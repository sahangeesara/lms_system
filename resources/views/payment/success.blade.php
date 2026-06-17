<x-app-layout>
    <x-slot name="header">
        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-900/30 mb-2">
                🎉 {{ __('Transaction Processed Successfully') }}
            </span>
            <h1 class="text-3xl font-extrabold tracking-tight text-neutral-900 dark:text-white">
                {{ __('Enrollment Confirmed!') }}
            </h1>
            <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
                {{ __('Your secure billing credentials have been verified and full access credentials have been provisioned.') }}
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 rounded-2xl p-6 sm:p-8 text-center shadow-sm space-y-6">

                <div class="w-16 h-16 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-full flex items-center justify-center text-2xl mx-auto border border-emerald-500/20 shadow-inner">
                    🚀
                </div>

                <div class="space-y-2">
                    <h2 class="text-xl font-black text-neutral-900 dark:text-white tracking-tight">
                        {{ __('Thank you for your order!') }}
                    </h2>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed max-w-md mx-auto">
                        {{ __('We appreciate your business! Your seat license has been activated inside the systemic course core matrix module wrapper.') }}
                    </p>
                </div>

                @if(isset($course))
                    <div class="p-5 rounded-xl bg-neutral-50 dark:bg-neutral-900/40 border border-neutral-100 dark:border-neutral-800/60 text-left space-y-3">
                        <h4 class="text-xs font-extrabold uppercase tracking-wider text-neutral-400 dark:text-neutral-500 pb-1 border-b border-neutral-200/50 dark:border-neutral-800/50">
                            {{ __('Access Asset Summary Details') }}
                        </h4>

                        <div class="flex justify-between items-start gap-4">
                            <span class="text-xs font-bold text-neutral-700 dark:text-neutral-300 line-clamp-1">
                                {{ $course->title }}
                            </span>
                            <span class="text-xs font-mono font-bold text-neutral-900 dark:text-white shrink-0">
                                ${{ number_format($amount ?? $course->price, 2) }}
                            </span>
                        </div>

                        <div class="flex justify-between items-center text-[11px] text-neutral-400 pt-1">
                            <span>{{ __('Duration Footprint Profile:') }}</span>
                            <span class="font-semibold">{{ $course->duration }} {{ __('Hours') }}</span>
                        </div>
                    </div>
                @endif

                <div class="p-4 rounded-xl border border-dashed border-neutral-200 dark:border-neutral-800 text-xs text-neutral-500 dark:text-neutral-400 leading-normal">
                    💡 {{ __('If you have any installation, API configuration, or curriculum routing questions, please ping structural support directly at') }}
                    <a href="mailto:orders@example.com" class="font-bold text-indigo-600 dark:text-indigo-400 hover:underline inline-flex items-center gap-0.5">
                        orders@example.com
                    </a>
                </div>

                <div class="pt-2 flex flex-col sm:flex-row items-center gap-3">
                    @if(isset($course))
                        <a href="{{ route('student.courses.show', $course->id) }}"
                           class="w-full sm:flex-1 flex items-center justify-center gap-2 px-5 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white font-bold text-sm tracking-wide shadow-md transition-all text-center cursor-pointer">
                            {{ __('Launch Classroom Workspace') }} →
                        </a>
                    @else
                        <a href="{{ route('student.courses.index') }}"
                           class="w-full sm:flex-1 flex items-center justify-center gap-2 px-5 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white font-bold text-sm tracking-wide shadow-md transition-all text-center cursor-pointer">
                            {{ __('Go to My Courses') }} →
                        </a>
                    @endif

                    <a href="{{ url('/student/dashboard') }}"
                       class="w-full sm:w-auto px-5 py-3.5 rounded-xl border border-neutral-200 dark:border-neutral-800 font-bold text-xs text-neutral-600 dark:text-neutral-400 hover:bg-neutral-50 dark:hover:bg-neutral-800/60 transition-all text-center cursor-pointer">
                        {{ __('Dashboard') }}
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
