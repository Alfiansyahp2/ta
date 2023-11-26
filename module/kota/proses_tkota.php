<?php
include "../../koneksi.php";

$nama = @$_POST['nama'];
$tarif = @$_POST['tarif'];
$status = @$_POST['status'];

$simpan_kota = @$_POST['simpan_kota'];

if ($simpan_kota) {
    $insertKotaQuery = $mysqli->query("INSERT INTO kota (nama_kota, tarif, status) VALUES ('$nama', $tarif, $status)");

    if ($insertKotaQuery) {
        ?>
        <script type="text/javascript"> alert("tambah Kota baru berhasil");
            window.location.href="../../halaman_admin.php?page=kota";
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript"> alert("Insert into kota failed: <?php echo $mysqli->error; ?>");
        </script>
        <?php
    }
} else {
    echo "gagal";
}
?>
