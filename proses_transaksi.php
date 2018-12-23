<?php
session_start();
    require 'functions.php';
    if(isset($_POST['prosestransaksi'])){
        // var_dump($_POST);
        
        //pemindahan data dari array post ke variable
        $id_karyawan=$_POST['id_karyawan'];
        $id_pesanan=$_POST['id_pesanan'];
        $kembalian=$_POST['kembalianpost'];
        $total=$_POST['totalpost'];
        $bayar=$_POST['bayarpost'];
        $date=date('Y-m-d');


        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk</title>
    <link rel="stylesheet" href="assets/css/struk.css"/>
</head>
<body>

  <div id="invoice-POS">
    
    <center id="top">
      <div class="logo"></div>
      <div class="info"> 
        <h2>SirKasir</h2>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
    
    <div id="mid">
      <div class="info">
        <h2>Informasi Pesanan</h2>
        <p> 
            Pesanan : <?php echo $id_pesanan;?></br>
            Karyawan   : <?php echo $id_karyawan;?></br>
            Tanggal   : <?php echo date('Y-m-d, H:i:s');?></br>
        </p>
      </div>
    </div><!--End Invoice Mid-->
    
    <div id="bot">

					<div id="table">
						<table>
							<tr class="tabletitle">
                                <td class="item"><h2>#</h2></td>
								<td class="item"><h2>Makanan</h2></td>
								<td class="Hours"><h2>Jumlah</h2></td>
								<td class="Rate"><h2>Sub Total</h2></td>
							</tr>

                            <?php
                                $query1= mysqli_query($conn, "SELECT p.id_pesanan,m.id_makanan,m.harga,m.nama,ip.jumlah,ip.subtotal FROM item_pesanan ip INNER JOIN pesanan p ON ip.id_pesanan=p.id_pesanan INNER JOIN makanan m ON ip.id_makanan=m.id_makanan WHERE ip.id_pesanan = '$id_pesanan'");
                                $i=0;
                                while ($record = mysqli_fetch_assoc($query1)){
                                    $records[] = $record;
                                }
                                foreach ($records as $r) :
                                    $i=$i+1;			
                                    $harga= number_format($r['harga']);
                                    $subtotal= number_format($r['subtotal']);

                            ?>
							<tr class="service">
								<td class="tableitem"><p class="itemtext"><?php echo $i;?></p></td>
								<td class="tableitem"><p class="itemtext"><?php echo $r['nama'];?></p></td>
                                <td class="tableitem"><p class="itemtext"><?php echo $r['jumlah'];?></p></td>
                                <td class="tableitem"><p class="itemtext"><?php echo $subtotal;?></p></td>
                            </tr>
                            <?php
                                endforeach;
                            ?>

							<tr class="tabletitle">
                                <td></td>
								<td></td>
								<td class="Rate"><h2>Total</h2></td>
								<td class="payment"><h2><?php echo $total;?></h2></td>
							</tr>

							<tr class="tabletitle">
                                <td></td>
								<td></td>
								<td class="Rate"><h2>Bayar</h2></td>
								<td class="payment"><h2><?php echo $bayar;?></h2></td>
                            </tr>

                            <tr class="tabletitle">
                                <td></td>
								<td></td>
								<td class="Rate"><h2>Kembali</h2></td>
								<td class="payment"><h2><?php echo $kembalian;?></h2></td>
							</tr>

						</table>
					</div><!--End Table-->

					<div id="legalcopy">
						<p class="legal"><strong>Terima Kasih Atas Transaksi Anda!</strong>  Pembelian ini dilakukan menggunakan sistem SirKasir. Menerima Kritik dan Saran. 
						</p>
					</div>

				</div><!--End InvoiceBot-->
  </div><!--End Invoice-->
    
</body>
</html>



<?php
   //ini query buat insert ke table transaksi
   $queryInsertTransaksi= mysqli_query($conn, "INSERT INTO `transaksi` (`id_transaksi`, `tanggal_transaksi`, `bayar`, `kembalian`, `id_karyawan`, `id_pesanan`) VALUES ('', '$date', '$bayar', '$kembalian', '$id_karyawan', '$id_pesanan')");
   $queryUpdateStatusPesanan = mysqli_query($conn, "UPDATE `pesanan` SET `status` = '1' WHERE `pesanan`.`id_pesanan` = '$id_pesanan'")
        // header('location: dashboard-kasir.php');     
?>
<script>
    window.print();
    window.location.replace('dashboard-kasir.php');
</script>