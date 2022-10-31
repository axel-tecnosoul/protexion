<?php
use Illuminate\Support\Facades\Route;
Route::post('origen/ajaxGuardar', 'OrigenController@ajaxGuardar')->name('origen.ajaxGuardar');
Route::get('origen/exportar', 'OrigenController@exportar')->name('origen.exportar');
//Route::get('origens/export/', [OrigenController::class, 'origen.exportar']);
//Route::get('origen/export/', [OrigenController::class, 'export'])->name('origen.exportar');








?>
