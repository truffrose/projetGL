<?php

    // nedd the settings to connect to the mysql account
    require_once("./../controller/settings.php");

    // // use to save the content on the server
    if (isset($_POST["levelPass"]) && $_POST["levelPass"] != -1) {
        if (connectMySql()) {
				$sql = 'SELECT id_level, pseudo_user FROM levelCompleted WHERE id_level = ' . $_POST["levelPass"] . ' AND md5(pseudo_user) = "' . $_POST["userCode"] . '";';
				$source = $_SESSION["link"]->query($sql);
				if ($result = $source->fetch_assoc()) {
                    $sql = 'update levelCompleted set timeToSolve = ' . $_POST["timeUse"] . ', numberClick = ' . $_POST["nbClick"] . '  where md5(pseudo_user) = "' . $_POST["userCode"] . '";';
				}
			    else {
                    $sql = 'insert into levelCompleted(id_level, pseudo_user, timeToSolve, numberClick) values (' . $_POST["levelPass"] . ', (select pseudo from user where md5(pseudo) = ' . $_POST["userCode"] . '), ' . $_POST["timeUse"] . ', ' . $_POST["nbClick"] . ');';
			    }
                $_SESSION["link"]->query($sql);
        }
        else {
            setCurrentError(new Error("Connection", "We are not connect to the DB"));
            return false;
        }
    }
    else {
        setCurrentError(new Error("Synchronise", "Can't connect to the server to save the result"));
    }

?>
