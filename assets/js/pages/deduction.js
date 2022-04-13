(function($) {
    'use strict';

    $(function() {
        if($('#deduction-datatable').length){
            initialize_deduction_table('#deduction-datatable');
        }

        initialize_click_events();
        initialize_on_change_events();
    });
})(jQuery);

function initialize_deduction_table(datatable_name, buttons = false, show_all = false){    
    var username = $('#username').text();
    var filter_branch = $('#filter_branch').val();
    var filter_department = $('#filter_department').val();
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var filter_deduction_type = $('#filter_deduction_type').val();
    var type = 'deduction table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'FILE_AS' },
        { 'data' : 'DEDUCTION_TYPE' },
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date, 'filter_deduction_type' : filter_deduction_type},
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" deduction="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }
    else{
        settings = {
            'ajax': { 
                'url' : 'system-generation.php',
                'method' : 'POST',
                'dataType': 'JSON',
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date, 'filter_deduction_type' : filter_deduction_type},
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" deduction="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }

    destroy_datatable(datatable_name);
    
    $(datatable_name).dataTable(settings);
}

function initialize_click_events(){
    var username = $('#username').text();

    $(document).on('click','.view-deduction',function() {
        var deduction_id = $(this).data('deduction-id');

        sessionStorage.setItem('deduction_id', deduction_id);

        generate_modal('deduction details', 'Deduction Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-deduction',function() {
        generate_modal('deduction form', 'Deduction', 'R' , '0', '1', 'form', 'deduction-form', '1', username);
    });

    $(document).on('click','.update-deduction',function() {
        var deduction_id = $(this).data('deduction-id');

        sessionStorage.setItem('deduction_id', deduction_id);
        
        generate_modal('deduction update form', 'Deduction', 'R' , '0', '1', 'form', 'deduction-update-form', '0', username);
    });
    
    $(document).on('click','.delete-deduction',function() {
        var deduction_id = $(this).data('deduction-id');
        var transaction = 'delete deduction';

        Swal.fire({
            title: 'Delete Deduction',
            text: 'Are you sure you want to delete this deduction?',
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
                    data: {username : username, deduction_id : deduction_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Deduction', 'The deduction has been deleted.', 'success');

                          reload_datatable('#deduction-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Deduction', 'The deduction does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Deduction', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-deduction',function() {
        var deduction_id = [];
        var transaction = 'delete multiple deduction';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                deduction_id.push(this.value);  
            }
        });

        if(deduction_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Deductions',
                text: 'Are you sure you want to delete these deductions?',
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
                        data: {username : username, deduction_id : deduction_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Deductions', 'The deductions have been deleted.', 'success');
    
                                reload_datatable('#deduction-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Deductions', 'The deduction does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Deductions', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Deductions', 'Please select the deductions you want to delete.', 'error');
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_deduction_table('#deduction-datatable');
    });
}

function calculate_deduction_end_date(){
    var transaction = 'calculate deduction end date';
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
        calculate_deduction_end_date();
    });

    $(document).on('change','#recurrence',function() {
        calculate_deduction_end_date();
    });

    $(document).on('change','#start_date',function() {
        calculate_deduction_end_date();
    });
}