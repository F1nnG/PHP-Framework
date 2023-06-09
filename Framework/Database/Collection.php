<?php

namespace Framework\Database;

class Collection
{
	public $items = [];

	public function __construct(array $items, string $class)
	{
		$modelName = $this->resolveModelName($class);

		foreach ($items as $item) {
			$model = new $modelName();
			$model->setModelData($item);
			$this->items[] = $model;
		}
	}

	public function first()
	{
		return $this->find(0);
	}

	public function last()
	{
		return $this->find(count($this->items) - 1);
	}

	public function find(int $index)
	{
		return $this->items[$index] ?? null;
	}

	private function resolveModelName(string $class): string
	{
		if (!str_contains($class, 'App\\Models\\')) {
			$class = 'App\\Models\\' . $class;
		}

		return $class;
	}
}
