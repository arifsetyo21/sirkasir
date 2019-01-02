<?php 

session_start();
include '../functions.php';

// if ($_SESSION["admin"] != "admin"){
//     echo "<script>
//             window.location.href='login.php';
//         </script>";
// }

$halamanAktif = $_GET['halaman'];
$dataPerhalaman = 10;
$jumlahData = count(query("SELECT DISTINCT p.id_pesanan, p.tanggal_pesanan, p.id_meja, pe.username, p.status FROM pesanan p INNER JOIN item_pesanan ip ON p.id_pesanan = ip.id_pesanan INNER JOIN pelanggan pe ON pe.id_pelanggan = p.id_pelanggan"));
$jumlahHalaman = ceil(($jumlahData/$dataPerhalaman));
$indexAwal = ($halamanAktif * $dataPerhalaman) - $dataPerhalaman;
// var_dump($jumlahHalaman);

$query = "SELECT DISTINCT p.id_pesanan, p.tanggal_pesanan, p.id_meja, pe.username, p.status FROM pesanan p INNER JOIN item_pesanan ip ON p.id_pesanan = ip.id_pesanan INNER JOIN pelanggan pe ON pe.id_pelanggan = p.id_pelanggan ORDER BY tanggal_pesanan DESC LIMIT $indexAwal, $dataPerhalaman";
$penjual = query($query);
$rows = $penjual;

?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Riwayat Pesanan</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    <script src="assets/js/script.js"></script>
    <style>
        #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }

    </style>
</head>

<body>
    <!-- Left Panel -->
    <?php include 'assets/php/dashboard-leftpanel.php'?>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?php include 'assets/php/dashboar-header.php'?>
        <!-- /#header -->

        
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Daftar Riwayat Pesanan</strong>
                                <div class="float-right"><button class="btn btn-success btn-sm" onclick="addPenjual()"><i class="fa fa-plus-square-o"></i> Tambah</button></div>
                            </div>
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th class="avatar">ID Pesanan</th>
                                            <th>Tanggal Pesanan</th>
                                            <th>ID Meja</th>
                                            <th>Username</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1;foreach ($rows as $row) :?>
                                        <tr>
                                            <td class="serial"><?= $i?>.</td>
                                            <td>  <span class="name"><?= $row['id_pesanan']?></span> </td>
                                            <td> <span class="product"><?= $row['tanggal_pesanan'];?></span> </td>
                                            <td> <span class="product"><?= $row['id_meja']?></span> </td>
                                            <td> <span class="product"><?= $row['username']?></span> </td>
                                          <?php if ($row['status'] == '1') :?>
                                            <td> <span class="product" style="color: green">Sudah dibayar</span> </td>
                                          <?php else :?>
                                            <td> <span class="product" style="color: red">Belum dibayar</span> </td>
                                          <?php endif?>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="delPesanan('<?= $row['id_pesanan']?>')"><i class="fa fa-trash-o"></i>Hapus</button>
                                            </td>
                                        </tr>
                                        <?php $i++; endforeach;?>
                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->
                        </div>
                    </div>
                </div>
                <div class="mx-auto" >
                <nav aria-label="..." class="" style="margin-left: 450px">
                <ul class="pagination">
                    <?php if ($halamanAktif > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?>" tabindex="-1">Previous</a>
                        <?php endif ?>
                        </li>
                        <?php for ($i=1; $i < $jumlahHalaman + 1; $i++) :?>
                                <?php if ($i == $halamanAktif): ?>
                                    <li class="page-item active">
                                        <a class="page-link halamanAktif" href="?halaman=<?= $i; ?>"><strong><?= $i; ?></strong></a>
                                    </li>
                                <?php else :?>
                                    <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                                <?php endif ?>
                            <?php endfor; ?>
                            <?php if ($halamanAktif < $jumlahHalaman): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?>">Next</a>
                                </li>
                            <?php endif ?>
                        </ul>
                    </nav>
                </div>
        </div>
    </div><!-- .animated -->
</div>
                <!-- /#add-category -->
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2018 Ela Admin
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="assets/js/init/fullcalendar-init.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
      function delMakanan(param) {
    var x = confirm('Yakin untuk hapus?');
    if (x == true) {
        window.location.assign('hapus-makanan.php?id_makanan=' + param);
      }
    }
    </script>

    <!--Local Stuff-->
</body>

</html>