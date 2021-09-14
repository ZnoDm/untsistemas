@extends('adminlte::page')
@section('title', 'Asignar Fecha')

@section('content')
    <div class="p-5">
        <form action="{{route('admin.tesis.asignando_fecha')}}" method="post">
            @csrf
            <h5 class="font-weight-bold">Titulo</h5>
            <p class="form-control"> {{$tesis->titulo}} </p> 
            <h5 class="font-weight-bold text-center">ASIGNAR FECHA DE SUSTENTACION </h5>

            <hr class="my-3 mx-3">
            <input type="hidden" name="tesis_id" value="{{$tesis->id}}">
            <input type="hidden" name="codigo" value="{{$tesis->alumno_codigo}}">
            <div class="row px-5 mb-5"> 
                <input type="date" name="sustentacion" id="sustentacion" class="form-control w-25 mx-auto is-invalid" value="{{old('sustentacion')}}">
                @error('sustentacion')
                    <div class="invalid-feedback text-center">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <input type="submit" value="ASIGNAR" class="btn btn-success w-100">
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    
@stop

