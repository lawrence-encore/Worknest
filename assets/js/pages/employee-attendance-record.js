(function($) {
    'use strict';

    $(function() {
        if($('#employee-attendance-record-datatable').length){
            initialize_employee_attendance_record_table('#employee-attendance-record-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_employee_attendance_record_table(datatable_name, buttons = false, show_all = false){    
    var username = $('#username').text();
    var type = 'employee attendance record table';
    var filter_time_in_behavior = $('#filter_time_in_behavior').val();
    var filter_time_out_behavior = $('#filter_time_out_behavior').val();
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
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
        { 'width': '10%', 'aTargets': 7 },
        { 'width': '20%', 'bSortable': false, 'aTargets': 8 },
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
                'data': {'type' : type, 'username' : username, 'filter_time_in_behavior' : filter_time_in_behavior, 'filter_time_out_behavior' :filter_time_out_behavior, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date },
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
                'data': {'type' : type, 'username' : username, 'filter_time_in_behavior' : filter_time_in_behavior, 'filter_time_out_behavior' :filter_time_out_behavior, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date },
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

function initialize_click_events(){
    var username = $('#username').text();

    $(document).on('click','.view-employee-attendance',function() {
        var attendance_id = $(this).data('attendance-id');

        sessionStorage.setItem('attendance_id', attendance_id);

        generate_modal('employee attendance details', 'Employee Attendance Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-attendance-creation',function() {
        generate_modal('attendance creation form', 'Attendance Creation', 'R' , '0', '1', 'form', 'attendance-creation-form', '1', username);
    });

    $(document).on('click','.add-attendance-adjustment-full',function() {
        var attendance_id = $(this).data('attendance-id');

        sessionStorage.setItem('attendance_id', attendance_id);

        generate_modal('attendance adjustment full form', 'Attendance Adjustment', 'R' , '0', '1', 'form', 'attendance-adjustment-full-form', '0', username);
    });

    $(document).on('click','.add-attendance-adjustment-partial',function() {
        var attendance_id = $(this).data('attendance-id');

        sessionStorage.setItem('attendance_id', attendance_id);

        generate_modal('attendance adjustment partial form', 'Attendance Adjustment', 'R' , '0', '1', 'form', 'attendance-adjustment-partial-form', '0', username);
    });

    $(document).on('click','#apply-filter',function() {
        initialize_employee_attendance_record_table('#employee-attendance-record-datatable');
    });
}