<?php

use App\Http\Controllers\CryptoController;
use Illuminate\Support\Facades\Route;

Route::post('/encode', [CryptoController::class, 'encode']);
Route::get('/decode', [CryptoController::class, 'decode']);
