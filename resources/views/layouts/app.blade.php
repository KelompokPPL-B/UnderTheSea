<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="oceanTheme">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Under The Sea') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Load Tailwind via CDN so project works without Vite dev server -->
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Optional: small Tailwind config can be added inline if needed -->
        <!-- Project custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Axios (required by app scripts) -->
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <!-- Alpine (required by app scripts) -->
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <!-- Project JS bundle -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased bg-sand">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <main class="flex-grow">
                @yield('content')
            </main>

            @include('layouts.footer')
        </div>
            @stack('scripts')
    </body>
</html>
