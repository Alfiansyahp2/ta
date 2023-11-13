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
                        <a class="navbar-brand" href="?page=keranjang"><img src="images/cart.png" alt="logo-cart" style="background-color:red; padding:2px 10px; border-radius:3px;"></a>
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
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>

            <?php
                    } else {
            ?>
                <!--<li class="nav-item">
				<a class="nav-link" href="?page=login">Login</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="?page=register">Register</a>
			</li>-->
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



    <div class="col-lg-9" style="margin:30px auto;">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img class="card-img-top" src="images/produk/kue1.png" alt="gambar">
                    <div class="card-body">
                        <h4 class="card-title" style="color: blue;">Kue Tart</h4>
                        <h5>Rp. 50.000</h5>
                        <p class="card-text"></p>
                        <p>ukuran 25x25</p>
                        <p></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><a href="tambah_keranjang.php?id_kue=6" class="btn btn-danger">+Masukan Keranjang</a></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img class="card-img-top" src="images/kue/promo3.jpg" alt="gambar">
                    <div class="card-body">
                        <h4 class="card-title" style="color: blue;">red velvet cake</h4>
                        <h5>Rp,235,000</h5>
                        <p class="card-text"></p>
                        <p>ada yang masukin admin</p>
                        <p></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><a href="tambah_keranjang.php?id_kue=3" class="btn btn-danger">+Masukan Keranjang</a></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img class="card-img-top" src="images/kue/promo1.jpg" alt="gambar">
                    <div class="card-body">
                        <h4 class="card-title" style="color: blue;">american chocolate cake</h4>
                        <h5>Rp,210,000</h5>
                        <p class="card-text"></p>
                        <p>di edit oleh admin</p>
                        <p></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><a href="tambah_keranjang.php?id_kue=2" class="btn btn-danger">+Masukan Keranjang</a></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img class="card-img-top" src="images/kue/promo9.jpg" alt="gambar">
                    <div class="card-body">
                        <h4 class="card-title" style="color: blue;">green tea cake</h4>
                        <h5>Rp,225,000</h5>
                        <p class="card-text"></p>
                        <p>admin yang masukin</p>
                        <p></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><a href="tambah_keranjang.php?id_kue=8" class="btn btn-danger">+Masukan Keranjang</a></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img class="card-img-top" src="images/kue/promo5.jpg" alt="gambar">
                    <div class="card-body">
                        <h4 class="card-title" style="color: blue;">summer fruit cake</h4>
                        <h5>Rp,230,000</h5>
                        <p class="card-text"></p>
                        <p>admin yang masukin</p>
                        <p></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><a href="tambah_keranjang.php?id_kue=5" class="btn btn-danger">+Masukan Keranjang</a></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img class="card-img-top" src="images/kue/promo11.jpg" alt="gambar">
                    <div class="card-body">
                        <h4 class="card-title" style="color: blue;">Black Forest Cake</h4>
                        <h5>Rp,210,000</h5>
                        <p class="card-text"></p>
                        <p>admin yang masukin</p>
                        <p></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><a href="tambah_keranjang.php?id_kue=10" class="btn btn-danger">+Masukan Keranjang</a></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img class="card-img-top" src="images/kue/promo4.jpg" alt="gambar">
                    <div class="card-body">
                        <h4 class="card-title" style="color: blue;">praline cake</h4>
                        <h5>Rp,245,000</h5>
                        <p class="card-text"></p>
                        <p>admin yang masukin</p>
                        <p></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><a href="tambah_keranjang.php?id_kue=4" class="btn btn-danger">+Masukan Keranjang</a></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img class="card-img-top" src="images/kue/promo7.jpg" alt="gambar">
                    <div class="card-body">
                        <h4 class="card-title" style="color: blue;">opera cake</h4>
                        <h5>Rp,225,000</h5>
                        <p class="card-text"></p>
                        <p>admin yang masukin</p>
                        <p></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><a href="tambah_keranjang.php?id_kue=7" class="btn btn-danger">+Masukan Keranjang</a></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img class="card-img-top" src="images/kue/promo10.jpg" alt="gambar">
                    <div class="card-body">
                        <h4 class="card-title" style="color: blue;">Triple Cake</h4>
                        <h5>Rp,225,000</h5>
                        <p class="card-text"></p>
                        <p>admin yang masukin</p>
                        <p></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><a href="tambah_keranjang.php?id_kue=9" class="btn btn-danger">+Masukan Keranjang</a></small>
                    </div>
                </div>
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
        } else if ($page == "data_pemesan") {
            include "data_pemesan.php";
        } else if ($page == "pesanan") {
            if ($action == "") {
                include "module/pesanan/list_pesanan.php";
            } else if ($action == "detail") {
                include "module/pesanan/detail.php";
            } else if ($action == "konfirmasi_pembayaran") {
                include "module/pesanan/konfirmasi_pembayaran.php";
            } else if ($action == "design") {
                include "module/pesanan/design.php";
            }
        } else {
            include "slides.php";
        }

        ?>

    </div>

    </div>

    </div>
    <!-- /.container -->

    <!-- Footer -->

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#contohModalKecil">Kirim
        Pesan</button>
    <div class="modal fade" id="contohModalKecil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding-top:600px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <?php include "chat.php"; ?>
            </div>
        </div>
    </div>
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