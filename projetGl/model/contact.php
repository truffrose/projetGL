<?php

	// Class 
	class Contact {
		
		// les variables de la class
		private $_personne;
		private $_client;
		
		// getters and setters
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
		private function constructor2Args($client, $personne) {
			$this->_client = $client;
			$this->_personne = $personne;
		}
		private function constructor1Args($personne) {
			$this->_client = -1;
			$this->_personne = $personne;
		}
		
		// sauvegarde un contact
		public function save() {
			if($this->_personne->save()) {
				if (isConnectMySql()) {
					$sql = 'update projetGL_contact c set c.client = ' . sanitize_string($this->_client) .' where c.personne = ' . sanitize_string($this->_personne->getId()) . ';';
					return $_SESSION["link"]->query($sql);
				}
				else {
					return false;
				}
			}
			return false;
		}
		
		// creation d'un contact
		public function create() {
			if (isConnectMySql()) {
				// creation de la personne
				$sqlPersonne = 'INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES (\'' . sanitize_string($this->_personne->getNom()) . '\', \'' . sanitize_string($this->_personne->getPrenom()) . '\', \'' . sanitize_string($this->_personne->getAdresse()) . '\', \'' . sanitize_string($this->_personne->getTelephone()) . '\', \'' . sanitize_string($this->_personne->getMail()) . '\');';
				if ($_SESSION["link"]->query($sqlPersonne) === true) {
					// creer le contact liée à la personne creer
					$persId = $_SESSION["link"]->insert_id;
					$sqlContact = 'INSERT INTO projetGL_contact(client, personne, etat) VALUES (' . $this->_client . ', ' . $persId . ', 1);'; 
					if ($_SESSION["link"]->query($sqlContact) === true) {
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
		
		// liste des tache à réallouer
		public function tacheListeDelete() {
			if (isConnectMySql()) {
				$sql = 'select p.id as pid, p.nom as pnom, t.id as tid, t.nom as tnom from projetGL_tache t join projetGL_projet p on t.projet = p.id where t.etat = 1 and t.contact = ' . $this->_personne->getId() . ';';
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
		
		// supprime le contact de la base en mettant son état à 2 (supprimé)
		public function remove() {
			if (isConnectMySql()) {
				$sql = 'update projetGL_contact set etat = 2 where personne = ' . $this->_personne->getId() . ';';
				return $_SESSION["link"]->query($sql);
			}
			else {
				return false;
			}
		}
		
	}
    
    // test si le contact existe
    function isContactActif($idContact, $idClient) {
        if (isConnectMySql()) {
			$sql = 'select personne from projetGL_contact where etat = 1 and client = ' . sanitize_string($idClient) . ' and personne = ' . sanitize_string($idContact) . ';';
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
    
	// créer un nouveau contact dans la base de donné (celui-ci n'est pas forcement rataché à un client)
	function createContact($nom, $prenom, $adresse, $telephone, $mail, $client) {
		if (isConnectMySql()) {
			// creation de la personne
			$sqlPersonne = 'INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES (\'' . sanitize_string($nom) . '\', \'' . sanitize_string($prenom) . '\', \'' . sanitize_string($adresse) . '\', \'' . sanitize_string($telephone) . '\', \'' . sanitize_string($mail) . '\');';
			echo $sqlPersonne;
			if ($_SESSION["link"]->query($sqlPersonne) === true) {
				// creer le compte utilisateur liée à la personne creer
				$persId = $_SESSION["link"]->insert_id;
				$sqlContact = 'INSERT INTO projetGL_contact(client, personne, etat) VALUES (' . sanitize_string($client) . ', ' . $persId . ', 1);';
				echo $sqlContact;
				if ($_SESSION["link"]->query($sqlUser) === true) {
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
	
	// requete sur les contacts
	function requeteContact($nom, $prenom, $telephone, $client) {
		if (isConnectMySql()) {
			$sql = 'select c.client, p.id, p.nom, p.prenom , p.mail , p.telephone from projetGL_contact c join projetGL_personne p  on c.personne = p.id where p.nom like \'%' . sanitize_string($nom) . '%\' and p.prenom like \'%' . sanitize_string($prenom) . '%\' and p.telephone like \'%' . sanitize_string($telephone) . '%\'';
			if ($client != -1) {
				$sql .= ' and c.client = ' . sanitize_string($client);
			}
			$sql .= ';';
			$result = $_SESSION["link"]->query($sql);
			if ($result->num_rows == 0) {
				return null;
			}
			else {
				$i = 0;
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					$retVal[$i] = new Contact($row["client"], new Personne($row["id"], $row["nom"], $row["prenom"], $row["mail"], $row["telephone"]));
					$i++;
				}
				return $retVal;
			}
		}
		else {
			return null;
		}
	}
	
	// retounr un contact via un id contact
	function getContactById($id) {
		if (isConnectMySql()) {
			$sql = 'select c.client, p.id, p.nom, p.prenom , p.mail , p.telephone from projetGL_contact c join projetGL_personne p  on c.personne = p.id where p.id = ' . $id . ';';
			$result = $_SESSION["link"]->query($sql);
			if ($result->num_rows == 0) {
				return null;
			}
			else {
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$retVal = new Contact($row["client"], new Personne($row["id"], $row["nom"], $row["prenom"], $row["mail"], $row["telephone"]));
				return $retVal;
			}
		}
		else {
			return null;
		}
	}
	
	// reatribut une tache a un autre contact
	function changeContact($idTache, $idNewContact) {
		if (isConnectMySql()) {
			$sql = 'update projetGL_tache set contact = ' . sanitize_string($idNewContact) .' where id = ' . sanitize_string($idTache) . ';';
			return $_SESSION["link"]->query($sql);
		}
		else {
			return false;
		}
	}
	
?>