<?php

	// import the error class (use to manage the error on the website)
	// require_once('./error.php');

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

	// getting the action
	function getCurrentAction() {
		if (isAction()) {
			return $_SESSION["action"];
		}
		else {
			return null;
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
		unset($_SESSION["action"]);
	}

	// refresh the page with out action or error
	function refresh() {
		deleteAction();
		header("Location: ./index.php");
	}

?>
