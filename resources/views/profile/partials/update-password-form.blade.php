<section>
    <!-- Card Sub-Header Meta Context -->
    <div class="mb-6 flex items-start gap-4">
        <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-indigo-50 dark:bg-indigo-950/30 border border-indigo-100 dark:border-indigo-900/40 flex items-center justify-center text-lg">
            🔑
        </div>
        <div>
            <h2 class="text-lg font-extrabold text-neutral-900 dark:text-white tracking-tight">
                {{ __('Update Password') }}
            </h2>
            <p class="mt-0.5 text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </div>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5 max-w-xl">
        @csrf
        @method('put')

        <!-- Current Password Form Control -->
        <div>
            <label for="update_password_current_password" class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                {{ __('Current Security Password') }}
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-neutral-400 dark:text-neutral-500 text-sm">
                    🔒
                </span>
                <input
                    id="update_password_current_password"
                    name="current_password"
                    type="password"
                    class="block w-full pl-10 pr-4 py-3 rounded-xl text-sm border-neutral-200 dark:border-neutral-800/80 bg-neutral-50 dark:bg-neutral-900/50 text-neutral-900 dark:text-white placeholder-neutral-400 focus:border-indigo-500 focus:ring-indigo-500 transition-all shadow-sm"
                    autocomplete="current-password"
                    placeholder="••••••••"
                />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-xs font-semibold text-red-600 dark:text-red-400" />
        </div>

        <!-- New Password Form Control -->
        <div>
            <label for="update_password_password" class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                {{ __('New Security Password') }}
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-neutral-400 dark:text-neutral-500 text-sm">
                    ✨
                </span>
                <input
                    id="update_password_password"
                    name="password"
                    type="password"
                    class="block w-full pl-10 pr-4 py-3 rounded-xl text-sm border-neutral-200 dark:border-neutral-800/80 bg-neutral-50 dark:bg-neutral-900/50 text-neutral-900 dark:text-white placeholder-neutral-400 focus:border-indigo-500 focus:ring-indigo-500 transition-all shadow-sm"
                    autocomplete="new-password"
                    placeholder="Minimum 8 characters"
                />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-xs font-semibold text-red-600 dark:text-red-400" />
        </div>

        <!-- Confirm New Password Form Control -->
        <div>
            <label for="update_password_password_confirmation" class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                {{ __('Confirm New Password') }}
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-neutral-400 dark:text-neutral-500 text-sm">
                    📋
                </span>
                <input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="block w-full pl-10 pr-4 py-3 rounded-xl text-sm border-neutral-200 dark:border-neutral-800/80 bg-neutral-50 dark:bg-neutral-900/50 text-neutral-900 dark:text-white placeholder-neutral-400 focus:border-indigo-500 focus:ring-indigo-500 transition-all shadow-sm"
                    autocomplete="new-password"
                    placeholder="Re-enter new password"
                />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-xs font-semibold text-red-600 dark:text-red-400" />
        </div>

        <!-- Form Submission Control Action Bar -->
        <div class="pt-2 flex items-center gap-4">
            <button type="submit" class="px-5 py-3 rounded-xl font-semibold text-sm tracking-wide bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-[#131313] transition-all cursor-pointer">
                {{ __('Update Password') }}
            </button>

            <!-- Inline Success Flash Status Status -->
            @if (session('status') === 'password-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-x-0"
                    x-transition:leave-end="opacity-0 transform translate-x-2"
                    x-init="setTimeout(() => show = false, 2500)"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-emerald-50 dark:bg-emerald-950/30 text-emerald-700 dark:text-emerald-400 border border-emerald-200/40 dark:border-emerald-900/30"
                >
                    <span>✓</span> {{ __('Password Saved.') }}
                </div>
            @endif
        </div>
    </form>
</section>
