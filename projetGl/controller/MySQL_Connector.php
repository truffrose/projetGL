<?php
	
	$link = new mysqli($host, $login, $passwd, $dbname);
	/* Vérification de la connexion */
	if (mysqli_connect_errno()) {
		printf('Error MySQL');
		// with error manager
	    // setCurrentError(new Error("Connection MySQL", mysql_error()));
		exit();
	}
	else  {
		$_SESSION["link"] = $link;
	}
	if (!$link->set_charset("utf8")) {
		echo 'Error Load UTF8';
	}

	// return true or false if the system is connect to the DB
	function isConnectMySql() {
		return isset($_SESSION["link"]);
	}
	
	// only with php 5 or higher
	function sanitize_string($str) {
		if (isConnectMySql()) {		
			if (get_magic_quotes_gpc()) {
				$sanitize = mysqli_real_escape_string($_SESSION["link"], stripslashes($str));	 
			} else {
				$sanitize = mysqli_real_escape_string($_SESSION["link"], $str);	
			} 
			return $sanitize;
		}
	}
	
?>
