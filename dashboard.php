<?php
    require('session.php');
    require('config/config.php');
    require('classes/api.php');

    $api = new Api;
    $page_title = 'Dashboard';

    $page_access = $api->check_role_permissions($username, 1);
    $record_attendance = $api->check_role_permissions($username, 159);
    $submit_health_declaration = $api->check_role_permissions($username, 165);
    $get_location = $api->check_role_permissions($username, 166);
    $scan_qr_code = $api->check_role_permissions($username, 167);

    $check_user_account_status = $api->check_user_account_status($username);

    if($check_user_account_status == 0){
        if($page_access == 0){
            header('location: 404-page.php');
        }

        $employee_details = $api->get_employee_details('', $username);
        $employee_id = $employee_details[0]['EMPLOYEE_ID'] ?? null;
        $file_as = $employee_details[0]['FILE_AS'] ?? $username;
        $designation = $employee_details[0]['DESIGNATION'] ?? null;
        $department = $employee_details[0]['DEPARTMENT'] ?? null;
        $join_date = $api->check_date('empty', $employee_details[0]['JOIN_DATE']  ?? null, '', 'm/d/Y', '', '', '');

        $designation_details = $api->get_designation_details($designation);
        $designation_name = $designation_details[0]['DESIGNATION'] ?? null;

        $department_details = $api->get_department_details($department);
        $department_name = $department_details[0]['DEPARTMENT'] ?? null;

        $latest_attendance_id = $api->get_attendance_by_date(date('Y-m-d'));
        $get_employee_attendance_details = $api->get_employee_attendance_details($latest_attendance_id);
        $time_in = $api->check_date('empty', $get_employee_attendance_details[0]['TIME_IN'] ?? null, '', 'h:i a', '', '', '');
        $time_out = $api->check_date('empty', $get_employee_attendance_details[0]['TIME_OUT'] ?? null, '', 'h:i a', '', '', '');
    }
    else{
        header('location: logout.php?logout');
    }

    require('views/_application_settings.php');
?>

<!doctype html>
<html lang="en">
    <head>
        <?php require('views/_head.php'); ?>
        <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="assets/libs/sweetalert2/sweetalert2.min.css">
        <?php require('views/_required_css.php'); ?>
    </head>

    <body data-sidebar="dark">
        <?php require('views/_preloader.php'); ?>

        <div id="layout-wrapper">
            <?php 
                require('views/_top_bar.php');
                require('views/_menu.php'); 
            ?>
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18"><?php echo $page_title; ?></h4>
                                    <div class="page-title-right">
                                        <div class="d-flex flex-wrap gap-2">
                                            <?php
                                                if($record_attendance > 0){
                                                    $attendance_setting_details = $api->get_attendance_setting_details(1);
                                                    $max_attendance = $attendance_setting_details[0]['MAX_ATTENDANCE'] ?? 1;
                                                    $get_clock_in_total = $api->get_clock_in_total($employee_id, date('Y-m-d'));
                                                    $health_declaration_count = $api->get_health_declaration_count($employee_id, date('Y-m-d'));

                                                    if($get_clock_in_total < $max_attendance){
                                                        $attendance_id = $api->check_attendance_clock_out($employee_id);

                                                        if(!empty($attendance_id)){
                                                            echo '<button type="button" class="btn btn-danger waves-effect waves-light" id="record-attendance" data-attendance-id="'. $attendance_id .'" data-attendance="out">Clock Out</button>';
                                                        }
                                                        else{
                                                            echo '<button type="button" class="btn btn-success waves-effect waves-light" id="record-attendance" data-attendance="in">Clock In</button>';
                                                        }
                                                    }
                                                }

                                                if($submit_health_declaration > 0 && $health_declaration_count == 0){
                                                   echo '<button type="button" class="btn btn-primary waves-effect waves-light" id="submit-health-declaration">Health Declaration</button>';
                                                }

                                                if($scan_qr_code > 0){
                                                   echo '<button type="button" class="btn btn-warning waves-effect waves-light" id="scan-qr-code">Scan QR Code</button>';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card overflow-hidden">
                                    <div class="bg-primary bg-soft">
                                        <div class="row">
                                            <div class="col-7">
                                                <div class="text-primary p-3">
                                                    <h5 class="text-primary">Welcome</h5>
                                                    <p>Digify Integrated Solutions Dashboard</p>
                                                </div>
                                            </div>
                                            <div class="col-5 align-self-end">
                                                <img src="assets/images/default/profile-img.png" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="avatar-md profile-user-wid mb-4">
                                                    <img src="./assets/images/default/default-avatar.png" alt="avatar" class="img-thumbnail rounded-circle">
                                                </div>
                                                <h5 class="font-size-15 text-truncate"><?php echo $file_as; ?></h5>
                                                <p class="text-muted mb-0 text-truncate"><?php echo $designation_name; ?></p>
                                            </div>

                                            <div class="col-sm-7">
                                                <div class="pt-4">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <h5 class="font-size-14 text-truncate" id="time-in-details">
                                                                <?php
                                                                    if(!empty($time_in)){
                                                                        echo $time_in;
                                                                    }                 
                                                                    else{
                                                                        echo '--';
                                                                    }
                                                                ?>
                                                            </h5>
                                                            <p class="text-muted mb-0 text-truncate">Time In</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <h5 class="font-size-14 text-truncate" id="time-out-details">
                                                                <?php
                                                                    if(!empty($time_out)){
                                                                        echo $time_out;
                                                                    }
                                                                    else{
                                                                        echo '--';
                                                                    }                                               
                                                                ?>
                                                            </h5>
                                                            <p class="text-muted mb-0 text-truncate">Time Out</p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4">
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <?php
                                                                if($get_location > 0){
                                                                    echo '<button type="button" class="btn btn-info waves-effect waves-light btn-sm" id="get-location">Get Location</button>';
                                                                }
                                                            ?>                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php require('views/_footer.php'); ?>
               
            </div>
        </div>

        <?php require('views/_script.php'); ?>
        <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="assets/libs/jquery-validation/js/jquery.validate.min.js"></script>
        <script src="assets/libs/qrcode/qrcode.min.js"></script>
        <script src="assets/libs/gmaps/gmaps.min.js"></script>
        <script src="assets/libs/select2/js/select2.min.js"></script>
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <script src="assets/libs/html5-qr-code/html5-qrcode.min.js"></script>
        <script src="assets/js/system.js?v=<?php echo rand(); ?>"></script>
        <script src="assets/js/pages/dashboard.js?v=<?php echo rand(); ?>"></script>
    </body>
</html>