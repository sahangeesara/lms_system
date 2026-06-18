<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel LMS') }}</title>

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
<body class="antialiased bg-white text-[#1b1b18]  dark:text-[#EDEDEC] transition-colors duration-300">
<div class="min-h-screen flex flex-row">

    @include('layouts.side_navbar')

    <div class="flex-1 min-w-0 flex flex-col">
        @isset($header)
            <header class="bg-white dark:bg-[#131313] border-b border-neutral-100 dark:border-neutral-800/60 shadow-sm">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="max-w-7xl w-full mx-auto py-8 px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>
    </div>
</div>
</body>
</html>
