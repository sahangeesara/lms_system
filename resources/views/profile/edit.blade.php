<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-extrabold text-2xl tracking-tight text-neutral-900 dark:text-white">
                {{ __('Account Profile Settings') }}
            </h2>
            <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-0.5">
                Update your identity parameters, security configurations, and login credentials.
            </p>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Main Configuration Section Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left Side Descriptive Meta Context Column -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-4">
                    <div class="p-6 bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 rounded-2xl shadow-sm">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="text-2xl">👤</div>
                            <h3 class="font-bold text-neutral-900 dark:text-white text-base">Personal Identity</h3>
                        </div>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400 leading-relaxed">
                            Keep your communication endpoints accurate. Your display name is visible across active LMS course rosters, group assignments, and certificates.
                        </p>
                    </div>

                    <div class="p-6 bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 rounded-2xl shadow-sm">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="text-2xl">🔐</div>
                            <h3 class="font-bold text-neutral-900 dark:text-white text-base">Security Protocols</h3>
                        </div>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400 leading-relaxed">
                            Ensure your account uses a long, unique passphrase to safeguard internal academic grading history and authentication states.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Side Interactive Forms Column -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Profile Information Card Wrapper -->
                <div class="p-6 sm:p-8 bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 rounded-2xl shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Security Password Reset Card Wrapper -->
                <div class="p-6 sm:p-8 bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 rounded-2xl shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

        </div>

        <!-- Dangerous Boundary Section Break -->
        <div class="pt-6 border-t border-neutral-200/60 dark:border-neutral-800/60">
            <div class="bg-red-50/40 dark:bg-red-950/10 border border-red-200/60 dark:border-red-900/30 rounded-2xl p-6 sm:p-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="max-w-2xl">
                    <h3 class="font-bold text-red-800 dark:text-red-400 text-lg flex items-center gap-2">
                        <span>⚠️</span> {{ __('Deactivate Academic Profile') }}
                    </h3>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1 leading-relaxed">
                        Once your profile is purged, all related structural data points—including course certificates, module progress metrics, and pending grading submissions—will be permanently erased.
                    </p>
                </div>
                <div class="shrink-0 max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
