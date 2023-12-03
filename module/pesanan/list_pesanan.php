<?php
$queryPesanan = "";

if ($level == "admin") {
    $queryPesanan = "SELECT pesanan.*, user.nama_lengkap FROM pesanan JOIN user ON pesanan.user_id=user.user_id  ORDER BY `pesanan`.`id_pesanan` DESC";
} else {
    $queryPesanan = "SELECT pesanan.*, user.nama_lengkap FROM pesanan JOIN user ON pesanan.user_id=user.user_id WHERE pesanan.user_id='$user_id' ORDER BY `pesanan`.`id_pesanan` DESC";
}

$resultPesanan = $mysqli->query($queryPesanan);

if ($resultPesanan === false) {
    die("Query failed: " . $mysqli->error);
}

if ($resultPesanan->num_rows == 0) {
    echo "<h3>Saat ini belum ada data pesanan</h3>";
} else {
    echo "<table class='table table-hover' id='datatables'>
            <thead>
                <tr>
                    <th>Nomor Pesanan</th>
                    <th>Status Pembayaran</th>
                    <th>Nama Akun</th>
                    <th>Action</th>
                </tr>
            </thead>";
    echo "<tbody>";

    while ($row = $resultPesanan->fetch_assoc()) {
        if ($level == "admin") {
            // $diskon = "<a class='btn btn-success' href='halaman_admin.php?page=pesanan&module=pesanan&action=diskon&id_pesanan=$row[id_pesanan]'>Diskon</a>";
            $adminbutton = "<a class='btn btn-success' href='halaman_admin.php?page=pesanan&module=pesanan&action=status&id_pesanan=$row[id_pesanan]'>Status</a>";
            $konfirmasi = "<a class='btn btn-success' href='halaman_admin.php?page=pesanan&module=pesanan&action=konfirmasi&id_pesanan=$row[id_pesanan]'>Konfirmasi</a>";
            $kirim = "<a class='btn btn-success' href='halaman_admin.php?page=pesanan&module=pesanan&action=kirim&id_pesanan=$row[id_pesanan]'>Kirim</a>";
        }

        $status = $row['status'];
        echo "<tr>
                <td>$row[id_pesanan]</td>
                <td>{$arrayStatusPesanan[$status]}</td>
                <td>$row[nama_lengkap]</td>
                <td>
                    <a class='btn btn-success' href='index.php?page=pesanan&module=pesanan&action=detail&id_pesanan=$row[id_pesanan]'>Detail</a>
                    // $diskon
                    $adminbutton
                    $konfirmasi
                    $kirim
                </td>
            </tr>";
    }
    echo "</tbody>";
    echo "</table>";
}
 
?>
