<?php
	/**
	 * Copyright (c) 2018.
	 * Created by Jeremy-Percy Batten
	 * Project Fiddly 2018
	 */

	class Admin extends Controller {
		private $userModel;
		private $productModel;
		private $adminModel;
		public $aAutorization = array();


		public function __construct() {
			parent::__construct();
			$this->userModel = $this->model('User');
			$this->productModel = $this->model('Product');
			$this->searchwordsModel = $this->model('SearchWords');
			$this->adminModel = $this->model('adminModel');
		}


		private function addFiddlyPicture() {
			// Check if profile image is uploaded
			if (!empty($_FILES['image']['name'])) {
				$file = $_FILES;
				$url = '/images/content/product_images/';

				// Run function to upload and validate image
				$file = uploadPic($file, $url);
			} else {
				// else keep current image
				$file = 'fiddly-product.png';
			}
			return $file;
		}

		protected function index() {

			$data = [
				'total_users' => $this->adminModel->countEntity('`user`'),
				'total_fiddlys' => $this->adminModel->countEntity('`fiddly_gps`'),
				'total_orders' => $this->adminModel->countEntity('`order`')
			];

			$this->view('admin/index', $data);

		}

		protected function products() {


			$data = $this->productModel->getAllProducts();


			$this->view('admin/products', $data);

		}

		protected function addProduct() {
			// Check for post



			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// process form

				$file = $this->addFiddlyPicture();

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'productName' => trim($_POST['productName']),
					'description' => trim($_POST['description']),
					'description_en' => trim($_POST['description_en']),
					'image_link' => trim($file),
					'productName_err' => '',
					'description_err' => '',
					'description_en_err' => ''
				];

				// Validate type
				if (empty($data['productName'])) {
					$data['productName_err'] = t_( 'error-name' );
				}
				// Validate description
				if (empty($data['description'])) {
					$data['description_err'] = t_( 'error-description' );
				}
				// Validate description
				if (empty($data['description_en'])) {
					$data['description_en_err'] = t_( 'error-description' );
				}
				// Make sure errors are empty
				if (empty($data['productName_err']) && empty($data['description_err']) && empty($data['description_en_err'])) {
					// Validated

					// add Product Type
					if ($this->productModel->addProduct($data)) {
						flash('add_product', t_('product_added'));
						redirect('admin/products');
					} else {
						die(t_('Something_wrong'));
					}
				} else {
					// Load view with errors
					$this->view('admin/add_product', $data);
				}
			} else {
				$data = [
					'productName' => '',
					'description' => '',
					'description_en' => '',
					'image_link' => 'fiddly-product.png'
				];

				$this->view('admin/add_product', $data);
			}
		}

		protected function edit($id) {

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {


				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				if ($_FILES['image']['size'] == 0) {
					$id = (int)$id;
					$file = $this->productModel->getProductPicture($id)->image_link;
				} else {
					$file = $this->addFiddlyPicture();
				}


				// Init data
				$data = [
					'productName' => trim($_POST['productName']),
					'description' => trim($_POST['description']),
					'description_en' => trim($_POST['description_en']),
					'image_link' => trim($file),
					'id' => trim($_POST['id']),
					'productName_err' => '',
					'description_err' => '',
					'description_en_err' => ''
				];

				$data['product'] = $this->productModel->getProductBrand($id);
				if (isset($data['product']) && isset($data['product'])) {
					$data['productTypes'] = $this->productModel->getProductAll($id);
				}

				// Validate type
				if (empty($data['productName'])) {
					$data['productName_err'] = t_( 'error-name' );
				}
				// Validate description
				if (empty($data['description'])) {
					$data['description_err'] = t_( 'error-description' );
				}
				// Validate description
				if (empty($data['description_en'])) {
					$data['description_en_err'] = t_( 'error-description' );
				}
				// Make sure errors are empty
				if (empty($data['productName_err']) && empty($data['description_err']) && empty($data['description_en_err']))  {
					// Validated

					// add Product Type
					if ($this->productModel->editProduct($data)) {
						flash('edit_product', t_('product_edited'));
						redirect('admin/products');
					} else {
						die(t_('something_wrong'));
					}
				} else {
					// Load view with errors
					$this->view('admin/edit_product', $data);
				}
			} else {
				// get product
				// get producttypes

				$data['product'] = $this->productModel->getProductBrand($id);
				if (isset($data['product']) && isset($data['product'])) {
					$data['productTypes'] = $this->productModel->getProductAll($id);
				}
				$this->view('admin/edit_product', $data);
			}
		}

		protected function remove($id) {

			$productType = $this->productModel->getProductAll($id);

			if (count($productType) == 0) {
				$this->productModel->removeProduct($id);
				flash('delete_product', t_('product_deleted'), 'alert alert-danger');
				redirect('admin/products');
			} else {
				flash('err_product', t_('delete_product_types_first'), 'alert alert-danger');
				redirectWithId('admin/edit', $id);
			}
		}

		protected function productTypes() {
			$allProductTypes = $this->productModel->getAllProductTypes();

			$data = $allProductTypes;

			$this->view('admin/productTypes', $data);
		}

		protected function addtype($id) {
			// Check for post
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// process form

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				$id = (int)$_POST['product_id_FK'];
				// Init data
				$data = [
					'product_id_FK' => $id,
					'type' => trim($_POST['type']),
					'pieces' => trim($_POST['pieces']),
					'price' => trim($_POST['price']),
					'type_err' => '',
					'pieces_err' => '',
					'price_err' => '',
					'product_err' => ''
				];

				// Validate type
				if (empty($data['type'])) {
					$data['type_err'] = t_('please_enter_type');
				}
				// Validate pieces
				if (empty($data['pieces'])) {
					$data['pieces_err'] = t_('please_enter_pieces');
				} else {
					$data['pieces'] = number_format((int)$data['pieces'], 0, '.', '');

					if(strlen($data['pieces']) >= 11) {
						$data['pieces_err'] = t_('maximum_pieces');
					}
				}
				// Validate price
				if (empty($data['price'])) {
					$data['price_err'] = t_('please_enter_price');
				}

				if(!empty($data['price'])){
					$data['price'] = str_replace(',', '.', $data['price']);
					$data['price'] = number_format((int)$data['price'], 2, '.', '');


					if (!is_float($data['price']) && !is_numeric($data['price'])){
						$data['price_err'] = t_('check_price');
					}

					if(strlen($data['price']) > 9) {
						$data['price_err'] = t_('price_to_high');
					}

				}



				if(!empty($data['pieces']) && !is_numeric($data['pieces'])){
					$data['pieces_err'] = t_('round_number');
				}

				// Make sure errors are empty
				if (empty($data['type_err']) && empty($data['pieces_err']) && empty($data['price_err'])) {
					// Validated

					// add Product Type
					if ($this->productModel->addProductType($data)) {
						flash('add_type', t_('type_added'));
						redirectWithId("admin/edit", $id);
					} else {
						die(t_('something_wrong'));
					}
				} else {
					// Load view with errors
					$this->view('admin/add_product_type', $data);
				}
			} else {
				$data = [
					'product_id_FK' => $id,
					'type' => '',
					'pieces' => '',
					'price' => '',
					'product' => ''
				];

				$this->view('admin/add_product_type', $data);
			}
		}

		// edit product type
		protected function type($id) {

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'type' => trim($_POST['type']),
					'pieces' => trim($_POST['pieces']),
					'price' => trim($_POST['price']),
					'id' => trim($_POST['id']),
					'type_err' => '',
					'pieces_err' => '',
					'price_err' => ''
				];

				// Validate type
				if (empty($data['type'])) {
					$data['type_err'] = t_( 'error-name' );
				}
				// Validate pieces
				if (empty($data['pieces'])) {
					$data['pieces_err'] = t_('please_enter_pieces');
				} else {
					$data['pieces'] = number_format((int)$data['pieces'], 0, '.', '');

					if(strlen($data['pieces']) >= 11) {
						$data['pieces_err'] = t_('maximum_pieces');
					}
				}

				if (empty($data['price'])) {
					$data['price_err'] = t_('please_enter_price');
				}

				if(!empty($data['price'])){
					$data['price'] = str_replace(',', '.', $data['price']);
					$data['price'] = number_format((int)$data['price'], 2, '.', '');


					if (!is_float($data['price']) && !is_numeric($data['price'])){
						$data['price_err'] = t_('check_price');
					}

					if(strlen($data['price']) > 9) {
						$data['price_err'] = t_('maximum_price');
					}

				}


				if(!empty($data['pieces']) && !is_numeric($data['pieces'])){
					$data['pieces_err'] = t_('round_number');
				}

				// Make sure errors are empty
				if (empty($data['type_err']) && empty($data['pieces_err']) && empty($data['_err'])) {
					// Validated

					// edit Product Type
					if ($this->productModel->editProductType($data)) {
						$id = (int)$data['id'];
						$redirectId = $this->productModel->getProductType($id);
						$redirectId = $redirectId->product_id_FK;
						flash('edit_type', t_('product_edited'));
						redirectWithId("admin/edit", $redirectId);
					} else {
						die(t_('something_wrong'));
					}
				} else {
					// Load view with errors
					$this->view('admin/edit_product_type', $data);
				}
			} else {

				$data = $this->productModel->getProductType($id);
				$this->view('admin/edit_product_type', $data);
			}
		}

		protected function removeType($id) {
			$redirectId = $this->productModel->getProductType($id);
			$redirectId = $redirectId->product_id_FK;
			$this->productModel->removeProductType($id);
			flash('delete_type', t_('productType_deleted'));
			redirectWithId("admin/edit", $redirectId);
		}

		/**
		 * Copyright (c) 2018.
		 * Created by Jeremy-Percy Batten
		 * Project Fiddly 2018
		 */
		// page with all users and their roles
		protected function userRoles() {
			$users = $this->userModel->getAllUsers();

			$data = [
				'users' => $users
			];

			$this->view('admin/user_roles', $data);
		}


		// Refer to user role page in admin section. Now you can easily update user roles but just changing option field
		// @ToDo make a search field.
		protected function updateUserRole() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				$role_id = trim($_POST['role_id']);
				$user_id = trim($_POST['user_id']);

				if ($this->userModel->updateUserRole($role_id, $user_id)) {
					flash('user_role_updated', t_('userRole_updated'));
					redirect('admin/userroles');
				}

			}
		}

		protected function searchwords() {
			//redirect instellen om al het zoeken te verplaatsen naar de searchController
			require_once '../app/controllers/search.php';
			$sMethod = 'searchwords';
			$sController = new Search;
			call_user_func_array(array(
				$sController,
				$sMethod
			), array());
		}

		protected function uploadCsv() {
			$this->view('admin/upload_csv');

		}

	}
