

<?php
$id_pesanan = $_GET["id_pesanan"];


?>

<div class="col-lg-4">
    <div class="card-title">
        <h4>Diskon</h4>
    </div>
    <div class="card-body">
        <div class="basic-form">
		<form action="module/pesanan/proses_konfirmasi.php?id_pesanan=<?php echo $id_pesanan; ?>" method="POST">
    <div class="form-group">
        <label>Pesanan Id (Faktur Id)</label>
        <input type="text" class="form-control" value="<?php echo $id_pesanan; ?>" name="id_pesanan" readonly="readonly" />
    </div>
	<?php
include "koneksi.php";

// Use prepared statements to prevent SQL injection
$query = "SELECT pesanan.id_pesanan, pesanan.nama_penerima, pesanan_detail.harga FROM pesanan JOIN pesanan_detail ON pesanan.id_pesanan=pesanan_detail.id_pesanan WHERE pesanan.id_pesanan=?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $id_pesanan);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    die("Query failed: " . $mysqli->error);
}

$row = $result->fetch_assoc();
$nama_penerima = $row['nama_penerima'];
$harga = $row['total_harga'];
?>

<div class="form-group">
    <label>Nama Penerima</label>
    <input type="text" class="form-control" value="<?php echo $nama_penerima; ?>" name="nama_penerima" readonly="readonly" />
</div>
    <div class="form-group">
        <label>Subtotal</label>
        <input type="text" class="form-control" value="<?php echo $harga; ?>" name="harga" id="harga" readonly="readonly" />
    </div>
    <div class="form-group">
        <label>Diskon</label>
        <input type="text" type="number" class="form-control" name="diskon" id="diskon" oninput="Diskon()" />
    </div>
    <div class="form-group">
        <label>Total Harga</label>
        <input type="text" class="form-control" name="total_harga" id="total" readonly="readonly" />
    </div>
    <input class="btn btn-success" type="submit" name="diskon" />
</form>
     </div>
    </div>
</div>
<script>
	function Diskon(){
		var harga = document.getElementById("harga").value
		var diskon = document.getElementById("diskon").value
		
		var totalharga =  harga - diskon 
		
		document.getElementById("total").value = totalharga
	}
</script>