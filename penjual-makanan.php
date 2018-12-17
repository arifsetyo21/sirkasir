<?php 
session_start();

require 'functions.php';

if ($_SESSION["login"]) {
  if (isset($_SESSION["user"]) && $_SESSION["user"] == "penjual") {
    $id_penjual = $_SESSION["id_penjual"];
    $result = mysqli_query($conn, "SELECT * FROM penjual WHERE id_penjual = '$id_penjual'");

    $penjual = mysqli_fetch_assoc($result);
    
    $result2 = mysqli_query($conn, "SELECT * FROM makanan WHERE id_penjual = '$id_penjual'");
    while($row = mysqli_fetch_assoc($result2)){
      $rows_makanan[] = $row;
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
 <title>Makanan</title>
 <link rel="stylesheet" href="assets/css/bulma.min.css" />
 <link rel="stylesheet" href="assets/css/style.css" />
 <script defer src="assets/js/all.js"></script>
 <script src="assets/js/script.js"></script>
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
      <h2 class="title is-2 level-left">Daftar Makanan</h2>
      <a href="penjual-makanan-tambah.php" target="_blank" class="level-right"><button class="button is-success"><i class="fas fa-plus"></i><p style="color:#23d160">p</p> Tambah Makanan</button></a>
    </div>
     <div class="box content is-fullwidth">
      <div class="pesanan">
       <table style="100%">
        <thead>
         <tr><th>#</th><th>Gambar</th><th>Nama</th><th>Deskripsi</th><th>Harga</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        <?php $i = 1 ?>
        <?php foreach ($rows_makanan as $makanan) : ?>
          <?php $id_makanan = $makanan["id_makanan"]?>
         <tr>
          <td><?= $i?></td>
          <td><img src="assets/img/makanan/<?= $makanan["gambar"]?>" alt="" style="width:70px"></td>
          <td><?= $makanan["nama"]?></td>
          <td><?= $makanan["deskripsi"]?></td>
          <td><?= $makanan["harga"]?></td>
          <td>
            <a href="penjual-makanan-ubah.php?id_makanan=<?= $makanan['id_makanan'] ?>"><button class="button is-small is-warning"><i class="fas fa-pencil-alt"></i></button></a>
            <!-- <button  onclick="del('<?= $id_makanan?>')" class="button is-small is-danger" ><i class="fas fa-trash-alt"></i></button> -->
            <a href="penjual-makanan-hapus.php?id_makanan=<?= $makanan['id_makanan'] ?>"><button class="button is-small is-danger" ><i class="fas fa-trash-alt"></i></button></a>
          </td>
         </tr>
        <?php $i++; endforeach; ?>
        </tbody>
       </table>
      </div>
     </div>

    </div>

   </div>
  </div>
</body>

<script src="assets/js/bulma.js"></script>
<script src="assets/js/script.js"></script>

</html>