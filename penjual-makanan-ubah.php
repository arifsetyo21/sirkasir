<?php 
session_start();

require 'functions.php';

if ($_SESSION["login"]) {
  if (isset($_SESSION["user"]) && $_SESSION["user"] == "penjual") {
    
   $id_makanan = $_GET["id_makanan"];
   $id_penjual = $_SESSION["id_penjual"];
    
    $penjual = query("SELECT * FROM penjual WHERE id_penjual = '$id_penjual'")[0];
    $makanan = query("SELECT * FROM makanan WHERE id_makanan = '$id_makanan'")[0];
    
    if (isset($_POST["ubah"])) {
      if( ubah($_POST) > 0){
         echo "<script>
               alert('data berhasil diubah');
               window.location.href = 'penjual-makanan.php';
         </script>";
      } else {
         echo "<script>alert('data gagal diubah');</script>";
         echo("Error description: " . mysqli_error($conn));
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
 <title>Ubah data makanan</title>
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
       <a class="navbar-item" href="dashboard-penjual.php">Home</a>
       <a class="navbar-item" href="penjual-makanan.php">Makanan</a>
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
      <h2 class="title is-2 level-left">Ubah Data Makanan</h2>
    </div>
     <div class="box content is-fullwidth">
      <div class="pesanan">
       <form action="" method="post" enctype="multipart/form-data">
         <ul>
            <input type="text" name="id_makanan" value="<?= $makanan["id_makanan"]?>">
            <input type="text" name="gambarLama" value="<?= $makanan["gambar"]?>">
            <input type="text" name="id_penjual" value="<?= $id_penjual?>">
            <li>
               <label for="gambar">Foto Makanan </label>
               <img src="assets/img/makanan/<?= $makanan["gambar"]?>" alt="" width= 60px>
               <input type="file" name="gambar" id="gambar">
            </li>
            <li>
               <label for="nama">Nama </label>
               <input type="text" name="nama" id="nama" required value="<?= $makanan["nama"]?>">
            </li>
            <li>
               <label for="harga">Harga </label>
               <input type="text" name="harga" id="harga" required value="<?= $makanan["harga"]?>">
            </li>
            <li>
               <label for="stok">Stok </label>
               <input type="number" name="stok" id="stok" required value="<?= $makanan["stok"]?>">
            </li>
            <li>
               <label for="deskripsi">Deskripsi </label>
               <textarea name="deskripsi" id="deskripsi" required> <?= $makanan['deskripsi']?></textarea>
            </li>
            <li>
               <button type="submit" name="ubah">ubah</button>
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