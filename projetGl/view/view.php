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
					require_once($path . "html/contact.php");
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
					$personneAccount = getPersonneById($_SESSION["user"]->getId());
					require_once($path . "html/account.php");
					break;
				case $CURSOR_clientEditView:
					/*
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
					*/
					require_once($path . "html/client_edit.php");
					break;
				case $CURSOR_research:
					require_once($path . "html/search.php");
					break;
				case $CURSOR_contactEditView:
					require_once($path . "html/contact_edit.php");
					break;
				// use as default page
				default:
					$personneAccount = getPersonneById($_SESSION["user"]->getId());
					require_once($path . "html/account.php");
			}
		}
		else {
			require_once($path . "html/login.php");
		}
		
		/*
		// TO DO
		// demande d'authentification
		
		// authentification du compte
		$user = new User('truffrose@gmail.com', '123');
		if ($user->login()) {
			echo 'log </br>';
		}
		else {
			echo 'no log </br>';
		}
		// affiche les variables de session utilisateur
		print_r($_SESSION["user"]);
		
		// try to get list of role
		$res = getRoleIdNameByIdUser($_SESSION["user"]->getId());
		print_r($res);
		
		
		// deconnexion
		$_SESSION["user"]->logout();
		
		// createCollaborateur($nom, $prenom, $adresse, $telephone, $mail)
		createAccount('try', 'try', 'try', 'try', 'try', 2);
		
		print_r(getListActiveUser());
	
		*/
?>
