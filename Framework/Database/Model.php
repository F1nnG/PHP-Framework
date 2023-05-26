<?php

namespace Framework\Database;

use Framework\Database\Database;
use Framework\Database\Collection;
use Framework\Database\Relationships\oneToOne;
use Framework\Database\Relationships\oneToMany;

class Model
{
	private $db;
	public $id;

	public function __construct()
	{
		$this->db = new Database();
	}

	static public function all()
	{
		$db = new Database();
		$name = basename(get_called_class());

		$models = $db->select("SELECT * FROM " . $name . "s");

		if ($models)
			return new Collection($models, get_called_class());

		return null;
	}

	static public function find($id)
	{
		$db = new Database();
		$name = basename(get_called_class());

		$models = $db->select("SELECT * FROM " . $name . "s WHERE id = :id", ['id' => $id]);
		$collection = new Collection($models, get_called_class());

		if ($collection->first())
			return $collection->first();

		return null;
	}

	static public function Factory($amount = 1)
	{
		$factoryName = 'App\\Database\\Factories\\' . basename(get_called_class()) . 'Factory';
		$factory = new $factoryName($amount);
		return $factory;
	}

	public function oneToOne($class)
	{
		return new oneToOne($class, $this);
	}

	public function oneToMany($class)
	{
		return new oneToMany($class, $this);
		// $name = basename(get_called_class());
		// $foreignKey = strtolower($name) . '_id';

		// $models = $this->db->select("SELECT * FROM " .  str_replace('App\\Models\\', '', $class) . "s WHERE " . $foreignKey . " = :id", ['id' => $this->id]);
		// $collection = new Collection($models, str_replace('App\\Models\\', '', $class));

		// if ($collection->first())
		// 	return $collection;

		// return null;
	}

	public function manyToMany($class, $table, $own_column, $other_column)
	{
		$models = $this->db->select("SELECT * FROM " .  str_replace('App\\Models\\', '', $class) . "s WHERE id IN (SELECT " . $other_column . " FROM " . $table . " WHERE " . $own_column . " = :id)", ['id' => $this->id]);
		$collection = new Collection($models, str_replace('App\\Models\\', '', $class));

		if ($collection->first())
			return $collection;

		return null;
	}

	public function belongsTo($class)
	{
		$models = $this->db->select("SELECT * FROM " .  str_replace('App\\Models\\', '', $class) . "s WHERE id = :id", ['id' => $this->id]);
		$collection = new Collection($models, str_replace('App\\Models\\', '', $class));

		if ($collection->first())
			return $collection->first();

		return null;
	}

	public function setModelData($data)
	{
		foreach ($data as $key => $value)
			$this->$key = $value;
	}
}