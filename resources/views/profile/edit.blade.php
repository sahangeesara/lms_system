<x-dynamic-component :component="$layout">
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl tracking-tight text-neutral-900 dark:text-white">
            {{ __('Account Profile Settings') }}
        </h2>
    </x-slot>

    <div class="space-y-8" x-data="{ activeTab: 'profile' }">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-4">
                    <div class="p-6 bg-white dark:bg-[#131313] border border-neutral-200 rounded-2xl shadow-sm">
                        <h3 class="font-bold mb-2">Account Management</h3>
                        <p class="text-xs text-neutral-500">Manage your identity and security settings from this unified dashboard.</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="flex gap-1 p-1 bg-neutral-100 dark:bg-neutral-800 rounded-xl w-fit border border-neutral-200 dark:border-neutral-700">

                    <button @click="activeTab = 'profile'"
                            :class="activeTab === 'profile'
                ? 'bg-indigo-600 text-white shadow-md'
                : 'text-neutral-500 hover:text-neutral-900 hover:bg-neutral-200 dark:text-neutral-400 dark:hover:text-white'"
                            class="px-6 py-2 text-sm font-bold rounded-lg transition-all duration-200 ease-in-out">
                        {{ __('Profile') }}
                    </button>

                    <button @click="activeTab = 'security'"
                            :class="activeTab === 'security'
                ? 'bg-indigo-600 text-white shadow-md'
                : 'text-neutral-500 hover:text-neutral-900 hover:bg-neutral-200 dark:text-neutral-400 dark:hover:text-white'"
                            class="px-6 py-2 text-sm font-bold rounded-lg transition-all duration-200 ease-in-out">
                        {{ __('Security') }}
                    </button>
                </div>

                <div x-show="activeTab === 'profile'" class="p-8 bg-white border border-neutral-200 rounded-2xl shadow-sm">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div x-show="activeTab === 'security'" class="p-8 bg-white border border-neutral-200 rounded-2xl shadow-sm">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <div class="pt-6 border-t border-neutral-200">
            <div class="bg-red-50/50 rounded-2xl p-8 flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <h3 class="font-bold text-red-800 text-lg">Deactivate Profile</h3>
                    <p class="text-sm text-neutral-600 mt-1">Permanently erase all academic history and grading data.</p>
                </div>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-dynamic-component>
