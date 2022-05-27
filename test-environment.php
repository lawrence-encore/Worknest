<?php
    require('config/config.php');
    require('classes/api.php');
    $api = new Api;

    #$api->backup_database('worknestdb_' . date('m.d.Y'),'LDAGULTO');
    $get_attendance_overtime_total = $api->get_attendance_overtime_total('1', '2022-05-03', '2022-05-03', '21:00:00');

    echo $get_attendance_overtime_total;
?>