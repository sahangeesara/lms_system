<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-[#FAF9F6] px-4 sm:px-6 lg:px-8">

        <div class="w-full max-w-md space-y-8 bg-white p-8 rounded-2xl border border-neutral-200/80 shadow-xl">

            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-indigo-50 text-3xl mb-4">
                    🎓
                </div>
                <h2 class="text-3xl font-extrabold tracking-tight text-neutral-900">
                    Welcome Back
                </h2>
                <p class="mt-2 text-sm text-neutral-500">
                    Sign in to access your LMS dashboard and courses
                </p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                @csrf

                <div class="space-y-1">
                    <x-input-label for="email" :value="__('Email Address')" class="text-neutral-700 font-medium" />
                    <x-text-input
                        id="email"
                        class="block mt-1 w-full bg-white text-black border-neutral-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl px-4 py-3 text-sm transition-all shadow-sm"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="name@example.com"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
                </div>

                <div class="space-y-1">
                    <div class="flex items-center justify-between">
                        <x-input-label for="password" :value="__('Password')" class="text-neutral-700 font-medium" />

                        @if (Route::has('password.request'))
                            <a class="text-xs font-semibold text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <x-text-input
                        id="password"
                        class="block mt-1 w-full bg-white text-black border-neutral-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl px-4 py-3 text-sm transition-all shadow-sm"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-neutral-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-neutral-600 select-none">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-md text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all cursor-pointer">
                        {{ __('Sign In to Portal') }}
                    </button>
                </div>
            </form>

            @if (Route::has('register'))
                <div class="text-center pt-4 border-t border-neutral-100">
                    <p class="text-sm text-neutral-500">
                        New to the platform?
                        <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:underline ms-1">
                            Create an account
                        </a>
                    </p>
                </div>
            @endif

        </div>
    </div>
</x-guest-layout>
