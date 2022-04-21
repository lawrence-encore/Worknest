(function($) {
    'use strict';

    $(function() {
        reset_import_table();

        initialize_click_events();
    });
})(jQuery);

function initialize_temporary_leave_table(datatable_name, buttons = false, show_all = false){    
    var username = $('#username').text();
    var type = 'temporary leave table';
    var settings;

    var column = [ 
        { 'data' : 'EMPLOYEE_ID' },
        { 'data' : 'LEAVE_TYPE' },
        { 'data' : 'LEAVE_DATE' },
        { 'data' : 'START_TIME' },
        { 'data' : 'END_TIME' },
        { 'data' : 'LEAVE_STATUS' },
        { 'data' : 'LEAVE_REASON' },
    ];

    var column_definition = [
        { 'width': '10%', 'aTargets': 0, 'className' : 'employee_id' },
        { 'width': '10%', 'aTargets': 1, 'className' : 'leave_type' },
        { 'width': '10%', 'aTargets': 2, 'className' : 'leave_date' },
        { 'width': '10%', 'aTargets': 3, 'className' : 'start_time' },
        { 'width': '10%', 'aTargets': 4, 'className' : 'end_time' },
        { 'width': '10%', 'aTargets': 5, 'className' : 'leave_status' },
        { 'width': '10%', 'aTargets': 6, 'className' : 'leave_reason' },
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

    $(document).on('click','#import-leave',function() {
        generate_modal('import leave form', 'Import Leave', 'R' , '0', '1', 'form', 'import-leave-form', '1', username);
    });

    $(document).on('click','#submit-import-leave',function() {
        var employee_id = [];
        var leave_type = [];
        var leave_date = [];
        var start_time = [];
        var end_time = [];
        var leave_status = [];
        var leave_reason = [];

        $('.employee_id').each(function(){
            employee_id.push($(this).text());
        });

        $('.leave_type').each(function(){
            leave_type.push($(this).text());
        });

        $('.leave_date').each(function(){
            leave_date.push($(this).text());
        });

        $('.start_time').each(function(){
            start_time.push($(this).text());
        });

        $('.end_time').each(function(){
            end_time.push($(this).text());
        });

        $('.leave_status').each(function(){
            leave_status.push($(this).text());
        });

        $('.leave_reason').each(function(){
            leave_reason.push($(this).text());
        });

        employee_id.splice(0,2);
        leave_type.splice(0,2);
        leave_date.splice(0,2);
        start_time.splice(0,2);
        end_time.splice(0,2);
        leave_status.splice(0,2);
        leave_reason.splice(0,2);
       
        var transaction = 'import leave data';
        var username = $('#username').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'TEXT',
            data: {employee_id : employee_id, leave_type : leave_type, leave_date :leave_date, start_time : start_time, end_time : end_time, leave_status : leave_status, leave_reason :leave_reason, transaction : transaction, username : username},
            success: function(response) {
                if(response === 'Imported'){
                    show_alert('Import Leave Date', 'The leaves have been imported.', 'success');
                    reset_import_table();
                }
                else{
                    show_alert('Import Leave Data Error', response, 'error');
                }
            }
        });
    });

    $(document).on('click','#clear-import-leave',function() {
        reset_import_table();
    });
}

function reset_import_table(){
    truncate_temporary_table('import leave');

    $('#import-leave').removeClass('d-none');
    $('#submit-import-leave').addClass('d-none');
    $('#clear-import-leave').addClass('d-none');
}