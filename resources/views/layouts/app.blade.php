<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IPBNet') }}</title>

    <!-- Fonts -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Page Content -->
        <div class="wrapper">
            @include('layouts.sidebar')
            <div class="main p-3">
                @if (isset($fyp))
                    @yield('fyp')
                @endif
                @if (isset($header))
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif
                @yield('main-content')
            </div>          
            <aside id="side_nav">
                <div class="side-right-container">
                    <div class="side-right-section" id="events-section">
                        @yield('events-content')
                    </div>
                    <div class="side-right-section" id="news-section">
                        @yield('news-content')
                    </div>
                </div>
            </aside>
        </div>
    </div>
</body>
</html>
