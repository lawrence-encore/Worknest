(function($) {
    'use strict';

    $(function() {
        if($('#government-contribution-datatable').length){
            initialize_government_contribution_table('#government-contribution-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_government_contribution_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var type = 'government contribution table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'GOVERNMENT_CONTRIBUTION' },
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

    $(document).on('click','#add-government-contribution',function() {
        generate_modal('government contribution form', 'Government Contribution', 'R' , '1', '1', 'form', 'government-contribution-form', '1', username);
    });

    $(document).on('click','.update-government-contribution',function() {
        var government_contribution_id = $(this).data('government-contribution-id');

        sessionStorage.setItem('government_contribution_id', government_contribution_id);
        
        generate_modal('government contribution form', 'Government Contribution', 'R' , '1', '1', 'form', 'government-contribution-form', '0', username);
    });
    
    $(document).on('click','.delete-government-contribution',function() {
        var government_contribution_id = $(this).data('government-contribution-id');
        var transaction = 'delete government contribution';

        Swal.fire({
            title: 'Delete Government Contribution',
            text: 'Are you sure you want to delete this government contribution?',
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
                    data: {username : username, government_contribution_id : government_contribution_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Government Contribution', 'The government contribution has been deleted.', 'success');

                          reload_datatable('#government-contribution-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Government Contribution', 'The government contribution does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Government Contribution', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-government-contribution',function() {
        var government_contribution_id = [];
        var transaction = 'delete multiple government contribution';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                government_contribution_id.push(this.value);  
            }
        });

        if(government_contribution_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Government Contributions',
                text: 'Are you sure you want to delete these government contributions?',
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
                        data: {username : username, government_contribution_id : government_contribution_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Government Contributions', 'The government contributions have been deleted.', 'success');
    
                                reload_datatable('#government-contribution-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Government Contributions', 'The government contribution does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Government Contributions', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Government Contributions', 'Please select the government contributions you want to delete.', 'error');
        }
    });

}