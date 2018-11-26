<?php 
session_start();

if ($_SESSION["login"]) {
	$username = $_SESSION["username"];
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	 <link rel="stylesheet" href="assets/css/bulma.min.css" />
 <script defer src="assets/js/all.js"></script>
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
      	<p><?= $username; ?></p>
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
	<table class="table is-striped">
		<thead>
			<th>No.</th>
			<th>Makanan</th>
			<th>Jumlah</th>
			<th>No Meja</th>
			<th>Aksi</th>
		</thead>
		<tbody>
			<tr>
				<td>1.</td>
				<td>Soto Ayam</td>
				<td>12</td>
				<td>002</td>
				<td>
					<a class="button is-primary"><strong>Antar<strong></a>
					<a class="button is-primary"><strong>Batal<strong></a>
				</td>
			</tr>
			<tr>
				<td>2.</td>
				<td>Soto Kambing</td>
				<td>10</td>
				<td>003</td>
				<td>
					<a class="button is-primary"><strong>Antar<strong></a>
					<a class="button is-primary"><strong>Batal<strong></a>
				</td>
			</tr>
		</tbody>
	</table>
</div>
</body>
</html>