<?php

namespace Framework\Console;

use App\Database\Migrations\Migration;

class Commands
{
	private $colors = [];

	public function __construct()
	{
		$this->colors = [
			'black' => '0;30',
			'blue' => '0;34',
			'green' => '0;32',
			'cyan' => '0;36',
			'red' => '0;31',
			'purple' => '0;35',
			'brown' => '0;33',
			'light_gray' => '0;37',
			'dark_gray' => '1;30',
			'light_blue' => '1;34',
			'light_green' => '1;32',
			'light_cyan' => '1;36',
			'light_red' => '1;31',
			'light_purple' => '1;35',
			'yellow' => '1;33',
			'white' => '1;37',
		];
	}

	public function migrate($arguments)
	{
		if (str_contains('--fresh', $arguments))
			Migration::run(true);
		else
			Migration::run();

		$this->message("Database Migration: ", 'white');
		$this->message("Success\n", 'light_green');
	}

	public function createmodel($arguments)
	{
		$modelName = $arguments[0];

		$filename = "App/Models/$modelName.php";
		$phpCode = "<?php\n\nnamespace App\Models;\n\nuse Framework\Database\Model;\n\nclass $modelName extends Model\n{\n	\n}";

		file_put_contents($filename, $phpCode);
	}

	public function createFactory($arguments)
	{
		$factoryName = $arguments[0];

		$filename = "App/Database/Factories/$factoryName.php";
		$phpCode = "<?php\n\nnamespace App\Database\Factories;\n\nuse Framework\Database\Factory;\n\nclass $factoryName extends Factory\n{\n	public function definition()\n	{\n		return [\n			\n		];\n	}\n}";

		file_put_contents($filename, $phpCode);
	}

	private function message($message, $color)
	{
		echo "\e[" . $this->colors[$color] . "m" . $message . "\e[0m";
	}
}
