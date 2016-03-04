<?php

	// Class 
	class Personne {
		
		// les variables de la class
		private $_id;
		private $_nom;
		private $_prenom;
		private $_mail;
		private $_telephone;
		private $_adresse;
		
		// les getters et les setters de personne
			// les getters
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
		public function getAdresse() {
			return $this->_adresse;
		}
			// les setters
		public function setNom($nom) {
			$this->_nom = $nom;
		}
		public function setPrenom ($prenom){
			$this->_prenom = $prenom;
		}
		public function setTelephone ($telephone){
			$this->_telephone = $telephone;
		}
		public function setAdresse($adresse){
			$this->_adresse = $adresse;
		}
		public function setMail($mail){
			$this->_mail = $mail;
		}
		
		// manager of the constructor
		public function __construct() {
			$ctp = func_num_args();
			$args = func_get_args();
			switch($ctp) {
				case 6:
					$this->constructor6Args($args[0],$args[1],$args[2],$args[3],$args[4],$args[5]);
					break;
				case 5:
					$this->constructor5Args($args[0],$args[1],$args[2],$args[3],$args[4]);
					break;
				case 4:
					$this->constructor4Args($args[0],$args[1],$args[2],$args[3]);
					break;
				case 3:
					$this->constructor3Args($args[0],$args[1],$args[2]);
					break;
				case 1:
					$this->constructor1Args($args[0]);
					break;
				 default:
					break;
			}
		}
		
		// the constrcutor
		private function constructor6Args($id, $nom, $prenom, $mail, $telephone, $adresse) {
			$this->_id = $id;
			$this->_nom = $nom;
			$this->_prenom = $prenom;
			$this->_mail = $mail;
			$this->_telephone = $telephone;
			$this->_adresse = $adresse;
		}
		private function constructor5Args($id, $nom, $prenom, $mail, $telephone) {
			$this->_id = $id;
			$this->_nom = $nom;
			$this->_prenom = $prenom;
			$this->_mail = $mail;
			$this->_telephone = $telephone;
			$this->_adresse = "";
		}
		private function constructor4Args($nom, $prenom, $mail, $telephone) {
			$this->_id = -1;
			$this->_nom = $nom;
			$this->_prenom = $prenom;
			$this->_mail = $mail;
			$this->_telephone = $telephone;
			$this->_adresse = "";
		}
		private function constructor3Args($id, $nom, $prenom) {
			$this->_id = $id;
			$this->_nom = $nom;
			$this->_prenom = $prenom;
			$this->_mail = "";
			$this->_telephone = "";
			$this->_adresse = "";
		}
		private function constructor1Args($id) {
			if (isConnectMySql()) {
				$sql = 'select nom, prenom, adresse, telephone, mail from projetGL_personne where id = ' . sanitize_string($id) . ';';
				$result = $_SESSION["link"]->query($sql);
				if ($result->num_rows != 0){
					$row = $result->fetch_array(MYSQLI_ASSOC);
					$this->_id = $id;
					$this->_nom = $row["nom"];
					$this->_prenom = $row["prenom"];
					$this->_mail = $row["mail"];
					$this->_telephone = $row["telephone"];
					$this->_adresse = $row["adresse"];
				}
			}
		}
		
		// sauvegarde une personne
		public function save() {
			if (isConnectMySql()) {
				$sql = 'update projetGL_personne p set p.nom = "' . sanitize_string($this->_nom) .'", p.prenom = "' . sanitize_string($this->_prenom) .'",  p.adresse = "' . sanitize_string($this->_adresse) .'", p.telephone = "' . sanitize_string($this->_telephone) . '", p.mail = "' . sanitize_string($this->_mail) .'" where p.id = ' . sanitize_string($this->_id) . ';';
				return $_SESSION["link"]->query($sql);
			}
			else {
				return false;
			}
		}
		
		// retoune la liste de projet actif avec ce collaborateur
		public function projetListeDelete() {
			if (isConnectMySql()) {
				$sql = 'select p.id as pid, p.nom as pnom from projetGL_projet p where p.etat = 1 and p.responsable = ' . $this->getId() . ';';
				$result = $_SESSION["link"]->query($sql);
				if ($result->num_rows == 0) {
					return null;
				}
				else {
					$i = 0;
					while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
						$retVal[$i]["pid"] = $row["pid"];
						$retVal[$i]["pnom"] = $row["pnom"];
						$i++;
					}
					return $retVal;
				}
			}
			else {
				return null;
			}
		}
		
		// retourne la liste de tache active avec ce collaborateur
		public function tacheListeDelete() {
			if (isConnectMySql()) {
				$sql = 'select p.id as pid, p.nom as pnom, t.id as tid, t.nom as tnom from projetGL_tache t join projetGL_projet p on t.projet = p.id where t.etat = 1 and t.responsable = ' . $this->getId() . ';';
				$result = $_SESSION["link"]->query($sql);
				if ($result->num_rows == 0) {
					return null;
				}
				else {
					$i = 0;
					while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
						$retVal[$i]["pid"] = $row["pid"];
						$retVal[$i]["pnom"] = $row["pnom"];
						$retVal[$i]["tid"] = $row["tid"];
						$retVal[$i]["tnom"] = $row["tnom"];
						$i++;
					}
					return $retVal;
				}
			}
			else {
				return null;
			}
		}
		
		// retourne la liste des utilisateur du system encore actif
			// 4 == collabo et 3 == chef de projet
		function getListActiveUserByRole($idRole) {
			if (isConnectMySql()) {
				$sql = 'select p.id, p.nom, p.prenom from projetGL_role r join projetGL_personne_role pr on r.id = pr.role join projetGL_personne p on p.id = pr.personne join projetGL_user u on u.personne = p.id where r.id = ' . sanitize_string($idRole) . ' and p.id <> 1 and p.id <> ' . sanitize_string($this->getId()) . ' and u.etat = 1;';
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
	}
	
	// retoune tous les collaborateur actifs
	function getCollaboList() {
		if (isConnectMySql()) {
			$sql = 'select distinct p.id, p.nom, p.prenom, p.mail, p.telephone, p.adresse from projetGL_personne_role pr join projetGL_personne p on pr.personne = p.id join projetGL_user u on u.personne = p.id where pr.role <> 1 and u.etat = 1;';
			$result = $_SESSION["link"]->query($sql);
			if ($result->num_rows == 0){
				return null;
			}
			else {
				$i = 0;
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					$retVal[$i] = new Personne($row["id"], $row["nom"], $row["prenom"], $row["mail"], $row["telephone"], $row["adresse"]);
					$i++;
				}
				return $retVal;
			}
		}
		else {
			return null;
		}
	}
	
	// retourne tous les  responsable de projet actifs
	function getRespoList() {
		if (isConnectMySql()) {
			$sql = 'select distinct p.id, p.nom, p.prenom, p.mail, p.telephone, p.adresse from projetGL_personne_role pr join projetGL_personne p on pr.personne = p.id join projetGL_user u on u.personne = p.id where pr.role = 3 and u.etat = 1;';
			$result = $_SESSION["link"]->query($sql);
			if ($result->num_rows == 0){
				return null;
			}
			else {
				$i = 0;
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					$retVal[$i] = new Personne($row["id"], $row["nom"], $row["prenom"], $row["mail"], $row["telephone"], $row["adresse"]);
					$i++;
				}
				return $retVal;
			}
		}
		else {
			return null;
		}
	}
	
	// requete sur les collabo
	function requeteCollabo($nom, $prenom, $telephone, $projet) {
		if (isConnectMySql()) {
			$sql = 'select distinct p.id, p.nom, p.prenom, p.mail, p.telephone, p.adresse from projetGL_personne p join projetGL_user u on u.personne = p.id left join projetGL_projet pj on pj.responsable = p.id left join projetGL_tache t on t.responsable = p.id where p.id <> 1 and u.etat = 1 and p.nom like \'%' . sanitize_string($nom) . '%\' and p.prenom like \'%' . sanitize_string($prenom) . '%\' and p.telephone like \'%' . sanitize_string($telephone) . '%\' ' ;
			if ($projet != -1) {
				$sql .= ' and (pj.id = ' . sanitize_string($projet) . ' or t.projet = ' . sanitize_string($projet) . ' )';
			}
			$sql .= ';';
			$result = $_SESSION["link"]->query($sql);
			if ($result->num_rows == 0) {
				return null;
			}
			else {
				$i = 0;
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					$retVal[$i] = new Personne($row["id"], $row["nom"], $row["prenom"], $row["mail"], $row["telephone"], $row["adresse"]);
					$i++;
				}
				return $retVal;
			}
		}
		else {
			return null;
		}
	}

?>