(function($) {
    'use strict';

    $(function() {
        if($('#job-category-datatable').length){
            initialize_job_category_table('#job-category-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_job_category_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var type = 'job category table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'JOB_CATEGORY' },
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

    $(document).on('click','#add-job-category',function() {
        generate_modal('job category form', 'Job Category', 'R' , '1', '1', 'form', 'job-category-form', '1', username);
    });

    $(document).on('click','.update-job-category',function() {
        var job_category_id = $(this).data('job-category-id');

        sessionStorage.setItem('job_category_id', job_category_id);
        
        generate_modal('job category form', 'Job Category', 'R' , '1', '1', 'form', 'job-category-form', '0', username);
    });
    

    $(document).on('click','.delete-job-category',function() {
        var job_category_id = $(this).data('job-category-id');
        var transaction = 'delete job category';

        Swal.fire({
            title: 'Delete Job Category',
            text: 'Are you sure you want to delete this job category?',
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
                    data: {username : username, job_category_id : job_category_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Job Category', 'The job category has been deleted.', 'success');

                          reload_datatable('#job-category-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Job Category', 'The job category does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Job Category', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-job-category',function() {
        var job_category_id = [];
        var transaction = 'delete multiple job category';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                job_category_id.push(this.value);  
            }
        });

        if(job_category_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Job Categories',
                text: 'Are you sure you want to delete these job categories?',
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
                        data: {username : username, job_category_id : job_category_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Job Categories', 'The job categories have been deleted.', 'success');
    
                                reload_datatable('#job-category-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Job Categories', 'The job categories does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Job Categories', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Job Categories', 'Please select the job categories you want to delete.', 'error');
        }
    });

}