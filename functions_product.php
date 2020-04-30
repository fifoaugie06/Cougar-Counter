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

    $nama_barang = htmlspecialchars($data["nama_barang"]);
    $merk = htmlspecialchars($data["merk"]);
    $type = htmlspecialchars($data["type"]);
    $description = htmlspecialchars($data["description"]);
    $harga = (int) $data["harga"];
    $stok = (int) $data["stok"];

    // upload gambar
    $gambar = upload();

    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO tb_barang VALUES
    (NULL, '$gambar' ,'$nama_barang', '$merk', '$type', '$description' ,$harga, $stok, current_timestamp())";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek yang diaplot gambar atau bukan
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        return false;
    }

    // cek ukuran gambar < 2Mb
    if ($ukuranFile > 2000000) {
        return false;
    }

    // gambar siap aplot dan generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img/' . $namaFileBaru);

    return $namaFileBaru;
}


function updatebarang($data)
{
    global $conn;

    $id = (int) $data["id"];
    $nama_barang = htmlspecialchars($data["nama_barang"]);
    $merk = htmlspecialchars($data["merk"]);
    $type = htmlspecialchars($data["type"]);
    $description = htmlspecialchars($data["description"]);
    $harga = (int) $data["harga"];
    $stok = (int) $data["stok"];
    $gambarLama = $data['gambarLama'];

    // cek user pilih gambar baru / tidak
    if ( $_FILES['gambar']['error'] === 4 ){
        $gambar = $gambarLama;
    }else{
        $gambar = upload();
    }

    $query = "UPDATE tb_barang
        SET gambar = '$gambar', nama_barang = '$nama_barang' , merk = '$merk', type = '$type', 
            description = '$description' , harga = $harga, stok = $stok, last_update = current_timestamp()
        WHERE id = $id";


    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function deletebarang($data)
{
    global $conn;

    $id = (int)$data["id"];

    $query = "DELETE FROM tb_barang WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
