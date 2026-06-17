<x-admin-app-layout>
    <!-- Solid Black Header Matrix -->
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-neutral-870 p-6 rounded-xl border border-neutral-900 shadow-md">
            <div>
                <h2 class="font-extrabold text-2xl tracking-tight text-white">
                    {{ __('Edit Curriculum Lesson') }}
                </h2>
                <p class="text-sm text-neutral-400 mt-0.5">
                    {{ __('Modify architectural constraints, sorting weights, and asset delivery targets.') }}
                </p>
            </div>
        </div>
    </x-slot>

    <!-- Validation Notification Bar -->
    @if($errors->any())
        <div class="max-w-4xl mx-auto px-6 pt-4">
            <div class="p-3.5 bg-rose-50 border border-rose-100 rounded-xl text-xs text-rose-700 font-medium space-y-1">
                <p class="font-bold uppercase tracking-wider text-[10px] text-rose-800 mb-1">{{ __('Validation Engine Constraints Rejected:') }}</p>
                <ul class="list-disc pl-4 space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Permanent Pure White Container -->
    <div class="bg-white min-h-screen p-6">
        <form id="lessonForm" action="{{ route('admin.lessons.update', $lesson->id) }}" method="POST"
              class="max-w-4xl mx-auto bg-white p-8 space-y-5 rounded-2xl border border-neutral-200 shadow-sm m-0">
            @csrf
            @method('PUT')

            <!-- Associated Course Group Dropdown Mapping Existing Constraint -->
            <div>
                <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Associated Target Course') }}</label>
                <select id="lesson_course_id" name="course_id" required
                        class="w-full text-sm bg-white border border-neutral-200 rounded-xl px-3.5 py-2.5 text-neutral-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 cursor-pointer">
                    @foreach($courses ?? [] as $course)
                        <option value="{{ $course->id }}" {{ old('course_id', $lesson->course_id) == $course->id ? 'selected' : '' }}>📚 {{ $course->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Lesson Title Module -->
            <div>
                <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Lesson Title') }}</label>
                <input type="text" id="lesson_title" name="title" value="{{ old('title', $lesson->title) }}" oninput="generateSlug(this.value)" required
                       placeholder="e.g., Introduction to RESTful Router Management"
                       class="w-full px-3.5 py-2.5 text-sm bg-white border border-neutral-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-neutral-900 transition-all">
            </div>

            <!-- Lesson Slug Module -->
            <div>
                <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Slug URL Key') }}</label>
                <input type="text" id="lesson_slug" name="slug" value="{{ old('slug', $lesson->slug) }}" required
                       placeholder="introduction-to-restful-router-management"
                       class="w-full px-3.5 py-2.5 text-sm bg-white border border-neutral-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-neutral-900 transition-all font-mono">
            </div>

            <!-- Streaming Video URL Input Tracking Current String Row -->
            <div>
                <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Streaming Video URL') }} <span class="text-neutral-400 font-normal">({{ __('Optional') }})</span></label>
                <input type="url" id="lesson_video_url" name="video_url" value="{{ old('video_url', $lesson->video_url) }}"
                       placeholder="https://vimeo.com/... or https://youtube.com/embed/..."
                       class="w-full px-3.5 py-2.5 text-sm bg-white border border-neutral-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-neutral-900 transition-all font-mono">
            </div>

            <!-- Text Content Field Content Decoding System Payload -->
            <div>
                <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Text Content Curriculum') }} <span class="text-neutral-400 font-normal">({{ __('Optional') }})</span></label>
                <textarea id="lesson_content" name="content" rows="6"
                          placeholder="Compose rich text guidelines, instructional guidelines..."
                          class="w-full px-3.5 py-2.5 text-sm bg-white border border-neutral-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-neutral-900 transition-all resize-none">
                    {{ trim(old('content', is_array($lesson->content) ? ($lesson->content['body'] ?? '') : (json_decode($lesson->content, true)['body'] ?? $lesson->content))) }}
                </textarea>
            </div>

            <!-- Display Controls Grid Block Tracking Flags -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <div>
                    <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Sequential Sorting Order') }}</label>
                    <input type="number" id="lesson_order" name="order" value="{{ old('order', $lesson->order) }}" min="0" required
                           class="w-full px-3.5 py-2.5 text-sm bg-white border border-neutral-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-neutral-900 transition-all">
                </div>
                <div class="flex flex-col justify-end pb-2.5 pl-2">
                    <label class="inline-flex items-center gap-2.5 cursor-pointer select-none">
                        <input type="checkbox" id="lesson_is_active" name="is_active" value="1" {{ old('is_active', $lesson->is_active) ? 'checked' : '' }}
                        class="w-4 h-4 rounded text-indigo-600 border-neutral-300 focus:ring-indigo-500/30">
                        <span class="text-sm font-semibold text-neutral-800">{{ __('Publish & Activate Immediately') }}</span>
                    </label>
                </div>
            </div>

            <!-- Form Submission Action Bar -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-neutral-100 mt-6">
                <a href="{{ route('admin.lessons.index') }}" class="px-4 py-2 text-sm font-semibold rounded-xl text-neutral-500 hover:bg-neutral-100 hover:text-neutral-900 transition-colors text-center cursor-pointer">
                    {{ __('Cancel Actions') }}
                </a>
                <button type="submit" class="px-4 py-2 text-sm font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white transition-colors shadow-sm cursor-pointer">
                    {{ __('Update Identity Blueprint') }}
                </button>
            </div>
        </form>
    </div>

    <!-- Autogenerate slug script configuration -->
    <script>
        function generateSlug(text) {
            document.getElementById('lesson_slug').value = text
                .toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
        }
    </script>
</x-admin-app-layout>
