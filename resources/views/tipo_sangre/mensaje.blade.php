@if (Session::has('delete_sexo_error'))
        <div class="alert alert-danger"data-auto-dismiss role="alert">{{ Session::get('delete_sexo_error') }}
                <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                </button>
        </div>
@endif


@if (Session::has('delete_sexo'))
        <div class="alert alert-success"data-auto-dismiss role="alert">{{ Session::get('delete_sexo') }}
                <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                </button>
        </div>
@endif

@if (Session::has('store_sexo'))
        <div class="alert alert-success"data-auto-dismiss role="alert">{{ Session::get('store_sexo') }}
                <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                </button>
        </div>
@endif

@if (Session::has('update_sexo'))
        <div class="alert alert-warning"data-auto-dismiss role="alert">{{ Session::get('update_sexo') }}
                <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                </button>
        </div>
@endif
