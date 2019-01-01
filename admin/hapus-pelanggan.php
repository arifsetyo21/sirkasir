<?php 

include '../functions.php';
if (isset($_GET)) {

   $id_pelanggan = $_GET['id_pelanggan'];

   $query = "DELETE FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'";
   mysqli_query($conn, $query);

   if (mysqli_affected_rows($conn) > 0){
      echo "<script>
          alert('Data berhasil di hapus');
          window.location.assign('pelanggan.php');
      </script>";
  } else {
    echo "<script>
          alert('Data gagal di hapus');
          window.location.assign('pelanggan.php');
      </script>";
  };
}
?>