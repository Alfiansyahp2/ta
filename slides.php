<?php
	include "koneksi.php";
?>

<div id="slides">
    <?php
    $querybanner = mysqli_query($mysqli, "SELECT * FROM banner WHERE status='on' ORDER BY banner_id DESC LIMIT 3");
    while ($rowbanner = mysqli_fetch_assoc($querybanner)) {
        echo "<img src='images/{$rowbanner['gambar']}' />";
    }
    ?>
</div>

<div class='row'>
    <?php
    $querykatalog = mysqli_query($mysqli, "SELECT kategori.kategori, kue.id_kue, kue.nama_kue, kue.spesifikasi, kue.gambar, kue.harga FROM kategori RIGHT JOIN kue ON kategori.id_kategori = kue.id_kategori WHERE kategori='katalog' AND kue.status='on' ORDER BY RAND() LIMIT 9") or die(mysqli_error($mysqli));
    while ($rowkatalog = mysqli_fetch_assoc($querykatalog)) {
        echo "<div class='col-lg-4 col-md-6 mb-4'>
            <div class='card h-100'>
                <img class='card-img-top' src='images/kue/{$rowkatalog['gambar']}' alt='gambar'>
                <div class='card-body'>
                    <h4 class='card-title' style='color: blue;'>{$rowkatalog['nama_kue']}</h4>
                    <h5>" . rupiah($rowkatalog['harga']) . "</h5>
                    <p class='card-text'>{$rowkatalog['spesifikasi']}</p>
                </div>
                <div class='card-footer'>
                    <small class='text-muted'><a href='tambah_keranjang.php?id_kue={$rowkatalog['id_kue']}' class='btn btn-danger'>+Masukan Keranjang</a></small>
                </div>
            </div>
        </div>";
    }
    ?>
</div>