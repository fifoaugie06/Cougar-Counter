<?php
require '../functions_product.php';

// Show data to input
$id = $_GET['update_product_id'];
$product = lihatbarang("SELECT * FROM tb_barang WHERE id=$id");

?>


<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Barang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <?php foreach ($product as $prod) : ?>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $prod['id']; ?>">
                    <input type="hidden" name="gambarLama" value="<?= $prod["gambar"]; ?>">
                    <div class="form-group">
                        <label for="nama_barang" class="col-form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $prod['nama_barang'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="merk" class="col-form-label">Merk</label>
                        <input type="text" class="form-control" id="merk" name="merk" value="<?= $prod['merk'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="type" class="col-form-label">Type</label>
                        <input type="text" class="form-control" id="type" name="type" value="<?= $prod['type'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-form-label">Description</label>
                        <textarea type="text" class="form-control" id="description" name="description" required maxlength="200"><?= $prod['description'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="harga" class="col-form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" value="<?= $prod['harga'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="stok" class="col-form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" value="<?= $prod['stok'] ?>" required>
                    </div>
                    <input type="file" name="gambar" id="gambar" style="margin-top: 16px;">
                    <p class="text-right" style="font-style: italic; font-size: 12px; color: red">Optionallity Choose File</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" name="update">Update</button>
                </div>
            <?php endforeach; ?>
        </form>
    </div>
</div>