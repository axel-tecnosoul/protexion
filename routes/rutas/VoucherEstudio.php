<?php
use Illuminate\Support\Facades\Route;
Route::post('VoucherEstudio','VoucherEstudioController@archivo')->name('voucherEstudio.archivo');
Route::get('VoucherEstudio/{voucherEstudio}/descargar','VoucherEstudioController@descargar')->name('voucherEstudio.descargar');
Route::get('VoucherEstudio/{voucherEstudio}','VoucherEstudioController@show')->name('voucherEstudio.show');
Route::delete('VoucherEstudio/{voucherEstudio}','VoucherEstudioController@delete')->name('voucherEstudio.delete');
?>