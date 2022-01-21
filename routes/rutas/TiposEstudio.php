<?php
use Illuminate\Support\Facades\Route;
    Route::get('tipo_estudios',                         'TipoEstudioController@index')             ->name('tipo_estudios.index');
    Route::get('tipo_estudios/create',                  'TipoEstudioController@create')            ->name('tipo_estudios.create');
    Route::post('tipo_estudios',                        'TipoEstudioController@store')             ->name('tipo_estudios.store');
    Route::delete('tipo_estudios/{id}',                 'TipoEstudioController@destroy')           ->name('tipo_estudios.destroy');

    /*
        Route::get('tipo_estudios/{tipo_estudio}',          'TipoEstudioController@show')              ->name('tipo_estudios.show');
        Route::get('tipo_estudios/{tipo_estudio}/edit',     'TipoEstudioController@edit')              ->name('tipo_estudios.edit');
        Route::patch('tipo_estudios/{id}',                  'TipoEstudioController@update')            ->name('tipo_estudios.update');
    */

?>