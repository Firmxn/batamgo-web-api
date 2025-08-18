<?php

use App\Http\Controllers\Api\TransportasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes API untuk Sistem Informasi Transportasi Publik
Route::prefix('transportasi')->group(function () {
    Route::get('routes', [TransportasiController::class, 'getRoutes']);
    Route::get('shelters', [TransportasiController::class, 'getShelters']);
    Route::get('buses', [TransportasiController::class, 'getBuses']); 
});