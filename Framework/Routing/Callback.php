<?php

namespace Framework\Routing;

class Callback
{
	private $callback;

	public function __construct($callback)
	{
		$this->callback = $callback;
	}

	public function getParameters()
	{
		$reflection = new \ReflectionFunction($this->callback);
		return $reflection->getParameters();
	}

	public function isCallable()
	{
		return is_callable($this->callback);
	}

	public function call($parameters)
	{
		$functionParameters = [];
		$callbackParameters = $this->getParameters();

		foreach ($callbackParameters as $parameter) {
			if (array_key_exists($parameter->getName(), $parameters))
				$functionParameters[] = $parameters[$parameter->getName()];
			else
				$functionParameters[] = null;
		}

		call_user_func_array($this->callback, $functionParameters);
	}
}