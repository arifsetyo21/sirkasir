<?php 

include '../konek.php';
if (isset($_GET)) {

   $id_suhu = $_GET['id_suhu'];

   $query = "DELETE FROM suhu WHERE id_suhu = '$id_suhu'";
   mysqli_query($dbkonek, $query);

   if (mysqli_affected_rows($dbkonek) > 0){
      echo "<script>
          alert('Data berhasil di hapus');
          window.location.assign('suhu.php');
      </script>";
  };
}
?>