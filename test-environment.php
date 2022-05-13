<?php
    require('config/config.php');
    require('classes/api.php');
    $api = new Api;

    #$api->backup_database('worknestdb_' . date('m.d.Y'),'LDAGULTO');
    $email_configuration_details = $api->get_email_configuration_details(1);
    $mail_password = $api->decrypt_data($email_configuration_details[0]['PASSWORD']);

    echo $mail_password;
?>