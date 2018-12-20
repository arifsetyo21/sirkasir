<?php
session_start();
    require 'functions.php';
    if(isset($_POST['prosestransaksi'])){
        // var_dump($_POST);
        
        //pemindahan data dari array post ke variable
        $id_karyawan=$_POST['id_karyawan'];
        $id_pesanan=$_POST['id_pesanan'];
        $kembalian=$_POST['kembalianpost'];
        $date=date('Y-m-d');

        //ini query buat insert ke table transaksi
        $queryInsertTransaksi= mysqli_query($conn, "INSERT INTO `transaksi` (`id_transaksi`, `tanggal_transaksi`, `id_karyawan`, `id_pesanan`) VALUES ('', '$date', '$id_karyawan', '$id_pesanan')");
        header('location: dashboard-kasir.php');
    }

?>