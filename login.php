<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['level'])) {
    if ($_SESSION['level'] == "admin") {
        header("location: halaman_admin.php");
    } else if ($_SESSION['level'] == "pembeli") {
        header("location: index.php");
    }
}

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $password = md5($_POST['password']);

    $query = mysqli_query($mysqli, "SELECT * FROM user WHERE username='$user' AND password='$password' AND status='on'");
    $jml = mysqli_num_rows($query);

    if ($jml == 0) {
        echo '<script language="javascript">alert("Username atau password salah!");</script>';
    } else {
        $row = mysqli_fetch_assoc($query);

        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
        $_SESSION['level'] = $row['level'];
        $_SESSION['username'] = $row['username'];

        if ($_SESSION['level'] == "admin") {
            header("location: halaman_admin.php");
        } elseif ($_SESSION['level'] == "pembeli") {
            header("location: index.php");
        }
    }
}
?>

<div class="col-lg-6" style="margin:165px 150px;">
    <div class="card">
        <div class="card-title">
            <h4>Halaman Login</h4>
        </div>

        <div class="card-body">
            <div class="basic-form">
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <input type="submit" class="btn btn-success" name="login" value="Login">
                </form>
            </div>
        </div>
    </div>
</div>



