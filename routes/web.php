<?php

use Illuminate\Support\Facades\Route;

Route::get('/bkash', function () {
    return 'Hello from the bkash package!';
})->name('bkash');
