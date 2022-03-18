(function($) {
    'use strict';

    $(function() {
        if($('#attendance-adjustment-recommendation-datatable').length){
            initialize_attendance_adjustment_recommendation_table('#attendance-adjustment-recommendation-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_attendance_adjustment_recommendation_table(datatable_name, buttons = false, show_all = false){   
    hide_multiple_buttons();

    var username = $('#username').text();
    var type = 'attendance adjustment recommendation table';
    var filter_attendance_adjustment_status = $('#filter_attendance_adjustment_status').val();
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
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
                'data': {'type' : type, 'username' : username, 'filter_attendance_adjustment_status' : filter_attendance_adjustment_status, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date },
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
                'data': {'type' : type, 'username' : username, 'filter_attendance_adjustment_status' : filter_attendance_adjustment_status, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date },
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

    $(document).on('click','.recommend-attendance-adjustment',function() {
        var request_id = $(this).data('request-id');
        var transaction = 'recommend attendance adjustment';

        Swal.fire({
            title: 'Recommend Attendance Adjustment',
            text: 'Are you sure you want to tag this attendance adjustment recommend?',
            icon: 'warning',
            showCancelButton: !0,
            confirmButtonText: 'Recommend',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-success mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, request_id : request_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Recommended'){
                          show_alert('Recommend Attendance Adjustment', 'The attendance adjustment has been recommended.', 'success');

                          reload_datatable('#attendance-adjustment-recommendation-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Recommend Attendance Adjustment', 'The attendance adjustment does not exist.', 'info');
                        }
                        else{
                          show_alert('Recommend Attendance Adjustment', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#recommend-attendance-adjustment',function() {
        var request_id = [];
        var transaction = 'recommend multiple attendance adjustment';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                request_id.push(this.value);  
            }
        });

        if(request_id.length > 0){
            Swal.fire({
                title: 'Recommend Multiple Attendance Adjustment',
                text: 'Are you sure you want to delete these attendance adjustments?',
                icon: 'warning',
                showCancelButton: !0,
                confirmButtonText: 'Recommend',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-success mt-2',
                cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
                buttonsStyling: !1
            }).then(function(result) {
                if (result.value) {
                    
                    $.ajax({
                        type: 'POST',
                        url: 'controller.php',
                        data: {username : username, request_id : request_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Recommended'){
                                show_alert('Recommend Multiple Attendance Adjustment', 'The attendance adjustments have been recommended.', 'success');
    
                                reload_datatable('#attendance-adjustment-recommendation-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Recommend Multiple Attendance Adjustment', 'The attendance adjustment does not exist.', 'info');
                            }
                            else{
                                show_alert('Recommend Multiple Attendance Adjustment', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Recommend Multiple Attendance Adjustment', 'Please select the attendance adjustments you want to delete.', 'error');
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_attendance_adjustment_recommendation_table('#attendance-adjustment-recommendation-datatable');
    });
}