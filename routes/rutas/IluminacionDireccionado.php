<?php

use Illuminate\Support\Facades\Route;

    Route::get('iluminacion_direccionados',                                     'IluminacionDireccionadoController@index')             ->name('iluminacion_direccionados.index');
    Route::get('iluminacion_direccionados/create/{voucher}',                    'IluminacionDireccionadoController@create')            ->name('iluminacion_direccionados.create');
    Route::post('iluminacion_direccionados',                                    'IluminacionDireccionadoController@store')             ->name('iluminacion_direccionados.store');
    Route::get('iluminacion_direccionados/{IluminacionDireccionado}',           'IluminacionDireccionadoController@show')              ->name('iluminacion_direccionados.show');
    Route::get('iluminacion_direccionados/{IluminacionDireccionado}/edit',      'IluminacionDireccionadoController@edit')              ->name('iluminacion_direccionados.edit');
    Route::patch('iluminacion_direccionados/{id}',                              'IluminacionDireccionadoController@update')            ->name('iluminacion_direccionados.update');
    Route::delete('iluminacion_direccionados/{id}',                             'IluminacionDireccionadoController@destroy')           ->name('iluminacion_direccionados.destroy');

    Route::get('iluminacion_direccionados/{IluminacionDireccionado}/pdf',       'IluminacionDireccionadoController@crearPDF')          ->name('iluminacion_direccionados.pdf');

?>