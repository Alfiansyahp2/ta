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

    // Validate and sanitize user input
    $nama = mysqli_real_escape_string($mysqli, $nama);
    $no_telp = mysqli_real_escape_string($mysqli, $no_telp);
    $alamat = mysqli_real_escape_string($mysqli, $alamat);
    $email = mysqli_real_escape_string($mysqli, $email);
    $jabatan = mysqli_real_escape_string($mysqli, $jabatan);

    $updateQuery = $mysqli->prepare("UPDATE karyawan SET nama_karyawan=?, no_telp=?, alamat=?, email=?, jabatan=?, status=? WHERE id_karyawan=?");

    // Bind the parameters
    $updateQuery->bind_param("sssssi", $nama, $no_telp, $alamat, $email, $jabatan, $status, $id_karyawan);

    if ($updateQuery->execute()) {
        ?>
        <script type="text/javascript">
            alert("Data karyawan berhasil diedit");
            window.location.href="../ta/halaman_admin.php?page=karyawan";
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript">
            alert("Update karyawan failed: <?php echo $mysqli->error; ?>");
        </script>
        <?php
    }

    $updateQuery->close();
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