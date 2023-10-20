 <div class="card-title" style="text-align:center;">
	<h4>Pesanan</h4>
 </div>
<?php

 
include "koneksi.php";

if ($level == "admin") {
    $queryPesanan = "SELECT pesanan.*, user.nama_lengkap FROM pesanan JOIN user ON pesanan.user_id = user.user_id WHERE pesanan.status = 1";
} else {
    $queryPesanan = "SELECT pesanan.*, user.nama_lengkap FROM pesanan JOIN user ON pesanan.user_id = user.user_id WHERE pesanan.user_id = ? ORDER BY pesanan.tgl_pemesanan DESC";
}

// Create a connection to the database
 
if ($level != "admin") {
    // Use a prepared statement to select user-specific orders
    $stmt = $mysqli->prepare($queryPesanan);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            echo "<h3>Saat ini belum ada data pesanan</h3>";
        } else {
            echo "<table class='table table-hover' id='datatables'>
                <thead>
                <tr>
                    <th>Nomor Pesanan</th>
                    <th>Status</th>
                    <th>Nama Akun</th>
                    <th>Action</th>
                </tr>
                </thead>";
            echo "<tbody>";

            while ($row = $result->fetch_assoc()) {
                $adminbutton = "";
                $konfirmasi = "";
                $kirim = "";

                $status = $row['status'];
                echo "<tr>
                        <td>$row[id_pesanan]</td>
                        <td>$arrayStatusPesanan[$status]</td>
                        <td>$row[nama_lengkap]</td>
                        <td>
                            <a class='btn btn-success' href='index.php?page=pesanan&module=pesanan&action=detail&id_pesanan=$row[id_pesanan]'>Detail</a>
                            $adminbutton
                            $konfirmasi
                            $kirim
                        </td>
                     </tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }
    } else {
        echo '<div class="warning">Error executing the query: ' . $mysqli->error . '</div>';
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Admin code here
}
 
?>

	
?>