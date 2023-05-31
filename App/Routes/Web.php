<?php

namespace App\Routes;

use Framework\Routing\Route;
use Framework\Routing\Request;
use App\Database\Migrations\Migration;
use App\Models\User;
use Framework\EdgeHandling\Error;

class Web
{
	public function __construct(Route $route)
	{
		$route->get('/test', function() {
			echo 'hallo';
		});

		$route->get('/test2', function(Request $request) {
			return new Error(404, 'page not found');
		});
	}
}
