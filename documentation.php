<?php
    require('session.php');
    require('config/config.php');
    require('classes/api.php');

    $api = new Api;
    $page_title = 'Documentation';

	$check_user_account_status = $api->check_user_account_status($username);

    if($check_user_account_status){
        header('location: logout.php?logout');
    }

    require('views/_application_settings.php');
?>

<!doctype html>
<html lang="en">
    <head>
        <?php require('views/_head.php'); ?>
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
                                                    <a class="nav-link mb-2 active" id="v-pills-introduction-tab" data-bs-toggle="pill" href="#v-pills-introduction" role="tab" aria-controls="v-pills-introduction" aria-selected="false">Introduction</a>
                                                    <a class="nav-link mb-2" id="v-pills-installation-tab" data-bs-toggle="pill" href="#v-pills-installation" role="tab" aria-controls="v-pills-installation" aria-selected="false">Installation</a>
                                                    <a class="nav-link mb-2" id="v-pills-common-error-tab" data-bs-toggle="pill" href="#v-pills-common-error" role="tab" aria-controls="v-pills-common-error" aria-selected="false">Common Errors & Issues</a>
                                                    <a class="nav-link mb-2" id="v-pills-important-setting-tab" data-bs-toggle="pill" href="#v-pills-important-setting" role="tab" aria-controls="v-pills-important-setting" aria-selected="false">Important Settings</a>
                                                    <a class="nav-link mb-2" id="v-pills-instruction-guide-tab" data-bs-toggle="pill" href="#v-pills-instruction-guide" role="tab" aria-controls="v-pills-instruction-guide" aria-selected="false">Instruction Guide</a>
                                                    <a class="nav-link mb-2" id="v-pills-change-log-tab" data-bs-toggle="pill" href="#v-pills-change-log" role="tab" aria-controls="v-pills-change-log" aria-selected="false">Change Log</a>
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
                                                    <div class="tab-pane fade show active" id="v-pills-introduction" role="tabpanel" aria-labelledby="v-pills-introduction-tab">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-grow-1 align-self-center">
                                                                        <h4 class="card-title">Introduction</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <p>DIS is designed to be an all-in-one online software. What sets it apart from other similar products are the innovation and experience that have gone into its development, making it incredibly intuitive, flexible and scalable to match the changing needs of a growing business.</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h5 class="font-size-15">Attendance Management</h5>
                                                                <p class="mb-2">Attendance management system enables an employer to manage their employee’s working hours, late arrivals, early departures and absenteeism.</p>
                                                                <p class="mb-1">Features:</p>                                                                
                                                                <ul>
                                                                    <li>Manual attendance by admin or manager</li>
                                                                    <li>Bulk CSV attendance import</li>
                                                                    <li>Attendance by employee</li>
                                                                    <li>QR code attendance system</li>
                                                                    <li>Attendance report management</li>
                                                                    <li>Flexible attendance settings</li>
                                                                    <li>Employees can request attendance adjustment or attendance creation</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h5 class="font-size-15">Employee Management</h5>
                                                                <p class="mb-2">Employee management system is designed to streamline human resource and other department duties. It consists of organizational work related and important personal information about an employee. EMS simplifies employee management and manages employee leave, attendance and salary.</p>
                                                                <p class="mb-1">Features:</p>                                                                
                                                                <ul>
                                                                    <li>Employee management</li>
                                                                    <li>Branch, Department and Designation management</li>
                                                                    <li>Bulk CSV employee import</li>
                                                                    <li>Employee documents management</li>
                                                                    <li>Employee profile</li>
                                                                    <li>Salary Management</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h5 class="font-size-15">Holiday Management</h5>
                                                                <p class="mb-2">Holiday management system facilitates the company holiday plan made easy and user-friendly. It handles the balance of leave, absence request, and employee attendance management. Holiday management is a crucial process in managing your staff.</p>
                                                                <p class="mb-1">Features:</p>                                                                
                                                                <ul>
                                                                    <li>Admin/Manager can create, update and delete holiday</li>
                                                                    <li>Admin/Manager can assign holiday on branches for local holidays</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h5 class="font-size-15">Leave Management</h5>
                                                                <p class="mb-2">Leave management is the process of managing employee leave requests in an accurate and efficient way. It tracks leave information accurately which is used for automated payroll processing.</p>
                                                                <p class="mb-1">Features:</p>                                                                
                                                                <ul>
                                                                    <li>Admin/Manager can add leave type</li>
                                                                    <li>Admin/manager can add leave entitlements</li>
                                                                    <li>Employee can apply for leave</li>
                                                                    <li>Admin/Manager or Department Head can approve, reject or cancel leave</li>
                                                                    <li>Admin/Manager can manually add employee leave</li>
                                                                    <li>Auto crediting of leave</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h5 class="font-size-15">Employee Shift Management</h5>
                                                                <p class="mb-2">Employee shift management is a totally essential aspect for any organization to optimize resources and team. This offers flexibility to HR managers in developing and dealing with shifts.</p>
                                                                <p class="mb-1">Features:</p>                                                                
                                                                <ul>
                                                                    <li>Admin/Manager can add new shift</li>
                                                                    <li>Easy to manage shift</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h5 class="font-size-15">Payslip Management</h5>
                                                                <p class="mb-2">Payslip management system is a software that is designed to manage all the tasks of employee payment and tax filing. It is the administration of the financial record of employee salary, wages, allowances and deductions.</p>
                                                                <p class="mb-1">Features:</p>                                                                
                                                                <ul>
                                                                    <li>Unlimited Payslip Creation</li>
                                                                    <li>Add allowance, other income, deduction and government contributions</li>
                                                                    <li>HTML/PDF payslip creation</li>
                                                                    <li>Create payslip for a specific date</li>
                                                                    <li>Send payslips through email</li>
                                                                    <li>Accurate computation of withholding tax</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h5 class="font-size-15">User Management</h5>
                                                                <p class="mb-2">User management system is an administration module of the company to access and control your core functions. An effective user management system allows your company to tightly define each employee level of access to data, based on user role.</p>
                                                                <p class="mb-1">Features:</p>                                                                
                                                                <ul>
                                                                    <li>Role-based access</li>
                                                                    <li>User creation system</li>
                                                                    <li>Password automatic expiry</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h5 class="font-size-15">System Management</h5>
                                                                <p class="mb-2">System management is designed to handle the flexibility of the system. It is the backbone of any system.</p>
                                                                <p class="mb-1">Features:</p>                                                                
                                                                <ul>
                                                                    <li>Notification management</li>
                                                                    <li>File upload management</li>
                                                                    <li>System Code management</li>
                                                                    <li>User interface management</li>
                                                                    <li>Transaction log tracking system</li>
                                                                    <li>Database backup</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="v-pills-installation" role="tabpanel" aria-labelledby="v-pills-installation-tab">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-grow-1 align-self-center">
                                                                        <h4 class="card-title">Server Requirements</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <p>Make sure all requirement meets before installation.</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                            <h5 class="font-size-14">Minimum Hardware Requirements</h5>                                                               
                                                                <ul>
                                                                    <li>Operating System: Windows 7</li>
                                                                    <li>CPU: Intel Core i3/Ryzen 3</li>
                                                                    <li>RAM: 4Gb</li>
                                                                    <li>Storage: 500Gb HDD or 250Gb SSD</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h5 class="font-size-14">Recommended Hardware Requirements</h5>                                                          
                                                                <ul>
                                                                    <li>Operating System: Windows 10 or higher</li>
                                                                    <li>CPU: Intel Core i5/Ryzen 5</li>
                                                                    <li>RAM: 8Gb or higher</li>
                                                                    <li>Storage: 500Gb HDD or 250Gb SSD</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h5 class="font-size-14">Software Requirements</h5>
                                                                <p class="mb-2">You can download the latest version of XAMPP <a href="https://www.apachefriends.org/download.html" target="_blank">here</a>.</p>
                                                                <ul>
                                                                    <li>XAMPP Version: 7.4.29 or above</li>
                                                                    <li>PHP Version Version: 7.4.29 or above</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5 class="font-size-15">PHP Configuration</h5>
                                                                <p class="mb-2">Open your php configuration file php.ini and change the following settings. If you are using Cpanel, login your Cpanel > search “MultiPHP INI Editor or Select PHP version/selector” and increase the above Options. Also,you can follow the Tutorials to change your PHP memory limit settings: <a href="https://youtu.be/cH0vQwGoPA0" target="_blank">https://youtu.be/cH0vQwGoPA0</a></p>
                                                                <ul>
                                                                    <li>max_execution_time = 30000</li>
                                                                    <li>max_input_time = 30000</li>
                                                                    <li>memory_limit = 128M</li>
                                                                    <li>post_max_size = 128MB</li>
                                                                    <li>upload_max_filesize = 128MB</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="v-pills-common-error" role="tabpanel" aria-labelledby="v-pills-common-error-tab">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-grow-1 align-self-center">
                                                                        <h4 class="card-title">Common Errors & Issues</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <p class="mb-2">We are continuously updating this page and we are explaining the various types of errors and possible solutions regarding the issues.</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5 class="font-size-14">Not Receiving Email Notification</h5>
                                                                <p class="mb-2">Configure your email delivery service from Settings > Email Settings Make sure that your email delivery service credentials are correct. If you have completed setting up your email server and you are still not getting any emails, these are the possible reasons and solutions.</p>
                                                                <ol>
                                                                    <li>Email is marked as spam: Configure DKIM & SPF records are used by email providers to verify and increase the trust of email coming from your server. This is usually common for shared hosting. You can check if your server has been blacklisted here. If your server is blacklisted, you will need to contact your web hosting provider for help.</li>
                                                                    <li>Make sure that your web hosting server (email server) has been blacklisted. If your server is blacklisted, you will need to contact your web hosting provider for help.</li>
                                                                    <li>Check the configuration of your email and do a test email.</li>
                                                                    <li>Make sure that the email notification is enabled on application notification.</li>
                                                                </ol>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5 class="font-size-14">Server Error</h5>
                                                                <p class="mb-2">You need to download <b>error logs</b> to identify the error. Contact <b>digital.integrated@gmail.com</b> to further assistance.You will need to log in to your Cpanel/web hosting control panels > File Manager (you can also use an FTP client if you prefer).</p>
                                                                <ol>
                                                                    <li>For <b>root</b> directory go to <b>your_domain/public_html/error_log</b>.</li>
                                                                    <li>For <b>sub_folder</b> directory go to <b>your_domain/public_html/sub_folder/error_log</b>.</li>
                                                                    ** Make sure log_errors option is enabled for your server.<br/>
                                                                    ** Please note this path might differ depending on your web hosting setup.
                                                                </ol>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5 class="font-size-14">404 Not Found</h5>
                                                                <ol>
                                                                    <li>If you are getting a Not Found (The requested URL was not found on this server) in the Installation phase, you need to configure your server properly.</li>
                                                                    <li>Check if your user account has permission to the page your accessing.</li>
                                                                </ol>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5 class="font-size-14">500 Server Error</h5>
                                                                <p class="mb-2">If you are getting a 500 server error, it means that the application has encountered an error and you will need to download the error logs to identify the error.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="v-pills-important-setting" role="tabpanel" aria-labelledby="v-pills-important-setting-tab">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-grow-1 align-self-center">
                                                                        <h4 class="card-title">Important settings for the app</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <p class="mb-2">Few important settings are needed to run the app. Without these settings app can't do some process.</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="accordion" id="important_setting">
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="headingOne">
                                                                            <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#company_setting" aria-expanded="true" aria-controls="company_setting">
                                                                            Company Setting
                                                                            </button>
                                                                        </h2>
                                                                        <div id="company_setting" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#important_setting">
                                                                            <div class="accordion-body">
                                                                                <div class="text-muted">
                                                                                    <p class="mb-2">This is where you configure the information of your company. You can setup company setting from here: Settings > Company Settings</p>
                                                                                    <img src="./assets/images/documentation/important_setting/company_setting.png" class="img-fluid mx-auto d-block mb-2"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="headingOne">
                                                                            <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#attendance_setting" aria-expanded="true" aria-controls="attendance_setting">
                                                                            Attendance Setting
                                                                            </button>
                                                                        </h2>
                                                                        <div id="attendance_setting" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#important_setting">
                                                                            <div class="accordion-body">
                                                                                <div class="text-muted">
                                                                                    <p class="mb-2">This is where you configure the parameters of your attendance. You can setup attendance setting from here: Settings > Attendance Settings</p>
                                                                                    <img src="./assets/images/documentation/important_setting/attendance_setting.png" class="img-fluid mx-auto d-block mb-2"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="headingOne">
                                                                            <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#payroll_setting" aria-expanded="true" aria-controls="payroll_setting">
                                                                            Payroll Setting
                                                                            </button>
                                                                        </h2>
                                                                        <div id="payroll_setting" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#important_setting">
                                                                            <div class="accordion-body">
                                                                                <div class="text-muted">
                                                                                    <p class="mb-2">This is where you configure the parameters of your payroll. You can setup payroll setting from here: Payroll > Payroll Settings</p>
                                                                                    <img src="./assets/images/documentation/important_setting/payroll_setting.png" class="img-fluid mx-auto d-block mb-2"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="headingOne">
                                                                            <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#email_configuration" aria-expanded="true" aria-controls="email_configuration">
                                                                            Email Setting
                                                                            </button>
                                                                        </h2>
                                                                        <div id="email_configuration" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#important_setting">
                                                                            <div class="accordion-body">
                                                                                <div class="text-muted">
                                                                                    <p class="mb-2">Email settings is one of the most important settings for the app. Email settings mean which settings your app will use to send mail. . You can setup attendance setting from here: Settings > Email Settings</p>
                                                                                    <img src="./assets/images/documentation/important_setting/email_configuration.png" class="img-fluid mx-auto d-block mb-2"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="v-pills-instruction-guide" role="tabpanel" aria-labelledby="v-pills-instruction-guide-tab">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-grow-1 align-self-center">
                                                                        <h4 class="card-title">Instruction Guide</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="v-pills-change-log" role="tabpanel" aria-labelledby="v-pills-change-log-tab">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-grow-1 align-self-center">
                                                                        <h4 class="card-title">Change Log</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5 class="font-size-14">Version 1.0.0 - May 01, 2022</h5>
                                                                <ul>
                                                                    <li>Initial release.</li>
                                                                </ul>
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
        <script src="assets/js/system.js?v=<?php echo rand(); ?>"></script>
    </body>
</html>