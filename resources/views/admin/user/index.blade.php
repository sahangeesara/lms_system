<x-admin-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl tracking-tight text-neutral-900 dark:text-white">
                    {{ __('User Account Management') }}
                </h2>
                <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-0.5">
                    {{ __('Provision internal systems profiles, assign role-based privileges, and review audit footprints.') }}
                </p>
            </div>

            <button type="button" onclick="window.location.href='{{ route('admin.user.create') }}'" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors shadow-sm shadow-indigo-100 dark:shadow-none cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                {{ __('Create New User') }}
            </button>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-200 dark:border-emerald-900/30 text-emerald-800 dark:text-emerald-400 rounded-xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
        <div class="relative w-full sm:w-80">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-neutral-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Search accounts by name or email...') }}"
                   class="w-full pl-9 pr-4 py-2 text-sm bg-neutral-50 dark:bg-[#131313] border border-neutral-200/80 dark:border-neutral-800/60 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors text-neutral-900 dark:text-white placeholder-neutral-400">
        </div>

        <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
            <select name="role" onchange="this.form.submit()" class="text-sm bg-neutral-50 dark:bg-[#131313] border border-neutral-200/80 dark:border-neutral-800/60 rounded-xl px-3 py-2 text-neutral-600 dark:text-neutral-400 focus:outline-none cursor-pointer">
                <option value="">{{ __('All Account Roles') }}</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>{{ __('Administrator') }}</option>
                <option value="instructor" {{ request('role') == 'instructor' ? 'selected' : '' }}>{{ __('Instructor') }}</option>
                <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>{{ __('Student') }}</option>
            </select>
            <a href="{{ route('admin.users.index') }}" class="text-xs text-neutral-400 hover:text-indigo-600 underline px-2">
                {{ __('Clear') }}
            </a>
        </div>
    </form>

    <div class="bg-white dark:bg-[#111111] border border-neutral-200/60 dark:border-neutral-800/60 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                <tr class="bg-neutral-50/70 dark:bg-[#161616] border-b border-neutral-200/60 dark:border-neutral-800/60 text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
                    <th class="py-3.5 px-6">{{ __('Identified Profile') }}</th>
                    <th class="py-3.5 px-6">{{ __('Email Address') }}</th>
                    <th class="py-3.5 px-6">{{ __('Assigned System Role') }}</th>
                    <th class="py-3.5 px-6">{{ __('Date Registered') }}</th>
                    <th class="py-3.5 px-6 text-right">{{ __('Action Handler') }}</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200/60 dark:divide-neutral-800/60 text-sm text-neutral-700 dark:text-neutral-300">

                @forelse($users as $accountUser)
                    <tr class="hover:bg-neutral-50/40 dark:hover:bg-[#141414] transition-colors">
                        <td class="py-4 px-6 flex items-center gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-950/30 border border-indigo-100 dark:border-indigo-900/30 flex items-center justify-center font-bold text-indigo-700 dark:text-indigo-400 shrink-0 uppercase">
                                {{ substr($accountUser->name, 0, 2) }}
                            </div>
                            <div>
                                <span class="font-bold text-neutral-900 dark:text-white block">
                                    {{ $accountUser->name }}
                                </span>
                                <span class="text-xs text-neutral-400 dark:text-neutral-500 block mt-0.5">
                                    {{ __('UID:') }} {{ str_pad($accountUser->id, 5, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>
                        </td>
                        <td class="py-4 px-6 font-medium text-neutral-600 dark:text-neutral-400">
                            {{ $accountUser->email }}
                        </td>
                        <td class="py-4 px-6">
                            @php $role = $accountUser->roles->first()?->name @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-bold rounded-full
                                {{ $role == 'admin' ? 'bg-rose-50 text-rose-700 border-rose-100' :
                                  ($role == 'instructor' ? 'bg-indigo-50 text-indigo-700 border-indigo-100' : 'bg-neutral-100 text-neutral-700 border-neutral-200') }}
                                border dark:border-0 dark:bg-neutral-800 dark:text-neutral-400">
                                {{ ucfirst($role ?? 'Student') }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-neutral-500 dark:text-neutral-400 font-medium">
                            {{ $accountUser->created_at->format('M d, Y') }}
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-2.5">
                                <button type="button" onclick="window.location.href='{{ route('admin.users.edit', $accountUser) }}'"
                                        class="p-1.5 rounded-lg text-neutral-400 hover:text-indigo-600 hover:bg-indigo-50 transition-all cursor-pointer">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                                </button>
                                <form action="{{ route('admin.users.destroy', $accountUser) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}');" class="inline m-0">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-neutral-400 hover:text-rose-600 hover:bg-rose-50 transition-all cursor-pointer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-sm font-medium text-neutral-400">{{ __('No users found.') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-app-layout>
