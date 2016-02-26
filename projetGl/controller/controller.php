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
				if (isset($_GET["contact"]) && $_GET["contact"] != -1) {
					if (isContactActif($_GET["contact"], $_SESSION["client"])) {
						$_SESSION["contact"] = $_GET["contact"];
					}
				}
				elseif (isset($_GET["contact"]) && $_GET["contact"] == -1) {
					$_SESSION["contact"] = -1;
				}
				break;
			case $ACTION_collaboView:
				if (isset($_GET["collabo"]) && $_GET["collabo"] != -1) {
					$_SESSION["collabo"] = $_GET["collabo"];
				}
				elseif (isset($_GET["collabo"]) && $_GET["collabo"] == -1) {
					$_SESSION["collabo"] = -1;
				}
				break;
			case $ACTION_collaboSave:
				// recupere les valeur des checkbox
				$collabo = false;
				if (isset($_POST["collabo_permission_check_collabo"]) && $_POST["collabo_permission_check_collabo"] == "check") {
					$collabo = true;
				}
				$respo = false;
				if (isset($_POST["collabo_permission_check_respo"]) && $_POST["collabo_permission_check_respo"] == "check") {
					$respo = true;
				}
				$admin = false;
				if (isset($_POST["collabo_permission_check_admin"]) && $_POST["collabo_permission_check_admin"] == "check") {
					$admin = true;
				}
				// besoin de faire les modifs de gestion des droits
				if (isset($_POST["collabo"]) && $_POST["collabo"] != -1) {
					$_SESSION["collabo"] = $_POST["collabo"];
					if ($_POST["collabo_password_field"] == "*****") {
						saveCollabo($_POST["collabo"], $_POST["collabo_name_field"],  $_POST["collabo_firstname_field"], $_POST["collabo_address_field"], $_POST["collabo_phone_field"], $_POST["collabo_email_field"]) ;
					}
					else {
						saveCollaboWithPassword($_POST["collabo"], $_POST["collabo_name_field"],  $_POST["collabo_firstname_field"], $_POST["collabo_password_field"], $_POST["collabo_address_field"], $_POST["collabo_phone_field"], $_POST["collabo_email_field"]) ;
					}
					if (synchroniseRole($_SESSION["collabo"], $collabo, $respo, $admin)) {
						// TO DO: affiché une réussite
					}
					else {
						// TO DO: gestion des erreurs
					}
				}
				
				break;
			case $ACTION_collaboDelete:
				if (isset($_GET["collabo"]) && $_GET["collabo"] != -1) {
					$_SESSION["collabo"] = -1;
					if (deleteCollabo($_GET["collabo"])) {
						// TO DO: affiché une réussite
					}
					else {
						// TO DO: gestion des erreurs
					}
				}
				break;
			case $ACTION_accountSave:
				$notif = "false";
				if (isset($_POST["checkbox_receive_notif"]) && $_POST["checkbox_receive_notif"] == "check") {
					$notif = "true";
				}
				$mail = "false";
				if (isset($_POST["checkbox_receive_mail"]) && $_POST["checkbox_receive_mail"] == "check") {
					$mail = "true";
				}
				if (majUserInformation($_SESSION["user"]->getId(), $_POST["password_field"], $mail, $notif, $_POST["select_default_user_type"], $_POST["adress_field"], $_POST["email_field"], $_POST["tel_field"])) {
					// mise a jour des données de l'utilisateur
					$_SESSION["user"]->getParameters()->getParameters();
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