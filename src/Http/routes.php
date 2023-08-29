<?php

use DeMemory\LockScreen\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('auth/lock', Controllers\LockScreenController::class . '@lock')->name('de-memory.lock-screen.lock');
Route::post('auth/unlock', Controllers\LockScreenController::class . '@unlock')->name('de-memory.lock-screen.unlock');

