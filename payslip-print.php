<?php
    require('session.php');
    require('config/config.php');
    require('classes/api.php');

    $api = new Api;
    $page_title = 'Payslip Print';

    $page_access = $api->check_role_permissions($username, 304);
	$delete_pay_slip = $api->check_role_permissions($username, 305);
	$send_pay_slip = $api->check_role_permissions($username, 306);
	$print_pay_slip = $api->check_role_permissions($username, 307);
    
    $check_user_account_status = $api->check_user_account_status($username);

    if($check_user_account_status == 0){
        if($page_access == 0 || !isset($_GET['id']) || empty($_GET['id'])){
            header('location: 404-page.php');
        }
        else{
            $id = $_GET['id'];
            $payslip_id = $api->decrypt_data($id);
            $payslip_details = $api->get_payslip_details($payslip_id);
            $pay_run_id = $payslip_details[0]['PAY_RUN_ID'];
            $employee_id = $payslip_details[0]['EMPLOYEE_ID'];
            $pay_run_encrypted = $api->encrypt_data($pay_run_id);

            # Company details
            $company_setting_details = $api->get_company_setting_details(1);
            $company_name = $company_setting_details[0]['COMPANY_NAME'];
            $company_address = $company_setting_details[0]['ADDRESS'];
            $company_province_id = $company_setting_details[0]['PROVINCE_ID'];
            $company_city_id = $company_setting_details[0]['CITY_ID'];
            $company_logo = $api->check_image($company_setting_details[0]['COMPANY_LOGO'] ?? null, 'company logo');

            # Company province details
            $company_province_details = $api->get_province_details($company_province_id);
            $company_province = $company_province_details[0]['PROVINCE'];

            # Company city details
            $city_details = $api->get_city_details($company_city_id, $company_province_id);
            $company_city = $city_details[0]['CITY'];

            # Employee details
            $employee_details = $api->get_employee_details($employee_id, '');
            $file_as = $employee_details[0]['FILE_AS'];
            $designation = $employee_details[0]['DESIGNATION'];
            $department = $employee_details[0]['DEPARTMENT'];

            # Designation details
            $designation_details = $api->get_designation_details($designation);
            $designation_name = $designation_details[0]['DESIGNATION'];
            $system_date = date('Y-m-d');

            # Department details
            $department_details = $api->get_department_details($department);
            $department_name = $department_details[0]['DEPARTMENT'];

            # Payrun details
            $pay_run_details = $api->get_pay_run_details($pay_run_id);
            $coverage_start_date = $api->check_date('empty', $pay_run_details[0]['START_DATE'], '', 'F d, Y', '', '', '');
            $coverage_end_date = $api->check_date('empty', $pay_run_details[0]['END_DATE'], '', 'F d, Y', '', '', '');
            $generated_date = ' <strong>Generated Date:</strong><br>'. date('F d, Y');
            $payslip_pay_run_details = ' <strong>Coverage Date:</strong><br>' . $coverage_start_date . ' - ' . $coverage_end_date;

            $payslip_employee_details = ' <strong>'. $file_as .'</strong><br>
                                            '. $designation_name .'<br>
                                            '. $department_name .'<br>
                                            Employee ID: ' . $employee_id;

            $payslip_company_details = ' <strong>'. $company_name .'</strong><br>
                                            ' . $company_address . ', ' . $company_city . ', ' . $company_province;

            $payslip_earnings_table = $api->generate_payslip_earnings_table($payslip_id, $employee_id);
            $payslip_deduction_table = $api->generate_payslip_deduction_table($payslip_id, $employee_id);
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Payroll</a></li>
                                            <li class="breadcrumb-item"><a href="pay-run.php">Pay Run</a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo 'payslip.php?id=' . $pay_run_encrypted; ?>">Payslip</a></li>
                                            <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
                                            <li class="breadcrumb-item" id="payslip-id"><a href="javascript: void(0);"><?php echo $payslip_id; ?></a></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="invoice-title">
                                            <h4 class="float-end font-size-16"># <?php echo $payslip_id; ?></h4>
                                                <div class="mb-4">
                                                    <img src="<?php echo $company_logo; ?>" alt="company logo" style="max-height: 50px"/>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-print-6">
                                                    <address><?php echo $payslip_company_details; ?></address>
                                                </div>
                                                <div class="col-print-6 text-end">
                                                    <address class="mt-2 mt-sm-0"><?php echo $generated_date; ?></address>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-print-6">
                                                    <address><?php echo $payslip_employee_details; ?></address>
                                                </div>
                                                <div class="col-print-6 text-end">
                                                    <address class="mt-2 mt-sm-0"><?php echo $payslip_pay_run_details; ?></address>
                                                </div>
                                            </div>
                                            <div class="py-0 mt-0">
                                                <h3 class="font-size-15 fw-bold">Earnings</h3>
                                            </div>
                                            <div class="table-responsive" id="earnings_table">
                                                <?php echo $payslip_earnings_table; ?>
                                            </div>
                                            <div class="py-0 mt-0">
                                                <h3 class="font-size-15 fw-bold">Deductions</h3>
                                            </div>
                                            <div class="table-responsive" id="deductions_table">
                                                <?php echo $payslip_deduction_table; ?>
                                            </div>
                                            <div class="d-print-none">
                                                <div class="float-end">
                                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
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
        <script src="assets/js/system.js?v=<?php echo rand(); ?>"></script>
    </body>
</html>