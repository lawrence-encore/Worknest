(function($) {
    'use strict';

    $(function() {
        if($('#emergency-contact-datatable').length){
            initialize_emergency_contact_table('#emergency-contact-datatable');
        }

        if($('#employee-address-datatable').length){
            initialize_employee_address_table('#employee-address-datatable');
        }

        if($('#employee-social-datatable').length){
            initialize_employee_social_table('#employee-social-datatable');
        }

        if($('#employee-attendance-datatable').length){
            initialize_employee_attendance_table('#employee-attendance-datatable');
        }

        if($('#employee-leave-entitlement-datatable').length){
            initialize_employee_leave_entitlement_table('#employee-leave-entitlement-datatable');
        }

        if($('#employee-leave-datatable').length){
            initialize_employee_leave_table('#employee-leave-datatable');
        }

        if($('#employee-file-datatable').length){
            initialize_employee_file_management_table('#employee-file-datatable');
        }

        initialize_on_change_events();
        initialize_click_events();
    });
})(jQuery);

function initialize_emergency_contact_table(datatable_name, buttons = false, show_all = false){
    var username = $('#username').text();
    var employee_id = $('#employee-id').text();
    var type = 'emergency contact table';
    var settings;

    var column = [ 
        { 'data' : 'NAME' },
        { 'data' : 'PHONE' },
        { 'data' : 'EMAIL' },
        { 'data' : 'TELEPHONE' },
        { 'data' : 'ADDRESS' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '24%', 'aTargets': 0 },
        { 'width': '12%', 'aTargets': 1 },
        { 'width': '12%', 'aTargets': 2 },
        { 'width': '12%', 'aTargets': 3 },
        { 'width': '20%', 'aTargets': 4 },
        { 'width': '20%', 'bSortable': false, 'aTargets': 5 },
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id},
                'dataSrc' : ''
            },
            dom:  "<'row'<'col-sm-3'l><'col-sm-6 text-center mb-2'B><'col-sm-3'f>>" +  "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'csv', 'excel', 'pdf'
            ],
            'order': [[ 0, 'asc' ]],
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" employee="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }
    else{
        settings = {
            'ajax': { 
                'url' : 'system-generation.php',
                'method' : 'POST',
                'dataType': 'JSON',
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id},
                'dataSrc' : ''
            },
            'order': [[ 0, 'asc' ]],
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" employee="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }

    destroy_datatable(datatable_name);
    
    $(datatable_name).dataTable(settings);
}

function initialize_employee_address_table(datatable_name, buttons = false, show_all = false){
    var username = $('#username').text();
    var employee_id = $('#employee-id').text();
    var type = 'employee address table';
    var settings;

    var column = [ 
        { 'data' : 'ADDRESS_TYPE' },
        { 'data' : 'ADDRESS' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '20%', 'aTargets': 0 },
        { 'width': '60%', 'aTargets': 1 },
        { 'width': '20%', 'bSortable': false, 'aTargets': 2 },
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id},
                'dataSrc' : ''
            },
            dom:  "<'row'<'col-sm-3'l><'col-sm-6 text-center mb-2'B><'col-sm-3'f>>" +  "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'csv', 'excel', 'pdf'
            ],
            'order': [[ 0, 'asc' ]],
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" employee="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }
    else{
        settings = {
            'ajax': { 
                'url' : 'system-generation.php',
                'method' : 'POST',
                'dataType': 'JSON',
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id},
                'dataSrc' : ''
            },
            'order': [[ 0, 'asc' ]],
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" employee="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }

    destroy_datatable(datatable_name);
    
    $(datatable_name).dataTable(settings);
}

