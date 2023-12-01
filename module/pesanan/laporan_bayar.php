<div class="card-title" style="text-align:center;">
    <h4>Tabel Laporan</h4>
</div>
<div class="btn-container">
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
	<table class="table table-hover" id="datatables" id="printTable">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama Akun</th>
                    <th>Nomor Rekening</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Total Harga</th>
                    <th>Bukti Pembayaran</th>
                </tr>
            </thead>
            <tbody>
				<?php
					include "../../koneksi.php";
					$no = 1;

					// Modifikasi query untuk menyertakan filter bulan
					$bulanFilter = isset($_POST['bulan']) ? $_POST['bulan'] : '';
					if ($bulanFilter) {
						$query = "SELECT * FROM konfirmasi_pembayaran 
								JOIN pesanan ON pesanan.id_pesanan = konfirmasi_pembayaran.konfirmasi_id 
								JOIN pesanan_detail ON pesanan.id_pesanan = pesanan_detail.id_pesanan
								WHERE MONTH(konfirmasi_pembayaran.tgl_transfer) = '$bulanFilter'";
					} else {
						$query = "SELECT * FROM konfirmasi_pembayaran 
								JOIN pesanan ON pesanan.id_pesanan = konfirmasi_pembayaran.konfirmasi_id 
								JOIN pesanan_detail ON pesanan.id_pesanan = pesanan_detail.id_pesanan";
					}

					$result = $mysqli->query($query);

					if ($result) {
						while ($data = $result->fetch_assoc()) {
							// Menampilkan total harga
							$idPesanan = $data['id_pesanan'];
							$queryTotalHarga = "SELECT SUM(harga) AS total_harga FROM pesanan_detail WHERE id_pesanan = ?";

							// Persiapkan statement
							$stmt = $mysqli->prepare($queryTotalHarga);
							if (!$stmt) {
								die("Gagal mempersiapkan statement: " . $mysqli->error);
							}

							$stmt->bind_param("i", $idPesanan); // Gunakan "i" untuk tipe data integer (id_pesanan)
							if (!$stmt->execute()) {
								die("Gagal mengeksekusi statement: " . $stmt->error);
							}

							// Ambil hasil query
							$resultTotalHarga = $stmt->get_result();
							if (!$resultTotalHarga) {
								die("Gagal mendapatkan hasil query: " . $stmt->error);
							}

							$dataTotalHarga = $resultTotalHarga->fetch_assoc();
							if (!$dataTotalHarga) {
								die("Gagal mendapatkan data total harga");
							}

							$totalHarga = $dataTotalHarga['total_harga'];

							// Tutup statement
							$stmt->close();

							echo "<tr>";
							echo "<td>$no</td>";
							echo "<td>{$data['nama_account']}</td>";
							echo "<td>{$data['no_rek']}</td>";
							echo "<td>" . date('d-m-Y', strtotime($data['tgl_transfer'])) . "</td>";
							echo "<td>Rp " . number_format($totalHarga, 2, ',', '.') . ",00</td>";
							echo "<td>";

							if (!empty($data['bukti_pembayaran'])) {
								$imagePath = 'images/bukti/' . $data['bukti_pembayaran'];
								// Check if the path is relative, if yes, add the base directory
								if (!file_exists($imagePath)) {
									$imagePath = __DIR__ . '/' . $imagePath;
								}
								echo "<a href='$imagePath' target='_blank'><img src='$imagePath' alt='Bukti Pembayaran' style='max-width: 100px;'></a>";
							} else {
								echo "Tidak Ada Bukti Pembayaran";
							}

							echo "</td>";
							echo "</tr>";

							$no++;
						}

						// Tutup koneksi
						$mysqli->close();
					} else {
						die("Gagal menjalankan query: " . $mysqli->error);
					}

					// Fungsi Cetak
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
