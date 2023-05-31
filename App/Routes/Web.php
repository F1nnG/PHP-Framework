<?php

namespace App\Routes;

use Framework\Routing\Route;
use Framework\Routing\Request;
use App\Database\Migration;
use App\Models\User;
use Framework\EdgeHandling\Error;

Route::get('/', function(Request $request) {
	echo 'dit is de homepagina';
});

Route::get('/test', function() {
	echo 'test test';
});

Route::get('/test2', function(Request $request) {
	return new Error(404, 'page not found');
});
