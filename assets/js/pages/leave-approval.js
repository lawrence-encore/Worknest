(function($) {
    'use strict';

    $(function() {
        if($('#leave-approval-datatable').length){
            initialize_leave_table('#leave-approval-datatable');
        }

        initialize_click_events();
        initialize_on_change_events();
    });
})(jQuery);

function initialize_leave_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var filter_leave_type = $('#filter_leave_type').val();
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var type = 'leave approval table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'FILE_AS' },
        { 'data' : 'LEAVE_NAME' },
        { 'data' : 'LEAVE_ENTITLMENT' },
        { 'data' : 'LEAVE_DATE' },
        { 'data' : 'LEAVE_STATUS' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '29%', 'aTargets': 1 },
        { 'width': '15%', 'aTargets': 2 },
        { 'width': '10%', 'aTargets': 3 },
        { 'width': '15%', 'aTargets': 4 },
        { 'width': '10%', 'aTargets': 5 },
        { 'width': '20%','bSortable': false, 'aTargets': 6 },
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
                'data': {'type' : type, 'username' : username, 'filter_leave_type' : filter_leave_type, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date},
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
                'data': {'type' : type, 'username' : username, 'filter_leave_type' : filter_leave_type, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date},
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

    $(document).on('click','.view-leave',function() {
        var leave_id = $(this).data('leave-id');

        sessionStorage.setItem('leave_id', leave_id);

        generate_modal('leave details', 'Leave Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-leave',function() {
        generate_modal('leave form', 'Leave', 'R' , '0', '1', 'form', 'leave-form', '1', username);
    });

    $(document).on('click','.approve-leave',function() {
        var leave_id = $(this).data('leave-id');

        sessionStorage.setItem('leave_id', leave_id);
        
        generate_modal('approve leave form', 'Approve Leave', 'R' , '0', '1', 'form', 'approve-leave-form', '1', username);
    });

    $(document).on('click','.reject-leave',function() {
        var leave_id = $(this).data('leave-id');

        sessionStorage.setItem('leave_id', leave_id);
        
        generate_modal('reject leave form', 'Reject Leave', 'R' , '0', '1', 'form', 'reject-leave-form', '1', username);
    });

    $(document).on('click','.cancel-leave',function() {
        var leave_id = $(this).data('leave-id');

        sessionStorage.setItem('leave_id', leave_id);
        
        generate_modal('cancel leave form', 'Cancel Leave', 'R' , '0', '1', 'form', 'cancel-leave-form', '1', username);
    });
    
    $(document).on('click','.delete-leave',function() {
        var leave_id = $(this).data('leave-id');
        var transaction = 'delete leave';

        Swal.fire({
            title: 'Delete Leave',
            text: 'Are you sure you want to delete this leave?',
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
                    data: {username : username, leave_id : leave_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Leave', 'The leave has been deleted.', 'success');

                          reload_datatable('#leave-approval-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Leave', 'The leave does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Leave', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-leave',function() {
        var leave_id = [];
        var transaction = 'delete multiple leave';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                leave_id.push(this.value);  
            }
        });

        if(leave_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Leaves',
                text: 'Are you sure you want to delete these leaves?',
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
                        data: {username : username, leave_id : leave_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Leaves', 'The leaves have been deleted.', 'success');
    
                                reload_datatable('#leave-approval-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Leaves', 'The leave does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Leaves', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Leaves', 'Please select the leaves you want to delete.', 'error');
        }
    });

    $(document).on('click','#approve-leave',function() {
        var leave_id = [];

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                leave_id.push(this.value);  
            }
        });

        sessionStorage.setItem('leave_id', leave_id);
        
        if(leave_id.length > 0){
            generate_modal('approve multiple leave form', 'Approve Multiple Leave', 'R' , '0', '1', 'form', 'approve-multiple-leave-form', '1', username);
        }
    });

    $(document).on('click','#reject-leave',function() {
        var leave_id = [];

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                leave_id.push(this.value);  
            }
        });

        sessionStorage.setItem('leave_id', leave_id);

        if(leave_id.length > 0){
            generate_modal('reject multiple leave form', 'Reject Multiple Leave', 'R' , '0', '1', 'form', 'reject-multiple-leave-form', '1', username);
        }
    });

    $(document).on('click','#cancel-leave',function() {
        var leave_id = [];

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                leave_id.push(this.value);  
            }
        });

        sessionStorage.setItem('leave_id', leave_id);
        
        if(leave_id.length > 0){
            generate_modal('cancel multiple leave form', 'Cancel Multiple Leave', 'R' , '0', '1', 'form', 'cancel-multiple-leave-form', '1', username);
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_leave_table('#leave-approval-datatable');
    });
}

function initialize_on_change_events(){
    $(document).on('change','#leave_duration',function() {
        if(this.value != ''){
            var username = $('#username').text();

            generate_element('leave duration', this.value, 'leave-date-container', '0', username);
        }
        else{
            document.getElementById('leave-date-container').innerHTML = '';
        }
    });
}