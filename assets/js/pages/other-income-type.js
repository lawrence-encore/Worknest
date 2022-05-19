(function($) {
    'use strict';

    $(function() {
        if($('#other-income-type-datatable').length){
            initialize_allowance_type_table('#other-income-type-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_allowance_type_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var type = 'other income type table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'OTHER_INCOME_TYPE' },
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

    $(document).on('click','#add-other-income-type',function() {
        generate_modal('other income type form', 'Other Income Type', 'R' , '1', '1', 'form', 'other-income-type-form', '1', username);
    });

    $(document).on('click','.update-other-income-type',function() {
        var allowance_type_id = $(this).data('other-income-type-id');

        sessionStorage.setItem('allowance_type_id', allowance_type_id);
        
        generate_modal('other income type form', 'Other Income Type', 'R' , '1', '1', 'form', 'other-income-type-form', '0', username);
    });
    
    $(document).on('click','.delete-other-income-type',function() {
        var allowance_type_id = $(this).data('other-income-type-id');
        var transaction = 'delete other income type';

        Swal.fire({
            title: 'Delete Other Income Type',
            text: 'Are you sure you want to delete this other income type?',
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
                    data: {username : username, allowance_type_id : allowance_type_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Other Income Type', 'The other income type has been deleted.', 'success');

                          reload_datatable('#other-income-type-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Other Income Type', 'The other income type does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Other Income Type', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-other-income-type',function() {
        var allowance_type_id = [];
        var transaction = 'delete multiple other income type';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                allowance_type_id.push(this.value);  
            }
        });

        if(allowance_type_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Other Income Types',
                text: 'Are you sure you want to delete these other income types?',
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
                        data: {username : username, allowance_type_id : allowance_type_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Other Income Types', 'The other income types have been deleted.', 'success');
    
                                reload_datatable('#other-income-type-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Other Income Types', 'The other income type does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Other Income Types', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Other Income Types', 'Please select the other income types you want to delete.', 'error');
        }
    });

}