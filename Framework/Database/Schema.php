<?php

namespace Framework\Database;

use Framework\Database\Blueprint;

class Schema
{
	public static function create($tableName, $callback)
	{
		$blueprint = $callback(new Blueprint($tableName));

		return $blueprint->build();
	}
}