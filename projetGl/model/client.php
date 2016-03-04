<?php

	// Class 
	class Client {
		
		// les variables de la class
		private $_id;
		private $_nom;
		private $_adresse;
        
        // les getters et les setters
        public function getId() {
            return $this->_id;
        }
        public function getNom() {
            return $this->_nom;
        }
        public function getAdresse() {
            return $this->_adresse;
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
				case 1:
					$this->constructor1Args($args[0]);
					break;
				 default:
					break;
			}
		}

		// the constrcutor
		private function constructor3Args($id, $nom, $adresse) {
			$this->_id = $id;
			$this->_nom = $nom;
			$this->_adresse = $adresse;
		}
		private function constructor2Args($nom, $adresse) {
			$this->_id = -1;
			$this->_nom = $nom;
			$this->_adresse = $adresse;
		}
        private function constructor1Args($id) {
            if (isConnectMySql()) {
                $sql = 'select nom, adresse from projetGL_client where id = ' . sanitize_string($id) . ';';
                $result = $_SESSION["link"]->query($sql);
                if ($result->num_rows == 0){
                    $this->constructor3Args($id, "", "");
                }
                else {
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    $this->constructor3Args($id, $row["nom"], $row["adresse"]);
                }
            }
            else {
                $this->constructor3Args($id, "", "");
            }
        }
		
		// additional function
			// retoune la liste des contact via un client
			public function getContact() {
				if (isConnectMySql()) {
                    $sql = 'select c.client, p.id, p.nom, p.prenom, p.mail, p.telephone, p.adresse from projetGL_personne p join projetGL_contact c on p.id = c.personne where etat = 1 and c.client = ' . sanitize_string($this->_id) . ';';
                    $result = $_SESSION["link"]->query($sql);
					if ($result->num_rows == 0){
						return null;
					}
					else {
						$i = 0;
                        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                            $retVal[$i] = new Contact($row["client"], new Personne($row["id"], $row["nom"], $row["prenom"], $row["mail"], $row["telephone"], $row["adresse"]));
                            $i++;
                        }
                        return $retVal;
					}
				}
				else {
					return null;
				}
			}
			// retourne la liste des projets via un client
			public function getProjet() {
				if (isConnectMySql()) {
					$sql = 'select p.id, p.nom, p.description, u.typeUnite, p.avancement from projetGL_projet p join projetGL_uniteTemps u on u.id = p.uniteTemps where etat = 1 and client = ' . sanitize_string($this->_id) . ';';
                    $result = $_SESSION["link"]->query($sql);
					if ($result->num_rows == 0){
						return null;
					}
					else {
						$i = 0;
                        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
							$retVal[$i] = new Projet($row["id"], $row["nom"], $row["description"], $row["typeUnite"], $row["avancement"], $this->_id);
                            $i++;
                        }
                        return $retVal;
					}
				}
				else {
					return null;
				}
			}
			
			// retourne le nombre de contact du client
			public function nbContact() {
				if (isConnectMySql()) {
					$sql = 'select count(personne) as nb from projetGL_contact where client = ' . sanitize_string($this->_id) . ' and etat = 1;';
                    $result = $_SESSION["link"]->query($sql);
					if ($result->num_rows == 0){
						return -1;
					}
					else {
						$row = $result->fetch_array(MYSQLI_ASSOC);
						return $row["nb"];
					}
				}
				return -1;
			}
			
            // supprime un client de la base de donnée (passe en inactif)
            
            // modifie un client de la base de donnée
            
            // créer un client au sein de la base de donnee
	}
    
	// recupere la liste des clients
    function getListActiveClient() {
		if (isConnectMySql()) {
			$sql = 'select id, nom, adresse from projetGL_client where etat = 1;';
			$result = $_SESSION["link"]->query($sql);
			if ($result->num_rows == 0){
				return null;
			}
			else {
				$i = 0;
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					$retVal[$i]= new Client($row["id"], $row["nom"], $row["adresse"]);
					$i++;
				}
				return $retVal;
			}
		}
		else {
			return null;
		}
	}
    
    // test si le client exite et est actif
    function isActiveClient($id) {
		if (isConnectMySql()) {
			$sql = 'select nom from projetGL_client where etat = 1 and id = ' . sanitize_string($id) . ';';
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
	
	// requete sur les clients
	function requeteClient($nom, $adresse, $projet) {
		if (isConnectMySql()) {
			$sql = 'select c.id, c.nom, c.adresse from projetGL_client c left join projetGL_projet p  on c.id = p.client where c.nom like \'%' . sanitize_string($nom) . '%\' and c.adresse like \'%' . sanitize_string($adresse) . '%\'';
			if ($projet != -1) {
				$sql .= ' and p.id = ' . sanitize_string($projet);
			}
			$sql .= ';';
			$result = $_SESSION["link"]->query($sql);
			if ($result->num_rows == 0) {
				return null;
			}
			else {
				$i = 0;
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					$retVal[$i] = new Client($row["id"], $row["nom"], $row["adresse"]);
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