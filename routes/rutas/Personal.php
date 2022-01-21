<?php
use Illuminate\Support\Facades\Route;
    Route::get('personal', 'PersonalClinicaController@index')->name('personal.index');

    Route::delete('personal/{personal}', 'PersonalClinicaController@delete')->name('personal.delete');


    Route::get('personal/create', 'PersonalClinicaController@create')->name('personal.create');


    Route::post('personal', 'PersonalClinicaController@store')->name('personal.store');

    Route::get('personal/{personal}/edit', 'PersonalClinicaController@edit')->name('personal.edit');


    Route::patch('personal/{personal}', 'PersonalClinicaController@update')->name('personal.update');

    Route::get('personal/{personal}/show', 'PersonalClinicaController@show')->name('personal.show');

    Route::get('personal/{personal}/eliminar', 'PersonalClinicaController@delete')->name('personal.eliminar');

    Route::get('personal/eliminado', 'PersonalClinicaController@eliminados')->name('personal.eliminado');

    Route::get('personal/{personal}', 'PersonalClinicaController@restaurar')->name('personal.restaurar');

    Route::get('personal/create/encontrarEspecialidad', 'PersonalClinicaController@encontrarEspecialidad');

?>
