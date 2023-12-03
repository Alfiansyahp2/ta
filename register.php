<div class="col-lg-8" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="card">
        <div class="card-title" style="text-align: center;">
            <br><h4>Registrasi Akun</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form action="" method="post">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label>No Telepon/Handphone</label>
                        <input type="number" name="telp" class="form-control" placeholder="No Telepon" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div style="display: flex; flex-direction: column; align-items: flex-start;">
                        <input type="submit" class="btn btn-success" name="daftar" value="Daftar">
                        <span style="margin-top: 10px;">Sudah punya akun?</span>
                        <a href="index.php?page=login" class="btn btn-success" style="margin-top: 10px;">Login</a>
                </form>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

<?php

if (isset($_POST['daftar'])) {
    $nama = @$_POST['nama'];
    $email = @$_POST['email'];
    $telp = @$_POST['telp'];
    $username = @$_POST['username'];
    $password = md5($_POST['password']);

    // Query untuk memeriksa apakah username sudah ada
    $checkUsernameQuery = "SELECT username FROM user WHERE username = '$username'";
    $result = $mysqli->query($checkUsernameQuery);

    if ($result->num_rows > 0) {
        echo "<script type='text/javascript'> alert('Username sudah ada, silahkan buat ulang.')</script>";
    } else {
        // Query untuk menyimpan data pengguna baru
        $insertUserQuery = "INSERT INTO user (nama_lengkap, email, no_telp, username, password, level, status) VALUES ('$nama', '$email', '$telp', '$username', '$password', 'pembeli', 'on')";

        if ($mysqli->query($insertUserQuery) === TRUE) {
            echo "<script type='text/javascript'> alert('Registrasi berhasil, silahkan login.')</script>";
            echo "<script type='text/javascript'> window.location.href='home.php?page=';</script>";
            header("Location: home.php"); // Mengalihkan ke halaman home.php
            exit;
        } else {
            echo "Error: " . $insertUserQuery . "<br>" . $mysqli->error;
        }
    }

    // Tutup mysqli
    $mysqli->close();
}
?>