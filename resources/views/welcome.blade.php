@extends('layouts.admin') <!-- Extiende de layout -->

@section('titulo') <!-- Titulo -->
<div class="box-header" style="text-align: center">
    <h4 class = "box-title" style="font-size:120%">Bienvenido/a: <b style="font-size:120%"> {{ Auth::user()->name }}</b></h4>
    <div class="box-tools pull-right"> </div>
</div>
@endsection

@section('content') <!-- Contenido -->
<div class="card-body">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="row">
            <!--div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{$cantUser}}</h3>
                        <p style="font-size:150%">Personas registradas</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-id-card" aria-hidden="true"></i>
                    </div>
                </div>
            </div-->
        </div>
        <!--div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{$cantUser}}</h3>
                        <p style="font-size:150%">Declaraciones Juradas</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-id-card" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div-->
    </div>
</div>
@endsection
