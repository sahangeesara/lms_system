<nav x-data="{ open: false }" class="bg-white dark:bg-[#131313] border-b border-neutral-200/60 dark:border-neutral-800/60 sticky top-0 z-50 transition-colors duration-300">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- LMS Logo / Branding -->
                <div class="shrink-0 flex items-center gap-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-xl font-bold tracking-tight text-neutral-900 dark:text-white group">
                        <span>🎓</span>
                        <span>Edu<span class="text-indigo-600 dark:text-indigo-400 transition-colors">Stream</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-sm font-semibold transition-all text-neutral-700 dark:text-neutral-300 hover:text-indigo-600 dark:hover:text-indigo-400 active:text-indigo-600 dark:active:text-indigo-400">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('student.courses.index')" :active="request()->routeIs('student.courses.index')" class="text-sm font-semibold transition-all text-neutral-700 dark:text-neutral-300 hover:text-indigo-600 dark:hover:text-indigo-400 active:text-indigo-600 dark:active:text-indigo-400">
                        {{ __('Course') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('lesson')" :active="request()->routeIs('lesson')" class="text-sm font-semibold transition-all text-neutral-700 dark:text-neutral-300 hover:text-indigo-600 dark:hover:text-indigo-400 active:text-indigo-600 dark:active:text-indigo-400">
                        {{ __('Lesson') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('enrollment')" :active="request()->routeIs('enrollment')" class="text-sm font-semibold transition-all text-neutral-700 dark:text-neutral-300 hover:text-indigo-600 dark:hover:text-indigo-400 active:text-indigo-600 dark:active:text-indigo-400">
                        {{ __('Enrollment') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3.5 py-2 border border-neutral-200/60 dark:border-neutral-800/80 text-sm leading-4 font-medium rounded-xl text-neutral-600 dark:text-neutral-300 bg-neutral-50 dark:bg-neutral-900/50 hover:text-neutral-900 dark:hover:text-white hover:bg-neutral-100 dark:hover:bg-neutral-800/60 focus:outline-none transition ease-in-out duration-150 cursor-pointer">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1.5 text-neutral-400 dark:text-neutral-500">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="font-medium text-sm">
                            {{ __('Profile Settings') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             class="font-medium text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/20"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Button -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2.5 rounded-xl text-neutral-500 dark:text-neutral-400 hover:text-neutral-800 dark:hover:text-neutral-200 hover:bg-neutral-100 dark:hover:bg-neutral-800/60 focus:outline-none transition duration-150 ease-in-out cursor-pointer">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-neutral-100 dark:border-neutral-800/60 bg-white dark:bg-[#131313]">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="font-semibold text-neutral-700 dark:text-neutral-300 active:text-indigo-600 dark:active:text-indigo-400">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('course')" :active="request()->routeIs('course')" class="font-semibold text-neutral-700 dark:text-neutral-300 active:text-indigo-600 dark:active:text-indigo-400">
                {{ __('Course') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('lesson')" :active="request()->routeIs('lesson')" class="font-semibold text-neutral-700 dark:text-neutral-300 active:text-indigo-600 dark:active:text-indigo-400">
                {{ __('Lesson') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('enrollment')" :active="request()->routeIs('enrollment')" class="font-semibold text-neutral-700 dark:text-neutral-300 active:text-indigo-600 dark:active:text-indigo-400">
                {{ __('Enrollment') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-4 border-t border-neutral-200/60 dark:border-neutral-800/60 bg-neutral-50/50 dark:bg-neutral-900/30">
            <div class="px-4 mb-3">
                <div class="font-bold text-base text-neutral-900 dark:text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-neutral-500 dark:text-neutral-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="font-medium">
                    {{ __('Profile Settings') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                           class="font-medium text-red-600 dark:text-red-400"
                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
