<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    <link rel="stylesheet" href="{{ asset('build/assets/app-a639a438.css') }}">
    <link rel="script" href="{{ asset('build/assets/app-d62ae1e6.js') }}">
    @stack("script")

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased">

<div class="bg-gray-300 h-max min-h-screen">
    <div class="navbar">
        <div class="flex-1">
            <a class="btn btn-ghost normal-case text-xl" href="/">Rimna</a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1 z-10">
                <li><a href="{{route("product")}}" class="{{request()->routeIs('product')?'active':''}}">Products</a>
                </li>
                @if(Auth::user())
                    <li><a href="{{route("admin.product")}}">Manage product</a></li>

                @else
                    <li><a href="{{route("login")}}">Login</a></li>
                @endif
            </ul>
        </div>
    </div>
    <div class="container mx-auto px-4 pb-4">
        {{ $slot }}
    </div>
</div>

@livewireScripts
</body>
</html>
