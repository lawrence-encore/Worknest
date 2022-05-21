(function($) {
    'use strict';

    $(function() {
        reset_import_table();

        initialize_click_events();
    });
})(jQuery);

function initialize_temporary_withholding_tax_table(datatable_name, buttons = false, show_all = false){    
    var username = $('#username').text();
    var type = 'temporary withholding tax table';
    var settings;

    var column = [ 
        { 'data' : 'WITHHOLDING_TAX_ID' },
        { 'data' : 'SALARY_FREQUENCY' },
        { 'data' : 'START_RANGE' },
        { 'data' : 'END_RANGE' },
        { 'data' : 'FIX_COMPENSATION_LEVEL' },
        { 'data' : 'BASE_TAX' },
        { 'data' : 'PERCENT_OVER' },
    ];

    var column_definition = [
        { 'width': '10%', 'aTargets': 0, 'className' : 'withholding_tax_id' },
        { 'width': '10%', 'aTargets': 1, 'className' : 'salary_frequency' },
        { 'width': '10%', 'aTargets': 2, 'className' : 'start_range' },
        { 'width': '10%', 'aTargets': 3, 'className' : 'end_range' },
        { 'width': '10%', 'aTargets': 4, 'className' : 'fix_compensation_level' },
        { 'width': '10%', 'aTargets': 5, 'className' : 'base_tax' },
        { 'width': '10%', 'aTargets': 6, 'className' : 'percent_over' },
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

    $(document).on('click','#import-withholding-tax',function() {
        generate_modal('import withholding tax form', 'Import Withholding Tax', 'R' , '0', '1', 'form', 'import-withholding-tax-form', '1', username);
    });

    $(document).on('click','#submit-import-withholding-tax',function() {
        var withholding_tax_id = [];
        var salary_frequency = [];
        var start_range = [];
        var end_range = [];
        var fix_compensation_level = [];
        var base_tax = [];
        var percent_over = [];

        $('.withholding_tax_id').each(function(){
            withholding_tax_id.push($(this).text());
        });

        $('.salary_frequency').each(function(){
            salary_frequency.push($(this).text());
        });

        $('.start_range').each(function(){
            start_range.push($(this).text());
        });

        $('.end_range').each(function(){
            end_range.push($(this).text());
        });

        $('.fix_compensation_level').each(function(){
            fix_compensation_level.push($(this).text());
        });

        $('.base_tax').each(function(){
            base_tax.push($(this).text());
        });

        $('.percent_over').each(function(){
            percent_over.push($(this).text());
        });

        withholding_tax_id.splice(0,2);
        salary_frequency.splice(0,2);
        start_range.splice(0,2);
        end_range.splice(0,2);
        fix_compensation_level.splice(0,2);
        base_tax.splice(0,2);
        percent_over.splice(0,2);
       
        var transaction = 'import withholding tax data';
        var username = $('#username').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'TEXT',
            data: {withholding_tax_id : withholding_tax_id, salary_frequency : salary_frequency, start_range : start_range, end_range : end_range, fix_compensation_level : fix_compensation_level, base_tax : base_tax, percent_over : percent_over, transaction : transaction, username : username},
            success: function(response) {
                if(response === 'Imported'){
                    show_alert('Import Withholding Tax Date', 'The withholding taxes have been imported.', 'success');
                    reset_import_table();
                }
                else{
                    show_alert('Import Withholding Tax Data Error', response, 'error');
                }
            }
        });
    });

    $(document).on('click','#clear-import-withholding-tax',function() {
        reset_import_table();
    });
}

function reset_import_table(){
    truncate_temporary_table('import withholding tax');

    $('#import-withholding-tax').removeClass('d-none');
    $('#submit-import-withholding-tax').addClass('d-none');
    $('#clear-import-withholding-tax').addClass('d-none');
}