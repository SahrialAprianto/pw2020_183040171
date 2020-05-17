<?php 
usleep(500000);
require '../functions.php';
$keyword = $_GET["keyword"];

$query = "SELECT * FROM film 
			WHERE
			judul LIKE '%$keyword%' OR
			penonton LIKE '%$keyword%' OR
			produksi LIKE '%$keyword%' OR
			tahun LIKE '%$keyword%' OR
			sutradara LIKE '%$keyword%'";
$film = query($query);


 ?>

 <table border="1" cellpadding="10" cellspacing="0">
		<tr>
			<th>No.</th>
			<th>Judul</th>
			<th>Penonton</th>
			<th>Produksi</th>
			<th>Tahun</th>
			<th>Sutradara</th>
			<th>Gambar</th>
			<th>Aksi</th>
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
			<td>
				<a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> |
				<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin')">Hapus</a>
			</td>
		</tr>


	<?php $i++; ?>
	<?php endforeach; ?>
		
	</table>