<x-guest-layout>
    <div class="min-height-screen flex flex-col items-center justify-center bg-[#FAF9F6] dark:bg-[#0A0A0A] px-4 sm:px-6 lg:px-8 transition-colors duration-300">

        <div class="w-full max-w-md space-y-6 bg-white dark:bg-[#131313] p-8 rounded-2xl border border-neutral-200/60 dark:border-neutral-800/60 shadow-xl">

            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-amber-50 dark:bg-amber-950/40 text-3xl mb-4">
                    🛡️
                </div>
                <h2 class="text-2xl font-extrabold tracking-tight text-neutral-900 dark:text-white">
                    Security Verification
                </h2>
                <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                @csrf

                <div class="space-y-1">
                    <x-input-label for="password" :value="__('Confirm Password')" class="text-neutral-700 dark:text-neutral-300 font-medium" />
                    <x-text-input
                        id="password"
                        class="block mt-1 w-full bg-white text-black dark:bg-white dark:text-black border-neutral-300 dark:border-neutral-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl px-4 py-3 text-sm transition-all shadow-sm"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        autofocus
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-md text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all cursor-pointer">
                        {{ __('Confirm Secure Action') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-guest-layout>
