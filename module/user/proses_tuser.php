<?php
include "../../koneksi.php";

$nama = @$_POST['nama'];
$email = @$_POST['email'];
$telp = @$_POST['telp'];
$username = @$_POST['username'];
$password = @$_POST['password'];
$level = @$_POST['level'];
$status = @$_POST['status'];

$simpan_user = @$_POST['simpan_user'];

if ($simpan_user) {
    $hashedPassword = md5($password); // Note: MD5 is not recommended for password hashing in production, consider using a stronger hash algorithm

    $insertQuery = $mysqli->prepare("INSERT INTO user VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");
    $insertQuery->bind_param("sssssss", $nama, $email, $telp, $username, $hashedPassword, $level, $status);

    if ($insertQuery->execute()) {
        ?>
        <script type="text/javascript"> alert("Tambah user baru berhasil");
            window.location.href="../../halaman_admin.php?page=user";
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript"> alert("Gagal menambahkan user baru: <?php echo $mysqli->error; ?>");
        </script>
        <?php
    }

    $insertQuery->close();
} else {
    echo "Gagal";
}
?>
