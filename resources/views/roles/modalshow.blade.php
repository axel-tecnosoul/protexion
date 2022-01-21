{{--ventanita modal cuando se haga clic en eliminar--}}


<div class="modal fade modal-slide-in-right"
    aria-hidden="true"
    role="dialog"
    tabindex="-1"
    id="modal-show-{{$role->id}}">



    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#4ab3eb">
                <h3 class="modal-title" style="color: white"><i style="color: white" class="fa fa-exclamation-triangle" aria-hidden="true"></i> Detalle deL rol {{ $role->id }}</h3>
                <div class="modal-body">
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            
                            <tr>
                                <th>Nombre</th>
                                <td>{{ $role->name}}</td>
                            </tr>
                            <tr>
                                <th>Permisos</th>
                                <td>@if(!empty($rolePermissions))
                                        @foreach($rolePermissions as $v)
                                            <label class="label label-success">{{ $v->name }},</label>
                                        @endforeach
                                    @endif</td>
                            </tr>

                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>

    </div>


</div>

