<?php

namespace Framework\Database;

use Framework\Database\Database;
use Framework\Database\Column;

class Blueprint
{
	private $tableName;
	public $columns = [];

	public function __construct(string $tableName)
	{
		$this->tableName = $tableName;
	}

	public function build(bool $fresh): void
	{
		$columns = implode(', ', $this->columns);
		$sql = "CREATE TABLE $this->tableName ($columns)";

		$db = new Database();

		if ($fresh)
			$db->freshDatabase();

		$db->query("DROP TABLE IF EXISTS $this->tableName");
		$db->query($sql);
	}

	// Column Types
	public function bigIncrement(string $columnName): Column
	{
		$this->columns[] = "$columnName BIGINT AUTO_INCREMENT PRIMARY KEY";

		return new Column(count($this->columns) - 1, $this);
	}

	public function bigInterger(string $columnName): Column
	{
		$this->columns[] = "$columnName BIGINT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function binary(string $columnName): Column
	{
		$this->columns[] = "$columnName BLOB NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function boolean(string $columnName): Column
	{
		$this->columns[] = "$columnName BOOLEAN NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function char(string $columnName, int $length): Column
	{
		$this->columns[] = "$columnName CHAR($length) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function dateTimeTz(string $columnName, int $precision = 6): Column
	{
		$this->columns[] = "$columnName DATETIME($precision) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function dateTime(string $columnName, int $precision = 6): Column
	{
		$this->columns[] = "$columnName DATETIME($precision) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function date(string $columnName): Column
	{
		$this->columns[] = "$columnName DATE NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function decimal(string $columnName, int $precision = 8, int $scale = 2): Column
	{
		$this->columns[] = "$columnName DECIMAL($precision, $scale) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function double(string $columnName, int $precision = 8, int $scale = 2): Column
	{
		$this->columns[] = "$columnName DOUBLE($precision, $scale) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function enum(string $columnName, array $values): Column
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

	public function float(string $columnName, int $precision = 8, int $scale = 2): Column
	{
		$this->columns[] = "$columnName FLOAT($precision, $scale) NOT NULL"; 

		return new Column(count($this->columns) - 1, $this);
	}

	public function foreignId(string $columnName): Column
	{
		$this->columns[] = "$columnName INT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function geometryCollection(string $columnName): Column
	{
		$this->columns[] = "$columnName GEOMETRYCOLLECTION NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function geometry(string $columnName): Column
	{
		$this->columns[] = "$columnName GEOMETRY NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function id(): void
	{
		$this->columns[] = 'id INT AUTO_INCREMENT PRIMARY KEY';
	}

	public function integer(string $columnName): Column
	{
		$this->columns[] = "$columnName INT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function ipAddress(string $columnName): Column
	{
		$this->columns[] = "$columnName VARCHAR(255) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function json(string $columnName): Column
	{
		$this->columns[] = "$columnName JSON NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function linestring(string $columnName): Column
	{
		$this->columns[] = "$columnName LINESTRING NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function longText(string $columnName): Column
	{
		$this->columns[] = "$columnName LONGTEXT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function mediumInteger(string $columnName): Column
	{
		$this->columns[] = "$columnName MEDIUMINT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function mediumText(string $columnName): Column
	{
		$this->columns[] = "$columnName MEDIUMTEXT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function multiLineString(string $columnName): Column
	{
		$this->columns[] = "$columnName MULTILINESTRING NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function multiPoint(string $columnName): Column
	{
		$this->columns[] = "$columnName MULTIPOINT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function multiPolygon(string $columnName): Column
	{
		$this->columns[] = "$columnName MULTIPOLYGON NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function point(string $columnName): Column
	{
		$this->columns[] = "$columnName POINT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function polygon(string $columnName): Column
	{
		$this->columns[] = "$columnName POLYGON NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function set(string $columnName, array $values): Column
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

	public function smallInteger(string $columnName): Column
	{
		$this->columns[] = "$columnName SMALLINT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function string(string $columnName): Column
	{
		$this->columns[] = "$columnName VARCHAR(255) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function text(string $columnName): Column
	{
		$this->columns[] = "$columnName TEXT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function timeTz(string $columnName, int $precision = 0): Column
	{
		$this->columns[] = "$columnName TIME($precision) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function time(string $columnName, int $precision = 0): Column
	{
		$this->columns[] = "$columnName TIME($precision) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function timestampTz(string $columnName, int $precision = 0): Column
	{
		$this->columns[] = "$columnName TIMESTAMP($precision) NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function tinyInteger(string $columnName): Column
	{
		$this->columns[] = "$columnName TINYINT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function tinyText(string $columnName): Column
	{
		$this->columns[] = "$columnName TINYTEXT NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}

	public function year(string $columnName): Column
	{
		$this->columns[] = "$columnName YEAR NOT NULL";

		return new Column(count($this->columns) - 1, $this);
	}
}
