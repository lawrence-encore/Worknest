(function($) {
    'use strict';

    $(function() {
        if($('#contribution-deduction-datatable').length){
            initialize_contribution_deduction_table('#contribution-deduction-datatable');
        }

        initialize_click_events();
        initialize_on_change_events();
    });
})(jQuery);

function initialize_contribution_deduction_table(datatable_name, buttons = false, show_all = false){    
    var username = $('#username').text();
    var filter_branch = $('#filter_branch').val();
    var filter_department = $('#filter_department').val();
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var filter_contribution_deduction_type = $('#filter_contribution_deduction_type').val();
    var type = 'contribution deduction table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'FILE_AS' },
        { 'data' : 'GOVERNMENT_CONTRIBUTION_TYPE' },
        { 'data' : 'PAYROLL_DATE' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '37%', 'aTargets': 1 },
        { 'width': '27%', 'aTargets': 2 },
        { 'width': '15%', 'aTargets': 3 },
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date, 'filter_contribution_deduction_type' : filter_contribution_deduction_type},
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date, 'filter_contribution_deduction_type' : filter_contribution_deduction_type},
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

    $(document).on('click','.view-contribution-deduction',function() {
        var contribution_deduction_id = $(this).data('contribution-deduction-id');

        sessionStorage.setItem('contribution_deduction_id', contribution_deduction_id);

        generate_modal('contribution deduction details', 'Contribution Deduction Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-contribution-deduction',function() {
        generate_modal('contribution deduction form', 'Contribution Deduction', 'R' , '0', '1', 'form', 'contribution-deduction-form', '1', username);
    });

    $(document).on('click','.update-contribution-deduction',function() {
        var contribution_deduction_id = $(this).data('contribution-deduction-id');

        sessionStorage.setItem('contribution contribution_deduction_id', contribution_deduction_id);
        
        generate_modal('contribution deduction update form', 'Contribution Deduction', 'R' , '0', '1', 'form', 'contribution-deduction-update-form', '0', username);
    });
    
    $(document).on('click','.delete-contribution-deduction',function() {
        var contribution_deduction_id = $(this).data('contribution-deduction-id');
        var transaction = 'delete contribution deduction';

        Swal.fire({
            title: 'Delete Contribution Deduction',
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
                    data: {username : username, contribution_deduction_id : contribution_deduction_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Contribution Deduction', 'The contribution deduction has been deleted.', 'success');

                          reload_datatable('#contribution-deduction-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Contribution Deduction', 'The contribution deduction does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Contribution Deduction', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-contribution-deduction',function() {
        var contribution_deduction_id = [];
        var transaction = 'delete multiple contribution deduction';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                contribution_deduction_id.push(this.value);  
            }
        });

        if(contribution_deduction_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Contribution Deductions',
                text: 'Are you sure you want to delete these contribution deductions?',
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
                        data: {username : username, contribution_deduction_id : contribution_deduction_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Contribution Deductions', 'The contribution deductions have been deleted.', 'success');
    
                                reload_datatable('#contribution-deduction-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Contribution Deductions', 'The contribution deduction does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Contribution Deductions', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Contribution Deductions', 'Please select the contribution deductions you want to delete.', 'error');
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_contribution_deduction_table('#contribution-deduction-datatable');
    });
}

function calculate_contribution_deduction_end_date(){
    var transaction = 'calculate contribution deduction end date';
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
        calculate_contribution_deduction_end_date();
    });

    $(document).on('change','#recurrence',function() {
        calculate_contribution_deduction_end_date();
    });

    $(document).on('change','#start_date',function() {
        calculate_contribution_deduction_end_date();
    });
}