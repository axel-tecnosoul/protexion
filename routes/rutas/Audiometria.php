<?php
use Illuminate\Support\Facades\Route;
    Route::get('audiometrias',                         'AudiometriaController@index')             ->name('audiometrias.index');
    Route::get('audiometrias/create/{voucher}',        'AudiometriaController@create')            ->name('audiometrias.create');
    Route::post('audiometrias',                        'AudiometriaController@store')             ->name('audiometrias.store');
    Route::get('audiometrias/{audiometria}',           'AudiometriaController@show')              ->name('audiometrias.show');
    Route::get('audiometrias/{audiometria}/edit',      'AudiometriaController@edit')              ->name('audiometrias.edit');
    Route::patch('audiometrias/{id}',                  'AudiometriaController@update')            ->name('audiometrias.update');
    Route::delete('audiometrias/{id}',                 'AudiometriaController@destroy')           ->name('audiometrias.destroy');

    Route::get('audiometrias/{audiometria}/pdf',       'AudiometriaController@crearPDF')          ->name('audiometrias.pdf');

?>