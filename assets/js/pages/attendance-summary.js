(function($) {
    'use strict';

    $(function() {
        if($('#attendance-summary-datatable').length){
            var export_attendance_summary = $('#export_attendance_summary').val();

            if(export_attendance_summary > 0){
                initialize_attendance_summary_table('#attendance-summary-datatable', true);
            }
            else{
                initialize_attendance_summary_table('#attendance-summary-datatable');
            }
        }

        if($('#time-in-behavior-doughnut').length && $('#time-out-behavior-doughnut').length){
            intialize_attendance_summary_chart();
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_attendance_summary_table(datatable_name, buttons = false, show_all = false){    
    var username = $('#username').text();
    var type = 'attendance summary table';
    var filter_branch = $('#filter_branch').val();
    var filter_department = $('#filter_department').val();
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var settings;

    var column = [ 
        { 'data' : 'FILE_AS' },
        { 'data' : 'WORKING_DAYS' },
        { 'data' : 'DAYS_WORKED' },
        { 'data' : 'LATE_COUNT' },
        { 'data' : 'TOTAL_LATE' },
        { 'data' : 'EARLY_LEAVING_COUNT' },
        { 'data' : 'TOTAL_EARLY_LEAVING' },
        { 'data' : 'ATTENDANCE_ADJUSTMENT' },
        { 'data' : 'ATTENDANCE_CREATION' },
        { 'data' : 'SANCTIONED_ATTENDANCE_ADJUSTMENT' },
        { 'data' : 'SANCTIONED_ATTENDANCE_CREATION' },
        { 'data' : 'UNSANCTIONED_ATTENDANCE_ADJUSTMENT' },
        { 'data' : 'UNSANCTIONED_ATTENDANCE_CREATION' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '25%', 'aTargets': 0 },
        { 'width': '10%', 'aTargets': 1 },
        { 'width': '10%', 'aTargets': 2 },
        { 'width': '10%', 'aTargets': 3 },
        { 'width': '10%', 'aTargets': 4 },
        { 'width': '10%', 'aTargets': 5 },
        { 'width': '10%', 'aTargets': 6 },
        { 'width': '10%', 'aTargets': 7 },
        { 'width': '10%', 'aTargets': 8 },
        { 'width': '10%', 'aTargets': 9 },
        { 'width': '10%', 'aTargets': 10 },
        { 'width': '10%', 'aTargets': 11 },
        { 'width': '10%', 'aTargets': 12 },
        { 'width': '20%','bSortable': false, 'aTargets': 13},
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date },
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date },
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

function initialize_employee_attendance_table(datatable_name, buttons = false, show_all = false){
    var username = $('#username').text();
    var employee_id = sessionStorage.getItem('employee_id');
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var type = 'attendance record summary table';
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
    ];

    var column_definition = [
        { 'width': '10%', 'aTargets': 0 },
        { 'width': '10%', 'aTargets': 1 },
        { 'width': '10%', 'aTargets': 2 },
        { 'width': '10%', 'aTargets': 3 },
        { 'width': '10%', 'aTargets': 4 },
        { 'width': '10%', 'aTargets': 5 },
        { 'width': '10%', 'aTargets': 6 }
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date},
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date},
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

function initialize_attendance_adjustment_table(datatable_name, buttons = false, show_all = false){

    var username = $('#username').text();
    var type = 'attendance adjustment summary table';
    var employee_id = sessionStorage.getItem('employee_id');
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var settings;

    var column = [ 
        { 'data' : 'TIME_IN_DATE' },
        { 'data' : 'TIME_IN' },
        { 'data' : 'TIME_OUT_DATE' },
        { 'data' : 'TIME_OUT' },
        { 'data' : 'STATUS' },
        { 'data' : 'ATTACHMENT' },
        { 'data' : 'REASON' },
        { 'data' : 'REQUEST_DATE' },
        { 'data' : 'FOR_RECOMMENDATION_DATE' },
        { 'data' : 'RECOMMENDATION_DATE' },
        { 'data' : 'RECOMMENDED_BY' },
        { 'data' : 'APPROVAL_DATE' },
        { 'data' : 'APPROVAL_BY' },
        { 'data' : 'REMARKS' }
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
        { 'width': '10%', 'aTargets': 8 },
        { 'width': '10%', 'aTargets': 9 },
        { 'width': '10%', 'aTargets': 10 },
        { 'width': '10%', 'aTargets': 11 },
        { 'width': '10%', 'aTargets': 12 },
        { 'width': '10%', 'aTargets': 13 }
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date },
                'dataSrc' : ''
            },
            dom:  "<'row'<'col-sm-3'l><'col-sm-6 text-center mb-2'B><'col-sm-3'f>>" +  "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'csv', 'excel', 'pdf'
            ],
            'order': [[ 1, 'desc' ]],
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date },
                'dataSrc' : ''
            },
            'order': [[ 1, 'desc' ]],
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

function initialize_attendance_creation_table(datatable_name, buttons = false, show_all = false){
    var username = $('#username').text();
    var type = 'attendance creation summary table';
    var employee_id = sessionStorage.getItem('employee_id');
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var settings;

    var column = [ 
        { 'data' : 'TIME_IN' },
        { 'data' : 'TIME_OUT' },
        { 'data' : 'STATUS' },
        { 'data' : 'ATTACHMENT' },
        { 'data' : 'REASON' },
        { 'data' : 'REQUEST_DATE' },
        { 'data' : 'FOR_RECOMMENDATION_DATE' },
        { 'data' : 'RECOMMENDATION_DATE' },
        { 'data' : 'RECOMMENDED_BY' },
        { 'data' : 'APPROVAL_DATE' },
        { 'data' : 'APPROVAL_BY' },
        { 'data' : 'REMARKS' }
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
        { 'width': '10%', 'aTargets': 8 },
        { 'width': '10%', 'aTargets': 9 },
        { 'width': '10%', 'aTargets': 10 },
        { 'width': '10%', 'aTargets': 11 }
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date },
                'dataSrc' : ''
            },
            dom:  "<'row'<'col-sm-3'l><'col-sm-6 text-center mb-2'B><'col-sm-3'f>>" +  "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'csv', 'excel', 'pdf'
            ],
            'order': [[ 1, 'desc' ]],
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
                'data': {'type' : type, 'username' : username, 'employee_id' : employee_id, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date },
                'dataSrc' : ''
            },
            'order': [[ 1, 'desc' ]],
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

    $(document).on('click','.view-attendance-summary',function() {
        var employee_id = $(this).data('employee-id');

        sessionStorage.setItem('employee_id', employee_id);

        generate_modal('attendance summary details', 'Attendance Summary Details', 'XL' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#apply-filter',function() {
        initialize_attendance_summary_table('#attendance-summary-datatable');
        intialize_attendance_summary_chart();
    });
}

