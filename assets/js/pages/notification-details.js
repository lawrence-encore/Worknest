(function($) {
    'use strict';

    $(function() {
        initialize_elements();

        display_form_details('notification details form');

        $('#notification-details-form').validate({
            submitHandler: function (form) {
                var transaction = 'submit notification details';
                var username = $('#username').text();
                var notification_recipient = $('#notification_recipient').val();

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&notification_recipient=' + notification_recipient,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated'){
                            show_alert_event('Notification Details Update Success', 'The notification details has been updated.', 'success', 'reload');
                        }
                        else{
                            show_alert('Notification Details Update Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Save');
                    }
                });

                return false;
            },
            rules: {
                notification_title: {
                    required: true
                },
                notification_message: {
                    required: true
                },
                system_link: {
                    required: true
                },
                web_link: {
                    required: true
                },
            },
            messages: {
                notification_title: {
                    required: 'Please enter the notification title',
                },
                notification_message: {
                    required: 'Please enter the notification message',
                },
                system_link: {
                    required: 'Please enter the system link',
                },
                web_link: {
                    required: 'Please enter the web link',
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