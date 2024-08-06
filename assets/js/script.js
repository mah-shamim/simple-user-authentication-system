$(document).ready(function() {
    $('.help-block').hide();
    $("#registerForm").submit(function(event) {
        event.preventDefault();
        $('.help-block').hide();
        $.ajax({
            url: "src/register.php",
            type: "post",
            dataType: 'json',
            data: $(this).serialize(),
            success: function(response) {
                if(response.status === false){
                    if(response.field){
                        $('.' + response.field).show();
                        $('.' + response.field).html(response.message);
                    }else{
                        $('.message').html(response.message);
                    }
                }else{
                    $('#registerForm')[0].reset();
                    $('#registerForm').hide();
                    $('h2').hide();
                    $('p').html(response.message + ' <a href="login.html">Please Login here</a>');
                    //window.location.href = 'index.html';
                }
            }
        });
    });

    $("#loginForm").submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: "src/login.php",
            type: "post",
            dataType: 'json',
            data: $(this).serialize(),
            success: function(response) {
                if (response.status === true) {
                    window.location.href = 'backend/index.php';
                }
            }
        });
    });
});