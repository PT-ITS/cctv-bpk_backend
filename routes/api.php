<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\PenggunaWilayahController;
use App\Http\Controllers\ProgressController;

Route::group([
  'prefix' => 'auth'
], function () {
  Route::post('register', [AuthController::class, 'register']);
  Route::post('login', [AuthController::class, 'login']);
  Route::group([
    'middleware' => 'auth:api'
  ], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);

    Route::group([
      'middleware' => 'auth:api'
    ], function () {});
  });
});

Route::group([
  'prefix' => 'pemeriksaan'
], function () {
  Route::group([
    'middleware' => ['auth:api']
  ], function () {
    Route::get('detail/{id}', [PemeriksaanController::class, 'detail']);
    Route::get('list', [PemeriksaanController::class, 'list']);
    Route::post('create', [PemeriksaanController::class, 'create']);
    Route::post('update/{id}', [PemeriksaanController::class, 'update']);
    Route::delete('delete/{id}', [PemeriksaanController::class, 'delete']);
  });
});

Route::group([
  'prefix' => 'pengguna-wilayah'
], function () {
  Route::group([
    'middleware' => ['auth:api']
  ], function () {
    Route::get('detail/{id}', [PenggunaWilayahController::class, 'detail']);
    Route::get('list', [PenggunaWilayahController::class, 'list']);
    Route::post('create', [PenggunaWilayahController::class, 'create']);
    Route::post('update/{id}', [PenggunaWilayahController::class, 'update']);
    Route::delete('delete/{id}', [PenggunaWilayahController::class, 'delete']);
  });
});

Route::group([
  'prefix' => 'progress'
], function () {
  Route::group([
    'middleware' => ['auth:api']
  ], function () {
    Route::get('detail/{id}', [ProgressController::class, 'detail']);
    Route::get('list-by-pemeriksaan/{id}', [ProgressController::class, 'listByPemeriksaan']);
    Route::get('list-by-user/{id}', [ProgressController::class, 'listByUser']);
    Route::post('create', [ProgressController::class, 'create']);
    Route::post('validasi/{id}', [ProgressController::class, 'validasi']);
    Route::post('update/{id}', [ProgressController::class, 'update']);
    Route::delete('delete/{id}', [ProgressController::class, 'delete']);
  });
});
