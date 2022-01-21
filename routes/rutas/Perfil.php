 <?php
use Illuminate\Support\Facades\Route;
    Route::get('perfil', 'PerfilController@index')->name('perfil.index');
    Route::get('perfil/actualizar',['as'=> 'perfil.edit', 'uses' => 'PerfilController@edit']);
    Route::get('perfil/show',['as'=> 'perfil.show', 'uses' => 'PerfilController@show']);
    Route::patch('perfil/actualizar',['as'=> 'perfil.update', 'uses' => 'PerfilController@update']);
    
?>