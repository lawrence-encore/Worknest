<?php
    require('session.php');
    require('config/config.php');
    require('classes/api.php');

    $api = new Api;
    $page_title = 'Profile';

    $page_access = $api->check_role_permissions($username, 338);
    $change_password = $api->check_role_permissions($username, 339);

    $check_user_account_status = $api->check_user_account_status($username);

    if($check_user_account_status == 0){
        if($page_access == 0){
            header('location: 404-page.php');
        }
        else{
            $system_date = date('Y-m-d');
            $employee_details = $api->get_employee_details('', $username);
            $employee_id = $employee_details[0]['EMPLOYEE_ID'];
            $employee_details = $api->get_employee_details($employee_id, '');
            $file_as = $employee_details[0]['FILE_AS'];
            $designation = $employee_details[0]['DESIGNATION'];
            $department = $employee_details[0]['DEPARTMENT'];
            $email = $employee_details[0]['EMAIL'];
            $phone = $employee_details[0]['PHONE'];
            $telephone = $employee_details[0]['TELEPHONE'];
            $employment_status = $employee_details[0]['EMPLOYMENT_STATUS'];
            $branch = $employee_details[0]['BRANCH'];
            $exit_reason = $employee_details[0]['EXIT_REASON'];
            $birthday = $api->check_date('empty', $employee_details[0]['BIRTHDAY'], '', 'F d, Y', '', '', '');
    
            $employment_status_details = $api->get_employment_status_details($employment_status);
            $employement_status_name = $employment_status_details[0]['EMPLOYMENT_STATUS'];
    
            $designation_details = $api->get_designation_details($designation);
            $designation_name = $designation_details[0]['DESIGNATION'];
    
            $department_details = $api->get_department_details($department);
            $department_name = $department_details[0]['DEPARTMENT'];
    
            $branch_details = $api->get_branch_details($branch);
            $branch_name = $branch_details[0]['BRANCH'];
    
            $gender_details = $api->get_system_code_details('GENDER', $employee_details[0]['GENDER']);
            $gender_name = $gender_details[0]['DESCRIPTION'] ?? null;
    
            $join_date = $api->check_date('empty', $employee_details[0]['JOIN_DATE'], '', 'F d, Y', '', '', '');
            $permanency_date = $api->check_date('empty', $employee_details[0]['PERMANENCY_DATE'], '', 'F d, Y', '', '', '');
            $exit_date = $api->check_date('empty', $employee_details[0]['EXIT_DATE'], '', 'F d, Y', '', '', '');
            
            $vacation_leave_statistics = $api->get_leave_statistics($employee_id, 'LEAVETP-1', $system_date);
            $sick_leave_statistics = $api->get_leave_statistics($employee_id, 'LEAVETP-2', $system_date);
            $emergency_leave_statistics = $api->get_leave_statistics($employee_id, 'LEAVETP-5', $system_date);
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
        <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
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
                                <div class="page-title-box d-lg-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18"><?php echo $page_title; ?></h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
                                            <li class="breadcrumb-item" id="employee-id"><a href="javascript: void(0);"><?php echo $employee_id; ?></a></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <img src="./assets/images/default/default-avatar.png" alt="avatar" class="avatar-md rounded-circle img-thumbnail">
                                                    </div>
                                                    <div class="flex-grow-1 align-self-center">
                                                        <div class="text-muted">
                                                            <h5 class="mb-1"><?php echo $file_as; ?></h5>
                                                            <p class="mb-0"><?php echo $designation_name; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="col-lg-5 align-self-center">
                                                <div class="text-lg-center mt-4 mt-lg-0">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div>
                                                                <p class="text-muted text-truncate mb-2">Vacation Leave</p>
                                                                <h5 class="mb-0"><?php echo $vacation_leave_statistics; ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div>
                                                                <p class="text-muted text-truncate mb-2">Sick Leave</p>
                                                                <h5 class="mb-0"><?php echo $sick_leave_statistics; ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div>
                                                                <p class="text-muted text-truncate mb-2">Emergency Leave</p>
                                                                <h5 class="mb-0"><?php echo $emergency_leave_statistics; ?></h5>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="col-lg-3 d-none d-lg-block">
                                                <div class="clearfix mt-4 mt-lg-0">
                                                    <div class="dropdown float-end">
                                                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action <i class="mdi mdi-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="javascript: void(0);" id="view-employee-qr-code">View QR Code</a>

                                                            <?php
                                                                if($change_password > 0){
                                                                    echo '<a class="dropdown-item" href="javascript: void(0);" id="change-password">Change Password</a>';
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    <a class="nav-link mb-2 active" id="v-pills-employee-information-tab" data-bs-toggle="pill" href="#v-pills-employee-information" role="tab" aria-controls="v-pills-employee-information" aria-selected="false">Profile</a>
                                                    <a class="nav-link mb-2" id="v-pills-attendance-tab" data-bs-toggle="pill" href="#v-pills-attendance" role="tab" aria-controls="v-pills-attendance" aria-selected="false">Attendance Record</a>
                                                    <a class="nav-link mb-2" id="v-pills-leave-tab" data-bs-toggle="pill" href="#v-pills-leave" role="tab" aria-controls="v-pills-leave" aria-selected="false">Leave</a>
                                                    <a class="nav-link mb-2" id="v-pills-leave-entitlement-tab" data-bs-toggle="pill" href="#v-pills-leave-entitlement" role="tab" aria-controls="v-pills-leave-entitlement" aria-selected="false">Leave Entitlement</a>
                                                    <a class="nav-link mb-2" id="v-pills-employee-payroll-summary-tab" data-bs-toggle="pill" href="#v-pills-employee-payroll-summary" role="tab" aria-controls="v-pills-employee-payroll-summary" aria-selected="false">Payroll Summary</a>
                                                    <a class="nav-link mb-2" id="v-pills-employee-file-tab" data-bs-toggle="pill" href="#v-pills-employee-file" role="tab" aria-controls="v-pills-employee-file" aria-selected="false">Employee File</a>
                                                    <a class="nav-link mb-2" id="v-pills-work-shift-tab" data-bs-toggle="pill" href="#v-pills-work-shift" role="tab" aria-controls="v-pills-work-shift" aria-selected="false">Work Shift</a>
                                                    <a class="nav-link mb-2" id="v-pills-address-tab" data-bs-toggle="pill" href="#v-pills-address" role="tab" aria-controls="v-pills-address" aria-selected="false">Address</a>
                                                    <a class="nav-link mb-2" id="v-pills-emergency-contact-tab" data-bs-toggle="pill" href="#v-pills-emergency-contact" role="tab" aria-controls="v-pills-emergency-contact" aria-selected="false">Emergency Contact</a>
                                                    <a class="nav-link" id="v-pills-social-link-tab" data-bs-toggle="pill" href="#v-pills-social-link" role="tab" aria-controls="v-pills-social-link" aria-selected="false">Social Link</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                                    <div class="tab-pane fade show active" id="v-pills-employee-information" role="tabpanel" aria-labelledby="v-pills-employee-information-tab">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-grow-1 align-self-center">
                                                                        <h4 class="card-title">Employee Information</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table class="table table-nowrap mb-0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th scope="row">Full Name :</th>
                                                                            <td><?php echo $file_as; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Department :</th>
                                                                            <td><?php echo $department_name; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Designation :</th>
                                                                            <td><?php echo $designation_name; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Branch :</th>
                                                                            <td><?php echo $branch_name; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Joining Date :</th>
                                                                            <td><?php echo $join_date; ?></td>
                                                                        </tr>
                                                                        <?php
                                                                            if(!empty($permanency_date)){
                                                                                echo '<tr>
                                                                                        <th scope="row">Permanency Date :</th>
                                                                                        <td>'. $permanency_date .'</td>
                                                                                    </tr>';
                                                                            }

                                                                            if(!empty($exit_date)){
                                                                                echo '<tr>
                                                                                        <th scope="row">Exit Date :</th>
                                                                                        <td>'. $exit_date .'</td>
                                                                                    </tr>';
                                                                            }

                                                                            if(!empty($exit_reason)){
                                                                                echo '<tr>
                                                                                        <th scope="row">Exit Reason :</th>
                                                                                        <td>'. $exit_reason .'</td>
                                                                                    </tr>';
                                                                            }
                                                                        ?>
                                                                        <tr>
                                                                            <th scope="row">Employment Status :</th>
                                                                            <td><?php echo $employement_status_name; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Birthday :</th>
                                                                            <td><?php echo $birthday; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Gender :</th>
                                                                            <td><?php echo $gender_name; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Email :</th>
                                                                            <td><?php echo $email; ?></td>
                                                                        </tr>
                                                                        <?php
                                                                            if(!empty($phone)){
                                                                                echo '<tr>
                                                                                        <th scope="row">Mobile Number :</th>
                                                                                        <td>'. $phone .'</td>
                                                                                    </tr>';
                                                                            }

                                                                            if(!empty($telephone)){
                                                                                echo '<tr>
                                                                                        <th scope="row">Telephone :</th>
                                                                                        <td>'. $telephone .'</td>
                                                                                    </tr>';
                                                                            }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="v-pills-attendance" role="tabpanel" aria-labelledby="v-pills-attendance-tab">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-grow-1 align-self-center">
                                                                        <h4 class="card-title">Attendance Record</h4>
                                                                    </div>
                                                                    <div class="d-flex gap-2">
                                                                         <button type="button" class="btn btn-info waves-effect btn-label waves-light" data-bs-toggle="offcanvas" data-bs-target="#filter-attendance-record" aria-controls="filter-attendance-record"><i class="bx bx-filter-alt label-icon"></i> Filter</button>
                                                                    </div>
                                                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="filter-attendance-record" data-bs-backdrop="true" aria-labelledby="filter-attendance-record-label">
                                                                        <div class="offcanvas-header">
                                                                            <h5 class="offcanvas-title" id="filter-attendance-record-label">Filter</h5>
                                                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="offcanvas-body">
                                                                            <div class="mb-3">
                                                                                <p class="text-muted">Attendance Record Date</p>
                            
                                                                                <div class="input-group mb-3" id="filter-attendance-record-start-date-container">
                                                                                    <input type="text" class="form-control" id="filter_attendance_record_start_date" name="filter_attendance_record_start_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#filter-attendance-record-start-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-orientation="right" placeholder="Start Date" value="<?php echo date('n/01/Y'); ?>">
                                                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                                </div>
                            
                                                                                <div class="input-group" id="filter-attendance-record-end-date-container">
                                                                                    <input type="text" class="form-control" id="filter_attendance_record_end_date" name="filter_attendance_record_end_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#filter-attendance-record-end-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-orientation="right" placeholder="End Date" value="<?php echo date('n/t/Y'); ?>">
                                                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <p class="text-muted">Time In Behavior</p>
                            
                                                                                <select class="form-control filter-attendance-record-select2" id="filter_attendance_record_time_in_behavior">
                                                                                    <option value="">All Time In Behavior</option>
                                                                                    <option value="REG">Regular</option>
                                                                                    <option value="EARLY">Early</option>
                                                                                    <option value="LATE">Late</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <p class="text-muted">Time Out Behavior</p>
                            
                                                                                <select class="form-control filter-attendance-record-select2" id="filter_attendance_record_time_out_behavior">
                                                                                    <option value="">All Time Out Behavior</option>
                                                                                    <option value="REG">Regular</option>
                                                                                    <option value="OT">Overtime</option>
                                                                                    <option value="EL">Early Leaving</option>
                                                                                </select>
                                                                             </div>
                                                                            <div>
                                                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="apply-attendance-record-filter" data-bs-toggle="offcanvas" data-bs-target="#filter-attendance-record" aria-controls="filter-attendance-record">Apply Filter</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                             </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-xl-6">
                                                                <div class="row text-center mb-3">
                                                                    <div class="col-4">
                                                                        <h5 class="mb-0" id="early-statistics">0</h5>
                                                                        <p class="text-muted text-truncate">Early</p>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <h5 class="mb-0" id="time-in-regular-statistics">0</h5>
                                                                        <p class="text-muted text-truncate">Regular</p>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <h5 class="mb-0" id="late-statistics">0</h5>
                                                                        <p class="text-muted text-truncate">Late</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <canvas id="time-in-behavior-doughnut" height="100"></canvas>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <div class="row text-center mb-3">
                                                                    <div class="col-4">
                                                                        <h5 class="mb-0" id="early-leaving-statistics">0</h5>
                                                                        <p class="text-muted text-truncate">Early Leaving</p>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <h5 class="mb-0" id="time-out-regular-statistics">0</h5>
                                                                        <p class="text-muted text-truncate">Regular</p>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <h5 class="mb-0" id="overtime-statistics">0</h5>
                                                                        <p class="text-muted text-truncate">Overtime</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <canvas id="time-out-behavior-doughnut" height="100"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table id="employee-attendance-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="all">Time In</th>
                                                                            <th class="all">Behavior</th>
                                                                            <th class="all">Time Out</th>
                                                                            <th class="all">Behavior</th>
                                                                            <th class="all">Late</th>
                                                                            <th class="all">Early Leave</th>
                                                                            <th class="all">Overtime</th>
                                                                            <th class="all">Total Hours</th>
                                                                            <th class="all">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody></tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="v-pills-leave" role="tabpanel" aria-labelledby="v-pills-leave-tab">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-grow-1 align-self-center">
                                                                        <h4 class="card-title">Leave</h4>
                                                                    </div>
                                                                    <div class="d-flex gap-2">
                                                                        <button type="button" class="btn btn-info waves-effect btn-label waves-light" data-bs-toggle="offcanvas" data-bs-target="#filter-employee-leave" aria-controls="filter-employee-leave"><i class="bx bx-filter-alt label-icon"></i> Filter</button>
                                                                    </div>
                                                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="filter-employee-leave" data-bs-backdrop="true" aria-labelledby="filter-employee-leave-label">
                                                                        <div class="offcanvas-header">
                                                                            <h5 class="offcanvas-title" id="filter-employee-leave-label">Filter</h5>
                                                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="offcanvas-body">
                                                                            <div class="mb-3">
                                                                                <p class="text-muted">Leave Date</p>

                                                                                <div class="input-group mb-3" id="filter-employee-leave-start-date-container">
                                                                                    <input type="text" class="form-control" id="filter_employee_leave_start_date" name="filter_start_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#filter-employee-leave-start-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-orientation="right" placeholder="Start Date" value="<?php echo date('n/01/Y'); ?>">
                                                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                                </div>

                                                                                <div class="input-group" id="filter--employee-leaveend-date-container">
                                                                                    <input type="text" class="form-control" id="filter_employee_leave_end_date" name="filter_end_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#filter-employee-leave-end-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-orientation="right" placeholder="End Date" value="<?php echo date('n/t/Y'); ?>">
                                                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <p class="text-muted">Leave Type</p>

                                                                                <select class="form-control filter-employee-leave-select2" id="filter_employee_leave_type">
                                                                                    <option value="">All Leave Type</option>
                                                                                    <?php echo $api->generate_leave_type_options(); ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <p class="text-muted">Leave Status</p>

                                                                                <select class="form-control filter-employee-leave-select2" id="filter_employee_leave_status">
                                                                                    <option value="">All Leave Status</option>
                                                                                    <option value="APV">Approved</option>
                                                                                    <option value="APVSYS">Approved (System Generation)</option>
                                                                                    <option value="CAN">Cancelled</option>
                                                                                    <option value="PEN">Pending</option>
                                                                                    <option value="REJ">Rejected</option>
                                                                                </select>
                                                                            </div>
                                                                            <div>
                                                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="apply-employee-leave-filter" data-bs-toggle="offcanvas" data-bs-target="#filter-employee-leave" aria-controls="filter-employee-leave">Apply Filter</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table id="employee-leave-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="all">Leave</th>
                                                                            <th class="all">Entitlement Status</th>
                                                                            <th class="all">Date</th>
                                                                            <th class="all">Status</th>
                                                                            <th class="all">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody></tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="v-pills-leave-entitlement" role="tabpanel" aria-labelledby="v-pills-leave-entitlement-tab">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-grow-1 align-self-center">
                                                                        <h4 class="card-title">Leave Entitlement</h4>
                                                                    </div>
                                                                    <div class="d-flex gap-2">
                                                                        <button type="button" class="btn btn-info waves-effect btn-label waves-light" data-bs-toggle="offcanvas" data-bs-target="#filter-employee-leave-entitlement" aria-controls="filter-employee-leave-entitlement"><i class="bx bx-filter-alt label-icon"></i> Filter</button>
                                                                    </div>
                                                                </div>
                                                                <div class="offcanvas offcanvas-end" tabindex="-1" id="filter-employee-leave-entitlement" data-bs-backdrop="true" aria-labelledby="filter-employee-leave-entitlement-label">
                                                                    <div class="offcanvas-header">
                                                                        <h5 class="offcanvas-title" id="filter-employee-leave-entitlement-label">Filter</h5>
                                                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="offcanvas-body">
                                                                        <div class="mb-3">
                                                                            <p class="text-muted">Coverage Date</p>

                                                                            <div class="input-group mb-3" id="filter-leave-entitlement-start-date-container">
                                                                                <input type="text" class="form-control" id="filter_leave_entitlement_start_date" name="filter_start_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#filter-leave-entitlement-start-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-orientation="right" placeholder="Start Date" value="<?php echo date('1/01/Y'); ?>">
                                                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                            </div>

                                                                            <div class="input-group" id="filter-leave-entitlement-end-date-container">
                                                                                <input type="text" class="form-control" id="filter_leave_entitlement_end_date" name="filter_end_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#filter-leave-entitlement-end-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-orientation="right" placeholder="End Date" value="<?php echo date('12/31/Y'); ?>">
                                                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <p class="text-muted">Leave Type</p>

                                                                            <select class="form-control filter-leave-entitlement-select2" id="filter_leave_entitlement_leave_type">
                                                                                <option value="">All Leave Type</option>
                                                                                <?php $api->generate_leave_type_options() ?>
                                                                            </select>
                                                                        </div>
                                                                        <div>
                                                                            <button type="button" class="btn btn-primary waves-effect waves-light" id="apply-employee-leave-entitlement-filter" data-bs-toggle="offcanvas" data-bs-target="#filter-employee-leave-entitlement" aria-controls="filter-employee-leave-entitlement">Apply Filter</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table id="employee-leave-entitlement-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="all">Leave</th>
                                                                            <th class="all">Coverage</th>
                                                                            <th class="all">Entitlement</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody></tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="v-pills-employee-payroll-summary" role="tabpanel" aria-labelledby="v-pills-employee-payroll-summary-tab">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-grow-1 align-self-center">
                                                                        <h4 class="card-title">Payroll Summary</h4>
                                                                    </div>
                                                                    <div class="d-flex gap-2">
                                                                        <button type="button" class="btn btn-info waves-effect btn-label waves-light" data-bs-toggle="offcanvas" data-bs-target="#filter-employee-payroll-summary" aria-controls="filter-employee-payroll-summary"><i class="bx bx-filter-alt label-icon"></i> Filter</button>
                                                                    </div>
                                                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="filter-employee-payroll-summary" data-bs-backdrop="true" aria-labelledby="filter-employee-payroll-summary-label">
                                                                        <div class="offcanvas-header">
                                                                            <h5 class="offcanvas-title" id="filter-employee-payroll-summary-label">Filter</h5>
                                                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="offcanvas-body">
                                                                            <div class="mb-3">
                                                                                <p class="text-muted">Payroll Coverage</p>

                                                                                <div class="input-group mb-3" id="filter-employee-payroll-summary-start-date-container">
                                                                                    <input type="text" class="form-control" id="filter_employee_payroll_summary_start_date" name="filter_employee_payroll_summary_start_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#filter-employee-payroll-summary-start-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-orientation="right" placeholder="Start Date" value="<?php echo date('n/01/Y'); ?>">
                                                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                                </div>

                                                                                <div class="input-group" id="filter-employee-payroll-summary-end-date-container">
                                                                                    <input type="text" class="form-control" id="filter_employee_payroll_summary_end_date" name="filter_employee_payroll_summary_end_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#filter-employee-payroll-summary-end-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-orientation="right" placeholder="End Date" value="<?php echo date('n/t/Y'); ?>">
                                                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="apply-employee-payroll-summary-filter" data-bs-toggle="offcanvas" data-bs-target="#filter-employee-payroll-summary" aria-controls="filter-employee-payroll-summary">Apply Filter</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table id="employee-payroll-summary-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="all">Pay Run</th>
                                                                            <th class="all">Gross Pay</th>
                                                                            <th class="all">Net Pay</th>
                                                                            <th class="all">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody></tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="v-pills-employee-file" role="tabpanel" aria-labelledby="v-pills-employee-file-tab">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-grow-1 align-self-center">
                                                                        <h4 class="card-title">Employee File</h4>
                                                                    </div>
                                                                    <div class="d-flex gap-2">
                                                                        <button type="button" class="btn btn-info waves-effect btn-label waves-light" data-bs-toggle="offcanvas" data-bs-target="#filter-employee-file" aria-controls="filter-employee-file"><i class="bx bx-filter-alt label-icon"></i> Filter</button>
                                                                    </div>
                                                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="filter-employee-file" data-bs-backdrop="true" aria-labelledby="filter-employee-file-label">
                                                                        <div class="offcanvas-header">
                                                                            <h5 class="offcanvas-title" id="filter-employee-file-label">Filter</h5>
                                                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="offcanvas-body">
                                                                            <div class="mb-3">
                                                                                <p class="text-muted">File Date</p>

                                                                                <div class="input-group mb-3" id="filter-file-employee-file-start-date-container">
                                                                                    <input type="text" class="form-control" id="filter_employee_file_start_date" name="filter_employee_file_start_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#filter-file-employee-file-start-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-orientation="right" placeholder="Start Date" value="<?php echo date('n/01/Y'); ?>">
                                                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                                </div>

                                                                                <div class="input-group" id="filter-file-employee-file-end-date-container">
                                                                                    <input type="text" class="form-control" id="filter_employee_file_end_date" name="filter_employee_file_end_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#filter-file-employee-file-end-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-orientation="right" placeholder="End Date" value="<?php echo date('n/t/Y'); ?>">
                                                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <p class="text-muted">Upload Date</p>

                                                                                <div class="input-group mb-3" id="filter-upload-employee-file-start-date-container">
                                                                                    <input type="text" class="form-control" id="filter_upload_employee_file_start_date" name="filter_upload_employee_file_start_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#filter-upload-employee-file-start-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-orientation="right" placeholder="Start Date">
                                                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                                </div>

                                                                                <div class="input-group" id="filter-upload-employee-file-end-date-container">
                                                                                    <input type="text" class="form-control" id="filter_upload_employee_file_end_date" name="filter_upload_employee_file_end_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#filter-upload-employee-file-end-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-orientation="right" placeholder="End Date">
                                                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <p class="text-muted">File Category</p>

                                                                                <select class="form-control filter-employee-file-select2" id="filter_employee_file_category">
                                                                                    <option value="">All File Category</option>
                                                                                    <?php echo $api->generate_system_code_options('FILECATEGORY'); ?>
                                                                                </select>
                                                                            </div>
                                                                            <div>
                                                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="apply-employee-file-filter" data-bs-toggle="offcanvas" data-bs-target="#filter-employee-file" aria-controls="filter-employee-file">Apply Filter</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table id="employee-file-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="all">File</th>
                                                                            <th class="all">File Date</th>
                                                                            <th class="all">File Category</th>
                                                                            <th class="all">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody></tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="v-pills-work-shift" role="tabpanel" aria-labelledby="v-pills-work-shift-tab">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="flex-grow-1 align-self-center">
                                                                    <h4 class="card-title">Work Shift</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <?php
                                                                    echo $api->generate_employee_work_shift_schedule_table($employee_id);
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="v-pills-address" role="tabpanel" aria-labelledby="v-pills-address-tab">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-grow-1 align-self-center">
                                                                        <h4 class="card-title">Address</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table id="employee-address-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                                    <thead>
                                                                        <tr>
                                                                             <th class="all">Address Type</th>
                                                                             <th class="all">Address</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody></tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="v-pills-emergency-contact" role="tabpanel" aria-labelledby="v-pills-emergency-contact-tab">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-grow-1 align-self-center">
                                                                        <h4 class="card-title">Emergency Contact</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table id="emergency-contact-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="all">Name</th>
                                                                            <th class="all">Phone</th>
                                                                            <th class="all">Email</th>
                                                                            <th class="all">Telephone</th>
                                                                            <th class="all">Address</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody></tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="v-pills-social-link" role="tabpanel" aria-labelledby="v-pills-social-link-tab">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-grow-1 align-self-center">
                                                                        <h4 class="card-title">Social Link</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table id="employee-social-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="all">Social</th>
                                                                            <th class="all">Link</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody></tbody>
                                                                </table>
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
        <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/libs/qrcode/qrcode.min.js"></script>
        <script src="assets/libs/chart.js/Chart.bundle.min.js"></script>
        <script src="assets/js/system.js?v=<?php echo rand(); ?>"></script>
        <script src="assets/js/pages/profile.js?v=<?php echo rand(); ?>"></script>
    </body>
</html>