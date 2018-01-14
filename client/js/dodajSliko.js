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
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                if (slike.length < 4) {
                    slike.push(e.target.result);
                }
                for (var i=1; i<= slike.length; i++) {
                    $('#img-upload'+i).attr('src', slike[i-1]);
                }
            }
            reader.readAsDataURL(input.files[0]);
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
