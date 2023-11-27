<?php
 // Dapatkan nilai user_id dari parameter URL
 $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
 
 // Lakukan koneksi ke database (gantilah parameter sesuai dengan konfigurasi database Anda)
 $mysqli = new mysqli("localhost", "root", "", "kue");
 
 // Periksa koneksi
 if ($mysqli->connect_error) {
     die("Koneksi Gagal: " . $mysqli->connect_error);
 }
 
 // Hindari SQL Injection menggunakan parameterized query
 $stmt = $mysqli->prepare("SELECT * FROM user WHERE user_id = ?");
 $stmt->bind_param("s", $user_id);
 $stmt->execute();
 $result = $stmt->get_result();
 
 // Periksa apakah data ditemukan
 if ($result->num_rows > 0) {
     // Ambil data
     $data = $result->fetch_assoc();
     $level = $data['level'];
     $status = $data['status'];
 } else {
     echo "Data tidak ditemukan.";
 }
 
 // Tutup statement dan koneksi
 $stmt->close();
 $mysqli->close();
 ?>
 <div class="col-lg-8">
		<div class="card-title">
            <h4>Form Edit User</h4>

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
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control" value="<?php echo $data['password']; ?>" required>
                        </div>
						<div class="form-group">
                            <label>Level</label>
							<div class="radio-inline"> 
								<input type="radio" name="level" id="opsi1" value="pembeli" <?php if($level == "pembeli"){ echo "checked='true'"; } ?> required> Pembeli
								<input type="radio" name="level" id="opsi2" value="admin" <?php if($level == "admin"){ echo "checked='true'"; } ?> required> Admin
							</div>
                        </div>
						<div class="form-group">
                            <label>Status</label>
							<div class="radio-inline"> 
								<input type="radio" name="status" id="opsi1" value="on" <?php if($status == "on"){ echo "checked='true'"; } ?> required> On
								<input type="radio" name="status" id="opsi2" value="off" <?php if($status == "off"){ echo "checked='true'"; } ?> required> Off
							</div>
                        </div>
                            <input type="submit" name="edit_user" value="Edit" class="btn btn-default">
                    </form>
                </div>
            </div>
</div>

<?php
// Inisialisasi variabel
$nama = $_POST['nama'];
$email = $_POST['email'];
$telp = $_POST['telp'];
$user = $_POST['username'];
$pass = $_POST['pass'];
$level = $_POST['level'];
$status = $_POST['status'];
$edit = $_POST['edit_user'];
$user_id = $_POST['user_id']; // Tambahkan baris ini untuk menginisialisasi $user_id

// Koneksi ke database (gantilah parameter sesuai dengan konfigurasi database Anda)
$mysqli = new mysqli("localhost", "root", "", "kue");

// Periksa koneksi
if ($mysqli->connect_error) {
    die("Koneksi Gagal: " . $mysqli->connect_error);
}


if ($edit) {
    // Gunakan parameterized query untuk mencegah SQL Injection
    $stmt = $mysqli->prepare("UPDATE user SET nama_lengkap=?, email=?, no_telp=?, username=?, password=md5(?), level=?, status=? WHERE user_id=?");
    $stmt->bind_param("ssssssss", $nama, $email, $telp, $user, $pass, $level, $status, $user_id);

    if ($stmt->execute()) {
        ?>
        <script type="text/javascript"> alert("data User berhasil diedit");
            window.location.href="../ta/halaman_admin.php?page=user";
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript"> alert("Update user failed: <?php echo $mysqli->error; ?>");
        </script>
        <?php
    }
    $stmt->execute();
    $stmt->close();

    ?>
    <?php
}

// Tutup koneksi
$mysqli->close();
?>
