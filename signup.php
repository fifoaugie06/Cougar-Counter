<?php
session_start();

if ( isset($_SESSION['userlogin'])){
    
    header('location: homepage/homepage.php');
    exit;
}

require "functions_signin_signup.php";
if( isset($_POST["submit"]) ){
    if(registrasi($_POST) > 0){
        echo "<script>
                    alert('Berhasil Registrasi!');
                    window.location.href = 'signup.php';
                </script>
        ";
    }else{
        echo "<script>
                    alert('Email sudah terdaftar!');
                    window.location.href = 'signup.php';
                </script>
            ";
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="style/style.css">

    <title>Cougar Counter</title>
</head>

<body style="background-color: #2c3e50;">
    <div class="align-middle wrapper card">
        <form action="" method="post">
            <h3 class="h3" style="margin-bottom: 16px; text-align: center;">Register New Account</h3>
            <div class="form-group" style="margin-top: 32px;">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="kota" name="kota" placeholder="Kota" required>
            </div>
            <div class="form-group">
                <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" required></textarea>
            </div>
            <div class="form-group">
                <select id="jenis_kelamin" class="form-control" name="jenis_kelamin">
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <button class="btn btn-dark" type="submit" id="btn_submit" name="submit">Register</button>
            <div class="text-center register">
                <p style="margin-top: 16px;">Sudah punya Akun? <a href="signin.php">Klik Disini</a></p>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- WAJIB VERSI 3.4.1 -->
    <script src="script/jquery.min.js"> </script>
    <script src="script/script.js"></script>
    <script src="script/popper.min.js"></script>
    <script src="script/bootstrap.min.js"></script>
</body>

</html>