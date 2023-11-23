<?php
include 'koneksi.php'; // Pastikan file koneksi.php sesuai dengan konfigurasi database Anda

if(isset($_GET['id_kategori'])) {
    $id_kategori = $_GET['id_kategori'];

    // Proses penghapusan
    $deleteQuery = $mysqli->prepare("DELETE FROM kategori WHERE id_kategori=?");

    // Bind parameter
    $deleteQuery->bind_param("i", $id_kategori);

    if ($deleteQuery->execute()) {
        ?>
        <script type="text/javascript"> alert("Data Kategori berhasil dihapus");
            window.location.href="../../halaman_admin.php?page=kategori";
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript"> alert("Hapus kategori gagal: <?php echo $mysqli->error; ?>");
            window.location.href="../../halaman_admin.php?page=kategori";
        </script>
        <?php
    }

    $deleteQuery->close();
} else {
    ?>
    <script type="text/javascript"> alert("ID Kategori tidak valid");
        window.location.href="../../halaman_admin.php?page=kategori";
    </script>
    <?php
}
?>
