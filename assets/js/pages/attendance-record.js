(function($) {
    'use strict';

    $(function() {
        if($('#attendance-record-datatable').length){
            initialize_attendance_record_table('#attendance-record-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_attendance_record_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var type = 'attendance record table';
    var filter_branch = $('#filter_branch').val();
    var filter_department = $('#filter_department').val();
    var filter_time_in_behavior = $('#filter_time_in_behavior').val();
    var filter_time_out_behavior = $('#filter_time_out_behavior').val();
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'FILE_AS' },
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
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '24%', 'aTargets': 1 },
        { 'width': '10%', 'aTargets': 2 },
        { 'width': '10%', 'aTargets': 3 },
        { 'width': '10%', 'aTargets': 4 },
        { 'width': '10%', 'aTargets': 5 },
        { 'width': '10%', 'aTargets': 6 },
        { 'width': '10%', 'aTargets': 7 },
        { 'width': '10%', 'aTargets': 8 },
        { 'width': '10%', 'aTargets': 9 },
        { 'width': '20%','bSortable': false, 'aTargets': 10},
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_time_in_behavior' : filter_time_in_behavior, 'filter_time_out_behavior' :filter_time_out_behavior, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date },
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_time_in_behavior' : filter_time_in_behavior, 'filter_time_out_behavior' :filter_time_out_behavior, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date },
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

function initialize_click_events(){
    var username = $('#username').text();

    $(document).on('click','.view-employee-attendance',function() {
        var attendance_id = $(this).data('attendance-id');

        sessionStorage.setItem('attendance_id', attendance_id);

        generate_modal('employee attendance details', 'Employee Attendance Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-attendance-record',function() {
        generate_modal('attendance record form', 'Attendance Record', 'R' , '0', '1', 'form', 'attendance-record-form', '1', username);
    });

    $(document).on('click','.update-attendance-record',function() {
        var attendance_id = $(this).data('attendance-id');

        sessionStorage.setItem('attendance_id', attendance_id);
        
        generate_modal('attendance record form', 'Attendance Record', 'R' , '0', '1', 'form', 'attendance-record-form', '0', username);
    });
    
    $(document).on('click','.delete-attendance-record',function() {
        var attendance_id = $(this).data('attendance-id');
        var transaction = 'delete employee attendance';

        Swal.fire({
            title: 'Delete Attendance Record',
            text: 'Are you sure you want to delete this attendance record?',
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
                          show_alert('Delete Attendance Record', 'The attendance record has been deleted.', 'success');

                          reload_datatable('#attendance-record-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Attendance Record', 'The attendance record does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Attendance Record', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-attendance-record',function() {
        var file_id = [];
        var transaction = 'delete multiple attendance record';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                file_id.push(this.value);  
            }
        });

        if(file_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Attendance Record',
                text: 'Are you sure you want to delete these attendance record?',
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
                                show_alert('Delete Multiple Attendance Record', 'The attendance record have been deleted.', 'success');
    
                                reload_datatable('#attendance-record-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Attendance Record', 'The attendance record does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Attendance Record', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Attendance Record', 'Please select the attendance record you want to delete.', 'error');
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_attendance_record_table('#attendance-record-datatable');
    });
}