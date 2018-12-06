<?php 
session_start();

require 'functions.php';

if ($_SESSION["login"]) {
  if (isset($_SESSION["user"]) && $_SESSION["user"] == "penjual") {
    $id_penjual = $_SESSION["id_penjual"];
    $result = mysqli_query($conn, "SELECT * FROM penjual WHERE id_penjual = '$id_penjual'");

    $penjual = mysqli_fetch_assoc($result);
    
    if (isset($_POST["tambah"])) {
      if( tambah($_POST) > 0){
         echo "data berhasil ditambahkan";
         header("Location: penjual-makanan.php");
      } else {
         echo "data gagal ditambahkan";
      }
    }
    

  } else {
    header("Location: login.php");
  }

} else {
  header("Location: login.php");
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
       <a class="navbar-item" href="">Makanan</a>
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
       <div class="id-admin"><?= $penjual["username"] ?></div>
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
    <div class="level">
      <h2 class="title is-2 level-left">Tambah Makanan</h2>
    </div>
     <div class="box content is-fullwidth">
      <div class="pesanan">
       <form action="" method="post" enctype="multipart/form-data">
         <ul>
            <input type="text" name="id" hidden>
            <input type="text" name="id_penjual" value="<?= $id_penjual?>" hidden> 
            <li>
               <label for="gambar">Foto Makanan </label>
               <input type="file" name="gambar" id="gambar">
            </li>
            <li>
               <label for="nama">Nama </label>
               <input type="text" name="nama" id="nama" required>
            </li>
            <li>
               <label for="harga">Harga </label>
               <input type="text" name="harga" id="harga" required>
            </li>
            <li>
               <label for="stok">Stok </label>
               <input type="number" name="stok" id="stok" required>
            </li>
            <li>
               <label for="desc">Deskripsi </label>
               <textarea name="desc" id="desc" required> </textarea>
            </li>
            <li>
               <button type="submit" name="tambah">Tambah</button>
            </li>
         </ul>
       </form>
      </div>
     </div>

    </div>

   </div>
  </div>
</body>

<script src="assets/js/bulma.js"></script>

</html>