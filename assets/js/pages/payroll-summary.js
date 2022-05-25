(function($) {
    'use strict';

    $(function() {
        if($('#payroll-summary-datatable').length){
            initialize_payroll_summary_table('#payroll-summary-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_payroll_summary_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var filter_branch = $('#filter_branch').val();
    var filter_department = $('#filter_department').val();
    var type = 'payroll summary table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'FILE_AS' },
        { 'data' : 'PAY_RUN' },
        { 'data' : 'GROSS_PAY' },
        { 'data' : 'NET_PAY' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '30%', 'aTargets': 1 },
        { 'width': '20%', 'aTargets': 2 },
        { 'width': '10%', 'aTargets': 3 },
        { 'width': '10%', 'aTargets': 4 },
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
                'data': {'type' : type, 'username' : username, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date, 'filter_branch' : filter_branch, 'filter_department' : filter_department},
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
                'data': {'type' : type, 'username' : username, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date, 'filter_branch' : filter_branch, 'filter_department' : filter_department},
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

    $(document).on('click','.view-payslip',function() {
        var payslip_id = $(this).data('payslip-id');

        sessionStorage.setItem('payslip_id', payslip_id);

        generate_modal('payslip details', 'Payslip Details', 'XL' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','.send-payslip',function() {
        var payslip_id = $(this).data('payslip-id');
        var transaction = 'send payslip';

        Swal.fire({
            title: 'Send Payslip',
            text: 'Are you sure you want to send this payslip?',
            icon: 'info',
            showCancelButton: !0,
            confirmButtonText: 'Send',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-success mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, payslip_id : payslip_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Sent'){
                          show_alert('Send Payslip', 'The payslip has been sent.', 'success');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Send Payslip', 'The payslip does not exist.', 'info');
                        }
                        else if(response === 'Email'){
                          show_alert('Send Payslip Error', 'The email of the employee does is empty.', 'error');
                        }
                        else if(response === 'Invalid Email'){
                          show_alert('Send Payslip Error', 'The email of the employee does is not valid.', 'error');
                        }
                        else{
                          show_alert('Send Payslip', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#send-payslip',function() {
        var payslip_id = [];
        var transaction = 'send multiple payslip';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                payslip_id.push(this.value);  
            }
        });

        if(payslip_id.length > 0){
            Swal.fire({
                title: 'Send Multiple Payslips',
                text: 'Are you sure you want to send these payslips?',
                icon: 'info',
                showCancelButton: !0,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-success mt-2',
                cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
                buttonsStyling: !1
            }).then(function(result) {
                if (result.value) {
                    
                    $.ajax({
                        type: 'POST',
                        url: 'controller.php',
                        data: {username : username, payslip_id : payslip_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Sent'){
                                show_alert('Send Payslip', 'The payslip has been sent.', 'success');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Send Multiple Payslip', 'The payslip does not exist.', 'info');
                            }
                            else if(response === 'Email'){
                                show_alert('Send Multiple Payslip Error', 'The email of the employee does is empty.', 'error');
                            }
                            else if(response === 'Invalid Email'){
                                show_alert('Send Multiple Payslip Error', 'The email of the employee does is not valid.', 'error');
                            }
                            else{
                                show_alert('Send Multiple Payslip', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Send Multiple Payslips', 'Please select the payslips you want to send.', 'error');
        }
    });
    
    $(document).on('click','.delete-payslip',function() {
        var payslip_id = $(this).data('payslip-id');
        var transaction = 'delete payslip';

        Swal.fire({
            title: 'Delete Payslip',
            text: 'Are you sure you want to delete this payslip?',
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
                    data: {username : username, payslip_id : payslip_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Payslip', 'The payslip has been deleted.', 'success');

                          reload_datatable('#payroll-summary-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Payslip', 'The payslip does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Payslip', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-payslip',function() {
        var payslip_id = [];
        var transaction = 'delete multiple payslip';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                payslip_id.push(this.value);  
            }
        });

        if(payslip_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Payslips',
                text: 'Are you sure you want to delete these payslips?',
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
                        data: {username : username, payslip_id : payslip_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Payslips', 'The payslips have been deleted.', 'success');
    
                                reload_datatable('#payroll-summary-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Payslips', 'The payslip does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Payslips', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Payslips', 'Please select the payslips you want to delete.', 'error');
        }
    });

    $(document).on('click','#print-payslip',function() {
        var payslip_id = [];
        var transaction = 'print multiple payslip';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                payslip_id.push(this.value);  
            }
        });

        if(payslip_id.length > 0){
            Swal.fire({
                title: 'Print Multiple Payslips',
                text: 'Are you sure you want to print these payslips?',
                icon: 'info',
                showCancelButton: !0,
                confirmButtonText: 'Print',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-info mt-2',
                cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
                buttonsStyling: !1
            }).then(function(result) {
                if (result.value) {
                    
                    $.ajax({
                        type: 'POST',
                        url: 'controller.php',
                        data: {username : username, payslip_id : payslip_id, transaction : transaction},
                        success: function (response) {
                            window.open(response, '_blank');
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Print Multiple Payslips', 'Please select the payslips you want to print.', 'error');
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_payroll_summary_table('#payroll-summary-datatable');
    });
}