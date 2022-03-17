(function($) {
    'use strict';

    $(function() {
        if($('#employee-datatable').length){
            initialize_employee_table('#employee-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_employee_table(datatable_name, buttons = false, show_all = false){    
    var username = $('#username').text();
    var filter_branch = $('#filter_branch').val();
    var filter_department = $('#filter_department').val();
    var filter_designation = $('#filter_designation').val();
    var filter_employment_status = $('#filter_employment_status').val();
    var type = 'employee table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'FILE_AS' },
        { 'data' : 'EMPLOYEE_ID' },
        { 'data' : 'EMPLOYMENT_STATUS' },
        { 'data' : 'DEPARTMENT' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '37%', 'aTargets': 1 },
        { 'width': '12%', 'aTargets': 2 },
        { 'width': '15%', 'aTargets': 3 },
        { 'width': '15%', 'aTargets': 4 },
        { 'width': '20%','bSortable': false, 'aTargets': 5 },
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_designation' : filter_designation, 'filter_employment_status' : filter_employment_status},
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" employee="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }
    else{
        settings = {
            'ajax': { 
                'url' : 'system-generation.php',
                'method' : 'POST',
                'dataType': 'JSON',
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_designation' : filter_designation, 'filter_employment_status' : filter_employment_status},
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" employee="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }

    destroy_datatable(datatable_name);
    
    $(datatable_name).dataTable(settings);
}

function initialize_click_events(){
    var username = $('#username').text();

    $(document).on('click','#add-employee',function() {
        generate_modal('employee form', 'Employee', 'XL' , '0', '1', 'form', 'employee-form', '1', username);
    });

    $(document).on('click','.update-employee',function() {
        var employee_id = $(this).data('employee-id');

        sessionStorage.setItem('employee_id', employee_id);
        
        generate_modal('employee form', 'Employee', 'XL' , '0', '1', 'form', 'employee-form', '0', username);
    });
    
    $(document).on('click','.delete-employee',function() {
        var employee_id = $(this).data('employee-id');
        var transaction = 'delete employee';

        Swal.fire({
            title: 'Delete Employee',
            text: 'Are you sure you want to delete this employee?',
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
                    data: {username : username, employee_id : employee_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Employee', 'The employee has been deleted.', 'success');

                          reload_datatable('#employee-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Employee', 'The employee does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Employee', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-employee',function() {
        var employee_id = [];
        var transaction = 'delete multiple employee';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                employee_id.push(this.value);  
            }
        });

        if(employee_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Employees',
                text: 'Are you sure you want to delete these employees?',
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
                        data: {username : username, employee_id : employee_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Employees', 'The employees have been deleted.', 'success');
    
                                reload_datatable('#employee-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Employees', 'The employee does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Employees', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Employees', 'Please select the employees you want to delete.', 'error');
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_employee_table('#employee-datatable');
    });
}