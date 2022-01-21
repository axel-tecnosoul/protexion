<?php
use Illuminate\Support\Facades\Route;
    Route::get('roles', 'RoleController@index')->name('roles.index');

    Route::delete('roles/{roles}', 'RoleController@destroy')->name('roles.destroy');


    Route::get('roles/create', 'RoleController@create')->name('roles.create');


    Route::post('roles', 'RoleController@store')->name('roles.store');

    Route::get('roles/{roles}/edit', 'RoleController@edit')->name('roles.edit');


    Route::patch('roles/{roles}', 'RoleController@update')->name('roles.update');

    Route::get('roles/{roles}/show', 'RoleController@show')->name('roles.show');




?>
