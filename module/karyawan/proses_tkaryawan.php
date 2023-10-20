<?php
include "../../koneksi.php";

$nama = @$_POST['nama'];
$no_telp = @$_POST['no_telp'];
$alamat = @$_POST['alamat'];
$email = @$_POST['email'];
$jabatan = @$_POST['jabatan'];
$status = @$_POST['status'];

$simpan_karyawan = @$_POST['simpan_karyawan'];

if ($simpan_karyawan) {
     
    if ($mysqli->connect_error) {
        die("Koneksi database gagal: " . $mysqli->connect_error);
    }

    $query = "INSERT INTO karyawan (nama_karyawan, no_telp, alamat, email, jabatan, status) VALUES ('$nama', '$no_telp', '$alamat', '$email', '$jabatan', '$status')";

    if ($mysqli->query($query) === TRUE) {
        ?>
        <script type="text/javascript"> 
            alert("Tambah karyawan baru berhasil");
            window.location.href = "../../halaman_admin.php?page=karyawan";
        </script>
        <?php
    } else {
        echo "Gagal: " . $query . "<br>" . $mysqli->error;
    }

    $mysqli->close();
} else {
    echo "Gagal";
}
?>
