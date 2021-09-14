<x-alumno-layout>
    
    <h1 class="text-center text-xl font-bold">Solicitud de Tesis</h1>
    @if (session('info'))
    <div class="bg-red-200 border border-red-400 text-red-700 px-4 py-3 rounded relative my-2" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{session('info')}}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
          <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
    </div>
    @endif
    <form action="{{route('tesis.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2 class="font-bold">Titulo: </h2>
        <div>
            <input type="text" name="titulo" id="titulo" class="w-full" value="{{old('titulo')}}">
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
                    @foreach($docentes as $docente)
                        <option value="{{$docente->id}}">{{$docente->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <hr class="my-3">
        
        <h2 class="font-bold">Documento F-003-B FORMATO DE TITULO : </h2>
        <p>Debe ser firmado por el asesor de lo contrario, será rechazado</p>
        <div>
            <input type="file" name="file_tesis" id="file_tesis" class="w-full" accept=".pdf">
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
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="w-full" value="{{old('fecha_inicio')}}">
                @error('fecha_inicio')
                    <span>
                        <strong class="text-red-500">{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="fecha_fin">Fecha a Finalizar:</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="w-full" value="{{old('fecha_fin')}}">
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
                    <input type="text" name="nro" id="nro" class="w-full" value="{{old('nro')}}">
                    @error('nro')
                        <span>
                            <strong class="text-red-500">{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div>
                    <label for="file_voucher">Adjunte Recibo:</label>
                    <input type="file" name="file_voucher" id="file_voucher" class="w-full" accept="image/*">
                    @error('file_voucher')
                        <span>
                            <strong class="text-red-500">{{$message}}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>       
        <input type="submit" value="Solicitar" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full mt-2 cursor-pointer">
    </form>
    
</x-alumno-layout>