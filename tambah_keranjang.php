<?php

	include_once("koneksi.php");
	 
session_start();

$id_kue = $_GET['id_kue'];
$keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : [];

 

$query = "SELECT nama_kue, gambar, harga FROM kue WHERE id_kue = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id_kue);
$stmt->execute();
$stmt->bind_result($nama_kue, $gambar, $harga);

if ($stmt->fetch()) {
    if (array_key_exists($id_kue, $keranjang)) {
        $keranjang[$id_kue]['qty']++;
    } else {
        $keranjang[$id_kue] = [
            "nama_kue" => $nama_kue,
            "gambar" => $gambar,
            "harga" => $harga,
            "qty" => 1
        ];
    }

    $_SESSION["keranjang"] = $keranjang;
}

$stmt->close();
$mysqli->close();

header("location: index.php");
?>
