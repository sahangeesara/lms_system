<x-admin-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl tracking-tight text-neutral-900 dark:text-white">
                    {{ __('Course Management') }}
                </h2>
                <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-0.5">
                    {{ __('Audit your curriculum offerings and status channels.') }}
                </p>
            </div>

            <button type="button" onclick="window.location.href='{{ route('admin.courses.create') }}'" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                {{ __('Create New Course') }}
            </button>
        </div>
    </x-slot>

    <form method="GET" action="{{ route('admin.courses.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-neutral-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Search by title...') }}"
                   class="w-full pl-9 pr-4 py-2 text-sm bg-neutral-50 dark:bg-[#131313] border border-neutral-200/80 rounded-xl focus:border-indigo-500 transition-colors dark:text-white">
        </div>

        <select name="status" onchange="this.form.submit()" class="text-sm bg-neutral-50 dark:bg-[#131313] border border-neutral-200/80 rounded-xl px-3 py-2 text-neutral-600 dark:text-neutral-400">
            <option value="">{{ __('All Statuses') }}</option>
            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>{{ __('Published') }}</option>
            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
        </select>

        <select name="instructor_id" onchange="this.form.submit()" class="text-sm bg-neutral-50 dark:bg-[#131313] border border-neutral-200/80 rounded-xl px-3 py-2 text-neutral-600 dark:text-neutral-400">
            <option value="">{{ __('All Instructors') }}</option>
            @foreach($instructors as $instructor)
                <option value="{{ $instructor->id }}" {{ request('instructor_id') == $instructor->id ? 'selected' : '' }}>{{ $instructor->name }}</option>
            @endforeach
        </select>

        <select name="price_range" onchange="this.form.submit()" class="text-sm bg-neutral-50 dark:bg-[#131313] border border-neutral-200/80 rounded-xl px-3 py-2 text-neutral-600 dark:text-neutral-400">
            <option value="">{{ __('Any Price Range') }}</option>
            <option value="0-60" {{ request('price_range') == '0-60' ? 'selected' : '' }}>{{ __('$0 - $60') }}</option>
            <option value="40-100" {{ request('price_range') == '40-100' ? 'selected' : '' }}>{{ __('$40 - $100') }}</option>
            <option value="150-500" {{ request('price_range') == '150-500' ? 'selected' : '' }}>{{ __('$150 - $500') }}</option>
        </select>
    </form>

    <div class="bg-white dark:bg-[#111111] border border-neutral-200/60 dark:border-neutral-800/60 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                <tr class="bg-neutral-50/70 dark:bg-[#161616] border-b border-neutral-200/60 text-xs font-bold uppercase tracking-wider text-neutral-500">
                    <th class="py-3.5 px-6">{{ __('Course Info') }}</th>
                    <th class="py-3.5 px-6">{{ __('Instructor') }}</th>
                    <th class="py-3.5 px-6">{{ __('Price') }}</th>
                    <th class="py-3.5 px-6">{{ __('Duration') }}</th>
                    <th class="py-3.5 px-6">{{ __('Status') }}</th>
                    <th class="py-3.5 px-6 text-right">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200/60 dark:divide-neutral-800/60 text-sm">
                @forelse($courses as $course)
                    <tr class="hover:bg-neutral-50/40 dark:hover:bg-[#141414] transition-colors">
                        <td class="py-4 px-6 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg bg-neutral-100 dark:bg-neutral-800 shrink-0 overflow-hidden border border-neutral-200/40 flex items-center justify-center">
                                @if($course->image)
                                    <img src="{{ asset($course->image) }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-xl">💻</span>
                                @endif
                            </div>
                            <div>
                                <span class="font-bold text-neutral-900 dark:text-white block">{{ $course->title }}</span>
                                <span class="text-xs text-neutral-400">{{ $course->slug }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6">{{ $course->instructor->name ?? __('N/A') }}</td>
                        <td class="py-4 px-6 font-semibold">{{ $course->price == 0 ? __('Free') : '$' . number_format($course->price, 2) }}</td>
                        <td class="py-4 px-6 text-neutral-500">{{ $course->duration }} {{ __('hrs') }}</td>
                        <td class="py-4 px-6">
                                <span class="px-2 py-1 text-xs font-bold rounded-md {{ $course->status === 'published' ? 'bg-emerald-50 text-emerald-700' : 'bg-neutral-100 text-neutral-600' }}">
                                    {{ ucfirst($course->status) }}
                                </span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <a href="{{ route('admin.courses.edit', $course) }}" class="text-indigo-600 hover:underline">{{ __('Edit') }}</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-neutral-400">{{ __('No courses found.') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-app-layout>
