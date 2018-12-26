<?php 
session_start();

require 'functions.php';

    if ($_SESSION["login"]) {
        if(isset($_SESSION["user"]) && $_SESSION["user"] == "petugas"){
            $id_karyawan = $_SESSION["id_karyawan"];
            $result = mysqli_query($conn, "SELECT * FROM karyawan WHERE id_karyawan = '$id_karyawan'");

            $id_karyawan = mysqli_fetch_assoc($result);

            $meja = query("SELECT * FROM meja");
        } else {
            header("Location: login.php");
        }

    } else {
        header("Location: login.php");
    }

?>


<html lang="en">

<?php include 'assets/html/head-penjual.html'?>

<body>

    <?php include 'assets/html/nav-penjual.html'?>

    <div class="container">
        <div class="section">
            <!-- Staff -->
            <div class="row columns is-multiline">
                <?php foreach ($meja as $m) : ?>
                <div class="column is-one-qurter">
                    <div class="card" style="border-radius: 0.35rem">
                        <div class="card-image">
                            <figure class="image is-4by3">
                              <?php if ($m["status"] == "tersedia") :?>
                                 <img class="foto-toko" src="assets/img/meja/Red.svg" alt="Placeholder image" style="border-radius: 1rem; padding: 0.5rem">
                                 <!-- <div style="background-color: blue; width:100px; height: 100px; position: fixed" ></div> -->
                              <?php else :?>  
                                 <!-- <img class="foto-toko" src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image" style="border-radius: 1rem; padding: 0.5rem"> -->
                                 <!-- <div class="foto-toko" style="background-color: red"></div> -->
                              <?php endif;?>
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="media">
                            <div class="media-content">
                                <p class="title is-4"><?= $m["id_meja"]?></a></p>
                                <p class="subtitle is-6">Status : <?= $m["status"]?></p>
                            </div>
                            </div>

                            <div class="content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Phasellus nec iaculis mauris. <a>@bulmaio</a>.
                            <a href="#">#css</a> <a href="#">#responsive</a>
                            <br>
                            <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
                            </div>
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