<?php
require('fpdf.php');
include('../../../koneksi.php');

$pdf = new FPDF();
$pdf->AddPage();

$pdf->Image('logo.jpg', 15, 10, 20);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 5, 'Laporan Pembayaran Masuk Pembelian Kue Ulang Tahun', '0', '1', 'C', false);
$pdf->Cell(0, 5, 'Le Dian Hotel', '0', '1', 'C', false);
$pdf->SetFont('Arial', 'i', 8);
$pdf->Cell(0, 2, 'Alamat : JL. Jendral Sudirman No. 88 sumer pecung Kec.Serang Kota Serang ', '0', '1', 'C', false);
$pdf->Ln(5);
$pdf->Cell(265, 0.6, '', '0', '1', 'C', true);
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 6, 'No', 1, 0, 'c');
$pdf->Cell(40, 6, 'Nama Akun', 1, 0, 'c');
$pdf->Cell(30, 6, 'Subtotal', 1, 0, 'c');
$pdf->Ln(2);

$no = 0;
$tgl1 = $_POST['tgl1'];
$tgl2 = $_POST['tgl2'];

// Replace this part with MySQLi
 

$query = "SELECT pesanan_detail.harga, konfirmasi_pembayaran.nama_account
          FROM pesanan_detail
          JOIN konfirmasi_pembayaran
          ON pesanan_detail.id_pesanan = konfirmasi_pembayaran.id_pesanan
          WHERE tgl_transfer BETWEEN '$tgl1' AND '$tgl2'";

$result = $mysqli->query($query);

if ($result) {
    $total = 0;

    while ($data = $result->fetch_assoc()) {
        $harga = $data['harga'];
        $total += $harga;
        $no++;

        $pdf->Ln(4);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 4, $no . '.', 1, 0, 'L');
        $pdf->Cell(40, 4, $data['nama_account'], 1, 0, 'L');
        $pdf->Cell(30, 4, "Rp." . $harga, 1, 0, 'L');
    }

    $pdf->Ln(4);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(50, 6, 'Total', 1, 0, 'c');
    $pdf->Cell(30, 6, "Rp." . $total, 1, 0, 'c');

    $result->free(); // Free the result set
}

$mysqli->close(); // Close the MySQLi connection

$pdf->Output();
?>
