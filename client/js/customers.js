function updateCustomerStatus(id, status) {
    status = status == 1 ? 0 : 1;
    $.ajax({
        type: "POST",
        url: "../api/customers_api.php",
        data: {
            id: id,
            activated: status
        }
    }).done(function () {
        window.location.reload();
    });
}