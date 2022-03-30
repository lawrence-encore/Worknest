<?php
    $menu = '';
     
    # Main pages
    $dashboard_page = $api->check_role_permissions($username, 1);
    $policy_page = $api->check_role_permissions($username, 2);
    $role_page = $api->check_role_permissions($username, 12);
    $system_parameter_page = $api->check_role_permissions($username, 19);
    $system_code_page = $api->check_role_permissions($username, 24);
    $notification_type_page = $api->check_role_permissions($username, 29);
    $user_interface_setting_page = $api->check_role_permissions($username, 34);
    $application_notification_page = $api->check_role_permissions($username, 37);
    $company_setting_page = $api->check_role_permissions($username, 39);
    $email_configuration_page = $api->check_role_permissions($username, 42);
    $department_page = $api->check_role_permissions($username, 45);
    $designation_page = $api->check_role_permissions($username, 50);
    $branch_page = $api->check_role_permissions($username, 55);
    $upload_setting_page = $api->check_role_permissions($username, 60);
    $employment_status_page = $api->check_role_permissions($username, 65);
    $employee_page = $api->check_role_permissions($username, 70);
    $work_shift_page = $api->check_role_permissions($username, 92);
    $leave_type_page = $api->check_role_permissions($username, 104);
    $leave_entitlement_page = $api->check_role_permissions($username, 109);
    $leave_management_page = $api->check_role_permissions($username, 119);
    $employee_file_management_page = $api->check_role_permissions($username, 133);
    $user_account_page = $api->check_role_permissions($username, 143);
    $holiday_page = $api->check_role_permissions($username, 151);
    $attendance_setting_page = $api->check_role_permissions($username, 156);
    $attendance_record_page = $api->check_role_permissions($username, 160);
    $employee_attendance_record_page = $api->check_role_permissions($username, 171);
    $attendance_creation_page = $api->check_role_permissions($username, 175);
    $attendance_adjustment_page = $api->check_role_permissions($username, 182);
    $attendance_creation_recommendation_page = $api->check_role_permissions($username, 188);
    $attendance_adjustment_recommendation_page = $api->check_role_permissions($username, 192);
    $attendance_creation_approval_page = $api->check_role_permissions($username, 198);
    $attendance_adjustment_approval_page = $api->check_role_permissions($username, 203);
    $leave_management_page = $api->check_role_permissions($username, 208);
    $leave_approval_page = $api->check_role_permissions($username, 213);

    if($dashboard_page > 0){
        $menu .= '<li class="menu-title" key="t-menu">Menu</li>
                    <li>
                        <a href="dashboard.php" class="waves-effect">
                            <i class="bx bx-home-alt"></i>
                            <span key="t-dashboard">Dashboard</span>
                        </a>
                    </li>';
    }

    if($employee_attendance_record_page > 0 || $attendance_creation_page > 0 || $attendance_adjustment_page > 0 || $leave_management_page > 0){
        $menu .= '<li class="menu-title" key="t-menu">Employee</li>';

        if($employee_attendance_record_page > 0 || $attendance_creation_page > 0 || $attendance_adjustment_page > 0){
            $menu .= '<li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-calendar"></i>
                            <span key="t-employee">Manage Attendance</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">';

                        if($employee_attendance_record_page > 0){
                            $menu .= '<li><a href="employee-attendance-record.php" key="t-all-employees">Attendance Record</a></li>';
                        }

                        if($attendance_adjustment_page > 0){
                            $menu .= '<li><a href="attendance-adjustment.php" key="t-all-employees">Attendance Adjustment</a></li>';
                        }

                        if($attendance_creation_page > 0){
                            $menu .= '<li><a href="attendance-creation.php" key="t-all-employees">Attendance Creation</a></li>';
                        }

            $menu .= '</ul>
                    </li>';
        }

        if($leave_management_page > 0){
            $menu .= '<li>
                        <a href="employee-leave-management.php" class="waves-effect">
                            <i class="bx bx-calendar-check"></i>
                            <span key="t-dashboard">Leave Management</span>
                        </a>
                    </li>';
        }
    }

    if($employment_status_page > 0 || $department_page > 0 || $designation_page > 0 || $employee_page > 0 || $work_shift_page > 0 || $leave_type_page > 0 || $leave_entitlement_page > 0 || $leave_management_page > 0 || $employee_file_management_page > 0 || $holiday_page > 0 || $attendance_record_page > 0){
        $menu .= '<li class="menu-title" key="t-menu">Human Resource</li>';

        

        if($employment_status_page > 0 || $department_page > 0 || $designation_page > 0 || $employee_page > 0 || $work_shift_page > 0 || $employee_file_management_page > 0 || $attendance_record_page > 0 ){
            $menu .= '<li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-user"></i>
                            <span key="t-employee">Employee</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">';

                        if($employee_page > 0){
                            $menu .= '<li><a href="all-employees.php" key="t-all-employees">All Employees</a></li>';
                        }

                        if($attendance_record_page > 0){
                            $menu .= '<li><a href="attendance-record.php" key="t-attendance-record">Attendance Record</a></li>';
                        }

                        if($department_page > 0){
                            $menu .= '<li><a href="department.php" key="t-department">Department</a></li>';
                        }

                        if($designation_page > 0){
                            $menu .= '<li><a href="designation.php" key="t-designation">Designation</a></li>';
                        }

                        if($employment_status_page > 0){
                            $menu .= '<li><a href="employment-status.php" key="t-employment-status">Employment Status</a></li>';
                        }

                        if($employee_file_management_page > 0){
                            $menu .= '<li><a href="employee-file-management.php" key="t-employment-status">Employee Files</a></li>';
                        }

                        if($work_shift_page > 0){
                            $menu .= '<li><a href="work-shift.php" key="t-designation">Work Shift</a></li>';
                        }

            $menu .= '</ul>
                    </li>';
        }

        if($leave_type_page > 0 || $leave_entitlement_page > 0 || $leave_management_page > 0){
            $menu .= '<li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-calendar"></i>
                            <span key="t-leave">Leave</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">';

                        if($leave_management_page > 0){
                            $menu .= '<li><a href="leave-management.php" key="t-all-employees">Leave Management</a></li>';
                        }

                        if($leave_entitlement_page > 0){
                            $menu .= '<li><a href="leave-entitlement.php" key="t-all-employees">Leave Entitlement</a></li>';
                        }

                        if($leave_type_page > 0){
                            $menu .= '<li><a href="leave-type.php" key="t-all-employees">Leave Type</a></li>';
                        }

            $menu .= '</ul>
                    </li>';
        }

        if($holiday_page > 0){
            $menu .= '<li>
                        <a href="holiday.php" class="waves-effect">
                            <i class="bx bx-calendar-event"></i>
                            <span key="t-holiday">Holiday</span>
                        </a>
                    </li>';
        }
    }

    if($attendance_creation_recommendation_page > 0 || $attendance_adjustment_recommendation_page > 0){
        $menu .= '<li class="menu-title" key="t-menu">Recommendation</li>';

        if($attendance_creation_recommendation_page > 0){
            $menu .= '<li>
                        <a href="attendance-adjustment-recommendation.php" class="waves-effect">
                            <i class="bx bx bx-calendar-event"></i>
                            <span key="t-dashboard">Attendance Adjustment</span>
                        </a>
                    </li>';
        }

        if($attendance_adjustment_recommendation_page > 0){
            $menu .= '<li>
                        <a href="attendance-creation-recommendation.php" class="waves-effect">
                            <i class="bx bx bx-calendar-plus"></i>
                            <span key="t-dashboard">Attendance Creation</span>
                        </a>
                    </li>';
        }
    }

    if($attendance_creation_approval_page > 0 || $attendance_adjustment_approval_page > 0 || $leave_approval_page > 0){
        $menu .= '<li class="menu-title" key="t-menu">Approval</li>';

        if($attendance_adjustment_approval_page > 0){
            $menu .= '<li>
                        <a href="attendance-adjustment-approval.php" class="waves-effect">
                            <i class="bx bx bx-calendar-event"></i>
                            <span key="t-dashboard">Attendance Adjustment</span>
                        </a>
                    </li>';
        }

        if($attendance_creation_approval_page > 0){
            $menu .= '<li>
                        <a href="attendance-creation-approval.php" class="waves-effect">
                            <i class="bx bx bx-calendar-plus"></i>
                            <span key="t-dashboard">Attendance Creation</span>
                        </a>
                    </li>';
        }

        if($leave_approval_page > 0){
            $menu .= '<li>
                        <a href="leave-approval.php" class="waves-effect">
                            <i class="bx bx bx-calendar-check"></i>
                            <span key="t-dashboard">Leave Approval</span>
                        </a>
                    </li>';
        }
    }

    if($policy_page > 0 || $role_page > 0 || $system_parameter_page > 0 || $system_code_page > 0 || $notification_type_page > 0 || $user_interface_setting_page > 0 || $application_notification_page > 0 || $company_setting_page > 0 || $email_configuration_page > 0 || $branch_page > 0 || $upload_setting_page > 0 || $user_account_page > 0 || $attendance_setting_page > 0){
        $menu .= '<li class="menu-title" key="t-menu">Administrator</li>';

        if($policy_page > 0 || $role_page > 0 || $system_parameter_page > 0 || $system_code_page > 0 || $notification_type_page > 0 || $user_interface_setting_page > 0 || $application_notification_page > 0 || $company_setting_page > 0 || $email_configuration_page > 0 || $department_page > 0 || $designation_page > 0 || $branch_page > 0 || $upload_setting_page > 0){
            $menu .= '<li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-cog"></i>
                            <span key="t-settings">Settings</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">';

                        if($user_interface_setting_page > 0 || $application_notification_page > 0 || $upload_setting_page > 0){
                            $menu .= ' <li>
                                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                <span key="t-multi-level">Application Setting</span>
                                            </a>
                                            <ul class="sub-menu" aria-expanded="true">';

                                            if($application_notification_page > 0){
                                                $menu .= '<li><a href="application-notification.php" key="t-human-resource-modules">Application Notification</a></li>';
                                            }

                                            if($upload_setting_page > 0){
                                                $menu .= '<li><a href="upload-setting.php" key="t-human-resource-modules">Upload Setting</a></li>';
                                            }

                                            if($user_interface_setting_page > 0){
                                                $menu .= '<li><a href="user-interface-setting.php" key="t-human-resource-modules">User Interface Setting</a></li>';
                                            }
                                           
                                    $menu .= '</ul>
                                        </li>';
                        }

                        if($attendance_setting_page > 0){
                            $menu .= '<li><a href="attendance-setting.php" key="t-attendance-setting">Attendance Setting</a></li>';
                        }

                        if($branch_page > 0){
                            $menu .= '<li><a href="branch.php" key="t-branch">Branch</a></li>';
                        }

                        if($company_setting_page > 0){
                            $menu .= '<li><a href="company-setting.php" key="t-company-setting">Company Setting</a></li>';
                        }

                        if($email_configuration_page > 0){
                            $menu .= '<li><a href="email-setting.php" key="t-email setting">Email Setting</a></li>';
                        }

                        if($notification_type_page > 0){
                            $menu .= '<li><a href="notification-type.php" key="t-notification-type">Notification Type</a></li>';
                        }

                        if($policy_page > 0){
                            $menu .= '<li><a href="policy.php" key="t-policy">Policy</a></li>';
                        }

                        if($role_page > 0){
                            $menu .= '<li><a href="role.php" key="t-role">Role</a></li>';
                        }

                        if($system_code_page > 0){
                            $menu .= '<li><a href="system-code.php" key="t-system-code">System Code</a></li>';
                        }

                        if($system_parameter_page > 0){
                            $menu .= '<li><a href="system-parameter.php" key="t-system-parameter">System Parameter</a></li>';
                        }

            $menu .= '</ul>
                    </li>';
        }

        if($user_account_page > 0){
            $menu .= '<li>
                        <a href="user-account.php" class="waves-effect">
                            <i class="bx bx-user-plus"></i>
                            <span key="t-dashboard">User Account</span>
                        </a>
                    </li>';
        }
    }
?>

<div class="vertical-menu">
                <div data-simplebar class="h-100">
                    <div id="sidebar-menu">
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <?php echo $menu; ?>
                        </ul>
                    </div>
                </div>
            </div>