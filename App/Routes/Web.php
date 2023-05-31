<?php

namespace App\Routes;

use Framework\Routing\Route;
use Framework\Views\View;

Route::get('/', function() {
	return View::render('home', [
		'maker' => 'Finn',
	]);
});
