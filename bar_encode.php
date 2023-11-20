<?php
require("koneksi.php");
header ('Content-Type: application/json');

$query = "SELECT MONTH(tgl_pemesanan) AS bulan, COUNT(id_pesanan) AS jumlah_id
          FROM pesanan
          GROUP BY MONTH(tgl_pemesanan)";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

$data = array(); // Membuat array kosong untuk menyimpan data

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

mysqli_close($conn);

if (empty($data)) {
    die("No data found");
}

echo json_encode($data);
?>
