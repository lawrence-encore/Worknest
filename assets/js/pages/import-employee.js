(function($) {
    'use strict';

    $(function() {
        reset_import_table();

        initialize_click_events();
    });
})(jQuery);

function initialize_temporary_employee_table(datatable_name, buttons = false, show_all = false){    
    var username = $('#username').text();
    var type = 'temporary employee table';
    var settings;

    var column = [ 
        { 'data' : 'EMPLOYEE_ID' },
        { 'data' : 'ID_NUMBER' },
        { 'data' : 'FILE_AS' },
        { 'data' : 'FIRST_NAME' },
        { 'data' : 'MIDDLE_NAME' },
        { 'data' : 'LAST_NAME' },
        { 'data' : 'SUFFIX' },
        { 'data' : 'BIRTHDAY' },
        { 'data' : 'EMPLOYMENT_STATUS' },
        { 'data' : 'JOIN_DATE' },
        { 'data' : 'EXIT_DATE' },
        { 'data' : 'PERMANENCY_DATE' },
        { 'data' : 'EXIT_REASON' },
        { 'data' : 'EMAIL' },
        { 'data' : 'PHONE' },
        { 'data' : 'TELEPHONE' },
        { 'data' : 'DEPARTMENT' },
        { 'data' : 'DESIGNATION' },
        { 'data' : 'BRANCH' },
        { 'data' : 'GENDER' }
    ];

    var column_definition = [
        { 'width': '10%', 'aTargets': 0, 'className' : 'employee_id' },
        { 'width': '10%', 'aTargets': 1, 'className' : 'id_number' },
        { 'width': '20%', 'aTargets': 2, 'className' : 'file_as' },
        { 'width': '15%', 'aTargets': 3, 'className' : 'first_name' },
        { 'width': '15%', 'aTargets': 4, 'className' : 'middle_name' },
        { 'width': '15%', 'aTargets': 5, 'className' : 'last_name' },
        { 'width': '10%', 'aTargets': 6, 'className' : 'suffix' },
        { 'width': '10%', 'aTargets': 7, 'className' : 'birthday' },
        { 'width': '10%', 'aTargets': 8, 'className' : 'employment_status' },
        { 'width': '10%', 'aTargets': 9, 'className' : 'join_date' },
        { 'width': '10%', 'aTargets': 10, 'className' : 'exit_date' },
        { 'width': '10%', 'aTargets': 11, 'className' : 'permanency_date' },
        { 'width': '10%', 'aTargets': 12, 'className' : 'exit_reason' },
        { 'width': '10%', 'aTargets': 13, 'className' : 'email' },
        { 'width': '10%', 'aTargets': 14, 'className' : 'phone' },
        { 'width': '10%', 'aTargets': 15, 'className' : 'telephone' },
        { 'width': '10%', 'aTargets': 16, 'className' : 'department' },
        { 'width': '10%', 'aTargets': 17, 'className' : 'designation' },
        { 'width': '10%', 'aTargets': 18, 'className' : 'branch' },
        { 'width': '10%', 'aTargets': 19, 'className' : 'gender' }
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

    $(document).on('click','#import-employee',function() {
        generate_modal('import employee form', 'Import Employee', 'R' , '0', '1', 'form', 'import-employee-form', '1', username);
    });

    $(document).on('click','#submit-import-employee',function() {
        var employee_id = []; 
        var id_number = []; 
        var file_as = []; 
        var first_name = []; 
        var middle_name = []; 
        var last_name = []; 
        var suffix = []; 
        var birthday = []; 
        var employment_status = []; 
        var join_date = []; 
        var exit_date = []; 
        var permanency_date = []; 
        var exit_reason = []; 
        var email = []; 
        var phone = []; 
        var telephone = []; 
        var department = []; 
        var designation = []; 
        var branch = []; 
        var gender = [];

        $('.employee_id').each(function(){
            employee_id.push($(this).text());
        });

        $('.id_number').each(function(){
            id_number.push($(this).text());
        });

        $('.file_as').each(function(){
            file_as.push($(this).text());
        });

        $('.first_name').each(function(){
            first_name.push($(this).text());
        });

        $('.middle_name').each(function(){
            middle_name.push($(this).text());
        });

        $('.last_name').each(function(){
            last_name.push($(this).text());
        });

        $('.suffix').each(function(){
            suffix.push($(this).text());
        });

        $('.birthday').each(function(){
            birthday.push($(this).text());
        });

        $('.employment_status').each(function(){
            employment_status.push($(this).text());
        });

        $('.join_date').each(function(){
            join_date.push($(this).text());
        });

        $('.exit_date').each(function(){
            exit_date.push($(this).text());
        });

        $('.permanency_date').each(function(){
            permanency_date.push($(this).text());
        });

        $('.exit_reason').each(function(){
            exit_reason.push($(this).text());
        });

        $('.email').each(function(){
            email.push($(this).text());
        });

        $('.phone').each(function(){
            phone.push($(this).text());
        });

        $('.telephone').each(function(){
            telephone.push($(this).text());
        });

        $('.department').each(function(){
            department.push($(this).text());
        });

        $('.designation').each(function(){
            designation.push($(this).text());
        });

        $('.branch').each(function(){
            branch.push($(this).text());
        });

        $('.gender').each(function(){
            gender.push($(this).text());
        });

        employee_id.splice(0,2);
        id_number.splice(0,2);
        file_as.splice(0,2);
        first_name.splice(0,2);
        middle_name.splice(0,2);
        last_name.splice(0,2);
        suffix.splice(0,2);
        birthday.splice(0,2);
        employment_status.splice(0,2);
        join_date.splice(0,2);
        exit_date.splice(0,2);
        permanency_date.splice(0,2);
        exit_reason.splice(0,2);
        email.splice(0,2);
        phone.splice(0,2);
        telephone.splice(0,2);
        department.splice(0,2);
        designation.splice(0,2);
        branch.splice(0,2);
        gender.splice(0,2);

        var transaction = 'import employee data';
        var username = $('#username').text();

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            dataType: 'TEXT',
            data: {employee_id : employee_id, id_number : id_number, file_as : file_as, first_name : first_name, middle_name : middle_name, last_name : last_name, suffix : suffix, birthday : birthday, employment_status : employment_status, join_date : join_date, exit_date : exit_date, permanency_date : permanency_date, exit_reason : exit_reason, email : email, phone : phone, telephone : telephone, department : department, designation : designation, branch : branch, gender :gender, transaction : transaction, username : username},
            success: function(response) {
                if(response === 'Imported'){
                    show_alert('Import Employee Date', 'The employees have been imported.', 'success');
                    reset_import_table();
                }
                else{
                    show_alert('Import Employee Data Error', response, 'error');
                }
            }
        });
    });

    $(document).on('click','#clear-import-employee',function() {
        reset_import_table();
    });
}

function reset_import_table(){
    truncate_temporary_table('import employee');

    $('#import-employee').removeClass('d-none');
    $('#submit-import-employee').addClass('d-none');
    $('#clear-import-employee').addClass('d-none');
}