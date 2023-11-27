<?php
include "../../koneksi.php";

$nama = @$_POST['nama'];
$tarif = @$_POST['tarif'];
$status = @$_POST['status'];

$simpan_kota = @$_POST['simpan_kota'];

if ($simpan_kota) {
    $insertKotaQuery = $mysqli->prepare("INSERT INTO kota (nama_kota, tarif, status) VALUES (?, ?, ?)");
    $insertKotaQuery->bind_param("sds", $nama, $tarif, $status);

    if ($insertKotaQuery->execute()) {
        ?>
        <script type="text/javascript"> alert("Tambah Kota baru berhasil");
            window.location.href="../../halaman_admin.php?page=kota";
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript"> alert("Insert into kota failed: <?php echo $insertKotaQuery->error; ?>");
        </script>
        <?php
    }

    $insertKotaQuery->close();
} else {
    echo "gagal";
}
?>
