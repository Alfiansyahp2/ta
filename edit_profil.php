<?php
session_start();
include "koneksi.php";
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

if ($user_id) {
    $sql = "SELECT * FROM user WHERE user_id = '$user_id'";
    $result = $mysqli->query($sql);

    if ($result) {
        $data = $result->fetch_assoc();

        // Sekarang Anda dapat menggunakan $data untuk informasi pengguna
    } else {
        die("Kesalahan dalam menjalankan kueri: " . $mysqli->error);
    }
} else {
    // Sesuatu yang sesuai dengan kasus ketika user_id tidak ada
}
 
?>

 <div class="col-lg-8">
		<div class="card-title">
            <h4>Profil Pengguna</h4>

        </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $data['nama_lengkap']; ?>" required>
                        </div>
						<div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>" required>
                        </div>
						<div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="telp" class="form-control" value="<?php echo $data['no_telp']; ?>" required>
                        </div>
						<div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $data['username']; ?>" required>
                        </div>
						<div class="form-group">
                            <label>Ganti Password</label>
                            <input type="password" name="pass" class="form-control" required>
                        </div>
                            <input type="submit" name="edit_user" value="Update" class="btn btn-default">
                    </form>
                </div>
            </div>
</div>
<?php
// Pastikan variabel $user_id telah didefinisikan sebelumnya

if (isset($_POST['edit_user'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telp = $_POST['telp'];
    $user = $_POST['username'];
    $pass = $_POST['pass'];

 

    // Menghindari SQL injection dengan menggunakan prepared statement
    $query = $mysqli->prepare("UPDATE user SET nama_lengkap=?, email=?, no_telp=?, username=?, password=? WHERE user_id=?");
    $query->bind_param("sssssi", $nama, $email, $telp, $user, md5($pass), $user_id);

    if ($query->execute()) {
        // Data pengguna berhasil diperbarui
        echo '<script>alert("Data Anda berhasil diperbarui"); window.location.href="index.php";</script>';
    } else {
        // Terjadi kesalahan
        echo "Error: " . $query->error;
    }

    // Tutup koneksi database
    $mysqli->close();
}
?>
