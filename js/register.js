$(document).ready(function(){
    $('#register-form').on('submit', function(e){
        e.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url: '../php/register.php',
            type: 'POST',
            data: form_data,
            success: function(response){
                alert(response);
            }
        });
    });
});