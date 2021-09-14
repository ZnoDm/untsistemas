@extends('adminlte::page')

@section('title', 'Sustentaciones')

@section('content_header')
    <h1>Sustentaciones</h1>
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
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tesis as $te)
                    <tr>
                        <td>{{$te->id}}</td>
                        <td>{{$te->codigo}}</td>
                        <td>
                            @if ($te->status == 8)
                                POR DEFINIR
                            @else
                                {{$te->sustentacion}}
                            @endif
                            
                        </td>
                        <td>
                            @if ($te->status == 8)
                                
                            <a href="{{route('admin.tesis.asignar_fecha',$te->id)}}" class="btn btn-warning">ASIGNA FECHA</a>
                            @else
                                
                            <a href="{{route('admin.tesis.calificar',$te->id)}}" class="btn btn-primary">CALIFICAR</a>
                            @endif
                        </td>
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
