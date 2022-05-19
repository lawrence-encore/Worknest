(function($) {
    'use strict';

    $(function() {
        if($('#other-income-datatable').length){
            initialize_other_income_table('#other-income-datatable');
        }

        initialize_click_events();
        initialize_on_change_events();
    });
})(jQuery);

function initialize_other_income_table(datatable_name, buttons = false, show_all = false){    
    var username = $('#username').text();
    var filter_branch = $('#filter_branch').val();
    var filter_department = $('#filter_department').val();
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var filter_other_income_type = $('#filter_other_income_type').val();
    var type = 'other income table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'FILE_AS' },
        { 'data' : 'OTHER_INCOME_TYPE' },
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date, 'filter_other_income_type' : filter_other_income_type},
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date, 'filter_other_income_type' : filter_other_income_type},
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

    $(document).on('click','.view-other-income',function() {
        var other_income_id = $(this).data('other-income-id');

        sessionStorage.setItem('other_income_id', other_income_id);

        generate_modal('other income details', 'Other Income Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-other-income',function() {
        generate_modal('other income form', 'Other Income', 'R' , '0', '1', 'form', 'other-income-form', '1', username);
    });

    $(document).on('click','.update-other-income',function() {
        var other_income_id = $(this).data('other-income-id');

        sessionStorage.setItem('other_income_id', other_income_id);
        
        generate_modal('other income update form', 'Other Income', 'R' , '0', '1', 'form', 'other-income-update-form', '0', username);
    });
    
    $(document).on('click','.delete-other-income',function() {
        var other_income_id = $(this).data('other-income-id');
        var transaction = 'delete other income';

        Swal.fire({
            title: 'Delete Other Income',
            text: 'Are you sure you want to delete this other income?',
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
                    data: {username : username, other_income_id : other_income_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Other Income', 'The other income has been deleted.', 'success');

                          reload_datatable('#other-income-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Other Income', 'The other income does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Other Income', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-other-income',function() {
        var other_income_id = [];
        var transaction = 'delete multiple other income';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                other_income_id.push(this.value);  
            }
        });

        if(other_income_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Other Incomes',
                text: 'Are you sure you want to delete these other incomes?',
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
                        data: {username : username, other_income_id : other_income_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Other Incomes', 'The other incomes have been deleted.', 'success');
    
                                reload_datatable('#other-income-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Other Incomes', 'The other income does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Other Incomes', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Other Incomes', 'Please select the other incomes you want to delete.', 'error');
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_other_income_table('#other-income-datatable');
    });
}

function calculate_other_income_end_date(){
    var transaction = 'calculate other income end date';
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
        calculate_other_income_end_date();
    });

    $(document).on('change','#recurrence',function() {
        calculate_other_income_end_date();
    });

    $(document).on('change','#start_date',function() {
        calculate_other_income_end_date();
    });
}