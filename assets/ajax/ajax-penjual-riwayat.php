<?php

session_start();
$id_penjual = $_SESSION['id_penjual'];

require '../../functions.php';
$notif = query("SELECT p.id_pesanan, m.nama as nama_makanan, m.id_makanan as id_makanan, i.jumlah, p.id_meja, pl.nama, i.status as status_transaksi FROM pesanan p INNER JOIN item_pesanan i ON p.id_pesanan=i.id_pesanan INNER JOIN makanan m ON i.id_makanan=m.id_makanan INNER JOIN pelanggan pl ON p.id_pelanggan = pl.id_pelanggan WHERE p.id_pesanan IN (SELECT id_pesanan FROM transaksi) AND m.id_penjual = '$id_penjual'");

?>
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

<script src="../js/script.js"></script>
<?php
?>