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
				$user = new User("truffrose@gmail.com", "123");
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
			case $ACTION_clientView:
				if (isset($_GET["client"])) {
					$_SESSION["client"] = $_GET["client"];
				}
				break;
			default:
				// TO DO: default action (nothing to do)
		}
		
		// supprime l'action car elle a ete effectué
		deleteAction();
		
 ?>