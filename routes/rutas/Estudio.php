<?php
use Illuminate\Support\Facades\Route;
    Route::get('estudios',                         'EstudioController@index')             ->name('estudios.index');
    Route::get('estudios/create',                  'EstudioController@create')            ->name('estudios.create');
    Route::post('estudios',                        'EstudioController@store')             ->name('estudios.store');
    Route::delete('estudios/{id}',                 'EstudioController@destroy')           ->name('estudios.destroy');

    /*
        Route::get('estudios/{estudio}',               'EstudioController@show')              ->name('estudios.show');
        Route::get('estudios/{estudio}/edit',          'EstudioController@edit')              ->name('estudios.edit');
        Route::patch('estudios/{id}',                  'EstudioController@update')            ->name('estudios.update');
    */

?>