<x-admin-app-layout>
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

        <div class="bg-emerald-50/40 dark:bg-emerald-950/10 p-6 rounded-2xl border border-emerald-100 dark:border-emerald-900/20 shadow-sm hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-semibold text-emerald-700 dark:text-emerald-400">Overall Course Progress</span>
                <span class="text-2xl">📈</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-neutral-900 dark:text-white">74%</span>
                <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/30 px-2 py-0.5 rounded-md">+4% this week</span>
            </div>
            <div class="w-full bg-neutral-200/60 dark:bg-neutral-800 h-2 rounded-full mt-4 overflow-hidden">
                <div class="bg-emerald-600 dark:bg-emerald-500 h-full rounded-full transition-all duration-500" style="width: 74%"></div>
            </div>
        </div>

        <div class="bg-rose-50/40 dark:bg-rose-950/10 p-6 rounded-2xl border border-rose-100 dark:border-rose-900/20 shadow-sm hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-semibold text-rose-700 dark:text-rose-400">Study Time Goal</span>
                <span class="text-2xl">⏳</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-neutral-900 dark:text-white">12.5 hrs</span>
                <span class="text-sm text-neutral-400">/ 15 hrs</span>
            </div>
            <div class="w-full bg-neutral-200/60 dark:bg-neutral-800 h-2 rounded-full mt-4 overflow-hidden">
                <div class="bg-amber-500 h-full rounded-full transition-all duration-500" style="width: 83.3%"></div>
            </div>
        </div>

        <div class="bg-indigo-50/40 dark:bg-indigo-950/10 p-6 rounded-2xl border border-indigo-100 dark:border-indigo-900/20 shadow-sm hover:shadow-md transition-all sm:col-span-2 lg:col-span-1">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-semibold text-indigo-700 dark:text-indigo-400">Completed Modules</span>
                <span class="text-2xl">✅</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-neutral-900 dark:text-white">18 / 24</span>
            </div>
            <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-4 font-medium">6 modules remaining across 2 active courses.</p>
        </div>
    </div>

    <div class="mb-4">
        <h3 class="text-lg font-bold text-neutral-900 dark:text-white">Grade Projection Simulator</h3>
        <p class="text-sm text-neutral-500 dark:text-neutral-400">Adjust your estimated effort parameters to forecast your final academic score trend.</p>
    </div>
</x-admin-app-layout>
