<x-alumno-layout>
    @php
        $status = $practica->status;
    @endphp
    <h2 class="text-xl font-bold mb-5">PROGRESO</h2>
    <div class="">	
        <div class="flex pb-3">
            <div class="flex-1">
            </div>
            <div class="flex-1">
                <div class="{{!$status ? 'border-2' : 'bg-green-500 text-white'}} w-10 h-10 mx-auto rounded-full text-lg flex items-center">
                    <span class="text-center w-full"> @if (!$status) 1 @else <i class="fas fa-check"></i> @endif </span>
                </div>
                <div class="text-center pt-2">
                    Aceptada
                </div>
            </div>
            
            <div class="w-1/4 align-center items-center align-middle content-center flex item pb-6">
                <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                    <div class="bg-green-500 text-xs leading-none py-1 text-center rounded " style="width: {{!$status ? '0%' : '100%'}}"></div>
                </div>
            </div>
        
            <div class="flex-1">
                <div class="{{($status ==4) ? 'bg-green-500 text-white': (($status==3) ? 'bg-red-500 text-white':'border-2')}} w-10 h-10 mx-auto rounded-full text-lg  flex items-center">
                    <span class="text-center w-full">@if ($status==4) <i class="fas fa-check"></i> @else  @if ($status==3) <i class="fas fa-times"></i> @else  2 @endif  @endif</span>
                </div>
                <div class="text-center pt-2">
                    Informe Final</i>
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
    @if ($status == 5)
        <h2 class="text-xl font-bold mt-10 text-center">INFORME FINAL ENVIADO EN REVISION</h2>
    @else
        @if ($status == 4)
            <h2 class="text-xl font-bold mt-10 text-center">PRACTICA FINALIZADA</h2> 
        @else
            @if ($status == 6)
            <h2 class="text-xl font-bold">OBSERVACIONES</h2>

            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                <p class="font-bold">Solucionar:</p>
                @foreach ($prac->observations as $observacion)
                    <p>{!!$observacion->mensaje!!}</p>
                @endforeach
            </div>
            <hr class="my-3">
            @endif
            <h2 class="text-xl font-bold mt-10">FECHA LIMITE</h2>
            @php
                $time=strtotime($practica->fecha_fin);
            @endphp
            <div class="grid grid-cols-3 gap-4">
                <div class=""></div>
                <div class="rounded-t lg:rounded-t-none lg:rounded-l text-center shadow-lg ">
                <div class="rounded-t overflow-hidden  text-center ">
                    <div class="bg-blue-600 text-white py-1">
                        {{date("F", $time)}}
                    </div>
                    <div class="pt-1 border-l border-r border-white bg-white">
                    <span class="text-5xl font-bold leading-tight">
                        {{date("d", $time)}}
                    </span>
                    </div>
                    <div class="border-l border-r border-b rounded-b-lg text-center border-white bg-white -pt-2 -mb-1">
                    <span class="text-sm">
                        {{date("D", $time)}}
                    </span>
                    </div>
                    <div class="pb-2 border-l border-r border-b rounded-b-lg text-center border-white bg-white">
                    <span class="text-xs leading-normal">
                        Antes de 12:00 pm
                    </span>
                    </div>
                </div>
                </div>
                <div class=""></div>
            </div>
        
            <h2 class="text-xl font-bold mt-10">INFORME FINAL</h2>
            <form action="{{route('practica.informefinal')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="practica_id" id="practica_id" value="{{$practica->practica_id}}">
                <div class="my-4">
                    <div class="mb-2 ">
                        <div>
                            <input type="file" name="file_informe_final" id="file_informe_final" class="w-full" accept=".pdf">
                            @error('file_informe_final')
                                <span>
                                    <strong class="text-red-500">{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
        
                
                <input type="submit" value="Enviar" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full mt-2 cursor-pointer">
            </form>
        @endif 
    
    @endif
</x-alumno-layout>