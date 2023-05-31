<?php

namespace Framework\Routing;

use Framework\Routing\Callback;
use Framework\EdgeHandling\Error;

class Route
{
	private static $routes = [];

	public static function get($route, $callback)
	{
		self::createRoute($route, $callback, 'GET');
	}

	public static function post($route, $callback)
	{
		self::createRoute($route, $callback, 'POST');
	}

	private static function createRoute($route, $callback, $method)
	{
		$pattern = '/{(?<Model>[a-zA-Z]*)}/m';

		preg_match_all($pattern, $route, $matches, PREG_SET_ORDER, 0);

		$usesModel = array_key_exists(0, $matches);

		if ($usesModel) {
			$regex = str_replace('/', '\/', $route);
			$regex = str_replace('{' . $matches[0]['Model'] . '}', '(?<id>[0-9]*)', $regex);
		}

		self::$routes[$route] = [
			'callback' => new Callback($callback),
			'method' => $method,
			'usesModel' => $usesModel,
			'model' => $usesModel ? $matches[0]['Model'] : null,
			'regex' => $usesModel ? $regex : null,
		];
	}

	public static function route(Request $request)
	{
		$route = self::getRoute($request->url());

		if (!$route)
			return new Error(404, 'Page ' . $request->url() . ' Not Found');

		if (!self::isCallable($route))
			return new Error(404, 'Method Not Found');

		self::triggerRoute($route, $request);
	}

	private static function isCallable($route)
	{
		return $route['callback']->isCallable();
	}

	private static function getRoute($url)
	{
		if (array_key_exists($url, self::$routes))
			return self::$routes[$url];

		foreach (self::$routes as $route) {
			preg_match_all('/' . $route['regex'] . '/', $url, $matches, PREG_SET_ORDER, 0);

			if (array_key_exists(0, $matches)) {
				if (array_key_exists('id', $matches[0])) {
					$route['id'] = $matches[0]['id'];
					return $route;
				}
			}
		}

		return null;
	}

	private static function triggerRoute($route, $request)
	{
		if ($route['usesModel']) {
			$model = 'App\\Models\\' . $route['model'];
			$route['callback']->call([
				'request' => $request,
				strtolower($route['model']) => $model::find($route['id']),
			]);
		} else {
			$route['callback']->call([
				'request' => $request,
			]);
		}
	}
}