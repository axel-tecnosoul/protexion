@if (Session::has('search_user'))
        <div class="alert alert-warning"data-auto-dismiss role="alert">{{ Session::get('search_user') }}
                <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                </button>
        </div>
@endif
