(function($) {
    'use strict';

    $(function() {
        if($('#contribution-bracket-datatable').length){
            initialize_contribution_bracket_table('#contribution-bracket-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_contribution_bracket_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var government_contribution_id = $('#government-contribution-id').text();
    var type = 'contribution bracket table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'BRACKET' },
        { 'data' : 'DEDUCTION_AMOUNT' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '39%', 'aTargets': 1 },
        { 'width': '30%', 'aTargets': 2 },
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
                'data': {'type' : type, 'username' : username, 'government_contribution_id' : government_contribution_id},
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
                'data': {'type' : type, 'username' : username, 'government_contribution_id' : government_contribution_id},
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

    $(document).on('click','#add-contribution-bracket',function() {
        generate_modal('contribution bracket form', 'Contribution Bracket', 'R' , '1', '1', 'form', 'contribution-bracket-form', '1', username);
    });

    $(document).on('click','.update-contribution-bracket',function() {
        var contribution_bracket_id = $(this).data('contribution-bracket-id'); 
        
        sessionStorage.setItem('contribution_bracket_id', contribution_bracket_id);
        
        generate_modal('contribution bracket form', 'Contribution Bracket', 'R' , '1', '1', 'form', 'contribution-bracket-form', '0', username);
    });
    
    $(document).on('click','.delete-contribution-bracket',function() {
        var contribution_bracket_id = $(this).data('contribution-bracket-id'); 
        var transaction = 'delete contribution bracket';

        Swal.fire({
            title: 'Delete Contribution Bracket',
            text: 'Are you sure you want to delete this contribution bracket?',
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
                    data: {username : username, contribution_bracket_id : contribution_bracket_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Contribution Bracket', 'The contribution bracket has been deleted.', 'success');

                          reload_datatable('#contribution-bracket-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Contribution Bracket', 'The contribution bracket does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Contribution Bracket', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-contribution-bracket',function() {
        var contribution_bracket_id = [];
        var transaction = 'delete multiple contribution bracket';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                contribution_bracket_id.push(this.value);  
            }
        });

        if(contribution_bracket_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Contribution Brackets',
                text: 'Are you sure you want to delete these contribution brackets?',
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
                        data: {username : username, contribution_bracket_id : contribution_bracket_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Contribution Brackets', 'The contribution brackets have been deleted.', 'success');
    
                                reload_datatable('#contribution-bracket-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Contribution Brackets', 'The contribution bracket does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Contribution Brackets', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Contribution Brackets', 'Please select the policies you want to delete.', 'error');
        }
    });
}