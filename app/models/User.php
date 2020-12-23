<?php
/**
 * Copyright (c) 2018.
 * Created by Jeremy-Percy Batten
 * Project Fiddly 2018
 */

class User {
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  // Register user
  public function register($data) {
    $this->db->query('INSERT INTO user (name, email, password) VALUES(:name, :email, :password)');
    // Bind values
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);

    // Execute
    if ($this->db->execute()){
      return true;
    } else {
      return false;
    }
  }

  // create user data table
  public function createUserData($data) {
    $this->db->query('INSERT INTO user_data (address, city, zipcode, country, phone, date_of_birth, user_id_FK) VALUE (:address, :city, :zipcode, :country, :phone, :date_of_birth, :id)');
    // Bind value
    $this->db->bind(':id', $data['user_id']);
    $this->db->bind(':address', $data['address']);
    $this->db->bind(':city', $data['city']);
    $this->db->bind(':zipcode', $data['zipcode']);
    $this->db->bind(':country', $data['country']);
    $this->db->bind(':phone', $data['phone']);
    $this->db->bind(':date_of_birth', $data['date_of_birth']);
    // Execute
    if ($this->db->execute()){
      return true;
    } else {
      return false;
    }
  }

  // Login user
  public function login($email, $password) {
    $this->db->query('SELECT * FROM `user` JOIN `role` ON role_id_FK = role_id WHERE email = :email');
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    $hashed_password = $row->password;
    if (password_verify($password, $hashed_password)){
      return $row;
    } else {
      return false;
    }

  }

  // find user by email
  public function findUserByEmail($email){
    $this->db->query('SELECT * FROM user WHERE email = :email');
    // Bind values
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    // Check row
    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  // find user by id
  public function getUserById($id){
    $this->db->query('SELECT * FROM user WHERE user_id = :id');
    // Bind values
    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row;
  }
  // find user data by id
  public function getUserDataById($id){
    $this->db->query('SELECT * FROM user_data WHERE user_id_FK = :id');
    // Bind values
    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row;
  }

  // Get all users in database with role
  public function getAllUsers() {
  	$this->db->query('SELECT * FROM user JOIN role ON role_id_FK = role_id');

  	$results = $this->db->resultSet();

  	return $results;
	}

  public function editUser($data) {

  	$bPasswordSet = false;
  	if(isset($data['password'])) {
	    $bPasswordSet = true;
  		$sPassword = 'password = :password,';
    } else {
	    $sPassword = '';
    }
    $this->db->query('UPDATE user SET name = :name, email = :email, '.$sPassword.' user_image = :user_image WHERE user_id = :id');

    $this->db->bind(':id', $data['user_id']);
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':email', $data['email']);
    if($bPasswordSet) {
	    $this->db->bind( ':password', $data['password'] );
    }
    $this->db->bind(':user_image', $data['user_image']);

    if ($this->db->execute()){
      return true;
    } else {
      return false;
    }

  }

  public function checkIfUserHasData($data) {
    $this->db->query('SELECT * FROM user_data WHERE user_id_FK = :id');
    // Bind values
    $this->db->bind(':id', $data['user_id']);

    $row = $this->db->single();

    // Check row
    if ($row) {
      return true;
    } else {
      return false;
    }
  }

  public function editUserData($data) {
    $this->db->query('UPDATE user_data SET address = :address, city = :city, zipcode = :zipcode, country = :country, phone = :phone, date_of_birth = :date_of_birth WHERE user_id_FK = :id');

    $this->db->bind(':id', $data['user_id']);
    $this->db->bind(':address', $data['address']);
    $this->db->bind(':city', $data['city']);
    $this->db->bind(':zipcode', $data['zipcode']);
    $this->db->bind(':country', $data['country']);
    $this->db->bind(':phone', $data['phone']);
    $this->db->bind(':date_of_birth', $data['date_of_birth']);

    if ($this->db->execute()){
      return true;
    } else {
      return false;
    }

  }
	public function updateUserRole($role_id, $id) {
  	$this->db->query('UPDATE user SET role_id_FK = :role_id WHERE user_id = :id');

		$this->db->bind(':role_id', $role_id);
  	$this->db->bind(':id', $id);

		if ($this->db->execute()){
			return true;
		} else {
			return false;
		}
	}
}
