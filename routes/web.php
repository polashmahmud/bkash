<?php

use App\Http\Controllers\BkashIndexController;
use App\Http\Controllers\BkashShowController;
use Illuminate\Support\Facades\Route;
use Polashmahmud\Bkash\Http\Controllers\BkashController;

// Admin Panel
Route::get('/bkash', BkashIndexController::class)->name('bkash.index');
Route::get('/bkash/{id}', BkashShowController::class)->name('bkash.show');

// Checkout (URL) User Part
Route::post('/bkash/payment/create', [BkashController::class, 'createPayment'])->name('bkash.payment-create');
Route::get('/bkash/payment/callback', [BkashController::class, 'callback'])->name('bkash.callback');

// Checkout (URL) Admin Part
Route::get('/bkash/payment/refund/{bkash}', [BkashController::class, 'getRefund'])->name('bkash.payment.refund');
Route::post('/bkash/payment/refund', [BkashController::class, 'refundPayment'])->name('bkash.payment.refund');
