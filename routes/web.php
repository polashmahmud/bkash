<?php

use App\Http\Controllers\BkashIndexController;
use App\Http\Controllers\BkashShowController;
use Illuminate\Support\Facades\Route;
use Polashmahmud\Bkash\Http\Controllers\BkashController;

// Admin Panel
Route::get('/bkash', BkashIndexController::class)->name('bkash.index');
Route::get('/bkash-transaction/{bkash}', BkashShowController::class)->name('bkash.show');

// Checkout (URL) User Part
Route::post('/bkash/create', [BkashController::class, 'createPayment'])->name('url-create');
Route::get('/bkash/callback', [BkashController::class, 'callback'])->name('url-callback');

// Checkout (URL) Admin Part
Route::get('/bkash/refund/{bkash}', [BkashController::class, 'getRefund'])->name('url-get-refund');
Route::post('/bkash/refund', [BkashController::class, 'refundPayment'])->name('url-post-refund');
