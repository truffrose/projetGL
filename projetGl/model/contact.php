<?php

	// Class 
	class Contact {
		
		// les variables de la class
		private $_id;
		private $_personne;
		private $_client;
		
		// getters and setters
		function getId() {
			return $this->_id;
		}
		function setPersonne($personne) {
			$this->_personne = $personne;
		}
		function getPersonne() {
			return $this->_personne;
		}
		function getClient() {
			return $this->_client;
		}

		// manager of the constructor
		public function __construct() {
			$ctp = func_num_args();
			$args = func_get_args();
			switch($ctp) {
				case 3:
					$this->constructor3Args($args[0],$args[1],$args[2]);
					break;
				case 2:
					$this->constructor2Args($args[0],$args[1]);
					break;
				case 1:
					$this->constructor1Args($args[0]);
					break;
				 default:
					break;
			}
		}

		// the constrcutor
		private function constructor3Args($id, $client, $personne) {
			$this->_id = $id;
			$this->client = $client;
			$this->_personne = $personne;
		}
		private function constructor2Args($id, $personne) {
			$this->_id = $id;
			$this->client = -1;
			$this->_personne = $personne;
		}
		private function constructor1Args($personne) {
			$this->_id = -1;
			$this->_client = -1;
			$this->_personne = $personne;
		}
		
	}
    
    // test si le contact existe
    function isContactActif($idContact, $idClient) {
        if (isConnectMySql()) {
			$sql = 'select id from projetGL_contact where etat = 1 and client = ' . sanitize_string($idClient) . ' and personne = ' . sanitize_string($idContact) . ';';
            $result = $_SESSION["link"]->query($sql);
			if ($result->num_rows == 0){
				return false;
			}
			else {
                return true;
			}
		}
		else {
			return false;
		}
    }
    
	
?>