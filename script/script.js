$(document).ready(function () {

    // AJAX MODAL UPDATE CUSTOMER
    $(".open_modal").click(function (e) {
        var id = $(this).attr("id");
        $.ajax({
            url: "modal_update_customer.php",
            type: "GET",
            data: {
                update_id: id,
            },
            success: function (ajaxData) {
                $("#ModalEdit").html(ajaxData);
                $("#ModalEdit").modal('show', {
                    backdrop: 'true'
                });
            }
        });
    });

    // AJAX MODAL UPDATE PRODUCT
    $(".update_product").click(function (e) {
        var id = $(this).attr("id");
        $.ajax({
            url: "modal_update_product.php",
            type: "GET",
            data: {
                update_product_id: id,
            },
            success: function (ajaxData) {
                $("#ModalUpdateProduct").html(ajaxData);
                $("#ModalUpdateProduct").modal('show', {
                    backdrop: 'true'
                });
            }
        });
    });

    // AJAX MODAL DELETE PRODUCT
    $(".delete_product").click(function (e) {
        var id = $(this).attr("id");
        $.ajax({
            url: "modal_delete_product.php",
            type: "GET",
            data: {
                delete_product_id: id,
            },
            success: function (ajaxData) {
                $("#ModalDeleteProduct").html(ajaxData);
                $("#ModalDeleteProduct").modal('show', {
                    backdrop: 'true'
                });
                console.log('oy');
            },
        });
    });

    // AJAX MODAL DELETE Customer
    $(".delete_customer").click(function (e) {
        var id = $(this).attr("id");
        $.ajax({
            url: "modal_delete_customer.php",
            type: "GET",
            data: {
                delete_customer_id: id,
            },
            success: function (ajaxData) {
                $("#ModalDeleteCustomer").html(ajaxData);
                $("#ModalDeleteCustomer").modal('show', {
                    backdrop: 'true'
                });
            },
        });
    });
});