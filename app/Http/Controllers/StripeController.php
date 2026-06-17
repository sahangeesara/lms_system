<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\StripeClient;

class StripeController extends Controller
{
    protected $stripe;

    public function __construct()
    {
        // Pulls secret from your config/services.php or .env file
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    /**
     * 1. Initiates checkout process
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $user = Auth::user();
        $course = Course::findOrFail($request->course_id);

        // Crucial: Check if they are already enrolled to avoid duplicate charges
        $alreadyEnrolled = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->exists();

        if ($alreadyEnrolled) {
            return redirect()->back()->withErrors(['error' => 'You are already enrolled in this course.']);
        }

        try {
            // Build the checkout session matrix
            $session = $this->stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $course->title,
                            'description' => substr($course->description, 0, 255),
                        ],
                        'unit_amount' => $course->price * 100, // Stripe expects amounts in cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                // CRUCIAL: We append ?session_id={CHECKOUT_SESSION_ID} so the success method can trace it
                'success_url' => route('student.payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('student.courses.show', $course->id),
                // CRUCIAL: Metadata is passed to track back who paid for what
                'metadata' => [
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                ],
            ]);

            return redirect($session->url);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Stripe initialization failed: ' . $e->getMessage()]);
        }
    }

    /**
     * 2. Handles successful redirect back from Stripe
     */
    public function success(Request $request)
    {
        $sessionId = $request->query('session_id');

        if (!$sessionId) {
            return redirect()->route('student.courses.index')->withErrors(['error' => 'Invalid session tracing tracking key pointer.']);
        }

        try {
            // Fetch raw session state back from Stripe API
            $sessionInfo = $this->stripe->checkout->sessions->retrieve($sessionId);

            // Extract metadata fields sent during step 1
            $userId   = $sessionInfo->metadata->user_id;
            $courseId = $sessionInfo->metadata->course_id;
            $amount   = $sessionInfo->amount_total / 100; // Convert cents back to absolute decimal
            $currency = strtoupper($sessionInfo->currency);

            // Open atomic transaction capsule to guarantee both tables change, or neither changes
            DB::transaction(function () use ($userId, $courseId, $amount, $currency, $sessionInfo) {

                // A. Populate/Update payments table
                $payment = Payment::updateOrCreate([
                    'transaction_id' => $sessionInfo->id,
                ], [
                    'user_id'        => $userId,
                    'provider'       => 'stripe',
                    'amount'         => $amount,
                    'currency'       => $currency,
                    'status'         => 'completed',
                    'notes'          => 'Automated checkout verification loop.',
                ]);

                // B. Populate/Update enrollments table
                Enrollment::updateOrCreate([
                    'user_id'     => $userId,
                    'course_id'   => $courseId,
                ], [
                    'amount_paid' => $amount,
                    'payment_id'  => $payment->id,
                    'enrolled_at' => now(),
                    'status'      => 'active',
                    'is_active'   => true,
                ]);
            });

            // Re-fetch course payload context for final display view presentation layout
            $course = Course::findOrFail($courseId);

            // Redirect back to individual dashboard view index with explicit banner indicators
            return redirect()->route('student.courses.show', $courseId)->with('success', 'Payment successful! You are now fully enrolled.');

        } catch (\Throwable $th) {
            Log::critical('Checkout sync failure point: ' . $th->getMessage());
            return redirect()->route('student.courses.index')->withErrors(['error' => 'Database writing process broken down: ' . $th->getMessage()]);
        }
    }

    public function cancel()
    {
        return view('payment.cancel');
    }
}
