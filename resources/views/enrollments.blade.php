<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-900/30 mb-2">
                    🎓 {{ __('Academic Portfolio') }}
                </span>
                <h1 class="text-2xl font-extrabold tracking-tight text-neutral-900 dark:text-white">
                    {{ __('My Enrolled Courses') }}
                </h1>
                <p class="mt-0.5 text-xs text-neutral-500 dark:text-neutral-400">
                    {{ __('Monitor active class passes, certification goals, and structural module progression timelines.') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-xs font-semibold">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($enrollments as $enrollment)
                    <div class="p-6 rounded-2xl bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 flex flex-col justify-between shadow-sm hover:shadow-md transition-all">

                        <div class="space-y-4">
                            <div class="flex items-start justify-between gap-2">
                                <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-500 dark:text-indigo-400 flex items-center justify-center font-bold text-lg flex-shrink-0">
                                    💻
                                </div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider {{ $enrollment->status === 'active' ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : ($enrollment->status === 'completed' ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400' : 'bg-neutral-500/10 text-neutral-500') }}">
                                    {{ $enrollment->status }}
                                </span>
                            </div>

                            <div>
                                <h3 class="text-sm font-bold text-neutral-900 dark:text-white line-clamp-2" title="{{ $enrollment->course->title ?? 'Unknown Course' }}">
                                    {{ $enrollment->course->title ?? __('Unassigned Course Module') }}
                                </h3>
                                <p class="text-[11px] text-neutral-400 mt-1 line-clamp-2">
                                    {{ $enrollment->course->description ?? __('No description footprint configured for this training pipeline.') }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-neutral-100 dark:border-neutral-800/60 flex items-center justify-between text-[11px]">
                            <div class="text-neutral-400">
                                {{ __('Registered:') }} <span class="font-mono font-semibold text-neutral-700 dark:text-neutral-300">{{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('M d, Y') : 'N/A' }}</span>
                            </div>

                            @if($enrollment->is_active && $enrollment->status !== 'suspended')
                                @php
                                    $firstLesson = $enrollment->course->lessons->first();
                                @endphp

                                @if($firstLesson)
                                    <a href="{{ route('student.lessons.show', ['lesson' => $firstLesson->slug]) }}" class="px-3 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold tracking-wide transition-all cursor-pointer">
                                        {{ __('Enter Class') }} →
                                    </a>
                                @else
                                    <a href="{{ route('student.lessons.show', ['lesson' => 'no-lessons-' . $enrollment->course_id]) }}" class="px-3 py-1.5 rounded-lg bg-neutral-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 text-neutral-500 dark:text-neutral-400 font-bold tracking-wide transition-all cursor-pointer">
                                        {{ __('Overview') }} 📖
                                    </a>
                                @endif
                            @else
                                <span class="text-rose-500 dark:text-rose-400 font-bold italic">
                                    🔒 {{ __('Access Locked') }}
                                </span>
                            @endif
                        </div>

                    </div>
                @empty
                    <div class="lg:col-span-3 p-12 text-center rounded-2xl border border-dashed border-neutral-300 dark:border-neutral-800">
                        <span class="text-3xl">📭</span>
                        <h3 class="mt-2 text-sm font-bold text-neutral-900 dark:text-white">{{ __('No Enrollments Tracked') }}</h3>
                        <p class="mt-1 text-xs text-neutral-400 max-w-sm mx-auto">
                            {{ __('You haven\'t secured pass privileges to any educational branches yet.') }}
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('student.courses.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow transition-all cursor-pointer">
                                {{ __('Browse Course Catalogue') }}
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            @if($enrollments->hasPages())
                <div class="mt-6">
                    {{ $enrollments->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
