{{--ventanita modal cuando se haga clic en clonar--}}

<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-clonar-{{$voucher->id}}">
  <div class="modal-dialog" role="document">
    <form action="{{route('voucher.clonar',$voucher->id)}}" method="POST" style="display:inline;">
      @csrf
        <div class="modal-content">
          <div class="modal-header fondo2">
            <h3 class="modal-title" style="color: white"> Clonar</h3>
          </div>
          <div class="modal-body" style="color: black">
            <div class="row mb-4">
              <div class="col-12">
                <p style="font-size:120%">Clonar visita de <b>{{ $voucher->paciente->nombreCompleto() }}</b> del día <b>{{ \Carbon\Carbon::parse($voucher->turno)->format('d/m/Y') }}</b>?</p>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-3" style="align-self: center;">Paciente:</div>
              <div class="col-6">
                <select name="paciente_id" id="paciente_id" class="paciente_id custom-select" required>
                  <option value="0" disabled="true" selected="true" title="-Seleccione un paciente-">-Seleccione un paciente-</option>
                  @foreach ($pacientes as $paciente)
                    <option
                      @if ($paciente->id == $voucher->paciente_id)
                        {{"selected"}}
                      @endif
                      value="{{$paciente->id }}">{{$paciente->nombreCompleto()}}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-3" style="align-self: center;">Turno:</div>
              <div class="col-6">
                <input type="date" name="turno" id="turno" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-arrow-left"></i> Cancelar</button>
              <!-- <button type="submit" class="btn fondo1 btn-responsive"><i class="fa fa-fw fa-trash"></i></button> -->
              <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Confirmar</button>
            @include('errors.request')
          </div>
        </div>
      </form>
    </div>

</div>

