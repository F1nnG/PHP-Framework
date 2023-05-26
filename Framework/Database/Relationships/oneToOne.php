<?php

namespace Framework\Database\Relationships;

use Framework\Database\Database;

class oneToOne
{
	private $db;
	private $model;

	public function __construct($class, $model)
	{
		$this->db = new Database();
		$this->model = $model;
		$this->setModelData($class, $model);
	}

	public function attach($model)
	{
		$name = strtolower(basename(get_class($this->model))) . '_id';

		$this->db->update("UPDATE " . str_replace('App\\Models\\', '', get_class($model)) . "s SET " . $name . " = :id WHERE id = :id", ['id' => $model->id]);
	}

	private function setModelData($class, $model)
	{
		$name = basename(get_class($model));
		$foreignKey = strtolower($name) . '_id';

		$models = $this->db->select("SELECT * FROM " .  str_replace('App\\Models\\', '', $class) . "s WHERE " . $foreignKey . " = :id", ['id' => $model->id]);

		if (count($models) <= 0)
			return;

		foreach ($models[0] as $key => $value)
			$this->$key = $value;
	}
}