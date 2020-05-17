<?php 
session_start();

if ( !isset($_SESSION["login"])) {
	header("location: login.php");
	exit;
}
require 'functions.php';

$id = $_GET["id"];

$flm = query("SELECT * FROM film WHERE id = $id") [0];


if ( isset($_POST["submit"]) ) {


	if( ubah($_POST) > 0 ) {
		echo "
		<script>
			alert('Data berhasil diubah');
			document.location.href = 'index.php';
		</script>
		";
	} else {
		echo "
		<script>
			alert('Data gagal diubah');
			document.location.href = 'index.php';
		</script>
		";
	}
	

	
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Data Film</title>
</head>
<body>
	<h1>Edit Data Film</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $flm["id"]; ?>">
		<input type="hidden" name="gambarLama" value="<?= $flm["gambar"]; ?>">
		<ul>
			<li>
				<label for="judul">Judul Film : </label>
				<input type="text" name="judul" required value="<?= $flm["judul"];  ?>">
			</li>
			<li>
				<label for="penonton">Jumlah Penonton : </label>
				<input type="text" name="penonton" value="<?= $flm["penonton"];  ?>">
			</li>
			<li>
				<label for="produksi">Produksi : </label>
				<input type="text" name="produksi" value="<?= $flm["produksi"];  ?>">
			</li>
			<li>
				<label for="tahun">Tahun : </label>
				<input type="text" name="tahun" value="<?= $flm["tahun"];  ?>">
			</li>
			<li>
				<label for="sutradara">Sutradara : </label>
				<input type="text" name="sutradara" value="<?= $flm["sutradara"];  ?>">
			</li>
			<li>
				<label for="gambar">Gambar : </label><br>
				<img src="img/<?= $flm["gambar"];  ?>" width= '50'> <br>
				<input type="file" name="gambar">
			</li>
			<li>
				<button type="submit" name="submit">Edit Data</button>
			</li>
		</ul>
		
	</form>

</body>
</html>