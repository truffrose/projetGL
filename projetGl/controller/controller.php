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
			case $ACTION_contactSave:
				$contact = new Contact($_POST["contact_company_select"], new Personne($_POST["contact"], $_POST["contact_name_field"], $_POST["contact_firstname_field"], $_POST["contact_email_field"], $_POST["contact_tel_field"], $_POST["contact_address_field"]));
				$_SESSION["client"] = $_POST["contact_company_select"];
				if ($contact->save()) {
					$_SESSION["contact"] = $_POST["contact"];
					// TO DO: affiché une réussite
				}
				else {
					$_SESSION["contact"] = -1;
					// TO DO: gestion des erreurs
				}
				break;
			case $ACTION_contactCreate:
				$contact = new Contact($_POST["contact_company_select"], new Personne(-1, $_POST["contact_name_field"], $_POST["contact_firstname_field"], $_POST["contact_email_field"], $_POST["contact_tel_field"], $_POST["contact_address_field"]));
				$_SESSION["client"] = $_POST["contact_company_select"];
				$idContact = $contact->create();
				if ($idContact != 0) {
					$_SESSION["contact"] = $idContact;
					// TO DO: affiché une réussite
				}
				else {
					$_SESSION["contact"] = -1;
					// TO DO: gestion des erreurs
				}
				break;
			case $ACTION_contactDelete:
				for($i = 0; $i < $_POST["nbCahnge"]; $i ++) {
					changeContact($_POST['tacheId' . $i], $_POST['select_new_contact' . $i]);
				}
				$tempContact = new Contact(new Personne($_POST["deleteID"]));
				$tempContact->remove();
				if (isset($_POST["client"])) {
					$_SESSION["client"] = $_POST["client"];
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
			case $ACTION_collaboNew:
				// recupere les valeur des checkbox
				$collabo = false;
				$current = 0;
				if (isset($_POST["collabo_permission_check_collabo"]) && $_POST["collabo_permission_check_collabo"] == "check") {
					$collabo = true;
					$current = 4;
				}
				$respo = false;
				if (isset($_POST["collabo_permission_check_respo"]) && $_POST["collabo_permission_check_respo"] == "check") {
					$respo = true;
					$current = 3;
				}
				$admin = false;
				if (isset($_POST["collabo_permission_check_admin"]) && $_POST["collabo_permission_check_admin"] == "check") {
					$admin = true;
					$current = 2;
				}
				if ($current == 0) {
					$collabo = true;
					$current = 4;
				}
				// ($nom, $prenom, $adresse, $userPassword, $telephone, $mail, $firstRole)
				$collaboId = createAccount($_POST["collabo_name_field"], $_POST["collabo_firstname_field"], $_POST["collabo_address_field"], $_POST["collabo_phone_field"], $_POST["collabo_password_field"], $_POST["collabo_email_field"], $current);
				if ($collaboId > 0) {
						$_SESSION["collabo"] = $collaboId;
						if (synchroniseRole($collaboId, $collabo, $respo, $admin)) {
							// TO DO: affiché une réussite
						}
						else {
							// TO DO: gestion des erreurs
						}
					}
					else {
						// TO DO: gestion des erreurs
					}
				break;
			case $ACTION_collaboDelete:
				// commence par réalouer les
					// les projets
				for($i = 0; $i < $_POST["nbRespo"]; $i ++) {
					changeRespo($_POST['projetId' . $i], $_POST['select_new_respo' . $i]);
				}
					// les taches
				for($i = 0; $i < $_POST["nbCollabo"]; $i ++) {
					changeCollabo($_POST['tacheId' . $i], $_POST['select_new_collabo' . $i]);
				}
				if (isset($_POST["deleteID"]) && $_POST["deleteID"] != -1) {
					$_SESSION["collabo"] = -1;
					if (deleteCollabo($_POST["deleteID"])) {
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
			case $ACTION_clientSave:
				
				if (isset($_POST["client"])) {
					$_SESSION["client"] = $_POST["client"];
				}
				$tempClient = new Client($_POST["client"], $_POST["client_name_field"], $_POST["client_address_field"]);
				$tempClient->save();
				break;
			case $ACTION_clientDelete:
				$tempClient = new Client($_GET["client"]);
				$tempClient->delete();
				$_SESSION["client"] = -1;
				break;
			case $ACTION_changeRole:
				// besoin des faire des verif savoir si l'utilisateur a bien le droit de change de ce role
				if (isset($_GET["role"])) {
					$_SESSION["systemData"]->setUserRole($_GET["role"]);
				}
				break;
			case $ACTION_showResult:
				$listeResultat = null;
				if (isset($_POST["search_type_select"])) {
					if ($_POST["search_type_select"] == 0) {
						$listeResultat[0] = 0;
						$active = false;
						if (isset($_POST["checkbox_filter_state_ongoing"]) && $_POST["checkbox_filter_state_ongoing"] == "check") {
							$active = true;
						}
						$termine = false;
						if (isset($_POST["checkbox_filter_state_finished"]) && $_POST["checkbox_filter_state_finished"] == "check") {
							$termine = true;
						}
						$archive = false;
						if (isset($_POST["checkbox_filter_state_archived"]) && $_POST["checkbox_filter_state_archived"] == "check") {
							$archive = true;
						}
						$listeResultat[1] = requeteProjet($_POST["field_project_filter_name"], $_POST["project_filter_client_select"], $_POST["project_filter_respo_select"], $active, $termine, $archive);
					}
					elseif ($_POST["search_type_select"] == 1) {
						$listeResultat[0] = 1;
						$listeResultat[1] = requeteClient($_POST["field_client_filter_name"], $_POST["field_client_filter_address"], $_POST["client_filter_project_select"]);
					}
					elseif ($_POST["search_type_select"] == 2) {
						$listeResultat[0] = 2;
						$listeResultat[1] = requeteContact($_POST["field_contact_filter_name"], $_POST["field_contact_filter_firstname"], $_POST["field_contact_filter_tel"], $_POST["contact_filter_client_select"]);
					}
					elseif ($_POST["search_type_select"] == 3) {
						$listeResultat[0] = 3;
						$listeResultat[1] = requeteCollabo($_POST["field_collabo_filter_name"], $_POST["field_collabo_filter_firstname"], $_POST["field_collabo_filter_tel"], $_POST["collabo_filter_project_select"]);
					}
				}
				else {
					// TODO: Pas de recherche
				}
				$_SESSION["resultat"] = $listeResultat;
				break;
			case $ACTION_projetView:
				if (isset($_GET["projet"]) && $_GET["projet"] != -1) {
					$_SESSION["projet"] = $_GET["projet"];
				}
				elseif (isset($_GET["projet"]) && $_GET["projet"] == -1) {
					$_SESSION["projet"] = -1;
				}
				break;
			case $ACTION_projetDelete:
				if (isset($_GET["projet"]) && $_GET["projet"] != -1) {
					$tempProjet = new Projet($_GET["projet"]);
					$tempProjet->delete();
					$_SESSION["projet"] = -1;
				}
				elseif (isset($_GET["projet"]) && $_GET["projet"] == -1) {
					$_SESSION["projet"] = -1;
				}
				break;
			case $ACTION_projetCreate:
				$tempProjet = new Projet(0, $_POST["project_name"], $_POST["project_description"], new Client($_POST["select_project_client"]), new Personne($_POST["select_project_respo"]));
				$_SESSION["projet"] = $tempProjet->create();
				break;
			case $ACTION_projetSave:
				$tempProjet = new Projet($_POST["projet"], $_POST["project_name"], $_POST["project_description"], new Client($_POST["select_project_client"]), new Personne($_POST["select_project_respo"]));
				$tempProjet->save();
				$_SESSION["projet"] = $tempProjet->getId();
				break;
			case $ACTION_tacheView:
				if (isset($_GET["tache"]) && $_GET["tache"] != -1) {
					$_SESSION["tache"] = $_GET["tache"];
				}
				elseif (isset($_GET["tache"]) && $_GET["tache"] == -1) {
					$_SESSION["tache"] = -1;
				}
				break;
			case $ACTION_tacheDelete:
				if (isset($_GET["tache"]) && $_GET["tache"] != -1) {
					$tacheTemp = new Tache($_GET["tache"]);
					$tacheTemp->delete();
				}
				break;
			case $ACTION_tacheSave:
				if ($_SESSION["systemData"]->getUserRole() == 4) {
					$tempTache = new Tache($_POST["tache"], $_POST["time_spend_value"], $_POST["time_remain_value"], $_POST["progress"]);
					$tempTache->save();
				}
				else {
					// $tempTache = new Tache($_POST["tache"], $_POST["time_spend_value"], $_POST["time_remain_value"], $_POST["progress"]);
					// $tempTache->save();
					// require_once($path . "html/task_edit_respo.php");
				}
				break;
			default:
				// TO DO: default action (nothing to do)
		}
		
		// supprime l'action car elle a ete effectué
		deleteAction();
		
 ?>