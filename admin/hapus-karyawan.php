<?php
    include '../functions.php';
    $id_karyawan= $_GET['id_karyawan'];
    $queryDeleteMeja= mysqli_query($conn, "DELETE FROM `karyawan` WHERE `karyawan`.`id_karyawan` = '$id_karyawan'");
    
?>

<script>
    window.alert("Karyawan Berhasil Dihapus");
    window.location.replace('karyawan.php');
</script>