<?php
session_start();

if ( !isset($_SESSION["login"])) {
	header("location: login.php");
	exit;
}
require 'functions.php';

if ( isset($_POST["submit"]) ) {

	


	if( tambah($_POST) > 0 ) {
		echo "
		<script>
			alert('Data berhasil ditambahkan');
			document.location.href = 'index.php';
		</script>
		";
	} else {
		echo "
		<script>
		alert('Data gagal ditambahkan');
		document.location.href = 'index.php';
		</script>
		";
	}
	

	
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Film</title>
</head>
<body>
	<h1>Tambah Data Film</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<ul>
			<li>
				<label for="judul">Judul Film : </label>
				<input type="text" name="judul" required>
			</li>
			<li>
				<label for="penonton">Jumlah Penonton : </label>
				<input type="text" name="penonton">
			</li>
			<li>
				<label for="produksi">Produksi : </label>
				<input type="text" name="produksi">
			</li>
			<li>
				<label for="tahun">Tahun : </label>
				<input type="text" name="tahun">
			</li>
			<li>
				<label for="sutradara">Sutradara : </label>
				<input type="text" name="sutradara">
			</li>
			<li>
				<label for="gambar">Gambar : </label>
				<input type="file" name="gambar">
			</li>
			<li>
				<button type="submit" name="submit">Tambah Data</button>
			</li>
		</ul>
		
	</form>

</body>
</html>