(function($) {
    'use strict';

    $(function() {
        display_form_details('email configuration form');
        initialize_elements();
        initialize_click_events();

        $('#email-configuration-form').validate({
            submitHandler: function (form) {
                var transaction = 'submit email configuration';
                var username = $('#username').text();

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-email-setting-form').disabled = true;
                        $('#submit-email-setting-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated'){
                            show_alert_event('Email Configuration Update Success', 'The email configuration has been updated.', 'success', 'reload');
                        }
                        else{
                            show_alert('Email Configuration Update Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-email-setting-form').disabled = false;
                        $('#submit-email-setting-form').html('Save');
                    }
                });
                return false;
            },
            rules: {
                mail_host: {
                    required: true
                },
                port: {
                    required: true
                },
                mail_user: {
                    required: true
                },
                mail_encryption: {
                    required: true
                },
                mail_from_name: {
                    required: true
                },
                mail_from_email: {
                    required: true
                },
            },
            messages: {
                mail_host: {
                    required: 'Please enter the mail host',
                },
                port: {
                    required: 'Please enter the port',
                },
                mail_user: {
                    required: 'Please enter the mail user',
                },
                mail_encryption: {
                    required: 'Please choose the mail encryption',
                },
                mail_from_name: {
                    required: 'Please enter the mail from name',
                },
                mail_from_email: {
                    required: 'Please enter the mail from email',
                },
            },
            errorPlacement: function(label, element) {
                if((element.hasClass('select2') || element.hasClass('form-select2')) && element.next('.select2-container').length) {
                    label.insertAfter(element.next('.select2-container'));
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

function initialize_click_events(){
    var username = $('#username').text();

    $(document).on('click','#send-test-email',function() {
        generate_modal('send test email form', 'Send Test Email', 'R' , '1', '1', 'form', 'send-test-email-form', '1', username);
    });
}