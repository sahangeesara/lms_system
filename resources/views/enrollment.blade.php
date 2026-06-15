<x-app-layout>
    <x-slot name="header">
        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-900/30 mb-2">
                🔒 {{ __('Secure Checkout Sandbox') }}
            </span>
            <h1 class="text-3xl font-extrabold tracking-tight text-neutral-900 dark:text-white">
                {{ __('Course Enrollment Portal') }}
            </h1>
            <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
                {{ __('Review your curriculum access parameters and complete programmatic registration onboarding.') }}
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                <!-- Left: Onboarding / Checkout Data Entry Panel (2/3 width) -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="p-6 sm:p-8 rounded-2xl bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 shadow-sm">
                        <h3 class="text-lg font-bold text-neutral-900 dark:text-white mb-6 flex items-center gap-2">
                            <span>📋</span> {{ __('Account & Licensing Details') }}
                        </h3>

                        <!-- Temporary Form Simulation Structural Scaffolding Layout -->
                        <form method="POST" action="#" class="space-y-5" onsubmit="event.preventDefault();">
                            @csrf

                            <!-- Static Identity Fields Row -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-neutral-400 dark:text-neutral-500 uppercase tracking-wider mb-2">
                                        {{ __('Enrolling Active Identity') }}
                                    </label>
                                    <input type="text" class="block w-full px-4 py-3 rounded-xl text-sm border-neutral-200 dark:border-neutral-800/60 bg-neutral-100 dark:bg-neutral-900/50 text-neutral-500 dark:text-neutral-400" value="{{ Auth::user()->name }}" disabled readonly />
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-neutral-400 dark:text-neutral-500 uppercase tracking-wider mb-2">
                                        {{ __('Communication Endpoint') }}
                                    </label>
                                    <input type="text" class="block w-full px-4 py-3 rounded-xl text-sm border-neutral-200 dark:border-neutral-800/60 bg-neutral-100 dark:bg-neutral-900/50 text-neutral-500 dark:text-neutral-400" value="{{ Auth::user()->email }}" disabled readonly />
                                </div>
                            </div>

                            <!-- Payment Token Key Placeholder Input field -->
                            <div>
                                <label for="sandbox_promo_token" class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                    {{ __('Access Authorization / Promo Token Key') }}
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-neutral-400 dark:text-neutral-500 text-sm">
                                        🔑
                                    </span>
                                    <input
                                        id="sandbox_promo_token"
                                        type="text"
                                        class="block w-full pl-10 pr-4 py-3 rounded-xl text-sm border-neutral-200 dark:border-neutral-800/80 bg-neutral-50 dark:bg-neutral-900/50 text-neutral-900 dark:text-white placeholder-neutral-400 focus:border-indigo-500 focus:ring-indigo-500 transition-all"
                                        placeholder="EDU-STREAM-SANDBOX-ACCESS-2026"
                                    />
                                </div>
                                <p class="mt-1.5 text-[11px] text-neutral-400 dark:text-neutral-500 leading-normal">
                                    {{ __('Enter your platform registration key voucher token override value if applicable.') }}
                                </p>
                            </div>

                            <!-- Terms Aggregation Checkbox element block container -->
                            <div class="pt-2 flex items-start gap-3">
                                <input id="terms_agree" type="checkbox" checked class="mt-0.5 h-4 w-4 rounded border-neutral-300 text-indigo-600 focus:ring-indigo-500 dark:bg-neutral-900 dark:border-neutral-800" required />
                                <label for="terms_agree" class="text-xs text-neutral-500 dark:text-neutral-400 leading-relaxed">
                                    I agree to the systemic access terms, resource fair-use streaming pipelines, and academic course evaluation requirements enforced within this enterprise matrix module.
                                </label>
                            </div>

                            <!-- Submission Trigger Row -->
                            <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800/60">
                                <button type="submit" class="w-full sm:w-auto px-6 py-3.5 rounded-xl font-bold text-sm tracking-wide bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white shadow-md hover:shadow-lg transition-all cursor-pointer">
                                    {{ __('Confirm Registration Enrollment') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right: Invoice Metadata Breakout Statement Box (1/3 width) -->
                <div class="space-y-6">
                    <h3 class="text-xs font-bold text-neutral-400 dark:text-neutral-500 uppercase tracking-wider pl-1">
                        {{ __('Order Item Blueprint Summary') }}
                    </h3>

                    <div class="p-6 rounded-2xl bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 space-y-5 shadow-sm">

                        <!-- Mini Course Info Thumbnail Display Simulation block -->
                        <div class="flex items-center gap-3 border-b border-neutral-100 dark:border-neutral-800/60 pb-4">
                            <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-500 dark:text-indigo-400 flex items-center justify-center font-bold text-base flex-shrink-0">
                                💻
                            </div>
                            <div class="truncate">
                                <h4 class="text-xs font-bold text-neutral-900 dark:text-white truncate">
                                    Advanced Full-Stack Engineering Masterclass
                                </h4>
                                <p class="text-[10px] text-neutral-400">12 Structural Modules · Certification Path</p>
                            </div>
                        </div>

                        <!-- Price Breakdown Calculations list grid rows items matrix -->
                        <div class="space-y-2.5">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-neutral-500 dark:text-neutral-400">{{ __('Standard Access Seat Licensing') }}</span>
                                <span class="font-medium text-neutral-900 dark:text-white">$199.00</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-neutral-500 dark:text-neutral-400">{{ __('Cloud Computing Resource Infrastructure Fee') }}</span>
                                <span class="font-medium text-neutral-900 dark:text-white">$25.00</span>
                            </div>
                            <div class="flex items-center justify-between text-xs text-emerald-600 dark:text-emerald-400 font-semibold">
                                <span>{{ __('Temporary Sandbox Account Discount') }}</span>
                                <span>-$224.00</span>
                            </div>
                        </div>

                        <!-- Grand Total Accent Footer Row Segment -->
                        <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800/60 flex items-center justify-between">
                            <span class="text-sm font-bold text-neutral-900 dark:text-white">{{ __('Total Due Amount') }}</span>
                            <span class="text-xl font-extrabold text-indigo-600 dark:text-indigo-400 tracking-tight">$0.00</span>
                        </div>
                    </div>

                    <!-- Informational Trust Warning Callout Badge container block -->
                    <div class="p-4 rounded-xl bg-neutral-50 dark:bg-neutral-900/40 border border-neutral-200/60 dark:border-neutral-800/80 text-[11px] text-neutral-400 dark:text-neutral-500 leading-normal flex gap-2.5">
                        <span class="text-sm">🛡️</span>
                        <span>This sandbox processing node features direct end-to-end data encryption. All temporary credentials stay safe under operational platform security compliance limits.</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
