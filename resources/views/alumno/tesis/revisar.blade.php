<x-alumno-layout>
    @php
        $status = $tesis->status;
    @endphp

        @if ($status == 4)
            <h2 class="text-xl font-bold mt-10 text-center">PROCESO DE TESIS FINALIZADA</h2> 
        @else
            
            <h2 class="text-xl font-bold mt-10">FECHA DE SUSTENTACION</h2>
            @php
                $time=strtotime($tesis->sustentacion);
            @endphp
            @if ($status == 8)
            <div class="bg-indigo-900 text-center py-4 lg:px-4">
                <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                  <span class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3">Nota</span>
                  <span class="font-semibold mr-2 text-left flex-auto">Cuendo termine, se le asignada su fecha de sustentacion.</span>
                  <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
                </div>
              </div>

            <h2 class="font-bold text-center mt-7">SU TESIS SE ENCUENTRA EN REVISION POR EL JURADO</h2> 
            <p class="font-bold text-center">Lapso de 15 días</p>

            @else
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
            @endif
        
            <h2 class="text-xl font-bold mt-10">JURADOS</h2>
            <table class="min-w-full">
                <thead>
                  <tr>
                    <th scope="col" class="text-center">JURADO</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($jurados as $jurado)
                        <tr class="text-center">
                            <td>{{$jurado->nombre}}</td>
                        </tr>      
                    @endforeach
                </tbody>
              </table>
        @endif 
    
        
</x-alumno-layout>