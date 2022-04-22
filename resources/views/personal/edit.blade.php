@extends('layouts.admin')
  <!-- Extiende de layout -->
@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/personal">Indice de Personal</a></li>
    <li class="breadcrumb-item active">Editar Personal</li>
@endsection
@section('content')

<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        @include('errors.request')
        @include('personal.mensaje')

        {!!Form::model($personal, ['method'=>'PATCH','route'=>['personal.update',$personal->id],'files' => true,])!!}
        {{Form::token()}}

        <div class="card card-dark">
            <div class="card-header">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fa fa-user" aria-hidden="true"></i> Editar Personal</p>
                </div>
            </div>
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input 
                            type="string"
                            name="nombres"
                            value="{{ $personal->nombres}}"
                            class="form-control"
                            title="nombre de la persona"
                            onkeypress="return soloLetras(event)">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="apellidos"> Apellido </label>
                        <input 
                            type="string"
                            name="apellidos"
                            value="{{ $personal->apellidos }}"
                            class="form-control"
                            title="apellido de la persona"
                            onkeypress="return soloLetras(event)">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="documento">Documento</label>
                        <input
                            type="integer"
                            name="documento"
                            id="documento"
                            value="{{ $personal->documento }}"
                            class="form-control"
                            title="documento de la persona"
                            onkeypress="return soloNumeros(event)">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de nacimiento</label>
                        <input
                            type="date"
                            name="fecha_nacimiento"
                            value="{{ $personal->fecha_nacimiento }}"
                            class="form-control"
                            title="fecha de nacimiento de la persona">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>
                            Sexo
                        </label>
                        <select
                            id="sexo_id"
                            name="sexo_id"
                            class="form-control">
                                @foreach ($sexos as $sexo)
                                    @if ($sexo->id==$personal->sexo_id)
                                        <option value="{{$sexo->id}}" selected>{{$sexo->definicion}}</option> 
                                    @else
                                        <option value="{{$sexo->id}}">{{$sexo->definicion}}<option>
                                    @endif
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

      </div>
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
          <div class="card card-dark">
            <div class="card-header">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fa fa-id-card" aria-hidden="true"></i> Datos Laborales</p>
                </div>
            </div>
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label> Puesto</label>
                            <select
                                name="puesto_id"
                                id="puesto_id"
                                class="puesto_id form-control"
                                required
                                >
                                <option
                                    value="0"
                                    disabled="true"
                                    selected="true"
                                    title="Seleccione un puesto"
                                    >
                                    -Seleccione un puesto-
                                </option>
                                @foreach ($puestos as $puesto)
                                    @if ($puesto->id==$personal->puesto_id)
                                        <option value="{{$puesto->id}}" selected>{{$puesto->nombre}}</option> 
                                    @else
                                    <option value="{{$puesto->id }}">{{$puesto->nombre}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label>
                                Especialidad
                            </label>
                            <select
                                name="especialidad_id"
                                id="especialidad_id"
                                class="especialidad_id form-control"
                                required
                                >
                                <option
                                    value="0"
                                    disabled="true"
                                    selected="true"
                                    title="Seleccione una especialidad"
                                    >
                                    -Seleccione una especialidad
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="nro_matricula"> Matricula</label>
                            <!-- old('nro_matricula') -->
                            <input
                                type="string"
                                name="nro_matricula"
                                maxlength="30"
                                value="{{$personal->nro_matricula}}"
                                class="form-control"
                                placeholder="Ingrese la matricula..."
                                title="Introduzca la matricula">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card-body">
                            <div class="form-group"><?php
                            //echo (public_path('imagenes/firmas/'.$personal->foto));
                            $classSelectFirma="";
                            $classPreview="d-none";
                            if($personal->foto){
                              $classSelectFirma="d-none";
                              $classPreview="";
                            }?>
                                <label for="foto">Firma</label>
                                <div id="select_firma" class="input-group <?=$classSelectFirma?>">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-file-image" aria-hidden="true"></i></span>
                                    </div>
                                    <input
                                        id="file"
                                        type="file"
                                        name="foto"
                                        class="form-control img-responsive">
                                </div>
                                <div id="preview" class="<?=$classPreview?>">
                                  @if ($personal->foto)
                                    <!-- <img src="{{public_path('imagenes/firmas/'.$personal->foto)}}" width="130" height="130" alt="firma del médico"> -->
                                    <img src="{{'../../../public/imagenes/firmas/'.$personal->foto}}" width="130" height="130" alt="firma del médico">
                                  @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    <input type="hidden" name="firma" id="firma">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group" style="text-align:center">
        <label>

        </label>
        <br>
        <a href="/protexion/public/personal">
            <button title="Cancelar" class="btn btn-secondary btn-lg" type="button"><i class="fas fa-arrow-left"></i> Cancelar</button>
        </a>
        <button title="Guardar" id="confirmar" class="btn btn-danger btn-lg" type="submit"> <i class="fa fa-check"></i> Guardar</button>
    </div>
</div>
    
</div>

{!!Form::close()!!}

    @push('scripts')
    <script type="text/javascript">    
        $(document).ready(function(){
            var select1 = $("#sexo_id").select2({width:'100%'});
            select1.data('select2').$selection.css('height', '100%');

            var select2 = $("#puesto_id").select2({width:'100%'});
            select2.data('select2').$selection.css('height', '100%');

            var select3 = $("#especialidad_id").select2({width:'100%'});
            select3.data('select2').$selection.css('height', '100%');

            $(document).on('change','.puesto_id',function(){
                var puesto_id=$(this).val();
                var div=$(this).parent();
                var op=" ";

                $.ajax({
                    type:'get',
                    url:'{!!URL::to('personal/create/encontrarEspecialidad')!!}',
                    data:{'id':puesto_id},
                    success:function(data){
                        op+='<option value="0" selected disabled>-Seleccione una especialidad-</option>';
                        for(var i=0;i<data.length;i++){
                          let selected="";
                          if("{{$personal->especialidad_id}}"==data[i].id){
                            selected="selected";
                          }
                            op+='<option value="'+data[i].id+'" '+selected+'>'+data[i].nombre+'</option>';
                        }
                        div.find('.especialidad_id').html(" ");
                        div.find('.especialidad_id').append(op);
                    },
                    error:function(){
                    }
                });
            });

            if("{{$personal->puesto_id}}"==3){
              $(".puesto_id").change();
            }

            $('#documento').mask('00.000.000');
        });
    </script>

<script>
    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = [8, 37, 39, 46];
    
        tecla_especial = false
        for(var i in especiales) {
            if(key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }
    
        if(letras.indexOf(tecla) == -1 && !tecla_especial)
            return false;
    }
</script>

<script>
    function soloNumeros(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key);
        letras = " 1234567890";
        especiales = [8, 37, 39, 46];
    
        tecla_especial = false
        for(var i in especiales) {
            if(key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }
    
        if(letras.indexOf(tecla) == -1 && !tecla_especial)
            return false;
    }
</script>

@endpush

@endsection

