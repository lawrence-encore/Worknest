(function($) {
    'use strict';

    $(function() {
        if($('#attendance-adjustment-approval-datatable').length){
            initialize_attendance_adjustment_approval_table('#attendance-adjustment-approval-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_attendance_adjustment_approval_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();

    var username = $('#username').text();
    var type = 'attendance adjustment approval table';
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var filter_branch = $('#filter_branch').val();
    var filter_department = $('#filter_department').val();
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'EMPLOYEE_ID' },
        { 'data' : 'TIME_IN_DATE' },
        { 'data' : 'TIME_IN' },
        { 'data' : 'TIME_OUT_DATE' },
        { 'data' : 'TIME_OUT' },
        { 'data' : 'STATUS' },
        { 'data' : 'ATTACHMENT' },
        { 'data' : 'REASON' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '10%', 'aTargets': 1 },
        { 'width': '10%', 'aTargets': 2 },
        { 'width': '10%', 'aTargets': 3 },
        { 'width': '10%', 'aTargets': 4 },
        { 'width': '10%', 'aTargets': 5 },
        { 'width': '10%', 'aTargets': 6 },
        { 'width': '10%', 'aTargets': 7 },
        { 'width': '9%', 'aTargets': 8 },
        { 'width': '20%','bSortable': false, 'aTargets': 9 },
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
                'data': {'type' : type, 'username' : username, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date, 'filter_branch' : filter_branch, 'filter_department' : filter_department },
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
                'data': {'type' : type, 'username' : username, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date, 'filter_branch' : filter_branch, 'filter_department' : filter_department },
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

    $(document).on('click','.view-attendance-adjustment',function() {
        var request_id = $(this).data('request-id');

        sessionStorage.setItem('request_id', request_id);

        generate_modal('attendance adjustment details', 'Attendance Adjustment Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','.cancel-attendance-adjustment',function() {
        var request_id = $(this).data('request-id');

        sessionStorage.setItem('request_id', request_id);
        
        generate_modal('cancel attendance adjustment form', 'Cancel Attendance Adjustment', 'R' , '0', '1', 'form', 'cancel-attendance-adjustment-form', '1', username);
    });

    $(document).on('click','#cancel-attendance-adjustment',function() {
        var request_id = [];

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                request_id.push(this.value);  
            }
        });

        if(request_id.length > 0){
            sessionStorage.setItem('request_id', request_id);
        }

        generate_modal('cancel multiple attendance adjustment form', 'Cancel Multiple Attendance Adjustment', 'R' , '0', '1', 'form', 'cancel-multiple-attendance-adjustment-form', '1', username);
    });

    $(document).on('click','.approve-attendance-adjustment',function() {
        var request_id = $(this).data('request-id');

        sessionStorage.setItem('request_id', request_id);
        
        generate_modal('approve attendance adjustment form', 'Approve Attendance Adjustment', 'R' , '0', '1', 'form', 'approve-attendance-adjustment-form', '1', username);
    });

    $(document).on('click','#approve-attendance-adjustment',function() {
        var request_id = [];

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                request_id.push(this.value);  
            }
        });

        if(request_id.length > 0){
            sessionStorage.setItem('request_id', request_id);
        }

        generate_modal('approve multiple attendance adjustment form', 'Approve Multiple Attendance Adjustment', 'R' , '0', '1', 'form', 'approve-multiple-attendance-adjustment-form', '1', username);
    });

    $(document).on('click','.reject-attendance-adjustment',function() {
        var request_id = $(this).data('request-id');

        sessionStorage.setItem('request_id', request_id);
        
        generate_modal('reject attendance adjustment form', 'Reject Attendance Adjustment', 'R' , '0', '1', 'form', 'reject-attendance-adjustment-form', '1', username);
    });

    $(document).on('click','#reject-attendance-adjustment',function() {
        var request_id = [];

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                request_id.push(this.value);  
            }
        });

        if(request_id.length > 0){
            sessionStorage.setItem('request_id', request_id);
        }

        generate_modal('reject multiple attendance adjustment form', 'Reject Multiple Attendance Adjustment', 'R' , '0', '1', 'form', 'reject-multiple-attendance-adjustment-form', '1', username);
    });

    $(document).on('click','#apply-filter',function() {
        initialize_attendance_adjustment_approval_table('#attendance-adjustment-approval-datatable');
    });
}