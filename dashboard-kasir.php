<?php 
session_start();

require 'functions.php';

if ($_SESSION["login"]) {
    if(isset($_SESSION["user"]) && $_SESSION["user"] == "kasir"){
        $id_karyawan = $_SESSION["id_karyawan"];
        $result = mysqli_query($conn, "SELECT * FROM karyawan WHERE id_karyawan = '$id_karyawan'");
        $id_karyawan = mysqli_fetch_assoc($result);
    } else {
        header("Location: login.php");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html>

<head>
 <meta charset="utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1" />
 <title>Dashboard!</title>
 <link rel="stylesheet" href="assets/css/bulma.min.css" />
 <link rel="stylesheet" href="assets/css/style.css" />
 <script defer src="assets/js/all.js"></script>
 <script src="assets/js/angular.min.js"></script>
</head>

<body>
  <section class="is-fullwidth">

   <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
     <a class="navbar-item brand-text" href="../">
      <img src="assets/img/logo.png" alt="" srcset="">
     </a>
     <div class="navbar-burger burger " data-target="navMenu">
      <span></span>
      <span></span>
      <span></span>
     </div>
    </div>

    <div id="navMenu" class="navbar-menu">
     <div class="navbar-start">
      <div class="navbar-item">
       <a class="navbar-item" href="">Home</a>
      </div>
     </div>
     <div class="navbar-end">
      <div class="navbar-item">
       <a class="button is-danger" href="logout.php">Logout</a>
      </div>
     </div>
    </div>

   </nav>

  </section>

  <div class="container">

   <div class="columns is-marginless">

    <div class="column is-2">
     <aside class="sidebar menu is-hidden-mobile is-uppercase has-text-weight-bold ">
      <div class="avatar has-text-centered">
       <figure class="img-avatar">
        <img src="assets/img/avatar.png" alt="">
       </figure>
       <div class="id-admin"><?php echo $id_karyawan["username"]?></div>
      </div>
      <hr>
      <p class="menu-label">General</p>
      <ul class="menu-list">
       <li><a href="">Edit Profil</a></li>
      </ul>
      <p class="menu-label">Transaction</p>
      <ul class="menu-list">
       <li><a href="">Riwayat</a></li>
      </ul>

     </aside>
    </div>

    <div class="column is-10">
    
    <div class="columns is-marginless is-center">
        <div class="column is-3" style="padding:0px;">
            <form action="" method="POST" name="">
            <input type="text" class="input" placeholder="Masukkan No Order...." name="order">
            
        </div>
        <div class="column is-2" style="padding:0px;">
            <button class="button is-success" style="margin-left:5px;" name="proses">Proses</button>
        </div>
        </form>
    </div>
    

     <div class="box content is-fullwidth" style="margin-top:5px;">
      <div class="pesanan">
       <table class="is-fullwidth">
        <thead>
         <tr><th>#</th><th>Pesanan</th><th>Harga Satuan</th><th colspan="3">Jumlah</th><th>Subtotal</th></tr>
        </thead>
        <tbody>
        <?php
            if (isset($_POST["proses"])){
                $order=$_POST['order'];
                $query1= mysqli_query($conn, "SELECT p.id_pesanan,m.id_makanan,m.harga,m.nama,ip.jumlah,ip.subtotal FROM item_pesanan ip INNER JOIN pesanan p ON ip.id_pesanan=p.id_pesanan INNER JOIN makanan m ON ip.id_makanan=m.id_makanan WHERE ip.id_pesanan = '$order'");
                $query2= mysqli_query($conn, "SELECT SUM(ip.subtotal) AS total FROM item_pesanan ip INNER JOIN pesanan p ON ip.id_pesanan=p.id_pesanan INNER JOIN makanan m ON ip.id_makanan=m.id_makanan WHERE ip.id_pesanan ='$order' ");
                $i=0;
                $record2= mysqli_fetch_array($query2);
                $total= number_format($record2['total']);
                while ($record = mysqli_fetch_array($query1)){
        ?>
        <tr>
            <?php
                $i=$i+1;
                $harga= number_format($record['harga']);
                $subtotal= number_format($record['subtotal']);
            ?>
            <td><?php echo $i?></td>
            <td><?php echo $record['nama'];?></td>
            <td><?php echo $harga;?></td>
            <td><button class="button is-small is-success"><i class="fas fa-minus-square"></i></button></td>
            <td><?php echo $record['jumlah'];?></td>
            <td><button class="button is-small is-success"><i class="fas fa-plus-square"></i></button></td>
            <td class="has-text-right"><?php echo $subtotal;?></td>
        </tr>
        <?php
            }
        ?>
        </tbody>
        <tfoot ng-app="kembalianApp" ng-controller="kembalianCtrl">
            <tr>
                <th class="has-text-right" colspan="6">TOTAL : </th>
                <th class="has-text-right" ><p ng-model="total" ng-init="total='<?php echo $record2['total'];?>'"><?php echo $total;?></p></th>
            </tr>
            <tr>
                <th class="no-border has-text-right" colspan="6">BAYAR : </th>
                <th style="max-width:100px;padding:0" class="no-border"><input type="text" class="input has-text-right has-text-weight-bold" ng-model="bayar"></th>
            </tr>
            <tr>
                <th class="no-border has-text-right" colspan="6">KEMBALIAN : </th>
                <th class="no-border has-text-right">{{kembalian()}}</th>
            </tr>
            
            <?php
            }
            ?>
        </tfoot>
       </table>
      </div>
     </div>

     <div class="columns is-marginless">
        <div class="column is-2 is-offset-10">
            <button class="button is-success is-medium is-fullwidth">PROSES</button>
        </div>
     </div>

   </div>
  </div>
</body>

<script>
var app = angular.module('kembalianApp', []);
app.controller('kembalianCtrl', function($scope) {
    $scope.kembalian = function() {
        if(parseInt($scope.bayar-$scope.total) >=0){
        return $scope.result= parseInt($scope.bayar)-parseInt($scope.total);
        }else{
        return $scope.result='-';
        }
    };
});
</script>
<script src="assets/js/bulma.js"></script>

</html>