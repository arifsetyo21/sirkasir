<?php
    include '../functions.php';
    if(isset($_POST['submit'])){
    // print_r($_POST);
        $id_meja = $_POST['id-meja'];
        $status = $_POST['status'];

        $queryUpdateMeja= mysqli_query($conn, "UPDATE `meja` SET `status` = '$status' WHERE `meja`.`id_meja` = '$id_meja'");
    };
    
?>

<script>
    window.alert("Meja Berhasil Dirubah");
    window.location.replace('meja.php');
</script>