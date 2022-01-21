@extends('layouts.admin')

@section('navegacion')
    <li class="breadcrumb-item"><a href="/tipo_estudios">Indice de tipo de estudios</a></li>
    <li class="breadcrumb-item active">Formulario de tipso de estudios</li>
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Tipo Estudio</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tipo_estudios.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            <div class="box-body ">
                                <div class="form-group">
                                    {{ Form::label('nombre') }}
                                    {{ Form::text('nombre', $tipoEstudio->nombre, ['class' => 'form-control col-6' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                                    {!! $errors->first('nombre', '<div class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>

                            <div class="" id="guardar">
                                <div class="form-group">
                                    <input id="guardar" name="_token" value="{{ csrf_token() }}" type="hidden">
                                        <button class="btn btn-success btn-lg btn-block" id="confirmar"type="submit"><i class="fa fa-check"> </i> Cargar tipo de estudio</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
