function addUser() {
   window.location.assign('tambah-user.php');
}

function ubahUser(param) {
   window.location.assign('ubah-user.php?id_user=' + param);
}

function delUser(param) {
   var x = confirm('Yakin untuk hapus?');
   if (x == true) {
      window.location.assign('hapus-user.php?id_user=' + param);
   }
}

//Ichsan

   //meja
function addMeja(){
   window.location.assign('tambah-meja.php');
}
function ubahMeja(param) {
   window.location.assign('ubah-meja.php?id_meja=' + param);
}

function delMeja(param) {
   var x = confirm('Yakin Ingin Menghapus Meja Ini?');
   if (x == true) {
      window.location.assign('hapus-meja.php?id_meja=' + param);
   }
   
}
   //end of meja

   //karyawan
function addKaryawan(){
   window.location.assign('tambah-karyawan.php');
}
function ubahKaryawan(param) {
   window.location.assign('ubah-karyawan.php?id_karyawan=' + param);
}

function delKaryawan(param) {
   var x = confirm('Yakin Ingin Menghapus Karyawan Ini?');
   if (x == true) {
      window.location.assign('hapus-karyawan.php?id_karyawan=' + param);
   }
   
}
   //karyawan

//End of Ichsan

function ubahMakanan(param) {
   window.location.assign('ubah-makanan.php?id_makanan=' + param);
}

function delMakanan(param) {
   var x = confirm('Yakin untuk hapus?');
   if (x == true) {
      window.location.assign('hapus-makanan.php?id_makanan=' + param);
   }
}

function addPenjual() {
   window.location.assign('tambah-penjual.php');
}

function ubahPenjual(param) {
   window.location.assign('ubah-penjual.php?id_penjual=' + param);
}

function delPenjual(param) {
   var x = confirm('Yakin untuk hapus?');
   if (x == true) {
      window.location.assign('hapus-penjual.php?id_penjual=' + param);
   }
}

function addSuhu() {
   window.location.assign('tambah-suhu.php');
}

function ubahSuhu(param) {
   window.location.assign('ubah-suhu.php?id_suhu=' + param);
}

function delSuhu(param) {
   var x = confirm('Yakin untuk hapus?');
   if (x == true) {
      window.location.assign('hapus-suhu.php?id_suhu=' + param);
   }
}

function addCurah() {
   window.location.assign('tambah-curah.php');
}

function ubahCurah(param) {
   window.location.assign('ubah-curah.php?id_hujan=' + param);
}

function delCurah(param) {
   var x = confirm('Yakin untuk hapus?');
   if (x == true) {
      window.location.assign('hapus-curah.php?id_hujan=' + param);
   }
}

function addKetinggian() {
   window.location.assign('tambah-ketinggian.php');
}

function ubahKetinggian(param) {
   window.location.assign('ubah-ketinggian.php?id_ketinggian=' + param);
}

function delKetinggian(param) {
   var x = confirm('Yakin untuk hapus?');
   if (x == true) {
      window.location.assign('hapus-ketinggian.php?id_ketinggian=' + param);
   }
}

function delHistory(param) {
   var x = confirm('Yakin untuk hapus?');
   if (x == true) {
      window.location.assign('hapus-history.php?id_history=' + param);
   }
}