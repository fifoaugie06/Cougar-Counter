<?php
require 'koneksi.php';

function lihattransaksi(){
    global $conn;
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

    $result = mysqli_query($conn, "$query");
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
