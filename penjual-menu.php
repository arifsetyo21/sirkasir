<?php 

session_start();

require 'functions.php';

if ($_SESSION["login"]) {
	$username = $_SESSION["username"];
	$result = query("SELECT id_penjual FROM penjual WHERE username = '$username'")[0];
	$id_penjual = $result["id_penjual"];
	$makanan = query("SELECT * FROM makanan WHERE id_penjual = '$id_penjual'");
}

 ?>

 <!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	 <link rel="stylesheet" href="assets/css/bulma.min.css" />
 <script defer src="assets/js/all.js"></script>
 <script type="text/javascript" src="assets/js/script.js"></script>
</head>
<body>
	<nav class="navbar is-light" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="https://bulma.io">
      <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
    </a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary">
            <strong>Home</strong>
          </a>
          <a class="button is-light" href="penjual-menu.php">
            Edit
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>
<div class="hero">
	<div class="container">
		<h1 class="title">Daftar Makanan</h1>
		<?php foreach ($makanan as $m) :?>
		<div class="box">
		  <article class="media">
		    <div class="media-left">
		      <figure class="image is-64x64">
		        <img src="https://bulma.io/images/placeholders/128x128.png" alt="Image">
		      </figure>
		    </div>
		    <div class="media-content">
		      <div class="content">
		        <p>
		          <strong><?= $m["nama"]?></strong>
		          <p>Harga : <?= $m["harga"] ?></p>
		          <p>Stok : <?= $m["stok"] ?></p>
		        </p>
		      </div>
		    </div>
			    <div class="buttons">
		          <a class="button is-light" onclick="editMenu()">
		            Edit
		          </a>
	        </div>
		  </article>
		</div>
		<?php endforeach; ?>
	</div>
	<div class="modal" id="modalTer">
	  <div class="modal-background"></div>
	  <div class="modal-content">
	    <!-- Any other Bulma elements you want -->
	  </div>
	  <button class="modal-close is-large" aria-label="close"></button>
	</div>
</div>
</body>
</html>