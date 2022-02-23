<?php
    require('config/config.php');
    require('classes/api.php');
    $api = new Api;
    

    echo $api->get_available_leave_entitlement(7, , );
    
?>