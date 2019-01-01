<?php 
session_start();

require 'functions.php';

if ($_SESSION["login"]) {
  if (isset($_SESSION["user"]) && $_SESSION["user"] == "penjual") {
    $id_penjual = $_SESSION["id_penjual"];
    $result = mysqli_query($conn, "SELECT * FROM penjual WHERE id_penjual = '$id_penjual'");

    $penjual = mysqli_fetch_assoc($result);


    // join tabel 4 tabel dengan nama column yang sama menggunakan as
    $riwayat = query("SELECT p.tanggal_pesanan as tanggal_pesanan, p.id_pesanan, m.id_makanan, m.nama as nama_makanan, i.jumlah, p.id_meja, pl.nama as nama_pelanggan, i.subtotal, i.status, m.id_penjual as id_penjual FROM pesanan p INNER JOIN item_pesanan i ON p.id_pesanan=i.id_pesanan INNER JOIN makanan m ON i.id_makanan=m.id_makanan INNER JOIN pelanggan pl ON p.id_pelanggan = pl.id_pelanggan WHERE p.id_pesanan IN (SELECT id_pesanan FROM transaksi) AND m.id_penjual = '$id_penjual'");
    //var_dump($riwayat);
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
     <aside class="sidebar menu is-hidden-mobile is-uppercase has-text-weight-bold ">
      <div class="avatar has-text-centered">
       <figure class="img-avatar">
        <img src="assets/img/avatar.png" alt="">
       </figure>
       <div class="id-admin"><?php echo $penjual["username"] ?></div>
      </div>
      <hr>
      <p class="menu-label">General</p>
      <ul class="menu-list">
       <li><a href="dashboard-penjual.php">Pesanan</a></li>
      </ul>
      <p class="menu-label">Transaction</p>
      <ul class="menu-list">
       <li><a class="is-active" href="penjual-riwayat.php">Riwayat</a></li>
      </ul>

     </aside>
    </div>

    <div class="column is-10">

     <div class="box content is-fullwidth">
      <div class="pesanan" id="tabel-pesanan">
       <table style="100%">
       <div class="control">
          <div class="select">
            <select required>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
          </div>
        </div>
        <hr style="border: 1px solid rgba(0,0,0,0.1)">
        <thead>
        <?php $i = 1;?>
         <tr><th>#</th><th>No. Order</th><th>Pesanan</th><th>Jumlah</th><th>Meja</th><th>Atas Nama</th><th>Subtotal</th><th>Status</th></tr>
        </thead>
        <tbody>
          <?php foreach ($riwayat as $r) :?>
            <tr><td><?php echo $i; $id_makanan = $r['id_makanan']; $id_pesanan = $r['id_pesanan']; $i++?></td><td><?php echo $r['id_pesanan']?></td><td><?php echo $r['nama_makanan'] ?></td><td><?php echo $r['jumlah']?></td><td><?php echo $r['id_meja']?></td><td><?= $r['nama_pelanggan']?></td><td><?= $r['subtotal']?></td><td><span class="button is-static">Selesai</span></td></tr>
          <?php endforeach; ?>
        </tbody>
       </table> 
      </div>
     </div>

    </div>

   </div>
  </div>
</body>
</html>
<script src="assets/js/bulma.js"></script>
<script src="assets/js/script.js"></script>
<script>

var tombolAntar = document.getElementById('antar');
//var interval = setInterval(pesanan, 1000);
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
  xhr.open('GET', 'assets/ajax/ajax-penjual-riwayat.php', true);
  xhr.send();
}

</script>
<script >

</script>

</html>