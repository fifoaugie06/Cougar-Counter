$(document).ready(function () {
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
});