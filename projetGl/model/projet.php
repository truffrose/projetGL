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
		
		// getters and setters
		function getId() {
			return $this->_id;
		}
        function getNom() {
            return $this->_nom;
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
		}
		private function constructor2Args($id, $nom) {
			$this->_id = $id;
            $this->_nom = $nom;
            $this->_description = null;
            $this->_uniteTemps = null;
            $this->_avancement = null;
            $this->_client = null;
		}
		private function constructor1Args($id) {
			$this->_id = $id;
            $this->_nom = null;
            $this->_description = null;
            $this->_uniteTemps = null;
            $this->_avancement = null;
            $this->_client = null;
		}
		
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
	
?>