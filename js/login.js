$(document).ready(function(){
    $('#login-form').on('submit', function(e){
        e.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url: 'php/login.php',
            type: 'POST',
            data: form_data,
            success: function(response){
                if(response == 'success'){
                    window.location = 'dashboard.php';
                } else {
                    $('#message').html(response);
                }
            }
        });
    });
});
