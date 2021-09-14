<x-alumno-layout>
    <h1 class="text-2xl font-bold text-center">SOLICITUD DE PRACTICAS</h1> 
    <div class="flex justify-end mb-2">
        <a class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded" href="{{route('practica.create')}}">Nueva solicitud</a>
    </div>

    @if (session('info'))
    <div class="bg-green-200 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{session('info')}}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
          <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
    </div>
    @endif

    <table class="min-w-full divide-y divide-gray-200 my-5 text-center">
        <thead class="bg-gray-50 text-center">
            <tr>
                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Descripcion
                </th>
                
                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Observaciones
                </th>
                <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200 text-center">
        @if ($practicas->count())
            @foreach ($practicas as $practica)
                <tr>
                    <td>
                        {{$practica->id}}
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap">
                        @switch($practica->status)
                            @case(1)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-red-800">
                                    Revision
                                </span>
                                @break
                            @case(2)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Aceptado
                                </span>
                                
                                @break
                            @case(3)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-yellow-800">
                                    Denegado
                                </span>
                                @break
                            @case(4)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                    Finalizada
                                </span>
                                @break
                            @case(5)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-red-800">
                                    Revision
                                </span>
                                @break
                            @case(6)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-yellow-800">
                                Denegado
                            </span>
                                @break
                            @default 
                        @endswitch  
                    </td>

                    @if ($practica->status == 3 or $practica->status == 6)
                        <td>
                            SI
                        </td>
                    @else
                        <td>
                           NINGUNA
                        </td>     
                    @endif
                    
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">                        
                        @if ($practica->status == 2 or $practica->status == 5 or $practica->status == 4 or  $practica->status ==6)

                            <a href="{{route('practica.progreso',$practica->id)}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-5 cursor-pointer">PROGRESO</a>
                        @else
                            <a href="{{route('practica.edit',$practica->id)}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-5 cursor-pointer">ACTUALIZAR</a>
                        @endif
                    </td>
                </tr>  
            @endforeach
              
        @else
            <tr>
                <td colspan="4" class="text-center">
                    No tiene ninguna solicitud pendiente.
                </td>
            </tr>
                
        @endif
    
        </tbody>
    </table>
    <hr class="mb-3">

    <!--REQUISITOS-->
    <h1 class="text-xl font-bold mt-10">PROCEDIMIENTO Y REQUISITOS DE PRÁCTICAS
    </h1>
    
    <div class="px-6 py-4">
            <p>
                Como requisito para iniciar las prácticas, el estudiante no debe adeudar ningún curso hasta el <span class="font-bold">VIII Ciclo.</span>
            </p>
            <!-- component -->
            <div class="container">
                <div class="flex flex-col md:grid grid-cols-9 mx-auto p-2 text-blue-50">
                    <!-- left -->
                    <div class="flex flex-row-reverse md:contents">
                        <div class="col-start-1 col-end-5 p-4 rounded-xl my-4 ml-auto shadow-md" style="background: #12377B">
                            <h3 class="font-semibold text-lg mb-1">VOUCHER DE TRÁMITE</h3>
                            <p class="leading-tight text-justify">
                            Voucher de trámite S/. 5.00 (grabado en un solo archivo).                  
                            </p>
                            <p>Depósitos en Bancos:</p>
                            <ul>
                                <li><i class="fa fa-university" aria-hidden="true"></i> Interbank - Cuenta Nº 6163001972909
                                </li>
                                <li><i class="fa fa-university" aria-hidden="true"></i> Financiera Confianza - Cuenta N°  003021000187671001
                                </li>
                            </ul>
                            <div class="text-center px-7"><img src="{{asset('img/financiera_confianza.png')}}" class="object-contain"></div>
                            <div class="pt-2 text-center px-7">
                                <svg version="1.1" viewBox="0 0 130 22" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="object-contain">
                                  <title>Interbank - El tiempo vale más que el dinero</title>
                                  <path d="M0,22 L19,22 C20.7304,22.0077476 21.9834907,20.7772084 22,19 L22,1.77635684e-15 L3,1.77635684e-15 C1.27432617,-0.00450496875 0.0233174171,1.22354403 0,3 L0,22 L0,22 L0,22 Z M5,18 L17,16 L17,4 L5,6 L5,18 L5,18 L5,18 Z" fill="#2F4A9F" fill-rule="evenodd"></path>
                                  <path id="brand-text" d="M82.64,9.057 C84.589,9.057 86.163,10.691 86.163,13.281 C86.163,15.871 84.589,17.568 82.64,17.568 C81.593802,17.5884877 80.5928114,17.1420555 79.909,16.35 C79.3233288,15.5644726 79.0291833,14.5996611 79.077,13.621 C78.9722668,12.5558593 79.200038,11.4844263 79.729,10.554 C80.4068301,9.62097964 81.4867998,9.06448545 82.64,9.054 L82.64,9.054 L82.64,9.057 Z M79.189,3.118 L79.15,8.562 C80.6846965,7.02581573 82.9553869,6.48814289 85.016,7.173 C87.575,7.848 89.036,10.16 89.071,13.336 C89.1774902,15.0753869 88.5529503,16.7802503 87.3480679,18.0392441 C86.1431856,19.2982379 84.467385,19.9970238 82.725,19.967 C78.915,20.003 76.138,17.423 76.168,13.667 L76.168,3.118 L79.189,3.118 L79.189,3.118 Z M73.478,6.477 L74.672,6.477 L74.672,9.377 L73.478,9.377 L73.478,9.372 C72.8429925,9.38093979 72.2351878,9.63121233 71.778,10.072 C71.3309137,10.4983542 71.0779477,11.0892103 71.078,11.707 L71.088,11.707 L71.088,19.97 L68.115,19.97 L68.115,11.7 L68.115,11.7 C68.1023455,10.3060825 68.6631579,8.96823229 69.666,8 C70.6926495,7.02216748 72.0592414,6.48177019 73.477,6.493 L73.477,6.477 L73.477,6.477 L73.478,6.477 Z M62.236,14.985 L57.865,14.985 C57.8991587,15.0547302 57.9512798,15.1140999 58.016,15.157 C58.5473012,16.3910552 59.7021458,17.2432403 61.038,17.387 L61.047,17.387 C61.227,17.414 61.423,17.441 61.612,17.459 C61.7970866,17.4774679 61.982995,17.4864796 62.169,17.486 L62.169,17.486 C63.3525697,17.5007947 64.523378,17.2402727 65.589,16.725 C65.6607009,17.3657075 65.6462389,18.0131332 65.546,18.65 C65.292,19.875 62.808,19.966 61.967,19.966 L61.967,19.975 C61.6998967,19.9765065 61.4328884,19.9644911 61.167,19.939 C60.8986296,19.9211058 60.6315176,19.8877168 60.367,19.839 L60.367,19.839 C57.1093228,19.3189452 54.8076559,16.3693888 55.095,13.083 L55.095,13.03 L55.095,13.03 C55.0875806,10.2822512 56.8640651,7.8474796 59.483,7.016 L59.493,7.016 L59.541,7 L59.55,6.991 C61.4241922,6.42828319 63.4560599,6.86956646 64.928,8.159 C65.1786876,8.38113647 65.4126552,8.62145462 65.628,8.878 C65.8405368,9.13419751 66.023369,9.4136456 66.173,9.711 L66.193,9.738 L66.193,9.738 C66.4743291,10.2672519 66.6284064,10.8548 66.643,11.454 C66.6421445,12.0791076 66.4307845,12.6857108 66.043,13.176 C65.6940791,13.6481419 65.2436881,14.0359976 64.725,14.311 L64.725,14.32 C63.9585925,14.731441 63.1074157,14.9600642 62.238,14.988 L62.238,14.988 L62.236,14.985 Z M57.808,12.54 L62.298,12.54 C63.312,12.54 64.289,12.04 63.709,10.74 L63.69,10.713 L63.69,10.713 C63.6225929,10.5735416 63.5440027,10.439771 63.455,10.313 C63.3482291,10.1574356 63.2229809,10.0153981 63.082,9.89 C62.3825248,9.0891337 61.2639895,8.7982907 60.263,9.157 L60.263,9.148 L60.226,9.166 L60.226,9.166 C60.0268277,9.2336171 59.8323949,9.31446375 59.644,9.408 C59.4646979,9.50256802 59.2954918,9.61514872 59.139,9.744 C58.3824932,10.4936364 57.9116954,11.4840451 57.808,12.544 L57.808,12.544 L57.808,12.54 Z M49.766,3 L49.766,6.481 L54.722,6.481 L54.611,7.73 C54.5,8.7 53.925,8.974 52.793,9 L49.766,9 L49.766,15.056 L49.766,15.056 C49.7705245,15.3131675 49.7892195,15.5698902 49.822,15.825 C49.9539378,16.6487919 50.7060798,17.2262825 51.536,17.141 C52.6016716,17.2420008 53.6767226,17.1221724 54.694,16.789 C54.808,17.847 54.657,19.381 54.029,19.614 C53.144445,19.8510768 52.228976,19.9522336 51.314,19.914 C50.8940245,19.9061745 50.4753513,19.8647085 50.062,19.79 C49.2364556,19.5980152 48.4702699,19.2073704 47.83,18.652 C47.0658494,17.6926862 46.6925699,16.4799742 46.785,15.257 L46.776,15.184 L46.776,3 L49.765,3 L49.766,3 Z M38.318,6.383 L39.4,6.383 L39.4,6.4 C40.8342985,6.38977659 42.2172752,6.93315284 43.261,7.917 C44.2750676,8.87750039 44.8502566,10.212257 44.852,11.609 L44.852,11.609 L44.852,19.968 L41.922,19.968 L41.922,11.609 L41.932,11.609 C41.9204055,10.9895186 41.6657619,10.3994207 41.223,9.966 C40.7409277,9.52940208 40.1153662,9.28494202 39.465,9.279 L39.465,9.288 L38.286,9.288 L38.286,9.279 C37.6509925,9.28793979 37.0431878,9.53821233 36.586,9.979 C36.1403763,10.406368 35.8876908,10.996569 35.886,11.614 L35.896,11.614 L35.896,19.973 L32.91,19.973 L32.91,11.609 L32.91,11.609 C32.9140897,10.2106174 33.4883081,8.87438591 34.5,7.909 C35.5294583,6.93090698 36.8980175,6.39000708 38.318,6.4 L38.318,6.383 L38.318,6.383 L38.318,6.383 Z M27.983,2.983 L30.983,2.983 L30.983,20.011 L27.983,20.011 L27.983,2.982 L27.983,2.982 L27.983,2.983 Z M108.605,6.353 L109.681,6.353 L109.681,6.371 C111.107437,6.36786112 112.481013,6.91063666 113.52,7.888 C114.522704,8.8557021 115.093315,10.1865264 115.103,11.58 L115.113,11.58 L115.113,19.97 L112.142,19.97 L112.142,11.58 L112.161,11.58 C112.164806,10.9546052 111.902259,10.3571478 111.439,9.937 C110.98181,9.49783577 110.372944,9.25178234 109.739,9.25 L109.739,9.259 L108.529,9.259 L108.529,9.247 C107.894806,9.24831808 107.286758,9.49987455 106.837,9.947 C106.375078,10.3649233 106.111978,10.9590787 106.113,11.582 L106.121,11.582 L106.121,19.972 L103.162,19.972 L103.162,11.582 L103.171,11.582 C103.1812,10.1846893 103.754849,8.85062179 104.762,7.882 C105.797581,6.90680137 107.168545,6.36722384 108.591,6.375 L108.591,6.352 L108.601,6.352 L108.605,6.353 Z M117.159,2.983 L120.147,2.983 L120.147,19.968 L117.159,19.968 L117.159,2.982 L117.159,2.982 L117.159,2.983 Z M124.547,7 L120.13,12.238 L120.137,13.059 L120.137,13.659 L125.555,19.978 L129.165,19.978 L123.149,13.056 L128.226,7 L124.547,7 L124.547,7 Z M98.455,13.985 L98.455,13.922 C97.8938993,13.9790525 97.329277,13.9934272 96.766,13.965 C95.9256255,13.915591 95.0843514,14.0454636 94.298,14.346 C93.7552115,14.5771244 93.3689752,15.0705857 93.275,15.653 L93.275,15.653 L93.275,15.744 L93.275,15.744 C93.1956832,16.1958521 93.3063172,16.6604093 93.5807856,17.0280077 C93.855254,17.395606 94.2692337,17.6336693 94.725,17.686 L94.752,17.686 L94.752,17.7 C95.6475938,17.859294 96.5700874,17.7582986 97.41,17.409 C97.9989122,17.0543509 98.3925669,16.4491252 98.478,15.767 C98.553679,15.1770433 98.5670861,14.580762 98.518,13.988 L98.455,13.988 L98.455,13.985 Z M95.034,6.366 C96.615122,6.18764116 98.2098723,6.55264925 99.556,7.401 C100.07707,7.81531593 100.50216,8.33763713 100.802,8.932 C101.080828,9.64892024 101.226219,10.4107817 101.231,11.18 L101.231,15.063 C101.415267,16.9757574 100.345927,18.7893541 98.583,19.554 C97.8774817,19.8409443 97.1245669,19.9935622 96.363,20.004 C92.956,20.085 90.206,18.424 90.469,15.404 C90.638,13.229 92.754,12.166 95.006,12.011 C96.076,11.939 97.853,12.134 98.526,11.988 C98.5876767,11.3664291 98.5073208,10.738969 98.291,10.153 C98.1052307,9.68053553 97.7241803,9.31151834 97.246,9.141 C96.4536908,8.88912726 95.6181607,8.80234104 94.791,8.886 C93.7715045,8.92633594 92.7796083,9.22872653 91.911,9.764 L91.889,8.636 C91.9043227,8.27546275 91.9839052,7.92055878 92.124,7.588 C92.9105583,6.83642438 93.9466676,6.40132968 95.034,6.366 L95.034,6.366 L95.034,6.366 Z" fill="#00BB31" fill-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="col-start-5 col-end-6 md:mx-auto relative mr-10">
                            <div class="h-full w-6 flex items-center justify-center">
                                <div class="h-full w-1 bg-blue-800 pointer-events-none"></div>
                            </div>
                            <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-blue-500 shadow"></div>
                        </div>
                    </div>
                    <!-- right -->
                    <div class="flex md:contents">
                        <div class="col-start-5 col-end-6 mr-10 md:mx-auto relative">
                            <div class="h-full w-6 flex items-center justify-center">
                                <div class="h-full w-1 bg-blue-800 pointer-events-none"></div>
                            </div>
                            <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-blue-500 shadow"></div>
                        </div>
                        <div class="col-start-6 col-end-10 p-4 rounded-xl my-4 mr-auto shadow-md" style="background: #12377B" >
                            <h3 class="font-semibold text-lg mb-1">ARCHIVO PLAN DE PRACTICA</h3>
                            <div>
                                <div>
                                    <p class="leading-tight">
                                    Un (01) ejemplar del Plan de Prácticas (grabado en un solo archivo).
                                    </p>
                                </div>
                                <div class="pt-2"> 
                                    <a href="{{asset('example_archivos/example_plan.pdf')}}" class="button" download><i class="fas fa-download"></i> Descarge ejemplo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- left -->
                    <div class="flex flex-row-reverse md:contents">
                        <div class="col-start-1 col-end-5 p-4 rounded-xl my-4 ml-auto shadow-md" style="background: #12377B">
                            <h3 class="font-semibold text-lg mb-1">HACER SU SOLICITUD DE PRACTICA</h3>
                            <p class="leading-tight text-justify">
                                Formato unico de trámite                  
                            </p>
                        </div>
                        <div class="col-start-5 col-end-6 md:mx-auto relative mr-10">
                            <div class="h-full w-6 flex items-center justify-center">
                                <div class="h-full w-1 bg-blue-800 pointer-events-none"></div>
                            </div>
                            <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-blue-500 shadow"></div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
        
</x-alumno-layout>