<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portfolio - Justin Jongstra</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
<div
    class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
                <a href="{{ route('login') }}"
                   class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                    in</a>
            @endauth
        </div>
    @endif

    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200">
            Justin Jongstra <span class="text-gray-600 dark:text-gray-400">- Software Developer</span>
        </h1>

        <h2 class="text-2xl text-gray-800 dark:text-gray-200 font-extrabold">
            Student at
            <a href="https://rijnijssel.nl"
               class="focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 underline hover:no-underline">
                <span class="text-orange-400 dark:text-orange-500">Rijn</span><span
                    class="text-purple-400 dark:text-purple-500">IJssel</span></a>
        </h2>

        <p class="text-gray-600 dark:text-gray-400 mt-8 w-3/4 text-xl">
            This is my website where I will be posting my projects. I am a student at Rijn IJssel College and I am
            currently studying for my MBO Software Developer diploma. I am currently in my 3rd year and I am looking
            forward to the future.
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">
            <div class="text-center text-gray-600 dark:text-gray-400 font-bold sm:mt-0 lg:mt-32">
                <h3 class="text-2xl text-gray-800 dark:text-gray-200 font-extrabold"
                    onclick="window.location.href = '/home'">
                    <x-primary-button>View more</x-primary-button>
                </h3>
            </div>
            <div class="h-48 w-48 hidden sm:block">
                <x-application-logo class="block h-12 w-auto fill-current text-gray-600 dark:text-gray-400"/>
            </div>
        </div>
    </div>
</div>
<x-footer/>

</body>
</html>
