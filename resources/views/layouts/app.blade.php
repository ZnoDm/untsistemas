<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
        @livewireStyles
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <style>
            .t-footer{
                color: #E6AD09;
            }
            .t-footer>p,.t-footer>span{
                color: #FFFFFF;
            }
            .t-footer>span>i{
                color: #E6AD09;
            }
        </style>
    </head>
    <body class="font-sans antialiased" >
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100" style="background:  #12377B">
            @livewire('navigation-menu')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
    <footer style="background:#1B1811">
        <div class="max-w-7xl mx-auto p-10 grid grid-cols-1 gap-4 sm:grid-cols-4" >
            <div class="t-footer">
                <h5>UBICACIÓN</h5>
                <div class="mb-3" style="border-bottom-style: solid; border-bottom-width: 3px; width: 40px;"></div>

                <span>Campus Universitario </span> <br>
                <span>Av. Juan Pablo II S/N </span> <br>
                <span>Trujillo - Perú </span> <br>
                <span>Filiales: </span> <br>
                <span>Sede Huamachuco </span> <br>
                <span>Sede Valle Jequetepeque </span>
            </div>
            <div class="t-footer">
                <h5>CONTACTO</h5>
                <div class="mb-3" style="border-bottom-style: solid; border-bottom-width: 3px; width: 40px;"></div>

                <span><i class="bi bi-telephone-fill"></i> &nbsp; (044) 209020  </span> <br>
                <span><i class="bi bi-envelope"></i> &nbsp; tdsgunt@unitru.edu.pe  </span> <br>
                <span><i class="bi bi-globe"></i> &nbsp; https://www.unitru.edu.pe/ </span>

            </div>
            <div class="t-footer">
                <h5>SOBRE ESTE PORTAL</h5>
                <div class="mb-3" style="border-bottom-style: solid; border-bottom-width: 3px; width: 40px;"></div>

                <span> Mapa de Sitio </span>  <br>
                <span> Términos de uso </span> <br>
                <span> Políticas de Privacidad </span>
            </div>
            <div class="t-footer">
                <h5>SÍGUENOS EN: </h5>
                <div class="mb-3" style="border-bottom-style: solid; border-bottom-width: 3px; width: 40px;"></div>
                <div class="flex" style="color: #FFFFFF!important;">
                    <h2 class="px-2"> <i class="bi bi-facebook"></i></h2>                     
                    <h2 class="px-2"> <i class="bi bi-instagram"></i></h2> 
                    <h2 class="px-2"> <i class="bi bi-twitter"></i></h2> 
                    <h2 class="px-2"> <i class="bi bi-linkedin"></i></h2> 
                </div>
            </div>
        </div>
    </footer>
</html>
