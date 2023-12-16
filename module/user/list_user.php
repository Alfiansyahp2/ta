
    <div class="card-title" style="text-align: center;">
        <h4>Tabel User</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="datatables">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;  // Ganti dengan koneksi database yang sesuai
                    if ($mysqli->connect_error) {
                        die("Koneksi database gagal: " . $mysqli->connect_error);
                    }

                    $query = "SELECT * FROM user";
                    $result = $mysqli->query($query);

                    if ($result->num_rows > 0) {
                        while ($data = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['nama_lengkap']; ?></td>
                                <td><?php echo $data['email']; ?></td>
                                <td><?php echo $data['no_telp']; ?></td>
                                <td><?php echo $data['username']; ?></td>
                                <td><?php echo $data['level']; ?></td>
                                <td><?php echo $data['status']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="?page=user&action=edit&user_id=<?php echo $data['user_id']; ?>">Edit</a>
                                            <a class="dropdown-item" onclick="return confirm('Yakin ingin menghapus data ?')" href="?page=user&action=hapus&user_id=<?php echo $data['user_id']; ?>">Hapus</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        echo "Tidak ada data user.";
                    }
                    $mysqli->close();
                    ?>
                </tbody>
            </table>
            <a href="?page=user&action=tambah_user" class="btn btn-success">+ Tambah User</a>
        </div>
    </div>

