<?php

	$id_pesanan = $_GET["id_pesanan"];
	
?>

<div class="col-lg-4">
    
        <div class="card-title">
            <h4>Form Kirim Pesanan</h4>
        </div>
<div class="card-body">
<div class="basic-form">
<form action="module/pesanan/proses_konfirmasi.php?id_pesanan=<?php echo $id_pesanan; ?>" method="POST">
						
	<div class="form-group">
		<label>Pesanan Id (Faktur Id)</label>    
		<input type="text" class="form-control" value="<?php echo $id_pesanan; ?>" name="id_pesanan" readonly="true" />
	</div>  
	<div class="form-group">
		<label>Pengirim</label>
		<select name="id_karyawan" class="form-control">
							
			<?php
				include "koneksi.php";  
$db = $mysqli->query("SELECT * FROM karyawan");

if ($db === false) {
    die("Query failed: " . $mysqli->error);
}

while ($data = $db->fetch_assoc()) {
?>
    <option value="<?php echo $data['id_karyawan']; ?>"><?php echo $data['nama_karyawan']; ?></option>
<?php
}
?>

								
		</select>
	</div> 
	<div class="form-group">
    <label for="status">Status</label>
    <select class="form-control" name="status" id="status" required>
        <option value="Dalam perjalan">dalam perjalanan</option>
        <option value="Sampai">sampai</option>
        <!-- Tambahkan opsi sesuai kebutuhan Anda -->
    </select>
</div>

	</div>  
	
		<input class="btn btn-success" type="submit" value="Kirim" name="kirimp" />
	
</form> 
</div> 
</div> 
</div> 