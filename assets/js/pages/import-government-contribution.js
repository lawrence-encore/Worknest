(function($) {
    'use strict';

    $(function() {
        reset_import_table();

        initialize_click_events();
    });
})(jQuery);

function initialize_temporary_government_contribution_table(datatable_name, buttons = false, show_all = false){    
    var username = $('#username').text();
    var type = 'temporary government contribution table';
    var settings;

    var column = [ 
        { 'data' : 'GOVERNMENT_CONTRIBUTION_ID' },
        { 'data' : 'GOVERNMENT_CONTRIBUTION' },
        { 'data' : 'DESCRIPTION' },
    ];

    var column_definition = [
        { 'width': '10%', 'aTargets': 0, 'className' : 'government_contribution_id' },
        { 'width': '10%', 'aTargets': 1, 'className' : 'government_contribution' },
        { 'width': '10%', 'aTargets': 2, 'className' : 'description' },
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

    $(document).on('click','#import-government-contribution',function() {
        generate_modal('import government contribution form', 'Import Government Contribution', 'R' , '0', '1', 'form', 'import-government-contribution-form', '1', username);
    });

    $(document).on('click','#submit-import-government-contribution',function() {
        var government_contribution_id = [];
        var government_contribution = [];
        var description = [];

        $('.government_contribution_id').each(function(){
            government_contribution_id.push($(this).text());
        });

        $('.government_contribution').each(function(){
            government_contribution.push($(this).text());
        });

        $('.description').each(function(){
            description.push($(this).text());
        });

        government_contribution_id.splice(0,2);
        government_contribution.splice(0,2);
        description.splice(0,2);
       
        var transaction = 'import government contribution data';
        var username = $('#username').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'TEXT',
            data: {government_contribution_id : government_contribution_id, government_contribution : government_contribution, description : description, transaction : transaction, username : username},
            success: function(response) {
                if(response === 'Imported'){
                    show_alert('Import Government Contribution Date', 'The government contributions have been imported.', 'success');
                    reset_import_table();
                }
                else{
                    show_alert('Import Government Contribution Data Error', response, 'error');
                }
            }
        });
    });

    $(document).on('click','#clear-import-government-contribution',function() {
        reset_import_table();
    });
}

function reset_import_table(){
    truncate_temporary_table('import government contribution');

    $('#import-government-contribution').removeClass('d-none');
    $('#submit-import-government-contribution').addClass('d-none');
    $('#clear-import-government-contribution').addClass('d-none');
}