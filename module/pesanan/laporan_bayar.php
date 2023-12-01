<div class="container">
	<h3>Laporan Pembayaran</h3><br>

	<form class="form-inline my-2 my-lg-0 mr-lg-2" action="module/pesanan/pdf/cetak_bayar.php" method="post">

		<div class="input-group">
			<label for="tgl" class="col-sm-2 control-label">Tgl</label>
			<input class="form-control" type="date" name="tgl1">S/d
			<input class="form-control" type="date" name="tgl2">
		</div>

		<style>
			.btn-container {
				margin-right: 30px;
				/* Atur margin kanan sesuai kebutuhan */
			}
		</style>

		<div class="btn-container">
			<input type="submit" class="btn btn-primary" name="lihat" value="Lihat">
		</div>

		<div class="btn-container">
			<input type="submit" class="btn btn-primary" name="cetak" value="Cetak">
		</div>


	</form>
	<br><br>
</div>
<div class="card-title" style="text-align:center;">
	<h4>Tabel Laporan bayar</h4>

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
					<th>total pesanan</th>
					<th>Bukti Pembayaran</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				$query = "SELECT * FROM konfirmasi_pembayaran";
				$result = $mysqli->query($query);

				if ($result) {
					while ($data = $result->fetch_assoc()) {
				?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data['nama_account']; ?></td>
							<td><?php echo $data['no_rek']; ?></td>
							<td><?php echo date('d-m-Y', strtotime($data['tgl_transfer'])); ?></td>
							<td><?php echo $data['total_pembayaran']; ?></td>
							<td>
								<?php if (!empty($data['bukti_pembayaran'])) : ?>
									<img src="images/bukti/<?php echo $data['bukti_pembayaran']; ?>" alt="Bukti Pembayaran" style="max-width: 100px;">
								<?php else : ?>
									Tidak Ada Bukti Pembayaran
								<?php endif; ?>
							</td>

							<!-- <td>
											<div class="btn-group">
												<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Action
												</button>
												<div class="dropdown-menu">
													<a class="dropdown-item" href="?page=kota&action=edit&id_kota=<?php echo $data['id_kota']; ?>">Edit</a>
													<a class="dropdown-item" onclick="return confirm('yakin ingin menghapus data ?')" href="?page=kota&action=hapus&id_kota=<?php echo $data['id_kota']; ?>">Hapus</a>
												</div>
											</div>
										</td> -->
						</tr>
				<?php
					}
				} else {
					die("Gagal menjalankan query: " . $mysqli->error);
				}

				?>
			</tbody>
		</table>
		<!-- <a href="?page=kota&action=tambah_kota" class="btn btn-success">+Tambah Kecamatan</a> -->
	</div>
</div>

</div>