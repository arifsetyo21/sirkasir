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
 <title>History Transaksi</title>
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
	   <li><a href="dashboard-kasir.php">Pesanan</a></li>
	   <li><a class="is-active" href="">Riwayat</a></li>
	  </ul>

	 </aside>
	</div>
    <?php
        //query buat select tahun di table transaksi
        $queryTahun= mysqli_query($conn, "SELECT YEAR(tanggal_transaksi) as 'tahun' FROM transaksi GROUP BY YEAR(tanggal_transaksi)");
    ?>
	<div class="column is-10">
	
	<div class="columns is-marginless is-variable is-1 is-centered">
		<div class="column is-2">
        <form action="" method="POST" name="">
			<select name="bulan" id="">
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
        <div class="column is-2">
            <select name="tahun" id="">
                <?php
                    //ngisi option di selection sebanyak tahun yang ada pada database table transaksi
                    while ($tahunRecord = mysqli_fetch_assoc($queryTahun)){
                ?>
                <option value="<?php echo $tahunRecord['tahun'];?>"><?php echo $tahunRecord['tahun'];?></option>
            </select>
                <?php 
                    }
                ?>
        </div>
		<div class="column is-2">
			<button class="button is-success is-fullwidth" name="proses">Proses</button>
        </div>
        </form>
		<div class="column no-pesan">
            <?php
                if(isset($_POST['proses'])){
                    //pemberian nama bulan/tahun
                    $bulan = $_POST['bulan'];
                    $tahun = $_POST['tahun'];
                    $dateObj   = DateTime::createFromFormat('!m', $bulan);
                    $namaBulan = $dateObj->format('F');
            ?>
            <h1 class="has-text-weight-bold">Bulan/Tahun : <?php echo @$namaBulan.'/'.@$tahun;?></h1>
            <?php 
                }else{
            ?>
            <h1 class="has-text-weight-bold">Bulan/Tahun :</h1>
            <?php
                }
            ?>
		</div>
		
	</div>
	

	 <div class="box content" style="margin-top:5px;">
	  <div class="pesanan" id="containerpesanan">
	   <table class="">
		<thead>
		 <tr><th>#</th><th>ID Transaksi</th><th>ID Pesanan</th><th>Pelanggan</th><th>Karyawan</th><th>Tanggal Transaksi</th></tr>
		</thead>
		<tbody>
            <?php
                if(isset($_POST['proses'])){
                    $queryCekHistory = mysqli_query($conn, "SELECT * FROM transaksi WHERE MONTH(tanggal_transaksi)=$bulan AND YEAR(tanggal_transaksi)=$tahun");
                    if(mysqli_num_rows($queryCekHistory)>0){
                        $queryHistory = mysqli_query($conn, "SELECT k.username,t.id_transaksi,t.tanggal_transaksi,p.id_pesanan,pl.nama FROM karyawan k INNER JOIN transaksi t ON k.id_karyawan=t.id_karyawan INNER JOIN pesanan p ON t.id_pesanan=p.id_pesanan INNER JOIN pelanggan pl ON p.id_pelanggan=pl.id_pelanggan WHERE MONTH(tanggal_transaksi)=$bulan AND YEAR(tanggal_transaksi)=$tahun");
                        $i=0;
                        while ($record = mysqli_fetch_assoc($queryHistory)){
                            $records[] = $record;
                        }
                        foreach ($records as $r) :
                            $i=$i+1;
            ?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $r['id_transaksi'];?></td>
			<td><?php echo $r['id_pesanan'];?></td>
            <td><?php echo $r['nama'];?></td>
            <td><?php echo $r['username'];?></td>
            <td><?php echo $r['tanggal_transaksi'];?></td>
        </tr>
                        <?php endforeach;?>
        <?php
               }else{
                echo '<script language="javascript">';
                echo 'alert("Record History Tidak Ada!")';
                echo '</script>';
               }
            }
        ?>
		</tbody>
		<tfoot>
		</tfoot>
	   </table>
	  </div>
	 </div>

	 <div class="columns is-marginless">
	 </div>

   </div>
  </div>
</body>

<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/bulma.js"></script>

</html>