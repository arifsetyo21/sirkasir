<?php 

include '../functions.php';
if (isset($_GET)) {

   $id_makanan = $_GET['id_makanan'];

   $query = "DELETE FROM makanan WHERE id_makanan = '$id_makanan'";
   mysqli_query($conn, $query);

   if (mysqli_affected_rows($conn) > 0){
      echo "<script>
          alert('Data berhasil di hapus');
          window.location.assign('makanan.php');
      </script>";
  } else {
    echo "<script>
          alert('Data gagal di hapus');
          window.location.assign('makanan.php');
      </script>";
  };
}
?>