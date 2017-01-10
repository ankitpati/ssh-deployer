<?php

    if (!isset($_REQUEST["username"])) die();

    $con = new PDO("mysql:host=localhost;dbname=tasktracker", "tasktracker", "tasktracker");

    $ps = $con->prepare("select 1 from users where username = ?");
    $ps->execute(array($_REQUEST["username"]));

    echo $ps->fetchColumn() ? 1 : 0;

    $ps = null;
    $con = null;

?>
