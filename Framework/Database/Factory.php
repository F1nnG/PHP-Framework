<?php

namespace Framework\Database;

use Framework\Helpers\Faker;

abstract class Factory
{
	protected $amount;
	protected $factoryData = [];
	protected $modelName;
	protected $lowerModelName;

	abstract protected function definition();

	public function __construct(int $amount = 1)
	{
		$this->amount = $amount;
		$this->modelName = str_replace('Factory', '', basename(get_called_class()));
		$this->lowerModelName = strtolower($this->modelName);
	}

	public function state(array $states): Factory
	{
		foreach ($states as $key => $state) {
			$this->factoryData[$key] = $state;
		}

		return $this;
	}

	public function create(): Collection|Model
	{
		$models = [];
		for ($i = 0; $i < $this->amount; $i++) {
			$definition = $this->definition();

			$data = $this->getColumnsAndValues($definition);

			$columns = rtrim($data['columns'], ', ');
			$values = rtrim($data['values'], ', ');

			$db = new Database();
			$sql = "INSERT INTO " . $this->lowerModelName . "s (" . $columns . ") VALUES (" . $values . ")";
			$id = $db->insert($sql, $data['bindings']);

			$models[] = $db->select("SELECT * FROM " . $this->lowerModelName . "s WHERE id = :id", ['id' => $id])[0];
		}

		$collection = new Collection($models, $this->modelName);

		if ($this->amount == 1)
			return $collection->first();
		return $collection;
	}

	private function getColumnsAndValues(array $definition): array
	{
		$columns = '';
		$values = '';
		$bindings = [];

		foreach ($definition as $key => $value) {
			if (array_key_exists($key, $this->factoryData)) {
				$columns .= $key . ', ';
				$values .= ':' . $key . ', ';
				$bindings[$key] = $this->factoryData[$key];
			} else {
				$columns .= $key . ', ';
				$values .= ':' . $key . ', ';
				$bindings[$key] = $value;
			}
		}

		return [
			'columns' => $columns,
			'values' => $values,
			'bindings' => $bindings,
		];
	}

	protected function faker()
	{
		return new Faker();
	}
}