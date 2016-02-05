<?php

    require_once("./../controller/settings.php");

    if (connectMySql()) {
        $sql = 'delete from code where ;';
        $sql = 'DELETE FROM code where md5(pseudo) = "' . $_SESSION["link"]->real_escape_string($_POST["userCode"]) . '" AND name = "' . $_SESSION["link"]->real_escape_string($_POST["nameCode"]) . '" ;';
        $_SESSION["link"]->query($sql);
    }
    else {
        setCurrentError(new Error("Connection", "We are not connect to the DB"));
        return false;
    }

?>
