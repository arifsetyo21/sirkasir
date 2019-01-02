<?php 

include '../functions.php';
if (isset($_GET)) {

   $id_pesanan = $_GET['id_pesanan'];

   $query = "DELETE FROM pesanan WHERE id_pesanan = '$id_pesanan'";
   mysqli_query($conn, $query);

   if (mysqli_affected_rows($conn) > 0){
      echo "<script>
          alert('Data berhasil di hapus');
          window.location.assign('riwayat-pesanan.php');
      </script>";
  } else {
    echo "<script>
          alert('Data gagal di hapus');
          window.location.assign('riwayat-pesanan.php');
      </script>";
  };
}
?>