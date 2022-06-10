(function($) {
    'use strict';

    $(function() {
        if($('#job-applicant-datatable').length){
            initialize_job_applicant_table('#job-applicant-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_job_applicant_table(datatable_name, buttons = false, show_all = false){    
    var username = $('#username').text();
    var filter_branch = $('#filter_branch').val();
    var filter_job = $('#filter_job').val();
    var filter_job_category = $('#filter_job_category').val();
    var filter_job_type = $('#filter_job_type').val();
    var filter_start_date = $('#filter_start_date').val();
    var filter_end_date = $('#filter_end_date').val();
    var filter_recruitment_stage = $('#filter_recruitment_stage').val();
    var type = 'job applicant table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'FILE_AS' },
        { 'data' : 'JOB_TITLE' },
        { 'data' : 'APPLICATION_DATE' },
        { 'data' : 'RECRUITMENT_PIPELINE_STAGE' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '35%', 'aTargets': 1 },
        { 'width': '15%', 'aTargets': 2 },
        { 'width': '15%', 'aTargets': 3 },
        { 'width': '15%', 'aTargets': 4 },
        { 'width': '19%','bSortable': false, 'aTargets': 5 },
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_job' : filter_job, 'filter_job_category' : filter_job_category, 'filter_job_type' : filter_job_type, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date, 'filter_recruitment_stage' : filter_recruitment_stage},
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
                'data': {'type' : type, 'username' : username, 'filter_branch' : filter_branch, 'filter_job' : filter_job, 'filter_job_category' : filter_job_category, 'filter_job_type' : filter_job_type, 'filter_start_date' : filter_start_date, 'filter_end_date' : filter_end_date, 'filter_recruitment_stage' : filter_recruitment_stage},
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

    $(document).on('click','#add-job-applicant',function() {
        generate_modal('job applicant form', 'Job Applicant', 'LG' , '1', '1', 'form', 'job-applicant-form', '1', username);
    });

    $(document).on('click','.update-job-applicant',function() {
        var job_applicant_id = $(this).data('job-applicant-id');

        sessionStorage.setItem('job_applicant_id', job_applicant_id);
        
        generate_modal('job applicant form', 'Job Applicant', 'LG' , '1', '1', 'form', 'job-applicant-form', '0', username);
    });
    
    $(document).on('click','.delete-job-applicant',function() {
        var job_applicant_id = $(this).data('job-applicant-id');
        var transaction = 'delete job applicant';

        Swal.fire({
            title: 'Delete Job Applicant',
            text: 'Are you sure you want to delete this job applicant?',
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
                    data: {username : username, job_applicant_id : job_applicant_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Job Applicant', 'The job applicant has been deleted.', 'success');

                          reload_datatable('#job-applicant-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Job Applicant', 'The job applicant does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Job Applicant', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-job-applicant',function() {
        var job_applicant_id = [];
        var transaction = 'delete multiple job applicant';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                job_applicant_id.push(this.value);  
            }
        });

        if(job_applicant_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Job Applicants',
                text: 'Are you sure you want to delete these job applicants?',
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
                        data: {username : username, job_applicant_id : job_applicant_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Job Applicants', 'The job applicants have been deleted.', 'success');
    
                                reload_datatable('#job-applicant-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Job Applicants', 'The job applicant does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Job Applicants', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Job Applicants', 'Please select the job applicants you want to delete.', 'error');
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_job_applicant_table('#job-applicant-datatable');
    });
}