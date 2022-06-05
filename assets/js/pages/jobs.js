(function($) {
    'use strict';

    $(function() {
        if($('#job-datatable').length){
            initialize_job_table('#job-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_job_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var filter_job_type = $('#filter_job_type').val();
    var filter_job_category = $('#filter_job_category').val();
    var filter_recruitment_pipeline = $('#filter_recruitment_pipeline').val();
    var filter_recruitment_scorecard = $('#filter_recruitment_scorecard').val();
    var filter_status = $('#filter_status').val();
    var filter_branch = $('#filter_branch').val();
    var filter_team_member = $('#filter_team_member').val();
    var type = 'job table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'JOB_TITLE' },
        { 'data' : 'JOB_CATEGORY' },
        { 'data' : 'JOB_TYPE' },
        { 'data' : 'STATUS' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '20%', 'aTargets': 1 },
        { 'width': '15%', 'aTargets': 2 },
        { 'width': '15%', 'aTargets': 3 },
        { 'width': '15%', 'aTargets': 4 },
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
                'data': {'type' : type, 'filter_job_type' : filter_job_type, 'filter_job_category' : filter_job_category, 'filter_recruitment_pipeline' : filter_recruitment_pipeline, 'filter_recruitment_scorecard' : filter_recruitment_scorecard, 'filter_status' : filter_status, 'filter_branch' : filter_branch, 'filter_team_member' : filter_team_member, 'username' : username},
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
                'data': {'type' : type, 'filter_job_type' : filter_job_type, 'filter_job_category' : filter_job_category, 'filter_recruitment_pipeline' : filter_recruitment_pipeline, 'filter_recruitment_scorecard' : filter_recruitment_scorecard, 'filter_status' : filter_status, 'filter_branch' : filter_branch, 'filter_team_member' : filter_team_member, 'username' : username},
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

    $(document).on('click','.view-job',function() {
        var job_id = $(this).data('job-id');

        sessionStorage.setItem('job_id', job_id);

        generate_modal('job details', 'Job Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-job',function() {
        generate_modal('job form', 'Job', 'LG' , '1', '1', 'form', 'job-form', '1', username);
    });

    $(document).on('click','.update-job',function() {
        var job_id = $(this).data('job-id');

        sessionStorage.setItem('job_id', job_id);
        
        generate_modal('job form', 'Job', 'LG' , '1', '1', 'form', 'job-form', '0', username);
    });

    $(document).on('click','.delete-job',function() {
        var job_id = $(this).data('job-id');
        var transaction = 'delete job';

        Swal.fire({
            title: 'Delete Job',
            text: 'Are you sure you want to delete this job?',
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
                    data: {username : username, job_id : job_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Job', 'The job has been deleted.', 'success');

                          reload_datatable('#job-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Job', 'The job does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Job', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-job',function() {
        var job_id = [];
        var transaction = 'delete multiple job';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                job_id.push(this.value);  
            }
        });

        if(job_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Jobs',
                text: 'Are you sure you want to delete these jobs?',
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
                        data: {username : username, job_id : job_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Jobs', 'The jobs have been deleted.', 'success');
    
                                reload_datatable('#job-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Jobs', 'The jobs does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Jobs', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Jobs', 'Please select the jobs you want to delete.', 'error');
        }
    });

    $(document).on('click','.activate-job',function() {
        var job_id = $(this).data('job-id');
        var transaction = 'activate job';

        Swal.fire({
            title: 'Activate Job',
            text: 'Are you sure you want to activate this job?',
            icon: 'info',
            showCancelButton: !0,
            confirmButtonText: 'Activate',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-success mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, job_id : job_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Activated'){
                          show_alert('Activate Job', 'The job has been activated.', 'success');

                          reload_datatable('#job-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Activate Job', 'The job does not exist.', 'info');
                        }
                        else{
                          show_alert('Activate Job', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','.deactivate-job',function() {
        var job_id = $(this).data('job-id');
        var transaction = 'deactivate job';

        Swal.fire({
            title: 'Deactivate Job',
            text: 'Are you sure you want to deactivate this job?',
            icon: 'warning',
            showCancelButton: !0,
            confirmButtonText: 'Deactivate',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-danger mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, job_id : job_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deactivated'){
                          show_alert('Deactivate Job', 'The job has been deactivated.', 'success');

                          reload_datatable('#job-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Deactivate Job', 'The job does not exist.', 'info');
                        }
                        else{
                          show_alert('Deactivate Job', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#activate-job',function() {
        var job_id = [];
        var transaction = 'activate multiple job';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                job_id.push(this.value);  
            }
        });

        if(job_id.length > 0){
            Swal.fire({
                title: 'Activate Multiple Jobs',
                text: 'Are you sure you want to activate these jobs?',
                icon: 'info',
                showCancelButton: !0,
                confirmButtonText: 'Activate',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-success mt-2',
                cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
                buttonsStyling: !1
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: 'controller.php',
                        data: {username : username, job_id : job_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Activated'){
                              show_alert('Activate Multiple Jobs', 'The jobs have been activated.', 'success');
    
                              reload_datatable('#job-datatable');
                            }
                            else if(response === 'Not Found'){
                              show_alert('Activate Multiple Jobs', 'The job does not exist.', 'info');
                            }
                            else{
                              show_alert('Activate Multiple Jobs', response, 'error');
                            }
                        }
                    });
                    return false;
                }
            });
        }
        else{
            show_alert('Activate Multiple Jobs', 'Please select the jobs you want to activate.', 'error');
        }
    });

    $(document).on('click','#deactivate-job',function() {
        var job_id = [];
        var transaction = 'deactivate multiple job';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                job_id.push(this.value);  
            }
        });

        if(job_id.length > 0){
            Swal.fire({
                title: 'Deactivate Multiple Jobs',
                text: 'Are you sure you want to deactivate these jobs?',
                icon: 'warning',
                showCancelButton: !0,
                confirmButtonText: 'Deactivate',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-danger mt-2',
                cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
                buttonsStyling: !1
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: 'controller.php',
                        data: {username : username, job_id : job_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deactivated'){
                              show_alert('Deactivate Multiple Job', 'The jobs have been deactivated.', 'success');
    
                              reload_datatable('#job-datatable');
                            }
                            else if(response === 'Not Found'){
                              show_alert('Deactivate Multiple Job', 'The job does not exist.', 'info');
                            }
                            else{
                              show_alert('Deactivate Multiple Job', response, 'error');
                            }
                        }
                    });
                    return false;
                }
            });
        }
        else{
            show_alert('Deactivate Multiple Jobs', 'Please select the jobs you want to deactivate.', 'error');
        }
    });

    $(document).on('click','#apply-filter',function() {
        initialize_job_table('#job-datatable');
    });

}