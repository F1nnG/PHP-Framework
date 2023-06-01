<?php

namespace Framework\Model;

use Framework\Database\Database;
use Framework\Database\Collection;

class Model
{
	public $id;
	private $modelData = [];

	static public function all(): Collection|null
	{
		$db = new Database();
		$name = basename(get_called_class());

		$models = $db->select("SELECT * FROM " . $name . "s");

		if ($models)
			return new Collection($models, get_called_class());

		return null;
	}

	static public function find(int $id)
	{
		$db = new Database();
		$name = basename(get_called_class());

		$models = $db->select("SELECT * FROM " . $name . "s WHERE id = :id", ['id' => $id]);
		$collection = new Collection($models, get_called_class());

		if ($collection->first())
			return $collection->first();

		return null;
	}

	static public function Factory(int $amount = 1): Factory
	{
		$factoryName = 'App\\Database\\Factories\\' . basename(get_called_class()) . 'Factory';
		$factory = new $factoryName($amount);

		return $factory;
	}

	public function setModelData(array $data): void
	{
		foreach ($data as $key => $value)
			$this->$key = $value;
			$this->modelData[$key] = $value;
	}

	public function save()
	{
		$newData = array_intersect_key(get_object_vars($this), $this->modelData);
		$tableName = strtolower(basename(get_called_class())) . 's';

		$setClauses = array_map(function ($column) {
			return $column . ' = ?';
		}, array_keys($newData));

		$query = "UPDATE $tableName SET " . implode(', ', $setClauses) . " WHERE id = ?";
		$values = array_merge(array_values($newData), [$this->id]);

		$db = new Database();
		$db->update($query, $values);

		return $this;
	}
}