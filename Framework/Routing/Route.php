<?php

namespace Framework\Routing;

use Framework\Routing\Callback;
use Framework\EdgeHandling\Error;

class Route
{
	private static $routes = [];

	public static function get(string $route, \Closure $callback)
	{
		self::createRoute($route, $callback, 'GET');
	}

	public static function post(string $route, \Closure $callback)
	{
		self::createRoute($route, $callback, 'POST');
	}

	private static function createRoute(string $route, \Closure $callback, string $method)
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

	public static function route(Request $request): bool|Error
	{
		$route = self::getRoute($request->url());

		if (!$route)
			return new Error(404, 'Page ' . $request->url() . ' Not Found');

		if (!self::isCallable($route))
			return new Error(404, 'Method Not Found');

		self::triggerRoute($route, $request);

		return true;
	}

	private static function getRoute(string $url): array|null
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

	private static function isCallable(array $route): bool
	{
		return $route['callback']->isCallable();
	}

	private static function triggerRoute(array $route, Request $request): void
	{
		$params = ['request' => $request];

		if ($route['usesModel']) {
			$model = 'App\\Models\\' . $route['model'];
			$params[strtolower($route['model'])] = $model::find($route['id']);
		}

		$route['callback']->call($params);
	}
}