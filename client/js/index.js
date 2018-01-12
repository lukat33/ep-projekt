function updateOrder(id, action) {
    $.ajax({
        type: "POST",
        url: "../api/salesman_index_api.php",
        data: {
            order_id: id,
            action: action
        }
    });
    window.location.reload();
}