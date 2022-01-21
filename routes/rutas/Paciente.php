<?php
use Illuminate\Support\Facades\Route;
    Route::get('paciente', 'PacienteController@index')->name('paciente.index');
    Route::delete('paciente/{paciente}', 'PacienteController@destroy')->name('paciente.destroy');
    Route::get('paciente/create', 'PacienteController@create')->name('paciente.create');
    Route::post('paciente', 'PacienteController@store')->name('paciente.store');
    Route::get('paciente/{paciente}/edit', 'PacienteController@edit')->name('paciente.edit');
    Route::patch('paciente/{paciente}', 'PacienteController@update')->name('paciente.update');
    Route::get('paciente/create/encontrarProvincia', 'PacienteController@encontrarProvincia');
    Route::get('paciente/create/encontrarCiudad', 'PacienteController@encontrarCiudad');
    Route::get('paciente/{paciente}/eliminar', 'PacienteController@delete')->name('paciente.eliminar');
    Route::get('paciente/eliminado', 'PacienteController@eliminados')->name('paciente.eliminado');
    Route::get('paciente/{paciente}', 'PacienteController@restaurar')->name('paciente.restaurar');

    Route::get('paciente/{paciente}/vouchers', 'PacienteController@voucher')->name('paciente.voucher');
    Route::post('paciente-import-list-excel', 'PacienteController@importExcel')->name('pacientes.import.excel');
?>
