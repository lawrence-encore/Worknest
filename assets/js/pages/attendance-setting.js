(function($) {
    'use strict';

    $(function() {
        display_form_details('attendance setting form');
        initialize_on_change_events();

        $('#attendance-setting-form').validate({
            submitHandler: function (form) {
                var transaction = 'submit attendance setting';
                var username = $('#username').text();
                var attendance_creation_approval = $('#attendance_creation_approval').val();
                var attendance_adjustment_approval = $('#attendance_adjustment_approval').val();
                
                document.getElementById('attendance_creation_approval').disabled = false;
                document.getElementById('attendance_adjustment_approval').disabled = false;

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: $(form).serialize() + '&username=' + username + '&transaction=' + transaction + '&attendance_creation_approval=' + attendance_creation_approval + '&attendance_adjustment_approval=' + attendance_adjustment_approval,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated'){
                            show_alert_event('Attendance Setting Update Success', 'The attendance setting has been updated.', 'success', 'reload');
                        }
                        else{
                            show_alert('Attendance Setting Update Error', response, 'error');
                        }
                    },
                    complete: function(){
                        document.getElementById('submit-form').disabled = false;
                        $('#submit-form').html('Save');
                    }
                });

                return false;
            },
            rules: {
                maximum_attendance: {
                    required: true
                },
                time_out_allowance: {
                    required: true
                },
            },
            messages: {
                maximum_attendance: {
                    required: 'Please enter the maximum attendance',
                },
                time_out_allowance: {
                    required: 'Please enter the time out allowance',
                },
            },
            errorPlacement: function(label, element) {
                if((element.hasClass('select2') || element.hasClass('form-select2')) && element.next('.select2-container').length) {
                    label.insertAfter(element.next('.select2-container'));
                }
                else if(element.parent('.input-group').length){
                    label.insertAfter(element.parent());
                }
                else{
                    label.insertAfter(element);
                }
            },
            highlight: function(element) {
                $(element).parent().addClass('has-danger');
                $(element).addClass('form-control-danger');
            },
            success: function(label,element) {
                $(element).parent().removeClass('has-danger')
                $(element).removeClass('form-control-danger')
                label.remove();
            }
        });
    });
})(jQuery);

function initialize_on_change_events(){
    $(document).on('change','#attendance_creation_recommendation',function() {
        $('#attendance_creation_approval').val('').change();

        if(this.checked){
            document.getElementById('attendance_creation_approval').disabled = false;
        }
        else{
            document.getElementById('attendance_creation_approval').disabled = true;
        }
    });

    $(document).on('change','#attendance_adjustment_recommendation',function() {
        $('#attendance_adjustment_approval').val('').change();

        if(this.checked){
            document.getElementById('attendance_adjustment_approval').disabled = false;
        }
        else{
            document.getElementById('attendance_adjustment_approval').disabled = true;
        }
    });   
}