<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-900/30 mb-2">
                    ⚡ {{ __('Module Preview') }}
                </span>
                <h1 class="text-3xl font-extrabold tracking-tight text-neutral-900 dark:text-white">
                    {{ __('Advanced Full-Stack Development') }}
                </h1>
                <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
                    {{ __('Course ID: Functional Route Placeholder Workspace') }}
                </p>
            </div>

            <!-- Quick Actions -->
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-neutral-800 font-semibold text-xs text-neutral-600 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-800/60 transition-all cursor-pointer">
                    {{ __('Back to Dashboard') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Construction Context Banner -->
            <div class="p-6 rounded-2xl bg-gradient-to-r from-indigo-500/10 via-transparent to-transparent border border-indigo-500/20 dark:border-indigo-500/30 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-indigo-600 flex items-center justify-center text-xl text-white shadow-md">
                        🛠️
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-neutral-900 dark:text-white">
                            {{ __('Temporary Workspace Environment Active') }}
                        </h3>
                        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed max-w-2xl">
                            {{ __('This layout represents a structural scaffolding blueprint block. Database entity relationships, video processing stream pipelines, and real-time step trackers are being linked to this operational matrix segment.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Main Split Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left: Syllabus Outline Placeholders (2 Columns wide) -->
                <div class="lg:col-span-2 space-y-4">
                    <h3 class="text-xs font-bold text-neutral-400 dark:text-neutral-500 uppercase tracking-wider pl-1">
                        {{ __('Pending Curriculum Index Structure') }}
                    </h3>

                    <!-- Step Item 1 -->
                    <div class="p-5 rounded-2xl bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 flex items-center justify-between gap-4 group hover:border-indigo-500/40 dark:hover:border-indigo-500/40 transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <span class="w-8 h-8 rounded-lg bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 flex items-center justify-center text-xs font-bold text-neutral-500 dark:text-neutral-400">
                                01
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-neutral-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                    {{ __('Architecture Foundations & Schema Engineering') }}
                                </h4>
                                <p class="text-xs text-neutral-400 dark:text-neutral-500 mt-0.5">
                                    {{ __('Duration: 45 minutes · Requires Core Prerequisites') }}
                                </p>
                            </div>
                        </div>
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-md bg-neutral-50 dark:bg-neutral-900 text-neutral-400 border border-neutral-200/50 dark:border-neutral-800/80">
                            {{ __('Locked') }}
                        </span>
                    </div>

                    <!-- Step Item 2 -->
                    <div class="p-5 rounded-2xl bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 flex items-center justify-between gap-4 group hover:border-indigo-500/40 dark:hover:border-indigo-500/40 transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <span class="w-8 h-8 rounded-lg bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 flex items-center justify-center text-xs font-bold text-neutral-500 dark:text-neutral-400">
                                02
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-neutral-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                    {{ __('Asynchronous Network Streams & WebSockets') }}
                                </h4>
                                <p class="text-xs text-neutral-400 dark:text-neutral-500 mt-0.5">
                                    {{ __('Duration: 60 minutes · Includes Code Exercise Data') }}
                                </p>
                            </div>
                        </div>
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-md bg-neutral-50 dark:bg-neutral-900 text-neutral-400 border border-neutral-200/50 dark:border-neutral-800/80">
                            {{ __('Locked') }}
                        </span>
                    </div>
                </div>

                <!-- Right: Metadata & Metrics Panel (1 Column wide) -->
                <div class="space-y-6">
                    <h3 class="text-xs font-bold text-neutral-400 dark:text-neutral-500 uppercase tracking-wider pl-1">
                        {{ __('Workspace Target Specs') }}
                    </h3>

                    <div class="p-6 rounded-2xl bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 space-y-5">
                        <!-- Metric Row 1 -->
                        <div class="flex items-center justify-between border-b border-neutral-100 dark:border-neutral-800/60 pb-3">
                            <span class="text-xs font-medium text-neutral-500 dark:text-neutral-400">{{ __('Assigned Instructor') }}</span>
                            <span class="text-xs font-bold text-neutral-900 dark:text-white">EduStream Core AI</span>
                        </div>

                        <!-- Metric Row 2 -->
                        <div class="flex items-center justify-between border-b border-neutral-100 dark:border-neutral-800/60 pb-3">
                            <span class="text-xs font-medium text-neutral-500 dark:text-neutral-400">{{ __('Target Modules Count') }}</span>
                            <span class="text-xs font-bold text-neutral-900 dark:text-white">12 Instructional Units</span>
                        </div>

                        <!-- Metric Row 3 -->
                        <div class="flex items-center justify-between pb-1">
                            <span class="text-xs font-medium text-neutral-500 dark:text-neutral-400">{{ __('Enrolled Access Level') }}</span>
                            <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">Premium Access</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
