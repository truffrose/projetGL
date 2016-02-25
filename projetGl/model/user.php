<?php

	// Class 
	class User {
		
		// les variables de la class
		private $_id;
		private $_mail;
		private $_password;
		private $_personne;
		private $_parameters;
		
		// getters and setters
		function getId() {
			return $this->_id;
		}
		function getPassword() {
			return $this->_password;
		}
		function setParameters($param) {
			$this->_parameters = $param;
		}
		function getParameters() {
			return $this->_parameters;
		}
		function getPersonne() {
			return $this->_personne;
		}
		
		

		// manager of the constructor
		public function __construct() {
			$ctp = func_num_args();
			$args = func_get_args();
			switch($ctp) {
				case 4:
					$this->constructor4Args($args[0],$args[1],$args[2],$args[3]);
					break;
				case 2:
					$this->constructor2Args($args[0],$args[1]);
					break;
				 default:
					break;
			}
		}

		// the constrcutor
		private function constructor4Args($id, $mail, $password, $personne) {
			$this->_id = $id;
			$this->_mail = $mail;
			$this->_password = $password;
			$this->_personne = $personne;
			$this->_parameters = null;
		}
		private function constructor2Args($mail, $password) {
			$this->_id = -1;
			$this->_mail = $mail;
			$this->_password = $password;
			$this->_personne = -1;
			$this->_parameters = null;
		}
		
		// additional function
			// permet de ce connecter au systeme
			function login() {
				if (isConnectMySql()) {
					$sql = 'select id, mail, personne from projetGL_user where mail = \'' . sanitize_string($this->_mail) . '\' && password = md5(\'' . sanitize_string($this->_password) . '\');';
					$result = $_SESSION["link"]->query($sql);
					if ($result->num_rows == 0){
						return false;
					}
					else {
						$row = $result->fetch_array(MYSQLI_ASSOC);
						$user = new User($row["id"], $row["mail"], $this->_password, $row["personne"]);
						$_SESSION["user"] = $user;
						// load the paremeter of the account
						$param = new UserParameters();
						if ($param->getParameters()) {
							$systemData = new SystemData($param->getDefaultRole());
							$_SESSION["systemData"] = $systemData;
							return true;
						}
						else {
							return false;
						}
					}
				}
				else {
					return false;
				}
			}
			
			// change le mot de passe dans la base de donnée
			function changePassword($newPassword) {
				if (isConnectMySql()) {
					$sql = 'update projetGL_user set password = md5(\'' . sanitize_string($newPassword) . '\') where mail = \'' . sanitize_string($this->_mail) . '\';';
					if ($_SESSION["link"]->query($sql) === true) {
						$this->password = md5($newPassword);
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
			
			//permet la deconnection du system
			function logout() {
				unset($_SESSION["user"]);
				session_destroy();
			}
			
			
				
				/*
				UPDATE TABLE_A a 
    JOIN TABLE_B b ON a.join_col = b.join_col AND a.column_a = b.column_b 
    JOIN TABLE_C c ON [condition]
SET a.column_c = a.column_c + 1


INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) 
INSERT INTO projetGL_user(mail, password, personne, etat) 
	INSERT INTO projetGL_user_parameters(userId, autoAlert, receiveMail, receiveAlert, defaultRole)
				*/
			
	}
	
	// permet la connection de l'auteur
	function login($mail, $password) {
		$user = new User($mail, $password);
		return $user->login();
	}
	
	// teste si un utilisateur est connecter
	function isConnectUser() {
		return isset($_SESSION["user"]);
	}

	// recupere la liste des utilisateurs
	function getListActiveUser() {
		if (isConnectMySql()) {
			$sql = 'select pu.id, pp.nom, pp.prenom from projetGL_user as pu join projetGL_personne as pp on pu.personne = pp.id where pu.id <> 1;';
			$result = $_SESSION["link"]->query($sql);
			if ($result->num_rows == 0){
				return null;
			}
			else {
				$i = 0;
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					$retVal[$i]["id"] = $row["id"];
					$retVal[$i]["nom"] = $row["nom"];
					$retVal[$i]["prenom"] = $row["prenom"];
					$i++;
				}
				return $retVal;
			}
		}
		else {
			return null;
		}
	}
	
	// creer un collaborateur et l'ajoute à la base
	function createAccount($nom, $prenom, $adresse, $telephone, $mail, $firstRole) {
		if (isConnectMySql()) {
			// creation de la personne
			$sqlPersonne = 'INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES (\'' . sanitize_string($nom) . '\', \'' . sanitize_string($prenom) . '\', \'' . sanitize_string($adresse) . '\', \'' . sanitize_string($telephone) . '\', \'' . sanitize_string($mail) . '\');';
			if ($_SESSION["link"]->query($sqlPersonne) === true) {
				// creer le compte utilisateur liée à la personne creer
				$persId = $_SESSION["link"]->insert_id;
				$userPassword = '123'; // need a fonction to make a random password and give it by mail and need to change it
				$sqlUser = 'INSERT INTO projetGL_user(mail, password, personne, etat) VALUES(\'' . sanitize_string($mail) . '\', md5(\'' . sanitize_string($userPassword) . '\'), ' . $persId . ', 1);'; 
				if ($_SESSION["link"]->query($sqlUser) === true) {
					// ajout les parametres par default
					$userId = $_SESSION["link"]->insert_id;
					$sqlRole = 'INSERT INTO projetGL_personne_role(personne, role) VALUES (' . $persId . ', ' . $firstRole . ');';
					if ($_SESSION["link"]->query($sqlRole) === true) {
						// ajout des param
						$sqlParams = 'INSERT INTO projetGL_user_parameters(userId, autoAlert, receiveMail, receiveAlert, defaultRole) VALUES(' . $userId . ', false, false, false, ' . $firstRole . ');';
						return $_SESSION["link"]->query($sqlParams);
					}
					else {
						return false;
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
		else {
			return false;
		}
	}
	
	// met à jour la base de donnée avec les valeurs de la session utilisé
	function majUserInformation($idUser, $password, $receiveMail, $receiveNotif, $defaultUser, $adresse, $mail, $telephone) {
		if (isConnectMySql()) {
			$sql = 'update projetGL_personne p join projetGL_user u on p.id = u.personne join projetGL_user_parameters up on up.userId = u.id set u.password = md5("' . sanitize_string($password) . '"), up.receiveMail = ' . sanitize_string($receiveMail) . ', up.receiveAlert = ' . sanitize_string($receiveNotif) . ', up.defaultRole = ' . sanitize_string($defaultUser) . ', p.adresse = "' . sanitize_string($adresse) .'", p.telephone = "' . sanitize_string($telephone) . '", p.mail = "' . sanitize_string($mail) .'" where u.id = ' . sanitize_string($idUser) . ';';
			return $_SESSION["link"]->query($sql);
		}
		else {
			return false;
		}
	}
	
	// retourne l'id d'un utilisateur via un id de personne
	function getUserIdFromPers($idPers) {
		if (isConnectMySql()) { // projetGL_user(mail, password, personne, etat) 
			$sql = 'select id from projetGL_user where personne = ' . $idPers . ';';
			$result = $_SESSION["link"]->query($sql);
			if ($result->num_rows == 0){
				return null;
			}
			else {
				$row = $result->fetch_array(MYSQLI_ASSOC);
				return $row["id"];
			}
		}
		else {
			return null;
		}
	}
	
	// change l'état d'un collaborateur pour le mettre dans l'état supprime
	function deleteCollabo($idCollabo) {
		if (isConnectMySql()) {
			$sql = 'update projetGL_user u set u.etat = 2 where u.personne = ' . sanitize_string($idCollabo) . ';';
			return $_SESSION["link"]->query($sql);
		}
		else {
			return false;
		}
	}
	
	// met a jour les valeurs d'un collaborateur sur la base de donnée
	function saveCollaboWithPassword($idCollabo, $nom, $prenom, $password, $adresse, $telephone, $mail) {
		if (isConnectMySql()) {
			$sql = 'update projetGL_user u join projetGL_personne p on u.personne = p.id set u.password = md5("' . sanitize_string($password) . '"), p.nom = "' . sanitize_string($nom) .'", p.prenom = "' . sanitize_string($prenom) .'",  p.adresse = "' . sanitize_string($adresse) .'", p.telephone = "' . sanitize_string($telephone) . '", p.mail = "' . sanitize_string($mail) .'" where personne = ' . sanitize_string($idCollabo) . ';';
			echo 'sql : ' . $sql;
			return $_SESSION["link"]->query($sql);
		}
		else {
			return false;
		}
	}
	function saveCollabo($idCollabo, $nom, $prenom, $adresse, $telephone, $mail) {
		if (isConnectMySql()) {
			$sql = 'update projetGL_user u join projetGL_personne p on u.personne = p.id set p.nom = "' . sanitize_string($nom) .'", p.prenom = "' . sanitize_string($prenom) .'",  p.adresse = "' . sanitize_string($adresse) .'", p.telephone = "' . sanitize_string($telephone) . '", p.mail = "' . sanitize_string($mail) .'" where personne = ' . sanitize_string($idCollabo) . ';';
			echo 'sql : ' . $sql;
			return $_SESSION["link"]->query($sql);
		}
		else {
			return false;
		}
	}
	
	// projetGL_personne(nom, prenom, adresse, telephone, mail)
?>