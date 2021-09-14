@extends('adminlte::page')
@section('title', 'Practicas Pendientes')
@section('content_header')
    <div class="d-flex">
        <h1 class="mr-auto">Solicitud de Practica</h1>
    </div>    
    <hr class="mt-3">
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <h2 class="my-5 font-weight-bold text-center"> PLAN DE PRACTICA </h5>
        <div class="row gx-2">
            <!--ASIDE-->
            <div class="col-4">

                <div class="text-center">
                    <img class="h-16 w-16 rounded-circle img-fluid" style="width: 200px" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div><br><br>

                <hr class="my-3 mx-4">

                <div class="text-center">
                    <h5 class="pb-3 font-weight-bold">INFORMACION DEL ALUMNO </h5>

                    <p><span class="font-weight-bold">Código de matricula</span> <br> 
                        {{$practica->alumno_codigo}}</p>

                    <p><span class="font-weight-bold">Apellidos y Nombres</span> <br> 
                        {{$practica->apellido.' '.$practica->nombre}}</p>
                
                </div>        
                <hr class="my-3 mx-4">
                <div class="text-center">
                    <h5 class="pb-3 font-weight-bold">CONTACTO </h5>
                    <p><span class="font-weight-bold"> Email</span> <br>
                    {{$practica->email}}</p>

                    <p><span class="font-weight-bold">Télefono</span> <br>
                        {{$practica->telefono}}</p>  
                </div>
            </div>  

            <div class="col-8 px-3">

                <!--PRACTICA-->
                @if ($practica->status ==5)
                <h5 class="font-weight-bold">INFORME FINAL</h5>
                <div class="d-flex justify-content-center">                    
                    <a href="{{$practica->file_informe_final}}" class="button" download><i class="fa fa-download"></i> Revisar informe Final</a>
                </div>

                <hr class="my-3 mx-3">
                @endif

                <h5 class="font-weight-bold">Asesor</h5>
                <p class="form-control"> {{$practica->docente}} </p> 
                
                <hr class="my-3 mx-3">

                <h5 class="font-weight-bold">Asunto</h5>
                {!!$practica->descripcion!!}

                <span class="font-weight-bold">Fecha de Incio:</span>
                <p class="form-control"> {{$practica->fecha_inicio}} </p> 
                <span class="font-weight-bold">Fecha de Fin:</span>
                <p class="form-control"> {{$practica->fecha_fin}} </p>

                <div class="d-flex justify-content-center">                    
                    <a href="{{$practica->file_practica}}" class="button" download><i class="fa fa-download"></i> Descargar Plan de Practica</a>
                </div>

                <hr class="my-3 mx-3">

                <!--VOUCHER-->
                <h5 class="font-weight-bold pb-3"> Voucher </h5>

                <span class="font-weight-bold">Numero de Operacion: </span>
                <p class="form-control"> {{$practica->nro}} </p>

                <div class="d-flex justify-content-center">                    
                    <a href="{{$practica->file_voucher}}" class="button" download><i class="fa fa-download"></i> Descargar Voucher</a>
                </div>

                <hr class="my-3 mx-3">


                <!--PRACTICA-->
                <h5 class="font-weight-bold pb-3"> Empresa</h5>
                <span class="font-weight-bold">Numero de Operacion: </span>
                <p class="form-control">{{$practica->ruc}}</p>

                <span class="font-weight-bold">Razon Social: </span>
                <p class="form-control">{{$practica->razonsocial}}</p>

                <span class="font-weight-bold">Representatne Legal: </span>
                <p class="form-control">{{$practica->representante}}</p>

                <span class="font-weight-bold">Supervisor del Academico: </span>
                <p class="form-control">{{$practica->supervisor}}</p>

                <span class="font-weight-bold">Telefono del Supervisor: </span>
                <p class="form-control">{{$practica->e_telefono}}</p>
            </div>
        </div>
        <div class="d-flex text-center justify-content-center">
            @php
                //SI ES ESTADO ES 5 (ENVIO INFORME FINAL)
                if($practica->status == 5 ) {$estado= 5;} else {$estado= 3;}
            @endphp
                <form action="{{route('admin.practica.aprobar',['id'=>$practica->id,'alumno' =>$practica->alumno_codigo,'estado' =>$estado])}}" method="POST">
                    @csrf
                    <input type="submit" value="APROBAR" class="btn btn-success mx-2">
                </form>

                <button type="button" class="btn btn-danger mx-2" data-toggle="modal" data-target="#exampleModal">
                    DENEGAR
                </button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Mandar Correcciones</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="p-2">
            <form action="{{route('admin.practica.denegar',['id'=>$practica->id,'alumno' =>$practica->alumno_codigo,'estado' =>$estado])}}" method="post">
                @csrf
                <label for="descripcion">Observaciones:</label>
                <textarea name="descripcion" id="descripcion" cols="30" rows="10" class="mb-2"></textarea>
                @error('descripcion')
                <span>
                    <strong class="text-red-500">{{$message}}</strong>
                </span>
                @enderror
                <input type="submit" value="Enviar" class="btn btn-success w-full btn-block mt-2">
            </form>
        </div>
        
      </div>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    
@stop

@section('js')
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
    <script> console.log('Hi!'); </script>
@stop
