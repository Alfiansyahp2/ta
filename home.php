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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


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
            <a class="navbar-brand" href="?page="><img src="images/muslimah.jpg" alt="logo-muslimah">Muslimah Bakery</a>
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
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=register">Register</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->

    <section class="slider_section ">
        <div class="slider_bg_box">
            <img src="images/bg.jpg" alt="" style="width: 100%; height: 240%; object-fit: cover;">
        </div>
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="container ">
                    <div class="row">
                        <div class="detail-box" style="margin-top: 100px; ">
                            <h1><span style="color: #f87503; font-size:50px;">Muslimah Bakery</span></h1>
                            <p style="font-size:22px;"><b>Menyediakan berbagai macam roti dan kue dengan</br> harga dan kualitas yang terjamin</b></p>
                            <div class="btn-box" style="margin-top: 30px; color:black;">
                                <a href="index.php?page=register" class="btn" style="background-color : #99CCFF; color:blue;"><b>Beli Sekarang</b></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="col-md-12 mx-auto " style="margin-top:480px">
            <div class="heading_container heading_center">
                <h1>Our <span>Products</span></h1>
                <div class='row'>
    <?php
    $querykatalog = mysqli_query($mysqli, "SELECT kategori.kategori, kue.id_kue, kue.nama_kue, kue.spesifikasi, kue.gambar, kue.harga FROM kategori RIGHT JOIN kue ON kategori.id_kategori = kue.id_kategori WHERE kue.status='on' ORDER BY kue.id_kue DESC LIMIT 8 ") or die(mysqli_error($mysqli));
    while ($rowkatalog = mysqli_fetch_assoc($querykatalog)) {
        echo "<div class='col-lg-3 col-md-6 mb-4'>
            <div class='card h-100'>
                <img class='card-img-top' src='images/kue/{$rowkatalog['gambar']}' alt='gambar'>
                <div class='card-body'>
                    <h4 class='card-title' style='color: blue;'>{$rowkatalog['nama_kue']}</h4>
                    <h5>" . rupiah($rowkatalog['harga']) . "</h5>
                    <p class='card-text'>{$rowkatalog['spesifikasi']}</p>
                </div>
                <div class='card-footer'>
                    <small class='text-muted'><a href='tambah_keranjang.php?id_kue={$rowkatalog['id_kue']}&redirect=home.php' class='btn btn-danger'>+Masukan Keranjang</a></small>
                </div>
            </div>
        </div>";
    }
    ?>
</div>
            </div>
            <?php

            $page = @$_GET['page'];
            $action = @$_GET['action'];
            if ($page == "register") {
                include "register.php";
            } else if ($page == "login") {
                include "login.php";
            } else if ($page == "lupa_pass") {
                include "lupa_pass.php";
            } else if ($page == "edit_user") {
                include "edit_profil.php";
            } else if ($page == "keranjang") {
                include "keranjang.php";
            } else if ($page == "produk") {
                include "produk.php";
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

        </div>

    </div>

    </div>
    <!-- /.container -->

    <!-- Footer -->

    <footer class="py-6 bg-dark" style="margin-top: 50px;">
        <div class="container">
            <div class="row">
                <footer class="ftco-footer ftco-section">
                    <div class="container">
                        <div class="row">
                            <div class="mouse">
                                <a href="#" class="mouse-icon">
                                    <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
                                </a>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md">
                                <div class="ftco-footer-widget mb-4">
                                    <div class="logo_footer">
                                        <h2>Muslimah Bakery</h2></br>
                                        <img width="210" src="images/lg.png" alt="#" style="margin-left: 20px;"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="ftco-footer-widget mb-4 ml-md-5">
                                    <h2 class>Menu</h2></br>
                                    <ul class="list-unstyled">
                                        <li><a href="index.php?page=login" class="py-2 d-block">Login</a></li>
                                        <li><a href="index.php?page=register" class="py-2 d-block">Register</a></li>
                                        <li><a href="home.php" class="py-2 d-block">Home</a></li>
                                        <li><a href="about.php" class="py-2 d-block">About</a></li>
                                        <li><a href="produk.php" class="py-2 d-block">Shop</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="ftco-footer-widget mb-4">
                                    <h2>Silahkan Kirim Pertanyaan Anda</h2>
                                    <div class="block-23 mb-3">
                                        <ul>
                                            <li> <span class="text">
                                                    <b>Outlet 1 :</b>
                                                    <a href="https://maps.app.goo.gl/tp7fdhzzzQ23c2JT8" target="_blank">
                                                        Jl. Supriadi No.131, Jawaan, Patemon, Kec. Pakusari, Kabupaten Jember, Jawa Timur 68181
                                                    </a>
                                                    <br>
                                                    <b>Outlet 2 :</b>
                                                    <a href="https://maps.app.goo.gl/baCbeaBMveUYjie69" target="_blank">
                                                        Jl. KH Shiddiq No.44, Kelurahan Jember Kidu, Jember Kidul, Kec. Kaliwates, Kabupaten Jember, Jawa Timur 68131
                                                    </a>
                                                </span></li>
                                            <li><a href="https://wa.me/6281235561662"><span class="text">+62 812-3556-1662</span></a></li>
                                            <li><a href="mailto:muslimahbakery24@gmail.com"><span class="text">Muslimahbakery24@gmail.com</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                </footer>


                <script src="datatables/datatables.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#datatables').DataTable();
                    });
                </script>

</body>

</html>