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
      <h2 class="title is-2 level-left">Daftar Makanan</h2>
      <a href="penjual-makanan-tambah.php" class="level-right"><button class="button is-success"><i class="fas fa-plus"></i><p style="color:#23d160">p</p> Tambah Makanan</button></a>
    </div>
     <div class="box content is-fullwidth">
      <div class="pesanan">
       <table style="100%">
        <thead>
         <tr><th>#</th><th>Gambar</th><th>Nama</th><th>Deskripsi</th><th>Harga</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        <?php if (isset($rows_makanan)) {?>
          <?php $i = 1 ?>
          <?php foreach ($rows_makanan as $makanan) : ?>
          <?php $id_makanan = $makanan["id_makanan"]?>
         <tr>
          <td><?= $i?></td>
          <td><img src="assets/img/makanan/<?= $makanan["gambar"]?>" alt="" style="width:70px"></td>
          <td><?= $makanan["nama"]?></td>
          <td><?= $makanan["desc"]?></td>
          <td><?= $makanan["harga"]?></td>
          <td>
            <a href="penjual-makanan-ubah.php?id_makanan=<?= $makanan['id_makanan'] ?>"><button class="button is-small is-warning"><i class="fas fa-pencil-alt"></i></button></a>
            <!-- <button  onclick="del('<?= $id_makanan?>')" class="button is-small is-danger" ><i class="fas fa-trash-alt"></i></button> -->
            <a href="penjual-makanan-hapus.php?id_makanan=<?= $makanan['id_makanan'] ?>"><button class="button is-small is-danger" ><i class="fas fa-trash-alt"></i></button></a>
          </td>
         </tr>
        <?php $i++; endforeach; ?>
        <?php }?>
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
<script>

</script>

</html>