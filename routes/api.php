<?php

use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/orders/webhook', [OrderController::class, 'handleWebhook']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
