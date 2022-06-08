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

        if($('#employee-payroll-summary-datatable').length){
            initialize_employee_payroll_summary_table('#employee-payroll-summary-datatable');
        }

        if($('#employee-file-datatable').length){
            initialize_employee_file_management_table('#employee-file-datatable');
        }

        if($('#time-in-behavior-doughnut').length && $('#time-out-behavior-doughnut').length){
            intialize_attendance_record_chart();
        }

        initialize_on_change_events();
        initialize_click_events();
        intialize_select2_filter();
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" role="status"><span class="sr-only">Loading...</span></div>'
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" role="status"><span class="sr-only">Loading...</span></div>'
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" role="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }

    destroy_datatable(datatable_name);
    
    $(datatable_name).dataTable(settings);
}

function initialize_employee_attendance_table(datatable_name, buttons = false, show_all = false){
    var username = $('#username').text();
    var employee_id = $('#employee-id').text();
    var filter_attendance_record_start_date = $('#filter_attendance_record_start_date').val();
    var filter_attendance_record_end_date = $('#filter_attendance_record_end_date').val();
    var filter_attendance_record_time_in_behavior = $('#filter_attendance_record_time_in_behavior').val();
    var filter_attendance_record_time_out_behavior = $('#filter_attendance_record_time_out_behavior').val();
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id, 'filter_attendance_record_start_date' : filter_attendance_record_start_date, 'filter_attendance_record_end_date' : filter_attendance_record_end_date, 'filter_attendance_record_time_in_behavior' : filter_attendance_record_time_in_behavior, 'filter_attendance_record_time_out_behavior' : filter_attendance_record_time_out_behavior},
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id, 'filter_attendance_record_start_date' : filter_attendance_record_start_date, 'filter_attendance_record_end_date' : filter_attendance_record_end_date, 'filter_attendance_record_time_in_behavior' : filter_attendance_record_time_in_behavior, 'filter_attendance_record_time_out_behavior' : filter_attendance_record_time_out_behavior},
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" role="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }

    destroy_datatable(datatable_name);
    
    $(datatable_name).dataTable(settings);
}

function initialize_employee_leave_entitlement_table(datatable_name, buttons = false, show_all = false){
    var username = $('#username').text();
    var employee_id = $('#employee-id').text();
    var filter_leave_entitlement_start_date = $('#filter_leave_entitlement_start_date').val();
    var filter_leave_entitlement_end_date = $('#filter_leave_entitlement_end_date').val();
    var filter_leave_entitlement_leave_type = $('#filter_leave_entitlement_leave_type').val();
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id, 'filter_leave_entitlement_start_date' : filter_leave_entitlement_start_date, 'filter_leave_entitlement_end_date' : filter_leave_entitlement_end_date, 'filter_leave_entitlement_leave_type' : filter_leave_entitlement_leave_type},
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id, 'filter_leave_entitlement_start_date' : filter_leave_entitlement_start_date, 'filter_leave_entitlement_end_date' : filter_leave_entitlement_end_date, 'filter_leave_entitlement_leave_type' : filter_leave_entitlement_leave_type},
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" role="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }

    destroy_datatable(datatable_name);
    
    $(datatable_name).dataTable(settings);
}

function initialize_employee_leave_table(datatable_name, buttons = false, show_all = false){
    var username = $('#username').text();
    var employee_id = $('#employee-id').text();
    var filter_employee_leave_start_date = $('#filter_employee_leave_start_date').val();
    var filter_employee_leave_end_date = $('#filter_employee_leave_end_date').val();
    var filter_employee_leave_type = $('#filter_employee_leave_type').val();
    var filter_employee_leave_status = $('#filter_employee_leave_status').val();
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id, 'filter_employee_leave_start_date' : filter_employee_leave_start_date, 'filter_employee_leave_end_date' : filter_employee_leave_end_date, 'filter_employee_leave_type' : filter_employee_leave_type, 'filter_employee_leave_status' : filter_employee_leave_status},
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id, 'filter_employee_leave_start_date' : filter_employee_leave_start_date, 'filter_employee_leave_end_date' : filter_employee_leave_end_date, 'filter_employee_leave_type' : filter_employee_leave_type, 'filter_employee_leave_status' : filter_employee_leave_status},
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" role="status"><span class="sr-only">Loading...</span></div>'
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
    var filter_employee_file_start_date = $('#filter_employee_file_start_date').val();
    var filter_employee_file_end_date = $('#filter_employee_file_end_date').val();
    var filter_upload_employee_file_start_date = $('#filter_upload_employee_file_start_date').val();
    var filter_upload_employee_file_end_date = $('#filter_upload_employee_file_end_date').val();
    var filter_employee_file_category = $('#filter_employee_file_category').val();
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id, 'filter_employee_file_start_date' : filter_employee_file_start_date, 'filter_employee_file_end_date' : filter_employee_file_end_date, 'filter_upload_employee_file_start_date' : filter_upload_employee_file_start_date, 'filter_upload_employee_file_end_date' : filter_upload_employee_file_end_date, 'filter_employee_file_category' : filter_employee_file_category },
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id, 'filter_employee_file_start_date' : filter_employee_file_start_date, 'filter_employee_file_end_date' : filter_employee_file_end_date, 'filter_upload_employee_file_start_date' : filter_upload_employee_file_start_date, 'filter_upload_employee_file_end_date' : filter_upload_employee_file_end_date, 'filter_employee_file_category' : filter_employee_file_category },
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

