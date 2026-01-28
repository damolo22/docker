<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900">
        
        <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('trips.index') }}" class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                            ✈️ Travel Agency
                        </a>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600">Log in</a>
                            <a href="{{ route('register') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <div class="min-h-screen">
            {{ $slot }}
        </div>
    </body>
</html>