<?php
error_reporting(0);
$mysqli = new mysqli("localhost", "root", "", "roti1");

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Sekarang Anda dapat menggunakan objek $mysqli untuk melakukan query ke database

?>
