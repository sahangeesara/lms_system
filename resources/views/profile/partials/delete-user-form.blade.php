<section class="space-y-6">
    <!-- Trigger Button targeting Alpine.js Modal Event -->
    <div class="flex justify-start md:justify-end">
        <button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            type="button"
            class="px-5 py-3 rounded-xl inline-flex items-center justify-center font-semibold text-sm tracking-wide bg-red-600 hover:bg-red-700 text-white shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-[#0A0A0A] transition-all cursor-pointer"
        >
            {{ __('Delete Account') }}
        </button>
    </div>

    <!-- Confirmation Modal Layout Overlay -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-8 bg-white dark:bg-[#131313] border border-neutral-200/40 dark:border-neutral-800/80 rounded-2xl">
            @csrf
            @method('delete')

            <!-- Modal Header Meta Context -->
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-red-50 dark:bg-red-950/30 border border-red-100 dark:border-red-900/40 flex items-center justify-center text-xl">
                    🚨
                </div>
                <div>
                    <h2 class="text-xl font-extrabold tracking-tight text-neutral-900 dark:text-white">
                        {{ __('Are you sure you want to delete your account?') }}
                    </h2>
                    <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed">
                        {{ __('This is an absolute point of no return. Once confirmed, your learning trajectory record, active module sessions, and database relationships will be permanently scrubbed. Enter your security credential password below to complete verification.') }}
                    </p>
                </div>
            </div>

            <!-- Password Form Control Field Wrapper -->
            <div class="mt-6 pl-0 sm:pl-16">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <div class="relative max-w-md">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-neutral-400 dark:text-neutral-500 text-sm">
                        🔒
                    </span>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="block w-full pl-10 pr-4 py-3 rounded-xl text-sm border-neutral-200 dark:border-neutral-800/80 bg-neutral-50 dark:bg-neutral-900/50 text-neutral-900 dark:text-white placeholder-neutral-400 focus:border-indigo-500 focus:ring-indigo-500 transition-all shadow-sm"
                        placeholder="{{ __('Verify your account password') }}"
                    />
                </div>

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-xs font-semibold text-red-600 dark:text-red-400" />
            </div>

            <!-- Modal Bottom Control Action Bar -->
            <div class="mt-8 pt-4 border-t border-neutral-100 dark:border-neutral-800/60 flex flex-col sm:flex-row sm:justify-end gap-3">
                <button
                    x-on:click="$dispatch('close')"
                    type="button"
                    class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-neutral-200 dark:border-neutral-800 font-semibold text-sm text-neutral-600 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-800/60 transition-all cursor-pointer"
                >
                    {{ __('Cancel') }}
                </button>

                <button
                    type="submit"
                    class="w-full sm:w-auto px-5 py-2.5 rounded-xl font-semibold text-sm text-white bg-red-600 hover:bg-red-700 shadow-sm transition-all cursor-pointer"
                >
                    {{ __('Permanently Purge Data') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
