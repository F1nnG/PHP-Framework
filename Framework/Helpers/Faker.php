<?php

namespace Framework\Helpers;

class Faker
{
	private $prefixes;
	private $firstnames;
	private $lastnames;
	private $emails;

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

		$this->emails = [
			'@gmail.com',
			'@hotmail.com',
			'@outlook.com',
			'@example.com',
			'@example.org',
			'@yahoo.com',
			'@live.com',
			'@live.nl',
			'@live.be',
		];
	}

	public function name(): string
	{
		return $this->prefixes[array_rand($this->prefixes)] . ' ' . $this->firstnames[array_rand($this->firstnames)] . ' ' . $this->lastnames[array_rand($this->lastnames)];
	}

	public function firstname(): string
	{
		return $this->firstnames[array_rand($this->firstnames)];
	}

	public function lastname(): string
	{
		return $this->lastnames[array_rand($this->lastnames)];
	}

	public function number(): int
	{
		return rand(0, 2147483647);
	}

	public function numberBetween(int $min, int $max): int
	{
		return rand($min, $max);
	}

	public function email(): string
	{
		return $this->firstname() . '.' . $this->lastname() . $this->emails[array_rand($this->emails)];
	}

	public function password(): string
	{
		return password_hash('password', PASSWORD_DEFAULT);
	}

	public function date(): string
	{
		return date('d-m-Y', mktime(0, 0, 0, rand(1, 12), rand(1, 28), rand(1900, 2020)));
	}

	public function datetime(): string
	{
		return date('d-m-Y H:i:s', mktime(rand(0, 23), rand(0, 59), rand(0, 59), rand(1, 12), rand(1, 28), rand(1900, 2020)));
	}

	public function time(): string
	{
		return date('H:i:s', mktime(rand(0, 23), rand(0, 59), rand(0, 59), rand(1, 12), rand(1, 28), rand(1900, 2020)));
	}

	public function text(int $length = 255): string
	{
		$text = '';
		$possible = ' ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz 0123456789 ';

		for ($i = 0; $i < $length; $i++) {
			$text .= $possible[rand(0, strlen($possible) - 1)];
		}

		return $text;
	}

	public function textBetween(int $min, int $max): string
	{
		$text = '';
		$possible = ' ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz 0123456789 ';

		for ($i = 0; $i < rand($min, $max); $i++) {
			$text .= $possible[rand(0, strlen($possible) - 1)];
		}

		return $text;
	}
}