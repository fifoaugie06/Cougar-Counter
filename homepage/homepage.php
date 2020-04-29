<?php

session_start();

if (!isset($_SESSION['userlogin'])) {

    header('location: ../signin.php');
    exit;
}

require '../functions_homepage.php';

// ambil user login id dari session
$user = $_SESSION['userloginid'];
$user = lihathomepage("SELECT * FROM tb_pembeli WHERE id = $user");

// Proses Read data
$homepage = lihathomepage("SELECT * FROM tb_barang");

// Order
if (isset($_POST['order'])) {
    if (orderbarang($_POST) > 0) {
        if (updatestok($_POST) > 0) {
            echo "
            <script>
                alert('berhasil transaksi');
                document.location.href = 'homepage.php';
            </script>
            ";
        }
    } else {
        echo "
        <script>
            alert('gagal transaksi');
            document.location.href = 'homepage.php';
        </script>";
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
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../style/style.css">

    <title>Cougar - Counter</title>
</head>

<body>
    <!-- Image and text -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand">Cougar Counter</a>
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
                <li class="nav-item">
                    <a class="nav-link" href="../transaction/transaction.php">Transaction</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item"><?= $user[0]['nama'] ?></a>
                        <a class="dropdown-item"><?= $user[0]['email'] ?></a>
                        <a class="dropdown-item text-danger" href="../signout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <main role="main">
        <section class="jumbotron text-center">
            <div class="container" style="height: 300px; padding-top: 30px;">
                <h1 class="jumbotron-heading text-white">Cougar Counter</h1>
                <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
                <p>
                    <a href="#" class="btn btn-primary my-2">Main call to action</a>
                    <a href="#" class="btn btn-secondary my-2">Secondary action</a>
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container" style="padding: 0;">
                <div class="d-flex justify-content-center">
                    <div class="card border-secondary mb-3" style="width: 16rem; margin-right: 22px;">
                        <div class="card-header">Totally Product</div>
                        <div class="card-body text-secondary">
                            <p></p>
                            <h2 class="card-title text-center"><?= $countAllProduct; ?></h2>
                        </div>
                    </div>
                    <div class="card border-secondary mb-3" style="width: 16rem; margin-right: 22px;">
                        <div class="card-header">Total Transaction</div>
                        <div class="card-body text-secondary">
                            <p></p>
                            <h2 class="card-title" style="text-align: center;"><?= $countTotallySold; ?></h2>
                        </div>
                    </div>
                    <div class="card border-secondary mb-3" style="width: 16rem;">
                        <div class="card-header">Not Sold Yet</div>
                        <div class="card-body text-secondary">
                            <p></p>
                            <h2 class="card-title text-center"><?= $sumNotSoldYet ?></h2>
                        </div>
                    </div>
                    <div class="card border-secondary mb-3" style="width: 16rem; margin-left: 22px;">
                        <div class="card-header">Last Update</div>
                        <div class="card-body text-secondary">
                            <h3 class="card-title text-center"><?= $lastUpdateFormat[0]; ?></h3>
                            <h5 class="card-title text-center"><?= $lastUpdateFormat[1]; ?></h5>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 22px;">
                    <?php foreach ($homepage as $home) : ?>
                        <div class="col-md-4">
                            <div class="card border-secondary mb-4 box-shadow">
                                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap" src="../img/<?= $home['gambar']; ?>">
                                <div class="card-body">
                                    <h5 class="card-text"><?= $home['nama_barang'] . ' ' . $home['merk'] . ' ' . $home['type'] ?></h5>
                                    <p class="card-text">Rp. <?= $home['harga'] ?></p>
                                    <p class="card-text"><?= $home['description'] ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <form action="" method="post">
                                            <div class="btn-group">
                                                <input type="hidden" name="kode_barang" value="<?= $home['id']; ?>">
                                                <input type="hidden" name="kode_pembeli" value="<?= $user[0]['id'] ?>">
                                                <?php if ($home['stok'] == 0) : ?>
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" name="order" disabled>Stok Habis</button>
                                                <?php else : ?>
                                                    <button type="submit" class="btn btn-sm btn-outline-dark" name="order">Order</button>
                                                <?php endif; ?>
                                            </div>
                                        </form>
                                        <small class="text-muted"><?= $home['stok'] ?> Tersisa</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>


    </main>

    <footer class="text-muted">
        <div class="container">
            <p class="float-right">
                <a href="#">Back to top</a>
            </p>
            <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
            <p>New to Bootstrap? <a href="../../">Visit the homepage</a> or read our <a href="../../getting-started/">getting started guide</a>.</p>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- WAJIB VERSI 3.4.1 -->
    <script src="../script/jquery.min.js"></script>
    <script src="../script/script.js"></script>
    <script src="../script/popper.min.js"></script>
    <script src="../script/bootstrap.min.js"></script>
</body>

</html>