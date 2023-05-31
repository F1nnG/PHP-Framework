<?php

namespace Framework\Routing;

use Framework\Routing\Callback;
use App\Models;

class Route
{
	private $routes = [];

	public function get($route, $callback)
	{
		$pattern = '/{(?<Model>[a-zA-Z]*)}/m';

		preg_match_all($pattern, $route, $matches, PREG_SET_ORDER, 0);

		$usesModel = array_key_exists(0, $matches);

		if ($usesModel) {
			$regex = str_replace('/', '\/', $route);
			$regex = str_replace('{' . $matches[0]['Model'] . '}', '(?<id>[0-9]*)', $regex);
		}

		$this->routes[$route] = [
			'callback' => new Callback($callback),
			'method' => 'GET',
			'usesModel' => $usesModel,
			'model' => $usesModel ? $matches[0]['Model'] : null,
			'regex' => $usesModel ? $regex : null,
		];
	}

	public function post($route, $callback)
	{
		$this->routes[$route] = [
			'callback' => new Callback($callback),
			'method' => 'POST',
		];
	}

	public function route(Request $request)
	{
		$route = $this->getRoute($request->url());

		if (!$route) {
			echo 'invalid route';
			return;
		}

		if (!$this->isCallable($route)) {
			echo 'invalid callback';
			return;
		}

		$this->triggerRoute($route, $request);
	}

	private function isCallable($route)
	{
		return $route['callback']->isCallable();
	}

	private function getRoute($url)
	{
		if (array_key_exists($url, $this->routes))
			return $this->routes[$url];

		foreach ($this->routes as $route) {
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

	private function triggerRoute($route, $request)
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