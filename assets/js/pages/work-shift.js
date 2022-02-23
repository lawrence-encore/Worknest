(function($) {
    'use strict';

    $(function() {
        if($('#work-shift-datatable').length){
            initialize_work_shift_table('#work-shift-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_work_shift_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var type = 'work shift table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'WORK_SHIFT' },
        { 'data' : 'WORK_SHIFT_TYPE' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '20%', 'aTargets': 1 },
        { 'width': '19%', 'aTargets': 2 },
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

    $(document).on('click','#add-work-shift',function() {
        generate_modal('work shift form', 'Work Shift', 'R' , '1', '1', 'form', 'work-shift-form', '1', username);
    });

    $(document).on('click','.update-work-shift',function() {
        var work_shift_id = $(this).data('work-shift-id');

        sessionStorage.setItem('work_shift_id', work_shift_id);
        
        generate_modal('work shift form', 'Work Shift', 'R' , '1', '1', 'form', 'work-shift-form', '0', username);
    });

    $(document).on('click','.update-work-shift-schedule',function() {
        var work_shift_id = $(this).data('work-shift-id');
        var work_shift_type = $(this).data('work-shift-type');

        sessionStorage.setItem('work_shift_id', work_shift_id);
        
        if(work_shift_type == 'REGULAR'){
            generate_modal('regular work shift schedule form', 'Work Shift Schedule', 'XL' , '1', '1', 'form', 'regular-work-shift-schedule-form', '0', username);
        }
        else{
            generate_modal('scheduled work shift schedule form', 'Work Shift Schedule', 'XL' , '1', '1', 'form', 'scheduled-work-shift-schedule-form', '0', username);
        }
    });

    $(document).on('click','.assign-work-shift',function() {
        var work_shift_id = $(this).data('work-shift-id');

        sessionStorage.setItem('work_shift_id', work_shift_id);
        
        generate_modal('assign work shift form', 'Assign Work Shift', 'LG' , '1', '1', 'form', 'assign-work-shift-form', '0', username);
    });
    
    $(document).on('click','.delete-work-shift',function() {
        var work_shift_id = $(this).data('work-shift-id');
        var transaction = 'delete work shift';

        Swal.fire({
            title: 'Delete Work Shift',
            text: 'Are you sure you want to delete this work shift?',
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
                    data: {username : username, work_shift_id : work_shift_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Work Shift', 'The work shift has been deleted.', 'success');

                          initialize_work_shift_table('#work-shift-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Work Shift', 'The work shift does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Work Shift', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-work-shift',function() {
        var work_shift_id = [];
        var transaction = 'delete multiple work shift';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                work_shift_id.push(this.value);  
            }
        });

        if(work_shift_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Work Shifts',
                text: 'Are you sure you want to delete these work shifts?',
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
                        data: {username : username, work_shift_id : work_shift_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Work Shifts', 'The work shifts have been deleted.', 'success');
    
                                initialize_work_shift_table('#work-shift-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Work Shifts', 'The work shift does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Work Shifts', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Work Shifts', 'Please select the work shifts you want to delete.', 'error');
        }
    });
}