(function($) {
    'use strict';

    $(function() {
        if($('#recruitment-pipeline-stage-datatable').length){
            initialize_recruitment_pipeline_stage_table('#recruitment-pipeline-stage-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_recruitment_pipeline_stage_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var recruitment_pipeline_id = $('#recruitment-pipeline-id').text();
    var type = 'recruitment pipeline stage table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'STAGE_ORDER' },
        { 'data' : 'RECRUITMENT_PIPELINE_STAGE' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '9%', 'aTargets': 1 },
        { 'width': '70%', 'aTargets': 2 },
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
                'data': {'type' : type, 'username' : username, 'recruitment_pipeline_id' : recruitment_pipeline_id},
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
                'data': {'type' : type, 'username' : username, 'recruitment_pipeline_id' : recruitment_pipeline_id},
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

    $(document).on('click','#add-recruitment-pipeline-stage',function() {
        generate_modal('recruitment pipeline stage form', 'Recruitment Pipeline Stage', 'R' , '1', '1', 'form', 'recruitment-pipeline-stage-form', '1', username);
    });

    $(document).on('click','.update-recruitment-pipeline-stage',function() {
        var recruitment_pipeline_stage_id = $(this).data('recruitment-pipeline-stage-id');

        sessionStorage.setItem('recruitment_pipeline_stage_id', recruitment_pipeline_stage_id);
        
        generate_modal('recruitment pipeline stage form', 'Recruitment Pipeline Stage', 'R' , '1', '1', 'form', 'recruitment-pipeline-stage-form', '0', username);
    });
    
    $(document).on('click','.delete-recruitment-pipeline-stage',function() {
        var recruitment_pipeline_stage_id = $(this).data('recruitment-pipeline-stage-id');
        var transaction = 'delete recruitment pipeline stage';

        Swal.fire({
            title: 'Delete Recruitment Pipeline Stage',
            text: 'Are you sure you want to delete this recruitment pipeline stage?',
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
                    data: {username : username, recruitment_pipeline_stage_id : recruitment_pipeline_stage_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Recruitment Pipeline Stage', 'The recruitment pipeline stage has been deleted.', 'success');

                          reload_datatable('#recruitment-pipeline-stage-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Recruitment Pipeline Stage', 'The recruitment pipeline stage does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Recruitment Pipeline Stage', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-recruitment-pipeline-stage',function() {
        var recruitment_pipeline_stage_id = [];
        var transaction = 'delete multiple recruitment pipeline stage';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                recruitment_pipeline_stage_id.push(this.value);  
            }
        });

        if(recruitment_pipeline_stage_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Recruitment Pipeline Stages',
                text: 'Are you sure you want to delete these recruitment pipeline stages?',
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
                        data: {username : username, recruitment_pipeline_stage_id : recruitment_pipeline_stage_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Recruitment Pipeline Stages', 'The recruitment pipeline stages have been deleted.', 'success');
    
                                reload_datatable('#recruitment pipeline stage datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Recruitment Pipeline Stages', 'The recruitment pipeline stage does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Recruitment Pipeline Stages', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Recruitment Pipeline Stages', 'Please select the recruitment pipeline stages you want to delete.', 'error');
        }
    });

    $(document).on('click','.recruitment-pipeline-stage-order-up',function() {
        var recruitment_pipeline_stage_id = $(this).data('recruitment-pipeline-stage-id');
        var stage_order = $(this).data('stage-order');
        var transaction = 'order up recruitment pipeline stage';

        Swal.fire({
            title: 'Order Up Recruitment Pipeline Stage',
            text: 'Are you sure you want to order up this recruitment pipeline stage?',
            icon: 'info',
            showCancelButton: !0,
            confirmButtonText: 'Order Up',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-success mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, recruitment_pipeline_stage_id : recruitment_pipeline_stage_id, stage_order : stage_order, transaction : transaction},
                    success: function (response) {
                        if(response === 'Order Up'){
                          show_alert('Order Up Recruitment Pipeline Stage', 'The recruitment pipeline stage has been ordered up.', 'success');

                          reload_datatable('#recruitment-pipeline-stage-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Order Up Recruitment Pipeline Stage', 'The recruitment pipeline stage does not exist.', 'info');
                        }
                        else{
                          show_alert('Order Up Recruitment Pipeline Stage', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','.recruitment-pipeline-stage-order-down',function() {
        var recruitment_pipeline_stage_id = $(this).data('recruitment-pipeline-stage-id');
        var stage_order = $(this).data('stage-order');
        var transaction = 'order down recruitment pipeline stage';

        Swal.fire({
            title: 'Order Down Recruitment Pipeline Stage',
            text: 'Are you sure you want to order down this recruitment pipeline stage?',
            icon: 'info',
            showCancelButton: !0,
            confirmButtonText: 'Order Down',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-warning mt-2',
            cancelButtonClass: 'btn btn-secondary ms-2 mt-2',
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: {username : username, recruitment_pipeline_stage_id : recruitment_pipeline_stage_id, stage_order : stage_order, transaction : transaction},
                    success: function (response) {
                        if(response === 'Order Down'){
                          show_alert('Order Down Recruitment Pipeline Stage', 'The recruitment pipeline stage has been ordered down.', 'success');

                          reload_datatable('#recruitment-pipeline-stage-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Order Down Recruitment Pipeline Stage', 'The recruitment pipeline stage does not exist.', 'info');
                        }
                        else{
                          show_alert('Order Down Recruitment Pipeline Stage', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });
}