<?php
/**
 * Copyright (c) 2018.
 * Created by Jeremy-Percy Batten
 * Project Fiddly 2018
 */

class Product {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    /**
     * @param $id
     *
     * @return Product data from database
     */

    public function getProduct($id) {
        $this->db->query('SELECT * FROM product_type pt JOIN product p ON pt.product_id_FK = p.product_id WHERE product_id_FK = :id');
        $this->db->bind(':id', $id);

        $results = $this->db->single();
        return $results;

    }

    public function getAllProducts() {
        $this->db->query('SELECT * FROM product');
        $results = $this->db->resultSet();

        return $results;
    }

    /**
     * @param $id
     *
     * @return All products data from database
     */
    public function getAllProductById($id) {
        $this->db->query('SELECT * FROM product_type pt JOIN product p ON pt.product_id_FK = p.product_id WHERE product_id_FK = :id');
        $this->db->bind(':id', $id);

        $results = $this->db->resultSet();
        return $results;

    }

    public function getProductBrand($id) {
        $this->db->query('SELECT * FROM product WHERE product_id = :id');
        $this->db->bind(':id', $id);

        $result = $this->db->single();

        return $result;
    }

    public function getProductBrandByResultSet($id) {
        $this->db->query('SELECT * FROM product WHERE product_id = :id');
        $this->db->bind(':id', $id);

        $result = $this->db->resultSet();

        return $result;
    }

    public function editProduct($data) {
        $this->db->query('UPDATE product SET `name` = :productName, `image_link` = :image_link,  `description` = :description, `description_en` = :description_en WHERE product_id = :id');
        $this->db->bind('productName',$data['productName']);
        $this->db->bind('image_link', $data['image_link']);
        $this->db->bind('description',$data['description']);
        $this->db->bind('description_en',$data['description_en']);
        $this->db->bind('id',$data['id']);

        // Execute
        if ($this->db->execute()){
            return true;
        } else {
            return false;
        }
  }

	/**
	 * @param $id
	 *
	 * @return Get product type from database
	 */
	public function getProductTypeById($id) {
		$this->db->query('SELECT * FROM product_type pt JOIN product p ON pt.product_id_FK = p.product_id WHERE product_type_id = :id');
		$this->db->bind(':id', $id);

		$results = $this->db->single();
		return $results;
	}

	/**
	 * @return Get all products and types from database
	 */


    public function removeProduct($id) {
        $this->db->query('DELETE FROM product WHERE product_id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
    }

    public function getAllProductTypes(){
        $this->db->query('SELECT * FROM product_type');
        $results = $this->db->resultSet();

        return $results;
    }

    public function getProductType($id) {
        $this->db->query('SELECT * FROM product_type WHERE product_type_id = :id');
        $this->db->bind('id', $id);

        $results = $this->db->single();

        return $results;
    }

    public function addProduct($data) {

        $this->db->query('INSERT INTO product (`name`, `image_link` ,`description`, `description_en`) VALUES (:productName, :image_link ,:description, :description_en)');
        $this->db->bind(':productName', $data['productName']);
        $this->db->bind(':image_link', $data['image_link']);
        $this->db->bind(':description',$data['description']);
        $this->db->bind(':description_en',$data['description_en']);

        // Execute
        if ($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function addProductType($data) {
        $this->db->query('INSERT INTO product_type (type, pieces, price, product_id_FK) VALUES (:type, :pieces, :price, :product)');
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':pieces',$data['pieces']);
        $this->db->bind(':price',$data['price']);
        $this->db->bind(':product',$data['product_id_FK']);

        // Execute
        if ($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }



    public function editProductType($data) {
        $this->db->query('UPDATE product_type SET type = :type, pieces = :pieces, price = :price WHERE product_type_id = :id');
        $this->db->bind('type',$data['type']);
        $this->db->bind('pieces',$data['pieces']);
        $this->db->bind('price',$data['price']);
        $this->db->bind('id',$data['id']);

        // Execute
        if ($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function removeProductType($id) {
        $this->db->query('DELETE FROM product_type WHERE product_type_id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
    }

    public function getProductAll($id) {
        $this->db->query('SELECT * FROM product_type pt JOIN product p ON pt.product_id_FK = p.product_id WHERE product_id_FK = :id');
        $this->db->bind(':id', $id);

        $results = $this->db->resultSet();
        return $results;
    }

	public function getAllProduct() {
    $this->db->query('SELECT * FROM product_type pt JOIN product p ON pt.product_id_FK = p.product_id');


    $results = $this->db->resultSet();
    return $results;
  }

    public function search($searchWord){
	    $this->db->query("SELECT * FROM product WHERE `description` LIKE :searchWord OR  `name` LIKE :searchWord ");
	    $this->db->bind(':searchWord', '%'.$searchWord.'%');


	    $results = $this->db->resultSet();
	    return $results;
    }

    public function addCsvProducts($aData){
		$results = $this->db->pdoMultiInsert('product', $aData, array('name', 'description'));

		return $results;
    }

    public function getProductPicture($id) {
        $this->db->query('SELECT `image_link` FROM `product` where `product_id` = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getLastInsertedId(){
    	return $this->db->lastInsertId();
    }
}