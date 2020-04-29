<?php
session_start();

if ( isset($_SESSION['userlogin'])){
    
    header('location: homepage/homepage.php');
    exit;
}

require 'functions_signin_signup.php';

if ( isset($_POST['login']) ){
    auth($_POST);
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
            <h3 class="h3" style="margin-bottom: 16px; text-align: center;">Login Account</h3>
            <div class="form-group" style="margin-top: 32px">
                <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <button class="btn btn-dark" type="submit" id="btn_submit" name="login">Login</button>
            <div class="text-center register">
                <p style="margin-top: 16px;">Belum punya Akun? <a href="signup.php">Klik Disini</a></p>
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