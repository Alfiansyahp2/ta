	<div class="card-title" style="text-align:center;">
			<h4>Tabel Banner</h4>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="datatables">
                <thead>
                    <tr>
						<th>NO</th>
                    	<th>Gambar</th>
                		<th>Status</th>
                		<th>Action</th>
                    </tr>
                </thead>
                <tbody>
						<?php
							$no = 1;
							$query = "SELECT * FROM banner";
							$result = $mysqli->query($query);
							
							if ($result) {
								while ($data = $result->fetch_assoc()) {
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $data['gambar']; ?></td>
										<td><?php echo $data['status']; ?></td>
										<td>
											<div class="btn-group">
												<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Action
												</button>
												<div class="dropdown-menu">
													<a class="dropdown-item" href="?page=banner&action=edit&banner_id=<?php echo $data['banner_id']; ?>">Edit</a></br>
													<a class="dropdown-item" onclick="return confirm('yakin ingin menghapus data ?')" href="?page=banner&action=hapus&banner_id=<?php echo $data['banner_id']; ?>">Hapus</a>
												</div>
											</div>
										</td>
									</tr>
									<?php
								}
							} else {
								die("Gagal menjalankan query: " . $mysqli->error);
							}
							
						?>
                    </tbody>
            </table>
            <a href="?page=banner&action=tambah_banner" class="btn btn-success">+Tambah Banner</a>
        </div>
    </div>
</div>
