<x-instructor-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-neutral-870 p-6 rounded-xl border border-neutral-900 shadow-md">
            <div>
                <h2 class="font-extrabold text-2xl tracking-tight text-white">
                    {{ __('Course Edit Form') }}
                </h2>
                <p class="text-sm text-neutral-400 mt-0.5">
                    {{ __('Modify and deploy existing institutional training modules.') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="bg-white min-h-screen p-6">
        <form id="courseForm" action="{{ route('instructor.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data"
              class="max-w-4xl mx-auto bg-white p-8 space-y-5 rounded-2xl border border-neutral-200 shadow-sm m-0">

            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Course Title') }}</label>
                <input type="text" id="course_title" name="title"
                       value="{{ old('title', $course->title) }}"
                       oninput="generateSlug(this.value)" required
                       placeholder="e.g., Advanced Enterprise Systems Integration"
                       class="w-full px-3.5 py-2.5 text-sm bg-white border border-neutral-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-neutral-900 transition-all">
            </div>

            <div>
                <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Slug URL Key') }}</label>
                <input type="text" id="course_slug" name="slug"
                       value="{{ old('slug', $course->slug) }}" required
                       placeholder="advanced-enterprise-systems-integration"
                       class="w-full px-3.5 py-2.5 text-sm bg-white border border-neutral-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-neutral-900 transition-all font-mono">
            </div>

            <div>
                <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">
                    {{ __('Assigned Instructor Profile') }}
                </label>

                    <input type="hidden" name="instructor_id" value="{{ Auth::id() }}">
                    <div class="w-full text-sm bg-neutral-50 border border-neutral-200 rounded-xl px-3.5 py-2.5 text-neutral-500 cursor-not-allowed">
                        💼 {{ Auth::user()->name }} ({{ Auth::user()->email }})
                    </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Description Syllabus Guidelines') }}</label>
                <textarea id="course_description" name="description" rows="5" required
                          placeholder="Outline technical summary objectives, learning outcomes..."
                          class="w-full px-3.5 py-2.5 text-sm bg-white border border-neutral-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-neutral-900 transition-all resize-none">{{ old('description', $course->description) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Price ($ USD)') }}</label>
                    <input type="number" step="0.01" id="course_price" name="price"
                           value="{{ old('price', $course->price ?? '0.00') }}" required
                           class="w-full px-3.5 py-2.5 text-sm bg-white border border-neutral-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-neutral-900 transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Duration (Hours)') }}</label>
                    <input type="number" id="course_duration" name="duration"
                           value="{{ old('duration', $course->duration) }}" required
                           placeholder="e.g., 36"
                           class="w-full px-3.5 py-2.5 text-sm bg-white border border-neutral-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-neutral-900 transition-all">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Course Thumbnail Cover Image') }}</label>
                @if($course->image)
                    <div class="mb-3 flex items-center gap-3 bg-neutral-50 p-2 rounded-xl border border-neutral-200 w-fit">
                        <img src="{{ asset($course->image) }}" alt="Thumbnail Preview" class="w-20 h-14 object-cover rounded-lg border border-neutral-200">
                        <span class="text-xs text-neutral-500 font-medium">{{ __('Current Active Image') }}</span>
                    </div>
                @endif
                <input type="file" name="image" class="w-full text-sm text-neutral-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-neutral-100 file:text-neutral-800 hover:file:bg-neutral-200 transition-all">
            </div>

            <div class="grid grid-cols-2 gap-4 pt-2">
                <div>
                    <label class="block text-xs font-bold text-neutral-600 tracking-wider uppercase mb-1.5">{{ __('Status Option') }}</label>
                    <select id="course_status" readonly name="status" class="w-full text-sm bg-white border border-neutral-200 rounded-xl px-3 py-2 text-neutral-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        <option value="draft" {{ old('status', $course->status) === 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
                        <option value="published" {{ old('status', $course->status) === 'published' ? 'selected' : '' }}>{{ __('Published') }}</option>
                    </select>
                </div>
                <div class="flex flex-col justify-end pb-2 pl-2">
                    <label class="inline-flex items-center gap-2.5 cursor-pointer select-none">
                        <input type="checkbox" id="course_is_active" name="is_active" value="1"
                               {{ old('is_active', $course->is_active) ? 'checked' : '' }}
                               class="w-4 h-4 rounded text-indigo-600 border-neutral-300 focus:ring-indigo-500/30">
                        <span class="text-sm font-semibold text-neutral-800">{{ __('Set Active Immediately') }}</span>
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-neutral-100 mt-6">
                <a href="{{ route('admin.courses.index') }}" class="px-4 py-2 text-sm font-semibold rounded-xl text-neutral-500 hover:bg-neutral-100 hover:text-neutral-900 transition-colors cursor-pointer text-center">
                    {{ __('Cancel') }}
                </a>
                <button type="submit" id="submitFormButton" class="px-4 py-2 text-sm font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white transition-colors shadow-sm cursor-pointer">
                    {{ __('Save Course Pipeline') }}
                </button>
            </div>
        </form>
    </div>
</x-instructor-app-layout>