function initialize_employee_social_table(datatable_name, buttons = false, show_all = false){
    var username = $('#username').text();
    var employee_id = $('#employee-id').text();
    var type = 'employee social table';
    var settings;

    var column = [ 
        { 'data' : 'SOCIAL_TYPE' },
        { 'data' : 'LINK' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '20%', 'aTargets': 0 },
        { 'width': '60%', 'aTargets': 1 },
        { 'width': '20%', 'bSortable': false, 'aTargets': 2 },
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id},
                'dataSrc' : ''
            },
            dom:  "<'row'<'col-sm-3'l><'col-sm-6 text-center mb-2'B><'col-sm-3'f>>" +  "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'csv', 'excel', 'pdf'
            ],
            'order': [[ 0, 'asc' ]],
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" employee="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }
    else{
        settings = {
            'ajax': { 
                'url' : 'system-generation.php',
                'method' : 'POST',
                'dataType': 'JSON',
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id},
                'dataSrc' : ''
            },
            'order': [[ 0, 'asc' ]],
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" employee="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }

    destroy_datatable(datatable_name);
    
    $(datatable_name).dataTable(settings);
}

function initialize_employee_attendance_table(datatable_name, buttons = false, show_all = false){
    var username = $('#username').text();
    var employee_id = $('#employee-id').text();
    var type = 'employee attendance table';
    var settings;

    var column = [ 
        { 'data' : 'TIME_IN' },
        { 'data' : 'TIME_IN_BEHAVIOR' },
        { 'data' : 'TIME_OUT' },
        { 'data' : 'TIME_OUT_BEHAVIOR' },
        { 'data' : 'LATE' },
        { 'data' : 'EARLY_LEAVING' },
        { 'data' : 'OVERTIME' },
        { 'data' : 'TOTAL_WORKING_HOURS' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '10%', 'aTargets': 0 },
        { 'width': '10%', 'aTargets': 1 },
        { 'width': '10%', 'aTargets': 2 },
        { 'width': '10%', 'aTargets': 3 },
        { 'width': '10%', 'aTargets': 4 },
        { 'width': '10%', 'aTargets': 5 },
        { 'width': '10%', 'aTargets': 6 },
        { 'width': '20%', 'bSortable': false, 'aTargets': 7 },
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id},
                'dataSrc' : ''
            },
            dom:  "<'row'<'col-sm-3'l><'col-sm-6 text-center mb-2'B><'col-sm-3'f>>" +  "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'csv', 'excel', 'pdf'
            ],
            'order': [[ 0, 'desc' ]],
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" employee="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }
    else{
        settings = {
            'ajax': { 
                'url' : 'system-generation.php',
                'method' : 'POST',
                'dataType': 'JSON',
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id},
                'dataSrc' : ''
            },
            'order': [[ 0, 'desc' ]],
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" employee="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }

    destroy_datatable(datatable_name);
    
    $(datatable_name).dataTable(settings);
}

function initialize_employee_leave_entitlement_table(datatable_name, buttons = false, show_all = false){
    var username = $('#username').text();
    var employee_id = $('#employee-id').text();
    var type = 'employee leave entitlement table';
    var settings;

    var column = [ 
        { 'data' : 'LEAVE_NAME' },
        { 'data' : 'COVERAGE' },
        { 'data' : 'ENTITLEMENT' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '30%', 'aTargets': 0 },
        { 'width': '25%', 'aTargets': 1 },
        { 'width': '25%', 'aTargets': 2 },
        { 'width': '20%', 'bSortable': false, 'aTargets': 3 }
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id},
                'dataSrc' : ''
            },
            dom:  "<'row'<'col-sm-3'l><'col-sm-6 text-center mb-2'B><'col-sm-3'f>>" +  "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'csv', 'excel', 'pdf'
            ],
            'order': [[ 0, 'asc' ]],
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" employee="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }
    else{
        settings = {
            'ajax': { 
                'url' : 'system-generation.php',
                'method' : 'POST',
                'dataType': 'JSON',
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id},
                'dataSrc' : ''
            },
            'order': [[ 0, 'asc' ]],
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" employee="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }

    destroy_datatable(datatable_name);
    
    $(datatable_name).dataTable(settings);
}

