<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CuentaNeflixController;
use App\Http\Controllers\UserCuentaNeflixController;
use App\Http\Controllers\RentUserAccountController;



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

//User
Route::get('/user',[UserController::class, 'index']);
Route::get('/user/show/{id}',[UserController::class, 'show']);
Route::post('/user',[UserController::class, 'store']);
Route::get('/user/edit/{id}',[UserController::class, 'edit']);
Route::put('/user/update/{id}',[UserController::class, 'update']);
Route::delete('/user/delete/{id}',[UserController::class, 'destroy']);
Route::get('/user/cuentas/{id}',[UserController::class, 'getAccounbyUser']);

// Cuenta_Neflix
Route::post('/account/{user_id}',[CuentaNeflixController::class, 'store']);
Route::get('/account/edit/{id}',[CuentaNeflixController::class, 'edit']);
Route::put('/account/update/{id}',[CuentaNeflixController::class, 'update']);
Route::delete('/account/delete/{id}',[CuentaNeflixController::class, 'destroy']);

Route::get('/account/user/neflix',[CuentaNeflixController::class, 'getUsersByAccount']);
Route::get('/account/rent',[CuentaNeflixController::class, 'GetAccountAndUser']);

// Cuenta_Neflix_User
Route::post('/user/netflix/{user_id}/{cuenta_neflix_id}',[UserCuentaNeflixController::class, 'store']);
Route::put('/user/netflix/update/{id}/{user_id}/{cuenta_neflix_id}',[UserCuentaNeflixController::class, 'update']);
Route::delete('/user/netflix/delete/{id}/{user_id}/{cuenta_neflix_id}',[UserCuentaNeflixController::class, 'destroy']);

Route::get('/user/netflix/obtener/{account_id}',[UserCuentaNeflixController::class, 'GetUserNeflixbyAccount']);


// Rent_User_Accout
Route::post('/rent/user/{cuenta_netflix_id}/{user_account_neflix_id}',[RentUserAccountController::class, 'store']);


