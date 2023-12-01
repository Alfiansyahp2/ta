<div class="card-title" style="text-align:center;">
    <h4>Tabel Laporan</h4>
</div>

<div class="card-body">
    <!-- Form filter bulan -->
    <form method="post">
        <label for="bulan">Pilih Bulan:</label>
        <select name="bulan" id="bulan">
            <?php
            // Menampilkan dropdown bulan
            for ($i = 1; $i <= 12; $i++) {
                $selected = ($i == date('n')) ? 'selected' : '';
                echo "<option value='$i' $selected>$i - " . date("F", mktime(0, 0, 0, $i, 1)) . "</option>";
            }
            ?>
        </select>
        <input type="submit" class="btn btn-primary" name="pilih" value="pilih">
    </form>

    <div class="table-responsive">
        <table class="table table-hover" id="datatables">
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
                $no = 1;
                // Modifikasi query untuk mengambil data sesuai bulan yang dipilih
                $selectedMonth = isset($_POST['bulan']) ? $_POST['bulan'] : date('n');
                $query = "SELECT * FROM konfirmasi_pembayaran 
                          JOIN pesanan ON pesanan.id_pesanan = konfirmasi_pembayaran.konfirmasi_id 
                          JOIN pesanan_detail ON pesanan.id_pesanan = pesanan_detail.id_pesanan
                          WHERE MONTH(tgl_transfer) = $selectedMonth;";
                $result = $mysqli->query($query);

                if ($result) {
                    while ($data = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['nama_account']; ?></td>
                            <td><?php echo $data['no_rek']; ?></td>
                            <td><?php echo date('d-m-Y', strtotime($data['tgl_transfer'])); ?></td>
                            <td><?php echo $data['total_harga']; ?></td>
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
            </tbody>
        </table>
    </div>
</div>
