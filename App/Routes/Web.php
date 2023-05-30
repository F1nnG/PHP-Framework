<?php

namespace App\Routes;

use Framework\Routing\Route;
use Framework\Routing\Request;
use App\Database\Migrations\Migration;
use App\Models\User;

class Web
{
	public function __construct(Route $route)
	{
		$route->get('/test', function() {
			echo 'hallo';
		});

		$route->get('/test2', function(Request $request) {
			Migration::run();

			$user = User::Factory(10)->create();

			echo '<pre>';
			print_r($user);
			// print_r($user);
			// print_r($profile);
			// print_r($posts);
			echo '</pre>';
		});
	}
}
