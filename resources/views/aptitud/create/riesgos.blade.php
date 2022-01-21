<div class="col-12">
    <!-- Riesgos -->
    <div class="card  "> 
        <div class="card-header header-bg">
            <h3 class="card-title">Riesgos</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
            </div>
        </div>
        <div class="card-body" > 
            <div class="row">
                @for ($i = 0; $i < sizeof($riesgos); $i++)
                <div class="form-group col-12">
                    <input type="text" value=0  name="riesgos[{{$i}}]" hidden>
                    <div class="icheck-danger d-inline">
                        <input type="checkbox" value=1 id="{{$i}}" name="riesgos[{{$i}}]">
                        <label for="{{$i}}">{{$riesgos[$i]}}</label>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>