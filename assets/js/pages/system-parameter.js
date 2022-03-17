(function($) {
    'use strict';

    $(function() {
        if($('#system-parameter-datatable').length){
            initialize_system_parameter_table('#system-parameter-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_system_parameter_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var type = 'system parameter table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'PARAMETER_ID' },
        { 'data' : 'PARAMETER_DESC' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '14%', 'aTargets': 1 },
        { 'width': '65%', 'aTargets': 2 },
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

    $(document).on('click','.view-system-parameter',function() {
        var parameter_id = $(this).data('parameter-id');

        sessionStorage.setItem('parameter_id', parameter_id);

        generate_modal('system parameter details', 'System Parameter Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-system-parameter',function() {
        generate_modal('system parameter form', 'System Parameter', 'R' , '1', '1', 'form', 'system-parameter-form', '1', username);
    });

    $(document).on('click','.update-system-parameter',function() {
        var parameter_id = $(this).data('parameter-id');

        sessionStorage.setItem('parameter_id', parameter_id);

        generate_modal('system parameter form', 'System Parameter', 'R' , '1', '1', 'form', 'system-parameter-form', '0', username);
    });
    
    $(document).on('click','.delete-system-parameter',function() {
        var parameter_id = $(this).data('parameter-id');
        var transaction = 'delete system parameter';

        Swal.fire({
            title: 'Delete System Parameter',
            text: 'Are you sure you want to delete this system parameter?',
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
                    data: {username : username, parameter_id : parameter_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete System Parameter', 'The system parameter has been deleted.', 'success');

                          reload_datatable('#system-parameter-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete System Parameter', 'The system parameter does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete System Parameter', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });
    
    $(document).on('click','#delete-system-parameter',function() {
        var parameter_id = [];
        var transaction = 'delete multiple system parameter';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                parameter_id.push(this.value);  
            }
        });

        if(parameter_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple System Parameters',
                text: 'Are you sure you want to delete these system parameters?',
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
                        data: {username : username, parameter_id : parameter_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple System Parameters', 'The system parameters have been deleted.', 'success');
    
                                reload_datatable('#system-parameter-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple System Parameters', 'The system parameter does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple System Parameters', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple System Parameters', 'Please select the paramaters you want to delete.', 'error');
        }
    });

}