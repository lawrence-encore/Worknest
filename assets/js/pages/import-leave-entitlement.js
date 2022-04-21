(function($) {
    'use strict';

    $(function() {
        reset_import_table();

        initialize_click_events();
    });
})(jQuery);

function initialize_temporary_leave_entitlement_table(datatable_name, buttons = false, show_all = false){    
    var username = $('#username').text();
    var type = 'temporary leave entitlement table';
    var settings;

    var column = [ 
        { 'data' : 'LEAVE_ENTITLEMENT_ID' },
        { 'data' : 'EMPLOYEE_ID' },
        { 'data' : 'LEAVE_TYPE' },
        { 'data' : 'NO_LEAVES' },
        { 'data' : 'START_DATE' },
        { 'data' : 'END_DATE' },
    ];

    var column_definition = [
        { 'width': '10%', 'aTargets': 0, 'className' : 'leave_entitlement_id' },
        { 'width': '10%', 'aTargets': 1, 'className' : 'employee_id' },
        { 'width': '10%', 'aTargets': 2, 'className' : 'leave_type' },
        { 'width': '10%', 'aTargets': 3, 'className' : 'no_leaves' },
        { 'width': '10%', 'aTargets': 4, 'className' : 'start_date' },
        { 'width': '10%', 'aTargets': 5, 'className' : 'end_date' }
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

    $(document).on('click','#import-leave-entitlement',function() {
        generate_modal('import leave entitlement form', 'Import Leave Entitlement', 'R' , '0', '1', 'form', 'import-leave-entitlement-form', '1', username);
    });

    $(document).on('click','#submit-import-leave-entitlement',function() {
        var leave_entitlement_id = [];
        var employee_id = [];
        var leave_type = [];
        var no_leaves = [];
        var start_date = [];
        var end_date = [];

        $('.leave_entitlement_id').each(function(){
            leave_entitlement_id.push($(this).text());
        });

        $('.employee_id').each(function(){
            employee_id.push($(this).text());
        });

        $('.leave_type').each(function(){
            leave_type.push($(this).text());
        });

        $('.no_leaves').each(function(){
            no_leaves.push($(this).text());
        });

        $('.start_date').each(function(){
            start_date.push($(this).text());
        });

        $('.end_date').each(function(){
            end_date.push($(this).text());
        });

        leave_entitlement_id.splice(0,2);
        employee_id.splice(0,2);
        leave_type.splice(0,2);
        no_leaves.splice(0,2);
        start_date.splice(0,2);
        end_date.splice(0,2);
       
        var transaction = 'import leave entitlement data';
        var username = $('#username').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'TEXT',
            data: {leave_entitlement_id : leave_entitlement_id, employee_id : employee_id, leave_type : leave_type, no_leaves :no_leaves, start_date : start_date, end_date :end_date, transaction : transaction, username : username},
            success: function(response) {
                if(response === 'Imported'){
                    show_alert('Import Leave Entitlement Date', 'The leave entitlements have been imported.', 'success');
                    reset_import_table();
                }
                else{
                    show_alert('Import Leave Entitlement Data Error', response, 'error');
                }
            }
        });
    });

    $(document).on('click','#clear-import-leave-entitlement',function() {
        reset_import_table();
    });
}

function reset_import_table(){
    truncate_temporary_table('import leave entitlement');

    $('#import-leave-entitlement').removeClass('d-none');
    $('#submit-import-leave-entitlement').addClass('d-none');
    $('#clear-import-leave-entitlement').addClass('d-none');
}