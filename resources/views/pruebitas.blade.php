<form action="{{route('prueba')}}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="solicitud">Solicitud:</label>
        <input type="text" name="solicitud" class="w-full">
    </div>

    <div class="mb-4">
        <textarea name="description" id="description" cols="30" rows="10" class="mb-2"></textarea>
    </div>

    <div class="mb-4">
        <label for="voucher">Voucher:</label>
        <div class="mb-2 grid grid-cols-2 gap-4">
            <div>
                <label for="datestart">Número de Operacion:</label>
                <input type="text" name="num_operacion" class="w-full">
            </div>
            <div>
                <input type="file" name="file_voucher" id="file_voucher">
            </div>
        </div>
    </div>

    <div class="mb-4 grid grid-cols-2 gap-4">
        <div>
            <label for="datestart">Fecha de inicio:</label>
            <input type="date" name="datestart" id="datestart" class="w-full">
        </div>
        <div>
            <label for="dateend">Fecha a Finalizar:</label>
            <input type="date" name="dateend" id="dateend" class="w-full">
        </div>
    </div>
    
    <!-- Subida de archivos-->
    
    <input type="file" name="archivo2" id="archivo2">
    <input type="file" name="archivo3" id="archivo3">

    <input type="submit" value="Solicitar" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full mt-2 cursor-pointer">
</form>

<div class="">	
    <div class="flex pb-3">
        <div class="flex-1">
        </div>
        <div class="flex-1">
            <div class="{{!$status ? 'border-2' : 'bg-green-500 text-white'}} w-10 h-10 mx-auto rounded-full text-lg flex items-center">
                <span class="text-center w-full"> @if (!$status) 1 @else <i class="fas fa-check"></i> @endif </span>
            </div>
            <div class="text-center pt-2">
                Solicitud
            </div>
        </div>
        
        <div class="w-1/4 align-center items-center align-middle content-center flex item pb-6">
            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                <div class="bg-green-500 text-xs leading-none py-1 text-center rounded " style="width: {{!$status ? '0%' : '100%'}}"></div>
            </div>
        </div>
    
        <div class="flex-1">
            <div class="{{($status ==2) ? 'bg-green-500 text-white': (($status==3) ? 'bg-red-500 text-white':'border-2')}} w-10 h-10 mx-auto rounded-full text-lg  flex items-center">
                <span class="text-center w-full">@if ($status==2) <i class="fas fa-check"></i> @else  @if ($status==3) <i class="fas fa-times"></i> @else  2 @endif  @endif</span>
            </div>
            <div class="text-center pt-2">
                @if ($status==2) Aprobada @else  @if ($status==3) Rechazada @else Revisión @endif  @endif </i>
            </div>
        </div>
    
        <div class="w-1/4 align-center items-center align-middle content-center flex pb-6">
            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                <div class="bg-green-500 text-xs leading-none py-1 text-center rounded " style="width: {{($status==4) ? '100%' : '0%'}}"></div>
            </div>
            
        </div>
    
        <div class="flex-1">
            <div class="{{($status==4) ? 'bg-green-500 text-white' : 'border-2'}} w-10 h-10 mx-auto rounded-full text-lg  flex items-center">
                <span class="text-center w-full">@if ($status==4) <i class="fas fa-check"></i> @else 3 @endif </span>
            </div>
            <div class="text-center pt-2">
                Finalizada
            </div>
        </div>
    
        <div class="flex-1">
        </div>		
    </div>
</div>

@switch($status)
        @case(1)
            <h3 class="text-center">Practica en REVISION.</h3>
            @break
        @case(2)
            <h3 class="text-center">Practica ACEPTADA.</h3>
             <!-- Contador regresivo -->
            @if (!is_null($practica))
                <section class="text-center pt-5">
                    <h2>Cuenta Regresiva</h2>
                    <input type="hidden" name="fecha" id="fecha" value="{{$practica->end_date}}">
                    <div id="countdown"></div>
                </section>
            @endif 
            @break
        @case(3)
            <h3 class="text-center">Practica RECHAZADA.</h3>
            @break
        @case(4)
            <h3 class="text-center">Practica FINALIZADA.</h3>
            @break
        @default
            <!-- NUNCA ENVIO NADA -->
            <form action="{{route('alumno.practicas.solicitud')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2>Solicitud: </h2>
                <div class="mb-4">
                    <label for="solicitud">Asunto:</label>
                    <input type="text" name="solicitud" class="w-full">
                    @error('solicitud"')
                    <span>
                        <strong class="text-red-500">{{$message}}</strong>
                    </span>
                @enderror
                </div>
                <div class="mb-4">
                    <label for="description">Descripcion:</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="mb-2"></textarea>
                    @error('description')
                    <span>
                        <strong class="text-red-500">{{$message}}</strong>
                    </span>
                @enderror
                </div>

                <hr class="my-3">
                <h2>Voucher: </h2>
                <div class="mb-4">
                    <div class="mb-2 grid grid-cols-2 gap-4">
                        <div>
                            <label for="num_operacion">Número de Operacion:</label>
                            <input type="text" name="num_operacion" id="num_operacion" class="w-full">
                            @error('num_operacion')
                                <span>
                                    <strong class="text-red-500">{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="file_voucher">Adjunte Recibo:</label>
                            <input type="file" name="file_voucher" id="file_voucher" class="w-full">
                            @error('file_voucher')
                                <span>
                                    <strong class="text-red-500">{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="my-3">
                <h2>Plan de Practicas: </h2>
                <div class="mb-4">
                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div>
                            <label for="start_date">Fecha de inicio:</label>
                            <input type="date" name="start_date" id="start_date" class="w-full">
                            @error('start_date')
                                <span>
                                    <strong class="text-red-500">{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="end_date">Fecha a Finalizar:</label>
                            <input type="date" name="end_date" id="end_date" class="w-full">
                            @error('end_date')
                                <span>
                                    <strong class="text-red-500">{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="file_practica">Adjunte Plan de Practicas:</label>
                        <input type="file" name="file_practica" id="file_practica" class="w-full">
                        @error('file_practica')
                            <span>
                                <strong class="text-red-500">{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
            
                <input type="submit" value="Solicitar" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full mt-2 cursor-pointer">
            </form>
    @endswitch
    