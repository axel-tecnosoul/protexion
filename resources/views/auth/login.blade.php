@extends('layouts.login')

@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
        @include('errors.request')
        <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-user"></i></span>
					</div>
					<input name="email" type="email" class="form-control" placeholder="correo">
                </div>

				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-key"></i></span>
					</div>
					<input name="password" type="password" class="form-control" placeholder="contraseña">
                </div>



                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" id="defaultUnchecked">
                        <label class="custom-control-label" for="defaultUnchecked">Recuerdame</label>

				</div>
				<div class="form-group">
					<input type="submit" value="Ingresar" class="btn float-right login_btn">
				</div>

        </form>

    </div>
@endsection
