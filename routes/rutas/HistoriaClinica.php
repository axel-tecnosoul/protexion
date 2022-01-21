<?php
use Illuminate\Support\Facades\Route;
    Route::get('historia_clinica', 'HistoriaClinicaController@index')
        ->name('historia_clinica.index');

    Route::delete('historia_clinica/{historia_clinica}', 'HistoriaClinicaController@destroy')
        ->name('historia_clinica.destroy');


    Route::get('historia_clinica/create/{voucher}', 'HistoriaClinicaController@create')
        ->name('historia_clinica.create');

    Route::post('historia_clinica', 'HistoriaClinicaController@store')
        ->name('historia_clinica.store');

    Route::get('historia_clinica/{historia_clinica}/edit', 'HistoriaClinicaController@edit')
        ->name('historia_clinica.edit');


    Route::patch('historia_clinica/{historia_clinica}', 'HistoriaClinicaController@update')
        ->name('historia_clinica.update');


    //PDF
    Route::get('historia_clinica/{historia_clinica}/pdf','HistoriaClinicaController@crearPDF')
        ->name('historia_clinica.pdf');


    Route::get('historia_clinica/{historia_clinica}/hc_formulario', 'HcFormularioController@index')
        ->name('hc_formulario.index');


    //CREAR FORMULARIO DE FORMULARIO DE HISTORIA CLINICA
    Route::get('historia_clinica/{historia_clinica}/create', 'HcFormularioController@create')
        ->name('hc_formulario.create');

    Route::post('hc_formulario', 'HcFormularioController@store')
        ->name('hc_formulario.store');

?>
