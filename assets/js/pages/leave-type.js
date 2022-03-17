(function($) {
    'use strict';

    $(function() {
        if($('#leave-type-datatable').length){
            initialize_leave_type_table('#leave-type-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_leave_type_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var type = 'leave type table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'LEAVE_NAME' },
        { 'data' : 'NO_LEAVES' },
        { 'data' : 'PAID_STATUS' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '59%', 'aTargets': 1 },
        { 'width': '10%', 'aTargets': 2 },
        { 'width': '10%', 'aTargets': 3 },
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" role="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }

    destroy_datatable(datatable_name);
    
    $(datatable_name).dataTable(settings);
}

function initialize_click_events(){
    var username = $('#username').text();

    $(document).on('click','#add-leave-type',function() {
        generate_modal('leave type form', 'Leave Type', 'R' , '1', '1', 'form', 'leave-type-form', '1', username);
    });

    $(document).on('click','.update-leave-type',function() {
        var leave_type_id = $(this).data('leave-type-id');

        sessionStorage.setItem('leave_type_id', leave_type_id);
        
        generate_modal('leave type form', 'Leave Type', 'R' , '1', '1', 'form', 'leave-type-form', '0', username);
    });
    
    $(document).on('click','.delete-leave-type',function() {
        var leave_type_id = $(this).data('leave-type-id');
        var transaction = 'delete leave type';

        Swal.fire({
            title: 'Delete Leave Type',
            text: 'Are you sure you want to delete this leave type?',
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
                    data: {username : username, leave_type_id : leave_type_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Leave Type', 'The leave type has been deleted.', 'success');

                          reload_datatable('#leave-type-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Leave Type', 'The leave type does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Leave Type', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-leave-type',function() {
        var leave_type_id = [];
        var transaction = 'delete multiple leave type';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                leave_type_id.push(this.value);  
            }
        });

        if(leave_type_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Leave Types',
                text: 'Are you sure you want to delete these leave types?',
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
                        data: {username : username, leave_type_id : leave_type_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Leave Types', 'The leave types have been deleted.', 'success');
    
                                reload_datatable('#leave-type-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Leave Types', 'The leave type does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Leave Types', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Leave Types', 'Please select the leave types you want to delete.', 'error');
        }
    });

}