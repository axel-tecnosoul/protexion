@if (Session::has('delete'))
        <div class="alert alert-{{ Session::get('delete')['alert'] }}" data-auto-dismiss role="alert">{{ Session::get('delete')['message'] }}
                <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                </button>
        </div>
@endif

@if (Session::has('store'))
        <div class="alert alert-{{ Session::get('store')['alert'] }}" data-auto-dismiss role="alert">{{ Session::get('store')['message'] }}
                <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                </button>
        </div>
@endif

@if (Session::has('update'))
        <div class="alert alert-{{ Session::get('update')['alert'] }}" data-auto-dismiss role="alert">{{ Session::get('update')['message'] }}
                <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                </button>
        </div>
@endif
