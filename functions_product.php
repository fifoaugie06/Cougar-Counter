<?php
include 'koneksi.php';

function lihatbarang($query)
{
    global $conn;

    $result = mysqli_query($conn, "$query");
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambahbarang($data)
{
    global $conn;

    $nama_barang = $data["nama_barang"];
    $merk = $data["merk"];
    $type = $data["type"];
    $harga = (int) $data["harga"];
    $stok = (int) $data["stok"];

    $query = "INSERT INTO tb_barang VALUES
    ('', '$nama_barang', '$merk', '$type', $harga, $stok, current_timestamp())";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

?>