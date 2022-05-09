(function($) {
    'use strict';

    $(function() {
        if($('#salary-datatable').length){
            initialize_salary_table('#salary-datatable');
        }

        initialize_click_events();
        initialize_on_change_events();
    });
})(jQuery);

function initialize_salary_table(datatable_name, buttons = false, show_all = false){
    var username = $('#username').text();
    var filter_branch = $('#filter_branch').val();
    var filter_department = $('#filter_department').val();
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var filter_salary_type = $('#filter_salary_type').val();
    var type = 'salary table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'FILE_AS' },
        { 'data' : 'SALARY_AMOUNT' },
        { 'data' : 'EFFECTIVITY_DATE' },
        { 'data' : 'REMARKS' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '29%', 'aTargets': 1 },
        { 'width': '15%', 'aTargets': 2 },
        { 'width': '15%', 'aTargets': 3 },
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date, 'filter_salary_type' : filter_salary_type},
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" salary="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }
    else{
        settings = {
            'ajax': { 
                'url' : 'system-generation.php',
                'method' : 'POST',
                'dataType': 'JSON',
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_department' : filter_department, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date, 'filter_salary_type' : filter_salary_type},
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
                'loadingRecords': '<div class="spinner-border spinner-border-lg text-info" salary="status"><span class="sr-only">Loading...</span></div>'
            }
        };
    }

    destroy_datatable(datatable_name);
    
    $(datatable_name).dataTable(settings);
}

function initialize_click_events(){
    var username = $('#username').text();

    $(document).on('click','.view-salary',function() {
        var salary_id = $(this).data('salary-id');

        sessionStorage.setItem('salary_id', salary_id);

        generate_modal('salary details', 'Salary Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-salary',function() {
        generate_modal('salary form', 'Salary', 'LG' , '0', '1', 'form', 'salary-form', '1', username);
    });

    $(document).on('click','.update-salary',function() {
        var salary_id = $(this).data('salary-id');

        sessionStorage.setItem('salary_id', salary_id);
        
        generate_modal('salary update form', 'Salary', 'LG' , '0', '1', 'form', 'salary-update-form', '0', username);
    });
    
    $(document).on('click','.delete-salary',function() {
        var salary_id = $(this).data('salary-id');
        var transaction = 'delete salary';

        Swal.fire({
            title: 'Delete Salary',
            text: 'Are you sure you want to delete this salary?',
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
                    data: {username : username, salary_id : salary_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Salary', 'The salary has been deleted.', 'success');

                          reload_datatable('#salary-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Salary', 'The salary does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Salary', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-salary',function() {
        var salary_id = [];
        var transaction = 'delete multiple salary';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                salary_id.push(this.value);  
            }
        });

        if(salary_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Salaries',
                text: 'Are you sure you want to delete these salaries?',
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
                        data: {username : username, salary_id : salary_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Salaries', 'The salaries have been deleted.', 'success');
    
                                reload_datatable('#salary-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Salaries', 'The salary does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Salaries', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Salaries', 'Please select the salaries you want to delete.', 'error');
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_salary_table('#salary-datatable');
    });
}

function calculate_salary_rate(){
    var transaction = 'calculate salary rate';
    var salary_amount = $('#salary_amount').val();
    var salary_frequency = $('#salary_frequency').val();
    var hours_per_week = $('#hours_per_week').val();
    var hours_per_day = $('#hours_per_day').val();

    $.ajax({
        url: 'controller.php',
        method: 'POST',
        dataType: 'JSON',
        data: {salary_amount : salary_amount, salary_frequency : salary_frequency, hours_per_week : hours_per_week, hours_per_day : hours_per_day, transaction : transaction},
        success: function(response) {
            $('#minute_rate').val(response[0].MINUTE_RATE);
            $('#hourly_rate').val(response[0].HOURLY_RATE);
            $('#daily_rate').val(response[0].DAILY_RATE);
            $('#weekly_rate').val(response[0].WEEKLY_RATE);
            $('#bi_weekly_rate').val(response[0].BI_WEEKLY_RATE);
            $('#monthly_rate').val(response[0].MONTHLY_RATE);
        }
    });
}

function initialize_on_change_events(){
    $(document).on('change','#salary_amount',function() {
        calculate_salary_rate();
    });

    $(document).on('change','#salary_frequency',function() {
        calculate_salary_rate();
    });

    $(document).on('change','#hours_per_week',function() {
        calculate_salary_rate();
    });

    $(document).on('change','#hours_per_day',function() {
        calculate_salary_rate();
    });
}