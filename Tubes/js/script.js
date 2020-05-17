$(document).ready(function() {
	// hilangkan tombol-cari
	$('#tombol-cari').hide();


// event keyword ditulis
$('#keyword').on('keyup', function() {
	// muncul loding
	$('.loader').show();

	// ajax load
// 	$('#container').load('ajax/film.php?keyword=' + $('#keyword').val());

// get
$.get('ajax/film.php?keyword=' + $('#keyword').val(), function(data) {

	$('#container').html(data);
	$('.loader').hide();

});

});

});







// var keyword = document.getElementById('keyword');
// var tombolcari = document.getElementById('tombol-cari');
// var container = document.getElementById('container');

// keyword.addEventListener('keyup', function() {
	
// 	// buat ajax
// 	var xhr =  new XMLHttpRequest();
// 	// cek ajax
// 	xhr.onreadystatechange = function() {
// 		if ( xhr.readyState == 4 && xhr.status == 200 ) {
// 			container.innerHTML = xhr.responseText;
// 		}
// 	}
// // eksekusi ajax
// xhr.open('GET', 'ajax/film.php?keyword=' + keyword.value, true);
// xhr.send();

// });
