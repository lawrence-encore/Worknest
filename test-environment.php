<?php
    require('config/config.php');
    require('classes/api.php');
    $api = new Api;
    
    $notification_id = 1;
    $employee_id = 7;


    $system_notification = $api->check_system_notification_exist($notification_id, 'S');
        $email_notification = $api->check_system_notification_exist($notification_id, 'E');

        if($system_notification > 0 || $email_notification > 0){
            $link = '';
            $employee_details = $api->get_employee_details($employee_id, '');
            $email = $employee_details[0]['EMAIL'];

            $send_email_notification = $api->send_email_notification($notification_id, $email, 'Test', 'Test', 0, '');

            echo $send_email_notification;
        }
    
?>