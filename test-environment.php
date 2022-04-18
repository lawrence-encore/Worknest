<?php
    require('config/config.php');
    require('classes/api.php');
    $api = new Api;

    $api->backup_database('worknestdb_' . date('m.d.Y'),'LDAGULTO');
?>