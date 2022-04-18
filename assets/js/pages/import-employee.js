(function($) {
    'use strict';

    $(function() {
        initialize_click_events();
    });
})(jQuery);

function initialize_click_events(){
    var username = $('#username').text();

    $(document).on('click','#import-employee',function() {
        generate_modal('import employee form', 'Import Employee', 'R' , '0', '1', 'form', 'import-employee-form', '1', username);
    });
}