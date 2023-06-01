<?php

namespace App\Database\Factories;

use Framework\Model\Factory;

class UserFactory extends Factory
{
	public function definition()
	{
		return [
			'name' => $this->faker()->name(),
			'email' => $this->faker()->email(),
			'age' => $this->faker()->numberBetween(18, 60),
		];
	}
}