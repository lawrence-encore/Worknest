<?php
    require('session.php');
    require('config/config.php');
    require('classes/api.php');

    $api = new Api;
    $page_title = 'Import Attendance Creation';

    $page_access = $api->check_role_permissions($username, 270);
	$import_attendance_creation = $api->check_role_permissions($username, 271);

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Import</a></li>
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
                                                        <h4 class="card-title">Import Attendance Creation</h4>
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                        <?php
                                                            if($import_attendance_creation > 0){
                                                                echo '<button type="button" class="btn btn-primary waves-effect btn-label waves-light" id="import-attendance-creation"><i class="bx bx-import label-icon"></i> Import</button>';
                                                            }
                                                        ?>

                                                        <button type="button" class="btn btn-success waves-effect btn-label waves-light d-none multiple" id="submit-import-attendance-creation"><i class="bx bx-import label-icon"></i> Import</button>

                                                        <button type="button" class="btn btn-danger waves-effect btn-label waves-light d-none multiple" id="clear-import-attendance-creation"><i class="bx bx-trash label-icon"></i> Clear</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <table id="import-attendance-creation-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th class="all">Request ID</th>
                                                            <th class="all">Employee ID</th>
                                                            <th class="all">Time In Date</th>
                                                            <th class="all">Time In</th>
                                                            <th class="all">Time Out Date</th>
                                                            <th class="all">Time Out</th>
                                                            <th class="all">Status</th>
                                                            <th class="all">Reason</th>
                                                            <th class="all">File Path</th>
                                                            <th class="all">Sanction</th>
                                                            <th class="all">Request Date</th>
                                                            <th class="all">Request Time</th>
                                                            <th class="all">For Recommendation Date</th>
                                                            <th class="all">For Recommendation Time</th>
                                                            <th class="all">Recommendation Date</th>
                                                            <th class="all">Recommendation Time</th>
                                                            <th class="all">Recommended By</th>
                                                            <th class="all">Decision Remarks</th>
                                                            <th class="all">Decision Date</th>
                                                            <th class="all">Decision Time</th>
                                                            <th class="all">Decision By</th>
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

                <?php require('views/_footer.php'); ?>
               
            </div>
        </div>

        <?php require('views/_script.php'); ?>
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script src="assets/libs/jquery-validation/js/jquery.validate.min.js"></script>
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/js/system.js?v=<?php echo rand(); ?>"></script>
        <script src="assets/js/pages/import-attendance-creation.js?v=<?php echo rand(); ?>"></script>
    </body>
</html>