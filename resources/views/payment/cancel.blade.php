<x-app-layout>
    <x-slot name="header">
        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 border border-amber-100 dark:border-amber-900/30 mb-2">
                ⚠️ {{ __('Transaction Gateway Absolute Abort') }}
            </span>
            <h1 class="text-3xl font-extrabold tracking-tight text-neutral-900 dark:text-white">
                {{ __('Checkout Canceled') }}
            </h1>
            <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
                {{ __('Your secure programmatic payment request pipeline was terminated. No financial charges were executed.') }}
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 rounded-2xl p-8 text-center shadow-sm space-y-6">

                <div class="w-16 h-16 bg-amber-500/10 text-amber-500 dark:text-amber-400 rounded-full flex items-center justify-center text-2xl mx-auto border border-amber-500/20">
                    🛒
                </div>

                <div class="space-y-2">
                    <h3 class="text-lg font-bold text-neutral-900 dark:text-white tracking-tight">
                        {{ __('Forgot to add something?') }}
                    </h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed">
                        {{ __('No worries! If you missed an item or want to review your educational profile limits, browse around the portal structure then return whenever you are ready to complete verification onboarding.') }}
                    </p>
                </div>

                <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800/60 flex flex-col gap-3.5">
                    <a href="{{ route('student.courses.index') }}"
                       class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white font-bold text-sm tracking-wide shadow-sm hover:shadow transition-all text-center cursor-pointer">
                        <span>📚</span> {{ __('Browse Course Catalogue') }}
                    </a>

                    <a href="{{ url('/student/dashboard') }}"
                       class="text-xs font-bold text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-300 transition-colors">
                        {{ __('Return to Student Dashboard') }}
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
