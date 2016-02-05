<?php

	// show the error -> delete after devellopement	
	error_reporting(E_ALL | E_STRICT);
	ini_set('display_errors', true);
	
	// not use the magic_quote
	if (get_magic_quotes_gpc()) {
		$process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
		while (list($key, $val) = each($process)) {
			foreach ($val as $k => $v) {
				unset($process[$key][$k]);
				if (is_array($v)) {
					$process[$key][stripslashes($k)] = $v;
					$process[] = &$process[$key][stripslashes($k)];
				}
				else {
					$process[$key][stripslashes($k)] = stripslashes($v);
				}
			}
		}
		unset($process);
	}

	// setting of the Data Base
	$host = 'localhost';
	$login = 'glUser';
	$passwd = '123';
	$dbname = 'projetGL';
	
?>
