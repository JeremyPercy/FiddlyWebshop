<?php
/**
 * Copyright in opdracht van Fiddly
 */

/**
 * Created by PhpStorm.
 * User: yweij
 * Date: 3-6-2018
 * Time: 13:38
 */
class Trackers extends Controller {
  private $fiddlyModel;
  public $aAutorization = array('add', 'find', 'edit', 'remove');


  public function __construct() {
    $this->fiddlyModel = $this->model('Tracker');
  }

  private function addFiddlyPicture() {
    // Check if profile image is uploaded
    if (!empty($_FILES['image']['name'])) {
      $file = $_FILES;
      $url = '/images/content/fiddly_images/';

      // Run function to upload and validate image
      $file = uploadPic($file, $url);
    } else {
      // else keep current image
      $file = 'stock.png';
    }
    return $file;
  }


  protected function add() {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $file = $this->addFiddlyPicture();

      $data = ['name' => trim($_POST['name']), 'serial' => trim($_POST['serial']), 'serial_id' => '', 'order_id' => trim($_POST['order_id']), 'user_id' => $_SESSION['user_id'], 'image_link' => trim($file), 'order_id_err' => '', 'name_err' => '', 'serial_err' => '', 'location' => array('lattitude' => '', 'longitude' => '')];


      // Validate name
      if (empty($data['name'])) {
        $data['name_err'] = t_('Please_enter_name');
      }

      // Validate order
      if (empty($data['order_id'])) {
        $data['order_id_err'] = t_('Please_enter_order_id');
      }

      // Validate serial
      if (empty($data['serial'])) {
        $data['serial_err'] = t_('Please_enter_serial');
      }

      // Make sure errors are empty
      if (empty($data['name_err']) && empty($data['order_id_err']) && empty($data['serial_err'])) {

        // convert strings to ints
        $data['user_id'] = (int)$data['user_id'];
        $data['serial'] = (int)$data['serial'];
        $data['order_id'] = (int)$data['order_id'];
        $id = $data['user_id'];

        // check if fiddly is ordered
        $order = $this->fiddlyModel->findFiddlyBySerialAndOrderId($data['serial'], $data['order_id']);

        if ($order) {

          $data['serial_id'] = $order->serialnumber_id;

          // check if fiddly is already registerd
          $lookup = $this->fiddlyModel->findFiddlyBySerial($data['serial_id']);

          if ($lookup) {
            flash('unknown_serial_or_order_id', 'Serialnummer is reeds geregistreerd', 'alert alert-danger');
            $this->view("admin/add_product/'$id'", $data);
          } else {
            $aLocation = $this->getRandomLongitudeLattitude();

            $data['location']['longitude'] = $aLocation['longitude'];
            $data['location']['lattitude'] = $aLocation['lattitude'];

            // add fiddly to user profile
            if ($this->fiddlyModel->addFiddlyToUserProfile($data)) {
              flash('fiddly_gps_added', t_('add_fiddly_gps'), 'alert alert-success');
              redirectWithId('users/index', $data['user_id']);
            } else {
              flash('unknown_serial_or_order_id', t_('something_wrong'), 'alert alert-danger');
            }
          }
        } else {
          flash('unknown_serial_or_order_id', t_('unknown_serial'), 'alert alert-danger');
          redirectWithId('trackers/add', $data['user_id']);
        }
      } else {
        $this->view("fiddly/add_fiddly", $data);
      }

    } else {
      $data = ['name' => '', 'serial' => '', 'id' => $_SESSION['user_id'], 'order_id' => '', 'image_link' => 'stock.png', 'order_id_err' => '', 'name_err' => '', 'serial_err' => ''];

      $this->view('fiddly/add_fiddly', $data);
    }
  }

  protected function remove($id) {
    $id = (int)$id;
    $this->fiddlyModel->removeFiddly($id);
    flash('fiddly_deleted', t_('fiddly_deleted'), 'alert alert-success');
    redirect("users/index");
  }

  protected function edit($id) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      if ($_FILES['image']['size'] == 0) {
        $id = (int)$id;
        $file = $this->fiddlyModel->getFiddlyPicture($id)->image_link;
      } else {
        $file = $this->addFiddlyPicture();
      }


      // Init data
      $data = ['name' => trim($_POST['name']), 'image_link' => trim($file), 'id' => $id, 'name_err' => trim('')];

      // Validate name
      if (empty($data['name'])) {
        $data['name_err'] = t_('enter_name');
      }

      // Make sure errors are empty
      if (empty($data['name_err'])) {
        // Validated
        $data['id'] = (int)$data['id'];

        // edit fiddly
        if ($this->fiddlyModel->editFiddly($data)) {
          flash('fiddly_edited', t_('fiddly_edited'), 'alert alert-success');
          redirect('users/index');

        } else {
          die('Something gone wrong');
        }
      } else {
        // Load view with errors
          $object = $this->fiddlyModel->getFiddly($id);
          $object['name_err'] = $data['name_err'];
          $this->view("fiddly/edit_fiddly", $object);
      }
    } else {
      $data = $this->fiddlyModel->getFiddly($id);
      $data[0]->fiddly_gps_id = (int)$id;
        $this->view('fiddly/edit_fiddly', $data);
    }
  }

  /**
   * Martijn Dijkgraaf
   *
   */
  protected function find($id = false) {

    $bHasFiddlys = false;

    if (!$id) {
      $bHasFiddlys = $this->fiddlyModel->getAllFiddlysByUser();
      $this->setLocations($bHasFiddlys);
    } else {
      $bAccessToFiddly = $this->fiddlyModel->checkIfUserIsOwner($id);

      if ($bAccessToFiddly) {
        $bHasFiddlys = $this->fiddlyModel->getFiddly($id);
        $this->setLocations($bHasFiddlys);
      } else {
        flash('access_denied', t_('access-denied'), ' alert alert-warning');
        redirect('users/');
      }
    }

    $data = [];

    $data['bHasFiddlys'] = false;
    if ($bHasFiddlys) {
      $data['bHasFiddlys'] = true;
    }

    $data['fiddlyData'] = $this->getFiddlyData();


    $this->view('fiddly/find', $data);

  }

  /**
   * https://stackoverflow.com/questions/5460838/php-select-a-random-lon-lat-within-a-certain-radius
   */
  public function getRandomLongitudeLattitude($longitude = null, $latitude = null) {

    if (!$longitude && !$latitude) {
      $longitude = (float)4.768323;
      $latitude = (float)51.571915;
    }
    $radius = rand(1, 2); // in miles

    $alocation = array();

    $alocation['longitude'] = substr($longitude + $radius / abs(cos(deg2rad($latitude)) * 69), 0, 12);
    $alocation['lattitude'] = substr($lat_max = $latitude + ($radius / 69), 0, 12);

    return $alocation;
  }


  /**
   * Martijn Dijkgraaf
   * @param $aData
   */
  public function setLocations($aData) {

    if (!$aData) {
      return true;
    }

    $aLocations = array();
    $i = 0;

    //create Json for the google maps feature
    foreach ($aData as $data) {
      $this->setNewLocations($this->getRandomLongitudeLattitude($data->longitude, $data->lattitude), $data->fiddly_gps_id);

      $aLocations[$i] = array('name' => $data->name, 'content' => '
			    <div class="infowindow">
			    	<h3>' . $data->name . '</h3>
			    	<span>' . t_('battery') . ' ' . $data->battery_status . '%</span>
			    	
			    	<div><a target="_blank" href="https://www.google.com/maps/?q=' . $data->lattitude . ',' . $data->longitude . '">
			    		' . t_('route-to-fiddly') . '
					</a>
					</div>
				</div>
			    ', 'battery_status' => $data->battery_status, 'longitude' => $data->longitude, 'lattitude' => $data->lattitude, 'img' => URLROOT . '/images/content/user_images/' . $data->image_link, 'id' => $data->fiddly_gps_id);
      $i++;
    }
    echo '<script> var locations =' . json_encode($aLocations) . '
					</script>';
  }

  public function setNewLocations($aLocations = array(), $id) {
    $this->fiddlyModel->updateLocations($aLocations, $id);
  }


  public function getFiddlyData() {
    return $this->fiddlyModel->getAllFiddlysByUser();
  }
}