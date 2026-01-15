<?php

use App\Http\Controllers\GiftController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GiftController::class, 'index'])->name('gifts.index');
Route::resource('gifts', GiftController::class)->except(['index']);