(function($) {
    'use strict';

    $(function() {
        if($('#recruitment-scorecard-section-option-datatable').length){
            initialize_recruitment_scorecard_section_option_table('#recruitment-scorecard-section-option-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_recruitment_scorecard_section_option_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var recruitment_scorecard_section_id = $('#recruitment-scorecard-section-id').text();
    var type = 'recruitment scorecard section option table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'RECRUITMENT_SCORECARD_SECTION_OPTION' },
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
                'data': {'type' : type, 'username' : username, 'recruitment_scorecard_section_id' : recruitment_scorecard_section_id},
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
                'data': {'type' : type, 'username' : username, 'recruitment_scorecard_section_id' : recruitment_scorecard_section_id},
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

    $(document).on('click','#add-recruitment-scorecard-section-option',function() {
        generate_modal('recruitment scorecard section option form', 'Recruitment Scorecard Section Option', 'R' , '1', '1', 'form', 'recruitment-scorecard-section-option-form', '1', username);
    });

    $(document).on('click','.update-recruitment-scorecard-section-option',function() {
        var recruitment_scorecard_section_option_id = $(this).data('recruitment-scorecard-section-option-id');

        sessionStorage.setItem('recruitment_scorecard_section_option_id', recruitment_scorecard_section_option_id);
        
        generate_modal('recruitment scorecard section option form', 'Recruitment Scorecard Section Option', 'R' , '1', '1', 'form', 'recruitment-scorecard-section-option-form', '0', username);
    });
    
    $(document).on('click','.delete-recruitment-scorecard-section-option',function() {
        var recruitment_scorecard_section_option_id = $(this).data('recruitment-scorecard-section-option-id');
        var transaction = 'delete recruitment scorecard section option';

        Swal.fire({
            title: 'Delete Recruitment Scorecard Section Option',
            text: 'Are you sure you want to delete this recruitment scorecard section option?',
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
                    data: {username : username, recruitment_scorecard_section_option_id : recruitment_scorecard_section_option_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Recruitment Scorecard Section Option', 'The recruitment scorecard section option has been deleted.', 'success');

                          reload_datatable('#recruitment-scorecard-section-option-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Recruitment Scorecard Section Option', 'The recruitment scorecard section option does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Recruitment Scorecard Section Option', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-recruitment-scorecard-section-option',function() {
        var recruitment_scorecard_section_option_id = [];
        var transaction = 'delete multiple recruitment scorecard section option';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                recruitment_scorecard_section_option_id.push(this.value);  
            }
        });

        if(recruitment_scorecard_section_option_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Recruitment Scorecard Section Optionss',
                text: 'Are you sure you want to delete these recruitment scorecard section options?',
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
                        data: {username : username, recruitment_scorecard_section_option_id : recruitment_scorecard_section_option_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Recruitment Scorecard Section Options', 'The recruitment scorecard section options have been deleted.', 'success');
    
                                reload_datatable('#recruitment scorecard section datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Recruitment Scorecard Section Options', 'The recruitment scorecard section option does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Recruitment Scorecard Section Options', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Recruitment Scorecard Section Options', 'Please select the recruitment scorecard section options you want to delete.', 'error');
        }
    });
}