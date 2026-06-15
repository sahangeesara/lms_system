<section>
    <!-- Card Sub-Header Meta Context -->
    <div class="mb-6 flex items-start gap-4">
        <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-indigo-50 dark:bg-indigo-950/30 border border-indigo-100 dark:border-indigo-900/40 flex items-center justify-center text-lg">
            🆔
        </div>
        <div>
            <h2 class="text-lg font-extrabold text-neutral-900 dark:text-white tracking-tight">
                {{ __('Profile Information') }}
            </h2>
            <p class="mt-0.5 text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed">
                {{ __("Update your account's identity parameters, communication endpoints, and global display name.") }}
            </p>
        </div>
    </div>

    <!-- Hidden Form for Email Verification Resend Trigger -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5 max-w-xl">
        @csrf
        @method('patch')

        <!-- Full Name Form Control -->
        <div>
            <label for="name" class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                {{ __('Display Name') }}
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-neutral-400 dark:text-neutral-500 text-sm">
                    👤
                </span>
                <input
                    id="name"
                    name="name"
                    type="text"
                    class="block w-full pl-10 pr-4 py-3 rounded-xl text-sm border-neutral-200 dark:border-neutral-800/80 bg-neutral-50 dark:bg-neutral-900/50 text-neutral-900 dark:text-white placeholder-neutral-400 focus:border-indigo-500 focus:ring-indigo-500 transition-all shadow-sm"
                    value="{{ old('name', $user->name) }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="John Doe"
                />
            </div>
            <x-input-error class="mt-2 text-xs font-semibold text-red-600 dark:text-red-400" :messages="$errors->get('name')" />
        </div>

        <!-- Email Address Form Control -->
        <div>
            <label for="email" class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                {{ __('Email Endpoint') }}
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-neutral-400 dark:text-neutral-500 text-sm">
                    ✉️
                </span>
                <input
                    id="email"
                    name="email"
                    type="email"
                    class="block w-full pl-10 pr-4 py-3 rounded-xl text-sm border-neutral-200 dark:border-neutral-800/80 bg-neutral-50 dark:bg-neutral-900/50 text-neutral-900 dark:text-white placeholder-neutral-400 focus:border-indigo-500 focus:ring-indigo-500 transition-all shadow-sm"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="username"
                    placeholder="name@domain.com"
                />
            </div>
            <x-input-error class="mt-2 text-xs font-semibold text-red-600 dark:text-red-400" :messages="$errors->get('email')" />

            <!-- Verification System Flow Alerts -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-4 rounded-xl bg-amber-50 dark:bg-amber-950/20 border border-amber-200/50 dark:border-amber-900/40">
                    <p class="text-sm text-amber-800 dark:text-amber-400 font-medium flex flex-col sm:flex-row sm:items-center gap-1.5">
                        <span>⚠️ {{ __('Your email endpoint is currently unverified.') }}</span>
                        <button form="send-verification" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 underline focus:outline-none transition-all cursor-pointer text-left">
                            {{ __('Re-send link.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-xs font-bold text-emerald-600 dark:text-emerald-400 flex items-center gap-1">
                            <span>✨</span> {{ __('A new verification link has been dispatched to your endpoint.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Form Submission Control Action Bar -->
        <div class="pt-2 flex items-center gap-4">
            <button type="submit" class="px-5 py-3 rounded-xl font-semibold text-sm tracking-wide bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-[#131313] transition-all cursor-pointer">
                {{ __('Save Changes') }}
            </button>

            <!-- Inline Success Flash Status -->
            @if (session('status') === 'profile-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-x-0"
                    x-transition:leave-end="opacity-0 transform translate-x-2"
                    x-init="setTimeout(() => show = false, 2500)"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-emerald-50 dark:bg-emerald-950/30 text-emerald-700 dark:text-emerald-400 border border-emerald-200/40 dark:border-emerald-900/30"
                >
                    <span>✓</span> {{ __('Identity Updated.') }}
                </div>
            @endif
        </div>
    </form>
</section>
