<?php

    if (!isset($_REQUEST["username"])) die();

    $con = mysqli_connect("localhost", "tasktracker", "tasktracker", "tasktracker");

    $ps = mysqli_prepare($con, "select username from users where username = ?");
    mysqli_stmt_bind_param($ps, "s", $_REQUEST["username"]);
    mysqli_stmt_execute($ps);
    mysqli_stmt_bind_result($ps, $username);

    echo mysqli_stmt_fetch($ps) ? 1 : 0;

    mysqli_stmt_close($ps);
    mysqli_close($con);

?>
