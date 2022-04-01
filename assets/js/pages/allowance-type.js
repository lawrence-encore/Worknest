(function($) {
    'use strict';

    $(function() {
        if($('#allowance-type-datatable').length){
            initialize_allowance_type_table('#allowance-type-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_allowance_type_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var type = 'allowance type table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'ALLOWANCE_TYPE' },
        { 'data' : 'TAXABLE' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '59%', 'aTargets': 1 },
        { 'width': '20%', 'aTargets': 2 },
        { 'width': '20%','bSortable': false, 'aTargets': 3 },
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

    $(document).on('click','#add-allowance-type',function() {
        generate_modal('allowance type form', 'Allowance Type', 'R' , '1', '1', 'form', 'allowance-type-form', '1', username);
    });

    $(document).on('click','.update-allowance-type',function() {
        var allowance_typeid = $(this).data('allowance-type-id');

        sessionStorage.setItem('allowance_typeid', allowance_typeid);
        
        generate_modal('allowance type form', 'Allowance Type', 'R' , '1', '1', 'form', 'allowance-type-form', '0', username);
    });
    
    $(document).on('click','.delete-allowance-type',function() {
        var allowance_typeid = $(this).data('allowance-type-id');
        var transaction = 'delete allowance type';

        Swal.fire({
            title: 'Delete Allowance Type',
            text: 'Are you sure you want to delete this allowance type?',
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
                    data: {username : username, allowance_typeid : allowance_typeid, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Allowance Type', 'The allowance type has been deleted.', 'success');

                          reload_datatable('#allowance-type-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Allowance Type', 'The allowance type does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Allowance Type', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-allowance-type',function() {
        var allowance_typeid = [];
        var transaction = 'delete multiple allowance type';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                allowance_typeid.push(this.value);  
            }
        });

        if(allowance_typeid.length > 0){
            Swal.fire({
                title: 'Delete Multiple Allowance Types',
                text: 'Are you sure you want to delete these allowance types?',
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
                        data: {username : username, allowance_typeid : allowance_typeid, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Allowance Types', 'The allowance types have been deleted.', 'success');
    
                                reload_datatable('#allowance-type-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Allowance Types', 'The allowance type does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Allowance Types', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Allowance Types', 'Please select the allowance types you want to delete.', 'error');
        }
    });

}