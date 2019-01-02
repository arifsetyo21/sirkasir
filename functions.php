<?php 

$conn = mysqli_connect("localhost", "root", "", "sirkasir");

function query($query) {

	global $conn;
	
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}

	return $rows;
}

function tambah($data) {
	global $conn;

	$id_penjual = $data["id_penjual"];
	$nama = $data["nama"];
	$harga = $data["harga"];
	$stock = $data["stok"];
	$deskripsi = $data["deskripsi"];
	$gambar = upload();

	$query = "INSERT INTO makanan VALUES ('', '$nama', '$harga', '$stock', '$gambar', '$id_penjual', '$deskripsi')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

function tambahPenjual($data) {
	global $conn;

	$id_penjual = '';
	$nama = $data["nama"];
	$username = $data["username"];
	$password = $data["password"];
	$no_stand = $data["no_stand"];
	$no_npwp = $data["no_npwp"];
	$deskripsi = $data["deskripsi"];
	$gambar = upload();

	$query = "INSERT INTO penjual VALUES ('', '$nama', '$username', '$password', '$no_stand', '$no_npwp', '$gambar','$deskripsi')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function tambahPelanggan($data) {
	global $conn;

	$nama = $data["nama"];
	$username = $data["username"];
	$password = $data["password"];
	$no_hp = $data["no_hp"];

	$query = "INSERT INTO pelanggan VALUES ('', '$nama', '$username', '$password', '$no_hp')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function upload(){
	$namaFile = $_FILES["gambar"]["name"];
	$ukuranFile = $_FILES["gambar"]["size"];
	$error = $_FILES["gambar"]["error"];
	$tmpName = $_FILES["gambar"]["tmp_name"];

	// cek apakah ada gambar yang diupload apa tidak
	if ($error === 4) {
		echo "<script>
				alert('pilih gambar terlebih dahulu!')
			  </script>";
		return false;
	}	

	/// cek kevalidan extensi gambar
	$extensiGambarValid = ['jpg', 'jpeg', 'png'];
	$extensiGambar = explode('.', $namaFile);
	$extensiGambar = strtolower(end($extensiGambar));
	if (!in_array($extensiGambar, $extensiGambarValid)) {
		echo "<script>
				alert('yang anda upload bukan gambar')
			  </script>";
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 200000) {
		echo "<script>
				alert('ukuran gambar terlalu besar')
			  </script>";
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $extensiGambar;

	if (isset($_POST['admin'])) {
		$admin = $_POST['admin'];
		if ($admin == "makanan") {
			move_uploaded_file($tmpName, '../assets/img/makanan/' . $namaFileBaru);
		} else if ($admin == "penjual") {
			move_uploaded_file($tmpName, '../assets/img/penjual/' . $namaFileBaru);
		}else if ($admin == "bayar"){
			move_uploaded_file($tmpName, '../assets/img/bayar/' . $namaFileBaru);
		} 
	} else {
		move_uploaded_file($tmpName, 'assets/img/makanan/' . $namaFileBaru);
	}
	
	return $namaFileBaru;
}

function hapus($data) {
	global $conn;

	$id_makanan = $data["id_makanan"];

	$query = "DELETE FROM makanan WHERE id_makanan = '$id_makanan'";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

//ichsan
function insertBayar($data){
	global $conn;

	$id_transaksi = htmlspecialchars($data["id_transaksi"]);
	$date = date('Y-m-d');
	
	$gambar = upload();

	$query =  "INSERT INTO `pembayaran_penjual` 
	(`id_pem_penjual`, 
	`tanggal_pembayaran`, 
	`gambar`, 
	`id_transaksi`) 
	VALUES ('', 
	'$date', 
	'$gambar', 
	'$id_transaksi')";
	
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
//ichsan

function ubah($data) {
	global $conn;

	$id_makanan = htmlspecialchars($data["id_makanan"]);
	$id_penjual = htmlspecialchars($data["id_penjual"]);
	$nama = htmlspecialchars($data["nama"]);
	$harga = htmlspecialchars($data["harga"]);
	$stok = htmlspecialchars($data["stok"]);
	$deskripsi = htmlspecialchars($data["deskripsi"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	if ( $_FILES["gambar"]["error"] === 4 ) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}

	$query =  "UPDATE makanan SET
				nama = '$nama',
				harga = '$harga',
				stok = '$stok',
				`desc` = '$deskripsi',
				gambar = '$gambar'
				WHERE id_makanan = '$id_makanan'";
	
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubahPenjual($data) {
	global $conn;

	$id_penjual = $data['id_penjual'];
	$nama = $data["nama"];
	$username = $data["username"];
	$password = $data["password"];
	$no_stand = $data["no_stand"];
	$no_npwp = $data["no_npwp"];
	$deskripsi = $data["deskripsi"];
	$gambarLama = $data["gambarLama"];

	if ( $_FILES["gambar"]["error"] === 4 ) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}

	$query = "UPDATE penjual SET 
					nama = '$nama',
					username = '$username',
					`password` = '$password',
					no_stand = '$no_stand',
					no_npwp = '$no_npwp',
					gambar = '$gambar',
					`desc` = '$deskripsi'
					WHERE id_penjual = '$id_penjual'";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

function ubahPelanggan($data) {
	global $conn;

	$id_pelanggan = $data['id_pelanggan'];
	$nama = $data["nama"];
	$username = $data["username"];
	$password = $data["password"];
	$no_hp = $data["no_hp"];

	$query = "UPDATE pelanggan SET nama = '$nama',
				username = '$username',
				`password` = '$password',
				no_hp = '$no_hp'
				WHERE id_pelanggan = '$id_pelanggan'";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function cart($data) {
	
	if (isset($data["act"])) {
		$act = $_GET["act"];

		if ($act == "add") {
			if (isset($_GET["id_makanan"])) {
				$id_makanan = $_GET["id_makanan"];
				if ($_SESSION['items'][$id_makanan]["jumlah"] != 0) {
						$_SESSION['items'][$id_makanan]["jumlah"] += 1;
				} else {
						$_SESSION["items"][$id_makanan]["jumlah"] = 1;
				}
			}
		} elseif ($act == "min") {
			if (isset($_GET["id_makanan"])) {
				$id_makanan = $_GET["id_makanan"];
				if ($_SESSION["items"][$id_makanan]["jumlah"]) {
						$_SESSION["items"][$id_makanan]["jumlah"] -= 1;
				}
			}
		} elseif ($act == "plus") {
			if (isset($_GET["id_makanan"])) {
				$id_makanan = $_GET["id_makanan"];
				if ($_SESSION['items'][$id_makanan]["jumlah"] !== 0) {
						$_SESSION['items'][$id_makanan]["jumlah"] += 1;
				} elseif ($_SESSION['items'][$id_makanan]["jumlah"] === 0) {
						$_SESSION['items'][$id_makanan]["jumlah"] = 1;
				}
			}
		} elseif ($act == "hapus") {
			if (isset($_GET["id_makanan"])) {
				$id_makanan = $_GET["id_makanan"];
				if ($_SESSION['items'][$id_makanan]["jumlah"]) {
							unset($_SESSION['items'][$id_makanan]["jumlah"]);
				}
			}
		} elseif ($act == "clear") {
			if (isset($_GET["id_makanan"])) {
				$id_makanan = $_GET["id_makanan"];
				if (isset($_SESSION['items'])) {
						foreach ($_SESSION['items'] as $items) {
							unset($_SESSION['items'][$items]);
						}
							unset($_SESSION['items']);
				}
			}
		}

	}
	
}

function order() {
	while($i = $_SESSION["items"]){
		$items[] = $i;
	}
}

function antar($data) {

	$id_pesanan = $data['id_pesanan'];
	$id_makanan = $data['id_makanan'];

	global $conn;

	$query = "UPDATE item_pesanan SET status = '1' WHERE id_pesanan = '$id_pesanan' AND id_makanan = '$id_makanan'";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

//report function
function array2csv(array &$array)
{
   if (count($array) == 0) {
     return null;
   }
   ob_start();
   $df = fopen("php://output", 'w');
   fputcsv($df, array_keys(reset($array)));
   foreach ($array as $row) {
      fputcsv($df, $row);
   }
   fclose($df);
   return ob_get_clean();
}

function download_send_headers($filename) {
	// disable caching
	$now = gmdate("D, d M Y H:i:s");
	header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
	header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
	header("Last-Modified: {$now} GMT");

	// force download  
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");

	// disposition / encoding on response body
	header("Content-Disposition: attachment;filename={$filename}");
	header("Content-Transfer-Encoding: binary");
}


function convert_to_csv($input_array, $output_file_name, $delimiter)
{
$temp_memory = fopen('php://memory', 'w');
// loop through the array
foreach ($input_array as $line) {
// use the default csv handler
fputcsv($temp_memory, $line, $delimiter);
}

fseek($temp_memory, 0);
// modify the header to be CSV format
header('Content-Type: application/csv');
header('Content-Disposition: attachement; filename="' . $output_file_name . '";');
// output the file to be downloaded
fpassthru($temp_memory);
}

function outputCsv($fileName, $assocDataArray)
{
    ob_clean();
    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private', false);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=' . $fileName);    
    if(isset($assocDataArray['0'])){
        $fp = fopen('php://output', 'w');
        fputcsv($fp, array_keys($assocDataArray['0']));
        foreach($assocDataArray AS $values){
            fputcsv($fp, $values);
        }
        fclose($fp);
    }
    ob_flush();
}