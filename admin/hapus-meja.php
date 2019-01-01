<?php
    include '../functions.php';
    $id_meja= $_GET['id_meja'];
    $queryDeleteMeja= mysqli_query($conn, "DELETE FROM `meja` WHERE `meja`.`id_meja` = '$id_meja'");
    
?>

<script>
    window.alert("Meja Berhasil Dihapus");
    window.location.replace('meja.php');
</script>