<?php

	class adminModel {

		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		//Count users for admin
		public function countEntity($entity) {
			$this->db->query('SELECT * FROM '.$entity);
			$this->db->bind(':entity', $entity);

			$results = $this->db->resultSet();

			return $this->db->rowCount();
		}
	}