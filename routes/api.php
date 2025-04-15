<?php

use App\Http\Controllers\CryptoController;
use Illuminate\Support\Facades\Route;

Route::get('/encode', [CryptoController::class, 'encode']);
Route::get('/decode', [CryptoController::class, 'decode']);
