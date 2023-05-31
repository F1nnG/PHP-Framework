<?php

namespace App\Database\Factories;

use Framework\Model\Factory;

class UserFactory extends Factory
{
	public function definition()
	{
		return [
			'name' => $this->faker()->name(),
		];
	}
}