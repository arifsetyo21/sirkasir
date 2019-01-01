<?php 
include '../functions.php';

if (isset($_GET['id_penjual'])) {
  $id_penjual = $_GET['id_penjual'];
  $penjual = query("SELECT * FROM penjual WHERE id_penjual = '$id_penjual'")[0];
}

if (isset($_POST["tambah"])) {
   //$id_tanaman = htmlspecialchars($_POST['id_tanaman']);

    if( ubahPenjual($_POST) > 0){
       echo "<script>
             alert('data berhasil di Ubah');
             window.location.href = 'penjual.php';
       </script>";
    } else {
       echo "data gagal di Ubah";
    }
  }


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
    <title>Ela Admin - HTML5 Admin Template</title>
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
                <div class="row align-items-center">
                <div class="col-lg-10">
                        <div class="card">
                            <div class="card-header">
                                <strong>Tambah Data</strong> Penjual
                            </div>
                            <div class="card-body card-block">
                            <div class="d-block mx-auto">
                                    <img class="rounded-circle mx-auto d-block" src="../assets/img/penjual/<?= $penjual['gambar'];?>" alt="Card image cap" width="250px"><br>
                                </div>
                                <form autocomplete="off" action="" method="post" enctype="multipart/form-data"   class="form-horizontal">
                                <input type="text" value="<?= $id_penjual?>" name="id_penjual">
                                <input type="text" value="penjual" name="admin" hidden>
                                <input type="text" value="<?= $penjual['gambar']?>" name="gambarLama" hidden>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label class=" form-control-label">Foto Penjual</label></div>
                                        <div class="col-12 col-md-9">
                                            <input type="file" class="btn btn-outline-secondary" name="gambar" id="gambar">
                                        </div>
                                    </div> 
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="name-input" class=" form-control-label">Nama </label></div>
                                        <div class="col-12 col-md-9"><input required type="text" id="name-input" name="nama" value="<?= $penjual['nama']?>" placeholder="Enter Name" class="form-control" autocomplete="off" required><small class="help-block form-text">Please enter name</small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="panen-input" class=" form-control-label">Username </label></div>
                                        <div class="col-12 col-md-9"><input required type="text" id="panen-input" name="username" value="<?= $penjual['username']?>" placeholder="Enter Day to Common Harvest" class="form-control" required><small class="help-block form-text">Please enter harvest time </small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="harga-input" class=" form-control-label">Password </label></div>
                                        <div class="col-12 col-md-9"><input required type="password" id="harga-input" name="password" value="" placeholder="Enter Market Prize" class="form-control" required><small class="help-block form-text">Please enter market price</small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="panen-input" class=" form-control-label">NO Stand </label></div>
                                        <div class="col-12 col-md-9"><input required type="text" id="panen-input" name="no_stand" value="<?= $penjual['no_stand']?>" placeholder="Enter Day to Common Harvest" class="form-control" required><small class="help-block form-text">Please enter harvest time </small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="panen-input" class=" form-control-label">NO NPWP </label></div>
                                        <div class="col-12 col-md-9"><input required type="text" id="panen-input" name="no_npwp" value="<?= $penjual['no_npwp']?>" placeholder="Enter Day to Common Harvest" class="form-control" required><small class="help-block form-text">Please enter harvest time </small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Deskripsi</label></div>
                                        <div class="col-12 col-md-9"><textarea name="deskripsi" id="textarea-input" rows="3" placeholder="Deskripsi..." class="form-control" require><?= $penjual['desc']?></textarea></div>
                                    </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="tambah" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-ban"></i> Reset
                                </button>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
        </div>
    </div><!-- .animated -->
</div>

                <div class="clearfix"></div>
                <!-- Modal - Calendar - Add New Event -->
                <div class="modal fade none-border" id="event-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><strong>Add New Event</strong></h4>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success save-event waves-effect waves-light">Create
                                    event</button>
                                <button type="button" class="btn btn-danger delete-event waves-effect waves-light"
                                    data-dismiss="modal">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /#event-modal -->
                <!-- Modal - Calendar - Add Category -->
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

    <!--Local Stuff-->
</body>

</html>