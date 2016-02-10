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
					/*
						$idClient = $_SESSION["client"];
					*/
					$idClient = 1;
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
				// use as default page
				default:
					$idClient = 1;
					$idContact = 1;
					$selectClient = new Client($idClient);
					$listeContact = $selectClient->getContact();
					require_once($path . "html/contact.php");
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
