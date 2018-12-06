function editMenu() {
    var modal = document.getElementById("modalTer");
    modal.classList.add("is-active");
}

function del(param) {

    var conf = confirm('Apakah anda yakin');
    if (conf == true) {
        window.location.assign('penjual-makanan-hapus.php?id_makanan=' + param);
    }
}