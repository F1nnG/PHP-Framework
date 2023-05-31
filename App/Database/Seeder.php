<?php

namespace App\Database;

use App\Models\User;

class Seeder {
	public static function run()
	{
		User::factory(10)->create();
	}
};