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
	}
	
	// retoune un objet personne en fonction de son id
	function getPersonneById($idPersonne) {
		if (isConnectMySql()) {
			$sql = 'select nom, prenom, adresse, telephone, mail from projetGL_personne where id = ' . sanitize_string($idPersonne) . ';';
			$result = $_SESSION["link"]->query($sql);
			if ($result->num_rows == 0){
				return null;
			}
			else {
				$row = $result->fetch_array(MYSQLI_ASSOC);
				return new Personne($idPersonne, $row["nom"], $row["prenom"], $row["mail"], $row["telephone"], $row["adresse"]);
			}
		}
		else {
			return null;
		}
	}

?>