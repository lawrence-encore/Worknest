(function($) {
    'use strict';

    $(function() {
        initialize_click_events();
        initialize_on_change_events();
    });
})(jQuery);


function initialize_click_events(){
    var username = $('#username').text();

    $(document).on('click','#record-attendance',function() {
        var attendance = $(this).data('attendance');
        
        if(attendance == 'in'){
            generate_modal('time in form', 'Time In', 'LG' , '1', '1', 'form', 'time-in-form', '1', username);
        }
        else{
            var attendance_id = $(this).data('attendance-id');

            sessionStorage.setItem('attendance_id', attendance_id);

            generate_modal('time out form', 'Time Out', 'LG' , '1', '1', 'form', 'time-out-form', '0', username);
        }
    });

    $(document).on('click','#submit-health-declaration',function() {
        generate_modal('health declaration form', 'Health Declaration', 'LG' , '1', '1', 'form', 'health-declaration-form', '1', username);
    });
   
    $(document).on('click','#scan-qr-code',function() {
        generate_modal('scan qr code form', 'Scan QR Code', 'LG' , '1', '0', 'element', '', '0', username);
    });

    $(document).on('click','#get-location',function() {
        generate_modal('get location form', 'Location', 'R' , '1', '1', 'form', 'get-location-form', '1', username);
    });
}

function initialize_on_change_events(){

    $(document).on('change','#question_5',function() {
        reset_element_validation('#specific');
        $('#specific').val('');

        if(this.value == 1){
            document.getElementById('specific').disabled = false;
        }
        else{
            document.getElementById('specific').disabled = true;
        }
    });
   
}