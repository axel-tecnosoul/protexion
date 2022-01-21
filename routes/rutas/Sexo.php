<?php
use Illuminate\Support\Facades\Route;
    Route::get('sexo', 'SexoController@index')->name('sexo.index');

    Route::delete('sexo/{sexo}', 'SexoController@destroy')->name('sexo.destroy');

  
    Route::get('sexo/create', 'SexoController@create')->name('sexo.create');


    Route::post('sexo', 'SexoController@store')->name('sexo.store');

    Route::get('sexo/{sexo}/edit', 'SexoController@edit')->name('sexo.edit');


    Route::patch('sexo/{sexo}', 'SexoController@update')->name('sexo.update');
        





?>