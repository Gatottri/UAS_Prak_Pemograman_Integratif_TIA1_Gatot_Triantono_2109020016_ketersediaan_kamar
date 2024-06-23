<?php

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\RoomAllocationController;
use App\Http\Controllers\Api\RoomController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/patients', [PatientController::class, 'index']);
Route::post('/patients', [PatientController::class, 'store']);
Route::get('/patients/{id}', [PatientController::class, 'show']);
Route::put('/patients/{id}', [PatientController::class, 'update']);
Route::delete('/patients/{id}', [PatientController::class, 'destroy']);

Route::get('/rooms', [RoomController::class, 'index']);
Route::post('/rooms', [RoomController::class, 'store']);
Route::get('/rooms/{id}', [RoomController::class, 'show']);
Route::put('/rooms/{id}', [RoomController::class, 'update']);
Route::put('/rooms/{id}/status', [RoomController::class, 'updateStatus']);

Route::get('/roomallocations', [RoomAllocationController::class, 'index']);
Route::post('/roomallocations', [RoomAllocationController::class, 'store']);
Route::get('/roomallocations/{id}', [RoomAllocationController::class, 'show']);
Route::put('/roomallocations/{id}', [RoomAllocationController::class, 'update']);
Route::put('/roomallocations/{id}/checkout', [RoomAllocationController::class, 'checkOut']);