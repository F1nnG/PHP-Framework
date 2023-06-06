<?php

namespace App\Routes;

use Framework\Routing\Route;
use App\Controllers\HomeController;
use App\Controllers\UserController;

Route::get('/', [HomeController::class, 'show']);

Route::get('/users', [UserController::class, 'index'], 'users.index');
Route::get('/users/{User}', [UserController::class, 'show'], 'users.show');
Route::get('/users/create', [UserController::class, 'create'], 'users.create');
Route::get('/users/{User}/edit', [UserController::class, 'edit'], 'users.edit');

Route::post('/users/store', [UserController::class, 'store'], 'users.store');
Route::post('/users/{User}/update', [UserController::class, 'update'], 'users.update');
Route::post('/users/{User}/destroy', [UserController::class, 'destroy'], 'users.destroy');

use Framework\Routing\Request;
Route::get('/test', function (Request $request) {
	$request->validate([
		'name' => 'required|string|integer',
	]);
});
