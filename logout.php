<?php
session_start();

if ($_SESSION["user"] == "pembeli") {
        $page = "Location: login-pembeli.php";
} else {
        $page = "Location: login.php";
}
        session_unset();
        session_destroy();
        header($page);
?>