<?php

namespace Framework\Routing;

class Request
{
	private $request;
	private $server;

	public function __construct($request, $server)
	{
		$this->request = $request;
		$this->server = $server;
	}

	public function input($key = null)
	{
		if ($key)
			return $this->request[$key];

		return $this->request;
	}

	public function server($key = null)
	{
		if ($key)
			return $this->server[$key];

		return $this->server;
	}

	public function url()
	{
		return '/' . $this->request['url'];
	}
}