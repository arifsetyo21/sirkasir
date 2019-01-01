<?php 

include '../konek.php';
if (isset($_GET)) {

   $id_user = $_GET['id_user'];

   $query = "DELETE FROM user WHERE id_user = '$id_user'";
   mysqli_query($dbkonek, $query);

   if (mysqli_affected_rows($dbkonek) > 0){
      echo "<script>
          alert('Data berhasil di hapus');
          window.location.assign('pengguna.php');
      </script>";
  };
}
?>