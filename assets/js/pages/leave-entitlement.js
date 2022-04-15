(function($) {
    'use strict';

    $(function() {
        if($('#leave-entitlement-datatable').length){
            initialize_leave_entitlement_table('#leave-entitlement-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_leave_entitlement_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var filter_branch = $('#filter_branch').val();
    var filter_department = $('#filter_department').val();
    var filter_leave_type = $('#filter_leave_type').val();
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var type = 'leave entitlement table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'FILE_AS' },
        { 'data' : 'LEAVE_NAME' },
        { 'data' : 'COVERAGE' },
        { 'data' : 'ENTITLEMENT' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '25%', 'aTargets': 1 },
        { 'width': '20%', 'aTargets': 2 },
        { 'width': '20%', 'aTargets': 3 },
        { 'width': '19%', 'aTargets': 4 },
        { 'width': '25%','bSortable': false, 'aTargets': 5 },
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_leave_type' : filter_leave_type, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date},
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_leave_type' : filter_leave_type, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date},
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

    $(document).on('click','#add-leave-entitlement',function() {
        generate_modal('leave entitlement form', 'Leave Entitlement', 'R' , '0', '1', 'form', 'leave-entitlement-form', '1', username);
    });

    $(document).on('click','.update-leave-entitlement',function() {
        var leave_entitlement_id = $(this).data('leave-entitlement-id');

        sessionStorage.setItem('leave_entitlement_id', leave_entitlement_id);
        
        generate_modal('update leave entitlement form', 'Leave Entitlement', 'R' , '0', '1', 'form', 'leave-entitlement-form', '0', username);
    });
    
    $(document).on('click','.delete-leave-entitlement',function() {
        var leave_entitlement_id = $(this).data('leave-entitlement-id');
        var transaction = 'delete leave entitlement';

        Swal.fire({
            title: 'Delete Leave Entitlement',
            text: 'Are you sure you want to delete this leave entitlement?',
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
                    data: {username : username, leave_entitlement_id : leave_entitlement_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Leave Entitlement', 'The leave entitlement has been deleted.', 'success');

                          reload_datatable('#leave-entitlement-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Leave Entitlement', 'The leave entitlement does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Leave Entitlement', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-leave-entitlement',function() {
        var leave_entitlement_id = [];
        var transaction = 'delete multiple leave entitlement';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                leave_entitlement_id.push(this.value);  
            }
        });

        if(leave_entitlement_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Leave Entitlements',
                text: 'Are you sure you want to delete theses leave entitlements?',
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
                        data: {username : username, leave_entitlement_id : leave_entitlement_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Leave Entitlements', 'The leave entitlements have been deleted.', 'success');
    
                                reload_datatable('#leave-entitlement-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Leave Entitlements', 'The leave entitlement does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Leave Entitlements', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Leave Entitlements', 'Please select the leave entitlements you want to delete.', 'error');
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_leave_entitlement_table('#leave-entitlement-datatable');
    });
}