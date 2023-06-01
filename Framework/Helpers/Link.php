<?php

namespace Framework\Helpers;

use Framework\Routing\Route;

class Link
{
	public static function redirect(string $link)
	{
		header("Location: $link");
	}

	public static function get($routeName)
	{
		$route = Route::getRouteByName($routeName);

		return 'http://' . getallheaders()['Host'] . $route['route'];
	}
}