<?php

use App\Http\Controllers\Cropper;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserClientSide;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use function Ramsey\Uuid\v1;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->middleware('auth');

//Route Client Side
Route::get('/user_client_side', [UserClientSide::class, 'index'])->middleware('auth');
Route::get('/user_client_side/get_data', [UserClientSide::class, 'get_data'])->middleware('auth');
Route::get('/user_client_side/{id}', [UserClientSide::class, 'show'])->middleware('auth');
Route::put('/user_client_side/{id}', [UserClientSide::class, 'update'])->middleware('auth');
Route::post('/user_client_side', [UserClientSide::class, 'get_data_user'])->middleware('auth');
Route::post('/user_client_side/create', [UserClientSide::class, 'store'])->middleware('auth');
Route::delete('/user_client_side/{id}', [UserClientSide::class, 'destroy'])->middleware('auth');

//Route Server Side
Route::get('/user', [UserController::class, 'index'])->middleware('auth');
Route::get('/user/{id}', [UserController::class, 'show'])->middleware('auth');
Route::put('/user/{id}', [UserController::class, 'update'])->middleware('auth');
Route::put('/update_password/{id}', [UserController::class, 'update_password'])->middleware('auth');
Route::post('/user', [UserController::class, 'get_data_user'])->middleware('auth');
Route::post('/user/create', [UserController::class, 'store'])->middleware('auth');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->middleware('auth');

//Route Cropper
Route::get('/cropper', [Cropper::class, 'index'])->middleware('auth');
Route::get('/cropper/{id}', [Cropper::class, 'show'])->middleware('auth');
Route::put('/cropper/{id}', [Cropper::class, 'update'])->middleware('auth');
Route::put('/update_password/{id}', [Cropper::class, 'update_password'])->middleware('auth');
Route::post('/cropper', [Cropper::class, 'get_data_cropper'])->middleware('auth');
Route::post('/cropper/create', [Cropper::class, 'store'])->middleware('auth');
Route::delete('/cropper/{id}', [Cropper::class, 'destroy'])->middleware('auth');

//Route Login
Route::resource('/login', LoginController::class);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'store']);
Route::post('login/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('login', array('as' => 'login', function () {
  return view('login', ['title' => 'Login']);
}));