function intialize_attendance_summary_chart(){
    var transaction = 'attendance summary chart';

    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var filter_branch = $('#filter_branch').val();
    var filter_department = $('#filter_department').val();

    $.ajax({
        url: 'controller.php',
        method: 'POST',
        dataType: 'JSON',
        data: {filter_start_date : filter_start_date, filter_end_date : filter_end_date, filter_branch : filter_branch, filter_department : filter_department, transaction : transaction},
        success: function(response) {
            var time_in_chart_container = document.getElementById('time-in-behavior-doughnut').getContext('2d');
            var time_out_chart_container = document.getElementById('time-out-behavior-doughnut').getContext('2d');
            var attendance_adjustment_container = document.getElementById('attendance-adjustment-doughnut').getContext('2d');
            var attendance_creation_container = document.getElementById('attendance-creation-doughnut').getContext('2d');

            $('#early-statistics').text(response[0].EARLY);
            $('#time-in-regular-statistics').text(response[0].TIME_IN_REGULAR);
            $('#late-statistics').text(response[0].LATE);
            $('#early-leaving-statistics').text(response[0].EARLY_LEAVING);
            $('#time-out-regular-statistics').text(response[0].TIME_OUT_REGULAR);
            $('#attendance-adjustment-sanction-statistics').text(response[0].SANCTIONED_ATTENDANCE_ADJUSTMENT);
            $('#attendance-adjustment-unsanction-statistics').text(response[0].UNSANCTIONED_ATTENDANCE_ADJUSTMENT);
            $('#attendance-creation-sanction-statistics').text(response[0].SANCTIONED_ATTENDANCE_CREATION);
            $('#attendance-creation-unsanction-statistics').text(response[0].UNSANCTIONED_ATTENDANCE_CREATION);

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

            var attendance_adjustment_chart = new Chart(attendance_adjustment_container, {
                type: 'doughnut',
                data: {
                    labels: ['Sanctioned', 'Unsanctioned'],
                    datasets: [
                        { 
                            data: [response[0].SANCTIONED_ATTENDANCE_ADJUSTMENT, response[0].UNSANCTIONED_ATTENDANCE_ADJUSTMENT],
                            backgroundColor: ['#f46a6a', '#34c38f'], 
                            hoverBackgroundColor: ['#f46a6a', '#34c38f'], 
                            hoverBorderColor: '#fff'
                        }
                    ]
                }
            });

            var attendance_creation_chart = new Chart(attendance_creation_container, {
                type: 'doughnut',
                data: {
                    labels: ['Sanctioned', 'Unsanctioned'],
                    datasets: [
                        { 
                            data: [response[0].SANCTIONED_ATTENDANCE_CREATION, response[0].UNSANCTIONED_ATTENDANCE_CREATION],
                            backgroundColor: ['#f46a6a', '#34c38f'], 
                            hoverBackgroundColor: ['#f46a6a', '#34c38f'], 
                            hoverBorderColor: '#fff'
                        }
                    ]
                }
            });
        }
    });
}

