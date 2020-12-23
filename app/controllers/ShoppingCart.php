<?php
/**
 * Copyright (c) 2018.
 * Created by Jeremy-Percy Batten
 * Project Fiddly 2018
 */

class ShoppingCart extends Controller {

  public $id;
  public $modelProduct;

  public function __construct() {
	  parent::__construct();
	  // Load model
    $this->modelProduct = $this->model('Product');
  }

  public function addToCart() {
    //Check for post what is submitted on product page
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // check if cookies are set
      if (isset($_COOKIE["shopping_cart"])) {

        // strip slashes from cookies and store it in variable
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        // Decode json file and store it in php variable
        $data = json_decode($cookie_data, true);
      } else {
        $data = [];
      }

      // Select column where id is stored in the variable and put it in a variable
      $item_id_list = array_column($data, 'product_type_id');

      // Check if id is posted and put it in a for each loop to add product to the already stored product quantity
      if (in_array($_POST["product_type_id"], $item_id_list)) {
        foreach ($data as $keys => $values) {
          if ($data[$keys]["product_type_id"] == $_POST["product_type_id"]) {
            $data[$keys]["quantity"] = $data[$keys]["quantity"] + 1;
          }
        }
      } else {

        // If profuct is not already stored in variable array add it
        $id = trim($_POST['product_type_id']);
        $data[] = $this->modelProduct->getProductTypeById($id);


      }
      // Encode variable back to json and store it back in the cookies. Redirect page.
      $item_data = json_encode($data);
      setcookie('shopping_cart', $item_data, time() + (86400 * 30), '/');
      /*redirect('products/product/' . $data['product_id']);*/
      flash('item_added', 'Item is succesvol toegevoegd aan uw winkelwagentje!, Bezoek hier uw <a href="'.URLROOT.'/shoppingcart/">winkelwagentje</a>');
      redirectWithId('products/product', $_POST['product_id']);
    } else {
    	redirect('products/');
		}
  }

  public function index() {
    if (isset($_COOKIE['shopping_cart'])) {
			$cookie_data = stripslashes($_COOKIE['shopping_cart']);
			$data = json_decode($cookie_data, true);

			$this->view('shoppingcart/index', $data);
		} else {
    	$this->view('shoppingcart/index');
		}
  }

  public function deleteItem($id) {
    if (isset($_COOKIE['shopping_cart'])) {
      $cookie_data = stripslashes($_COOKIE['shopping_cart']);
      $data = json_decode($cookie_data, true);

      foreach ($data as $keys => $values) {
        if ($data[$keys]['product_type_id'] == $id) {
					if ($data[$keys]["quantity"] > 1) {
						$data[$keys]["quantity"] = $data[$keys]["quantity"] - 1;
					} else {
							unset($data[$keys]);
						}
          $item_data = json_encode($data);
          setcookie('shopping_cart', $item_data, time() + (86400 * 30), '/');
        }
      }
    } else {
      echo 'error';
    }
    flash('item_removed', 'Item is succesvol verwijderd', ' alert alert-warning');
    redirect('shoppingcart/');
  }
}