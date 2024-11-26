<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::group([
    'prefix' => 'auth'
  ], function () {
    Route::post('register', [AuthController::class,'register']);
    Route::post('login', [AuthController::class,'login']);
    Route::group([
      'middleware' => 'auth:api'
    ], function(){
      Route::post('logout', [AuthController::class,'logout']);
      Route::post('refresh', [AuthController::class, 'refresh']);
      Route::get('me', [AuthController::class,'me']);
      
      Route::group([
        'middleware' => 'auth:api'
      ], function () {

      });
      
    });
  });

Route::group([
    'prefix' => 'pemeriksaan'
], function () {
    Route::post('list', [PemeriksaanController::class, 'listPengajuan']);
    Route::post('create', [PemeriksaanController::class, 'createPemeriksaan']);
    Route::put('update/{id}', [PemeriksaanController::class, 'updatePemeriksaan']);
    Route::delete('delete/{id}', [PemeriksaanController::class, 'deletePemeriksaan']);
});

Route::group([
  'prefix' => 'progres'
], function () {
  Route::post('create', [PemeriksaanController::class, 'createProgres']);
  Route::put('update/{id}', [PemeriksaanController::class, 'updateProgres']);
  Route::delete('delete/{id}', [PemeriksaanController::class, 'deleteProgres']);
});


