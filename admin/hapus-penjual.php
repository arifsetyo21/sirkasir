<?php 

include '../functions.php';
if (isset($_GET)) {

   $id_penjual = $_GET['id_penjual'];

   $query = "DELETE FROM penjual WHERE id_penjual = '$id_penjual'";
   mysqli_query($conn, $query);

   if (mysqli_affected_rows($conn) > 0){
      echo "<script>
          alert('Data berhasil di hapus');
          window.location.assign('penjual.php');
      </script>";
  } else {
    echo "<script>
          alert('Data gagal di hapus');
          window.location.assign('penjual.php');
      </script>";
  };
}
?>