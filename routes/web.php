<?php

use App\Http\Controllers\AsesiController;
use App\Http\Controllers\AsesorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\SkemaManagementController;
use App\Http\Controllers\UserManagementController;
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


Route::post('/login', [AuthController::class, 'signIn']);
Route::get('/login', [AuthController::class, 'signIn']);
Route::get('/signup', [AuthController::class, 'register']);
Route::post('/signup', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'signOut']);
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('role:all');

Route::group(['middleware' => 'role:admin'], function() {
    Route::get('/user-management', [UserManagementController::class, 'index']);
    Route::get('/asesor-management', [AsesorController::class, 'index']);
    Route::get('/prodi-management', [MasterDataController::class, 'prodiManagement']);
    Route::get('/event-management', [EventController::class, 'index']);

});

Route::group(['prefix' => '/skema', 'middleware' => 'role:all'], function() {

    Route::get('/', [SkemaManagementController::class, 'index']);
    
});

Route::group(['middleware' => 'role:asesi', 'prefix' => 'asesi'], function() {
    Route::get('/profile', [AsesiController::class, 'profile']);
    Route::post('/profile', [AsesiController::class, 'profile']);
});