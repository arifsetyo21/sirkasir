<?php 

include '../konek.php';
if (isset($_GET)) {

   $id_hujan = $_GET['id_hujan'];

   $query = "DELETE FROM curah_hujan WHERE id_hujan = '$id_hujan'";
   mysqli_query($dbkonek, $query);

   if (mysqli_affected_rows($dbkonek) > 0){
      echo "<script>
          alert('Data berhasil di hapus');
          window.location.assign('curah.php');
      </script>";
  };
}
?>