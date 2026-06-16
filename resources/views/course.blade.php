<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-900/30 mb-2">
                    🎓 {{ __('Curriculum Matrix') }}
                </span>
                <h1 class="text-3xl font-extrabold tracking-tight text-neutral-900 dark:text-white">
                    {{ isset($course) ? $course->title : __('Academic Courses') }}
                </h1>
                <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
                    {{ isset($course) ? __('Course Scope Profile Workspace') : __('Manage and deploy institutional training modules.') }}
                </p>
            </div>

            <div class="flex items-center gap-3">
                @if(isset($course))
                    <a href="{{ route('student.courses.index') }}" class="px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-neutral-800 font-semibold text-xs text-neutral-600 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-800/60 transition-all cursor-pointer">
                        {{ __('View All Courses') }}
                    </a>
                @else
                    <a href="{{ url('/student/dashboard') }}" class="px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-neutral-800 font-semibold text-xs text-neutral-600 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-800/60 transition-all cursor-pointer">
                        {{ __('Back to Dashboard') }}
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-sm font-semibold flex items-center gap-3">
                    <span>✅</span> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 text-sm font-semibold space-y-1">
                    @foreach($errors->all() as $error)
                        <div class="flex items-center gap-3">
                            <span>⚠️</span> {{ $error }}
                        </div>
                    @endforeach
                </div>
            @endif

            @if(isset($course))
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-6">
                        <div class="p-6 rounded-2xl bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 space-y-4">
                            @if($course->image)
                                <img src="{{ asset($course->image) }}" alt="{{ $course->title }}" class="w-full h-64 object-cover rounded-xl border border-neutral-100 dark:border-neutral-800/40">
                            @endif
                            <h2 class="text-xl font-bold text-neutral-900 dark:text-white">{{ __('Description') }}</h2>
                            <p class="text-neutral-600 dark:text-neutral-400 text-sm leading-relaxed whitespace-pre-line">
                                {{ $course->description }}
                            </p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="p-6 rounded-2xl bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 space-y-4">
                            <h3 class="text-xs font-bold text-neutral-400 dark:text-neutral-500 uppercase tracking-wider">{{ __('Specification Details') }}</h3>

                            <div class="flex items-center justify-between border-b border-neutral-100 dark:border-neutral-800/60 pb-3">
                                <span class="text-xs font-medium text-neutral-500 dark:text-neutral-400">{{ __('Assigned Instructor') }}</span>
                                <span class="text-xs font-bold text-neutral-900 dark:text-white">{{ $course->instructor->name ?? __('Unassigned') }}</span>
                            </div>

                            <div class="flex items-center justify-between border-b border-neutral-100 dark:border-neutral-800/60 pb-3">
                                <span class="text-xs font-medium text-neutral-500 dark:text-neutral-400">{{ __('Allocated Value') }}</span>
                                <span class="text-sm font-extrabold text-neutral-900 dark:text-white">${{ number_format($course->price, 2) }}</span>
                            </div>

                            <div class="flex items-center justify-between border-b border-neutral-100 dark:border-neutral-800/60 pb-3">
                                <span class="text-xs font-medium text-neutral-500 dark:text-neutral-400">{{ __('Duration Footprint') }}</span>
                                <span class="text-xs font-bold text-neutral-900 dark:text-white">{{ $course->duration }} {{ __('Hours') }}</span>
                            </div>

                            <div class="flex items-center justify-between pb-1">
                                <span class="text-xs font-medium text-neutral-500 dark:text-neutral-400">{{ __('Publication Status') }}</span>
                                <span class="text-xs font-bold uppercase tracking-wider px-2 py-0.5 rounded text-white {{ $course->status === 'published' ? 'bg-emerald-600' : 'bg-amber-600' }}">
                                    {{ $course->status ?? 'Draft' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($courses ?? [] as $item)
                        <div class="group flex flex-col justify-between p-5 rounded-2xl bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 hover:border-indigo-500/40 transition-all duration-300">
                            <div class="space-y-4">
                                <div class="relative w-full h-44 rounded-xl bg-neutral-100 dark:bg-neutral-900 overflow-hidden border border-neutral-200/40 dark:border-neutral-800/40">
                                    @if($item->image)
                                        <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-neutral-400 dark:text-neutral-600 text-sm">
                                            {{ __('No Blueprint Cover Asset') }}
                                        </div>
                                    @endif

                                    <span class="absolute top-3 right-3 text-[10px] font-extrabold uppercase tracking-widest px-2 py-1 rounded-md shadow bg-white/90 dark:bg-neutral-950/90 text-neutral-800 dark:text-neutral-200 backdrop-blur-sm">
                                        {{ $item->duration }} {{ __('Hours') }}
                                    </span>
                                </div>

                                <div class="space-y-1">
                                    <h2 class="text-base font-bold text-neutral-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors line-clamp-1">
                                        {{ $item->title }}
                                    </h2>
                                    <p class="text-xs text-neutral-400 dark:text-neutral-500 font-medium">
                                        {{ __('Instructor:') }} <span class="text-neutral-600 dark:text-neutral-300 font-semibold">{{ $item->instructor->name ?? __('System Core AI') }}</span>
                                    </p>
                                </div>

                                <p class="text-xs text-neutral-500 dark:text-neutral-400 leading-relaxed line-clamp-2">
                                    {{ $item->description }}
                                </p>
                            </div>

                            <div class="pt-4 mt-4 border-t border-neutral-100 dark:border-neutral-800/60 flex items-center justify-between gap-2">
                                <span class="text-base font-black text-neutral-900 dark:text-white">
                                    ${{ number_format($item->price, 2) }}
                                </span>

                                <div class="flex items-center gap-2">
                                    <a href="{{ route('student.courses.show', $item->id) }}" class="px-3 py-1.5 rounded-lg bg-neutral-50 hover:bg-neutral-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 font-bold text-[11px] text-neutral-700 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-800 transition-colors cursor-pointer">
                                        {{ __('View Scope') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full p-12 text-center rounded-2xl border-2 border-dashed border-neutral-200 dark:border-neutral-800/60">
                            <span class="text-3xl text-neutral-400">📦</span>
                            <h3 class="mt-4 text-sm font-bold text-neutral-900 dark:text-white">{{ __('No Training Modules Active') }}</h3>
                            <p class="mt-1 text-xs text-neutral-500 dark:text-neutral-400">{{ __('The instructional database catalog is currently empty or records are soft-disabled.') }}</p>
                        </div>
                    @endforelse
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
