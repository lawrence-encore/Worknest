(function($) {
    'use strict';

    $(function() {
        initialize_elements();
        initialize_on_change_events();

        display_form_details('company setting form');

        $('#company-setting-form').validate({
            submitHandler: function (form) {
                var transaction = 'submit company setting';
                var username = $('#username').text();
                
                var formData = new FormData(form);
                formData.append('username', username);
                formData.append('transaction', transaction);

                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        document.getElementById('submit-form').disabled = true;
                        $('#submit-form').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span rclass="sr-only"></span></div>');
                    },
                    success: function (response) {
                        if(response === 'Updated'){
                            show_alert_event('Company Setting Update Success', 'The company setting has been updated.', 'success', 'reload');
                        }
                        else{
                            show_alert('Company Setting Update Error', response, 'error');
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
                company_name: {
                    required: true
                },
                province: {
                    required: true
                },
                city: {
                    required: true
                },
                address: {
                    required: true
                }
            },
            messages: {
                company_name: {
                    required: 'Please enter the company name',
                },
                province: {
                    required: 'Please choose the province',
                },
                city: {
                    required: 'Please choose the city',
                },
                address: {
                    required: 'Please enter the address',
                }
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
    $(document).on('change','#province',function() {
        if(this.value != ''){
            reset_element_validation('#city');

            generate_city_option(this.value, '');

            document.getElementById('city').disabled = false;
        }
        else{
            $('#city').append(new Option('--', '', false, false));

            $('#city').val('').change();

            document.getElementById('city').disabled = true;
        }
    });
}