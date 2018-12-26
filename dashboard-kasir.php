<?php 
session_start();

require 'functions.php';

if ($_SESSION["login"]) {
	if(isset($_SESSION["user"]) && $_SESSION["user"] == "kasir"){
		$id_karyawan = $_SESSION["id_karyawan"];
		$result = mysqli_query($conn, "SELECT * FROM karyawan WHERE id_karyawan = '$id_karyawan'");
		$id_karyawan = mysqli_fetch_assoc($result);
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
 <title>Dashboard!</title>
 <link rel="stylesheet" href="assets/css/bulma.min.css" />
 <link rel="stylesheet" href="assets/css/style.css" />
 <script defer src="assets/js/all.js"></script>
 <script src="assets/js/angular.min.js"></script>
 
 
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
	   <div class="id-admin"><?php echo $id_karyawan["username"]?></div>
	  </div>
	  <hr>
	  <p class="menu-label">General</p>
	  <ul class="menu-list">
	   <li><a href="">Edit Profil</a></li>
	  </ul>
	  <p class="menu-label">Transaction</p>
	  <ul class="menu-list">
	   <li><a class="is-active" href="">Pesanan</a></li>
	   <li><a href="history-kasir.php">Riwayat</a></li>
	  </ul>

	 </aside>
	</div>

	<div class="column is-10">
	
	<div class="columns is-marginless is-variable is-1 is-centered">
		<div class="column is-3">
			<form action="" method="POST" name="">
			<input type="text" class="input" placeholder="Masukkan No Order...." name="order">
		</div>
		<div class="column is-2">
			<button class="button is-success is-fullwidth" name="proses">Proses</button>
		</div>
		<?php
			if(isset($_POST["proses"])){
				$order=$_POST['order'];
			};
		?>
		<div class="column no-pesan">
			<h1 class="has-text-weight-bold">Pesanan : <?php echo @$order;?></h1>
		</div>
		</form>
	</div>
	

	 <div class="box content" style="margin-top:5px;">
	  <div class="pesanan" id="containerpesanan">
	   <table class="">
		<thead>
		 <tr><th>#</th><th>Pesanan</th><th>Harga Satuan</th><th colspan="3">Jumlah</th><th>Subtotal</th></tr>
		</thead>
		<tbody>
		<?php
			if (isset($_POST["proses"])){
				$queryCek= mysqli_query($conn, "SELECT id_pesanan FROM pesanan WHERE id_pesanan='$order' AND status = '0'");
				if(mysqli_num_rows($queryCek)==1){
				$query1= mysqli_query($conn, "SELECT p.id_pesanan,m.id_makanan,m.harga,m.nama,ip.jumlah,ip.subtotal FROM item_pesanan ip INNER JOIN pesanan p ON ip.id_pesanan=p.id_pesanan INNER JOIN makanan m ON ip.id_makanan=m.id_makanan WHERE ip.id_pesanan = '$order'");
				$query2= mysqli_query($conn, "SELECT SUM(ip.subtotal) AS total FROM item_pesanan ip INNER JOIN pesanan p ON ip.id_pesanan=p.id_pesanan INNER JOIN makanan m ON ip.id_makanan=m.id_makanan WHERE ip.id_pesanan ='$order' ");
				$i=0;
				$record2= mysqli_fetch_array($query2);
				$total= number_format($record2['total']);
				while ($record = mysqli_fetch_assoc($query1)){
					$records[] = $record;
				}
		?>

		<?php foreach ($records as $r) : ?>
		<tr>
			<?php
				$i=$i+1;
				
				$harga= number_format($r['harga']);
				$subtotal= number_format($r['subtotal']);
			?>
			<td><?php echo $i?></td>
			<td><?php echo $r['nama'];?></td>
			<td><?php echo $harga;?></td>
			<td>
				<button class="button is-small is-success kurang" name="kurang" id="btn_kurang" data-id_pesanan="<?php echo htmlspecialchars($r['id_pesanan']); ?>" data-id_makanan="<?php echo htmlspecialchars($r['id_makanan']); ?>" data-jumlah="<?php echo htmlspecialchars($r['jumlah']); ?>"><i class="fas fa-minus-square"></i></button>
			</td>
			<td><?php echo $r['jumlah'];?></td>
			<td>
				<button class="button is-small is-success tambah" name="tambah" id="btn_tambah" data-id_pesanan="<?php echo htmlspecialchars($r['id_pesanan']); ?>" data-id_makanan="<?php echo htmlspecialchars($r['id_makanan']); ?>" data-jumlah="<?php echo htmlspecialchars($r['jumlah']); ?>"><i class="fas fa-plus-square"></i></button>
			</td>
			<td class="has-text-right"><?php echo $subtotal;?></td>
		</tr>
		<?php
			endforeach;
		?>
		</tbody>
		<tfoot ng-app="kembalianApp" ng-controller="kembalianCtrl">
			<tr>
				<th class="has-text-right" colspan="6">TOTAL : </th>
				<th class="has-text-right" ><p id="totalharga" ng-model="total" ng-init="total='<?php echo $record2['total'];?>'" data-total="<?php echo htmlspecialchars($record2['total']); ?>"><?php echo $total;?></p></th>
			</tr>
			<tr>
				<th class="no-border has-text-right" colspan="6">BAYAR : </th>
				<th style="max-width:100px;padding:0" class="no-border"><input type="text" id="bayar" class="input has-text-right has-text-weight-bold" ng-model="bayar"></th>
			</tr>
			<tr>
				<th class="no-border has-text-right" colspan="6">KEMBALIAN : </th>
				<th class="no-border has-text-right"><p id="hasilkembalian">-</p></th>
			</tr>
			
			<?php
				}else{
					echo '<script language="javascript">';
					echo 'alert("Pesanan Tidak Ditemukan")';
					echo '</script>';
				}
			}
			?>
		</tfoot>
	   </table>
	  </div>
	 </div>

	 <div class="columns is-marginless">
		<div class="column is-2 is-offset-10">
			<?php
			if(isset($_POST["proses"])){
			?>
			<form action="proses_transaksi.php" method="POST">
				<input type="hidden" name="id_pesanan" value="<?php echo $order;?>">
				<input type="hidden" name="id_karyawan" value="<?php echo $_SESSION['id_karyawan'];?>">
				<input type="hidden" name="kembalianpost" value="" id="kembalianpost">
				<input type="hidden" name="totalpost" value="" id="totalpost">
				<input type="hidden" name="bayarpost" value="" id="bayarpost">
				<input class="button is-success is-medium is-fullwidth" type="submit" name="prosestransaksi" value="PROSES">
			</form>
			<?php
			}else{
			?>
			<button class="button is-success is-medium is-fullwidth">PROSES</button>
			<?php
			}
			?>
		</div>
	 </div>

   </div>
  </div>
</body>

<!-- <script>
var app = angular.module('kembalianApp', []);
app.controller('kembalianCtrl', function($scope) {
	$scope.kembalian = function() {
		if(parseInt($scope.bayar-$scope.total) >=0){
		return $scope.result= parseInt($scope.bayar)-parseInt($scope.total);
		}else{
		return $scope.result='-';
		}
	};
});
</script> -->
<script src="assets/js/jquery-3.3.1.min.js"></script>
 <script src="assets/js/editmenukasir.js"></script>
<script src="assets/js/bulma.js"></script>

</html>