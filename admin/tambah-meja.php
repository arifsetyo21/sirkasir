<?php
    include '../functions.php';

    $queryInsertMeja= mysqli_query($conn, "INSERT INTO `meja` (`id_meja`, `status`) VALUES ('', 'free')");
?>

<script>
    window.alert("Meja Berhasil Ditambahkan");
    window.location.replace('meja.php');
</script>