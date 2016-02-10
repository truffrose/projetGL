<?php

	// Class 
	class Personne {
		
		// les variables de la class
		private $_id;
		private $_nom;
		private $_prenom;
		private $_mail;
		private $_telephone;
		
		// les getters et les setters de personne
		public function getId() {
			return $this->_id;
		}
		public function getNom() {
			return $this->_nom;
		}
		public function getPrenom() {
			return $this->_prenom;
		}
		public function getMail() {
			return $this->_mail;
		}
		public function getTelephone() {
			return $this->_telephone;
		}
		
		
		// manager of the constructor
		public function __construct() {
			$ctp = func_num_args();
			$args = func_get_args();
			switch($ctp) {
				case 5:
					$this->constructor5Args($args[0],$args[1],$args[2],$args[3],$args[4]);
					break;
				case 4:
					$this->constructor4Args($args[0],$args[1],$args[2],$args[3]);
					break;
				 default:
					break;
			}
		}
		
		// the constrcutor
		private function constructor5Args($id, $nom, $prenom, $mail, $telephone) {
			$this->_id = $id;
			$this->_nom = $nom;
			$this->_prenom = $prenom;
			$this->_mail = $mail;
			$this->_telephone = $telephone;
		}
		private function constructor4Args($nom, $prenom, $mail, $telephone) {
			$this->_id = -1;
			$this->_nom = $nom;
			$this->_prenom = $prenom;
			$this->_mail = $mail;
			$this->_telephone = $telephone;
		}
	}

?>