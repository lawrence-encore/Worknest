<?php
    require('session.php');
    require('config/config.php');
    require('classes/api.php');

    $api = new Api;
    $page_title = 'Recruitment Scorecard Section';

    $page_access = $api->check_role_permissions($username, 365);
	$add_recruitment_scorecard_section = $api->check_role_permissions($username, 365);
	$delete_recruitment_scorecard_section = $api->check_role_permissions($username, 368);
    
    $check_user_account_status = $api->check_user_account_status($username);

    if($check_user_account_status == 0){
        if($page_access == 0 || !isset($_GET['id']) || empty($_GET['id'])){
            header('location: 404-page.php');
        }
        else{
            $id = $_GET['id'];
            $recruitment_scorecard_id = $api->decrypt_data($id);
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Human Resource</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Recruitment</a></li>
                                            <li class="breadcrumb-item"><a href="recruitment-scorecard.php">Recruitment Scorecard</a></li>
                                            <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
                                            <li class="breadcrumb-item" id="recruitment-scorecard-id"><a href="javascript: void(0);"><?php echo $recruitment_scorecard_id; ?></a></li>
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
                                                        <h4 class="card-title">Recruitment Scorecard Section List</h4>
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                        <?php
                                                             if($add_recruitment_scorecard_section > 0 || $delete_recruitment_scorecard_section > 0){
                                                                if($add_recruitment_scorecard_section > 0){
                                                                    echo '<button type="button" class="btn btn-primary waves-effect btn-label waves-light" id="add-recruitment-scorecard-section"><i class="bx bx-plus label-icon"></i> Add</button>';
                                                                }

                                                                if($delete_recruitment_scorecard_section > 0){
                                                                    echo '<button type="button" class="btn btn-danger waves-effect btn-label waves-light d-none multiple" id="delete-recruitment-scorecard-section"><i class="bx bx-trash label-icon"></i> Delete</button>';
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <table id="recruitment-scorecard-section-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th class="all">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" id="datatable-checkbox" type="checkbox">
                                                                </div>
                                                            </th>
                                                            <th class="all">Recruitment Scorecard Section</th>
                                                            <th class="all">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody><tbody>
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
        <script src="assets/js/system.js?v=<?php echo rand(); ?>"></script>
        <script src="assets/js/pages/recruitment-scorecard-section.js?v=<?php echo rand(); ?>"></script>
    </body>
</html>