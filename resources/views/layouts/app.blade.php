<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'Laravel') }}</title>

   <!-- Fonts -->
   <link rel="preconnect" href="https://fonts.bunny.net">
   <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

   <!-- Scripts -->
   <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
   <link rel="stylesheet" href="{{ asset('build/assets/app-445b7fe1.css') }}">
   <script src="{{ asset('build/assets/app-d62ae1e6.js') }}"></script>
   @stack('script')

   <!-- Styles -->
   @livewireStyles
</head>

<body class="font-sans antialiased">
   <x-banner />

   <div class="min-h-screen bg-gray-100">
      @livewire('navigation-menu')

      <!-- Page Heading -->
      @if (isset($header))
         <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
               {{ $header }}
            </div>
         </header>
      @endif

      <!-- Page Content -->
      <main>
         <div class="container mx-auto px-4">
            {{ $slot }}
         </div>
      </main>
   </div>

   @stack('modals')

   @livewireScripts
</body>

</html>
