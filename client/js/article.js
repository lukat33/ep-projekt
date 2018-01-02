$( document ).ready( function () {

    addRating();

    $( ".fa" ).mouseover( function () {

        var id = parseInt($( this ).attr("id"));
        $.each( $(".fa"), function (key, value) {
            if (parseInt($(value).attr("id")) != 0) {
                if (parseInt($(value).attr("id")) <= id) {
                    $(value).addClass("checked");
                } else {
                    $(value).removeClass("checked");
                }
            }
        });

    });

    $( ".fa" ).mouseleave( function () {
        var rating = parseInt($(".rating").attr("id"));

        $.each( $(".fa"), function (key, value) {
            if (parseInt($(value).attr("id")) != 0) {
                if (parseInt($(value).attr("id")) > rating) {
                    $(value).removeClass("checked");
                }
            }
        });

    });

    $( ".fa" ).click( function () {
        var rating = $( this ).attr("id");

        $.each( $(".fa"), function (key, value) {
            if (parseInt($(value).attr("id")) != 0) {
                if (parseInt($(value).attr("id")) <= rating) {
                    $(value).addClass("checked");
                } else {
                    $(value).removeClass("checked");
                }
                $(value).off()
            }
        });

        $.ajax({
            type: "POST",
            url: "../api/article_api.php",
            data: {
                action: "rate",
                rating: rating,
                articleId: parseInt($(".rating").attr("data-article"))
            }
        });
    });

    $(".num").off()

});

function addRating() {
    var rating = parseFloat($(".rating").attr("id"));

    for (var i = 1; i <= 5; i++) {
        if (i - 1 < rating) {
            jQuery('<div/>', {
                id: i,
                class: 'fa fa-star checked'
            }).appendTo(".rating");
        } else {
            jQuery('<div/>', {
                id: i,
                class: 'fa fa-star'
            }).appendTo(".rating");
        }
    }

    if (parseInt(rating) === 0) {
        jQuery('<div/>', {
            id: 0,
            text: "Ni ocen",
            class: 'fa num',
            style: 'padding: 10px'
        }).appendTo(".rating");
    } else {
        jQuery('<div/>', {
            id: 0,
            text: rating,
            class: 'fa num',
            style: 'padding: 10px'
        }).appendTo(".rating");
    }
}