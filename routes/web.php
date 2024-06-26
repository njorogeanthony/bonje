<?php

use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ValidateReceiptController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::name("receipts.")->prefix("receipts/")->group(function () {
        Route::get('', [ReceiptController::class, 'index'])->name('index');
        Route::view('create', 'app.create')->name('create');
        Route::post('store', [ReceiptController::class, 'store'])->name('store');
        Route::get('edit/{receipt}', [ReceiptController::class, 'edit'])->name('edit');
        Route::put('update/{receipt}', [ReceiptController::class, 'update'])->name('update');
        Route::delete('destroy/{receipt}', [ReceiptController::class, 'destroy'])->name('destroy');
    });

    Route::name("receipts.validate.")->prefix("receipts/validate/")->group(function () {
        Route::get('unvalidated', [ValidateReceiptController::class, 'unvalidated'])->name('unvalidated');
        Route::get('validate/{receipt}', [ValidateReceiptController::class, 'validate'])->name('validate');
        Route::get('validated', [ValidateReceiptController::class, 'validated'])->name('validated');
    });
});
