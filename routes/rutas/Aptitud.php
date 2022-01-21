<?php
use Illuminate\Support\Facades\Route;
    Route::get('aptitudes',                         'AptitudController@index')             ->name('aptitudes.index');
    Route::get('aptitudes/create/{voucher}',        'AptitudController@create')            ->name('aptitudes.create');
    Route::post('aptitudes',                        'AptitudController@store')             ->name('aptitudes.store');
    Route::get('aptitudes/{aptitud}',               'AptitudController@show')              ->name('aptitudes.show');
    Route::get('aptitudes/{aptitud}/edit',          'AptitudController@edit')              ->name('aptitudes.edit');
    Route::patch('aptitudes/{id}',                  'AptitudController@update')            ->name('aptitudes.update');
    Route::delete('aptitudes/{id}',                 'AptitudController@destroy')           ->name('aptitudes.destroy');

    Route::get('aptitudes/{aptitud}/descargar',     'AptitudController@descargar')         ->name('aptitudes.descargar');

?>