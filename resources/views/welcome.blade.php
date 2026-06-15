<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LMS - Advanced Learning Platform</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-[#FAF9F6] text-[#1b1b18] dark:bg-[#0A0A0A] dark:text-[#EDEDEC] transition-colors duration-300">

<header class="w-full max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
    <div class="flex items-center gap-2">
        <span class="text-2xl">🎓</span>
        <span class="font-bold text-xl tracking-tight text-neutral-900 dark:text-white">
                Edu<span class="text-indigo-600 dark:text-indigo-400">Stream</span>
            </span>
    </div>

    @if (Route::has('login'))
        <nav class="flex items-center gap-4">
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="inline-block px-5 py-2 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-full text-sm font-medium transition-all"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="inline-block px-4 py-2 dark:text-[#EDEDEC] text-[#1b1b18] hover:text-indigo-600 dark:hover:text-indigo-400 text-sm font-medium transition-all"
                >
                    Log in
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="inline-block px-5 py-2 text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 rounded-full text-sm font-medium shadow-sm transition-all"
                    >
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</header>

<main class="w-full max-w-7xl mx-auto px-6 pt-16 pb-24 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

    <div class="lg:col-span-7 text-center lg:text-left space-y-6">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-50 dark:bg-indigo-950/40 border border-indigo-100 dark:border-indigo-900/60">
            <span class="w-2 h-2 rounded-full bg-indigo-600 dark:bg-indigo-400 animate-pulse"></span>
            <span class="text-xs font-semibold text-indigo-700 dark:text-indigo-300 tracking-wide uppercase">
                    Laravel 12 Ecosystem Ready
                </span>
        </div>

        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-neutral-900 dark:text-white leading-[1.15]">
            Master skills seamlessly, <br>
            <span class="bg-gradient-to-r from-indigo-600 to-violet-500 bg-clip-text text-transparent dark:from-indigo-400 dark:to-violet-400">
                    one layer at a time.
                </span>
        </h1>

        <p class="text-base sm:text-lg text-neutral-600 dark:text-neutral-400 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
            Welcome to your modular Learning Management System. Streamline curriculum structures, manage video delivery streams, track user progress metrics, and experience native system reliability out of the box.
        </p>

        <div class="pt-4 flex flex-col sm:flex-row justify-center lg:justify-start items-center gap-4">
            <a href="{{ route('register') }}" class="w-full sm:w-auto text-center px-8 py-4 text-white bg-neutral-900 hover:bg-neutral-800 dark:bg-white dark:text-neutral-900 dark:hover:bg-neutral-100 font-semibold rounded-xl shadow-md transition-all">
                Explore Courses
            </a>
            <a href="#features" class="w-full sm:w-auto text-center px-8 py-4 text-neutral-700 border border-neutral-300 hover:border-neutral-400 dark:text-neutral-300 dark:border-neutral-700 dark:hover:border-neutral-600 font-semibold rounded-xl transition-all">
                View Features
            </a>
        </div>
    </div>

    <div id="features" class="lg:col-span-5 grid grid-cols-1 sm:grid-cols-2 gap-4">

        <div class="p-6 bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 rounded-2xl shadow-sm space-y-3">
            <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-blue-50 dark:bg-blue-950/50 text-xl">
                📁
            </div>
            <h3 class="font-bold text-lg text-neutral-900 dark:text-white">Structured Content</h3>
            <p class="text-sm text-neutral-500 dark:text-neutral-400">Organize core course structures into manageable modules and specific tracks.</p>
        </div>

        <div class="p-6 bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 rounded-2xl shadow-sm space-y-3">
            <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-emerald-50 dark:bg-emerald-950/50 text-xl">
                ⚡
            </div>
            <h3 class="font-bold text-lg text-neutral-900 dark:text-white">Real-time Metrics</h3>
            <p class="text-sm text-neutral-500 dark:text-neutral-400">Keep tabs on student progression data points instantly without delays.</p>
        </div>

        <div class="p-6 bg-white dark:bg-[#131313] border border-neutral-200/60 dark:border-neutral-800/60 rounded-2xl shadow-sm space-y-3 sm:col-span-2">
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <h3 class="font-bold text-lg text-neutral-900 dark:text-white">Secure Access Layer</h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">Breeze lightweight authentication protocols protecting student routes natively.</p>
                </div>
                <span class="text-3xl hidden sm:block">🛡️</span>
            </div>
        </div>

    </div>
</main>

</body>
</html>
