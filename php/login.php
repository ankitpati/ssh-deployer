<?php

    if (!isset($_REQUEST["username"])) die();

    $con = new PDO("mysql:host=localhost;dbname=sshdeployer", "sshdeployer", "sshdeployer");

    if (!isset($_REQUEST["password"])) {
        $ps = $con->prepare("select 1 from users where username = ?");
        $ps->execute(array($_REQUEST["username"]));

        echo $ps->fetchColumn() ? 1 : 0;
    }

    if (isset($_REQUEST["login"])) {
        if ($_REQUEST["login"] === "true") {
            $ps = $con->prepare("select password from users where username = ?");
            $ps->execute(array($_REQUEST["username"]));

            if (password_verify($_REQUEST["password"], $ps->fetchColumn())) {
                setcookie("username", $_REQUEST["username"], time() + 60*60*24*30, "/");
                setcookie("password", $_REQUEST["password"], time() + 60*60*24*30, "/");
                header("Location: ../index.html?status=correct");
            }
            else {
                setcookie("username", "", 1, "/");
                setcookie("password", "", 1, "/");
                header("Location: ../index.html?status=incorrect");
            }
        }
        else {
            $ps = $con->prepare("insert into users values (?, ?)");
            header(
                "Location: ../index.html?status=".
                ($ps->execute(array($_REQUEST["username"], password_hash($_REQUEST["password"], PASSWORD_DEFAULT))) ? "created" : "exists")
            );
        }
    }

    $ps = null;
    $con = null;

?>
