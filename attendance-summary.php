<?php
    require('session.php');
    require('config/config.php');
    require('classes/api.php');

    $api = new Api;
    $page_title = 'Attendance Summary';

    $page_access = $api->check_role_permissions($username, 258);
    $export_attendance_summary = $api->check_role_permissions($username, 259);

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
        <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
        <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="assets/libs/sweetalert2/sweetalert2.min.css">
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Human Resource</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Employee</a></li>
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
                                        <div class="row mb-4">
                                            <div class="col-md-12">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-grow-1 align-self-center">
                                                        <h4 class="card-title">Attendance Summary List</h4>
                                                        <input type="hidden" id="export_attendance_summary" value="<?php echo $export_attendance_summary; ?>">
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                        <button type="button" class="btn btn-info waves-effect btn-label waves-light" data-bs-toggle="offcanvas" data-bs-target="#filter-off-canvas" aria-controls="filter-off-canvas"><i class="bx bx-filter-alt label-icon"></i> Filter</button>
                                                    </div>

                                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="filter-off-canvas" data-bs-backdrop="true" aria-labelledby="filter-off-canvas-label">
                                                        <div class="offcanvas-header">
                                                            <h5 class="offcanvas-title" id="filter-off-canvas-label">Filter</h5>
                                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                        </div>
                                                        <div class="offcanvas-body">
                                                            <div class="mb-3">
                                                                <p class="text-muted">Attendance Summary Date</p>

                                                                <div class="input-group mb-3" id="filter-file-start-date-container">
                                                                    <input type="text" class="form-control" id="filter_start_date" name="filter_start_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#filter-file-start-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-orientation="right" placeholder="Start Date" value="<?php echo date('n/01/Y'); ?>">
                                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                </div>

                                                                <div class="input-group" id="filter-file-end-date-container">
                                                                    <input type="text" class="form-control" id="filter_end_date" name="filter_end_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#filter-file-end-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-orientation="right" placeholder="End Date" value="<?php echo date('n/t/Y'); ?>">
                                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <p class="text-muted">Branch</p>

                                                                <select class="form-control filter-select2" id="filter_branch">
                                                                    <option value="">All Branch</option>
                                                                    <?php echo $api->generate_branch_options(); ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <p class="text-muted">Department</p>

                                                                <select class="form-control filter-select2" id="filter_department">
                                                                    <option value="">All Department</option>
                                                                    <?php echo $api->generate_department_options(); ?>
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="apply-filter" data-bs-toggle="offcanvas" data-bs-target="#filter-off-canvas" aria-controls="filter-off-canvas">Apply Filter</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-xl-3">
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
                                                    <canvas id="time-in-behavior-doughnut" height="200"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
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
                                                    <canvas id="time-out-behavior-doughnut" height="200"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
                                                <div class="row text-center mb-3">
                                                    <div class="col-6">
                                                        <h5 class="mb-0" id="attendance-adjustment-sanction-statistics">0</h5>
                                                        <p class="text-muted text-truncate">Sanction</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="mb-0" id="attendance-adjustment-unsanction-statistics">0</h5>
                                                        <p class="text-muted text-truncate">Unsanctioned</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <canvas id="attendance-adjustment-doughnut" height="200"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
                                                <div class="row text-center mb-3">
                                                    <div class="col-6">
                                                        <h5 class="mb-0" id="attendance-creation-sanction-statistics">0</h5>
                                                        <p class="text-muted text-truncate">Sanction</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="mb-0" id="attendance-creation-unsanction-statistics">0</h5>
                                                        <p class="text-muted text-truncate">Unsanctioned</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <canvas id="attendance-creation-doughnut" height="200"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <table id="attendance-summary-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th class="all">Employee</th>
                                                            <th class="all">Working Days</th>
                                                            <th class="all">Days Worked</th>
                                                            <th class="all">No. of Late</th>
                                                            <th class="all">Late</th>
                                                            <th class="all">No. of Undertime</th>
                                                            <th class="all">Undertime</th>
                                                            <th class="all">Attendance Adjustment</th>
                                                            <th class="all">Attendance Creation</th>
                                                            <th class="all">Attendance Adjustment (Sanctioned)</th>
                                                            <th class="all">Attendance Creation (Sanctioned)</th>
                                                            <th class="all">Attendance Adjustment (Unsanctioned)</th>
                                                            <th class="all">Attendance Creation (Unsanctioned)</th>
                                                            <th class="all">Action</th>
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
        <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script src="assets/libs/jquery-validation/js/jquery.validate.min.js"></script>
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <script src="assets/libs/select2/js/select2.min.js"></script>
        <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/libs/chart.js/Chart.bundle.min.js"></script>
        <script src="assets/js/system.js?v=<?php echo rand(); ?>"></script>
        <script src="assets/js/pages/attendance-summary.js?v=<?php echo rand(); ?>"></script>
    </body>
</html>