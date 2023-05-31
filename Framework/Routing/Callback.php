<?php

namespace Framework\Routing;

class Callback
{
	private $callback;

	public function __construct($callback)
	{
		$this->callback = $callback;
	}

	public function getParameters(): array
	{
		$reflection = new \ReflectionFunction($this->callback);
		return $reflection->getParameters();
	}

	public function isCallable(): bool
	{
		return is_callable($this->callback);
	}

	public function call(array $parameters): void
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