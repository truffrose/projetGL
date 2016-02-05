<?php

    // nedd the settings to connect to the mysql account
    require_once("./../controller/settings.php");

    // // use to save the content on the server
    if (isset($_POST["contentCode"])) {
        if (connectMySql()) {
				$sql = 'SELECT pseudo, name FROM code WHERE md5(pseudo) = "' . $_POST["userCode"] . '" AND name = "' . $_SESSION["link"]->real_escape_string($_POST["nameCode"]) . '";';
				$source = $_SESSION["link"]->query($sql);
				if ($result = $source->fetch_assoc()) {
                    $sql = 'update code set content = "' . $_SESSION["link"]->real_escape_string($_POST["contentCode"]) . '" where md5(pseudo) = "' . $_POST["userCode"] . '" and name = "' . $_SESSION["link"]->real_escape_string($_POST["nameCode"]) . '";';
				}
			    else {
                    $sql = 'INSERT INTO code (pseudo, name, content) VALUES ((select u.pseudo from user u where md5(u.pseudo) = "' . $_POST["userCode"] . '"), "' . $_SESSION["link"]->real_escape_string($_POST["nameCode"]) . '", "' . $_SESSION["link"]->real_escape_string($_POST["contentCode"]) . '");';
                    // if no name we load the default name
                    if ($_POST["nameCode"] == "undefined") {
                        $sql = 'select count(name)from code where name like "undefined%";';
                        $_SESSION["link"]->query($sql);
                        if ($_SESSION["link"]->multi_query($sql)) {
                            // get the first result
                            if ($result = $_SESSION["link"]->use_result()) {
                                $sql = 'INSERT INTO code (pseudo, name, content) VALUES ((select u.pseudo from user u where md5(u.pseudo) = "' . $_POST["userCode"] . '"), "undefined' . $result->fetch_row()[0] . '", "' . $_SESSION["link"]->real_escape_string($_POST["contentCode"]) . '");';
                                $result->close();
                            }
                        }
                    }
			    }
                $_SESSION["link"]->query($sql);
        }
        else {
            setCurrentError(new Error("Connection", "We are not connect to the DB"));
            return false;
        }
    }
    else {
        setCurrentError(new Error("Synchronise", "Can't connec to the server to synchronise the code"));
    }

?>
