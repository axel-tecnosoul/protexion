<?php
use Illuminate\Support\Facades\Route;
    Route::get('voucher',                               'VoucherController@index')->                        name('voucher.index');
    Route::delete('voucher/{voucher}',                  'VoucherController@destroy')->                      name('voucher.destroy');
    Route::get('voucher/create/{paciente}',             'VoucherController@create')->                       name('voucher.create');
    Route::post('voucher',                              'VoucherController@store')->                        name('voucher.store');
    Route::get('voucher/{voucher}/edit',                'VoucherController@edit')->                         name('voucher.edit');
    Route::patch('voucher/{voucher}',                   'VoucherController@update')->                       name('voucher.update');
    Route::get('voucher/{voucher}',                     'VoucherController@show')->                         name('voucher.show');
    Route::get('voucher/{voucher}/forms',               'VoucherController@showforms')->                    name('voucher.showforms');
    Route::get('voucher/create/traerDatosPaciente',     'VoucherController@traerDatosPaciente');
    Route::get('voucher/{voucher}/pdf_medico',          'VoucherController@pdf_medico')->                   name('voucher.pdf_medico'  );
    Route::get('voucher/{voucher}/pdf_paciente',        'VoucherController@pdf_paciente')->                 name('voucher.pdf_paciente');



?>