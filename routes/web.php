<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AsesiController;
use App\Http\Controllers\AsesorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\SertifikatController;
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


Route::group(['middleware' => 'role:admin'], function () {
    
    Route::get('/admin/profile', [AdminController::class, 'index']);
    
    Route::group(['prefix' => '/asesor'], function () {
        Route::get('/', [AsesorController::class, 'index']);
        Route::get('/create', [AsesorController::class, 'create']);
        Route::get('/update/{id}', [AsesorController::class, 'create']);
    });


    Route::get('/user-management', [UserManagementController::class, 'index']);
    Route::get('/prodi-management', [MasterDataController::class, 'prodiManagement']);

});

Route::group(['prefix' => '/sertifikat', 'middelware' => 'role:all'], function() {
    Route::get('/{id}', [SertifikatController::class, 'index']);
});

Route::group(['prefix' => '/event', 'middleware' => 'role:all'], function() {
    Route::get('/', [EventController::class, 'index']);
    Route::get('/{id}', [EventController::class, 'detail']);
    Route::get('/{id}/asesi', [EventController::class, 'skemaAsesi']);
});

Route::group(['prefix' => '/event', 'middleware' => 'role:asesi'], function() {
    Route::get('/{id}/register', [EventController::class, 'registerEvent']);
    Route::get('/{id}/asesmen-mandiri', [EventController::class, 'asesmentMandiri']);
});

Route::group(['prefix' => '/skema', 'middleware' => 'role:all'], function () {

    Route::get('/', [SkemaManagementController::class, 'index']);
    Route::get('/{id}', [SkemaManagementController::class, 'datail']);
    Route::post('/{id}/update', [SkemaManagementController::class, 'update']);

    Route::get('/{id}/unit-kompetensi', [SkemaManagementController::class, 'unitKompetensi']);
    Route::post('/{id}/unit-kompetensi/update', [SkemaManagementController::class, 'updateUnitKompetensi']);
});

Route::group(['middleware' => 'role:asesi', 'prefix' => 'asesi'], function () {
    Route::get('/sertifikat', [AsesiController::class, 'sertifikat']);
    Route::get('/profile', [AsesiController::class, 'profile']);
    Route::post('/profile', [AsesiController::class, 'profile']);
    Route::get('/umpan-balik-asesi/{id}', [AsesiController::class, 'umpanBalik']);
    Route::get('/observasi/{id}', [AsesiController::class, 'observasi']);
});
