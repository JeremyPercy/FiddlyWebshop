<?php
/**
 * Copyright (c) 2018.
 * Created by Jeremy-Percy Batten
 * Project Fiddly 2018
 */

class Pages extends Controller {

		public function __construct() {
		  parent::__construct();
		}

		public function index() {

			$data = [
				'title' => 'Fiddly GPS Tracker',
                'subtitle' => 'is awesome!',
				'description' => 'Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Cras ultricies ligula sed magna dictum porta. Nulla porttitor accumsan tincidunt. '
			];

			$this->view('pages/index', $data);
		}

		public function about() {
			$data = [
				'title' => t_('about-us'),
			];
			$this->view('pages/about', $data);
		}

		public function product() {
			$data = [
				'title' => 'Product',
				'price' => '199.95',
			];
			$this->view('pages/product', $data);
		}

	}