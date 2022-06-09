<?php
    require('session.php');
    require('config/config.php');
    require('classes/api.php');

    $api = new Api;
    $page_title = 'Job Applicant';

    $page_access = $api->check_role_permissions($username, 382);
	$add_job_applicant = $api->check_role_permissions($username, 383);
	$delete_job_applicant = $api->check_role_permissions($username, 385);

	if($page_access == 0){
		header('location: 404-page.php');
	}

    require('views/_application_settings.php');
?>

<!doctype html>
<html lang="en">
    <head>
        <?php require('views/_head.php'); ?>
        <link rel="stylesheet" href="assets/libs/sweetalert2/sweetalert2.min.css">
        <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
        <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Human Resource</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Recruitment</a></li>
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
                                                        <h4 class="card-title">Job Applicant List</h4>
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                        <?php
                                                           if($add_job_applicant > 0 || $delete_job_applicant > 0){

                                                                if($add_job_applicant > 0){
                                                                    echo '<button type="button" class="btn btn-primary waves-effect btn-label waves-light" id="add-job-applicant"><i class="bx bx-plus label-icon"></i> Add</button>';
                                                                }

                                                                if($delete_job_applicant > 0){
                                                                    echo '<button type="button" class="btn btn-danger waves-effect btn-label waves-light d-none multiple" id="delete-job-applicant"><i class="bx bx-trash label-icon"></i> Delete</button>';
                                                                }
                                                            }
                                                        ?>
                                                        <button type="button" class="btn btn-info waves-effect btn-label waves-light" data-bs-toggle="offcanvas" data-bs-target="#filter-off-canvas" aria-controls="filter-off-canvas"><i class="bx bx-filter-alt label-icon"></i> Filter</button>
                                                    </div>
                                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="filter-off-canvas" data-bs-backdrop="true" aria-labelledby="filter-off-canvas-label">
                                                        <div class="offcanvas-header">
                                                            <h5 class="offcanvas-title" id="filter-off-canvas-label">Filter</h5>
                                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                        </div>
                                                        <div class="offcanvas-body">
                                                            <div class="mb-3">
                                                                <p class="text-muted">Application Date</p>

                                                                <div class="input-group mb-3" id="filter-start-date-container">
                                                                    <input type="text" class="form-control" id="filter_start_date" name="filter_start_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#filter-start-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-orientation="right" placeholder="Start Date" value="<?php echo date('n/01/Y'); ?>">
                                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                </div>

                                                                <div class="input-group" id="filter-end-date-container">
                                                                    <input type="text" class="form-control" id="filter_end_date" name="filter_end_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#filter-end-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-orientation="right" placeholder="End Date" value="<?php echo date('n/t/Y'); ?>">
                                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <p class="text-muted">Applied For</p>

                                                                <select class="form-control filter-select2" id="filter_job">
                                                                    <option value="">All Jobs</option>
                                                                    <?php echo $api->generate_job_options(); ?>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <p class="text-muted">Job Category</p>

                                                                <select class="form-control filter-select2" id="filter_job_category">
                                                                    <option value="">All Job Category</option>
                                                                    <?php echo $api->generate_job_category_options(); ?>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <p class="text-muted">Job Type</p>

                                                                <select class="form-control filter-select2" id="filter_job_type">
                                                                    <option value="">All Job Type</option>
                                                                    <?php echo $api->generate_job_type_options(); ?>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <p class="text-muted">Recruitment Stage</p>

                                                                <select class="form-control filter-select2" id="filter_recruitment_stage">
                                                                    <option value="">All Recruitment Stage</option>
                                                                    <?php echo $api->generate_recruitment_stage_options(); ?>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <p class="text-muted">Branch</p>

                                                                <select class="form-control filter-select2" id="filter_branch">
                                                                    <option value="">All Branch</option>
                                                                    <?php echo $api->generate_branch_options(); ?>
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
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <table id="job-applicant-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th class="all">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" id="datatable-checkbox" type="checkbox">
                                                                </div>
                                                            </th>
                                                            <th class="all">Job Applicant</th>
                                                            <th class="all">Applied For</th>
                                                            <th class="all">Application Date</th>
                                                            <th class="all">Recruitment Stage</th>
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
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script src="assets/libs/jquery-validation/js/jquery.validate.min.js"></script>
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <script src="assets/libs/select2/js/select2.min.js"></script>
        <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/js/system.js?v=<?php echo rand(); ?>"></script>
        <script src="assets/js/pages/job-applicant.js?v=<?php echo rand(); ?>"></script>
    </body>
</html>