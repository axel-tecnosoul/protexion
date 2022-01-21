<?php
use Illuminate\Support\Facades\Route;
    Route::get('tipo-sangre', 'TipoSangreController@index')->name('tipo-sangre.index');

    Route::delete('tipo-sangre/{tipo-sangre}', 'TipoSangreController@destroy')->name('tipo-sangre.destroy');


    Route::get('tipo-sangre/create', 'TipoSangreController@create')->name('tipo-sangre.create');


    Route::post('tipo-sangre', 'TipoSangreController@store')->name('tipo-sangre.store');

    Route::get('tipo-sangre/{tipo-sangre}/edit', 'TipoSangreController@edit')->name('tipo-sangre.edit');


    Route::patch('tipo-sangre/{tipo-sangre}', 'TipoSangreController@update')->name('tipo-sangre.update');






?>
