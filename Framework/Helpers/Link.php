<?php

namespace Framework\Helpers;

use Framework\Routing\Route;

class Link
{
	public static function redirect(string $link)
	{
		header("Location: $link");
	}

	public static function get($routeName, $modelId = null)
	{
		$route = Route::getRouteByName($routeName);

		if ($route['usesModel']) {
			$route['route'] = str_replace('{' . $route['model'] . '}', $modelId, $route['route']);
		}

		return 'http://' . getallheaders()['Host'] . $route['route'];
	}
}