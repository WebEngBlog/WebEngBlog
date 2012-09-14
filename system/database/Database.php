<?php

class Database {

	private $name;

	private $host;

	private $user;

	private $password;

	/**
	 *
	 * @var mysqli_stmt
	 */
	private $statement;

	/**
	 *
	 * @var mysqli
	 */
	private $connection;

	public function __construct($name, $host, $user, $password) {
		$this->name = $name;
		$this->host = $host;
		$this->user = $user;
		$this->password = $password;
	}

	public function connect() {
		$this->connection = @new mysqli($this->host, $this->user, $this->password, $this->name);
		if (mysqli_connect_errno()) {
			die ("Could not connect to database: ". mysqli_connect_error());
		}

		return true;
	}

	public function disconnect() {
		if ($this->connection === null) {
			return false;
		}
		return $this->connection->close();
	}

	public function commit() {
		return $this->connection->commit();
	}

	public function rollback() {
		return $this->connection->rollback();
	}

	public function setAutoCommit($type) {
		$this->connection->autocommit($type);
	}

	public function prepareStatement($sql, $params = null, $result = null, $execute = false) {
		if (is_a($this->statement, "mysqli_stmt")) {
			$this->statement->free_result();	
		}
		
		$this->statement = $this->connection->prepare($sql);
		if (!$this->statement) {
			$this->statement = null;
			throw new mysqli_sql_exception($stat->error);
		}

		if (is_array($params)) {
			$this->bindParams($params);
		}
		
		if (is_array($result)) {
			$this->bindResult($result);
		}
		
		if ($execute === true) {
			$this->executeStatement();
		}

		return $this->statement;
	}

	private function getType($var) {
		switch (gettype($var)) {
			case "boolean":
				return "i";
			case "integer":
				return "i";
			case "double":
				return "d";
			case "string":
				return "s";
			default:
				return "b";
		}
	}
	
	private function getStatement(&$stat) {
		return is_a($stat, "mysqli_stmt") ? $stat : $this->statement;
	}

	public function bindParams(&$params, &$stat = null, $execute = false) {
		$stat = $this->getStatement($stat);
		if (is_array($params)) {
			$types = "";
			$tmp = array();
			foreach ($params as $key => $value) {
				$types .= $this->getType($value);
				$tmp[$key] = &$params[$key];
			}
		}
		
		$tmp = array_merge(array($types), $tmp);
		call_user_func_array(array($stat, "bind_param"), $tmp);
		
		if ($stat->errno) {
			throw new mysqli_sql_exception($stat->error);
		}
		
		if ($execute === true) {
			return $this->executeStatement($stat);
		}
		
		return true;
	}

	public function bindResult(&$result, &$stat = null, $execute = false) {
		$stat = $this->getStatement($stat);
		
		call_user_func_array(array($stat, "bind_result"), $result);
		
		if ($stat->errno) {
			throw new mysqli_sql_exception($stat->error);
		}
		
		if ($execute === true) {
			return $this->executeStatement($stat);
		}
	
		return true;
	}

	/**
	 *
	 * @param mysqli_stmt $stat
	 * @return bool
	 */
	public function executeStatement(&$stat = null) {
		$stat = $this->getStatement($stat);
		if (!$stat->execute()) {
			throw new mysqli_sql_exception($stat->error);
		}
		return true;
	}
	
	/**
	 *
	 * @param mysqli_stmt $stat
	 * @return int
	 */
	public function getLastId(&$stat = null) {
		return $this->getStatement($stat)->insert_id;
	}
	
	/**
	 *
	 * @param mysqli_stmt $stat
	 * @return bool
	 */
	public function fetchStatement(&$stat = null) {
		return $this->getStatement($stat)->fetch();
	}
	
	/**
	 * 
	 * @param mysqli_stmt $stat
	 * @return mysqli_result
	 */
	public function getResult(&$stat = null) {
		return $this->getStatement($stat)->get_result();
	}
	
}

?>