<?php 

include '../konek.php';
if (isset($_GET)) {

   $id_tanah = $_GET['id_tanah'];

   $query = "DELETE FROM tanah WHERE id_tanah = '$id_tanah'";
   mysqli_query($dbkonek, $query);

   if (mysqli_affected_rows($dbkonek) > 0){
      echo "<script>
          alert('Data berhasil di hapus');
          window.location.assign('tanah.php');
      </script>";
  };
}
?>