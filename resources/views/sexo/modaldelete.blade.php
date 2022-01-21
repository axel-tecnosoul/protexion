{{--ventanita modal cuando se haga clic en eliminar--}}


<div class="modal fade modal-slide-in-right"
     aria-hidden="true"
     role="dialog"
     tabindex="-1"
     id="modal-delete-{{$sexo->id}}">


     {{Form::Open(array(
        'action'=>array('SexoController@destroy',$sexo->id),
        'method'=>'delete'
        ))}}

        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header" style="background-color:red">
              <h3 class="modal-title" style="color: white"><i style="color: white" class="fa fa-exclamation-triangle" aria-hidden="true"></i> Eliminar</h3>
               
              </div>
              <div class="modal-body" style="color: black">
                <p style="font-size:120%">¿Desea eliminar el sexo <b>{{$sexo->descripcion}}</b>?</p>
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

