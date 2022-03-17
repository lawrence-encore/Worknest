(function($) {
    'use strict';

    $(function() {
        if($('#holiday-datatable').length){
            initialize_holiday_table('#holiday-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_holiday_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var type = 'holiday table';
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var filter_holiday_type = $('#filter_holiday_type').val();
    var filter_branch = $('#filter_branch').val();
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'HOLIDAY' },
        { 'data' : 'HOLIDAY_DATE' },
        { 'data' : 'BRANCH' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '34%', 'aTargets': 1 },
        { 'width': '15%', 'aTargets': 2 },
        { 'width': '30%', 'aTargets': 3 },
        { 'width': '20%','bSortable': false, 'aTargets': 4 },
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
                'data': {'type' : type, 'username' : username, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date, 'filter_holiday_type' : filter_holiday_type, 'filter_branch' : filter_branch},
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
                'data': {'type' : type, 'username' : username, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date, 'filter_holiday_type' : filter_holiday_type, 'filter_branch' : filter_branch},
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

    $(document).on('click','#add-holiday',function() {
        generate_modal('holiday form', 'Holiday', 'R' , '0', '1', 'form', 'holiday-form', '1', username);
    });

    $(document).on('click','.update-holiday',function() {
        var holiday_id = $(this).data('holiday-id');

        sessionStorage.setItem('holiday_id', holiday_id);
        
        generate_modal('holiday form', 'Holiday', 'R' , '0', '1', 'form', 'holiday-form', '0', username);
    });
    
    $(document).on('click','.delete-holiday',function() {
        var holiday_id = $(this).data('holiday-id');
        var transaction = 'delete holiday';

        Swal.fire({
            title: 'Delete Holiday',
            text: 'Are you sure you want to delete this holiday?',
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
                    data: {username : username, holiday_id : holiday_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Holiday', 'The holiday has been deleted.', 'success');

                          reload_datatable('#holiday-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Holiday', 'The holiday does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Holiday', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-holiday',function() {
        var holiday_id = [];
        var transaction = 'delete multiple holiday';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                holiday_id.push(this.value);  
            }
        });

        if(holiday_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Holidays',
                text: 'Are you sure you want to delete these holidays?',
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
                        data: {username : username, holiday_id : holiday_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Holidays', 'The holidays have been deleted.', 'success');
    
                                reload_datatable('#holiday-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Holidays', 'The holiday does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Holidays', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Holidays', 'Please select the holidays you want to delete.', 'error');
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_holiday_table('#holiday-datatable');
    });
}