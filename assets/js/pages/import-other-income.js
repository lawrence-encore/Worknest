(function($) {
    'use strict';

    $(function() {
        reset_import_table();

        initialize_click_events();
    });
})(jQuery);

function initialize_temporary_other_income_table(datatable_name, buttons = false, show_all = false){    
    var username = $('#username').text();
    var type = 'temporary other income table';
    var settings;

    var column = [ 
        { 'data' : 'OTHER_INCOME_ID' },
        { 'data' : 'EMPLOYEE_ID' },
        { 'data' : 'OTHER_INCOME_TYPE' },
        { 'data' : 'PAYROLL_ID' },
        { 'data' : 'PAYROLL_DATE' },
        { 'data' : 'AMOUNT' }
    ];

    var column_definition = [
        { 'width': '10%', 'aTargets': 0, 'className' : 'other_income_id' },
        { 'width': '10%', 'aTargets': 1, 'className' : 'employee_id' },
        { 'width': '10%', 'aTargets': 2, 'className' : 'other_income_type' },
        { 'width': '10%', 'aTargets': 3, 'className' : 'payroll_id' },
        { 'width': '10%', 'aTargets': 4, 'className' : 'payroll_date' },
        { 'width': '10%', 'aTargets': 5, 'className' : 'amount' }
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

    $(document).on('click','#import-other-income',function() {
        generate_modal('import other income form', 'Import Other Income', 'R' , '0', '1', 'form', 'import-other-income-form', '1', username);
    });

    $(document).on('click','#submit-import-other-income',function() {
        var other_income_id = [];
        var employee_id = [];
        var other_income_type = [];
        var payroll_id = [];
        var payroll_date = [];
        var amount = [];

        $('.other_income_id').each(function(){
            other_income_id.push($(this).text());
        });

        $('.employee_id').each(function(){
            employee_id.push($(this).text());
        });

        $('.other_income_type').each(function(){
            other_income_type.push($(this).text());
        });

        $('.payroll_id').each(function(){
            payroll_id.push($(this).text());
        });

        $('.payroll_date').each(function(){
            payroll_date.push($(this).text());
        });

        $('.amount').each(function(){
            amount.push($(this).text());
        });

        other_income_id.splice(0,2);
        employee_id.splice(0,2);
        other_income_type.splice(0,2);
        payroll_id.splice(0,2);
        payroll_date.splice(0,2);
        amount.splice(0,2);
       
        var transaction = 'import other income data';
        var username = $('#username').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'TEXT',
            data: {other_income_id : other_income_id, employee_id : employee_id, other_income_type :other_income_type, payroll_id : payroll_id, payroll_date : payroll_date, amount : amount, transaction : transaction, username : username},
            success: function(response) {
                if(response === 'Imported'){
                    show_alert('Import Other Income Date', 'The other incomes have been imported.', 'success');
                    reset_import_table();
                }
                else{
                    show_alert('Import Other Income Data Error', response, 'error');
                }
            }
        });
    });

    $(document).on('click','#clear-import-other-income',function() {
        reset_import_table();
    });
}

function reset_import_table(){
    truncate_temporary_table('import other income');

    $('#import-other-income').removeClass('d-none');
    $('#submit-import-other-income').addClass('d-none');
    $('#clear-import-other-income').addClass('d-none');
}