<?php
		$id_kota = @$_GET['id_kota'];
        $query = "SELECT * FROM kota WHERE id_kota='$id_kota'";
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
            <h4>Form Edit Kota</h4>

        </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Nama Kota</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $data['nama_kota']; ?>"  required>
                        </div>
						<div class="form-group">
                            <label>Tarif</label>
                            <input type="text" name="tarif" class="form-control" value="<?php echo $data['tarif']; ?>" required>
                        </div>
						<div class="form-group">
                            <label>Status</label>
							<div class="radio-inline"> 
								<input type="radio" name="status" id="opsi1" value="on" <?php if($status == "on"){ echo "checked='true'"; } ?> required> On
								<input type="radio" name="status" id="opsi2" value="off" <?php if($status == "off"){ echo "checked='true'"; } ?> required> Off
							</div>
                        </div>
                            <input type="submit" name="edit_kota" value="Edit" class="btn btn-default">
                    </form>
					
                </div>
            </div>

</div>
<?php
if (isset($_POST['edit_kota'])) {
    $nama = $_POST['nama'];
    $tarif = $_POST['tarif'];
    $status = $_POST['status'];

    $updateQuery = $mysqli->prepare("UPDATE kota SET nama_kota=?, tarif=?, status=? WHERE id_kota=?");

    // Bind the parameters
    $updateQuery->bind_param("sssi", $nama, $tarif, $status, $id_kota);

    if ($updateQuery->execute()) {
        ?>
        <script type="text/javascript"> alert("Data kota berhasil diedit");
            window.location.href="../ta/halaman_admin.php?page=kota";
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript"> alert("Update kota failed: <?php echo $mysqli->error; ?>");
        </script>
        <?php
    }

    $updateQuery->close();
}
?>