@extends('layouts.admin')

@section('content')
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header header-bg">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fas fa-stethoscope"></i>Formulario de Archivo adjunto</p>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFileLang" lang="es">
                        <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                      </div>
                </div>
            </div>
        <!-- Guardar -->
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
                <div class="form-group">
                    <input id="guardar" name="_token" value="{{ csrf_token() }}" type="hidden">
                        <button class="btn btn-success btn-lg btn-block" id="confirmar"type="submit"><i class="fa fa-check"> </i>Cargar</button>
                </div>
            </div>
        <!-- / Guardar -->
        </div>
    </div>

    {!!Form::close()!!}

    @push('scripts')
        <script>

        </script>
    @endpush
@endsection
