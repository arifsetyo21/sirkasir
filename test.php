<?php 

require 'functions.php';

if ($hasil = query("SELECT * FROM karyawan")) {
	$hasils[] =  $hasil;

	var_dump($hasils);
}

 ?>