<?php

    // nedd the settings to connect to the mysql account
    require_once("./../controller/settings.php");

    // // use to save the content on the server
    if (connectMySql()) {
        $sql = 'SELECT content FROM code where pseudo = (select u.pseudo from user u where md5(u.pseudo) = "' . $_SESSION["link"]->real_escape_string($_POST["userCode"]) . '") AND name = "' . $_SESSION["link"]->real_escape_string($_POST["nameCode"]) . '" ;';
        if ($result = $_SESSION["link"]->query($sql)) {
            if ($result->num_rows > 0) {
                // output data of each row
                if($row = $result->fetch_assoc()) {
                    echo $row["content"];
                }
                else {
                    echo 'null';
                }
            } else {
                echo 'null';
            }
        }
    }
    else {
        setCurrentError(new Error("Connection", "We are not connect to the DB"));
        return false;
    }

?>
