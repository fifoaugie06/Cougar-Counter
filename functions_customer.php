<?php
include 'koneksi.php';

function lihatpembeli($query)
{
    global $conn;

    $result = mysqli_query($conn, "$query");
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function caripembeli($keyword, $searchby)
{
    $query = "SELECT * FROM tb_pembeli
                WHERE $searchby LIKE '%$keyword%' ";
    return lihatpembeli($query);
}

function tambahpembeli($data)
{
    global $conn;

    $nama = $data["nama"];
    $alamat = $data["alamat"];
    $kota = $data["kota"];
    $jenis_kelamin = $data["jenis_kelamin"];
    $email = $data["email"];
    $password_default = "123456";
    $password_hash = password_hash($password_default, PASSWORD_DEFAULT);

    $query = "INSERT INTO tb_pembeli VALUES
    ('', '$nama', '$jenis_kelamin', '$alamat', '$kota', '$email' ,'$password_hash')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updatepembeli($data)
{

    global $conn;

    $id = (int) $data["id_update"];
    $nama = $data["nama"];
    $alamat = $data["alamat"];
    $kota = $data["kota"];
    $email = $data["email"];
    $jenis_kelamin = $data["jenis_kelamin"];
    $password = $data["password"];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    var_dump(strlen($password));

    if (strlen($password) == 0) {
        $query = "UPDATE tb_pembeli
        SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat',
        kota = '$kota', email = '$email'
        WHERE id = $id";
    }else{
        $query = "UPDATE tb_pembeli
        SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat',
        kota = '$kota', email = '$email' ,password = '$password_hash'
        WHERE id = $id";
    }
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function deletepembeli($data)
{
    global $conn;

    $id = $data["delete"];

    $query = "DELETE FROM tb_pembeli WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
