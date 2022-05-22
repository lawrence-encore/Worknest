<?php
    require('session-check.php');
    require('config/config.php');
	require('classes/api.php');

	$api = new Api;
    $page_title = 'Worknest';

    require('views/_application_settings.php');
?>

<!doctype html>
<html lang="en">
    <head>
        <?php require('views/_head.php'); ?>
        <link rel="stylesheet" href="assets/libs/sweetalert2/sweetalert2.min.css">
        <?php require('views/_required_css.php'); ?>
    </head>

    <body class="auth-body-bg">
        <div>
            <div class="container-fluid p-0">
                <div class="row g-0">
                    
                    <div class="col-xl-8">
                        <div class="auth-full-bg pt-lg-5 p-4">
                            <div class="w-100">
                                <div class="bg-overlay" style="background:url('<?php echo $login_bg; ?>'); background-size:cover;background-repeat:no-repeat;background-position:center"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="auth-full-page-content p-md-5 p-4">
                            <div class="w-100">

                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5">
                                        <a href="index.php" class="d-block auth-logo">
                                            <img src="<?php echo $logo_dark; ?>" alt="logo" style="max-height: 80px" class="auth-logo-dark">
                                            <img src="<?php echo $logo_light; ?>" alt="logo" style="max-height: 80px" class="auth-logo-light">
                                        </a>
                                    </div>
                                    <div class="my-auto">
                                        
                                        <div>
                                            <h5 class="text-primary">Welcome !</h5>
                                            <p class="text-muted">Sign in to continue to Digify Integrated Solutions.</p>
                                        </div>
            
                                        <div class="mt-4">
                                            <form id="signin-form" method="post" action="#">
                
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" class="form-control" id="username" name="username" autocomplete="off" placeholder="Enter username">
                                                </div>
                        
                                                <div class="mb-3">
                                                    <!--<div class="float-end">
                                                        <a href="forgot-password.php" class="text-muted">Forgot password?</a>
                                                    </div>-->
                                                    <label class="form-label">Password</label>
                                                    <div class="input-group auth-pass-inputgroup">
                                                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                                        <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                    </div>
                                                </div>
                                                
                                                <div class="mt-3 d-grid">
                                                    <button id="signin" class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                    <div class="mt-4 mt-md-5 text-center">
                                        <p class="mb-0">Copyright © <?php echo date('Y') ?> Digify Integrated Solutions. All rights reserved.</p>
                                    </div>
                                </div>
                                
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>

        <?php require('views/_script.php'); ?>
        <script src="assets/libs/jquery-validation/js/jquery.validate.min.js"></script>
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <script src="assets/js/pages/index.js?v=<?php echo rand(); ?>"></script>
        <script src="assets/js/system.js?v=<?php echo rand(); ?>"></script>
    </body>
</html>
