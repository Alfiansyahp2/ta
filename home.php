<?php
include "koneksi.php";
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
$level = isset($_SESSION['level']) ? $_SESSION['level'] : false;
$keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : array();
$totalbarang = count($keranjang);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ... Your meta tags, title, CSS, and JavaScript imports ... -->
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

                    <!-- ... Your navigation code ... -->
                    <li class="nav-item">
                        <a class="navbar-brand" href="index.php?page=keranjang"><img src="images/cart.png" alt="logo-cart" style="background-color:red; padding:2px 10px; border-radius:3px;"></a>
                    </li>
                    
    </nav>

    <!-- Page Content -->
    <center>
        <div class="container">
            <div class="row">
                <div class="col-lg-9" style="margin:220px 150px;">
                    <div style="margin-bottom: 20px;">
                        <?php
                        echo "<h1>Selamat Datang di </br> Muslimah Bakery</h1>";
                        ?>
                        <!-- Tambahkan Tombol Login dan Register di Bagian Ini -->
                        <div class="col-lg-4 text-center">
                            <a href="index.php?page=login" class="btn btn-primary btn-lg" style="margin-top: 20px;">Login</a>
                            <a href="index.php?page=register" class="btn btn-primary btn-lg" style="margin-top:20px; margin-left: 20px;">Register</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9" style="margin:30px 150px;">


                </div>
            </div>
        </div>

    </center>

    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Muslimah Bakery &copy;</p>
        </div>
    </footer>

    <!-- Modal for Chat -->

    <!-- DataTables JavaScript -->
    <script src="datatables/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatables').DataTable();
        });
    </script>
</body>

</html>