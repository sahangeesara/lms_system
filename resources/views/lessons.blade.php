<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">

                {{-- Main Content Column --}}
                <div class="lg:col-span-3 space-y-6">
                    <div class="relative aspect-video rounded-2xl bg-neutral-950 overflow-hidden shadow-lg border border-neutral-800">
                        @if(!empty($lesson->video_url))
                            @php
                                $url = str_contains($lesson->video_url, 'watch?v=')
                                    ? str_replace('watch?v=', 'embed/', $lesson->video_url)
                                    : $lesson->video_url;
                            @endphp
                            <iframe class="w-full h-full absolute inset-0" src="{{ $url }}" allowfullscreen></iframe>
                        @else
                            <div class="flex items-center justify-center h-full text-neutral-500 italic">
                                {{ __('No media available for this module.') }}
                            </div>
                        @endif
                    </div>

                    <div class="p-8 rounded-2xl bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60">
                        <h3 class="text-xl font-extrabold text-neutral-900 dark:text-white mb-4">{{ $lesson->title }}</h3>
                        @php
                            $content = is_string($lesson->content) ? json_decode($lesson->content, true) : $lesson->content;
                            $body = trim(is_array($content) ? ($content['body'] ?? '') : $lesson->content);
                        @endphp
                        <p class="text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed whitespace-pre-wrap">{{ $body }}</p>
                    </div>
                </div>

                {{-- Sidebar: Curriculum --}}
                <div class="lg:col-span-1 space-y-6">
                    <h4 class="text-xs font-bold text-neutral-400 uppercase tracking-wider pl-1">{{ __('Curriculum') }}</h4>
                    <div class="rounded-2xl bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 overflow-hidden">
                        @forelse($allLessons as $item)
                            @php
                                // Check if this is the active lesson, safely handling mock objects
                                $isActive = (isset($lesson->id) && $item->id === $lesson->id);
                            @endphp

                            <a href="{{ route('student.lessons.show', ['lesson' => $item->slug]) }}"
                               class="block p-4 border-b border-neutral-100 dark:border-neutral-800 last:border-b-0
                               {{ $isActive ? 'bg-indigo-50 dark:bg-indigo-900/20' : 'hover:bg-neutral-50 dark:hover:bg-neutral-900' }}">
                                <div class="flex items-start gap-3">
                                    <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-neutral-200 dark:bg-neutral-800 text-neutral-600">{{ $item->order }}</span>
                                    <p class="text-sm font-semibold {{ $isActive ? 'text-indigo-600 dark:text-indigo-400' : 'text-neutral-800 dark:text-neutral-200' }}">
                                        {{ $item->title }}
                                    </p>
                                </div>
                            </a>
                        @empty
                            <div class="p-4 text-sm text-neutral-500 italic">
                                {{ __('No additional lessons available.') }}
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
