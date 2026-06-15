<x-guest-layout>
    <div class="min-height-screen flex flex-col items-center justify-center bg-[#FAF9F6] dark:bg-[#0A0A0A] px-4 sm:px-6 lg:px-8 transition-colors duration-300">

        <div class="w-full max-w-md space-y-6 bg-white dark:bg-[#131313] p-8 rounded-2xl border border-neutral-200/60 dark:border-neutral-800/60 shadow-xl">

            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-indigo-50 dark:bg-indigo-950/40 text-3xl mb-4">
                    ✉️
                </div>
                <h2 class="text-2xl font-extrabold tracking-tight text-neutral-900 dark:text-white">
                    Verify Your Email
                </h2>
                <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/40 text-sm font-medium text-emerald-700 dark:text-emerald-400">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="pt-2 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="w-full sm:w-auto flex justify-center py-3 px-5 border border-transparent rounded-xl shadow-md text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all cursor-pointer">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto text-center">
                    @csrf
                    <button type="submit" class="text-sm font-semibold text-neutral-500 dark:text-neutral-400 hover:text-neutral-700 dark:hover:text-neutral-200 hover:underline transition-all cursor-pointer">
                        {{ __('Log Out') }}
                    </button>
                </form>

            </div>

        </div>
    </div>
</x-guest-layout>
