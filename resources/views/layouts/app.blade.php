<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="oceanTheme">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Under The Sea') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-sand">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="max-w-7xl mx-auto px-6 mt-4">
                    <div class="alert alert-success shadow-lg">
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            @if(session('error'))
                <div class="max-w-7xl mx-auto px-6 mt-4">
                    <div class="alert alert-error shadow-lg">
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <main class="flex-grow">
                @yield('content')
            </main>

            @include('layouts.footer')
        </div>
        @stack('scripts')
    </body>
</html>
