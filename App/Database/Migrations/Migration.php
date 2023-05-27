<?php

namespace App\Database\Migrations;

use Framework\Database\Schema;
use Framework\Database\Blueprint;

class Migration {
	public static function run()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('name');

			return $table;
		});
	}
};