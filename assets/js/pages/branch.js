(function($) {
    'use strict';

    $(function() {
        if($('#branch-datatable').length){
            initialize_branch_table('#branch-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_branch_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var type = 'branch table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'BRANCH' },
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

    $(document).on('click','.view-branch',function() {
        var branch_id = $(this).data('branch-id');

        sessionStorage.setItem('branch_id', branch_id);

        generate_modal('branch details', 'Branch Details', 'R' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#add-branch',function() {
        generate_modal('branch form', 'Branch', 'R' , '1', '1', 'form', 'branch-form', '1', username);
    });

    $(document).on('click','.update-branch',function() {
        var branch_id = $(this).data('branch-id');

        sessionStorage.setItem('branch_id', branch_id);
        
        generate_modal('branch form', 'Branch', 'R' , '1', '1', 'form', 'branch-form', '0', username);
    });
    
    $(document).on('click','.delete-branch',function() {
        var branch_id = $(this).data('branch-id');
        var transaction = 'delete branch';

        Swal.fire({
            title: 'Delete Branch',
            text: 'Are you sure you want to delete this branch?',
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
                    data: {username : username, branch_id : branch_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Branch', 'The branch has been deleted.', 'success');

                          reload_datatable('#branch-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Branch', 'The branch does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Branch', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-branch',function() {
        var branch_id = [];
        var transaction = 'delete multiple branch';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                branch_id.push(this.value);  
            }
        });

        if(branch_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Branches',
                text: 'Are you sure you want to delete these branches?',
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
                        data: {username : username, branch_id : branch_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Branches', 'The branches have been deleted.', 'success');
    
                                reload_datatable('#branch-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Branches', 'The branch does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Branches', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Branches', 'Please select the branches you want to delete.', 'error');
        }
    });

}