<div class="col-12">
    <div class="row">
        
        <!--Preexistencias -->
        <div class="col-6">
            <div class="card  "> 
                <div class="card-header header-bg">
                    <h3 class="card-title">Preexistencias</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body" >
                    <textarea class="form-control" name="preexistencias" id="preexistencias" cols="30" rows="10" readonly></textarea>
                </div>
            </div>
        </div>

        <!--Observaciones -->
        <div class="col-6">
            <div class="card  "> 
                <div class="card-header header-bg">
                    <h3 class="card-title">Observaciones</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body" > 
                    <textarea class="form-control" name="observaciones" id="observaciones" cols="30" rows="10" readonly></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- HIDDEN para datos hardcodeados (Petición del cliente) -->
<textarea id="datosAdicionales" class="form-control" hidden>{{$datosAdicionales}}</textarea>