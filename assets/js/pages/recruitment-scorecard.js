(function($) {
    'use strict';

    $(function() {
        if($('#recruitment-scorecard-datatable').length){
            initialize_recruitment_scorecard_table('#recruitment-scorecard-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_recruitment_scorecard_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var type = 'recruitment scorecard table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'RECRUITMENT_SCORECARD' },
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

    $(document).on('click','#add-recruitment-scorecard',function() {
        generate_modal('recruitment scorecard form', 'Recruitment Scorecard', 'R' , '1', '1', 'form', 'recruitment-scorecard-form', '1', username);
    });

    $(document).on('click','.update-recruitment-scorecard',function() {
        var recruitment_scorecard_id = $(this).data('recruitment-scorecard-id');

        sessionStorage.setItem('recruitment_scorecard_id', recruitment_scorecard_id);
        
        generate_modal('recruitment scorecard form', 'Recruitment Scorecard', 'R' , '1', '1', 'form', 'recruitment-scorecard-form', '0', username);
    });

    $(document).on('click','.delete-recruitment-scorecard',function() {
        var recruitment_scorecard_id = $(this).data('recruitment-scorecard-id');
        var transaction = 'delete recruitment scorecard';

        Swal.fire({
            title: 'Delete Recruitment Scorecard',
            text: 'Are you sure you want to delete this recruitment scorecard?',
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
                    data: {username : username, recruitment_scorecard_id : recruitment_scorecard_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Recruitment Scorecard', 'The recruitment scorecard has been deleted.', 'success');

                          reload_datatable('#recruitment-scorecard-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Recruitment Scorecard', 'The recruitment scorecard does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Recruitment Scorecard', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-recruitment-scorecard',function() {
        var recruitment_scorecard_id = [];
        var transaction = 'delete multiple recruitment scorecard';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                recruitment_scorecard_id.push(this.value);  
            }
        });

        if(recruitment_scorecard_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Recruitment Scorecards',
                text: 'Are you sure you want to delete these recruitment scorecards?',
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
                        data: {username : username, recruitment_scorecard_id : recruitment_scorecard_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Recruitment Scorecards', 'The recruitment scorecards have been deleted.', 'success');
    
                                reload_datatable('#recruitment-scorecard-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Recruitment Scorecards', 'The recruitment scorecards does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Recruitment Scorecards', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Recruitment Scorecards', 'Please select the recruitment scorecards you want to delete.', 'error');
        }
    });

}