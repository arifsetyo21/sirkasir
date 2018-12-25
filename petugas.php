<?php
session_start();

require 'functions.php';

if ($_SESSION["login"]) {
	if(isset($_SESSION["user"]) && $_SESSION["user"] == "petugas"){
		$id_karyawan = $_SESSION["id_karyawan"];
		$result = mysqli_query($conn, "SELECT * FROM karyawan WHERE id_karyawan = '$id_karyawan'");
		$id_karyawan = mysqli_fetch_assoc($result);
	} else {
		header("Location: login.php");
		exit;
	}
} else {
	header("Location: login.php");
	exit;
}

if(isset($_GET['meja'])){
    $id_meja=$_GET['meja'];
    $queryUpdateStatusMeja = mysqli_query($conn, "UPDATE `meja` SET `status` = 'free' WHERE `meja`.`id_meja` = '$id_meja'");
}

$meja = query("SELECT * FROM meja");
$i=0;

 ?>

 <html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Petugas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="../images/fav_icon.png" type="image/x-icon">
    <link rel='stylesheet prefetch' href='assets/css/bulma.min.css'>
    <script src="assets/js/all.js"></script>
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <link rel="stylesheet" href="assets/css/card-dashboard-pembeli.css">
</head>

<body>

        <!-- START NAV -->
<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item brand-text" href="../">
        <img src="assets/img/logo.png" alt="" srcset="">
        </a>
        <div class="navbar-burger burger " data-target="navMenu">
        <span></span>
        <span></span>
        <span></span>
        </div>
    </div>

    <div id="navMenu" class="navbar-menu">
        <div class="navbar-start">
        <div class="navbar-item">
        <a class="navbar-item" href="petugas.php">REFRESH</a>
        </div>
        </div>
        <div class="navbar-end">
        <div class="navbar-item">
        <a class="button is-danger" href="logout.php">Logout</a>
        </div>
        </div>
    </div>

</nav>
            <!-- END NAV -->

    <div class="container">
        <div class="section">
            <!-- Staff -->
            <div class="row columns is-multiline">
            <?php foreach ($meja as $m) : 
                $i=$i+1;

                if($m['status']=='free'){
                ?>
                <div class="column is-one-third">
                    <div class="card" style="border-radius: 0.35rem">
                        <div class="card-content" style="background-color:lightgrey;">
                            <div class="media">
                            <div class="media-content has-text-centered">
                            <p class="title is-4"><?php echo $m['id_meja'];?></p>
                                <p class="subtitle is-6"><?php echo 'Meja : '.$i;?></p>
                            </div>
                            </div>

                            <div class="content has-text-centered">
                            <button class="button is-success is-medium is-fullwidth" title="Disabled Button" Disabled>CLEAR</button>
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- End Card Staff -->
                <?php
                }else{
              ?>
              <div class="column is-one-third">
                    <div class="card" style="border-radius: 0.35rem">
                        <div class="card-content" style="">
                            <div class="media">
                            <div class="media-content has-text-centered">
                            <p class="title is-4"><?php echo $m['id_meja'];?></p>
                                <p class="subtitle is-6"><?php echo 'Meja : '.$i;?></p>
                            </div>
                            </div>

                            <div class="content has-text-centered">
                            <a href="petugas.php?meja=<?= $m["id_meja"]?>" class="button is-success is-medium is-fullwidth">CLEAR</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                endforeach;
                ?>
           
        </div>
    </div>
    <footer class="footer">
            <div class="container">
                <div class="content has-text-centered">
                    <div class="soc">
                        <a hidden href="#"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </footer>

            <script src="assets/js/bulma.js"></script>


</body>

</html>