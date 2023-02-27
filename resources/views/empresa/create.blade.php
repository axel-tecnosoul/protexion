@extends('layouts.admin')
<!-- Extiende de layout -->
@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/empresa">Indice de Empresa</a></li>
    <li class="breadcrumb-item active">Crear Empresa</li>
@endsection
@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        @include('errors.request')
        @include('empresa.mensaje')
        
        {!!Form::open(array('url'=>'empresa','method'=>'POST','autocomplete'=>'off'))!!}
        {{Form::token()}}

        <div class="card card-dark">
            <div class="card-header">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fa fa-building" aria-hidden="true"></i> Datos de la Empresa</p>
                </div>
            </div>
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="definicion"> Nombre</label>
                        <input
                            type="string"
                            name="definicion"
                            maxlength="30"
                            value="{{old('definicion')}}"
                            class="form-control"
                            placeholder="Ingrese el nombre..."
                            title="Introduzca un nombre"
                            required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="cuit">CUIT</label>
                        <input
                            type="string"
                            name="cuit"
                            maxlength="30"
                            value="{{old('cuit')}}"
                            class="form-control"
                            placeholder="Ingrese el cuit..."
                            title="Introduzca el cuit">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>Pais</label>
                        <select name="pais_idOrigen" id="pais_idOrigen" class="pais_idOrigen form-control">
                            <option value="0" disabled="true" selected="true" title="Seleccione un pais">-Seleccione un pais-</option>
                            @foreach ($paises as $pais)
                                <option value="{{$pais->id }}">{{$pais->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>Provincia</label>
                        <select name="provincia_idOrigen" id="provincia_idOrigen" class="provincia_idOrigen form-control">
                            <option value="0" disabled="true" selected="true" title="Seleccione una provincia">-Seleccione una provincia-</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>Ciudad</label>
                        <select name="ciudad_idOrigen" id="ciudad_idOrigen" class="ciudad_idOrigen form-control">
                            <option value="0" disabled="true" selected="true" title="Seleccione una ciudad">-Seleccione una ciudad-</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>Domicilio</label>
                        <input class="form-control" id="direccionOrigen" name="direccionOrigen" type="text" placeholder="direccion">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group" style="text-align:center">
        <a href="/protexion/public/empresa">
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
    var select1 = $("#provincias_id").select2({width:'100%'});
    select1.data('select2').$selection.css('height', '100%');
  });

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

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });


  $(document).ready(function(){
    var select16 = $("#pais_idOrigen").select2({width:'100%'});
    select16.data('select2').$selection.css('height', '100%');
    var select17 = $("#provincia_idOrigen").select2({width:'100%'});
    select17.data('select2').$selection.css('height', '100%');
    var select18 = $("#ciudad_idOrigen").select2({width:'100%'});
    select18.data('select2').$selection.css('height', '100%');

    $(document).on('change','.pais_idOrigen',function(){
      var pais_id=$(this).val();
      var div=$(this).parent();
      var op=" ";

      $.ajax({
        type:'get',
        //url:'{!!URL::to('paciente/create/encontrarProvincia')!!}',
        url:'<?php echo URL::to('paciente/create/encontrarProvincia')?>',
        data:{'id':pais_id},
        success:function(data){
          console.log(data);
          op+='<option value="0" selected disabled>-Seleccione una provincia-</option>';
          for(var i=0;i<data.length;i++){
            op+='<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
          }
          //div.find('.provincia_idOrigen').html(" ");
          $('.provincia_idOrigen').html(" ");
          //div.find('.provincia_idOrigen').append(op);
          $('.provincia_idOrigen').append(op);
        },
        error:function(){
        }
      });
    });

    $(document).on('change','.provincia_idOrigen',function(){
      var provincia_id=$(this).val();
      var div=$(this).parent();
      var op=" ";

      $.ajax({
        type:'get',
        //url:'{!!URL::to('paciente/create/encontrarCiudad')!!}',
        url:'<?php echo URL::to('paciente/create/encontrarCiudad')?>',
        data:{'id':provincia_id},
        success:function(data){
          op+='<option value="0" selected disabled>-Seleccione una ciudad-</option>';
          for(var i=0;i<data.length;i++){
            op+='<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
          }
          /*div.find('.ciudad_idOrigen').html(" ");
          div.find('.ciudad_idOrigen').append(op);*/
          $('.ciudad_idOrigen').html(" ");
          $('.ciudad_idOrigen').append(op);
        },
        error:function(){
        }
      });
    });

    $("#agregarOrigen").click(function() {
      var definicion = $("#definicionOrigen").val();
      var cuit = $("#cuitOrigen").val();
      var direccion = $("#direccionOrigen").val();
      var ciudad_id = $("#ciudad_idOrigen").val();

      $.ajax({
        type:'POST',
        url:"{{ route('origen.ajaxGuardar') }}",
        data:{'definicion':definicion, 'cuit':cuit, 'ciudad_idOrigen':ciudad_id, 'direccionOrigen':direccion},
        success:function(data){
          $("#origen_id").append('<option value=' + data.id + '>' + data.definicion + '</option>');
          $('#modal-agregarOrigen').modal('hide') //ocultamos el modal
          toastr.success("Procedencia " + data.definicion + " registrada correctamente");
        },
        error:function(){
          toastr.error('no se pudo guardar');
        }
      });
    });

  });
</script>

@endpush

@endsection