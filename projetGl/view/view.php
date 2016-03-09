<?php

	// importation du skeleton
	// require_once("./view/skeleton/index.php");
	
	// le chemin d'acces au fiche html et css
	$path = "./view/skeleton/";
	
	// test si on est connecter
		if (isConnectUser()) {
			switch (getCurrentCursor()) {
				case $CURSOR_home:
					print_r($_SESSION);
					$_SESSION["user"]->logout();
					break;
				case $CURSOR_contactView:
					$idClient = $_SESSION["client"];
					if (isset($_SESSION["contact"])) {
						$idContact = $_SESSION["contact"];
					}
					else {
						$idContact = -1;
					}
					$selectClient = new Client($idClient);
					$listeContact = $selectClient->getContact();
					$selectContact = null;
					if ($listeContact != null)
						foreach ($listeContact as $value) {
							if ($idContact == $value->getPersonne()->getId()) {
								$selectContact = $value;
								break;
							}
						}
					if ($selectContact == null) {
						$selectContact = getContactById($idContact);
						$selectClient = new Client($selectContact->getClient());
					}
					require_once($path . "html/contact.php");
					break;
				case $CURSOR_contactEditView:
					$idClient = $_SESSION["client"];
					if (isset($_SESSION["contact"])) {
						$idContact = $_SESSION["contact"];
					}
					else {
						$idContact = -1;
					}
					$selectClient = new Client($idClient);
					$listeContact = $selectClient->getContact();
					$selectContact = null;
					if ($listeContact != null)
						foreach ($listeContact as $value) {
							if ($idContact == $value->getPersonne()->getId()) {
								$selectContact = $value;
								break;
							}
						}
					require_once($path . "html/contact_edit.php");
					break;
				case $CURSOR_contactDelete:
					$idClient = $_SESSION["client"];
					if (isset($_SESSION["contact"])) {
						$idContact = $_SESSION["contact"];
					}
					else {
						$idContact = -1;
					}
					$selectClient = new Client($idClient);
					$listeContact = $selectClient->getContact();
					$selectContact = null;
					foreach ($listeContact as $value) {
						if ($idContact == $value->getPersonne()->getId()) {
							$selectContact = $value;
							break;
						}
					}
					require_once($path . "html/contact_delete_admin.php");
					break;
				case $CURSOR_clientView:
					if (isset($_SESSION["client"])) {
						$idClient = $_SESSION["client"];
					}
					else {
						$idClient = -1;
					}
					$selectClient = new Client($idClient);
					$listeContact = $selectClient->getContact();
					$listeProjet = $selectClient->getProjet();
					$listeClient = getListActiveClient();
					require_once($path . "html/client.php");
					break;
				case $CURSOR_compteView:
					$personneAccount = new Personne($_SESSION["user"]->getId());
					require_once($path . "html/account.php");
					break;
				case $CURSOR_clientEditView:
					if (isset($_SESSION["client"])) {
						$idClient = $_SESSION["client"];
					}
					else {
						$idClient = -1;
					}
					$selectClient = new Client($idClient);
					$listeContact = $selectClient->getContact();
					$listeProjet = $selectClient->getProjet();
					$listeClient = getListActiveClient();
					require_once($path . "html/client_edit.php");
					break;
				case $CURSOR_research:
					require_once($path . "html/search.php");
					break;
				case $CURSOR_tableau:
					if ($_SESSION["systemData"]->getUserRole() == 4) {
						require_once($path . "html/tableau_collabo.php");
					}
					else {
						require_once($path . "html/tableau_respo.php");
					}
					break;
				case $CURSOR_collabo:
					if (isset($_SESSION["collabo"])) {
						$idCollabo = $_SESSION["collabo"];
					}
					else {
						$idCollabo = -1;
					}
					$listeCollabo = getCollaboList();
					require_once($path . "html/collabo.php");
					break;
				case $CURSOR_collaboEditView:
					if (isset($_SESSION["collabo"])) {
						$idCollabo = $_SESSION["collabo"];
					}
					else {
						$idCollabo = -1;
					}
					$listeCollabo = getCollaboList();
					require_once($path . "html/collabo_edit_admin.php");
					break;
				case $CURSOR_collaboDelete:
					if (isset($_SESSION["collabo"])) {
						$idCollabo = $_SESSION["collabo"];
					}
					else {
						$idCollabo = -1;
					}
					$listeCollabo = getCollaboList();
					require_once($path . "html/collabo_delete_admin.php");
					break;
				case $CURSOR_projetView:
					if (isset($_SESSION["projet"])) {
						$idProjet = $_SESSION["projet"];
					}
					else {
						$idProjet = -1;
					}
					$projectSelected = new Projet($idProjet);
					require_once($path . "html/projet.php");
					break;
				case $CURSOR_projetEdit:
					if (isset($_SESSION["projet"])) {
						$idProjet = $_SESSION["projet"];
					}
					else {
						$idProjet = -1;
					}
					$projectSelected = new Projet($idProjet);
					require_once($path . "html/projet_edit.php");
					break;
				case $CURSOR_tacheView:
					if (isset($_SESSION["tache"])) {
						$tacheId = $_SESSION["tache"];
					}
					else {
						$tacheId = -1;
					}
					$selectedTache = new Tache($tacheId);
					$_SESSION["client"] = $selectedTache->getProjet()->getClient()->getId();
					require_once($path . "html/task.php");
					break;
				case $CURSOR_tacheEdit:
					if (isset($_SESSION["tache"])) {
						$tacheId = $_SESSION["tache"];
					}
					else {
						$tacheId = -1;
					}
					$selectedTache = new Tache($tacheId);
					if ($tacheId == -1) {
						$_SESSION["projet"] = new Projet($_GET["projet"]);
					}
					else {
						$_SESSION["client"] = $selectedTache->getProjet()->getClient()->getId();
						$_SESSION["projet"] = $selectedTache->getProjet();
					}
					if ($_SESSION["systemData"]->getUserRole() == 4) {
						require_once($path . "html/task_edit_collabo.php");
					}
					else {
						require_once($path . "html/task_edit_respo.php");
					}
					break;
				// use as default page
				default:
					require_once($path . "html/actu.php");
			}
		}
		else {
			require_once($path . "html/login.php");
		}
?>
