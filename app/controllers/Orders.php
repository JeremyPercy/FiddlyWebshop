<?php

class Orders extends Controller {

  private $modelOrder;
  private $modelUser;
  private $modelProduct;
  public $aAutorization = ['order', 'index'];

  public function __construct() {
    parent::__construct();
    // Load models
    $this->modelOrder = $this->model('Order');
    $this->modelUser = $this->model('User');
    $this->modelProduct = $this->model('Product');
  }

  protected function index() {
	// load list of order for customers
    $data =$this->modelOrder->getOrderByUserId($_SESSION['user_id']);

    $this->view('orders/index', $data);

  }

  protected function order($id) {
  	// Load orders by id
    $order = $this->modelOrder->getOrderById($id);

    // show order to user
    if ($order->user_id_FK == $_SESSION['user_id']){

      $userData = $this->modelUser->getUserDataById($_SESSION['user_id']);
      $products = $this->modelOrder->getAllProductOrderData($id);
      $serials = $this->modelOrder->getSerialFromOrder($id);
      $productsQuantity = $this->modelOrder->getProductQuantity($id);

      $data = [
        'user_data' => $userData,
        'products' => $products,
        'serials' => $serials,
        'orderId' => $id,
        'productsQuantity' => $productsQuantity,
      ];

      $this->view('orders/order', $data);
    } else {
      redirect('users/login');
    }

  }


  // Checkout page before order confirm.
  public function checkOut() {
    if (!isset($_SESSION['user_id'])) {
      redirect('users/login?cart=checkout');
    } elseif (!$this->modelUser->getUserDataById($_SESSION['user_id'])) {
      $this->view('orders/add_shipping_details');
    } else {

			/*if (isset($_COOKIE['shopping_cart'])) {
				$cookie_data = stripslashes($_COOKIE['shopping_cart']);
				$shoppingCart = json_decode($cookie_data, true);*/

			$shoppingCart = cookiesData();

			$userData = $this->modelUser->getUserDataById($_SESSION['user_id']);

			$data = [
				'user_data' => $userData,
				'shopping_cart' => $shoppingCart
			];
			// show shopping cart and user data
			$this->view('orders/checkout', $data);
		}
  }

  // Process order to the actual order.
  public function processOrder() {
		//
    if (isset($_SESSION['user_id'])) {
      $userID = $_SESSION['user_id'];
      // create order
      $orderID = $this->modelOrder->createOrder($userID);

      // check if order is created
      if (!empty($orderID)) {

        $cart_items = cookiesData();
        $aSerials = [];

        foreach ($cart_items as $item) {

          $this->modelOrder->insertProductQuantity($orderID, $item);

          // Create random serial for each product
          $sTotalSerials = ($item['pieces'] * $item['quantity']);
          for ($x = 1; $x <= $sTotalSerials; $x++) {
            $serial = $aSerials[] = rand();

            $this->modelOrder->getRandomSerial($serial, $orderID);
          }
        }
        // Unset cookies
        if (isset($_COOKIE['shopping_cart'])) {
          unset($_COOKIE['shopping_cart']);
          setcookie('shopping_cart', '', time() - 3600, '/'); // empty value and old timestamp
        }
      }
      redirectWithId('orders/order', $orderID);
    } else {
      redirect('users/login');
    }
  }

  public function getQuantityForProduct($product){
  	return $this->modelOrder->getProductQuantityForProduct($product->order_id_FK, $product->product_type_id);

  }


}