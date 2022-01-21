<?php
use Illuminate\Support\Facades\Route;
    Route::get('posiciones_forzadas', 'PosicionesForzadasController@index')->name('posiciones_forzadas.index');

    Route::delete('posiciones_forzadas/{posiciones_forzadas}', 'PosicionesForzadasController@destroy')->name('posiciones_forzadas.destroy');


    Route::get('posiciones_forzadas/create/{voucher}', 'PosicionesForzadasController@create')->name('posiciones_forzadas.create');


    Route::post('posiciones_forzadas', 'PosicionesForzadasController@store')->name('posiciones_forzadas.store');

    Route::get('posiciones_forzadas/{posiciones_forzadas}/edit', 'PosicionesForzadasController@edit')->name('posiciones_forzadas.edit');


    Route::patch('posiciones_forzadas/{posiciones_forzadas}', 'PosicionesForzadasController@update')->name('posiciones_forzadas.update');


    //PDF
    Route::get('posiciones_forzadas/{posiciones_forzadas}/pdf','PosicionesForzadasController@crearPDF')->name('posiciones_forzadas.pdf');


    Route::get('posiciones_forzadas/create/traerDatosPaciente', 'PosicionesForzadasController@traerDatosPaciente');

?>
