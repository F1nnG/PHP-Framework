<?php

namespace App\Routes;

use Framework\Routing\Route;
use App\Controllers\HomeController;
use App\Controllers\UserController;

Route::get('/', [HomeController::class, 'show']);

Route::get('/users/create', [UserController::class, 'create'], 'users.create');

Route::post('/users/store', [UserController::class, 'store'], 'users.store');
