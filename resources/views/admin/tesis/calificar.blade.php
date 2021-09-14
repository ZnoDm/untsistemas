@extends('adminlte::page')
@section('title', 'Calificar')

@section('content')
    <div class="p-5">
        <h3 class="font-bold text-center">CALIFICACIONES DE JURADOS</h3>
        <form action="{{route('admin.tesis.calificando')}}" method="post">
            @csrf
            @php
                $array[] = "";
                
            @endphp
            @foreach ($jurados as $jurado)
                @php
                    array_push($array, $jurado->nombre);
                @endphp
            @endforeach
            <input type="hidden" name="tesis_id" value="{{$tesis->id}}">
            <input type="hidden" name="codigo" value="{{$tesis->alumno_codigo}}">
            <div class="pb-3">  
            <p class="form-control">{{$array[1]}}</p>
            <label for="">Nota 1:</label>
            <input type="text" id="nota1" name="nota1" class="is-invalid" onKeyPress="return soloNumeros(event)">
            @error('nota1')
                <div class="invalid-feedback">
                        {{$message}}
                </div>
            @enderror
            </div>

            <div class="pb-3">         
            <p class="form-control">{{$array[2]}}</p>
            <label for="">Nota 2:</label>
            <input type="text" id="nota2" name="nota2" class="is-invalid" onKeyPress="return soloNumeros(event)">
            @error('nota2')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
            </div>
            
            <div class="pb-3">
            <p class="form-control">{{$array[3]}}</p>
            <label for="">Nota 3:</label>
            <input type="text" id="nota3" name="nota3" class="is-invalid" onKeyPress="return soloNumeros(event)">
            @error('nota3')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            </div>
            <br> <br>
            <input type="submit" value="Enviar" class="btn btn-success w-100">
        </form>
    </div>
    <script type="text/javascript">
        // Solo permite ingresar numeros.
        function soloNumeros(e){
            var key = window.Event ? e.which : e.keyCode
            return (key >= 48 && key <= 57)
        }
    </script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    
@stop

