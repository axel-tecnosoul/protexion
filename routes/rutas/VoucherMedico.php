<?php
use Illuminate\Support\Facades\Route;
Route::get('voucher_medico','VoucherMedicoController@index')->name('voucher_medico.index');
Route::get('voucher_medico/{voucher}','VoucherMedicoController@show')->name('voucher_medico.show');
Route::get('voucher_medico/{fecha},{tipo_estudio_id}/pdf_medico','VoucherMedicoController@pdf_medico')->name('voucher_medico.pdf_medico');
?>