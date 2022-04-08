(function($) {
    'use strict';

    $(function() {
        if($('#deduction-type-datatable').length){
            initialize_deduction_type_table('#deduction-type-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_deduction_type_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var type = 'deduction type table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'DEDUCTION_TYPE' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '79%', 'aTargets': 1 },
        { 'width': '20%','bSortable': false, 'aTargets': 2 },
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

    $(document).on('click','#add-deduction-type',function() {
        generate_modal('deduction type form', 'Deduction Type', 'R' , '1', '1', 'form', 'deduction-type-form', '1', username);
    });

    $(document).on('click','.update-deduction-type',function() {
        var deduction_type_id = $(this).data('deduction-type-id');

        sessionStorage.setItem('deduction_type_id', deduction_type_id);
        
        generate_modal('deduction type form', 'Deduction Type', 'R' , '1', '1', 'form', 'deduction-type-form', '0', username);
    });
    
    $(document).on('click','.delete-deduction-type',function() {
        var deduction_type_id = $(this).data('deduction-type-id');
        var transaction = 'delete deduction type';

        Swal.fire({
            title: 'Delete Deduction Type',
            text: 'Are you sure you want to delete this deduction type?',
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
                    data: {username : username, deduction_type_id : deduction_type_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Deduction Type', 'The deduction type has been deleted.', 'success');

                          reload_datatable('#deduction-type-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Deduction Type', 'The deduction type does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Deduction Type', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-deduction-type',function() {
        var deduction_type_id = [];
        var transaction = 'delete multiple deduction type';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                deduction_type_id.push(this.value);  
            }
        });

        if(deduction_type_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Deduction Types',
                text: 'Are you sure you want to delete these deduction types?',
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
                        data: {username : username, deduction_type_id : deduction_type_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Deduction Types', 'The deduction types have been deleted.', 'success');
    
                                reload_datatable('#deduction-type-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Deduction Types', 'The deduction type does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Deduction Types', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Deduction Types', 'Please select the deduction types you want to delete.', 'error');
        }
    });

}