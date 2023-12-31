<?php
$id_karyawan = @$_GET['id_karyawan'];
$query = "SELECT * FROM karyawan WHERE id_karyawan='$id_karyawan'";
$result = $mysqli->query($query);

if ($result) {
    $data = $result->fetch_assoc();
    $status = $data['status'];
} else {
    die("Gagal menjalankan query: " . $mysqli->error);
}
?>

<div class="col-lg-8">
    <div class="card-title">
        <h4>Form Edit User</h4>
    </div>
    <div class="card-body">
        <div class="basic-form">
            <form action="" method="post">
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

<?php
if (isset($_POST['edit_karyawan'])) {
    $nama = $_POST['nama_karyawan'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $jabatan = $_POST['jabatan'];
    $status = $_POST['status'];

    $updateQuery = $mysqli->prepare("UPDATE karyawan SET nama_karyawan=?, no_telp=?, alamat=?, email=?, jabatan=?, status=? WHERE id_karyawan=?");

    // Bind the parameters
    $updateQuery->bind_param("ssssssi", $nama, $no_telp, $alamat, $email, $jabatan, $status, $id_karyawan);

    if ($updateQuery->execute()) {
        ?>
        <script type="text/javascript">
            alert("Data user berhasil diedit");
            window.location.href="../ta/halaman_admin.php?page=karyawan";
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript">
            alert("Update user failed: <?php echo $mysqli->error; ?>");
        </script>
        <?php
    }
    $updateQuery->close();
}
?>
