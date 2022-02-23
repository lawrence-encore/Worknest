(function($) {
    'use strict';

    $(function() {
        display_form_details('application notification form');

        $('#application-notification-form').validate({
            submitHandler: function (form) {
                var transaction = 'submit application notification';
                var username = $('#username').text();
                var notification = [];
        
                $('.application-notification').each(function(){
                    if($(this).is(':checked')){  
                        notification.push(this.value);  
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&notification=' + notification,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Assigned'){
                            show_alert_event('Application Notification Update Success', 'The application notification has been updated.', 'success', 'reload');
                        }
                        else{
                            show_alert('Application Notification Update Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Save');
                    }
                });

                return false;
            }
        });
    });
})(jQuery);