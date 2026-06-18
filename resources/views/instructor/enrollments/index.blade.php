<x-instructor-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-neutral-900 p-6 rounded-xl border border-neutral-950 shadow-md">
            <div>
                <h2 class="font-extrabold text-2xl tracking-tight text-white">
                    {{ __('Course Enrollments Ledger') }}
                </h2>
                <p class="text-sm text-neutral-400 mt-0.5">
                    {{ __('Control center for managing global course admission footprints and access tokens.') }}
                </p>
            </div>
            <div>
                <a href="{{ route('admin.enrollments.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl shadow-sm transition-all cursor-pointer">
                    <span>➕ {{ __('New Enrollment') }}</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="bg-white dark:bg-[#111111] border border-neutral-200/60 dark:border-neutral-800/60 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                <tr class="bg-neutral-50/70 dark:bg-[#161616] border-b border-neutral-200/60 dark:border-neutral-800/60 text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
                    <th class="py-3.5 px-6">{{ __('Student Details') }}</th>
                    <th class="py-3.5 px-6">{{ __('Assigned Course') }}</th>
                    <th class="py-3.5 px-6">{{ __('Financials') }}</th>
                    <th class="py-3.5 px-6 text-center">{{ __('Status') }}</th>
                    <th class="py-3.5 px-6 text-center">{{ __('Enrolled At') }}</th>
                    <th class="py-3.5 px-6 text-right">{{ __('Action Handlers') }}</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200/60 dark:divide-neutral-800/60 text-sm text-neutral-700 dark:text-neutral-300">
                @forelse($enrollments ?? [] as $enrollment)
                    <tr class="hover:bg-neutral-50/40 dark:hover:bg-[#141414] transition-colors">
                        <td class="py-4 px-6">
                            <span class="font-bold text-neutral-900 dark:text-white block">{{ $enrollment->user->name ?? __('Deleted Student') }}</span>
                            <span class="text-xs text-neutral-400 dark:text-neutral-500 block mt-0.5 font-mono">{{ $enrollment->user->email ?? '' }}</span>
                        </td>

                        <td class="py-4 px-6 font-medium text-neutral-600 dark:text-neutral-400">
                            📚 {{ $enrollment->course->title ?? __('Deleted Course') }}
                        </td>

                        <td class="py-4 px-6">
                            <span class="font-mono font-bold text-neutral-900 dark:text-white">${{ number_format($enrollment->amount_paid, 2) }}</span>
                            <span class="text-[11px] text-neutral-400 dark:text-neutral-500 font-mono block">ID: {{ $enrollment->payment_id ?? 'N/A' }}</span>
                        </td>

                        <td class="py-4 px-6 text-center">
                            @if($enrollment->status === 'active')
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 dark:bg-emerald-950/20 text-emerald-700 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-900/30">
                                {{ __('Active') }}
                            </span>
                            @elseif($enrollment->status === 'completed')
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-bold bg-indigo-50 dark:bg-indigo-950/20 text-indigo-700 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-900/30">
                                {{ __('Completed') }}
                            </span>
                            @else
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-bold bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-400 border border-neutral-200 dark:border-neutral-700/50">
                                {{ __('Suspended') }}
                            </span>
                            @endif
                        </td>

                        <td class="py-4 px-6 text-center text-xs text-neutral-500 dark:text-neutral-400 font-mono">
                            {{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('M d, Y') : 'N/A' }}
                        </td>

                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-2.5">
                                <a href="{{ route('admin.enrollments.edit', $enrollment->id) }}"
                                   class="p-1.5 rounded-lg text-neutral-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-950/30 transition-all cursor-pointer"
                                   title="{{ __('Edit Enrollment') }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                    </svg>
                                </a>

                                <form action="{{ route('admin.enrollments.destroy', $enrollment->id) }}" method="POST" class="inline m-0" onsubmit="return confirm('Drop this student enrollment from global course access records?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-neutral-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/25 transition-all cursor-pointer" title="{{ __('Delete Enrollment') }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-sm font-medium text-neutral-400 dark:text-neutral-500">
                            {{ __('No student admissions matching active system traces inside database records.') }}
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-instructor-app-layout>
