 <?php
				
		// start the session
		if (!isset($_SESSION))
			session_start();
		// only for ie
		// header('P3P: CP="NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM"'); 
	
		require_once("./controller/configuration.php");
		require_once("./controller/MySQL_Connector.php");
		require_once("./controller/settings.php");
		
		// effectue la bonne action selectiné par l'utilisateur
		switch(getCurrentAction()) {
			case $ACTION_logIn:
				// pour les test on utilise un compte deja existant
				$user = new User("a.rousseau", "arousse");
				// $user = new User($_POST["login"], $_POST["password"]);
				if ($user->login()) {
					// TO DO: affiché une réussite
				}
				else {
					// TO DO: gestion des erreurs
				}
				break;
			case $ACTION_logOut:
				if (isConnectUser()) {
					$_SESSION["user"]->logout();
				}
				break;
			case $ACTION_contactView:
				if (isContactActif($_GET["contact"], $_SESSION["client"])) {
					$_SESSION["contact"] = $_GET["contact"];
				}
				break;
			case $ACTION_contactSave:
				if (majUserInformation($_SESSION["user"]->getId(), $_POST["password_field"], $_POST["adress_field"], $_POST["email_field"], $_POST["tel_field"])) {
					// TO DO: affiché une réussite
				}
				else {
					// TO DO: gestion des erreurs
				}
				break;
			case $ACTION_clientView:
				if (isset($_GET["client"])) {
					$_SESSION["client"] = $_GET["client"];
				}
				break;
			case $ACTION_changeRole:
				// besoin des faire des verif savoir si l'utilisateur a bien le droit de change de ce role
				if (isset($_GET["role"])) {
					$_SESSION["systemData"]->setUserRole($_GET["role"]);
				}
				break;
			default:
				// TO DO: default action (nothing to do)
		}
		
		// supprime l'action car elle a ete effectué
		deleteAction();
		
 ?>