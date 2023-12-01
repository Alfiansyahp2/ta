<?php

	include "../../koneksi.php";
	include "../../function.php";
	
	
	session_start();
	
	$id_pesanan = $_GET['id_pesanan'];
	$kirim = $_POST['kirim'];
	$button = $_POST['button'];
	$konfirmasi = $_POST['konfirmasi'];
	$kirimp = $_POST['kirimp'];
	$diskon = $_POST['diskon'];
	//
	if($kirim){
	
		$user_id = $_SESSION['user_id'];
		$nomor_rekening = $_POST['norek'];
		$nama_akun = $_POST['nama_akun'];
		$waktu_saat_ini = date("Y-m-d");
		$sumber = $_FILES['gambar']['tmp_name'];
		$target = '../../images/bukti/';
		$nama_gambar = $_FILES['gambar']['name'];
		move_uploaded_file($sumber, $target . $nama_gambar);
		$queryPembayaran = $mysqli->query("INSERT INTO konfirmasi_pembayaran (id_pesanan, no_rek, nama_account, tgl_transfer, bukti_pembayaran) VALUES ('$id_pesanan', '$nomor_rekening', '$nama_akun', '$waktu_saat_ini','$nama_gambar')");
		
		if ($queryPembayaran) {
			$mysqli->query("UPDATE pesanan SET status='1' WHERE id_pesanan='$id_pesanan'");
			?>
			<script type="text/javascript"> alert("konfirmasi berhasil");
				window.location.href="../../index.php?page=pesanan";
			</script>
			<?php
		} 
	}
	if($konfirmasi){
		$karyawan = $_POST["id_karyawan"];
		$lama_pesanan = $_POST["lama_pesanan"];

		$insertKonfirmasiQuery = $mysqli->query("INSERT INTO konfirmasi_pesanan (id_pesanan, id_karyawan, lama_pesanan) VALUES ('$id_pesanan', '$karyawan', '$lama_pesanan')");

		if ($insertKonfirmasiQuery) {
			echo '<script>alert("berhasil"); window.location.href="../../halaman_admin.php?page=pesanan";</script>';
			?>
			<script type="text/javascript"> alert("konfirmasi berhasil");
				window.location.href="../../halaman_admin.php?page=pesanan";
			</script>
			<?php
		} else {
			// Handle the case where the query failed
			echo "Konfirmasi pesanan failed: " . $mysqli->error;
		}


	}
	 if($button){
		$status = $_POST["status"];

		$updateStatusQuery = $mysqli->query("UPDATE pesanan SET status='$status' WHERE id_pesanan='$id_pesanan'");

		if ($updateStatusQuery) {
			?>
			<script type="text/javascript"> alert("update status berhasil");
				window.location.href="../../halaman_admin.php?page=pesanan";
			</script>
			<?php
		} else {
			// Handle the case where the query failed
			echo "Update status failed: " . $mysqli->error;
		}

	} 
	if($kirimp){
		$karyawan = $_POST["id_karyawan"];
		$status = $_POST["status"];

		$insertKirimQuery = $mysqli->query("INSERT INTO kirim (id_pesanan, id_karyawan, status) VALUES ('$id_pesanan', '$karyawan', '$status')");

		if ($insertKirimQuery) {
			?>
			<script type="text/javascript"> alert("berhasil");
				window.location.href="../../halaman_admin.php?page=pesanan";
			</script>
			<?php
		} else {
			// Handle the case where the query failed
			echo "Insert into kirim failed: " . $mysqli->error;
		}


	}

	if($diskon){

		$total = $_POST["total_harga"];

		$insertKirimQuery = $mysqli->query("UPDATE pesanan SET total_harga='$total' WHERE id_pesanan='$id_pesanan'");

		if ($insertKirimQuery) {
			?>
			<script type="text/javascript"> alert("berhasil");
				window.location.href="../../halaman_admin.php?page=pesanan";
			</script>
			<?php
		} else {
			// Handle the case where the query failed
			echo "Insert into kirim failed: " . $mysqli->error;
		}


	}
?>