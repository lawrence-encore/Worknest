<?php
    require('config/config.php');
    require('classes/api.php');
    $api = new Api;
    $start_date = '01-Jan-2022';
    $recurrence_pattern = 'MONTHLY';
    $recurrence = 12;

    $payroll_date = $start_date;
    
    for($i = 0; $i <= $recurrence; $i++){
        if($i == 0){
            $payroll_date = $start_date;
        }
        else{
            $payroll_date = $api->check_date('empty', $api->get_next_date($payroll_date, $recurrence_pattern), '', 'F d, Y', '', '', '');
        }
        

        echo $payroll_date . '<br/>';
    }
?>