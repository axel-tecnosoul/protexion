{{--ventanita modal cuando se haga clic en eliminar--}}

<div class="modal fade modal-slide-in-right"
     aria-hidden="true"
     role="dialog"
     tabindex="-1"
     id="modal-delete-{{$empresa->id}}">

     <!-- <form action="{{route('empresa.destroy',$empresa->id)}}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i></button>
                            </form> -->

     {{Form::Open(array(
        'action'=>array('EmpresaController@delete',$empresa->id),
        'method'=>'get'
        ))}}

        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#C82333">
              <h3 class="modal-title" style="color: white"><i style="color: white" aria-hidden="true"></i> Eliminar</h3>
            </div>
            <div class="modal-body" style="color: black">
              <p style="font-size:120%">¿Desea dar de baja la empresa <b>{{$empresa->definicion}}</b>?</p>
              <!-- <hr>
              <p style="font-size:120%"><i class="fa fa-question-circle" style="color: blue"></i> <?php //echo $empresa->existeReferencia()?></p> -->
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

