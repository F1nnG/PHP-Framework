<?php

namespace Framework\Database;

use Closure;
use Framework\Database\Blueprint;

class Schema
{
	public static function create(string $tableName, Closure $callback, bool $fresh): void
	{
		$blueprint = $callback(new Blueprint($tableName));

		$blueprint->build($fresh);
	}
}