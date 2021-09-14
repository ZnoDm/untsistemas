<x-alumno-layout>
    @php
        $status = $tesis->status;
    @endphp

    @if ($status == 5)
        <h2 class="text-xl font-bold mt-10 text-center">INFORME FINAL ENVIADO A REVISION</h2>
    @else
        @if ($status == 4)
            <h2 class="text-xl font-bold mt-10 text-center">PROCESO DE TESIS FINALIZADA</h2> 
        @else
            @if ($status == 6)
                <h2 class="text-xl font-bold">OBSERVACIONES</h2>

                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                    <p class="font-bold">Solucionar:</p>
                    @foreach ($tes->observations as $observacion)
                        <p>{!!$observacion->mensaje!!}</p>
                    @endforeach
                </div>
                <hr class="my-3">
            @endif
            <h2 class="text-xl font-bold mt-10">FECHA LIMITE</h2>
            @php
                $time=strtotime($tesis->fecha_fin);
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
            <form action="{{route('tesis.send_informefinal')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tesis_id" id="tesis_id" value="{{$tesis->tesis_id}}">
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