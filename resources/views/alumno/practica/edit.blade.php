<x-alumno-layout>
    <h1 class="text-center text-xl font-bold">Actualizar Solicitud de Practica</h1>
    @if ($alumno_practica->status == 3)
        <h2 class="text-xl font-bold">OBSERVACIONES</h2>

        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
            <p class="font-bold">Solucionar:</p>
            @foreach ($practica->observations as $observacion)
                <p>{!!$observacion->mensaje!!}</p>
            @endforeach
        </div>
        <hr class="my-3">
    @endif
    <form action="{{route('practica.update',$practica)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div>
            <label for="descripcion">Asunto:</label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="10" class="mb-2">{{old('descripcion',$practica->descripcion)}}</textarea>
            @error('descripcion')
            <span>
                <strong class="text-red-500">{{$message}}</strong>
            </span>
            @enderror
        </div>
        
        <div class="my-4 grid grid-cols-2 gap-4">
            <div>
                <label for="fecha_inicio">Fecha de inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="w-full" value="{{old('fecha_inicio',$practica->fecha_inicio)}}">
                @error('fecha_inicio')
                    <span>
                        <strong class="text-red-500">{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="fecha_fin">Fecha a Finalizar:</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="w-full" value="{{old('fecha_fin',$practica->fecha_fin)}}">
                @error('fecha_fin')
                    <span>
                        <strong class="text-red-500">{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div>
            <label for="file_practica">Adjunte Plan de Practicas:</label>
            <input type="file" name="file_practica" id="file_practica" class="w-full" value="{{old('file_practica',$practica->file_practica)}}">
            @error('file_practica')
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
                        <option value="{{$docente->id}}" {{ $docente->id==$alumno_practica->docente_id ? 'selected':''}}> {{$docente->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <hr class="my-3">

        <h2 class="font-bold">Voucher: </h2>

        <div class="mb-4">
            <div class="mb-2 grid grid-cols-2 gap-4">
                <div>
                    <label for="nro">Número de Operacion:</label>
                    <input type="text" name="nro" id="nro" class="w-full" value="{{old('nro',$practica->voucher->nro)}}">
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

        <hr class="my-3">
        <h2 class="font-bold">Empresa: </h2>
        <div class="mb-4">
            <div class="mb-2 grid grid-cols-2 gap-4">
                <div>
                    <label for="ruc">RUC:</label>
                    <input type="text" name="ruc" id="ruc" class="w-full" value="{{old('ruc',$practica->empresa->ruc)}}">
                    @error('ruc')
                        <span>
                            <strong class="text-red-500">{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div>
                    <label for="nombre">RAZON SOCIAL:</label>
                    <input type="text" name="nombre" id="nombre" class="w-full" value="{{old('nombre',$practica->empresa->nombre)}}">
                    @error('nombre')
                        <span>
                            <strong class="text-red-500">{{$message}}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div>
                <label for="representante">REPRESENTANTE:</label>
                <input type="text" name="representante" id="representante" class="w-full" value="{{old('representante',$practica->empresa->representante)}}">
                @error('representante')
                    <span>
                        <strong class="text-red-500">{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="my-2 grid grid-cols-2 gap-4">
                <div>
                    <label for="supervisor">SUPERVISOR:</label>
                    <input type="text" name="supervisor" id="supervisor" class="w-full" value="{{old('supervisor',$practica->empresa->supervisor)}}">
                    @error('supervisor')
                        <span>
                            <strong class="text-red-500">{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div>
                    <label for="telefono">TELEFONO:</label>
                    <input type="text" name="telefono" id="telefono" class="w-full" value="{{old('telefono',$practica->empresa->telefono)}}">
                    @error('telefono')
                        <span>
                            <strong class="text-red-500">{{$message}}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        
        
        <input type="submit" value="@if ($alumno_practica->status == 3) Solicitar @else Actualizar Informacion @endif" class="{{($alumno_practica->status == 3) ? 'bg-green-500 hover:bg-green-700' : 'bg-blue-500 hover:bg-blue-700' }} text-white font-bold py-2 px-4 rounded w-full mt-2 cursor-pointer">        
    
        </form>
    
    
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    <script>
        //CKEDITOR
            ClassicEditor
                .create( document.querySelector( '#descripcion' ), {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'blockQuote' ],
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                        ]
                    }
                } )
                .catch( error => {
                    console.log( error );
                } );
    </script>
    
</x-alumno-layout>