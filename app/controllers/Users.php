<?php
	/**
	 * Copyright (c) 2018.
	 * Created by Jeremy-Percy Batten
	 * Project Fiddly 2018
	 */

	class Users extends Controller {
		private $userModel;
		private $fiddlyModel;
		public $aAutorization = array(
			'profile',
			'edit',
			'index'
		);
		public $checkout = [];

		public function __construct() {
			parent::__construct();
			$this->userModel = $this->model('User');
			$this->fiddlyModel = $this->model('Tracker');
		}


		protected function index() {
			$data['fiddlyData'] = $this->fiddlyModel->getAllFiddlysByUser();

			$this->view('users/index', $data);

		}

		// Register form on homepage, where users can register
		public function register() {
			// Check for post
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// process form

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'name' => trim($_POST['name']),
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),
					'confirm_password' => trim($_POST['confirm_password']),
					'name_err' => '',
					'email_err' => '',
					'password_err' => '',
					'confirm_password_err' => ''
				];

				// Validate name
				if (empty($data['name'])) {
					$data['name_err'] = 'Please enter name';
				}
				// Validate email
				if (empty($data['email'])) {
					$data['email_err'] = 'Please enter email';
				} else {
					// Check email
					if ($this->userModel->findUserByEmail($data['email'])) {
						$data['email_err'] = 'Email is already taken';
					}
				}
				// validate password
				if (empty($data['password'])) {
					$data['password_err'] = 'Please enter password';
				} elseif (strlen($data['password']) < 6) {
					$data['password_err'] = 'Password must be at least 6 characters long';
				}
				// Validate confirm password
				if (empty($data['confirm_password'])) {
					$data['confirm_password_err'] = 'Please confirm password';
				} else {
					if ($data['password'] != $data['confirm_password']) {
						$data['confirm_password_err'] = 'Passwords do not match';
					}
				}

				// Make sure errors are empty
				if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
					// Validated

					// Hash password
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

					// Register user
					if ($this->userModel->register($data)) {
						flash('register_success', 'You are registered and can log in');
						redirect('users/login');
					} else {
						die('Something gone wrong');
					}
				} else {
					// Load view with errors
					$this->view('users/register', $data);
				}
			} else {
				// Init data
				$data = [
					'name' => '',
					'email' => '',
					'password' => '',
					'confirm_password' => '',
					'name_err' => '',
					'email_err' => '',
					'password_err' => '',
					'confirm_password_err' => ''
				];

				// Load view
				$this->view('users/register', $data);
			}
		}

		// Login form where users and admins can login
		public function login() {
			// Check for post
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// process form
				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),
					'email_err' => '',
					'password_err' => '',
				];

				// Validate email
				if (empty($data['email'])) {
					$data['email_err'] = 'Please enter email';
				}
				// validate password
				if (empty($data['password'])) {
					$data['password_err'] = 'Please enter password';
				}

				// Check for user/email
				if ($this->userModel->findUserByEmail($data['email'])) {
					// User found
				} else {
					$data['email_err'] = 'No User found';
				}

				// Make sure errors are empty
				if (empty($data['email_err']) && empty($data['password_err'])) {
					// Validated
					// Check and set logged in user
					$loggedInUser = $this->userModel->login($data['email'], $data['password']);
					if ($loggedInUser) {
						//create session
						$this->createUserSession($loggedInUser);
						if (isset($_POST['checkout'])) {
							redirect('orders/checkout');
						} else {
							redirect('users');
						}
					} else {
						$data['password_err'] = ' Password incorrect';

						$this->view('users/login', $data);
					}

				} else {
					// Load view with errors
					$this->view('users/login', $data);
				}

			} else {
				// Init data
				$data = [
					'email' => '',
					'password' => '',
					'email_err' => '',
					'password_err' => ''
				];

				// Load view
				$this->view('users/login', $data);
			}
		}

		//Create user session
		public function createUserSession($user) {
			$_SESSION['user_id'] = $user->user_id;
			$_SESSION['user_email'] = $user->email;
			$_SESSION['user_name'] = $user->name;
			$_SESSION['user_image'] = $user->user_image;
			$_SESSION['user_role'] = $user->role_name;
		}

		// logging user out
		public function logout() {
			unset($_SESSION['user_id']);
			unset($_SESSION['user_email']);
			unset($_SESSION['user_name']);
			unset($_SESSION['user_image']);
			unset($_SESSION['user_role']);
			session_destroy();
			redirect('users/login');
		}

		// Show profile of user
		protected function profile() {
			$id = $_SESSION['user_id'];
			$user = $this->userModel->getUserById($id);
			$userData = $this->userModel->getUserDataById($id);

			// If data is not present show empty string
			if (!$userData) {
				$userData = [
					'user_data_id' => '',
					'address' => '',
					'zipcode' => '',
					'city' => '',
					'country' => '',
					'phone' => '',
					'date_of_birth' => '',
					'user_id_FK' => ''
				];
			}

			// load data
			$data = [
				'user' => $user,
				'user_data' => $userData
			];


			// Load view
			$this->view('users/profile', $data);
		}

		// Edit form, which can be used for updating user profile or edit and add shipping details. Depends on the submitted form
		protected function edit() {
			$id = $_SESSION['user_id'];

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// process form

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// If form submit is from edit profile
				if ($_POST['dest'] === 'profile') {

					// Check if profile image is uploaded
					if (!empty($_FILES['image']['name'])) {
						$file = $_FILES;
						$url = '/images/content/user_images/';

						// Run function to upload and validate image
						$file = uploadPic($file, $url);

						// If upload successful reset session with image
						if ($file) {
							$_SESSION['user_image'] = $file;
						}
					} else {
						// else keep current image
						$file = $_SESSION['user_image'];
					}

					$data = [
						'user_id' => $_SESSION['user_id'],
						'name' => trim($_POST['name']),
						'email' => trim($_POST['email']),
						//                 'password' => trim($_POST['password']),
						'user_image' => trim($file),
						'email_err' => false,
						'password_err' => false
					];

					// Check email
					if ($data['email'] !== $_SESSION['user_email']) {
						if ($this->userModel->findUserByEmail($data['email'])) {
							$data['email_err'] = true;
							flash('edit_profile', t_('edit-profile-email-err'), 'alert alert-warning');
						}
					}

					// Make sure errors are empty
					if ($data['email_err'] == false && $data['password_err'] == false) {
						// Validated

						if (isset($_POST['password']) && !empty($_POST['password'])) {
							// validate password
							if (strlen($_POST['password']) < 6) {
								$data['password_err'] = true;
								flash('edit_profile', t_('edit-profile-password-err'), 'alert alert-warning');
							}
							$data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
						}

						// Update user profile in database
						$this->userModel->editUser($data);

						redirectWithId('users/profile', $id);
						flash('edit_profile', t_('edit-profile-account-successful'));
					} else {
						redirectWithId('users/profile', $id);
					}

					// If form submit is from shipping details
				} elseif ($_POST['dest'] === 'shipping_details') {

					$data = [
						'address' => trim($_POST['address']),
						'city' => trim($_POST['city']),
						'zipcode' => trim($_POST['zipcode']),
						'country' => trim($_POST['country']),
						'phone' => trim($_POST['phone']),
						'date_of_birth' => trim($_POST['date_of_birth']),
						'user_id' => trim($_POST['user_id']),
						'empty_err' => false,
					];

					// Check if form is compleet and there are no empty fields
					if (empty($data['address']) || empty($data['city']) || empty($data['zipcode']) || empty($data['country']) || empty($data['phone']) || empty($data['date_of_birth'])) {
						$data['empty_err'] = true;
						flash('edit_profile', t_('edit-profile-empty-forms'), 'alert alert-warning');
					}

					// If there are no errors update or add shipping details
					if ($data['empty_err'] == false) {
						if ($this->userModel->checkIfUserHasData($data)) {
							$this->userModel->editUserData($data);;
							flash('edit_profile', t_('edit-profile-shipping-edit-successful'));
						} else {
							$this->userModel->createUserData($data);
							flash('edit_profile', t_('edit-profile-shipping-added-successful'));
						}
					}
					if (isset($_POST['checkout'])) {
						redirect('orders/checkout');
					} else {
						redirectWithId('users/profile', $id);
					}
				}
			}
		}
	}
