<?php 
session_start();

require 'functions.php';

if ($_SESSION["login"]) {

$id_pelanggan = $_SESSION["id_pelanggan"];
$result = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");

$pembeli = mysqli_fetch_assoc($result);

} else {
  header("Location: login-pembeli.php");
}

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>bulma cards</title>
    <link rel="shortcut icon" href="../images/fav_icon.png" type="image/x-icon">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.css'>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/card-dashboard-pembeli.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script defer src="assets/js/all.js"></script>
    <style type="text/css">
        .nama {
            margin-right: 10px; 
        }
    </style>
</head>

<body>

        <!-- START NAV -->
        <section class="is-fullwidth">

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
    <a class="nama" href="">Selamat Datang, <?= $pembeli["nama"] ?></a>
    <a class="button is-danger" href="functionLogout.php">Logout</a>
   </div>
  </div>
 </div>

</nav>

</section>
            <!-- END NAV -->

    <div class="container">
        <div class="section">
            
            <!-- Developers -->
            <div class="row columns">
                <div class="column is-mobile">
                    <div class="card ">
                        <div class="card-image">
                            <figure class="image">
                                <img src="https://images.unsplash.com/photo-1475778057357-d35f37fa89dd?dpr=1&auto=compress,format&fit=crop&w=1920&h=&q=80&cs=tinysrgb&crop=" alt="Image">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="media">
                                <div class="media-content">
                                    <p class="title is-4 no-padding">Okinami</p>
                                    <p><span class="title is-6"><a href="http://twitter.com/#">@twitterid</a></span></p>
                                    <div class="content">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum consequatur numquam aliquam tenetur ad amet inventore hic beatae
                                <div class="background-icon"><span class="icon-barcode"></span></div>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card ">
                        <div class="card-image">
                            <figure class="image">
                                <img src="https://source.unsplash.com/uzDLtlPY8kQ" alt="Image">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="media">
                                <div class="media-content">
                                    <p class="title is-4 no-padding">McSocks</p>
                                    <p><span class="title is-6"><a href="http://twitter.com/#">@twitterid</a></span></p>
                                </div>
                            </div>
                            <div class="content">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum consequatur numquam aliquam tenetur ad amet inventore hic beatae
                                <div class="background-icon"><span class="icon-barcode"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card ">
                        <div class="card-image">
                            <figure class="image">
                                <img src="https://source.unsplash.com/uzDLtlPY8kQ" alt="Image">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="media">
                                <div class="media-content">
                                    <p class="title is-4 no-padding">McSocks</p>
                                    <p><span class="title is-6"><a href="http://twitter.com/#">@twitterid</a></span></p>
                                </div>
                            </div>
                            <div class="content">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum consequatur numquam aliquam tenetur ad amet inventore hic beatae
                                <div class="background-icon"><span class="icon-barcode"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- End Developers -->
        </div>
    </div>

            <script src="assets/js/bulma.js"></script>


</body>

</html>