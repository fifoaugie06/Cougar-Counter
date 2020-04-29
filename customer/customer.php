<?php
session_start();

if ( !isset($_SESSION['userlogin'])){
    
    header('location: ../signin.php');
    exit;
}


require '../functions_customer.php';
// Proses Pagination
$jumlahDataPerhalaman = 10;
$jumlahDataKeseluruhan = count(lihatpembeli('SELECT * FROM tb_pembeli'));
$jumlahHalaman = ceil($jumlahDataKeseluruhan / $jumlahDataPerhalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;


// Proses Read data
$pembeli = lihatpembeli("SELECT * FROM tb_pembeli LIMIT $awalData, $jumlahDataPerhalaman");

// Proses Create data
if (isset($_POST["submit"])) {
    if (tambahpembeli($_POST) > 0) {
        header("Location: customer.php");
    } else {
        header("Location: customer.php");
    }
}

// Proses Update data
if (isset($_POST['update'])) {
    updatepembeli($_POST);
    if (updatepembeli($_POST) > 0) {
        header("Location: customer.php");
    } else {
        header("Location: customer.php");
    }
}

// Proses Delete data
if (isset($_GET["delete"])) {
    if (deletepembeli($_GET) > 0) {
        header("Location: customer.php");
    } else {
        header("Location: customer.php");
    }
}

// Proses Search
if (isset($_POST["cari"])) {
    $pembeli = caripembeli($_POST['keyword'], $_POST['searchby']);
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

    <title>Cougar Counter</title>
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
                    <a class="nav-link" href="../product/product.php">Product</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link">Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../transaction/transaction.php">Transaction</a>
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
                                <option value="nama">Nama</option>
                                <option value="jenis_kelamin">Jenis Kelamin</option>
                                <option value="alamat">Alamat</option>
                                <option value="kota">Kota</option>
                                <option value="email">E-Mail</option>
                            </select>
                            <button class="btn btn-outline-secondary" type="submit" name="cari">Cari</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="item_input">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Pembeli</button>
            </div>
        </div>


        <!--TABEL-->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Kota</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col" colspan="2" style="text-align: center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($pembeli as $pemb) : ?>
                    <tr class="content_td">
                        <td><?= $i; ?></td>
                        <td><?= $pemb["nama"]; ?></td>
                        <td><?= $pemb["jenis_kelamin"]; ?></td>
                        <td><?= $pemb["alamat"]; ?></td>
                        <td><?= $pemb["kota"]; ?></td>
                        <td><?= $pemb["email"]; ?></td>
                        <td id="aksi_edit">
                            <button class="open_modal btn btn-outline-success" id="<?= $pemb['id'] ?>">Update</button>
                        </td>
                        <td id="aksi_delete">
                            <form action="" method="get">
                                <button class="btn btn-outline-danger" type="submit" name="delete" value="<?= $pemb['id'] ?>">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>


        <!--Modal tambah data-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pembeli</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama" class="col-form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="col-form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="kota" class="col-form-label">Kota</label>
                                <input type="text" class="form-control" id="kota" name="kota" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">E-Mail</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="kota" class="col-form-label">Jenis Kelamin</label>
                                <select id="jenis_kelamin" class="form-control" name="jenis_kelamin">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <p class="text-right" style="font-style: italic; font-size: 12px; color: red">Default password New Customer 123456</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success" name="submit">Tambahkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Modal update data-->
        <div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        </div>

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
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- WAJIB VERSI 3.4.1 -->
    <script src="../script/jquery.min.js"></script>
    <script src="../script/script.js"></script>
    <script src="../script/popper.min.js"></script>
    <script src="../script/bootstrap.min.js"></script>

</body>

</html>