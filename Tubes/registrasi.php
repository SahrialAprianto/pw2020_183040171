<?php 
require 'functions.php';

if ( isset($_POST["register"]) ) {
	if ( registrasi($_POST) > 0 ) {
		echo "<script>
				alert('user baru berhasil ditambah');
			  </script>";
	} else {
		echo mysqli_error($conn);
	}
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman regis</title>
	<style>
		label {
			display: block;
		}
		body {
			background-color: black;
		}
		p {
			color: red;
			font-style: italic;
		}
		img {
			border-radius: 50%;
		}
		.container {
			position: relative;
			top: 90px;
			margin: auto;
			width: 400px;
			height: 450px;
			background-color: grey;
			text-align: center;
			border-radius: 50px;
			padding-top: 20px;
		}
		.pas {
			padding-left: 3px;
		}
		.use {
			margin: 7px;
			padding: 3px;
			padding-right: 30px;
		}
		button {
			margin-right: 240px;
		}
		label {
			font-style: italic;
		}
		h1 {
			font-family: serif;
		}
	</style>
</head>
<body>
	<div class="container">

	<h1>Halaman Registrasi</h1> 

	<form action="" method="post">
		<!-- <ul> -->
			<!-- <li> -->
				<label for="username">username : </label>
				<input type="text" name="username" id="username" class="use">
			<!-- </li> -->
			<!-- <li> -->
				<label for="password">password : </label>
				<input type="password" name="password" id="password" class="use">
			<!-- </li> -->
			<!-- <li> -->
				<label for="password2">konfirmasi password : </label>
				<input type="password" name="password2" id="password2" class="use">
			<!-- </li> -->
			<!-- <li> -->
				<button type="submit" name="register" class="sub">Register!</button>
			<!-- </li> -->
		<!-- </ul> -->
		
	</form>
	</div>

</body>
</html>