<?php
    require('session.php');
    require('config/config.php');
    require('classes/api.php');

    $api = new Api;
    $page_title = 'Role Permission';

    $page_access = $api->check_role_permissions($username, 17);
    $update_role_permission = $api->check_role_permissions($username, 18);

    $check_user_account_status = $api->check_user_account_status($username);

    if($check_user_account_status == 0){
        if($page_access == 0 || !isset($_GET['id']) || empty($_GET['id'])){
            header('location: 404-page.php');
        }
        else{
            $id = $_GET['id'];
            $role_id = $api->decrypt_data($id);
            $get_role_details = $api->get_role_details($role_id);
            $role = $get_role_details[0]['ROLE'];
            $description = $get_role_details[0]['DESCRIPTION'];
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                            <li class="breadcrumb-item"><a href="role.php">Role</a></li>
                                            <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
                                            <li class="breadcrumb-item" id="role-id"><a href="javascript: void(0);"><?php echo $role_id; ?></a></li>
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
                                                        <h4 class="card-title"><?php echo $role; ?></h4>
                                                        <p class="card-text text-muted"><?php echo $description; ?></p>
                                                    </div>
                                                    <?php
                                                        if($update_role_permission > 0){
                                                            echo '<div class="d-flex gap-2">
                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light" form="role-permission-form" id="submit-form">Save</button>
                                                                    </div>';
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <form class="cmxform" id="role-permission-form" method="post" action="#">
                                                    <div class="row">
                                                        <?php 
                                                            if($update_role_permission > 0){
                                                                echo $api->generate_role_permission_form();
                                                            } 
                                                            else{
                                                                echo $api->generate_role_permission_form('disabled');
                                                            }
                                                        ?>
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
        <script src="assets/js/system.js?v=<?php echo rand(); ?>"></script>
        <script src="assets/js/pages/role-permission.js?v=<?php echo rand(); ?>"></script>
    </body>
</html> 