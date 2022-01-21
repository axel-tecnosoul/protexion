<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

Route::middleware(['auth'])->group(function() {
    include 'rutas/Welcome.php';
    include 'rutas/Sexo.php';
    include 'rutas/User.php';
    //include 'rutas/Roles.php';
    include 'rutas/Audit.php';
    include 'rutas/Configuracion.php';
    //include 'rutas/TipoSangre.php';
    include 'rutas/Paciente.php';
    include 'rutas/DeclaracionJurada.php';
    include 'rutas/HistoriaClinica.php';
    include 'rutas/Origen.php';
    include 'rutas/ObraSocial.php';
    include 'rutas/PosicionesForzadas.php';
    include 'rutas/Voucher.php';
    include 'rutas/Perfil.php';
    include 'rutas/Personal.php';

    include 'rutas/Audiometria.php';
    include 'rutas/Espiriometria.php';
    include 'rutas/Estudio.php';
    include 'rutas/TiposEstudio.php';
    include 'rutas/VoucherEstudio.php';
    include 'rutas/IluminacionDireccionado.php';
    include 'rutas/Aptitud.php';

});

