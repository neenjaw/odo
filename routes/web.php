<?php

use App\Http\Controllers\AuthController;
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

Route::group(['middleware' => ['guest']], function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login.show');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::get('verify-login/{token}', [AuthController::class, 'verifyLogin'])->name('verify-login');
});

Route::prefix('vehicle')->group(function () {
    Route::get('/', [VehicleController::class, 'showVehicleForm'])->name('vehicle.form');
    Route::post('/', [VehicleController::class, 'createVehicle'])->name('vehicle.create');
    Route::get('/{id}', [VehicleController::class, 'showVehicle'])->name('vehicle.show');
});

Route::prefix('milage')->group(function () {
    Route::get('/', [MilageController::class, 'showMilageForm'])->name('milage.form');
});

Route::get('/', [VehicleController::class, 'index'])->middleware('auth')->name('index');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
