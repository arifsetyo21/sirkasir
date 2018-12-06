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

	$id = $data["id"];
	$id_penjual = $data["id_penjual"];
	$nama = $data["nama"];
	$harga = $data["harga"];
	$stock = $data["stok"];
	$desc = $data["desc"];
	$gambar = upload();

	$query = "INSERT INTO makanan VALUES ('', '$nama', '$harga', '$stock', '$gambar', '$id_penjual', '$desc')";
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

	move_uploaded_file($tmpName, 'assets/img/makanan/' . $namaFileBaru);
	
	return $namaFileBaru;
}

function hapus($data) {
	global $conn;

	$id_makanan = $data["id_makanan"];

	$query = "DELETE FROM makanan WHERE id_makanan = '$id_makanan'";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

 ?>