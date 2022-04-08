(function($) {
    'use strict';

    $(function() {
        if($('#allowance-datatable').length){
            initialize_allowance_table('#allowance-datatable');
        }

        initialize_click_events();
        initialize_on_change_events();
    });
})(jQuery);

function initialize_allowance_table(datatable_name, buttons = false, show_all = false){    
    var username = $('#username').text();
    var filter_branch = $('#filter_branch').val();
    var filter_department = $('#filter_department').val();
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var filter_allowance_type = $('#filter_allowance_type').val();
    var type = 'allowance table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'FILE_AS' },
        { 'data' : 'ALLOWANCE_TYPE' },
        { 'data' : 'PAYROLL_DATE' },
        { 'data' : 'AMOUNT' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '27%', 'aTargets': 1 },
        { 'width': '22%', 'aTargets': 2 },
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date, 'filter_allowance_type' : filter_allowance_type},
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" allowance="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }
    else{
        settings = {
            'ajax': { 
                'url' : 'system-generation.php',
                'method' : 'POST',
                'dataType': 'JSON',
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date, 'filter_allowance_type' : filter_allowance_type},
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" allowance="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }

    destroy_datatable(datatable_name);
    
    $(datatable_name).dataTable(settings);
}

function initialize_click_events(){
    var username = $('#username').text();

    $(document).on('click','.view-allowance',function() {
        var allowance_id = $(this).data('allowance-id');

        sessionStorage.setItem('allowance_id', allowance_id);

        generate_modal('allowance details', 'Allowance Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-allowance',function() {
        generate_modal('allowance form', 'Allowance', 'R' , '0', '1', 'form', 'allowance-form', '1', username);
    });

    $(document).on('click','.update-allowance',function() {
        var allowance_id = $(this).data('allowance-id');

        sessionStorage.setItem('allowance_id', allowance_id);
        
        generate_modal('allowance update form', 'Allowance', 'R' , '0', '1', 'form', 'allowance-update-form', '0', username);
    });
    
    $(document).on('click','.delete-allowance',function() {
        var allowance_id = $(this).data('allowance-id');
        var transaction = 'delete allowance';

        Swal.fire({
            title: 'Delete Allowance',
            text: 'Are you sure you want to delete this allowance?',
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
                    data: {username : username, allowance_id : allowance_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Allowance', 'The allowance has been deleted.', 'success');

                          reload_datatable('#allowance-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Allowance', 'The allowance does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Allowance', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-allowance',function() {
        var allowance_id = [];
        var transaction = 'delete multiple allowance';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                allowance_id.push(this.value);  
            }
        });

        if(allowance_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Allowances',
                text: 'Are you sure you want to delete these allowances?',
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
                        data: {username : username, allowance_id : allowance_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Allowances', 'The allowances have been deleted.', 'success');
    
                                reload_datatable('#allowance-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Allowances', 'The allowance does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Allowances', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Allowances', 'Please select the allowances you want to delete.', 'error');
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_allowance_table('#allowance-datatable');
    });
}

function calculate_allowance_end_date(){
    var transaction = 'calculate allowance end date';
    var recurrence_pattern = $('#recurrence_pattern').val();
    var recurrence = $('#recurrence').val();
    var start_date = $('#start_date').val();

    $.ajax({
        url: 'controller.php',
        method: 'POST',
        dataType: 'TEXT',
        data: {recurrence_pattern : recurrence_pattern, recurrence : recurrence, start_date : start_date, transaction : transaction},
        success: function(response) {
            $('#end_date').val(response);
        }
    });
}

function initialize_on_change_events(){
    $(document).on('change','#recurrence_pattern',function() {
        calculate_allowance_end_date();
    });

    $(document).on('change','#recurrence',function() {
        calculate_allowance_end_date();
    });

    $(document).on('change','#start_date',function() {
        calculate_allowance_end_date();
    });
}