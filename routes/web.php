<?php

use App\Http\Controllers\DataforseoController;
use Illuminate\Support\Facades\Route;

Route::resource('/', DataforseoController::class)->only(['index', 'create', 'store']);
Route::post('own-post-endpoint', [DataforseoController::class, 'store'])->name('own-post-endpoint');
