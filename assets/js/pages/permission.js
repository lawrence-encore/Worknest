(function($) {
    'use strict';

    $(function() {
        if($('#permission-datatable').length){
            initialize_permission_table('#permission-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_permission_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var policy_id = $('#policy-id').text();
    var type = 'permission table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'PERMISSION_ID' },
        { 'data' : 'PERMISSION' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '15%', 'aTargets': 1 },
        { 'width': '69%', 'aTargets': 2 },
        { 'width': '20%','bSortable': false, 'aTargets': 3 },
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
                'data': {'type' : type, 'username' : username, 'policy_id' : policy_id},
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
                'data': {'type' : type, 'username' : username, 'policy_id' : policy_id},
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

    $(document).on('click','#add-permission',function() {
        generate_modal('permission form', 'Permission', 'R' , '1', '1', 'form', 'permission-form', '1', username);
    });

    $(document).on('click','.update-permission',function() {
        var permission_id = $(this).data('permission-id'); 
        
        sessionStorage.setItem('permission_id', permission_id);
        
        generate_modal('permission form', 'Permission', 'R' , '1', '1', 'form', 'permission-form', '0', username);
    });
    
    $(document).on('click','.delete-permission',function() {
        var permission_id = $(this).data('permission-id'); 
        var transaction = 'delete permission';

        Swal.fire({
            title: 'Delete Permission',
            text: 'Are you sure you want to delete this permission?',
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
                    data: {username : username, permission_id : permission_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Permission', 'The permission has been deleted.', 'success');

                          reload_datatable('#permission-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Permission', 'The permission does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Permission', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-permission',function() {
        var permission_id = [];
        var transaction = 'delete multiple permission';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                permission_id.push(this.value);  
            }
        });

        if(permission_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Permissions',
                text: 'Are you sure you want to delete these permissions?',
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
                        data: {username : username, permission_id : permission_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Permissions', 'The permissions have been deleted.', 'success');
    
                                reload_datatable('#permission-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Permissions', 'The permission does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Permissions', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Permissions', 'Please select the policies you want to delete.', 'error');
        }
    });
}