<?php

namespace Framework\EdgeHandling;

class Error
{
	public function __construct(int $type, string $message)
	{
		echo "<h1>$type: $message</h1>";
	}
}