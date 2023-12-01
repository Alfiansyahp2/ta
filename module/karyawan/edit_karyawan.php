<?php
include "../../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id_karyawan = @$_GET['id_karyawan'];
    $sql = $mysqli->query("SELECT * FROM karyawan WHERE id_karyawan='$id_karyawan'");

    if ($sql) {
        $data = $sql->fetch_assoc();
        $status = $data['status'];
    } else {
        die("MySQLi error: " . $mysqli->error);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['edit_karyawan'])) {
    $id_karyawan = $_POST['id_karyawan'];
    $nama = $_POST['nama_karyawan'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $jabatan = $_POST['jabatan'];
    $status = $_POST['status'];

    $query = "UPDATE `karyawan` SET `nama_karyawan` = '$nama' , no_telp= '$no_telp', alamat= '$alamat', email= '$email', jabatan= '$jabatan', status= '$status' WHERE `karyawan`.`id_karyawan` = $id_karyawan;    ";

<<<<<<< HEAD
    if ($mysqli->query($query) === TRUE) {
        ?>
        <script type="text/javascript"> 
            alert("Tambah karyawan baru berhasil");
            window.location.href = "halaman_admin.php?page=karyawan";
        </script>
        <?php
    } else {
        echo "Gagal: " . $query . "<br>" . $mysqli->error;
=======
    $updateQuery = $mysqli->prepare("UPDATE karyawan SET nama_karyawan=?, no_telp=?, alamat=?, email=?, jabatan=?, status=? WHERE id_karyawan=?");

    // Bind the parameters
    $updateQuery->bind_param("sssssi", $nama, $no_telp, $alamat, $email, $jabatan, $status, $id_karyawan);

    if ($updateQuery->execute()) {
        // Redirect after successful form submission
        header("Location: ../ta/halaman_admin.php?page=karyawan");
        exit();
    } else {
        $error_message = "Update karyawan failed: " . $mysqli->error;
>>>>>>> 4356d6e274b35d39e9be513e4534f7aee35d1b1f
    }

    $mysqli->close();
}
?>

<!-- The HTML form goes here -->


<div class="col-lg-8">
    <div class="card-title">
        <h4>Form Edit Karyawan</h4>
    </div>
    <div class="card-body">
        <div class="basic-form">
            <form action="" method="post">
                <!-- Add a hidden input field to capture id_karyawan -->
                <input type="hidden" name="id_karyawan" value="<?php echo $id_karyawan; ?>">

                <div class="form-group">
                    <label>Nama Karyawan</label>
                    <input type="text" name="nama_karyawan" class="form-control" value="<?php echo $data['nama_karyawan']; ?>" required>
                </div>
                <div class="form-group">
                    <label>No Telepon</label>
                    <input type="text" name="no_telp" class="form-control" value="<?php echo $data['no_telp']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="<?php echo $data['alamat']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" value="<?php echo $data['jabatan']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <div class="radio-inline">
                        <input type="radio" name="status" id="opsi1" value="on" <?php if($status == "on"){ echo "checked='true'"; } ?> required> On
                        <input type="radio" name="status" id="opsi2" value="off" <?php if($status == "off"){ echo "checked='true'"; } ?> required> Off
                    </div>
                </div>
                <input type="submit" name="edit_karyawan" value="Edit" class="btn btn-default">
            </form>
        </div>
    </div>
</div>