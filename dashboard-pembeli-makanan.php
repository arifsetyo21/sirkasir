<?php 
session_start();
error_reporting(0);
require 'functions.php';

   if ($_SESSION["login"]) {
      if(isset($_SESSION["user"]) && $_SESSION["user"] == "pembeli"){
            $id_pelanggan = $_SESSION["id_pelanggan"];
            $result = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");

            $pembeli = mysqli_fetch_assoc($result);

            $id_penjual = $_GET["id_penjual"];

            $makanan = query("SELECT * FROM makanan WHERE id_penjual = '$id_penjual'");
            
            if (isset($_GET["act"])) {
                cart($_GET);
        
            }
            
            // var_dump($_SESSION);
            // echo "<script> window.location.reload();</script>";

      } else {
            header("Location: login-pembeli.php");
      }

   } else {
      header("Location: login-pembeli.php");
   }

?>


<html lang="en">

<head>
   <meta charset="UTF-8">
   <title>Makanan</title>
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
        <a class="navbar-item" href="">Home</a>
        <a class="navbar-item" href="">Makanan</a>
        </div>
        </div>
        <div class="navbar-end">
        <div class="navbar-item">
        <a href= "dashboard-pembeli-keranjang.php" class="button is-text"><i class="fas fa-shopping-cart"></i></a>
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
                <?php $i =1; foreach ($makanan as $m) : ?>
                <div class="column is-one-third">
                    <div class="card" style="border-radius: 0.35rem">
                        <div class="card-image">
                            <figure class="image is-4by3">
                            <img class="foto-toko" src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image" style="border-radius: 1rem; padding: 0.5rem">
                            </figure>
                        </div>
                        <form action="" method="post">
                        <div class="card-content">
                            <div class="media">
                            <div class="media-content">
                                 <input type="text" name="id_makanan" value="<?php  $id_makanan = $m["id_makanan"]; echo $id_makanan?>" hidden>
                                <p class="title is-4"><a href="#"><?= $m["nama"]?></a></p>
                                <p class="subtitle is-6">Rp. <?= $m["harga"]?></p>
                            </div>
                            </div>

                            <div class="content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Phasellus nec iaculis mauris. <a>@bulmaio</a>.
                            <a href="#">#css</a> <a href="#">#responsive</a>
                            <br>
                            <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
                            </div>
                            <div class="field columns">
                              <div class="control column is-half">
                                 <div class="columns">
                                    <div class="column">
                                       <a href="?id_penjual=<?= $id_penjual?>&amp;act=min&amp;id_makanan=<?php echo $m["id_makanan"]?>" class="button is-small is-success"><i class="fas fa-minus-square"></i></a>
                                    </div>
                                    <div class="column is-half">
                                     <input disabled type="number" class="input" name="jumlah" min="1" max="<?= $m["stok"]?>" value="<?php if(!empty($_SESSION["items"][$m["id_makanan"]]) ){ echo $_SESSION["items"][$m["id_makanan"]]["jumlah"]; } else {echo "0";}?>" id="makanan<?= $i;?>">
                                    </div>
                                    <div class="column">
                                       <a href="?id_penjual=<?= $id_penjual?>&amp;act=plus&amp;id_makanan=<?php echo $m["id_makanan"]?>" class="button is-small is-success"><i class="fas fa-plus-square"></i></a>
                                    </div>
                                 </div>
                              </div>
                              <div class="control column is-one-quarter">
                                 <a href="?id_penjual=<?= $id_penjual?>&amp;act=add&amp;id_makanan=<?php echo $m["id_makanan"]?>" class="button is-success">Tambah ke Keranjang</a>
                              </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <!-- End Card Staff -->
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