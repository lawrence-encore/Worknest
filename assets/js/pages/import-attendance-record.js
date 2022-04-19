(function($) {
    'use strict';

    $(function() {
        if($('#import-attendance-record-datatable').length){
            truncate_temporary_table('import attendance record');
            initialize_temporary_attendance_record_table('#import-attendance-record-datatable', false, true);
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_temporary_attendance_record_table(datatable_name, buttons = false, show_all = false){    
    var username = $('#username').text();
    var type = 'temporary attendance record table';
    var settings;

    var column = [ 
        { 'data' : 'EMPLOYEE_ID' },
        { 'data' : 'TIME_IN_DATE' },
        { 'data' : 'TIME_IN' },
        { 'data' : 'TIME_OUT_DATE' },
        { 'data' : 'TIME_OUT' },
    ];

    var column_definition = [
        { 'width': '10%', 'aTargets': 0, 'className' : 'employee_id' },
        { 'width': '10%', 'aTargets': 1, 'className' : 'time_in_date' },
        { 'width': '10%', 'aTargets': 2, 'className' : 'time_in' },
        { 'width': '10%', 'aTargets': 3, 'className' : 'time_out_date' },
        { 'width': '10%', 'aTargets': 4, 'className' : 'time_out' },
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
                'data': {'type' : type, 'username' : username},
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
                'data': {'type' : type, 'username' : username},
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

    $(document).on('click','#import-attendance-record',function() {
        generate_modal('import attendance record form', 'Import Attendance Record', 'R' , '0', '1', 'form', 'import-attendance-record-form', '1', username);
    });

    $(document).on('click','#submit-import-attendance-record',function() {
        var employee_id = [];
        var time_in_date = [];
        var time_in = [];
        var time_in_location = [];
        var time_in_ip_address = [];
        var time_in_by = [];
        var time_out_date = [];
        var time_out = [];
        var time_out_location = [];
        var time_out_ip_address = [];
        var time_out_by = [];

        $('.employee_id').each(function(){
            employee_id.push($(this).text());
        });

        $('.time_in_date').each(function(){
            time_in_date.push($(this).text());
        });

        $('.time_in').each(function(){
            time_in.push($(this).text());
        });

        $('.time_in_location').each(function(){
            time_in_location.push($(this).text());
        });

        $('.time_in_ip_address').each(function(){
            time_in_ip_address.push($(this).text());
        });

        $('.time_in_by').each(function(){
            time_in_by.push($(this).text());
        });

        $('.time_out_date').each(function(){
            time_out_date.push($(this).text());
        });

        $('.time_out').each(function(){
            time_out.push($(this).text());
        });

        $('.time_out_location').each(function(){
            time_out_location.push($(this).text());
        });

        $('.time_out_ip_address').each(function(){
            time_out_ip_address.push($(this).text());
        });

        $('.time_out_by').each(function(){
            time_out_by.push($(this).text());
        });

        employee_id.splice(0,2);
        time_in_date.splice(0,2);
        time_in.splice(0,2);
        time_in_location.splice(0,2);
        time_in_ip_address.splice(0,2);
        time_in_by.splice(0,2);
        time_out_date.splice(0,2);
        time_out.splice(0,2);
        time_out_location.splice(0,2);
        time_out_ip_address.splice(0,2);
        time_out_by.splice(0,2);
       
        var transaction = 'import attendance record data';
        var username = $('#username').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'TEXT',
            data: {employee_id : employee_id, time_in_date : time_in_date, time_in :time_in, time_in_location : time_in_location, time_in_ip_address : time_in_ip_address, time_in_by : time_in_by, time_out_date : time_out_date, time_out :time_out, time_out_location : time_out_location, time_out_ip_address : time_out_ip_address, time_out_by : time_out_by, transaction : transaction, username : username},
            success: function(response) {
                if(response === 'Imported'){
                    show_alert('Import Attendance Record Date', 'The attendance records have been imported.', 'success');
                    reset_import_table();
                }
                else{
                    show_alert('Import Attendance Record Data Error', response, 'error');
                }
            }
        });
    });

    $(document).on('click','#clear-import-attendance-record',function() {
        reset_import_table();
    });
}

function reset_import_table(){
    truncate_temporary_table('import attendance record');
    initialize_temporary_attendance_record_table('#import-attendance-record-datatable', false, true);

    $('#import-attendance-record').removeClass('d-none');
    $('#submit-import-attendance-record').addClass('d-none');
    $('#clear-import-attendance-record').addClass('d-none');
}