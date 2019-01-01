<?php
    include '../functions.php';
    if(isset($_POST['submit'])){
    // print_r($_POST);
    $id_karyawan = $_POST['id_karyawan'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $no_hp = $_POST['no_hp'];
    $no_ktp = $_POST['no_ktp'];
    $bagian = $_POST['bagian'];

        $queryUpdateKaryawan= mysqli_query($conn, "UPDATE `karyawan` SET `username` = '$username', `password` = '$password', `no_hp` = '$no_hp', `no_ktp` = '$no_ktp', `bagian` = '$bagian' WHERE `karyawan`.`id_karyawan` = '$id_karyawan'");
    };
    
?>

<script>
    window.alert("Data Karyawan Berhasil Dirubah");
    window.location.replace('karyawan.php');
</script>