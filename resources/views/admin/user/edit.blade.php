<x-admin-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-neutral-870 p-6 rounded-xl border border-neutral-900 shadow-md">
            <div>
                <h2 class="font-extrabold text-2xl tracking-tight text-white">
                    {{ __('User Account Edit Form') }}
                </h2>
                <p class="text-sm text-neutral-400 mt-0.5">
                    {{ __('Provision internal systems profiles, assign role-based privileges, and review audit footprints.') }}
                </p>
            </div>
        </div>
    </x-slot>

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

    <div class="bg-white min-h-screen p-6">
        <form id="userForm" action="{{ route('admin.users.update', $accountUser->id) }}" method="POST"
              class="max-w-4xl mx-auto bg-white p-8 space-y-5 rounded-2xl border border-neutral-200 shadow-sm m-0">

            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Profile Full Name') }}</label>
                <input type="text" id="user_name" name="name"
                       value="{{ old('name', $accountUser->name) }}" required
                       placeholder="e.g., Sahan Geesara"
                       class="w-full px-3.5 py-2.5 text-sm bg-white border @error('name') border-rose-400 @else border-neutral-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-neutral-900 transition-all">
            </div>

            <div>
                <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Email Address') }}</label>
                <input type="email" id="user_email" name="email"
                       value="{{ old('email', $accountUser->email) }}" required
                       placeholder="name@domain.com"
                       class="w-full px-3.5 py-2.5 text-sm bg-white border @error('email') border-rose-400 @else border-neutral-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-neutral-900 transition-all">
            </div>

            <div>
                <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5">{{ __('Account System Access Role') }}</label>
                <select id="user_role" name="role" required
                        class="w-full text-sm bg-white border @error('role') border-rose-400 @else border-neutral-200 @enderror rounded-xl px-3.5 py-2.5 text-neutral-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 cursor-pointer">
                    <option value="" disabled class="text-neutral-400">{{ __('Assign permission role matrix...') }}</option>

                    <option value="Student" {{ old('role', $accountUser->roles->first()?->name) == 'student' ? 'selected' : '' }}>{{ __('Student Profile') }}</option>
                    <option value="Instructor" {{ old('role', $accountUser->roles->first()?->name) == 'instructor' ? 'selected' : '' }}>{{ __('Instructor Profile') }}</option>
                    <option value="Admin" {{ old('role', $accountUser->roles->first()?->name) == 'admin' ? 'selected' : '' }}>{{ __('System Administrator') }}</option>
                </select>
            </div>

            <div id="passwordWrapperBlock" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5" id="passwordLabel">{{ __('Access Password') }}</label>
                    <input type="password" id="user_password" name="password" placeholder="••••••••"
                           class="w-full px-3.5 py-2.5 text-sm bg-white border @error('password') border-rose-400 @else border-neutral-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-neutral-900 transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-neutral-600 uppercase tracking-wider mb-1.5" id="passwordConfirmLabel">{{ __('Confirm Password') }}</label>
                    <input type="password" id="user_password_confirmation" name="password_confirmation" placeholder="••••••••"
                           class="w-full px-3.5 py-2.5 text-sm bg-white border border-neutral-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-neutral-900 transition-all">
                </div>
            </div>
            <p id="passwordFormHelperNote" class="text-xs text-neutral-400 mt-1">
                {{ __('Leave password inputs blank if you do not wish to modify the existing credentials strategy.') }}
            </p>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-neutral-100 mt-6">
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-sm font-semibold rounded-xl text-neutral-500 hover:bg-neutral-100 hover:text-neutral-900 transition-colors cursor-pointer text-center">
                    {{ __('Cancel Actions') }}
                </a>
                <button type="submit" id="submitFormButton" class="px-4 py-2 text-sm font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white transition-colors shadow-sm cursor-pointer">
                    {{ __('Update Identity Profile') }}
                </button>
            </div>
        </form>
    </div>
</x-admin-app-layout>
