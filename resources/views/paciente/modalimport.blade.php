{{--ventanita modal cuando se haga clic en eliminar--}}


<div class="modal fade modal-slide-in-right"
    aria-hidden="true"
    role="dialog"
    tabindex="-1"
    id="modal-import">

    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header fondo2">
                <h3 class="modal-title">Importar Lista de Pacientes </h3>
            </div>
            <div class="modal-body">
                <form action="{{ route('pacientes.import.excel') }}" method="post" enctype="multipart/form-data">
                    @csrf            
                    <input type="file" name="file" placeholder="seleccione un archivo" class="form-control">
                    <button type="submit" name="importar" class="form-control fondo1">Importar Pacientes</button>
                </form>
            </div>
        </div>

    </div>

    

</div>

