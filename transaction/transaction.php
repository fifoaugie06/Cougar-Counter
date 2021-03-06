<?php
session_start();

if (!isset($_SESSION['userlogin'])) {

    header('location: ../signin.php');
    exit;
}

require '../functions_transactions.php';

// Proses Pagination LIMIT
$query .= "LIMIT $awalData, $jumlahDataPerhalaman";

$transaksi = lihattransaksi($query);


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

        <!--Pagination-->
        <nav aria-label="Page navigation example" style="margin-top: 50px">
            <ul class="pagination justify-content-end">
                <!-- PREVIOUS -->
                <?php if ($halamanAktif > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>">Previous</a>
                    </li>
                <?php else : ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>">Previous</a>
                    </li>
                <?php endif; ?>

                <!-- INDEX AKTIF -->
                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                    <?php if ($i == $halamanAktif) : ?>
                        <li class="page-item active">
                            <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                    <?php else : ?>
                        <li class="page-item inactive">
                            <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                    <?php endif; ?>
                <?php endfor; ?>

                <!-- NEXT -->
                <?php if ($halamanAktif < $jumlahHalaman) : ?>
                    <li class="page-item ">
                        <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">Next</a>
                    </li>
                <?php else : ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!-- WAJIB VERSI 3.4.1 -->
        <script src="../script/jquery.min.js"></script>
        <script src="../script/script.js"></script>
        <script src="../script/popper.min.js"></script>
        <script src="../script/bootstrap.min.js"></script>
</body>

</html>