<?php 
session_start();

if ( !isset($_SESSION["login"])) {
	header("location: login.php");
	exit;
}

require 'functions.php';

// pagination

// $jumlahDataPerhalaman = 3;
// $jumlahData = count(query("SELECT * FROM film"));
// $jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);

// $halamanAktif = ( isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
// $awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;





// $film = query("SELECT * FROM film LIMIT $awalData, $jumlahDataPerhalaman");

$film = query("SELECT * FROM film ");

if( isset($_POST["cari"]) ) {
	$film = cari($_POST["keyword"]);
}


 ?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>Halaman Admin</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">

	<style>
		.loader {
	width: 100px;
	position: absolute;
	top: 125px;
	left: 800px;
	z-index: -1;
	display: none;

}

@media print {
	.logout, .tambah, .form-cari, .aksi {
		display: none;


	}
}
	</style>
	
	<script src="js/jquery-3.4.0.min.js"></script>
	<script src="js/script.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Film Indonesia</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="user.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tambah.php">Tambah Data Film</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cetak.php">Cetak</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
  </div>
</nav>
	<!-- End navbar -->
	

	<!-- <a href="logout.php" class="logout">Logout</a> | <a href="cetak.php" target="_blank">Cetak</a> -->

	<h1 align="center">Elektronik</h1>
	<!-- <a href="tambah.php" class="tambah">Tambah Referensi Film</a> -->
	<br><br>

	<form action="" method="post" class="form-cari" align="center">

		<input type="text" name="keyword" size="40" autofocus placeholder="masukkan pencarian.." autocomplete="off" id="keyword">
		<button type="submit" name="cari" id="tombol-cari">Cari!</button>

		<img src="img/bb.gif" class="loader">
		
	</form>

	<br>

	<!-- <?php if( $halamanAktif > 1) : ?>

	<a href="?halaman=<?= $halamanAktif - 1 ?>">&laquo</a>
	<?php endif; ?>

	<?php for($i =1; $i<= $jumlahHalaman; $i++) : ?>
		<?php if( $i == $halamanAktif ) : ?>

		<a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: darkblue;"><?= $i; ?></a>
		<?php else : ?>
			<a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
		<?php endif; ?>
	<?php endfor; ?>

	<?php if( $halamanAktif < $jumlahHalaman) : ?>

	<a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo</a>
	<?php endif; ?>
 -->
	<!-- <br> -->

<div id="container" align="center">
	<table border="1" cellpadding="10" cellspacing="0">
		<tr>
			<th>No.</th>
			<th>Judul</th>
			<th>Penonton</th>
			<th>Produksi</th>
			<th>Tahun</th>
			<th>Sutradara</th>
			<th>Gambar</th>
			<th class="aksi">Aksi</th>
		</tr>

		<?php $i = 1; ?>

		<?php foreach( $film as $row ) : ?>

		<tr>
			<td><?= $i; ?></td>
			<td><?= $row["judul"] ?></td>
			<td><?= $row["penonton"] ?></td>
			<td><?= $row["produksi"] ?></td>
			<td><?= $row["tahun"] ?></td>
			<td><?= $row["sutradara"] ?></td>
			<td>
				<img src="img/<?= $row["gambar"]; ?>" width="60">
			</td>
			<td class="aksi">
				<a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> |
				<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin')">Hapus</a>
			</td>
		</tr>


	<?php $i++; ?>
	<?php endforeach; ?>
		
	</table>
	</div>

	
	
</body>
</html>