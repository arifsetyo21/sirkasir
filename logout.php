<?php
session_start();

if ($_SESSION["user"] == "admin") {
        $page = "Location: index.php";
} else {
        $page = "Location: index.php";
}
        session_unset();
        session_destroy();
        
        header($page);
?>