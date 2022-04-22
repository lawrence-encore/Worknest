(function($) {
    'use strict';

    $(function() {
        reset_import_table();

        initialize_click_events();
    });
})(jQuery);

function initialize_temporary_attendance_adjustment_table(datatable_name, buttons = false, show_all = false){    
    var username = $('#username').text();
    var type = 'temporary attendance adjustment table';
    var settings;

    var column = [ 
        { 'data' : 'REQUEST_ID' },
        { 'data' : 'EMPLOYEE_ID' },
        { 'data' : 'ATTENDANCE_ID' },
        { 'data' : 'TIME_IN_DATE_ADJUSTED' },
        { 'data' : 'TIME_IN_ADJUSTED' },
        { 'data' : 'TIME_OUT_DATE_ADJUSTED' },
        { 'data' : 'TIME_OUT_ADJUSTED' },
        { 'data' : 'STATUS' },
        { 'data' : 'REASON' },
        { 'data' : 'FILE_PATH' },
        { 'data' : 'SANCTION' },
        { 'data' : 'REQUEST_DATE' },
        { 'data' : 'REQUEST_TIME' },
        { 'data' : 'FOR_RECOMMENDATION_DATE' },
        { 'data' : 'FOR_RECOMMENDATION_TIME' },
        { 'data' : 'RECOMMENDATION_DATE' },
        { 'data' : 'RECOMMENDATION_TIME' },
        { 'data' : 'RECOMMENDED_BY' },
        { 'data' : 'DECISION_REMARKS' },
        { 'data' : 'DECISION_DATE' },
        { 'data' : 'DECISION_TIME' },
        { 'data' : 'DECISION_BY' }
    ];

    var column_definition = [
        { 'width': '10%', 'aTargets': 0, 'className' : 'request_id' },
        { 'width': '10%', 'aTargets': 1, 'className' : 'employee_id' },
        { 'width': '10%', 'aTargets': 2, 'className' : 'attendance_id' },
        { 'width': '10%', 'aTargets': 3, 'className' : 'time_in_date_adjusted' },
        { 'width': '10%', 'aTargets': 4, 'className' : 'time_in_adjusted' },
        { 'width': '10%', 'aTargets': 5, 'className' : 'time_out_date_adjusted' },
        { 'width': '10%', 'aTargets': 6, 'className' : 'time_out_adjusted' },
        { 'width': '10%', 'aTargets': 7, 'className' : 'status' },
        { 'width': '10%', 'aTargets': 8, 'className' : 'reason' },
        { 'width': '10%', 'aTargets': 9, 'className' : 'file_path' },
        { 'width': '10%', 'aTargets': 10, 'className' : 'sanction' },
        { 'width': '10%', 'aTargets': 11, 'className' : 'request_date' },
        { 'width': '10%', 'aTargets': 12, 'className' : 'request_time' },
        { 'width': '10%', 'aTargets': 13, 'className' : 'for_recommendation_date' },
        { 'width': '10%', 'aTargets': 14, 'className' : 'for_recommendation_time' },
        { 'width': '10%', 'aTargets': 15, 'className' : 'recommendation_date' },
        { 'width': '10%', 'aTargets': 16, 'className' : 'recommendation_time' },
        { 'width': '10%', 'aTargets': 17, 'className' : 'recommended_by' },
        { 'width': '10%', 'aTargets': 18, 'className' : 'decision_remarks' },
        { 'width': '10%', 'aTargets': 19, 'className' : 'decision_date' },
        { 'width': '10%', 'aTargets': 20, 'className' : 'decision_time' },
        { 'width': '10%', 'aTargets': 21, 'className' : 'decision_by' }
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
                'loadingAdjustments': '<div class="spinner-border spinner-border-lg text-info" role="status"><span class="sr-only">Loading...</span></div>'
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
                'loadingAdjustments': '<div class="spinner-border spinner-border-lg text-info" role="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }

    destroy_datatable(datatable_name);
    
    $(datatable_name).dataTable(settings);
}

function initialize_click_events(){
    var username = $('#username').text();

    $(document).on('click','#import-attendance-adjustment',function() {
        generate_modal('import attendance adjustment form', 'Import Attendance Adjustment', 'R' , '0', '1', 'form', 'import-attendance-adjustment-form', '1', username);
    });

    $(document).on('click','#submit-import-attendance-adjustment',function() {
        var request_id = [];
        var employee_id = [];
        var attendance_id = [];
        var time_in_date_adjusted = [];
        var time_in_adjusted = [];
        var time_out_date_adjusted = [];
        var time_out_adjusted = [];
        var status = [];
        var reason = [];
        var file_path = [];
        var sanction = [];
        var request_date = [];
        var request_time = [];
        var for_recommendation_date = [];
        var for_recommendation_time = [];
        var recommendation_date = [];
        var recommendation_time = [];
        var recommended_by = [];
        var decision_remarks = [];
        var decision_date = [];
        var decision_time = [];
        var decision_by = [];

        $('.request_id').each(function(){
            request_id.push($(this).text());
        });

        $('.employee_id').each(function(){
            employee_id.push($(this).text());
        });

        $('.attendance_id').each(function(){
            attendance_id.push($(this).text());
        });

        $('.time_in_date_adjusted').each(function(){
            time_in_date_adjusted.push($(this).text());
        });

        $('.time_in_adjusted').each(function(){
            time_in_adjusted.push($(this).text());
        });

        $('.time_out_date_adjusted').each(function(){
            time_out_date_adjusted.push($(this).text());
        });

        $('.time_out_adjusted').each(function(){
            time_out_adjusted.push($(this).text());
        });

        $('.status').each(function(){
            status.push($(this).text());
        });

        $('.reason').each(function(){
            reason.push($(this).text());
        });

        $('.file_path').each(function(){
            file_path.push($(this).text());
        });

        $('.sanction').each(function(){
            sanction.push($(this).text());
        });

        $('.request_date').each(function(){
            request_date.push($(this).text());
        });

        $('.request_time').each(function(){
            request_time.push($(this).text());
        });

        $('.for_recommendation_date').each(function(){
            for_recommendation_date.push($(this).text());
        });

        $('.for_recommendation_time').each(function(){
            for_recommendation_time.push($(this).text());
        });

        $('.recommendation_date').each(function(){
            recommendation_date.push($(this).text());
        });

        $('.recommendation_time').each(function(){
            recommendation_time.push($(this).text());
        });

        $('.recommended_by').each(function(){
            recommended_by.push($(this).text());
        });

        $('.decision_remarks').each(function(){
            decision_remarks.push($(this).text());
        });

        $('.decision_date').each(function(){
            decision_date.push($(this).text());
        });

        $('.decision_time').each(function(){
            decision_time.push($(this).text());
        });

        $('.decision_by').each(function(){
            decision_by.push($(this).text());
        });

        request_id.splice(0,2);
        employee_id.splice(0,2);
        attendance_id.splice(0,2);
        time_in_date_adjusted.splice(0,2);
        time_in_adjusted.splice(0,2);
        time_out_date_adjusted.splice(0,2);
        time_out_adjusted.splice(0,2);
        status.splice(0,2);
        reason.splice(0,2);
        file_path.splice(0,2);
        sanction.splice(0,2);
        request_date.splice(0,2);
        request_time.splice(0,2);
        for_recommendation_date.splice(0,2);
        for_recommendation_time.splice(0,2);
        recommendation_date.splice(0,2);
        recommendation_time.splice(0,2);
        recommended_by.splice(0,2);
        decision_remarks.splice(0,2);
        decision_date.splice(0,2);
        decision_time.splice(0,2);
        decision_by.splice(0,2);
       
        var transaction = 'import attendance adjustment data';
        var username = $('#username').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'TEXT',
            data: {request_id : request_id, employee_id : employee_id, attendance_id : attendance_id, time_in_date_adjusted : time_in_date_adjusted, time_in_adjusted : time_in_adjusted, time_out_date_adjusted : time_out_date_adjusted, time_out_adjusted : time_out_adjusted, status : status, reason : reason, file_path : file_path, sanction : sanction, request_date : request_date, request_time : request_time, for_recommendation_date : for_recommendation_date, for_recommendation_time : for_recommendation_time, recommendation_date : recommendation_date, recommendation_time : recommendation_time, recommended_by : recommended_by, decision_remarks : decision_remarks, decision_date : decision_date, decision_time : decision_time, decision_by : decision_by, transaction : transaction, username : username},
            success: function(response) {
                if(response === 'Imported'){
                    show_alert('Import Attendance Adjustment Date', 'The attendance adjustments have been imported.', 'success');
                    reset_import_table();
                }
                else{
                    show_alert('Import Attendance Adjustment Data Error', response, 'error');
                }
            }
        });
    });

    $(document).on('click','#clear-import-attendance-adjustment',function() {
        reset_import_table();
    });
}

function reset_import_table(){
    truncate_temporary_table('import attendance adjustment');

    $('#import-attendance-adjustment').removeClass('d-none');
    $('#submit-import-attendance-adjustment').addClass('d-none');
    $('#clear-import-attendance-adjustment').addClass('d-none');
}