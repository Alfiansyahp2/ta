<?php
include "koneksi.php";

$showForgotPasswordForm = true;

if (isset($_POST['act_reset'])) {
    date_default_timezone_set("Asia/Jakarta");

    $pass = "1A2B4HTjsk5kwhadbwlff";
    $panjang = '8';
    $len = strlen($pass);
    $start = $len - $panjang;
    $xx = rand(0, $start);
    $yy = str_shuffle($pass);
    $passwordbaru = substr($yy, $xx, $panjang);

    $email = strtolower(trim(strip_tags($_POST['email'])));

    // Use a prepared statement to select user data
    $query = "SELECT user_id, email, nama_lengkap, username FROM user WHERE email = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $stmt->store_result();
        $stmt->bind_result($user_id, $alamatEmail, $nama, $username);

        if ($stmt->num_rows == 1) {
            // Get user data
            $stmt->fetch();

            // Generate and send the password reset email
            $title = "Permintaan Password Baru";
            $pesan = "Kami telah mereset kata sandi " . $nama . ". Anda dapat login kembali ke situs kami. \n\n"
                . "DETAIL AKUN ANDA:\nUsername: " . $username . "\n"
                . "Kata sandi Anda yang baru adalah: " . $passwordbaru . ". Untuk mengubahnya, silahkan login dan perbarui di menu profil.";

            $header = "From: nama-website<no-reply@domain.com>";

            if (mail($alamatEmail, $title, $pesan, $header)) {
                // Update the new password to the database
                $hashedPassword = password_hash($passwordbaru, PASSWORD_DEFAULT);
                $updateQuery = "UPDATE user SET password = ? WHERE user_id = ?";
                $updateStmt = $mysqli->prepare($updateQuery);
                $updateStmt->bind_param("si", $hashedPassword, $user_id);

                if ($updateStmt->execute()) {
                    echo '
                    <div class="col-lg-8" style="margin-top: 180px; margin-bottom: 180px;">
                        <div class="card">
                            <div class="card-title">
                                <h4>Kata sandi baru telah direset</h4>
                            </div>
                            <div class="card-body">
                                ' . $pesan . '<hr>
                            </div>
                        </div>
                    </div>';

                    // Set $showForgotPasswordForm menjadi false agar formulir lupa password tidak ditampilkan
                    $showForgotPasswordForm = false;
                } else {
                    echo '<div class="warning">Gagal mengupdate kata sandi baru</div>';
                }
            } else {
                echo '<div class="warning">Pengiriman kata sandi baru gagal</div>';
            }
        } else {
            echo '<div class="warning">Alamat Email tidak ditemukan</div>';
        }

        $stmt->close();
    } else {
        echo '<div class="warning">Error executing the query: ' . $mysqli->error . '</div>';
    }

    // Close the database connection
    $mysqli->close();
}

if ($showForgotPasswordForm) {
    ?>
    <div class="col-lg-8" style="margin-top: 180px; margin-bottom: 180px;">
        <div class="card">
            <div class="card-title">
                <h4>Halaman Lupa Password</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Masukkan email anda</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <input type="submit" class="btn btn-default" name="act_reset" value="Reset">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
