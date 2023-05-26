<?php

namespace Framework\Database\Relationships;

use Framework\Database\Database;
use Framework\Database\Collection;

class oneToMany
{
	private $db;
	private $model;
	public $collection;

	public function __construct($class, $model)
	{
		$this->db = new Database();
		$this->model = $model;
		$this->setModelData($class, $model);
	}

	public function attach($model)
	{
		$name = strtolower(basename(get_class($this->model))) . '_id';

		$this->db->update("UPDATE " . str_replace('App\\Models\\', '', get_class($model)) . "s SET " . $name . " = :id WHERE id = :id", ['id' => $this->model->id]);
	}

	private function setModelData($class, $model)
	{
		$name = basename(get_class($model));
		$foreignKey = strtolower($name) . '_id';

		$models = $this->db->select("SELECT * FROM " .  str_replace('App\\Models\\', '', $class) . "s WHERE " . $foreignKey . " = :id", ['id' => $model->id]);

		if (count($models) <= 0)
			return;

		$collection = new Collection($models, str_replace('App\\Models\\', '', $class));
		$this->collection = $collection->items;
	}
}