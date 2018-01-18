function save_edit() {
    var request;
    event.preventDefault();

    // Abort any pending request
    if (request) {
        request.abort();
    }
    // setup some local variables
    var $form = $("#modal_form");

    // Let's select and cache all the fields
    var $inputs = $form.find("input, select, button, textarea");
    // Serialize the data in the form
    var status = 1;
    if ($('#modal_togglebtn').prop('checked') == false) {
        status = 0;
    }

    var serializedData = $form.serialize() + "&modal_form=&modal_status=" + status;
    var pwdLen = $('#modal_password_1').val().length;

    if (pwdLen < 6 && pwdLen > 0) {
        $('#errors').css("visibility","visible");
        $('#errors').html("Geslo mora vsebovati vsaj 6 znakov");
    } else {
        if ($('#modal_password_1').val() == $('#modal_password_2').val()) {
            // Let's disable the inputs for the duration of the Ajax request.
            $inputs.prop("disabled", true);
            request = $.ajax({
                url: "../api/admin_api.php",
                type: "post",
                data: serializedData
            });

            // Callback handler called on success
            request.done(function (response, textStatus, jqXHR) {
                console.log(response);
                var lineNumber = $('#lineNumber').text();
                var table = $("#admin_table")[0];
                var row = table.rows[lineNumber];
                row.cells[1].innerText = $('#modal_firstname').val();
                row.cells[2].innerText = $('#modal_lastname').val();
                row.cells[3].innerText = $('#modal_email').val();
                if ($('#modal_togglebtn').prop('checked')) {
                    row.cells[4].innerText = "Aktiviran";
                } else {
                    row.cells[4].innerText = "Deaktiviran";
                }
            });

            // Callback handler called  on failure
            request.fail(function (jqXHR, textStatus, errorThrown) {
                console.error("The following error occurred: " + textStatus, errorThrown);
            });

            // Callback handler that will be called regardless of success
            request.always(function () {
                // Reenable the inputs
                $inputs.prop("disabled", false);
                $('#myModal').modal('hide');
                $('#modal_password_1').val("");
                $('#modal_password_2').val("");
                $('#errors').css("visibility","hidden");
            });
        }  else {
            // display error message
            $('#errors').css("visibility","visible");
            $('#errors').html("Gesli se ne ujemata");
        }
    }
}
function edit(lineNumber) {
    $('#lineNumber').html(lineNumber);

    var table =$("#admin_table")[0];
    var row = table.rows[lineNumber];
    var firstname = row.cells[1].innerText;
    var lastname = row.cells[2].innerText;
    var email = row.cells[3].innerText;
    var status = row.cells[4].innerText;

    $('#modal_firstname').val(firstname);
    $('#modal_lastname').val(lastname);
    $('#modal_email').val(email);
    if (status == "Aktiviran") {
        $('#modal_togglebtn').prop('checked', true).change();
    }
}

function reset_form() {
    $('#modal_password_1').val("");
    $('#modal_password_2').val("");
    $('#errors').css("visibility","hidden");
}

function reset_add_form() {
    $('#modal_add_password_1').val("");
    $('#modal_add_password_2').val("");
    $('#errors_add').css("visibility","hidden");
}

function add_salesman() {
    if ($('#modal_add_firstname').val().length > 0 && $('#modal_add_lastname').val().length > 0 &&
        $('#modal_add_email').val().length > 0 && $('#modal_add_togglebtn').val().length > 0 &&
        $('#modal_add_password_1').val().length > 0 && $('#modal_add_password_2').val().length > 0) {

        var request;
        event.preventDefault();

        // Abort any pending request
        if (request) {
            request.abort();
        }
        // setup some local variables
        var $form = $("#modal_add_form");

        // Let's select and cache all the fields
        var $inputs = $form.find("input, select, button, textarea");
        // Serialize the data in the form
        var status = 1;
        if ($('#modal_add_togglebtn').prop('checked') == false) {
            status = 0;
        }

        var serializedData = $form.serialize() + "&modal_add_form=&modal_add_status=" + status;

        if ($('#modal_add_password_1').val().length < 6) {
            $('#errors_add').css("visibility","visible");
            $('#errors_add').html("Geslo mora vsebovati vsaj 6 znakov");
        } else {
            if ($('#modal_add_password_1').val() == $('#modal_add_password_2').val()) {
                // Let's disable the inputs for the duration of the Ajax request.
                $inputs.prop("disabled", true);
                request = $.ajax({
                    url: "../api/admin_api.php",
                    type: "post",
                    data: serializedData
                });

                // Callback handler called on success
                request.done(function (response, textStatus, jqXHR) {
                    // console.log(response);
                    location.reload();
                });

                // Callback handler called  on failure
                request.fail(function (jqXHR, textStatus, errorThrown) {
                    console.error("The following error occurred: " + textStatus, errorThrown);
                });

                // Callback handler that will be called regardless of success
                request.always(function () {
                    // Reenable the inputs
                    $inputs.prop("disabled", false);
                    $('#modal_add').modal('hide');
                    $('#modal_add_password_1').val("");
                    $('#modal_add_password_2').val("");
                    $('#errors_add').css("visibility","hidden");
                });
            }  else {
                // display error message
                $('#errors_add').css("visibility","visible");
                $('#errors_add').html("Gesli se ne ujemata");
            }
        }
    } else {
        // display error message
        $('#errors_add').css("visibility","visible");
        $('#errors_add').html("Izpolni vsa vnosna polja");
    }
}