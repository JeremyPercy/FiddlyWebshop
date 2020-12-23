<?php
/**
 * Copyright (c) 2018.
 * Created by Jeremy-Percy Batten
 * Project Fiddly 2018
 */

class Products extends Controller {

  private $productModel;

  public function __construct() {
	  parent::__construct();

	  // Load model
    $this->productModel = $this->model('Product');
  }

  public function product($id) {
    // Get product data from database
    $product = $this->productModel->getProduct($id);

    if($this->translate->isEnglish()){
	    $product->description = $product->description_en;
    }

    // Get all products data from database
    $productTypes = $this->productModel->getAllProductById($id);

    // Init data
    $data = [
      'product' => $product,
      'productTypes' => $productTypes,
      'products' => $this->allProducts(true, $id)
    ];


    // Create view for this method
    $this->view('products/product', $data);

  }

  public function allProducts($bInclude = false, $id = false) {
    $products = $this->productModel->getAllProduct();
    $aProducts = Array();

    //door alle producten loopen
    foreach($products as $product){
	    $bAlreadyExists = false;

	    //kijken of het product al toegevoegd is in de array, de array key Array['deze dus' => value] is gelijk aan de FK.
	    if(!array_key_exists($product->product_id_FK,$aProducts)) {
	    	// is er een id van de product pagina meegekomen, dit product niet weergeven in de 'all_products'
		    if ( $id ) {
			    $bCurrentProduct = $this->isCurrentProduct($product->product_id_FK, $id);
		    }

		    //als het product in de loop overeen komt met het product die we nu bekijken, dan niet toevoegen aan de array
		    // maar doorgaan met de foreach
		    if($bCurrentProduct){
		    	continue;
		    }

		    //product toevoegen aan de array
		    $aProducts[$product->product_id_FK] = $product;
 	    }

    }
    if($bInclude){
	    return $aProducts;
    }

    $data = [
      'products' => $aProducts
    ];

    $this->view('products/all_products', $data);
  }

	private function isCurrentProduct($nCurrentProduct,$id){
  	    if ($nCurrentProduct == $id){
  	    	return true;
        } else {
  	    	return false;
        }
	}


}