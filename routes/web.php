<?php

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\VaccineSearchController;
use Illuminate\Support\Facades\Route;

Route::get('/search', [VaccineSearchController::class, 'showSearchPage']);
Route::post('/search', [VaccineSearchController::class, 'checkStatus']);

Route::get('/', [RegistrationController::class, 'index']);
Route::post('/register', [RegistrationController::class, 'store'])->name('register');
Route::get('/status', [RegistrationController::class, 'checkStatus']);
