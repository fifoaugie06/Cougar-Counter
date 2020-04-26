<?php
require '../functions.php';

// Show data to input
$id = $_GET['update_id'];
$pembeli = lihatpembeli("SELECT * FROM tb_pembeli WHERE id=$id");

?>

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="updateModalLabel">Update Pembeli</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="POST">
            <?php foreach ($pembeli as $pemb) : ?>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id_update" value="<?= $pemb['id']; ?>">
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $pemb['nama'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="col-form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" required><?= $pemb['alamat']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="kota" class="col-form-label">Kota</label>
                        <input type="text" class="form-control" id="kota" name="kota" value="<?= $pemb['kota'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">E-Mail</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $pemb['email'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin</label>
                        <select id="jenis_kelamin" class="form-control" name="jenis_kelamin">
                            <option value="L" <?php if ($pemb['jenis_kelamin'] == 'L') {
                                                    echo ("selected");
                                                } ?>>Laki-laki</option>
                            <option value="P" <?php if ($pemb['jenis_kelamin'] == 'P') {
                                                    echo ("selected");
                                                } ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Optionality">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" name="update">Update</button>
                </div>
            <?php endforeach; ?>
        </form>
    </div>
</div>