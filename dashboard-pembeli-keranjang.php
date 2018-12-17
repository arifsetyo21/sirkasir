<?php 
session_start();

require 'functions.php';
include "phpqrcode/qrlib.php";

if ($_SESSION["login"]) {
	if(isset($_SESSION["user"]) && $_SESSION["user"] == "pembeli"){
		$id_pelanggan = $_SESSION["id_pelanggan"];
		$result = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
      $pembeli = mysqli_fetch_assoc($result);
      
		cart($_GET);
		// foreach ($_SESSION["items"] as $key => $value) {
		// 	echo "saya punya ". $key . "dengan jumalah" .$value;
		// }
		// $count = count($_SESSION["items"]);
		// var_dump($count);
		// var_dump($_GET);
		if (isset($_GET["param"])) {
			//header("Location: dashboard-pembeli-keranjang.php");
			$total = $_SESSION["total"];

			$time = mysqli_fetch_array(mysqli_query($conn, "SELECT NOW() as time"));

			//buat order
			
			$query = "INSERT INTO pesanan VALUES ('', '$time[0]', $total, 'MJ1', '$id_pelanggan')";
			mysqli_query($conn, $query);

			$id_pesanan = (mysqli_fetch_array(mysqli_query($conn, "SELECT id_pesanan as id_pesanan FROM pesanan ORDER BY id_pesanan DESC LIMIT 1")));
			// var_dump($id_pesanan[0]);

			//insert item_pesanan
			
			foreach ($_SESSION["items"] as $item => $val) {
				$jumlah = $val["jumlah"];
				$subtotal = $val["subtotal"];
				mysqli_query($conn, "INSERT INTO item_pesanan VALUES ('$id_pesanan[0]', '$item', '$jumlah', '$subtotal')");
			}	
			
			if (mysqli_affected_rows($conn) > 0){
				$tempdir = "temp/";
				$isi_teks = urlencode("?no=".$id_pesanan[0]);
				$namafile = $id_pesanan[0].".png";
				$quality = "M";
				$ukuran = "7";
				$padding = "2";

				QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
				unset($_SESSION["items"]);
				header("Location: print.php?no=". $id_pesanan[0]);
			};
		}
		

	} else {
		header("Location: login.php");
		exit;
	}
} else {
	header("Location: login.php");
	exit;
}

?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Daftar Order</title>
	<link rel="stylesheet" href="assets/css/bulma.min.css" />
	<link rel="stylesheet" href="assets/css/style.css" />
	<script defer src="assets/js/all.js"></script>
	<script defer src="assets/js/angular.min.js"></script>
	<style>
		@media print {
			.noprint {display: none;}
			.center-margin-print{
				margin: auto;
			}
		}
	</style>
	<script>
		function confirmCart() {
			var x = confirm("Yakin untuk Bayar?");
			console.log(x);
			if(x == true){
				window.location.href='dashboard-pembeli-keranjang.php?param=true';
			}
		}
	</script>
</head>

<body>
  <section class="is-fullwidth">

   <nav class="navbar norpint" role="navigation" aria-label="main navigation">
	<div class="navbar-brand">
	 <a class="navbar-item brand-text center-margin-print" href="../">
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
	   <a class="button is-danger" href="logout.php">Logout</a>
	  </div>
	 </div>
	</div>

   </nav>

  </section>

  <div class="container">

   <div class="columns is-marginless">

	<div class="column">
	<h1 class="title is-2 noprint">Daftar Order</h1>
   
	 <div class="box content" style="margin-top:5px;">
	  <div class="pesanan">
	   <table class="">
		<thead>
		 <tr><th>#</th><th>Pesanan</th><th>Harga Satuan</th><th colspan="3">Jumlah</th><th>Subtotal</th></tr>
		</thead>
		<tbody>
      <?php $total = 0; $i = 1;if (isset($_SESSION['items'])) :?>
         <?php foreach ($_SESSION['items'] as $id_makanan => $val) : ?>
            <?php $result2 = mysqli_query($conn, "SELECT id_makanan, nama, harga, stok, gambar, deskripsi FROM makanan WHERE id_makanan = '$id_makanan'")?>
				<?php 
                  $makanan = mysqli_fetch_array($result2);
						$subtotal = $val["jumlah"] * $makanan["harga"];
						$total += $subtotal;
            ?>
            <tr>
               <td><?= $i?></td>
               <td><?php echo $makanan["nama"]?></td>
               <td><?php echo $makanan["harga"]?></td>
               <td><a href="?act=min&amp;id_makanan=<?php echo $makanan["id_makanan"]?>" class="button is-small is-success"><i class="fas fa-minus-square"></i></a></td>
               <td><input class="input" type="number" value="<?php echo $_SESSION['items'][$id_makanan]["jumlah"]; ?>" style="width: 70px; text-align:center;" disabled></td>
               <td><a href="?act=plus&amp;id_makanan=<?php echo $makanan["id_makanan"]?>" class="button is-small is-success"><i class="fas fa-plus-square"></i></a></td>
               <td class="has-text-right"><input class="input" type="text" value="<?php echo $subtotal; $_SESSION['items'][$id_makanan]["subtotal"] = $subtotal;?>" disabled style="width:100px"></td>
            </tr>
         <?php $i++;endforeach; ?>
      <?php endif;?>
		</tbody>
		<tfoot>
			<tr>
				<th class="has-text-right" colspan="10">TOTAL : <input class="input" type="number" value="<?php echo $total; $_SESSION["total"] = $total;?>" style="width: 200px; text-align:center;" disabled></th>
			</tr>
		</tfoot>
	   </table>
	  </div>
	 </div>

	 <div class="columns is-marginless noprint">
		<div class="column is-2 is-offset-10">
			<!-- <form action="" method="post"> -->
				<a class="button is-success is-medium is-fullwidth" onclick="confirmCart()" name="bayar">BAYAR</a> 
				<!-- <button type="submit" class="button is-success is-medium is-fullwidth" name="bayar" onclick="confirmCart()" >BAYAR</button> -->
			<!-- </form> -->
		</div>
	 </div>
   </div>
  </div>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="assets/js/bulma.js"></script>
</html>