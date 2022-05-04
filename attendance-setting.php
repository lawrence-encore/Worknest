<?php
    require('session.php');
    require('config/config.php');
    require('classes/api.php');

    $api = new Api;
    $page_title = 'Attendance Setting';

    $page_access = $api->check_role_permissions($username, 156);
    $update_attendance_setting = $api->check_role_permissions($username, 157);
    $view_transaction_log = $api->check_role_permissions($username, 158);

    $attendance_setting_details = $api->get_attendance_setting_details(1);
    $transaction_log_id = $attendance_setting_details[0]['TRANSACTION_LOG_ID'] ?? null;

	$check_user_account_status = $api->check_user_account_status($username);

    if($check_user_account_status == 0){
        if($page_access == 0){
            header('location: 404-page.php');
        }
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
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Administrator</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                            <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-grow-1 align-self-center">
                                                        <h4 class="card-title">Attendance Setting</h4>
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                    <?php
                                                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                                                            echo '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'">Transaction Log</button>';
                                                        }

                                                        if($update_attendance_setting > 0){
                                                            echo '<button type="submit" class="btn btn-primary waves-effect waves-light" form="attendance-setting-form" id="submit-form">Save</button>';

                                                            $disabled = '';
                                                        }
                                                        else{
                                                            $disabled = 'disabled';
                                                        }                                                        
                                                    ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <form class="cmxform" id="attendance-setting-form" method="post" action="#">
                                                    <div class="row mb-3">
                                                        <label for="maximum_attendance" class="col-md-4 col-form-label">Maximum Attendance  <i class="bx bx-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="This sets the number of attendance record per day."></i> <span class="required">*</span></label>
                                                        <div class="col-md-8">
                                                            <input id="maximum_attendance" name="maximum_attendance" class="form-control" type="number" min="1" value="1" <?php echo $disabled; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="time_out_allowance" class="col-md-4 col-form-label">Time Out Grace Period (Minutes) <i class="bx bx-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="This sets the grace period before the employee can time out after time in."></i> <span class="required">*</span></label>
                                                        <div class="col-md-8">
                                                            <input id="time_out_allowance" name="time_out_allowance" class="form-control" type="number" min="1" value="1" <?php echo $disabled; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="late_allowance" class="col-md-4 col-form-label">Late Grace Period (Minutes) <i class="bx bx-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="This sets the grace period before the employee can be considered as late."></i> <span class="required">*</span></label>
                                                        <div class="col-md-8">
                                                            <input id="late_allowance" name="late_allowance" class="form-control" type="number" min="1" value="1" <?php echo $disabled; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="late_policy" class="col-md-4 col-form-label">Late Policy (Minutes) <i class="bx bx-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="This sets the policy before the employee can be considered as half day. Set the value to 0 to disable this feature."></i></label>
                                                        <div class="col-md-8">
                                                            <input id="late_policy" name="late_policy" class="form-control" type="number" min="0" value="0" <?php echo $disabled; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="early_leaving_policy" class="col-md-4 col-form-label">Early Leaving Policy (Minutes) <i class="bx bx-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="This sets the policy before the employee can be considered as half day. Set the value to 0 to disable this feature."></i></label>
                                                        <div class="col-md-8">
                                                            <input id="early_leaving_policy" name="early_leaving_policy" class="form-control" type="number" min="0" value="0" <?php echo $disabled; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="overtime_policy" class="col-md-4 col-form-label">Overtime Policy (Minutes) <i class="bx bx-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="This sets the policy before the employee can be considered as overtime. Set the value to 0 to disable this feature."></i></label>
                                                        <div class="col-md-8">
                                                            <input id="overtime_policy" name="overtime_policy" class="form-control" type="number" min="0" value="0" <?php echo $disabled; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="attendance_creation_recommendaiton" class="col-md-4 col-form-label">Attendance Creation Recommendation <i class="bx bx-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="This sets if the attendance creation recommendation is required."></i></label>
                                                        <div class="col-md-8">
                                                            <div class="form-check form-switch mb-3">
                                                                <input class="form-check-input" type="checkbox" id="attendance_creation_recommendation" name="attendance_creation_recommendation" value="1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="attendance_creation_approval" class="col-md-4 col-form-label">Attendance Creation Recommendation Exception</label>
                                                        <div class="col-md-8">
                                                            <select class="form-control select2" id="attendance_creation_approval" multiple="multiple" name="attendance_creation_approval" disabled>
                                                                <?php echo $api->generate_active_employee_options(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="attendance_creation_recommendaiton" class="col-md-4 col-form-label">Attendance Adjustment Recommendation <i class="bx bx-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="This sets if the attendance adjustment recommendation is required."></i></label>
                                                        <div class="col-md-8">
                                                            <div class="form-check form-switch mb-3">
                                                                <input class="form-check-input" type="checkbox" id="attendance_adjustment_recommendation" name="attendance_adjustment_recommendation" value="1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="attendance_adjustment_approval" class="col-md-4 col-form-label">Attendance Adjustment Recommendation Exception</label>
                                                        <div class="col-md-8">
                                                            <select class="form-control select2" id="attendance_adjustment_approval" multiple="multiple" name="attendance_adjustment_approval" disabled>
                                                                <?php echo $api->generate_active_employee_options(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </form>
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
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script src="assets/libs/jquery-validation/js/jquery.validate.min.js"></script>
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <script src="assets/libs/select2/js/select2.min.js"></script>
        <script src="assets/js/system.js?v=<?php echo rand(); ?>"></script>
        <script src="assets/js/pages/attendance-setting.js?v=<?php echo rand(); ?>"></script>
    </body>
</html>