<x-alumno-layout>
    <h1 class="text-center text-xl font-bold">Actualizar Solicitud de Tesis</h1>
    @if ($alumno_tesis->status == 3)
        <h2 class="text-xl font-bold">OBSERVACIONES</h2>

        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
            <p class="font-bold">Solucionar:</p>
            @foreach ($tesis->observations as $observacion)
                <p>{!!$observacion->mensaje!!}</p>
            @endforeach
        </div>
        <hr class="my-3">
    @endif
    <form action="{{route('tesis.update',$tesis)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <h2 class="font-bold">Titulo: </h2>
        <div>
            <input type="text" name="titulo" id="titulo" class="w-full" value="{{old('titulo',$tesis->titulo)}}">
            @error('titulo')
                <span>
                    <strong class="text-red-500">{{$message}}</strong>
                </span>
            @enderror
        </div>
        <hr class="my-3">
        <h2 class="font-bold">Asesor: </h2>

        <div class="mb-4">
            <div>
                <select name="docente_id" id="docente_id" class="w-full">
                    <option value="">SELECCIONA UN DOCENTE</option>
                    @foreach ($docentes as $docente)
                        <option value="{{$docente->id}}" {{ $docente->id == $alumno_tesis->docente_id ? 'selected':''}}> 
                            {{$docente->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <hr class="my-3">
        
        <h2 class="font-bold">Documento F-003-B FORMATO DE TITULO : </h2>
        <p>Debe ser firmado por el asesor de lo contrario, será rechazado</p>
        <div>
            <input type="file" name="file_tesis" id="file_tesis" class="w-full" accept=".pdf" value="{{old('file_tesis',$tesis->file_tesis)}}">
            @error('file_tesis')
                <span>
                    <strong class="text-red-500">{{$message}}</strong>
                </span>
            @enderror
        </div>
        <hr class="my-3">

        <div class="my-4 grid grid-cols-2 gap-4">
            <div>
                <label for="fecha_inicio">Fecha de inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="w-full" value="{{old('fecha_inicio',$tesis->fecha_inicio)}}">
                @error('fecha_inicio')
                    <span>
                        <strong class="text-red-500">{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="fecha_fin">Fecha a Finalizar:</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="w-full" value="{{old('fecha_fin',$tesis->fecha_fin)}}">
                @error('fecha_fin')
                    <span>
                        <strong class="text-red-500">{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div>

        
        <hr class="my-3">

        <h2 class="font-bold">Voucher: </h2>

        <div class="mb-4">
            <div class="mb-2 grid grid-cols-2 gap-4">
                <div>
                    <label for="nro">Número de Operacion:</label>
                    <input type="text" name="nro" id="nro" class="w-full" value="{{old('nro',$tesis->voucher->nro)}}">
                    @error('nro')
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
        
        <input  type="submit" value="@if ($alumno_tesis->status == 3) Solicitar @else Actualizar Informacion @endif" class="{{($alumno_tesis->status == 3) ? 'bg-green-500 hover:bg-green-700' : 'bg-blue-500 hover:bg-blue-700' }} text-white font-bold py-2 px-4 rounded w-full mt-2 cursor-pointer">        
    
        </form>
    
    
</x-alumno-layout>