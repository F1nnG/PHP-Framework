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

	public function setModelData($data)
	{
		foreach ($data as $key => $value)
			$this->$key = $value;
	}
}