<x-admin-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl tracking-tight text-neutral-900 dark:text-white">
                    {{ __('Course Create Form') }}
                </h2>
                <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-0.5">
                    {{ __('Create, edit, and audit your curriculum offerings and status channels.') }}
                </p>
            </div>

        </div>
    </x-slot>

    <form id="courseForm" action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data" class="flex-1 overflow-y-auto p-6 space-y-4 m-0">
        @csrf
        <div id="methodOverride"></div>

        <div>
            <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Course Title') }}</label>
            <input type="text" id="course_title" name="title" oninput="generateSlug(this.value)" required placeholder="e.g., Advanced Enterprise Systems Integration" class="w-full px-3.5 py-2 text-sm bg-neutral-50 border border-neutral-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-black transition-all">
        </div>

        <div>
            <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Slug URL Key') }}</label>
            <input type="text" id="course_slug" name="slug" required placeholder="advanced-enterprise-systems-integration" class="w-full px-3.5 py-2 text-sm bg-neutral-50 border border-neutral-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-black transition-all font-mono">
        </div>

        <div>
            <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">
                {{ __('Assigned Instructor Profile') }}
            </label>

            <select id="course_instructor" name="instructor_id" required
                    class="w-full text-sm bg-white border border-neutral-200 rounded-xl px-3.5 py-2.5 text-neutral-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all cursor-pointer">

                <option value="" disabled {{ old('instructor_id') ? '' : 'selected' }} class="text-neutral-400">
                    {{ __('Select an instructor profile...') }}
                </option>

                @forelse($instructors ?? [] as $instructor)
                    @if(Auth::check() && Auth::id() === $instructor->id && Auth::user()->hasRole('instructor'))
                        @continue
                    @endif

                    <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }} class="bg-white text-neutral-900">
                        💼 {{ $instructor->name }} ({{ $instructor->email }})
                    </option>
                @empty
                    <option value="" disabled class="text-rose-500 font-medium">
                        ⚠️ {{ __('No instructors found in database records') }}
                    </option>
                @endforelse
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Description Syllabus Guidelines') }}</label>
            <textarea id="course_description" name="description" rows="3" required placeholder="Outline technical summary objectives, learning outcomes, and module syllabus guidelines..." class="w-full px-3.5 py-2 text-sm bg-neutral-50 border border-neutral-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-black transition-all resize-none"></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Price ($ USD)') }}</label>
                <input type="number" step="0.01" id="course_price" name="price" value="0.00" required class="w-full px-3.5 py-2 text-sm bg-neutral-50 border border-neutral-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-black transition-all">
            </div>
            <div>
                <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Duration (Hours)') }}</label>
                <input type="number" id="course_duration" name="duration" required placeholder="e.g., 36" class="w-full px-3.5 py-2 text-sm bg-neutral-50 border border-neutral-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-black transition-all">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Course Thumbnail Cover Image') }}</label>
            <input type="file" name="image" class="w-full text-sm text-neutral-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-neutral-100 file:text-neutral-800 hover:file:bg-neutral-200 transition-all">
        </div>

        <div class="grid grid-cols-2 gap-4 pt-2">
            <div>
                <label class="block text-xs font-bold text-neutral-600 tracking-wider uppercase mb-1.5">{{ __('Status Option') }}</label>
                <select id="course_status" name="status" class="w-full text-sm bg-neutral-50 border border-neutral-200 rounded-xl px-3 py-2 text-black focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                    <option value="draft">{{ __('Draft') }}</option>
                    <option value="published">{{ __('Published') }}</option>
                </select>
            </div>
            <div class="flex flex-col justify-end pb-2 pl-2">
                <label class="inline-flex items-center gap-2.5 cursor-pointer select-none">
                    <input type="checkbox" id="course_is_active" name="is_active" value="1" checked class="w-4 h-4 rounded text-indigo-600 border-neutral-300 focus:ring-indigo-500/30">
                    <span class="text-sm font-semibold text-neutral-800">{{ __('Set Active Immediately') }}</span>
                </label>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-4 border-t border-neutral-100 mt-6">
            <button type="button" onclick="toggleCourseModal(false)" class="px-4 py-2 text-sm font-semibold rounded-xl text-neutral-500 hover:bg-neutral-50 hover:text-black transition-colors cursor-pointer">
                {{ __('Cancel') }}
            </button>
            <button type="submit" id="submitFormButton" class="px-4 py-2 text-sm font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white transition-colors shadow-sm cursor-pointer">
                {{ __('Save Course Pipeline') }}
            </button>
        </div>
    </form>
    <script>
        function generateSlug(text) {
            document.getElementById('course_slug').value = text
                .toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
        }
    </script>

</x-admin-app-layout>
