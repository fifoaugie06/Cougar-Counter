<?php
require 'koneksi.php';

function lihattransaksi($query){
    global $conn;

    $result = mysqli_query($conn, "$query");
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// lihat transaksi
$query = "SELECT T.tanggal_beli AS tanggal_pembelian,
                P.nama AS detail_pembeli,
                CONCAT(CONCAT(CONCAT(B.nama_barang, ' - '), B.merk, ' '), B.type) AS detail_barang,
                B.harga AS harga
                FROM tb_pembeli P
                INNER JOIN tb_transaction T
                ON P.id = T.kode_pembeli
                INNER JOIN tb_barang B
                ON B.id = T.kode_barang
";

// Proses Pagination
$jumlahDataPerhalaman = 10;
$jumlahDataKeseluruhan = count(lihattransaksi($query));
$jumlahHalaman = ceil($jumlahDataKeseluruhan / $jumlahDataPerhalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;