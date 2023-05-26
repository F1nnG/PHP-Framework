<?php

namespace App\Database\Factories;

use Framework\Database\Factory;

class TagFactory extends Factory
{
	public function definition()
	{
		return [
			'name' => 'coole tag',
		];
	}
}