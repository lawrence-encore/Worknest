(function($) {
    'use strict';

    $(function() {
        if($('#recruitment-scorecard-section-datatable').length){
            initialize_recruitment_scorecard_section_table('#recruitment-scorecard-section-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_recruitment_scorecard_section_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var recruitment_scorecard_id = $('#recruitment-scorecard-id').text();
    var type = 'recruitment scorecard section table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'RECRUITMENT_SCORECARD_SECTION' },
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
                'data': {'type' : type, 'username' : username, 'recruitment_scorecard_id' : recruitment_scorecard_id},
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
                'data': {'type' : type, 'username' : username, 'recruitment_scorecard_id' : recruitment_scorecard_id},
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

    $(document).on('click','#add-recruitment-scorecard-section',function() {
        generate_modal('recruitment scorecard section form', 'Recruitment Scorecard Section', 'R' , '1', '1', 'form', 'recruitment-scorecard-section-form', '1', username);
    });

    $(document).on('click','.update-recruitment-scorecard-section',function() {
        var recruitment_scorecard_section_id = $(this).data('recruitment-scorecard-section-id');

        sessionStorage.setItem('recruitment_scorecard_section_id', recruitment_scorecard_section_id);
        
        generate_modal('recruitment scorecard section form', 'Recruitment Scorecard Section', 'R' , '1', '1', 'form', 'recruitment-scorecard-section-form', '0', username);
    });
    
    $(document).on('click','.delete-recruitment-scorecard-section',function() {
        var recruitment_scorecard_section_id = $(this).data('recruitment-scorecard-section-id');
        var transaction = 'delete recruitment scorecard section';

        Swal.fire({
            title: 'Delete Recruitment Scorecard Section',
            text: 'Are you sure you want to delete this recruitment scorecard section?',
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
                    data: {username : username, recruitment_scorecard_section_id : recruitment_scorecard_section_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Recruitment Scorecard Section', 'The recruitment scorecard section has been deleted.', 'success');

                          reload_datatable('#recruitment-scorecard-section-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Recruitment Scorecard Section', 'The recruitment scorecard section does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Recruitment Scorecard Section', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-recruitment-scorecard-section',function() {
        var recruitment_scorecard_section_id = [];
        var transaction = 'delete multiple recruitment scorecard section';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                recruitment_scorecard_section_id.push(this.value);  
            }
        });

        if(recruitment_scorecard_section_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Recruitment Scorecard Sections',
                text: 'Are you sure you want to delete these recruitment scorecard sections?',
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
                        data: {username : username, recruitment_scorecard_section_id : recruitment_scorecard_section_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Recruitment Scorecard Sections', 'The recruitment scorecard sections have been deleted.', 'success');
    
                                reload_datatable('#recruitment scorecard section datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Recruitment Scorecard Sections', 'The recruitment scorecard section does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Recruitment Scorecard Sections', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Recruitment Scorecard Sections', 'Please select the recruitment scorecard sections you want to delete.', 'error');
        }
    });
}