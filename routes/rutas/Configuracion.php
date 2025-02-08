<?php
use Illuminate\Support\Facades\Route;
    Route::get('configuracion', 'ConfiguracionController@index')->name('configuracion.index');
    Route::get('configuracion/export', 'ConfiguracionController@export')->name('configuracion.export');







?>
