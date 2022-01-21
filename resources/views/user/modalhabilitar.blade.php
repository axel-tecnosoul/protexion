{{--ventanita modal cuando se haga clic en eliminar--}}


<div class="modal fade modal-slide-in-right"aria-hidden="true"role="dialog" tabindex="-1"id="modal-habilitar-{{$user->id}}">

  {{Form::Open(array(
    'action'=>array('UserController@restaurar',$user->id),
    'method'=>'get'
  ))}}

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#138496">
        <h3 class="modal-title" style="color: white"><i style="color: white" class="fas fa-personal-plus" aria-hidden="true"></i> Habilitar</h3>
      </div>
      <div class="modal-body" style="color: black">
        <p style="font-size:120%">¿Desea habilitar al usuario <b>{{$user->name}}</b>?</p>
        <hr>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-arrow-left"></i> Cancelar</button>
        <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Confirmar</button>
        @include('errors.request')
      </div>
    </div>
  </div>


  {{Form::Close()}}


</div>

