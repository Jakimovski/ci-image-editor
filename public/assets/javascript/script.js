

$(document).ready(function() {
    $('#username').keyup(function() {
        var username = $(this).val();
        var fn = $('#first_name').val();
        var ln = $('#last_name').val();

        $.ajax({
            url: '/validation/username_check',
            method: 'POST',
            data: {
                user_name:username,
                first_name:fn,
                last_name:ln
            },
            dataType:'text',
            success: function(html){
                $('#username_availability').html(html);
            }
        });
    });

    $('#email').blur(function() {
        var email = $(this).val();
        $.ajax({
            url: '/validation/email_check',
            method: 'POST',
            data: {
                email_address:email
            },
            dataType:'text',
            success: function(html){
                $('#email_availability').html(html);
            }
        });
    });
});