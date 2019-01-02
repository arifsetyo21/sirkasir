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
         echo "<script>
               alert('data berhasil ditambahkan');
               window.location.href = 'penjual-makanan.php';
         </script>";
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

   <?php include "assets/html/head-penjual.html"?>

<body>
  <section class="is-fullwidth">

   <?php include "assets/html/nav-penjual.html"?>

  </section>

  <div class="container">

   <div class="columns is-marginless">

    <div class="column is-2">
    <?php include 'assets/html/leftpanel-penjual.php'?>
    </div>
    <div class="column is-10">
    <div class="level">
      <h2 class="title is-2 level-left">Tambah Makanan</h2>
    </div>
     <div class="box content is-fullwidth">
      <div class="pesanan">
       <form action="" method="post" enctype="multipart/form-data">
         <ul>
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
               <label for="deskripsi">Deskripsi </label>
               <textarea name="deskripsi" id="deskripsi" required> </textarea>
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