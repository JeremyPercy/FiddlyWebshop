<?php
	/**
	 * Copyright in opdracht van Fiddly
	 */

	/**
	 * Created by PhpStorm.
	 * User: yweij
	 * Date: 3-6-2018
	 * Time: 13:42
	 */
	class Tracker {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function addFiddlyToUserProfile($data) {
			$this->db->query('INSERT INTO fiddly_gps (`name`, image_link, user_id_FK, serialnumber_id_FK) VALUES (:trackerName, :image, :user_id, :serial)');
			$this->db->bind('trackerName', $data['name']);
			$this->db->bind('image', $data['image_link']);
			$this->db->bind('user_id', $data['user_id']);
			$this->db->bind('serial', $data['serial_id']);

			$this->db->execute();

			if ($this->addFiddlyGpsData($this->db->lastInsertId(), $data['location'])) {
				return true;
			} else {
				return false;
			}

			// Execute
		}

		public function editFiddly($data) {
			$this->db->query('UPDATE `fiddly_gps` SET `name` = :name, `image_link` = :image_link WHERE fiddly_gps_id = :id');
			$this->db->bind('name', $data['name']);
			$this->db->bind('image_link', $data['image_link']);
			$this->db->bind('id', $data['id']);

			// Execute
			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function removeFiddly($id) {
			$this->removeFiddlyData($id);
			$this->db->query('DELETE FROM fiddly_gps WHERE fiddly_gps_id = :id');
			$this->db->bind('id', $id);
			$this->db->execute();
		}

		public function removeFiddlyData($id) {
			$this->db->query('DELETE FROM `fiddly_gps_data` WHERE `fiddly_gps_id_FK` = :id');
			$this->db->bind('id', $id);

			return $this->db->execute();
		}

		public function findFiddlyBySerialAndOrderId($serial, $id) {
			$this->db->query('SELECT * FROM serialnumber where order_id_FK = :id AND `number` = :serial');
			$this->db->bind('id', $id);
			$this->db->bind('serial', $serial);

			$result = $this->db->single();

			return $result;
		}

		public function findFiddlyBySerial($serial) {
			$this->db->query('SELECT * FROM fiddly_gps WHERE serialnumber_id_FK = :serial');
			$this->db->bind('serial', $serial);

			$result = $this->db->single();

			return $result;
		}

		public function addFiddlyGpsData($serialId, $location) {
			$this->db->query('INSERT INTO `fiddly_gps_data` (`longitude`, `lattitude`, `battery_status`,`fiddly_gps_id_FK`)
            VALUES (:longitude, :lattitude, :battery_status, :serialnumber_id_FK)');

			$this->db->bind('longitude', $location['longitude']);
			$this->db->bind('lattitude', $location['lattitude']);
			$this->db->bind('battery_status', rand(45, 100)); //random battery status
			$this->db->bind('serialnumber_id_FK', $serialId);

			return ($this->db->execute());

		}

		public function checkIfUserIsOwner($fiddly_gps_id) {
			$this->db->query('SELECT * FROM `fiddly_gps` WHERE `fiddly_gps_id` = :id AND `user_id_FK` = :userId');
			$this->db->bind('id', $fiddly_gps_id);
			$this->db->bind('userId', $_SESSION['user_id']);

			return $this->db->single();

		}

		public function getAllFiddlysByUser() {
			$this->db->query('SELECT * FROM `fiddly_gps` JOIN `fiddly_gps_data` ON `fiddly_gps_id_FK` = `fiddly_gps_id` WHERE `user_id_FK` = :userId');
			$this->db->bind('userId', $_SESSION['user_id']);


			return $this->db->resultSet();
		}

		public function getFiddly($id) {
			$this->db->query('SELECT * FROM `fiddly_gps` JOIN `fiddly_gps_data` ON `fiddly_gps_id_FK` = `fiddly_gps_id` WHERE `fiddly_gps_id` = :id');
			$this->db->bind('id', $id);


			return $this->db->resultSet();
		}

		public function updateLocations($aLocations, $id) {
			$this->db->query('UPDATE `fiddly_gps_data` SET `longitude` = :longitude, `lattitude` = :lattitude WHERE `fiddly_gps_data_id` = :id');
			$this->db->bind('longitude', $aLocations['longitude']);
			$this->db->bind('lattitude', $aLocations['lattitude']);
			$this->db->bind('id', $id);

			return ($this->db->execute());

		}

		public function getFiddlyPicture($id) {
			$this->db->query('SELECT `image_link` FROM `fiddly_gps` where `fiddly_gps_id` = :id');
			$this->db->bind('id', $id);

			return $this->db->single();
		}


	}