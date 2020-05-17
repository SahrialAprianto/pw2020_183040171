<?php 
session_start();

require 'functions.php';

if ( isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	$result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	if ( $key === hash('sha256', $row['username']) ) {
		$_SESSION['login'] = true;
	}

}

if ( isset($_SESSION["login"])) {
	header("location: admin.php");
	exit;
}



if ( isset($_POST["login"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	if( mysqli_num_rows($result) === 1 ) {

		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["password"]) ) {

			$_SESSION["login"] = true;



			if ( isset($_POST['remember'])) {
				setcookie('id', $row['id'], time() + 60);
				setcookie('key', hash('sha256', $row['username']), time() + 60);
			}

			header("location: admin.php");
			exit;
		}
	}

	$error = true;

}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<style>
		body {
			background-color: white;
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
	<h1>Silahkan Login</h1>
			<div class="logo">
				<img src="img/k.png">
			</div>
	

	<?php if ( isset($error) ) : ?>
		<p style="color: darkblue; font-style: italic;">username / password salah</p>
	<?php endif; ?>

	<form action="" method="post">
		<!-- <ul>
			<li> -->
				<label for="username">Username : </label>
				<input type="text" name="username" id="username" class="use"> <br>
			<!-- </li>
			<li> -->
				<label for="password" class="pas">Password : </label>
				<input type="password" name="password" id="password" class="use"> <br>
			<!-- </li>
			<li> -->
				<input type="checkbox" name="remember" id="remember" >
				<label for="remember" >Remember Me </label><br>

			<a href="registrasi.php" class="register">Register</a><br>
			<!-- </li>
			<li> -->
				<button type="submit" name="login" class="sub">Login</button>
			<!-- </li>
		</ul> -->
	</form>
	</div>
</body>
</html>