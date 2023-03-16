$(document).ready(function(){   
    $.ajax({ 
        url: '../php/profile.php',  
        type: 'POST',  
        success: function(response){  
            $('#profile-info').html(response);
        }  
    });
});  
