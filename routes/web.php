<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\historyController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\tempatController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;


Route::get('/', [homeController::class, 'index_home']);
Route::post('sortir', [homeController::class, 'index_home']);



// auth proses
Route::get('login', [authController::class, 'login']);
Route::post('login', [authController::class, 'validasi']);
Route::get('register', [authController::class, 'registers']);
Route::post('register', [authController::class, 'register']);
Route::get('logout', [authController::class, 'logout']);

// history controller user
Route::post('addhistory', [historyController::class, 'createHistory']);
Route::get('edithistory/{id}', [historyController::class, 'editHistory']);
Route::delete('deletehistory/{id}', [historyController::class, 'deleteHistory']);



// hanya bisa di akses admin
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('admin', [homeController::class, 'index_admin']);

    // history controller admin
    Route::get('history', [historyController::class, 'index']);
    Route::get('detailhistory/{id}', [historyController::class, 'detailHistory']);
    Route::get('download/{id}', [historyController::class, 'download']);


    
    // tempat controller admin
    Route::get('tempat', [tempatController::class, 'index']);
    
    
    // user controller admin
    Route::get('user', [userController::class, 'user']);
    Route::post('edituser/{id}', [userController::class, 'edit']);
    Route::post('adduser', [userController::class, 'create']);
    Route::delete('deleteuser/{id}', [userController::class, 'delete']);
});


// hanya di akses oleh role tempat
Route::group(['middleware' => ['role:tempat']], function () {
    Route::get('tempat', [tempatController::class, 'tempat']);
});
