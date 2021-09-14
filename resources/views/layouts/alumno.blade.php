<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Trámites</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 grid grid-cols-5 gap-6">
                <aside>
                    <h1 class="font-bold text-lg mb-4">Trámites</h1>
                    <ul class="text-sm text-gray-600 mb-4">
                        <li class="leading-7 mb-1 border-l-4 {{request()->routeIs('practica.*') ? 'border-indigo-400' :'border-transparent'}} pl-2">
                            <a href="{{route('practica.index')}}">Practicas</a>
                        </li>
                        <li class="leading-7 mb-1 border-l-4 {{request()->routeIs('tesis.*') ? 'border-indigo-400' :'border-transparent'}} pl-2">
                            <a href="{{route('tesis.index')}}">Tesis</a>
                        </li>
                    </ul>
                </aside>
                
                <div class="col-span-4 bg-white rounded-lg shadow-lg">
                    <main class="text-gray-600 p-4 m-5">
                        {{$slot}}
                    </main>
                </div>
            </div>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
