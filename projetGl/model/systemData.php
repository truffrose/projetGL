<?php

	// Class 
	class SystemData {
		
		// les variables de la class
		private $_userRole;
		
		public function getUserRole() {
			return $this->_userRole;
		}
		public function setUserRole($idRole) {
			$this->_userRole = $idRole;
		}
		
		// manager of the constructor
		public function __construct() {
			$ctp = func_num_args();
			$args = func_get_args();
			switch($ctp) {
				case 4:
					$this->constructor1Args($args[0]);
					break;
				case 2:
					$this->constructor0Args();
					break;
				 default:
					break;
			}
		}

		// the constrcutor
		private function constructor1Args($idRole) {
			$this->_userRole = $idRole;
		}
		private function constructor0Args() {
			$this->_userRole = -1;
		}
		
	}
	
	/*
	// return les droits d'un utilisateur (le role du compte connecté)
	function isSuperAdmin() {
		return isset($_SESSION["user"]);
	}
	*/
	
?>