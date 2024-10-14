<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\CashbackController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [OrderController::class, 'dashboard'])->name('dashboard');

    //orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    //shipments
    Route::get('/shipments', [ShipmentController::class, 'index'])->name('shipments.index');
    Route::get('/orders/{order}/shipments/create', [ShipmentController::class, 'create'])->name('shipments.create'); // Formulário para criar envio
    Route::post('/orders/{order}/shipments', [ShipmentController::class, 'store'])->name('shipments.store'); // Armazenar envio
    Route::post('/shipments/{shipment}/status', [ShipmentController::class, 'updateStatus'])->name('shipments.updateStatus'); // Atualizar status de envio
    Route::get('/shipments/{id}/edit', [ShipmentController::class, 'edit'])->name('shipments.edit');

    //cashback
    Route::get('cashback', [CashbackController::class, 'index'])->name('cashback.index');    
    Route::put('cashback/{id}/mark-paid', [CashbackController::class, 'markAsPaid'])->name('cashback.markAsPaid');

    //clients
    Route::resource('clients', ClientController::class);

});

Route::post('cashback', [CashbackController::class, 'store'])->name('cashback.store');