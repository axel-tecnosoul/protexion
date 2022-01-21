{{--ventanita modal cuando se haga clic en eliminar--}}
<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="modal fade modal-slide-in-right"
    aria-hidden="true"
    role="dialog"
    tabindex="-1"
    id="modal-agregarOrigen">


        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" ><i class="fa fa-industry" aria-hidden="true"></i> Agregar Nueva Procedencia</h3>
                </div>
                <div class="modal-body" style="color: black">
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">      
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" id="definicionOrigen" name="definicion" type="text" placeholder="nombre">
                        </div>     
                        <div class="form-group">
                            <label>Cuit</label>
                            <input class="form-control" id="cuitOrigen" name="cuit" type="text" placeholder="cuit">
                        </div>             
                        <div class="form-group">
                            <label>
                                Pais
                            </label>
                            <select
                                name="pais_idOrigen"
                                id="pais_idOrigen"
                                class="pais_idOrigen form-control"
                                >
                                <option
                                    value="0"
                                    disabled="true"
                                    selected="true"
                                    title="Seleccione un pais"
                                    >
                                    -Seleccione un pais-
                                </option>
                                @foreach ($paises as $pais)
                                    <option
                                        value="{{$pais->id }}">
                                            {{$pais->nombre}}
                                    </option>
                                @endforeach
                            </select>
                            <br>
                            <br>
                            <label>
                                Provincia
                            </label>
                            <select
                                name="provincia_idOrigen"
                                id="provincia_idOrigen"
                                class="provincia_idOrigen form-control"
                                >
                                <option
                                    value="0"
                                    disabled="true"
                                    selected="true"
                                    title="Seleccione una provincia"
                                    >
                                    -Seleccione una provincia-
                                </option>
                            </select>
                            <br>
                            <br>
                            <label>
                                Ciudad
                            </label>
                            <select
                                name="ciudad_idOrigen"
                                id="ciudad_idOrigen"
                                class="ciudad_idOrigen form-control"
                                >
                                <option
                                    value="0"
                                    disabled="true"
                                    selected="true"
                                    title="Seleccione una ciudad"
                                    >
                                    -Seleccione una ciudad-
                                </option>
                            </select>
                            <br>
                            <br>
                        </div>
                        
                  
                        <label>Domicilio</label>
                        <input class="form-control" id="direccionOrigen" name="direccionOrigen" type="text" placeholder="direccion">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="agregarOrigen" type="button" class="btn btn-danger">Guardar</button>
                    
                    @include('errors.request')
                </div>
            </div>
        </div>


         


</div>
@push('scripts')
<script type="text/javascript">
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
                    url:'{!!URL::to('paciente/create/encontrarProvincia')!!}',
                    data:{'id':pais_id},
                    success:function(data){
                        op+='<option value="0" selected disabled>-Seleccione una provincia-</option>';
                        for(var i=0;i<data.length;i++){
                            op+='<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                        }
                        div.find('.provincia_idOrigen').html(" ");
                        div.find('.provincia_idOrigen').append(op);
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
                    url:'{!!URL::to('paciente/create/encontrarCiudad')!!}',
                    data:{'id':provincia_id},
                    success:function(data){
                        op+='<option value="0" selected disabled>-Seleccione una ciudad-</option>';
                        for(var i=0;i<data.length;i++){
                            op+='<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                        }
                        div.find('.ciudad_idOrigen').html(" ");
                        div.find('.ciudad_idOrigen').append(op);
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

