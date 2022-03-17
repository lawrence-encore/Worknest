(function($) {
    'use strict';

    $(function() {
        if($('#upload-setting-datatable').length){
            initialize_upload_setting_table('#upload-setting-datatable');
        }

        initialize_click_events();
    });
})(jQuery);

function initialize_upload_setting_table(datatable_name, buttons = false, show_all = false){
    hide_multiple_buttons();
    
    var username = $('#username').text();
    var type = 'upload setting table';
    var settings;

    var column = [ 
        { 'data' : 'CHECK_BOX' },
        { 'data' : 'UPLOAD_SETTING_ID' },
        { 'data' : 'UPLOAD_SETTING' },
        { 'data' : 'MAX_FILE_SIZE' },
        { 'data' : 'FILE_TYPE' },
        { 'data' : 'ACTION' }
    ];

    var column_definition = [
        { 'width': '1%','bSortable': false, 'aTargets': 0 },
        { 'width': '15%', 'aTargets': 1 },
        { 'width': '34%', 'aTargets': 2 },
        { 'width': '10%', 'aTargets': 3 },
        { 'width': '24%', 'aTargets': 4 },
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

    $(document).on('click','#add-upload-setting',function() {
        generate_modal('upload setting form', 'Upload Setting', 'R' , '1', '1', 'form', 'upload-setting-form', '1', username);
    });

    $(document).on('click','.update-upload-setting',function() {
        var upload_setting_id = $(this).data('upload-setting-id');

        sessionStorage.setItem('upload_setting_id', upload_setting_id);
        
        generate_modal('upload setting form', 'Upload Setting', 'R' , '1', '1', 'form', 'upload-setting-form', '0', username);
    });
    
    $(document).on('click','.delete-upload-setting',function() {
        var upload_setting_id = $(this).data('upload-setting-id');
        var transaction = 'delete upload setting';

        Swal.fire({
            title: 'Delete Upload Setting',
            text: 'Are you sure you want to delete this upload setting?',
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
                    data: {username : username, upload_setting_id : upload_setting_id, transaction : transaction},
                    success: function (response) {
                        if(response === 'Deleted'){
                          show_alert('Delete Upload Setting', 'The upload setting has been deleted.', 'success');

                          reload_datatable('#upload-setting-datatable');
                        }
                        else if(response === 'Not Found'){
                          show_alert('Delete Upload Setting', 'The upload setting does not exist.', 'info');
                        }
                        else{
                          show_alert('Delete Upload Setting', response, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });

    $(document).on('click','#delete-upload-setting',function() {
        var upload_setting_id = [];
        var transaction = 'delete multiple upload setting';

        $('.datatable-checkbox-children').each(function(){
            if($(this).is(':checked')){  
                upload_setting_id.push(this.value);  
            }
        });

        if(upload_setting_id.length > 0){
            Swal.fire({
                title: 'Delete Multiple Upload Settings',
                text: 'Are you sure you want to delete these upload settings?',
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
                        data: {username : username, upload_setting_id : upload_setting_id, transaction : transaction},
                        success: function (response) {
                            if(response === 'Deleted'){
                                show_alert('Delete Multiple Upload Settings', 'The upload settings have been deleted.', 'success');
    
                                reload_datatable('#upload-setting-datatable');
                            }
                            else if(response === 'Not Found'){
                                show_alert('Delete Multiple Upload Settings', 'The upload setting does not exist.', 'info');
                            }
                            else{
                                show_alert('Delete Multiple Upload Settings', response, 'error');
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
        else{
            show_alert('Delete Multiple Upload Settings', 'Please select the upload settings you want to delete.', 'error');
        }
    });

}