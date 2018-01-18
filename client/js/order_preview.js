function sendOrder(size) {
    if (size === 0) {
        alert("Vaša košarica je prazna! Dodajte izdelke preden boste oddali naročilo.");
    } else {
        $.ajax({
            type: "POST",
            url: "../api/order_preview_api.php",
            data: {
                action: "send-order"
            }
        });
        window.location.href = "order_sent.php";
    }

}