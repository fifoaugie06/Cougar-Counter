<?php

if (isset($_SESSION['userlogin'])) {
    header("Location: homepage/homepage.php");
    exit;
}

if (!isset($_SESSION)) {

    session_start();
}


require "koneksi.php";


function registrasi($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $kota = htmlspecialchars($data['kota']);
    $alamat = htmlspecialchars($data['alamat']);
    $jenis_kelamin = $data['jenis_kelamin'];
    $email = htmlspecialchars($data['email']);
    $password = $data['password'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // cek email sudah terdaftar di db atau belum
    $result = mysqli_query($conn, "SELECT email FROM tb_pembeli WHERE email = '$email'");

    if (mysqli_fetch_assoc($result)) {
        return false;
    }


    $query = "INSERT INTO tb_pembeli VALUES
    (NULL, '$nama', '$jenis_kelamin', '$alamat', '$kota', '$email' ,'$password_hash')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function auth($data)
{
    global $conn;

    $email = $data['email'];
    $password = $data['password'];

    // cek email dulu
    $result = mysqli_query($conn, "SELECT * FROM tb_pembeli WHERE email = '$email'");
    if (mysqli_num_rows($result) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            // set session
            $_SESSION["userlogin"] = true;
            $_SESSION["userloginid"] = $row['id'];

            header("Location: homepage/homepage.php");
            exit;
        }
    }
}
