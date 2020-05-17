<?php

require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';
$film = query("SELECT * FROM film ");


$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Daftar Film Indonesia</title>
<link rel="stylesheet" href="css/print.css">

</head>
<body>
	<h1>Daftar Film Indonesia</h1>
	<table border="1" cellpadding="10" cellspacing="0">
		<tr>
			<th>No.</th>
			<th>Judul</th>
			<th>Penonton</th>
			<th>Produksi</th>
			<th>Tahun</th>
			<th>Sutradara</th>
			<th>Gambar</th>
			
		</tr>';

		$i = 1;
		foreach ( $film as $row ) {
			$html .= '<tr>
				<td>'. $i++ .'</td>
				<td>'. $row["judul"] .'</td>
				<td>'. $row["penonton"] .'</td>
				<td>'. $row["produksi"] .'</td>
				<td>'. $row["tahun"] .'</td>
				<td>'. $row["sutradara"] .'</td>
				<td><img src="img/'. $row["gambar"] .'" width="50"></td>
			</tr>';
		}

$html .= '</table>

</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output('daftar-film.pdf', 'I');


?>
