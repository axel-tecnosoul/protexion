@extends('layouts.admin')

@section('titulo')
<div class="box-header" style="text-align:center">
    <a href="{{ asset('sexo') }}">
        <button title="atras" class="btn btn-default btn-responsive pull-left">
            <i class="fa fa-arrow-left"></i> Atras
        </button>
    </a>
</div>
@endsection

@section('content')

    {!!Form::model($sexo, [
        'method'=>'PATCH',
        'route'=>['sexo.update',$sexo->id]
    ])!!}
    

    {{Form::token()}}
    <div class="box-body">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color:#D2D6DE">
            @include('errors.request')
            @include('sexo.mensaje')
            <div class="box">
                <div class="box-header">
                    <h4 class="box-title" >
                        <i class="fa fa-venus-mars" aria-hidden="true"></i> Editar un sexo
                    </h4>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                            <label for="descripcion" class="control-label">Descripción</label>
        
                                <input id="descripcion" type="string" class="form-control" name="descripcion" value="{{ $sexo->descripcion }}" required>
        
            
                        </div>
        
                

                
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <button title="Guardar" class="btn btn-danger btn-responsive" type="submit"> <i class="fa fa-check"></i> Guardar</button>
                            <button title="Limpiar" class="btn btn-secondary btn-responsive" type="reset"><i class="fa fa-remove"></i> Cancelar</button>
                        </div>
                    </div>
    
                 </div>
                </div>
            </div>   
        </div>
        {!!Form::close()!!}


@endsection
