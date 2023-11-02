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
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-9" style="margin:220px 150px;">
                <?php
                // Anda bisa menambahkan konten utama dari halaman "home.php" di sini.
                // Misalnya, Anda dapat menampilkan produk atau konten lainnya.

                // Contoh: Menampilkan judul
                echo "<h1>Selamat Datang di </br> Muslimah Bakery</h1>";

                // Contoh: Menampilkan gambar slider
                
                
                // Contoh: Menampilkan produk atau konten lainnya
                // Anda dapat menambahkan kode HTML dan PHP di sini sesuai kebutuhan.
                ?>

                <!-- Tambahkan Tombol Login dan Register di Bagian Ini -->
    <div class="container" style="margin-top: 80px;">
    
    <div class="btn-group" role="group">
    <a href="?page=login" class="btn btn-primary btn-lg mr-2">Login</a>
    <a href="?page=register" class="btn btn-success btn-lg">Register</a>


        <!-- <div class="col-lg-9 text-center">
            <a href="?page=login" class="btn btn-primary btn-lg btn-block">Login</a>
        </div>
        <div class="col-lg-9 text-center">
            <a href="?page=register" class="btn btn-success btn-lg btn-block">Register</a>
        </div>-->
    </div>
</div>

            </div>
        </div>
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Muslimah Bakery &copy;</p>
        </div>
    </footer>

    <!-- Modal for Chat -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#contohModalKecil">Kirim Pesan</button>
    <div class="modal fade" id="contohModalKecil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding-top:600px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <?php include "chat.php"; ?>
            </div>
        </div>
    </div>
    <!-- DataTables JavaScript -->
    <script src="datatables/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#datatables').DataTable();
        });
    </script>
</body>
</html>
