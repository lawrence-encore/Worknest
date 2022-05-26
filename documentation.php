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
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active"><?php echo $check_user_account_status; ?></li>
                                        </ol>
                                    </div>
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
                                                                
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="v-pills-installation" role="tabpanel" aria-labelledby="v-pills-installation-tab">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-grow-1 align-self-center">
                                                                        <h4 class="card-title">Installation</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                
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
                                                                
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="v-pills-important-setting" role="tabpanel" aria-labelledby="v-pills-important-setting-tab">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-grow-1 align-self-center">
                                                                        <h4 class="card-title">Important Settings</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                
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