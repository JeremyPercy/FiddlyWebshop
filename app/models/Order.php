<?php

class Order {

  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function createOrder($data) {
    $this->db->query('INSERT INTO `order` (order_date, payment_status, delivery_status, user_id_FK) VALUES (now(), :payment, :delivery, :user_id)');

    $this->db->bind(':payment', 'Confirmed');
    $this->db->bind(':delivery', 'Order send');
    $this->db->bind(':user_id', $data);

    if ($this->db->execute()) {
      return $this->db->lastInsertId();
    } else {
      return false;
    }
  }

  public function insertProductQuantity($orderID, $item) {
    $this->db->query('INSERT INTO order_quantity (order_id_FK, product_type_id_FK, quantity) VALUES (:order_id, :product_type_id, :quantity)');

    $this->db->bind(':order_id', $orderID);
    $this->db->bind(':product_type_id', $item['product_type_id']);
    $this->db->bind(':quantity', $item['quantity']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getProductQuantity($orderID) {
    $this->db->query('SELECT * FROM order_quantity WHERE order_id_FK = :id');

    $this->db->bind(':id', $orderID);

    $results = $this->db->resultSet();

    return $results;
  }

	public function getProductQuantityForProduct($orderID, $productId) {
		$this->db->query('SELECT `quantity` FROM `order_quantity` WHERE order_id_FK = :id AND product_type_id_FK = :productId');

		$this->db->bind(':id', $orderID);
		$this->db->bind(':productId', $productId);

		return $this->db->single()->quantity;
	}

  function getRandomSerial($serial, $orderID) {

    $this->db->query('INSERT INTO `serialnumber` (`number`, `date`, `order_id_FK`)
            VALUES (:serial, now(), :order_id_FK)');

    $this->db->bind(':serial', $serial);
    $this->db->bind(':order_id_FK', $orderID);

    $this->db->execute();
  }

  public function getSerialFromOrder($id) {
    $this->db->query('SELECT * FROM serialnumber WHERE order_id_FK = :id');
    $this->db->bind(':id', $id);

    $results = $this->db->resultSet();

    return $results;
  }

  public function getOrderById($id) {
    $this->db->query('SELECT * FROM `order` WHERE order_id = :id');
    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row;
  }

  public function getAllProductOrderData($id) {
    $this->db->query('SELECT * FROM order_quantity oq 
          JOIN product_type pt ON oq.product_type_id_FK = pt.product_type_id 
          JOIN product p ON pt.product_id_FK = p.product_id
          WHERE oq.order_id_FK = :id');
    $this->db->bind(':id', $id);

    $results = $this->db->resultSet();

    return $results;
  }

  public function getOrderByUserId($id) {
    $this->db->query('SELECT * FROM `order` WHERE user_id_FK = :id');
    $this->db->bind(':id', $id);

    $results = $this->db->resultSet();

    return $results;
  }

}