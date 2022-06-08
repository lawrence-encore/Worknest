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
    $allowance_type_page = $api->check_role_permissions($username, 218);
    $allowance_page = $api->check_role_permissions($username, 223);
    $deduction_type_page = $api->check_role_permissions($username, 228);
    $government_contribution_page = $api->check_role_permissions($username, 233);
    $deduction_page = $api->check_role_permissions($username, 243);
    $contribution_deduction_page = $api->check_role_permissions($username, 248);
    $attendance_summary_page = $api->check_role_permissions($username, 258);
    $import_employee_page = $api->check_role_permissions($username, 260);
    $import_attendance_record_page = $api->check_role_permissions($username, 262);
    $import_leave_entitlement_page = $api->check_role_permissions($username, 264);
    $import_leave_page = $api->check_role_permissions($username, 266);
    $import_attendance_adjustment_page = $api->check_role_permissions($username, 268);
    $import_attendance_creation_page = $api->check_role_permissions($username, 270);
    $import_allowance_page = $api->check_role_permissions($username, 272);
    $import_deduction_page = $api->check_role_permissions($username, 274);
    $import_government_contribution_page = $api->check_role_permissions($username, 276);
    $import_contribution_bracket_page = $api->check_role_permissions($username, 278);
    $import_contribution_deduction_page = $api->check_role_permissions($username, 280);
    $salary_page = $api->check_role_permissions($username, 284);
    $payroll_setting_page = $api->check_role_permissions($username, 289);
    $payroll_group_page = $api->check_role_permissions($username, 292);
    $pay_run_page = $api->check_role_permissions($username, 297);
    $withholding_tax_page = $api->check_role_permissions($username, 309);
    $import_withholding_tax_page = $api->check_role_permissions($username, 314);
    $other_income_type_page = $api->check_role_permissions($username, 316);
    $other_income_page = $api->check_role_permissions($username, 321);
    $import_other_income_page = $api->check_role_permissions($username, 326);
    $payroll_summary_page = $api->check_role_permissions($username, 328);
    $job_category_page = $api->check_role_permissions($username, 340);
    $job_type_page = $api->check_role_permissions($username, 345);
    $recruitment_pipeline_page = $api->check_role_permissions($username, 350);
    $recruitment_scorecard_page = $api->check_role_permissions($username, 360);
    $jobs_page = $api->check_role_permissions($username, 375);
    $job_application_page = $api->check_role_permissions($username, 382);

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

    if($employment_status_page > 0 || $department_page > 0 || $designation_page > 0 || $employee_page > 0 || $work_shift_page > 0 || $leave_type_page > 0 || $leave_entitlement_page > 0 || $leave_management_page > 0 || $employee_file_management_page > 0 || $holiday_page > 0 || $attendance_record_page > 0 || $attendance_summary_page > 0 || $salary_page > 0 || $job_category_page > 0 || $job_type_page > 0 || $recruitment_pipeline_page > 0 || $recruitment_scorecard_page > 0 || $jobs_page > 0 || $job_application_page > 0){
        $menu .= '<li class="menu-title" key="t-menu">Human Resource</li>';

        if($employment_status_page > 0 || $department_page > 0 || $designation_page > 0 || $employee_page > 0 || $work_shift_page > 0 || $employee_file_management_page > 0 || $attendance_record_page > 0 || $attendance_summary_page > 0 || $salary_page > 0){
            $menu .= '<li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-user-circle"></i>
                            <span key="t-employee">Employee</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">';

                        if($employee_page > 0){
                            $menu .= '<li><a href="all-employees.php" key="t-all-employees">All Employees</a></li>';
                        }

                        if($attendance_record_page > 0){
                            $menu .= '<li><a href="attendance-record.php" key="t-attendance-record">Attendance Record</a></li>';
                        }

                        if($attendance_summary_page > 0){
                            $menu .= '<li><a href="attendance-summary.php" key="t-attendance-record">Attendance Summary</a></li>';
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

                        if($salary_page > 0){
                            $menu .= '<li><a href="salary.php" key="t-employment-status">Salary</a></li>';
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

        if($job_category_page > 0 || $job_type_page > 0 || $recruitment_pipeline_page > 0 || $recruitment_scorecard_page > 0 || $jobs_page > 0 || $job_application_page > 0){
            $menu .= '<li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-user-plus"></i>
                            <span key="t-leave">Recruitment</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">';

                        if($job_application_page > 0){
                            $menu .= '<li><a href="job-applicant.php" key="t-job-applicant">Job Applicant</a></li>';
                        }

                        if($jobs_page > 0){
                            $menu .= '<li><a href="jobs.php" key="t-jobs">Jobs</a></li>';
                        }

                        if($job_category_page > 0){
                            $menu .= '<li><a href="job-category.php" key="t-job-category">Job Category</a></li>';
                        }

                        if($job_type_page > 0){
                            $menu .= '<li><a href="job-type.php" key="t-job-type">Job Type</a></li>';
                        }

                        if($recruitment_pipeline_page > 0){
                            $menu .= '<li><a href="recruitment-pipeline.php" key="t-job-type">Recruitment Pipeline</a></li>';
                        }

                        if($recruitment_scorecard_page > 0){
                            $menu .= '<li><a href="recruitment-scorecard.php" key="t-job-type">Recruitment Scorecard</a></li>';
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

    if($allowance_type_page > 0 || $allowance_page > 0 || $deduction_type_page > 0 || $deduction_page > 0 || $contribution_deduction_page > 0 || $payroll_setting_page > 0 || $payroll_group_page > 0 || $pay_run_page > 0 || $withholding_tax_page > 0 || $other_income_type_page > 0 || $other_income_page > 0 || $payroll_summary_page > 0){
        $menu .= '<li class="menu-title" key="t-menu">Payroll</li>';

        if($payroll_setting_page > 0 || $payroll_group_page > 0 || $pay_run_page > 0 || $payroll_summary_page > 0){
            $menu .= '<li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-money"></i>
                            <span key="t-payroll">Payroll</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">';

                        if($pay_run_page > 0){
                            $menu .= '<li><a href="pay-run.php" key="t-pay-run">Pay Run</a></li>';
                        }

                        if($payroll_group_page > 0){
                            $menu .= '<li><a href="payroll-group.php" key="t-payroll-group">Payroll Group</a></li>';
                        }

                        if($payroll_summary_page > 0){
                            $menu .= '<li><a href="payroll-summary.php" key="t-payroll-summary">Payroll Summary</a></li>';
                        }

                        if($payroll_setting_page > 0){
                            $menu .= '<li><a href="payroll-setting.php" key="t-payroll-setting">Payroll Setting</a></li>';
                        }

            $menu .= '</ul>
                    </li>';
        }

        if($allowance_type_page > 0 || $allowance_page > 0){
            $menu .= '<li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-dollar-circle"></i>
                            <span key="t-allowance">Manage Allowance</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">';

                        if($allowance_page > 0){
                            $menu .= '<li><a href="allowance.php" key="t-allowance">Allowance</a></li>';
                        }

                        if($allowance_type_page > 0){
                            $menu .= '<li><a href="allowance-type.php" key="t-allowance-type">Allowance Type</a></li>';
                        }

            $menu .= '</ul>
                    </li>';
        }

        if($other_income_type_page > 0 || $other_income_page > 0){
            $menu .= '<li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-plus"></i>
                            <span key="t-allowance">Manage Other Income</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">';

                        if($other_income_page > 0){
                            $menu .= '<li><a href="other-income.php" key="t-allowance">Other Income</a></li>';
                        }

                        if($other_income_type_page > 0){
                            $menu .= '<li><a href="other-income-type.php" key="t-allowance">Other Income Type</a></li>';
                        }
                        
            $menu .= '</ul>
                    </li>';
        }

        if($deduction_type_page > 0 || $government_contribution_page > 0 || $deduction_page > 0 || $contribution_deduction_page > 0 || $withholding_tax_page > 0){
            $menu .= '<li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-minus"></i>
                            <span key="t-deduction">Manage Deduction</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">';

                        if($contribution_deduction_page > 0){
                            $menu .= '<li><a href="contribution-deduction.php" key="t-deduction">Contribution Deduction</a></li>';
                        }

                        if($deduction_page > 0){
                            $menu .= '<li><a href="deduction.php" key="t-deduction">Deduction</a></li>';
                        }

                        if($deduction_type_page > 0){
                            $menu .= '<li><a href="deduction-type.php" key="t-deduction-type">Deduction Type</a></li>';
                        }

                        if($government_contribution_page > 0){
                            $menu .= '<li><a href="government-contribution.php" key="t-government-contribution">Government Contribution</a></li>';
                        }

                        if($withholding_tax_page > 0){
                            $menu .= '<li><a href="withholding-tax.php" key="t-withholding-tax">Withholding Tax</a></li>';
                        }

            $menu .= '</ul>
                    </li>';
        }
    }

    if($attendance_creation_approval_page > 0 || $attendance_adjustment_approval_page > 0 || $leave_approval_page > 0){
        $menu .= '<li class="menu-title" key="t-menu">Approval</li>';

        if($attendance_adjustment_approval_page > 0){
            $menu .= '<li>
                        <a href="attendance-adjustment-approval.php" class="waves-effect">
                            <i class="bx bx-time"></i>
                            <span key="t-dashboard">Attendance Adjustment</span>
                        </a>
                    </li>';
        }

        if($attendance_creation_approval_page > 0){
            $menu .= '<li>
                        <a href="attendance-creation-approval.php" class="waves-effect">
                            <i class="bx bx-calendar-plus"></i>
                            <span key="t-dashboard">Attendance Creation</span>
                        </a>
                    </li>';
        }

        if($leave_approval_page > 0){
            $menu .= '<li>
                        <a href="leave-approval.php" class="waves-effect">
                            <i class="bx bx-calendar-check"></i>
                            <span key="t-dashboard">Leave Approval</span>
                        </a>
                    </li>';
        }
    }

    if($attendance_creation_recommendation_page > 0 || $attendance_adjustment_recommendation_page > 0){
        $menu .= '<li class="menu-title" key="t-menu">Recommendation</li>';

        if($attendance_creation_recommendation_page > 0){
            $menu .= '<li>
                        <a href="attendance-adjustment-recommendation.php" class="waves-effect">
                            <i class="bx bx-time"></i>
                            <span key="t-dashboard">Attendance Adjustment</span>
                        </a>
                    </li>';
        }

        if($attendance_adjustment_recommendation_page > 0){
            $menu .= '<li>
                        <a href="attendance-creation-recommendation.php" class="waves-effect">
                            <i class="bx bx-calendar-plus"></i>
                            <span key="t-dashboard">Attendance Creation</span>
                        </a>
                    </li>';
        }
    }

    if($policy_page > 0 || $role_page > 0 || $system_parameter_page > 0 || $system_code_page > 0 || $notification_type_page > 0 || $user_interface_setting_page > 0 || $application_notification_page > 0 || $company_setting_page > 0 || $email_configuration_page > 0 || $branch_page > 0 || $upload_setting_page > 0 || $user_account_page > 0 || $attendance_setting_page > 0 || $import_employee_page > 0 || $import_attendance_record_page > 0 || $import_leave_entitlement_page > 0 || $import_leave_page > 0 || $import_attendance_adjustment_page > 0 || $import_attendance_creation_page > 0 || $import_allowance_page > 0 || $import_deduction_page > 0 || $import_government_contribution_page > 0 || $import_contribution_bracket_page > 0 || $import_contribution_deduction_page > 0 || $import_withholding_tax_page > 0 || $import_other_income_page > 0){
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

        if($import_employee_page > 0 || $import_attendance_record_page > 0 || $import_leave_entitlement_page > 0 || $import_leave_page > 0 || $import_attendance_adjustment_page > 0 || $import_attendance_creation_page > 0 || $import_allowance_page > 0 || $import_deduction_page > 0 || $import_government_contribution_page > 0 || $import_contribution_bracket_page > 0 || $import_contribution_deduction_page > 0 || $import_withholding_tax_page > 0 || $import_other_income_page > 0){
            $menu .= '<li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-import"></i>
                            <span key="t-settings">Import</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">';

                        if($import_employee_page > 0){
                            $menu .= '<li><a href="import-employee.php" key="t-import-employee">Employee</a></li>';
                        }

                        if($import_attendance_record_page > 0){
                            $menu .= '<li><a href="import-attendance-record.php" key="t-import-attendance-record">Attendance Record</a></li>';
                        }

                        if($import_attendance_adjustment_page > 0){
                            $menu .= '<li><a href="import-attendance-adjustment.php" key="t-import-attendance-adjustment">Attendance Adjustment</a></li>';
                        }

                        if($import_attendance_creation_page > 0){
                            $menu .= '<li><a href="import-attendance-creation.php" key="t-import-attendance-creation">Attendance Creation</a></li>';
                        }

                        if($import_leave_page > 0){
                            $menu .= '<li><a href="import-leave.php" key="t-import-leave">Leave</a></li>';
                        }

                        if($import_leave_entitlement_page > 0){
                            $menu .= '<li><a href="import-leave-entitlement.php" key="t-import-leave-entitlement">Leave Entitlement</a></li>';
                        }

                        if($import_allowance_page > 0){
                            $menu .= '<li><a href="import-allowance.php" key="t-import-allowance">Allowance</a></li>';
                        }

                        if($import_deduction_page > 0){
                            $menu .= '<li><a href="import-deduction.php" key="t-import-deduction">Deduction</a></li>';
                        }

                        if($import_government_contribution_page > 0){
                            $menu .= '<li><a href="import-government-contribution.php" key="t-import-government-contribution">Government Contribution</a></li>';
                        }

                        if($import_contribution_bracket_page > 0){
                            $menu .= '<li><a href="import-contribution-bracket.php" key="t-import-contribution-bracket">Contribution Bracket</a></li>';
                        }

                        if($import_contribution_deduction_page > 0){
                            $menu .= '<li><a href="import-contribution-deduction.php" key="t-import-contribution-deduction">Contribution Deduction</a></li>';
                        }

                        if($import_other_income_page > 0){
                            $menu .= '<li><a href="import-other-income.php" key="t-import-other-income">Other Income</a></li>';
                        }

                        if($import_withholding_tax_page > 0){
                            $menu .= '<li><a href="import-withholding-tax.php" key="t-import-contribution-deduction">Withholding Tax</a></li>';
                        }

            $menu .= '</ul>
                    </li>';
        }

        if($user_account_page > 0){
            $menu .= '<li>
                        <a href="user-account.php" class="waves-effect">
                            <i class="bx bx-user"></i>
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
                            <li>
                                <a href="documentation.php" class="waves-effect">
                                    <i class="bx bx-book"></i>
                                    <span key="t-documentation">Documentation</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>