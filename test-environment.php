<?php
    require('config/config.php');
    require('classes/api.php');
    $api = new Api;
    $start_date = '01-Jan-2022';
    $recurrence_pattern = 'MONTHLY';
    $recurrence = 12;

    $api->backup_database('worknestdb_' . date('m.d.Y'),'LDAGULTO');
?>