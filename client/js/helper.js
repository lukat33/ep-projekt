$(document).ready(function(){
    $('.button').click(function(){
        var clickBtnValue = $(this).val();
        var ajaxurl = 'ajax.php',
            data =  {'action': clickBtnValue};
        $.post(ajaxurl, data, function (response) {});
    });
});