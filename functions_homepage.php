<?php
include 'koneksi.php';

function lihathomepage($query)
{
    global $conn;

    $result = mysqli_query($conn, "$query");
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// total product
$countAllProduct = lihathomepage("SELECT COUNT(id) AS total_product FROM tb_barang");
$countAllProduct = $countAllProduct[0]['total_product'];

// sum stok belum terjual
$sumNotSoldYet = lihathomepage("SELECT SUM(stok) AS belum_terjual FROM tb_barang");
$sumNotSoldYet = $sumNotSoldYet[0]['belum_terjual'];

// last update
$lastUpdate = lihathomepage("SELECT DATE_FORMAT(MAX(last_update),'%k.%i;%a, %d %b %Y') AS last_update FROM tb_barang");
$lastUpdate = $lastUpdate[0]['last_update'];
$lastUpdateFormat = explode(";", $lastUpdate);

// total transaksi
$countTotallySold = lihathomepage("SELECT COUNT(id_transaksi) AS total_product FROM tb_transaction");
$countTotallySold = $countTotallySold[0]['total_product'];

function orderbarang($data)
{
    global $conn;

    $kode_barang = (int) $data['kode_barang'];
    $kode_pembeli = (int) $data['kode_pembeli'];

    $query = "INSERT INTO tb_transaction VALUES('', $kode_barang, $kode_pembeli, current_timestamp())";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updatestok($data)
{
    global $conn;

    $id_barang = (int) $data['kode_barang'];
    $query = "SELECT stok FROM tb_barang WHERE id = $id_barang";
    $stok = (int) lihathomepage($query)[0]['stok'];
    $stok -= 1;

    $queryupdate = "UPDATE tb_barang SET stok = $stok, last_update = current_timestamp()
                    WHERE id = $id_barang";
    
    mysqli_query($conn, $queryupdate);

    return mysqli_affected_rows($conn);
}