function initialize_employee_payroll_summary_table(datatable_name, buttons = false, show_all = false){
    var username = $('#username').text();
    var type = 'employee payroll summary table';
    var employee_id = $('#employee-id').text();
    var filter_employee_payroll_summary_start_date = $('#filter_employee_payroll_summary_start_date').val();
    var filter_employee_payroll_summary_end_date = $('#filter_employee_payroll_summary_end_date').val();
    var settings;

    var column = [ 
        { 'data' : 'PAY_RUN' },
        { 'data' : 'GROSS_PAY' },
        { 'data' : 'NET_PAY' },
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id, 'filter_employee_payroll_summary_start_date' : filter_employee_payroll_summary_start_date, 'filter_employee_payroll_summary_end_date' : filter_employee_payroll_summary_end_date },
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id, 'filter_employee_payroll_summary_start_date' : filter_employee_payroll_summary_start_date, 'filter_employee_payroll_summary_end_date' : filter_employee_payroll_summary_end_date },
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

    $(document).on('click','#apply-attendance-record-filter',function() {
        initialize_employee_attendance_table('#employee-attendance-datatable');
        intialize_attendance_record_chart();
    });

    $(document).on('click','#apply-employee-leave-filter',function() {
        initialize_employee_leave_table('#employee-leave-datatable');
    });

    $(document).on('click','#apply-employee-leave-entitlement-filter',function() {
        initialize_employee_leave_entitlement_table('#employee-leave-entitlement-datatable');
    });

    $(document).on('click','#apply-employee-file-filter',function() {
        initialize_employee_file_management_table('#employee-file-datatable');
    });

    $(document).on('click','.view-payslip',function() {
        var payslip_id = $(this).data('payslip-id');

        sessionStorage.setItem('payslip_id', payslip_id);

        generate_modal('payslip details', 'Payslip Details', 'XL' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','.send-employee-payslip',function() {
        var payslip_id = $(this).data('payslip-id');
        var transaction = 'send payslip';

        Swal.fire({
            title: 'Send Employee Payslip',
            text: 'Are you sure you want to send this payslip?',
            icon: 'info',
            showCancelButton: !0,
            confirmButtonText: 'Send',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-success mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, payslip_id : payslip_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Sent'){
                          show_alert('Send Payslip', 'The payslip has been sent.', 'success');
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
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','.delete-employee-payslip',function() {
        var payslip_id = $(this).data('payslip-id');
        var transaction = 'delete payslip';

        Swal.fire({
            title: 'Delete Payslip',
            text: 'Are you sure you want to delete this payslip?',
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
                    data: {username : username, payslip_id : payslip_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Payslip', 'The payslip has been deleted.', 'success');

                          reload_datatable('#payroll-summary-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Payslip', 'The payslip does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Payslip', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#filter-employee-payroll-summary',function() {
        initialize_employee_payroll_summary_table('#employee-payroll-summary-datatable');
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

function intialize_select2_filter(){
    if ($('.filter-attendance-record-select2').length) {
        $('.filter-attendance-record-select2').select2({
            dropdownParent: $('#filter-attendance-record')
        });
    }

    if ($('.filter-employee-leave-select2').length) {
        $('.filter-employee-leave-select2').select2({
            dropdownParent: $('#filter-employee-leave')
        });
    }

    if ($('.filter-leave-entitlement-select2').length) {
        $('.filter-leave-entitlement-select2').select2({
            dropdownParent: $('#filter-employee-leave-entitlement')
        });
    }

    if ($('.filter-employee-file-select2').length) {
        $('.filter-employee-file-select2').select2({
            dropdownParent: $('#filter-employee-file')
        });
    }
}

function intialize_attendance_record_chart(){
    var transaction = 'employee attendance record chart';

    var employee_id = $('#employee-id').text();
    var filter_attendance_record_start_date = $('#filter_attendance_record_start_date').val();
    var filter_attendance_record_end_date = $('#filter_attendance_record_end_date').val();

    $.ajax({
        url: 'controller.php',
        method: 'POST',
        dataType: 'JSON',
        data: {employee_id : employee_id, filter_attendance_record_start_date : filter_attendance_record_start_date, filter_attendance_record_end_date : filter_attendance_record_end_date, transaction : transaction},
        success: function(response) {
            var time_in_chart_container = document.getElementById('time-in-behavior-doughnut').getContext('2d');
            var time_out_chart_container = document.getElementById('time-out-behavior-doughnut').getContext('2d');

            $('#early-statistics').text(response[0].EARLY);
            $('#time-in-regular-statistics').text(response[0].TIME_IN_REGULAR);
            $('#late-statistics').text(response[0].LATE);
            $('#early-leaving-statistics').text(response[0].EARLY_LEAVING);
            $('#time-out-regular-statistics').text(response[0].TIME_OUT_REGULAR);
            $('#overtime-statistics').text(response[0].OVERTIME);

            var time_in_chart = new Chart(time_in_chart_container, {
                type: 'doughnut',
                data: {
                    labels: ['Early', 'Regular', 'Late'],
                    datasets: [
                        { 
                            data: [response[0].EARLY, response[0].TIME_IN_REGULAR, response[0].LATE], 
                            backgroundColor: ['#50a5f1', '#34c38f', '#f46a6a'], 
                            hoverBackgroundColor: ['#50a5f1', '#34c38f', '#f46a6a'], 
                            hoverBorderColor: '#fff'
                        }
                    ]
                }
            });

            var time_out_chart = new Chart(time_out_chart_container, {
                type: 'doughnut',
                data: {
                    labels: ['Early Leaving', 'Regular', 'Overtime'],
                    datasets: [
                        { 
                            data: [response[0].EARLY_LEAVING, response[0].TIME_OUT_REGULAR, response[0].OVERTIME],
                            backgroundColor: ['#f46a6a', '#34c38f', '#50a5f1'], 
                            hoverBackgroundColor: ['#f46a6a', '#34c38f', '#50a5f1'], 
                            hoverBorderColor: '#fff'
                        }
                    ]
                }
            });
        }
    });
}