(function($) {
    'use strict';

    $(function() {
        if($('#employee-file-datatable').length){
            initialize_employee_file_management_table('#employee-file-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_employee_file_management_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var type = 'employee file management table';
    var filter_branch = $('#filter_branch').val();
    var filter_department = $('#filter_department').val();
    var filter_file_category = $('#filter_file_category').val();
    var filter_file_start_date = $('#filter_file_start_date').val();
    var filter_file_end_date = $('#filter_file_end_date').val();
    var filter_upload_start_date = $('#filter_upload_start_date').val();
    var filter_upload_end_date = $('#filter_upload_end_date').val();
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'FILE_AS' },
        { 'data' : 'FILE_NAME' },
        { 'data' : 'FILE_DATE' },
        { 'data' : 'FILE_CATEGORY' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '24%', 'aTargets': 1 },
        { 'width': '20%', 'aTargets': 2 },
        { 'width': '15%', 'aTargets': 3 },
        { 'width': '20%', 'aTargets': 4 },
        { 'width': '20%','bSortable': false, 'aTargets': 5},
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_file_category' : filter_file_category, 'filter_file_start_date' : filter_file_start_date, 'filter_file_end_date' :filter_file_end_date, 'filter_upload_start_date' : filter_upload_start_date, 'filter_upload_end_date' : filter_upload_end_date },
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_file_category' : filter_file_category, 'filter_file_start_date' : filter_file_start_date, 'filter_file_end_date' :filter_file_end_date, 'filter_upload_start_date' : filter_upload_start_date, 'filter_upload_end_date' : filter_upload_end_date },
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

    $(document).on('click','.view-employee-file',function() {
        var file_id = $(this).data('file-id');

        sessionStorage.setItem('file_id', file_id);

        generate_modal('employee file details', 'Employee File Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-employee-file-management',function() {
        generate_modal('employee file management form', 'Employee File', 'R' , '0', '1', 'form', 'employee-file-management-form', '1', username);
    });

    $(document).on('click','.update-employee-file-management',function() {
        var file_id = $(this).data('file-id');

        sessionStorage.setItem('file_id', file_id);
        
        generate_modal('employee file management form', 'Employee File', 'R' , '0', '1', 'form', 'employee-file-management-form', '0', username);
    });

    $(document).on('click','.delete-employee-file-management',function() {
        var file_id = $(this).data('file-id');
        var transaction = 'delete employee file';

        Swal.fire({
            title: 'Delete Employee File',
            text: 'Are you sure you want to delete this employee file?',
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
                          show_alert('Delete Employee File', 'The employee file has been deleted.', 'success');

                          reload_datatable('#employee-file-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Employee File', 'The employee file does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Employee File', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-employee-file',function() {
        var file_id = [];
        var transaction = 'delete multiple employee file';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                file_id.push(this.value);  
            }
        });

        if(file_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Employee Files',
                text: 'Are you sure you want to delete these employee files?',
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
                                show_alert('Delete Multiple Employee Files', 'The employee files have been deleted.', 'success');
    
                                reload_datatable('#employee-file-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Employee Files', 'The employee file does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Employee Files', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Employee Files', 'Please select the employee files you want to delete.', 'error');
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_employee_file_management_table('#employee-file-datatable');
    });
}