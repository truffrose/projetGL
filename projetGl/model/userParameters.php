<?php

	// Class 
	class UserParameters {
		
		// les variables de la class
		private $_idUser;
		private $_autoAlert;
		private $_receiveMail;
		private $_receiveAlerte;
		private $_defaultRole;
		
		// getters and setters
		function getDefaultRole() {
			return $this->_defaultRole;
		}
		
		// manager of the constructor
		public function __construct() {
			$ctp = func_num_args();
			$args = func_get_args();
			switch($ctp) {
				case 5:
					$this->constructor5Args($args[0],$args[1],$args[2],$args[3],$args[4]);
					break;
				case 1:
					$this->constructor1Args($args[0]);
					break;
				case 0:
					$this->constructor0Args();
					break;
				 default:
					break;
			}
		}

		// the constructor
		private function constructor5Args($idUser, $autoAlert, $receiveMail, $receiveAlerte, $defaultRole) {
			$this->_idUser = $idUser;
			$this->_autoAlert = $autoAlert;
			$this->_receiveMail = $receiveMail;
			$this->_receiveAlerte = $receiveAlerte;
			$this->_defaultRole = $defaultRole;
		}
		private function constructor1Args($idUser) {
			$this->_idUser = $idUser;
			$this->_autoAlert = false;
			$this->_receiveMail = false;
			$this->_receiveAlerte = false;
			$this->_defaultRole = -1;
		}
		private function constructor0Args() {
			$this->_idUser = $_SESSION["user"]->getId();
			$this->_autoAlert = false;
			$this->_receiveMail = false;
			$this->_receiveAlerte = false;
			$this->_defaultRole = -1;
		}
		
		// additional function
			// lors dela connection au system on met a jours les droits d'un utilisateur
			function getParameters() {
				if (isConnectMySql()) {
					if (isConnectUser()) {
						$sql = 'select autoAlert, receiveMail, receiveAlert, defaultRole from projetGL_user_parameters where userId = ' . sanitize_string($this->_idUser) . ';';
						$result = $_SESSION["link"]->query($sql);
						if ($result->num_rows == 0){
							return false;
						}
						else {
							$row = $result->fetch_array(MYSQLI_ASSOC);
							$userParameters = new UserParameters($this->_idUser, $row["autoAlert"], $row["receiveMail"], $row["receiveAlert"], $row["defaultRole"]);
							$this->constructor5Args($this->_idUser, $row["autoAlert"], $row["receiveMail"], $row["receiveAlert"], $row["defaultRole"]);
							$_SESSION["user"]->setParameters($userParameters);
							return true;
						}
					}
					else {
						return false;
					}
				}
				else {
					return false;
				}
			}
			
			// permet de changer les parametres (tous en même temps)
			function setParameters() {
				if (isConnectMySql()) {
					$sql = 'update projetGL_user_parameters set autoAlert = ' . $this->_autoAlert . ', receiveMail = ' . $this->_receiveMail . ', receiveAlert = ' . $this->_receiveAlert . ', defaultRole = ' . $this->_defaultRole . ',   where userId = ' . sanitize_string($this->_idUser) . ';';
					if ($_SESSION["link"]->query($sql) === true) {
						return true;
					}
					else {
						return false;
					}
				}
				else {
					return false;
				}
			}
	}
	
	// permet la connection de l'auteur
	function getUserParameter($idUser) {
		if (isConnectMySql()) {
			if (isConnectUser()) {
				$sql = 'select autoAlert, receiveMail, receiveAlert, defaultRole from projetGL_user_parameters where userId = ' . sanitize_string($idUser) . ';';
				$result = $_SESSION["link"]->query($sql);
				if ($result->num_rows == 0){
					return NULL;
				}
				else {
					return $userParameters;
				}
			}
			else {
				return NULL;
			}
		}
		else {
			return NULL;
		}
	}
	
	// return the list of role in function of the id of a user
	function getRoleIdNameByIdUser($idUser) {
		if (isConnectMySql()) {
			$sql = 'select ppr.role, pr.nom from projetGL_personne_role as ppr join projetGL_role as pr on ppr.role = pr.id where personne = ' . sanitize_string($idUser) . ';';
			$result = $_SESSION["link"]->query($sql);
			if ($result->num_rows == 0){
				return null;
			}
			else {
				$i = 0;
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					$retVal[$i]["id"] = $row["role"];
					$retVal[$i]["nom"] = $row["nom"];
					$i++;
				}
				return $retVal;
			}
		}
		else {
			return null;
		}
	}
	
	// ajoute des droits a un utilisateur
	function addRole($idUser, $idRole) {
		if (isConnectMySql()) {
			$sql = 'INSERT INTO projetGL_personne_role(personne, role) VALUES (' . sanitize_string($idUser) . ', ' . sanitize_string($idRole) . ');';
			if ($_SESSION["link"]->query($sql) === true) {
				return true;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}
	
	// enleve des droit a un utilisateur
	function rmRole($idUser, $idRole) {
		if (isConnectMySql()) {
			$sql = 'DELETE FROM projetGL_personne_role WHERE personne = ' . sanitize_string($idUser) . ' AND role = ' . sanitize_string($idRole) . ';';
			if ($_SESSION["link"]->query($sql) === true) {
				return true;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}

?>