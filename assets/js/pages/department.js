(function($) {
    'use strict';

    $(function() {
        if($('#department-datatable').length){
            initialize_department_table('#department-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_department_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var type = 'department table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'DEPARTMENT' },
        { 'data' : 'DEPARTMENT_HEAD' },
        { 'data' : 'PARENT_DEPARTMENT' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '39%', 'aTargets': 1 },
        { 'width': '20%', 'aTargets': 2 },
        { 'width': '20%', 'aTargets': 3 },
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

    $(document).on('click','#add-department',function() {
        generate_modal('department form', 'Department', 'R' , '1', '1', 'form', 'department-form', '1', username);
    });

    $(document).on('click','.update-department',function() {
        var department_id = $(this).data('department-id');

        sessionStorage.setItem('department_id', department_id);
        
        generate_modal('department form', 'Department', 'R' , '1', '1', 'form', 'department-form', '0', username);
    });
    
    $(document).on('click','.delete-department',function() {
        var department_id = $(this).data('department-id');
        var transaction = 'delete department';

        Swal.fire({
            title: 'Delete Department',
            text: 'Are you sure you want to delete this department?',
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
                    data: {username : username, department_id : department_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Department', 'The department has been deleted.', 'success');

                          reload_datatable('#department-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Department', 'The department does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Department', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-department',function() {
        var department_id = [];
        var transaction = 'delete multiple department';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                department_id.push(this.value);  
            }
        });

        if(department_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Departments',
                text: 'Are you sure you want to delete these departments?',
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
                        data: {username : username, department_id : department_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Departments', 'The departments have been deleted.', 'success');
    
                                reload_datatable('#department-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Departments', 'The department does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Departments', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Departments', 'Please select the departments you want to delete.', 'error');
        }
    });

}