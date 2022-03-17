(function($) {
    'use strict';

    $(function() {
        if($('#employment-status-datatable').length){
            initialize_employment_status_table('#employment-status-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_employment_status_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var type = 'employment status table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'EMPLOYMENT_STATUS' },
        { 'data' : 'PREVIEW' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '54%', 'aTargets': 1 },
        { 'width': '25%', 'aTargets': 2 },
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

    $(document).on('click','#add-employment-status',function() {
        generate_modal('employment status form', 'Employment Status', 'R' , '1', '1', 'form', 'employment-status-form', '1', username);
    });

    $(document).on('click','.update-employment-status',function() {
        var employment_status_id = $(this).data('employment-status-id');

        sessionStorage.setItem('employment_status_id', employment_status_id);
        
        generate_modal('employment status form', 'Employment Status', 'R' , '1', '1', 'form', 'employment-status-form', '0', username);
    });
    
    $(document).on('click','.delete-employment-status',function() {
        var employment_status_id = $(this).data('employment-status-id');
        var transaction = 'delete employment status';

        Swal.fire({
            title: 'Delete Employment Status',
            text: 'Are you sure you want to delete this employment status?',
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
                    data: {username : username, employment_status_id : employment_status_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Employment Status', 'The employment status has been deleted.', 'success');

                          reload_datatable('#employment-status-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Employment Status', 'The employment status does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Employment Status', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-employment-status',function() {
        var employment_status_id = [];
        var transaction = 'delete multiple employment status';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                employment_status_id.push(this.value);  
            }
        });

        if(employment_status_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Employment Status',
                text: 'Are you sure you want to delete these employment status?',
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
                        data: {username : username, employment_status_id : employment_status_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Employment Status', 'The employment status have been deleted.', 'success');
    
                                reload_datatable('#employment-status-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Employment Status', 'The employment status does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Employment Status', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Employment Status', 'Please select the employment status you want to delete.', 'error');
        }
    });

}