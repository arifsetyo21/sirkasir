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