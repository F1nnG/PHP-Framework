<?php

namespace Framework\Database;

abstract class Factory
{
	protected $amount;
	protected $factoryData;
	protected $modelName;
	protected $lowerModelName;

	abstract protected function definition();

	public function __construct($amount = 1)
	{
		$this->amount = $amount;
		$this->factoryData = $this->definition();
		$this->modelName = str_replace('Factory', '', basename(get_called_class()));
		$this->lowerModelName = strtolower($this->modelName);
	}

	public function state($states)
	{
		foreach ($states as $key => $state) {
			$this->factoryData[$key] = $state;
		}

		return $this;
	}

	public function create()
	{
		$models = [];
		for ($i = 0; $i < $this->amount; $i++) {
			$definition = $this->factoryData;

			$columns = '';
			$values = '';
			$bindings = [];

			foreach ($definition as $key => $value) {
				$columns .= $key . ', ';
				$values .= ':' . $key . ', ';
				$bindings[$key] = $value;
			}

			$columns = rtrim($columns, ', ');
			$values = rtrim($values, ', ');

			$sql = "INSERT INTO " . $this->lowerModelName . "s (" . $columns . ") VALUES (" . $values . ")";

			$db = new Database();

			$id = $db->insert($sql, $bindings);
			$models[] = $db->select("SELECT * FROM " . $this->lowerModelName . "s WHERE id = :id", ['id' => $id])[0];
		}

		$collection = new Collection($models, $this->modelName);

		if ($this->amount == 1)
			return $collection->first();
		return $collection;
	}
}