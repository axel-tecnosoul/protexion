<?php
use Illuminate\Support\Facades\Route;
    Route::get('user', 'UserController@index')->name('user.index');

    //Route::delete('user/{user}', 'UserController@destroy')->name('user.destroy');


    Route::get('user/create', 'UserController@create')->name('user.create');


    Route::post('user', 'UserController@store')->name('user.store');

    Route::get('user/{user}/edit', 'UserController@edit')->name('user.edit');


    Route::patch('user/{user}', 'UserController@update')->name('user.update');

    Route::get('user/{user}/eliminar', 'UserController@delete')->name('user.eliminar');

    Route::get('user/eliminado', 'UserController@eliminados')->name('user.eliminado');

    Route::get('user/{user}', 'UserController@restaurar')->name('user.restaurar');






?>
