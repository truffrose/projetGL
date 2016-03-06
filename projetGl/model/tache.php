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
		private $_uniteTemps;
		private $_fille;
		private $_nbFille;
        
		// les getters
		public function getId() {
			return $this->_id;
		}
		public function getNom() {
			return $this->_nom;
		}
		public function getNiveau() {
			return $this->_niveau;
		}
		public function getDescription() {
			return $this->_description;
		}
		public function getDateDebut() {
			return $this->_dateDebut;
		}
		public function getDateFinTot() {
			return $this->_dateFinTot;
		}
		public function getDateFinTard() {
			return $this->_dateFinTard;
		}
		public function getAvancement() {
			return $this->_avancement;
		}
		public function getTempsPasse() {
			return $this->_tempsPasse;
		}
		public function getTempsRestant() {
			return $this->_tempsRestant;
		}
		public function getTacheMere() {
			return $this->_tacheMere;
		}
		public function getPredecesseur() {
			return $this->_predecesseur;
		}
		public function getProjet() {
			return $this->_projet;
		}
		public function getResponsable() {
			return $this->_responsable;
		}
		public function getContact() {
			return $this->_contact;
		}
		public function getUniteTemps() {
			return $this->_uniteTemps;
		}
		public function getFille() {
			return $this->_fille;
		}
		public function addFille($el) {
			$this->_fille[$this->_nbFille] = $el;
			$this->_nbFille ++;
		}
		public function setFille($fille) {
			$this->_fille = $fille;
		}
		
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
				$sql = 'select u.typeUnite, t.nom, t.description, t.dateDebut, t.dateFinTot, t.dateFinTard, t.charge, t.avancement, t.tempsPasse, t.tempsRestant, t.niveau, t.tacheMere, t.predecesseur, t.projet, t.responsable, t.contact from projetGL_tache t join projetGL_projet p on t.projet = p.id join projetGL_uniteTemps u on u.id = p.uniteTemps where t.id = ' . sanitize_string($id) . ';';
				$result = $_SESSION["link"]->query($sql);
				if ($result->num_rows != 0){
					$row = $result->fetch_array(MYSQLI_ASSOC);
					$this->_id = $id;
					$this->_nom = $row["nom"];
					$this->_description = $row["description"];
					$this->_dateDebut = $row["dateDebut"];
					$this->_dateFinTot = $row["dateFinTot"];
					$this->_dateFinTard = $row["dateFinTard"];
					$this->_charge = $row["charge"];
					$this->_avancement = $row["avancement"];
					$this->_tempsPasse = $row["tempsPasse"];
					$this->_tempsRestant = $row["tempsRestant"];
					$this->_niveau = $row["niveau"];
					if ($row["tacheMere"] != null){
						$this->_tacheMere = new Tache($row["tacheMere"]);
					}
					else {
						$this->_tacheMere = null;
					}
					if ($row["predecesseur"] != null){
						$this->_predecesseur = new Tache($row["predecesseur"]);
					}
					else {
						$this->_predecesseur = null;
					}
					$this->_projet = new Projet($row["projet"]);
					$this->_responsable = new Personne($row["responsable"]);
					$this->_contact = new Personne($row["contact"]);
					$this->_uniteTemps = $row["typeUnite"];
					$this->_fille = null;
				 	$this->_nbFille = 0;
				}
			}
		}
        
    }

?>