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
	<title>Halaman Admin</title>
	<style>
		.loader {
	width: 100px;
	position: absolute;
	top: 105px;
	left: 300px;
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


	

	<a href="logout.php" class="logout">Logout</a> | <a href="cetak.php" target="_blank">Cetak</a>

	<h1>Daftar Film Indonesia</h1>
	<a href="tambah.php" class="tambah">Tambah Referensi Film</a>
	<br><br>

	<form action="" method="post" class="form-cari">

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

<div id="container">
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