@extends('adminlte::page')

@section('title', 'Tesis Pendientes')

@section('content_header')
    <h1>Pendientes de Aprobación</h1>
@stop

@section('content')
<hr class="mt-3">
@if (session('info'))
    <div class="alert alert-success mt-2" x-data="{open:true}" x-show="open">
        {{session('info')}}
    </div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>COD Alumno</th>
                    <th>Solicitud</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tesis as $te)
                    <tr>
                        <td>{{$te->id}}</td>
                        <td>{{$te->codigo}}</td>
                        <td> 
                            @if ($te->status ==1)
                                SOLICITUD DE TESIS
                            @else
                                INFORME FINAL DE TESIS
                            @endif
                        </td>
                        <td><a href="{{route('admin.tesis.revision',$te->id)}}" class="btn btn-primary">Revisar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
