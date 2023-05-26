<?php

namespace Framework\Database;

class Collection
{
	public $items = [];

	public function __construct($items, $class)
	{
		$modelName = 'App\\Models\\' . $class;
		foreach ($items as $item) {
			$model = new $modelName();
			$model->setModelData($item);
			$this->items[] = $model;
		}
	}

	public function first()
	{
		if (array_key_exists(0, $this->items))
			return $this->items[0];
		return null;
	}

	public function last()
	{
		if (array_key_exists(count($this->items) - 1, $this->items))
			return $this->items[count($this->items) - 1];
		return null;
	}
}