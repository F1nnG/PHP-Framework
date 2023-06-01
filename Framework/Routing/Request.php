<?php

namespace Framework\Routing;

class Request
{
	private $request;
	private $server;

	public function __construct(array $request, array $server)
	{
		$this->request = $request;
		$this->server = $server;
	}

	public function input(string|null $key = null): array|string|null
	{
		if ($key)
			return $this->request[$key];

		return $this->request;
	}

	public function server(string|null $key = null): array|string|null
	{
		if ($key)
			return $this->server[$key];

		return $this->server;
	}

	public function url(): string
	{
		return '/' . $this->request['url'];
	}
}