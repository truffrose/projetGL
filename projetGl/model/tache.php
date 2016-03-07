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
		public function setTempsPasse($temp) {
			$this->_tempsPasse = $temp;
		}
		public function setTempsRestant($temp) {
			$this->_tempsRestant = $temp;
		}
		public function setAvacnement($avanc) {
			$this->_avancement = $avanc;
		}
		
        // manager of the constructor
		public function __construct() {
			$ctp = func_num_args();
			$args = func_get_args();
			switch($ctp) {
				case 12:
					$this->constructor12Args($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7], $args[8], $args[9], $args[10], $args[11]);
					break;
				case 10:
					$this->constructor10Args($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7], $args[8], $args[9]);
					break;
				case 4:
					$this->constructor4Args($args[0],$args[1],$args[2],$args[3]);
					break;
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
		private function constructor4Args($id, $tempPasse, $tempRestant, $avancement) {
			$this->constructor1Args($id);
			$this->_tempsPasse = $tempPasse;
			$this->_tempsRestant = $tempRestant;
			$this->_avancement = $avancement;
		}
		
		private function constructor12Args($id, $nom, $description, $responsable, $contact, $predecesseur, $tacheMere, $dateFinTot, $dateFinTard, $tempPasse, $tempRestant, $avancement) {
			$this->constructor1Args($id);
			$this->_nom = $nom;
			$this->_description = $description;
			$this->_responsable = new Personne($responsable);
			$this->_contact = new Personne($contact);
			$this->_predecesseur = $predecesseur;
			$this->_tacheMere = $tacheMere;
			$this->_dateFinTot = $dateFinTot;
			$this->_dateFinTard = $dateFinTard;
			$this->_tempsPasse = $tempPasse;
			$this->_tempsRestant = $tempRestant;
			$this->_avancement = $avancement;
		}
		private function constructor10Args($nom, $description, $responsable, $contact, $predecesseur, $tacheMere, $dateFinTot, $dateFinTard, $tempRestant, $projet) {
			$this->_id = -1;
			$this->_nom = $nom;
			$this->_description = $description;
			$this->_responsable = new Personne($responsable);
			$this->_contact = new Personne($contact);
			$this->_predecesseur = $predecesseur;
			$this->_tacheMere = $tacheMere;
			$this->_dateFinTot = $dateFinTot;
			$this->_dateFinTard = $dateFinTard;
			$this->_tempsPasse = 0;
			$this->_tempsRestant = $tempRestant;
			$this->_avancement = 0;
			$this->_charge = $tempRestant;
			$this->_projet = new Projet($projet);
		}
		
		
		// met a jour la tache en la synchronisant avec la base de donnée
		public function save() {
			if (isConnectMySql()) {
				$lvl = 0;
				$tm = "null";
				$pred = "null";
				if ($this->_tacheMere != null) {
					$lvl = $this->_tacheMere->getNiveau() + 1;
					$tm = $this->_tacheMere->getId();
				}
				if ($this->_predecesseur != null) {
					$pred = $this->_predecesseur->getId();
				}
				$sql = 'update projetGL_tache t set t.nom = "' .  sanitize_string($this->_nom) . '", t.description = "' .  sanitize_string($this->_description) . '", t.dateFinTot = "' .  sanitize_string($this->_dateFinTot) . '", t.dateFinTard = "' .  sanitize_string($this->_dateFinTard) . '", t.avancement = ' .  sanitize_string($this->_avancement) . ', t.tempsPasse = ' .  sanitize_string($this->_tempsPasse) . ', t.tempsRestant = ' .  sanitize_string($this->_tempsRestant) . ', t.niveau = ' .  $lvl . ', t.tacheMere = ' .  sanitize_string($tm) . ', t.predecesseur = ' .  sanitize_string($pred) . ', t.responsable = ' .  sanitize_string($this->_responsable->getId()) . ', t.contact = ' .  sanitize_string($this->_contact->getId()) . ' where id = ' . sanitize_string($this->_id) . ';';
				return $_SESSION["link"]->query($sql);
			}
			else {
				return false;
			}
		}
		
		// créer une nouvelle tache dans la base de donnée et retourne l'id de la tache
		public function create() {
			if (isConnectMySql()) {
				$sql = 'INSERT INTO projetGL_tache(nom, description, dateDebut, dateFinTot, dateFinTard, charge, avancement, tempsPasse, tempsRestant, detruitALaCompletion, niveau, tacheMere, predecesseur, projet, responsable, contact, etat)';
				$lvl = 0;
				$tm = "null";
				$pred = "null";
				if ($this->_tacheMere != null) {
					$lvl = $this->_tacheMere->getNiveau() + 1;
					$tm = $this->_tacheMere->getId();
				}
				if ($this->_predecesseur != null) {
					$pred = $this->_predecesseur->getId();
				}
				$sql .= 'VALUES("' . sanitize_string($this->_nom) . '", "' .  sanitize_string($this->_description) . '", now(), "' .  sanitize_string($this->_dateFinTot) . '", "' .  sanitize_string($this->_dateFinTard) . '", ' . sanitize_string($this->_charge) . ', 0, ' .  sanitize_string($this->_tempsPasse) . ', ' .  sanitize_string($this->_tempsRestant) . ', true, ' . $lvl . ', ' . sanitize_string($tm) . ', ' .  sanitize_string($pred) . ', ' .  sanitize_string($this->_projet->getId()) . ', ' .  sanitize_string($this->_responsable->getId()) . ', ' .  sanitize_string($this->_contact->getId()) . ', 1);';
				if ($_SESSION["link"]->query($sql) == true)
					return $_SESSION["link"]->insert_id;
				else
					return -1;
			}
			else {
				return -1;
			}
		}
		
		// supprime artificiellement la tache en passant l'état à 2
		public function delete() {
			if (isConnectMySql()) {
				$sqlTache = 'update projetGL_tache set etat = 2 where id = ' . sanitize_string($this->_id) . ';';
				return $_SESSION["link"]->query($sqlTache);
			}
			else {
				return false;
			}
		}
		
        
    }

?>