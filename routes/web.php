<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UploadTemporaryImageController;
use App\Http\Controllers\DeleteTemporaryImageController;
use App\Http\Controllers\StorePostController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class);
Route::post('/upload', UploadTemporaryImageController::class);
Route::delete('/delete', DeleteTemporaryImageController::class);
Route::post('/', StorePostController::class);
