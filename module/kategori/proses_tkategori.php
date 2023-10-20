<?php
include "../../koneksi.php";

$nama = @$_POST['nama'];
$status = @$_POST['status'];

$simpan_kategori = @$_POST['simpan_kategori'];

if ($simpan_kategori) {
    $insertKategoriQuery = $mysqli->query("INSERT INTO kategori (kategori, status) VALUES ('$nama', '$status')");

    if ($insertKategoriQuery) {
        ?>
        <script type="text/javascript"> alert("tambah Kategori baru berhasil");
            window.location.href="../../halaman_admin.php?page=kategori";
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript"> alert("Insert into kategori failed: <?php echo $mysqli->error; ?>");
        </script>
        <?php
    }
} else {
    echo "gagal";
}
?>
