<?php

	// Class 
	class User {
		
		// les variables de la class
		private $_mail;
		private $_password;
		private $_personne;
		private $_parameters;
		
		// getters and setters
		function getId() {
			return $this->_personne->getId();
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
				case 3:
					$this->constructor3Args($args[0],$args[1],$args[2]);
					break;
				case 2:
					$this->constructor2Args($args[0],$args[1]);
					break;
				 default:
					break;
			}
		}

		// the constrcutor
		private function constructor3Args($mail, $password, $personne) {
			$this->_mail = $mail;
			$this->_password = $password;
			$this->_personne = $personne;
			$this->_parameters = null;
		}
		private function constructor2Args($mail, $password) {
			$this->_mail = $mail;
			$this->_password = $password;
			$this->_personne = -1;
			$this->_parameters = null;
		}
		
		// additional function
			// permet de ce connecter au systeme
			function login() {
				if (isConnectMySql()) {
					$sql = 'select mail, personne from projetGL_user where mail = \'' . sanitize_string($this->_mail) . '\' && password = md5(\'' . sanitize_string($this->_password) . '\');';
					$result = $_SESSION["link"]->query($sql);
					if ($result->num_rows == 0){
						return false;
					}
					else {
						$row = $result->fetch_array(MYSQLI_ASSOC);
						$user = new User($row["mail"], $this->_password, new Personne($row["personne"]));
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
			$sql = 'select pu.personne, pp.nom, pp.prenom from projetGL_user as pu join projetGL_personne as pp on pu.personne = pp.id where pu.id <> 1;';
			$result = $_SESSION["link"]->query($sql);
			if ($result->num_rows == 0){
				return null;
			}
			else {
				$i = 0;
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					$retVal[$i]["id"] = $row["personne"];
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
	function createAccount($nom, $prenom, $adresse, $userPassword, $telephone, $mail, $firstRole) {
		if (isConnectMySql()) {
			// creation de la personne
			$sqlPersonne = 'INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES (\'' . sanitize_string($nom) . '\', \'' . sanitize_string($prenom) . '\', \'' . sanitize_string($adresse) . '\', \'' . sanitize_string($telephone) . '\', \'' . sanitize_string($mail) . '\');';
			if ($_SESSION["link"]->query($sqlPersonne) === true) {
				// creer le compte utilisateur liée à la personne creer
				$persId = $_SESSION["link"]->insert_id;
				$sqlUser = 'INSERT INTO projetGL_user(mail, password, personne, etat) VALUES(\'' . sanitize_string($mail) . '\', md5(\'' . sanitize_string($userPassword) . '\'), ' . $persId . ', 1);'; 
				if ($_SESSION["link"]->query($sqlUser) === true) {
					// ajout les parametres par default
					$sqlRole = 'INSERT INTO projetGL_personne_role(personne, role) VALUES (' . $persId . ', ' . $firstRole . ');';
					if ($_SESSION["link"]->query($sqlRole) === true) {
						// ajout des param
						$sqlParams = 'INSERT INTO projetGL_user_parameters(userId, autoAlert, receiveMail, receiveAlert, defaultRole) VALUES(' . $persId . ', false, false, false, ' . $firstRole . ');';
						return $persId;
					}
					else {
						return 0;
					}
				}
				else {
					return 0;
				}
			}
			else {
				return 0;
			}
		}
		else {
			return 0;
		}
	}
	
	// met à jour la base de donnée avec les valeurs de la session utilisé
	function majUserInformation($idUser, $password, $receiveMail, $receiveNotif, $defaultUser, $adresse, $mail, $telephone) {
		if (isConnectMySql()) {
			$sql = 'update projetGL_personne p join projetGL_user u on p.id = u.personne join projetGL_user_parameters up on up.userId = u.id set u.password = md5("' . sanitize_string($password) . '"), up.receiveMail = ' . sanitize_string($receiveMail) . ', up.receiveAlert = ' . sanitize_string($receiveNotif) . ', up.defaultRole = ' . sanitize_string($defaultUser) . ', p.adresse = "' . sanitize_string($adresse) .'", p.telephone = "' . sanitize_string($telephone) . '", p.mail = "' . sanitize_string($mail) .'" where u.personne = ' . sanitize_string($idUser) . ';';
			return $_SESSION["link"]->query($sql);
		}
		else {
			return false;
		}
	}
	
	/*
	// retourne l'id d'un utilisateur via un id de personne
	function getUserIdFromPers($idPers) {
		if (isConnectMySql()) {
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
	*/
	
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
	function synchroniseRole($idCollabo, $collabo, $respo, $admin) {
		if (isConnectMySql()) {
			$temp[0][0] = 2;
			$temp[1][0] = 3;
			$temp[2][0] = 4;
			if ($collabo)
				$temp[2][1] = "add";
			else
				$temp[2][1] = "";
			if ($respo)
				$temp[1][1] = "add";
			else
				$temp[1][1] = "";
			if ($admin)
				$temp[0][1] = "add";
			else
				$temp[0][1] = "";
			$sql = 'select role from projetGL_personne_role where personne = ' . sanitize_string($idCollabo) . ';';
			$result = $_SESSION["link"]->query($sql);
			if ($result->num_rows != 0){
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					if ($temp[$row["role"] - 2][1] == "add") {
						$temp[$row["role"] - 2][1] = "";
					}
					else if ($temp[$row["role"] - 2][1] == "") {
						$temp[$row["role"] - 2][1] = "rm";
					}
				}
			}
			for ($i = 0; $i < 3; $i ++) {
				$sql = "";
				if ($temp[$i][1] == "add") {
					$sql = 'INSERT INTO projetGL_personne_role(personne, role) VALUES (' . $idCollabo . ', ' . $temp[$i][0] . ');';
				}
				elseif ($temp[$i][1] == "rm") {
					$sql = 'DELETE FROM projetGL_personne_role where personne = ' . $idCollabo . ' and role = ' . $temp[$i][0] . ';';
				}
				if ($sql != "") {
					echo 'sql : ' . $sql . '<br/>';
					if(!$_SESSION["link"]->query($sql)) {
						return false;
					}
				}
			}
			return true;
		}
		else {
			return false;
		}
	}
?>