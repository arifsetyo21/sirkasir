<?php 
session_start();

require 'functions.php';

if ($_SESSION["login"]="login") {
$id_karyawan = $_SESSION["id_karyawan"];
$result = mysqli_query($conn, "SELECT * FROM karyawan WHERE id_karyawan = '$id_karyawan'");
$id_karyawan = mysqli_fetch_assoc($result);
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
       <a class="button is-danger" href="functionsLogout.php">Logout</a>
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
            <input type="text" class="input" placeholder="Masukkan No Order....">
        </div>
        <div class="column is-2" style="padding:0px;">
            <button class="button is-success" style="margin-left:5px;">Proses</button>
        </div>
    </div>
    

     <div class="box content is-fullwidth" style="margin-top:5px;">
      <div class="pesanan">
       <table class="is-fullwidth">
        <thead>
         <tr><th>#</th><th>Pesanan</th><th>Harga Satuan</th><th colspan="3">Jumlah</th><th>Subtotal</th></tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>Tahu Kupat</td>
            <td>10k</td>
            <td><button class="button is-small is-success"><i class="fas fa-minus-square"></i></button></td>
            <td>100</td>
            <td><button class="button is-small is-success"><i class="fas fa-plus-square"></i></button></td>
            <td class="has-text-right">100k</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Tahu Kupat</td>
            <td>10k</td>
            <td><button class="button is-small is-success"><i class="fas fa-minus-square"></i></button></td>
            <td>100</td>
            <td><button class="button is-small is-success"><i class="fas fa-plus-square"></i></button></td>
            <td class="has-text-right">100k</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Tahu Kupat</td>
            <td>10k</td>
            <td><button class="button is-small is-success"><i class="fas fa-minus-square"></i></button></td>
            <td>100</td>
            <td><button class="button is-small is-success"><i class="fas fa-plus-square"></i></button></td>
            <td class="has-text-right">100k</td>
        </tr>
        </tbody>
        <tfoot>
            <tr>
                <th class="has-text-right" colspan="6">TOTAL : </th>
                <th class="has-text-right">100.000</th>
            </tr>
            <tr>
                <th class="no-border has-text-right" colspan="6">BAYAR : </th>
                <th style="max-width:100px;padding:0" class="no-border"><input type="text" class="input has-text-right has-text-weight-bold"></th>
            </tr>
            <tr>
                <th class="no-border has-text-right" colspan="6">KEMBALIAN : </th>
                <th class="no-border has-text-right">100.000</th>
            </tr>
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

<script src="assets/js/bulma.js"></script>

</html>