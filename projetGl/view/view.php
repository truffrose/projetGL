<?php

	// importation du skeleton
	// require_once("./view/skeleton/index.php");
	
	// test si on est connecter
		if (isConnectUser()) {
		
			// TO DO
			// on est connecter affiche correctement le site internet
			
		}
		else {
		
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
		}
		// createCollaborateur($nom, $prenom, $adresse, $telephone, $mail)
		createAccount('try', 'try', 'try', 'try', 'try', 2);
		
		
		
		print_r(getListActiveUser());
	
		
	
?>
