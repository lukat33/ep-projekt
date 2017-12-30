function addToBasketAction(id) {
    $.ajax({
        type: "POST",
        url: "../api/basket_api.php",
        data: {
            id: id,
            action: "add"
        }
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

$( document ).ready( function () {

    $(".quantity-selector").change( function () {
        var id = $(this).attr('article_id');
        var quantity = $(this).val();
        var price = $(".price#" + id).text();

        var subtotal = (parseFloat(quantity) * parseFloat(price)).toFixed(2);
        $("#" + id + ".subtotal").text(subtotal + "€");

        var total = 0;
        $.each( $(".subtotal"), function(key, value) {
            total += parseFloat(value.innerText);
        });
        $(".total").html("<b>Skupaj " + total.toFixed(2) + "€</b>")

        $.ajax({
            type: "POST",
            url: "../api/basket_api.php",
            data: {
                id: id,
                quantity: quantity,
                action: "quantity"
            }
        });
    });
});