<?php 

include '../konek.php';
if (isset($_GET)) {

   $id_ketinggian = $_GET['id_ketinggian'];

   $query = "DELETE FROM ketinggian WHERE id_ketinggian = '$id_ketinggian'";
   mysqli_query($dbkonek, $query);

   if (mysqli_affected_rows($dbkonek) > 0){
      echo "<script>
          alert('Data berhasil di hapus');
          window.location.assign('ketinggian.php');
      </script>";
  };
}
?>