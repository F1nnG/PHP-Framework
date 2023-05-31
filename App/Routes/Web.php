<?php

namespace App\Routes;

use Framework\Routing\Route;
use Framework\Routing\Request;

Route::get('/', function(Request $request) {
	echo 'This is the homepage';
});

Route::get('/test', function() {
	echo 'test test';
});
