<x-instructor-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl tracking-tight text-neutral-900 dark:text-white">
                    {{ __('Welcome Back, ') }}{{ Auth::user()->name }} 👋
                </h2>
                <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-0.5">
                    Track your performance and manage your learning milestones.
                </p>
            </div>
            <div class="flex items-center gap-2 text-xs font-semibold px-3 py-1.5 rounded-full bg-indigo-50 text-indigo-700 dark:bg-indigo-950/40 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-900/30 w-fit">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                Academic Term: Fall 2026
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="p-6 rounded-2xl bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 shadow-sm hover:shadow-md transition-all flex items-center justify-between group">
            <div class="space-y-1.5">
                <p class="text-xs font-bold text-neutral-400 dark:text-neutral-500 uppercase tracking-wider">
                    {{ __('Total Students') }}
                </p>
                <h3 class="text-3xl font-black text-neutral-900 dark:text-white tracking-tight">
                    {{ $students_count ?? '0' }}
                </h3>
                <p class="text-[11px] font-medium text-emerald-600 dark:text-emerald-400 flex items-center gap-1">
                    <span>✨</span> {{ __('Active learners onboarded') }}
                </p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 dark:bg-indigo-500/5 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl shadow-inner group-hover:scale-105 transition-transform duration-300">
                👥
            </div>
        </div>

        <div class="p-6 rounded-2xl bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 shadow-sm hover:shadow-md transition-all flex items-center justify-between group">
            <div class="space-y-1.5">
                <p class="text-xs font-bold text-neutral-400 dark:text-neutral-500 uppercase tracking-wider">
                    {{ __('Instructors') }}
                </p>
                <h3 class="text-3xl font-black text-neutral-900 dark:text-white tracking-tight">
                    {{ $instructors_count ?? '0' }}
                </h3>
                <p class="text-[11px] font-medium text-amber-600 dark:text-amber-500 flex items-center gap-1">
                    <span>🛡️</span> {{ __('Verified staff members') }}
                </p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-500/10 dark:bg-amber-500/5 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xl shadow-inner group-hover:scale-105 transition-transform duration-300">
                👨‍🏫
            </div>
        </div>

        <div class="p-6 rounded-2xl bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 shadow-sm hover:shadow-md transition-all flex items-center justify-between group sm:col-span-2 lg:col-span-1">
            <div class="space-y-1.5">
                <p class="text-xs font-bold text-neutral-400 dark:text-neutral-500 uppercase tracking-wider">
                    {{ __('Active Courses') }}
                </p>
                <h3 class="text-3xl font-black text-neutral-900 dark:text-white tracking-tight">
                    {{ $courses_count ?? '0' }}
                </h3>
                <p class="text-[11px] font-medium text-indigo-600 dark:text-indigo-400 flex items-center gap-1">
                    <span>📖</span> {{ __('Live curriculum modules') }}
                </p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 dark:bg-emerald-500/5 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl shadow-inner group-hover:scale-105 transition-transform duration-300">
                💻
            </div>
        </div>
    </div>

    <div class="mb-4">
        <h3 class="text-lg font-bold text-neutral-900 dark:text-white">Grade Projection Simulator</h3>
        <p class="text-sm text-neutral-500 dark:text-neutral-400">Adjust your estimated effort parameters to forecast your final academic score trend.</p>
    </div>
</x-instructor-app-layout>
