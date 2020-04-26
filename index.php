<?php
require 'functions.php';
// Proses Read data
$pembeli = lihatpembeli('SELECT * FROM tb_pembeli');

// Proses Create data
if (isset($_POST["submit"])) {
    if (tambahpembeli($_POST) > 0) {
        header("Location: index.php");
    } else {
        header("Location: index.php");
    }
}

// Proses Update data
if (isset($_POST['update'])) {
    updatepembeli($_POST);
    if (updatepembeli($_POST) > 0) {
        header("Location: index.php");
    } else {
        header("Location: index.php");
    }
}

// Proses Delete data
if (isset($_GET["delete"])) {
    if (deletepembeli($_GET) > 0) {
        header("Location: index.php");
    } else {
        header("Location: index.php");
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="style.css">

    <title>Cougar Counter</title>
</head>


<body>
    <!-- Image and text -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Cougar Counter</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav" style="margin-left: 16px">
                <li class="nav-item">
                    <a class="nav-link" href="product/product.php">Product</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link">Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="transaction/transaction.php">Transaction</a>
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
                        <td id="aksi_edit">
                            <button class="open_modal btn btn-outline-secondary" id="<?= $pemb['id'] ?>">Update</button>
                        </td>
                        <td id="aksi_delete">
                            <form action="" method="get">
                                <button class="btn btn-outline-secondary" type="submit" name="delete" value="<?= $pemb['id'] ?>">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

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
                            <label for="kota" class="col-form-label">Jenis Kelamin</label>
                            <select id="jenis_kelamin" class="form-control" name="jenis_kelamin">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <p class="text-right" style="font-style: italic; font-size: 12px; color: red">Default password New Customer 123456</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" name="submit">Tambahkan</button>
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
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>