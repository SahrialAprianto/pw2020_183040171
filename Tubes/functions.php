<?php 
$conn = mysqli_connect("localhost", "root", "", "tubes");


function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ){
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data) {
	global $conn;
	$judul = htmlspecialchars($data["judul"]);
	$penonton = htmlspecialchars($data["penonton"]);
	$produksi = htmlspecialchars($data["produksi"]);
	$tahun = htmlspecialchars($data["tahun"]);
	$sutradara = htmlspecialchars($data["sutradara"]);

	// upload gambar
	$gambar = upload();
	if( !$gambar) {
		return false;
	}

	$query = "INSERT INTO film VALUES ('', '$judul', '$penonton', '$produksi', '$tahun', '$sutradara', '$gambar')";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function upload() {

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah tdk ada gambar di upload
	if ( $error === 4) {
		echo "<script>
			alert('pilih gambar terlebih dahulu');
			</script>";
			return false;
	}

	// cek apakah yg diupload
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if ( !in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "
		<script>
			alert('yang anda upload bukan gambar!');
		</script>";
		return false;
	}

	// cek jika ukuran besar
	if( $ukuranFile > 1000000) {
		echo "
		<script>
			alert('ukuran gambar terlalu besar!');
		</script>";

		return false;
	}

	// lolos gambar

	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;
	

	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
	return $namaFileBaru;

}



function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM film WHERE id =  $id");
	return mysqli_affected_rows($conn);
}

function ubah($data) {
	global $conn;

	$id = $data["id"];
	$judul = htmlspecialchars($data["judul"]);
	$penonton = htmlspecialchars($data["penonton"]);
	$produksi = htmlspecialchars($data["produksi"]);
	$tahun = htmlspecialchars($data["tahun"]);
	$sutradara = htmlspecialchars($data["sutradara"]);

	$gambarLama = htmlspecialchars($data["gambarLama"]);

	if ( $_FILES['gambar']['error'] === 4) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}

	

	$query = "UPDATE film SET
				judul = '$judul',
				penonton = '$penonton',
				produksi = '$produksi',
				tahun = '$tahun',
				sutradara = '$sutradara',
				gambar = '$gambar'
				WHERE id = $id
				";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function cari($keyword) {
	$query = "SELECT * FROM film WHERE
			judul LIKE '%$keyword%' OR
			penonton LIKE '%$keyword%' OR
			produksi LIKE '%$keyword%' OR
			tahun LIKE '%$keyword%' OR
			sutradara LIKE '%$keyword%'";
			return query($query);
}

function registrasi($data) {
	global $conn;

	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);


	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
	if ( mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('username  sudah terdaftar');
			  </script>";
			  return false;
	}



	if ( $password !== $password2 ) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
			  </script>";
		return false;
	}

	// amankan password
	$password = password_hash($password, PASSWORD_DEFAULT);
	
	mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

	return mysqli_affected_rows($conn);

}



 
 ?>