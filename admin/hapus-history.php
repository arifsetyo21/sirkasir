<?php 

include '../konek.php';
if (isset($_GET)) {

   $id_history = $_GET['id_history'];

   $query = "DELETE FROM history WHERE id_history = '$id_history'";
   mysqli_query($dbkonek, $query);

   if (mysqli_affected_rows($dbkonek) > 0){
      echo "<script>
          alert('Data berhasil di hapus');
          window.location.assign('history.php');
      </script>";
  };
}
?>