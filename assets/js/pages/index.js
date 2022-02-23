(function($) {
    'use strict';

    $(function() {
        $('#signin-form').validate({
            submitHandler: function (form) {
                var transaction = 'authenticate';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('signin').disabled = true;
                        $('#signin').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span class="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Authenticated'){
                            var username = $('#username').val();
                            sessionStorage.setItem('username', username);

                            window.location = 'dashboard.php';
                        }
                        else{
                            if(response === 'Incorrect'){
                                show_alert('Authentication Error', 'Your username or password is incorrect.', 'error');
                            }
                            else if(response === 'Locked'){
                                show_alert('Authentication Error', 'Your user account is locked. Please contact your administrator.', 'error');
                            }
                            else if(response === 'Inactive'){
                                show_alert('Authentication Error', 'Your user account is inactive. Please contact your administrator.', 'error');
                            }
                            else if(response === 'Password Expired'){
                                show_alert_confirmation('User Account Password Expired', 'Your password has expired. Do you want to update your password?', 'info', 'Update Password', 'primary', 'expired password');
                            }
                            else{
                                show_alert('Authentication Error', response, 'error');
                            }

                            document.getElementById('signin').disabled = false;
                            $('#signin').html('Log In');
                        }
                    }
                });

                return false;
            },
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                username: {
                    required: 'Please enter your username',
                },
                password: {
                    required: 'Please enter your password',
                }
            },
            errorPlacement: function(label, element) {
                if(element.hasClass('web-select2') && element.next('.select2-container').length) {
                    label.insertAfter(element.next('.input-group'));
                }
                else if(element.parent('.input-group').length){
                    label.insertAfter(element.parent());
                }
                else{
                    label.insertAfter(element);
                }
            },
            highlight: function(element) {
                $(element).parent().addClass('has-danger');
                $(element).addClass('form-control-danger');
            },
            success: function(label,element) {
                $(element).parent().removeClass('has-danger')
                $(element).removeClass('form-control-danger')
                label.remove();
            }
        });
    });
})(jQuery);