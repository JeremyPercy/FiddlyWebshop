<?php
/**
 * Copyright (c) 2018.
 * Created by Jeremy-Percy Batten
 * Project Fiddly 2018
 */

	/*
	 * Base controller
	 * Loads the modules and views
	 */

	class Controller {
		public $aAutorization = array();
		public $translate;


		public function __construct(){
      $this->translate = new Translate();
		}

		//Load module
		public function model($model) {
			// require model file
			require_once '../app/models/' . $model . '.php';

			//Instantiate model
			return new $model();
		}

		// Load view
		public function view($view, $data = []) {
			// Check for the view file
			if (file_exists('../app/views/' . $view . '.php')) {
				require_once '../app/views/' . $view . '.php';
			} else {
				// view does not exist
				die('View does not exist');
			}
		}


		public function checkAutorization($method){
			if(isset($_SESSION['user_id']) && ($_SESSION['user_role'] === 'admin')) {
				return true;
			}  elseif(isset($_SESSION['user_id'])  && !in_array($method,$this->aAutorization)) {
				flash('access_denied', t_('access-denied'), ' alert alert-warning');
				redirect('users/');
				return false;

			} elseif(isset($_SESSION['user_id'])  && in_array($method,$this->aAutorization)) {
				return true;
			}
			else {
				redirect('users/login');
				return false;
			}
		}

		public function __call($method,$arguments) {
			if(method_exists($this, $method)) {
				if($this->checkAutorization($method)) {
					return call_user_func_array(array($this,$method),$arguments);
				}
			}
		}
	}

