<?php
session_start();

        echo "<script>
                confirm('apakah anda yakin akan logout?');
                </script>";
        session_unset();
        session_destroy();
        header("Location: login.php");
?>