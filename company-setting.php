<?php
    require('session.php');
    require('config/config.php');
    require('classes/api.php');

    $api = new Api;
    $page_title = 'Company Setting';

    $page_access = $api->check_role_permissions($username, 39);
    $update_company_setting = $api->check_role_permissions($username, 40);
    $view_transaction_log = $api->check_role_permissions($username, 41);

    $company_setting_details = $api->get_company_setting_details(1);
    $transaction_log_id = $company_setting_details[0]['TRANSACTION_LOG_ID'] ?? null;

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
                                                        <h4 class="card-title">Company Setting</h4>
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                    <?php
                                                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                                                            echo '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'">Transaction Log</button>';
                                                        }

                                                        if($update_company_setting > 0){
                                                            echo '<button type="submit" class="btn btn-primary waves-effect waves-light" form="company-setting-form" id="submit-form">Save</button>';

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
                                                <form class="cmxform" id="company-setting-form" method="post" action="#">
                                                    <div class="row mb-3">
                                                        <label for="company_logo" class="col-md-2 col-form-label">Company Logo</label>
                                                        <div class="col-md-10">
                                                            <img class="rounded mr-2 mb-3" alt="company logo" width="150" src="" id="company-logo" data-holder-rendered="true">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="company_name" class="col-md-2 col-form-label">Company Name <span class="required">*</span></label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control maxlength" autocomplete="off" id="company_name" name="company_name" maxlength="300" <?php echo $disabled; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="email" class="col-md-2 col-form-label">Email</label>
                                                        <div class="col-md-10">
                                                            <input id="email" name="email" class="form-control email-inputmask maxlength" maxlength="50" autocomplete="off" <?php echo $disabled; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for=""phone" class="col-md-2 col-form-label">Phone</label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control maxlength" autocomplete="off" id="phone" name="phone" maxlength="30" <?php echo $disabled; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="telephone" class="col-md-2 col-form-label">Telephone</label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control maxlength" autocomplete="off" id="telephone" name="telephone" maxlength="30" <?php echo $disabled; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="website" class="col-md-2 col-form-label">Website</label>
                                                        <div class="col-md-10">
                                                            <input type="url" id="website" name="website" class="form-control maxlength" maxlength="100" autocomplete="off" <?php echo $disabled; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="province" class="col-md-2 col-form-label">Province <span class="required">*</span></label>
                                                        <div class="col-md-10">
                                                            <select class="form-control form-select2" id="province" name="province" <?php echo $disabled; ?>>
                                                                <option value="">--</option>
                                                                <?php echo $api->generate_province_options(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="city" class="col-md-2 col-form-label">City <span class="required">*</span></label>
                                                        <div class="col-md-10">
                                                            <select class="form-control form-select2" id="city" name="city" disabled>
                                                                <option value="">--</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="company_logo" class="col-md-2 col-form-label">Company Logo</label>
                                                        <div class="col-md-10">
                                                        <input class="form-control" type="file" name="company_logo" id="company_logo" <?php echo $disabled; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="address" class="col-md-2 col-form-label">Address <span class="required">*</span></label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control maxlength" id="address" name="address" maxlength="500" rows="5" <?php echo $disabled; ?>></textarea>
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
        <script src="assets/js/pages/company-setting.js?v=<?php echo rand(); ?>"></script>
    </body>
</html>