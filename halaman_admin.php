<?php
	
	session_start();
	include "koneksi.php";
	include "function.php";
	$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
	$level = isset($_SESSION['level']) ? $_SESSION['level'] : null;

if ($user_id === null || $level === null) {
    header("location: index.php?page=login");
		exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>halaman admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="datatables/datatables.min.css" rel="stylesheet">
	<script src="vendor/jquery/jquery-3.1.1.min.js" rel="stylesheet"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <!-- <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div> -->
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- header header  -->
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="halaman_admin.php">
                        <!-- Logo icon -->
                        <b><img src="images/muslimah1.jpg" alt="homepage" class="dark-logo" /></b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <!--<span><img src="images/logo-text.png" alt="homepage" class="dark-logo" /></span>-->
                    </a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                     
                    </ul>
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/users/5.jpg" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End header header -->
        <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li> <a href="halaman_admin.php" aria-expanded="false"><i class="fa fa-star"></i></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li class="nav-label">Data</li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-suitcase"></i><span class="hide-menu">Master</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="?page=karyawan">Karyawan</a></li>
								<li><a href="?page=user">user</a></li>
                                <li><a href="?page=banner">Banner</a></li>
                                <li><a href="?page=kota">Kecamatan</a></li>
                                <li><a href="?page=kategori">Kategori</a></li>	
                                <li><a href="?page=kue">Kue</a></li>	
                            </ul>
                        </li>
						<li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-money"></i><span class="hide-menu">Transaksi</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="?page=pesanan">Pesanan</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-table"></i><span class="hide-menu">Laporan</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="?page=laporan_bayar">Laporan</a></li>
                                <!-- <li><a href="?page=laporan_pesan">Laporan Pemesanan</a></li> -->
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body"> 
								
								<?php
				
									$page=@$_GET['page'];
									$action=@$_GET['action'];
									if($_SESSION['level'] == "admin"){
										if($page == "banner"){
											if ($action==""){
												include "module/banner/list_banner.php";
											}
											else if($action == "tambah_banner"){
												include "module/banner/tambah_banner.php";
											}
											else if($action == "edit"){
												include "module/banner/edit_banner.php";
											}
											else if($action=="hapus"){
												$banner_id = @$_GET['banner_id'];
												$query = "DELETE FROM banner WHERE banner_id = '$banner_id'";
												if ($mysqli->query($query)) {
													echo '<script type="text/javascript">window.location.href="halaman_admin.php?page=banner";</script>';
												} else {
													echo "Gagal menghapus data: " . $mysqli->error;
												}
											}
										}
										else if($page == "user"){
											if ($action==""){
												include "module/user/list_user.php";
											}
											else if($action == "tambah_user"){
												include "module/user/tambah_user.php";
											}
											else if($action == "edit"){
												include "module/user/edit_user.php";
											}
											else if($action=="hapus"){
												$user_id = @$_GET['user_id'];
												$query = "DELETE FROM user WHERE user_id = '$user_id'";
												if ($mysqli->query($query)) {
													echo '<script type="text/javascript">window.location.href="../kue/halaman_admin.php?page=user";</script>';
												} else {
													echo "Gagal menghapus data: " . $mysqli->error;
												}
											}
										}
                                        else if ($page == "kota") {
											if ($action == "") {
												include "module/kota/list_kota.php";
											} elseif ($action == "tambah_kota") {
												include "module/kota/tambah_kota.php";
											} elseif ($action == "edit") {
												include "module/kota/edit_kota.php";
											} elseif ($action == "hapus") {
												$id_kota = @$_GET['id_kota'];
												$query = "DELETE FROM kota WHERE id_kota = '$id_kota'";
												
												if ($mysqli->query($query)) {
													echo '<script type="text/javascript">window.location.href="../kue/halaman_admin.php?page=kota";</script>';
												} else {
													echo "Gagal menghapus data: " . $mysqli->error;
												}
											}
										}
										else if ($page == "kategori") {
											if ($action == "") {
												include "module/kategori/list_kategori.php";
											} elseif ($action == "tambah_kategori") {
												include "module/kategori/tambah_kategori.php";
											} elseif ($action == "edit") {
												include "module/kategori/edit_kategori.php";
											} elseif ($action == "hapus") {
												$id_kategori = @$_GET['id_kategori'];
												$query = "DELETE FROM kategori WHERE id_kategori = '$id_kategori'";
												
												if ($mysqli->query($query)) {
													echo '<script type="text/javascript">window.location.href="halaman_admin.php?page=kategori";</script>';
												} else {
													echo "Gagal menghapus data: " . $mysqli->error;
												}
											}
										}
										
										else if ($page == "karyawan") {
											if ($action == "") {
												include "module/karyawan/list_karyawan.php";
											} elseif ($action == "tambah_karyawan") {
												include "module/karyawan/tambah_karyawan.php";
											} elseif ($action == "edit") {
												include "module/karyawan/edit_karyawan.php";
											} elseif ($action == "hapus") {
												$id_karyawan = @$_GET['id_karyawan'];
												$query = "DELETE FROM karyawan WHERE id_karyawan = '$id_karyawan'";
												
												if ($mysqli->query($query)) {
													echo '<script type="text/javascript">window.location.href="halaman_admin.php?page=karyawan";</script>';
												} else {
													echo "Gagal menghapus data: " . $mysqli->error;
												}
											}
										}
										
										else if ($page == "kue") {
											if ($action == "") {
												include "module/kue/list_kue.php";
											} elseif ($action == "tambah_kue") {
												include "module/kue/tambah_kue.php";
											} elseif ($action == "edit") {
												include "module/kue/edit_kue.php";
											} elseif ($action == "hapus") {
												$id_kue = @$_GET['id_kue'];
												$query = "DELETE FROM kue WHERE id_kue = '$id_kue'";
												
												if ($mysqli->query($query)) {
													echo '<script type="text/javascript">window.location.href="../kue/halaman_admin.php?page=kue";</script>';
												} else {
													echo "Gagal menghapus data: " . $mysqli->error;
												}
											}
										}
										
										else if($page == "pesanan"){
											if ($action==""){
												include "module/pesanan/list_pesanan.php";
										}
											else if ($action=="diskon"){
												include "module/pesanan/diskon.php";
										}
											else if ($action=="status"){
												include "module/pesanan/status.php";
										}
										else if ($action=="konfirmasi"){
												include "module/pesanan/konfirmasi.php";
										}
										else if ($action=="kirim"){
												include "module/pesanan/kirim.php";
										}
									}
									else if($page == "laporan_pesan"){
										include "module/pesanan/laporan_pesan.php";
									}
									else if($page == "laporan_bayar"){
										include "module/pesanan/laporan_bayar.php";
									}
									else if($page == "pesanan_masuk"){
										include "pesanan_masuk.php";
									}
										else{
											include "home_admin.php";
										}
									}else{
										 echo '<script language="javascript">alert("maaf anda tidak punya akses!"); document.location="error-404.html";</script>';
									}
						
								?>
						
							</div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class="footer"> © Muslimah Bakery. 
			</footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="js/lib/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
	<script src="datatables/datatables.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready( function () {
		$('#datatables').DataTable();
		} );
	</script>

</body>

</html>
