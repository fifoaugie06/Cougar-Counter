<?php
session_start();

if ( !isset($_SESSION['userlogin'])){
    
    header('location: ../signin.php');
    exit;
}


require '../functions_customer.php';

// Show data to input
$id = $_GET['delete_customer_id'];

$pembeli = lihatpembeli("SELECT * FROM tb_pembeli WHERE id=$id");

?>

<div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
        <form action="" method="post">
            <?php foreach ($pembeli as $pemb) : ?>
                <div class="modal-header">
                    <input type="hidden" name="id" value="<?= $pemb['id'] ?>">
                    <h4 class="modal-title" style="text-align:center;">Menghapus Informasi Customer dapat mengakibatkan Informasi Transaksi terhapus juga, Anda Yakin ?</h4>
                </div>
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                </div>
            <?php endforeach; ?>
        </form>
    </div>
</div>