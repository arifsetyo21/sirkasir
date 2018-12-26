<?php

session_start();
require 'functions.php';

if ($_SESSION["login"]) {
      if (isset($_SESSION["user"]) && $_SESSION["user"] == "penjual") {
        
        if( antar($_GET) > 0) {
            
          echo "<script>
             alert('pesanan berhasil di konfirmasi');
             document.location.href = 'dashboard-penjual.php';
           </script>
           ";
        } else {
          echo "<script>
          alert('pesanan gagal di konfirmasi');
          document.location.href = 'dashboard-penjual.php';
        </script>
        ";
        }
    
      } else {
        header("Location: login.php");
      }
    
    } else {
      header("Location: login.php");
    }

?>