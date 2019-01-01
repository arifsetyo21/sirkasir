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

function addMakanan() {
   window.location.assign('tambah-makanan.php');
}

function ubahMakanan(param) {
   window.location.assign('ubah-makanan.php?id_makanan=' + param);
}

function delTanaman(param) {
   var x = confirm('Yakin untuk hapus?');
   if (x == true) {
      window.location.assign('hapus-tanaman.php?id_tanaman=' + param);
   }
}

function addTanah() {
   window.location.assign('tambah-tanah.php');
}

function ubahTanah(param) {
   window.location.assign('ubah-tanah.php?id_tanah=' + param);
}

function delTanah(param) {
   var x = confirm('Yakin untuk hapus?');
   if (x == true) {
      window.location.assign('hapus-tanah.php?id_tanah=' + param);
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