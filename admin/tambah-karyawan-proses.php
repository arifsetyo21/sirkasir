<?php
    include '../functions.php';
    if(isset($_POST['submit'])){
    // print_r($_POST);
        $username = $_POST['username'];
        $password = $_POST['password'];
        $no_hp = $_POST['no_hp'];
        $no_ktp = $_POST['no_ktp'];
        $bagian = $_POST['bagian'];

        $queryInsertKaryawan= mysqli_query($conn, "INSERT INTO `karyawan` (`id_karyawan`, `username`, `password`, `no_hp`, `no_ktp`, `bagian`) VALUES ('', '$username', '$password', '$no_hp', '$no_ktp', '$bagian')");
    };
    
?>

<script>
    window.alert("Karyawan Berhasil Diinputkan");
    window.location.replace('karyawan.php');
</script>