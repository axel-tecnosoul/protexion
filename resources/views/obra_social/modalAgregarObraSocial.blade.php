{{--ventanita modal cuando se haga clic en eliminar--}}
<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="modal fade modal-slide-in-right"
     aria-hidden="true"
     role="dialog"
     tabindex="-1"
     id="modal-agregarObraSocial">


        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:black">
                    <h3 class="modal-title" style="color: white"><i class="fa fa-credit-card" aria-hidden="true"></i> Agregar Obra Social</h3>
                </div>
                <div class="modal-body" style="color: black">
                    <div class="form-group">
                        <label>Definicion</label>
                        <input class="form-control" id="definicionObra" name="definicion" type="text" placeholder="nombre de la obra social">
                    </div>
                    <div class="form-group">
                        <label>Abreviatura</label>
                        <input class="form-control" id="abreviaturaObra" name="abreviatura" type="text" placeholder="abreviatura de la Obra social">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="agregarObra" type="button" class="btn btn-danger">Guardar</button>
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




        $("#agregarObra").click(function() {

            var definicion = $("#definicionObra").val();
            var abreviatura = $("#abreviaturaObra").val();

            //var definicion = $("input[name=definicion]").val();
            //var abreviatura = $("input[name=abreviatura]").val();


            $.ajax({
                type:'POST',
                url:"{{ route('obra_social.ajaxGuardar') }}",
                data:{'definicion':definicion, 'abreviatura':abreviatura},
                success:function(data){
                  
                    $("#obra_social_id").append('<option value=' + data.id + '>' + data.abreviatura + ' - ' + data.definicion + '</option>');
                   
                    $('#modal-agregarObraSocial').modal('hide') //ocultamos el modal
                    toastr.success("Obra social " + data.definicion + " registrada correctamente");

                },
                error:function(){
                    toastr.error('Ingresó valores que exceden lo permitido');
                }
            });

            

        });




    });


</script>
@endpush

