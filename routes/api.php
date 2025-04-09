<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\NewsletterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//  Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



Route::middleware('auth:sanctum')->group(function(){
    
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::apiResource('newsletter',NewsletterController::class);
    Route::apiResource('campaigns',CampaignController::class);
    
});