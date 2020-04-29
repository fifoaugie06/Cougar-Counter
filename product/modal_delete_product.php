<?php
session_start();

if ( !isset($_SESSION['userlogin'])){
    
    header('location: ../signin.php');
    exit;
}


require '../functions_product.php';

// Show data to input
$id = $_GET['delete_product_id'];

$product = lihatbarang("SELECT * FROM tb_barang WHERE id=$id");

?>

<div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
        <form action="" method="post">
            <?php foreach ($product as $prod) : ?>
                <div class="modal-header">
                    <input type="hidden" name="id" value="<?= $prod['id'] ?>">
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                </div>
            <?php endforeach; ?>
        </form>
    </div>
</div>