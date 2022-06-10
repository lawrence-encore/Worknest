(function($) {
    'use strict';

    $(function() {
        initialize_global_functions();
    });
})(jQuery);

// Initialize function
function initialize_global_functions(){
    $(document).on('click','#datatable-checkbox',function() {
        var status = $(this).is(':checked') ? true : false;
        $('.datatable-checkbox-children').prop('checked',status);

        check_table_check_box();
        check_table_multiple_button();
    });
    
    $(document).on('click','.datatable-checkbox-children',function() {
        check_table_check_box();
        check_table_multiple_button();
    });

    $(document).on('click','.view-transaction-log',function() {
        var username = $('#username').text();
        var transaction_log_id = $(this).data('transaction-log-id');

        sessionStorage.setItem('transaction_log_id', transaction_log_id);

        generate_modal('transaction log', 'Transaction Log', 'XL' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#page-header-notifications-dropdown',function() {
        var username = $('#username').text();
        var transaction = 'partial notification status';

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'text',
            data: {transaction : transaction, username : username},
            success: function () {
                $('#page-header-notifications-dropdown').html('<i class="bx bx-bell">');
            }
        });
    });

    $(document).on('click','.notification-item',function() {
        var username = $('#username').text();
        var transaction = 'read notification status';
        var notification_id = $(this).data('notification-id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'text',
            data: {transaction : transaction, notification_id : notification_id, username : username},
            success: function () {
                $(this).removeClass('text-primary');
            }
        });
    });

    $(document).on('click','#backup-database',function() {
        var username = $('#username').text();
        generate_modal('backup database form', 'Backup Database', 'R' , '1', '1', 'form', 'backup-database-form', '1', username);
    });

    if ($('.select2').length) {
        $('.select2').select2();
    }

    if ($('.filter-select2').length) {
        $('.filter-select2').select2({
            dropdownParent: $('#filter-off-canvas')
        });
    }
}

function initialize_elements(){
    if ($('.form-maxlength').length) {
        $('.form-maxlength').maxlength({
            alwaysShow: true,
            warningClass: 'badge mt-1 bg-info',
            limitReachedClass: 'badge mt-1 bg-danger',
            validate: true
        });
    }

    if ($('.form-select2').length) {
        $('.form-select2').select2().on('change', function() {
            $(this).valid();
        });
    }

    if ($('.birthday-date-picker').length) {
        $('.birthday-date-picker').datepicker({
            endDate: '-18y'
        });
    }
}

