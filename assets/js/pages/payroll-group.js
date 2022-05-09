(function($) {
    'use strict';

    $(function() {
        if($('#payroll-group-datatable').length){
            initialize_payroll_group_table('#payroll-group-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_payroll_group_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var type = 'payroll group table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'PAYROLL_GROUP' },
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

    $(document).on('click','.view-payroll-group',function() {
        var payroll_group_id = $(this).data('payroll-group-id');

        sessionStorage.setItem('payroll_group_id', payroll_group_id);

        generate_modal('payroll group details', 'Payroll Group Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-payroll-group',function() {
        generate_modal('payroll group form', 'Payroll Group', 'R' , '1', '1', 'form', 'payroll-group-form', '1', username);
    });

    $(document).on('click','.update-payroll-group',function() {
        var payroll_group_id = $(this).data('payroll-group-id');

        sessionStorage.setItem('payroll_group_id', payroll_group_id);
        
        generate_modal('payroll group form', 'Payroll Group', 'R' , '1', '1', 'form', 'payroll-group-form', '0', username);
    });
    
    $(document).on('click','.delete-payroll-group',function() {
        var payroll_group_id = $(this).data('payroll-group-id');
        var transaction = 'delete payroll group';

        Swal.fire({
            title: 'Delete Payroll Group',
            text: 'Are you sure you want to delete this payroll group?',
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
                    data: {username : username, payroll_group_id : payroll_group_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Payroll Group', 'The payroll group has been deleted.', 'success');

                          reload_datatable('#payroll-group-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Payroll Group', 'The payroll group does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Payroll Group', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-payroll-group',function() {
        var payroll_group_id = [];
        var transaction = 'delete multiple payroll group';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                payroll_group_id.push(this.value);  
            }
        });

        if(payroll_group_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Payroll Groups',
                text: 'Are you sure you want to delete these payroll groups?',
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
                        data: {username : username, payroll_group_id : payroll_group_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Payroll Groups', 'The payroll groups have been deleted.', 'success');
    
                                reload_datatable('#payroll-group-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Payroll Groups', 'The payroll group does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Payroll Groups', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Payroll Groups', 'Please select the payroll groups you want to delete.', 'error');
        }
    });

}