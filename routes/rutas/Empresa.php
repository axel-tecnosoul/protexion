<?php
use Illuminate\Support\Facades\Route;
Route::get('empresa', 'EmpresaController@index')->name('empresa.index');
Route::delete('empresa/{empresa}', 'EmpresaController@delete')->name('empresa.delete');
Route::get('empresa/create', 'EmpresaController@create')->name('empresa.create');
Route::post('empresa', 'EmpresaController@store')->name('empresa.store');
Route::get('empresa/{empresa}/edit', 'EmpresaController@edit')->name('empresa.edit');
Route::patch('empresa/{empresa}', 'EmpresaController@update')->name('empresa.update');
Route::get('empresa/{empresa}/show', 'EmpresaController@show')->name('empresa.show');
Route::get('empresa/{empresa}/eliminar', 'EmpresaController@delete')->name('empresa.eliminar');
Route::get('empresa/eliminado', 'EmpresaController@eliminados')->name('empresa.eliminado');
Route::get('empresa/{empresa}', 'EmpresaController@restaurar')->name('empresa.restaurar');
Route::get('empresa/create/encontrarEspecialidad', 'EmpresaController@encontrarEspecialidad');
Route::delete('empresa/{id}','EmpresaController@destroy')->name('empresa.destroy');
Route::get('empresa/{id}','EmpresaController@destroy')->name('empresa.destroy');
Route::get('empresa/reporte/empresarial','EmpresaController@reporte')->name('empresa.reporte');
Route::get('empresa/reporte/pdf_empresarial/{empresa}/{visitas}','EmpresaController@pdf_reporte')->name('empresa.pdf_reporte');
?>
