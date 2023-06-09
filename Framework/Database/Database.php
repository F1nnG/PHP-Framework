<?php

namespace Framework\Database;

use Framework\EdgeHandling\Error;

class Database
{
	private $host;
	private $username;
	private $password;
	private $dbname;
	private $dsn;
	private $conn;

	public function __construct()
	{
		$this->host = '127.0.0.1';
		$this->username = 'root';
		$this->password = '';
		$this->dbname = 'custom_framework';
		$this->dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

		try {
			$this->conn = new \PDO($this->dsn, $this->username, $this->password);
			$this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		} catch (\PDOException $e) {
			throw new Error(500, $e->getMessage());
		}
	}

	public function query(string $query, array $params = []): bool
	{
		$stmt = $this->conn->prepare($query);
		$stmt->execute($params);

		return true;
	}

	public function select(string $query, array $params = []): array
	{
		$stmt = $this->conn->prepare($query);
		$stmt->execute($params);

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function insert(string $query, array $params = []): int
	{
		$stmt = $this->conn->prepare($query);
		$stmt->execute($params);

		return $this->conn->lastInsertId();
	}

	public function update(string $query, array $params = []): bool
	{
		$stmt = $this->conn->prepare($query);
		$stmt->execute($params);

		return true;
	}

	public function freshDatabase(): void
	{
		$tables = $this->select("SELECT TABLE_SCHEMA, TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE';");

		foreach ($tables as $table) {
			if ($table['TABLE_SCHEMA'] === $this->dbname)
				$this->query('DROP TABLE ' . $table['TABLE_NAME']);
		}
	}
}
