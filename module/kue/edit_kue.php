 <script src="js/ckeditor/ckeditor.js"> </script>
 <div class="col-lg-6">
	
 <?php
$id_kue = @$_GET['id_kue'];
$query = $mysqli->query("SELECT kue.*, kategori.kategori FROM kue JOIN kategori ON kue.id_kategori = kategori.id_kategori WHERE id_kue='$id_kue'");

if ($query) {
    $data = $query->fetch_assoc();
    $status = $data['status'];
    $spesifikasi = $data['spesifikasi'];
    $kategori = $data['kategori'];
} else {
    die("MySQLi error: " . $mysqli->error);
}
?>

        <div class="card-title">
            <h4>Form Edit Banner</h4>

        </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="" method="post" enctype="multipart/form-data">
                         <div class="form-group">
                            <label>Nama Kue</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $data['nama_kue']; ?>" required>
                        </div>
						<div class="form-group">
						  <label>Kategori :</label>
						  <select name="id_kategori" class="form-control">
								<option value="<?php echo $data['id_kategori']; ?>"><?php echo $data['kategori']; ?>
									<?php if(kategori == $kategori){echo "selected='true'";} ?>
								</option>
						  </select>
						 </div>
						 <div style="margin-bottom:10px">
							<label style="font-weight:bold">Spesifikasi</label>
							<span> <textarea name="spesifikasi" id="editor"> <?php echo $spesifikasi; ?> </textarea> </span>
						</div>
						<div class="form-group">
                            <label>Harga</label>
                            <input type="text" name="harga" class="form-control" value="<?php echo $data['harga']; ?>" required>
                        </div>
						<div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="form-control">
                        </div>
						<div class="form-group">
                            <label>Status</label>
							<div class="radio-inline"> 
								<input type="radio" name="status" id="opsi1" value="on" <?php if($status == "on"){ echo "checked='true'"; } ?> required> On
								<input type="radio" name="status" id="opsi2" value="off" <?php if($status == "off"){ echo "checked='true'"; } ?> required> Off
							</div>
                        </div>
                            <input type="submit" name="edit_kue" value="Edit" class="btn btn-default">
                    </form>
                </div>
            </div>
        
</div>
<script>
	CKEDITOR.replace("editor");
</script>
<?php
include "../../koneksi.php";

$nama = @$_POST['nama'];
$kategori = @$_POST['id_kategori'];
$spesifikasi = @$_POST['spesifikasi'];
$harga = @$_POST['harga'];
$status = @$_POST['status'];

$sumber = @$_FILES['gambar']['tmp_name'];
$target = 'images/kue/';
$nama_gambar = @$_FILES['gambar']['name'];

$edit = @$_POST['edit_kue'];

if ($edit) {
    if ($nama_gambar == "") {
        $updateQuery = $mysqli->prepare("UPDATE kue SET id_kategori=?, nama_kue=?, spesifikasi=?, harga=?, status=? WHERE id_kue=?");

        // Bind the parameters
        $updateQuery->bind_param("isssii", $kategori, $nama, $spesifikasi, $harga, $status, $id_kue);

        if ($updateQuery->execute()) {
            ?>
            <script type="text/javascript"> 
                alert("data berhasil diedit");
                window.location.href="../../halaman_admin.php?page=kue";
            </script>
            <?php
        } else {
            ?>
            <script type="text/javascript">
                alert("Update kue failed: <?php echo $mysqli->error; ?>");
            </script>
            <?php
        }

        $updateQuery->close();
    } else {
        $pindah = move_uploaded_file($sumber, $target.$nama_gambar);

        if ($pindah) {
            $updateQuery = $mysqli->prepare("UPDATE kue SET id_kategori=?, nama_kue=?, spesifikasi=?, gambar=?, harga=?, status=? WHERE id_kue=?");

            // Bind the parameters
            $updateQuery->bind_param("isssisi", $kategori, $nama, $spesifikasi, $nama_gambar, $harga, $status, $id_kue);

            if ($updateQuery->execute()) {
                ?>
                <script type="text/javascript"> 
                    alert("data berhasil diedit");
                    window location.href="../../halaman_admin.php?page=kue";
                </script>
                <?php
            } else {
                ?>
                <script type="text/javascript">
                    alert("Update kue failed: <?php echo $mysqli->error; ?>");
                </script>
                <?php
            }

            $updateQuery->close();
        } else {
            ?>
            <script type="text/javascript">
                alert("upload gambar gagal");
            </script>
            <?php
        }
    }
}
?>
