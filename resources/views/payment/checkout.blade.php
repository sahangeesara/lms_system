<x-app-layout>
    <x-slot name="header">
        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-900/30 mb-2">
                📦 {{ __('Product Validation Matrix') }}
            </span>
            <h1 class="text-3xl font-extrabold tracking-tight text-neutral-900 dark:text-white">
                {{ __('Confirm Purchase Entry') }}
            </h1>
            <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
                {{ __('Verify core asset descriptions before dispatching data packets to the Stripe transaction processing core.') }}
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">

            @if($errors->any())
                <div class="mb-4 p-4 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 text-xs font-semibold space-y-1">
                    @foreach($errors->all() as $error)
                        <div class="flex items-center gap-2"><span>⚠️</span> {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">

                <div class="relative w-full h-64 bg-neutral-100 dark:bg-neutral-900 overflow-hidden border-b border-neutral-100 dark:border-neutral-800/60">
                    @if(isset($course) && $course->image)
                        <img src="{{ asset($course->image) }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                    @else
                        <img src="https://i.imgur.com/EHyR2nP.png" alt="Stubborn Attachments Cover" class="w-full h-full object-cover">
                    @endif
                </div>

                <div class="p-6 space-y-6">
                    <div class="space-y-1.5">
                        <h3 class="text-lg font-bold text-neutral-900 dark:text-white tracking-tight">
                            {{ $course->title ?? 'Stubborn Attachments' }}
                        </h3>
                        <p class="text-xs text-neutral-400 dark:text-neutral-500 leading-normal line-clamp-3">
                            {{ $course->description ?? __('A vision for a society of free, prosperous, and responsible individuals maximizing systemic long-term production value.') }}
                        </p>
                    </div>

                    <div class="p-4 rounded-xl bg-neutral-50 dark:bg-neutral-900/40 border border-neutral-100 dark:border-neutral-800/60 flex items-center justify-between">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-neutral-400 dark:text-neutral-500">
                            {{ __('Total Valuation Due') }}
                        </span>
                        <span class="text-2xl font-black text-indigo-600 dark:text-indigo-400 font-mono">
                            ${{ isset($course) ? number_format($course->price, 2) : '20.00' }}
                        </span>
                    </div>

                    <form action="{{ route('student.payment.checkout') }}" method="POST" class="m-0 pt-2">
                        @csrf

                        <input type="hidden" name="course_id" value="{{ $course->id ?? 1 }}">

                        <button type="submit" id="checkout-button" class="w-full flex items-center justify-center gap-2 px-4 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white font-bold text-sm tracking-wide shadow transition-colors cursor-pointer">
                            <span>💳</span> {{ __('Proceed to Secure Checkout') }}
                        </button>
                    </form>

                    <div class="text-center">
                        <a href="{{ route('student.courses.index') }}" class="inline-block text-xs font-bold text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-300 transition-colors">
                            ← {{ __('Return to Catalogue') }}
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
