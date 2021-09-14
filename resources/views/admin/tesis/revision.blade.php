@extends('adminlte::page')
@section('title', 'Tesis Pendientes')
@section('content_header')
    <div class="d-flex">
        <h1 class="mr-auto">Solicitud de Tesis</h1>
    </div>    
    <hr class="mt-3">
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <h2 class="my-5 font-weight-bold text-center"> TESIS </h5>
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
                        {{$tesis->alumno_codigo}}</p>

                    <p><span class="font-weight-bold">Apellidos y Nombres</span> <br> 
                        {{$tesis->apellido.' '.$tesis->nombre}}</p>
                
                </div>        
                <hr class="my-3 mx-4">
                <div class="text-center">
                    <h5 class="pb-3 font-weight-bold">CONTACTO </h5>
                    <p><span class="font-weight-bold"> Email</span> <br>
                    {{$tesis->email}}</p>

                    <p><span class="font-weight-bold">Télefono</span> <br>
                        {{$tesis->telefono}}</p>  
                </div>
            </div>  

            <div class="col-8 px-3">

                <!--tesis-->

                <h5 class="font-weight-bold">Titulo</h5>
                <p class="form-control"> {{$tesis->titulo}} </p> 

                <span class="font-weight-bold">Fecha de Incio:</span>
                <p class="form-control"> {{$tesis->fecha_inicio}} </p> 
                <span class="font-weight-bold">Fecha de Fin:</span>
                <p class="form-control"> {{$tesis->fecha_fin}} </p> 

                <div class="d-flex justify-content-center">                    
                    <a href="{{$tesis->file_tesis}}" class="button" download><i class="fa fa-download"></i> Descargar Carpeta de Tesis</a>
                </div>

                <hr class="my-3 mx-3">
                @if ($tesis->status ==5)
                    <h5 class="font-weight-bold">INFORME FINAL</h5>
                    <div class="d-flex justify-content-center">                    
                        <a href="{{$tesis->file_informe_final}}" class="button" download><i class="fa fa-download"></i> Revisar informe Final</a>
                    </div>

                    <hr class="my-3 mx-3">
                @endif
                
                <!--VOUCHER-->
                <h5 class="font-weight-bold pb-3"> Voucher </h5>

                <span class="font-weight-bold">Numero de Operacion: </span>
                <p class="form-control"> {{$tesis->nro}} </p>

                <div class="d-flex justify-content-center">                    
                    <a href="{{$tesis->file_voucher}}" class="button" download><i class="fa fa-download"></i> Descargar Voucher</a>
                </div>

            </div>
        </div>
        @php
                if($tesis->status == 5 ) {$estado= 5;} else {$estado= 1;}
        @endphp
        <form action="{{route('admin.tesis.aprobar',['id'=>$tesis->id,'alumno' =>$tesis->alumno_codigo,'estado' =>$estado])}}" method="POST">
            @csrf

            @if ($tesis->status ==5)
            
               
                
                <h5 class="font-weight-bold text-center">ASIGNAR JURADO</h5>
                <div class="row px-5">
                    <select name="docente_id" id="docente_id" class="form-control w-100" aria-label=".form-select-lg example" onchange="agregar();">
                            <option value="">SELECCIONA UN DOCENTE</option>
                            @foreach($docentes as $docente)
                                <option value="{{$docente->id}}_{{$docente->nombre}}">{{$docente->nombre}}</option>
                            @endforeach
                    </select>
                    <br> <br>
                    <table class="table" id="detalle">
                        <tr>
                            <th scope="col">CODIGO</th>
                            <th scope="col">DOCENTE</th>
                            <th scope="col">ACCION</th>
                        </tr>
                    </table>

                    
                </div>
            @endif
        <div class="d-flex text-center justify-content-center">
            
                <input @if ($tesis->status ==5)
                disabled
                @endif  type="submit" class="btn btn-success mx-2" id="submit"  value="APROBAR">
                <button type="button" class="btn btn-danger mx-2" data-toggle="modal" data-target="#exampleModal">
                    DENEGAR
                </button>
        </div>
    </form>
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
            <form action="{{route('admin.tesis.denegar',['id'=>$tesis->id,'alumno' =>$tesis->alumno_codigo,'estado' =>$estado])}}" method="post">
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
<script type="text/javascript">
    var indice=0;
    let temporal=[];
    var suma_jurados=0;
    function agregar()
    {		
        docente=document.getElementById('docente_id').value.split('_');
        if(temporal.indexOf(docente[0])>-1){
            alert('Ya has asignado este jurado');
        }
        else{
            suma_jurados = suma_jurados + 1;
            if(suma_jurados>3){
                suma_jurados = suma_jurados - 1;
                alert('Solo se asignan 3 jurados');
            }else{
                if(docente[1] ==undefined){
                    
                    suma_jurados = suma_jurados - 1;
                    alert('Seleccione un docente');
                }
                else{
                    temporal[indice] = docente[0];		
                fila='<tr id="fila'+indice+'"><td><input type="hidden" name="docente_ids[]" value="'+docente[0]+'">'+docente[0]+'</td><td>'+docente[1]+'</td><td><a href="#" onclick="quitar('+indice+')" style="color:red;"><i class="far fa-trash-alt"></i></a></td></tr>';
                $('#detalle').append(fila);

                document.getElementById('submit').disabled=false;
                indice++;

                console.log(temporal);
                }
                

            }
        }
        console.log(suma_jurados);
    }	

    function quitar(item)
    {
        
        temporal.splice(item, 1);
        console.log(temporal);
        $('#fila'+item).remove();
        indice--;
        suma_jurados = suma_jurados - 1;
        if(suma_jurados === 0){
            document.getElementById('submit').disabled=true;
        }
        console.log(suma_jurados);
    }
</script>
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
    
@stop
