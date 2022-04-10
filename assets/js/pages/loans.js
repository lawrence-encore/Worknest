(function($) {
    'use strict';

    $(function() {
        if($('#loan-datatable').length){
            initialize_loan_table('#loan-datatable');
        }

        initialize_click_events();
        initialize_on_change_events();
    });
})(jQuery);

function initialize_loan_table(datatable_name, buttons = false, show_all = false){    
    var username = $('#username').text();
    var filter_branch = $('#filter_branch').val();
    var filter_department = $('#filter_department').val();
    var filter_loan_type = $('#filter_loan_type').val();
    var type = 'loan table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'FILE_AS' },
        { 'data' : 'LOAN_TYPE' },
        { 'data' : 'START_DATE' },
        { 'data' : 'END_DATE' },
        { 'data' : 'OUTSTANDING_BALANCE' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '26%', 'aTargets': 1 },
        { 'width': '14%', 'aTargets': 2 },
        { 'width': '13%', 'aTargets': 3 },
        { 'width': '13%', 'aTargets': 4 },
        { 'width': '13%', 'aTargets': 5 },
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_loan_type' : filter_loan_type},
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" loan="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }
    else{
        settings = {
            'ajax': { 
                'url' : 'system-generation.php',
                'method' : 'POST',
                'dataType': 'JSON',
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_loan_type' : filter_loan_type},
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" loan="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }

    destroy_datatable(datatable_name);
    
    $(datatable_name).dataTable(settings);
}

function initialize_click_events(){
    var username = $('#username').text();

    $(document).on('click','.view-loan',function() {
        var loan_id = $(this).data('loan-id');

        sessionStorage.setItem('loan_id', loan_id);

        generate_modal('loan details', 'Loan Details', 'LG' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-loan',function() {
        generate_modal('loan form', 'Loan', 'LG' , '0', '1', 'form', 'loan-form', '1', username);
    });

    $(document).on('click','.update-loan',function() {
        var loan_id = $(this).data('loan-id');

        sessionStorage.setItem('loan_id', loan_id);
        
        generate_modal('loan update form', 'Loan', 'R' , '0', '1', 'form', 'loan-update-form', '0', username);
    });
    
    $(document).on('click','.delete-loan',function() {
        var loan_id = $(this).data('loan-id');
        var transaction = 'delete loan';

        Swal.fire({
            title: 'Delete Loan',
            text: 'Are you sure you want to delete this loan?',
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
                    data: {username : username, loan_id : loan_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Loan', 'The loan has been deleted.', 'success');

                          reload_datatable('#loan-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Loan', 'The loan does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Loan', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-loan',function() {
        var loan_id = [];
        var transaction = 'delete multiple loan';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                loan_id.push(this.value);  
            }
        });

        if(loan_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Loans',
                text: 'Are you sure you want to delete these loans?',
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
                        data: {username : username, loan_id : loan_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Loans', 'The loans have been deleted.', 'success');
    
                                reload_datatable('#loan-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Loans', 'The loan does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Loans', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Loans', 'Please select the loans you want to delete.', 'error');
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_loan_table('#loan-datatable');
    });
}

function calculate_loan_end_date(){
    var transaction = 'calculate loan end date';
    var payment_frequency = $('#payment_frequency').val();
    var number_of_payments = $('#number_of_payments').val();
    var start_date = $('#start_date').val();

    $.ajax({
        url: 'controller.php',
        method: 'POST',
        dataType: 'TEXT',
        data: {payment_frequency : payment_frequency, number_of_payments : number_of_payments, start_date : start_date, transaction : transaction},
        success: function(response) {
            $('#end_date').val(response);
        }
    });
}

function calculate_loan_amount(){
    var transaction = 'calculate loan amount';
    var loan_amount = $('#loan_amount').val();
    var payment_frequency = $('#payment_frequency').val();
    var number_of_payments = $('#number_of_payments').val();
    var interest_rate = $('#interest_rate').val();

    $.ajax({
        url: 'controller.php',
        method: 'POST',
        dataType: 'JSON',
        data: {loan_amount : loan_amount, payment_frequency : payment_frequency, number_of_payments : number_of_payments, interest_rate : interest_rate, transaction : transaction},
        success: function(response) {
            $('#repayment_amount').val(response[0].REPAYMENT_AMOUNT);
            $('#interest_amount').val(response[0].INTEREST_AMOUNT);
            $('#total_repayment_amount').val(response[0].TOTAL_REPAYMENT_AMOUNT);
            $('#outstanding_balance').val(response[0].OUTSTANDING_BALANCE);
        }
    });
}

function initialize_on_change_events(){
    $(document).on('change','#loan_amount',function() {
        calculate_loan_amount();
    });

    $(document).on('change','#interest_rate',function() {
        calculate_loan_amount();
    });

    $(document).on('change','#payment_frequency',function() {
        calculate_loan_end_date();
        calculate_loan_amount();
    });

    $(document).on('change','#number_of_payments',function() {
        calculate_loan_end_date();
        calculate_loan_amount();
    });

    $(document).on('change','#start_date',function() {
        calculate_loan_end_date();
    });
}