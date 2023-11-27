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

<!-- About Section -->
  <section id="about">
    <div class="about container">
      <div class="col-right">
      <h1 class="section-title">ABOUT<span> US</span></h1>
        <h2>MUSLIMAH BAKERY</h2>
        <p style="text-align: justify;">Sejak awal karirnya di industri roti pada tahun 1999, Bapak Selamet 
        telah merintis perjalanan yang memikat dalam dunia kuliner. Pada tahun 2001, visinya mengukuhkan diri 
        dalam sebuah toko roti yang berfokus pada kualitas dan keunikan, lahir dalam wujud Muslimah Bakery. 
        Dengan semangat yang menggebu-gebu, kami menawarkan kemudahan pemesanan melalui Whatsapp dan layanan 
        kunjungan langsung ke toko untuk mendapatkan produk kami. Namun, kami juga telah memperluas jangkauan 
        kami dengan kehadiran online melalui website, memastikan pengalaman belanja yang lebih mudah dan menyenangkan. 
        Pembayaran juga dapat dilakukan secara aman dan mudah melalui transfer, memberikan kemudahan bagi setiap 
        pelanggan kami.
        
        Kami di Muslimah Bakery tidak hanya menawarkan produk, tetapi juga pengalaman yang istimewa dalam setiap 
        hidangan roti kami. Keberadaan kami tak hanya berfungsi sebagai toko, tetapi sebagai rumah bagi kreativitas 
        dan cita rasa yang tak terlupakan. Dengan didukung oleh inovasi teknologi, kini setiap produk kami dapat 
        diakses dan dipesan melalui website kami, serta memberikan kenyamanan tanpa batas bagi pelanggan kami. Kami 
        berkomitmen untuk terus berinovasi demi memberikan yang terbaik bagi Anda, menciptakan pengalaman berbelanja 
        roti yang tak terlupakan di Muslimah Bakery.</p>
      </div>
    </div>
  </section>
  <!-- End About Section -->
          
  
  <!-- Contact Section -->
  <section id="contact">
    <div class="contact container">
      <div>
        <center><h1 class="section-title">INFORMASI<span> KONTAK</span></h1></center>
      </div>
      <div class="contact-items">
        <div class="contact-item">
          <div class="icon"> <a href="https://wa.me/6281235561662"> <img
                src="https://img.icons8.com/bubbles/100/000000/phone.png" /></a></div>
          <div class="contact-info">
            <h1>Phone</h1>
            <h2>+62 812-3556-1662</h2>
          </div>
        </div>
        <div class="contact-item">
          <div class="icon"><a href="mailto:muslimahbakery24@gmail.com"><img
                src="https://img.icons8.com/bubbles/100/000000/new-post.png" /></a></div>
          <div class="contact-info">
            <h1>Email</h1>
            <h2>muslimahbakery24@gmail.com</h2>
          </div>
        </div>
        <div class="contact-item">
          <div class="icon"> <a href="https://maps.app.goo.gl/tp7fdhzzzQ23c2JT8"><img
                src="https://img.icons8.com/bubbles/100/000000/map-marker.png" /></a></div>
          <div class="contact-info">
            <h1>Alamat</h1>
            <h2>Jl. Supriadi No.131, Jawaan, Patemon, Kec. Pakusari, Kabupaten Jember, Jawa Timur 68181</h2>
          </div>
        </div>
      </div>
    </div>
    
  </section>
</body>
</html>
