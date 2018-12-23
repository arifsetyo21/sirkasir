$(document).ready(function(){


    $('.kurang').on('click', function(){
        var id_pesanan = $(this).data('id_pesanan');
        var id_makanan = $(this).data('id_makanan');
        var jumlah = $(this).data('jumlah');
        jumlah = parseInt(jumlah);
        jumlah = jumlah-1;
        $.post('assets/ajax/kurangmenu.php', {
            id_makanan: id_makanan,
            id_pesanan: id_pesanan,
            jumlah: jumlah
        }, function(data){
            $('#containerpesanan').html(data);
        });

    });

    $('.tambah').on('click', function(){
        var id_pesanan = $(this).data('id_pesanan');
        var id_makanan = $(this).data('id_makanan');
        var jumlah = $(this).data('jumlah');
        jumlah = parseInt(jumlah);
        jumlah = jumlah+1;
        $.post('assets/ajax/kurangmenu.php', {
            id_makanan: id_makanan,
            id_pesanan: id_pesanan,
            jumlah: jumlah
        }, function(data){
            $('#containerpesanan').html(data);
        });

    });

    $('#bayar').on('keyup', function(){
        var total = $('#totalharga').data('total');
        var bayar = $(this).val();
        total = parseInt(total);
        bayar = parseInt(bayar);
        var kembalian = bayar-total;
        if(kembalian<0){
            kembalian='-';
        }
        $('#hasilkembalian').html(kembalian);
        $('#kembalianpost').val(kembalian);
        $('#bayarpost').val(bayar);
        $('#totalpost').val(total);
    });
    
});