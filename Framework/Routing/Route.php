<?php

namespace Framework\Routing;

use Framework\Routing\Callback;

class Route
{
	private $routes = [];

	public function get($route, $callback)
	{
		$this->routes[$route] = [
			'callback' => new Callback($callback),
			'method' => 'GET',
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
		if (!$this->doesRouteExist($request->url())) {
			echo $request->url() . ' not found';
			return;
		}

		if (!$this->isCallable($request->url())) {
			echo 'invalid callback';
			return;
		}

		$this->routes[$request->url()]['callback']->call([
			'request' => $request,
		]);
	}

	private function doesRouteExist($url)
	{
		return array_key_exists($url, $this->routes);
	}

	private function isCallable($url)
	{
		return $this->routes[$url]['callback']->isCallable();
	}
}