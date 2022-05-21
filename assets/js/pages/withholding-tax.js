(function($) {
    'use strict';

    $(function() {
        if($('#withholding-tax-datatable').length){
            initialize_withholding_tax_table('#withholding-tax-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_withholding_tax_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var type = 'withholding tax table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'SALARY_FREQUENCY' },
        { 'data' : 'COMPENSATION_RANGE' },
        { 'data' : 'FIX_COMPENSATION_LEVEL' },
        { 'data' : 'BASE_TAX' },
        { 'data' : 'PERCENT_OVER' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '29%', 'aTargets': 1 },
        { 'width': '20%', 'aTargets': 2 },
        { 'width': '20%', 'aTargets': 3 },
        { 'width': '20%', 'aTargets': 4 },
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

    $(document).on('click','#add-withholding-tax',function() {
        generate_modal('withholding tax form', 'Withholding Tax', 'LG' , '1', '1', 'form', 'withholding-tax-form', '1', username);
    });

    $(document).on('click','.update-withholding-tax',function() {
        var withholding_tax_id = $(this).data('withholding-tax-id');

        sessionStorage.setItem('withholding_tax_id', withholding_tax_id);
        
        generate_modal('withholding tax form', 'Withholding Tax', 'LG' , '1', '1', 'form', 'withholding-tax-form', '0', username);
    });
    
    $(document).on('click','.delete-withholding-tax',function() {
        var withholding_tax_id = $(this).data('withholding-tax-id');
        var transaction = 'delete withholding tax';

        Swal.fire({
            title: 'Delete Withholding Tax',
            text: 'Are you sure you want to delete this withholding tax?',
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
                    data: {username : username, withholding_tax_id : withholding_tax_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Withholding Tax', 'The withholding tax has been deleted.', 'success');

                          reload_datatable('#withholding-tax-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Withholding Tax', 'The withholding tax does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Withholding Tax', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-withholding-tax',function() {
        var withholding_tax_id = [];
        var transaction = 'delete multiple withholding tax';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                withholding_tax_id.push(this.value);  
            }
        });

        if(withholding_tax_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Withholding Taxes',
                text: 'Are you sure you want to delete these withholding taxes?',
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
                        data: {username : username, withholding_tax_id : withholding_tax_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Withholding Taxes', 'The withholding taxes have been deleted.', 'success');
    
                                reload_datatable('#withholding-tax-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Withholding Taxes', 'The withholding tax does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Withholding Taxes', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Withholding Taxes', 'Please select the withholding taxes you want to delete.', 'error');
        }
    });

}