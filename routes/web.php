<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::apiResource('/articulos', ArticuloController::class);
Route::apiResource('/vehiculos',VehicleController::class);
Route::apiResource('/conductores',DriverController::class);
Route::apiResource('/propietarios',OwnerController::class);

Route::get('/getVehicles', [VehicleController::class, 'getVehicles']);

Route::get('/list-conductores', [DriverController::class, 'listDriver'])->name('list-conductores');
Route::get('/list-propietarios', [OwnerController::class, 'listOwner'])->name('list-propietarios');
Route::get('/detalle-vehiculo/{id}', [VehicleController::class, 'getDetailVehicle'])->name('detalle-vehiculo');
