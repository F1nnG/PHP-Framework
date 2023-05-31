<?php

namespace Framework\Database;

class Column
{
	private $columnKey;
	private $parent;

	public function __construct(int $columnKey, Blueprint $parent)
	{
		$this->columnKey = $columnKey;
		$this->parent = $parent;
	}

	public function nullable(): Column
	{
		$this->parent->columns[$this->columnKey] = str_replace('NOT NULL', 'NULL', $this->parent->columns[$this->columnKey]);
		return $this;
	}

	public function default($value): Column
	{
		$this->parent->columns[$this->columnKey] .= " DEFAULT '$value'";
		return $this;
	}
}