<?php
    $id_kota = @$_GET['user_id'];
    $query = "SELECT * FROM user WHERE user_id='$id_kota'";
    $result = $mysqli->query($query);
 
    if ($result) {
        $data = $result->fetch_assoc();
        $status = $data['status'];
        $level = $data['level']; // Add this line to define $level
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
if (isset($_POST['edit_user'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telp = $_POST['telp'];
    $user = $_POST['username'];
    $pass = $_POST['pass'];
    $level = $_POST['level'];
    $status = $_POST['status'];

    $updateQuery = $mysqli->prepare("UPDATE user SET nama_lengkap=?, email=?, no_telp=?, username=?, password=md5(?), level=?, status=? WHERE user_id=?");

    // Bind the parameters
    $updateQuery->bind_param("sssssssi", $nama, $email, $telp, $user, $pass, $level, $status, $id_kota); // Change $user_id to $id_kota

    if ($updateQuery->execute()) {
        ?>
        <script type="text/javascript"> alert("Data user berhasil diedit");
            window.location.href="../ta/halaman_admin.php?page=user";
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript"> alert("Update user failed: <?php echo $mysqli->error; ?>");
        </script>
        <?php
    }
    $updateQuery->close();
}

?>