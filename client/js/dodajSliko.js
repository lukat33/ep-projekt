function dodajSliko(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#slika')
                .attr('src', e.target.result)
                .width(255);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready( function() {
    var slike = [];

    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);

        fil = $('#imgInp')[0].files.length;
        console.log(fil);

        if (fil == 2)
            $('#labe').val("Izbrali ste " + fil + " sliki.");
        else if (fil > 1)
            $('#labe').val("Izbrali ste " + fil + " slik.");
        else if (fil == 1)
            $('#labe').val("Izbrali ste " + fil + " sliko.");
        else
            $('#labe').val("");
    });

    $('.btn-file :file').on('fileselect', function(event, label) {
        if (slike.length < 4) {
            var input = $(this).parents('.input-group').find(':text'),
                log = label;
            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
        }
    });

    function readURL(input) {
        for (var i=1; i<=4; i++) {
            $('#img-upload'+i).attr('src', "");
            slike = [];
        }
        if (input.files && input.files[0]) {

            for (var i=0; i <input.files.length; i++) {
                f = input.files[i];

                var reader = new FileReader();
                // console.log("I: ", f);
                reader.onload = (function (theFile) {
                    return function (e) {
                        // Render thumbnail.
                        slike.push(e.target.result);
                        // PRIKAZ SLIKE ZAKOMENTIRANOOO!O!OO!!O!O
                        // $('#img-upload'+(i)).attr('src', e.target.result);
                    };
                })(f);

                // Read in the image file as a data URL.
                reader.readAsDataURL(f);
            }
        }
    }
    $("#imgInp").change(function(){
        readURL(this);
    });

    $(".img-up").click(function() {
        var id = $(this).attr("id").slice(-1);
        slike.splice((id-1),1);
        $('#img-upload'+id).attr('src', "");

        for (var i=1; i<= slike.length; i++) {
            $('#img-upload'+i).attr('src', slike[i-1]);
        }
    });
});
