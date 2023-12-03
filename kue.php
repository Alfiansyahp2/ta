<?php

session_start();
include "koneksi.php";
include "function.php";
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
$level = isset($_SESSION['level']) ? $_SESSION['level'] : false;
$keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : array();
$totalbarang = count($keranjang);
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Muslimah Bakery</title>

	<!-- Bootstrap core CSS -->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/shop-homepage.css" rel="stylesheet">
	<link href="css/banner.css" rel="stylesheet">
	<link href="css/index.css" rel="stylesheet">
	<link href="datatables/datatables.min.css" rel="stylesheet">
	<script src="vendor/jquery/jquery-3.1.1.min.js" rel="stylesheet"></script>
	<script src="vendor/bootstrap/js/bootstrap.js" rel="stylesheet"></script>
	<script src="vendor/jquery/jquery.slides.min.js" rel="stylesheet"></script>


</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="?page="><img src="images/muslimah.jpg" alt="muslimah">Muslimah Bakery</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<?php

					if ($totalbarang != 0) {
						echo "<h5 style='color:white; position:absolute; margin-left:30px;'>$totalbarang</h5>";
					}

					?>
					<li class="nav-item">
						<a class="navbar-brand" href="index.php?page=keranjang"><img src="images/cart.png" alt="logo-cart" style="background-color:red; padding:2px 10px; border-radius:3px;"></a>
					</li>

					<?php
					if ($user_id) { ?>
						<li class="nav-item">
							<a class="nav-link" href="index.php">Home</a>
						</li>
						<li class="dropdown">
							<a class="nav-link" href="produk.php">Produk</a>
							<ul>
								<li><a href="roti.php">Roti</a></li>
								<li><a href="donat.php">Donat</a></li>
								<li><a href="kue.php">Kue Tart</a></li>
						</li>
				</ul>
				<li class="nav-item">
							<a class="nav-link" href="about.php">About Us</a>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Logout</a>
				</li>

			<?php
					} else {
			?>

				<li class="nav-item">
					<a class="nav-link" href="home.php">Home</a>

				</li>
			<?php
					}
			?>
			</ul>
			</div>
		</div>
	</nav>
	<!-- Page Content -->
	<div class="container">
		</br><br>
		<h1>KUE TART</h1></br>

		<div class="row">
			<?php

			$page = @$_GET['page'];
			$action = @$_GET['action'];

			if ($page == "keranjang") {
				include "keranjang.php";
			} else if ($page == "data_pemesan") {
				include "data_pemesan.php";
			} else if ($page == "pesanan") {
				if ($action == "") {
					include "module/pesanan/list_pesanan.php";
				} else if ($action == "detail") {
					include "module/pesanan/detail.php";
				} else if ($action == "konfirmasi_pembayaran") {
					include "module/pesanan/konfirmasi_pembayaran.php";
				}
			}

			?>
			<div class="col-lg-12" ;>


				<div class='row'>
					<?php
					$querydonat = mysqli_query($mysqli, "SELECT kategori.kategori, kue.id_kue, kue.nama_kue, kue.spesifikasi, kue.gambar, kue.harga FROM kategori RIGHT JOIN kue ON kategori.id_kategori = kue.id_kategori WHERE kategori='kue_tart' AND kue.status='on'  ORDER BY kue.id_kue DESC; ") or die(mysqli_error($mysqli));
					while ($rowkatalog = mysqli_fetch_assoc($querydonat)) {
						echo "<div class='col-lg-3 col-md-6 mb-4'>
            <div class='card h-100'>
                <img class='card-img-top' src='images/kue/{$rowkatalog['gambar']}' alt='gambar'>
                <div class='card-body'>
                    <h4 class='card-title' style='color: blue;'>{$rowkatalog['nama_kue']}</h4>
                    <h5>" . rupiah($rowkatalog['harga']) . "</h5>
                    <p class='card-text'>{$rowkatalog['spesifikasi']}</p>
                </div>
                <div class='card-footer'>
                    <small class='text-muted'><a href='tambah_keranjang.php?id_kue={$rowkatalog['id_kue']}&redirect=kue.php' class='btn btn-danger'>+Masukan Keranjang</a></small>
                </div>
            </div>
        </div>";
					}

					?>
				</div>

			</div>

		</div>

	</div>

	<!-- Footer -->

	
	<footer class="py-5 bg-dark">
		<div class="container">
			<p class="m-0 text-center text-white">Muslimah Bakery &copy;</p>
		</div>
		<!-- /.container -->
	</footer>

	<script src="datatables/datatables.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#datatables').DataTable();
		});
	</script>
</body>

</html>