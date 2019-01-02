<?php 
session_start();

require 'functions.php';
include "phpqrcode/qrlib.php";

if ($_SESSION["login"]) {
	if(isset($_SESSION["user"]) && $_SESSION["user"] == "pembeli"){
		$id_pelanggan = $_SESSION["id_pelanggan"];
		$meja = $_SESSION["meja"];
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
			if (isset($_SESSION['items'])) {	
			
				//header("Location: dashboard-pembeli-keranjang.php");
				$total = $_SESSION["total"];

				$time = mysqli_fetch_array(mysqli_query($conn, "SELECT NOW() as time"));

				//buat order
				//status : baru pesan, belum bayar = order : 0
				//				Sudah bayar di kasir = paid : 1
				//				Sudah di proses penjual = selesai : 2
				$query = "INSERT INTO pesanan VALUES ('', '$time[0]', $total, '$meja', '$id_pelanggan', '0')";
				$query2 = "UPDATE meja SET status = 'used' WHERE id_meja = '$meja'";
				mysqli_query($conn, $query);
				mysqli_query($conn, $query2);
				

				// Ambil id_pesanan berdasarkan urutan tanggal
				$id_pesanan = (mysqli_fetch_array(mysqli_query($conn, "SELECT id_pesanan as id_pesanan FROM pesanan ORDER BY UNIX_TIMESTAMP(tanggal_pesanan) DESC")));
				// var_dump($id_pesanan[0]);

				//insert item_pesanan
				foreach ($_SESSION["items"] as $item => $val) {
					$jumlah = $val["jumlah"];
					$subtotal = $val["subtotal"];					
					mysqli_query($conn, "INSERT INTO item_pesanan VALUES ('$id_pesanan[0]', '$item', '$jumlah', '$subtotal','0')");
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

			} else {
				echo "<script>
						alert('Pilih Makanan Terlebih dahulu!');
				</script>";
			}
		
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
</head>

<body>
  <section class="is-fullwidth">

  <?php include 'assets/html/nav-pembeli.php' ?>

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
				<?php if ($val['jumlah'] != 0) :?>
					<?php $result2 = mysqli_query($conn, "SELECT * FROM makanan WHERE id_makanan = '$id_makanan'")?>
					<?php 
							// var_dump($result2);
							$makanan = mysqli_fetch_array($result2);
							// var_dump($makanan);
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
				<?php endif;?>
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
	 <?//php var_dump($_SESSION)?>
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
<script src="assets/js/script.js"></script>
</html>