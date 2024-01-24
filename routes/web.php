<?php

use App\Http\Controllers\BkashIndexController;
use Illuminate\Support\Facades\Route;
use Polashmahmud\Bkash\Http\Controllers\BkashController;

// Admin Panel
Route::get('/bkash', BkashIndexController::class)->name('bkash.index');

// Checkout (URL) User Part
Route::post('/bkash/create', [BkashController::class, 'createPayment'])->name('url-create');
Route::get('/bkash/callback', [BkashController::class, 'callback'])->name('url-callback');

// Checkout (URL) Admin Part
Route::get('/bkash/refund', [BkashController::class, 'getRefund'])->name('url-get-refund');
Route::post('/bkash/refund', [BkashController::class, 'refundPayment'])->name('url-post-refund');
