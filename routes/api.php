<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\CaseController;
use App\Http\Controllers\Api\EcgImageController;
use App\Http\Controllers\Api\PredictionController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('patients', PatientController::class);
    Route::apiResource('cases', CaseController::class);
    Route::apiResource('ecg-images', EcgImageController::class)
        ->only(['index', 'store', 'show', 'destroy']);
    Route::apiResource('predictions', PredictionController::class);
});
// Route::get('/test', function () {
//     return response()->json(['message' => 'API OK']);
// });
// Route::post('/login', function () {
//     return response()->json(['login' => 'ok']);
// });