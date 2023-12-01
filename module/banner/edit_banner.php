<?php
include "../../koneksi.php";

$banner_id = @$_GET['banner_id'];
$query = "SELECT * FROM banner WHERE banner_id=?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $banner_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    $data = $result->fetch_assoc();
    $status = $data['status'];
} else {
    die("Gagal menjalankan query: " . $mysqli->error);
}

$stmt->close();
?>

<div class="col-lg-6">
    <div class="card-title">
        <h4>Form Edit Banner</h4>
    </div>
    <div class="card-body">
        <div class="basic-form">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <div class="radio-inline">
                        <input type="radio" name="status" id="opsi1" value="on" <?php if ($status == "on") { echo "checked='true'"; } ?> required> On
                        <input type="radio" name="status" id="opsi2" value="off" <?php if ($status == "off") { echo "checked='true'"; } ?> required> Off
                    </div>
                </div>
                <input type="submit" name="edit_banner" value="Edit" class="btn btn-default">
            </form>

            <?php
            $status = @$_POST['status'];

            $sumber = @$_FILES['gambar']['tmp_name'];
            $target = 'images/';
            $nama_gambar = @$_FILES['gambar']['name'];

            $edit = @$_POST['edit_banner'];

            if ($edit) {
                if ($nama_gambar == "") {
                    $updateQuery = $mysqli->prepare("UPDATE banner SET status=? WHERE banner_id=?");
                    $updateQuery->bind_param("si", $status, $banner_id);
                    $updateQuery->execute();

                    if ($updateQuery->affected_rows > 0) {
                        ?>
                        <script type="text/javascript">
                            alert("data berhasil diedit");
                            window.location.href="../ta/halaman_admin.php?page=banner";
                        </script>
                        <?php
                    } else {
                        ?>
                        <script type="text/javascript">
                            alert("data tidak berubah");
                        </script>
                        <?php
                    }

                    $updateQuery->close();
                } else {
                    $pindah = move_uploaded_file($sumber, $target . $nama_gambar);

                    if ($pindah) {
                        $updateQuery = $mysqli->prepare("UPDATE banner SET gambar=?, status=? WHERE banner_id=?");
                        $updateQuery->bind_param("ssi", $nama_gambar, $status, $banner_id);
                        $updateQuery->execute();

                        if ($updateQuery->affected_rows > 0) {
                            ?>
                            <script type="text/javascript">
                                alert("data berhasil diedit");
                                window.location.href="../ta/halaman_admin.php?page=banner";
                            </script>
                            <?php
                        } else {
                            ?>
                            <script type="text/javascript">
                                alert("data tidak berubah");
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
        </div>
    </div>
</div>
