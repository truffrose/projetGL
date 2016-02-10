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
