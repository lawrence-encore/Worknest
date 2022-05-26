<?php
    require('session.php');
    require('config/config.php');
    require('classes/api.php');

    $api = new Api;
    $page_title = 'Notification Details';

    $page_access = $api->check_role_permissions($username, 168);
	$update_notification_details = $api->check_role_permissions($username, 169);
    $view_transaction_log = $api->check_role_permissions($username, 170);
    
    $check_user_account_status = $api->check_user_account_status($username);

    if($check_user_account_status == 0){
        if($page_access == 0 || !isset($_GET['id']) || empty($_GET['id'])){
            header('location: 404-page.php');
        }
        else{
            $id = $_GET['id'];
            $notification_id = $api->decrypt_data($id);

            $notification_details = $api->get_notification_details($notification_id);
            $transaction_log_id = $notification_details[0]['TRANSACTION_LOG_ID'] ?? null;
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
                                            <li class="breadcrumb-item"><a href="notification-type.php">Notification Type</a></li>
                                            <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
                                            <li class="breadcrumb-item" id="notification-id"><a href="javascript: void(0);"><?php echo $notification_id; ?></a></li>
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
                                                        <h4 class="card-title">Notification Details</h4>
                                                    </div> 
                                                    <div class="d-flex gap-2">
                                                    <?php
                                                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                                                            echo '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'">Transaction Log</button>';
                                                        }

                                                        if($update_notification_details > 0){
                                                            echo '<button type="submit" class="btn btn-primary waves-effect waves-light" form="notification-details-form" id="submit-form">Save</button>';

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
                                            <form class="cmxform" id="notification-details-form" method="post" action="#">
                                                    <div class="row mb-3">
                                                        <label for="notification_title" class="col-md-2 col-form-label">Notification Title <span class="required">*</span></label>
                                                        <div class="col-md-10">
                                                            <input type="hidden" id="notification_id" name="notification_id" value="<?php echo $notification_id; ?>">
                                                            <input type="text" class="form-control form-maxlength" autocomplete="off" id="notification_title" name="notification_title" maxlength="500" <?php echo $disabled; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="notification_message" class="col-md-2 col-form-label">Notification Message <span class="required">*</span></label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control form-maxlength" autocomplete="off" id="notification_message" name="notification_message" maxlength="500" <?php echo $disabled; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="system_link" class="col-md-2 col-form-label">Notification Link <span class="required">*</span></label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control form-maxlength" autocomplete="off" id="system_link" name="system_link" maxlength="200" <?php echo $disabled; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="web_link" class="col-md-2 col-form-label">Web Link <span class="required">*</span></label>
                                                        <div class="col-md-10">
                                                            <input type="url" id="web_link" name="web_link" class="form-control form-maxlength" maxlength="200" autocomplete="off" <?php echo $disabled; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="notification_recipient" class="col-md-2 col-form-label">Notification Recipient</label>
                                                        <div class="col-md-10">
                                                            <select class="form-control select2" id="notification_recipient" multiple="multiple" name="notification_recipient">
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
        <script src="assets/js/pages/notification-details.js?v=<?php echo rand(); ?>"></script>
    </body>
</html> 