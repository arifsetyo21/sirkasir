function editMenu() {
    var modal = document.getElementById("modalTer");
    modal.classList.add("is-active");
}

function del(param) {

    var conf = confirm('Apakah anda yakin');
    console.log(param);
    if (conf == true) {
        window.location.href = 'penjual-makanan-hapus.php?id_makanan=' + param;
    }
}

function confirmCart() {
    var x = confirm("Yakin mau Bayar?");
    console.log(x);
    if (x == true) {
        window.location.href = 'pembeli-keranjang.php?param=true';
    }
}

function antar(p1, p2) {
    var conf = confirm('Apakah anda yakin');
    console.log(p1, p2);
    if (conf == true) {
        window.location.href = 'penjual-makanan-antar.php?id_pesanan=' + p1 + '&id_makanan=' + p2;
    }
}