<?php

	// Class 
	class Projet {
		
		// les variables de la class
		private $_id;
		private $_nom;
		private $_description;
		private $_uniteTemps;
		private $_avancement;
		private $_client;
		private $_listeTache;
		private $_responsable;
		
		// getters and setters
		function getId() {
			return $this->_id;
		}
        function getNom() {
            return $this->_nom;
        }
        function getDescription() {
            return $this->_description;
        }
		function getClient() {
			return $this->_client;
		}
		function getResponsable() {
			return $this->_responsable;
		}
		function getAvancement() {
			return $this->_avancement;
		}
		

		// manager of the constructor
		public function __construct() {
			$ctp = func_num_args();
			$args = func_get_args();
			switch($ctp) {
				case 6:
					$this->constructor6Args($args[0],$args[1],$args[2],$args[3],$args[4],$args[5]);
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
		private function constructor6Args($id, $nom, $description, $uniteTemps, $avancement, $client) {
			$this->_id = $id;
            $this->_nom = $nom;
            $this->_description = $description;
            $this->_uniteTemps = $uniteTemps;
            $this->_avancement = $avancement;
            $this->_client = $client;
            $this->_listeTache = null;
			$this->_responsable = null;
		}
		private function constructor2Args($id, $nom) {
			$this->_id = $id;
            $this->_nom = $nom;
            $this->_description = null;
            $this->_uniteTemps = null;
            $this->_avancement = null;
            $this->_client = null;
            $this->_listeTache = null;
			$this->_responsable = null;
		}
		private function constructor1Args($id) {
			if (isConnectMySql()) {
				$sql = 'select p.id as pid, p.nom as pnom, p.description, p.avancement, c.id as cid, c.nom as cnom, c.adresse, pe.id as peid, pe.nom as penom, pe.prenom as peprenom from projetGL_projet p join projetGL_client c on p.client = c.id join projetGL_personne pe on pe.id = p.responsable where p.id = ' . sanitize_string($id) . ';';
				$result = $_SESSION["link"]->query($sql);
				if ($result->num_rows == 0){
					return false;
				}
				else {
					$row = $result->fetch_array(MYSQLI_ASSOC);
					$this->_id = $id;
					$this->_nom = $row["pnom"];
					$this->_description = $row["description"];
					$this->_uniteTemps = "";
					$this->_avancement = $row["avancement"];
					$this->_client = new Client($row["cid"], $row["cnom"], $row["adresse"]);
					$this->_listeTache = "";
					$this->_responsable = new Personne($row["peid"], $row["penom"], $row["peprenom"]);
					return true;
				}
			}
			else {
				return false;
			}
		}
		
		// retourne la liste des taches
		public function getListTache() {
			if (isConnectMySql()) {
				$sql = 'select id from projetGL_tache where etat = 1 and projet = ' . sanitize_string($this->_id) . ';';
				$result = $_SESSION["link"]->query($sql);
				if ($result->num_rows == 0){
					return null;
				}
				else {
					$i = 0;
					while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
						$retVal[$i] = new Tache($row["id"]);
						$i++;
					}
					return $retVal;
				}
			}
			else {
				return null;
			}
		}
		
		// retourne un arbre de tache
		/*
		public function getTreeTache() {
			$listeTaches = $this->getListTache();
			$listeRestante = null;
			$listeMere = null;
			$i = 0;
			$j = 0;
			if ($listeTaches != null) {
				foreach($listeTaches as $value) {
					if ($value->getTacheMere() == null) {
						$listeMere[$i] = $value;
						$i ++;
					}
					else {
						$listeRestante[$j] = $value;
						$j ++;
					}
				}
				while ($listeRestante != null) {
					foreach($listeRestante as $vRest) {
						foreach($listeMere as $vMere) {
							if ($vMere->getId() == $vRest)
						}
					}
				}
			}
			return $listeMere;
		}
		*/
		
		// ajoute un element à un arbre
		/*
		private function addToTree($tree, $val) {
			foreach($tree as $element) {
				if ($element->getId() == $val->get)
			}
		}
		*/
		
	}
    
    // test si le contact existe
    function isProjetActif($idProjet, $idClient) {
        if (isConnectMySql()) {
			$sql = 'select nom from projetGL_projet where etat = 1 and client = ' . sanitize_string($idClient) . ' and id = ' . sanitize_string($idProjet) . ';';
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
	
	// retourne la liste des projets
	function getListProjectActif() {
		if (isConnectMySql()) {
			$sql = 'select id, nom from projetGL_projet where etat = 1;';
			$result = $_SESSION["link"]->query($sql);
			if ($result->num_rows == 0){
				return null;
			}
			else {
				$i = 0;
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					$retVal[$i] = new Projet($row["id"], $row["nom"]);
					$i++;
				}
				return $retVal;
			}
		}
		else {
			return null;
		}
	}
	
	// requete sur les projets
	function requeteProjet($nom, $client, $respo, $active, $termine, $archive) {
		if (isConnectMySql()) {
			$sql = 'select id, nom from projetGL_projet where nom like \'%' . sanitize_string($nom) . '%\'';
			if ($client != -1) {
				$sql .= ' and client = ' . sanitize_string($client);
			}
			if ($respo != -1) {
				$sql .= ' and responsable = ' .  sanitize_string($respo);
			}
			if ($active || $termine || $archive) {
				if (($active && $termine) || ($active && $archive ) || ($termine && $archive)) {
					$first = true;
					$sql .= ' and (';
					if ($active) {
						if ($first) {
							$sql .= 'etat = 1';
							$first = false;
						}
						else {
							$sql .= ' or etat = 1';
						}
					}
					if ($termine) {
						if ($first) {
							$sql .= 'etat = 3';
							$first = false;
						}
						else {
							$sql .= ' or etat = 3';
						}
					}
					if ($archive) {
						if ($first) {
							$sql .= 'etat = 4';
							$first = false;
						}
						else {
							$sql .= ' or etat = 4';
						}
					}
					$sql .= ')';
				}
				else {
					if ($active) {
						$sql .= ' and etat = 1';
					}
					else if ($termine) {
						$sql .= ' and etat = 3';
					}
					else if ($archive) {
						$sql .= ' and etat = 4';
					}
				}
			}
			$sql .= ';';
			$result = $_SESSION["link"]->query($sql);
			if ($result->num_rows == 0) {
				return null;
			}
			else {
				$i = 0;
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					$retVal[$i] = new Projet($row["id"], $row["nom"]);
					$i++;
				}
				return $retVal;
			}
		}
		else {
			return null;
		}
	}
	
	
	// reatribut un projet a un autre responsable
	function changeRespo($idProjet, $idNewRespo) {
		if (isConnectMySql()) {
			$sql = 'update projetGL_projet set responsable = ' . sanitize_string($idNewRespo) .' where id = ' . sanitize_string($idProjet) . ';';
			echo 'sql Respo : ' . $sql;
			return $_SESSION["link"]->query($sql);
		}
		else {
			return false;
		}
	}
	
	// reatribut une tache a un autre collaborateur
	function changeCollabo($idTache, $idNewCollabo) {
		if (isConnectMySql()) {
			$sql = 'update projetGL_tache set responsable = ' . sanitize_string($idNewCollabo) .' where id = ' . sanitize_string($idTache) . ';';
			echo 'sql collabo : ' . $sql;
			return $_SESSION["link"]->query($sql);
		}
		else {
			return false;
		}
	}
	
?>