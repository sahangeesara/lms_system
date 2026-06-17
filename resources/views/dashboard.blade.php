<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl tracking-tight text-neutral-900 dark:text-white">
                    {{ __('Welcome Back, ') }}{{ Auth::user()->name }} 👋
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-[#131313] p-6 rounded-2xl border border-neutral-200/60 dark:border-neutral-800/60 shadow-sm">
                    <span class="text-sm font-semibold text-neutral-500">{{ __('Overall Progress') }}</span>
                    <h3 class="text-3xl font-black mt-2">{{ $overall_progress ?? 0 }}%</h3>
                    <div class="w-full bg-neutral-100 dark:bg-neutral-800 h-2 rounded-full mt-4">
                        <div class="bg-indigo-600 h-full rounded-full" style="width: {{ $overall_progress ?? 0}}%"></div>
                    </div>
                </div>

                <div class="bg-white dark:bg-[#131313] p-6 rounded-2xl border border-neutral-200/60 dark:border-neutral-800/60 shadow-sm">
                    <span class="text-sm font-semibold text-neutral-500">{{ __('My Enrollments') }}</span>
                    <h3 class="text-3xl font-black mt-2">{{ $enrolled_count ?? 0}}</h3>
                </div>

                <div class="bg-white dark:bg-[#131313] p-6 rounded-2xl border border-neutral-200/60 dark:border-neutral-800/60 shadow-sm">
                    <span class="text-sm font-semibold text-neutral-500">{{ __('Catalog Size') }}</span>
                    <h3 class="text-3xl font-black mt-2">{{ $total_courses_count ?? 0}}</h3>
                </div>

            </div>

            <div class="bg-white dark:bg-[#131313] p-8 rounded-2xl border border-neutral-200/60 dark:border-neutral-800/60 shadow-sm">
                <h3 class="text-lg font-bold text-neutral-900 dark:text-white">{{ __('Grade Projection Simulator') }}</h3>
                <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-2">
                    {{ __('Adjust your effort parameters to forecast your final academic score.') }}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
