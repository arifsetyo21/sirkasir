<?php 

session_start();
include 'functions.php';

if (isset($_GET)) {
   $id_pesanan = $_GET["no"];
   $id_pelanggan = $_SESSION["id_pelanggan"];
   $query = "SELECT * FROM item_pesanan INNER JOIN makanan ON item_pesanan.id_makanan=makanan.id_makanan WHERE id_pesanan = '$id_pesanan'";
   $items = query($query);
   $pelanggan = query("SELECT nama FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");

}


?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Print</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
   <script src="main.js"></script>
   <script defer src="assets/js/all.js"></script>
   <script src="assets/js/angular.min.js"></script>
   <script src="assets/js/jquery-3.3.1.min.js"></script>
   <script src="assets/js/editmenukasir.js"></script>
      <link rel="stylesheet" href="assets/css/bulma.min.css" />
   <link rel="stylesheet" href="assets/css/style.css" />
   <style>
      .onlyprint {
         display: none;
      }

      /@media print {
			.noprint {display: none; }
			.center-margin-print{
				margin: auto;
			}
         .printable {
         display: block !important;
		   }
      } 
   </style>
   <script>$(document).ready(function(){
      window.print();
      $(document).click(function(){
         window.location.href='dashboard-pembeli-keranjang.php'; 
         });
      });
   </script>
</head>
<!-- <body onload="window.print()"> -->
<body>

<section class="is-fullwidth" class="noprint">

<nav class="navbar" role="navigation" aria-label="main navigation" class="noprint">
<div class="navbar-brand">
 <a class="navbar-item brand-text" href="../">
  <img src="assets/img/logo.png" alt="" srcset="" class="noprint">
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

<div class="column">

 <div class="box content" style="margin-left:100px; margin-right:100px">
  <div class="pesanan" style="margin-left: 100px; margin-right: 100px">
  <div class="has-text-centered"  >
   <br>
   <br>
  </div>
  <div class="has-text-centered">
   <h1 >Detail Order</h1>
   <img src="temp/<?= $id_pesanan?>.png" alt="">
   <br>
   <br>
  </div>
  <div>
   <p class="is-size-6">No Order : <?= $id_pesanan?><br>Nama Pemasan : <?= $pelanggan[0]['nama'];?><br>No Meja : MJ1</p>
   <br>
  </div>
   <table class="" style="">
   <thead>
    <tr><th>#</th><th>Pesanan</th><th>Harga Satuan</th><th class="text-align: center; margin: auto">Jumlah</th><th>Subtotal</th></tr>
   </thead>
   <tbody>
   <?php $total = 0; $i = 1;?>
      <?php foreach ($items as $makanan) : ?>
         <tr>
            <td><?= $i?></td>
            <td><?php echo $makanan["nama"]?></td>
            <td><?php echo $makanan["harga"]?></td>
            <td><input class="input" type="number" value="<?php echo $makanan["jumlah"];?>" style="width: 70px; text-align:center;" disabled></td>
            <td><input class="input" type="text" value="<?php echo $makanan["subtotal"]; $total += $makanan["subtotal"];?>" disabled style="width:100px"></td>
         </tr>
      <?php $i++;endforeach; ?>
   </tbody>
   <tfoot>
      <tr>
         <th class="has-text-right" colspan="10"></th>
      </tr>
   </tfoot>
   </table>
   <div  style="margin: auto; text-align: center">
  <p style="inline: block"><h3 style="inline: block">TOTAL BAYAR</h3><input class="input" type="number" value="<?php echo $total;?>" style="width: 200px; text-align:center;" disabled></p>
  </div>
  </div>
 </div>
</div>
</div>
</body>
</html>