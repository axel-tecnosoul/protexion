@extends('layouts.admin')

@section('navegacion')
    <li class="breadcrumb-item"><a href="/audiometrias">Indice de audiometría</a></li>
    <li class="breadcrumb-item active">Formulario de Audiometría</li>
@endsection

@section('content')
    {!!Form::open(array(
        'url'=>'audiometrias',
        'method'=>'POST',
        'autocomplete'=>'off',
        'files' => true,
    ))!!}

    {{Form::token()}}

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header header-bg">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fas fa-stethoscope"></i>Formulario de Audiometría</p>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <!-- Seleccionar Voucher -->
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>Seleccionar Voucher</label>
                            <select
                                name="voucher_id"
                                id="voucher_id"
                                class="voucher_id custom-select"
                                >
                                <option
                                    value="0"
                                    disabled="true"
                                    selected="true"
                                    title="-Seleccione un paciente-">
                                    -Seleccione un voucher-
                                </option>
                                @foreach ($vouchers as $voucher)
                                    <option value="{{$voucher->id }}">{{$voucher->voucherPaciente()}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                <!-- / Seleccionar paciente -->
                <!-- Datos del paciente -->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card card-dark "> <!--collapsed-card -->
                            <div class="card-header">
                                <h3 class="card-title">Datos del Paciente</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body" > <!--style="display: none;" -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="datos_paciente" class="form-group">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="foto_paciente" class="form-group">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- / Datos del paciente -->

                </div>
            </div>
        <!-- Guardar -->
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
                <div class="form-group">
                    <input id="guardar" name="_token" value="{{ csrf_token() }}" type="hidden">
                        <button class="btn btn-success btn-lg btn-block" id="confirmar"type="submit"><i class="fa fa-check"> </i>Cargar al formulario</button>
                </div>
            </div>
        <!-- / Guardar -->
        </div>
    </div>

    {!!Form::close()!!}

    @push('scripts')
        <script>
        
        $(document).ready(function(){
            
            //Voucher
                var select1 = $("#voucher_id").select2({width:'100%'});
                select1.data('select2').$selection.css('height', '34px');
    
    
                $("#voucher_id").change(function(){
                    mostrarDatos();
                });
    
                function mostrarDatos()
                {
                    voucher_id=$("#voucher_id").val();
                    vouchers=$("#voucher_id option:selected").text();
                    
    
    
                    /*   Aca iría el Ajax para obtener la cantidad por Paquete*/
                    $.ajax({
                        type:'get',
                        url:'{!!URL::to('declaracion_jurada/create/traerDatosPaciente')!!}',
                        data:{'id':voucher_id},
                        success:function(data){
    
                            documento=data['documento'];
                            nombres=data['nombres'];
                            apellidos=data['apellidos'];
                            fecha_nacimiento=data['fecha_nacimiento'];
                            foto=data['foto'];
                            cuil=data['cuil'];
                            sexo=data['sexo'];
    
    
                            datosPaciente='<div class="added"> <input type="hidden" value="'+nombres+'"><p style="font-size:140%" class="text-left">Nombre y Apellido del paciente: '+nombres+'</p><input type="hidden" value="'+documento+'"><p style="font-size:140%" class="text-left">Documento del paciente: '+documento+'</p><input type="hidden" value="'+fecha_nacimiento+'"><p style="font-size:140%" class="text-left">Fecha de nacimiento del paciente: '+fecha_nacimiento+'</p><input type="hidden"  value="'+cuil+'"><p style="font-size:140%" class="text-left">CUIL: '+cuil+'</p><input type="hidden" value="'+sexo+'"><p style="font-size:140%" class="text-left">Sexo: '+sexo+'</p><input type="hidden" name="voucher_id" value="'+voucher_id+'"></div>';
                            fotoPaciente='<div class="added"> @if('+foto+'==null)<img class="img-thumbnail" height="85px" width="85px" src='+foto+'>@else<img class="img-thumbnail" height="350px" width="350px" src="{{ asset('imagenes/paciente/default.png')}}">@endif </div>';
    
                            //Limpiar datos agregadoss
                            $('.added').remove();
                            
                            $("#datos_paciente").append(datosPaciente).hide().show('slow');
                            $("#foto_paciente").append(fotoPaciente).hide().show('slow');
                        },
                        error:function(){
                            console.log('no anda AJAX');
                        }
                    });
    
                }
                function eliminarDelSelect2 ()
                {
                    $("#voucher_id option:selected").remove();
    
                }
            // 
        
        });  
        </script>
    
    @endpush
@endsection
