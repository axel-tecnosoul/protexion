<?php
use Illuminate\Support\Facades\Route;
    Route::get('obra_social', 'ObraSocialController@index')->name('obra_social.index');

    Route::delete('obra_social/{obra_social}', 'ObraSocialController@destroy')->name('obra_social.destroy');

    Route::get('obra_social/create', 'ObraSocialController@create')->name('obra_social.create');

    Route::post('obra_social', 'ObraSocialController@store')->name('obra_social.store');

    Route::get('obra_social/{obra_social}/edit', 'ObraSocialController@edit')->name('obra_social.edit');

    Route::patch('obra_social/{obra_social}', 'ObraSocialController@update')->name('obra_social.update');



    Route::post('obra_social/ajaxGuardar', 'ObraSocialController@ajaxGuardar')->name('obra_social.ajaxGuardar');



?>
