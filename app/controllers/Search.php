<?php
/**
 * Copyright (c) 2018.
 * Gemaakt door: Martijn Dijkgraaf
 * In opdracht van: Fiddly
 *
 */

class Search extends Controller {

  private $productModel;
  private $searchwordsModel;
  private $aResults = array();
  private $sSearch = false;
  public  $aAutorization = array('index');

  public function __construct() {
    parent::__construct();
	  $this->productModel = $this->model('Product');
	  $this->searchwordsModel = $this->model( 'SearchWords' );
  }


	/**
	 *
	 */
	protected function index() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Sanitize Get data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			if(isset($_POST) && isset($_POST['searchWord'])){
				$this->sSearch =  $_POST['searchWord'];
			}

			if(!empty($this->sSearch)) {
				//looping trough the proucts
				$oProducts = $this->searchProduct();
				if ( count( $oProducts ) > 0 ) {
					foreach ( $oProducts as $oProduct ) {
						$this->aResults['products'][] = $oProduct;
					}
				}

				//looping trough the keywords
				$oSearchWords = $this->searchSearchWords();
				if ( count( $oSearchWords ) > 0 ) {
					foreach ( $oSearchWords as $oSearchWord ) {

						//change description on the English page to english
						if ( $this->translate->isEnglish() ) {
							$oSearchWord->description = $oSearchWord->description_en;
						}

						$this->aResults['searchword'][] = $oSearchWord;


					}
				}

				//add words that not exist in the databse
				if(empty($this->aResults)){
					$this->addSearchWord();
				}
			}
		}
	    $data = [
	        'title' => 'zoeken',
	        'aResults' => $this->aResults,
	        'sSearch' => $this->sSearch,
	    ];

	    $this->view('search/index', $data);

	}

	protected function searchwords() {
		$data = [];

		$data['searchwords'] = $this->searchwordsModel->getAllSearchWords();

		$this->view( 'admin/searchwords', $data );
	}


	protected function deleteSearchword($id) {

		$_GET = filter_input_array( INPUT_GET, FILTER_SANITIZE_STRING );
		$this->searchwordsModel->deleteSearchword( $id );
		flash( 'search-word-deleted', t_( 'item-deleted' ), ' alert alert-warning' );


		redirect( 'admin/searchwords' );
	}

	protected function editSearchword($id) {

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


			// Init data
			$data = [
				'post'  => [
					'word'        => trim( $_POST['word'] ),
					'description' => trim( $_POST['description'] ),
					'description_en' => trim( $_POST['description_en'] ),
					'link'        => trim( $_POST['link'] ),
					'id'          => trim( $_POST['id'] ),
				],
				'error' => []
			];

			$data = $this->validateSearchForm($data);

			// Make sure errors are empty
			if ( !$data['hasError'] ) {
				// Validated
				// add Product Type
				if ( $this->searchwordsModel->editSearchWord( $data['post'] ) ) {
					flash( 'search-word_edited', t_( 'searchword-edited' ) );
					redirect( 'admin/searchwords' );
				} else {
					die( 'Something gone wrong' );
				}
			} else {
				// Load view with errors
				$errors = implode( '<br>', $data['error'] );
				flash( 'search-word_edited_error', $errors, 'alert alert-danger' );
				$data = $this->searchwordsModel->getSearchWord( $data['post']['id'] );
				$this->view( 'search/editsearchword', $data );
			}
		} else {
			$data = $this->searchwordsModel->getSearchWord( $id );
			$this->view( 'search/editsearchword', $data );
		}

	}

	/**
	 * @return mixed
	 */
	private function searchProduct(){
	  return $this->productModel->search($this->sSearch);

	}

	/**
	 * @return mixed
	 */
	private function searchSearchWords(){
		return $this->searchwordsModel->search($this->sSearch);
	}

	/**
	 * @return mixed
	 */
	private function addSearchWord(){
		return $this->searchwordsModel->setSearchword($this->sSearch);
	}

	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	private function validateSearchForm($data){

		$data['hasError'] = false;
		// Validate type
		if ( empty( $data['post']['word'] ) ) {
			$data['error']['name_err'] = t_( 'error-name' );
		}
		// Validate description
		if ( empty( $data['post']['description'] ) ) {
			$data['error']['description_err'] = t_( 'error-description' );
		}

		if ( empty( $data['post']['description_en'] ) ) {
			$data['error']['description_err_en'] = t_( 'error-description_en' );
		}

		if (!empty( $data['error']['name_err'] ) || !empty( $data['error']['description_err'])  || !empty( $data['error']['description_err_en'])) {
			$data['hasError'] = true;
		}


		return $data;

	}




}