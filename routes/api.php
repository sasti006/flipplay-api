<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CollectionController;

// Endpoint CRUD Media
Route::apiResource('media', MediaController::class);

// Endpoint pencarian media
Route::get('/media-search', [MediaController::class, 'index']);

// Endpoint User
Route::apiResource('users', UserController::class)
    ->only(['index', 'store', 'show']);

// Endpoint koleksi pengguna
Route::post('/users/{user}/collection/{media}', [CollectionController::class, 'add']);

Route::get('/users/{user}/collection', [CollectionController::class, 'index']);

Route::delete('/users/{user}/collection/{media}', [CollectionController::class, 'remove']);