function initialize_employee_leave_table(datatable_name, buttons = false, show_all = false){
    var username = $('#username').text();
    var employee_id = $('#employee-id').text();
    var type = 'employee leave table';
    var settings;

    var column = [ 
        { 'data' : 'LEAVE_NAME' },
        { 'data' : 'LEAVE_ENTITLMENT' },
        { 'data' : 'LEAVE_DATE' },
        { 'data' : 'LEAVE_STATUS' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '30%', 'aTargets': 0 },
        { 'width': '25%', 'aTargets': 1 },
        { 'width': '25%', 'aTargets': 2 },
        { 'width': '20%', 'bSortable': false, 'aTargets': 3 }
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id},
                'dataSrc' : ''
            },
            dom:  "<'row'<'col-sm-3'l><'col-sm-6 text-center mb-2'B><'col-sm-3'f>>" +  "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'csv', 'excel', 'pdf'
            ],
            'order': [[ 0, 'asc' ]],
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" employee="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }
    else{
        settings = {
            'ajax': { 
                'url' : 'system-generation.php',
                'method' : 'POST',
                'dataType': 'JSON',
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id},
                'dataSrc' : ''
            },
            'order': [[ 0, 'asc' ]],
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" employee="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }

    destroy_datatable(datatable_name);
    
    $(datatable_name).dataTable(settings);
}

