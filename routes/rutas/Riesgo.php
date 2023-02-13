<?php
use Illuminate\Support\Facades\Route;
Route::get('riesgo', 'RiesgoController@index')->name('riesgo.index');
Route::delete('riesgo/{riesgo}', 'RiesgoController@delete')->name('riesgo.delete');
Route::get('riesgo/create', 'RiesgoController@create')->name('riesgo.create');
Route::post('riesgo', 'RiesgoController@store')->name('riesgo.store');
Route::get('riesgo/{riesgo}/edit', 'RiesgoController@edit')->name('riesgo.edit');
Route::patch('riesgo/{riesgo}', 'RiesgoController@update')->name('riesgo.update');
Route::get('riesgo/{riesgo}/show', 'RiesgoController@show')->name('riesgo.show');
Route::get('riesgo/{riesgo}/eliminar', 'RiesgoController@delete')->name('riesgo.eliminar');
Route::get('riesgo/eliminado', 'RiesgoController@eliminados')->name('riesgo.eliminado');
Route::get('riesgo/{riesgo}', 'RiesgoController@restaurar')->name('riesgo.restaurar');
Route::get('riesgo/create/encontrarEspecialidad', 'RiesgoController@encontrarEspecialidad');
Route::delete('riesgo/{id}','RiesgoController@destroy')->name('riesgo.destroy');
?>
