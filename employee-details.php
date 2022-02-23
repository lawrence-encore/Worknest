<?php
    require('session.php');
    require('config/config.php');
    require('classes/api.php');

    $api = new Api;
    $page_title = 'Employee Details';

    $page_access = $api->check_role_permissions($username, 75);
	$update_employee = $api->check_role_permissions($username, 76);
	$view_emergency_contact = $api->check_role_permissions($username, 77);
	$add_emergency_contact = $api->check_role_permissions($username, 78);
	$view_employee_address = $api->check_role_permissions($username, 82);
	$add_employee_address = $api->check_role_permissions($username, 83);
	$view_employee_social = $api->check_role_permissions($username, 87);
	$add_employee_social = $api->check_role_permissions($username, 88);
	$view_employee_attendance = $api->check_role_permissions($username, 99);
	$add_employee_attendance = $api->check_role_permissions($username, 100);
	$view_employee_leave_entitlement = $api->check_role_permissions($username, 114);
	$add_employee_leave_entitlement = $api->check_role_permissions($username, 115);
	$view_employee_leave = $api->check_role_permissions($username, 126);
	$add_employee_leave = $api->check_role_permissions($username, 127);
	$view_employee_file = $api->check_role_permissions($username, 138);
	$add_employee_file = $api->check_role_permissions($username, 139);

    $check_user_account_status = $api->check_user_account_status($username);

    if($check_user_account_status == 0){
        if($page_access == 0 || !isset($_GET['id']) || empty($_GET['id'])){
            header('location: 404-page.php');
        }
        else{
            $system_date = date('Y-m-d');
            $id = $_GET['id'];
            $employee_id = $api->decrypt_data($id);
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
    
            $join_date = $api->check_date('empty', $employee_details[0]['JOIN_DATE'], '', 'm/d/Y', '', '', '');
            $permanency_date = $api->check_date('empty', $employee_details[0]['PERMANENCY_DATE'], '', 'm/d/Y', '', '', '');
            $exit_date = $api->check_date('empty', $employee_details[0]['EXIT_DATE'], '', 'm/d/Y', '', '', '');
            
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Human Resource</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Employee</a></li>
                                            <li class="breadcrumb-item"><a href="all-employees.php">All Employee</a></li>
                                            <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
                                            <li class="breadcrumb-item" id="employee-id"><a href="javascript: void(0);"><?php echo $employee_id; ?></a></li>
                                        </ol>
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
                                                    <h5 class="text-primary">Employee Profile</h5>
                                                    <p>Details of the employee</p>
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
                                                            <h5 class="font-size-14 text-truncate"><?php echo $department_name; ?></h5>
                                                            <p class="text-muted mb-0 text-truncate">Department</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <h5 class="font-size-14 text-truncate"><?php echo $join_date; ?></h5>
                                                            <p class="text-muted mb-0 text-truncate">Joining Date</p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-primary waves-effect waves-light btn-sm" id="view-employee-qr-code">View QR Code</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-grow-1 align-self-center">
                                                        <h4 class="card-title mb-2">Personal Information</h4>
                                                    </div>
                                                    <?php
                                                            if($update_employee > 0 || $add_emergency_contact > 0 || $add_employee_address > 0 || $add_employee_social > 0 || $add_employee_attendance > 0 || $add_employee_leave_entitlement > 0 || $add_employee_leave > 0 || $add_employee_file > 0){
                                                                $employee_dropdown = '<div class="d-flex gap-2">
                                                                <div class="btn-group">
                                                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        Action <i class="mdi mdi-chevron-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-end">';
                                                                    
                                                                        if($update_employee > 0){
                                                                            $employee_dropdown .= '<a class="dropdown-item" href="javascript: void(0);" data-employee-id="'. $employee_id .'" id="update-employee">Update Employee</a>';
                                                                        }
                                                                    
                                                                        if($add_employee_attendance > 0){
                                                                            $employee_dropdown .= '<a class="dropdown-item" href="javascript: void(0);" id="add-employee-attendance">Add Attendance</a>';
                                                                        }

                                                                        if($add_employee_leave > 0){
                                                                            $employee_dropdown .= '<a class="dropdown-item" href="javascript: void(0);" id="add-employee-leave">Add Leave</a>';
                                                                        }

                                                                        if($add_employee_leave_entitlement > 0){
                                                                            $employee_dropdown .= '<a class="dropdown-item" href="javascript: void(0);" id="add-employee-leave-entitlement">Add Leave Entitlement</a>';
                                                                        }
                                                                    
                                                                        if($add_employee_file > 0){
                                                                            $employee_dropdown .= '<a class="dropdown-item" href="javascript: void(0);" id="add-employee-file">Add Employee File</a>';
                                                                        }
                                                                    
                                                                        if($add_employee_address > 0){
                                                                            $employee_dropdown .= '<a class="dropdown-item" href="javascript: void(0);" id="add-employee-address">Add Address</a>';
                                                                        }

                                                                        if($add_emergency_contact > 0){
                                                                            $employee_dropdown .= '<a class="dropdown-item" href="javascript: void(0);" id="add-emergency-contact">Add Emergency Contact</a>';
                                                                        }

                                                                        if($add_employee_social > 0){
                                                                            $employee_dropdown .= '<a class="dropdown-item" href="javascript: void(0);" id="add-employee-social">Add Social Link</a>';
                                                                        }

                                                                        $employee_dropdown .=' </div>
                                                                        </div></div>';

                                                                echo $employee_dropdown;
                                                            }
                                                        ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="bx bx-building-house"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-13 mb-0 text-truncate">Vacation Leave</h5>
                                                </div>
                                                <div class="text-muted mt-4">
                                                    <h5><?php echo $vacation_leave_statistics; ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="bx bx-band-aid"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-13 mb-0 text-truncate">Sick Leave</h5>
                                                </div>
                                                <div class="text-muted mt-4">
                                                    <h5><?php echo $sick_leave_statistics; ?></i></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="bx bx-bell"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-13 mb-0 text-truncate">Emergency Leave</h5>
                                                </div>
                                                <div class="text-muted mt-4">
                                                    <h5><?php echo $emergency_leave_statistics; ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                        <div class="col-md-3">
                                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    <?php
                                                        if($view_employee_attendance > 0){
                                                            echo '<a class="nav-link mb-2 active" id="v-pills-attendance-tab" data-bs-toggle="pill" href="#v-pills-attendance" role="tab" aria-controls="v-pills-attendance" aria-selected="false">Attendance</a>';
                                                        }

                                                        if($view_employee_leave > 0){
                                                            echo '<a class="nav-link mb-2" id="v-pills-leave-tab" data-bs-toggle="pill" href="#v-pills-leave" role="tab" aria-controls="v-pills-leave" aria-selected="false">Leave</a>';
                                                        }

                                                        if($view_employee_leave_entitlement > 0){
                                                            echo '<a class="nav-link mb-2" id="v-pills-leave-entitlement-tab" data-bs-toggle="pill" href="#v-pills-leave-entitlement" role="tab" aria-controls="v-pills-leave-entitlement" aria-selected="false">Leave Entitlement</a>';
                                                        }
                                                    ?>

                                                    <a class="nav-link mb-2" id="v-pills-work-shift-tab" data-bs-toggle="pill" href="#v-pills-work-shift" role="tab" aria-controls="v-pills-work-shift" aria-selected="false">Work Shift</a>
                                                    
                                                    <?php
                                                        if($view_employee_file > 0){
                                                            echo '<a class="nav-link mb-2" id="v-pills-employee-file-tab" data-bs-toggle="pill" href="#v-pills-employee-file" role="tab" aria-controls="v-pills-employee-file" aria-selected="false">Employee File</a>';
                                                        }

                                                        if($view_employee_address > 0){
                                                            echo '<a class="nav-link mb-2" id="v-pills-address-tab" data-bs-toggle="pill" href="#v-pills-address" role="tab" aria-controls="v-pills-address" aria-selected="false">Address</a>';
                                                        }

                                                        if($view_emergency_contact > 0){
                                                            echo '<a class="nav-link mb-2" id="v-pills-emergency-contact-tab" data-bs-toggle="pill" href="#v-pills-emergency-contact" role="tab" aria-controls="v-pills-emergency-contact" aria-selected="false">Emergency Contact</a>';
                                                        }

                                                        if($view_employee_social > 0){
                                                            echo '<a class="nav-link" id="v-pills-social-link-tab" data-bs-toggle="pill" href="#v-pills-social-link" role="tab" aria-controls="v-pills-social-link" aria-selected="false">Social Link</a>';
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                                    <?php
                                                        if($view_employee_attendance > 0){
                                                            echo '<div class="tab-pane fade show active" id="v-pills-attendance" role="tabpanel" aria-labelledby="v-pills-attendance-tab">
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
                                                                </div>';
                                                        }
                                                    ?>
                                                    <div class="tab-pane fade" id="v-pills-work-shift" role="tabpanel" aria-labelledby="v-pills-work-shift-tab">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <?php
                                                                    echo $api->generate_employee_work_shift_schedule_table($employee_id);
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        if($view_employee_leave > 0){
                                                            echo ' <div class="tab-pane fade" id="v-pills-leave" role="tabpanel" aria-labelledby="v-pills-leave-tab">
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
                                                                    </div>';
                                                        }
                                                        
                                                        if($view_employee_leave_entitlement > 0){
                                                            echo ' <div class="tab-pane fade" id="v-pills-leave-entitlement" role="tabpanel" aria-labelledby="v-pills-leave-entitlement-tab">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <table id="employee-leave-entitlement-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th class="all">Leave</th>
                                                                                            <th class="all">Coverage</th>
                                                                                            <th class="all">Entitlement</th>
                                                                                            <th class="all">Action</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody></tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>';
                                                        }
                                                    
                                                        if($view_employee_file > 0){
                                                            echo '<div class="tab-pane fade" id="v-pills-employee-file" role="tabpanel" aria-labelledby="v-pills-employee-file-tab">
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
                                                                </div>';
                                                        }
                                                    
                                                        if($view_employee_address > 0){
                                                            echo '<div class="tab-pane fade" id="v-pills-address" role="tabpanel" aria-labelledby="v-pills-address-tab">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <table id="employee-address-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="all">Address Type</th>
                                                                                        <th class="all">Address</th>
                                                                                        <th class="all">Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody></tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                                                        }

                                                        if($view_emergency_contact > 0){
                                                            echo '<div class="tab-pane fade" id="v-pills-emergency-contact" role="tabpanel" aria-labelledby="v-pills-emergency-contact-tab">
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
                                                                                        <th class="all">Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody></tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                                                        }

                                                        if($view_employee_social > 0){
                                                            echo '<div class="tab-pane fade" id="v-pills-social-link" role="tabpanel" aria-labelledby="v-pills-social-link-tab">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <table id="employee-social-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="all">Social</th>
                                                                                        <th class="all">Link</th>
                                                                                        <th class="all">Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody></tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>';
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
        <script src="assets/js/system.js?v=<?php echo rand(); ?>"></script>
        <script src="assets/js/pages/employee-details.js?v=<?php echo rand(); ?>"></script>
    </body>
</html>