function initialize_employee_file_management_table(datatable_name, buttons = false, show_all = false){
    var username = $('#username').text();
    var type = 'employee file table';
    var employee_id = $('#employee-id').text();
    var settings;

    var column = [ 
        { 'data' : 'FILE_NAME' },
        { 'data' : 'FILE_DATE' },
        { 'data' : 'FILE_CATEGORY' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '35%', 'aTargets': 0 },
        { 'width': '20%', 'aTargets': 1 },
        { 'width': '20%', 'aTargets': 2 },
        { 'width': '20%','bSortable': false, 'aTargets': 3},
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id },
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id },
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

    $(document).on('click','#update-employee',function() {
        var employee_id = $(this).data('employee-id');

        sessionStorage.setItem('employee_id', employee_id);
        
        generate_modal('employee form', 'Employee', 'XL' , '0', '1', 'form', 'employee-form', '0', username);
    });

    $(document).on('click','#add-emergency-contact',function() {
        generate_modal('emergency contact form', 'Employee Emergency Contact', 'LG' , '1', '1', 'form', 'emergency-contact-form', '1', username);
    });

    $(document).on('click','.update-emergency-contact',function() {
        var contact_id = $(this).data('contact-id');

        sessionStorage.setItem('contact_id', contact_id);
        
        generate_modal('emergency contact form', 'Employee Emergency Contact', 'LG' , '1', '1', 'form', 'emergency-contact-form', '0', username);
    });
    
    $(document).on('click','.delete-emergency-contact',function() {
        var contact_id = $(this).data('contact-id');
        var transaction = 'delete emergency contact';

        Swal.fire({
            title: 'Delete Emergency Contact',
            text: 'Are you sure you want to delete this emergency contact?',
            icon: 'warning',
            showCancelButton: !0,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-danger mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, contact_id : contact_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Emergency Contact', 'The emergency contact has been deleted.', 'success');

                          reload_datatable('#emergency-contact-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Emergency Contact', 'The emergency contact does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Emergency Contact', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#add-employee-address',function() {
        generate_modal('employee address form', 'Employee Address', 'R' , '1', '1', 'form', 'employee-address-form', '1', username);
    });

    $(document).on('click','.update-employee-address',function() {
        var address_id = $(this).data('address-id');

        sessionStorage.setItem('address_id', address_id);
        
        generate_modal('employee address form', 'Employee Address', 'R' , '1', '1', 'form', 'employee-address-form', '0', username);
    });
    
    $(document).on('click','.delete-employee-address',function() {
        var address_id = $(this).data('address-id');
        var transaction = 'delete employee address';

        Swal.fire({
            title: 'Delete Employee Address',
            text: 'Are you sure you want to delete this employee address?',
            icon: 'warning',
            showCancelButton: !0,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-danger mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, address_id : address_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Employee Address', 'The employee address has been deleted.', 'success');

                          reload_datatable('#employee-address-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Employee Address', 'The employee address does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Employee Address', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#add-employee-social',function() {
        generate_modal('employee social form', 'Employee Social', 'R' , '1', '1', 'form', 'employee-social-form', '1', username);
    });

    $(document).on('click','.update-employee-social',function() {
        var social_id = $(this).data('social-id');

        sessionStorage.setItem('social_id', social_id);
        
        generate_modal('employee social form', 'Employee Social', 'R' , '1', '1', 'form', 'employee-social-form', '0', username);
    });
    
    $(document).on('click','.delete-employee-social',function() {
        var social_id = $(this).data('social-id');
        var transaction = 'delete employee social';

        Swal.fire({
            title: 'Delete Employee Social',
            text: 'Are you sure you want to delete this employee social?',
            icon: 'warning',
            showCancelButton: !0,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-danger mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, social_id : social_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Employee Social', 'The employee social has been deleted.', 'success');

                          reload_datatable('#employee-social-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Employee Social', 'The employee social does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Employee Social', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','.view-employee-attendance',function() {
        var attendance_id = $(this).data('attendance-id');

        sessionStorage.setItem('attendance_id', attendance_id);

        generate_modal('employee attendance details', 'Employee Attendance Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-employee-attendance',function() {
        generate_modal('employee attendance form', 'Employee Attendance', 'R' , '0', '1', 'form', 'employee-attendance-form', '1', username);
    });

    $(document).on('click','.update-employee-attendance',function() {
        var attendance_id = $(this).data('attendance-id');

        sessionStorage.setItem('attendance_id', attendance_id);
        
        generate_modal('employee attendance form', 'Employee Attendance', 'R' , '0', '1', 'form', 'employee-attendance-form', '0', username);
    });
    
    $(document).on('click','.delete-employee-attendance',function() {
        var attendance_id = $(this).data('attendance-id');
        var transaction = 'delete employee attendance';

        Swal.fire({
            title: 'Delete Employee Attendance',
            text: 'Are you sure you want to delete this employee attendance?',
            icon: 'warning',
            showCancelButton: !0,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-danger mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, attendance_id : attendance_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Employee Attendance', 'The employee attendance has been deleted.', 'success');

                          reload_datatable('#employee-attendance-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Employee Attendance', 'The employee attendance does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Employee Attendance', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#add-employee-leave-entitlement',function() {
        generate_modal('employee leave entitlement form', 'Employee Leave Entitlement', 'R' , '0', '1', 'form', 'employee-leave-entitlement-form', '1', username);
    });

    $(document).on('click','.update-employee-leave-entitlement',function() {
        var leave_entitlement_id = $(this).data('leave-entitlement-id');

        sessionStorage.setItem('leave_entitlement_id', leave_entitlement_id);
        
        generate_modal('employee leave entitlement form', 'Employee Leave Entitlement', 'R' , '0', '1', 'form', 'employee-leave-entitlement-form', '0', username);
    });
    
    $(document).on('click','.delete-employee-leave-entitlement',function() {
        var leave_entitlement_id = $(this).data('leave-entitlement-id');
        var transaction = 'delete employee leave entitlement';

        Swal.fire({
            title: 'Delete Employee Attendance',
            text: 'Are you sure you want to delete this employee attendance?',
            icon: 'warning',
            showCancelButton: !0,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-danger mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, leave_entitlement_id : leave_entitlement_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Employee Leave Entitlement', 'The employee leave entitlement has been deleted.', 'success');

                          reload_datatable('#leave-entitlement-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Employee Leave Entitlement', 'The employee leave entitlement does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Employee Leave Entitlement', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','.view-leave',function() {
        var leave_id = $(this).data('leave-id');

        sessionStorage.setItem('leave_id', leave_id);

        generate_modal('leave details', 'Leave Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-employee-leave',function() {
        generate_modal('employee leave form', 'Leave', 'R' , '0', '1', 'form', 'employee-leave-form', '1', username);
    });

    $(document).on('click','.approve-employee-leave',function() {
        var leave_id = $(this).data('leave-id');

        sessionStorage.setItem('leave_id', leave_id);
        
        generate_modal('approve employee leave form', 'Approve Leave', 'R' , '0', '1', 'form', 'approve-leave-form', '1', username);
    });

    $(document).on('click','.reject-employee-leave',function() {
        var leave_id = $(this).data('leave-id');

        sessionStorage.setItem('leave_id', leave_id);
        
        generate_modal('reject employee leave form', 'Reject Leave', 'R' , '0', '1', 'form', 'reject-leave-form', '1', username);
    });

    $(document).on('click','.cancel-employee-leave',function() {
        var leave_id = $(this).data('leave-id');

        sessionStorage.setItem('leave_id', leave_id);
        
        generate_modal('cancel employee leave form', 'Cancel Leave', 'R' , '0', '1', 'form', 'cancel-leave-form', '1', username);
    });
    
    $(document).on('click','.delete-employee-leave',function() {
        var leave_id = $(this).data('leave-id');
        var transaction = 'delete leave';

        Swal.fire({
            title: 'Delete Leave',
            text: 'Are you sure you want to delete this leave?',
            icon: 'warning',
            showCancelButton: !0,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-danger mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, leave_id : leave_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Leave', 'The leave has been deleted.', 'success');

                          reload_datatable('#employee-leave-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Leave', 'The leave does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Leave', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','.view-employee-file',function() {
        var file_id = $(this).data('file-id');

        sessionStorage.setItem('file_id', file_id);

        generate_modal('employee file details', 'Employee File Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-employee-file',function() {
        generate_modal('employee file form', 'Employee File', 'R' , '0', '1', 'form', 'employee-file-form', '1', username);
    });

    $(document).on('click','.update-employee-file',function() {
        var file_id = $(this).data('file-id');

        sessionStorage.setItem('file_id', file_id);
        
        generate_modal('employee file form', 'Employee File', 'R' , '0', '1', 'form', 'employee-file-form', '0', username);
    });

    $(document).on('click','.delete-employee-file',function() {
        var file_id = $(this).data('file-id');
        var transaction = 'delete employee file';

        Swal.fire({
            title: 'Delete Employee File',
            text: 'Are you sure you want to delete this employee file?',
            icon: 'warning',
            showCancelButton: !0,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-danger mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, file_id : file_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Employee File', 'The employee file has been deleted.', 'success');

                          reload_datatable('#employee-file-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Employee File', 'The employee file does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Employee File', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#view-employee-qr-code',function() {
        generate_modal('employee qr code', 'Employee QR Code', 'R' , '1', '0', 'element', '', '0', username);
    });
}

function initialize_on_change_events(){
    $(document).on('change','#province',function() {
        reset_element_validation('#city');

        if(this.value != ''){
            generate_city_option(this.value, '');
            document.getElementById('city').disabled = false;
        }
        else{
            $('#city').empty();

            var newOption = new Option('--', '', false, false);
            $('#city').append(newOption);
            document.getElementById('city').disabled = true;
        }
    });

    $(document).on('change','#leave_duration',function() {
        if(this.value != ''){
            var username = $('#username').text();

            generate_element('leave duration', this.value, 'leave-date-container', '0', username);
        }
        else{
            document.getElementById('leave-date-container').innerHTML = '';
        }
    });
}