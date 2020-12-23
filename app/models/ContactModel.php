<?php

	class ContactModel {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function storeChatForm($data) {
			$this->db->query('INSERT INTO chat_form (email, issue, message) VALUES (:email, :issue, :message)');

			$this->db->bind(':email', $data['email']);
			$this->db->bind(':issue', $data['issue']);
			$this->db->bind(':message', $data['message']);

			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function getAllChatForms () {
			$this->db->query('SELECT * FROM chat_form');

			$result = $this->db->resultSet();

			return $result;
		}

		//contact form by MC

        public function storeContactForm($data) {
            $this->db->query('INSERT INTO contact_form (email, name, subject, message) VALUES (:email, :name, :subject, :message)');

            $this->db->bind(':email', $data['email']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':subject', $data['subject']);
            $this->db->bind(':message', $data['message']);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        //contact form by MC, gether all info for admin dashboard
        public function getAllContactForms() {
            $this->db->query('SELECT * FROM contact_form');

            $result = $this->db->resultSet();

            return $result;
        }



        //nog aan te passen MC
        public function deleteChatRecord($id) {
            $this->db->query('DELETE FROM chat_form WHERE chat_id = :id');
            $this->db->bind(':id', $id);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function deleteContactRecord($id) {
            $this->db->query('DELETE FROM contact_form WHERE contact_id = :id');
            $this->db->bind(':id', $id);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

	}