<?php

namespace Framework\Database;

use Framework\Database\Database;

use function PHPSTORM_META\type;

class Column
{
	private $columnKey;
	private $parent;

	public function __construct($columnKey, $parent)
	{
		$this->columnKey = $columnKey;
		$this->parent = $parent;
	}

	public function nullable()
	{
		$this->parent->columns[$this->columnKey] = str_replace('NOT NULL', 'NULL', $this->parent->columns[$this->columnKey]);
		return $this;
	}

	public function default($value)
	{
		$this->parent->columns[$this->columnKey] .= " DEFAULT '$value'";
		return $this;
	}
}

class Blueprint
{
	private $tableName;
	public $columns = [];

	public function __construct($tableName)
	{
		$this->tableName = $tableName;
	}

	public function build($fresh)
	{
		$columns = implode(', ', $this->columns);
		$sql = "CREATE TABLE $this->tableName ($columns)";

		$db = new Database();

		if ($fresh)
			$db->freshDatabase();

		$db->query("DROP TABLE IF EXISTS $this->tableName");
		$db->query($sql);
		return $sql;
	}

	// Column Types
	public function bigIncrement($columnName)
	{
		$this->columns[] = "$columnName BIGINT AUTO_INCREMENT PRIMARY KEY";

		return new Column(count($this->columns) - 1, $this);
	}

	public function bigInterger($columnName)
	{
		$this->columns[] = "$columnName BIGINT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function binary($columnName)
	{
		$this->columns[] = "$columnName BLOB NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function boolean($columnName)
	{
		$this->columns[] = "$columnName BOOLEAN NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function char($columnName, $length)
	{
		$this->columns[] = "$columnName CHAR($length) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function dateTimeTz($columnName, $precision = 6)
	{
		$this->columns[] = "$columnName DATETIME($precision) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function dateTime($columnName, $precision = 6)
	{
		$this->columns[] = "$columnName DATETIME($precision) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function date($columnName)
	{
		$this->columns[] = "$columnName DATE NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function decimal($columnName, $precision = 8, $scale = 2)
	{
		$this->columns[] = "$columnName DECIMAL($precision, $scale) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function double($columnName, $precision = 8, $scale = 2)
	{
		$this->columns[] = "$columnName DOUBLE($precision, $scale) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function enum($columnName, $values)
	{
		$newValues = [];

		foreach ($values as $value) {
			if (gettype($value) == 'string')
				$newValues[] = "'$value'";
			else
				$newValues[] = $value;
		}
		$enumValues = implode(', ', $newValues);
		$this->columns[] = "$columnName ENUM($enumValues) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function float($columnName, $precision = 8, $scale = 2)
	{
		$this->columns[] = "$columnName FLOAT($precision, $scale) NOT NULL"; 

		return new Column(count($this->columns) - 1, $this);
	}

	public function foreignId($columnName)
	{
		$this->columns[] = "$columnName INT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function geometryCollection($columnName)
	{
		$this->columns[] = "$columnName GEOMETRYCOLLECTION NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function geometry($columnName)
	{
		$this->columns[] = "$columnName GEOMETRY NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function id()
	{
		$this->columns[] = 'id INT AUTO_INCREMENT PRIMARY KEY';
	}

	public function integer($columnName)
	{
		$this->columns[] = "$columnName INT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function ipAddress($columnName)
	{
		$this->columns[] = "$columnName VARCHAR(255) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function json($columnName)
	{
		$this->columns[] = "$columnName JSON NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function linestring($columnName)
	{
		$this->columns[] = "$columnName LINESTRING NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function longText($columnName)
	{
		$this->columns[] = "$columnName LONGTEXT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function mediumInteger($columnName)
	{
		$this->columns[] = "$columnName MEDIUMINT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function mediumText($columnName)
	{
		$this->columns[] = "$columnName MEDIUMTEXT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function multiLineString($columnName)
	{
		$this->columns[] = "$columnName MULTILINESTRING NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function multiPoint($columnName)
	{
		$this->columns[] = "$columnName MULTIPOINT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function multiPolygon($columnName)
	{
		$this->columns[] = "$columnName MULTIPOLYGON NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function point($columnName)
	{
		$this->columns[] = "$columnName POINT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function polygon($columnName)
	{
		$this->columns[] = "$columnName POLYGON NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function set($columnName, $values)
	{
		$newValues = [];

		foreach ($values as $value) {
			if (gettype($value) == 'string')
				$newValues[] = "'$value'";
			else
				$newValues[] = $value;
		}
		$setValues = implode(', ', $newValues);
		$this->columns[] = "$columnName SET($setValues) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function smallInteger($columnName)
	{
		$this->columns[] = "$columnName SMALLINT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function string($columnName)
	{
		$this->columns[] = "$columnName VARCHAR(255) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function text($columnName)
	{
		$this->columns[] = "$columnName TEXT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function timeTz($columnName, $precision = 0)
	{
		$this->columns[] = "$columnName TIME($precision) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function time($columnName, $precision = 0)
	{
		$this->columns[] = "$columnName TIME($precision) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function timestampTz($columnName, $precision = 0)
	{
		$this->columns[] = "$columnName TIMESTAMP($precision) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function tinyInteger($columnName)
	{
		$this->columns[] = "$columnName TINYINT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function tinyText($columnName)
	{
		$this->columns[] = "$columnName TINYTEXT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function year($columnName)
	{
		$this->columns[] = "$columnName YEAR NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}
}