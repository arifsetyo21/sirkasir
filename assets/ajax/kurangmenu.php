<?php
    require '../../functions.php';

    if(isset($_POST['id_pesanan'])){
        $id_pesanan= $_POST['id_pesanan'];
        $id_makanan= $_POST['id_makanan'];
        $jumlah= $_POST['jumlah'];
    }
    $queryUpdate= mysqli_query($conn, "UPDATE item_pesanan SET jumlah=$jumlah WHERE id_pesanan='$id_pesanan' AND id_makanan='$id_makanan'");
?>

<table class="">
		<thead>
		 <tr><th>#</th><th>Pesanan</th><th>Harga Satuan</th><th colspan="3">Jumlah</th><th>Subtotal</th></tr>
		</thead>
		<tbody>
		<?php
				$query1= mysqli_query($conn, "SELECT p.id_pesanan,m.id_makanan,m.harga,m.nama,ip.jumlah,ip.subtotal FROM item_pesanan ip INNER JOIN pesanan p ON ip.id_pesanan=p.id_pesanan INNER JOIN makanan m ON ip.id_makanan=m.id_makanan WHERE ip.id_pesanan = '$id_pesanan'");
				$query2= mysqli_query($conn, "SELECT SUM(ip.subtotal) AS total FROM item_pesanan ip INNER JOIN pesanan p ON ip.id_pesanan=p.id_pesanan INNER JOIN makanan m ON ip.id_makanan=m.id_makanan WHERE ip.id_pesanan ='$id_pesanan' ");
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
				<th class="has-text-right" ><p ng-model="total" ng-init="total='<?php echo $record2['total'];?>'"><?php echo $total;?></p></th>
			</tr>
			<tr>
				<th class="no-border has-text-right" colspan="6">BAYAR : </th>
				<th style="max-width:100px;padding:0" class="no-border"><input type="text" class="input has-text-right has-text-weight-bold" ng-model="bayar"></th>
			</tr>
			<tr>
				<th class="no-border has-text-right" colspan="6">KEMBALIAN : </th>
				<th class="no-border has-text-right">{{kembalian()}}</th>
			</tr>
			
		</tfoot>
	   </table>
            <?php var_dump($record2['total']);?>
      
    <script>
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
</script>

    <script src="assets/js/editmenukasir.js"></script>

    
