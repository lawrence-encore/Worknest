<?php
    $user_interface_settings_details = $api->get_user_interface_settings_details(1);
    $login_bg = $user_interface_settings_details[0]['LOGIN_BG'];
    $logo_light = $user_interface_settings_details[0]['LOGO_LIGHT'];
    $logo_dark = $user_interface_settings_details[0]['LOGO_DARK'];
    $logo_icon_light = $user_interface_settings_details[0]['LOGO_ICON_LIGHT'];
    $logo_icon_dark = $user_interface_settings_details[0]['LOGO_ICON_DARK'];
    $favicon = $user_interface_settings_details[0]['FAVICON'];
?>