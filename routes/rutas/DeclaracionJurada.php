<?php
use Illuminate\Support\Facades\Route;
    Route::get('declaracion_jurada', 'DeclaracionJuradaController@index')->name('declaracion_jurada.index');

    Route::delete('declaracion_jurada/{declaracion_jurada}', 'DeclaracionJuradaController@destroy')->name('declaracion_jurada.destroy');


    Route::get('declaracion_jurada/create/{voucher}', 'DeclaracionJuradaController@create')->name('declaracion_jurada.create');


    Route::post('declaracion_jurada', 'DeclaracionJuradaController@store')->name('declaracion_jurada.store');

    Route::get('declaracion_jurada/{declaracion_jurada}/edit', 'DeclaracionJuradaController@edit')->name('declaracion_jurada.edit');


    Route::patch('declaracion_jurada/{declaracion_jurada}', 'DeclaracionJuradaController@update')->name('declaracion_jurada.update');


    //PDF
    Route::get('declaracion_jurada/{declaracion_jurada}/pdf','DeclaracionJuradaController@crearPDF')->name('declaracion_jurada.pdf');


    Route::get('declaracion_jurada/create/traerDatosPaciente', 'DeclaracionJuradaController@traerDatosPaciente');

?>
