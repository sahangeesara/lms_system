<x-app-layout>
    <!-- Sub-Navbar Context Header Block -->
    <div class="bg-white dark:bg-[#131313] border-b border-neutral-200/60 dark:border-neutral-800/60 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="text-neutral-400 dark:text-neutral-500 hover:text-neutral-900 dark:hover:text-white transition-colors text-sm">
                    📂 {{ __('Curriculum Index') }}
                </a>
                <span class="text-neutral-300 dark:text-neutral-700 text-sm">/</span>
                <span class="text-xs font-bold px-2 py-0.5 rounded bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-900/30">
                    {{ __('Unit 03') }}
                </span>
                <h2 class="text-sm font-bold text-neutral-800 dark:text-neutral-200 truncate max-w-xs sm:max-w-md">
                    {{ __('Database Normalization & Index Optimization Strategies') }}
                </h2>
            </div>

            <div class="flex items-center gap-2">
                <button class="px-3 py-1.5 rounded-lg border border-neutral-200 dark:border-neutral-800 text-xs font-semibold text-neutral-600 dark:text-neutral-400 hover:bg-neutral-50 dark:hover:bg-neutral-800/50 transition-all cursor-pointer">
                    {{ __('Previous Lesson') }}
                </button>
                <button class="px-3 py-1.5 rounded-lg bg-indigo-600 dark:bg-indigo-500 text-white text-xs font-bold hover:bg-indigo-700 dark:hover:bg-indigo-600 transition-all shadow-sm cursor-pointer">
                    {{ __('Complete & Next') }} →
                </button>
            </div>
        </div>
    </div>

    <!-- Main Workspace Content Stream -->
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                <!-- Left/Center Column: Main Learning Canvas (2/3 width) -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Media / Stream Player Simulation Box -->
                    <div class="relative aspect-video rounded-2xl bg-neutral-950 border border-neutral-800 flex flex-col items-center justify-center overflow-hidden group shadow-lg">
                        <!-- Diagonal blueprint cross lines just to simulate layout structural space -->
                        <div class="absolute inset-0 opacity-5 pointer-events-none bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:16px_16px]"></div>

                        <div class="z-10 text-center px-6">
                            <div class="w-16 h-16 mx-auto rounded-full bg-indigo-600/10 border border-indigo-500/30 text-indigo-400 flex items-center justify-center text-2xl shadow-inner mb-4 animate-pulse">
                                🎬
                            </div>
                            <h3 class="text-base font-bold text-white tracking-tight">
                                {{ __('Video Media Stream Pipeline Matrix') }}
                            </h3>
                            <p class="text-xs text-neutral-400 mt-1 max-w-sm mx-auto">
                                {{ __('Target space for HLS media playback assets or interactive terminal configurations.') }}
                            </p>
                        </div>

                        <!-- Progress Bar Simulation tracking structural load -->
                        <div class="absolute bottom-0 inset-x-0 h-1.5 bg-neutral-900 border-t border-neutral-800">
                            <div class="h-full w-1/4 bg-indigo-500 dark:bg-indigo-400 transition-all duration-500"></div>
                        </div>
                    </div>

                    <!-- Lesson Text Documentation Block -->
                    <div class="p-6 sm:p-8 rounded-2xl bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 space-y-4">
                        <h3 class="text-xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
                            {{ __('Core Theory Architecture') }}
                        </h3>

                        <p class="text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">
                            {{ __('Database normalization reduces programmatic redundancy by checking that non-prime attributes remain completely dependent on the designated primary key structure. When moving to Third Normal Form (3NF), you systematically eliminate all lingering transitive functional dependencies.') }}
                        </p>

                        <!-- Code Example Block Blueprint Layout -->
                        <div class="rounded-xl bg-neutral-900 border border-neutral-800 overflow-hidden font-mono text-xs">
                            <div class="bg-neutral-950 px-4 py-2 border-b border-neutral-800/60 text-neutral-500 flex items-center justify-between">
                                <span>database-migration.sql</span>
                                <span class="text-[10px] uppercase tracking-wider text-neutral-600">PostgreSQL</span>
                            </div>
                            <pre class="p-4 text-neutral-300 overflow-x-auto"><code><span class="text-indigo-400">CREATE INDEX</span> idx_users_composite
<span class="text-indigo-400">ON</span> users (tenant_id, account_status)
<span class="text-indigo-400">WHERE</span> account_status = <span class="text-emerald-400">'active'</span>;</code></pre>
                        </div>
                    </div>

                </div>

                <!-- Right Column: Supplemental Resources & Footnotes Panel (1/3 width) -->
                <div class="space-y-6">

                    <!-- Resources Card Link Set -->
                    <div>
                        <h4 class="text-xs font-bold text-neutral-400 dark:text-neutral-500 uppercase tracking-wider pl-1 mb-3">
                            {{ __('Lesson Reference Attachments') }}
                        </h4>

                        <div class="p-5 rounded-2xl bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 space-y-3">
                            <!-- Resource Item 1 -->
                            <a href="#" class="flex items-center justify-between p-3 rounded-xl bg-neutral-50 dark:bg-neutral-900/40 border border-neutral-200/40 dark:border-neutral-800/80 hover:border-indigo-500/40 dark:hover:border-indigo-500/40 transition-all group">
                                <div class="flex items-center gap-3">
                                    <span class="text-lg">📄</span>
                                    <div class="text-left">
                                        <p class="text-xs font-bold text-neutral-800 dark:text-neutral-200 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                            {{ __('PDF Cheat-Sheet Blueprint') }}
                                        </p>
                                        <p class="text-[10px] text-neutral-400">1.4 MB · Storage Object</p>
                                    </div>
                                </div>
                                <span class="text-neutral-400 dark:text-neutral-600 group-hover:translate-x-0.5 transition-transform text-xs">→</span>
                            </a>

                            <!-- Resource Item 2 -->
                            <a href="#" class="flex items-center justify-between p-3 rounded-xl bg-neutral-50 dark:bg-neutral-900/40 border border-neutral-200/40 dark:border-neutral-800/80 hover:border-indigo-500/40 dark:hover:border-indigo-500/40 transition-all group">
                                <div class="flex items-center gap-3">
                                    <span class="text-lg">💻</span>
                                    <div class="text-left">
                                        <p class="text-xs font-bold text-neutral-800 dark:text-neutral-200 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                            {{ __('GitHub Sandbox Repository') }}
                                        </p>
                                        <p class="text-[10px] text-neutral-400">External Endpoint Source</p>
                                    </div>
                                </div>
                                <span class="text-neutral-400 dark:text-neutral-600 group-hover:translate-x-0.5 transition-transform text-xs">→</span>
                            </a>
                        </div>
                    </div>

                    <!-- Sidebar Instructor Message Note -->
                    <div class="p-5 rounded-2xl bg-amber-500/5 border border-amber-500/20 dark:border-amber-500/20">
                        <div class="flex gap-3">
                            <span class="text-sm">💡</span>
                            <div>
                                <h5 class="text-xs font-bold text-amber-800 dark:text-amber-400 uppercase tracking-wide">
                                    {{ __('Instructor Note') }}
                                </h5>
                                <p class="text-xs text-amber-700/90 dark:text-amber-500/80 mt-1 leading-relaxed">
                                    {{ __('Ensure your local server context is running standard relational configurations before starting up the indexing script optimizations, or matching operations will hit performance timeouts.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
