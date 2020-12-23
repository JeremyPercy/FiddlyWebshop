<?php
/**
 * Copyright (c) 2018.
 * Created by Jeremy-Percy Batten
 * Project Fiddly 2018
 */

	/*
	 * PDO Database class
	 * Connect toe database
	 * Create prepared statements
	 * Bind values
	 * Return rows and results
	 */

	class Database {
		private $host = DB_HOST;
		private $user = DB_USER;
		private $pass = DB_PASS;
		private $dbname = DB_NAME;

		private $dbh;
		private $stmt;
		private $error;

		public function __construct() {
			// set DSN
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
			$options = array(
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);

			// Create PDO instance
			try {
				$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
			} catch (PDOException $e) {
				$this->error = $e->getMessage();
				echo $this->error;
			}
		}

		// Prepare statement with query
		public function query($sql) {
			$this->stmt = $this->dbh->prepare($sql);
		}

		// Bind values
		public function bind($param, $value, $type = null) {
			if (is_null($type)) {
				switch (true) {
					case is_int($value):
						$type = PDO::PARAM_INT;
						break;
					case is_bool($value):
						$type = PDO::PARAM_BOOL;
						break;
					case is_null($value):
						$type = PDO::PARAM_NULL;
						break;
					default:
						$type = PDO::PARAM_STR;
				}
			}

			$this->stmt->bindValue($param, $value, $type);
		}

		// Execute the prepared statement
		public function execute() {
			return $this->stmt->execute();
		}

		// Get result set as a array of objects
		public function resultSet() {
			$this->execute();
			return $this->stmt->fetchAll(PDO::FETCH_OBJ);
		}

		// Get single record as object
		public function single() {
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_OBJ);
		}

		// Get row count
		public function rowCount() {
			return $this->stmt->rowCount();
		}

		/**
		 * http://thisinterestsme.com/pdo-prepared-multi-inserts/
		 * A custom function that automatically constructs a multi insert statement.
		 *
		 * @param string $tableName Name of the table we are inserting into.
		 * @param array $data An "array of arrays" containing our row data.
		 * @param PDO $pdoObject Our PDO object.
		 * @return boolean TRUE on success. FALSE on failure.
		 */

		public function pdoMultiInsert($tableName, $data, $columnNames = array()){

			//Will contain SQL snippets.
			$rowsSQL = array();

			//Will contain the values that we need to bind.
			$toBind = array();

			//Loop through our $data array.
			foreach($data as $arrayIndex => $row){
				$params = array();
				foreach($row as $columnName => $columnValue){
					$param = ":" . $columnName . $arrayIndex;
					$params[] = $param;
					$toBind[$param] = $columnValue;
				}
				$rowsSQL[] = "(" . implode(", ", $params) . ")";
			}

			//Construct our SQL statement
			$sql = "INSERT INTO `$tableName` (" . implode(", ", $columnNames) . ") VALUES " . implode(", ", $rowsSQL);

			//Prepare our PDO statement.
			$pdoStatement = $this->dbh->prepare($sql);

			//Bind our values.
			foreach($toBind as $param => $val){
				$pdoStatement->bindValue($param, $val);
			}

			//Execute our statement (i.e. insert the data).
			return $pdoStatement->execute();
		}

		public function lastInsertId(){
			return  $this->dbh->lastInsertId();
		}

	}