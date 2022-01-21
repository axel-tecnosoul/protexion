<?php
use Illuminate\Support\Facades\Route;
    Route::get('espiriometrias',                         'EspiriometriaController@index')             ->name('espiriometrias.index');
    Route::get('espiriometrias/create/{voucher}',        'EspiriometriaController@create')            ->name('espiriometrias.create');
    Route::post('espiriometrias',                        'EspiriometriaController@store')             ->name('espiriometrias.store');
    Route::get('espiriometrias/{espiriometria}',         'EspiriometriaController@show')              ->name('espiriometrias.show');
    Route::get('espiriometrias/{espiriometria}/edit',    'EspiriometriaController@edit')              ->name('espiriometrias.edit');
    Route::patch('espiriometrias/{id}',                  'EspiriometriaController@update')            ->name('espiriometrias.update');
    Route::delete('espiriometrias/{id}',                 'EspiriometriaController@destroy')           ->name('espiriometrias.destroy');

    Route::get('espiriometrias/{espiriometria}/pdf',     'EspiriometriaController@crearPDF')          ->name('espiriometrias.pdf');

?>