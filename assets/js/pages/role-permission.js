(function($) {
    'use strict';

    $(function() {
        display_form_details('role permission form');

        $('#role-permission-form').validate({
            submitHandler: function (form) {
                var transaction = 'submit role permission';
                var role_id = $('#role-id').text();
                var username = $('#username').text();
                var permission = [];
        
                $('.role-permissions').each(function(){
                    if($(this).is(':checked')){  
                        permission.push(this.value);  
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&role_id=' + role_id + '&permission=' + permission,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Assigned'){
                            show_alert_event('Role Permission Assignment Success', 'The permission has been assigned to the role.', 'success', 'reload');
                        }
                        else if(response === 'Not Found'){
                            show_alert('Role Permission Assignment Error', 'The role does not exist.', 'error');
                        }
                        else{
                            show_alert('Role Permission Assignment Error', response, 'error');
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