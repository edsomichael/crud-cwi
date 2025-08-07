<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

// Endpoint health
Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

// Endpoint /external que consome microsserviço Node.js
Route::get('/external', function () {
    $response = Http::get('http://localhost:4000/external-data');
    if ($response->successful()) {
        return response()->json([
            'node_response' => $response->json()
            ], 200, ['Content-Type' => 'application/json; charset=utf-8']);
    }
    return response()->json(['error' => 'Failed to get data'], 500);
});
