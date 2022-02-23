<?php
    require('session.php');
    require('config/config.php');
    require('classes/api.php');

    $api = new Api;
    $page_title = 'Email Setting';

    $page_access = $api->check_role_permissions($username, 42);
    $update_email_configuration = $api->check_role_permissions($username, 43);
    $view_transaction_log = $api->check_role_permissions($username, 44);
    
    $email_configuration_details = $api->get_email_configuration_details(1);
    $transaction_log_id = $email_configuration_details[0]['TRANSACTION_LOG_ID'] ?? null;

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
                                                        <h4 class="card-title">Email Configuration</h4>
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                    <button type="button" class="btn btn-success waves-effect waves-light" id="send-test-email">Send Test Email</button>
                                                    <?php
                                                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                                                            echo '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'">Transaction Log</button>';
                                                        }

                                                        if($update_email_configuration > 0){
                                                            echo '<button type="submit" class="btn btn-primary waves-effect waves-light" form="email-configuration-form" id="submit-email-setting-form">Save</button>';
                                                                    
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
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form class="cmxform" id="email-configuration-form" method="post" action="#">
                                                            <div class="row mb-3">
                                                                <label for="mail_host" class="col-md-2 col-form-label">Mail Host <span class="required">*</span></label>
                                                                <div class="col-md-10">
                                                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="mail_host" name="mail_host" maxlength="100" <?php echo $disabled; ?>>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="port" class="col-md-2 col-form-label">Mail Port <span class="required">*</span></label>
                                                                <div class="col-md-10">
                                                                    <input id="port" name="port" class="form-control" type="number" min="0" <?php echo $disabled; ?>>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="mail_user" class="col-md-2 col-form-label">Mail Username <span class="required">*</span></label>
                                                                <div class="col-md-10">
                                                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="mail_user" name="mail_user" maxlength="200" <?php echo $disabled; ?>>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="mail_password" class="col-md-2 col-form-label">Mail Password</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group auth-pass-inputgroup">
                                                                        <input type="password" id="mail_password" name="mail_password" class="form-control" aria-label="Password" aria-describedby="password-addon" <?php echo $disabled; ?>>
                                                                        <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="mail_encryption" class="col-md-2 col-form-label">Mail Encryption <span class="required">*</span></label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group auth-pass-inputgroup">
                                                                        <select class="form-control form-select2" id="mail_encryption" name="mail_encryption" <?php echo $disabled; ?>>
                                                                            <option value="">--</option>
                                                                            <?php echo $api->generate_system_code_options('MAILENCRYPTION'); ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="smtp_auth" class="col-md-2 col-form-label">SMTP Authentication</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group auth-pass-inputgroup">
                                                                        <select class="form-control form-select2" id="smtp_auth" name="smtp_auth" <?php echo $disabled; ?>>
                                                                            <option value="1">True</option>
                                                                            <option value="0">False</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="smtp_auto_tls" class="col-md-2 col-form-label">SMTP Auto TLS</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group auth-pass-inputgroup">
                                                                        <select class="form-control form-select2" id="smtp_auto_tls" name="smtp_auto_tls" <?php echo $disabled; ?>>
                                                                            <option value="1">True</option>
                                                                            <option value="0">False</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="mail_from_name" class="col-md-2 col-form-label">Mail From Name <span class="required">*</span></label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group auth-pass-inputgroup">
                                                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="mail_from_name" name="mail_from_name" maxlength="200" <?php echo $disabled; ?>>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="mail_from_email" class="col-md-2 col-form-label">Mail From Email <span class="required">*</span></label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group auth-pass-inputgroup">
                                                                    <input class="form-control email-inputmask form-maxlength" autocomplete="off" id="mail_from_email" name="mail_from_email" maxlength="200" <?php echo $disabled; ?>>
                                                                    </div>
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
        <script src="assets/js/pages/email-setting.js?v=<?php echo rand(); ?>"></script>
    </body>
</html>