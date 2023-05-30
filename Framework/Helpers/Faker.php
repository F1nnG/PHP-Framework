<?php

namespace Framework\Helpers;

class Faker
{
	private $prefixes;
	private $firstnames;
	private $lastnames;

	public function __construct()
	{
		$this->prefixes = [
			'Mr.',
			'Mrs.',
			'Ms.',
			'Miss',
			'Dr.',
			'Prof.',
		];

		$this->firstnames = [
			'John',
			'Jane',
			'Jack',
			'Jill',
			'James',
			'Jenny',
			'Jasper',
			'Jeroen',
			'Jesse',
			'Jeroen',
			'Jell',
		];

		$this->lastnames = [
			'Doe',
			'Jackson',
			'Johnson',
			'Janssen',
			'Jansen',
			'Janssens',
			'Jans',
			'Janss',
			'Janssens',
			'Janssen',
			'Janssen',
		];
	}

	public function name()
	{
		return $this->prefixes[array_rand($this->prefixes)] . ' ' . $this->firstnames[array_rand($this->firstnames)] . ' ' . $this->lastnames[array_rand($this->lastnames)];
	}

	public function firstname()
	{
		return $this->firstnames[array_rand($this->firstnames)];
	}

	public function lastname()
	{
		return $this->lastnames[array_rand($this->lastnames)];
	}
}