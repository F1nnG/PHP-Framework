<?php

namespace Framework\Console;

use App\Database\Migration;
use App\Database\Seeder;

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

	public function migrate(array $arguments): void
	{
		if (in_array('--fresh', $arguments))
			Migration::run(true);
		else
			Migration::run();

		$this->message("Database Migration: ", 'white');
		$this->message("Complete\n", 'light_green');
	}

	public function seed(array $arguments): void
	{
		Seeder::run();

		$this->message("Database Seeding: ", 'white');
		$this->message("Complete\n", 'light_green');
	}

	public function createcontroller(array $arguments): void
	{
		$controllerName = $arguments[0];

		$filename = "App/Controllers/$controllerName.php";
		$phpCode = "<?php\n\nnamespace App\Controllers;\n\nclass $controllerName\n{\n	\n}";

		file_put_contents($filename, $phpCode);

		$this->message("Controller Creation: ", 'white');
		$this->message("Complete\n", 'light_green');
	}

	public function createservice(array $arguments):void
	{
		$serviceName = $arguments[0];

		$filename = "App/Services/$serviceName.php";
		$phpCode = "<?php\n\nnamespace App\Services;\n\nclass $serviceName\n{\n	\n}";

		file_put_contents($filename, $phpCode);

		$this->message("Service Creation: ", 'white');
		$this->message("Complete\n", 'light_green');
	}

	public function createmodel(array $arguments): void
	{
		$modelName = $arguments[0];

		$filename = "App/Models/$modelName.php";
		$phpCode = "<?php\n\nnamespace App\Models;\n\nuse Framework\Model\Model;\n\nclass $modelName extends Model\n{\n	\n}";

		file_put_contents($filename, $phpCode);

		$this->message("Model Creation: ", 'white');
		$this->message("Complete\n", 'light_green');
	}

	public function createFactory(array $arguments): void
	{
		$factoryName = $arguments[0];

		$filename = "App/Database/Factories/$factoryName.php";
		$phpCode = "<?php\n\nnamespace App\Database\Factories;\n\nuse Framework\Model\Factory;\n\nclass $factoryName extends Factory\n{\n	public function definition()\n	{\n		return [\n			\n		];\n	}\n}";

		file_put_contents($filename, $phpCode);

		$this->message("Factory Creation: ", 'white');
		$this->message("Complete\n", 'light_green');
	}

	private function message(string $message, string $color): void
	{
		echo "\e[" . $this->colors[$color] . "m" . $message . "\e[0m";
	}
}
