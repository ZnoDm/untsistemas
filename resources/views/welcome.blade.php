<x-app-layout>
    @section('title', 'SISTEMA DE TRÁMITES DE PRACTICAS Y TESIS')
    <section>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
            <!-- This is an example component -->
            <div class="container mx-auto my-5">

                <div class="relative rounded-lg flex flex-col md:flex-row items-center md:shadow-xl md:h-72 mx-2">
                    
                    <div class="z-0 order-1 md:order-2 relative w-full md:w-2/5 h-80 md:h-full overflow-hidden rounded-lg md:rounded-none md:rounded-r-lg">
                        <div class="absolute inset-0 w-full h-full object-fill object-center bg-blue-400 bg-opacity-30 bg-cover bg-bottom" style="background-image: url( https://cdn.pixabay.com/photo/2015/03/26/09/41/tie-690084_960_720.jpg ); background-blend-mode: multiply;"></div>
                        <div class="md:hidden absolute inset-0 h-full p-6 pb-6 flex flex-col-reverse justify-start items-start bg-gradient-to-b from-transparent via-transparent to-gray-900">
                            <h3 class="w-full font-bold text-2xl text-white leading-tight mb-2">SISTEMA DE TRÁMITES DE PRACTICAS Y TESIS</h3>
                            <h4 class="w-full text-xl text-gray-100 leading-tight">Bienvenido al</h4>
                        </div>
                        <svg class="hidden md:block absolute inset-y-0 h-full w-24 fill-current text-white -ml-12" viewBox="0 0 100 100" preserveAspectRatio="none">
                            <polygon points="50,0 100,0 50,100 0,100" />
                        </svg>
                    </div>

                    <div class="z-10 order-2 md:order-1 w-full h-full md:w-3/5 flex items-center -mt-6 md:mt-0">
                        <div class="p-8 md:pr-18 md:pl-14 md:py-12 mx-2 md:mx-0 h-full bg-white rounded-lg md:rounded-none md:rounded-l-lg shadow-xl md:shadow-none">
                            <h4 class="hidden md:block text-xl text-gray-400">Bienvenido al</h4>
                            <h3 class="hidden md:block font-bold text-2xl text-gray-700">SISTEMA DE TRÁMITES DE PRACTICAS Y TESIS</h3>
                            <p class="text-gray-600 text-justify">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione itaque perspiciatis quod sapiente quidem, vero consectetur quae iure error tempore reprehenderit unde veritatis fugit iusto nemo amet. Assumenda, quam facilis.</p>
                            <a class="flex items-baseline mt-3 text-blue-600 hover:text-blue-900 focus:text-blue-900" href="">
                                <span>Conocer más de Nosotros</span>
                                <span class="text-xs ml-1">&#x279c;</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    
    <section class="max-w-7xl mx-auto">
        <h1 class="font-bold text-4xl text-center mb-3" style="color:#E6AD09">PROCEDIMIENTOS</h1>
        <img src="{{asset('img/SLIDER1.png')}}" alt="" class="object-center px-20"> <br> <br>
        <img src="{{asset('img/SLIDER2.png')}}" alt="" class="object-center p-20">
    </section>
 </x-app-layout>