<?php

	// Class 
	class Tache {
        
        private $_id;
        private $_nom;
        private $_description;
        private $_dateDebut;
        private $_dateFinTot;
        private $_dateFinTard;
        private $_charge;
        private $_avancement;
        private $_tempsPasse;
        private $_tempsRestant;
        private $_niveau;
        private $_tacheMere;
		private $_predecesseur;
        private $_projet;
        private $_responsable;
        private $_contact;
        
        // manager of the constructor
		public function __construct() {
			$ctp = func_num_args();
			$args = func_get_args();
			switch($ctp) {
				case 1:
					$this->constructor1Args($args[0]);
					break;
				 default:
					break;
			}
		}
        
        // contructeur via l'id d'une tache
        private function constructor1Args($id) {
			if (isConnectMySql()) {
				$sql = 'select nom, description, dateDebut, dateFinTot, dateFinTard, charge, avancement, tempsPasse, tempsRestant, niveau, tacheMere, predecesseur, projet, responsable, contact from projetGL_tache where id = ' . sanitize_string($id) . ';';
				$result = $_SESSION["link"]->query($sql);
				if ($result->num_rows != 0){
					$row = $result->fetch_array(MYSQLI_ASSOC);
					$this->_id = $id;
					$this->_nom = $row["nom"];
					$this->_prenom = $row["prenom"];
					$this->_mail = $row["mail"];
					$this->_telephone = $row["telephone"];
					$this->_adresse = $row["adresse"];
					
private $_id;
        private $_nom;
        private $_description;
        private $_dateDebut;
        private $_dateFinTot;
        private $_dateFinTard;
        private $_charge;
        private $_avancement;
        private $_tempsPasse;
        private $_tempsRestant;
        private $_niveau;
        private $_tacheMere;
		private $_predecesseur;
        private $_projet;
        private $_responsable;
        private $_contact;private $_id;
        private $_nom;
        private $_description;
        private $_dateDebut;
        private $_dateFinTot;
        private $_dateFinTard;
        private $_charge;
        private $_avancement;
        private $_tempsPasse;
        private $_tempsRestant;
        private $_niveau;
        private $_tacheMere;
		private $_predecesseur;
        private $_projet;
        private $_responsable;
        private $_contact;
				}
			}
		}
        
    }

?>