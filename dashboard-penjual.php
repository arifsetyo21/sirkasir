<?php 
session_start();

require 'functions.php';

if ($_SESSION["login"]) {
  if (isset($_SESSION["user"]) && $_SESSION["user"] == "penjual") {
    $id_penjual = $_SESSION["id_penjual"];
    $result = mysqli_query($conn, "SELECT * FROM penjual WHERE id_penjual = '$id_penjual'");

    $penjual = mysqli_fetch_assoc($result);


    // join tabel 4 tabel dengan nama column yang sama menggunakan as
    $notif = query("SELECT p.id_pesanan, m.nama as nama_makanan, m.id_makanan as id_makanan, i.jumlah, p.id_meja, pl.nama, i.status as status_transaksi FROM pesanan p INNER JOIN item_pesanan i ON p.id_pesanan=i.id_pesanan INNER JOIN makanan m ON i.id_makanan=m.id_makanan INNER JOIN pelanggan pl ON p.id_pelanggan = pl.id_pelanggan WHERE p.id_pesanan IN (SELECT id_pesanan FROM transaksi) AND p.status = '1' AND i.status = '0' AND m.id_penjual = '$id_penjual'");
    
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

     <div class="box content is-fullwidth">
      <div class="pesanan" id="tabel-pesanan">
       <table style="100%">
        <thead>
        <?php $i = 1;?>
         <tr><th>#</th><th>No. Order</th><th>Pesanan</th><th>Jumlah</th><th>Meja</th><th>Atas Nama</th><th>Aksi</th></tr>
        </thead>
        <tbody>
          <?php foreach ($notif as $n) :?>
          <tr><td><?php echo $i; $id_makanan = $n['id_makanan']; $id_pesanan = $n['id_pesanan']; $i++?></td><td><?php echo $n['id_pesanan']?></td><td><?php echo $n['nama_makanan'] ?></td><td><?php echo $n['jumlah']?></td><td><?php echo $n['id_meja']?></td><th><?= $n['nama']?></th><td><button class="button is-small is-success" onclick="antar('<?= $id_pesanan?>', '<?= $id_makanan?>')"><i class="fas fa-check"></i></button></td></tr>
          <?php endforeach; ?>
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

var tombolAntar = document.getElementById('antar');
var interval = setInterval(pesanan, 1000);
var tabelPesanan = document.getElementById('tabel-pesanan');

function pesanan() {

  //buat objek ajax
  var xhr = new XMLHttpRequest();

  //cek kesiapan ajax
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      tabelPesanan.innerHTML = xhr.response;
    }
  }
  //eksekusi ajax
  xhr.open('GET', 'assets/ajax/ajax-penjual-pesanan.php', true);
  xhr.send();
}

</script>
<script >

</script>

</html>