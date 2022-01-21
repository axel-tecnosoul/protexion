{{--ventanita modal cuando se haga clic en eliminar--}}


<div class="modal fade modal-slide-in-right"
     aria-hidden="true"
     role="dialog"
     tabindex="-1"
     id="modal-rehabilitar-{{$pacientesEliminado->id}}">


     {{Form::Open(array(
        'action'=>array('PacienteController@restaurar',$pacientesEliminado->id),
        'method'=>'get'
        ))}}

        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header" style="background-color:blue">
              <h3 class="modal-title" style="color: white"><i style="color: white" class="fa fa-question" aria-hidden="true"></i> Restaurar</h3>

              </div>
              <div class="modal-body" style="color: black">
                <p style="font-size:120%">¿Desea restaurar al paciente <b>{{$pacientesEliminado->nombres}}</b>?</p>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Confirmar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                @include('errors.request')


              </div>
            </div>
          </div>


          {{Form::Close()}}


</div>

