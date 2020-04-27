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

function caribarang($keyword, $searchby)
{
    $query = "SELECT * FROM tb_barang
                WHERE $searchby LIKE '%$keyword%' ";
    return lihatbarang($query);
}

function tambahbarang($data)
{
    global $conn;

    $nama_barang = $data["nama_barang"];
    $merk = $data["merk"];
    $type = $data["type"];
    $description = $data["description"];
    $harga = (int) $data["harga"];
    $stok = (int) $data["stok"];

    $query = "INSERT INTO tb_barang VALUES
    ('', '' ,'$nama_barang', '$merk', '$type', '$description' ,$harga, $stok, current_timestamp())";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deletebarang($data)
{
    global $conn;

    $id = $data["delete"];

    $query = "DELETE FROM tb_barang WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
