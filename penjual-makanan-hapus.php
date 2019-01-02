<?php 
session_start();

require 'functions.php';
echo "<script>
        var x = confirm('Yakin untuk menghapus?');
        if (x == false) {
          document.location.href = 'penjual-makanan.php';
          ".header('Location: penjual-makanan.php')."
        }
      </script>
      ";
if ($_SESSION["login"]) {
  if (isset($_SESSION["user"]) && $_SESSION["user"] == "penjual") {
    $id_penjual = $_SESSION["id_penjual"];
    $result = mysqli_query($conn, "SELECT * FROM penjual WHERE id_penjual = '$id_penjual'");

    $penjual = mysqli_fetch_assoc($result);
    
    if( hapus($_GET) > 0) {
      echo "<script>
         alert('data berhasil dihapus');
         document.location.href = 'penjual-makanan.php';
       </script>
       ";
    } else {
      echo "<script>
      alert('data gagal dihapus');
      document.location.href = 'penjual-makanan.php';
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