<?php

namespace App\Database;

use Framework\Database\Schema;
use Framework\Database\Blueprint;

class Migration {
	public static function run($fresh = false)
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('name');

			return $table;
		}, $fresh);
	}
};