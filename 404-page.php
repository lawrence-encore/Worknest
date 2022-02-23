<?php
	require('session.php');
	require('config/config.php');
	require('classes/api.php');
	$api = new Api;
	$page_title = '404-Page';
?>
        <?php
            require('views/_head.php');
        ?>
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    </head>

    <body data-sidebar="dark">
        <?php
            require('views/_preloader.php');
        ?>
        <div class="account-pages my-2 pt-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-5">
                            <h1 class="display-2 fw-medium">4<i class="bx bx-buoy bx-spin text-primary display-3"></i>4</h1>
                            <h4 class="text-uppercase">Sorry, page not found</h4>
                            <div class="mt-5 text-center">
                                <a class="btn btn-primary waves-effect waves-light" href="dashboard.php">Back to Dashboard</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8 col-xl-6">
                        <div>
                            <img src="assets/images/default/error-img.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
	        require('views/_scripts.php');
        ?>
    </body>
</html>
