<?php

	// import the error class (use to manage the error on the website)
	// require_once('./error.php');

	// gestion des actions au sein du site internet
		// put the action in the session to be able to access the data
		if (isset($_POST["action"])) {
			$_SESSION["action"] = $_POST["action"];
		}
		if (isset($_GET["action"])) {
			$_SESSION["action"] = $_GET["action"];
		}
	
		// the list of the possible action
		$ACTION_none = 0;
		$ACTION_logIn = 1;
		$ACTION_logOut = 2;
		$ACTION_contactView = 3;
		$ACTION_contactCreate = 4;
		$ACTION_contactSave = 5;
		$ACTION_contactDelete = 6;
		$ACTION_changeRole = 7;
		$ACTION_collaboView = 8;
		$ACTION_collaboDelete = 9;
		$ACTION_collaboSave = 10;
		$ACTION_collaboNew = 11;
		$ACTION_accountSave = 12;
		$ACTION_showResult = 13;
		$ACTION_projetView = 14;
		$ACTION_clientView = 15;
		$ACTION_clientSave = 16;
		$ACTION_clientDelete = 17;
		$ACTION_tacheView = 18;
		$ACTION_tacheDelete = 19;
		$ACTION_tacheCreate = 20;
		$ACTION_tacheSave = 21;
		$ACTION_projetDelete = 22;
		$ACTION_projetSave = 23;
		$ACTION_projetCreate = 24;
		$ACTION_clientCreate = 25;
		
	
		// getting the action
		function getCurrentAction() {
			if (isAction()) {
				return $_SESSION["action"];
			}
			else {
				return -1;
			}
		}
	
		// return true or false if we have an action
		function isAction() {
			if (isset($_SESSION["action"])) {
				return true;
			}
			else {
				return false;
			}
		}
	
		// erase the common action
		function deleteAction() {
			if (isset($_SESSION["action"]))
				unset($_SESSION["action"]);
		}
	
	// gestion de la navigation au sein du site internet
		// met les parametre de navigation dans la variables session
		if (isset($_POST["cursor"])) {
			$_SESSION["cursor"] = $_POST["cursor"];
		}
		if (isset($_GET["cursor"])) {
			$_SESSION["cursor"] = $_GET["cursor"];
		}

		// la liste de navigation possible
		$CURSOR_home = 0;
		$CURSOR_contactView = 1;
		$CURSOR_contactDelete = 2;
		$CURSOR_clientView = 3;
		$CURSOR_clientEditView = 4;
		$CURSOR_contactEditView = 5;
		$CURSOR_research = 6;
		$CURSOR_tableau = 7;
		$CURSOR_collabo = 8;
		$CURSOR_collaboEditView = 9;
		$CURSOR_collaboDelete = 10;
		$CURSOR_projetView = 11;
		$CURSOR_projetEdit = 12;
		$CURSOR_compteView = 13;
		$CURSOR_tacheView = 14;
		$CURSOR_tacheEdit = 15;
		$CURSOR_actu = 16;
		
		// grecupere le curseur courant
		function getCurrentCursor() {
			if (isCursor()) {
				return $_SESSION["cursor"];
			}
			else {
				return -1;
			}
		}
	
		// returne vrai ou faux si on a une position
		function isCursor() {
			if (isset($_SESSION["cursor"])) {
				return true;
			}
			else {
				return false;
			}
		}
	
		// supprime la position courant
		function deleteCursor() {
			unset($_SESSION["cursor"]);
		}
		
	// refresh the page with out action or error
	function refresh() {
		deleteAction();
		header("Location: ./index.php");
	}

?>
