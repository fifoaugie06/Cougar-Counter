<?php
session_start();

if (!isset($_SESSION['userlogin'])) {

    header('location: ../signin.php');
    exit;
}

require '../functions_transactions.php';

// lihat transaksi
$transaksi = lihattransaksi();


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../style/style.css">

    <title>Transaction</title>
</head>

<body>
    <!-- Image and text -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../homepage/homepage.php">Cougar Counter</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav" style="margin-left: 16px">
                <li class="nav-item">
                    <a class="nav-link" href="../product/product.php">Product<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../customer/customer.php">Customer</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link">Transaction</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container_content">
        <!--Button Cari dan Input Data-->
        <div class="container_top">
            <form action="" method="POST">
                <div class="item_search">
                    <div class="input-group">
                        <input name="keyword" type="text" class="form-control" placeholder="Masukkan Pencarian" aria-label="Recipient's username with two button addons" aria-describedby="button-addon4">
                        <div class="input-group-append" id="button-addon4">
                            <select id="filter" class="btn btn-outline-secondary" name="searchby">
                                <option value="detail_pembeli">Pembeli</option>
                                <option value="detail_barang">Barang</option>
                                <option value="harga">Harga</option>
                            </select>
                            <button class="btn btn-outline-secondary" type="submit" name="cari">Cari</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!--TABEL-->
        <table class="table table-striped" border="1">
            <thead>
                <tr class="tr-product">
                    <th scope="col" style="width: 50px;">No</th>
                    <th scope="col">Detail Pembeli</th>
                    <th scope="col">Detail Barang</th>
                    <th scope="col">Harga Barang</th>
                    <th scope="col">Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($transaksi as $trans) : ?>
                    <tr class="content_td">
                        <td style="text-align: center;"><?= $i; ?></td>
                        <td style="text-align: center;"><?= $trans['detail_pembeli']; ?></td>
                        <td style="text-align: center;"><?= $trans['detail_barang']; ?></td>
                        <td style="text-align: center;"><?= $trans['harga']; ?></td>
                        <td style="text-align: center;"><?= $trans['tanggal_pembelian']; ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!-- WAJIB VERSI 3.4.1 -->
        <script src="../script/jquery.min.js"></script>
        <script src="../script/script.js"></script>
        <script src="../script/popper.min.js"></script>
        <script src="../script/bootstrap.min.js"></script>
</body>

</html>