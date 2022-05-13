(function($) {
    'use strict';

    $(function() {
        if($('#pay-run-datatable').length){
            initialize_pay_run_table('#pay-run-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_pay_run_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var filter_pay_run_start_date = $('#filter_pay_run_start_date').val();
    var filter_pay_run_end_date = $('#filter_pay_run_end_date').val();
    var filter_generated_start_date = $('#filter_generated_start_date').val();
    var filter_generated_end_date = $('#filter_generated_end_date').val();
    var filter_pay_run_status = $('#filter_pay_run_status').val();
    var type = 'pay run table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'PAY_RUN_ID' },
        { 'data' : 'COVERAGE_DATE' },
        { 'data' : 'GENERATION_DATE' },
        { 'data' : 'STATUS' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '10%', 'aTargets': 1 },
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
                'data': {'type' : type, 'username' : username, 'filter_pay_run_start_date' : filter_pay_run_start_date, 'filter_pay_run_end_date' : filter_pay_run_end_date, 'filter_generated_start_date' : filter_generated_start_date, 'filter_generated_end_date' : filter_generated_end_date, 'filter_pay_run_status' : filter_pay_run_status},
                'dataSrc' : ''
            },
            dom:  "<'row'<'col-sm-3'l><'col-sm-6 text-center mb-2'B><'col-sm-3'f>>" +  "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'csv', 'excel', 'pdf'
            ],
            'order': [[ 1, 'desc' ]],
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
                'data': {'type' : type, 'username' : username, 'filter_pay_run_start_date' : filter_pay_run_start_date, 'filter_pay_run_end_date' : filter_pay_run_end_date, 'filter_generated_start_date' : filter_generated_start_date, 'filter_generated_end_date' : filter_generated_end_date, 'filter_pay_run_status' : filter_pay_run_status},
                'dataSrc' : ''
            },
            'order': [[ 1, 'desc' ]],
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

    $(document).on('click','.view-pay-run',function() {
        var pay_run_id = $(this).data('pay-run-id');

        sessionStorage.setItem('pay_run_id', pay_run_id);

        generate_modal('pay run details', 'Pay Run Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-pay-run',function() {
        generate_modal('pay run form', 'Pay run', 'LG' , '0', '1', 'form', 'pay-run-form', '1', username);
    });

    $(document).on('click','.update-pay-run',function() {
        var pay_run_id = $(this).data('pay-run-id');

        sessionStorage.setItem('pay_run_id', pay_run_id);
        
        generate_modal('pay run form', 'Pay run', 'LG' , '0', '1', 'form', 'pay-run-form', '1', username);
    });

    $(document).on('click','.unlock-pay-run',function() {
        var pay_run_id = $(this).data('pay-run-id');
        var transaction = 'unlock pay run';

        Swal.fire({
            title: 'Unlock Pay Run',
            text: 'Are you sure you want to unlock this pay run?',
            icon: 'info',
            showCancelButton: !0,
            confirmButtonText: 'Unlock',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-success mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, pay_run_id : pay_run_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Unlocked'){
                          show_alert('Unlock Pay Run', 'The pay run has been unlocked.', 'success');

                          reload_datatable('#pay-run-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Unlock Pay Run', 'The pay run does not exist.', 'info');
                        }
                        else{
                          show_alert('Unlock Pay Run', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','.lock-pay-run',function() {
        var pay_run_id = $(this).data('pay-run-id');
        var transaction = 'lock pay run';

        Swal.fire({
            title: 'Lock Pay Run',
            text: 'Are you sure you want to lock this pay run?',
            icon: 'warning',
            showCancelButton: !0,
            confirmButtonText: 'Lock',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-danger mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, pay_run_id : pay_run_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Locked'){
                          show_alert('Lock Pay Run', 'The pay run has been locked.', 'success');

                          reload_datatable('#pay-run-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Lock Pay Run', 'The pay run does not exist.', 'info');
                        }
                        else{
                          show_alert('Lock Pay Run', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','.send-payslip',function() {
        var pay_run_id = $(this).data('pay-run-id');

        sessionStorage.setItem('pay_run_id', pay_run_id);
        
        generate_modal('send payslip form', 'Send Payslip', 'LG' , '0', '1', 'form', 'send-payslip-form', '1', username);
    });
    
    $(document).on('click','.delete-pay-run',function() {
        var pay_run_id = $(this).data('pay-run-id');
        var transaction = 'delete pay run';

        Swal.fire({
            title: 'Delete Pay Run',
            text: 'Are you sure you want to delete this pay run?',
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
                    data: {username : username, pay_run_id : pay_run_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Pay Run', 'The pay run has been deleted.', 'success');

                          reload_datatable('#pay-run-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Pay Run', 'The pay run does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Pay Run', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-pay-run',function() {
        var pay_run_id = [];
        var transaction = 'delete multiple pay run';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                pay_run_id.push(this.value);  
            }
        });

        if(pay_run_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Pay Runs',
                text: 'Are you sure you want to delete these pay runs?',
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
                        data: {username : username, pay_run_id : pay_run_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Pay Runs', 'The pay runs have been deleted.', 'success');
    
                                reload_datatable('#pay-run-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Pay Runs', 'The pay run does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Pay Runs', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Pay Runs', 'Please select the pay runs you want to delete.', 'error');
        }
    });

    $(document).on('click','#lock-pay-run',function() {
        var pay_run_id = [];
        var transaction = 'lock multiple pay run';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                pay_run_id.push(this.value);  
            }
        });

        if(pay_run_id.length > 0){
            Swal.fire({
                title: 'Lock Multiple Pay Runs',
                text: 'Are you sure you want to lock these pay runs?',
                icon: 'warning',
                showCancelButton: !0,
                confirmButtonText: 'Lock',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-danger mt-2',
                cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
                buttonsStyling: !1
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: 'controller.php',
                        data: {username : username, pay_run_id : pay_run_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Locked'){
                              show_alert('Lock Pay Runs', 'The pay runs have been locked.', 'success');
    
                              reload_datatable('#pay-run-datatable');
                            }
                            else if(response === 'Not Found'){
                              show_alert('Lock Pay Runs', 'The pay run does not exist.', 'info');
                            }
                            else{
                              show_alert('Lock Pay Runs', response, 'error');
                            }
                        }
                    });
                    return false;
                }
            });
        }
        else{
            show_alert('Lock Multiple Pay Runs', 'Please select the pay runs you want to lock.', 'error');
        }
    });

    $(document).on('click','#unlock-pay-run',function() {
        var pay_run_id = [];
        var transaction = 'unlock multiple pay run';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                pay_run_id.push(this.value);  
            }
        });

        if(pay_run_id.length > 0){
            Swal.fire({
                title: 'Unlock Multiple Pay Runs',
                text: 'Are you sure you want to unlock these pay runs?',
                icon: 'info',
                showCancelButton: !0,
                confirmButtonText: 'Unlock',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-success mt-2',
                cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
                buttonsStyling: !1
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: 'controller.php',
                        data: {username : username, pay_run_id : pay_run_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Unlocked'){
                              show_alert('Unlock Pay Runs', 'The pay runs have been unlocked.', 'success');
    
                              reload_datatable('#pay-run-datatable');
                            }
                            else if(response === 'Not Found'){
                              show_alert('Unlock Pay Runs', 'The pay run does not exist.', 'info');
                            }
                            else{
                              show_alert('Unlock Pay Runs', response, 'error');
                            }
                        }
                    });
                    return false;
                }
            });
        }
        else{
            show_alert('Unlock Multiple Pay Runs', 'Please select the pay runs you want to unlock.', 'error');
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_pay_run_table('#pay-run-datatable');
    });
}