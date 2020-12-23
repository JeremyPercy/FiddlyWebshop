<?php
/**
 * Copyright (c) 2018.
 * Gemaakt door: Martijn Dijkgraaf
 * In opdracht van: Fiddly
 *
 */

class Uploadcsv extends Controller {


  public $aAutorization = array();
	private $productModel;

	public function __construct() {
    parent::__construct();
	  $this->productModel = $this->model('Product');
  }


  protected function addCsv(){

	  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		  // process form

		  // Sanitize POST data

		  $filename = $_FILES['file']['tmp_name'];

		  $header = null;
		  $aData = array();

		  if($_FILES["file"]["size"] > 0)
		  {
			  $file = fopen($filename, "r");
			  while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
			  {
			  	if(count($getData) != 2) {
			  		$bResults = false;

			    } else {
				    $aData[] = $getData;
			    }
			  }


			  fclose($file);
		  }

		  if(!empty($aData)){
			  $bResults = $this->productModel->addCsvProducts($aData);
		  }

		  if($bResults){
			  flash('csv_complete', t_('csv-success'), ' alert alert-success');
		  } else {
			  flash('csv_error', t_('csv-error'), ' alert alert-danger');
		  }
		  redirect('admin/uploadcsv');
	  }

  }



}