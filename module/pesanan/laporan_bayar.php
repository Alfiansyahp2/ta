<div class="card-title" style="text-align:center;">
    <h2>Tabel Laporan</h2>
</div>
<br>
<div class="btn-container" style="margin: 30px;">
    <!-- Tambahkan form untuk filter bulan -->
    <form method="post">
        <label for="bulan">Pilih Bulan:</label>
        <select name="bulan" id="bulan">
            <option value="">Semua Bulan</option> <!-- Opsi baru untuk menampilkan semua bulan -->
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
            <!-- Tambahkan opsi bulan lainnya sesuai kebutuhan -->
        </select>
        <input type="submit" class="btn btn-primary" name="filter" value="Filter">
    	<!-- Ubah input type button menjadi button -->
		<button type="button" class="btn btn-primary" onclick="printTable()">Cetak</button>

    </form>
</div>
<div class="card-body">
	<div class="table-responsive">
		<table class="table table-hover" id="datatables">
			<thead>
				<tr>
					<th>NO</th>
					<th>Nama Akun</th>
					<th>Nomor Rekening</th>
					<th>Tanggal Pembayaran</th>
					<th>Jumlah pesanan</th>
					<th>Total Harga</th>
					<th>Bukti Pembayaran</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if (isset($_POST['bulan']) ) {
					$bulanFilter = $_POST['bulan'];
					$query = "SELECT * FROM konfirmasi_pembayaran 
							WHERE MONTH(konfirmasi_pembayaran.tgl_transfer) = '$bulanFilter'";
				} else {
					$query = "SELECT * FROM konfirmasi_pembayaran ";
				}
				$no = 1;
				//$query = "SELECT * FROM konfirmasi_pembayaran JOIN pesanan ON pesanan.id_pesanan = konfirmasi_pembayaran.konfirmasi_id;";
				$result = $mysqli->query($query);

				if ($result) {
					while ($data = $result->fetch_assoc()) {
						$idpesanan = $data['id_pesanan'];
						//;
						$kota  = "SELECT pesanan.id_kota, kota.tarif FROM pesanan JOIN kota ON pesanan.id_kota = kota.id_kota WHERE pesanan.id_pesanan='$idpesanan';";
						$ambil = $mysqli->query($kota);
						$kotanya = $ambil->fetch_assoc();
						$queryTotalHarga = "SELECT id_pesanan, SUM(harga * qty) AS total_harga FROM pesanan_detail WHERE id_pesanan = '$idpesanan' GROUP BY id_pesanan;";
						$ambil2 = $mysqli->query($queryTotalHarga);
						$detail2 = $ambil2->fetch_assoc();
						$qty = "SELECT id_pesanan, SUM(qty) AS qty FROM pesanan_detail WHERE id_pesanan = '$idpesanan' GROUP BY id_pesanan;";
						$qtt = $mysqli->query($qty);
						$qtyy = $qtt->fetch_assoc();

						 
				?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data['nama_account']; ?></td>
							<td><?php echo $data['no_rek']; ?></td>
							<td><?php echo date('d-m-Y', strtotime($data['tgl_transfer'])); ?></td>
							<td><?php echo $qtyy['qty']; ?></td>
							<td>Rp. <?php echo number_format($detail2['total_harga']+$kotanya['tarif']) . ",00" ?></td>

							<td>
								<?php if (!empty($data['bukti_pembayaran'])) : ?>
									<?php
									$imagePath = 'images/bukti/' . $data['bukti_pembayaran'];
									// Check if the path is relative, if yes, add the base directory
									if (!file_exists($imagePath)) {
										$imagePath = __DIR__ . '/' . $imagePath;
									}
									?>
									<a href="<?php echo $imagePath; ?>" target="_blank">
										<img src="<?php echo $imagePath; ?>" alt="Bukti Pembayaran" style="max-width: 100px;">
									</a>
								<?php else : ?>
									Tidak Ada Bukti Pembayaran
								<?php endif; ?>
							</td>
						</tr>
				<?php
					}
				} else {
					die("Gagal menjalankan query: " . $mysqli->error);
				}
				?>
				<?php
				if (isset($_POST['cetak'])) {
						echo "<script>window.print();</script>";
					}
					?>
					<script>
						function printTable() {
							var printContents = document.getElementById('datatables').outerHTML;
							var originalContents = document.body.innerHTML;
							document.body.innerHTML = printContents;
							window.print();
							document.body.innerHTML = originalContents;
						}
					</script>
			</tbody>
		</table>
	</div>
</div>