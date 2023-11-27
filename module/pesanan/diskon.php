<?php

	$id_pesanan = $_GET["id_pesanan"];
	
?>

<div class="col-lg-4">
    
        <div class="card-title">
            <h4>Diskon</h4>
        </div>
<div class="card-body">
<div class="basic-form">
<form action="module/pesanan/diskon.php?id_pesanan=<?php echo $id_pesanan; ?>" method="POST">
						
	<div class="form-group">
		<label>Pesanan Id (Faktur Id)</label>    
		<input type="text" class="form-control" value="<?php echo $id_pesanan; ?>" name="id_pesanan" readonly="true" />
	</div>  
	<div class="form-group">
		<label>total pembayaran :</label>
		<select name="id_pesanan" class="form-control">
							
			<?php
				include "koneksi.php"; 
				$query = "SELECT * FROM pesanan_detail";
				$result = $mysqli->query($query);

				if ($result === false) {
					die("Query failed: " . $mysqli->error);
				}

				while ($data = $result->fetch_assoc()) {
				?>
					<option value="<?php echo $data['id_pesanan']; ?>"><?php echo $data['harga']; ?></option>
				<?php
				}
				?>
								
		</select>
	</div> 
	<div class="form-group">
		<label>Diskon</label>    
		<input type="text" class="form-control"  name="diskon" required />
	</div>  
    <div class="form-group">
		<label>total+diskon</label>    
		<input type="text" class="form-control"  name="total_akhir" required />
	</div>
	
		<input class="btn btn-success" type="submit" value="Konfirmasi" name="konfirmasi" />
	
</form> 
</div> 
</div> 
</div> 