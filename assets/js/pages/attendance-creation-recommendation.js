(function($) {
    'use strict';

    $(function() {
        if($('#attendance-creation-recommendation-datatable').length){
            initialize_attendance_creation_recommendation_table('#attendance-creation-recommendation-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_attendance_creation_recommendation_table(datatable_name, buttons = false, show_all = false){   
    hide_multiple_buttons();

    var username = $('#username').text();
    var type = 'attendance creation recommendation table';
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'EMPLOYEE_ID' },
        { 'data' : 'TIME_IN' },
        { 'data' : 'TIME_OUT' },
        { 'data' : 'STATUS' },
        { 'data' : 'ATTACHMENT' },
        { 'data' : 'REASON' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '15%', 'aTargets': 1 },
        { 'width': '10%', 'aTargets': 2 },
        { 'width': '10%', 'aTargets': 3 },
        { 'width': '10%', 'aTargets': 4 },
        { 'width': '10%', 'aTargets': 5 },
        { 'width': '29%', 'aTargets': 6 },
        { 'width': '15%','bSortable': false, 'aTargets': 7 },
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
                'data': {'type' : type, 'username' : username, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date },
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
                'data': {'type' : type, 'username' : username, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date },
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

    $(document).on('click','.view-attendance-creation',function() {
        var request_id = $(this).data('request-id');

        sessionStorage.setItem('request_id', request_id);

        generate_modal('attendance creation details', 'Attendance Creation Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','.cancel-attendance-creation',function() {
        var request_id = $(this).data('request-id');

        sessionStorage.setItem('request_id', request_id);
        
        generate_modal('cancel attendance creation form', 'Cancel Attendance Creation', 'R' , '0', '1', 'form', 'cancel-attendance-creation-form', '1', username);
    });

    $(document).on('click','#cancel-attendance-creation',function() {
        var request_id = [];

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                request_id.push(this.value);  
            }
        });

        if(request_id.length > 0){
            sessionStorage.setItem('request_id', request_id);
        }

        generate_modal('cancel multiple attendance creation form', 'Cancel Multiple Attendance Creation', 'R' , '0', '1', 'form', 'cancel-multiple-attendance-creation-form', '1', username);
    });

    $(document).on('click','.recommend-attendance-creation',function() {
        var request_id = $(this).data('request-id');
        var transaction = 'recommend attendance creation';

        Swal.fire({
            title: 'Recommend Attendance Creation',
            text: 'Are you sure you want to recommmend this attendance creation?',
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
                          show_alert('Recommend Attendance Creation', 'The attendance creation has been recommended.', 'success');

                          reload_datatable('#attendance-creation-recommendation-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Recommend Attendance Creation', 'The attendance creation does not exist.', 'info');
                        }
                        else{
                          show_alert('Recommend Attendance Creation', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#recommend-attendance-creation',function() {
        var request_id = [];
        var transaction = 'for recommendation multiple attendance creation';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                request_id.push(this.value);  
            }
        });

        if(request_id.length > 0){
            Swal.fire({
                title: 'Recommend Multiple Attendance Creations',
                text: 'Are you sure you want to delete these attendance creations?',
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
                            if(response === 'For Recommendation'){
                                show_alert('Recommend Multiple Attendance Creations', 'The attendance creations have been recommended.', 'success');
    
                                reload_datatable('#attendance-creation-recommendation-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Recommend Multiple Attendance Creations', 'The attendance creation does not exist.', 'info');
                            }
                            else{
                                show_alert('Recommend Multiple Attendance Creations', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Recommend Multiple Attendance Creations', 'Please select the attendance creations you want to delete.', 'error');
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_attendance_creation_recommendation_table('#attendance-creation-recommendation-datatable');
    });
}