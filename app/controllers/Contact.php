<?php

	class Contact extends Controller {
		public $modelContact;

		public function __construct() {
			parent::__construct();

			$this->modelContact = $this->model('ContactModel');
		}

		// contactpagina
		public function index () {

			$data=[];
			$this->contactForm();

			$this->view('contact/index', $data);

		}

		protected function admin() {
			// Get all forms
            $data = [];

			$data['chatforms'] = $this->modelContact->getAllChatForms();
			$data['contactforms'] = $this->modelContact->getAllContactForms();
			// Create view for this method


			$this->view('contact/admin', $data);

		}


		//Nog afmaken MC
        public function deleteItemChat($id) {
		    $this->modelContact->deleteChatRecord($id);
            redirect("contact/admin");
        }



        //Nog afmaken MC
        public function deleteItemContact($id) {
            $this->modelContact->deleteContactRecord($id);
            redirect("contact/admin");
        }




		public function chatForm() {
			// Check for post
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// process form
				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				$data = [
					'email' => trim($_POST['email']),
					'issue' => trim($_POST['issue']),
					'message' => trim($_POST['message'])
				];

				if ($this->modelContact->storeChatForm($data)) {
					flash('chat_form', t_('form_succesful'));
				} else {
					flash('chat_form',  t_('form_error'), 'alert alert-warning');
				}
				redirect('');
			}
		}

		//contact form by MC
        public function contactForm() {
            // Check for post
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // process form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'email' => trim($_POST['email']),
                    'name' => trim($_POST['name']),
                    'subject' => trim($_POST['subject']),
                    'message' => trim($_POST['message'])
                ];

                if(!$this->validateContactForm($data)) {
	                flash('contact_form', t_('form_not_correct'),'alert alert-danger');
	                $this->view('contact/index', $data);
                } else  if ($this->modelContact->storeContactForm($data)) {
                    flash('contact_form', t_('form_succesful'));
                } else {
                    flash('contact_form', t_('form_error'), 'alert alert-danger');
                }
            }
	        $this->view('contact/index');
        }

        private function validateContactForm($data){

			//looping trough the field to check if they are filled in correctly
			$bValid = true;
			foreach($data as $formFields){
				if (empty($formFields)) {
					$bValid = false;
				}
			}

			return $bValid;

        }

	}