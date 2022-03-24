<?php
    require('config/config.php');
    require('classes/api.php');
    $api = new Api;
    
    $test = $api->get_attendance_creation_details('5');

    echo $test[0]['EMPLOYEE_ID'];
?>