<?php

namespace App\Database\Factories;

use Framework\Database\Factory;

class PostFactory extends Factory
{
	public function definition()
	{
		return [
			'title' => 'Dit is een super mooie titel',
			'content' => 'Dit is de content van de post',
		];
	}
}