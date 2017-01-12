<?php

    if ($_SERVER["REMOTE_ADDR"] !== "127.0.0.1" && $_SERVER["REMOTE_ADDR"] !== "::1") die();

    if (!isset($_COOKIE["username"]) || !isset($_COOKIE["password"]) || !isset($_FILES["upload"])) die();

    $con = new PDO("mysql:host=localhost;dbname=sshdeployer", "sshdeployer", "sshdeployer");

    $ps = $con->prepare("select password from users where username = ?");
    $ps->execute(array($_COOKIE["username"]));

    function delete_dir($path) {
        return is_file($path) ?
                @unlink($path) :
                array_map(__FUNCTION__, glob($path.'/*')) == @rmdir($path);
    }

    if (password_verify($_COOKIE["password"], $ps->fetchColumn())) {
        $dirpath = "../apps/".$_COOKIE["username"]."/".pathinfo($_FILES["upload"]["name"])["filename"];
        if (file_exists($dirpath)) delete_dir($dirpath);
        mkdir($dirpath, 0777, true);
        $file = new ZipArchive;
        if ($file->open($_FILES["upload"]["tmp_name"]) === true) {
            $file->extractTo($dirpath."/");
            $file->close();
            header("Location: ../workspace.html?status=pass");
        }
        else
            header("Location: ../workspace.html?status=fail");
    }
    else {
        setcookie("username", "", 1, "/");
        setcookie("password", "", 1, "/");
        header("Location: ../index.html?status=incorrect");
    }

    $ps = null;
    $con = null;

?>
