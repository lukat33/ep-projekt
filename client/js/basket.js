function addToBasketAction(id) {
    $.ajax({
        type: "POST",
        url: "../api/basket_api.php",
        data: {
            id: id,
            action: "add"
        }
    }).done(function (msg) {
        alert(msg);
    });
    window.location.href = "basket.php";
}

function removeArticle(id) {
    $.ajax({
        type: "POST",
        url: "../api/basket_api.php",
        data: {
            id: id,
            action: "remove"
        }
    });
    window.location.reload();
}