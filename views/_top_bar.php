<header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <div class="navbar-brand-box">
                            <a href="dashboard.php" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?php echo $logo_icon_dark; ?>" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?php echo $logo_dark; ?>" alt="" height="40">
                                </span>
                            </a>

                            <a href="dashboard.php" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?php echo $logo_icon_light; ?>" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?php echo $logo_light; ?>" alt="" height="40">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                                <i class="bx bx-fullscreen"></i>
                            </button>
                            <?php
                                $backup_database = $api->check_role_permissions($username, 283);

                                if($backup_database > 0){
                                    echo '<button type="button" class="btn header-item noti-icon waves-effect" id="backup-database">
                                        <i class="bx bx-data"></i>
                                    </button>';
                                }
                            ?>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                    $employee_details = $api->get_employee_details('', $username);
                                    $employee_id = $employee_details[0]['EMPLOYEE_ID'] ?? $username;

                                    $unread_notification = $api->get_notification_count($employee_id, 0);

                                    if($unread_notification > 0){
                                        echo '<i class="bx bx-bell bx-tada"></i><span class="badge bg-danger rounded-pill">'. number_format($unread_notification) .'</span>';
                                    }
                                    else{
                                        echo '<i class="bx bx-bell"></i>';
                                    }
                                ?>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0" key="t-notifications"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="notification.php" class="small" key="t-view-all"> View All</a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 250px;">
                                    <?php
                                        echo $api->generate_notification_list($employee_id);
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="./assets/images/default/default-avatar.png"
                                    alt="Header Avatar">
                                    <span class="d-none d-xl-inline-block ms-1" key="t-henry" id="username"><?php echo $username; ?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <?php
                                    $notification_page = $api->check_role_permissions($username, 282);

                                    if($notification_page > 0){
                                        echo '<a class="dropdown-item" href="notification.php"><i class="bx bx-bell font-size-16 align-middle me-1"></i> <span key="t-profile">Notification</span></a>';
                                    }
                                ?>
                                <a class="dropdown-item" href="profile.php"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                                <a class="dropdown-item" href="lockscreen.php"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span key="t-lock-screen">Lock screen</span></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="logout.php?logout"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                            </div>
                        </div>

                    </div>
                </div>
            </header>