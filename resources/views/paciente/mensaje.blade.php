@if (Session::has('delete_user_error'))
        <div class="alert alert-danger"data-auto-dismiss role="alert">{{ Session::get('delete_user_error') }}
                <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                </button>
        </div>
@endif


@if (Session::has('delete_user'))
        <div class="alert alert-success"data-auto-dismiss role="alert">{{ Session::get('delete_user') }}
                <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                </button>
        </div>
@endif

@if (Session::has('store_user'))
        <div class="alert alert-success"data-auto-dismiss role="alert">{{ Session::get('store_user') }}
                <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                </button>
        </div>
@endif

@if (Session::has('update_paciente'))
        <div class="alert alert-warning"data-auto-dismiss role="alert">{{ Session::get('update_paciente') }}
                <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                </button>
        </div>
@endif
