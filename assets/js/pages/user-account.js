(function($) {
    'use strict';

    $(function() {
        if($('#user-account-datatable').length){
            initialize_user_account_table('#user-account-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_user_account_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var filter_user_account_lock_status = $('#filter_user_account_lock_status').val();
    var filter_department = $('#filter_department').val();
    var filter_user_account_status = $('#filter_user_account_status').val();
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var type = 'user account table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'FILE_AS' },
        { 'data' : 'ACCOUNT_STATUS' },
        { 'data' : 'LOCK_STATUS' },
        { 'data' : 'PASSWORD_EXPIRY_DATE' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '39%', 'aTargets': 1 },
        { 'width': '10%', 'aTargets': 2 },
        { 'width': '10%', 'aTargets': 3 },
        { 'width': '25%', 'aTargets': 4 },
        { 'width': '20%','bSortable': false, 'aTargets': 5 },
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
                'data': {'type' : type, 'username' : username , 'filter_user_account_lock_status' : filter_user_account_lock_status, 'filter_department' : filter_department, 'filter_user_account_status' : filter_user_account_status, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date},
                'dataSrc' : ''
            },
            dom:  "<'row'<'col-sm-3'l><'col-sm-6 text-center mb-2'B><'col-sm-3'f>>" +  "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'csv', 'excel', 'pdf'
            ],
            'order': [[ 1, 'asc' ]],
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
                'data': {'type' : type, 'username' : username , 'filter_user_account_lock_status' : filter_user_account_lock_status, 'filter_department' : filter_department, 'filter_user_account_status' : filter_user_account_status, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date},
                'dataSrc' : ''
            },
            'order': [[ 1, 'asc' ]],
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

function initialize_click_events(){
    var username = $('#username').text();

    $(document).on('click','.view-user-account',function() {
        var user_code = $(this).data('user-code');

        sessionStorage.setItem('user_code', user_code);

        generate_modal('user account details', 'User Account Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-user-account',function() {
        generate_modal('user account form', 'User Account', 'R' , '1', '1', 'form', 'user-account-form', '1', username);
    });

    $(document).on('click','.update-user-account',function() {
        var user_code = $(this).data('user-code');

        sessionStorage.setItem('user_code', user_code);
        
        generate_modal('user account update form', 'User Account', 'R' , '1', '1', 'form', 'user-account-update-form', '0', username);
    });

    $(document).on('click','#password-addon',function() {
        $(this).siblings("input").length && ("password" == $(this).siblings("input").attr("type") ? $(this).siblings("input").attr("type", "input") : $(this).siblings("input").attr("type", "password"));
    });

    $(document).on('click','.unlock-user-account',function() {
        var user_code = $(this).data('user-code');
        var transaction = 'unlock user account';

        Swal.fire({
            title: 'Unlock User Account',
            text: 'Are you sure you want to unlock this user account?',
            icon: 'info',
            showCancelButton: !0,
            confirmButtonText: 'Unlock',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-success mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, user_code : user_code, transaction : transaction},
                    success: function (response) {
                        if(response === 'Unlocked'){
                          show_alert('Unlock User Account', 'The user account has been unlocked.', 'success');

                          reload_datatable('#user-account-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Unlock User Account', 'The user account does not exist.', 'info');
                        }
                        else{
                          show_alert('Unlock User Account', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','.lock-user-account',function() {
        var user_code = $(this).data('user-code');
        var transaction = 'lock user account';

        Swal.fire({
            title: 'Lock User Account',
            text: 'Are you sure you want to lock this user account?',
            icon: 'warning',
            showCancelButton: !0,
            confirmButtonText: 'Lock',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-danger mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, user_code : user_code, transaction : transaction},
                    success: function (response) {
                        if(response === 'Locked'){
                          show_alert('Lock User Account', 'The user account has been locked.', 'success');

                          reload_datatable('#user-account-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Lock User Account', 'The user account does not exist.', 'info');
                        }
                        else{
                          show_alert('Lock User Account', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#lock-user-account',function() {
        var user_code = [];
        var transaction = 'lock multiple user account';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                user_code.push(this.value);  
            }
        });

        if(user_code.length > 0){
            Swal.fire({
                title: 'Lock Multiple User Accounts',
                text: 'Are you sure you want to lock these user accounts?',
                icon: 'warning',
                showCancelButton: !0,
                confirmButtonText: 'Lock',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-danger mt-2',
                cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
                buttonsStyling: !1
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: 'controller.php',
                        data: {username : username, user_code : user_code, transaction : transaction},
                        success: function (response) {
                            if(response === 'Locked'){
                              show_alert('Lock User Accounts', 'The user accounts have been locked.', 'success');
    
                              reload_datatable('#user-account-datatable');
                            }
                            else if(response === 'Not Found'){
                              show_alert('Lock User Accounts', 'The user account does not exist.', 'info');
                            }
                            else{
                              show_alert('Lock User Accounts', response, 'error');
                            }
                        }
                    });
                    return false;
                }
            });
        }
        else{
            show_alert('Lock Multiple User Accounts', 'Please select the user accounts you want to lock.', 'error');
        }
    });

    $(document).on('click','#unlock-user-account',function() {
        var user_code = [];
        var transaction = 'unlock multiple user account';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                user_code.push(this.value);  
            }
        });

        if(user_code.length > 0){
            Swal.fire({
                title: 'Unlock Multiple User Accounts',
                text: 'Are you sure you want to unlock these user accounts?',
                icon: 'info',
                showCancelButton: !0,
                confirmButtonText: 'Unlock',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-success mt-2',
                cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
                buttonsStyling: !1
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: 'controller.php',
                        data: {username : username, user_code : user_code, transaction : transaction},
                        success: function (response) {
                            if(response === 'Unlocked'){
                              show_alert('Unlock User Accounts', 'The user accounts have been unlocked.', 'success');
    
                              reload_datatable('#user-account-datatable');
                            }
                            else if(response === 'Not Found'){
                              show_alert('Unlock User Accounts', 'The user account does not exist.', 'info');
                            }
                            else{
                              show_alert('Unlock User Accounts', response, 'error');
                            }
                        }
                    });
                    return false;
                }
            });
        }
        else{
            show_alert('Unlock Multiple User Accounts', 'Please select the user accounts you want to unlock.', 'error');
        }
    });

    $(document).on('click','.activate-user-account',function() {
        var user_code = $(this).data('user-code');
        var transaction = 'activate user account';

        Swal.fire({
            title: 'Activate User Account',
            text: 'Are you sure you want to activate this user account?',
            icon: 'info',
            showCancelButton: !0,
            confirmButtonText: 'Activate',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-success mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, user_code : user_code, transaction : transaction},
                    success: function (response) {
                        if(response === 'Activated'){
                          show_alert('Activate User Account', 'The user account has been activated.', 'success');

                          reload_datatable('#user-account-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Activate User Account', 'The user account does not exist.', 'info');
                        }
                        else{
                          show_alert('Activate User Account', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','.deactivate-user-account',function() {
        var user_code = $(this).data('user-code');
        var transaction = 'deactivate user account';

        Swal.fire({
            title: 'Deactivate User Account',
            text: 'Are you sure you want to deactivate this user account?',
            icon: 'warning',
            showCancelButton: !0,
            confirmButtonText: 'Deactivate',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-danger mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, user_code : user_code, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deactivated'){
                          show_alert('Deactivate User Account', 'The user account has been deactivated.', 'success');

                          reload_datatable('#user-account-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Deactivate User Account', 'The user account does not exist.', 'info');
                        }
                        else{
                          show_alert('Deactivate User Account', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#activate-user-account',function() {
        var user_code = [];
        var transaction = 'activate multiple user account';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                user_code.push(this.value);  
            }
        });

        if(user_code.length > 0){
            Swal.fire({
                title: 'Activate Multiple User Accounts',
                text: 'Are you sure you want to activate these user accounts?',
                icon: 'info',
                showCancelButton: !0,
                confirmButtonText: 'Activate',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-success mt-2',
                cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
                buttonsStyling: !1
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: 'controller.php',
                        data: {username : username, user_code : user_code, transaction : transaction},
                        success: function (response) {
                            if(response === 'Activated'){
                              show_alert('Activate Multiple User Accounts', 'The user accounts have been activated.', 'success');
    
                              reload_datatable('#user-account-datatable');
                            }
                            else if(response === 'Not Found'){
                              show_alert('Activate Multiple User Accounts', 'The user account does not exist.', 'info');
                            }
                            else{
                              show_alert('Activate Multiple User Accounts', response, 'error');
                            }
                        }
                    });
                    return false;
                }
            });
        }
        else{
            show_alert('Activate Multiple User Accounts', 'Please select the user accounts you want to activate.', 'error');
        }
    });

    $(document).on('click','#deactivate-user-account',function() {
        var user_code = [];
        var transaction = 'deactivate multiple user account';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                user_code.push(this.value);  
            }
        });

        if(user_code.length > 0){
            Swal.fire({
                title: 'Deactivate Multiple User Accounts',
                text: 'Are you sure you want to deactivate these user accounts?',
                icon: 'warning',
                showCancelButton: !0,
                confirmButtonText: 'Deactivate',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-danger mt-2',
                cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
                buttonsStyling: !1
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: 'controller.php',
                        data: {username : username, user_code : user_code, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deactivated'){
                              show_alert('Deactivate Multiple User Account', 'The user accounts have been deactivated.', 'success');
    
                              reload_datatable('#user-account-datatable');
                            }
                            else if(response === 'Not Found'){
                              show_alert('Deactivate Multiple User Account', 'The user account does not exist.', 'info');
                            }
                            else{
                              show_alert('Deactivate Multiple User Account', response, 'error');
                            }
                        }
                    });
                    return false;
                }
            });
        }
        else{
            show_alert('Deactivate Multiple User Accounts', 'Please select the user accounts you want to deactivate.', 'error');
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_user_account_table('#user-account-datatable');
    });
}