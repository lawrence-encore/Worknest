(function($) {
    'use strict';

    $(function() {
        reset_import_table();

        initialize_click_events();
    });
})(jQuery);

function initialize_temporary_contribution_bracket_table(datatable_name, buttons = false, show_all = false){    
    var username = $('#username').text();
    var type = 'temporary contribution bracket table';
    var settings;

    var column = [ 
        { 'data' : 'CONTRIBUTION_BRACKET_ID' },
        { 'data' : 'GOVERNMENT_CONTRIBUTION_ID' },
        { 'data' : 'START_RANGE' },
        { 'data' : 'END_RANGE' },
        { 'data' : 'DEDUCTION_AMOUNT' },
    ];

    var column_definition = [
        { 'width': '10%', 'aTargets': 0, 'className' : 'contribution_bracket_id' },
        { 'width': '10%', 'aTargets': 1, 'className' : 'government_contribution_id' },
        { 'width': '10%', 'aTargets': 2, 'className' : 'start_range' },
        { 'width': '10%', 'aTargets': 3, 'className' : 'end_range' },
        { 'width': '10%', 'aTargets': 4, 'className' : 'deduction_amount' },
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

    $(document).on('click','#import-contribution-bracket',function() {
        generate_modal('import contribution bracket form', 'Import Contribution Bracket', 'R' , '0', '1', 'form', 'import-contribution-bracket-form', '1', username);
    });

    $(document).on('click','#submit-import-contribution-bracket',function() {
        var contribution_bracket_id = [];
        var government_contribution_id = [];
        var start_range = [];
        var end_range = [];
        var deduction_amount = [];

        $('.contribution_bracket_id').each(function(){
            contribution_bracket_id.push($(this).text());
        });

        $('.government_contribution_id').each(function(){
            government_contribution_id.push($(this).text());
        });

        $('.start_range').each(function(){
            start_range.push($(this).text());
        });

        $('.end_range').each(function(){
            end_range.push($(this).text());
        });

        $('.deduction_amount').each(function(){
            deduction_amount.push($(this).text());
        });

        contribution_bracket_id.splice(0,2);
        government_contribution_id.splice(0,2);
        start_range.splice(0,2);
        end_range.splice(0,2);
        deduction_amount.splice(0,2);
       
        var transaction = 'import contribution bracket data';
        var username = $('#username').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'TEXT',
            data: {contribution_bracket_id : contribution_bracket_id, government_contribution_id : government_contribution_id, start_range : start_range, end_range : end_range, deduction_amount : deduction_amount, transaction : transaction, username : username},
            success: function(response) {
                if(response === 'Imported'){
                    show_alert('Import Contribution Bracket Date', 'The contribution brackets have been imported.', 'success');
                    reset_import_table();
                }
                else{
                    show_alert('Import Contribution Bracket Data Error', response, 'error');
                }
            }
        });
    });

    $(document).on('click','#clear-import-contribution-bracket',function() {
        reset_import_table();
    });
}

function reset_import_table(){
    truncate_temporary_table('import contribution bracket');

    $('#import-contribution-bracket').removeClass('d-none');
    $('#submit-import-contribution-bracket').addClass('d-none');
    $('#clear-import-contribution-bracket').addClass('d-none');
}