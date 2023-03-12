<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

            @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex justify-center">

                </div>

                <div class="text-center text-gray-600 dark:text-gray-400 font-bold text-gray-800 dark:text-gray-200">
                    <h1 class="text-4xl">Welcome to my portfolio website</h1>
                    <h2 class="text-2xl mt-2">My name is <span class="text-red-500">Justin Jongstra</span></h2>
                    <h3 class="text-xl mt-2">I'm a <span class="text-red-500">Software Developer</span></h3>
                    <h4 class="text-lg mt-6">Student at <a class="text-blue-500 hover:text-blue-700 underline dark:text-blue-500 dark:hover:text-blue-700 dark:underline dark:hover:no-underline dark:font-bold dark:font-normal" href="https://www.rijnijssel.nl/" target="_blank">RijnIJssel</a></h4>
                </div>
                <div class="text-center text-gray-600 dark:text-gray-400 mt-16">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Made with <a href="https://laravel.com" class="text-gray-900 dark:text-gray-200 underline hover:no-underline">Laravel</a>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
