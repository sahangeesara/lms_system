<x-guest-layout>
    <div class="min-height-screen flex flex-col items-center justify-center bg-[#FAF9F6] dark:bg-[#0A0A0A] px-4 sm:px-6 lg:px-8 transition-colors duration-300">

        <div class="w-full max-w-md space-y-6 bg-white dark:bg-[#131313] p-8 rounded-2xl border border-neutral-200/60 dark:border-neutral-800/60 shadow-xl">

            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-indigo-50 dark:bg-indigo-950/40 text-3xl mb-4">
                    🚀
                </div>
                <h2 class="text-3xl font-extrabold tracking-tight text-neutral-900 dark:text-white">
                    Create Account
                </h2>
                <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">
                    Get started with your new student or instructor profile
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div class="space-y-1">
                    <x-input-label for="name" :value="__('Full Name')" class="text-neutral-700 dark:text-neutral-300 font-medium" />
                    <x-text-input
                        id="name"
                        class="block mt-1 w-full bg-white text-black dark:bg-white dark:text-black border-neutral-300 dark:border-neutral-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl px-4 py-3 text-sm transition-all shadow-sm"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="John Doe"
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs text-red-500" />
                </div>

                <div class="space-y-1">
                    <x-input-label for="email" :value="__('Email Address')" class="text-neutral-700 dark:text-neutral-300 font-medium" />
                    <x-text-input
                        id="email"
                        class="block mt-1 w-full bg-white text-black dark:bg-white dark:text-black border-neutral-300 dark:border-neutral-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl px-4 py-3 text-sm transition-all shadow-sm"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autocomplete="username"
                        placeholder="name@example.com"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
                </div>

                <div class="space-y-1">
                    <x-input-label for="password" :value="__('Password')" class="text-neutral-700 dark:text-neutral-300 font-medium" />
                    <x-text-input
                        id="password"
                        class="block mt-1 w-full bg-white text-black dark:bg-white dark:text-black border-neutral-300 dark:border-neutral-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl px-4 py-3 text-sm transition-all shadow-sm"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
                </div>

                <div class="space-y-1">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-neutral-700 dark:text-neutral-300 font-medium" />
                    <x-text-input
                        id="password_confirmation"
                        class="block mt-1 w-full bg-white text-black dark:bg-white dark:text-black border-neutral-300 dark:border-neutral-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl px-4 py-3 text-sm transition-all shadow-sm"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-red-500" />
                </div>

                <div class="pt-3">
                    <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-md text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all cursor-pointer">
                        {{ __('Register Account') }}
                    </button>
                </div>
            </form>

            <div class="text-center pt-4 border-t border-neutral-100 dark:border-neutral-800">
                <p class="text-sm text-neutral-500 dark:text-neutral-400">
                    {{ __('Already registered?') }}
                    <a href="{{ route('login') }}" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:underline ms-1">
                        Log in here
                    </a>
                </p>
            </div>

        </div>
    </div>
</x-guest-layout>