function initialize_form_validation(form_type){
    var transaction;
    var username = $('#username').text();

    if(form_type == 'change password form'){
        $('#change-password-form').validate({
            submitHandler: function (form) {
                transaction = 'change password';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('signin').disabled = true;
                        $('#signin').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span class="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated'){
                            show_alert('Change User Account Password Success', 'The user account password has been updated. You can now sign in your account.', 'success');
                            $('#System-Modal').modal('hide');

                            document.getElementById('signin').disabled = false;
                            $('#signin').html('Log In');
                        }
                        else{
                            if(response === 'Not Found'){
                                show_alert('Change User Account Password Error', 'The user account does not exist.', 'error');
                            }
                            else{
                                show_alert('Change User Account Password Error', response, 'error');
                            }                            

                            document.getElementById('submit-form').disabled = false;
                            $('#submit-form').html('Submit');
                        }
                    }
                });

                return false;
            },
            rules: {
                change_password: {
                    required: true,
                    password_strength : true
                }
            },
            messages: {
                change_password: {
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
    }
    else if(form_type == 'change profile password form'){
        $('#change-profile-password-form').validate({
            submitHandler: function (form) {
                transaction = 'change password';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated'){
                            show_alert('Change User Account Password Success', 'The user account password has been updated.', 'success');
                            $('#System-Modal').modal('hide');
                        }
                        else{
                            if(response === 'Not Found'){
                                show_alert('Change User Account Password Error', 'The user account does not exist.', 'error');
                            }
                            else{
                                show_alert('Change User Account Password Error', response, 'error');
                            }                            

                            document.getElementById('submit-form').disabled = false;
                            $('#submit-form').html('Submit');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });

                return false;
            },
            rules: {
                change_password: {
                    required: true,
                    password_strength : true
                }
            },
            messages: {
                change_password: {
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
    }
    else if(form_type == 'system parameter form'){
        $('#system-parameter-form').validate({
            submitHandler: function (form) {
                var transaction = 'submit system parameter';
    
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert System Parameter Success', 'The system parameter has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update System Parameter Success', 'The system parameter has been updated.', 'success');
                            }
    
                            $('#System-Modal').modal('hide');
                            reload_datatable('#system-parameter-datatable');
                        }
                        else{
                            show_alert('System Parameter Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                parameter: {
                    required: true         
                },
            },
            messages: {
                parameter: {
                    required: 'Please enter the parameter',
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
    }
    else if(form_type == 'policy form'){
        $('#policy-form').validate({
            submitHandler: function (form) {
                transaction = 'submit policy';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Policy Success', 'The policy has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Policy Success', 'The policy has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#policy-datatable');
                        }
                        else{
                            show_alert('Policy Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                policy: {
                    required: true         
                },
                description: {
                    required: true         
                }
            },
            messages: {
                policy: {
                    required: 'Please enter the policy',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'permission form'){
        $('#permission-form').validate({
            submitHandler: function (form) {
                transaction = 'submit permission';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Permission Success', 'The permission has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Permission Success', 'The permission has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#permission-datatable');
                        }
                        else{
                            show_alert('Permission Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                permission: {
                    required: true         
                }
            },
            messages: {
                permission: {
                    required: 'Please enter the permission',
                }
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
    }
    else if(form_type == 'role form'){
        $('#role-form').validate({
            submitHandler: function (form) {
                transaction = 'submit role';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Role Success', 'The role has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Role Success', 'The role has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#role-datatable');
                        }
                        else{
                            show_alert('Role Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                role: {
                    required: true
                },
                description: {
                    required: true
                }
            },
            messages: {
                role: {
                    required: 'Please enter the role',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'system code form'){
        $('#system-code-form').validate({
            submitHandler: function (form) {
                var transaction = 'submit system code';

                document.getElementById('system_type').disabled = false;

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert System Code Success', 'The system code has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update System Code Success', 'The system code has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#system-code-datatable');
                        }
                        else{
                            show_alert('System Code Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                system_type: {
                    required: true         
                },
                systemcsystem_codeode: {
                    required: true         
                },
                system_description: {
                    required: true         
                }
            },
            messages: {
                system_type: {
                    required: 'Please choose the system type',
                },
                system_code: {
                    required: 'Please enter the system code',
                },
                system_description: {
                    required: 'Please enter the system description',
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
    }
    else if(form_type == 'notification type form'){
        $('#notification-type-form').validate({
            submitHandler: function (form) {
                transaction = 'submit notification type';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Notification Type Success', 'The notification type has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Notification Type Success', 'The notification type has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#notification-type-datatable');
                        }
                        else{
                            show_alert('Notification Type Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                notification: {
                    required: true         
                },
                description: {
                    required: true         
                }
            },
            messages: {
                notification: {
                    required: 'Please enter the notification',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'department form'){
        $('#department-form').validate({
            submitHandler: function (form) {
                transaction = 'submit department';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Department Success', 'The department has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Department Success', 'The department has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#department-datatable');
                        }
                        else{
                            show_alert('Department Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                department: {
                    required: true
                },
                description: {
                    required: true
                }
            },
            messages: {
                department: {
                    required: 'Please enter the department',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'designation form'){
        $('#designation-form').validate({
            submitHandler: function (form) {
                var transaction = 'submit designation';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Designation Success', 'The designation has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Designation Success', 'The designation has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#designation-datatable');
                        }
                        else if(response === 'File Size'){
                            show_alert('Designation Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Designation Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Designation Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                designation: {
                    required: true
                },
                description: {
                    required: true
                }
            },
            messages: {
                designation: {
                    required: 'Please enter the designation',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'branch form'){
        $('#branch-form').validate({
            submitHandler: function (form) {
                transaction = 'submit branch';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Branch Success', 'The branch has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Branch Success', 'The branch has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#branch-datatable');
                        }
                        else{
                            show_alert('Branch Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                branch: {
                    required: true
                },
                address: {
                    required: true
                }
            },
            messages: {
                branch: {
                    required: 'Please enter the branch',
                },
                address: {
                    required: 'Please enter the address',
                }
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
    }
    else if(form_type == 'upload setting form'){
        $('#upload-setting-form').validate({
            submitHandler: function (form) {
                transaction = 'submit upload setting';
                var file_type = $('#file_type').val();

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&file_type=' + file_type,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Upload Setting Success', 'The upload setting has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Upload Setting Success', 'The upload setting has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#upload-setting-datatable');
                        }
                        else{
                            show_alert('Upload Setting Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                upload_setting: {
                    required: true
                },
                max_file_size: {
                    required: true
                },
                file_type: {
                    required: true
                },
                description: {
                    required: true
                }
            },
            messages: {
                upload_setting: {
                    required: 'Please enter the upload setting',
                },
                max_file_size: {
                    required: 'Please enter the max file size',
                },
                file_type: {
                    required: 'Please choose at least one (1) file type',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'employment status form'){
        $('#employment-status-form').validate({
            submitHandler: function (form) {
                transaction = 'submit employment status';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Employment Status Success', 'The employment status has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Employment Status Success', 'The employment status has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#employment-status-datatable');
                        }
                        else{
                            show_alert('Employment Status Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                employment_status: {
                    required: true
                },
                color_value: {
                    required: true
                },
                description: {
                    required: true
                }
            },
            messages: {
                employment_status: {
                    required: 'Please enter the employment status',
                },
                color_value: {
                    required: 'Please enter the color value',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'employee form'){
        $('#employee-form').validate({
            submitHandler: function (form) {
                transaction = 'submit employee';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Employee Success', 'The employee has been inserted.', 'success');
                                reload_datatable('#employee-datatable');
                            }
                            else{
                                if($('#employee-datatable').length){
                                    show_alert('Update Employee Success', 'The employee has been updated.', 'success');
                                    reload_datatable('#employee-datatable');
                                }
                                else{
                                    show_alert_event('Update Employee Success', 'The employee has been updated.', 'success', 'reload');
                                }
                            }

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'ID Number Exist'){
                            show_alert('Employee Error', 'The ID number you entered already exist.', 'error');
                        }
                        else{
                            show_alert('Employee Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                id_number: {
                    required: true
                },
                joining_date: {
                    required: true
                },
                exit_date: {
                    required: function(element){
                        var employment_status = $('#employment_status').val();

                        if(employment_status == '3' || employment_status == '4'){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                exit_reason: {
                    required: function(element){
                        var employment_status = $('#employment_status').val();

                        if(employment_status == '3' || employment_status == '4'){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                permanency_date: {
                    required: function(element){
                        var employment_status = $('#employment_status').val();

                        if(employment_status == '1'){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                department: {
                    required: true
                },
                designation: {
                    required: true
                },
                branch: {
                    required: true
                },
                employment_status: {
                    required: true
                },
                birthday: {
                    employee_age : 18,
                    required: true
                },
                gender: {
                    required: true
                },
                phone: {
                    required: true
                }
            },
            messages: {
                id_number: {
                    required: 'Please enter the ID number',
                },
                joining_date: {
                    required: 'Please choose the joining date',
                },
                exit_date: {
                    required: 'Please choose the exit date',
                },
                exit_reason: {
                    required: 'Please enter the exit reason',
                },
                permanency_date: {
                    required: 'Please choose the permanency date',
                },
                first_name: {
                    required: 'Please enter the first name',
                },
                last_name: {
                    required: 'Please enter the last name',
                },
                department: {
                    required: 'Please choose the department',
                },
                designation: {
                    required: 'Please choose the designation',
                },
                branch: {
                    required: 'Please choose the branch',
                },
                employment_status: {
                    required: 'Please choose the employment status',
                },
                birthday: {
                    required: 'Please choose the birthday',
                },
                gender: {
                    required: 'Please choose the gender',
                },
                phone: {
                    required: 'Please enter the mobile number',
                }
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
    }
    else if(form_type == 'emergency contact form'){
        $('#emergency-contact-form').validate({
            submitHandler: function (form) {
                transaction = 'submit emergency contact';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Emergency Contact Success', 'The emergency contact has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Emergency Contact Success', 'The emergency contact has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#emergency-contact-datatable');
                        }
                        else{
                            show_alert('Emergency Contact Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                contact_name: {
                    required: true
                },
                relationship: {
                    required: true
                },
                address: {
                    required: true
                },
                province: {
                    required: true
                },
                city: {
                    required: true
                },
                phone: {
                    required: true
                }
            },
            messages: {
                contact_name: {
                    required: 'Please enter the name',
                },
                relationship: {
                    required: 'Please choose the relationship',
                },
                address: {
                    required: 'Please enter the address',
                },
                province: {
                    required: 'Please choose the province',
                },
                city: {
                    required: 'Please choose the city',
                },
                phone: {
                    required: 'Please enter the phone',
                }
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
    }
    else if(form_type == 'employee address form'){
        $('#employee-address-form').validate({
            submitHandler: function (form) {
                transaction = 'submit employee address';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Employee Address Success', 'The employee address has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Employee Address Success', 'The employee address has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#employee-address-datatable');
                        }
                        else{
                            show_alert('Employee Address Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                address_type: {
                    required: true
                },
                address: {
                    required: true
                },
                province: {
                    required: true
                },
                city: {
                    required: true
                }
            },
            messages: {
                address_type: {
                    required: 'Please choose the address type',
                },
                address: {
                    required: 'Please enter the address',
                },
                province: {
                    required: 'Please choose the province',
                },
                city: {
                    required: 'Please choose the city',
                }
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
    }
    else if(form_type == 'employee social form'){
        $('#employee-social-form').validate({
            submitHandler: function (form) {
                transaction = 'submit employee social';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Employee Social Success', 'The employee social has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Employee Social Success', 'The employee social has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#employee-social-datatable');
                        }
                        else{
                            show_alert('Employee Social Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                social_type: {
                    required: true
                },
                link: {
                    required: true
                }
            },
            messages: {
                social_type: {
                    required: 'Please choose the social',
                },
                link: {
                    required: 'Please enter the link',
                }
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
    }
    else if(form_type == 'work shift form'){
        $('#work-shift-form').validate({
            submitHandler: function (form) {
                transaction = 'submit work shift';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Work Shift Success', 'The work shift has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Work Shift Success', 'The work shift has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#work-shift-datatable');
                        }
                        else{
                            show_alert('Work Shift Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                work_shift: {
                    required: true
                },
                work_shift_type: {
                    required: true
                },
                description: {
                    required: true
                }
            },
            messages: {
                work_shift: {
                    required: 'Please enter the work shift',
                },
                work_shift_type: {
                    required: 'Please choose the work shift type',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'regular work shift schedule form'){
        $('#regular-work-shift-schedule-form').validate({
            submitHandler: function (form) {
                transaction = 'submit regular work shift schedule';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Work Shift Success', 'The work shift has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Work Shift Success', 'The work shift has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#work-shift-datatable');
                        }
                        else{
                            show_alert('Work Shift Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                monday_start_time: {
                    required: function(element){
                        var monday_end_time = $('#monday_end_time').val();
                        var monday_lunch_start_time = $('#monday_lunch_start_time').val();
                        var monday_lunch_end_time = $('#monday_lunch_end_time').val();
                        var monday_half_day_mark = $('#monday_half_day_mark').val();
                        var monday_late_mark = $('#monday_late_mark').val();

                        if(monday_end_time || monday_lunch_start_time || monday_lunch_end_time || monday_half_day_mark || monday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                monday_end_time: {
                    required: function(element){
                        var monday_start_time = $('#monday_start_time').val();
                        var monday_lunch_start_time = $('#monday_lunch_start_time').val();
                        var monday_lunch_end_time = $('#monday_lunch_end_time').val();
                        var monday_half_day_mark = $('#monday_half_day_mark').val();
                        var monday_late_mark = $('#monday_late_mark').val();

                        if(monday_start_time || monday_lunch_start_time || monday_lunch_end_time || monday_half_day_mark || monday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                monday_lunch_start_time: {
                    required: function(element){
                        var monday_start_time = $('#monday_start_time').val();
                        var monday_end_time = $('#monday_end_time').val();
                        var monday_lunch_end_time = $('#monday_lunch_end_time').val();
                        var monday_half_day_mark = $('#monday_half_day_mark').val();
                        var monday_late_mark = $('#monday_late_mark').val();

                        if(monday_start_time || monday_end_time || monday_lunch_end_time || monday_half_day_mark || monday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                monday_lunch_end_time: {
                    required: function(element){
                        var monday_start_time = $('#monday_start_time').val();
                        var monday_end_time = $('#monday_end_time').val();
                        var monday_lunch_start_time  = $('#monday_lunch_start_time').val();
                        var monday_half_day_mark = $('#monday_half_day_mark').val();
                        var monday_late_mark = $('#monday_late_mark').val();

                        if(monday_start_time || monday_end_time || monday_lunch_start_time || monday_half_day_mark || monday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                monday_half_day_mark: {
                    required: function(element){
                        var monday_start_time = $('#monday_start_time').val();
                        var monday_end_time = $('#monday_end_time').val();
                        var monday_lunch_start_time  = $('#monday_lunch_start_time').val();
                        var monday_lunch_end_time = $('#monday_lunch_end_time').val();
                        var monday_late_mark = $('#monday_late_mark').val();

                        if(monday_start_time || monday_end_time || monday_lunch_start_time || monday_lunch_end_time || monday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                monday_late_mark: {
                    required: function(element){
                        var monday_start_time = $('#monday_start_time').val();
                        var monday_end_time = $('#monday_end_time').val();
                        var monday_lunch_start_time  = $('#monday_lunch_start_time').val();
                        var monday_lunch_end_time = $('#monday_lunch_end_time').val();
                        var monday_half_day_mark = $('#monday_half_day_mark').val();

                        if(monday_start_time || monday_end_time || monday_lunch_start_time || monday_lunch_end_time || monday_half_day_mark){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                tuesday_start_time: {
                    required: function(element){
                        var tuesday_end_time = $('#tuesday_end_time').val();
                        var tuesday_lunch_start_time = $('#tuesday_lunch_start_time').val();
                        var tuesday_lunch_end_time = $('#tuesday_lunch_end_time').val();
                        var tuesday_half_day_mark = $('#tuesday_half_day_mark').val();
                        var tuesday_late_mark = $('#tuesday_late_mark').val();

                        if(tuesday_end_time || tuesday_lunch_start_time || tuesday_lunch_end_time || tuesday_half_day_mark || tuesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                tuesday_end_time: {
                    required: function(element){
                        var tuesday_start_time = $('#tuesday_start_time').val();
                        var tuesday_lunch_start_time = $('#tuesday_lunch_start_time').val();
                        var tuesday_lunch_end_time = $('#tuesday_lunch_end_time').val();
                        var tuesday_half_day_mark = $('#tuesday_half_day_mark').val();
                        var tuesday_late_mark = $('#tuesday_late_mark').val();

                        if(tuesday_start_time || tuesday_lunch_start_time || tuesday_lunch_end_time || tuesday_half_day_mark || tuesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                tuesday_lunch_start_time: {
                    required: function(element){
                        var tuesday_start_time = $('#tuesday_start_time').val();
                        var tuesday_end_time = $('#tuesday_end_time').val();
                        var tuesday_lunch_end_time = $('#tuesday_lunch_end_time').val();
                        var tuesday_half_day_mark = $('#tuesday_half_day_mark').val();
                        var tuesday_late_mark = $('#tuesday_late_mark').val();

                        if(tuesday_start_time || tuesday_end_time || tuesday_lunch_end_time || tuesday_half_day_mark || tuesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                tuesday_lunch_end_time: {
                    required: function(element){
                        var tuesday_start_time = $('#tuesday_start_time').val();
                        var tuesday_end_time = $('#tuesday_end_time').val();
                        var tuesday_lunch_start_time  = $('#tuesday_lunch_start_time').val();
                        var tuesday_half_day_mark = $('#tuesday_half_day_mark').val();
                        var tuesday_late_mark = $('#tuesday_late_mark').val();

                        if(tuesday_start_time || tuesday_end_time || tuesday_lunch_start_time || tuesday_half_day_mark || tuesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                tuesday_half_day_mark: {
                    required: function(element){
                        var tuesday_start_time = $('#tuesday_start_time').val();
                        var tuesday_end_time = $('#tuesday_end_time').val();
                        var tuesday_lunch_start_time  = $('#tuesday_lunch_start_time').val();
                        var tuesday_lunch_end_time = $('#tuesday_lunch_end_time').val();
                        var tuesday_late_mark = $('#tuesday_late_mark').val();

                        if(tuesday_start_time || tuesday_end_time || tuesday_lunch_start_time || tuesday_lunch_end_time || tuesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                tuesday_late_mark: {
                    required: function(element){
                        var tuesday_start_time = $('#tuesday_start_time').val();
                        var tuesday_end_time = $('#tuesday_end_time').val();
                        var tuesday_lunch_start_time  = $('#tuesday_lunch_start_time').val();
                        var tuesday_lunch_end_time = $('#tuesday_lunch_end_time').val();
                        var tuesday_half_day_mark = $('#tuesday_half_day_mark').val();

                        if(tuesday_start_time || tuesday_end_time || tuesday_lunch_start_time || tuesday_lunch_end_time || tuesday_half_day_mark){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                wednesday_start_time: {
                    required: function(element){
                        var wednesday_end_time = $('#wednesday_end_time').val();
                        var wednesday_lunch_start_time = $('#wednesday_lunch_start_time').val();
                        var wednesday_lunch_end_time = $('#wednesday_lunch_end_time').val();
                        var wednesday_half_day_mark = $('#wednesday_half_day_mark').val();
                        var wednesday_late_mark = $('#wednesday_late_mark').val();

                        if(wednesday_end_time || wednesday_lunch_start_time || wednesday_lunch_end_time || wednesday_half_day_mark || wednesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                wednesday_end_time: {
                    required: function(element){
                        var wednesday_start_time = $('#wednesday_start_time').val();
                        var wednesday_lunch_start_time = $('#wednesday_lunch_start_time').val();
                        var wednesday_lunch_end_time = $('#wednesday_lunch_end_time').val();
                        var wednesday_half_day_mark = $('#wednesday_half_day_mark').val();
                        var wednesday_late_mark = $('#wednesday_late_mark').val();

                        if(wednesday_start_time || wednesday_lunch_start_time || wednesday_lunch_end_time || wednesday_half_day_mark || wednesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                wednesday_lunch_start_time: {
                    required: function(element){
                        var wednesday_start_time = $('#wednesday_start_time').val();
                        var wednesday_end_time = $('#wednesday_end_time').val();
                        var wednesday_lunch_end_time = $('#wednesday_lunch_end_time').val();
                        var wednesday_half_day_mark = $('#wednesday_half_day_mark').val();
                        var wednesday_late_mark = $('#wednesday_late_mark').val();

                        if(wednesday_start_time || wednesday_end_time || wednesday_lunch_end_time || wednesday_half_day_mark || wednesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                wednesday_lunch_end_time: {
                    required: function(element){
                        var wednesday_start_time = $('#wednesday_start_time').val();
                        var wednesday_end_time = $('#wednesday_end_time').val();
                        var wednesday_lunch_start_time  = $('#wednesday_lunch_start_time').val();
                        var wednesday_half_day_mark = $('#wednesday_half_day_mark').val();
                        var wednesday_late_mark = $('#wednesday_late_mark').val();

                        if(wednesday_start_time || wednesday_end_time || wednesday_lunch_start_time || wednesday_half_day_mark || wednesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                wednesday_half_day_mark: {
                    required: function(element){
                        var wednesday_start_time = $('#wednesday_start_time').val();
                        var wednesday_end_time = $('#wednesday_end_time').val();
                        var wednesday_lunch_start_time  = $('#wednesday_lunch_start_time').val();
                        var wednesday_lunch_end_time = $('#wednesday_lunch_end_time').val();
                        var wednesday_late_mark = $('#wednesday_late_mark').val();

                        if(wednesday_start_time || wednesday_end_time || wednesday_lunch_start_time || wednesday_lunch_end_time || wednesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                wednesday_late_mark: {
                    required: function(element){
                        var wednesday_start_time = $('#wednesday_start_time').val();
                        var wednesday_end_time = $('#wednesday_end_time').val();
                        var wednesday_lunch_start_time  = $('#wednesday_lunch_start_time').val();
                        var wednesday_lunch_end_time = $('#wednesday_lunch_end_time').val();
                        var wednesday_half_day_mark = $('#wednesday_half_day_mark').val();

                        if(wednesday_start_time || wednesday_end_time || wednesday_lunch_start_time || wednesday_lunch_end_time || wednesday_half_day_mark){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                thursday_start_time: {
                    required: function(element){
                        var thursday_end_time = $('#thursday_end_time').val();
                        var thursday_lunch_start_time = $('#thursday_lunch_start_time').val();
                        var thursday_lunch_end_time = $('#thursday_lunch_end_time').val();
                        var thursday_half_day_mark = $('#thursday_half_day_mark').val();
                        var thursday_late_mark = $('#thursday_late_mark').val();

                        if(thursday_end_time || thursday_lunch_start_time || thursday_lunch_end_time || thursday_half_day_mark || thursday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                thursday_end_time: {
                    required: function(element){
                        var thursday_start_time = $('#thursday_start_time').val();
                        var thursday_lunch_start_time = $('#thursday_lunch_start_time').val();
                        var thursday_lunch_end_time = $('#thursday_lunch_end_time').val();
                        var thursday_half_day_mark = $('#thursday_half_day_mark').val();
                        var thursday_late_mark = $('#thursday_late_mark').val();

                        if(thursday_start_time || thursday_lunch_start_time || thursday_lunch_end_time || thursday_half_day_mark || thursday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                thursday_lunch_start_time: {
                    required: function(element){
                        var thursday_start_time = $('#thursday_start_time').val();
                        var thursday_end_time = $('#thursday_end_time').val();
                        var thursday_lunch_end_time = $('#thursday_lunch_end_time').val();
                        var thursday_half_day_mark = $('#thursday_half_day_mark').val();
                        var thursday_late_mark = $('#thursday_late_mark').val();

                        if(thursday_start_time || thursday_end_time || thursday_lunch_end_time || thursday_half_day_mark || thursday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                thursday_lunch_end_time: {
                    required: function(element){
                        var thursday_start_time = $('#thursday_start_time').val();
                        var thursday_end_time = $('#thursday_end_time').val();
                        var thursday_lunch_start_time  = $('#thursday_lunch_start_time').val();
                        var thursday_half_day_mark = $('#thursday_half_day_mark').val();
                        var thursday_late_mark = $('#thursday_late_mark').val();

                        if(thursday_start_time || thursday_end_time || thursday_lunch_start_time || thursday_half_day_mark || thursday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                thursday_half_day_mark: {
                    required: function(element){
                        var thursday_start_time = $('#thursday_start_time').val();
                        var thursday_end_time = $('#thursday_end_time').val();
                        var thursday_lunch_start_time  = $('#thursday_lunch_start_time').val();
                        var thursday_lunch_end_time = $('#thursday_lunch_end_time').val();
                        var thursday_late_mark = $('#thursday_late_mark').val();

                        if(thursday_start_time || thursday_end_time || thursday_lunch_start_time || thursday_lunch_end_time || thursday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                thursday_late_mark: {
                    required: function(element){
                        var thursday_start_time = $('#thursday_start_time').val();
                        var thursday_end_time = $('#thursday_end_time').val();
                        var thursday_lunch_start_time  = $('#thursday_lunch_start_time').val();
                        var thursday_lunch_end_time = $('#thursday_lunch_end_time').val();
                        var thursday_half_day_mark = $('#thursday_half_day_mark').val();

                        if(thursday_start_time || thursday_end_time || thursday_lunch_start_time || thursday_lunch_end_time || thursday_half_day_mark){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                friday_start_time: {
                    required: function(element){
                        var friday_end_time = $('#friday_end_time').val();
                        var friday_lunch_start_time = $('#friday_lunch_start_time').val();
                        var friday_lunch_end_time = $('#friday_lunch_end_time').val();
                        var friday_half_day_mark = $('#friday_half_day_mark').val();
                        var friday_late_mark = $('#friday_late_mark').val();

                        if(friday_end_time || friday_lunch_start_time || friday_lunch_end_time || friday_half_day_mark || friday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                friday_end_time: {
                    required: function(element){
                        var friday_start_time = $('#friday_start_time').val();
                        var friday_lunch_start_time = $('#friday_lunch_start_time').val();
                        var friday_lunch_end_time = $('#friday_lunch_end_time').val();
                        var friday_half_day_mark = $('#friday_half_day_mark').val();
                        var friday_late_mark = $('#friday_late_mark').val();

                        if(friday_start_time || friday_lunch_start_time || friday_lunch_end_time || friday_half_day_mark || friday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                friday_lunch_start_time: {
                    required: function(element){
                        var friday_start_time = $('#friday_start_time').val();
                        var friday_end_time = $('#friday_end_time').val();
                        var friday_lunch_end_time = $('#friday_lunch_end_time').val();
                        var friday_half_day_mark = $('#friday_half_day_mark').val();
                        var friday_late_mark = $('#friday_late_mark').val();

                        if(friday_start_time || friday_end_time || friday_lunch_end_time || friday_half_day_mark || friday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                friday_lunch_end_time: {
                    required: function(element){
                        var friday_start_time = $('#friday_start_time').val();
                        var friday_end_time = $('#friday_end_time').val();
                        var friday_lunch_start_time  = $('#friday_lunch_start_time').val();
                        var friday_half_day_mark = $('#friday_half_day_mark').val();
                        var friday_late_mark = $('#friday_late_mark').val();

                        if(friday_start_time || friday_end_time || friday_lunch_start_time || friday_half_day_mark || friday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                friday_half_day_mark: {
                    required: function(element){
                        var friday_start_time = $('#friday_start_time').val();
                        var friday_end_time = $('#friday_end_time').val();
                        var friday_lunch_start_time  = $('#friday_lunch_start_time').val();
                        var friday_lunch_end_time = $('#friday_lunch_end_time').val();
                        var friday_late_mark = $('#friday_late_mark').val();

                        if(friday_start_time || friday_end_time || friday_lunch_start_time || friday_lunch_end_time || friday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                friday_late_mark: {
                    required: function(element){
                        var friday_start_time = $('#friday_start_time').val();
                        var friday_end_time = $('#friday_end_time').val();
                        var friday_lunch_start_time  = $('#friday_lunch_start_time').val();
                        var friday_lunch_end_time = $('#friday_lunch_end_time').val();
                        var friday_half_day_mark = $('#friday_half_day_mark').val();

                        if(friday_start_time || friday_end_time || friday_lunch_start_time || friday_lunch_end_time || friday_half_day_mark){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                saturday_start_time: {
                    required: function(element){
                        var saturday_end_time = $('#saturday_end_time').val();
                        var saturday_lunch_start_time = $('#saturday_lunch_start_time').val();
                        var saturday_lunch_end_time = $('#saturday_lunch_end_time').val();
                        var saturday_half_day_mark = $('#saturday_half_day_mark').val();
                        var saturday_late_mark = $('#saturday_late_mark').val();

                        if(saturday_end_time || saturday_lunch_start_time || saturday_lunch_end_time || saturday_half_day_mark || saturday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                saturday_end_time: {
                    required: function(element){
                        var saturday_start_time = $('#saturday_start_time').val();
                        var saturday_lunch_start_time = $('#saturday_lunch_start_time').val();
                        var saturday_lunch_end_time = $('#saturday_lunch_end_time').val();
                        var saturday_half_day_mark = $('#saturday_half_day_mark').val();
                        var saturday_late_mark = $('#saturday_late_mark').val();

                        if(saturday_start_time || saturday_lunch_start_time || saturday_lunch_end_time || saturday_half_day_mark || saturday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                saturday_lunch_start_time: {
                    required: function(element){
                        var saturday_start_time = $('#saturday_start_time').val();
                        var saturday_end_time = $('#saturday_end_time').val();
                        var saturday_lunch_end_time = $('#saturday_lunch_end_time').val();
                        var saturday_half_day_mark = $('#saturday_half_day_mark').val();
                        var saturday_late_mark = $('#saturday_late_mark').val();

                        if(saturday_start_time || saturday_end_time || saturday_lunch_end_time || saturday_half_day_mark || saturday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                saturday_lunch_end_time: {
                    required: function(element){
                        var saturday_start_time = $('#saturday_start_time').val();
                        var saturday_end_time = $('#saturday_end_time').val();
                        var saturday_lunch_start_time  = $('#saturday_lunch_start_time').val();
                        var saturday_half_day_mark = $('#saturday_half_day_mark').val();
                        var saturday_late_mark = $('#saturday_late_mark').val();

                        if(saturday_start_time || saturday_end_time || saturday_lunch_start_time || saturday_half_day_mark || saturday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                saturday_half_day_mark: {
                    required: function(element){
                        var saturday_start_time = $('#saturday_start_time').val();
                        var saturday_end_time = $('#saturday_end_time').val();
                        var saturday_lunch_start_time  = $('#saturday_lunch_start_time').val();
                        var saturday_lunch_end_time = $('#saturday_lunch_end_time').val();
                        var saturday_late_mark = $('#saturday_late_mark').val();

                        if(saturday_start_time || saturday_end_time || saturday_lunch_start_time || saturday_lunch_end_time || saturday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                saturday_late_mark: {
                    required: function(element){
                        var saturday_start_time = $('#saturday_start_time').val();
                        var saturday_end_time = $('#saturday_end_time').val();
                        var saturday_lunch_start_time  = $('#saturday_lunch_start_time').val();
                        var saturday_lunch_end_time = $('#saturday_lunch_end_time').val();
                        var saturday_half_day_mark = $('#saturday_half_day_mark').val();

                        if(saturday_start_time || saturday_end_time || saturday_lunch_start_time || saturday_lunch_end_time || saturday_half_day_mark){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                sunday_start_time: {
                    required: function(element){
                        var sunday_end_time = $('#sunday_end_time').val();
                        var sunday_lunch_start_time = $('#sunday_lunch_start_time').val();
                        var sunday_lunch_end_time = $('#sunday_lunch_end_time').val();
                        var sunday_half_day_mark = $('#sunday_half_day_mark').val();
                        var sunday_late_mark = $('#sunday_late_mark').val();

                        if(sunday_end_time || sunday_lunch_start_time || sunday_lunch_end_time || sunday_half_day_mark || sunday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                sunday_end_time: {
                    required: function(element){
                        var sunday_start_time = $('#sunday_start_time').val();
                        var sunday_lunch_start_time = $('#sunday_lunch_start_time').val();
                        var sunday_lunch_end_time = $('#sunday_lunch_end_time').val();
                        var sunday_half_day_mark = $('#sunday_half_day_mark').val();
                        var sunday_late_mark = $('#sunday_late_mark').val();

                        if(sunday_start_time || sunday_lunch_start_time || sunday_lunch_end_time || sunday_half_day_mark || sunday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                sunday_lunch_start_time: {
                    required: function(element){
                        var sunday_start_time = $('#sunday_start_time').val();
                        var sunday_end_time = $('#sunday_end_time').val();
                        var sunday_lunch_end_time = $('#sunday_lunch_end_time').val();
                        var sunday_half_day_mark = $('#sunday_half_day_mark').val();
                        var sunday_late_mark = $('#sunday_late_mark').val();

                        if(sunday_start_time || sunday_end_time || sunday_lunch_end_time || sunday_half_day_mark || sunday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                sunday_lunch_end_time: {
                    required: function(element){
                        var sunday_start_time = $('#sunday_start_time').val();
                        var sunday_end_time = $('#sunday_end_time').val();
                        var sunday_lunch_start_time  = $('#sunday_lunch_start_time').val();
                        var sunday_half_day_mark = $('#sunday_half_day_mark').val();
                        var sunday_late_mark = $('#sunday_late_mark').val();

                        if(sunday_start_time || sunday_end_time || sunday_lunch_start_time || sunday_half_day_mark || sunday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                sunday_half_day_mark: {
                    required: function(element){
                        var sunday_start_time = $('#sunday_start_time').val();
                        var sunday_end_time = $('#sunday_end_time').val();
                        var sunday_lunch_start_time  = $('#sunday_lunch_start_time').val();
                        var sunday_lunch_end_time = $('#sunday_lunch_end_time').val();
                        var sunday_late_mark = $('#sunday_late_mark').val();

                        if(sunday_start_time || sunday_end_time || sunday_lunch_start_time || sunday_lunch_end_time || sunday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                sunday_late_mark: {
                    required: function(element){
                        var sunday_start_time = $('#sunday_start_time').val();
                        var sunday_end_time = $('#sunday_end_time').val();
                        var sunday_lunch_start_time  = $('#sunday_lunch_start_time').val();
                        var sunday_lunch_end_time = $('#sunday_lunch_end_time').val();
                        var sunday_half_day_mark = $('#sunday_half_day_mark').val();

                        if(sunday_start_time || sunday_end_time || sunday_lunch_start_time || sunday_lunch_end_time || sunday_half_day_mark){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
            },
            messages: {
                monday_start_time: {
                    required: 'Please enter the start time',
                },
                monday_end_time: {
                    required: 'Please enter the end time',
                },
                monday_lunch_start_time: {
                    required: 'Please enter the lunch start time',
                },
                monday_lunch_end_time: {
                    required: 'Please enter the lunch end time',
                },
                monday_half_day_mark: {
                    required: 'Please enter the half day mark',
                },
                monday_late_mark: {
                    required: 'Please enter the late mark',
                },
                tuesday_start_time: {
                    required: 'Please enter the start time',
                },
                tuesday_end_time: {
                    required: 'Please enter the end time',
                },
                tuesday_lunch_start_time: {
                    required: 'Please enter the lunch start time',
                },
                tuesday_lunch_end_time: {
                    required: 'Please enter the lunch end time',
                },
                tuesday_half_day_mark: {
                    required: 'Please enter the half day mark',
                },
                tuesday_late_mark: {
                    required: 'Please enter the late mark',
                },
                wednesday_start_time: {
                    required: 'Please enter the start time',
                },
                wednesday_end_time: {
                    required: 'Please enter the end time',
                },
                wednesday_lunch_start_time: {
                    required: 'Please enter the lunch start time',
                },
                wednesday_lunch_end_time: {
                    required: 'Please enter the lunch end time',
                },
                wednesday_half_day_mark: {
                    required: 'Please enter the half day mark',
                },
                wednesday_late_mark: {
                    required: 'Please enter the late mark',
                },
                thursday_start_time: {
                    required: 'Please enter the start time',
                },
                thursday_end_time: {
                    required: 'Please enter the end time',
                },
                thursday_lunch_start_time: {
                    required: 'Please enter the lunch start time',
                },
                thursday_lunch_end_time: {
                    required: 'Please enter the lunch end time',
                },
                thursday_half_day_mark: {
                    required: 'Please enter the half day mark',
                },
                thursday_late_mark: {
                    required: 'Please enter the late mark',
                },
                friday_start_time: {
                    required: 'Please enter the start time',
                },
                friday_end_time: {
                    required: 'Please enter the end time',
                },
                friday_lunch_start_time: {
                    required: 'Please enter the lunch start time',
                },
                friday_lunch_end_time: {
                    required: 'Please enter the lunch end time',
                },
                friday_half_day_mark: {
                    required: 'Please enter the half day mark',
                },
                friday_late_mark: {
                    required: 'Please enter the late mark',
                },
                saturday_start_time: {
                    required: 'Please enter the start time',
                },
                saturday_end_time: {
                    required: 'Please enter the end time',
                },
                saturday_lunch_start_time: {
                    required: 'Please enter the lunch start time',
                },
                saturday_lunch_end_time: {
                    required: 'Please enter the lunch end time',
                },
                saturday_half_day_mark: {
                    required: 'Please enter the half day mark',
                },
                saturday_late_mark: {
                    required: 'Please enter the late mark',
                },
                sunday_start_time: {
                    required: 'Please enter the start time',
                },
                sunday_end_time: {
                    required: 'Please enter the end time',
                },
                sunday_lunch_start_time: {
                    required: 'Please enter the lunch start time',
                },
                sunday_lunch_end_time: {
                    required: 'Please enter the lunch end time',
                },
                sunday_half_day_mark: {
                    required: 'Please enter the half day mark',
                },
                sunday_late_mark: {
                    required: 'Please enter the late mark',
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
    }
    else if(form_type == 'scheduled work shift schedule form'){
        $('#scheduled-work-shift-schedule-form').validate({
            submitHandler: function (form) {
                transaction = 'submit scheduled work shift schedule';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Work Shift Success', 'The work shift has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Work Shift Success', 'The work shift has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#work-shift-datatable');
                        }
                        else{
                            show_alert('Work Shift Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                start_date: {
                    required: true
                },
                end_date: {
                    required: true
                },
                monday_start_time: {
                    required: function(element){
                        var monday_end_time = $('#monday_end_time').val();
                        var monday_lunch_start_time = $('#monday_lunch_start_time').val();
                        var monday_lunch_end_time = $('#monday_lunch_end_time').val();
                        var monday_half_day_mark = $('#monday_half_day_mark').val();
                        var monday_late_mark = $('#monday_late_mark').val();

                        if(monday_end_time || monday_lunch_start_time || monday_lunch_end_time || monday_half_day_mark || monday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                monday_end_time: {
                    required: function(element){
                        var monday_start_time = $('#monday_start_time').val();
                        var monday_lunch_start_time = $('#monday_lunch_start_time').val();
                        var monday_lunch_end_time = $('#monday_lunch_end_time').val();
                        var monday_half_day_mark = $('#monday_half_day_mark').val();
                        var monday_late_mark = $('#monday_late_mark').val();

                        if(monday_start_time || monday_lunch_start_time || monday_lunch_end_time || monday_half_day_mark || monday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                monday_lunch_start_time: {
                    required: function(element){
                        var monday_start_time = $('#monday_start_time').val();
                        var monday_end_time = $('#monday_end_time').val();
                        var monday_lunch_end_time = $('#monday_lunch_end_time').val();
                        var monday_half_day_mark = $('#monday_half_day_mark').val();
                        var monday_late_mark = $('#monday_late_mark').val();

                        if(monday_start_time || monday_end_time || monday_lunch_end_time || monday_half_day_mark || monday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                monday_lunch_end_time: {
                    required: function(element){
                        var monday_start_time = $('#monday_start_time').val();
                        var monday_end_time = $('#monday_end_time').val();
                        var monday_lunch_start_time  = $('#monday_lunch_start_time').val();
                        var monday_half_day_mark = $('#monday_half_day_mark').val();
                        var monday_late_mark = $('#monday_late_mark').val();

                        if(monday_start_time || monday_end_time || monday_lunch_start_time || monday_half_day_mark || monday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                monday_half_day_mark: {
                    required: function(element){
                        var monday_start_time = $('#monday_start_time').val();
                        var monday_end_time = $('#monday_end_time').val();
                        var monday_lunch_start_time  = $('#monday_lunch_start_time').val();
                        var monday_lunch_end_time = $('#monday_lunch_end_time').val();
                        var monday_late_mark = $('#monday_late_mark').val();

                        if(monday_start_time || monday_end_time || monday_lunch_start_time || monday_lunch_end_time || monday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                monday_late_mark: {
                    required: function(element){
                        var monday_start_time = $('#monday_start_time').val();
                        var monday_end_time = $('#monday_end_time').val();
                        var monday_lunch_start_time  = $('#monday_lunch_start_time').val();
                        var monday_lunch_end_time = $('#monday_lunch_end_time').val();
                        var monday_half_day_mark = $('#monday_half_day_mark').val();

                        if(monday_start_time || monday_end_time || monday_lunch_start_time || monday_lunch_end_time || monday_half_day_mark){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                tuesday_start_time: {
                    required: function(element){
                        var tuesday_end_time = $('#tuesday_end_time').val();
                        var tuesday_lunch_start_time = $('#tuesday_lunch_start_time').val();
                        var tuesday_lunch_end_time = $('#tuesday_lunch_end_time').val();
                        var tuesday_half_day_mark = $('#tuesday_half_day_mark').val();
                        var tuesday_late_mark = $('#tuesday_late_mark').val();

                        if(tuesday_end_time || tuesday_lunch_start_time || tuesday_lunch_end_time || tuesday_half_day_mark || tuesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                tuesday_end_time: {
                    required: function(element){
                        var tuesday_start_time = $('#tuesday_start_time').val();
                        var tuesday_lunch_start_time = $('#tuesday_lunch_start_time').val();
                        var tuesday_lunch_end_time = $('#tuesday_lunch_end_time').val();
                        var tuesday_half_day_mark = $('#tuesday_half_day_mark').val();
                        var tuesday_late_mark = $('#tuesday_late_mark').val();

                        if(tuesday_start_time || tuesday_lunch_start_time || tuesday_lunch_end_time || tuesday_half_day_mark || tuesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                tuesday_lunch_start_time: {
                    required: function(element){
                        var tuesday_start_time = $('#tuesday_start_time').val();
                        var tuesday_end_time = $('#tuesday_end_time').val();
                        var tuesday_lunch_end_time = $('#tuesday_lunch_end_time').val();
                        var tuesday_half_day_mark = $('#tuesday_half_day_mark').val();
                        var tuesday_late_mark = $('#tuesday_late_mark').val();

                        if(tuesday_start_time || tuesday_end_time || tuesday_lunch_end_time || tuesday_half_day_mark || tuesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                tuesday_lunch_end_time: {
                    required: function(element){
                        var tuesday_start_time = $('#tuesday_start_time').val();
                        var tuesday_end_time = $('#tuesday_end_time').val();
                        var tuesday_lunch_start_time  = $('#tuesday_lunch_start_time').val();
                        var tuesday_half_day_mark = $('#tuesday_half_day_mark').val();
                        var tuesday_late_mark = $('#tuesday_late_mark').val();

                        if(tuesday_start_time || tuesday_end_time || tuesday_lunch_start_time || tuesday_half_day_mark || tuesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                tuesday_half_day_mark: {
                    required: function(element){
                        var tuesday_start_time = $('#tuesday_start_time').val();
                        var tuesday_end_time = $('#tuesday_end_time').val();
                        var tuesday_lunch_start_time  = $('#tuesday_lunch_start_time').val();
                        var tuesday_lunch_end_time = $('#tuesday_lunch_end_time').val();
                        var tuesday_late_mark = $('#tuesday_late_mark').val();

                        if(tuesday_start_time || tuesday_end_time || tuesday_lunch_start_time || tuesday_lunch_end_time || tuesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                tuesday_late_mark: {
                    required: function(element){
                        var tuesday_start_time = $('#tuesday_start_time').val();
                        var tuesday_end_time = $('#tuesday_end_time').val();
                        var tuesday_lunch_start_time  = $('#tuesday_lunch_start_time').val();
                        var tuesday_lunch_end_time = $('#tuesday_lunch_end_time').val();
                        var tuesday_half_day_mark = $('#tuesday_half_day_mark').val();

                        if(tuesday_start_time || tuesday_end_time || tuesday_lunch_start_time || tuesday_lunch_end_time || tuesday_half_day_mark){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                wednesday_start_time: {
                    required: function(element){
                        var wednesday_end_time = $('#wednesday_end_time').val();
                        var wednesday_lunch_start_time = $('#wednesday_lunch_start_time').val();
                        var wednesday_lunch_end_time = $('#wednesday_lunch_end_time').val();
                        var wednesday_half_day_mark = $('#wednesday_half_day_mark').val();
                        var wednesday_late_mark = $('#wednesday_late_mark').val();

                        if(wednesday_end_time || wednesday_lunch_start_time || wednesday_lunch_end_time || wednesday_half_day_mark || wednesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                wednesday_end_time: {
                    required: function(element){
                        var wednesday_start_time = $('#wednesday_start_time').val();
                        var wednesday_lunch_start_time = $('#wednesday_lunch_start_time').val();
                        var wednesday_lunch_end_time = $('#wednesday_lunch_end_time').val();
                        var wednesday_half_day_mark = $('#wednesday_half_day_mark').val();
                        var wednesday_late_mark = $('#wednesday_late_mark').val();

                        if(wednesday_start_time || wednesday_lunch_start_time || wednesday_lunch_end_time || wednesday_half_day_mark || wednesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                wednesday_lunch_start_time: {
                    required: function(element){
                        var wednesday_start_time = $('#wednesday_start_time').val();
                        var wednesday_end_time = $('#wednesday_end_time').val();
                        var wednesday_lunch_end_time = $('#wednesday_lunch_end_time').val();
                        var wednesday_half_day_mark = $('#wednesday_half_day_mark').val();
                        var wednesday_late_mark = $('#wednesday_late_mark').val();

                        if(wednesday_start_time || wednesday_end_time || wednesday_lunch_end_time || wednesday_half_day_mark || wednesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                wednesday_lunch_end_time: {
                    required: function(element){
                        var wednesday_start_time = $('#wednesday_start_time').val();
                        var wednesday_end_time = $('#wednesday_end_time').val();
                        var wednesday_lunch_start_time  = $('#wednesday_lunch_start_time').val();
                        var wednesday_half_day_mark = $('#wednesday_half_day_mark').val();
                        var wednesday_late_mark = $('#wednesday_late_mark').val();

                        if(wednesday_start_time || wednesday_end_time || wednesday_lunch_start_time || wednesday_half_day_mark || wednesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                wednesday_half_day_mark: {
                    required: function(element){
                        var wednesday_start_time = $('#wednesday_start_time').val();
                        var wednesday_end_time = $('#wednesday_end_time').val();
                        var wednesday_lunch_start_time  = $('#wednesday_lunch_start_time').val();
                        var wednesday_lunch_end_time = $('#wednesday_lunch_end_time').val();
                        var wednesday_late_mark = $('#wednesday_late_mark').val();

                        if(wednesday_start_time || wednesday_end_time || wednesday_lunch_start_time || wednesday_lunch_end_time || wednesday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                wednesday_late_mark: {
                    required: function(element){
                        var wednesday_start_time = $('#wednesday_start_time').val();
                        var wednesday_end_time = $('#wednesday_end_time').val();
                        var wednesday_lunch_start_time  = $('#wednesday_lunch_start_time').val();
                        var wednesday_lunch_end_time = $('#wednesday_lunch_end_time').val();
                        var wednesday_half_day_mark = $('#wednesday_half_day_mark').val();

                        if(wednesday_start_time || wednesday_end_time || wednesday_lunch_start_time || wednesday_lunch_end_time || wednesday_half_day_mark){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                thursday_start_time: {
                    required: function(element){
                        var thursday_end_time = $('#thursday_end_time').val();
                        var thursday_lunch_start_time = $('#thursday_lunch_start_time').val();
                        var thursday_lunch_end_time = $('#thursday_lunch_end_time').val();
                        var thursday_half_day_mark = $('#thursday_half_day_mark').val();
                        var thursday_late_mark = $('#thursday_late_mark').val();

                        if(thursday_end_time || thursday_lunch_start_time || thursday_lunch_end_time || thursday_half_day_mark || thursday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                thursday_end_time: {
                    required: function(element){
                        var thursday_start_time = $('#thursday_start_time').val();
                        var thursday_lunch_start_time = $('#thursday_lunch_start_time').val();
                        var thursday_lunch_end_time = $('#thursday_lunch_end_time').val();
                        var thursday_half_day_mark = $('#thursday_half_day_mark').val();
                        var thursday_late_mark = $('#thursday_late_mark').val();

                        if(thursday_start_time || thursday_lunch_start_time || thursday_lunch_end_time || thursday_half_day_mark || thursday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                thursday_lunch_start_time: {
                    required: function(element){
                        var thursday_start_time = $('#thursday_start_time').val();
                        var thursday_end_time = $('#thursday_end_time').val();
                        var thursday_lunch_end_time = $('#thursday_lunch_end_time').val();
                        var thursday_half_day_mark = $('#thursday_half_day_mark').val();
                        var thursday_late_mark = $('#thursday_late_mark').val();

                        if(thursday_start_time || thursday_end_time || thursday_lunch_end_time || thursday_half_day_mark || thursday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                thursday_lunch_end_time: {
                    required: function(element){
                        var thursday_start_time = $('#thursday_start_time').val();
                        var thursday_end_time = $('#thursday_end_time').val();
                        var thursday_lunch_start_time  = $('#thursday_lunch_start_time').val();
                        var thursday_half_day_mark = $('#thursday_half_day_mark').val();
                        var thursday_late_mark = $('#thursday_late_mark').val();

                        if(thursday_start_time || thursday_end_time || thursday_lunch_start_time || thursday_half_day_mark || thursday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                thursday_half_day_mark: {
                    required: function(element){
                        var thursday_start_time = $('#thursday_start_time').val();
                        var thursday_end_time = $('#thursday_end_time').val();
                        var thursday_lunch_start_time  = $('#thursday_lunch_start_time').val();
                        var thursday_lunch_end_time = $('#thursday_lunch_end_time').val();
                        var thursday_late_mark = $('#thursday_late_mark').val();

                        if(thursday_start_time || thursday_end_time || thursday_lunch_start_time || thursday_lunch_end_time || thursday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                thursday_late_mark: {
                    required: function(element){
                        var thursday_start_time = $('#thursday_start_time').val();
                        var thursday_end_time = $('#thursday_end_time').val();
                        var thursday_lunch_start_time  = $('#thursday_lunch_start_time').val();
                        var thursday_lunch_end_time = $('#thursday_lunch_end_time').val();
                        var thursday_half_day_mark = $('#thursday_half_day_mark').val();

                        if(thursday_start_time || thursday_end_time || thursday_lunch_start_time || thursday_lunch_end_time || thursday_half_day_mark){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                friday_start_time: {
                    required: function(element){
                        var friday_end_time = $('#friday_end_time').val();
                        var friday_lunch_start_time = $('#friday_lunch_start_time').val();
                        var friday_lunch_end_time = $('#friday_lunch_end_time').val();
                        var friday_half_day_mark = $('#friday_half_day_mark').val();
                        var friday_late_mark = $('#friday_late_mark').val();

                        if(friday_end_time || friday_lunch_start_time || friday_lunch_end_time || friday_half_day_mark || friday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                friday_end_time: {
                    required: function(element){
                        var friday_start_time = $('#friday_start_time').val();
                        var friday_lunch_start_time = $('#friday_lunch_start_time').val();
                        var friday_lunch_end_time = $('#friday_lunch_end_time').val();
                        var friday_half_day_mark = $('#friday_half_day_mark').val();
                        var friday_late_mark = $('#friday_late_mark').val();

                        if(friday_start_time || friday_lunch_start_time || friday_lunch_end_time || friday_half_day_mark || friday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                friday_lunch_start_time: {
                    required: function(element){
                        var friday_start_time = $('#friday_start_time').val();
                        var friday_end_time = $('#friday_end_time').val();
                        var friday_lunch_end_time = $('#friday_lunch_end_time').val();
                        var friday_half_day_mark = $('#friday_half_day_mark').val();
                        var friday_late_mark = $('#friday_late_mark').val();

                        if(friday_start_time || friday_end_time || friday_lunch_end_time || friday_half_day_mark || friday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                friday_lunch_end_time: {
                    required: function(element){
                        var friday_start_time = $('#friday_start_time').val();
                        var friday_end_time = $('#friday_end_time').val();
                        var friday_lunch_start_time  = $('#friday_lunch_start_time').val();
                        var friday_half_day_mark = $('#friday_half_day_mark').val();
                        var friday_late_mark = $('#friday_late_mark').val();

                        if(friday_start_time || friday_end_time || friday_lunch_start_time || friday_half_day_mark || friday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                friday_half_day_mark: {
                    required: function(element){
                        var friday_start_time = $('#friday_start_time').val();
                        var friday_end_time = $('#friday_end_time').val();
                        var friday_lunch_start_time  = $('#friday_lunch_start_time').val();
                        var friday_lunch_end_time = $('#friday_lunch_end_time').val();
                        var friday_late_mark = $('#friday_late_mark').val();

                        if(friday_start_time || friday_end_time || friday_lunch_start_time || friday_lunch_end_time || friday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                friday_late_mark: {
                    required: function(element){
                        var friday_start_time = $('#friday_start_time').val();
                        var friday_end_time = $('#friday_end_time').val();
                        var friday_lunch_start_time  = $('#friday_lunch_start_time').val();
                        var friday_lunch_end_time = $('#friday_lunch_end_time').val();
                        var friday_half_day_mark = $('#friday_half_day_mark').val();

                        if(friday_start_time || friday_end_time || friday_lunch_start_time || friday_lunch_end_time || friday_half_day_mark){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                saturday_start_time: {
                    required: function(element){
                        var saturday_end_time = $('#saturday_end_time').val();
                        var saturday_lunch_start_time = $('#saturday_lunch_start_time').val();
                        var saturday_lunch_end_time = $('#saturday_lunch_end_time').val();
                        var saturday_half_day_mark = $('#saturday_half_day_mark').val();
                        var saturday_late_mark = $('#saturday_late_mark').val();

                        if(saturday_end_time || saturday_lunch_start_time || saturday_lunch_end_time || saturday_half_day_mark || saturday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                saturday_end_time: {
                    required: function(element){
                        var saturday_start_time = $('#saturday_start_time').val();
                        var saturday_lunch_start_time = $('#saturday_lunch_start_time').val();
                        var saturday_lunch_end_time = $('#saturday_lunch_end_time').val();
                        var saturday_half_day_mark = $('#saturday_half_day_mark').val();
                        var saturday_late_mark = $('#saturday_late_mark').val();

                        if(saturday_start_time || saturday_lunch_start_time || saturday_lunch_end_time || saturday_half_day_mark || saturday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                saturday_lunch_start_time: {
                    required: function(element){
                        var saturday_start_time = $('#saturday_start_time').val();
                        var saturday_end_time = $('#saturday_end_time').val();
                        var saturday_lunch_end_time = $('#saturday_lunch_end_time').val();
                        var saturday_half_day_mark = $('#saturday_half_day_mark').val();
                        var saturday_late_mark = $('#saturday_late_mark').val();

                        if(saturday_start_time || saturday_end_time || saturday_lunch_end_time || saturday_half_day_mark || saturday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                saturday_lunch_end_time: {
                    required: function(element){
                        var saturday_start_time = $('#saturday_start_time').val();
                        var saturday_end_time = $('#saturday_end_time').val();
                        var saturday_lunch_start_time  = $('#saturday_lunch_start_time').val();
                        var saturday_half_day_mark = $('#saturday_half_day_mark').val();
                        var saturday_late_mark = $('#saturday_late_mark').val();

                        if(saturday_start_time || saturday_end_time || saturday_lunch_start_time || saturday_half_day_mark || saturday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                saturday_half_day_mark: {
                    required: function(element){
                        var saturday_start_time = $('#saturday_start_time').val();
                        var saturday_end_time = $('#saturday_end_time').val();
                        var saturday_lunch_start_time  = $('#saturday_lunch_start_time').val();
                        var saturday_lunch_end_time = $('#saturday_lunch_end_time').val();
                        var saturday_late_mark = $('#saturday_late_mark').val();

                        if(saturday_start_time || saturday_end_time || saturday_lunch_start_time || saturday_lunch_end_time || saturday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                saturday_late_mark: {
                    required: function(element){
                        var saturday_start_time = $('#saturday_start_time').val();
                        var saturday_end_time = $('#saturday_end_time').val();
                        var saturday_lunch_start_time  = $('#saturday_lunch_start_time').val();
                        var saturday_lunch_end_time = $('#saturday_lunch_end_time').val();
                        var saturday_half_day_mark = $('#saturday_half_day_mark').val();

                        if(saturday_start_time || saturday_end_time || saturday_lunch_start_time || saturday_lunch_end_time || saturday_half_day_mark){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                sunday_start_time: {
                    required: function(element){
                        var sunday_end_time = $('#sunday_end_time').val();
                        var sunday_lunch_start_time = $('#sunday_lunch_start_time').val();
                        var sunday_lunch_end_time = $('#sunday_lunch_end_time').val();
                        var sunday_half_day_mark = $('#sunday_half_day_mark').val();
                        var sunday_late_mark = $('#sunday_late_mark').val();

                        if(sunday_end_time || sunday_lunch_start_time || sunday_lunch_end_time || sunday_half_day_mark || sunday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                sunday_end_time: {
                    required: function(element){
                        var sunday_start_time = $('#sunday_start_time').val();
                        var sunday_lunch_start_time = $('#sunday_lunch_start_time').val();
                        var sunday_lunch_end_time = $('#sunday_lunch_end_time').val();
                        var sunday_half_day_mark = $('#sunday_half_day_mark').val();
                        var sunday_late_mark = $('#sunday_late_mark').val();

                        if(sunday_start_time || sunday_lunch_start_time || sunday_lunch_end_time || sunday_half_day_mark || sunday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                sunday_lunch_start_time: {
                    required: function(element){
                        var sunday_start_time = $('#sunday_start_time').val();
                        var sunday_end_time = $('#sunday_end_time').val();
                        var sunday_lunch_end_time = $('#sunday_lunch_end_time').val();
                        var sunday_half_day_mark = $('#sunday_half_day_mark').val();
                        var sunday_late_mark = $('#sunday_late_mark').val();

                        if(sunday_start_time || sunday_end_time || sunday_lunch_end_time || sunday_half_day_mark || sunday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                sunday_lunch_end_time: {
                    required: function(element){
                        var sunday_start_time = $('#sunday_start_time').val();
                        var sunday_end_time = $('#sunday_end_time').val();
                        var sunday_lunch_start_time  = $('#sunday_lunch_start_time').val();
                        var sunday_half_day_mark = $('#sunday_half_day_mark').val();
                        var sunday_late_mark = $('#sunday_late_mark').val();

                        if(sunday_start_time || sunday_end_time || sunday_lunch_start_time || sunday_half_day_mark || sunday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                sunday_half_day_mark: {
                    required: function(element){
                        var sunday_start_time = $('#sunday_start_time').val();
                        var sunday_end_time = $('#sunday_end_time').val();
                        var sunday_lunch_start_time  = $('#sunday_lunch_start_time').val();
                        var sunday_lunch_end_time = $('#sunday_lunch_end_time').val();
                        var sunday_late_mark = $('#sunday_late_mark').val();

                        if(sunday_start_time || sunday_end_time || sunday_lunch_start_time || sunday_lunch_end_time || sunday_late_mark > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                sunday_late_mark: {
                    required: function(element){
                        var sunday_start_time = $('#sunday_start_time').val();
                        var sunday_end_time = $('#sunday_end_time').val();
                        var sunday_lunch_start_time  = $('#sunday_lunch_start_time').val();
                        var sunday_lunch_end_time = $('#sunday_lunch_end_time').val();
                        var sunday_half_day_mark = $('#sunday_half_day_mark').val();

                        if(sunday_start_time || sunday_end_time || sunday_lunch_start_time || sunday_lunch_end_time || sunday_half_day_mark){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
            },
            messages: {
                start_date: {
                    required: 'Please choose the start date',
                },
                end_date: {
                    required: 'Please choose the end date',
                },
                monday_start_time: {
                    required: 'Please enter the start time',
                },
                monday_end_time: {
                    required: 'Please enter the end time',
                },
                monday_lunch_start_time: {
                    required: 'Please enter the lunch start time',
                },
                monday_lunch_end_time: {
                    required: 'Please enter the lunch end time',
                },
                monday_half_day_mark: {
                    required: 'Please enter the half day mark',
                },
                monday_late_mark: {
                    required: 'Please enter the late mark',
                },
                tuesday_start_time: {
                    required: 'Please enter the start time',
                },
                tuesday_end_time: {
                    required: 'Please enter the end time',
                },
                tuesday_lunch_start_time: {
                    required: 'Please enter the lunch start time',
                },
                tuesday_lunch_end_time: {
                    required: 'Please enter the lunch end time',
                },
                tuesday_half_day_mark: {
                    required: 'Please enter the half day mark',
                },
                tuesday_late_mark: {
                    required: 'Please enter the late mark',
                },
                wednesday_start_time: {
                    required: 'Please enter the start time',
                },
                wednesday_end_time: {
                    required: 'Please enter the end time',
                },
                wednesday_lunch_start_time: {
                    required: 'Please enter the lunch start time',
                },
                wednesday_lunch_end_time: {
                    required: 'Please enter the lunch end time',
                },
                wednesday_half_day_mark: {
                    required: 'Please enter the half day mark',
                },
                wednesday_late_mark: {
                    required: 'Please enter the late mark',
                },
                thursday_start_time: {
                    required: 'Please enter the start time',
                },
                thursday_end_time: {
                    required: 'Please enter the end time',
                },
                thursday_lunch_start_time: {
                    required: 'Please enter the lunch start time',
                },
                thursday_lunch_end_time: {
                    required: 'Please enter the lunch end time',
                },
                thursday_half_day_mark: {
                    required: 'Please enter the half day mark',
                },
                thursday_late_mark: {
                    required: 'Please enter the late mark',
                },
                friday_start_time: {
                    required: 'Please enter the start time',
                },
                friday_end_time: {
                    required: 'Please enter the end time',
                },
                friday_lunch_start_time: {
                    required: 'Please enter the lunch start time',
                },
                friday_lunch_end_time: {
                    required: 'Please enter the lunch end time',
                },
                friday_half_day_mark: {
                    required: 'Please enter the half day mark',
                },
                friday_late_mark: {
                    required: 'Please enter the late mark',
                },
                saturday_start_time: {
                    required: 'Please enter the start time',
                },
                saturday_end_time: {
                    required: 'Please enter the end time',
                },
                saturday_lunch_start_time: {
                    required: 'Please enter the lunch start time',
                },
                saturday_lunch_end_time: {
                    required: 'Please enter the lunch end time',
                },
                saturday_half_day_mark: {
                    required: 'Please enter the half day mark',
                },
                saturday_late_mark: {
                    required: 'Please enter the late mark',
                },
                sunday_start_time: {
                    required: 'Please enter the start time',
                },
                sunday_end_time: {
                    required: 'Please enter the end time',
                },
                sunday_lunch_start_time: {
                    required: 'Please enter the lunch start time',
                },
                sunday_lunch_end_time: {
                    required: 'Please enter the lunch end time',
                },
                sunday_half_day_mark: {
                    required: 'Please enter the half day mark',
                },
                sunday_late_mark: {
                    required: 'Please enter the late mark',
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
    }
    else if(form_type == 'assign work shift form'){
        $('#assign-work-shift-form').validate({
            submitHandler: function (form) {
                transaction = 'submit work shift assignment';
                var employee = $('#employee').val();

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&employee=' + employee,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Assigned'){
                            show_alert('Assign Work Shift Success', 'The work shift has been assigned.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#work-shift-datatable');
                        }
                        else if(response === 'Not Found'){
                            show_alert('Assign Work Shift Error', 'The work shift does not exist.', 'error');
                        }
                        else{
                            show_alert('Work Shift Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                employee: {
                    required: true
                }
            },
            messages: {
                employee: {
                    required: 'Please choose at least one (1) employee',
                }
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
    }
    else if(form_type == 'employee attendance form'){
        $('#employee-attendance-form').validate({
            submitHandler: function (form) {
                transaction = 'submit employee attendance';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Employee Attendance Success', 'The employee attendance has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Employee Attendance Success', 'The employee attendance has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#employee-attendance-datatable');
                            intialize_attendance_record_chart();
                        }
                        else if(response === 'Max Attendance'){
                            show_alert('Employee Attendance Error', 'There was a conflict with the inserted time in date.', 'error');
                        }
                        else if(response === 'Time In'){
                            show_alert('Employee Attendance Error', 'The time in cannot be greater than the time out.', 'error');
                        }
                        else if(response === 'Time Out'){
                            show_alert('Employee Attendance Error', 'The time out cannot be less than the time in.', 'error');
                        }
                        else{
                            show_alert('Employee Attendance Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                time_in_date: {
                    required: true
                },
                time_in: {
                    required: true
                }
            },
            messages: {
                time_in_date: {
                    required: 'Please choose the time in date',
                },
                time_in: {
                    required: 'Please choose the time in',
                }
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
    }
    else if(form_type == 'leave type form'){
        $('#leave-type-form').validate({
            submitHandler: function (form) {
                transaction = 'submit leave type';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Leave Type Success', 'The leave type has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Leave Type Success', 'The leave type has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#leave-type-datatable');
                        }
                        else{
                            show_alert('Leave Type Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                leave_name: {
                    required: true
                },
                paid_status: {
                    required: true
                },
                description: {
                    required: true
                }
            },
            messages: {
                leave_name: {
                    required: 'Please enter the leave',
                },
                paid_status: {
                    required: 'Please choose the paid status',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'leave entitlement form'){
        $('#leave-entitlement-form').validate({
            submitHandler: function (form) {
                transaction = 'submit leave entitlement';

                var employee = $('#employee').val();

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&employee=' + employee,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Inserted'){
                            show_alert('Insert Leave Entitlement Success', 'The leave entitlement has been inserted.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#leave-entitlement-datatable');
                        }
                        else{
                            show_alert('Leave Entitlement Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                employee: {
                    required: true
                },
                leave_type: {
                    required: true
                },
                no_leaves: {
                    required: true
                },
                start_date: {
                    required: true
                },
                end_date: {
                    required: true
                }
            },
            messages: {
                employee: {
                    required: 'Please choose at least one (1) employee',
                },
                leave_type: {
                    required: 'Please choose the leave type',
                },
                no_leaves: {
                    required: 'Please enter the entitlement',
                },
                start_date: {
                    required: 'Please choose the start date',
                },
                end_date: {
                    required: 'Please choose the end date',
                }
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
    }
    else if(form_type == 'update leave entitlement form'){
        $('#leave-entitlement-form').validate({
            submitHandler: function (form) {
                transaction = 'submit leave entitlement update';
                document.getElementById('employee_id').disabled = false;
                document.getElementById('leave_type').disabled = false;

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated'){
                            show_alert('Update Leave Entitlement Success', 'The leave entitlement has been updated.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#leave-entitlement-datatable');
                        }
                        else if(response == 'Overlap'){
                            show_alert('Leave Entitlement Error', 'The leave entitlement overlaps with an existing entitlement.', 'error');
                        }
                        else{
                            show_alert('Leave Entitlement Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                no_leaves: {
                    required: true
                },
                start_date: {
                    required: true
                },
                end_date: {
                    required: true
                }
            },
            messages: {
                no_leaves: {
                    required: 'Please enter the entitlement',
                },
                start_date: {
                    required: 'Please choose the start date',
                },
                end_date: {
                    required: 'Please choose the end date',
                }
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
    }
    else if(form_type == 'employee leave entitlement form'){
        $('#employee-leave-entitlement-form').validate({
            submitHandler: function (form) {
                transaction = 'submit employee leave entitlement';

                document.getElementById('leave_type').disabled = false;

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Employee Leave Entitlement Success', 'The employee leave entitlement has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Employee Leave Entitlement Success', 'The employee leave entitlement has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#employee-leave-entitlement-datatable');
                        }
                        else if(response == 'Overlap'){
                            show_alert('Employee Leave Entitlement Error', 'The employee leave entitlement overlaps with an existing entitlement.', 'error');
                        }
                        else{
                            show_alert('Employee Leave Entitlement Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                leave_type: {
                    required: true
                },
                no_leaves: {
                    required: true
                },
                start_date: {
                    required: true
                },
                end_date: {
                    required: true
                }
            },
            messages: {
                leave_type: {
                    required: 'Please choose the leave type',
                },
                no_leaves: {
                    required: 'Please enter the entitlement',
                },
                start_date: {
                    required: 'Please choose the start date',
                },
                end_date: {
                    required: 'Please choose the end date',
                }
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
    }
    else if(form_type == 'leave form'){
        $('#leave-form').validate({
            submitHandler: function (form) {
                transaction = 'submit leave';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Inserted'){
                            show_alert('Insert Leave Success', 'The employee leave has been inserted.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#leave-datatable');
                        }
                        else if(response === 'Leave Entitlement'){
                            show_alert('Insert Leave Error', 'The leave entitlement was consumed.', 'error');
                        }
                        else{
                            show_alert('Leave Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                employee: {
                    required: true
                },
                leave_type: {
                    required: true
                },
                leave_status: {
                    required: true
                },
                leave_duration: {
                    required: true
                },
                leave_date: {
                    required: true
                },
                start_time: {
                    required: true
                },
                end_time: {
                    required: true
                },
                reason: {
                    required: true
                }
            },
            messages: {
                employee: {
                    required: 'Please choose at least one (1) employee',
                },
                leave_type: {
                    required: 'Please choose the leave type',
                },
                leave_status: {
                    required: 'Please choose the status',
                },
                leave_duration: {
                    required: 'Please choose the duration',
                },
                leave_date: {
                    required: 'Please choose the leave date',
                },
                start_time: {
                    required: 'Please choose the start time',
                },
                end_time: {
                    required: 'Please choose the end time',
                },
                reason: {
                    required: 'Please enter the reason',
                }
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
    }
    else if(form_type == 'approve leave form' || form_type == 'approve employee leave form'){
        $('#approve-leave-form').validate({
            submitHandler: function (form) {
                transaction = 'approve leave';
                var leave_id = $('#leave_id').val();
                var decision_remarks = $('#decision_remarks').val();

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Approved'){
                            show_alert('Leave Approval Success', 'The leave has been approved.', 'success');

                            $('#System-Modal').modal('hide');

                            if($('#leave-datatable').length){
                                reload_datatable('#leave-datatable');
                            }

                            if($('#employee-leave-datatable').length){
                                reload_datatable('#employee-leave-datatable');
                            }

                            if($('#leave-approval-datatable').length){
                                reload_datatable('#leave-approval-datatable');
                            }
                        }
                        else if(response === 'Not Found'){
                            show_alert('Leave Approval Error', 'The leave does not exist.', 'info');
                        }
                        else if(response === 'Overlap'){
                            Swal.fire({
                                title: 'Leave Overlap',
                                text: 'This leave being applied overlaps with an existing approved leave. Do you want to continue approving this leave?',
                                icon: 'warning',
                                showCancelButton: !0,
                                confirmButtonText: 'Continue',
                                cancelButtonText: 'Close',
                                confirmButtonClass: 'btn btn-warning mt-2',
                                cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
                                buttonsStyling: !1
                            }).then(function(result) {
                                if (result.value) {
                                    transaction = 'approve overlap leave';

                                    $.ajax({
                                        type: 'POST',
                                        url: 'controller.php',
                                        data: {username : username, leave_id : leave_id, decision_remarks : decision_remarks, transaction : transaction},
                                        success: function (response) {
                                            if(response === 'Approved'){
                                                show_alert('Leave Approval Success', 'The leave has been approved.', 'success');
                    
                                                $('#System-Modal').modal('hide');
                                                reload_datatable('#leave-datatable');
                                            }
                                            else{
                                                show_alert('Leave Approval Error', response, 'error');
                                            }
                                        }
                                    });
                                    return false;
                                }
                                else{
                                    $('#System-Modal').modal('hide');

                                    show_alert('Leave Overlap', 'Please fix the overlap.', 'info');
                                }
                            });
                        }
                        else{
                            show_alert('Leave Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
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
    }
    else if(form_type == 'reject leave form' || form_type == 'reject employee leave form'){
        $('#reject-leave-form').validate({
            submitHandler: function (form) {
                transaction = 'reject leave';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Rejected'){
                            show_alert('Leave Rejection Success', 'The leave has been rejected.', 'success');

                            $('#System-Modal').modal('hide');

                            if($('#leave-datatable').length){
                                reload_datatable('#leave-datatable');
                            }

                            if($('#employee-leave-datatable').length){
                                reload_datatable('#employee-leave-datatable');
                            }

                            if($('#leave-approval-datatable').length){
                                reload_datatable('#leave-approval-datatable');
                            }
                        }
                        else if(response === 'Not Found'){
                            show_alert('Leave Rejection Error', 'The leave does not exist.', 'info');
                        }
                        else{
                            show_alert('Leave Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                decision_remarks: {
                    required: true
                },
            },
            messages: {
                decision_remarks: {
                    required: 'Please enter the rejection remarks',
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
    }
    else if(form_type == 'cancel leave form' || form_type == 'cancel employee leave form'){
        $('#cancel-leave-form').validate({
            submitHandler: function (form) {
                transaction = 'cancel leave';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Cancelled'){
                            show_alert('Leave Cancellation Success', 'The leave has been cancelled.', 'success');

                            $('#System-Modal').modal('hide');
                            
                            if($('#leave-datatable').length){
                                reload_datatable('#leave-datatable');
                            }

                            if($('#employee-leave-datatable').length){
                                reload_datatable('#employee-leave-datatable');
                            }

                            if($('#leave-approval-datatable').length){
                                reload_datatable('#leave-approval-datatable');
                            }
                        }
                        else if(response === 'Not Found'){
                            show_alert('Leave Cancellation Error', 'The leave does not exist.', 'info');
                        }
                        else{
                            show_alert('Leave Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                decision_remarks: {
                    required: true
                },
            },
            messages: {
                decision_remarks: {
                    required: 'Please enter the cancellation remarks',
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
    }
    else if(form_type == 'approve multiple leave form'){
        $('#approve-multiple-leave-form').validate({
            submitHandler: function (form) {
                transaction = 'approve multiple leave';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Approved'){
                            show_alert('Leave Approval Success', 'The leave has been approved.', 'success');

                            $('#System-Modal').modal('hide');
                        }
                        else{
                            show_alert('Leave Error', response, 'error');
                        }

                        if($('#leave-datatable').length){
                            reload_datatable('#leave-datatable');
                        }

                        if($('#leave-approval-datatable').length){
                            reload_datatable('#leave-approval-datatable');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
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
    }
    else if(form_type == 'reject multiple leave form'){
        $('#reject-multiple-leave-form').validate({
            submitHandler: function (form) {
                transaction = 'reject multiple leave';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Rejected'){
                            show_alert('Leave Rejection Success', 'The leave has been rejected.', 'success');

                            $('#System-Modal').modal('hide');
                        }
                        else{
                            show_alert('Leave Error', response, 'error');
                        }

                        if($('#leave-datatable').length){
                            reload_datatable('#leave-datatable');
                        }

                        if($('#leave-approval-datatable').length){
                            reload_datatable('#leave-approval-datatable');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                decision_remarks: {
                    required: true
                },
            },
            messages: {
                decision_remarks: {
                    required: 'Please enter the rejection remarks',
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
    }
    else if(form_type == 'cancel multiple leave form'){
        $('#cancel-multiple-leave-form').validate({
            submitHandler: function (form) {
                transaction = 'cancel multiple leave';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Cancelled'){
                            show_alert('Leave Cancellation Success', 'The leave has been cancelled.', 'success');

                            $('#System-Modal').modal('hide');
                        }
                        else{
                            show_alert('Leave Error', response, 'error');
                        }

                        if($('#leave-datatable').length){
                            reload_datatable('#leave-datatable');
                        }

                        if($('#employee-leave-datatable').length){
                            reload_datatable('#employee-leave-datatable');
                        }

                        if($('#leave-approval-datatable').length){
                            reload_datatable('#leave-approval-datatable');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                decision_remarks: {
                    required: true
                },
            },
            messages: {
                decision_remarks: {
                    required: 'Please enter the cancellation remarks',
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
    }
    else if(form_type == 'employee leave form'){
        $('#employee-leave-form').validate({
            submitHandler: function (form) {
                transaction = 'submit leave';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Inserted'){
                            show_alert('Insert Leave Success', 'The employee leave has been inserted.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#employee-leave-datatable');
                        }
                        else if(response === 'Leave Entitlement'){
                            show_alert('Insert Leave Error', 'The leave entitlement was consumed.', 'error');
                        }
                        else{
                            show_alert('Leave Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                leave_type: {
                    required: true
                },
                leave_status: {
                    required: true
                },
                leave_duration: {
                    required: true
                },
                leave_date: {
                    required: true
                },
                start_time: {
                    required: true
                },
                end_time: {
                    required: true
                },
                reason: {
                    required: true
                }
            },
            messages: {
                leave_type: {
                    required: 'Please choose the leave type',
                },
                leave_status: {
                    required: 'Please choose the status',
                },
                leave_duration: {
                    required: 'Please choose the duration',
                },
                leave_date: {
                    required: 'Please choose the leave date',
                },
                start_time: {
                    required: 'Please choose the start time',
                },
                end_time: {
                    required: 'Please choose the end time',
                },
                reason: {
                    required: 'Please enter the reason',
                }
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
    }
    else if(form_type == 'employee file management form'){
        $('#employee-file-management-form').validate({
            submitHandler: function (form) {
                var transaction = 'submit employee file management';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Employee File Success', 'The employee file has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Employee File Success', 'The employee file has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#employee-file-datatable');
                        }
                        else if(response === 'File Size'){
                            show_alert('Employee File Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Employee File Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Employee File Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                employee_id: {
                    required: true
                },
                file_name: {
                    required: true
                },
                file_category: {
                    required: true
                },
                file_date: {
                    required: true
                },
                file: {
                    required: function(element){
                        var update = $('#update').val();

                        if(update == '0'){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                remarks: {
                    required: true
                }
            },
            messages: {
                employee_id: {
                    required: 'Please choose the employee',
                },
                file_name: {
                    required: 'Please enter the file name',
                },
                file_category: {
                    required: 'Please choose the file category',
                },
                file_date: {
                    required: 'Please choose the file date',
                },
                file: {
                    required: 'Please choose the file',
                },
                remarks: {
                    required: 'Please enter the remarks',
                }
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
    }
    else if(form_type == 'employee file form'){
        $('#employee-file-form').validate({
            submitHandler: function (form) {
                var transaction = 'submit employee file management';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Employee File Success', 'The employee file has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Employee File Success', 'The employee file has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#employee-file-datatable');
                        }
                        else if(response === 'File Size'){
                            show_alert('Employee File Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Employee File Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Employee File Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                employee_id: {
                    required: true
                },
                file_name: {
                    required: true
                },
                file_category: {
                    required: true
                },
                file_date: {
                    required: true
                },
                file: {
                    required: function(element){
                        var update = $('#update').val();

                        if(update == '0'){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                remarks: {
                    required: true
                }
            },
            messages: {
                employee_id: {
                    required: 'Please choose the employee',
                },
                file_name: {
                    required: 'Please enter the file name',
                },
                file_category: {
                    required: 'Please choose the file category',
                },
                file_date: {
                    required: 'Please choose the file date',
                },
                file: {
                    required: 'Please choose the file',
                },
                remarks: {
                    required: 'Please enter the remarks',
                }
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
    }
    else if(form_type == 'user account form'){
        $('#user-account-form').validate({
            submitHandler: function (form) {
                transaction = 'submit user account';
                var role = $('#role').val();

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&role=' + role,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Inserted'){
                            show_alert('Insert User Account Success', 'The user account has been inserted.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#user-account-datatable');
                        }
                        else{
                            show_alert('User Account Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                user_code: {
                    required: true
                },
                password: {
                    required: true,
                    password_strength : true
                },
                role: {
                    required: true
                }
            },
            messages: {
                user_code: {
                    required: 'Please enter the username',
                },
                password: {
                    required: 'Please enter the password',
                },
                role: {
                    required: 'Please choose at least one (1) role',
                }
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
    }
    else if(form_type == 'user account update form'){
        $('#user-account-update-form').validate({
            submitHandler: function (form) {
                transaction = 'submit user account update';
                var role = $('#role').val();

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&role=' + role,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated'){
                            show_alert('Update User Account Success', 'The user account has been updated.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#user-account-datatable');
                        }
                        else if(response === 'Not Found'){
                            show_alert('User Account', 'The user account does not exist.', 'info');
                        }
                        else{
                            show_alert('User Account Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                role: {
                    required: true
                }
            },
            messages: {
                role: {
                    required: 'Please choose at least one (1) role',
                }
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
    }
    else if(form_type == 'holiday form'){
        $('#holiday-form').validate({
            submitHandler: function (form) {
                transaction = 'submit holiday';
                var branch = $('#branch').val();

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&branch=' + branch,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Holiday Success', 'The holiday has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Holiday Success', 'The holiday has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#holiday-datatable');
                        }
                        else{
                            show_alert('Holiday Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                holiday: {
                    required: true
                },
                holiday_type: {
                    required: true
                },
                holiday_date: {
                    required: true
                },
                branch: {
                    required: true
                },
            },
            messages: {
                holiday: {
                    required: 'Please enter the holiday',
                },
                holiday_type: {
                    required: 'Please choose the holiday type',
                },
                holiday_date: {
                    required: 'Please choose the holiday date',
                },
                branch: {
                    required: 'Please choose at least one (1) branch',
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
    }
    else if(form_type == 'time in form'){
        $('#time-in-form').validate({
            submitHandler: function (form) {
                transaction = 'submit time in';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Recorded'){
                            show_alert_event('Time In Success', 'Your time in has been recorded.', 'success', 'reload');

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'Max Attendance'){
                            show_alert_event('Time In Error', 'Your have reached the maximum clock-in for the day.', 'error', 'reload');
                        }
                        else if(response === 'Location'){
                            show_alert_event('Time In Error', 'Your location cannot be determined.', 'error', 'reload');
                        }
                        else{
                            show_alert('Time In Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
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
    }
    else if(form_type == 'time out form'){
        $('#time-out-form').validate({
            submitHandler: function (form) {
                transaction = 'submit time out';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Recorded'){
                            show_alert_event('Time Out Success', 'Your time in has been recorded.', 'success', 'reload');

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'Location'){
                            show_alert_event('Time Out Error', 'Your location cannot be determined.', 'error', 'reload');
                        }
                        else{
                            show_alert('Time Out Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
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
    }
    else if(form_type == 'attendance record form'){
        $('#attendance-record-form').validate({
            submitHandler: function (form) {
                document.getElementById('employee_id').disabled = false;
                transaction = 'submit employee attendance';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Employee Attendance Success', 'The employee attendance has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Employee Attendance Success', 'The employee attendance has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#attendance-record-datatable');
                        }
                        else if(response === 'Max Attendance'){
                            show_alert('Employee Attendance Error', 'There was a conflict with the inserted time in date.', 'error');
                        }
                        else if(response === 'Time In'){
                            show_alert('Employee Attendance Error', 'The time in cannot be greater than the time out.', 'error');
                        }
                        else if(response === 'Time Out'){
                            show_alert('Employee Attendance Error', 'The time out cannot be less than the time in.', 'error');
                        }
                        else{
                            show_alert('Employee Attendance Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                employee_id: {
                    required: true
                },
                time_in_date: {
                    required: true
                },
                time_in: {
                    required: true
                }
            },
            messages: {
                employee_id: {
                    required: 'Please choose the employee',
                },
                time_in_date: {
                    required: 'Please choose the time in date',
                },
                time_in: {
                    required: 'Please choose the time in',
                }
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
    }
    else if(form_type == 'health declaration form'){
        $('#health-declaration-form').validate({
            submitHandler: function (form) {
                document.getElementById('specific').disabled = false;
                transaction = 'submit health declaration';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Inserted'){
                            show_alert_event('Insert Health Declaration Success', 'The health declaration has been inserted.', 'success', 'reload');

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'Existed'){
                            show_alert_event('Health Declaration Error', 'You already submitted your health declaration today.', 'error', 'reload');
                        }
                        else{
                            show_alert('Health Declaration Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                temperature: {
                    required: true
                },
                specific: {
                    required: function(element){
                        var question_5 = $('#question_5').val();

                        if(question_5 == '1'){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
            },
            messages: {
                temperature: {
                    required: 'Please enter the temperature',
                },
                specific: {
                    required: 'Please enter the specific place',
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
    }
    else if(form_type == 'get location form'){
        $('#get-location-form').validate({
            submitHandler: function (form) {
                transaction = 'submit location';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Inserted'){
                            show_alert('Insert Location Success', 'The location has been inserted.', 'success');

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'Location'){
                            show_alert_event('Location Error', 'You location cannot be determined.', 'error', 'reload');
                        }
                        else{
                            show_alert('Location Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
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
    }
    else if(form_type == 'send test email form'){
        $('#send-test-email-form').validate({
            submitHandler: function (form) {
                transaction = 'send test email';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Sent'){
                            show_alert_event('Test Email Success', 'The test email has been sent.', 'success', 'reload');

                            $('#System-Modal').modal('hide');
                        }
                        else{
                            show_alert('Test Email Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                email: {
                    required: true
                },
            },
            messages: {
                email: {
                    required: 'Please enter the email',
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
    }
    else if(form_type == 'attendance creation form'){
        $('#attendance-creation-form').validate({
            submitHandler: function (form) {
                var transaction = 'submit attendance creation';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Attendance Creation', 'The attendance creation has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Attendance Creation', 'The attendance creation has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');

                            if($('#attendance-creation-datatable').length){
                                reload_datatable('#attendance-creation-datatable');
                            }
                        }
                        else if(response === 'Time In'){
                            show_alert('Attendance Creation Error', 'The time in cannot be greater than the time out.', 'error');
                        }
                        else if(response === 'Time Out'){
                            show_alert('Attendance Creation Error', 'The time out cannot be less than the time in.', 'error');
                        }
                        else if(response === 'File Size'){
                            show_alert('Attendance Creation Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Attendance Creation Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Attendance Creation Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                time_in_date: {
                    required: true
                },
                time_in: {
                    required: true
                },
                file: {
                    required: function(element){
                        var update = $('#update').val();

                        if(update == '0'){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                time_out_date: {
                    required: function(element){
                        var time_out = $('#time_out').val();

                        if(time_out != ''){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                time_out: {
                    required: function(element){
                        var time_out_date = $('#time_out_date').val();

                        if(time_out_date != ''){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                reason: {
                    required: true
                }
            },
            messages: {
                time_in_date: {
                    required: 'Please choose the time in date',
                },
                time_in: {
                    required: 'Please choose the time in',
                },
                time_out_date: {
                    required: 'Please choose the time out date',
                },
                time_out: {
                    required: 'Please choose the time out',
                },
                file: {
                    required: 'Please choose the file',
                },
                reason: {
                    required: 'Please enter the reason',
                }
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
    }
    else if(form_type == 'attendance adjustment full form'){
        $('#attendance-adjustment-full-form').validate({
            submitHandler: function (form) {
                var transaction = 'submit attendance adjustment';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Attendance Adjustment', 'The attendance adjustment has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Attendance Adjustment', 'The attendance adjustment has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'Time In'){
                            show_alert('Attendance Adjustment Error', 'The time in cannot be greater than the time out.', 'error');
                        }
                        else if(response === 'Time Out'){
                            show_alert('Attendance Adjustment Error', 'The time out cannot be less than the time in.', 'error');
                        }
                        else if(response === 'File Size'){
                            show_alert('Attendance Adjustment Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Attendance Adjustment Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Attendance Adjustment Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                time_in_date: {
                    required: true
                },
                time_in: {
                    required: true
                },
                time_out_date: {
                    required: true
                },
                time_out: {
                    required: true
                },
                file: {
                    required: true
                },
                reason: {
                    required: true
                }
            },
            messages: {
                time_in_date: {
                    required: 'Please choose the time in date',
                },
                time_in: {
                    required: 'Please choose the time in',
                },
                time_out_date: {
                    required: 'Please choose the time out date',
                },
                time_out: {
                    required: 'Please choose the time out',
                },
                file: {
                    required: 'Please choose the file',
                },
                reason: {
                    required: 'Please enter the reason',
                }
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
    }
    else if(form_type == 'attendance adjustment partial form'){
        $('#attendance-adjustment-partial-form').validate({
            submitHandler: function (form) {
                var transaction = 'submit attendance adjustment';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Attendance Adjustment', 'The attendance adjustment has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Attendance Adjustment', 'The attendance adjustment has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'Time In'){
                            show_alert('Attendance Adjustment Error', 'The time in cannot be greater than the time out.', 'error');
                        }
                        else if(response === 'Time Out'){
                            show_alert('Attendance Adjustment Error', 'The time out cannot be less than the time in.', 'error');
                        }
                        else if(response === 'File Size'){
                            show_alert('Attendance Adjustment Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Attendance Adjustment Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Attendance Adjustment Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                time_in_date: {
                    required: true
                },
                time_in: {
                    required: true
                },
                file: {
                    required: true
                },
                reason: {
                    required: true
                }
            },
            messages: {
                time_in_date: {
                    required: 'Please choose the time in date',
                },
                time_in: {
                    required: 'Please choose the time in',
                },
                file: {
                    required: 'Please choose the file',
                },
                reason: {
                    required: 'Please enter the reason',
                }
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
    }
    else if(form_type == 'cancel attendance creation form'){
        $('#cancel-attendance-creation-form').validate({
            submitHandler: function (form) {
                transaction = 'cancel attendance creation';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Cancelled'){
                            show_alert('Attendance Creation Cancellation Success', 'The attendance creation has been cancelled.', 'success');

                            $('#System-Modal').modal('hide');
                            
                            if($('#attendance-adjustment-datatable').length){
                                reload_datatable('#attendance-creation-datatable');
                            }
    
                            if($('#attendance-creation-recommendation-datatable').length){
                                reload_datatable('#attendance-creation-recommendation-datatable');
                            }

                            if($('#attendance-creation-approval-datatable').length){
                                reload_datatable('#attendance-creation-approval-datatable');
                            }
                        }
                        else if(response === 'Not Found'){
                            show_alert('Attendance Creation Cancellation Error', 'The attendance creation does not exist.', 'info');
                        }
                        else{
                            show_alert('Attendance Creation Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                decision_remarks: {
                    required: true
                },
            },
            messages: {
                decision_remarks: {
                    required: 'Please enter the cancellation remarks',
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
    }
    else if(form_type == 'cancel multiple attendance creation form'){
        $('#cancel-multiple-creation-form').validate({
            submitHandler: function (form) {
                transaction = 'cancel multiple attendance creation';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Cancelled'){
                            show_alert('Multiple Attendance Creation Cancellation Success', 'The multiple attendance creation has been cancelled.', 'success');
                        }
                        else{
                            show_alert('Multiple Attendance Creation Error', response, 'error');
                        }

                        $('#System-Modal').modal('hide');

                        if($('#attendance-adjustment-datatable').length){
                            reload_datatable('#attendance-creation-datatable');
                        }

                        if($('#attendance-creation-recommendation-datatable').length){
                            reload_datatable('#attendance-creation-recommendation-datatable');
                        }

                        if($('#attendance-creation-approval-datatable').length){
                            reload_datatable('#attendance-creation-approval-datatable');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                decision_remarks: {
                    required: true
                },
            },
            messages: {
                decision_remarks: {
                    required: 'Please enter the cancellation remarks',
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
    }
    else if(form_type == 'reject attendance creation form'){
        $('#reject-attendance-creation-form').validate({
            submitHandler: function (form) {
                transaction = 'reject attendance creation';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Rejected'){
                            show_alert('Attendance Creation Rejection Success', 'The attendance creation has been rejected.', 'success');

                            $('#System-Modal').modal('hide');
                            
                            if($('#attendance-adjustment-datatable').length){
                                reload_datatable('#attendance-creation-datatable');
                            }
    
                            if($('#attendance-creation-recommendation-datatable').length){
                                reload_datatable('#attendance-creation-recommendation-datatable');
                            }

                            if($('#attendance-creation-approval-datatable').length){
                                reload_datatable('#attendance-creation-approval-datatable');
                            }
                        }
                        else if(response === 'Not Found'){
                            show_alert('Attendance Creation Rejection Error', 'The attendance creation does not exist.', 'info');
                        }
                        else{
                            show_alert('Attendance Creation Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                decision_remarks: {
                    required: true
                },
            },
            messages: {
                decision_remarks: {
                    required: 'Please enter the rejection remarks',
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
    }
    else if(form_type == 'reject multiple attendance creation form'){
        $('#reject-multiple-creation-form').validate({
            submitHandler: function (form) {
                transaction = 'reject multiple attendance creation';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Rejected'){
                            show_alert('Multiple Attendance Creation Rejection Success', 'The multiple attendance creation has been rejected.', 'success');
                        }
                        else{
                            show_alert('Multiple Attendance Creation Error', response, 'error');
                        }

                        $('#System-Modal').modal('hide');

                        if($('#attendance-adjustment-datatable').length){
                            reload_datatable('#attendance-creation-datatable');
                        }

                        if($('#attendance-creation-recommendation-datatable').length){
                            reload_datatable('#attendance-creation-recommendation-datatable');
                        }

                        if($('#attendance-creation-approval-datatable').length){
                            reload_datatable('#attendance-creation-approval-datatable');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                decision_remarks: {
                    required: true
                },
            },
            messages: {
                decision_remarks: {
                    required: 'Please enter the rejection remarks',
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
    }
    else if(form_type == 'approve attendance creation form'){
        $('#approve-attendance-creation-form').validate({
            submitHandler: function (form) {
                transaction = 'approve attendance creation';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Approved'){
                            show_alert('Attendance Creation Approval Success', 'The attendance creation has been approved.', 'success');

                            $('#System-Modal').modal('hide');
                            
                            if($('#attendance-adjustment-datatable').length){
                                reload_datatable('#attendance-creation-datatable');
                            }
    
                            if($('#attendance-creation-recommendation-datatable').length){
                                reload_datatable('#attendance-creation-recommendation-datatable');
                            }

                            if($('#attendance-creation-approval-datatable').length){
                                reload_datatable('#attendance-creation-approval-datatable');
                            }
                        }
                        else if(response === 'Not Found'){
                            show_alert('Attendance Creation Approval Error', 'The attendance creation does not exist.', 'info');
                        }
                        else if(response === 'Max Attendance'){
                            show_alert('Attendance Creation Approval Error', 'There was a conflict with the inserted time in date.', 'error');
                        }
                        else{
                            show_alert('Attendance Creation Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                sanction: {
                    required: true
                },
            },
            messages: {
                sanction: {
                    required: 'Please choose the sanction',
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
    }
    else if(form_type == 'approve multiple attendance creation form'){
        $('#approve-multiple-creation-form').validate({
            submitHandler: function (form) {
                transaction = 'approve multiple attendance creation';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Approved'){
                            show_alert('Multiple Attendance Creation Approval Success', 'The multiple attendance creation has been approved.', 'success');
                        }
                        else{
                            show_alert('Multiple Attendance Creation Error', response, 'error');
                        }

                        $('#System-Modal').modal('hide');

                        if($('#attendance-adjustment-datatable').length){
                            reload_datatable('#attendance-creation-datatable');
                        }

                        if($('#attendance-creation-recommendation-datatable').length){
                            reload_datatable('#attendance-creation-recommendation-datatable');
                        }

                        if($('#attendance-creation-approval-datatable').length){
                            reload_datatable('#attendance-creation-approval-datatable');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                sanction: {
                    required: true
                },
            },
            messages: {
                sanction: {
                    required: 'Please choose the sanction',
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
    }
    else if(form_type == 'attendance adjustment full update form'){
        $('#attendance-adjustment-full-update-form').validate({
            submitHandler: function (form) {
                var transaction = 'submit attendance adjustment update';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            show_alert('Update Attendance Adjustment', 'The attendance adjustment has been updated.', 'success');

                            $('#System-Modal').modal('hide');

                            reload_datatable('#attendance-adjustment-datatable');
                        }
                        else if(response === 'Not Found'){
                            show_alert('Attendance Adjustment Error', 'The attendance adjustment does not exist.', 'error');
                        }
                        else if(response === 'Time In'){
                            show_alert('Attendance Adjustment Error', 'The time in cannot be greater than the time out.', 'error');
                        }
                        else if(response === 'Time Out'){
                            show_alert('Attendance Adjustment Error', 'The time out cannot be less than the time in.', 'error');
                        }
                        else if(response === 'File Size'){
                            show_alert('Attendance Adjustment Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Attendance Adjustment Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Attendance Adjustment Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                time_in_date: {
                    required: true
                },
                time_in: {
                    required: true
                },
                time_out_date: {
                    required: true
                },
                time_out: {
                    required: true
                },
                reason: {
                    required: true
                }
            },
            messages: {
                time_in_date: {
                    required: 'Please choose the time in date',
                },
                time_in: {
                    required: 'Please choose the time in',
                },
                time_out_date: {
                    required: 'Please choose the time out date',
                },
                time_out: {
                    required: 'Please choose the time out',
                },
                reason: {
                    required: 'Please enter the reason',
                }
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
    }
    else if(form_type == 'attendance adjustment partial update form'){
        $('#attendance-adjustment-partial-update-form').validate({
            submitHandler: function (form) {
                var transaction = 'submit attendance adjustment update';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated'){
                            show_alert('Update Attendance Adjustment', 'The attendance adjustment has been updated.', 'success');

                            $('#System-Modal').modal('hide');

                            reload_datatable('#attendance-adjustment-datatable');
                        }
                        else if(response === 'Not Found'){
                            show_alert('Attendance Adjustment Error', 'The attendance adjustment does not exist.', 'error');
                        }
                        else if(response === 'Time In'){
                            show_alert('Attendance Adjustment Error', 'The time in cannot be greater than the time out.', 'error');
                        }
                        else if(response === 'Time Out'){
                            show_alert('Attendance Adjustment Error', 'The time out cannot be less than the time in.', 'error');
                        }
                        else if(response === 'File Size'){
                            show_alert('Attendance Adjustment Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Attendance Adjustment Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Attendance Adjustment Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                time_in_date: {
                    required: true
                },
                time_in: {
                    required: true
                },
                reason: {
                    required: true
                }
            },
            messages: {
                time_in_date: {
                    required: 'Please choose the time in date',
                },
                time_in: {
                    required: 'Please choose the time in',
                },
                reason: {
                    required: 'Please enter the reason',
                }
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
    }
    else if(form_type == 'cancel attendance adjustment form'){
        $('#cancel-attendance-adjustment-form').validate({
            submitHandler: function (form) {
                transaction = 'cancel attendance adjustment';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Cancelled'){
                            show_alert('Attendance Adjustment Cancellation Success', 'The attendance adjustment has been cancelled.', 'success');

                            $('#System-Modal').modal('hide');

                            if($('#attendance-adjustment-datatable').length){
                                reload_datatable('#attendance-adjustment-datatable');
                            }

                            if($('#attendance-adjustment-datatable').length){
                                reload_datatable('#attendance-adjustment-recommendation-datatable');
                            }

                            if($('#attendance-adjustment-approval-datatable').length){
                                reload_datatable('#attendance-adjustment-approval-datatable');
                            }
                        }
                        else if(response === 'Not Found'){
                            show_alert('Attendance Adjustment Cancellation Error', 'The attendance adjustment does not exist.', 'info');
                        }
                        else{
                            show_alert('Attendance Adjustment Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                decision_remarks: {
                    required: true
                },
            },
            messages: {
                decision_remarks: {
                    required: 'Please enter the cancellation remarks',
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
    }
    else if(form_type == 'cancel multiple attendance adjustment form'){
        $('#cancel-multiple-adjustment-form').validate({
            submitHandler: function (form) {
                transaction = 'cancel multiple attendance adjustment';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Cancelled'){
                            show_alert('Multiple Attendance Adjustment Cancellation Success', 'The multiple attendance adjustment has been cancelled.', 'success');
                        }
                        else{
                            show_alert('Multiple Attendance Adjustment Error', response, 'error');
                        }

                        $('#System-Modal').modal('hide');
                            
                        if($('#attendance-adjustment-datatable').length){
                            reload_datatable('#attendance-adjustment-datatable');
                        }

                        if($('#attendance-adjustment-recommendation-datatable').length){
                            reload_datatable('#attendance-adjustment-recommendation-datatable');
                        }

                        if($('#attendance-adjustment-approval-datatable').length){
                            reload_datatable('#attendance-adjustment-approval-datatable');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                decision_remarks: {
                    required: true
                },
            },
            messages: {
                decision_remarks: {
                    required: 'Please enter the cancellation remarks',
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
    }
    else if(form_type == 'reject attendance adjustment form'){
        $('#reject-attendance-adjustment-form').validate({
            submitHandler: function (form) {
                transaction = 'reject attendance adjustment';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Rejected'){
                            show_alert('Attendance Adjustment Rejection Success', 'The attendance adjustment has been rejected.', 'success');

                            $('#System-Modal').modal('hide');

                            if($('#attendance-adjustment-datatable').length){
                                reload_datatable('#attendance-adjustment-datatable');
                            }

                            if($('#attendance-adjustment-recommendation-datatable').length){
                                reload_datatable('#attendance-adjustment-recommendation-datatable');
                            }

                            if($('#attendance-adjustment-approval-datatable').length){
                                reload_datatable('#attendance-adjustment-approval-datatable');
                            }
                        }
                        else if(response === 'Not Found'){
                            show_alert('Attendance Adjustment Rejection Error', 'The attendance adjustment does not exist.', 'info');
                        }
                        else{
                            show_alert('Attendance Adjustment Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                decision_remarks: {
                    required: true
                },
            },
            messages: {
                decision_remarks: {
                    required: 'Please enter the rejection remarks',
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
    }
    else if(form_type == 'reject multiple attendance adjustment form'){
        $('#reject-multiple-adjustment-form').validate({
            submitHandler: function (form) {
                transaction = 'reject multiple attendance adjustment';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Rejected'){
                            show_alert('Multiple Attendance Adjustment Rejection Success', 'The multiple attendance adjustment has been rejected.', 'success');
                        }
                        else{
                            show_alert('Multiple Attendance Adjustment Error', response, 'error');
                        }

                        $('#System-Modal').modal('hide');
                            
                        if($('#attendance-adjustment-datatable').length){
                            reload_datatable('#attendance-adjustment-datatable');
                        }

                        if($('#attendance-adjustment-recommendation-datatable').length){
                            reload_datatable('#attendance-adjustment-recommendation-datatable');
                        }

                        if($('#attendance-adjustment-approval-datatable').length){
                            reload_datatable('#attendance-adjustment-approval-datatable');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                decision_remarks: {
                    required: true
                },
            },
            messages: {
                decision_remarks: {
                    required: 'Please enter the rejection remarks',
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
    }
    else if(form_type == 'approve attendance adjustment form'){
        $('#approve-attendance-adjustment-form').validate({
            submitHandler: function (form) {
                transaction = 'approve attendance adjustment';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Approved'){
                            show_alert('Attendance Adjustment Approval Success', 'The attendance adjustment has been approved.', 'success');

                            $('#System-Modal').modal('hide');
                            
                            if($('#attendance-adjustment-datatable').length){
                                reload_datatable('#attendance-adjustment-datatable');
                            }
    
                            if($('#attendance-adjustment-recommendation-datatable').length){
                                reload_datatable('#attendance-adjustment-recommendation-datatable');
                            }

                            if($('#attendance-adjustment-approval-datatable').length){
                                reload_datatable('#attendance-adjustment-approval-datatable');
                            }
                        }
                        else if(response === 'Attendance Record Not Found'){
                            show_alert('Attendance Adjustment Approval Error', 'The attendance record does not exist.', 'info');
                        }
                        else if(response === 'Not Found'){
                            show_alert('Attendance Adjustment Approval Error', 'The attendance adjustment does not exist.', 'info');
                        }
                        else if(response === 'Max Attendance'){
                            show_alert('Attendance Adjustment Approval Error', 'There was a conflict with the inserted time in date.', 'error');
                        }
                        else{
                            show_alert('Attendance Adjustment Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                sanction: {
                    required: true
                },
            },
            messages: {
                sanction: {
                    required: 'Please choose the sanction',
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
    }
    else if(form_type == 'approve multiple attendance adjustment form'){
        $('#approve-multiple-adjustment-form').validate({
            submitHandler: function (form) {
                transaction = 'approve multiple attendance adjustment';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Approved'){
                            show_alert('Multiple Attendance Adjustment Approval Success', 'The multiple attendance adjustment has been approved.', 'success');
                        }
                        else{
                            show_alert('Multiple Attendance Adjustment Error', response, 'error');
                        }

                        $('#System-Modal').modal('hide');

                        if($('#attendance-adjustment-datatable').length){
                            reload_datatable('#attendance-adjustment-datatable');
                        }

                        if($('#attendance-adjustment-recommendation-datatable').length){
                            reload_datatable('#attendance-adjustment-recommendation-datatable');
                        }

                        if($('#attendance-adjustment-approval-datatable').length){
                            reload_datatable('#attendance-adjustment-approval-datatable');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                sanction: {
                    required: true
                },
            },
            messages: {
                sanction: {
                    required: 'Please choose the sanction',
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
    }
    else if(form_type == 'employee leave management form'){
        $('#employee-leave-management-form').validate({
            submitHandler: function (form) {
                transaction = 'submit employee leave';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Inserted'){
                            show_alert('Insert Leave Success', 'The employee leave has been inserted.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#employee-leave-datatable');
                        }
                        else if(response === 'Leave Entitlement'){
                            show_alert('Insert Leave Error', 'The leave entitlement was consumed.', 'error');
                        }
                        else{
                            show_alert('Leave Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                leave_type: {
                    required: true
                },
                leave_duration: {
                    required: true
                },
                leave_date: {
                    required: true
                },
                start_time: {
                    required: true
                },
                end_time: {
                    required: true
                },
                reason: {
                    required: true
                }
            },
            messages: {
                leave_type: {
                    required: 'Please choose the leave type',
                },
                leave_duration: {
                    required: 'Please choose the duration',
                },
                leave_date: {
                    required: 'Please choose the leave date',
                },
                start_time: {
                    required: 'Please choose the start time',
                },
                end_time: {
                    required: 'Please choose the end time',
                },
                reason: {
                    required: 'Please enter the reason',
                }
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
    }
    else if(form_type == 'allowance type form'){
        $('#allowance-type-form').validate({
            submitHandler: function (form) {
                transaction = 'submit allowance type';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Allowance Type Success', 'The allowance type has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Allowance Type Success', 'The allowance type has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#allowance-type-datatable');
                        }
                        else{
                            show_alert('Allowance Type Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                allowance_type: {
                    required: true
                },
                taxable: {
                    required: true
                },
                description: {
                    required: true
                }
            },
            messages: {
                allowance_type: {
                    required: 'Please enter the allowance type',
                },
                taxable: {
                    required: 'Please choose the tax type',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'allowance form'){
        $('#allowance-form').validate({
            submitHandler: function (form) {
                transaction = 'submit allowance';

                var employee = $('#employee').val();

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&employee=' + employee,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Inserted'){
                            show_alert('Insert Allowance Success', 'The allowance has been inserted.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#allowance-datatable');
                        }
                        else{
                            show_alert('Allowance Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                employee_id: {
                    required: true
                },
                allowance_type: {
                    required: true
                },
                amount: {
                    required: true
                },
                recurrence_pattern: {
                    required: function(element){
                        var recurrence = $('#recurrence').val();

                        if(recurrence > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                recurrence: {
                    required: function(element){
                        var recurrence_pattern = $('#recurrence_pattern').val();

                        if(recurrence_pattern != ''){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                start_date: {
                    required: true
                },
            },
            messages: {
                employee_id: {
                    required: 'Please choose at least one (1) employee',
                },
                allowance_type: {
                    required: 'Please choose the allowance type',
                },
                amount: {
                    required: 'Please enter the amount',
                },
                recurrence_pattern: {
                    required: 'Please choose the recurrence pattern',
                },
                recurrence: {
                    required: 'Please enter the recurrence',
                },
                start_date: {
                    required: 'Please choose the start date',
                }
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
    }
    else if(form_type == 'allowance update form'){
        $('#allowance-update-form').validate({
            submitHandler: function (form) {
                transaction = 'submit allowance update';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated'){
                            show_alert('Update Allowance Success', 'The allowance has been updated.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#allowance-datatable');
                        }
                        else if(response === 'Not Found'){
                            show_alert('Update Allowance Error', 'The allowance does not exist.', 'error');
                        }
                        else{
                            show_alert('Allowance Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                amount: {
                    required: true
                },
                payroll_date: {
                    required: true
                }
            },
            messages: {
                amount: {
                    required: 'Please enter the amount',
                },
                payroll_date: {
                    required: 'Please choose the payroll date',
                }
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
    }
    else if(form_type == 'other income type form'){
        $('#other-income-type-form').validate({
            submitHandler: function (form) {
                transaction = 'submit other income type';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Other Income Type Success', 'The other income type has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Other Income Type Success', 'The other income type has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#other-income-type-datatable');
                        }
                        else{
                            show_alert('Other Income Type Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                other_income_type: {
                    required: true
                },
                taxable: {
                    required: true
                },
                description: {
                    required: true
                }
            },
            messages: {
                other_income_type: {
                    required: 'Please enter the other income type',
                },
                taxable: {
                    required: 'Please choose the tax type',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'other income form'){
        $('#other-income-form').validate({
            submitHandler: function (form) {
                transaction = 'submit other income';

                var employee = $('#employee').val();

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&employee=' + employee,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Inserted'){
                            show_alert('Insert Other Income Success', 'The other income has been inserted.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#other-income-datatable');
                        }
                        else{
                            show_alert('Other Income Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                employee_id: {
                    required: true
                },
                allowance_type: {
                    required: true
                },
                amount: {
                    required: true
                },
                recurrence_pattern: {
                    required: function(element){
                        var recurrence = $('#recurrence').val();

                        if(recurrence > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                recurrence: {
                    required: function(element){
                        var recurrence_pattern = $('#recurrence_pattern').val();

                        if(recurrence_pattern != ''){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                start_date: {
                    required: true
                },
            },
            messages: {
                employee_id: {
                    required: 'Please choose at least one (1) employee',
                },
                allowance_type: {
                    required: 'Please choose the allowance type',
                },
                amount: {
                    required: 'Please enter the amount',
                },
                recurrence_pattern: {
                    required: 'Please choose the recurrence pattern',
                },
                recurrence: {
                    required: 'Please enter the recurrence',
                },
                start_date: {
                    required: 'Please choose the start date',
                }
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
    }
    else if(form_type == 'other income update form'){
        $('#other-income-update-form').validate({
            submitHandler: function (form) {
                transaction = 'submit other income update';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated'){
                            show_alert('Update Other Income Success', 'The other income has been updated.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#other-income-datatable');
                        }
                        else if(response === 'Not Found'){
                            show_alert('Update Other Income Error', 'The other income does not exist.', 'error');
                        }
                        else{
                            show_alert('Other Income Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                amount: {
                    required: true
                },
                payroll_date: {
                    required: true
                }
            },
            messages: {
                amount: {
                    required: 'Please enter the amount',
                },
                payroll_date: {
                    required: 'Please choose the payroll date',
                }
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
    }
    else if(form_type == 'deduction type form'){
        $('#deduction-type-form').validate({
            submitHandler: function (form) {
                transaction = 'submit deduction type';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Deduction Type Success', 'The deduction type has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Deduction Type Success', 'The deduction type has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#deduction-type-datatable');
                        }
                        else{
                            show_alert('Deduction Type Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                deduction_type: {
                    required: true
                },
                description: {
                    required: true
                }
            },
            messages: {
                deduction_type: {
                    required: 'Please enter the deduction type',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'government contribution form'){
        $('#government-contribution-form').validate({
            submitHandler: function (form) {
                transaction = 'submit government contribution';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Government Contribution Success', 'The government contribution has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Government Contribution Success', 'The government contribution has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#government-contribution-datatable');
                        }
                        else{
                            show_alert('Government Contribution Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                government_contribution: {
                    required: true
                },
                description: {
                    required: true
                }
            },
            messages: {
                government_contribution: {
                    required: 'Please enter the government contribution',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'contribution bracket form'){
        $('#contribution-bracket-form').validate({
            submitHandler: function (form) {
                transaction = 'submit contribution bracket';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Contribution Bracket Success', 'The contribution bracket has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Contribution Bracket Success', 'The contribution bracket has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#contribution-bracket-datatable');
                        }
                        else if(response === 'Overlap'){
                            show_alert('Contribution Bracket Error', 'The contribution bracket range overlaps with the other contribution bracket.', 'error');
                        }
                        else{
                            show_alert('Contribution Bracket Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                start_range: {
                    required: true
                },
                end_range: {
                    required: true
                },
                deduction_amount: {
                    required: true
                }
            },
            messages: {
                start_range: {
                    required: 'Please enter the start range',
                },
                end_range: {
                    required: 'Please enter the end range',
                },
                deduction_amount: {
                    required: 'Please enter the deduction amount',
                }
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
    }
    else if(form_type == 'loan form'){
        $('#loan-form').validate({
            submitHandler: function (form) {
                transaction = 'submit loan';
                document.getElementById('maturity_date').disabled = false;

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Loan Success', 'The loan has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Loan Success', 'The loan has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#loan-datatable');
                        }
                        else{
                            show_alert('Loan Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                employee_id: {
                    required: true
                },
                loan_type: {
                    required: true
                },
                loan_amount: {
                    required: true
                },
                number_of_payments: {
                    required: true
                },
                payment_frequency: {
                    required: true
                },
                start_date: {
                    required: true
                },
            },
            messages: {
                employee_id: {
                    required: 'Please choose the employee',
                },
                loan_type: {
                    required: 'Please choose the loan type',
                },
                loan_amount: {
                    required: 'Please enter the loan amount',
                },
                number_of_payments: {
                    required: 'Please enter the number of payments',
                },
                payment_frequency: {
                    required: 'Please choose the payment frequency',
                },
                start_date: {
                    required: 'Please choose the start date',
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
    }
    else if(form_type == 'tag loan details as paid form'){
        $('#tag-loan-details-as-paid-form').validate({
            submitHandler: function (form) {
                transaction = 'tag loan details as paid';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Paid'){
                            ishow_alert('Tag Loan Details As Paid', 'The loan detail has been tagged as paid.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#loan-details-datatable');
                        }
                        else if(response === 'Not Found'){
                            show_alert('Tag Loan Details As Paid Error', 'The loan detail does not exist.', 'info');
                        }
                        else{
                            show_alert('Tag Loan Details As Paid Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                remarks: {
                    required: true
                },
            },
            messages: {
                remarks: {
                    required: 'Please enter the remarks',
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
    }
    else if(form_type == 'tag multiple loan details as paid form'){
        $('#tag-multiple-loan-details-as-unpaid-form').validate({
            submitHandler: function (form) {
                transaction = 'tag multiple loan details as paid';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Paid'){
                            ishow_alert('Tag Multiple Loan Details As Paid', 'The multiple loan details has been tagged as paid.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#loan-details-datatable');
                        }
                        else{
                            show_alert('Tag Multiple Loan Details As Paid Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                remarks: {
                    required: true
                },
            },
            messages: {
                remarks: {
                    required: 'Please enter the remarks',
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
    }
    else if(form_type == 'tag loan details as unpaid form'){
        $('#tag-loan-details-as-paid-form').validate({
            submitHandler: function (form) {
                transaction = 'tag loan details as unpaid';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Unpaid'){
                            ishow_alert('Tag Loan Details As Unpaid', 'The loan detail has been tagged as unpaid.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#loan-details-datatable');
                        }
                        else if(response === 'Not Found'){
                            show_alert('Tag Loan Details As Unpaid Error', 'The loan detail does not exist.', 'info');
                        }
                        else{
                            show_alert('Tag Loan Details As Unpaid Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                remarks: {
                    required: true
                },
            },
            messages: {
                remarks: {
                    required: 'Please enter the remarks',
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
    }
    else if(form_type == 'tag multiple loan details as unpaid form'){
        $('#tag-multiple-loan-details-as-unpaid-form').validate({
            submitHandler: function (form) {
                transaction = 'tag multiple loan details as unpaid';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Unpaid'){
                            ishow_alert('Tag Multiple Loan Details As Unpaid', 'The multiple loan details has been tagged as unpaid.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#loan-details-datatable');
                        }
                        else{
                            show_alert('Tag Multiple Loan Details As Unpaid Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                remarks: {
                    required: true
                },
            },
            messages: {
                remarks: {
                    required: 'Please enter the remarks',
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
    }
    else if(form_type == 'deduction form'){
        $('#deduction-form').validate({
            submitHandler: function (form) {
                transaction = 'submit deduction';

                var employee = $('#employee').val();

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&employee=' + employee,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Inserted'){
                            show_alert('Insert Deduction Success', 'The deduction has been inserted.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#deduction-datatable');
                        }
                        else{
                            show_alert('Deduction Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                employee_id: {
                    required: true
                },
                deduction_type: {
                    required: true
                },
                amount: {
                    required: true
                },
                recurrence_pattern: {
                    required: function(element){
                        var recurrence = $('#recurrence').val();

                        if(recurrence > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                recurrence: {
                    required: function(element){
                        var recurrence_pattern = $('#recurrence_pattern').val();

                        if(recurrence_pattern != ''){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                start_date: {
                    required: true
                },
            },
            messages: {
                employee_id: {
                    required: 'Please choose at least one (1) employee',
                },
                deduction_type: {
                    required: 'Please choose the deduction type',
                },
                amount: {
                    required: 'Please enter the amount',
                },
                recurrence_pattern: {
                    required: 'Please choose the recurrence pattern',
                },
                recurrence: {
                    required: 'Please enter the recurrence',
                },
                start_date: {
                    required: 'Please choose the start date',
                }
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
    }
    else if(form_type == 'deduction update form'){
        $('#deduction-update-form').validate({
            submitHandler: function (form) {
                transaction = 'submit deduction update';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated'){
                            show_alert('Update Deduction Success', 'The deduction has been updated.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#deduction-datatable');
                        }
                        else if(response === 'Not Found'){
                            show_alert('Update Deduction Error', 'The deduction does not exist.', 'error');
                        }
                        else{
                            show_alert('Deduction Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                amount: {
                    required: true
                },
                payroll_date: {
                    required: true
                }
            },
            messages: {
                amount: {
                    required: 'Please enter the amount',
                },
                payroll_date: {
                    required: 'Please choose the payroll date',
                }
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
    }
    else if(form_type == 'contribution deduction form'){
        $('#contribution-deduction-form').validate({
            submitHandler: function (form) {
                transaction = 'submit contribution deduction';

                var employee = $('#employee').val();

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&employee=' + employee,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Inserted'){
                            show_alert('Insert Contribution Deduction Success', 'The contribution deduction has been inserted.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#contribution-deduction-datatable');
                        }
                        else{
                            show_alert('Contribution Deduction Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                employee_id: {
                    required: true
                },
                deduction_type: {
                    required: true
                },
                recurrence_pattern: {
                    required: function(element){
                        var recurrence = $('#recurrence').val();

                        if(recurrence > 0){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                recurrence: {
                    required: function(element){
                        var recurrence_pattern = $('#recurrence_pattern').val();

                        if(recurrence_pattern != ''){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                start_date: {
                    required: true
                },
            },
            messages: {
                employee_id: {
                    required: 'Please choose at least one (1) employee',
                },
                deduction_type: {
                    required: 'Please choose the deduction type',
                },
                recurrence_pattern: {
                    required: 'Please choose the recurrence pattern',
                },
                recurrence: {
                    required: 'Please enter the recurrence',
                },
                start_date: {
                    required: 'Please choose the start date',
                }
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
    }
    else if(form_type == 'contribution deduction update form'){
        $('#contribution-deduction-update-form').validate({
            submitHandler: function (form) {
                transaction = 'submit contribution deduction update';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated'){
                            show_alert('Update Contribution Deduction Success', 'The contribution deduction has been updated.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#contribution-deduction-datatable');
                        }
                        else if(response === 'Not Found'){
                            show_alert('Update Contribution Deduction Error', 'The contribution deduction does not exist.', 'error');
                        }
                        else{
                            show_alert('Contribution Deduction Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                payroll_date: {
                    required: true
                }
            },
            messages: {
                payroll_date: {
                    required: 'Please choose the payroll date',
                }
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
    }
    else if(form_type == 'import employee form'){
        $('#import-employee-form').validate({
            submitHandler: function (form) {
                var transaction = 'import employee';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Imported'){
                            show_alert('Import Employee Success', 'The employee has been imported.', 'success');
                            reload_datatable('#import-employee-datatable');

                            $('#import-employee').addClass('d-none');
                            $('#submit-import-employee').removeClass('d-none');
                            $('#clear-import-employee').removeClass('d-none');

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'File Size'){
                            show_alert('Import Employee Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Import Employee Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Import Employee Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                import_file: {
                    required: true
                }
            },
            messages: {
                import_file: {
                    required: 'Please choose the import file',
                }
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
    }
    else if(form_type == 'import attendance record form'){
        $('#import-attendance-record-form').validate({
            submitHandler: function (form) {
                var transaction = 'import attendance record';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Imported'){
                            show_alert('Import Attendance Record Success', 'The attendance record has been imported.', 'success');
                            reload_datatable('#import-attendance-record-datatable');

                            $('#import-attendance-record').addClass('d-none');
                            $('#submit-import-attendance-record').removeClass('d-none');
                            $('#clear-import-attendance-record').removeClass('d-none');

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'File Size'){
                            show_alert('Import Attendance Record Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Import Attendance Record Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Import Attendance Record Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                import_file: {
                    required: true
                }
            },
            messages: {
                import_file: {
                    required: 'Please choose the import file',
                }
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
    }
    else if(form_type == 'import leave entitlement form'){
        $('#import-leave-entitlement-form').validate({
            submitHandler: function (form) {
                var transaction = 'import leave entitlement';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Imported'){
                            show_alert('Import Leave Entitlement Success', 'The leave entitlement has been imported.', 'success');
                            reload_datatable('#import-leave-entitlement-datatable');

                            $('#import-leave-entitlement').addClass('d-none');
                            $('#submit-import-leave-entitlement').removeClass('d-none');
                            $('#clear-import-leave-entitlement').removeClass('d-none');

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'File Size'){
                            show_alert('Import Leave Entitlement Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Import Leave Entitlement Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Import Leave Entitlement Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                import_file: {
                    required: true
                }
            },
            messages: {
                import_file: {
                    required: 'Please choose the import file',
                }
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
    }
    else if(form_type == 'import leave form'){
        $('#import-leave-form').validate({
            submitHandler: function (form) {
                var transaction = 'import leave';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Imported'){
                            show_alert('Import Leave Success', 'The leave has been imported.', 'success');
                            reload_datatable('#import-leave-datatable');

                            $('#import-leave').addClass('d-none');
                            $('#submit-import-leave').removeClass('d-none');
                            $('#clear-import-leave').removeClass('d-none');

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'File Size'){
                            show_alert('Import Leave Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Import Leave Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Import Leave Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                import_file: {
                    required: true
                }
            },
            messages: {
                import_file: {
                    required: 'Please choose the import file',
                }
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
    }
    else if(form_type == 'import attendance adjustment form'){
        $('#import-attendance-adjustment-form').validate({
            submitHandler: function (form) {
                var transaction = 'import attendance adjustment';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Imported'){
                            show_alert('Import Attendance Adjustment Success', 'The attendance adjustment has been imported.', 'success');
                            reload_datatable('#import-attendance-adjustment-datatable');

                            $('#import-attendance-adjustment').addClass('d-none');
                            $('#submit-import-attendance-adjustment').removeClass('d-none');
                            $('#clear-import-attendance-adjustment').removeClass('d-none');

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'File Size'){
                            show_alert('Import Attendance Adjustment Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Import Attendance Adjustment Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Import Attendance Adjustment Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                import_file: {
                    required: true
                }
            },
            messages: {
                import_file: {
                    required: 'Please choose the import file',
                }
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
    }
    else if(form_type == 'import attendance creation form'){
        $('#import-attendance-creation-form').validate({
            submitHandler: function (form) {
                var transaction = 'import attendance creation';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Imported'){
                            show_alert('Import Attendance Creation Success', 'The attendance creation has been imported.', 'success');
                            reload_datatable('#import-attendance-creation-datatable');

                            $('#import-attendance-creation').addClass('d-none');
                            $('#submit-import-attendance-creation').removeClass('d-none');
                            $('#clear-import-attendance-creation').removeClass('d-none');

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'File Size'){
                            show_alert('Import Attendance Creation Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Import Attendance Creation Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Import Attendance Creation Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                import_file: {
                    required: true
                }
            },
            messages: {
                import_file: {
                    required: 'Please choose the import file',
                }
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
    }
    else if(form_type == 'import allowance form'){
        $('#import-allowance-form').validate({
            submitHandler: function (form) {
                var transaction = 'import allowance';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Imported'){
                            show_alert('Import Allowance Success', 'The allowance has been imported.', 'success');
                            reload_datatable('#import-allowance-datatable');

                            $('#import-allowance').addClass('d-none');
                            $('#submit-import-allowance').removeClass('d-none');
                            $('#clear-import-allowance').removeClass('d-none');

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'File Size'){
                            show_alert('Import Allowance Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Import Allowance Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Import Allowance Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                import_file: {
                    required: true
                }
            },
            messages: {
                import_file: {
                    required: 'Please choose the import file',
                }
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
    }
    else if(form_type == 'import other income form'){
        $('#import-other-income-form').validate({
            submitHandler: function (form) {
                var transaction = 'import other income';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Imported'){
                            show_alert('Import Other Income Success', 'The other income has been imported.', 'success');
                            reload_datatable('#import-other-income-datatable');

                            $('#import-other-income').addClass('d-none');
                            $('#submit-import-other-income').removeClass('d-none');
                            $('#clear-import-other-income').removeClass('d-none');

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'File Size'){
                            show_alert('Import Other Income Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Import Other Income Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Import Other Income Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                import_file: {
                    required: true
                }
            },
            messages: {
                import_file: {
                    required: 'Please choose the import file',
                }
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
    }
    else if(form_type == 'import deduction form'){
        $('#import-deduction-form').validate({
            submitHandler: function (form) {
                var transaction = 'import deduction';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Imported'){
                            show_alert('Import Deduction Success', 'The deduction has been imported.', 'success');
                            reload_datatable('#import-deduction-datatable');

                            $('#import-deduction').addClass('d-none');
                            $('#submit-import-deduction').removeClass('d-none');
                            $('#clear-import-deduction').removeClass('d-none');

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'File Size'){
                            show_alert('Import Deduction Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Import Deduction Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Import Deduction Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                import_file: {
                    required: true
                }
            },
            messages: {
                import_file: {
                    required: 'Please choose the import file',
                }
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
    }
    else if(form_type == 'import government contribution form'){
        $('#import-government-contribution-form').validate({
            submitHandler: function (form) {
                var transaction = 'import government contribution';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Imported'){
                            show_alert('Import Government Contribution Success', 'The government contribution has been imported.', 'success');
                            reload_datatable('#import-government-contribution-datatable');

                            $('#import-government-contribution').addClass('d-none');
                            $('#submit-import-government-contribution').removeClass('d-none');
                            $('#clear-import-government-contribution').removeClass('d-none');

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'File Size'){
                            show_alert('Import Government Contribution Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Import Government Contribution Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Import Government Contribution Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                import_file: {
                    required: true
                }
            },
            messages: {
                import_file: {
                    required: 'Please choose the import file',
                }
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
    }
    else if(form_type == 'import contribution bracket form'){
        $('#import-contribution-bracket-form').validate({
            submitHandler: function (form) {
                var transaction = 'import contribution bracket';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Imported'){
                            show_alert('Import Contribution Bracket Success', 'The contribution bracket has been imported.', 'success');
                            reload_datatable('#import-contribution-bracket-datatable');

                            $('#import-contribution-bracket').addClass('d-none');
                            $('#submit-import-contribution-bracket').removeClass('d-none');
                            $('#clear-import-contribution-bracket').removeClass('d-none');

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'File Size'){
                            show_alert('Import Contribution Bracket Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Import Contribution Bracket Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Import Contribution Bracket Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                import_file: {
                    required: true
                }
            },
            messages: {
                import_file: {
                    required: 'Please choose the import file',
                }
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
    }
    else if(form_type == 'import contribution deduction form'){
        $('#import-contribution-deduction-form').validate({
            submitHandler: function (form) {
                var transaction = 'import contribution deduction';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Imported'){
                            show_alert('Import Contribution Deduction Success', 'The contribution deduction has been imported.', 'success');
                            reload_datatable('#import-contribution-deduction-datatable');

                            $('#import-contribution-deduction').addClass('d-none');
                            $('#submit-import-contribution-deduction').removeClass('d-none');
                            $('#clear-import-contribution-deduction').removeClass('d-none');

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'File Size'){
                            show_alert('Import Contribution Deduction Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Import Contribution Deduction Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Import Contribution Deduction Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                import_file: {
                    required: true
                }
            },
            messages: {
                import_file: {
                    required: 'Please choose the import file',
                }
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
    }
    else if(form_type == 'backup database form'){
        $('#backup-database-form').validate({
            submitHandler: function (form) {
                transaction = 'backup database';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Backed-up'){
                            show_alert('Backup Database Success', 'The database has been backed-up.', 'success');
                            $('#System-Modal').modal('hide');
                        }
                        else{
                            show_alert('Backup Database Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                file_name: {
                    required: true
                }
            },
            messages: {
                file_name: {
                    required: 'Please enter the file name',
                }
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
    }
    else if(form_type == 'salary form'){
        $('#salary-form').validate({
            submitHandler: function (form) {
                transaction = 'submit salary';

                var employee_id = $('#employee_id').val();

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&employee_id=' + employee_id,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Inserted'){
                            show_alert('Insert Salary Success', 'The salary has been inserted.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#salary-datatable');
                        }
                        else if(response === 'Overlap'){
                            show_alert('Insert Salary Error', 'The salary effectivity date overlaps with the existing salary of the employee.', 'error');
                        }
                        else{
                            show_alert('Salary Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                employee_id: {
                    required: true
                },
                salary_amount: {
                    required: true
                },
                salary_frequency: {
                    required: true
                },
                hours_per_week: {
                    required: true
                },
                hours_per_day: {
                    required: true
                },
                effectivity_date: {
                    required: true
                }
            },
            messages: {
                employee_id: {
                    required: 'Please choose at least one (1) employee',
                },
                salary_amount: {
                    required: 'Please enter the basic pay',
                },
                salary_frequency: {
                    required: 'Please choose the salary frequency',
                },
                hours_per_week: {
                    required: 'Please enter the hours per week',
                },
                hours_per_day: {
                    required: 'Please enter the hours per day',
                },
                effectivity_date: {
                    required: 'Please choose the effectivity date',
                }
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
    }
    else if(form_type == 'salary update form'){
        $('#salary-update-form').validate({
            submitHandler: function (form) {
                transaction = 'submit salary update';
                document.getElementById('employee_id').disabled = false;

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated'){
                            show_alert('Update Salary Success', 'The salary has been updated.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#salary-datatable');
                        }
                        else if(response === 'Overlap'){
                            show_alert('Update Salary Error', 'The salary effectivity date overlaps with the existing salary of the employee.', 'error');
                        }
                        else if(response === 'Not Found'){
                            show_alert('Update Salary Error', 'The salary does not exist.', 'error');
                        }
                        else{
                            show_alert('Salary Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                basic_pay: {
                    required: true
                },
                effectivity_date: {
                    required: true
                }
            },
            messages: {
                basic_pay: {
                    required: 'Please enter the basic pay',
                },
                effectivity_date: {
                    required: 'Please choose the effectivity date',
                }
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
    }
    else if(form_type == 'payroll group form'){
        $('#payroll-group-form').validate({
            submitHandler: function (form) {
                transaction = 'submit payroll group';

                var employee_id = $('#employee_id').val();

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&employee_id=' + employee_id,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Payroll Group Success', 'The payroll group has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Payroll Group Success', 'The payroll group has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#payroll-group-datatable');
                        }
                        else{
                            show_alert('Payroll Group Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                payroll_group: {
                    required: true
                },
                employee_id: {
                    required: true
                },
                description: {
                    required: true
                }
            },
            messages: {
                payroll_group: {
                    required: 'Please enter the payroll group',
                },
                employee_id: {
                    required: 'Please choose at least one (1) employee',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'pay run form'){
        $('#pay-run-form').validate({
            submitHandler: function (form) {
                transaction = 'submit pay run';

                var payroll_group_id = $('#payroll_group_id').val();
                var employee_id = $('#employee_id').val();

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&payroll_group_id=' + payroll_group_id + '&employee_id=' + employee_id,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Inserted'){
                            show_alert('Insert Pay Run Success', 'The pay run has been inserted.', 'success');

                            $('#System-Modal').modal('hide');
                            reload_datatable('#pay-run-datatable');
                        }
                        else if(response === 'Payee'){
                            show_alert('Pay Run Error', 'Please choose at least one (1) payroll group or employee.', 'error');
                        }
                        else if(response === 'Start Date'){
                            show_alert('Pay Run Error', 'The start date cannot be greater than the end date.', 'error');
                        }
                        else if(response === 'End Date'){
                            show_alert('Pay Run Error', 'The end date cannot be less than the start date.', 'error');
                        }
                        else{
                            show_alert('Pay Run Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                start_date: {
                    required: true
                },
                end_date: {
                    required: true
                },
                consider_overtime: {
                    required: true
                },
                consider_withholding_tax: {
                    required: true
                },
                payroll_group_id: {
                    required: function(element){
                        var payroll_group_id = $('#payroll_group_id').val();
                        var employee_id = $('#employee_id').val();

                        if(employee_id == '' && payroll_group_id == ''){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                employee_id: {
                    required: function(element){
                        var payroll_group_id = $('#payroll_group_id').val();
                        var employee_id = $('#employee_id').val();

                        if(employee_id == '' && payroll_group_id == ''){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
            },
            messages: {
                start_date: {
                    required: 'Please choose the start date',
                },
                end_date: {
                    required: 'Please choose the end date',
                },
                consider_overtime: {
                    required: 'Please choose if consider overtime',
                },
                consider_withholding_tax: {
                    required: 'Please choose if consider withholding tax',
                },
                payroll_group_id: {
                    required: 'Please choose at least one (1) payroll group or employee',
                },
                employee_id: {
                    required: 'Please choose at least one (1) payroll group or employee',
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
    }
    else if(form_type == 'withholding tax form'){
        $('#withholding-tax-form').validate({
            submitHandler: function (form) {
                transaction = 'submit withholding tax';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Withholding Tax Success', 'The withholding tax has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Withholding Tax Success', 'The withholding tax has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#withholding-tax-datatable');
                        }
                        else if(response === 'Overlap'){
                            show_alert('Withholding Tax Error', 'The withholding tax range overlaps with the other withholding tax.', 'error');
                        }
                        else{
                            show_alert('Withholding Tax Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                salary_frequency: {
                    required: true
                },
                start_range: {
                    required: true
                },
                end_range: {
                    required: true
                },
                fix_compensation_level: {
                    required: true
                },
                base_tax: {
                    required: true
                },
                rate: {
                    required: true
                }
            },
            messages: {
                salary_frequency: {
                    required: 'Please choose the salary frequency',
                },
                start_range: {
                    required: 'Please enter the start range',
                },
                end_range: {
                    required: 'Please enter the end range',
                },
                fix_compensation_level: {
                    required: 'Please enter the fix compensation level',
                },
                base_tax: {
                    required: 'Please enter the base tax',
                },
                rate: {
                    required: 'Please enter the rate',
                }
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
    }
    else if(form_type == 'import withholding tax form'){
        $('#import-withholding-tax-form').validate({
            submitHandler: function (form) {
                var transaction = 'import withholding tax';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Imported'){
                            show_alert('Import Withholding Tax Success', 'The withholding tax has been imported.', 'success');
                            reload_datatable('#import-withholding-tax-datatable');

                            $('#import-withholding-tax').addClass('d-none');
                            $('#submit-import-withholding-tax').removeClass('d-none');
                            $('#clear-import-withholding-tax').removeClass('d-none');

                            $('#System-Modal').modal('hide');
                        }
                        else if(response === 'File Size'){
                            show_alert('Import Withholding Tax Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Import Withholding Tax Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Import Withholding Tax Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                import_file: {
                    required: true
                }
            },
            messages: {
                import_file: {
                    required: 'Please choose the import file',
                }
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
    }
    else if(form_type == 'send payslip form'){
        $('#send-payslip-form').validate({
            submitHandler: function (form) {
                transaction = 'send pay run payslip';

                var employee_id = $('#employee_id').val();

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&employee_id=' + employee_id,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Sent'){
                            show_alert('Send Payslip', 'The payslip has been sent.', 'success');
  
                            $('#System-Modal').modal('hide');
                          }
                          else if(response === 'Not Found'){
                            show_alert('Send Payslip', 'The payslip does not exist.', 'info');
                          }
                          else if(response === 'Email'){
                            show_alert('Send Payslip Error', 'The email of the employee does is empty.', 'error');
                          }
                          else if(response === 'Invalid Email'){
                            show_alert('Send Payslip Error', 'The email of the employee does is not valid.', 'error');
                          }
                          else{
                            show_alert('Send Payslip', response, 'error');
                          }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                employee_id: {
                    required: true
                },
            },
            messages: {
                employee_id: {
                    required: 'Please choose at least one (1) employee',
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
    }
    else if(form_type == 'job category form'){
        $('#job-category-form').validate({
            submitHandler: function (form) {
                transaction = 'submit job category';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Job Category Success', 'The job category has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Job Category Success', 'The job category has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#job-category-datatable');
                        }
                        else{
                            show_alert('Job Category Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                job_category: {
                    required: true         
                },
                description: {
                    required: true         
                }
            },
            messages: {
                job_category: {
                    required: 'Please enter the job category',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'job type form'){
        $('#job-type-form').validate({
            submitHandler: function (form) {
                transaction = 'submit job type';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Job Type Success', 'The job type has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Job Type Success', 'The job type has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#job-type-datatable');
                        }
                        else{
                            show_alert('Job Type Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                job_type: {
                    required: true         
                },
                description: {
                    required: true         
                }
            },
            messages: {
                job_type: {
                    required: 'Please enter the job type',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'recruitment pipeline form'){
        $('#recruitment-pipeline-form').validate({
            submitHandler: function (form) {
                transaction = 'submit recruitment pipeline';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Recruitment Pipeline Success', 'The recruitment pipeline has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Recruitment Pipeline Success', 'The recruitment pipeline has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#recruitment-pipeline-datatable');
                        }
                        else{
                            show_alert('Recruitment Pipeline Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                recruitment_pipeline: {
                    required: true         
                },
                description: {
                    required: true         
                }
            },
            messages: {
                recruitment_pipeline: {
                    required: 'Please enter the recruitment pipeline',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'recruitment pipeline stage form'){
        $('#recruitment-pipeline-stage-form').validate({
            submitHandler: function (form) {
                transaction = 'submit recruitment pipeline stage';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Recruitment Pipeline Stage Success', 'The recruitment pipeline stage has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Recruitment Pipeline Stage Success', 'The recruitment pipeline stage has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#recruitment-pipeline-stage-datatable');
                        }
                        else{
                            show_alert('Recruitment Pipeline Stage Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                recruitment_pipeline_stage: {
                    required: true         
                },
                description: {
                    required: true         
                }
            },
            messages: {
                recruitment_pipeline_stage: {
                    required: 'Please enter the recruitment pipeline stage',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'recruitment scorecard form'){
        $('#recruitment-scorecard-form').validate({
            submitHandler: function (form) {
                transaction = 'submit recruitment scorecard';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Recruitment Scorecard Success', 'The recruitment scorecard has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Recruitment Scorecard Success', 'The recruitment scorecard has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#recruitment-scorecard-datatable');
                        }
                        else{
                            show_alert('Recruitment Scorecard Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                recruitment_scorecard: {
                    required: true         
                },
                description: {
                    required: true         
                }
            },
            messages: {
                recruitment_scorecard: {
                    required: 'Please enter the recruitment scorecard',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'recruitment scorecard section form'){
        $('#recruitment-scorecard-section-form').validate({
            submitHandler: function (form) {
                transaction = 'submit recruitment scorecard section';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Recruitment Scorecard Section Success', 'The recruitment scorecard section has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Recruitment Scorecard Section Success', 'The recruitment scorecard section has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#recruitment-scorecard-section-datatable');
                        }
                        else{
                            show_alert('Recruitment Scorecard Section Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                recruitment_scorecard_section: {
                    required: true         
                },
                description: {
                    required: true         
                }
            },
            messages: {
                recruitment_scorecard_section: {
                    required: 'Please enter the recruitment scorecard section',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'recruitment scorecard section option form'){
        $('#recruitment-scorecard-section-option-form').validate({
            submitHandler: function (form) {
                transaction = 'submit recruitment scorecard section option';

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Recruitment Scorecard Section Option Success', 'The recruitment scorecard section option has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Recruitment Scorecard Section Option Success', 'The recruitment scorecard section option has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#recruitment-scorecard-section-option-datatable');
                        }
                        else{
                            show_alert('Recruitment Scorecard Section Option Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                recruitment_scorecard_section_option: {
                    required: true         
                }
            },
            messages: {
                recruitment_scorecard_section_option: {
                    required: 'Please enter the recruitment scorecard section option',
                }
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
    }
    else if(form_type == 'job form'){
        $('#job-form').validate({
            submitHandler: function (form) {
                transaction = 'submit job';

                var team_member = $('#team_member').val();
                var branch_id = $('#branch_id').val();

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&team_member=' + team_member + '&branch_id=' + branch_id,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Job Success', 'The job has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Job Success', 'The job has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#job-datatable');
                        }
                        else{
                            show_alert('Job Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                job_title: {
                    required: true
                },
                job_category: {
                    required: true
                },
                job_type: {
                    required: true
                },
                recruitment_pipeline: {
                    required: true
                },
                recruitment_scorecard: {
                    required: true
                },
                team_member: {
                    required: true
                },
                branch_id: {
                    required: true
                },
                description: {
                    required: true         
                }
            },
            messages: {
                job_title: {
                    required: 'Please enter the job title',
                },
                job_category: {
                    required: 'Please choose the job category',
                },
                job_type: {
                    required: 'Please choose the job type',
                },
                recruitment_pipeline: {
                    required: 'Please choose the recruitment pipeline',
                },
                recruitment_scorecard: {
                    required: 'Please choose the recruitment scorecard',
                },
                team_member: {
                    required: 'Please choose at least one (1) team member',
                },
                branch_id: {
                    required: 'Please choose at least one (1) branch',
                },
                description: {
                    required: 'Please enter the description',
                }
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
    }
    else if(form_type == 'job applicant form'){
        $('#job-applicant-form').validate({
            submitHandler: function (form) {
                var transaction = 'submit job applicant';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated' || response === 'Inserted'){
                            if(response === 'Inserted'){
                                show_alert('Insert Designation Success', 'The designation has been inserted.', 'success');
                            }
                            else{
                                show_alert('Update Designation Success', 'The designation has been updated.', 'success');
                            }

                            $('#System-Modal').modal('hide');
                            reload_datatable('#designation-datatable');
                        }
                        else if(response === 'File Size'){
                            show_alert('Designation Error', 'The file uploaded exceeds the maximum file size.', 'error');
                        }
                        else if(response === 'File Type'){
                            show_alert('Designation Error', 'The file uploaded is not supported.', 'error');
                        }
                        else{
                            show_alert('Designation Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Submit');
                    }
                });
                return false;
            },
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                application_date: {
                    required: true
                },
                birthday: {
                    employee_age : 18,
                    required: true
                },
                applicant_resume: {
                    required: function(element){
                        var update = $('#update').val();

                        if(update == '0'){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                },
                gender: {
                    required: true
                },
                phone: {
                    required: true
                }
            },
            messages: {
                first_name: {
                    required: 'Please enter the first name',
                },
                last_name: {
                    required: 'Please enter the last name',
                },
                application_date: {
                    required: 'Please choose the application date',
                },
                birthday: {
                    required: 'Please choose the birthday',
                },
                applicant_resume: {
                    required: 'Please choose the applicant resume',
                },
                gender: {
                    required: 'Please choose the gender',
                },
                phone: {
                    required: 'Please enter the mobile number',
                }
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
    }
}

function initialize_transaction_log_table(datatable_name, buttons = false, show_all = false){
    var username = $('#username').text();
    var transaction_log_id = sessionStorage.getItem('transaction_log_id');
    var type = 'transaction log table';
    var settings;

    var column = [ 
        { 'data' : 'LOG_TYPE' },
        { 'data' : 'LOG' },
        { 'data' : 'LOG_DATE' },
        { 'data' : 'LOG_BY' }
    ];

    var column_definition = [
        { 'width': '15%', 'aTargets': 0 },
        { 'width': '45%', 'aTargets': 1 },
        { 'width': '20%', 'aTargets': 2 },
        { 'width': '20%', 'aTargets': 3 },
    ];

    if(show_all){
        length_menu = [ [-1], ['All'] ];
    }
    else{
        length_menu = [ [10, 25, 50, 100, -1], [10, 25, 50, 100, 'All'] ];
    }

    if(buttons){
        settings = {
            'ajax': { 
                'url' : 'system-generation.php',
                'method' : 'POST',
                'dataType': 'JSON',
                'data': {'type' : type, 'username' : username, 'transaction_log_id' : transaction_log_id},
                'dataSrc' : ''
            },
            dom:  "<'row'<'col-sm-3'l><'col-sm-6 text-center mb-2'B><'col-sm-3'f>>" +  "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'csv', 'excel', 'pdf'
            ],
            'order': [[ 2, 'desc' ]],
            'columns' : column,
            'scrollY': false,
            'scrollX': true,
            'scrollCollapse': true,
            'fnDrawCallback': function( oSettings ) {
                readjust_datatable_column();
            },
            'aoColumnDefs': column_definition,
            'lengthMenu': length_menu,
            'language': {
                'emptyTable': 'No data found',
                'searchPlaceholder': 'Search...',
                'search': '',
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" role="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }
    else{
        settings = {
            'ajax': { 
                'url' : 'system-generation.php',
                'method' : 'POST',
                'dataType': 'JSON',
                'data': {'type' : type, 'username' : username, 'transaction_log_id' : transaction_log_id},
                'dataSrc' : ''
            },
            'order': [[ 2, 'desc' ]],
            'columns' : column,
            'scrollY': false,
            'scrollX': true,
            'scrollCollapse': true,
            'fnDrawCallback': function( oSettings ) {
                readjust_datatable_column();
            },
            'aoColumnDefs': column_definition,
            'lengthMenu': length_menu,
            'language': {
                'emptyTable': 'No data found',
                'searchPlaceholder': 'Search...',
                'search': '',
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" role="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }

    destroy_datatable(datatable_name);
    
    $(datatable_name).dataTable(settings);
}

// Get location function
function get_location(map_div) {
    if(!map_div){
        if (navigator.geolocation) {
            var options = {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            };

            navigator.geolocation.watchPosition(show_position, show_geolocation_error, options);
        } 
        else {
            show_alert('Geolocation Error', 'Your browser does not support geolocation.', 'error');
        }
    }
    else{
        var map = new GMaps({
            div: '#' + map_div,
            lat: -12.043333,
            lng: -77.028333
        });
    
        GMaps.geolocate({
            success: function(position){
                map.setCenter(position.coords.latitude, position.coords.longitude);
                map.addMarker({
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                });

                sessionStorage.setItem('latitude', position.coords.latitude);
                sessionStorage.setItem('longitude', position.coords.longitude);
            },
            error: function(error){
                show_alert('Geolocation Error', 'Geolocation failed: ' + error.message, 'error');
            },
            not_supported: function(){
                show_alert('Geolocation Error', 'Your browser does not support geolocation.', 'error');
            },
        });
    }
}

function show_position(position) {
    sessionStorage.setItem('latitude', position.coords.latitude);
    sessionStorage.setItem('longitude', position.coords.longitude);

    if ($('#attendance_position').length) {
        $('#attendance_position').val(position.coords.longitude + ', ' + position.coords.latitude);
    }

    if ($('#position').length) {
        $('#position').val(position.coords.longitude + ', ' + position.coords.latitude);
    }
}

function show_geolocation_error(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            show_alert('Geolocation Error', 'User denied the request for Geolocation.', 'error');
            break;
        case error.POSITION_UNAVAILABLE:
            show_alert('Geolocation Error', 'Location information is unavailable.', 'error');
            break;
        case error.TIMEOUT:
            show_alert('Geolocation Error', 'The request to get user location timed out.', 'error');
            break;
        case error.UNKNOWN_ERROR:
            show_alert('Geolocation Error', 'An unknown error occurred.', 'error');
            break;
    }
}

// Generate function
function generate_modal(form_type, title, size, scrollable, submit_button, generate_type, form_id, add, username){
    var type = 'system modal';

    $.ajax({
        url: 'system-generation.php',
        method: 'POST',
        dataType: 'JSON',
        data: {type : type, username : username, title : title, size : size, scrollable : scrollable, submit_button : submit_button, generate_type : generate_type, form_id : form_id},
        beforeSend: function(){
            $('#System-Modal').remove();
        },
        success: function(response) {
            $('body').append(response[0].MODAL);
        },
        complete : function(){
            if(generate_type == 'form'){
                generate_form(form_type, form_id, add, username);
            }
            else{
                generate_element(form_type, '', '', '1', username);
            }
        }
    });
}

function generate_form(form_type, form_id, add, username){
    var type = 'system form';

    $.ajax({
        url: 'system-generation.php',
        method: 'POST',
        dataType: 'JSON',
        data: { type : type, username : username, form_type : form_type, form_id : form_id },
        success: function(response) {
            document.getElementById('modal-body').innerHTML = response[0].FORM;
        },
        complete: function(){
            if(add == '0'){
                display_form_details(form_type);
            }
            else{
                if(form_type == 'permission form'){
                    var policy_id = $('#policy-id').text();
                    $('#policy_id').val(policy_id);
                }
                else if(form_type == 'emergency contact form' || form_type == 'employee address form' || form_type == 'employee social form' || form_type == 'employee attendance form' || form_type == 'employee leave entitlement form' || form_type == 'employee leave form' || form_type == 'employee file form' || form_type == 'employee allowance form' || form_type == 'employee allowance update form'){
                    var employee_id = $('#employee-id').text();
                    $('#employee_id').val(employee_id);
                }
                else if(form_type == 'approve leave form' || form_type == 'reject leave form' || form_type == 'cancel leave form' || form_type == 'approve multiple leave form' || form_type == 'reject multiple leave form' || form_type == 'cancel multiple leave form' || form_type == 'approve employee leave form' || form_type == 'reject employee leave form' || form_type == 'cancel employee leave form'){
                    var leave_id = sessionStorage.getItem('leave_id');
                    $('#leave_id').val(leave_id);
                }
                else if(form_type == 'time in form' || form_type == 'get location form'){
                    get_location('');
                }
                else if(form_type == 'approve attendance creation form' || form_type == 'approve multiple attendance creation form' || form_type == 'reject attendance creation form' || form_type == 'cancel attendance creation form' || form_type == 'reject multiple attendance creation form' || form_type == 'cancel multiple attendance creation form' || form_type == 'approve attendance adjustment form' || form_type == 'approve multiple attendance adjustment form' || form_type == 'reject attendance adjustment form' || form_type == 'cancel attendance adjustment form' || form_type == 'reject multiple attendance adjustment form' || form_type == 'cancel multiple attendance adjustment form'){
                    var request_id = sessionStorage.getItem('request_id');
                    $('#request_id').val(request_id);
                }
                else if(form_type == 'contribution bracket form'){
                    var government_contribution_id = $('#government-contribution-id').text();
                    $('#government_contribution_id').val(government_contribution_id);
                }
                else if(form_type == 'tag loan details as paid form' || form_type == 'tag loan details as unpaid form' || form_type == 'tag multiple loan details as paid form' || form_type == 'tag multiple loan details as unpaid form'){
                    var loan_details_id = sessionStorage.getItem('loan_details_id');
                    $('#loan_details_id').val(loan_details_id);
                }
                else if(form_type == 'send payslip form'){
                    var pay_run_id = sessionStorage.getItem('pay_run_id');

                    $('#pay_run_id').val(pay_run_id);
                    generate_pay_run_payee_option(pay_run_id);
                }
                else if(form_type == 'recruitment pipeline stage form'){
                    var recruitment_pipeline_id = $('#recruitment-pipeline-id').text();

                    $('#recruitment_pipeline_id').val(recruitment_pipeline_id);
                }
                else if(form_type == 'recruitment scorecard section form'){
                    var recruitment_scorecard_id = $('#recruitment-scorecard-id').text();

                    $('#recruitment_scorecard_id').val(recruitment_scorecard_id);
                }
                else if(form_type == 'recruitment scorecard section option form'){
                    var recruitment_scorecard_section_id = $('#recruitment-scorecard-section-id').text();

                    $('#recruitment_scorecard_section_id').val(recruitment_scorecard_section_id);
                }
            }

            initialize_elements();
            initialize_form_validation(form_type);

            $('#System-Modal').modal('show');
        }
    });    
}

function generate_element(element_type, value, container, modal, username){
    var type = 'system element';

    $.ajax({
        url: 'system-generation.php',
        method: 'POST',
        dataType: 'JSON',
        data: { type : type, username : username, value : value, element_type : element_type },
        beforeSend : function(){
            if(container){
                document.getElementById(container).innerHTML = '';
            }
        },
        success: function(response) {
            if(!container){
                document.getElementById('modal-body').innerHTML = response[0].ELEMENT;
            }
            else{
                document.getElementById(container).innerHTML = response[0].ELEMENT;
            }
        },
        complete: function(){
            initialize_elements();

            if(modal == '1'){
                $('#System-Modal').modal('show');

                if(element_type == 'system parameter details' || element_type == 'branch details' || element_type == 'leave details' || element_type == 'employee file details' || element_type == 'employee qr code' || element_type == 'user account details' || element_type == 'employee attendance details' || element_type == 'attendance creation details' || element_type == 'attendance adjustment details' || element_type == 'work shift regular details' || element_type == 'work shift scheduled details' || element_type == 'allowance details' || element_type == 'deduction details' || element_type == 'contribution deduction details' || element_type == 'salary details' || element_type == 'payroll group details' || element_type == 'pay run details' || element_type == 'other income details' || element_type == 'payslip details' || element_type == 'job details'){
                    display_form_details(element_type);
                }
                else if(element_type == 'scan qr code form'){
                    $('#qr-code-reader').html('<div class="d-flex justify-content-center"><div class="spinner-border spinner-border-sm text-primary" role="status"><span rclass="sr-only"></span></div></div>');

                    Html5Qrcode.getCameras().then(devices => {
                        if (devices && devices.length) {
                            var camera_id = devices[0].id;
            
                            const html5QrCode = new Html5Qrcode("qr-code-reader");
                            const config = { fps: 10, qrbox: { width: 250, height: 250 } };
                            const qrCodeSuccessCallback = (decodedText, decodedResult) => {
                                var audio = new Audio('assets/audio/scan.mp3');
                                audio.play();
                                navigator.vibrate([500]);
            
                                var employee_id = decodedText.substring(
                                    decodedText.lastIndexOf("[") + 1, 
                                    decodedText.lastIndexOf("]")
                                );
            
                                var latitude = sessionStorage.getItem('latitude');
                                var longitude = sessionStorage.getItem('longitude');
                                var transaction = 'submit attendance record';
                                var username = $('#username').text();
                                    
                                $.ajax({
                                    type: 'POST',
                                    url: 'controller.php',
                                    data: {username : username, latitude : latitude, employee_id : employee_id, longitude : longitude, transaction : transaction},
                                    success: function (response) {
                                        if(response === 'Time In'){
                                            var audio = new Audio('assets/audio/attendance-clock-in-success.mp3');
                                            audio.play();
                                            navigator.vibrate([500]);
                                        }
                                        else if(response === 'Time Out'){
                                            var audio = new Audio('assets/audio/attendance-clock-out-success.mp3');
                                            audio.play();
                                            navigator.vibrate([500]);
                                        }
                                        else if(response === 'Max Attendance'){
                                            var audio = new Audio('assets/audio/max-attendance-error.mp3');
                                            audio.play();
                                            navigator.vibrate([500]);
                                        }
                                        else if(response === 'Location'){
                                            var audio = new Audio('assets/audio/location-error.mp3');
                                            audio.play();
                                            navigator.vibrate([500]);
                                        }
                                        else if(response === 'Time Allowance'){
                                            var audio = new Audio('assets/audio/clock-out-time-error.mp3');
                                            audio.play();
                                            navigator.vibrate([500]);
                                        }
                                        else{
                                            var audio = new Audio('assets/audio/attendance-error.mp3');
                                            audio.play();
                                            navigator.vibrate([500]);
                                        }
                                    }
                                });
            
                                html5QrCode.stop().then((ignore) => {
                                    $('#qr-code-reader').html('');
                                    $('#qr-code-reader').html('<div class="d-flex justify-content-center"><div class="spinner-border spinner-border-sm text-primary" role="status"><span rclass="sr-only"></span></div></div>');
                                    
                                    setTimeout(function(){  html5QrCode.start({ deviceId: { exact: camera_id} }, config, qrCodeSuccessCallback); }, 4000);
                                }).catch((err) => {
                                    alert(err);
                                });
                            };
            
                            html5QrCode.start({ deviceId: { exact: camera_id} }, config, qrCodeSuccessCallback);
                        }
                    }).catch(err => {
                        alert(err);
                    });
                }
                else if(element_type == 'transaction log'){
                    if($('#transaction-log-datatable').length){
                        initialize_transaction_log_table('#transaction-log-datatable');
                    }
                }
                else if(element_type == 'attendance summary details'){
                    if($('#employee-attendance-datatable').length){
                        initialize_employee_attendance_table('#employee-attendance-datatable');
                    }

                    if($('#attendance-adjustment-datatable').length){
                        initialize_attendance_adjustment_table('#attendance-adjustment-datatable');
                    }

                    if($('#attendance-creation-datatable').length){
                        initialize_attendance_creation_table('#attendance-creation-datatable');
                    }
                }
            }
        }
    });
}

function generate_city_option(province, selected){
    var username = $('#username').text();
    var type = 'city options';

    $.ajax({
        url: 'system-generation.php',
        method: 'POST',
        dataType: 'JSON',
        data: {type : type, province : province, username : username},
        beforeSend: function(){
            $('#city').empty();
        },
        success: function(response) {
            var newOption = new Option('--', '', false, false);
            $('#city').append(newOption);

            for(var i = 0; i < response.length; i++) {
                newOption = new Option(response[i].CITY, response[i].CITY_ID, false, false);
                $('#city').append(newOption);
            }
        },
        complete: function(){
            if(selected != ''){
                $('#city').val(selected).change();
            }
        }
    });
}

function generate_pay_run_payee_option(pay_run_id){
    var username = $('#username').text();
    var type = 'pay run payee options';

    $.ajax({
        url: 'system-generation.php',
        method: 'POST',
        dataType: 'JSON',
        data: {type : type, pay_run_id : pay_run_id, username : username},
        beforeSend: function(){
            $('#payee').empty();
        },
        success: function(response) {
            for(var i = 0; i < response.length; i++) {
                newOption = new Option(response[i].FILE_AS, response[i].EMPLOYEE_ID, false, false);
                $('#payee').append(newOption);
            }
        }
    });
}

// Reset validation functions
function reset_element_validation(element){
    $(element).parent().removeClass('has-danger');
    $(element).removeClass('form-control-danger');
    $(element + '-error').remove();
}

// Reload functions
function reload_datatable(datatable){
    hide_multiple_buttons();
    $(datatable).DataTable().ajax.reload();
}

// Display functions
function display_form_details(form_type){
    var transaction;
    var d = new Date();

    if(form_type == 'system parameter form'){
        transaction = 'system parameter details';

        var parameter_id = sessionStorage.getItem('parameter_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {parameter_id : parameter_id, transaction : transaction},
            success: function(response) {
                $('#parameter').val(response[0].PARAMETER_DESC);
                $('#extension').val(response[0].PARAMETER_EXTENSION);
                $('#parameter_number').val(response[0].PARAMETER_NUMBER);
                $('#parameter_id').val(parameter_id);
            }
        });
    }
    else if(form_type == 'system parameter details'){
        transaction = 'system parameter details';
        
        var parameter_id = sessionStorage.getItem('parameter_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {parameter_id : parameter_id, transaction : transaction},
            success: function(response) {
                $('#parameter').text(response[0].PARAMETER_DESC);
                $('#extension').text(response[0].PARAMETER_EXTENSION);
                $('#parameter_number').text(response[0].PARAMETER_NUMBER);
            }
        });
    }
    else if(form_type == 'transaction log'){
        transaction = 'transaction log details';
        
        var transaction_log_id = sessionStorage.getItem('transaction_log_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {transaction_log_id : transaction_log_id, transaction : transaction},
            success: function(response) {
                document.getElementById('transaction-log-timeline').innerHTML = response[0].TIMELINE;
            }
        });
    }
    else if(form_type == 'policy form'){
        transaction = 'policy details';

        var policy_id = sessionStorage.getItem('policy_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {policy_id : policy_id, transaction : transaction},
            success: function(response) {
                $('#policy').val(response[0].POLICY);
                $('#description').val(response[0].DESCRIPTION);
                $('#policy_id').val(policy_id);
            }
        });
    }
    else if(form_type == 'permission form'){
        transaction = 'permission details';
        
        var permission_id = sessionStorage.getItem('permission_id');
        var policy_id = $('#policy-id').text();
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {permission_id : permission_id, transaction : transaction},
            success: function(response) {
                $('#permission_id').val(permission_id);
                $('#policy_id').val(policy_id);
                $('#permission').val(response[0].PERMISSION);
            }
        });
    }
    else if(form_type == 'role form'){
        transaction = 'role details';
        
        var role_id = sessionStorage.getItem('role_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {role_id : role_id, transaction : transaction},
            success: function(response) {
                $('#role_id').val(role_id);
                $('#role').val(response[0].ROLE);
                $('#description').val(response[0].DESCRIPTION);
            }
        });
    }
    else if(form_type == 'role permission form'){
        transaction = 'role permission details';
        
        var role_id = $('#role-id').text();
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {role_id : role_id, transaction : transaction},
            success: function(response) {
                var userArray = new Array();
                userArray = response.toString().split(',');

                $('.role-permissions').each(function(index) {
                    var val = $(this).val();
                    if (userArray.includes(val)) {
                        $(this).prop('checked', true);
                    }
                });
            }
        });
    }
    else if(form_type == 'system code form'){
        transaction = 'system code details';
        
        var system_type = sessionStorage.getItem('system_type');
        var system_code = sessionStorage.getItem('system_code');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {system_type : system_type, system_code : system_code, transaction : transaction},
            success: function(response) {
                $('#system_description').val(response[0].DESCRIPTION);
                $('#system_code').val(system_code);

                check_option_exist('#system_type', system_type, '');
            },
            complete: function(){
                document.getElementById('system_type').disabled = true;
                document.getElementById('system_code').readOnly = true;
            }
        });
    }
    else if(form_type == 'user interface setting form'){
        transaction = 'user interface settings details';

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {transaction : transaction},
            success: function(response) {
                $('#login-bg').attr('src', response[0].LOGIN_BG + '?' + d.getMilliseconds());
                $('#logo-light').attr('src', response[0].LOGO_LIGHT + '?' + d.getMilliseconds());
                $('#logo-dark').attr('src', response[0].LOGO_DARK + '?' + d.getMilliseconds());
                $('#logo-icon-light').attr('src', response[0].LOGO_ICON_LIGHT + '?' + d.getMilliseconds());
                $('#logo-icon-dark').attr('src', response[0].LOGO_ICON_DARK + '?' + d.getMilliseconds());
                $('#favicon-image').attr('src', response[0].FAVICON + '?' + d.getMilliseconds());
            }
        });
    }
    else if(form_type == 'email configuration form'){
        transaction = 'email configuration details';
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {transaction : transaction},
            success: function(response) {
                $('#mail_host').val(response[0].MAIL_HOST);
                $('#port').val(response[0].PORT);
                $('#mail_user').val(response[0].USERNAME);
                $('#mail_password').val(response[0].PASSWORD);
                $('#mail_from_name').val(response[0].MAIL_FROM_NAME);
                $('#mail_from_email').val(response[0].MAIL_FROM_EMAIL);

                check_empty(response[0].MAIL_ENCRYPTION, '#mail_encryption', 'select');
                check_empty(response[0].SMTP_AUTH, '#smtp_auth', 'select');
                check_empty(response[0].SMTP_AUTO_TLS, '#smtp_auto_tls', 'select');
            }
        });
    }
    else if(form_type == 'notification type form'){
        transaction = 'notification type details';
        
        var notification_id = sessionStorage.getItem('notification_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {notification_id : notification_id, transaction : transaction},
            success: function(response) {
                $('#notification').val(response[0].NOTIFICATION);
                $('#description').val(response[0].DESCRIPTION);
                $('#notification_id').val(notification_id);
            }
        });
    }
    else if(form_type == 'notification details form'){
        transaction = 'notification details';
        
        var notification_id = $('#notification-id').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {notification_id : notification_id, transaction : transaction},
            success: function(response) {
                $('#notification_title').val(response[0].NOTIFICATION_TITLE);
                $('#notification_message').val(response[0].NOTIFICATION_MESSAGE);
                $('#system_link').val(response[0].SYSTEM_LINK);
                $('#web_link').val(response[0].WEB_LINK);

                check_empty(response[0].RECIPIENT.split(','), '#notification_recipient', 'select');
            }
        });
    }
    else if(form_type == 'application notification form'){
        transaction = 'application notification details';
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {transaction : transaction},
            success: function(response) {
                var userArray = new Array();
                userArray = response.toString().split(',');

                $('.application-notification').each(function(index) {
                    var val = $(this).val();
                    if (userArray.includes(val)) {
                        $(this).prop('checked', true);
                    }
                    else{
                        $(this).prop('checked', false);
                    }
                });
            }
        });
    }
    else if(form_type == 'company setting form'){
        transaction = 'company setting details';

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {transaction : transaction},
            success: function(response) {
                $('#company_name').val(response[0].COMPANY_NAME);
                $('#email').val(response[0].EMAIL);
                $('#phone').val(response[0].PHONE);
                $('#telephone').val(response[0].TELEPHONE);
                $('#website').val(response[0].WEBSITE);
                $('#address').val(response[0].ADDRESS);

                $('#company-logo').attr('src', response[0].COMPANY_LOGO + '?' + d.getMilliseconds());

                check_option_exist('#province', response[0].PROVINCE_ID, '');

                generate_city_option(response[0].PROVINCE_ID, response[0].CITY_ID);
            }
        });
    }
    else if(form_type == 'department form'){
        transaction = 'department details';
        
        var department_id = sessionStorage.getItem('department_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {department_id : department_id, transaction : transaction},
            success: function(response) {
                $('#department_id').val(department_id);
                $('#department').val(response[0].DEPARTMENT);
                $('#description').val(response[0].DESCRIPTION);

                check_option_exist('#department_head', response[0].DEPARTMENT_HEAD, '');
                check_option_exist('#parent_department', response[0].PARENT_DEPARTMENT, '');
            }
        });
    }
    else if(form_type == 'designation form'){
        transaction = 'designation details';
        
        var designation_id = sessionStorage.getItem('designation_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {designation_id : designation_id, transaction : transaction},
            success: function(response) {
                $('#designation_id').val(designation_id);
                $('#designation').val(response[0].DESIGNATION);
                $('#description').val(response[0].DESCRIPTION);
            }
        });
    }
    else if(form_type == 'branch form'){
        transaction = 'branch details';
        
        var branch_id = sessionStorage.getItem('branch_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {branch_id : branch_id, transaction : transaction},
            success: function(response) {
                $('#branch_id').val(branch_id);
                $('#branch').val(response[0].BRANCH);
                $('#email').val(response[0].EMAIL);
                $('#phone').val(response[0].PHONE);
                $('#telephone').val(response[0].TELEPHONE);
                $('#address').val(response[0].ADDRESS);
            }
        });
    }
    else if(form_type == 'branch details'){
        transaction = 'branch details';

        var branch_id = sessionStorage.getItem('branch_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {branch_id : branch_id, transaction : transaction},
            success: function(response) {
                $('#branch').text(response[0].BRANCH);
                $('#email').text(response[0].EMAIL);
                $('#phone').text(response[0].PHONE);
                $('#telephone').text(response[0].TELEPHONE);
                $('#address').text(response[0].ADDRESS);
            }
        });
    }
    else if(form_type == 'upload setting form'){
        transaction = 'upload setting details';
        
        var upload_setting_id = sessionStorage.getItem('upload_setting_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {upload_setting_id : upload_setting_id, transaction : transaction},
            success: function(response) {
                $('#upload_setting_id').val(upload_setting_id);
                $('#upload_setting').val(response[0].UPLOAD_SETTING);
                $('#max_file_size').val(response[0].MAX_FILE_SIZE);
                $('#description').val(response[0].DESCRIPTION);
               
                check_empty(response[0].FILE_TYPE.split(','), '#file_type', 'select');
            }
        });
    }
    else if(form_type == 'employment status form'){
        transaction = 'employment status details';

        var employment_status_id = sessionStorage.getItem('employment_status_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {employment_status_id : employment_status_id, transaction : transaction},
            success: function(response) {
                $('#employment_status').val(response[0].EMPLOYMENT_STATUS);
                $('#description').val(response[0].DESCRIPTION);
                $('#employment_status_id').val(employment_status_id);

                check_option_exist('#color_value', response[0].COLOR_VALUE, '');
            }
        });
    }
    else if(form_type == 'employee form'){
        transaction = 'employee details';

        var employee_id = sessionStorage.getItem('employee_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {employee_id : employee_id, transaction : transaction},
            success: function(response) {
                check_option_exist('#employment_status', response[0].EMPLOYMENT_STATUS, '');
                check_option_exist('#suffix', response[0].SUFFIX, '');
                check_option_exist('#department', response[0].DEPARTMENT, '');
                check_option_exist('#designation', response[0].DESIGNATION, '');
                check_option_exist('#branch', response[0].BRANCH, '');
                check_option_exist('#gender', response[0].GENDER, '');

                $('#id_number').val(response[0].ID_NUMBER);
                $('#joining_date').val(response[0].JOIN_DATE);
                $('#permanency_date').val(response[0].PERMANENCY_DATE);
                $('#exit_date').val(response[0].EXIT_DATE);
                $('#exit_reason').val(response[0].EXIT_REASON);
                $('#first_name').val(response[0].FIRST_NAME);
                $('#middle_name').val(response[0].MIDDLE_NAME);
                $('#last_name').val(response[0].LAST_NAME);
                $('#email').val(response[0].EMAIL);
                $('#phone').val(response[0].PHONE);
                $('#telephone').val(response[0].TELEPHONE);
                $('#birthday').val(response[0].BIRTHDAY);
                $('#employee_id').val(employee_id);
            },
            complete: function(){
                document.getElementById('id_number').readOnly = true;
            }
        });
    }
    else if(form_type == 'emergency contact form'){
        transaction = 'emergency contact details';

        var contact_id = sessionStorage.getItem('contact_id');
        var employee_id = $('#employee-id').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {contact_id : contact_id, transaction : transaction},
            success: function(response) {
                $('#contact_name').val(response[0].NAME);
                $('#address').val(response[0].ADDRESS);
                $('#phone').val(response[0].PHONE);
                $('#email').val(response[0].EMAIL);
                $('#telephone').val(response[0].TELEPHONE);
                $('#contact_id').val(contact_id);
                $('#employee_id').val(employee_id);

                check_option_exist('#relationship', response[0].RELATIONSHIP, '');
                check_option_exist('#province', response[0].PROVINCE, '');

                generate_city_option(response[0].PROVINCE, response[0].CITY);
            }
        });
    }
    else if(form_type == 'employee address form'){
        transaction = 'employee address details';

        var address_id = sessionStorage.getItem('address_id');
        var employee_id = $('#employee-id').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {address_id : address_id, transaction : transaction},
            success: function(response) {
                $('#address').val(response[0].ADDRESS);
                $('#address_id').val(address_id);
                $('#employee_id').val(employee_id);

                check_option_exist('#address_type', response[0].ADDRESS_TYPE, '');
                check_option_exist('#province', response[0].PROVINCE, '');

                generate_city_option(response[0].PROVINCE, response[0].CITY);
            }
        });
    }
    else if(form_type == 'employee social form'){
        transaction = 'employee social details';

        var social_id = sessionStorage.getItem('social_id');
        var employee_id = $('#employee-id').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {social_id : social_id, transaction : transaction},
            success: function(response) {
                $('#link').val(response[0].LINK);
                $('#social_id').val(social_id);
                $('#employee_id').val(employee_id);

                check_option_exist('#social_type', response[0].SOCIAL_TYPE, '');
            }
        });
    }
    else if(form_type == 'work shift form'){
        transaction = 'work shift details';

        var work_shift_id = sessionStorage.getItem('work_shift_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {work_shift_id : work_shift_id, transaction : transaction},
            success: function(response) {
                $('#work_shift').val(response[0].WORK_SHIFT);
                $('#description').val(response[0].DESCRIPTION);
                $('#work_shift_id').val(work_shift_id);

                check_option_exist('#work_shift_type', response[0].WORK_SHIFT_TYPE, '');
            }
        });
    }
    else if(form_type == 'work shift regular details' || form_type == 'work shift scheduled details'){
        transaction = 'work shift summary details';

        var work_shift_id = sessionStorage.getItem('work_shift_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {work_shift_id : work_shift_id, transaction : transaction},
            success: function(response) {
                $('#work_shift').text(response[0].WORK_SHIFT);
                $('#description').text(response[0].DESCRIPTION);
                $('#work_shift_type').text(response[0].WORK_SHIFT_TYPE);

                if($('#start_date').length){
                    $('#start_date').text(response[0].START_DATE);
                }

                if($('#end_date').length){
                    $('#end_date').text(response[0].END_DATE);
                }

                document.getElementById('monday').innerHTML = response[0].MONDAY;
                document.getElementById('tuesday').innerHTML = response[0].TUESDAY;
                document.getElementById('wednesday').innerHTML = response[0].WEDNESDAY;
                document.getElementById('thursday').innerHTML = response[0].THURSDAY;
                document.getElementById('friday').innerHTML = response[0].FRIDAY;
                document.getElementById('saturday').innerHTML = response[0].SATURDAY;
                document.getElementById('sunday').innerHTML = response[0].SUNDAY;
                document.getElementById('assigned_to').innerHTML = response[0].EMPLOYEE;
            }
        });
    }
    else if(form_type == 'regular work shift schedule form'){
        transaction = 'work shift schedule details';

        var work_shift_id = sessionStorage.getItem('work_shift_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {work_shift_id : work_shift_id, transaction : transaction},
            success: function(response) {
                $('#monday_start_time').val(response[0].MONDAY_START_TIME);
                $('#monday_end_time').val(response[0].MONDAY_END_TIME);
                $('#monday_lunch_start_time').val(response[0].MONDAY_LUNCH_START_TIME);
                $('#monday_lunch_end_time').val(response[0].MONDAY_LUNCH_END_TIME);
                $('#monday_half_day_mark').val(response[0].MONDAY_HALF_DAY_MARK);
                $('#monday_late_mark').val(response[0].MONDAY_LATE_MARK);

                $('#tuesday_start_time').val(response[0].TUESDAY_START_TIME);
                $('#tuesday_end_time').val(response[0].TUESDAY_END_TIME);
                $('#tuesday_lunch_start_time').val(response[0].TUESDAY_LUNCH_START_TIME);
                $('#tuesday_lunch_end_time').val(response[0].TUESDAY_LUNCH_END_TIME);
                $('#tuesday_half_day_mark').val(response[0].TUESDAY_HALF_DAY_MARK);
                $('#tuesday_late_mark').val(response[0].TUESDAY_LATE_MARK);

                $('#wednesday_start_time').val(response[0].WEDNESDAY_START_TIME);
                $('#wednesday_end_time').val(response[0].WEDNESDAY_END_TIME);
                $('#wednesday_lunch_start_time').val(response[0].WEDNESDAY_LUNCH_START_TIME);
                $('#wednesday_lunch_end_time').val(response[0].WEDNESDAY_LUNCH_END_TIME);
                $('#wednesday_half_day_mark').val(response[0].WEDNESDAY_HALF_DAY_MARK);
                $('#wednesday_late_mark').val(response[0].WEDNESDAY_LATE_MARK);

                $('#thursday_start_time').val(response[0].THURSDAY_START_TIME);
                $('#thursday_end_time').val(response[0].THURSDAY_END_TIME);
                $('#thursday_lunch_start_time').val(response[0].THURSDAY_LUNCH_START_TIME);
                $('#thursday_lunch_end_time').val(response[0].THURSDAY_LUNCH_END_TIME);
                $('#thursday_half_day_mark').val(response[0].THURSDAY_HALF_DAY_MARK);
                $('#thursday_late_mark').val(response[0].THURSDAY_LATE_MARK);

                $('#friday_start_time').val(response[0].FRIDAY_START_TIME);
                $('#friday_end_time').val(response[0].FRIDAY_END_TIME);
                $('#friday_lunch_start_time').val(response[0].FRIDAY_LUNCH_START_TIME);
                $('#friday_lunch_end_time').val(response[0].FRIDAY_LUNCH_END_TIME);
                $('#friday_half_day_mark').val(response[0].FRIDAY_HALF_DAY_MARK);
                $('#friday_late_mark').val(response[0].FRIDAY_LATE_MARK);

                $('#saturday_start_time').val(response[0].SATURDAY_START_TIME);
                $('#saturday_end_time').val(response[0].SATURDAY_END_TIME);
                $('#saturday_lunch_start_time').val(response[0].SATURDAY_LUNCH_START_TIME);
                $('#saturday_lunch_end_time').val(response[0].SATURDAY_LUNCH_END_TIME);
                $('#saturday_half_day_mark').val(response[0].SATURDAY_HALF_DAY_MARK);
                $('#saturday_late_mark').val(response[0].SATURDAY_LATE_MARK);

                $('#sunday_start_time').val(response[0].SUNDAY_START_TIME);
                $('#sunday_end_time').val(response[0].SUNDAY_END_TIME);
                $('#sunday_lunch_start_time').val(response[0].SUNDAY_LUNCH_START_TIME);
                $('#sunday_lunch_end_time').val(response[0].SUNDAY_LUNCH_END_TIME);
                $('#sunday_half_day_mark').val(response[0].SUNDAY_HALF_DAY_MARK);
                $('#sunday_late_mark').val(response[0].SUNDAY_LATE_MARK);

                $('#work_shift_id').val(work_shift_id);
            }
        });
    }
    else if(form_type == 'scheduled work shift schedule form'){
        transaction = 'work shift schedule details';

        var work_shift_id = sessionStorage.getItem('work_shift_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {work_shift_id : work_shift_id, transaction : transaction},
            success: function(response) {
                $('#start_date').val(response[0].START_DATE);
                $('#end_date').val(response[0].END_DATE);

                $('#monday_start_time').val(response[0].MONDAY_START_TIME);
                $('#monday_end_time').val(response[0].MONDAY_END_TIME);
                $('#monday_lunch_start_time').val(response[0].MONDAY_LUNCH_START_TIME);
                $('#monday_lunch_end_time').val(response[0].MONDAY_LUNCH_END_TIME);
                $('#monday_half_day_mark').val(response[0].MONDAY_HALF_DAY_MARK);
                $('#monday_late_mark').val(response[0].MONDAY_LATE_MARK);

                $('#tuesday_start_time').val(response[0].TUESDAY_START_TIME);
                $('#tuesday_end_time').val(response[0].TUESDAY_END_TIME);
                $('#tuesday_lunch_start_time').val(response[0].TUESDAY_LUNCH_START_TIME);
                $('#tuesday_lunch_end_time').val(response[0].TUESDAY_LUNCH_END_TIME);
                $('#tuesday_half_day_mark').val(response[0].TUESDAY_HALF_DAY_MARK);
                $('#tuesday_late_mark').val(response[0].TUESDAY_LATE_MARK);

                $('#wednesday_start_time').val(response[0].WEDNESDAY_START_TIME);
                $('#wednesday_end_time').val(response[0].WEDNESDAY_END_TIME);
                $('#wednesday_lunch_start_time').val(response[0].WEDNESDAY_LUNCH_START_TIME);
                $('#wednesday_lunch_end_time').val(response[0].WEDNESDAY_LUNCH_END_TIME);
                $('#wednesday_half_day_mark').val(response[0].WEDNESDAY_HALF_DAY_MARK);
                $('#wednesday_late_mark').val(response[0].WEDNESDAY_LATE_MARK);

                $('#thursday_start_time').val(response[0].THURSDAY_START_TIME);
                $('#thursday_end_time').val(response[0].THURSDAY_END_TIME);
                $('#thursday_lunch_start_time').val(response[0].THURSDAY_LUNCH_START_TIME);
                $('#thursday_lunch_end_time').val(response[0].THURSDAY_LUNCH_END_TIME);
                $('#thursday_half_day_mark').val(response[0].THURSDAY_HALF_DAY_MARK);
                $('#thursday_late_mark').val(response[0].THURSDAY_LATE_MARK);

                $('#friday_start_time').val(response[0].FRIDAY_START_TIME);
                $('#friday_end_time').val(response[0].FRIDAY_END_TIME);
                $('#friday_lunch_start_time').val(response[0].FRIDAY_LUNCH_START_TIME);
                $('#friday_lunch_end_time').val(response[0].FRIDAY_LUNCH_END_TIME);
                $('#friday_half_day_mark').val(response[0].FRIDAY_HALF_DAY_MARK);
                $('#friday_late_mark').val(response[0].FRIDAY_LATE_MARK);

                $('#saturday_start_time').val(response[0].SATURDAY_START_TIME);
                $('#saturday_end_time').val(response[0].SATURDAY_END_TIME);
                $('#saturday_lunch_start_time').val(response[0].SATURDAY_LUNCH_START_TIME);
                $('#saturday_lunch_end_time').val(response[0].SATURDAY_LUNCH_END_TIME);
                $('#saturday_half_day_mark').val(response[0].SATURDAY_HALF_DAY_MARK);
                $('#saturday_late_mark').val(response[0].SATURDAY_LATE_MARK);

                $('#sunday_start_time').val(response[0].SUNDAY_START_TIME);
                $('#sunday_end_time').val(response[0].SUNDAY_END_TIME);
                $('#sunday_lunch_start_time').val(response[0].SUNDAY_LUNCH_START_TIME);
                $('#sunday_lunch_end_time').val(response[0].SUNDAY_LUNCH_END_TIME);
                $('#sunday_half_day_mark').val(response[0].SUNDAY_HALF_DAY_MARK);
                $('#sunday_late_mark').val(response[0].SUNDAY_LATE_MARK);

                $('#work_shift_id').val(work_shift_id);
            }
        });
    }
    else if(form_type == 'assign work shift form'){
        transaction = 'work shift assignment details';

        var work_shift_id = sessionStorage.getItem('work_shift_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {work_shift_id : work_shift_id, transaction : transaction},
            success: function(response) {
                $('#work_shift_id').val(work_shift_id);

                check_empty(response[0].EMPLOYEE_ID.split(','), '#employee', 'select');
            },
            complete: function(){
                reset_element_validation('#employee');
            }
        });
    }
    else if(form_type == 'employee attendance form'){
        transaction = 'employee attendance details';

        var attendance_id = sessionStorage.getItem('attendance_id');
        var employee_id = $('#employee-id').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {attendance_id : attendance_id, transaction : transaction},
            success: function(response) {
                $('#time_in_date').val(response[0].TIME_IN_DATE);
                $('#time_in').val(response[0].TIME_IN);
                $('#time_out_date').val(response[0].TIME_OUT_DATE);
                $('#time_out').val(response[0].TIME_OUT);
                $('#remarks').val(response[0].REMARKS);
                $('#attendance_id').val(attendance_id);
                $('#employee_id').val(employee_id);
            }
        });
    }
    else if(form_type == 'leave type form'){
        transaction = 'leave type details';
        
        var leave_type_id = sessionStorage.getItem('leave_type_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {leave_type_id : leave_type_id, transaction : transaction},
            success: function(response) {
                $('#leave_type_id').val(leave_type_id);
                $('#leave_name').val(response[0].LEAVE_NAME);
                $('#no_leaves').val(response[0].NO_LEAVES);
                $('#description').val(response[0].DESCRIPTION);

                check_option_exist('#paid_status', response[0].PAID_STATUS, '');
            }
        });
    }
    else if(form_type == 'update leave entitlement form'){
        transaction = 'leave entitlement details';
        
        var leave_entitlement_id = sessionStorage.getItem('leave_entitlement_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {leave_entitlement_id : leave_entitlement_id, transaction : transaction},
            success: function(response) {
                $('#leave_entitlement_id').val(leave_entitlement_id);
                $('#no_leaves').val(response[0].NO_LEAVES);
                $('#start_date').val(response[0].START_DATE);
                $('#end_date').val(response[0].END_DATE);

                check_option_exist('#leave_type', response[0].LEAVE_TYPE, '');
                check_option_exist('#employee_id', response[0].EMPLOYEE_ID, '');
            }
        });
    }
    else if(form_type == 'employee leave entitlement form'){
        transaction = 'leave entitlement details';
        
        var leave_entitlement_id = sessionStorage.getItem('leave_entitlement_id');
        var employee_id = $('#employee-id').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {leave_entitlement_id : leave_entitlement_id, transaction : transaction},
            success: function(response) {
                $('#leave_entitlement_id').val(leave_entitlement_id);
                $('#employee_id').val(employee_id);
                $('#no_leaves').val(response[0].NO_LEAVES);
                $('#start_date').val(response[0].START_DATE);
                $('#end_date').val(response[0].END_DATE);

                check_option_exist('#leave_type', response[0].LEAVE_TYPE, '');
            },
            complete: function(){
                document.getElementById('leave_type').disabled = true;
            }
        });
    }
    else if(form_type == 'leave details'){
        transaction = 'leave details';
        
        var leave_id = sessionStorage.getItem('leave_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {leave_id : leave_id, transaction : transaction},
            success: function(response) {
                $('#employee').text(response[0].EMPLOYEE);
                $('#leave_type').text(response[0].LEAVE_TYPE);
                $('#leave_date').text(response[0].LEAVE_DATE);
                $('#leave_time').text(response[0].LEAVE_TIME);
                $('#leave_reason').text(response[0].LEAVE_REASON);
                $('#leave_status').text(response[0].LEAVE_STATUS);
                $('#decision_by').text(response[0].DECISION_BY);
                $('#decision_remarks').text(response[0].DECISION_REMARKS);
                $('#decision_date').text(response[0].DECISION_DATE);
                $('#decision_time').text(response[0].DECISION_TIME);
            }
        });
    }
    else if(form_type == 'employee file management form'){
        transaction = 'employee file details';
        
        var file_id = sessionStorage.getItem('file_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {file_id : file_id, transaction : transaction},
            success: function(response) {
                $('#update').val('1');
                $('#file_id').val(file_id);
                $('#file_name').val(response[0].FILE_NAME);
                $('#file_date').val(response[0].FILE_DATE);
                $('#remarks').val(response[0].REMARKS);

                check_option_exist('#employee_id', response[0].EMPLOYEE_ID, '');
                check_option_exist('#file_category', response[0].FILE_CATEGORY, '');
            }
        });
    }
    else if(form_type == 'employee file details'){
        transaction = 'employee file summary details';
        
        var file_id = sessionStorage.getItem('file_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {file_id : file_id, transaction : transaction},
            success: function(response) {
                $('#employee').text(response[0].EMPLOYEE_ID);
                $('#file_name').text(response[0].FILE_NAME);
                $('#file_category').text(response[0].FILE_CATEGORY);
                $('#file').html(response[0].FILE_PATH);
                $('#file_date').text(response[0].FILE_DATE);
                $('#upload_date').text(response[0].UPLOAD_DATE);
                $('#upload_time').text(response[0].UPLOAD_TIME);
                $('#upload_by').text(response[0].UPLOAD_BY);
                $('#remarks').text(response[0].REMARKS);
            }
        });
    }
    else if(form_type == 'employee file form'){
        transaction = 'employee file details';
        
        var file_id = sessionStorage.getItem('file_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {file_id : file_id, transaction : transaction},
            success: function(response) {
                $('#update').val('1');
                $('#file_id').val(file_id);
                $('#employee_id').val(response[0].EMPLOYEE_ID);
                $('#file_name').val(response[0].FILE_NAME);
                $('#file_date').val(response[0].FILE_DATE);
                $('#remarks').val(response[0].REMARKS);

                check_option_exist('#file_category', response[0].FILE_CATEGORY, '');
            }
        });
    }
    else if(form_type == 'employee qr code'){
        transaction = 'employee details';

        var employee_id = $('#employee-id').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {employee_id : employee_id, transaction : transaction},
            success: function(response) {
                create_employee_qr_code('qr-code', response[0].FIRST_NAME + ' ' + response[0].LAST_NAME, employee_id, response[0].EMAIL, response[0].PHONE);
            },
        });
    }
    else if(form_type == 'user account update form'){
        transaction = 'user account details';

        var user_code = sessionStorage.getItem('user_code');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {user_code : user_code, transaction : transaction},
            success: function(response) {
                $('#user_code').val(user_code);

                check_empty(response[0].ROLES.split(','), '#role', 'select');
            },
            complete: function(){
                document.getElementById('user_code').readOnly = true;
            }
        });
    }
    else if(form_type == 'user account details'){
        transaction = 'view user account details';
        
        var user_code = sessionStorage.getItem('user_code');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {user_code : user_code, transaction : transaction},
            success: function(response) {
                $('#user_code').text(user_code);
                $('#employee').text(response[0].FILE_AS);
                $('#active').text(response[0].ACTIVE);
                $('#password_expiry_date').html(response[0].PASSWORD_EXPIRY_DATE);
                $('#failed_login').text(response[0].FAILED_LOGIN);
                $('#last_failed_login').text(response[0].LAST_FAILED_LOGIN);
                $('#roles').text(response[0].ROLES);
            }
        });
    }
    else if(form_type == 'holiday form'){
        transaction = 'holiday details';

        var holiday_id = sessionStorage.getItem('holiday_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {holiday_id : holiday_id, transaction : transaction},
            success: function(response) {
                $('#holiday_id').val(holiday_id);
                $('#holiday').val(response[0].HOLIDAY);
                $('#holiday_date').val(response[0].HOLIDAY_DATE);

                check_option_exist('#holiday_type', response[0].HOLIDAY_TYPE, '');

                check_empty(response[0].BRANCH.split(','), '#branch', 'select');
            }
        });
    }
    else if(form_type == 'attendance setting form'){
        transaction = 'attendance setting details';
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {transaction : transaction},
            success: function(response) {
                $('#maximum_attendance').val(response[0].MAX_ATTENDANCE);
                $('#time_out_allowance').val(response[0].TIME_OUT_ALLOWANCE);
                $('#late_allowance').val(response[0].LATE_ALLOWANCE);
                $('#late_policy').val(response[0].LATE_POLICY);
                $('#early_leaving_policy').val(response[0].EARLY_LEAVING_POLICY);
                $('#overtime_policy').val(response[0].OVERTIME_POLICY);

                if(response[0].ATTENDANCE_CREATION_RECOMMENDATION == 1){
                    $('#attendance_creation_recommendation').prop('checked', true);
                }
                else{
                    $('#attendance_creation_recommendation').prop('checked', false);
                }

                if(response[0].ATTENDANCE_ADJUSTMENT_RECOMMENDATION == 1){
                    $('#attendance_adjustment_recommendation').prop('checked', true);
                }
                else{
                    $('#attendance_adjustment_recommendation').prop('checked', false);
                }
               
                check_empty(response[0].CREATION.split(','), '#attendance_creation_approval', 'select');
                check_empty(response[0].ADJUSTMENT.split(','), '#attendance_adjustment_approval', 'select');
            },
            complete: function(){
                if($('#attendance_creation_recommendation').is(':checked')){
                    document.getElementById('attendance_creation_approval').disabled = false;
                }
                else{
                    document.getElementById('attendance_creation_approval').disabled = true;
                }

                if($('#attendance_adjustment_recommendation').is(':checked')){
                    document.getElementById('attendance_adjustment_approval').disabled = false;
                }
                else{
                    document.getElementById('attendance_adjustment_approval').disabled = true;
                }
            }
        });
    }
    else if(form_type == 'time out form'){
        transaction = 'record attendance details';

        var attendance_id = sessionStorage.getItem('attendance_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {attendance_id : attendance_id, transaction : transaction},
            success: function(response) {
                $('#time-in-record').text(response[0].TIME_IN_DATE);
                $('#attendance_id').val(attendance_id);
                get_location('');
            }
        });
    }
    else if(form_type == 'employee attendance details'){
        transaction = 'employee attendance summary details';

        var attendance_id = sessionStorage.getItem('attendance_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {attendance_id : attendance_id, transaction : transaction},
            success: function(response) {
                $('#employee').text(response[0].EMPLOYEE_ID);
                $('#time_in_date').text(response[0].TIME_IN_DATE);
                $('#time_in').text(response[0].TIME_IN);
                document.getElementById('time_in_location').innerHTML = response[0].TIME_IN_LOCATION;
                $('#time_in_ip_address').text(response[0].TIME_IN_IP_ADDRESS);
                $('#time_in_by').text(response[0].TIME_IN_BY);
                document.getElementById('time_in_behavior').innerHTML = response[0].TIME_IN_BEHAVIOR;
                $('#time_in_note').text(response[0].TIME_IN_NOTE);
                $('#time_out_date').text(response[0].TIME_OUT_DATE);
                $('#time_out').text(response[0].TIME_OUT);
                document.getElementById('time_out_location').innerHTML = response[0].TIME_OUT_LOCATION;
                $('#time_out_ip_address').text(response[0].TIME_OUT_IP_ADDRESS);
                $('#time_out_by').text(response[0].TIME_OUT_BY);
                document.getElementById('time_out_behavior').innerHTML = response[0].TIME_OUT_BEHAVIOR;
                $('#time_out_note').text(response[0].TIME_OUT_NOTE);
                $('#late').text(response[0].LATE);
                $('#early_leaving').text(response[0].EARLY_LEAVING);
                $('#overtime').text(response[0].OVERTIME);
                $('#total_working_hours').text(response[0].TOTAL_WORKING_HOURS);
                $('#remarks').text(response[0].REMARKS);
            }
        });
    }
    else if(form_type == 'attendance record form'){
        transaction = 'attendance record details';

        var attendance_id = sessionStorage.getItem('attendance_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {attendance_id : attendance_id, transaction : transaction},
            success: function(response) {
                $('#time_in_date').val(response[0].TIME_IN_DATE);
                $('#time_in').val(response[0].TIME_IN);
                $('#time_out_date').val(response[0].TIME_OUT_DATE);
                $('#time_out').val(response[0].TIME_OUT);
                $('#remarks').val(response[0].REMARKS);
                $('#attendance_id').val(attendance_id);

                check_option_exist('#employee_id', response[0].EMPLOYEE_ID, '');
            },
            complete: function(){
                document.getElementById('employee_id').disabled = true;
            }
        });
    }
    else if(form_type == 'attendance adjustment full form'){
        transaction = 'attendance record details';

        var attendance_id = sessionStorage.getItem('attendance_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {attendance_id : attendance_id, transaction : transaction},
            success: function(response) {
                $('#time_in_date').val(response[0].TIME_IN_DATE);
                $('#time_in').val(response[0].TIME_IN);
                $('#time_out_date').val(response[0].TIME_OUT_DATE);
                $('#time_out').val(response[0].TIME_OUT);
                $('#attendance_id').val(attendance_id);
            }
        });
    }
    else if(form_type == 'attendance adjustment partial form'){
        transaction = 'attendance record details';

        var attendance_id = sessionStorage.getItem('attendance_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {attendance_id : attendance_id, transaction : transaction},
            success: function(response) {
                $('#time_in_date').val(response[0].TIME_IN_DATE);
                $('#time_in').val(response[0].TIME_IN);
                $('#attendance_id').val(attendance_id);
            }
        });
    }
    else if(form_type == 'attendance creation form'){
        transaction = 'attendance creation details';

        var request_id = sessionStorage.getItem('request_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {request_id : request_id, transaction : transaction},
            success: function(response) {
                $('#time_in_date').val(response[0].TIME_IN_DATE);
                $('#time_in').val(response[0].TIME_IN);
                $('#time_out_date').val(response[0].TIME_OUT_DATE);
                $('#time_out').val(response[0].TIME_OUT);
                $('#reason').val(response[0].REASON);
                $('#request_id').val(request_id);
                $('#update').val('1');
            }
        });
    }
    else if(form_type == 'attendance creation details'){
        transaction = 'attendance creation summary details';

        var request_id = sessionStorage.getItem('request_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {request_id : request_id, transaction : transaction},
            success: function(response) {
                $('#employee').text(response[0].EMPLOYEE_ID);
                $('#time_in_date').text(response[0].TIME_IN_DATE);
                $('#time_in').text(response[0].TIME_IN);
                $('#time_out_date').text(response[0].TIME_OUT_DATE);
                $('#time_out').text(response[0].TIME_OUT);
                document.getElementById('attachment').innerHTML = response[0].ATTACHMENT;
                document.getElementById('creation_status').innerHTML = response[0].STATUS;
                document.getElementById('creation_sanction').innerHTML = response[0].SANCTION;
                $('#reason').text(response[0].REASON);
                $('#request_date').text(response[0].REQUEST_DATE);
                $('#request_time').text(response[0].REQUEST_TIME);
                $('#for_recommendation_date').text(response[0].FOR_RECOMMENDATION_DATE);
                $('#for_recommendation_time').text(response[0].FOR_RECOMMENDATION_TIME);
                $('#recommendation_date').text(response[0].RECOMMENDATION_DATE);
                $('#recommendation_time').text(response[0].RECOMMENDATION_TIME);
                $('#recommendation_by').text(response[0].RECOMMENDATION_BY);
                $('#decision_date').text(response[0].DECISION_DATE);
                $('#decision_time').text(response[0].DECISION_TIME);
                $('#decision_remarks').text(response[0].DECISION_REMARKS);
                $('#decision_by').text(response[0].DECISION_BY);
            }
        });
    }
    else if(form_type == 'attendance adjustment details'){
        transaction = 'attendance adjustment summary details';

        var request_id = sessionStorage.getItem('request_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {request_id : request_id, transaction : transaction},
            success: function(response) {
                $('#employee').text(response[0].EMPLOYEE_ID);
                $('#time_in_date').text(response[0].TIME_IN_DATE);
                $('#time_in').text(response[0].TIME_IN);
                $('#time_in_date_adjustment').text(response[0].TIME_IN_DATE_ADJUSTMENT);
                $('#time_in_adjustment').text(response[0].TIME_IN_ADJUSTMENT);
                $('#time_out_date').text(response[0].TIME_OUT_DATE);
                $('#time_out').text(response[0].TIME_OUT);
                $('#time_out_date_adjustment').text(response[0].TIME_OUT_DATE_ADJUSTMENT);
                $('#time_out_adjustment').text(response[0].TIME_OUT_ADJUSTMENT);
                document.getElementById('attachment').innerHTML = response[0].ATTACHMENT;
                document.getElementById('adjustment_status').innerHTML = response[0].STATUS;
                document.getElementById('adjustment_sanction').innerHTML = response[0].SANCTION;
                $('#reason').text(response[0].REASON);
                $('#request_date').text(response[0].REQUEST_DATE);
                $('#request_time').text(response[0].REQUEST_TIME);
                $('#for_recommendation_date').text(response[0].FOR_RECOMMENDATION_DATE);
                $('#for_recommendation_time').text(response[0].FOR_RECOMMENDATION_TIME);
                $('#recommendation_date').text(response[0].RECOMMENDATION_DATE);
                $('#recommendation_time').text(response[0].RECOMMENDATION_TIME);
                $('#recommendation_by').text(response[0].RECOMMENDATION_BY);
                $('#decision_date').text(response[0].DECISION_DATE);
                $('#decision_time').text(response[0].DECISION_TIME);
                $('#decision_remarks').text(response[0].DECISION_REMARKS);
                $('#decision_by').text(response[0].DECISION_BY);
            }
        });
    }
    else if(form_type == 'attendance adjustment full update form'){
        transaction = 'attendance adjustment details';

        var request_id = sessionStorage.getItem('request_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {request_id : request_id, transaction : transaction},
            success: function(response) {
                $('#time_in_date').val(response[0].TIME_IN_DATE_ADJUSTED);
                $('#time_in').val(response[0].TIME_IN_ADJUSTED);
                $('#time_out_date').val(response[0].TIME_OUT_DATE_ADJUSTED);
                $('#time_out').val(response[0].TIME_OUT_ADJUSTED);
                $('#reason').val(response[0].REASON);
                $('#request_id').val(request_id);
            }
        });
    }
    else if(form_type == 'attendance adjustment partial update form'){
        transaction = 'attendance adjustment details';

        var request_id = sessionStorage.getItem('request_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {request_id : request_id, transaction : transaction},
            success: function(response) {
                $('#time_in_date').val(response[0].TIME_IN_DATE_ADJUSTED);
                $('#time_in').val(response[0].TIME_IN_ADJUSTED);
                $('#reason').val(response[0].REASON);
                $('#request_id').val(request_id);
            }
        });
    }
    else if(form_type == 'allowance type form'){
        transaction = 'allowance type details';
        
        var allowance_type_id = sessionStorage.getItem('allowance_type_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {allowance_type_id : allowance_type_id, transaction : transaction},
            success: function(response) {
                $('#allowance_type_id').val(allowance_type_id);
                $('#allowance_type').val(response[0].ALLOWANCE_TYPE);
                $('#description').val(response[0].DESCRIPTION);

                check_option_exist('#taxable', response[0].TAXABLE, '');
            }
        });
    }
    else if(form_type == 'allowance update form'){
        transaction = 'allowance details';
        
        var allowance_id = sessionStorage.getItem('allowance_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {allowance_id : allowance_id, transaction : transaction},
            success: function(response) {
                $('#allowance_id').val(allowance_id);
                $('#amount').val(response[0].AMOUNT);
                $('#payroll_date').val(response[0].PAYROLL_DATE);

                check_option_exist('#employee_id', response[0].EMPLOYEE_ID, '');
                check_option_exist('#allowance_type', response[0].ALLOWANCE_TYPE, '');
            }
        });
    }
    else if(form_type == 'allowance details'){
        transaction = 'allowance summary details';

        var allowance_id = sessionStorage.getItem('allowance_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {allowance_id : allowance_id, transaction : transaction},
            success: function(response) {
                $('#employee').text(response[0].EMPLOYEE_ID);
                $('#allowance_type').text(response[0].ALLOWANCE_TYPE);
                $('#payroll_date').text(response[0].PAYROLL_DATE);
                $('#amount').text(response[0].AMOUNT);
                document.getElementById('payroll').innerHTML = response[0].PAYROLL;
            }
        });
    }
    else if(form_type == 'other income type form'){
        transaction = 'other income type details';
        
        var other_income_type_id = sessionStorage.getItem('other_income_type_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {other_income_type_id : other_income_type_id, transaction : transaction},
            success: function(response) {
                $('#other_income_type_id').val(other_income_type_id);
                $('#other_income_type').val(response[0].OTHER_INCOME_TYPE);
                $('#description').val(response[0].DESCRIPTION);

                check_option_exist('#taxable', response[0].TAXABLE, '');
            }
        });
    }
    else if(form_type == 'other income update form'){
        transaction = 'other income details';
        
        var other_income_id = sessionStorage.getItem('other_income_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {other_income_id : other_income_id, transaction : transaction},
            success: function(response) {
                $('#other_income_id').val(other_income_id);
                $('#amount').val(response[0].AMOUNT);
                $('#payroll_date').val(response[0].PAYROLL_DATE);

                check_option_exist('#employee_id', response[0].EMPLOYEE_ID, '');
                check_option_exist('#other_income_type', response[0].OTHER_INCOME_TYPE, '');
            }
        });
    }
    else if(form_type == 'other income details'){
        transaction = 'other income summary details';

        var other_income_id = sessionStorage.getItem('other_income_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {other_income_id : other_income_id, transaction : transaction},
            success: function(response) {
                $('#employee').text(response[0].EMPLOYEE_ID);
                $('#other_income_type').text(response[0].OTHER_INCOME_TYPE);
                $('#payroll_date').text(response[0].PAYROLL_DATE);
                $('#amount').text(response[0].AMOUNT);
                document.getElementById('payroll').innerHTML = response[0].PAYROLL;
            }
        });
    }
    else if(form_type == 'deduction type form'){
        transaction = 'deduction type details';
        
        var deduction_type_id = sessionStorage.getItem('deduction_type_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {deduction_type_id : deduction_type_id, transaction : transaction},
            success: function(response) {
                $('#deduction_type_id').val(deduction_type_id);
                $('#deduction_type').val(response[0].DEDUCTION_TYPE);
                $('#description').val(response[0].DESCRIPTION);
            }
        });
    }
    else if(form_type == 'government contribution form'){
        transaction = 'government contribution details';
        
        var government_contribution_id = sessionStorage.getItem('government_contribution_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {government_contribution_id : government_contribution_id, transaction : transaction},
            success: function(response) {
                $('#government_contribution_id').val(government_contribution_id);
                $('#government_contribution').val(response[0].GOVERNMENT_CONTRIBUTION);
                $('#description').val(response[0].DESCRIPTION);
            }
        });
    }
    else if(form_type == 'contribution bracket form'){
        transaction = 'contribution bracket details';
        
        var contribution_bracket_id = sessionStorage.getItem('contribution_bracket_id');
        var government_contribution_id = $('#government-contribution-id').text();
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {contribution_bracket_id : contribution_bracket_id, transaction : transaction},
            success: function(response) {
                $('#contribution_bracket_id').val(contribution_bracket_id);
                $('#government_contribution_id').val(government_contribution_id);
                $('#start_range').val(response[0].START_RANGE);
                $('#end_range').val(response[0].END_RANGE);
                $('#deduction_amount').val(response[0].DEDUCTION_AMOUNT);
            }
        });
    }
    else if(form_type == 'deduction update form'){
        transaction = 'deduction details';
        
        var deduction_id = sessionStorage.getItem('deduction_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {deduction_id : deduction_id, transaction : transaction},
            success: function(response) {
                $('#deduction_id').val(deduction_id);
                $('#amount').val(response[0].AMOUNT);
                $('#payroll_date').val(response[0].PAYROLL_DATE);

                check_option_exist('#employee_id', response[0].EMPLOYEE_ID, '');
                check_option_exist('#deduction_type', response[0].DEDUCTION_TYPE, '');
            }
        });
    }
    else if(form_type == 'deduction details'){
        transaction = 'deduction summary details';

        var deduction_id = sessionStorage.getItem('deduction_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {deduction_id : deduction_id, transaction : transaction},
            success: function(response) {
                $('#employee').text(response[0].EMPLOYEE_ID);
                $('#deduction_type').text(response[0].DEDUCTION_TYPE);
                $('#payroll_date').text(response[0].PAYROLL_DATE);
                $('#amount').text(response[0].AMOUNT);
                document.getElementById('payroll').innerHTML = response[0].PAYROLL;
            }
        });
    }
    else if(form_type == 'contribution deduction update form'){
        transaction = 'contribution deduction details';
        
        var contribution_deduction_id = sessionStorage.getItem('contribution_deduction_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {contribution_deduction_id : contribution_deduction_id, transaction : transaction},
            success: function(response) {
                $('#contribution_deduction_id').val(contribution_deduction_id);
                $('#payroll_date').val(response[0].PAYROLL_DATE);

                check_option_exist('#employee_id', response[0].EMPLOYEE_ID, '');
                check_option_exist('#government_contribution', response[0].GOVERNMENT_CONTRIBUTION_TYPE, '');
            }
        });
    }
    else if(form_type == 'contribution deduction details'){
        transaction = 'contribution deduction summary details';

        var contribution_deduction_id = sessionStorage.getItem('contribution_deduction_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {contribution_deduction_id : contribution_deduction_id, transaction : transaction},
            success: function(response) {
                $('#employee').text(response[0].EMPLOYEE_ID);
                $('#government_contribution_type').text(response[0].GOVERNMENT_CONTRIBUTION_TYPE);
                $('#payroll_date').text(response[0].PAYROLL_DATE);
                document.getElementById('payroll').innerHTML = response[0].PAYROLL;
            }
        });
    }
    else if(form_type == 'salary update form'){
        transaction = 'salary details';
        
        var salary_id = sessionStorage.getItem('salary_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {salary_id : salary_id, transaction : transaction},
            success: function(response) {
                $('#salary_id').val(salary_id);
                $('#salary_amount').val(response[0].SALARY_AMOUNT);
                $('#hours_per_week').val(response[0].HOURS_PER_WEEK);
                $('#hours_per_day').val(response[0].HOURS_PER_DAY);
                $('#minute_rate').val(response[0].MINUTE_RATE);
                $('#hourly_rate').val(response[0].HOURLY_RATE);
                $('#daily_rate').val(response[0].DAILY_RATE);
                $('#weekly_rate').val(response[0].WEEKLY_RATE);
                $('#bi_weekly_rate').val(response[0].BI_WEEKLY_RATE);
                $('#monthly_rate').val(response[0].MONTHLY_RATE);
                $('#effectivity_date').val(response[0].EFFECTIVITY_DATE);
                $('#remarks').val(response[0].REMARKS);

                check_option_exist('#employee_id', response[0].EMPLOYEE_ID, '');
                check_option_exist('#salary_frequency', response[0].SALARY_FREQUENCY, '');
            }
        });
    }
    else if(form_type == 'salary details'){
        transaction = 'salary summary details';
        
        var salary_id = sessionStorage.getItem('salary_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {salary_id : salary_id, transaction : transaction},
            success: function(response) {
                $('#employee').text(response[0].EMPLOYEE_ID);
                $('#salary_amount').text(response[0].SALARY_AMOUNT);
                $('#salary_frequency').text(response[0].SALARY_FREQUENCY);
                $('#hours_per_week').text(response[0].HOURS_PER_WEEK);
                $('#hours_per_day').text(response[0].HOURS_PER_DAY);
                $('#minute_rate').text(response[0].MINUTE_RATE);
                $('#hourly_rate').text(response[0].HOURLY_RATE);
                $('#daily_rate').text(response[0].DAILY_RATE);
                $('#weekly_rate').text(response[0].WEEKLY_RATE);
                $('#bi_weekly_rate').text(response[0].BI_WEEKLY_RATE);
                $('#monthly_rate').text(response[0].MONTHLY_RATE);
                $('#effectivity_date').text(response[0].EFFECTIVITY_DATE);
                $('#remarks').text(response[0].REMARKS);
            }
        });
    }
    else if(form_type == 'payroll setting form'){
        transaction = 'payroll setting details';
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {transaction : transaction},
            success: function(response) {
                $('#late_deduction_rate').val(response[0].LATE_DEDUCTION_RATE);
                $('#early_leaving_deduction_rate').val(response[0].EARLY_LEAVING_DEDUCTION_RATE);
                $('#overtime_rate').val(response[0].OVERTIME_RATE);
                $('#night_differential_rate').val(response[0].NIGHT_DIFFERENTIAL_RATE);
            }
        });
    }
    else if(form_type == 'payroll group form'){
        transaction = 'payroll group details';
        
        var payroll_group_id = sessionStorage.getItem('payroll_group_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {payroll_group_id : payroll_group_id, transaction : transaction},
            success: function(response) {
                $('#payroll_group_id').val(payroll_group_id);
                $('#payroll_group').val(response[0].PAYROLL_GROUP);
                $('#description').val(response[0].DESCRIPTION);
               
                check_empty(response[0].EMPLOYEE_ID.split(','), '#employee_id', 'select');
            }
        });
    }
    else if(form_type == 'payroll group details'){
        transaction = 'payroll group summary details';
        
        var payroll_group_id = sessionStorage.getItem('payroll_group_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {payroll_group_id : payroll_group_id, transaction : transaction},
            success: function(response) {
                document.getElementById('employee').innerHTML = response[0].EMPLOYEE;
                $('#payroll_group').text(response[0].PAYROLL_GROUP);
                $('#description').text(response[0].DESCRIPTION);
            }
        });
    }
    else if(form_type == 'pay run details'){
        transaction = 'pay run summary details';
        
        var pay_run_id = sessionStorage.getItem('pay_run_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {pay_run_id : pay_run_id, transaction : transaction},
            success: function(response) {
                document.getElementById('payees').innerHTML = response[0].PAYEE;
                document.getElementById('consider_overtime').innerHTML = response[0].CONSIDER_OVERTIME;
                document.getElementById('consider_withholding_tax').innerHTML = response[0].CONSIDER_WITHHOLDING_TAX;
                document.getElementById('pay_run_status').innerHTML = response[0].STATUS;

                $('#pay_run_id').text(pay_run_id);
                $('#start_date').text(response[0].START_DATE);
                $('#end_date').text(response[0].END_DATE);
                $('#payslip_note').text(response[0].PAYSLIP_NOTE);
                $('#generated_date').text(response[0].GENERATION_DATE);
                $('#generated_time').text(response[0].GENERATION_TIME);
                $('#generated_by').text(response[0].GENERATED_BY);
            }
        });
    }
    else if(form_type == 'withholding tax form'){
        transaction = 'withholding tax details';
        
        var withholding_tax_id = sessionStorage.getItem('withholding_tax_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {withholding_tax_id : withholding_tax_id, transaction : transaction},
            success: function(response) {
                $('#withholding_tax_id').val(withholding_tax_id);
                $('#start_range').val(response[0].START_RANGE);
                $('#end_range').val(response[0].END_RANGE);
                $('#fix_compensation_level').val(response[0].FIX_COMPENSATION_LEVEL);
                $('#base_tax').val(response[0].BASE_TAX);
                $('#percent_over').val(response[0].PERCENT_OVER);

                check_option_exist('#salary_frequency', response[0].SALARY_FREQUENCY, '');
            }
        });
    }
    else if(form_type == 'payslip details'){
        transaction = 'payslip summary details';
        
        var payslip_id = sessionStorage.getItem('payslip_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {payslip_id : payslip_id, transaction : transaction},
            success: function(response) {
                document.getElementById('company_details').innerHTML = response[0].COMPANY_DETAILS;
                document.getElementById('generated_date').innerHTML = response[0].GENERATED_DATE;
                document.getElementById('employee_details').innerHTML = response[0].EMPLOYEE_DETAILS;
                document.getElementById('payrun_details').innerHTML = response[0].PAYRUN_DETAILS;
                document.getElementById('earnings_table').innerHTML = response[0].EARNINGS_TABLE;
                document.getElementById('deductions_table').innerHTML = response[0].DEDUCTIONS_TABLE;
                document.getElementById('company_logo').innerHTML = response[0].COMPANY_LOGO;

                $('#payslip_id').text('# ' + payslip_id);
            }
        });
    }
    else if(form_type == 'job category form'){
        transaction = 'job category details';

        var job_category_id = sessionStorage.getItem('job_category_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {job_category_id : job_category_id, transaction : transaction},
            success: function(response) {
                $('#job_category').val(response[0].JOB_CATEGORY);
                $('#description').val(response[0].DESCRIPTION);
                $('#job_category_id').val(job_category_id);
            }
        });
    }
    else if(form_type == 'job type form'){
        transaction = 'job type details';

        var job_type_id = sessionStorage.getItem('job_type_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {job_type_id : job_type_id, transaction : transaction},
            success: function(response) {
                $('#job_type').val(response[0].JOB_TYPE);
                $('#description').val(response[0].DESCRIPTION);
                $('#job_type_id').val(job_type_id);
            }
        });
    }
    else if(form_type == 'recruitment pipeline form'){
        transaction = 'recruitment pipeline details';

        var recruitment_pipeline_id = sessionStorage.getItem('recruitment_pipeline_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {recruitment_pipeline_id : recruitment_pipeline_id, transaction : transaction},
            success: function(response) {
                $('#recruitment_pipeline').val(response[0].RECRUITMENT_PIPELINE);
                $('#description').val(response[0].DESCRIPTION);
                $('#recruitment_pipeline_id').val(recruitment_pipeline_id);
            }
        });
    }
    else if(form_type == 'recruitment pipeline stage form'){
        transaction = 'recruitment pipeline stage details';

        var recruitment_pipeline_stage_id = sessionStorage.getItem('recruitment_pipeline_stage_id');
        var recruitment_pipeline_id = $('#recruitment-pipeline-id').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {recruitment_pipeline_stage_id : recruitment_pipeline_stage_id, transaction : transaction},
            success: function(response) {
                $('#recruitment_pipeline_stage').val(response[0].RECRUITMENT_PIPELINE_STAGE);
                $('#description').val(response[0].DESCRIPTION);
                $('#recruitment_pipeline_id').val(recruitment_pipeline_id);
                $('#recruitment_pipeline_stage_id').val(recruitment_pipeline_stage_id);
            }
        });
    }
    else if(form_type == 'recruitment scorecard form'){
        transaction = 'recruitment scorecard details';

        var recruitment_scorecard_id = sessionStorage.getItem('recruitment_scorecard_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {recruitment_scorecard_id : recruitment_scorecard_id, transaction : transaction},
            success: function(response) {
                $('#recruitment_scorecard').val(response[0].RECRUITMENT_SCORECARD);
                $('#description').val(response[0].DESCRIPTION);
                $('#recruitment_scorecard_id').val(recruitment_scorecard_id);
            }
        });
    }
    else if(form_type == 'recruitment scorecard section form'){
        transaction = 'recruitment scorecard section details';

        var recruitment_scorecard_section_id = sessionStorage.getItem('recruitment_scorecard_section_id');
        var recruitment_scorecard_id = $('#recruitment-scorecard-id').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {recruitment_scorecard_section_id : recruitment_scorecard_section_id, transaction : transaction},
            success: function(response) {
                $('#recruitment_scorecard_section').val(response[0].RECRUITMENT_SCORECARD_SECTION);
                $('#description').val(response[0].DESCRIPTION);
                $('#recruitment_scorecard_id').val(recruitment_scorecard_id);
                $('#recruitment_scorecard_section_id').val(recruitment_scorecard_section_id);
            }
        });
    }
    else if(form_type == 'recruitment scorecard section option form'){
        transaction = 'recruitment scorecard section option details';

        var recruitment_scorecard_section_option_id = sessionStorage.getItem('recruitment_scorecard_section_option_id');
        var recruitment_scorecard_section_id = $('#recruitment-scorecard-section-id').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {recruitment_scorecard_section_option_id : recruitment_scorecard_section_option_id, transaction : transaction},
            success: function(response) {
                $('#recruitment_scorecard_section_option').val(response[0].RECRUITMENT_SCORECARD_SECTION_OPTION);
                $('#recruitment_scorecard_section_id').val(recruitment_scorecard_section_id);
                $('#recruitment_scorecard_section_option_id').val(recruitment_scorecard_section_option_id);
            }
        });
    }
    else if(form_type == 'job form'){
        transaction = 'job details';

        var job_id = sessionStorage.getItem('job_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {job_id : job_id, transaction : transaction},
            success: function(response) {
                $('#job_id').val(job_id);
                $('#job_title').val(response[0].JOB_TITLE);
                $('#salary_amount').val(response[0].SALARY);
                $('#description').val(response[0].DESCRIPTION);

                check_empty(response[0].JOB_CATEGORY, '#job_category', 'select');
                check_empty(response[0].JOB_TYPE, '#job_type', 'select');
                check_empty(response[0].PIPELINE, '#recruitment_pipeline', 'select');
                check_empty(response[0].SCORECARD, '#recruitment_scorecard', 'select');

                check_empty(response[0].TEAM_MEMBER.split(','), '#team_member', 'select');
                check_empty(response[0].BRANCH.split(','), '#branch_id', 'select');
            }
        });
    }
    else if(form_type == 'job details'){
        transaction = 'job summary details';

        var job_id = sessionStorage.getItem('job_id');

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {job_id : job_id, transaction : transaction},
            success: function(response) {
                $('#job_title').text(response[0].JOB_TITLE);
                $('#job_category').text(response[0].JOB_CATEGORY);
                $('#job_type').text(response[0].JOB_TYPE);
                $('#pipeline').text(response[0].PIPELINE);
                $('#scorecard').text(response[0].SCORECARD);
                $('#salary').text(response[0].SALARY);
                $('#description').text(response[0].DESCRIPTION);
                $('#created_date').text(response[0].CREATED_DATE);
                $('#created_time').text(response[0].CREATED_TIME);
                $('#created_by').text(response[0].CREATED_BY);

                document.getElementById('job_status').innerHTML = response[0].STATUS;
                document.getElementById('branch').innerHTML = response[0].BRANCH;
                document.getElementById('team_member').innerHTML = response[0].TEAM_MEMBER;
            }
        });
    }
    else if(form_type == 'job applicant form'){
        transaction = 'job applicant details';
        
        var applicant_id = sessionStorage.getItem('applicant_id');
  
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {applicant_id : applicant_id, transaction : transaction},
            success: function(response) {
                $('#update').val('1');
                $('#applicant_id').val(applicant_id);
                $('#first_name').val(response[0].FIRST_NAME);
                $('#middle_name').val(response[0].MIDDLE_NAME);
                $('#last_name').val(response[0].LAST_NAME);
                $('#application_date').val(response[0].APPLICATION_DATE);
                $('#birthday').val(response[0].BIRTHDAY);
                $('#email').val(response[0].EMAIL);
                $('#phone').val(response[0].PHONE);
                $('#telephone').val(response[0].TELEPHONE);

                check_option_exist('#suffix', response[0].SUFFIX, '');
                check_option_exist('#applied_for', response[0].APPLIED_FOR, '');
                check_option_exist('#gender', response[0].GENDER, '');
            }
        });
    }
}

// Destroy functions
function destroy_datatable(datatable_name){
    $(datatable_name).DataTable().clear().destroy();
}

// Clear
function clear_datatable(datatable_name){
    $(datatable_name).dataTable().fnClearTable();
}

// Re-adjust datatable columns
function readjust_datatable_column(){
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    });

    $('a[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    });

    $('#System-Modal').on('shown.bs.modal', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    });
}

// Truncate functions
function truncate_temporary_table(table_name){
    var transaction = 'truncate temporary table';

    $.ajax({
        url: 'controller.php',
        method: 'POST',
        dataType: 'TEXT',
        data: {table_name : table_name, transaction : transaction},
        success: function(response) {
            if($('#import-attendance-record-datatable').length){
                initialize_temporary_attendance_record_table('#import-attendance-record-datatable', false, true);
            }

            if($('#import-employee-datatable').length){
                initialize_temporary_employee_table('#import-employee-datatable', false, true);
            }

            if($('#import-leave-entitlement-datatable').length){
                initialize_temporary_leave_entitlement_table('#import-leave-entitlement-datatable', false, true);
            }

            if($('#import-leave-datatable').length){
                initialize_temporary_leave_table('#import-leave-datatable', false, true);
            }

            if($('#import-attendance-adjustment-datatable').length){
                initialize_temporary_attendance_adjustment_table('#import-attendance-adjustment-datatable', false, true);
            }

            if($('#import-attendance-creation-datatable').length){
                initialize_temporary_attendance_creation_table('#import-attendance-creation-datatable', false, true);
            }

            if($('#import-allowance-datatable').length){
                initialize_temporary_allowance_table('#import-allowance-datatable', false, true);
            }

            if($('#import-deduction-datatable').length){
                initialize_temporary_deduction_table('#import-deduction-datatable', false, true);
            }

            if($('#import-government-contribution-datatable').length){
                initialize_temporary_government_contribution_table('#import-government-contribution-datatable', false, true);
            }

            if($('#import-contribution-bracket-datatable').length){
                initialize_temporary_contribution_bracket_table('#import-contribution-bracket-datatable', false, true);
            }

            if($('#import-contribution-deduction-datatable').length){
                initialize_temporary_contribution_deduction_table('#import-contribution-deduction-datatable', false, true);
            }

            if($('#import-withholding-tax-datatable').length){
                initialize_temporary_withholding_tax_table('#import-withholding-tax-datatable', false, true);
            }

            if($('#import-other-income-datatable').length){
                initialize_temporary_other_income_table('#import-other-income-datatable', false, true);
            }
        }
    });
}

// Check functions
function check_option_exist(element, option, return_value){
    if ($(element).find('option[value="' + option + '"]').length) {
        $(element).val(option).trigger('change');
    }
    else{
        $(element).val(return_value).trigger('change');
    }
}

function check_empty(value, id, type){
    if(value != '' || value != null){
        if(type == 'select'){
            $(id).val(value).change();
        }
        else if(type == 'text'){
            $(id).text(value);
        }
        else {
            $(id).val(value);
        }
    }
}

function check_table_check_box(){
    var input_elements = [].slice.call(document.querySelectorAll('.datatable-checkbox-children'));
    var checked_value = input_elements.filter(chk => chk.checked).length;

    if(checked_value > 0){
        $('.multiple').removeClass('d-none');
    }
    else{
        $('.multiple').addClass('d-none');
    }
}

function check_table_multiple_button(){
    var input_elements = [].slice.call(document.querySelectorAll('.datatable-checkbox-children'));
    var checked_value = input_elements.filter(chk => chk.checked).length;

    if(checked_value > 0){
        var lock_array = [];
        var cancel_array = [];
        var delete_array = [];
        var reject_array = [];
        var approve_array = [];
        var for_recommendation_array = [];
        var for_approval_array = [];
        var recommend_array = [];
        var active_array = [];
        var paid_array = [];
        var unpaid_array = [];
        var send_array = [];
        var print_array = [];
        
        $(".datatable-checkbox-children").each(function () {
            var cancel_data = $(this).data('cancel');
            var delete_data = $(this).data('delete');
            var for_recommendation_data = $(this).data('for-recommendation');
            var for_approval_data = $(this).data('for-approval');
            var recommend_data = $(this).data('recommend');
            var reject_data = $(this).data('reject');
            var approve_data = $(this).data('approve');
            var lock = $(this).data('lock');
            var active = $(this).data('active');
            var paid = $(this).data('paid');
            var unpaid = $(this).data('unpaid');
            var send = $(this).data('send');
            var print = $(this).data('print');

            if($(this).prop('checked') === true){
                lock_array.push(lock);
                cancel_array.push(cancel_data);
                approve_array.push(approve_data);
                for_approval_array.push(for_approval_data);
                reject_array.push(reject_data);
                delete_array.push(delete_data);
                for_recommendation_array.push(for_recommendation_data);
                recommend_array.push(recommend_data);
                active_array.push(active);
                paid_array.push(paid);
                unpaid_array.push(unpaid);
                send_array.push(send);
                print_array.push(print);
            }
        });

        var cancel_checker = arr => arr.every(v => v === 1);
        var delete_checker = arr => arr.every(v => v === 1);
        var for_recommendation_checker = arr => arr.every(v => v === 1);
        var for_approval_checker = arr => arr.every(v => v === 1);
        var recommend_checker = arr => arr.every(v => v === 1);
        var reject_checker = arr => arr.every(v => v === 1);
        var approve_checker = arr => arr.every(v => v === 1);
        var unlock_checker = arr => arr.every(v => v === 1);
        var lock_checker = arr => arr.every(v => v === 0);
        var activate_checker = arr => arr.every(v => v === 0);
        var deactivate_checker = arr => arr.every(v => v === 1);
        var paid_checker = arr => arr.every(v => v === 1);
        var unpaid_checker = arr => arr.every(v => v === 1);
        var send_checker = arr => arr.every(v => v === 1);
        var print_checker = arr => arr.every(v => v === 1);
        
        if(lock_checker(lock_array) || unlock_checker(lock_array)){
            if(lock_checker(lock_array)){
                $('.multiple-lock').removeClass('d-none');
                $('.multiple-unlock').addClass('d-none');
            }

            if(unlock_checker(lock_array)){
                $('.multiple-lock').addClass('d-none');
                $('.multiple-unlock').removeClass('d-none');
            }
        }
        else{
            $('.multiple-lock').addClass('d-none');
            $('.multiple-unlock').addClass('d-none');
        }

        if(activate_checker(active_array) || deactivate_checker(active_array)){
            if(activate_checker(active_array)){
                $('.multiple-activate').removeClass('d-none');
                $('.multiple-deactivate').addClass('d-none');
            }

            if(deactivate_checker(active_array)){
                $('.multiple-activate').addClass('d-none');
                $('.multiple-deactivate').removeClass('d-none');
            }
        }
        else{
            $('.multiple-activate').addClass('d-none');
            $('.multiple-deactivate').addClass('d-none');
        }
        
        if(for_approval_checker(for_approval_array)){
            $('.multiple-for-approval').removeClass('d-none');
        }
        else{
            $('.multiple-for-approval').addClass('d-none');
        }
        
        if(cancel_checker(cancel_array)){
            $('.multiple-cancel').removeClass('d-none');
        }
        else{
            $('.multiple-cancel').addClass('d-none');
        }
        
        if(reject_checker(reject_array)){
            $('.multiple-reject').removeClass('d-none');
        }
        else{
            $('.multiple-reject').addClass('d-none');
        }
        
        if(approve_checker(approve_array)){
            $('.multiple-approve').removeClass('d-none');
        }
        else{
            $('.multiple-approve').addClass('d-none');
        }
        
        if(delete_checker(delete_array)){
            $('.multiple-delete').removeClass('d-none');
        }
        else{
            $('.multiple-delete').addClass('d-none');
        }
        
        if(for_recommendation_checker(for_recommendation_array)){
            $('.multiple-for-recommendation').removeClass('d-none');
        }
        else{
            $('.multiple-for-recommendation').addClass('d-none');
        }
        
        if(recommend_checker(recommend_array)){
            $('.multiple-recommendation').removeClass('d-none');
        }
        else{
            $('.multiple-recommendation').addClass('d-none');
        }

        if(paid_checker(paid_array)){
            $('.multiple-tag-loan-details-as-paid').removeClass('d-none');
        }
        else{
            $('.multiple-tag-loan-details-as-paid').addClass('d-none');
        }

        if(unpaid_checker(unpaid_array)){
            $('.multiple-tag-loan-details-as-unpaid').removeClass('d-none');
        }
        else{
            $('.multiple-tag-loan-details-as-unpaid').addClass('d-none');
        }

        if(send_checker(send_array)){
            $('.multiple-send').removeClass('d-none');
        }
        else{
            $('.multiple-send').addClass('d-none');
        }

        if(print_checker(print_array)){
            $('.multiple-print').removeClass('d-none');
        }
        else{
            $('.multiple-print').addClass('d-none');
        }
    }
    else{
        $('.multiple-delete').addClass('d-none');
        $('.multiple-cancel').addClass('d-none');
        $('.multiple-for-recommendation').addClass('d-none');
        $('.multiple-for-approval').addClass('d-none');
        $('.multiple-recommendation').addClass('d-none');
        $('.multiple-reject').addClass('d-none');
        $('.multiple-approve').addClass('d-none');
        $('.multiple-lock').addClass('d-none');
        $('.multiple-unlock').addClass('d-none');
        $('.multiple-activate').addClass('d-none');
        $('.multiple-deactivate').addClass('d-none');
        $('.multiple-tag-loan-details-as-paid').addClass('d-none');
        $('.multiple-tag-loan-details-as-unpaid').addClass('d-none');
        $('.multiple-send').addClass('d-none');
        $('.multiple-print').addClass('d-none');
    }
}

// Show alert
function show_alert(title, message, type){
    Swal.fire(title, message, type);
}

function show_alert_event(title, message, type, event){
    Swal.fire(title, message, type).then(function(){ 
            if(event == 'reload'){
                location.reload();
            }
        }
    );
}

function show_alert_confirmation(confirm_title, confirm_text, confirm_icon, confirm_button_text, button_color, confirm_type){
    Swal.fire({
        title: confirm_title,
        text: confirm_text,
        icon: confirm_icon,
        showCancelButton: !0,
        confirmButtonText: confirm_button_text,
        cancelButtonText: "Cancel",
        confirmButtonClass: "btn btn-"+ button_color +" mt-2",
        cancelButtonClass: "btn btn-secondary ms-2 mt-2",
        buttonsStyling: !1
    }).then(function(result) {
        if (result.value) {
            if(confirm_type == 'expired password'){
                var username = $('#username').val();
                
                generate_modal('change password form', 'Change Password', 'R' , '1', '1', 'form', 'change-password-form', '1', username);
            }
        }
    })
}

function create_employee_qr_code(container, name, employee_id, email, mobile){
    document.getElementById(container).innerHTML = '';

    var card = 'BEGIN:VCARD\r\n';
    card += 'VERSION:3.0\r\n';
    card += 'FN:'+ name +'\r\n';
    card += 'EMAIL:' + email +'\r\n';
    card += 'ID NO:[' + employee_id + ']\r\n';

    if(mobile){
        card += 'TEL:' + mobile +'\r\n';
    }
    
    card += 'END:VCARD';

    var qrcode = new QRCode(document.getElementById(container), {
        width: 300,
        height: 300,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H,
    });

    qrcode.makeCode(card);
}

// Hide
function hide_multiple_buttons(){
    $('#datatable-checkbox').prop('checked', false);

    $('.multiple').addClass('d-none');
    $('.multiple-lock').addClass('d-none');
    $('.multiple-unlock').addClass('d-none');
    $('.multiple-activate').addClass('d-none');
    $('.multiple-deactivate').addClass('d-none');
    $('.multiple-approve').addClass('d-none');
    $('.multiple-reject').addClass('d-none');
    $('.multiple-cancel').addClass('d-none');
    $('.multiple-delete').addClass('d-none');
    $('.multiple-cancel').addClass('d-none');
    $('.multiple-for-recommendation').addClass('d-none');
    $('.multiple-recommendation').addClass('d-none');
    $('.multiple-reject').addClass('d-none');
    $('.multiple-approve').addClass('d-none');
    $('.multiple-send').addClass('d-none');
    $('.multiple-print').addClass('d-none');
}

// Form validation rules
// Rule for password strength
$.validator.addMethod('password_strength', function(value) {
    if(value != ''){
        var re = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
        return re.test(value);
    }
    else{
        return true;
    }

}, 'Password must contain at least 1 lowercase, uppercase letter, number, special character and must be 8 characters or longer');

// Rule for legal age
$.validator.addMethod('employee_age', function(value, element, min) {
    var today = new Date();
    var birthDate = new Date(value);
    var age = today.getFullYear() - birthDate.getFullYear();
  
    if (age > min+1) { return true; }
  
    var m = today.getMonth() - birthDate.getMonth();
  
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) { age--; }
  
    return age >= min;
}, 'The employee must be at least 18 years old and above');