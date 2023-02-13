<?php
use Illuminate\Support\Facades\Route;
Route::get('ciudad', 'CiudadController@index')->name('ciudad.index');
Route::delete('ciudad/{ciudad}', 'CiudadController@delete')->name('ciudad.delete');
Route::get('ciudad/create', 'CiudadController@create')->name('ciudad.create');
Route::post('ciudad', 'CiudadController@store')->name('ciudad.store');
Route::get('ciudad/{ciudad}/edit', 'CiudadController@edit')->name('ciudad.edit');
Route::patch('ciudad/{ciudad}', 'CiudadController@update')->name('ciudad.update');
Route::get('ciudad/{ciudad}/show', 'CiudadController@show')->name('ciudad.show');
Route::get('ciudad/{ciudad}/eliminar', 'CiudadController@delete')->name('ciudad.eliminar');
Route::get('ciudad/eliminado', 'CiudadController@eliminados')->name('ciudad.eliminado');
Route::get('ciudad/{ciudad}', 'CiudadController@restaurar')->name('ciudad.restaurar');
Route::get('ciudad/create/encontrarEspecialidad', 'CiudadController@encontrarEspecialidad');
Route::delete('ciudad/{id}','CiudadController@destroy')->name('ciudad.destroy');
?>
