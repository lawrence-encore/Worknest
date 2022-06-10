<?php
session_start();
require('config/config.php');
require('classes/api.php');

if(isset($_POST['transaction']) && !empty($_POST['transaction'])){
    $transaction = $_POST['transaction'];
    $api = new Api;
    $system_date = date('Y-m-d');
    $current_time = date('H:i:s');

    # Authenticate
    if($transaction == 'authenticate'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){
            $username = $_POST['username'];
            $password = $api->encrypt_data($_POST['password']);

            $authenticate = $api->authenticate($username, $password);
            
            if($authenticate == 1){
                $_SESSION['lock'] = 0;
                $_SESSION['logged_in'] = 1;
                $_SESSION['username'] = $username;

                echo 'Authenticated';
            }
            else{
                echo $authenticate;
            }
        }
    }
    # -------------------------------------------------------------

    # Change password
    else if($transaction == 'change password'){
        if(isset($_POST['change_username']) && !empty($_POST['change_username']) && isset($_POST['change_password']) && !empty($_POST['change_password'])){
            $username = $_POST['change_username'];
            $password = $api->encrypt_data($_POST['change_password']);
            $password_expiry_date = $api->format_date('Y-m-d', $system_date, '+6 months');

            $check_user_account_exist = $api->check_user_account_exist($username);

            if($check_user_account_exist){
                $update_user_password = $api->update_user_password($username, $password, $password_expiry_date);

                if($update_user_password){
                    $update_login_attempt = $api->update_login_attempt($username, '', 0, NULL);

                    if($update_login_attempt){
                        echo 'Updated';
                    }
                    else{
                        echo $update_login_attempt;
                    }
                }
                else{
                    echo $update_user_password;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Chart transactions
    # -------------------------------------------------------------

    # Employee attendance record chart
    else if($transaction == 'employee attendance record chart'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['filter_attendance_record_start_date']) && isset($_POST['filter_attendance_record_end_date'])){
            $employee_id = $_POST['employee_id'];
            $filter_attendance_record_start_date = $api->check_date('empty', $_POST['filter_attendance_record_start_date'], '', 'Y-m-d', '', '', '');
            $filter_attendance_record_end_date = $api->check_date('empty', $_POST['filter_attendance_record_end_date'], '', 'Y-m-d', '', '', '');

            $early = $api->get_attendance_time_in_count('EARLY', $employee_id, $filter_attendance_record_start_date, $filter_attendance_record_end_date);
            $time_in_regular_count = $api->get_attendance_time_in_count('REG', $employee_id, $filter_attendance_record_start_date, $filter_attendance_record_end_date);
            $late_count = $api->get_attendance_time_in_count('LATE', $employee_id, $filter_attendance_record_start_date, $filter_attendance_record_end_date);

            $early_leaving = $api->get_attendance_time_out_count('EL', $employee_id, $filter_attendance_record_start_date, $filter_attendance_record_end_date);
            $time_out_regular_count = $api->get_attendance_time_out_count('REG', $employee_id, $filter_attendance_record_start_date, $filter_attendance_record_end_date);
            $overtime_count = $api->get_attendance_time_out_count('OT', $employee_id, $filter_attendance_record_start_date, $filter_attendance_record_end_date);

            $response[] = array(
                'EARLY' => number_format($early),
                'TIME_IN_REGULAR' => number_format($time_in_regular_count),
                'LATE' => number_format($late_count),
                'EARLY_LEAVING' => number_format($early_leaving),
                'TIME_OUT_REGULAR' => number_format($time_out_regular_count),
                'OVERTIME' => number_format($overtime_count)
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Attendance summary chart
    else if($transaction == 'attendance summary chart'){
        if(isset($_POST['filter_start_date']) && isset($_POST['filter_end_date']) && isset($_POST['filter_branch']) && isset($_POST['filter_department'])){
            $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
            $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');

            if(!empty($_POST['filter_branch'])){
                $filter_branch = $_POST['filter_branch'];
            }
            else{
                $filter_branch = null;
            }

            if(!empty($_POST['filter_department'])){
                $filter_department = $_POST['filter_department'];
            }
            else{
                $filter_department = null;
            }

            $early = $api->get_attendance_summary_time_in_count('EARLY', $filter_start_date, $filter_end_date, $filter_branch, $filter_department);
            $time_in_regular_count = $api->get_attendance_summary_time_in_count('REG', $filter_start_date, $filter_end_date, $filter_branch, $filter_department);
            $late_count = $api->get_attendance_summary_time_in_count('LATE', $filter_start_date, $filter_end_date, $filter_branch, $filter_department);

            $early_leaving = $api->get_attendance_summary_time_out_count('EL', $filter_start_date, $filter_end_date, $filter_branch, $filter_department);
            $time_out_regular_count = $api->get_attendance_summary_time_out_count('REG', $filter_start_date, $filter_end_date, $filter_branch, $filter_department);
            $overtime_count = $api->get_attendance_summary_time_out_count('OT', $filter_start_date, $filter_end_date, $filter_branch, $filter_department);

            $get_attendance_adjustments_sanction_count = $api->get_attendance_summary_attendance_adjustments_sanction_count(1, $filter_start_date, $filter_end_date, $filter_branch, $filter_department);
            $get_attendance_creation_sanction_count = $api->get_attendance_summary_attendance_creation_sanction_count(1, $filter_start_date, $filter_end_date, $filter_branch, $filter_department);
            $get_attendance_adjustments_unsanction_count = $api->get_attendance_summary_attendance_adjustments_sanction_count(0, $filter_start_date, $filter_end_date, $filter_branch, $filter_department);
            $get_attendance_creation_unsanction_count = $api->get_attendance_summary_attendance_creation_sanction_count(0, $filter_start_date, $filter_end_date, $filter_branch, $filter_department);

            $response[] = array(
                'EARLY' => number_format($early),
                'TIME_IN_REGULAR' => number_format($time_in_regular_count),
                'LATE' => number_format($late_count),
                'EARLY_LEAVING' => number_format($early_leaving),
                'TIME_OUT_REGULAR' => number_format($time_out_regular_count),
                'OVERTIME' => number_format($overtime_count),
                'SANCTIONED_ATTENDANCE_ADJUSTMENT' => number_format($get_attendance_adjustments_sanction_count),
                'SANCTIONED_ATTENDANCE_CREATION' => number_format($get_attendance_creation_sanction_count),
                'UNSANCTIONED_ATTENDANCE_ADJUSTMENT' => number_format($get_attendance_adjustments_unsanction_count),
                'UNSANCTIONED_ATTENDANCE_CREATION' => number_format($get_attendance_creation_unsanction_count),
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Calculation transactions
    # -------------------------------------------------------------

    # Calculate allowance end date
    else if($transaction == 'calculate allowance end date'){
        if(isset($_POST['recurrence_pattern']) && isset($_POST['recurrence']) && isset($_POST['start_date'])){
            $recurrence_pattern = $_POST['recurrence_pattern'];
            $recurrence = $_POST['recurrence'];
            $start_date = $api->check_date('empty', $_POST['start_date'], '', 'Y-m-d', '', '', '');

            if(!empty($start_date) && !empty($recurrence_pattern) && $recurrence > 0){
                $payroll_date = $start_date;

                for($i = 0; $i < $recurrence; $i++){
                    if($i == 0){
                        $payroll_date = $start_date;
                    }
                    else{
                        $payroll_date = $api->check_date('empty', $api->get_next_date($payroll_date, $recurrence_pattern), '', 'Y-m-d', '', '', '');
                    }
                }

                echo $api->check_date('empty', $payroll_date, '', 'n/d/Y', '', '', '');
            }
            else{
                echo $api->check_date('empty', $start_date, '', 'n/d/Y', '', '', '');
            }
        }
    }
    # -------------------------------------------------------------

    # Calculate other income end date
    else if($transaction == 'calculate other income end date'){
        if(isset($_POST['recurrence_pattern']) && isset($_POST['recurrence']) && isset($_POST['start_date'])){
            $recurrence_pattern = $_POST['recurrence_pattern'];
            $recurrence = $_POST['recurrence'];
            $start_date = $api->check_date('empty', $_POST['start_date'], '', 'Y-m-d', '', '', '');

            if(!empty($start_date) && !empty($recurrence_pattern) && $recurrence > 0){
                $payroll_date = $start_date;

                for($i = 0; $i < $recurrence; $i++){
                    if($i == 0){
                        $payroll_date = $start_date;
                    }
                    else{
                        $payroll_date = $api->check_date('empty', $api->get_next_date($payroll_date, $recurrence_pattern), '', 'Y-m-d', '', '', '');
                    }
                }

                echo $api->check_date('empty', $payroll_date, '', 'n/d/Y', '', '', '');
            }
            else{
                echo $api->check_date('empty', $start_date, '', 'n/d/Y', '', '', '');
            }
        }
    }
    # -------------------------------------------------------------

    # Calculate deduction end date
    else if($transaction == 'calculate deduction end date'){
        if(isset($_POST['recurrence_pattern']) && isset($_POST['recurrence']) && isset($_POST['start_date'])){
            $recurrence_pattern = $_POST['recurrence_pattern'];
            $recurrence = $_POST['recurrence'];
            $start_date = $api->check_date('empty', $_POST['start_date'], '', 'Y-m-d', '', '', '');

            if(!empty($start_date) && !empty($recurrence_pattern) && $recurrence > 0){
                $payroll_date = $start_date;

                for($i = 0; $i < $recurrence; $i++){
                    if($i == 0){
                        $payroll_date = $start_date;
                    }
                    else{
                        $payroll_date = $api->check_date('empty', $api->get_next_date($payroll_date, $recurrence_pattern), '', 'Y-m-d', '', '', '');
                    }
                }

                echo $api->check_date('empty', $payroll_date, '', 'n/d/Y', '', '', '');
            }
            else{
                echo $api->check_date('empty', $start_date, '', 'n/d/Y', '', '', '');
            }
        }
    }
    # -------------------------------------------------------------

    # Calculate contribution deduction end date
    else if($transaction == 'calculate contribution deduction end date'){
        if(isset($_POST['recurrence_pattern']) && isset($_POST['recurrence']) && isset($_POST['start_date'])){
            $recurrence_pattern = $_POST['recurrence_pattern'];
            $recurrence = $_POST['recurrence'];
            $start_date = $api->check_date('empty', $_POST['start_date'], '', 'Y-m-d', '', '', '');

            if(!empty($start_date) && !empty($recurrence_pattern) && $recurrence > 0){
                $payroll_date = $start_date;

                for($i = 0; $i < $recurrence; $i++){
                    if($i == 0){
                        $payroll_date = $start_date;
                    }
                    else{
                        $payroll_date = $api->check_date('empty', $api->get_next_date($payroll_date, $recurrence_pattern), '', 'Y-m-d', '', '', '');
                    }
                }

                echo $api->check_date('empty', $payroll_date, '', 'n/d/Y', '', '', '');
            }
            else{
                echo $api->check_date('empty', $start_date, '', 'n/d/Y', '', '', '');
            }
        }
    }
    # -------------------------------------------------------------

    # Calculate salary rate
    else if($transaction == 'calculate salary rate'){
        if(isset($_POST['salary_amount']) && isset($_POST['salary_frequency']) && isset($_POST['hours_per_week']) && isset($_POST['hours_per_day'])){
            $salary_amount = $_POST['salary_amount'];
            $salary_frequency = $_POST['salary_frequency'];
            $hours_per_week = $_POST['hours_per_week'];
            $hours_per_day = $_POST['hours_per_day'];

            if(!empty($salary_amount) && !empty($salary_frequency) && !empty($hours_per_week) && !empty($hours_per_day)){
                if($salary_frequency == 'MONTHLY'){
                    $hourly_rate = (($salary_amount * 12) / 52) / $hours_per_week;
                }
                else if($salary_frequency == 'BIWEEKLY'){
                    $hourly_rate = $salary_amount / ($hours_per_week * 2);
                }
                else if($salary_frequency == 'WEEKLY'){
                    $hourly_rate = $salary_amount / $hours_per_week;
                }
                else{
                    $hourly_rate = $salary_amount / $hours_per_day;
                }

                $daily_rate = $hourly_rate * $hours_per_day;
                $minute_rate = $hourly_rate / 60;
                $weekly_rate = $hourly_rate * $hours_per_week;
                $bi_weekly_rate = $weekly_rate * 2;
                $monthly_rate = ($hourly_rate * $hours_per_week * 52) / 12;
            }
            else{
                $minute_rate = '0.00';
                $hourly_rate = '0.00';
                $daily_rate = '0.00';
                $weekly_rate = '0.00';
                $bi_weekly_rate = '0.00';
                $monthly_rate = '0.00';
            }

            $response[] = array(
                'MINUTE_RATE' => number_format($minute_rate, 2, '.', ''),
                'HOURLY_RATE' => number_format($hourly_rate, 2, '.', ''),
                'DAILY_RATE' => number_format($daily_rate, 2, '.', ''),
                'WEEKLY_RATE' => number_format($weekly_rate, 2, '.', ''),
                'BI_WEEKLY_RATE' => number_format($bi_weekly_rate, 2, '.', ''),
                'MONTHLY_RATE' => number_format($monthly_rate, 2, '.', '')
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Backup transactions
    # -------------------------------------------------------------

    # Backup database
    else if($transaction == 'backup database'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['file_name']) && !empty($_POST['file_name'])){
            $username = $_POST['username'];
            $file_name = $_POST['file_name'];

            $backup_database = $api->backup_database($file_name, $username);

            if($backup_database){
                echo 'Backed-up';
            }
            else{
                echo $backup_database;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Import transactions
    # -------------------------------------------------------------

    # Import employee
    else if($transaction == 'import employee'){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            $file_type = '';
            $username = $_POST['username'];

            $import_file_name = $_FILES['import_file']['name'];
            $import_file_size = $_FILES['import_file']['size'];
            $import_file_error = $_FILES['import_file']['error'];
            $import_file_tmp_name = $_FILES['import_file']['tmp_name'];
            $import_file_ext = explode('.', $import_file_name);
            $import_file_actual_ext = strtolower(end($import_file_ext));

            $upload_setting_details = $api->get_upload_setting_details(12);
            $upload_file_type_details = $api->get_upload_file_type_details(12);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            if(in_array($import_file_actual_ext, $allowed_ext)){
                if(!$import_file_error){
                    if($import_file_size < $file_max_size){
                        $truncate_temporary_employee_table = $api->truncate_temporary_employee_table();

                        if($truncate_temporary_employee_table){
                            $file = fopen($import_file_tmp_name, 'r');
                            fgetcsv($file);
    
                            while (($column = fgetcsv($file, 0, ',')) !== FALSE) { 
                                $employee_id = $column[0];
                                $id_number = $column[1];
                                $first_name = $column[2];
                                $middle_name = $column[3];
                                $last_name = $column[4];
                                $suffix = $column[5];
                                $file_as = $api->get_file_as_format($first_name, $middle_name, $last_name, $suffix);
                                $birthday = $api->check_date('empty', $column[6], '', 'Y-m-d', '', '', '');
                                $employment_status = $column[7];
                                $join_date = $api->check_date('empty', $column[8], '', 'Y-m-d', '', '', '');
                                $exit_date = $api->check_date('empty', $column[9], '', 'Y-m-d', '', '', '');
                                $permanency_date = $api->check_date('empty', $column[10], '', 'Y-m-d', '', '', '');
                                $exit_reason = $column[11];
                                $email = $column[12];
                                $phone = $column[13];
                                $telephone = $column[14];
                                $department = $column[15];
                                $designation = $column[16];
                                $branch = $column[17];
                                $gender = $column[18];
                                $validate_email = $api->validate_email($email);

                                if(!empty($id_number) && !empty($file_as) && !empty($first_name) && !empty($middle_name) && !empty($last_name) && !empty($birthday) && !empty($employment_status) && !empty($phone)){
                                    $insert_temporary_employee = $api->insert_temporary_employee($employee_id, $id_number, $file_as, $first_name, $middle_name, $last_name, $suffix, $birthday, $employment_status, $join_date, $exit_date, $permanency_date, $exit_reason, $email, $phone, $telephone, $department, $designation, $branch, $gender);
                                }
                            }

                            echo 'Imported';
                        }
                        else{
                            echo $truncate_temporary_employee_table;
                        }
                    }
                    else{
                        echo 'File Size';
                    }
                }
                else{
                    echo 'There was an error uploading the file.';
                }
            }
            else{
                echo 'File Type';
            }
        }
    }
    # -------------------------------------------------------------

    # Import employee data
    else if($transaction == 'import employee data'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employee_id']) && isset($_POST['id_number']) && isset($_POST['file_as']) && isset($_POST['first_name']) && isset($_POST['middle_name']) && isset($_POST['last_name']) && isset($_POST['suffix']) && isset($_POST['employment_status']) && isset($_POST['exit_reason']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['telephone']) && isset($_POST['department']) && isset($_POST['designation']) && isset($_POST['branch']) && isset($_POST['gender']) && isset($_POST['birthday']) && isset($_POST['join_date']) && isset($_POST['exit_date']) && isset($_POST['permanency_date'])){
            $username = $_POST['username'];
            $employee_id = $_POST['employee_id'];
            $id_number = $_POST['id_number'];
            $file_as = $_POST['file_as'];
            $first_name = $_POST['first_name'];
            $middle_name = $_POST['middle_name'];
            $last_name = $_POST['last_name'];
            $suffix = $_POST['suffix'];
            $employment_status = $_POST['employment_status'];
            $exit_reason = $_POST['exit_reason'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $telephone = $_POST['telephone'];
            $department = $_POST['department'];
            $designation = $_POST['designation'];
            $branch = $_POST['branch'];
            $gender = $_POST['gender'];
            $birthday = $_POST['birthday'];
            $join_date = $_POST['join_date'];
            $exit_date = $_POST['exit_date'];
            $permanency_date = $_POST['permanency_date'];

            for($i = 0; $i < count($id_number); $i++){
                if(!empty($employee_id[$i])){
                    $check_employee_exist = $api->check_employee_exist($employee_id[$i]);

                    if($check_employee_exist > 0){
                        $update_employee = $api->update_employee($employee_id[$i], $file_as[$i], $first_name[$i], $middle_name[$i], $last_name[$i], $suffix[$i], $birthday[$i], $employment_status[$i], $join_date[$i], $permanency_date[$i], $exit_date[$i], $exit_reason[$i], $email[$i], $phone[$i], $telephone[$i], $department[$i], $designation[$i], $branch[$i], $gender[$i], $username);
                    }
                    else{
                        $check_employee_id_number_exist = $api->check_employee_id_number_exist($id_number[$i]);
        
                        if($check_employee_id_number_exist == 0){
                            $insert_employee = $api->insert_employee($id_number[$i], $file_as[$i], $first_name[$i], $middle_name[$i], $last_name[$i], $suffix[$i], $birthday[$i], $employment_status[$i], $join_date[$i], $permanency_date[$i], $exit_date[$i], $exit_reason[$i], $email[$i], $phone[$i], $telephone[$i], $department[$i], $designation[$i], $branch[$i], $gender[$i], $username);
                        }
                    }
                }
                else{
                    $check_employee_id_number_exist = $api->check_employee_id_number_exist($id_number[$i]);
        
                    if($check_employee_id_number_exist == 0){
                        $insert_employee = $api->insert_employee($id_number[$i], $file_as[$i], $first_name[$i], $middle_name[$i], $last_name[$i], $suffix[$i], $birthday[$i], $employment_status[$i], $join_date[$i], $permanency_date[$i], $exit_date[$i], $exit_reason[$i], $email[$i], $phone[$i], $telephone[$i], $department[$i], $designation[$i], $branch[$i], $gender[$i], $username);
                    }
                }
            }

            echo 'Imported';
        }
    }
    # -------------------------------------------------------------

    # Import attendance record
    else if($transaction == 'import attendance record'){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            $file_type = '';
            $username = $_POST['username'];

            $import_file_name = $_FILES['import_file']['name'];
            $import_file_size = $_FILES['import_file']['size'];
            $import_file_error = $_FILES['import_file']['error'];
            $import_file_tmp_name = $_FILES['import_file']['tmp_name'];
            $import_file_ext = explode('.', $import_file_name);
            $import_file_actual_ext = strtolower(end($import_file_ext));

            $upload_setting_details = $api->get_upload_setting_details(13);
            $upload_file_type_details = $api->get_upload_file_type_details(13);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            if(in_array($import_file_actual_ext, $allowed_ext)){
                if(!$import_file_error){
                    if($import_file_size < $file_max_size){
                        $truncate_temporary_attendance_record_table = $api->truncate_temporary_attendance_record_table();

                        if($truncate_temporary_attendance_record_table){
                            $file = fopen($import_file_tmp_name, 'r');
                            fgetcsv($file);
    
                            while (($column = fgetcsv($file, 0, ',')) !== FALSE) { 
                                $attendance_id = $column[0];
                                $employee_id = $column[1];
                                $time_in_date = $api->check_date('empty', $column[2], '', 'Y-m-d', '', '', '');
                                $time_in = $api->check_date('empty', $column[3], '', 'H:i:00', '', '', '');
                                $time_out_date = $api->check_date('empty', $column[4], '', 'Y-m-d', '', '', '');
                                $time_out = $api->check_date('empty', $column[5], '', 'H:i:00', '', '', '');

                                if(!empty($employee_id) && !empty($time_in_date) && !empty($time_in)){
                                    $insert_temporary_attendance_record = $api->insert_temporary_attendance_record($attendance_id, $employee_id, $time_in_date, $time_in, $time_out_date, $time_out);
                                }
                            }

                            echo 'Imported';
                        }
                        else{
                            echo $truncate_temporary_attendance_record_table;
                        }
                    }
                    else{
                        echo 'File Size';
                    }
                }
                else{
                    echo 'There was an error uploading the file.';
                }
            }
            else{
                echo 'File Type';
            }
        }
    }
    # -------------------------------------------------------------

    # Import attendance record data
    else if($transaction == 'import attendance record data'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['attendance_id']) && isset($_POST['employee_id']) && isset($_POST['time_in_date']) && isset($_POST['time_in']) && isset($_POST['time_out_date']) && isset($_POST['time_out'])){
            $username = $_POST['username'];
            $attendance_id = $_POST['attendance_id'];
            $employee_id = $_POST['employee_id'];
            $time_in_date = $_POST['time_in_date'];
            $time_in = $_POST['time_in'];
            $time_out_date = $_POST['time_out_date'];
            $time_out = $_POST['time_out'];

            for($i = 0; $i < count($employee_id); $i++){
                $late = $api->get_attendance_late_total($employee_id[$i], $time_in_date[$i], $time_in[$i]);
                $time_in_behavior = $api->get_time_in_behavior($employee_id[$i], $time_in_date[$i], $time_in[$i]);
                
                $time_out_behavior = '';
                $early_leaving = 0;
                $overtime = 0;
                $total_hours_worked = 0;

                $attendance_setting_details = $api->get_attendance_setting_details(1);
                $max_attendance = $attendance_setting_details[0]['MAX_ATTENDANCE'] ?? 1;
                $get_clock_in_total = $api->get_clock_in_total($employee_id[$i], $time_in_date[$i]);

                $check_attendance_validation = $api->check_attendance_validation($time_in_date[$i], $time_in[$i], $time_out_date[$i], $time_out[$i]);

                if(empty($check_attendance_validation)){
                    if(!empty($time_out_date[$i]) && !empty($time_out[$i])){
                        $early_leaving = $api->get_attendance_early_leaving_total($employee_id[$i], $time_in_date[$i], $time_out[$i]);
                        $overtime = $api->get_attendance_overtime_total($employee_id[$i], $time_in_date[$i], $time_out_date[$i], $time_out[$i]);
                        $total_hours_worked = $api->get_attendance_total_hours($employee_id[$i], $time_in_date[$i], $time_in[$i], $time_out_date[$i], $time_out[$i]);
                        $time_out_behavior = $api->get_time_out_behavior($employee_id[$i], $time_in_date[$i], $time_out_date[$i], $time_out[$i]);
                    }

                    $check_employee_attendance_exist = $api->check_employee_attendance_exist($attendance_id[$i]);

                    if($check_employee_attendance_exist > 0){
                        $get_employee_attendance_details = $api->get_employee_attendance_details($attendance_id[$i]);
                        $time_date_details = $get_employee_attendance_details[0]['TIME_IN_DATE'];

                        if(strtotime($time_date_details) != strtotime($time_in_date[$i])){
                            if($get_clock_in_total < $max_attendance){
                                $update_manual_employee_attendance = $api->update_manual_employee_attendance($attendance_id[$i], $time_in_date[$i], $time_in[$i], $time_in_behavior, $time_out_date[$i], $time_out[$i], $time_out_behavior, $late, $early_leaving, $overtime, $total_hours_worked, 'Imported Data', $username);
                            }
                        }
                        else{
                            $update_manual_employee_attendance = $api->update_manual_employee_attendance($attendance_id[$i], $time_in_date[$i], $time_in[$i], $time_in_behavior, $time_out_date[$i], $time_out[$i], $time_out_behavior, $late, $early_leaving, $overtime, $total_hours_worked, 'Imported Data', $username);
                        }
                    }
                    else{
                        if($get_clock_in_total < $max_attendance){
                            $insert_manual_employee_attendance = $api->insert_manual_employee_attendance($employee_id[$i], $time_in_date[$i], $time_in[$i], $time_in_behavior, $time_out_date[$i], $time_out[$i], $time_out_behavior, $late, $early_leaving, $overtime, $total_hours_worked, 'Imported Data', $username);
                        }
                    }
                }
            }

            echo 'Imported';
        }
    }
    # -------------------------------------------------------------

    # Import leave entitlement
    else if($transaction == 'import leave entitlement'){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            $file_type = '';
            $username = $_POST['username'];

            $import_file_name = $_FILES['import_file']['name'];
            $import_file_size = $_FILES['import_file']['size'];
            $import_file_error = $_FILES['import_file']['error'];
            $import_file_tmp_name = $_FILES['import_file']['tmp_name'];
            $import_file_ext = explode('.', $import_file_name);
            $import_file_actual_ext = strtolower(end($import_file_ext));

            $upload_setting_details = $api->get_upload_setting_details(14);
            $upload_file_type_details = $api->get_upload_file_type_details(14);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            if(in_array($import_file_actual_ext, $allowed_ext)){
                if(!$import_file_error){
                    if($import_file_size < $file_max_size){
                        $truncate_temporary_leave_table = $api->truncate_temporary_leave_table();

                        if($truncate_temporary_leave_table){
                            $file = fopen($import_file_tmp_name, 'r');
                            fgetcsv($file);
    
                            while (($column = fgetcsv($file, 0, ',')) !== FALSE) { 
                                $leave_entitlement_id = $column[0];
                                $employee_id = $column[1];
                                $leave_type = $column[2];
                                $no_leaves = $column[3];
                                $start_date = $api->check_date('empty', $column[4], '', 'Y-m-d', '', '', '');
                                $end_date = $api->check_date('empty', $column[5], '', 'Y-m-d', '', '', '');

                                if(!empty($employee_id) && !empty($leave_type) && !empty($no_leaves) && !empty($start_date) && !empty($end_date)){
                                    $insert_temporary_leave_entitlement = $api->insert_temporary_leave_entitlement($leave_entitlement_id, $employee_id, $leave_type, $no_leaves, $start_date, $end_date);
                                }
                            }

                            echo 'Imported';
                        }
                        else{
                            echo $truncate_temporary_leave_table;
                        }
                    }
                    else{
                        echo 'File Size';
                    }
                }
                else{
                    echo 'There was an error uploading the file.';
                }
            }
            else{
                echo 'File Type';
            }
        }
    }
    # -------------------------------------------------------------

    # Import leave entitlement data
    else if($transaction == 'import leave entitlement data'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_entitlement_id']) && isset($_POST['employee_id']) && isset($_POST['leave_type']) && isset($_POST['no_leaves']) && isset($_POST['start_date']) && isset($_POST['end_date'])){
            $username = $_POST['username'];
            $leave_entitlement_id = $_POST['leave_entitlement_id'];
            $employee_id = $_POST['employee_id'];
            $leave_type = $_POST['leave_type'];
            $no_leaves = $_POST['no_leaves'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            for($i = 0; $i < count($employee_id); $i++){
                $check_leave_entitlement_exist = $api->check_leave_entitlement_exist($leave_entitlement_id[$i]);

                if($check_leave_entitlement_exist > 0){
                    $leave_entitlement_details = $api->get_leave_entitlement_details($leave_entitlement_id[$i]);
                    $leave_entitlement_start_date = $leave_entitlement_details[0]['START_DATE'];
                    $leave_entitlement_end_date = $leave_entitlement_details[0]['END_DATE'];

                    if(strtotime($leave_entitlement_start_date) != strtotime($start_date[$i]) || strtotime($leave_entitlement_end_date) != strtotime($end_date[$i])){
                        $leave_entitlement_overlap = $api->check_leave_entitlement_overlap($leave_entitlement_id[$i], $start_date[$i], $end_date[$i], $employee_id[$i], $leave_type[$i]);

                        if($leave_entitlement_overlap == 0){
                            $update_leave_entitlement = $api->update_leave_entitlement($leave_entitlement_id[$i], $no_leaves[$i], $start_date[$i], $end_date[$i], $username);
                        }
                    }
                    else{
                        $update_leave_entitlement = $api->update_leave_entitlement($leave_entitlement_id[$i], $no_leaves[$i], $start_date[$i], $end_date[$i], $username);
                    }
                }
                else{
                    $leave_entitlement_overlap = $api->check_leave_entitlement_overlap('', $start_date[$i], $end_date[$i], $employee_id[$i], $leave_type[$i]);

                    if($leave_entitlement_overlap == 0){
                        $insert_leave_entitlement = $api->insert_leave_entitlement($employee_id[$i], $leave_type[$i], $no_leaves[$i], $start_date[$i], $end_date[$i], $username);
                    }
                }
            }

            echo 'Imported';
        }
    }
    # -------------------------------------------------------------

    # Import leave
    else if($transaction == 'import leave'){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            $file_type = '';
            $username = $_POST['username'];

            $import_file_name = $_FILES['import_file']['name'];
            $import_file_size = $_FILES['import_file']['size'];
            $import_file_error = $_FILES['import_file']['error'];
            $import_file_tmp_name = $_FILES['import_file']['tmp_name'];
            $import_file_ext = explode('.', $import_file_name);
            $import_file_actual_ext = strtolower(end($import_file_ext));

            $upload_setting_details = $api->get_upload_setting_details(15);
            $upload_file_type_details = $api->get_upload_file_type_details(15);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            if(in_array($import_file_actual_ext, $allowed_ext)){
                if(!$import_file_error){
                    if($import_file_size < $file_max_size){
                        $truncate_temporary_leave_table = $api->truncate_temporary_leave_table();

                        if($truncate_temporary_leave_table){
                            $file = fopen($import_file_tmp_name, 'r');
                            fgetcsv($file);
    
                            while (($column = fgetcsv($file, 0, ',')) !== FALSE) { 
                                $employee_id = $column[0];
                                $leave_type = $column[1];
                                $leave_date = $api->check_date('empty', $column[2], '', 'Y-m-d', '', '', '');
                                $start_time = $api->check_date('empty', $column[3], '', 'H:i:00', '', '', '');
                                $end_time = $api->check_date('empty', $column[4], '', 'H:i:00', '', '', '');
                                $leave_status = $column[5];
                                $leave_reason = $column[6];

                                if(!empty($employee_id) && !empty($leave_type) && !empty($leave_date) && !empty($start_time) && !empty($end_time) && !empty($leave_status) && !empty($leave_reason)){
                                    $insert_temporary_leave = $api->insert_temporary_leave($employee_id, $leave_type, $leave_date, $start_time, $end_time, $leave_status, $leave_reason);
                                }
                            }

                            echo 'Imported';
                        }
                        else{
                            echo $truncate_temporary_leave_table;
                        }
                    }
                    else{
                        echo 'File Size';
                    }
                }
                else{
                    echo 'There was an error uploading the file.';
                }
            }
            else{
                echo 'File Type';
            }
        }
    }
    # -------------------------------------------------------------

    # Import leave data
    else if($transaction == 'import leave data'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employee_id']) && isset($_POST['leave_type']) && isset($_POST['leave_date']) && isset($_POST['start_time']) && isset($_POST['end_time']) && isset($_POST['leave_status']) && isset($_POST['leave_reason'])){
            $username = $_POST['username'];
            $employee_id = $_POST['employee_id'];
            $leave_type = $_POST['leave_type'];
            $leave_date = $_POST['leave_date'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $leave_status = $_POST['leave_status'];
            $leave_reason = $_POST['leave_reason'];

            for($i = 0; $i < count($employee_id); $i++){
                if($leave_status[$i] == 'APV' || $leave_status[$i] == 'APVSYS'){
                    $decision_date = date('Y-m-d');
                    $decision_time = date('H:i:s');
                    $decision_by = $username;
                }
                else{
                    $decision_date = null;
                    $decision_time = null;
                    $decision_by = null;
                }

                $leave_day = $api->check_week_day($api->check_date('empty', $leave_date[$i], '', 'w', '', '', ''));

                $work_shift_schedule = $api->get_work_shift_schedule($employee_id[$i], $leave_date[$i], $leave_day);
                $work_shift_time_in = $work_shift_schedule[0]['START_TIME'];
                $work_shift_time_out = $work_shift_schedule[0]['END_TIME'];
                $work_shift_half_day_mark = $work_shift_schedule[0]['HALF_DAY_MARK'];
                
                $total_working_hours = round(abs(strtotime($work_shift_time_out) - strtotime($work_shift_time_in)) / 3600, 2);
                $total_leave_hours = round(abs(strtotime($end_time[$i]) - strtotime($start_time[$i])) / 3600, 2);

                if($total_working_hours != $total_leave_hours){
                    if($total_working_hours > 0){
                        $total_hours = ($total_working_hours - $total_leave_hours) / $total_working_hours;
                    }
                    else{
                        $total_hours = 0;
                    }
                }
                else{
                    $total_hours = 1;
                }
                
                if($leave_status[$i] == 'PEN' || $leave_status[$i] == 'APV' || $leave_status[$i] == 'APVSYS'){
                    $get_available_leave_entitlement = $api->get_available_leave_entitlement($employee_id[$i], $leave_type[$i], $leave_date[$i]);

                    if($get_available_leave_entitlement > 0){
                        $insert_leave = $api->insert_leave($employee_id[$i], $leave_type[$i], $leave_date[$i], $start_time[$i], $end_time[$i], $leave_status[$i], $leave_reason[$i], $decision_date, $decision_time, $decision_by, $username);

                        if($insert_leave){
                            $update_leave_entitlement_count = $api->update_leave_entitlement_count($employee_id[$i], $leave_type[$i], $leave_date[$i], $total_hours, $username);
                        }
                    }
                }
                else{
                    $insert_leave = $api->insert_leave($employee_id[$i], $leave_type[$i], $leave_date[$i], $start_time[$i], $end_time[$i], $leave_status[$i], $leave_reason[$i], $decision_date, $decision_time, $decision_by, $username);
                }
            }

            echo 'Imported';
        }
    }
    # -------------------------------------------------------------

    # Import attendance adjustment
    else if($transaction == 'import attendance adjustment'){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            $file_type = '';
            $username = $_POST['username'];

            $import_file_name = $_FILES['import_file']['name'];
            $import_file_size = $_FILES['import_file']['size'];
            $import_file_error = $_FILES['import_file']['error'];
            $import_file_tmp_name = $_FILES['import_file']['tmp_name'];
            $import_file_ext = explode('.', $import_file_name);
            $import_file_actual_ext = strtolower(end($import_file_ext));

            $upload_setting_details = $api->get_upload_setting_details(16);
            $upload_file_type_details = $api->get_upload_file_type_details(16);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            if(in_array($import_file_actual_ext, $allowed_ext)){
                if(!$import_file_error){
                    if($import_file_size < $file_max_size){
                        $truncate_temporary_attendance_adjustment_table = $api->truncate_temporary_attendance_adjustment_table();

                        if($truncate_temporary_attendance_adjustment_table){
                            $file = fopen($import_file_tmp_name, 'r');
                            fgetcsv($file);
    
                            while (($column = fgetcsv($file, 0, ',')) !== FALSE) { 
                                $request_id = $column[0];
                                $employee_id = $column[1];
                                $attendance_id = $column[2];
                                $time_in_date_adjusted = $api->check_date('empty', $column[3], '', 'Y-m-d', '', '', '');
                                $time_in_adjusted = $api->check_date('empty', $column[4], '', 'H:i:s', '', '', '');
                                $time_out_date_adjusted = $api->check_date('empty', $column[5], '', 'Y-m-d', '', '', '');
                                $time_out_adjusted = $api->check_date('empty', $column[6], '', 'H:i:s', '', '', '');
                                $status = $column[7];
                                $reason = $column[8];
                                $file_path = $column[9];
                                $sanction = $column[10];
                                $request_date = $api->check_date('empty', $column[11], '', 'Y-m-d', '', '', '');
                                $request_time = $api->check_date('empty', $column[12], '', 'H:i:s', '', '', '');
                                $for_recommendation_date = $api->check_date('empty', $column[13], '', 'Y-m-d', '', '', '');
                                $for_recommendation_time = $api->check_date('empty', $column[14], '', 'H:i:s', '', '', '');
                                $recommendation_date = $api->check_date('empty', $column[15], '', 'Y-m-d', '', '', '');
                                $recommendation_time = $api->check_date('empty', $column[16], '', 'H:i:s', '', '', '');
                                $recommended_by = $column[17];
                                $decision_remarks = $column[18];
                                $decision_date = $api->check_date('empty', $column[19], '', 'Y-m-d', '', '', '');
                                $decision_time = $api->check_date('empty', $column[20], '', 'H:i:s', '', '', '');
                                $decision_by = $column[21];

                                if(!empty($employee_id) && !empty($attendance_id) && !empty($status) && !empty($reason) && !empty($file_path) && !empty($request_date) && !empty($request_time)){
                                    $insert_temporary_attendance_adjustment = $api->insert_temporary_attendance_adjustment($request_id, $employee_id, $attendance_id, $time_in_date_adjusted, $time_in_adjusted, $time_out_date_adjusted, $time_out_adjusted, $status, $reason, $file_path, $sanction, $request_date, $request_time, $for_recommendation_date, $for_recommendation_time, $recommendation_date, $recommendation_time, $recommended_by, $decision_remarks, $decision_date, $decision_time, $decision_by);
                                }
                            }

                            echo 'Imported';
                        }
                        else{
                            echo $truncate_temporary_attendance_adjustment_table;
                        }
                    }
                    else{
                        echo 'File Size';
                    }
                }
                else{
                    echo 'There was an error uploading the file.';
                }
            }
            else{
                echo 'File Type';
            }
        }
    }
    # -------------------------------------------------------------

    # Import attendance adjustment data
    else if($transaction == 'import attendance adjustment data'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && isset($_POST['employee_id']) && isset($_POST['attendance_id']) && isset($_POST['time_in_date_adjusted']) && isset($_POST['time_in_adjusted']) && isset($_POST['time_out_date_adjusted']) && isset($_POST['time_out_adjusted']) && isset($_POST['status']) && isset($_POST['reason']) && isset($_POST['file_path']) && isset($_POST['sanction']) && isset($_POST['request_date']) && isset($_POST['request_time']) && isset($_POST['for_recommendation_date']) && isset($_POST['for_recommendation_time']) && isset($_POST['recommendation_date']) && isset($_POST['recommendation_time']) && isset($_POST['recommended_by']) && isset($_POST['decision_remarks']) && isset($_POST['decision_date']) && isset($_POST['decision_time']) && isset($_POST['decision_by'])){
            $username = $_POST['username'];
            $request_id = $_POST['request_id'];
            $employee_id = $_POST['employee_id'];
            $attendance_id = $_POST['attendance_id'];
            $time_in_date_adjusted = $_POST['time_in_date_adjusted'];
            $time_in_adjusted = $_POST['time_in_adjusted'];
            $time_out_date_adjusted = $_POST['time_out_date_adjusted'];
            $time_out_adjusted = $_POST['time_out_adjusted'];
            $status = $_POST['status'];
            $reason = $_POST['reason'];
            $file_path = $_POST['file_path'];
            $sanction = $_POST['sanction'];
            $request_date = $_POST['request_date'];
            $request_time = $_POST['request_time'];
            $for_recommendation_date = $_POST['for_recommendation_date'];
            $for_recommendation_time = $_POST['for_recommendation_time'];
            $recommendation_date = $_POST['recommendation_date'];
            $recommendation_time = $_POST['recommendation_time'];
            $recommended_by = $_POST['recommended_by'];
            $decision_remarks = $_POST['decision_remarks'];
            $decision_date = $_POST['decision_date'];
            $decision_time = $_POST['decision_time'];
            $decision_by = $_POST['decision_by'];

            for($i = 0; $i < count($employee_id); $i++){
                $get_employee_attendance_details = $api->get_employee_attendance_details($attendance_id[$i]);
                $time_in_date_default = $api->check_date('empty', $get_employee_attendance_details[0]['TIME_IN_DATE'], '', 'Y-m-d', '', '', '');
                $time_in_default = $api->check_date('empty', $get_employee_attendance_details[0]['TIME_IN'], '', 'H:i:00', '', '', '');
                $time_out_date_default = $api->check_date('empty', $get_employee_attendance_details[0]['TIME_OUT_DATE'], '', 'Y-m-d', '', '', '');
                $time_out_default = $api->check_date('empty', $get_employee_attendance_details[0]['TIME_OUT'], '', 'H:i:00', '', '', '');
                
                if(!empty($time_in_date_adjusted[$i])){
                    $time_in_date_adjustment = $time_in_date_adjusted[$i];
                }
                else{
                    $time_in_date_adjustment = $time_in_date_default;
                }
                
                if(!empty($time_in_adjusted[$i])){
                    $time_in_adjustment = $time_in_adjusted[$i];
                }
                else{
                    $time_in_adjustment = $time_in_default;
                }
                
                if(!empty($time_out_date_adjusted[$i])){
                    $time_out_date_adjustment = $time_out_date_adjusted[$i];
                }
                else{
                    $time_out_date_adjustment = $time_out_date_default;
                }
                
                if(!empty($time_out_adjusted[$i])){
                    $time_out_adjustment = $time_out_adjusted[$i];
                }
                else{
                    $time_out_adjustment = $time_out_default;
                }

                $check_attendance_validation = $api->check_attendance_validation($time_in_date_adjustment, $time_in_adjustment, $time_out_date_adjustment, $time_out_adjustment);

                if(empty($check_attendance_validation)){
                    $check_attendance_adjustment_exist = $api->check_attendance_adjustment_exist($request_id[$i]);
    
                    if($check_attendance_adjustment_exist > 0){
                        $update_attendance_adjustment = $api->update_attendance_adjustment($request_id[$i], $time_in_date_adjustment, $time_in_adjustment, $time_out_date_adjustment, $time_out_adjustment, $reason[$i], $username);
                    }
                    else{
                        $insert_imported_attendance_adjustment = $api->insert_imported_attendance_adjustment($employee_id[$i], $attendance_id[$i], $time_in_date_default, $time_in_default, $time_in_date_adjustment, $time_in_adjustment, $time_out_date_default, $time_out_default, $time_out_date_adjustment, $time_out_adjustment, $status[$i], $reason[$i], $file_path[$i], $sanction[$i], $request_date[$i], $request_time[$i], $for_recommendation_date[$i], $for_recommendation_time[$i], $recommendation_date[$i], $recommendation_time[$i], $recommended_by[$i], $decision_remarks[$i], $decision_date[$i], $decision_time[$i], $decision_by[$i], $username);
                    }
                }
            }

            echo 'Imported';
        }
    }
    # -------------------------------------------------------------

    # Import attendance creation
    else if($transaction == 'import attendance creation'){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            $file_type = '';
            $username = $_POST['username'];

            $import_file_name = $_FILES['import_file']['name'];
            $import_file_size = $_FILES['import_file']['size'];
            $import_file_error = $_FILES['import_file']['error'];
            $import_file_tmp_name = $_FILES['import_file']['tmp_name'];
            $import_file_ext = explode('.', $import_file_name);
            $import_file_actual_ext = strtolower(end($import_file_ext));

            $upload_setting_details = $api->get_upload_setting_details(16);
            $upload_file_type_details = $api->get_upload_file_type_details(16);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            if(in_array($import_file_actual_ext, $allowed_ext)){
                if(!$import_file_error){
                    if($import_file_size < $file_max_size){
                        $truncate_temporary_attendance_creation_table = $api->truncate_temporary_attendance_creation_table();

                        if($truncate_temporary_attendance_creation_table){
                            $file = fopen($import_file_tmp_name, 'r');
                            fgetcsv($file);
    
                            while (($column = fgetcsv($file, 0, ',')) !== FALSE) { 
                                $request_id = $column[0];
                                $employee_id = $column[1];
                                $time_in_date = $api->check_date('empty', $column[2], '', 'Y-m-d', '', '', '');
                                $time_in = $api->check_date('empty', $column[3], '', 'H:i:s', '', '', '');
                                $time_out_date = $api->check_date('empty', $column[4], '', 'Y-m-d', '', '', '');
                                $time_out = $api->check_date('empty', $column[5], '', 'H:i:s', '', '', '');
                                $status = $column[6];
                                $reason = $column[7];
                                $file_path = $column[8];
                                $sanction = $column[9];
                                $request_date = $api->check_date('empty', $column[10], '', 'Y-m-d', '', '', '');
                                $request_time = $api->check_date('empty', $column[11], '', 'H:i:s', '', '', '');
                                $for_recommendation_date = $api->check_date('empty', $column[12], '', 'Y-m-d', '', '', '');
                                $for_recommendation_time = $api->check_date('empty', $column[13], '', 'H:i:s', '', '', '');
                                $recommendation_date = $api->check_date('empty', $column[14], '', 'Y-m-d', '', '', '');
                                $recommendation_time = $api->check_date('empty', $column[15], '', 'H:i:s', '', '', '');
                                $recommended_by = $column[16];
                                $decision_remarks = $column[17];
                                $decision_date = $api->check_date('empty', $column[18], '', 'Y-m-d', '', '', '');
                                $decision_time = $api->check_date('empty', $column[19], '', 'H:i:s', '', '', '');
                                $decision_by = $column[20];

                                if(!empty($employee_id) && !empty($time_in_date) && !empty($time_in) && !empty($status) && !empty($reason) && !empty($file_path) && !empty($request_date) && !empty($request_time)){
                                    $insert_temporary_attendance_creation = $api->insert_temporary_attendance_creation($request_id, $employee_id, $time_in_date, $time_in, $time_out_date, $time_out, $status, $reason, $file_path, $sanction, $request_date, $request_time, $for_recommendation_date, $for_recommendation_time, $recommendation_date, $recommendation_time, $recommended_by, $decision_remarks, $decision_date, $decision_time, $decision_by);
                                }
                            }

                            echo 'Imported';
                        }
                        else{
                            echo $truncate_temporary_attendance_creation_table;
                        }
                    }
                    else{
                        echo 'File Size';
                    }
                }
                else{
                    echo 'There was an error uploading the file.';
                }
            }
            else{
                echo 'File Type';
            }
        }
    }
    # -------------------------------------------------------------

    # Import attendance creation data
    else if($transaction == 'import attendance creation data'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && isset($_POST['employee_id']) && isset($_POST['time_in_date']) && isset($_POST['time_in']) && isset($_POST['time_out_date']) && isset($_POST['time_out']) && isset($_POST['status']) && isset($_POST['reason']) && isset($_POST['file_path']) && isset($_POST['sanction']) && isset($_POST['request_date']) && isset($_POST['request_time']) && isset($_POST['for_recommendation_date']) && isset($_POST['for_recommendation_time']) && isset($_POST['recommendation_date']) && isset($_POST['recommendation_time']) && isset($_POST['recommended_by']) && isset($_POST['decision_remarks']) && isset($_POST['decision_date']) && isset($_POST['decision_time']) && isset($_POST['decision_by'])){
            $username = $_POST['username'];
            $request_id = $_POST['request_id'];
            $employee_id = $_POST['employee_id'];
            $time_in_date = $_POST['time_in_date'];
            $time_in = $_POST['time_in'];
            $time_out_date = $_POST['time_out_date'];
            $time_out = $_POST['time_out'];
            $status = $_POST['status'];
            $reason = $_POST['reason'];
            $file_path = $_POST['file_path'];
            $sanction = $_POST['sanction'];
            $request_date = $_POST['request_date'];
            $request_time = $_POST['request_time'];
            $for_recommendation_date = $_POST['for_recommendation_date'];
            $for_recommendation_time = $_POST['for_recommendation_time'];
            $recommendation_date = $_POST['recommendation_date'];
            $recommendation_time = $_POST['recommendation_time'];
            $recommended_by = $_POST['recommended_by'];
            $decision_remarks = $_POST['decision_remarks'];
            $decision_date = $_POST['decision_date'];
            $decision_time = $_POST['decision_time'];
            $decision_by = $_POST['decision_by'];

            for($i = 0; $i < count($employee_id); $i++){
                $check_attendance_validation = $api->check_attendance_validation($time_in_date[$i], $time_in[$i], $time_out_date[$i], $time_out[$i]);

                if(empty($check_attendance_validation)){
                    $check_attendance_creation_exist = $api->check_attendance_creation_exist($request_id[$i]);
    
                    if($check_attendance_creation_exist > 0){
                        $update_attendance_creation = $api->update_attendance_creation($request_id[$i], $time_in_date[$i], $time_in[$i], $time_out_date[$i], $time_out[$i], $reason[$i], $username);
                    }
                    else{
                        $insert_imported_attendance_creation = $api->insert_imported_attendance_creation($employee_id[$i], $time_in_date[$i], $time_in[$i], $time_out_date[$i], $time_out[$i], $status[$i], $reason[$i], $file_path[$i], $sanction[$i], $request_date[$i], $request_time[$i], $for_recommendation_date[$i], $for_recommendation_time[$i], $recommendation_date[$i], $recommendation_time[$i], $recommended_by[$i], $decision_remarks[$i], $decision_date[$i], $decision_time[$i], $decision_by[$i], $username);
                    }
                }
                else{
                    echo $check_attendance_validation;
                }
            }

            echo 'Imported';
        }
    }
    # -------------------------------------------------------------

    # Import allowance
    else if($transaction == 'import allowance'){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            $file_type = '';
            $username = $_POST['username'];

            $import_file_name = $_FILES['import_file']['name'];
            $import_file_size = $_FILES['import_file']['size'];
            $import_file_error = $_FILES['import_file']['error'];
            $import_file_tmp_name = $_FILES['import_file']['tmp_name'];
            $import_file_ext = explode('.', $import_file_name);
            $import_file_actual_ext = strtolower(end($import_file_ext));

            $upload_setting_details = $api->get_upload_setting_details(15);
            $upload_file_type_details = $api->get_upload_file_type_details(15);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            if(in_array($import_file_actual_ext, $allowed_ext)){
                if(!$import_file_error){
                    if($import_file_size < $file_max_size){
                        $truncate_temporary_allowance_table = $api->truncate_temporary_allowance_table();

                        if($truncate_temporary_allowance_table){
                            $file = fopen($import_file_tmp_name, 'r');
                            fgetcsv($file);
    
                            while (($column = fgetcsv($file, 0, ',')) !== FALSE) { 
                                $allowance_id = $column[0];
                                $employee_id = $column[1];
                                $allowance_type = $column[2];
                                $payroll_id = $column[3];
                                $payroll_date = $api->check_date('empty', $column[4], '', 'Y-m-d', '', '', '');
                                $amount = $column[5];

                                if(!empty($employee_id) && !empty($allowance_type) && !empty($payroll_date) && !empty($amount)){
                                    $insert_temporary_allowance = $api->insert_temporary_allowance($allowance_id, $employee_id, $allowance_type, $payroll_id, $payroll_date, $amount);
                                }
                            }

                            echo 'Imported';
                        }
                        else{
                            echo $truncate_temporary_allowance_table;
                        }
                    }
                    else{
                        echo 'File Size';
                    }
                }
                else{
                    echo 'There was an error uploading the file.';
                }
            }
            else{
                echo 'File Type';
            }
        }
    }
    # -------------------------------------------------------------

    # Import allowance data
    else if($transaction == 'import allowance data'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['allowance_id']) && isset($_POST['employee_id']) && isset($_POST['allowance_type']) && isset($_POST['payroll_id']) && isset($_POST['payroll_date']) && isset($_POST['amount'])){
            $username = $_POST['username'];
            $allowance_id = $_POST['allowance_id'];
            $employee_id = $_POST['employee_id'];
            $allowance_type = $_POST['allowance_type'];
            $payroll_id = $_POST['payroll_id'];
            $payroll_date = $_POST['payroll_date'];
            $amount = $_POST['amount'];

            for($i = 0; $i < count($employee_id); $i++){
                $check_allowance_exist = $api->check_allowance_exist($allowance_id[$i]);

                if($check_allowance_exist > 0){
                    $update_allowance = $api->update_allowance($allowance_id[$i], $payroll_date[$i], $amount[$i], $username);
                }
                else{
                    $insert_allowance = $api->insert_allowance($employee_id[$i], $allowance_type[$i], $payroll_date[$i], $amount[$i], $username);
                }
            }

            echo 'Imported';
        }
    }
    # -------------------------------------------------------------

    # Import deduction
    else if($transaction == 'import deduction'){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            $file_type = '';
            $username = $_POST['username'];

            $import_file_name = $_FILES['import_file']['name'];
            $import_file_size = $_FILES['import_file']['size'];
            $import_file_error = $_FILES['import_file']['error'];
            $import_file_tmp_name = $_FILES['import_file']['tmp_name'];
            $import_file_ext = explode('.', $import_file_name);
            $import_file_actual_ext = strtolower(end($import_file_ext));

            $upload_setting_details = $api->get_upload_setting_details(15);
            $upload_file_type_details = $api->get_upload_file_type_details(15);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            if(in_array($import_file_actual_ext, $allowed_ext)){
                if(!$import_file_error){
                    if($import_file_size < $file_max_size){
                        $truncate_temporary_deduction_table = $api->truncate_temporary_deduction_table();

                        if($truncate_temporary_deduction_table){
                            $file = fopen($import_file_tmp_name, 'r');
                            fgetcsv($file);
    
                            while (($column = fgetcsv($file, 0, ',')) !== FALSE) { 
                                $deduction_id = $column[0];
                                $employee_id = $column[1];
                                $deduction_type = $column[2];
                                $payroll_id = $column[3];
                                $payroll_date = $api->check_date('empty', $column[4], '', 'Y-m-d', '', '', '');
                                $amount = $column[5];

                                if(!empty($employee_id) && !empty($deduction_type) && !empty($payroll_date) && !empty($amount)){
                                    $insert_temporary_deduction = $api->insert_temporary_deduction($deduction_id, $employee_id, $deduction_type, $payroll_id, $payroll_date, $amount);
                                }
                            }

                            echo 'Imported';
                        }
                        else{
                            echo $truncate_temporary_deduction_table;
                        }
                    }
                    else{
                        echo 'File Size';
                    }
                }
                else{
                    echo 'There was an error uploading the file.';
                }
            }
            else{
                echo 'File Type';
            }
        }
    }
    # -------------------------------------------------------------

    # Import deduction data
    else if($transaction == 'import deduction data'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['deduction_id']) && isset($_POST['employee_id']) && isset($_POST['deduction_type']) && isset($_POST['payroll_id']) && isset($_POST['payroll_date']) && isset($_POST['amount'])){
            $username = $_POST['username'];
            $deduction_id = $_POST['deduction_id'];
            $employee_id = $_POST['employee_id'];
            $deduction_type = $_POST['deduction_type'];
            $payroll_id = $_POST['payroll_id'];
            $payroll_date = $_POST['payroll_date'];
            $amount = $_POST['amount'];

            for($i = 0; $i < count($employee_id); $i++){
                $check_deduction_exist = $api->check_deduction_exist($deduction_id[$i]);

                if($check_deduction_exist > 0){
                    $update_deduction = $api->update_deduction($deduction_id[$i], $payroll_date[$i], $amount[$i], $username);
                }
                else{
                    $insert_deduction = $api->insert_deduction($employee_id[$i], $deduction_type[$i], $payroll_date[$i], $amount[$i], $username);
                }
            }

            echo 'Imported';
        }
    }
    # -------------------------------------------------------------

    # Import government contribution
    else if($transaction == 'import government contribution'){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            $file_type = '';
            $username = $_POST['username'];

            $import_file_name = $_FILES['import_file']['name'];
            $import_file_size = $_FILES['import_file']['size'];
            $import_file_error = $_FILES['import_file']['error'];
            $import_file_tmp_name = $_FILES['import_file']['tmp_name'];
            $import_file_ext = explode('.', $import_file_name);
            $import_file_actual_ext = strtolower(end($import_file_ext));

            $upload_setting_details = $api->get_upload_setting_details(15);
            $upload_file_type_details = $api->get_upload_file_type_details(15);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            if(in_array($import_file_actual_ext, $allowed_ext)){
                if(!$import_file_error){
                    if($import_file_size < $file_max_size){
                        $truncate_temporary_government_contribution_table = $api->truncate_temporary_government_contribution_table();

                        if($truncate_temporary_government_contribution_table){
                            $file = fopen($import_file_tmp_name, 'r');
                            fgetcsv($file);
    
                            while (($column = fgetcsv($file, 0, ',')) !== FALSE) { 
                                $government_contribution_id = $column[0];
                                $government_contribution = $column[1];
                                $description = $column[2];

                                if(!empty($government_contribution) && !empty($description)){
                                    $insert_temporary_government_contribution = $api->insert_temporary_government_contribution($government_contribution_id, $government_contribution, $description);
                                }
                            }

                            echo 'Imported';
                        }
                        else{
                            echo $truncate_temporary_government_contribution_table;
                        }
                    }
                    else{
                        echo 'File Size';
                    }
                }
                else{
                    echo 'There was an error uploading the file.';
                }
            }
            else{
                echo 'File Type';
            }
        }
    }
    # -------------------------------------------------------------

    # Import government contribution data
    else if($transaction == 'import government contribution data'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['government_contribution_id']) && isset($_POST['government_contribution']) && isset($_POST['description'])){
            $username = $_POST['username'];
            $government_contribution_id = $_POST['government_contribution_id'];
            $government_contribution = $_POST['government_contribution'];
            $description = $_POST['description'];

            for($i = 0; $i < count($government_contribution); $i++){
                $check_government_contribution_exist = $api->check_government_contribution_exist($government_contribution_id[$i]);

                if($check_government_contribution_exist > 0){
                    $update_government_contribution = $api->update_government_contribution($government_contribution_id[$i], $government_contribution[$i], $description[$i], $username);
                }
                else{
                    $insert_government_contribution = $api->insert_government_contribution($government_contribution[$i], $description[$i], $username);
                }
            }

            echo 'Imported';
        }
    }
    # -------------------------------------------------------------

    # Import contribution bracket
    else if($transaction == 'import contribution bracket'){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            $file_type = '';
            $username = $_POST['username'];

            $import_file_name = $_FILES['import_file']['name'];
            $import_file_size = $_FILES['import_file']['size'];
            $import_file_error = $_FILES['import_file']['error'];
            $import_file_tmp_name = $_FILES['import_file']['tmp_name'];
            $import_file_ext = explode('.', $import_file_name);
            $import_file_actual_ext = strtolower(end($import_file_ext));

            $upload_setting_details = $api->get_upload_setting_details(15);
            $upload_file_type_details = $api->get_upload_file_type_details(15);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            if(in_array($import_file_actual_ext, $allowed_ext)){
                if(!$import_file_error){
                    if($import_file_size < $file_max_size){
                        $truncate_temporary_contribution_bracket_table = $api->truncate_temporary_contribution_bracket_table();

                        if($truncate_temporary_contribution_bracket_table){
                            $file = fopen($import_file_tmp_name, 'r');
                            fgetcsv($file);
    
                            while (($column = fgetcsv($file, 0, ',')) !== FALSE) { 
                                $contribution_bracket_id = $column[0];
                                $government_contribution_id = $column[1];
                                $start_range = $column[2];
                                $end_range = $column[3];
                                $deduction_amount = $column[4];

                                if(!empty($government_contribution_id) && !empty($start_range) && !empty($end_range) && !empty($deduction_amount)){
                                    $insert_temporary_contribution_bracket = $api->insert_temporary_contribution_bracket($contribution_bracket_id, $government_contribution_id, $start_range, $end_range, $deduction_amount);
                                }
                            }

                            echo 'Imported';
                        }
                        else{
                            echo $truncate_temporary_contribution_bracket_table;
                        }
                    }
                    else{
                        echo 'File Size';
                    }
                }
                else{
                    echo 'There was an error uploading the file.';
                }
            }
            else{
                echo 'File Type';
            }
        }
    }
    # -------------------------------------------------------------

    # Import contribution bracket data
    else if($transaction == 'import contribution bracket data'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['contribution_bracket_id']) && isset($_POST['government_contribution_id']) && isset($_POST['start_range']) && isset($_POST['end_range']) && isset($_POST['deduction_amount'])){
            $username = $_POST['username'];
            $contribution_bracket_id = $_POST['contribution_bracket_id'];
            $government_contribution_id = $_POST['government_contribution_id'];
            $start_range = $_POST['start_range'];
            $end_range = $_POST['end_range'];
            $deduction_amount = $_POST['deduction_amount'];

            for($i = 0; $i < count($government_contribution_id); $i++){
                $check_contribution_bracket_exist = $api->check_contribution_bracket_exist($contribution_bracket_id[$i]);

                if($check_contribution_bracket_exist > 0){
                    $check_start_contribution_bracket_range_overlap = $api->check_contribution_bracket_overlap($contribution_bracket_id[$i], $government_contribution_id[$i], $start_range[$i]);
                    $check_end_contribution_bracket_range_overlap = $api->check_contribution_bracket_overlap($contribution_bracket_id[$i], $government_contribution_id[$i], $end_range[$i]);

                    if($check_start_contribution_bracket_range_overlap == 0 && $check_end_contribution_bracket_range_overlap == 0){
                        $update_contribution_bracket = $api->update_contribution_bracket($contribution_bracket_id[$i], $start_range[$i], $end_range[$i], $deduction_amount[$i], $username);
                    }
                }
                else{
                    $check_start_contribution_bracket_range_overlap = $api->check_contribution_bracket_overlap(null, $government_contribution_id[$i], $start_range[$i]);
                    $check_end_contribution_bracket_range_overlap = $api->check_contribution_bracket_overlap(null, $government_contribution_id[$i], $end_range[$i]);

                    if($check_start_contribution_bracket_range_overlap == 0 && $check_end_contribution_bracket_range_overlap == 0){
                        $insert_contribution_bracket = $api->insert_contribution_bracket($government_contribution_id[$i], $start_range[$i], $end_range[$i], $deduction_amount[$i], $username);
                    }
                }
            }

            echo 'Imported';
        }
    }
    # -------------------------------------------------------------

    # Import contribution deduction
    else if($transaction == 'import contribution deduction'){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            $file_type = '';
            $username = $_POST['username'];

            $import_file_name = $_FILES['import_file']['name'];
            $import_file_size = $_FILES['import_file']['size'];
            $import_file_error = $_FILES['import_file']['error'];
            $import_file_tmp_name = $_FILES['import_file']['tmp_name'];
            $import_file_ext = explode('.', $import_file_name);
            $import_file_actual_ext = strtolower(end($import_file_ext));

            $upload_setting_details = $api->get_upload_setting_details(15);
            $upload_file_type_details = $api->get_upload_file_type_details(15);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            if(in_array($import_file_actual_ext, $allowed_ext)){
                if(!$import_file_error){
                    if($import_file_size < $file_max_size){
                        $truncate_temporary_contribution_deduction_table = $api->truncate_temporary_contribution_deduction_table();

                        if($truncate_temporary_contribution_deduction_table){
                            $file = fopen($import_file_tmp_name, 'r');
                            fgetcsv($file);
    
                            while (($column = fgetcsv($file, 0, ',')) !== FALSE) { 
                                $contribution_deduction_id = $column[0];
                                $employee_id = $column[1];
                                $government_contribution_type = $column[2];
                                $payroll_id = $column[3];
                                $payroll_date = $api->check_date('empty', $column[4], '', 'Y-m-d', '', '', '');

                                if(!empty($employee_id) && !empty($government_contribution_type) && !empty($payroll_date)){
                                    $insert_temporary_contribution_deduction = $api->insert_temporary_contribution_deduction($contribution_deduction_id, $employee_id, $government_contribution_type, $payroll_id, $payroll_date);
                                }
                            }

                            echo 'Imported';
                        }
                        else{
                            echo $truncate_temporary_contribution_deduction_table;
                        }
                    }
                    else{
                        echo 'File Size';
                    }
                }
                else{
                    echo 'There was an error uploading the file.';
                }
            }
            else{
                echo 'File Type';
            }
        }
    }
    # -------------------------------------------------------------

    # Import contribution deduction data
    else if($transaction == 'import contribution deduction data'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['contribution_deduction_id']) && isset($_POST['employee_id']) && isset($_POST['government_contribution_type']) && isset($_POST['payroll_id']) && isset($_POST['payroll_date'])){
            $username = $_POST['username'];
            $contribution_deduction_id = $_POST['contribution_deduction_id'];
            $employee_id = $_POST['employee_id'];
            $government_contribution_type = $_POST['government_contribution_type'];
            $payroll_id = $_POST['payroll_id'];
            $payroll_date = $_POST['payroll_date'];

            for($i = 0; $i < count($employee_id); $i++){
                $check_contribution_deduction_exist = $api->check_contribution_deduction_exist($contribution_deduction_id[$i]);

                if($check_contribution_deduction_exist > 0){
                    $update_contribution_deduction = $api->update_contribution_deduction($contribution_deduction_id[$i], $payroll_date[$i], $username);
                }
                else{
                    $insert_contribution_deduction = $api->insert_contribution_deduction($employee_id[$i], $government_contribution_type[$i], $payroll_date[$i], $username);
                }
            }

            echo 'Imported';
        }
    }
    # -------------------------------------------------------------

    # Import withholding tax
    else if($transaction == 'import withholding tax'){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            $file_type = '';
            $username = $_POST['username'];

            $import_file_name = $_FILES['import_file']['name'];
            $import_file_size = $_FILES['import_file']['size'];
            $import_file_error = $_FILES['import_file']['error'];
            $import_file_tmp_name = $_FILES['import_file']['tmp_name'];
            $import_file_ext = explode('.', $import_file_name);
            $import_file_actual_ext = strtolower(end($import_file_ext));

            $upload_setting_details = $api->get_upload_setting_details(18);
            $upload_file_type_details = $api->get_upload_file_type_details(18);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            if(in_array($import_file_actual_ext, $allowed_ext)){
                if(!$import_file_error){
                    if($import_file_size < $file_max_size){
                        $truncate_temporary_withholding_tax_table = $api->truncate_temporary_withholding_tax_table();

                        if($truncate_temporary_withholding_tax_table){
                            $file = fopen($import_file_tmp_name, 'r');
                            fgetcsv($file);
    
                            while (($column = fgetcsv($file, 0, ',')) !== FALSE) { 
                                $withholding_tax_id = $column[0];
                                $salary_frequency = $column[1];
                                $start_range = $column[2];
                                $end_range = $column[3];
                                $fix_compensation_level = $column[4];
                                $base_tax = $column[5];
                                $percent_over = $column[6];

                                if(!empty($salary_frequency) && !empty($start_range) && !empty($end_range)){
                                    $insert_temporary_withholding_tax = $api->insert_temporary_withholding_tax($withholding_tax_id, $salary_frequency, $start_range, $end_range, $fix_compensation_level, $base_tax, $percent_over);
                                }
                            }

                            echo 'Imported';
                        }
                        else{
                            echo $truncate_temporary_withholding_tax_table;
                        }
                    }
                    else{
                        echo 'File Size';
                    }
                }
                else{
                    echo 'There was an error uploading the file.';
                }
            }
            else{
                echo 'File Type';
            }
        }
    }
    # -------------------------------------------------------------

    # Import withholding tax data
    else if($transaction == 'import withholding tax data'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['withholding_tax_id']) && isset($_POST['salary_frequency']) && isset($_POST['start_range']) && isset($_POST['end_range']) && isset($_POST['fix_compensation_level']) && isset($_POST['base_tax']) && isset($_POST['percent_over'])){
            $username = $_POST['username'];
            $withholding_tax_id = $_POST['withholding_tax_id'];
            $salary_frequency = $_POST['salary_frequency'];
            $start_range = $_POST['start_range'];
            $end_range = $_POST['end_range'];
            $fix_compensation_level = $_POST['fix_compensation_level'];
            $base_tax = $_POST['base_tax'];
            $percent_over = $_POST['percent_over'];

            for($i = 0; $i < count($salary_frequency); $i++){
                $check_withholding_tax_exist = $api->check_withholding_tax_exist($withholding_tax_id[$i]);

                if($check_withholding_tax_exist > 0){
                    $check_start_withholding_tax_range_overlap = $api->check_withholding_tax_overlap($withholding_tax_id[$i], $salary_frequency[$i], $start_range[$i]);
                    $check_end_withholding_tax_range_overlap = $api->check_withholding_tax_overlap($withholding_tax_id[$i], $salary_frequency[$i], $end_range[$i]);
    
                    if($check_start_withholding_tax_range_overlap == 0 && $check_end_withholding_tax_range_overlap == 0){
                        $update_withholding_tax = $api->update_withholding_tax($withholding_tax_id[$i], $salary_frequency[$i], $start_range[$i], $end_range[$i], $fix_compensation_level[$i], $base_tax[$i], $percent_over[$i], $username);
                    }
                }
                else{
                    $check_start_withholding_tax_range_overlap = $api->check_withholding_tax_overlap(null, $salary_frequency[$i], $start_range[$i]);
                    $check_end_withholding_tax_range_overlap = $api->check_withholding_tax_overlap(null, $salary_frequency[$i], $end_range[$i]);
    
                    if($check_start_withholding_tax_range_overlap == 0 && $check_end_withholding_tax_range_overlap == 0){
                        $insert_withholding_tax = $api->insert_withholding_tax($salary_frequency[$i], $start_range[$i], $end_range[$i], $fix_compensation_level[$i], $base_tax[$i], $percent_over[$i], $username);
                    }
                }
            }

            echo 'Imported';
        }
    }
    # -------------------------------------------------------------

    # Import other income
    else if($transaction == 'import other income'){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            $file_type = '';
            $username = $_POST['username'];

            $import_file_name = $_FILES['import_file']['name'];
            $import_file_size = $_FILES['import_file']['size'];
            $import_file_error = $_FILES['import_file']['error'];
            $import_file_tmp_name = $_FILES['import_file']['tmp_name'];
            $import_file_ext = explode('.', $import_file_name);
            $import_file_actual_ext = strtolower(end($import_file_ext));

            $upload_setting_details = $api->get_upload_setting_details(19);
            $upload_file_type_details = $api->get_upload_file_type_details(19);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            if(in_array($import_file_actual_ext, $allowed_ext)){
                if(!$import_file_error){
                    if($import_file_size < $file_max_size){
                        $truncate_temporary_other_income_table = $api->truncate_temporary_other_income_table();

                        if($truncate_temporary_other_income_table){
                            $file = fopen($import_file_tmp_name, 'r');
                            fgetcsv($file);
    
                            while (($column = fgetcsv($file, 0, ',')) !== FALSE) { 
                                $other_income_id = $column[0];
                                $employee_id = $column[1];
                                $other_income_type = $column[2];
                                $payroll_id = $column[3];
                                $payroll_date = $api->check_date('empty', $column[4], '', 'Y-m-d', '', '', '');
                                $amount = $column[5];

                                if(!empty($employee_id) && !empty($other_income_type) && !empty($payroll_date) && !empty($amount)){
                                    $insert_temporary_other_income = $api->insert_temporary_other_income($other_income_id, $employee_id, $other_income_type, $payroll_id, $payroll_date, $amount);
                                }
                            }

                            echo 'Imported';
                        }
                        else{
                            echo $truncate_temporary_other_income_table;
                        }
                    }
                    else{
                        echo 'File Size';
                    }
                }
                else{
                    echo 'There was an error uploading the file.';
                }
            }
            else{
                echo 'File Type';
            }
        }
    }
    # -------------------------------------------------------------

    # Import other income data
    else if($transaction == 'import other income data'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['other_income_id']) && isset($_POST['employee_id']) && isset($_POST['other_income_type']) && isset($_POST['payroll_id']) && isset($_POST['payroll_date']) && isset($_POST['amount'])){
            $username = $_POST['username'];
            $other_income_id = $_POST['other_income_id'];
            $employee_id = $_POST['employee_id'];
            $other_income_type = $_POST['other_income_type'];
            $payroll_id = $_POST['payroll_id'];
            $payroll_date = $_POST['payroll_date'];
            $amount = $_POST['amount'];

            for($i = 0; $i < count($employee_id); $i++){
                $check_other_income_exist = $api->check_other_income_exist($other_income_id[$i]);

                if($check_other_income_exist > 0){
                    $update_other_income = $api->update_other_income($other_income_id[$i], $payroll_date[$i], $amount[$i], $username);
                }
                else{
                    $insert_other_income = $api->insert_other_income($employee_id[$i], $other_income_type[$i], $payroll_date[$i], $amount[$i], $username);
                }
            }

            echo 'Imported';
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Truncate transactions
    # -------------------------------------------------------------

    # Truncate temporary table
    else if($transaction == 'truncate temporary table'){
        if(isset($_POST['table_name']) && !empty($_POST['table_name'])){
            $file_type = '';
            $table_name = $_POST['table_name'];

            if($table_name == 'import employee'){
                $truncate_table = $api->truncate_temporary_employee_table();
            }
            else if($table_name == 'import attendance record'){
                $truncate_table = $api->truncate_temporary_attendance_record_table();
            }
            else if($table_name == 'import leave entitlement'){
                $truncate_table = $api->truncate_temporary_leave_entitlement_table();
            }
            else if($table_name == 'import leave'){
                $truncate_table = $api->truncate_temporary_leave_table();
            }
            else if($table_name == 'import attendance adjustment'){
                $truncate_table = $api->truncate_temporary_attendance_adjustment_table();
            }
            else if($table_name == 'import attendance creation'){
                $truncate_table = $api->truncate_temporary_attendance_creation_table();
            }
            else if($table_name == 'import allowance'){
                $truncate_table = $api->truncate_temporary_allowance_table();
            }
            else if($table_name == 'import other income'){
                $truncate_table = $api->truncate_temporary_other_income_table();
            }
            else if($table_name == 'import deduction'){
                $truncate_table = $api->truncate_temporary_deduction_table();
            }
            else if($table_name == 'import government contribution'){
                $truncate_table = $api->truncate_temporary_government_contribution_table();
            }
            else if($table_name == 'import contribution bracket'){
                $truncate_table = $api->truncate_temporary_contribution_bracket_table();
            }
            else if($table_name == 'import contribution deduction'){
                $truncate_table = $api->truncate_temporary_contribution_deduction_table();
            }
            else if($table_name == 'import withholding tax'){
                $truncate_table = $api->truncate_temporary_withholding_tax_table();
            }
            else{
                $truncate_table = 1;
            }

            if($truncate_table){
                echo 'Truncated';
            }
            else{
                echo $truncate_table;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Submit transactions
    # -------------------------------------------------------------

    # Submit system parameter
    else if($transaction == 'submit system parameter'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['parameter_id']) && isset($_POST['parameter']) && !empty($_POST['parameter']) && isset($_POST['extension']) && isset($_POST['parameter_number'])){
            $username = $_POST['username'];
            $parameter_id = $_POST['parameter_id'];
            $parameter = $_POST['parameter'];
            $extension = $_POST['extension'];
            $parameter_number = $api->check_number($_POST['parameter_number']);

            $check_system_parameter_exist = $api->check_system_parameter_exist($parameter_id);

            if($check_system_parameter_exist > 0){
                $update_system_parameter = $api->update_system_parameter($parameter_id, $parameter, $extension, $parameter_number, $username);
                                        
                if($update_system_parameter){
                    echo 'Updated';
                }
                else{
                    echo $update_system_parameter;
                }
            }
            else{
                $insert_system_parameter = $api->insert_system_parameter($parameter, $extension, $parameter_number, $username);
                        
                if($insert_system_parameter){
                    echo 'Inserted';
                }
                else{
                    echo $insert_system_parameter;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit policy
    else if($transaction == 'submit policy'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['policy_id']) && isset($_POST['policy']) && !empty($_POST['policy']) && isset($_POST['description']) && !empty($_POST['description'])){
            $username = $_POST['username'];
            $policy_id = $_POST['policy_id'];
            $policy = $_POST['policy'];
            $description = $_POST['description'];

            $check_policy_exist = $api->check_policy_exist($policy_id);

            if($check_policy_exist > 0){
                $update_policy = $api->update_policy($policy, $policy_id, $description, $username);

                if($update_policy){
                    echo 'Updated';
                }
                else{
                    echo $update_policy;
                }
            }
            else{
                $insert_policy = $api->insert_policy($policy, $description, $username);

                if($insert_policy){
                    echo 'Inserted';
                }
                else{
                    echo $insert_policy;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit permission
    else if($transaction == 'submit permission'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['permission_id']) && isset($_POST['policy_id']) && !empty($_POST['policy_id']) && isset($_POST['permission']) && !empty($_POST['permission'])){
            $username = $_POST['username'];
            $permission_id = $_POST['permission_id'];
            $policy_id = $_POST['policy_id'];
            $permission = $_POST['permission'];

            $check_permission_exist = $api->check_permission_exist($permission_id);

            if($check_permission_exist > 0){
                $update_permission = $api->update_permission($permission_id, $policy_id, $permission, $username);

                if($update_permission){
                    echo 'Updated';
                }
                else{
                    echo $update_permission;
                }
            }
            else{
                $insert_permission = $api->insert_permission($policy_id, $permission, $username);

                if($insert_permission){
                    echo 'Inserted';
                }
                else{
                    echo $insert_permission;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit role
    else if($transaction == 'submit role'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['role_id']) && isset($_POST['role']) && !empty($_POST['role']) && isset($_POST['description']) && !empty($_POST['description'])){
            $username = $_POST['username'];
            $role_id = $_POST['role_id'];
            $role = $_POST['role'];
            $description = $_POST['description'];

            $check_role_exist = $api->check_role_exist($role_id);

            if($check_role_exist > 0){
                $update_role = $api->update_role($role_id, $role, $description, $username);

                if($update_role){
                    echo 'Updated';
                }
                else{
                    echo $update_role;
                }
            }
            else{
                $insert_role = $api->insert_role($role, $description, $username);

                if($insert_role){
                    echo 'Inserted';
                }
                else{
                    echo $insert_role;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit role permission
    else if($transaction == 'submit role permission'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['role_id']) && !empty($_POST['role_id']) && isset($_POST['permission'])){
            $error = '';
            $username = $_POST['username'];
            $role_id = $_POST['role_id'];
            $permissions = explode(',', $_POST['permission']);
            $role_details = $api->get_role_details($role_id);
            $transaction_log_id = $role_details[0]['TRANSACTION_LOG_ID'];

            $check_role_exist = $api->check_role_exist($role_id);

            if($check_role_exist){
                $delete_permission_role = $api->delete_permission_role($role_id, $username);

                if($delete_permission_role){
                    foreach($permissions as $permission){
                        $insert_permission_role = $api->insert_permission_role($role_id, $permission, $username);

                        if(!$insert_permission_role){
                            $error = $insert_permission_role;
                        }
                    }

                    if(empty($error)){
                        $insert_transaction_log = $api->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated role permission (' . $role_id . ').');
                                    
                        if($insert_transaction_log){
                            echo 'Assigned';
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        echo $error;
                    }
                }
                else{
                    echo $delete_permission_role;
                }
            }
            else{
               echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Submit system code
    else if($transaction == 'submit system code'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['system_type']) && !empty($_POST['system_type']) && isset($_POST['system_code']) && !empty($_POST['system_code']) && isset($_POST['system_description']) && !empty($_POST['system_description'])){
            $username = $_POST['username'];
            $system_type = $_POST['system_type'];
            $system_code = $_POST['system_code'];
            $system_description = $_POST['system_description'];

            $check_system_code_exist = $api->check_system_code_exist($system_type, $system_code);
            
            if($check_system_code_exist > 0){
                $update_system_code = $api->update_system_code($system_type, $system_code, $system_description, $username);
                                    
                if($update_system_code){
                    echo 'Updated';
                }
                else{
                    echo $update_system_code;
                }
            }
            else{
                $insert_system_code = $api->insert_system_code($system_type, $system_code, $system_description, $username);
                        
                if($insert_system_code){
                    echo 'Inserted';
                }
                else{
                    echo $insert_system_code;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit user interface setting
    else if($transaction == 'submit user interface setting'){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            $error = '';
            $username = $_POST['username'];
            $setting_id = 1;

            $check_user_interface_settings_exist = $api->check_user_interface_settings_exist($setting_id);

            if($check_user_interface_settings_exist > 0){
                $login_bg_upload = $api->check_user_interface_upload($_FILES['login_bg'], 'login background', $setting_id, $username);

                if($login_bg_upload){
                    $logo_light_upload = $api->check_user_interface_upload($_FILES['logo_light'], 'logo light', $setting_id, $username);

                    if($logo_light_upload){
                        $logo_dark_upload = $api->check_user_interface_upload($_FILES['logo_dark'], 'logo dark', $setting_id, $username);

                        if($logo_dark_upload){
                            $logo_icon_light_upload = $api->check_user_interface_upload($_FILES['login_icon_light'], 'logo icon light', $setting_id, $username);

                            if($logo_icon_light_upload){
                                $logo_icon_dark_upload = $api->check_user_interface_upload($_FILES['login_icon_dark'], 'logo icon dark', $setting_id, $username);

                                if($logo_icon_dark_upload){
                                    $favicon_upload = $api->check_user_interface_upload($_FILES['favicon_image'], 'favicon image', $setting_id, $username);

                                    if($favicon_upload){
                                        echo 'Updated';
                                    }
                                    else{
                                        echo $favicon_upload;
                                    }
                                }
                                else{
                                    echo $logo_icon_dark_upload;
                                }
                            }
                            else{
                                echo $logo_icon_light_upload;
                            }
                        }
                        else{
                            echo $logo_dark_upload;
                        }
                    }
                    else{
                        echo $logo_light_upload;
                    }
                }
                else{
                    echo $login_bg_upload;
                }
            }
            else{
                $insert_user_interface_settings = $api->insert_user_interface_settings($setting_id, $username);

                if($insert_user_interface_settings){
                    $login_bg_upload = $api->check_user_interface_upload($_FILES['login_bg'], 'login background', $setting_id, $username);

                    if($login_bg_upload){
                        $logo_light_upload = $api->check_user_interface_upload($_FILES['logo_light'], 'logo light', $setting_id, $username);
    
                        if($logo_light_upload){
                            $logo_dark_upload = $api->check_user_interface_upload($_FILES['logo_dark'], 'logo dark', $setting_id, $username);
    
                            if($logo_dark_upload){
                                $logo_icon_light_upload = $api->check_user_interface_upload($_FILES['login_icon_light'], 'logo icon light', $setting_id, $username);
    
                                if($logo_icon_light_upload){
                                    $logo_icon_dark_upload = $api->check_user_interface_upload($_FILES['login_icon_dark'], 'logo icon dark', $setting_id, $username);
    
                                    if($logo_icon_dark_upload){
                                        $favicon_upload = $api->check_user_interface_upload($_FILES['favicon_image'], 'favicon image', $setting_id, $username);
    
                                        if($favicon_upload){
                                            echo 'Inserted';
                                        }
                                        else{
                                            echo $favicon_upload;
                                        }
                                    }
                                    else{
                                        echo $logo_icon_dark_upload;
                                    }
                                }
                                else{
                                    echo $logo_icon_light_upload;
                                }
                            }
                            else{
                                echo $logo_dark_upload;
                            }
                        }
                        else{
                            echo $logo_light_upload;
                        }
                    }
                    else{
                        echo $login_bg_upload;
                    }
                }
                else{
                    echo $insert_user_interface_settings;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit email configuration
    else if($transaction == 'submit email configuration'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['mail_host']) && !empty($_POST['mail_host']) && isset($_POST['port']) && !empty($_POST['port']) && isset($_POST['smtp_auth']) && isset($_POST['smtp_auto_tls']) && isset($_POST['mail_user']) && !empty($_POST['mail_user']) && isset($_POST['mail_password']) && isset($_POST['mail_encryption']) && !empty($_POST['mail_encryption']) && isset($_POST['mail_from_name']) && !empty($_POST['mail_from_name']) && isset($_POST['mail_from_email']) && !empty($_POST['mail_from_email'])){
            $username = $_POST['username'];
            $mail_id = 1;
            $mail_host = $_POST['mail_host'];
            $port = $_POST['port'];
            $smtp_auth = $_POST['smtp_auth'];
            $smtp_auto_tls = $_POST['smtp_auto_tls'];
            $mail_user = $_POST['mail_user'];
            $mail_password = $api->encrypt_data($_POST['mail_password']);
            $mail_encryption = $_POST['mail_encryption'];
            $mail_from_name = $_POST['mail_from_name'];
            $mail_from_email = $_POST['mail_from_email'];

            $check_mail_configuration_exist = $api->check_mail_configuration_exist($mail_id);

            if($check_mail_configuration_exist > 0){
                $update_email_configuration = $api->update_email_configuration($mail_id, $mail_host, $port, $smtp_auth, $smtp_auto_tls, $mail_user, $mail_password, $mail_encryption, $mail_from_name, $mail_from_email, $username);

                if($update_email_configuration){
                    echo 'Updated';
                }
                else{
                    echo $update_email_configuration;
                }
            }
            else{
                $insert_email_configuration = $api->insert_email_configuration($mail_id, $mail_host, $port, $smtp_auth, $smtp_auto_tls, $mail_user, $mail_password, $mail_encryption, $mail_from_name, $mail_from_email, $username);

                if($insert_email_configuration){
                    echo 'Inserted';
                }
                else{
                    echo $insert_email_configuration;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit notification type
    else if($transaction == 'submit notification type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['notification_id']) && isset($_POST['notification']) && !empty($_POST['notification']) && isset($_POST['description']) && !empty($_POST['description'])){
            $username = $_POST['username'];
            $notification_id = $_POST['notification_id'];
            $notification = $_POST['notification'];
            $description = $_POST['description'];

            $check_notification_type_exist = $api->check_notification_type_exist($notification_id);

            if($check_notification_type_exist > 0){
                $update_notification_type = $api->update_notification_type($notification_id, $notification, $description, $username);

                if($update_notification_type){
                    echo 'Updated';
                }
                else{
                    echo $update_notification_type;
                }
            }
            else{
                $insert_notification_type = $api->insert_notification_type($notification, $description, $username);

                if($insert_notification_type){
                    echo 'Inserted';
                }
                else{
                    echo $insert_notification_type;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit notification details
    else if($transaction == 'submit notification details'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['notification_id']) && !empty($_POST['notification_id']) && isset($_POST['notification_title']) && !empty($_POST['notification_title']) && isset($_POST['notification_message']) && !empty($_POST['notification_message']) && isset($_POST['system_link']) && !empty($_POST['system_link']) && isset($_POST['web_link']) && !empty($_POST['web_link']) && isset($_POST['notification_recipient'])){
            $username = $_POST['username'];
            $notification_id = $_POST['notification_id'];
            $notification_title = $_POST['notification_title'];
            $notification_message = $_POST['notification_message'];
            $system_link = $_POST['system_link'];
            $web_link = $_POST['web_link'];

            $notification_recipients = explode(',', $_POST['notification_recipient']);

            $check_notification_details_exist = $api->check_notification_details_exist($notification_id);

            if($check_notification_details_exist > 0){
                $update_notification_details = $api->update_notification_details($notification_id, $notification_title, $notification_message, $system_link, $web_link, $username);

                if($update_notification_details){
                    $delete_notification_recipient = $api->delete_notification_recipient($notification_id);

                    if($delete_notification_recipient){
                        foreach($notification_recipients as $notification_recipient){
                            $insert_notification_recipient = $api->insert_notification_recipient($notification_id, $notification_recipient, $username);
    
                            if(!$insert_notification_recipient){
                                $error = $insert_notification_recipient;
                            }
                        }
                    }
                    else{
                        $error = $delete_notification_recipient;
                    }
                }
                else{
                    echo $update_notification_details;
                }
            }
            else{
                $insert_notification_details = $api->insert_notification_details($notification_id, $notification_title, $notification_message, $system_link, $web_link, $username);

                if($insert_notification_details){
                    foreach($notification_recipients as $notification_recipient){
                        $insert_notification_recipient = $api->insert_notification_recipient($notification_id, $notification_recipient, $username);

                        if(!$insert_notification_recipient){
                            $error = $insert_notification_recipient;
                        }
                    }
                }
                else{
                    echo $insert_notification_details;
                }
            }

            if(empty($error)){
                echo 'Updated';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Submit application notification
    else if($transaction == 'submit application notification'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['notification'])){
            $username = $_POST['username'];
            $notifications = explode(',', $_POST['notification']);
            $error = '';

            $delete_all_application_notification = $api->delete_all_application_notification($username);

            if($delete_all_application_notification){
                foreach($notifications as $notification){            
                    $notification_string = explode('-', $notification);
                    $notification_id = $notification_string[0];
                    $notification_type = $notification_string[1];

                    $insert_application_notification = $api->insert_application_notification($notification_id, $notification_type, $username);

                    if(!$insert_application_notification){
                        $error = $insert_application_notification;
                    }
                }

                if(empty($error)){
                    echo 'Assigned';
                }
                else{
                    echo $error;
                }
            }
            else{
                echo $delete_all_application_notification;
            }
        }
    }
    # -------------------------------------------------------------

    # Submit company setting
    else if($transaction == 'submit company setting'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['company_name']) && !empty($_POST['company_name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['telephone']) && isset($_POST['website']) && isset($_POST['province']) && !empty($_POST['province']) && isset($_POST['city']) && !empty($_POST['city']) && isset($_POST['address']) && !empty($_POST['address'])){
            $file_type = '';
            $username = $_POST['username'];
            $company_id = 1;
            $company_name = $_POST['company_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $telephone = $_POST['telephone'];
            $website = $_POST['website'];
            $province = $_POST['province'];
            $city = $_POST['city'];
            $address = $_POST['address'];

            $company_logo_file_name = $_FILES['company_logo']['name'];
            $company_logo_file_size = $_FILES['company_logo']['size'];
            $company_logo_file_error = $_FILES['company_logo']['error'];
            $company_logo_file_tmp_name = $_FILES['company_logo']['tmp_name'];
            $company_logo_file_ext = explode('.', $company_logo_file_name);
            $company_logo_file_actual_ext = strtolower(end($company_logo_file_ext));

            $upload_setting_details = $api->get_upload_setting_details(20);
            $upload_file_type_details = $api->get_upload_file_type_details(20);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            $check_company_setting_exist = $api->check_company_setting_exist($company_id);

            if($check_company_setting_exist > 0){
                if(!empty($company_logo_file_tmp_name)){
                    if(in_array($company_logo_file_actual_ext, $allowed_ext)){
                        if(!$company_logo_file_error){
                            if($company_logo_file_size < $file_max_size){
                                $update_company_setting = $api->update_company_setting($company_id, $company_name, $email, $telephone, $phone, $website, $address, $province, $city, $username);
    
                                if($update_company_setting){
                                    $update_company_logo_file = $api->update_company_logo_file($company_logo_file_tmp_name, $company_logo_file_actual_ext, $company_id, $username);
            
                                    if($update_company_logo_file){
                                        echo 'Updated';
                                    }
                                    else{
                                        echo $update_company_logo_file;
                                    }
                                }
                                else{
                                    echo $update_company_setting;
                                }
                            }
                            else{
                                echo 'File Size';
                            }
                        }
                        else{
                            echo 'There was an error uploading the file.';
                        }
                    }
                    else{
                        echo 'File Type';
                    }
                }
                else{
                    $update_company_setting = $api->update_company_setting($company_id, $company_name, $email, $telephone, $phone, $website, $address, $province, $city, $username);

                    if($update_company_setting){
                        echo 'Updated';
                    }
                    else{
                        echo $update_company_setting;
                    }
                }
            }
            else{
                if(!empty($company_logo_file_tmp_name)){
                    if(in_array($company_logo_file_actual_ext, $allowed_ext)){
                        if(!$company_logo_file_error){
                            if($company_logo_file_size < $file_max_size){
                                $insert_company_setting = $api->insert_company_setting($company_id, $company_name, $email, $telephone, $phone, $website, $address, $province, $city, $username);
    
                                if($insert_company_setting){
                                    $update_company_logo_file = $api->update_company_logo_file($company_logo_file_tmp_name, $company_logo_file_actual_ext, $company_id, $username);
            
                                    if($update_company_logo_file){
                                        echo 'Updated';
                                    }
                                    else{
                                        echo $update_company_logo_file;
                                    }
                                }
                                else{
                                    echo $insert_company_setting;
                                }
                            }
                            else{
                                echo 'File Size';
                            }
                        }
                        else{
                            echo 'There was an error uploading the file.';
                        }
                    }
                    else{
                        echo 'File Type';
                    }
                }
                else{
                    $insert_company_setting = $api->insert_company_setting($company_id, $company_name, $email, $telephone, $phone, $website, $address, $province, $city, $username);

                    if($insert_company_setting){
                        echo 'Updated';
                    }
                    else{
                        echo $insert_company_setting;
                    }
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit department
    else if($transaction == 'submit department'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['department_id']) && isset($_POST['department']) && !empty($_POST['department']) && isset($_POST['description']) && !empty($_POST['description']) && isset($_POST['department_head']) && isset($_POST['parent_department'])){
            $username = $_POST['username'];
            $department_id = $_POST['department_id'];
            $department = $_POST['department'];
            $department_head = $_POST['department_head'];
            $parent_department = $_POST['parent_department'];
            $description = $_POST['description'];

            $check_department_exist = $api->check_department_exist($department_id);

            if($check_department_exist > 0){
                $update_department = $api->update_department($department_id, $department, $description, $department_head, $parent_department, $username);

                if($update_department){
                    echo 'Updated';
                }
                else{
                    echo $update_department;
                }
            }
            else{
                $insert_department = $api->insert_department($department, $description, $department_head, $parent_department, $username);

                if($insert_department){
                    echo 'Inserted';
                }
                else{
                    echo $insert_department;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit designation
    else if($transaction == 'submit designation'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['designation_id']) && isset($_POST['designation']) && !empty($_POST['designation']) && isset($_POST['description']) && !empty($_POST['description'])){
            $file_type = '';
            $username = $_POST['username'];
            $designation_id = $_POST['designation_id'];
            $designation = $_POST['designation'];
            $description = $_POST['description'];

            $job_description_name = $_FILES['job_description']['name'];
            $job_description_size = $_FILES['job_description']['size'];
            $job_description_error = $_FILES['job_description']['error'];
            $job_description_tmp_name = $_FILES['job_description']['tmp_name'];
            $job_description_ext = explode('.', $job_description_name);
            $job_description_actual_ext = strtolower(end($job_description_ext));

            $upload_setting_details = $api->get_upload_setting_details(7);
            $upload_file_type_details = $api->get_upload_file_type_details(7);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            $check_designation_exist = $api->check_designation_exist($designation_id);
 
            if($check_designation_exist > 0){
                if(!empty($job_description_tmp_name)){
                    if(in_array($job_description_actual_ext, $allowed_ext)){
                        if(!$job_description_error){
                            if($job_description_size < $file_max_size){
                                $update_designation_file = $api->update_designation_file($job_description_tmp_name, $job_description_actual_ext, $designation_id, $username);
        
                                if($update_designation_file){
                                    $update_designation = $api->update_designation($designation_id, $designation, $description, $username);

                                    if($update_designation){
                                        echo 'Updated';
                                    }
                                    else{
                                        echo $update_designation;
                                    }
                                }
                                else{
                                    echo $update_designation_file;
                                }
                            }
                            else{
                                echo 'File Size';
                            }
                        }
                        else{
                            echo 'There was an error uploading the file.';
                        }
                    }
                    else{
                        echo 'File Type';
                    }
                }
                else{
                    $update_designation = $api->update_designation($designation_id, $designation, $description, $username);

                    if($update_designation){
                        echo 'Updated';
                    }
                    else{
                        echo $update_designation;
                    }
                }
            }
            else{
                if(!empty($job_description_tmp_name)){
                    if(in_array($job_description_actual_ext, $allowed_ext)){
                        if(!$job_description_error){
                            if($job_description_size < $file_max_size){
                                $insert_designation = $api->insert_designation($job_description_tmp_name, $job_description_actual_ext, $designation, $description, $username);

                                if($insert_designation){
                                    echo 'Inserted';
                                }
                                else{
                                    echo $insert_designation;
                                }
                            }
                            else{
                                echo 'File Size';
                            }
                        }
                        else{
                            echo 'There was an error uploading the file.';
                        }
                    }
                    else{
                        echo 'File Type';
                    }
                }
                else{
                    $insert_designation = $api->insert_designation('', '', $designation, $description, $username);

                    if($insert_designation){
                        echo 'Inserted';
                    }
                    else{
                        echo $insert_designation;
                    }
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit branch
    else if($transaction == 'submit branch'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['branch_id']) && isset($_POST['branch']) && !empty($_POST['branch']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['telephone']) && isset($_POST['address']) && !empty($_POST['address'])){
            $username = $_POST['username'];
            $branch_id = $_POST['branch_id'];
            $branch = $_POST['branch'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $telephone = $_POST['telephone'];
            $address = $_POST['address'];

            $check_branch_exist = $api->check_branch_exist($branch_id);

            if($check_branch_exist > 0){
                $update_branch = $api->update_branch($branch_id, $branch, $email, $phone, $telephone, $address, $username);

                if($update_branch){
                    echo 'Updated';
                }
                else{
                    echo $update_branch;
                }
            }
            else{
                $insert_branch = $api->insert_branch($branch, $email, $phone, $telephone, $address, $username);

                if($insert_branch){
                    echo 'Inserted';
                }
                else{
                    echo $insert_branch;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit upload setting
    else if($transaction == 'submit upload setting'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['upload_setting_id']) && isset($_POST['upload_setting']) && !empty($_POST['upload_setting']) && isset($_POST['description']) && !empty($_POST['description']) && isset($_POST['max_file_size']) && !empty($_POST['max_file_size']) && isset($_POST['file_type']) && !empty($_POST['file_type'])){
            $error = '';
            $username = $_POST['username'];
            $upload_setting_id = $_POST['upload_setting_id'];
            $upload_setting = $_POST['upload_setting'];
            $description = $_POST['description'];
            $max_file_size = $api->remove_comma($_POST['max_file_size']);
            $file_types = explode(',', $_POST['file_type']);

            $check_upload_setting_exist = $api->check_upload_setting_exist($upload_setting_id);

            if($check_upload_setting_exist > 0){
                $update_upload_setting = $api->update_upload_setting($upload_setting_id, $upload_setting, $description, $max_file_size, $username);

                if($update_upload_setting){
                    $delete_all_upload_file_type = $api->delete_all_upload_file_type($upload_setting_id, $username);

                    if($delete_all_upload_file_type){
                        foreach($file_types as $file_type){
                            $insert_upload_file_type = $api->insert_upload_file_type($upload_setting_id, $file_type, $username);

                            if(!$insert_upload_file_type){
                                $error = $insert_upload_file_type;
                            }
                        }
                    }
                    else{
                        $error = $delete_all_upload_file_type;
                    }

                    if(empty($error)){
                        echo 'Updated';
                    }
                    else{
                        echo $error;
                    }
                }
                else{
                    echo $update_upload_setting;
                }
            }
            else{
                $insert_upload_setting = $api->insert_upload_setting($upload_setting, $description, $max_file_size, $file_types, $username);

                if($insert_upload_setting){
                    echo 'Inserted';
                }
                else{
                    echo $insert_upload_setting;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit employment status
    else if($transaction == 'submit employment status'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employment_status_id']) && isset($_POST['employment_status']) && !empty($_POST['employment_status']) && isset($_POST['color_value']) && !empty($_POST['color_value']) && isset($_POST['color_value']) && !empty($_POST['description'])){
            $username = $_POST['username'];
            $employment_status_id = $_POST['employment_status_id'];
            $employment_status = $_POST['employment_status'];
            $color_value = $_POST['color_value'];
            $description = $_POST['description'];

            $check_employment_status_exist = $api->check_employment_status_exist($employment_status_id);

            if($check_employment_status_exist > 0){
                $update_employment_status = $api->update_employment_status($employment_status_id, $employment_status, $color_value, $description, $username);

                if($update_employment_status){
                    echo 'Updated';
                }
                else{
                    echo $update_employment_status;
                }
            }
            else{
                $insert_employment_status = $api->insert_employment_status($employment_status, $color_value, $description, $username);

                if($insert_employment_status){
                    echo 'Inserted';
                }
                else{
                    echo $insert_employment_status;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit employee
    else if($transaction == 'submit employee'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employee_id']) && isset($_POST['id_number']) && !empty($_POST['id_number']) && isset($_POST['joining_date']) && !empty($_POST['joining_date']) && isset($_POST['permanency_date']) && isset($_POST['exit_date']) && isset($_POST['first_name']) && !empty($_POST['first_name']) && isset($_POST['middle_name']) && isset($_POST['last_name']) && !empty($_POST['last_name']) && isset($_POST['department']) && !empty($_POST['department']) && isset($_POST['designation']) && !empty($_POST['designation']) && isset($_POST['branch']) && !empty($_POST['branch']) && isset($_POST['employment_status']) && !empty($_POST['employment_status']) && isset($_POST['email']) && isset($_POST['phone']) && !empty($_POST['phone']) && isset($_POST['telephone']) && isset($_POST['gender']) && !empty($_POST['gender']) && isset($_POST['birthday']) && !empty($_POST['birthday'])){
            $username = $_POST['username'];
            $employee_id = $_POST['employee_id'];
            $id_number = $_POST['id_number'];
            $joining_date = $api->check_date('empty', $_POST['joining_date'], '', 'Y-m-d', '', '', '');
            $permanency_date = $api->check_date('empty', $_POST['permanency_date'], '', 'Y-m-d', '', '', '');
            $exit_date = $api->check_date('empty', $_POST['exit_date'], '', 'Y-m-d', '', '', '');
            $exit_reason = $_POST['exit_reason'];
            $first_name = $_POST['first_name'];
            $middle_name = $_POST['middle_name'];
            $last_name = $_POST['last_name'];
            $suffix = $_POST['suffix'];
            $file_as = $api->get_file_as_format($first_name, $middle_name, $last_name, $suffix);
            $department = $_POST['department'];
            $designation = $_POST['designation'];
            $branch = $_POST['branch'];
            $employment_status = $_POST['employment_status'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $telephone = $_POST['telephone'];
            $gender = $_POST['gender'];
            $birthday = $api->check_date('empty', $_POST['birthday'], '', 'Y-m-d', '', '', '');

            $check_employee_exist = $api->check_employee_exist($employee_id);

            if($check_employee_exist > 0){
                $update_employee = $api->update_employee($employee_id, $file_as, $first_name, $middle_name, $last_name, $suffix, $birthday, $employment_status, $joining_date, $permanency_date, $exit_date, $exit_reason, $email, $phone, $telephone, $department, $designation, $branch, $gender, $username);

                if($update_employee){
                    echo 'Updated';
                }
                else{
                    echo $update_employee;
                }
            }
            else{
                $check_employee_id_number_exist = $api->check_employee_id_number_exist($id_number);

                if($check_employee_id_number_exist == 0){
                    $insert_employee = $api->insert_employee($id_number, $file_as, $first_name, $middle_name, $last_name, $suffix, $birthday, $employment_status, $joining_date, $permanency_date, $exit_date, $exit_reason, $email, $phone, $telephone, $department, $designation, $branch, $gender, $username);

                    if($insert_employee){
                        echo 'Inserted';
                    }
                    else{
                        echo $insert_employee;
                    }
                }
                else{
                    echo 'ID Number Exist';
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit emergency contact
    else if($transaction == 'submit emergency contact'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['contact_id']) && isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['contact_name']) && !empty($_POST['contact_name']) && isset($_POST['relationship']) && !empty($_POST['relationship']) && isset($_POST['address']) && !empty($_POST['address']) && isset($_POST['province']) && !empty($_POST['province']) && isset($_POST['city']) && !empty($_POST['city']) && isset($_POST['phone']) && !empty($_POST['phone']) && isset($_POST['email']) && isset($_POST['telephone'])){
            $username = $_POST['username'];
            $contact_id = $_POST['contact_id'];
            $employee_id = $_POST['employee_id'];
            $contact_name = $_POST['contact_name'];
            $relationship = $_POST['relationship'];
            $address = $_POST['address'];
            $province = $_POST['province'];
            $city = $_POST['city'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $telephone = $_POST['telephone'];

            $check_emergency_contact_exist = $api->check_emergency_contact_exist($contact_id);

            if($check_emergency_contact_exist > 0){
                $update_emergency_contact = $api->update_emergency_contact($contact_id, $contact_name, $relationship, $email, $phone, $telephone, $address, $city, $province, $username);

                if($update_emergency_contact){
                    echo 'Updated';
                }
                else{
                    echo $update_emergency_contact;
                }
            }
            else{
                $insert_emergency_contact = $api->insert_emergency_contact($employee_id, $contact_name, $relationship, $email, $phone, $telephone, $address, $city, $province, $username);

                if($insert_emergency_contact){
                    echo 'Inserted';
                }
                else{
                    echo $insert_emergency_contact;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit employee address
    else if($transaction == 'submit employee address'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['address_id']) && isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['address_type']) && !empty($_POST['address_type']) && isset($_POST['address']) && !empty($_POST['address']) && isset($_POST['province']) && !empty($_POST['province']) && isset($_POST['city']) && !empty($_POST['city'])){
            $username = $_POST['username'];
            $address_id = $_POST['address_id'];
            $employee_id = $_POST['employee_id'];
            $address_type = $_POST['address_type'];
            $address = $_POST['address'];
            $province = $_POST['province'];
            $city = $_POST['city'];

            $check_employee_address_exist = $api->check_employee_address_exist($address_id);

            if($check_employee_address_exist > 0){
                $update_employee_address = $api->update_employee_address($address_id, $address_type, $address, $city, $province, $username);

                if($update_employee_address){
                    echo 'Updated';
                }
                else{
                    echo $update_employee_address;
                }
            }
            else{
                $insert_employee_address = $api->insert_employee_address($employee_id, $address_type, $address, $city, $province, $username);

                if($insert_employee_address){
                    echo 'Inserted';
                }
                else{
                    echo $insert_employee_address;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit employee social
    else if($transaction == 'submit employee social'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['social_id']) && isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['social_type']) && !empty($_POST['social_type']) && isset($_POST['link']) && !empty($_POST['link'])){
            $username = $_POST['username'];
            $social_id = $_POST['social_id'];
            $employee_id = $_POST['employee_id'];
            $social_type = $_POST['social_type'];
            $link = $_POST['link'];

            $check_employee_social_exist = $api->check_employee_social_exist($social_id);

            if($check_employee_social_exist > 0){
                $update_employee_social = $api->update_employee_social($social_id, $social_type, $link, $username);

                if($update_employee_social){
                    echo 'Updated';
                }
                else{
                    echo $update_employee_social;
                }
            }
            else{
                $insert_employee_social = $api->insert_employee_social($employee_id, $social_type, $link, $username);

                if($insert_employee_social){
                    echo 'Inserted';
                }
                else{
                    echo $insert_employee_social;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit work shift
    else if($transaction == 'submit work shift'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['work_shift_id']) && isset($_POST['work_shift']) && !empty($_POST['work_shift']) && isset($_POST['work_shift_type']) && !empty($_POST['work_shift_type']) && isset($_POST['description']) && !empty($_POST['description'])){
            $username = $_POST['username'];
            $work_shift_id = $_POST['work_shift_id'];
            $work_shift = $_POST['work_shift'];
            $work_shift_type = $_POST['work_shift_type'];
            $description = $_POST['description'];

            $check_work_shift_exist = $api->check_work_shift_exist($work_shift_id);

            if($check_work_shift_exist > 0){
                $update_work_shift = $api->update_work_shift($work_shift_id, $work_shift, $work_shift_type, $description, $username);

                if($update_work_shift){
                    echo 'Updated';
                }
                else{
                    echo $update_work_shift;
                }
            }
            else{
                $insert_work_shift = $api->insert_work_shift($work_shift, $work_shift_type, $description, $username);

                if($insert_work_shift){
                    echo 'Inserted';
                }
                else{
                    echo $insert_work_shift;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit regular work shift schedule
    else if($transaction == 'submit regular work shift schedule'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['work_shift_id']) && isset($_POST['monday_start_time']) && isset($_POST['monday_end_time']) && isset($_POST['monday_lunch_start_time']) && isset($_POST['monday_lunch_end_time']) && isset($_POST['monday_half_day_mark']) && isset($_POST['tuesday_start_time']) && isset($_POST['tuesday_end_time']) && isset($_POST['tuesday_lunch_start_time']) && isset($_POST['tuesday_lunch_end_time']) && isset($_POST['tuesday_half_day_mark']) && isset($_POST['wednesday_start_time']) && isset($_POST['wednesday_end_time']) && isset($_POST['wednesday_lunch_start_time']) && isset($_POST['wednesday_lunch_end_time']) && isset($_POST['wednesday_half_day_mark']) && isset($_POST['thursday_start_time']) && isset($_POST['thursday_end_time']) && isset($_POST['thursday_lunch_start_time']) && isset($_POST['thursday_lunch_end_time']) && isset($_POST['thursday_half_day_mark']) && isset($_POST['friday_start_time']) && isset($_POST['friday_end_time']) && isset($_POST['friday_lunch_start_time']) && isset($_POST['friday_lunch_end_time']) && isset($_POST['friday_half_day_mark']) && isset($_POST['saturday_start_time']) && isset($_POST['saturday_end_time']) && isset($_POST['saturday_lunch_start_time']) && isset($_POST['saturday_lunch_end_time']) && isset($_POST['saturday_half_day_mark']) && isset($_POST['sunday_start_time']) && isset($_POST['sunday_end_time']) && isset($_POST['sunday_lunch_start_time']) && isset($_POST['sunday_lunch_end_time']) && isset($_POST['sunday_half_day_mark'])){
            $username = $_POST['username'];
            $work_shift_id = $_POST['work_shift_id'];
            $monday_start_time = $api->check_date('empty', $_POST['monday_start_time'], '', 'H:i:s', '', '', '');
            $monday_end_time = $api->check_date('empty', $_POST['monday_end_time'], '', 'H:i:s', '', '', '');
            $monday_lunch_start_time = $api->check_date('empty', $_POST['monday_lunch_start_time'], '', 'H:i:s', '', '', '');
            $monday_lunch_end_time = $api->check_date('empty', $_POST['monday_lunch_end_time'], '', 'H:i:s', '', '', '');
            $monday_half_day_mark = $api->check_date('empty', $_POST['monday_half_day_mark'], '', 'H:i:s', '', '', '');
            $tuesday_start_time = $api->check_date('empty', $_POST['tuesday_start_time'], '', 'H:i:s', '', '', '');
            $tuesday_end_time = $api->check_date('empty', $_POST['tuesday_end_time'], '', 'H:i:s', '', '', '');
            $tuesday_lunch_start_time = $api->check_date('empty', $_POST['tuesday_lunch_start_time'], '', 'H:i:s', '', '', '');
            $tuesday_lunch_end_time = $api->check_date('empty', $_POST['tuesday_lunch_end_time'], '', 'H:i:s', '', '', '');
            $tuesday_half_day_mark = $api->check_date('empty', $_POST['tuesday_half_day_mark'], '', 'H:i:s', '', '', '');
            $wednesday_start_time = $api->check_date('empty', $_POST['wednesday_start_time'], '', 'H:i:s', '', '', '');
            $wednesday_end_time = $api->check_date('empty', $_POST['wednesday_end_time'], '', 'H:i:s', '', '', '');
            $wednesday_lunch_start_time = $api->check_date('empty', $_POST['wednesday_lunch_start_time'], '', 'H:i:s', '', '', '');
            $wednesday_lunch_end_time = $api->check_date('empty', $_POST['wednesday_lunch_end_time'], '', 'H:i:s', '', '', '');
            $wednesday_half_day_mark = $api->check_date('empty', $_POST['wednesday_half_day_mark'], '', 'H:i:s', '', '', '');
            $thursday_start_time = $api->check_date('empty', $_POST['thursday_start_time'], '', 'H:i:s', '', '', '');
            $thursday_end_time = $api->check_date('empty', $_POST['thursday_end_time'], '', 'H:i:s', '', '', '');
            $thursday_lunch_start_time = $api->check_date('empty', $_POST['thursday_lunch_start_time'], '', 'H:i:s', '', '', '');
            $thursday_lunch_end_time = $api->check_date('empty', $_POST['thursday_lunch_end_time'], '', 'H:i:s', '', '', '');
            $thursday_half_day_mark = $api->check_date('empty', $_POST['thursday_half_day_mark'], '', 'H:i:s', '', '', '');
            $friday_start_time = $api->check_date('empty', $_POST['friday_start_time'], '', 'H:i:s', '', '', '');
            $friday_end_time = $api->check_date('empty', $_POST['friday_end_time'], '', 'H:i:s', '', '', '');
            $friday_lunch_start_time = $api->check_date('empty', $_POST['friday_lunch_start_time'], '', 'H:i:s', '', '', '');
            $friday_lunch_end_time = $api->check_date('empty', $_POST['friday_lunch_end_time'], '', 'H:i:s', '', '', '');
            $friday_half_day_mark = $api->check_date('empty', $_POST['friday_half_day_mark'], '', 'H:i:s', '', '', '');
            $saturday_start_time = $api->check_date('empty', $_POST['saturday_start_time'], '', 'H:i:s', '', '', '');
            $saturday_end_time = $api->check_date('empty', $_POST['saturday_end_time'], '', 'H:i:s', '', '', '');
            $saturday_lunch_start_time = $api->check_date('empty', $_POST['saturday_lunch_start_time'], '', 'H:i:s', '', '', '');
            $saturday_lunch_end_time = $api->check_date('empty', $_POST['saturday_lunch_end_time'], '', 'H:i:s', '', '', '');
            $saturday_half_day_mark = $api->check_date('empty', $_POST['saturday_half_day_mark'], '', 'H:i:s', '', '', '');
            $sunday_start_time = $api->check_date('empty', $_POST['sunday_start_time'], '', 'H:i:s', '', '', '');
            $sunday_end_time = $api->check_date('empty', $_POST['sunday_end_time'], '', 'H:i:s', '', '', '');
            $sunday_lunch_start_time = $api->check_date('empty', $_POST['sunday_lunch_start_time'], '', 'H:i:s', '', '', '');
            $sunday_lunch_end_time = $api->check_date('empty', $_POST['sunday_lunch_end_time'], '', 'H:i:s', '', '', '');
            $sunday_half_day_mark = $api->check_date('empty', $_POST['sunday_half_day_mark'], '', 'H:i:s', '', '', '');

            $check_work_shift_schedule_exist = $api->check_work_shift_schedule_exist($work_shift_id);

            if($check_work_shift_schedule_exist > 0){
                $update_work_shift_schedule = $api->update_work_shift_schedule($work_shift_id, null, null, $monday_start_time, $monday_end_time, $monday_lunch_start_time, $monday_lunch_end_time, $monday_half_day_mark, $tuesday_start_time, $tuesday_end_time, $tuesday_lunch_start_time, $tuesday_lunch_end_time, $tuesday_half_day_mark, $wednesday_start_time, $wednesday_end_time, $wednesday_lunch_start_time, $wednesday_lunch_end_time, $wednesday_half_day_mark, $thursday_start_time, $thursday_end_time, $thursday_lunch_start_time, $thursday_lunch_end_time, $thursday_half_day_mark, $friday_start_time, $friday_end_time, $friday_lunch_start_time, $friday_lunch_end_time, $friday_half_day_mark, $saturday_start_time, $saturday_end_time, $saturday_lunch_start_time, $saturday_lunch_end_time, $saturday_half_day_mark, $sunday_start_time, $sunday_end_time, $sunday_lunch_start_time, $sunday_lunch_end_time, $sunday_half_day_mark, $username);

                if($update_work_shift_schedule){
                    echo 'Updated';
                }
                else{
                    echo $update_work_shift_schedule;
                }
            }
            else{
                $insert_work_shift_schedule = $api->insert_work_shift_schedule($work_shift_id, null, null, $monday_start_time, $monday_end_time, $monday_lunch_start_time, $monday_lunch_end_time, $monday_half_day_mark, $tuesday_start_time, $tuesday_end_time, $tuesday_lunch_start_time, $tuesday_lunch_end_time, $tuesday_half_day_mark, $wednesday_start_time, $wednesday_end_time, $wednesday_lunch_start_time, $wednesday_lunch_end_time, $wednesday_half_day_mark, $thursday_start_time, $thursday_end_time, $thursday_lunch_start_time, $thursday_lunch_end_time, $thursday_half_day_mark, $friday_start_time, $friday_end_time, $friday_lunch_start_time, $friday_lunch_end_time, $friday_half_day_mark, $saturday_start_time, $saturday_end_time, $saturday_lunch_start_time, $saturday_lunch_end_time, $saturday_half_day_mark, $sunday_start_time, $sunday_end_time, $sunday_lunch_start_time, $sunday_lunch_end_time, $sunday_half_day_mark, $username);

                if($insert_work_shift_schedule){
                    echo 'Inserted';
                }
                else{
                    echo $insert_work_shift_schedule;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit scheduled work shift schedule
    else if($transaction == 'submit scheduled work shift schedule'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['work_shift_id']) && isset($_POST['start_date']) && !empty($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['end_date']) && isset($_POST['monday_start_time']) && isset($_POST['monday_end_time']) && isset($_POST['monday_lunch_start_time']) && isset($_POST['monday_lunch_end_time']) && isset($_POST['monday_half_day_mark']) && isset($_POST['tuesday_start_time']) && isset($_POST['tuesday_end_time']) && isset($_POST['tuesday_lunch_start_time']) && isset($_POST['tuesday_lunch_end_time']) && isset($_POST['tuesday_half_day_mark']) && isset($_POST['wednesday_start_time']) && isset($_POST['wednesday_end_time']) && isset($_POST['wednesday_lunch_start_time']) && isset($_POST['wednesday_lunch_end_time']) && isset($_POST['wednesday_half_day_mark']) && isset($_POST['thursday_start_time']) && isset($_POST['thursday_end_time']) && isset($_POST['thursday_lunch_start_time']) && isset($_POST['thursday_lunch_end_time']) && isset($_POST['thursday_half_day_mark']) && isset($_POST['friday_start_time']) && isset($_POST['friday_end_time']) && isset($_POST['friday_lunch_start_time']) && isset($_POST['friday_lunch_end_time']) && isset($_POST['friday_half_day_mark']) && isset($_POST['saturday_start_time']) && isset($_POST['saturday_end_time']) && isset($_POST['saturday_lunch_start_time']) && isset($_POST['saturday_lunch_end_time']) && isset($_POST['saturday_half_day_mark']) && isset($_POST['sunday_start_time']) && isset($_POST['sunday_end_time']) && isset($_POST['sunday_lunch_start_time']) && isset($_POST['sunday_lunch_end_time']) && isset($_POST['sunday_half_day_mark'])){
            $username = $_POST['username'];
            $work_shift_id = $_POST['work_shift_id'];
            $start_date = $api->check_date('empty', $_POST['start_date'], '', 'Y-m-d', '', '', '');
            $end_date = $api->check_date('empty', $_POST['end_date'], '', 'Y-m-d', '', '', '');
            $monday_start_time = $api->check_date('empty', $_POST['monday_start_time'], '', 'H:i:s', '', '', '');
            $monday_end_time = $api->check_date('empty', $_POST['monday_end_time'], '', 'H:i:s', '', '', '');
            $monday_lunch_start_time = $api->check_date('empty', $_POST['monday_lunch_start_time'], '', 'H:i:s', '', '', '');
            $monday_lunch_end_time = $api->check_date('empty', $_POST['monday_lunch_end_time'], '', 'H:i:s', '', '', '');
            $monday_half_day_mark = $api->check_date('empty', $_POST['monday_half_day_mark'], '', 'H:i:s', '', '', '');
            $tuesday_start_time = $api->check_date('empty', $_POST['tuesday_start_time'], '', 'H:i:s', '', '', '');
            $tuesday_end_time = $api->check_date('empty', $_POST['tuesday_end_time'], '', 'H:i:s', '', '', '');
            $tuesday_lunch_start_time = $api->check_date('empty', $_POST['tuesday_lunch_start_time'], '', 'H:i:s', '', '', '');
            $tuesday_lunch_end_time = $api->check_date('empty', $_POST['tuesday_lunch_end_time'], '', 'H:i:s', '', '', '');
            $tuesday_half_day_mark = $api->check_date('empty', $_POST['tuesday_half_day_mark'], '', 'H:i:s', '', '', '');
            $wednesday_start_time = $api->check_date('empty', $_POST['wednesday_start_time'], '', 'H:i:s', '', '', '');
            $wednesday_end_time = $api->check_date('empty', $_POST['wednesday_end_time'], '', 'H:i:s', '', '', '');
            $wednesday_lunch_start_time = $api->check_date('empty', $_POST['wednesday_lunch_start_time'], '', 'H:i:s', '', '', '');
            $wednesday_lunch_end_time = $api->check_date('empty', $_POST['wednesday_lunch_end_time'], '', 'H:i:s', '', '', '');
            $wednesday_half_day_mark = $api->check_date('empty', $_POST['wednesday_half_day_mark'], '', 'H:i:s', '', '', '');
            $thursday_start_time = $api->check_date('empty', $_POST['thursday_start_time'], '', 'H:i:s', '', '', '');
            $thursday_end_time = $api->check_date('empty', $_POST['thursday_end_time'], '', 'H:i:s', '', '', '');
            $thursday_lunch_start_time = $api->check_date('empty', $_POST['thursday_lunch_start_time'], '', 'H:i:s', '', '', '');
            $thursday_lunch_end_time = $api->check_date('empty', $_POST['thursday_lunch_end_time'], '', 'H:i:s', '', '', '');
            $thursday_half_day_mark = $api->check_date('empty', $_POST['thursday_half_day_mark'], '', 'H:i:s', '', '', '');
            $friday_start_time = $api->check_date('empty', $_POST['friday_start_time'], '', 'H:i:s', '', '', '');
            $friday_end_time = $api->check_date('empty', $_POST['friday_end_time'], '', 'H:i:s', '', '', '');
            $friday_lunch_start_time = $api->check_date('empty', $_POST['friday_lunch_start_time'], '', 'H:i:s', '', '', '');
            $friday_lunch_end_time = $api->check_date('empty', $_POST['friday_lunch_end_time'], '', 'H:i:s', '', '', '');
            $friday_half_day_mark = $api->check_date('empty', $_POST['friday_half_day_mark'], '', 'H:i:s', '', '', '');
            $saturday_start_time = $api->check_date('empty', $_POST['saturday_start_time'], '', 'H:i:s', '', '', '');
            $saturday_end_time = $api->check_date('empty', $_POST['saturday_end_time'], '', 'H:i:s', '', '', '');
            $saturday_lunch_start_time = $api->check_date('empty', $_POST['saturday_lunch_start_time'], '', 'H:i:s', '', '', '');
            $saturday_lunch_end_time = $api->check_date('empty', $_POST['saturday_lunch_end_time'], '', 'H:i:s', '', '', '');
            $saturday_half_day_mark = $api->check_date('empty', $_POST['saturday_half_day_mark'], '', 'H:i:s', '', '', '');
            $sunday_start_time = $api->check_date('empty', $_POST['sunday_start_time'], '', 'H:i:s', '', '', '');
            $sunday_end_time = $api->check_date('empty', $_POST['sunday_end_time'], '', 'H:i:s', '', '', '');
            $sunday_lunch_start_time = $api->check_date('empty', $_POST['sunday_lunch_start_time'], '', 'H:i:s', '', '', '');
            $sunday_lunch_end_time = $api->check_date('empty', $_POST['sunday_lunch_end_time'], '', 'H:i:s', '', '', '');
            $sunday_half_day_mark = $api->check_date('empty', $_POST['sunday_half_day_mark'], '', 'H:i:s', '', '', '');

            $check_work_shift_schedule_exist = $api->check_work_shift_schedule_exist($work_shift_id);

            if($check_work_shift_schedule_exist > 0){
                $update_work_shift_schedule = $api->update_work_shift_schedule($work_shift_id, $start_date, $end_date, $monday_start_time, $monday_end_time, $monday_lunch_start_time, $monday_lunch_end_time, $monday_half_day_mark, $tuesday_start_time, $tuesday_end_time, $tuesday_lunch_start_time, $tuesday_lunch_end_time, $tuesday_half_day_mark, $wednesday_start_time, $wednesday_end_time, $wednesday_lunch_start_time, $wednesday_lunch_end_time, $wednesday_half_day_mark, $thursday_start_time, $thursday_end_time, $thursday_lunch_start_time, $thursday_lunch_end_time, $thursday_half_day_mark, $friday_start_time, $friday_end_time, $friday_lunch_start_time, $friday_lunch_end_time, $friday_half_day_mark, $saturday_start_time, $saturday_end_time, $saturday_lunch_start_time, $saturday_lunch_end_time, $saturday_half_day_mark, $sunday_start_time, $sunday_end_time, $sunday_lunch_start_time, $sunday_lunch_end_time, $sunday_half_day_mark, $username);

                if($update_work_shift_schedule){
                    echo 'Updated';
                }
                else{
                    echo $update_work_shift_schedule;
                }
            }
            else{
                $insert_work_shift_schedule = $api->insert_work_shift_schedule($work_shift_id, $start_date, $end_date, $monday_start_time, $monday_end_time, $monday_lunch_start_time, $monday_lunch_end_time, $monday_half_day_mark, $tuesday_start_time, $tuesday_end_time, $tuesday_lunch_start_time, $tuesday_lunch_end_time, $tuesday_half_day_mark, $wednesday_start_time, $wednesday_end_time, $wednesday_lunch_start_time, $wednesday_lunch_end_time, $wednesday_half_day_mark, $thursday_start_time, $thursday_end_time, $thursday_lunch_start_time, $thursday_lunch_end_time, $thursday_half_day_mark, $friday_start_time, $friday_end_time, $friday_lunch_start_time, $friday_lunch_end_time, $friday_half_day_mark, $saturday_start_time, $saturday_end_time, $saturday_lunch_start_time, $saturday_lunch_end_time, $saturday_half_day_mark, $sunday_start_time, $sunday_end_time, $sunday_lunch_start_time, $sunday_lunch_end_time, $sunday_half_day_mark, $username);

                if($insert_work_shift_schedule){
                    echo 'Inserted';
                }
                else{
                    echo $insert_work_shift_schedule;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit work shift assignment
    else if($transaction == 'submit work shift assignment'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['work_shift_id']) && !empty($_POST['work_shift_id']) && isset($_POST['employee']) && !empty($_POST['employee'])){
            $username = $_POST['username'];
            $work_shift_id = $_POST['work_shift_id'];
            $employees = explode(',', $_POST['employee']);

            $check_work_shift_exist = $api->check_work_shift_exist($work_shift_id);

            if($check_work_shift_exist > 0){
                $delete_employee_work_shift = $api->delete_employee_work_shift($work_shift_id, $username);

                if($delete_employee_work_shift){
                    foreach($employees as $employee){
                        $delete_employee_work_shift_assignment = $api->delete_employee_work_shift_assignment($employee, $username);

                        if($delete_employee_work_shift_assignment){
                            $insert_employee_work_shift = $api->insert_employee_work_shift($work_shift_id, $employee, $username);

                            if(!$insert_employee_work_shift){
                                $error = $insert_employee_work_shift;
                            }
                        }
                        else{
                            $error = $delete_employee_work_shift_assignment;
                        }
                    }
                }
                else{
                    $error = $delete_employee_work_shift;
                }

                if(empty($error)){
                    echo 'Assigned';
                }
                else{
                    echo $error;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Submit employee attendance
    else if($transaction == 'submit employee attendance'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['attendance_id']) && isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['time_in_date']) && !empty($_POST['time_in_date']) && isset($_POST['time_in']) && !empty($_POST['time_in']) && isset($_POST['time_out_date']) && isset($_POST['time_out']) && isset($_POST['remarks'])){
            $username = $_POST['username'];
            $attendance_id = $_POST['attendance_id'];
            $employee_id = $_POST['employee_id'];
            $time_in_date = $api->check_date('empty', $_POST['time_in_date'], '', 'Y-m-d', '', '', '');
            $time_in = $api->check_date('empty', $_POST['time_in'], '', 'H:i:00', '', '', '');
            $time_in_behavior = $api->get_time_in_behavior($employee_id, $time_in_date, $time_in);
            $time_out_date = $api->check_date('empty', $_POST['time_out_date'], '', 'Y-m-d', '', '', '');
            $time_out = $api->check_date('empty', $_POST['time_out'], '', 'H:i:00', '', '', '');
            $remarks = $_POST['remarks'];
            $late = $api->get_attendance_late_total($employee_id, $time_in_date, $time_in);
            
            $time_out_behavior = '';
            $early_leaving = 0;
            $overtime = 0;
            $total_hours_worked = 0;

            $attendance_setting_details = $api->get_attendance_setting_details(1);
            $max_attendance = $attendance_setting_details[0]['MAX_ATTENDANCE'] ?? 1;
            $get_clock_in_total = $api->get_clock_in_total($employee_id, $time_in_date);

            $check_attendance_validation = $api->check_attendance_validation($time_in_date, $time_in, $time_out_date, $time_out);

            if(empty($check_attendance_validation)){
                if(!empty($time_out_date) && !empty($time_out)){
                    $early_leaving = $api->get_attendance_early_leaving_total($employee_id, $time_in_date, $time_out);
                    $overtime = $api->get_attendance_overtime_total($employee_id, $time_in_date, $time_out_date, $time_out);
                    $total_hours_worked = $api->get_attendance_total_hours($employee_id, $time_in_date, $time_in, $time_out_date, $time_out);
                    $time_out_behavior = $api->get_time_out_behavior($employee_id, $time_in_date, $time_out_date, $time_out);
                }

                $check_employee_attendance_exist = $api->check_employee_attendance_exist($attendance_id);

                if($check_employee_attendance_exist > 0){
                    $get_employee_attendance_details = $api->get_employee_attendance_details($attendance_id);
                    $time_date_details = $get_employee_attendance_details[0]['TIME_IN_DATE'];

                    if(strtotime($time_date_details) != strtotime($time_in_date)){
                        if($get_clock_in_total < $max_attendance){
                            $update_manual_employee_attendance = $api->update_manual_employee_attendance($attendance_id, $time_in_date, $time_in, $time_in_behavior, $time_out_date, $time_out, $time_out_behavior, $late, $early_leaving, $overtime, $total_hours_worked, $remarks, $username);

                            if($update_manual_employee_attendance){
                                echo 'Updated';
                            }
                            else{
                                echo $update_manual_employee_attendance;
                            }
                        }
                        else{
                            echo 'Max Attendance';
                        }
                    }
                    else{
                        $update_manual_employee_attendance = $api->update_manual_employee_attendance($attendance_id, $time_in_date, $time_in, $time_in_behavior, $time_out_date, $time_out, $time_out_behavior, $late, $early_leaving, $overtime, $total_hours_worked, $remarks, $username);

                        if($update_manual_employee_attendance){
                            echo 'Updated';
                        }
                        else{
                            echo $update_manual_employee_attendance;
                        }
                    }
                }
                else{
                    if($get_clock_in_total < $max_attendance){
                        $insert_manual_employee_attendance = $api->insert_manual_employee_attendance($employee_id, $time_in_date, $time_in, $time_in_behavior, $time_out_date, $time_out, $time_out_behavior, $late, $early_leaving, $overtime, $total_hours_worked, $remarks, $username);

                        if($insert_manual_employee_attendance){
                            echo 'Inserted';
                        }
                        else{
                            echo $insert_manual_employee_attendance;
                        }
                    }
                    else{
                        echo 'Max Attendance';
                    }
                }
            }
            else{
                echo $check_attendance_validation;
            }
        }
    }
    # -------------------------------------------------------------

    # Submit leave type
    else if($transaction == 'submit leave type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_type_id']) && isset($_POST['leave_name']) && !empty($_POST['leave_name']) && isset($_POST['description']) && !empty($_POST['description']) && isset($_POST['no_leaves']) && isset($_POST['paid_status']) && !empty($_POST['paid_status'])){
            $username = $_POST['username'];
            $leave_type_id = $_POST['leave_type_id'];
            $leave_name = $_POST['leave_name'];
            $no_leaves = $_POST['no_leaves'];
            $paid_status = $_POST['paid_status'];
            $description = $_POST['description'];

            $check_leave_type_exist = $api->check_leave_type_exist($leave_type_id);

            if($check_leave_type_exist > 0){
                $update_leave_type = $api->update_leave_type($leave_type_id, $leave_name, $description, $no_leaves, $paid_status, $username);

                if($update_leave_type){
                    echo 'Updated';
                }
                else{
                    echo $update_leave_type;
                }
            }
            else{
                $insert_leave_type = $api->insert_leave_type($leave_name, $description, $no_leaves, $paid_status, $username);

                if($insert_leave_type){
                    echo 'Updated';
                }
                else{
                    echo $insert_leave_type;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit leave entitlement
    else if($transaction == 'submit leave entitlement'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employee']) && !empty($_POST['employee']) && isset($_POST['leave_type']) && !empty($_POST['leave_type']) && isset($_POST['no_leaves']) && !empty($_POST['no_leaves']) && isset($_POST['start_date']) && !empty($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['end_date'])){
            $error = '';
            $username = $_POST['username'];
            $leave_type = $_POST['leave_type'];
            $no_leaves = $_POST['no_leaves'];
            $start_date = $api->check_date('empty', $_POST['start_date'], '', 'Y-m-d', '', '', '');
            $end_date = $api->check_date('empty', $_POST['end_date'], '', 'Y-m-d', '', '', '');
            $employees = explode(',', $_POST['employee']);

            foreach($employees as $employee){
                $leave_overlap = $api->check_leave_entitlement_overlap('', $start_date, $end_date, $employee, $leave_type);

                if($leave_overlap == 0){
                    $insert_leave_entitlement = $api->insert_leave_entitlement($employee, $leave_type, $no_leaves, $start_date, $end_date, $username);

                    if(!$insert_leave_entitlement){
                        $error = $insert_leave_entitlement;
                    }
                }
            }

            if(empty($error)){
                echo 'Inserted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Submit leave entitlement update
    else if($transaction == 'submit leave entitlement update'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_entitlement_id']) && isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['leave_type']) && !empty($_POST['leave_type']) && isset($_POST['no_leaves']) && !empty($_POST['no_leaves']) && isset($_POST['start_date']) && !empty($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['end_date'])){
            $error = '';
            $username = $_POST['username'];
            $leave_entitlement_id = $_POST['leave_entitlement_id'];
            $employee_id = $_POST['employee_id'];
            $leave_type = $_POST['leave_type'];
            $no_leaves = $_POST['no_leaves'];
            $start_date = $api->check_date('empty', $_POST['start_date'], '', 'Y-m-d', '', '', '');
            $end_date = $api->check_date('empty', $_POST['end_date'], '', 'Y-m-d', '', '', '');

            $check_leave_entitlement_exist = $api->check_leave_entitlement_exist($leave_entitlement_id);

            if($check_leave_entitlement_exist > 0){
                $leave_entitlement_details = $api->get_leave_entitlement_details($leave_entitlement_id);
                $leave_entitlement_start_date = $leave_entitlement_details[0]['START_DATE'];
                $leave_entitlement_end_date = $leave_entitlement_details[0]['END_DATE'];

                if(strtotime($leave_entitlement_start_date) != strtotime($start_date) || strtotime($leave_entitlement_end_date) != strtotime($end_date)){
                    $leave_entitlement_overlap = $api->check_leave_entitlement_overlap($leave_entitlement_id, $start_date, $end_date, $employee_id, $leave_type);

                    if($leave_entitlement_overlap == 0){
                        $update_leave_entitlement = $api->update_leave_entitlement($leave_entitlement_id, $no_leaves, $start_date, $end_date, $username);

                        if($update_leave_entitlement){
                            echo 'Updated';
                        }
                        else{
                            echo $update_leave_entitlement;
                        }
                    }
                    else{
                        echo 'Overlap';
                    }
                }
                else{
                    $update_leave_entitlement = $api->update_leave_entitlement($leave_entitlement_id, $no_leaves, $start_date, $end_date, $username);

                    if($update_leave_entitlement){
                        echo 'Updated';
                    }
                    else{
                        echo $update_leave_entitlement;
                    }
                }
            }
            else{
                $leave_entitlement_overlap = $api->check_leave_entitlement_overlap('', $start_date, $end_date, $employee_id, $leave_type);

                if($leave_entitlement_overlap == 0){
                    $insert_leave_entitlement = $api->insert_leave_entitlement($employee_id, $leave_type, $no_leaves, $start_date, $end_date, $username);

                    if($insert_leave_entitlement){
                        echo 'Updated';
                    }
                    else{
                        echo $insert_leave_entitlement;
                    }
                }
                else{
                    echo 'Overlap';
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit employee leave entitlement
    else if($transaction == 'submit employee leave entitlement'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_entitlement_id']) && isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['leave_type']) && !empty($_POST['leave_type']) && isset($_POST['no_leaves']) && !empty($_POST['no_leaves']) && isset($_POST['start_date']) && !empty($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['end_date'])){
            $error = '';
            $username = $_POST['username'];
            $leave_entitlement_id = $_POST['leave_entitlement_id'];
            $employee_id = $_POST['employee_id'];
            $leave_type = $_POST['leave_type'];
            $no_leaves = $_POST['no_leaves'];
            $start_date = $api->check_date('empty', $_POST['start_date'], '', 'Y-m-d', '', '', '');
            $end_date = $api->check_date('empty', $_POST['end_date'], '', 'Y-m-d', '', '', '');

            $check_leave_entitlement_exist = $api->check_leave_entitlement_exist($leave_entitlement_id);

            if($check_leave_entitlement_exist > 0){
                $leave_entitlement_details = $api->get_leave_entitlement_details($leave_entitlement_id);
                $leave_entitlement_start_date = $leave_entitlement_details[0]['START_DATE'];
                $leave_entitlement_end_date = $leave_entitlement_details[0]['END_DATE'];

                if(strtotime($leave_entitlement_start_date) != strtotime($start_date) || strtotime($leave_entitlement_end_date) != strtotime($end_date)){
                    $leave_entitlement_overlap = $api->check_leave_entitlement_overlap($leave_entitlement_id, $start_date, $end_date, $employee_id, $leave_type);

                    if($leave_entitlement_overlap == 0){
                        $update_leave_entitlement = $api->update_leave_entitlement($leave_entitlement_id, $no_leaves, $start_date, $end_date, $username);

                        if($update_leave_entitlement){
                            echo 'Updated';
                        }
                        else{
                            echo $update_leave_entitlement;
                        }
                    }
                    else{
                        echo 'Overlap';
                    }
                }
                else{
                    $update_leave_entitlement = $api->update_leave_entitlement($leave_entitlement_id, $no_leaves, $start_date, $end_date, $username);

                    if($update_leave_entitlement){
                         echo 'Updated';
                    }
                    else{
                        echo $update_leave_entitlement;
                    }
                }
            }
            else{
                $leave_entitlement_overlap = $api->check_leave_entitlement_overlap('', $start_date, $end_date, $employee_id, $leave_type);

                if($leave_entitlement_overlap == 0){
                    $insert_leave_entitlement = $api->insert_leave_entitlement($employee_id, $leave_type, $no_leaves, $start_date, $end_date, $username);

                    if($insert_leave_entitlement){
                        echo 'Inserted';
                    }
                    else{
                        echo $insert_leave_entitlement;
                    }
                }
                else{
                    echo 'Overlap';
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit leave
    else if($transaction == 'submit leave'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['leave_type']) && !empty($_POST['leave_type']) && isset($_POST['leave_status']) && !empty($_POST['leave_status']) && isset($_POST['leave_duration']) && !empty($_POST['leave_duration']) && isset($_POST['reason']) && !empty($_POST['reason']) && isset($_POST['leave_date']) && !empty($_POST['leave_date'])){
            $error = '';
            $file_type = '';
            $username = $_POST['username'];
            $employee_id = $_POST['employee_id'];
            $leave_type = $_POST['leave_type'];
            $leave_status = $_POST['leave_status'];
            $leave_duration = $_POST['leave_duration'];
            $reason = $_POST['reason'];
            $leave_dates = explode(',', $_POST['leave_date']);

            if($leave_status == 'APV'){
                $decision_date = date('Y-m-d');
                $decision_time = date('H:i:s');
                $decision_by = $username;
            }
            else{
                $decision_date = null;
                $decision_time = null;
                $decision_by = null;
            }

            foreach($leave_dates as $leave_date){
                $leave_date = $api->check_date('empty', $leave_date, '', 'Y-m-d', '', '', '');
                $leave_day = $api->check_week_day($api->check_date('empty', $leave_date, '', 'w', '', '', ''));

                $work_shift_schedule = $api->get_work_shift_schedule($employee_id, $leave_date, $leave_day);
                $work_shift_time_in = $work_shift_schedule[0]['START_TIME'];
                $work_shift_time_out = $work_shift_schedule[0]['END_TIME'];
                $work_shift_half_day_mark = $work_shift_schedule[0]['HALF_DAY_MARK'];

                if($leave_duration == 'CUSTOM'){
                    $start_time = $api->check_date('empty', $_POST['start_time'], '', 'H:i:00', '', '', '');
                    $end_time = $api->check_date('empty', $_POST['start_time'], '', 'H:i:00', '', '', '');
                }
                else if($leave_duration == 'HLFDAYMOR' || $leave_duration == 'HLFDAYAFT'){
                    if($leave_duration == 'HLFDAYMOR'){
                        $start_time = $api->check_date('empty', $work_shift_time_in, '', 'H:i:00', '', '', '');
                        $end_time = $api->check_date('empty', $work_shift_half_day_mark, '', 'H:i:00', '', '', '');
                    }
                    else{
                        $start_time = $api->check_date('empty', $work_shift_half_day_mark, '', 'H:i:00', '', '', '');
                        $end_time = $api->check_date('empty', $work_shift_time_out, '', 'H:i:00', '', '', '');
                    }
                }
                else{
                    $start_time = $api->check_date('empty', $work_shift_time_in, '', 'H:i:00', '', '', '');
                    $end_time = $api->check_date('empty', $work_shift_time_out, '', 'H:i:00', '', '', '');
                }

                $total_working_hours = round(abs(strtotime($work_shift_time_out) - strtotime($work_shift_time_in)) / 3600, 2);
                $total_leave_hours = round(abs(strtotime($end_time) - strtotime($start_time)) / 3600, 2);

                if($total_working_hours != $total_leave_hours){
                    $total_hours = ($total_working_hours - $total_leave_hours) / $total_working_hours;
                }
                else{
                    $total_hours = 1;
                }
                
                $get_available_leave_entitlement = $api->get_available_leave_entitlement($employee_id, $leave_type, $leave_date);

                if($get_available_leave_entitlement > 0){
                    $insert_leave = $api->insert_leave($employee_id, $leave_type, $leave_date, $start_time, $end_time, $leave_status, $reason, $decision_date, $decision_time, $decision_by, $username);

                    if($insert_leave){
                        $update_leave_entitlement_count = $api->update_leave_entitlement_count($employee_id, $leave_type, $leave_date, $total_hours, $username);

                        if(!$update_leave_entitlement_count){
                            $error = $update_leave_entitlement_count;
                            break;
                        }
                    }
                    else{
                        $error = $insert_leave;
                        break;
                    }
                }
                else{
                    $error = 'Leave Entitlement';
                    break;
                }
            }

            if(empty($error)){
                echo 'Inserted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Submit employee file management
    else if($transaction == 'submit employee file management'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['file_id']) && isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['file_name']) && !empty($_POST['file_name']) && isset($_POST['file_category']) && !empty($_POST['file_category']) && isset($_POST['file_date']) && !empty($_POST['file_date']) && isset($_POST['remarks']) && !empty($_POST['remarks'])){
            $file_type = '';
            $username = $_POST['username'];
            $file_id = $_POST['file_id'];
            $employee_id = $_POST['employee_id'];
            $file_name = $_POST['file_name'];
            $file_category = $_POST['file_category'];
            $file_date = $api->check_date('empty', $_POST['file_date'], '', 'Y-m-d', '', '', '');
            $remarks = $_POST['remarks'];

            $employee_file_name = $_FILES['file']['name'];
            $employee_file_size = $_FILES['file']['size'];
            $employee_file_error = $_FILES['file']['error'];
            $employee_file_tmp_name = $_FILES['file']['tmp_name'];
            $employee_file_ext = explode('.', $employee_file_name);
            $employee_file_actual_ext = strtolower(end($employee_file_ext));

            $upload_setting_details = $api->get_upload_setting_details(8);
            $upload_file_type_details = $api->get_upload_file_type_details(8);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            $check_employee_file_exist = $api->check_employee_file_exist($file_id);
 
            if($check_employee_file_exist > 0){
                if(!empty($employee_file_tmp_name)){
                    if(in_array($employee_file_actual_ext, $allowed_ext)){
                        if(!$employee_file_error){
                            if($employee_file_size < $file_max_size){
                                $update_employee_file = $api->update_employee_file($employee_file_tmp_name, $employee_file_actual_ext, $file_id, $username);
        
                                if($update_employee_file){
                                    $update_employee_file_details = $api->update_employee_file_details($file_id, $file_name, $file_category, $remarks, $file_date, $username);

                                    if($update_employee_file_details){
                                        echo 'Updated';
                                    }
                                    else{
                                        echo $update_employee_file_details;
                                    }
                                }
                                else{
                                    echo $update_employee_file;
                                }
                            }
                            else{
                                echo 'File Size';
                            }
                        }
                        else{
                            echo 'There was an error uploading the file.';
                        }
                    }
                    else{
                        echo 'File Type';
                    }
                }
                else{
                    $update_employee_file_details = $api->update_employee_file_details($file_id, $file_name, $file_category, $remarks, $file_date, $username);

                    if($update_employee_file_details){
                        echo 'Updated';
                    }
                    else{
                        echo $update_employee_file_details;
                    }
                }
            }
            else{
                if(in_array($employee_file_actual_ext, $allowed_ext)){
                    if(!$employee_file_error){
                        if($employee_file_size < $file_max_size){
                            $insert_employee_file = $api->insert_employee_file($employee_file_tmp_name, $employee_file_actual_ext, $employee_id, $file_name, $file_category, $remarks, $file_date, $system_date, $current_time, $username);

                            if($insert_employee_file){
                                echo 'Inserted';
                            }
                            else{
                                echo $insert_employee_file;
                            }
                        }
                        else{
                            echo 'File Size';
                        }
                    }
                    else{
                        echo 'There was an error uploading the file.';
                    }
                }
                else{
                    echo 'File Type';
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit user account
    else if($transaction == 'submit user account'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employee_id']) && isset($_POST['user_code']) && !empty($_POST['user_code']) && isset($_POST['password']) && isset($_POST['role'])){
            $username = $_POST['username'];
            $employee_id = $_POST['employee_id'];
            $user_code = $_POST['user_code'];
            $password = $_POST['password'];
            $roles = explode(',', $_POST['role']);
            $password_expiry_date = $api->format_date('Y-m-d', $system_date, '+6 months');

            if(!empty($password)){
                $password = $api->encrypt_data($password);
            }

            $check_user_account_exist = $api->check_user_account_exist($user_code);

            if($check_user_account_exist > 0){
                $update_user_account = $api->update_user_account($user_code, $password, $password_expiry_date, $username);

                if($update_user_account){
                    $delete_all_role_users = $api->delete_all_user_role($user_code);

                    if($delete_all_role_users){
                        foreach($roles as $role){
                            $insert_user_role = $api->insert_user_role($user_code, $role, $username);

                            if(!$insert_user_role){
                                $error = $insert_user_role;
                            }
                        }
                    }
                    else{
                        $error = $delete_all_role_users;
                    }                    
                }
                else{
                    $error = $update_user_account;
                }

                if(empty($error)){
                    echo 'Updated';
                }
                else{
                    echo $error;
                }
            }
            else{
                $insert_user_account = $api->insert_user_account($user_code, $password, $password_expiry_date, $username);

                if($insert_user_account){
                    foreach($roles as $role){
                        $insert_user_role = $api->insert_user_role($user_code, $role, $username);

                        if(!$insert_user_role){
                            $error = $insert_user_role;
                        }
                    }

                    if(empty($error)){
                        if(!empty($employee_id)){
                            $update_employee_user_account = $api->update_employee_user_account($employee_id, $user_code, $username);

                            if($update_employee_user_account){
                                echo 'Inserted';
                            }
                            else{
                                echo $update_employee_user_account;
                            }
                        }
                        else{
                            echo 'Inserted';
                        }
                    }
                    else{
                        echo $error;
                    }
                }
                else{
                    $error = $insert_user_account;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit user account update
    else if($transaction == 'submit user account update'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['user_code']) && !empty($_POST['user_code']) && isset($_POST['password']) && isset($_POST['role'])){
            $username = $_POST['username'];
            $user_code = $_POST['user_code'];
            $password = $_POST['password'];
            $roles = explode(',', $_POST['role']);
            $password_expiry_date = $api->format_date('Y-m-d', $system_date, '+6 months');

            if(!empty($password)){
                $password = $api->encrypt_data($password);
            }

            $check_user_account_exist = $api->check_user_account_exist($user_code);

            if($check_user_account_exist > 0){
                $update_user_account = $api->update_user_account($user_code, $password, $password_expiry_date, $username);

                if($update_user_account){
                    $delete_all_role_users = $api->delete_all_user_role($user_code);

                    if($delete_all_role_users){
                        foreach($roles as $role){
                            $insert_user_role = $api->insert_user_role($user_code, $role, $username);

                            if(!$insert_user_role){
                                $error = $insert_user_role;
                            }
                        }
                    }
                    else{
                        $error = $delete_all_role_users;
                    }
                }
                else{
                    $error = $update_user_account;
                }

                if(empty($error)){
                    echo 'Updated';
                }
                else{
                    echo $error;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Submit holiday
    else if($transaction == 'submit holiday'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['holiday_id']) && isset($_POST['holiday']) && !empty($_POST['holiday']) && isset($_POST['holiday_type']) && !empty($_POST['holiday_type']) && isset($_POST['holiday_date']) && !empty($_POST['holiday_date'])){
            $error = '';
            $username = $_POST['username'];
            $holiday_id = $_POST['holiday_id'];
            $holiday = $_POST['holiday'];
            $holiday_type = $_POST['holiday_type'];
            $holiday_date = $api->check_date('empty', $_POST['holiday_date'], '', 'Y-m-d', '', '', '');
            $branches = explode(',', $_POST['branch']);

            $check_holiday_exist = $api->check_holiday_exist($holiday_id);

            if($check_holiday_exist > 0){
                $update_holiday = $api->update_holiday($holiday_id, $holiday, $holiday_date, $holiday_type, $username);

                if($update_holiday){
                    $delete_all_holiday_branch = $api->delete_all_holiday_branch($holiday_id);

                    if($delete_all_holiday_branch){
                        foreach($branches as $branch){
                            $insert_holiday_branch = $api->insert_holiday_branch($holiday_id, $branch, $username);

                            if(!$insert_holiday_branch){
                                $error = $insert_holiday_branch;
                            }
                        }
                    }
                    else{
                        $error = $delete_all_holiday_branch;
                    }
                }
                else{
                    $error = $update_holiday;
                }

                if(empty($error)){
                    echo 'Updated';
                }
                else{
                    echo $error;
                }
            }
            else{
                $insert_holiday = $api->insert_holiday($holiday, $holiday_date, $holiday_type, $branches, $username);

                if($insert_holiday){
                   echo 'Inserted';
                }
                else{
                   echo $insert_holiday;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit attendance setting
    else if($transaction == 'submit attendance setting'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['maximum_attendance']) && !empty($_POST['maximum_attendance']) && isset($_POST['time_out_allowance']) && !empty($_POST['time_out_allowance'])  && isset($_POST['late_allowance']) && isset($_POST['late_policy']) && isset($_POST['early_leaving_policy']) && isset($_POST['overtime_policy']) && isset($_POST['attendance_creation_approval']) && isset($_POST['attendance_adjustment_approval'])){
            $error = '';
            $username = $_POST['username'];
            $setting_id = 1;
            $maximum_attendance = $_POST['maximum_attendance'];
            $time_out_allowance = $_POST['time_out_allowance'];
            $late_allowance = $_POST['late_allowance'];
            $late_policy = $_POST['late_policy'];
            $early_leaving_policy = $_POST['early_leaving_policy'];
            $overtime_policy = $_POST['overtime_policy'];
            $attendance_creation_recommendation = $_POST['attendance_creation_recommendation'] ?? 0;
            $attendance_adjustment_recommendation = $_POST['attendance_adjustment_recommendation'] ?? 0;
            $attendance_creation_approvals = explode(',', $_POST['attendance_creation_approval']);
            $attendance_adjustment_approvals = explode(',', $_POST['attendance_adjustment_approval']);

            $check_attendance_setting_exist = $api->check_attendance_setting_exist($setting_id);

            if($check_attendance_setting_exist > 0){
                $update_attendance_setting = $api->update_attendance_setting($setting_id, $maximum_attendance, $time_out_allowance, $late_allowance, $late_policy, $early_leaving_policy, $overtime_policy, $attendance_creation_recommendation, $attendance_adjustment_recommendation, $username);

                if($update_attendance_setting){
                    $delete_attendance_creation_approval = $api->delete_attendance_creation_approval();

                    if($delete_attendance_creation_approval){
                        foreach($attendance_creation_approvals as $attendance_creation_approval){
                            $insert_attendance_creation_approval = $api->insert_attendance_creation_approval($attendance_creation_approval, $username);

                            if(!$insert_attendance_creation_approval){
                                $error = $insert_attendance_creation_approval;
                            }
                        }
                    }
                    else{
                        $error = $delete_attendance_creation_approval;
                    }

                    $delete_attendance_adjustment_approval = $api->delete_attendance_adjustment_approval();

                    if($delete_attendance_adjustment_approval){
                        foreach($attendance_adjustment_approvals as $attendance_adjustment_approval){
                            $insert_attendance_adjustment_approval = $api->insert_attendance_adjustment_approval($attendance_adjustment_approval, $username);

                            if(!$insert_attendance_adjustment_approval){
                                $error = $insert_attendance_adjustment_approval;
                            }
                        }
                    }
                    else{
                        $error = $delete_attendance_adjustment_approval;
                    }

                    if(empty($error)){
                        echo 'Updated';
                    }
                    else{
                        echo $error;
                    }
                }
                else{
                    echo $update_attendance_setting;
                }
            }
            else{
                $insert_attendance_setting = $api->insert_attendance_setting($setting_id, $maximum_attendance, $time_out_allowance, $late_allowance, $late_policy, $early_leaving_policy, $overtime_policy, $attendance_creation_recommendation, $attendance_adjustment_recommendation, $username);

                if($insert_attendance_setting){
                    foreach($attendance_adjustment_approvals as $attendance_adjustment_approval){
                        $insert_attendance_creation_approval = $api->insert_attendance_creation_approval($attendance_adjustment_approval, $username);

                        if(!$insert_attendance_creation_approval){
                            $error = $insert_attendance_creation_approval;
                        }
                    }

                    foreach($attendance_adjustment_approvals as $attendance_adjustment_approval){
                        $insert_attendance_adjustment_approval = $api->insert_attendance_adjustment_approval($attendance_adjustment_approval, $username);

                        if(!$insert_attendance_adjustment_approval){
                            $error = $insert_attendance_adjustment_approval;
                        }
                    }
                }

                if(empty($error)){
                    echo 'Updated';
                }
                else{
                    echo $error;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit time in
    else if($transaction == 'submit time in'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['time_in_note']) && isset($_POST['attendance_position'])){
            $error = '';
            $username = $_POST['username'];
            $time_in_note = $_POST['time_in_note'];
            $attendance_position = $_POST['attendance_position'];
            $employee_details = $api->get_employee_details('', $username);
            $employee_id = $employee_details[0]['EMPLOYEE_ID'];
            $time_in_date = date('Y-m-d');
            $time_in = date('H:i:00');

            $time_in_behavior = $api->get_time_in_behavior($employee_id, $time_in_date, $time_in);
            $late = $api->get_attendance_late_total($employee_id, $time_in_date, $time_in);

            $attendance_setting_details = $api->get_attendance_setting_details(1);
            $max_attendance = $attendance_setting_details[0]['MAX_ATTENDANCE'] ?? 1;
            $get_clock_in_total = $api->get_clock_in_total($employee_id, date('Y-m-d'));

            $ip_address = $api->get_ip_address();

            $notification_details = $api->get_notification_details(1);
            $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
            $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
            $notification_message = str_replace('{date}', $api->check_date('empty', $time_in_date, '', 'F d, Y', '', '', ''), $notification_message);
            $notification_message = str_replace('{time}', $api->check_date('empty', $time_in, '', 'h:i a', '', '', ''), $notification_message);

            if (!filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)){
                if($get_clock_in_total < $max_attendance){
                    $insert_time_in = $api->insert_time_in($employee_id, $time_in_date, $time_in, $attendance_position, $ip_address, $time_in_behavior, $time_in_note, $late, $username);

                    if($insert_time_in > 0){
                        $send_notification = $api->send_notification(1, null, $employee_id, $notification_title, $notification_message, $username);

                        if($send_notification){
                            echo 'Recorded';
                        }
                        else{
                            echo $send_notification;
                        }
                    }
                    else{
                        echo $insert_time_in;
                    }
                }
                else{
                    echo 'Max Attendance';
                }
            }
            else{
                if(!empty($attendance_position)){
                    $insert_time_in = $api->insert_time_in($employee_id, $time_in_date, $time_in, $attendance_position, $ip_address, $time_in_behavior, $time_in_note, $late, $username);

                    if($insert_time_in > 0){
                        $send_notification = $api->send_notification(1, null, $employee_id, $notification_title, $notification_message, $username);

                        if($send_notification){
                            echo 'Recorded';
                        }
                        else{
                            echo $send_notification;
                        }
                    }
                    else{
                        echo $insert_time_in;
                    }
                }
                else{
                    echo 'Location';
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit time out
    else if($transaction == 'submit time out'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['attendance_id']) && !empty($_POST['attendance_id']) && isset($_POST['time_out_note']) && isset($_POST['attendance_position'])){
            $error = '';
            $username = $_POST['username'];
            $attendance_id = $_POST['attendance_id'];
            $time_out_note = $_POST['time_out_note'];
            $attendance_position = $_POST['attendance_position'];
            $employee_details = $api->get_employee_details('', $username);
            $employee_id = $employee_details[0]['EMPLOYEE_ID'];
            $time_out_date = date('Y-m-d');
            $time_out = date('H:i:00');

            $get_employee_attendance_details = $api->get_employee_attendance_details($attendance_id);
            $time_in_date = $get_employee_attendance_details[0]['TIME_IN_DATE'];
            $time_in = $get_employee_attendance_details[0]['TIME_IN'];

            $early_leaving = $api->get_attendance_early_leaving_total($employee_id, $time_in_date, $time_out);
            $overtime = $api->get_attendance_overtime_total($employee_id, $time_in_date, $time_out_date, $time_out);
            $total_hours_worked = $api->get_attendance_total_hours($employee_id, $time_in_date, $time_in, $time_out_date, $time_out);
            $time_out_behavior = $api->get_time_out_behavior($employee_id, $time_in_date, $time_out_date, $time_out);

            $attendance_setting_details = $api->get_attendance_setting_details(1);
            $max_attendance = $attendance_setting_details[0]['MAX_ATTENDANCE'] ?? 1;
            $get_clock_in_total = $api->get_clock_in_total($employee_id, date('Y-m-d'));

            $ip_address = $api->get_ip_address();

            $notification_details = $api->get_notification_details(2);
            $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
            $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
            $notification_message = str_replace('{date}', $api->check_date('empty', $time_out_date, '', 'F d, Y', '', '', ''), $notification_message);
            $notification_message = str_replace('{time}', $api->check_date('empty', $time_out, '', 'h:i a', '', '', ''), $notification_message);

            if (!filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)){
                if($get_clock_in_total < $max_attendance){
                    $update_time_out = $api->update_time_out($attendance_id, $time_out_date, $time_out, $attendance_position, $ip_address, $time_out_behavior, $time_out_note, $early_leaving, $overtime, $total_hours_worked, $username);

                    if($update_time_out > 0){
                        $send_notification = $api->send_notification(2, null, $employee_id, $notification_title, $notification_message, $username);

                        if($send_notification){
                            echo 'Recorded';
                        }
                        else{
                            echo $send_notification;
                        }
                    }
                    else{
                        echo $update_time_out;
                    }
                }
                else{
                    echo 'Max Attendance';
                }
            }
            else{
                if(!empty($attendance_position)){
                    $update_time_out = $api->update_time_out($attendance_id, $time_out_date, $time_out, $attendance_position, $ip_address, $time_out_behavior, $time_out_note, $early_leaving, $overtime, $total_hours_worked, $username);

                    if($update_time_out > 0){
                        $send_notification = $api->send_notification(2, null, $employee_id, $notification_title, $notification_message, $username);

                        if($send_notification){
                            echo 'Recorded';
                        }
                        else{
                            echo $send_notification;
                        }
                    }
                    else{
                        echo $update_time_out;
                    }
                }
                else{
                    echo 'Location';
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit health declaration
    else if($transaction == 'submit health declaration'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['temperature']) && !empty($_POST['temperature']) && isset($_POST['sore_throat']) && isset($_POST['body_pain']) && isset($_POST['headache']) && isset($_POST['fever']) && isset($_POST['question_2']) && isset($_POST['question_3']) && isset($_POST['question_4']) && isset($_POST['question_5']) && isset($_POST['specific'])){
            $username = $_POST['username'];
            $temperature = $_POST['temperature'];
            $sore_throat = $_POST['sore_throat'];
            $body_pain = $_POST['body_pain'];
            $headache = $_POST['headache'];
            $fever = $_POST['fever'];
            $question_1 = $sore_throat + $body_pain + $headache + $fever;
            $question_2 = $_POST['question_2'];
            $question_3 = $_POST['question_3'];
            $question_4 = $_POST['question_4'];
            $question_5 = $_POST['question_5'];
            $specific = $_POST['specific'];

            $employee_details = $api->get_employee_details('', $username);
            $employee_id = $employee_details[0]['EMPLOYEE_ID'];

            $health_declaration_count = $api->get_health_declaration_count($employee_id, $system_date);

            if($health_declaration_count == 0){
                $insert_health_declaration = $api->insert_health_declaration($employee_id, $temperature, $question_1, $question_2, $question_3, $question_4, $question_5, $specific, $system_date, $current_time, $username);

                if($insert_health_declaration){
                   echo 'Inserted';
                }
                else{
                   echo $insert_health_declaration;
                }
            }
            else{
                echo 'Existed';
            }
        }
    }
    # -------------------------------------------------------------

    # Submit attendance record
    else if($transaction == 'submit attendance record'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employee_id']) && isset($_POST['latitude']) && isset($_POST['longitude'])){
            $error = '';
            $username = $_POST['username'];
            $employee_id = $_POST['employee_id'];
            $latitude = $_POST['latitude'];
            $longitude = $_POST['longitude'];

            $attendance_setting_details = $api->get_attendance_setting_details(1);
            $time_out_allowance = $attendance_setting_details[0]['TIME_OUT_ALLOWANCE'] ?? 1;

            if(!empty($latitude) && !empty($longitude)){
                $attendance_position = $latitude . ', ' . $longitude;
            }
            else{
                $attendance_position = null;
            }

            $attendance_id = $api->check_attendance_clock_out($employee_id);

            $attendance_setting_details = $api->get_attendance_setting_details(1);
            $max_attendance = $attendance_setting_details[0]['MAX_ATTENDANCE'] ?? 1;
            $get_clock_in_total = $api->get_clock_in_total($employee_id, date('Y-m-d'));
            $ip_address = $api->get_ip_address();

            if(!empty($attendance_id)){
                $time_out_date = date('Y-m-d');
                $time_out = date('H:i:00');

                $notification_details = $api->get_notification_details(2);
                $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                $notification_message = str_replace('{date}', $api->check_date('empty', $time_out_date, '', 'F d, Y', '', '', ''), $notification_message);
                $notification_message = str_replace('{time}', $api->check_date('empty', $time_out, '', 'h:i a', '', '', ''), $notification_message);

                $get_employee_attendance_details = $api->get_employee_attendance_details($attendance_id);
                $time_in_date = $get_employee_attendance_details[0]['TIME_IN_DATE'];
                $time_in = $get_employee_attendance_details[0]['TIME_IN'];

                $early_leaving = $api->get_attendance_early_leaving_total($employee_id, $time_in_date, $time_out);
                $overtime = $api->get_attendance_overtime_total($employee_id, $time_in_date, $time_out_date, $time_out);
                $total_hours_worked = $api->get_attendance_total_hours($employee_id, $time_in_date, $time_in, $time_out_date, $time_out);
                $time_out_behavior = $api->get_time_out_behavior($employee_id, $time_in_date, $time_out_date, $time_out);

                $time_difference = round(abs(strtotime($time_out_date . ' ' . $time_out) - strtotime($time_in_date . ' ' . $time_in)) / 60, 2);

                if($time_difference > $time_out_allowance){
                    if (!filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)){
                        if($get_clock_in_total < $max_attendance){
                            $update_time_out = $api->update_time_out($attendance_id, $time_out_date, $time_out, $attendance_position, $ip_address, $time_out_behavior, 'Scanned', $early_leaving, $overtime, $total_hours_worked, $username);
    
                            if($update_time_out > 0){
                                $send_notification = $api->send_notification(2, null, $employee_id, $notification_title, $notification_message, $username);

                                if($send_notification){
                                    echo 'Time Out';
                                }
                                else{
                                    echo $send_notification;
                                }
                            }
                            else{
                                echo $update_time_out;
                            }
                        }
                        else{
                            echo 'Max Attendance';
                        }
                    }
                    else{
                        if(!empty($attendance_position)){
                            $update_time_out = $api->update_time_out($attendance_id, $time_out_date, $time_out, $attendance_position, $ip_address, $time_out_behavior, 'Scanned', $early_leaving, $overtime, $total_hours_worked, $username);
    
                            if($update_time_out > 0){
                                $send_notification = $api->send_notification(2, null, $employee_id, $notification_title, $notification_message, $username);

                                if($send_notification){
                                    echo 'Time Out';
                                }
                                else{
                                    echo $send_notification;
                                }
                            }
                            else{
                                echo $update_time_out;
                            }
                        }
                        else{
                            echo 'Location';
                        }
                    }
                }
                else{
                    echo 'Time Allowance';
                }
            }
            else{
                $time_in_date = date('Y-m-d');
                $time_in = date('H:i:00');
                $time_in_behavior = $api->get_time_in_behavior($employee_id, $time_in_date, $time_in);
                $late = $api->get_attendance_late_total($employee_id, $time_in_date, $time_in);
                
                $notification_details = $api->get_notification_details(1);
                $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                $notification_message = str_replace('{date}', $api->check_date('empty', $time_in_date, '', 'F d, Y', '', '', ''), $notification_message);
                $notification_message = str_replace('{time}', $api->check_date('empty', $time_in, '', 'h:i a', '', '', ''), $notification_message);
    
                if (!filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)){
                    if($get_clock_in_total < $max_attendance){
                        $insert_time_in = $api->insert_time_in($employee_id, $time_in_date, $time_in, $attendance_position, $ip_address, $time_in_behavior, 'Scanned', $late, $username);
    
                        if($insert_time_in > 0){
                            $send_notification = $api->send_notification(1, null, $employee_id, $notification_title, $notification_message, $username);

                            if($send_notification){
                                echo 'Time In';
                            }
                            else{
                                echo $send_notification;
                            }
                        }
                        else{
                            echo $insert_time_in;
                        }
                    }
                    else{
                        echo 'Max Attendance';
                    }
                }
                else{
                    if(!empty($attendance_position)){
                        $insert_time_in = $api->insert_time_in($employee_id, $time_in_date, $time_in, $attendance_position, $ip_address, $time_in_behavior, 'Scanned', $late, $username);
    
                        if($insert_time_in > 0){
                            $send_notification = $api->send_notification(1, null, $employee_id, $notification_title, $notification_message, $username);

                            if($send_notification){
                                echo 'Time In';
                            }
                            else{
                                echo $send_notification;
                            }
                        }
                        else{
                            echo $insert_time_in;
                        }
                    }
                    else{
                        echo 'Location';
                    }
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit location
    else if($transaction == 'submit location'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['position']) && isset($_POST['remarks'])){
            $username = $_POST['username'];
            $position = $_POST['position'];
            $remarks = $_POST['remarks'];

            $employee_details = $api->get_employee_details('', $username);
            $employee_id = $employee_details[0]['EMPLOYEE_ID'];

            if(!empty($position)){
                $insert_location = $api->insert_location($employee_id, $position, $system_date, $current_time, $remarks, $username);

                if($insert_location){
                   echo 'Inserted';
                }
                else{
                   echo $insert_location;
                }
            }
            else{
                echo 'Location';
            }
        }
    }
    # -------------------------------------------------------------

    # Submit attendance creation
    else if($transaction == 'submit attendance creation'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && isset($_POST['time_in_date']) && !empty($_POST['time_in_date']) && isset($_POST['time_in']) && !empty($_POST['time_in']) && isset($_POST['time_out_date']) && isset($_POST['time_out']) && isset($_POST['reason']) && !empty($_POST['reason'])){
            $file_type = '';
            $username = $_POST['username'];
            $request_id = $_POST['request_id'];
            $time_in_date = $api->check_date('empty', $_POST['time_in_date'], '', 'Y-m-d', '', '', '');
            $time_in = $api->check_date('empty', $_POST['time_in'], '', 'H:i:s', '', '', '');
            $time_out_date = $api->check_date('empty', $_POST['time_out_date'], '', 'Y-m-d', '', '', '');
            $time_out = $api->check_date('empty', $_POST['time_out'], '', 'H:i:s', '', '', '');
            $reason = $_POST['reason'];

            $employee_details = $api->get_employee_details('', $username);
            $employee_id = $employee_details[0]['EMPLOYEE_ID'];

            $attendance_creation_file_name = $_FILES['file']['name'];
            $attendance_creation_file_size = $_FILES['file']['size'];
            $attendance_creation_file_error = $_FILES['file']['error'];
            $attendance_creation_file_tmp_name = $_FILES['file']['tmp_name'];
            $attendance_creation_file_ext = explode('.', $attendance_creation_file_name);
            $attendance_creation_file_actual_ext = strtolower(end($attendance_creation_file_ext));

            $upload_setting_details = $api->get_upload_setting_details(9);
            $upload_file_type_details = $api->get_upload_file_type_details(9);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            $check_attendance_validation = $api->check_attendance_validation($time_in_date, $time_in, $time_out_date, $time_out);

            if(empty($check_attendance_validation)){
                $check_attendance_creation_exist = $api->check_attendance_creation_exist($request_id);
 
                if($check_attendance_creation_exist > 0){
                    if(!empty($attendance_creation_file_tmp_name)){
                        if(in_array($attendance_creation_file_actual_ext, $allowed_ext)){
                            if(!$attendance_creation_file_error){
                                if($attendance_creation_file_size < $file_max_size){
                                    $update_attendance_creation_file = $api->update_attendance_creation_file($attendance_creation_file_tmp_name, $attendance_creation_file_actual_ext, $request_id, $username);
            
                                    if($update_attendance_creation_file){
                                        $update_attendance_creation = $api->update_attendance_creation($request_id, $time_in_date, $time_in, $time_out_date, $time_out, $reason, $username);

                                        if($update_attendance_creation){
                                            echo 'Updated';
                                        }
                                        else{
                                            echo $update_attendance_creation;
                                        }
                                    }
                                    else{
                                        echo $update_attendance_creation_file;
                                    }
                                }
                                else{
                                    echo 'File Size';
                                }
                            }
                            else{
                                echo 'There was an error uploading the file.';
                            }
                        }
                        else{
                            echo 'File Type';
                        }
                    }
                    else{
                        $update_attendance_creation = $api->update_attendance_creation($request_id, $time_in_date, $time_in, $time_out_date, $time_out, $reason, $username);

                        if($update_attendance_creation){
                            echo 'Updated';
                        }
                        else{
                            echo $update_attendance_creation;
                        }
                    }
                }
                else{
                    if(in_array($attendance_creation_file_actual_ext, $allowed_ext)){
                        if(!$attendance_creation_file_error){
                            if($attendance_creation_file_size < $file_max_size){
                                $insert_attendance_creation = $api->insert_attendance_creation($attendance_creation_file_tmp_name, $attendance_creation_file_actual_ext, $employee_id, $time_in_date, $time_in, $time_out_date, $time_out, $reason, $system_date, $current_time, $username);

                                if($insert_attendance_creation){
                                    echo 'Inserted';
                                }
                                else{
                                    echo $insert_attendance_creation;
                                }
                            }
                            else{
                                echo 'File Size';
                            }
                        }
                        else{
                            echo 'There was an error uploading the file.';
                        }
                    }
                    else{
                        echo 'File Type';
                    }
                }
            }
            else{
                echo $check_attendance_validation;
            }
        }
    }
    # -------------------------------------------------------------

    # Submit attendance adjustment
    else if($transaction == 'submit attendance adjustment'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['attendance_id']) && isset($_POST['time_in_date']) && !empty($_POST['time_in_date']) && isset($_POST['time_in']) && !empty($_POST['time_in']) && isset($_POST['reason']) && !empty($_POST['reason'])){
            $file_type = '';
            $username = $_POST['username'];
            $attendance_id = $_POST['attendance_id'];
            $time_in_date = $api->check_date('empty', $_POST['time_in_date'], '', 'Y-m-d', '', '', '');
            $time_in = $api->check_date('empty', $_POST['time_in'], '', 'H:i:s', '', '', '');
            $reason = $_POST['reason'];

            if(isset($_POST['time_out_date']) && isset($_POST['time_out'])){
                $time_out_date = $api->check_date('empty', $_POST['time_out_date'], '', 'Y-m-d', '', '', '');
                $time_out = $api->check_date('empty', $_POST['time_out'], '', 'H:i:s', '', '', '');
            }
            else{
                $time_out_date = null;
                $time_out = null;
            }

            $get_employee_attendance_details = $api->get_employee_attendance_details($attendance_id);
            $time_in_date_default = $api->check_date('empty', $get_employee_attendance_details[0]['TIME_IN_DATE'], '', 'Y-m-d', '', '', '');
            $time_in_default = $api->check_date('empty', $get_employee_attendance_details[0]['TIME_IN'], '', 'H:i:00', '', '', '');
            $time_out_date_default = $api->check_date('empty', $get_employee_attendance_details[0]['TIME_OUT_DATE'], '', 'Y-m-d', '', '', '');
            $time_out_default = $api->check_date('empty', $get_employee_attendance_details[0]['TIME_OUT'], '', 'H:i:00', '', '', '');

            $employee_details = $api->get_employee_details('', $username);
            $employee_id = $employee_details[0]['EMPLOYEE_ID'];

            $attendance_adjustment_file_name = $_FILES['file']['name'];
            $attendance_adjustment_file_size = $_FILES['file']['size'];
            $attendance_adjustment_file_error = $_FILES['file']['error'];
            $attendance_adjustment_file_tmp_name = $_FILES['file']['tmp_name'];
            $attendance_adjustment_file_ext = explode('.', $attendance_adjustment_file_name);
            $attendance_adjustment_file_actual_ext = strtolower(end($attendance_adjustment_file_ext));

            $upload_setting_details = $api->get_upload_setting_details(10);
            $upload_file_type_details = $api->get_upload_file_type_details(10);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            $check_attendance_validation = $api->check_attendance_validation($time_in_date, $time_in, $time_out_date, $time_out);

            if(empty($check_attendance_validation)){
                if(in_array($attendance_adjustment_file_actual_ext, $allowed_ext)){
                    if(!$attendance_adjustment_file_error){
                        if($attendance_adjustment_file_size < $file_max_size){
                            $insert_attendance_adjustment = $api->insert_attendance_adjustment($attendance_adjustment_file_tmp_name, $attendance_adjustment_file_actual_ext, $employee_id, $attendance_id, $time_in_date_default, $time_in_default, $time_in_date, $time_in, $time_out_date_default, $time_out_default, $time_out_date, $time_out, $reason, $system_date, $current_time, $username);

                            if($insert_attendance_adjustment){
                                echo 'Inserted';
                            }
                            else{
                                echo $insert_attendance_adjustment;
                            }
                        }
                        else{
                            echo 'File Size';
                        }
                    }
                    else{
                        echo 'There was an error uploading the file.';
                    }
                }
                else{
                    echo 'File Type';
                }
            }
            else{
                echo $check_attendance_validation;
            }
        }
    }
    # -------------------------------------------------------------

    # Submit attendance adjustment update
    else if($transaction == 'submit attendance adjustment update'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && isset($_POST['time_in_date']) && !empty($_POST['time_in_date']) && isset($_POST['time_in']) && !empty($_POST['time_in']) && isset($_POST['reason']) && !empty($_POST['reason'])){
            $file_type = '';
            $username = $_POST['username'];
            $request_id = $_POST['request_id'];
            $time_in_date = $api->check_date('empty', $_POST['time_in_date'], '', 'Y-m-d', '', '', '');
            $time_in = $api->check_date('empty', $_POST['time_in'], '', 'H:i:s', '', '', '');
            $reason = $_POST['reason'];

            if(isset($_POST['time_out_date']) && isset($_POST['time_out'])){
                $time_out_date = $api->check_date('empty', $_POST['time_out_date'], '', 'Y-m-d', '', '', '');
                $time_out = $api->check_date('empty', $_POST['time_out'], '', 'H:i:s', '', '', '');
            }
            else{
                $time_out_date = null;
                $time_out = null;
            }

            $attendance_adjustment_file_name = $_FILES['file']['name'];
            $attendance_adjustment_file_size = $_FILES['file']['size'];
            $attendance_adjustment_file_error = $_FILES['file']['error'];
            $attendance_adjustment_file_tmp_name = $_FILES['file']['tmp_name'];
            $attendance_adjustment_file_ext = explode('.', $attendance_adjustment_file_name);
            $attendance_adjustment_file_actual_ext = strtolower(end($attendance_adjustment_file_ext));

            $upload_setting_details = $api->get_upload_setting_details(10);
            $upload_file_type_details = $api->get_upload_file_type_details(10);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            $check_attendance_validation = $api->check_attendance_validation($time_in_date, $time_in, $time_out_date, $time_out);

            if(empty($check_attendance_validation)){
                $check_attendance_adjustment_exist = $api->check_attendance_adjustment_exist($request_id);
 
                if($check_attendance_adjustment_exist > 0){
                    if(!empty($attendance_adjustment_file_tmp_name)){
                        if(in_array($attendance_adjustment_file_actual_ext, $allowed_ext)){
                            if(!$attendance_adjustment_file_error){
                                if($attendance_adjustment_file_size < $file_max_size){
                                    $update_attendance_adjustment = $api->update_attendance_adjustment($request_id, $time_in_date, $time_in, $time_out_date, $time_out, $reason, $username);
        
                                    if($update_attendance_adjustment){
                                        $update_attendance_adjustment_file = $api->update_attendance_adjustment_file($attendance_adjustment_file_tmp_name, $attendance_adjustment_file_actual_ext, $request_id, $username);
                
                                        if($update_attendance_adjustment_file){
                                            echo 'Updated';
                                        }
                                        else{
                                            echo $update_attendance_adjustment_file;
                                        }
                                    }
                                    else{
                                        echo $update_attendance_adjustment;
                                    }
                                }
                                else{
                                    echo 'File Size';
                                }
                            }
                            else{
                                echo 'There was an error uploading the file.';
                            }
                        }
                        else{
                            echo 'File Type';
                        }
                    }
                    else{
                        $update_attendance_adjustment = $api->update_attendance_adjustment($request_id, $time_in_date, $time_in, $time_out_date, $time_out, $reason, $username);
        
                        if($update_attendance_adjustment){
                            echo 'Updated';
                        }
                        else{
                            echo $update_attendance_adjustment;
                        }
                    }
                }
                else{
                    echo 'Not Found';
                }
            }
            else{
                echo $check_attendance_validation;
            }
        }
    }
    # -------------------------------------------------------------

    # Submit employee leave
    else if($transaction == 'submit employee leave'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_type']) && !empty($_POST['leave_type']) && isset($_POST['leave_duration']) && !empty($_POST['leave_duration']) && isset($_POST['reason']) && !empty($_POST['reason']) && isset($_POST['leave_date']) && !empty($_POST['leave_date'])){
            $error = '';
            $username = $_POST['username'];
            $employee_details = $api->get_employee_details('', $username);
            $employee_id = $employee_details[0]['EMPLOYEE_ID'];
            $leave_type = $_POST['leave_type'];
            $leave_duration = $_POST['leave_duration'];
            $reason = $_POST['reason'];
            $leave_dates = explode(',', $_POST['leave_date']);

            $from_department = $employee_details[0]['DEPARTMENT'] ?? null;
            $from_file_as = $employee_details[0]['FILE_AS'] ?? null;

            $department_details = $api->get_department_details($from_department);
            $department_head = $department_details[0]['DEPARTMENT_HEAD'];

            $notification_details = $api->get_notification_details(15);
            $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
            $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
            $notification_message = str_replace('{name}', $from_file_as, $notification_message);

            foreach($leave_dates as $leave_date){
                $leave_date = $api->check_date('empty', $leave_date, '', 'Y-m-d', '', '', '');
                $leave_day = $api->check_week_day($api->check_date('empty', $leave_date, '', 'w', '', '', ''));

                $work_shift_schedule = $api->get_work_shift_schedule($employee_id, $leave_date, $leave_day);
                $work_shift_time_in = $work_shift_schedule[0]['START_TIME'];
                $work_shift_time_out = $work_shift_schedule[0]['END_TIME'];
                $work_shift_half_day_mark = $work_shift_schedule[0]['HALF_DAY_MARK'];

                if($leave_duration == 'CUSTOM'){
                    $start_time = $api->check_date('empty', $_POST['start_time'], '', 'H:i:00', '', '', '');
                    $end_time = $api->check_date('empty', $_POST['start_time'], '', 'H:i:00', '', '', '');
                }
                else if($leave_duration == 'HLFDAYMOR' || $leave_duration == 'HLFDAYAFT'){
                    if($leave_duration == 'HLFDAYMOR'){
                        $start_time = $api->check_date('empty', $work_shift_time_in, '', 'H:i:00', '', '', '');
                        $end_time = $api->check_date('empty', $work_shift_half_day_mark, '', 'H:i:00', '', '', '');
                    }
                    else{
                        $start_time = $api->check_date('empty', $work_shift_half_day_mark, '', 'H:i:00', '', '', '');
                        $end_time = $api->check_date('empty', $work_shift_time_out, '', 'H:i:00', '', '', '');
                    }
                }
                else{
                    $start_time = $api->check_date('empty', $work_shift_time_in, '', 'H:i:00', '', '', '');
                    $end_time = $api->check_date('empty', $work_shift_time_out, '', 'H:i:00', '', '', '');
                }

                $total_working_hours = round(abs(strtotime($work_shift_time_out) - strtotime($work_shift_time_in)) / 3600, 2);
                $total_leave_hours = round(abs(strtotime($end_time) - strtotime($start_time)) / 3600, 2);

                if($total_working_hours != $total_leave_hours){
                    $total_hours = ($total_working_hours - $total_leave_hours) / $total_working_hours;
                }
                else{
                    $total_hours = 1;
                }
                
                $get_available_leave_entitlement = $api->get_available_leave_entitlement($employee_id, $leave_type, $leave_date);

                if($get_available_leave_entitlement > 0){
                    $insert_leave = $api->insert_leave($employee_id, $leave_type, $leave_date, $start_time, $end_time, 'PEN', $reason, null, null, null, $username);

                    if($insert_leave){
                        $update_leave_entitlement_count = $api->update_leave_entitlement_count($employee_id, $leave_type, $leave_date, $total_hours, $username);

                        if(!$update_leave_entitlement_count){
                            $error = $update_leave_entitlement_count;
                            break;
                        }
                    }
                    else{
                        $error = $insert_leave;
                        break;
                    }
                }
                else{
                    $error = 'Leave Entitlement';
                    break;
                }
            }

            if(empty($error)){
                $send_notification = $api->send_notification(15, $employee_id, $department_head, $notification_title, $notification_message, $username);
    
                if($send_notification){
                    echo 'Inserted';
                }
                else{
                    echo $send_notification;
                }
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Submit allowance type
    else if($transaction == 'submit allowance type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['allowance_type_id']) && isset($_POST['allowance_type']) && !empty($_POST['allowance_type']) && isset($_POST['taxable']) && !empty($_POST['taxable']) && isset($_POST['description']) && !empty($_POST['description'])){
            $username = $_POST['username'];
            $allowance_type_id = $_POST['allowance_type_id'];
            $allowance_type = $_POST['allowance_type'];
            $taxable = $_POST['taxable'];
            $description = $_POST['description'];

            $check_allowance_type_exist = $api->check_allowance_type_exist($allowance_type_id);

            if($check_allowance_type_exist > 0){
                $update_allowance_type = $api->update_allowance_type($allowance_type_id, $allowance_type, $taxable, $description, $username);

                if($update_allowance_type){
                    echo 'Updated';
                }
                else{
                    echo $update_allowance_type;
                }
            }
            else{
                $insert_allowance_type = $api->insert_allowance_type($allowance_type, $taxable, $description, $username);

                if($insert_allowance_type){
                    echo 'Inserted';
                }
                else{
                    echo $insert_allowance_type;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit allowance
    else if($transaction == 'submit allowance'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['allowance_type']) && !empty($_POST['allowance_type']) && isset($_POST['amount']) && !empty($_POST['amount']) && isset($_POST['start_date']) && !empty($_POST['start_date']) && isset($_POST['recurrence_pattern']) && isset($_POST['recurrence'])){
            $username = $_POST['username'];
            $employee_ids = explode(',', $_POST['employee_id']);
            $allowance_type = $_POST['allowance_type'];
            $amount = $_POST['amount'];
            $recurrence_pattern = $_POST['recurrence_pattern'];
            $recurrence = $_POST['recurrence'];
            $start_date = $api->check_date('empty', $_POST['start_date'], '', 'Y-m-d', '', '', '');

            foreach($employee_ids as $employee_id){
                if(!empty($start_date) && !empty($recurrence_pattern) && $recurrence > 0){
                    for($i = 0; $i < $recurrence; $i++){
                        if($i == 0){
                            $payroll_date = $start_date;
                        }
                        else{
                            $payroll_date = $api->check_date('empty', $api->get_next_date($payroll_date, $recurrence_pattern), '', 'Y-m-d', '', '', '');
                        }
    
                        $insert_allowance = $api->insert_allowance($employee_id, $allowance_type, $payroll_date, $amount, $username);
    
                        if(!$insert_allowance){
                            $error = $insert_allowance;
                        }
                    }
                }
                else{
                    $insert_allowance = $api->insert_allowance($employee_id, $allowance_type, $start_date, $amount, $username);

                    if(!$insert_allowance){
                        $error =  $insert_allowance;
                    }
                }
            }
            
            if(empty($error)){
                echo 'Inserted';
            }
            else{
                echo $error;
            }              
        }
    }
    # -------------------------------------------------------------

    # Submit allowance update
    else if($transaction == 'submit allowance update'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['allowance_id']) && !empty($_POST['allowance_id']) && isset($_POST['amount']) && !empty($_POST['amount']) && isset($_POST['payroll_date']) && !empty($_POST['payroll_date'])){
            $username = $_POST['username'];
            $allowance_id = $_POST['allowance_id'];
            $amount = $_POST['amount'];
            $payroll_date = $api->check_date('empty', $_POST['payroll_date'], '', 'Y-m-d', '', '', '');

            $check_allowance_exist = $api->check_allowance_exist($allowance_id);

            if($check_allowance_exist > 0){
                $update_allowance = $api->update_allowance($allowance_id, $payroll_date, $amount, $username);

                if($update_allowance){
                    echo 'Updated';
                }
                else{
                    echo $update_allowance;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Submit other income type
    else if($transaction == 'submit other income type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['other_income_type_id']) && isset($_POST['other_income_type']) && !empty($_POST['other_income_type']) && isset($_POST['taxable']) && !empty($_POST['taxable']) && isset($_POST['description']) && !empty($_POST['description'])){
            $username = $_POST['username'];
            $other_income_type_id = $_POST['other_income_type_id'];
            $other_income_type = $_POST['other_income_type'];
            $taxable = $_POST['taxable'];
            $description = $_POST['description'];

            $check_other_income_type_exist = $api->check_other_income_type_exist($other_income_type_id);

            if($check_other_income_type_exist > 0){
                $update_other_income_type = $api->update_other_income_type($other_income_type_id, $other_income_type, $taxable, $description, $username);

                if($update_other_income_type){
                    echo 'Updated';
                }
                else{
                    echo $update_other_income_type;
                }
            }
            else{
                $insert_other_income_type = $api->insert_other_income_type($other_income_type, $taxable, $description, $username);

                if($insert_other_income_type){
                    echo 'Inserted';
                }
                else{
                    echo $insert_other_income_type;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit other income
    else if($transaction == 'submit other income'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['other_income_type']) && !empty($_POST['other_income_type']) && isset($_POST['amount']) && !empty($_POST['amount']) && isset($_POST['start_date']) && !empty($_POST['start_date']) && isset($_POST['recurrence_pattern']) && isset($_POST['recurrence'])){
            $username = $_POST['username'];
            $employee_ids = explode(',', $_POST['employee_id']);
            $other_income_type = $_POST['other_income_type'];
            $amount = $_POST['amount'];
            $recurrence_pattern = $_POST['recurrence_pattern'];
            $recurrence = $_POST['recurrence'];
            $start_date = $api->check_date('empty', $_POST['start_date'], '', 'Y-m-d', '', '', '');

            foreach($employee_ids as $employee_id){
                if(!empty($start_date) && !empty($recurrence_pattern) && $recurrence > 0){
                    for($i = 0; $i < $recurrence; $i++){
                        if($i == 0){
                            $payroll_date = $start_date;
                        }
                        else{
                            $payroll_date = $api->check_date('empty', $api->get_next_date($payroll_date, $recurrence_pattern), '', 'Y-m-d', '', '', '');
                        }
    
                        $insert_other_income = $api->insert_other_income($employee_id, $other_income_type, $payroll_date, $amount, $username);
    
                        if(!$insert_other_income){
                            $error = $insert_other_income;
                        }
                    }
                }
                else{
                    $insert_other_income = $api->insert_other_income($employee_id, $other_income_type, $start_date, $amount, $username);

                    if(!$insert_other_income){
                        $error =  $insert_other_income;
                    }
                }
            }
            
            if(empty($error)){
                echo 'Inserted';
            }
            else{
                echo $error;
            }              
        }
    }
    # -------------------------------------------------------------

    # Submit other income update
    else if($transaction == 'submit other income update'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['other_income_id']) && !empty($_POST['other_income_id']) && isset($_POST['amount']) && !empty($_POST['amount']) && isset($_POST['payroll_date']) && !empty($_POST['payroll_date'])){
            $username = $_POST['username'];
            $other_income_id = $_POST['other_income_id'];
            $amount = $_POST['amount'];
            $payroll_date = $api->check_date('empty', $_POST['payroll_date'], '', 'Y-m-d', '', '', '');

            $check_other_income_exist = $api->check_other_income_exist($other_income_id);

            if($check_other_income_exist > 0){
                $update_other_income = $api->update_other_income($other_income_id, $payroll_date, $amount, $username);

                if($update_other_income){
                    echo 'Updated';
                }
                else{
                    echo $update_other_income;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Submit deduction type
    else if($transaction == 'submit deduction type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['deduction_type_id']) && isset($_POST['deduction_type']) && !empty($_POST['deduction_type']) && isset($_POST['description']) && !empty($_POST['description'])){
            $username = $_POST['username'];
            $deduction_type_id = $_POST['deduction_type_id'];
            $deduction_type = $_POST['deduction_type'];
            $description = $_POST['description'];

            $check_deduction_type_exist = $api->check_deduction_type_exist($deduction_type_id);

            if($check_deduction_type_exist > 0){
                $update_deduction_type = $api->update_deduction_type($deduction_type_id, $deduction_type, $description, $username);

                if($update_deduction_type){
                    echo 'Updated';
                }
                else{
                    echo $update_deduction_type;
                }
            }
            else{
                $insert_deduction_type = $api->insert_deduction_type($deduction_type, $description, $username);

                if($insert_deduction_type){
                    echo 'Inserted';
                }
                else{
                    echo $insert_deduction_type;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit government contribution
    else if($transaction == 'submit government contribution'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['government_contribution_id']) && isset($_POST['government_contribution']) && !empty($_POST['government_contribution']) && isset($_POST['description']) && !empty($_POST['description'])){
            $username = $_POST['username'];
            $government_contribution_id = $_POST['government_contribution_id'];
            $government_contribution = $_POST['government_contribution'];
            $description = $_POST['description'];

            $check_government_contribution_exist = $api->check_government_contribution_exist($government_contribution_id);

            if($check_government_contribution_exist > 0){
                $update_government_contribution = $api->update_government_contribution($government_contribution_id, $government_contribution, $description, $username);

                if($update_government_contribution){
                    echo 'Updated';
                }
                else{
                    echo $update_government_contribution;
                }
            }
            else{
                $insert_government_contribution = $api->insert_government_contribution($government_contribution, $description, $username);

                if($insert_government_contribution){
                    echo 'Inserted';
                }
                else{
                    echo $insert_government_contribution;
                }
            }
        }
    }
    # -------------------------------------------------------------
    
    # Submit contribution bracket
    else if($transaction == 'submit contribution bracket'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['contribution_bracket_id']) && isset($_POST['government_contribution_id']) && !empty($_POST['government_contribution_id']) && isset($_POST['start_range']) && isset($_POST['end_range']) && isset($_POST['deduction_amount'])){
            $username = $_POST['username'];
            $contribution_bracket_id = $_POST['contribution_bracket_id'];
            $government_contribution_id = $_POST['government_contribution_id'];
            $start_range = $_POST['start_range'];
            $end_range = $_POST['end_range'];
            $deduction_amount = $_POST['deduction_amount'];

            $check_contribution_bracket_exist = $api->check_contribution_bracket_exist($contribution_bracket_id);

            if($check_contribution_bracket_exist > 0){
                $check_start_contribution_bracket_range_overlap = $api->check_contribution_bracket_overlap($contribution_bracket_id, $government_contribution_id, $start_range);
                $check_end_contribution_bracket_range_overlap = $api->check_contribution_bracket_overlap($contribution_bracket_id, $government_contribution_id, $end_range);

                if($check_start_contribution_bracket_range_overlap == 0 && $check_end_contribution_bracket_range_overlap == 0){
                    $update_contribution_bracket = $api->update_contribution_bracket($contribution_bracket_id, $start_range, $end_range, $deduction_amount, $username);

                    if($update_contribution_bracket){
                        echo 'Updated';
                    }
                    else{
                        echo $update_contribution_bracket;
                    }
                }
                else{
                    echo 'Overlap';
                }
            }
            else{
                $check_start_contribution_bracket_range_overlap = $api->check_contribution_bracket_overlap(null, $government_contribution_id, $start_range);
                $check_end_contribution_bracket_range_overlap = $api->check_contribution_bracket_overlap(null, $government_contribution_id, $end_range);

                if($check_start_contribution_bracket_range_overlap == 0 && $check_end_contribution_bracket_range_overlap == 0){
                    $insert_contribution_bracket = $api->insert_contribution_bracket($government_contribution_id, $start_range, $end_range, $deduction_amount, $username);

                    if($insert_contribution_bracket){
                        echo 'Inserted';
                    }
                    else{
                        echo $insert_contribution_bracket;
                    }
                }
                else{
                    echo 'Overlap';
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit deduction
    else if($transaction == 'submit deduction'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['deduction_type']) && !empty($_POST['deduction_type']) && isset($_POST['amount']) && !empty($_POST['amount']) && isset($_POST['start_date']) && !empty($_POST['start_date']) && isset($_POST['recurrence_pattern']) && isset($_POST['recurrence'])){
            $username = $_POST['username'];
            $employee_ids = explode(',', $_POST['employee_id']);
            $deduction_type = $_POST['deduction_type'];
            $amount = $_POST['amount'];
            $recurrence_pattern = $_POST['recurrence_pattern'];
            $recurrence = $_POST['recurrence'];
            $start_date = $api->check_date('empty', $_POST['start_date'], '', 'Y-m-d', '', '', '');

            foreach($employee_ids as $employee_id){
                if(!empty($start_date) && !empty($recurrence_pattern) && $recurrence > 0){
                    for($i = 0; $i < $recurrence; $i++){
                        if($i == 0){
                            $payroll_date = $start_date;
                        }
                        else{
                            $payroll_date = $api->check_date('empty', $api->get_next_date($payroll_date, $recurrence_pattern), '', 'Y-m-d', '', '', '');
                        }
    
                        $insert_deduction = $api->insert_deduction($employee_id, $deduction_type, $payroll_date, $amount, $username);
    
                        if(!$insert_deduction){
                            $error = $insert_deduction;
                        }
                    }
                }
                else{
                    $insert_deduction = $api->insert_deduction($employee_id, $deduction_type, $start_date, $amount, $username);

                    if(!$insert_deduction){
                        $error =  $insert_deduction;
                    }
                }
            }
            
            if(empty($error)){
                echo 'Inserted';
            }
            else{
                echo $error;
            }              
        }
    }
    # -------------------------------------------------------------

    # Submit deduction update
    else if($transaction == 'submit deduction update'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['deduction_id']) && !empty($_POST['deduction_id']) && isset($_POST['amount']) && !empty($_POST['amount']) && isset($_POST['payroll_date']) && !empty($_POST['payroll_date'])){
            $username = $_POST['username'];
            $deduction_id = $_POST['deduction_id'];
            $amount = $_POST['amount'];
            $payroll_date = $api->check_date('empty', $_POST['payroll_date'], '', 'Y-m-d', '', '', '');

            $check_deduction_exist = $api->check_deduction_exist($deduction_id);

            if($check_deduction_exist > 0){
                $update_deduction = $api->update_deduction($deduction_id, $payroll_date, $amount, $username);

                if($update_deduction){
                    echo 'Updated';
                }
                else{
                    echo $update_deduction;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Submit contribution deduction
    else if($transaction == 'submit contribution deduction'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['government_contribution']) && !empty($_POST['government_contribution']) && isset($_POST['start_date']) && !empty($_POST['start_date']) && isset($_POST['recurrence_pattern']) && isset($_POST['recurrence'])){
            $username = $_POST['username'];
            $employee_ids = explode(',', $_POST['employee_id']);
            $government_contribution = $_POST['government_contribution'];
            $recurrence_pattern = $_POST['recurrence_pattern'];
            $recurrence = $_POST['recurrence'];
            $start_date = $api->check_date('empty', $_POST['start_date'], '', 'Y-m-d', '', '', '');

            foreach($employee_ids as $employee_id){
                if(!empty($start_date) && !empty($recurrence_pattern) && $recurrence > 0){
                    for($i = 0; $i < $recurrence; $i++){
                        if($i == 0){
                            $payroll_date = $start_date;
                        }
                        else{
                            $payroll_date = $api->check_date('empty', $api->get_next_date($payroll_date, $recurrence_pattern), '', 'Y-m-d', '', '', '');
                        }
    
                        $insert_contribution_deduction = $api->insert_contribution_deduction($employee_id, $government_contribution, $payroll_date, $username);
    
                        if(!$insert_contribution_deduction){
                            $error = $insert_contribution_deduction;
                        }
                    }
                }
                else{
                    $insert_contribution_deduction = $api->insert_contribution_deduction($employee_id, $government_contribution, $start_date, $username);

                    if(!$insert_contribution_deduction){
                        $error =  $insert_contribution_deduction;
                    }
                }
            }
            
            if(empty($error)){
                echo 'Inserted';
            }
            else{
                echo $error;
            }              
        }
    }
    # -------------------------------------------------------------

    # Submit contribution deduction update
    else if($transaction == 'submit contribution deduction update'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['contribution_deduction_id']) && !empty($_POST['contribution_deduction_id']) && isset($_POST['payroll_date']) && !empty($_POST['payroll_date'])){
            $username = $_POST['username'];
            $contribution_deduction_id = $_POST['contribution_deduction_id'];
            $payroll_date = $api->check_date('empty', $_POST['payroll_date'], '', 'Y-m-d', '', '', '');

            $check_contribution_deduction_exist = $api->check_contribution_deduction_exist($contribution_deduction_id);

            if($check_contribution_deduction_exist > 0){
                $update_contribution_deduction = $api->update_contribution_deduction($contribution_deduction_id, $payroll_date, $username);

                if($update_contribution_deduction){
                    echo 'Updated';
                }
                else{
                    echo $update_contribution_deduction;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Submit salary
    else if($transaction == 'submit salary'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['effectivity_date']) && !empty($_POST['effectivity_date']) && isset($_POST['salary_amount']) && !empty($_POST['salary_amount']) && isset($_POST['salary_frequency']) && !empty($_POST['salary_frequency']) && isset($_POST['hours_per_week']) && !empty($_POST['hours_per_week']) && isset($_POST['hours_per_day']) && !empty($_POST['hours_per_day']) && isset($_POST['minute_rate']) && !empty($_POST['minute_rate']) && isset($_POST['hourly_rate']) && !empty($_POST['hourly_rate']) && isset($_POST['daily_rate']) && !empty($_POST['daily_rate']) && isset($_POST['weekly_rate']) && !empty($_POST['weekly_rate']) && isset($_POST['bi_weekly_rate']) && !empty($_POST['bi_weekly_rate']) && isset($_POST['monthly_rate']) && !empty($_POST['monthly_rate']) && isset($_POST['remarks'])){
            $username = $_POST['username'];
            $employee_ids = explode(',', $_POST['employee_id']);
            $salary_amount = $_POST['salary_amount'];
            $salary_frequency = $_POST['salary_frequency'];
            $hours_per_week = $_POST['hours_per_week'];
            $hours_per_day = $_POST['hours_per_day'];
            $minute_rate = $_POST['minute_rate'];
            $hourly_rate = $_POST['hourly_rate'];
            $daily_rate = $_POST['daily_rate'];
            $weekly_rate = $_POST['weekly_rate'];
            $bi_weekly_rate = $_POST['bi_weekly_rate'];
            $monthly_rate = $_POST['monthly_rate'];
            $remarks = $_POST['remarks'];
            $effectivity_date = $api->check_date('empty', $_POST['effectivity_date'], '', 'Y-m-d', '', '', '');

            foreach($employee_ids as $employee_id){
                $check_salary_effectivity_date_conflict = $api->check_salary_effectivity_date_conflict(null, $employee_id, $effectivity_date);

                if($check_salary_effectivity_date_conflict == 0){
                    $insert_salary = $api->insert_salary($employee_id, $salary_amount, $salary_frequency, $hours_per_week, $hours_per_day, $minute_rate, $hourly_rate, $daily_rate, $weekly_rate, $bi_weekly_rate, $monthly_rate, $effectivity_date, $remarks, $username);
    
                    if(!$insert_salary){
                        $error = $insert_salary;
                    }
                }
                else{
                    $error = 'Overlap';
                }
            }
            
            if(empty($error)){
                echo 'Inserted';
            }
            else{
                echo $error;
            }    
        }
    }
    # -------------------------------------------------------------

    # Submit salary update
    else if($transaction == 'submit salary update'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['salary_id']) && !empty($_POST['salary_id']) && isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['effectivity_date']) && !empty($_POST['effectivity_date']) && isset($_POST['salary_amount']) && !empty($_POST['salary_amount']) && isset($_POST['salary_frequency']) && !empty($_POST['salary_frequency']) && isset($_POST['hours_per_week']) && !empty($_POST['hours_per_week']) && isset($_POST['hours_per_day']) && !empty($_POST['hours_per_day']) && isset($_POST['minute_rate']) && !empty($_POST['minute_rate']) && isset($_POST['hourly_rate']) && !empty($_POST['hourly_rate']) && isset($_POST['daily_rate']) && !empty($_POST['daily_rate']) && isset($_POST['weekly_rate']) && !empty($_POST['weekly_rate']) && isset($_POST['bi_weekly_rate']) && !empty($_POST['bi_weekly_rate']) && isset($_POST['monthly_rate']) && !empty($_POST['monthly_rate']) && isset($_POST['remarks'])){
            $username = $_POST['username'];
            $salary_id = $_POST['salary_id'];
            $employee_id = $_POST['employee_id'];
            $salary_amount = $_POST['salary_amount'];
            $salary_frequency = $_POST['salary_frequency'];
            $hours_per_week = $_POST['hours_per_week'];
            $hours_per_day = $_POST['hours_per_day'];
            $minute_rate = $_POST['minute_rate'];
            $hourly_rate = $_POST['hourly_rate'];
            $daily_rate = $_POST['daily_rate'];
            $weekly_rate = $_POST['weekly_rate'];
            $bi_weekly_rate = $_POST['bi_weekly_rate'];
            $monthly_rate = $_POST['monthly_rate'];
            $remarks = $_POST['remarks'];
            $effectivity_date = $api->check_date('empty', $_POST['effectivity_date'], '', 'Y-m-d', '', '', '');
            
            $check_salary_exist = $api->check_salary_exist($salary_id);

            if($check_salary_exist > 0){
                $salary_details = $api->get_salary_details($salary_id);
                $salary_effetivity_date = $salary_details[0]['EFFECTIVITY_DATE'];

                if(strtotime($salary_effetivity_date) != strtotime($effectivity_date)){
                    $check_salary_effectivity_date_conflict = $api->check_salary_effectivity_date_conflict($salary_id, $employee_id, $effectivity_date);

                    if($check_salary_effectivity_date_conflict == 0){
                        $update_salary = $api->update_salary($salary_id, $salary_amount, $salary_frequency, $hours_per_week, $hours_per_day, $minute_rate, $hourly_rate, $daily_rate, $weekly_rate, $bi_weekly_rate, $monthly_rate, $effectivity_date, $remarks, $username);

                        if($update_salary){
                            echo 'Updated';
                        }
                        else{
                            echo $update_salary;
                        }
                    }
                    else{
                        echo 'Overlap';
                    }
                }
                else{
                    $update_salary = $api->update_salary($salary_id, $salary_amount, $salary_frequency, $hours_per_week, $hours_per_day, $minute_rate, $hourly_rate, $daily_rate, $weekly_rate, $bi_weekly_rate, $monthly_rate, $effectivity_date, $remarks, $username);

                    if($update_salary){
                        echo 'Updated';
                    }
                    else{
                        echo $update_salary;
                    }
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Submit payroll setting
    else if($transaction == 'submit payroll setting'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['late_deduction_rate']) && isset($_POST['early_leaving_deduction_rate']) && isset($_POST['overtime_rate']) && isset($_POST['night_differential_rate'])){
            $error = '';
            $username = $_POST['username'];
            $setting_id = 1;
            $late_deduction_rate = $_POST['late_deduction_rate'];
            $early_leaving_deduction_rate = $_POST['early_leaving_deduction_rate'];
            $overtime_rate = $_POST['overtime_rate'];
            $night_differential_rate = $_POST['night_differential_rate'];

            $check_payroll_setting_exist = $api->check_payroll_setting_exist($setting_id);

            if($check_payroll_setting_exist > 0){
                $update_payroll_setting = $api->update_payroll_setting($setting_id, $late_deduction_rate, $early_leaving_deduction_rate, $overtime_rate, $night_differential_rate, $username);

                if($update_payroll_setting){
                    echo 'Updated';
                }
                else{
                    echo $update_payroll_setting;
                }
            }
            else{
                $insert_payroll_setting = $api->insert_payroll_setting($setting_id, $late_deduction_rate, $early_leaving_deduction_rate, $overtime_rate, $night_differential_rate, $username);

                if($insert_payroll_setting){
                    echo 'Updated';
                }
                else{
                    echo $insert_payroll_setting;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit payroll group
    else if($transaction == 'submit payroll group'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['payroll_group_id']) && isset($_POST['payroll_group']) && !empty($_POST['payroll_group']) && isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['description']) && !empty($_POST['description'])){
            $error = '';
            $username = $_POST['username'];
            $payroll_group_id = $_POST['payroll_group_id'];
            $payroll_group = $_POST['payroll_group'];
            $description = $_POST['description'];
            $employee_ids = explode(',', $_POST['employee_id']);

            $check_payroll_group_exist = $api->check_payroll_group_exist($payroll_group_id);

            if($check_payroll_group_exist > 0){
                $update_payroll_group = $api->update_payroll_group($payroll_group_id, $payroll_group, $description, $username);

                if($update_payroll_group){
                    $delete_all_payroll_group_employee = $api->delete_all_payroll_group_employee($payroll_group_id, $username);

                    if($delete_all_payroll_group_employee){
                        foreach($employee_ids as $employee_id){
                            $insert_payroll_group_employee = $api->insert_payroll_group_employee($payroll_group_id, $employee_id, $username);

                            if(!$insert_payroll_group_employee){
                                $error = $insert_payroll_group_employee;
                            }
                        }
                    }
                    else{
                        $error = $delete_all_payroll_group_employee;
                    }

                    if(empty($error)){
                        echo 'Updated';
                    }
                    else{
                        echo $error;
                    }
                }
                else{
                    echo $update_payroll_group;
                }
            }
            else{
                $insert_payroll_group = $api->insert_payroll_group($payroll_group, $description, $employee_ids, $username);

                if($insert_payroll_group){
                    echo 'Inserted';
                }
                else{
                    echo $insert_payroll_group;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit pay run
    else if($transaction == 'submit pay run'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['start_date']) && !empty($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['end_date']) && isset($_POST['consider_overtime'])&& isset($_POST['consider_withholding_tax']) && isset($_POST['payroll_group_id']) && isset($_POST['employee_id']) && isset($_POST['payslip_note'])){
            $error = '';
            $username = $_POST['username'];
            $consider_overtime = $_POST['consider_overtime'];
            $consider_withholding_tax = $_POST['consider_withholding_tax'];
            $payslip_note = $_POST['payslip_note'];
            $start_date = $api->check_date('empty', $_POST['start_date'], '', 'Y-m-d', '', '', '');
            $end_date = $api->check_date('empty', $_POST['end_date'], '', 'Y-m-d', '', '', '');

            $check_date_validation = $api->check_date_validation($start_date, $end_date);

            if(empty($check_date_validation)){
                if(!empty($_POST['payroll_group_id']) || !empty($_POST['employee_id'])){
                    $payroll_group_ids = explode(',', $_POST['payroll_group_id']);
                    $employee_ids = explode(',', $_POST['employee_id']);
                    $payees = array();
    
                    if(!empty($_POST['payroll_group_id']) && !empty($_POST['employee_id'])){
                        foreach($payroll_group_ids as $payroll_group_id){
                            $payroll_group_employee_details = $api->get_payroll_group_employee_details($payroll_group_id);
    
                            for($i = 0; $i < count($payroll_group_employee_details); $i++) {
                                $payroll_group_employee = $payroll_group_employee_details[$i]['EMPLOYEE_ID'];
    
                                if (!in_array($payroll_group_employee, $employee_ids)){
                                    $employee_ids[] = $payroll_group_employee; 
                                }
                            }
                        }
    
                        foreach($employee_ids as $employee_id){
                            $payees[] = $employee_id; 
                        }
                    }
                    else if(!empty($_POST['payroll_group_id']) && empty($_POST['employee_id'])){
                        foreach($payroll_group_ids as $payroll_group_id){
                            $payroll_group_employee_details = $api->get_payroll_group_employee_details($payroll_group_id);
    
                            for($i = 0; $i < count($payroll_group_employee_details); $i++) {
                                $payroll_group_employee = $payroll_group_employee_details[$i]['EMPLOYEE_ID'];
    
                                $payees[] = $payroll_group_employee;
                            }
                        }
                    }
                    else {
                        foreach($employee_ids as $employee_id){
                            $payees[] = $employee_id; 
                        }
                    }
    
                    $insert_pay_run = $api->insert_pay_run($start_date, $end_date, $payslip_note, $consider_overtime, $consider_withholding_tax, 0, 0, $payees, $username);
    
                    if($insert_pay_run){
                        echo 'Inserted';
                    }
                    else{
                        echo $insert_pay_run;
                    }
                }
                else{
                    echo 'Payee';
                }
            }
            else{
                echo $check_date_validation;
            }
        }
    }
    # -------------------------------------------------------------

    # Submit withholding tax
    else if($transaction == 'submit withholding tax'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['withholding_tax_id']) && isset($_POST['salary_frequency']) && !empty($_POST['salary_frequency']) && isset($_POST['start_range']) && isset($_POST['end_range']) && isset($_POST['base_tax']) && isset($_POST['fix_compensation_level']) && isset($_POST['percent_over'])){
            $username = $_POST['username'];
            $withholding_tax_id = $_POST['withholding_tax_id'];
            $salary_frequency = $_POST['salary_frequency'];
            $start_range = $_POST['start_range'];
            $end_range = $_POST['end_range'];
            $fix_compensation_level = $_POST['fix_compensation_level'];
            $base_tax = $_POST['base_tax'];
            $percent_over = $_POST['percent_over'];

            $check_withholding_tax_exist = $api->check_withholding_tax_exist($withholding_tax_id);

            if($check_withholding_tax_exist > 0){
                $check_start_withholding_tax_range_overlap = $api->check_withholding_tax_overlap($withholding_tax_id, $salary_frequency, $start_range);
                $check_end_withholding_tax_range_overlap = $api->check_withholding_tax_overlap($withholding_tax_id, $salary_frequency, $end_range);

                if($check_start_withholding_tax_range_overlap == 0 && $check_end_withholding_tax_range_overlap == 0){
                    $update_withholding_tax = $api->update_withholding_tax($withholding_tax_id, $salary_frequency, $start_range, $end_range, $fix_compensation_level, $base_tax, $percent_over, $username);

                    if($update_withholding_tax){
                        echo 'Updated';
                    }
                    else{
                        echo $update_withholding_tax;
                    }
                }
                else{
                    echo 'Overlap';
                }
            }
            else{
                $check_start_withholding_tax_range_overlap = $api->check_withholding_tax_overlap(null, $salary_frequency, $start_range);
                $check_end_withholding_tax_range_overlap = $api->check_withholding_tax_overlap(null, $salary_frequency, $end_range);

                if($check_start_withholding_tax_range_overlap == 0 && $check_end_withholding_tax_range_overlap == 0){
                    $insert_withholding_tax = $api->insert_withholding_tax($salary_frequency, $start_range, $end_range, $fix_compensation_level, $base_tax, $percent_over, $username);

                    if($insert_withholding_tax){
                        echo 'Inserted';
                    }
                    else{
                        echo $insert_withholding_tax;
                    }
                }
                else{
                    echo 'Overlap';
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit job category
    else if($transaction == 'submit job category'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['job_category_id']) && isset($_POST['job_category']) && !empty($_POST['job_category']) && isset($_POST['description']) && !empty($_POST['description'])){
            $username = $_POST['username'];
            $job_category_id = $_POST['job_category_id'];
            $job_category = $_POST['job_category'];
            $description = $_POST['description'];

            $check_job_category_exist = $api->check_job_category_exist($job_category_id);

            if($check_job_category_exist > 0){
                $update_job_category = $api->update_job_category($job_category_id, $job_category, $description, $username);

                if($update_job_category){
                    echo 'Updated';
                }
                else{
                    echo $update_job_category;
                }
            }
            else{
                $insert_job_category = $api->insert_job_category($job_category, $description, $username);

                if($insert_job_category){
                    echo 'Inserted';
                }
                else{
                    echo $insert_job_category;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit job type
    else if($transaction == 'submit job type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['job_type_id']) && isset($_POST['job_type']) && !empty($_POST['job_type']) && isset($_POST['description']) && !empty($_POST['description'])){
            $username = $_POST['username'];
            $job_type_id = $_POST['job_type_id'];
            $job_type = $_POST['job_type'];
            $description = $_POST['description'];

            $check_job_type_exist = $api->check_job_type_exist($job_type_id);

            if($check_job_type_exist > 0){
                $update_job_type = $api->update_job_type($job_type_id, $job_type, $description, $username);

                if($update_job_type){
                    echo 'Updated';
                }
                else{
                    echo $update_job_type;
                }
            }
            else{
                $insert_job_type = $api->insert_job_type($job_type, $description, $username);

                if($insert_job_type){
                    echo 'Inserted';
                }
                else{
                    echo $insert_job_type;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit recruitment pipeline
    else if($transaction == 'submit recruitment pipeline'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['recruitment_pipeline_id']) && isset($_POST['recruitment_pipeline']) && !empty($_POST['recruitment_pipeline']) && isset($_POST['description']) && !empty($_POST['description'])){
            $username = $_POST['username'];
            $recruitment_pipeline_id = $_POST['recruitment_pipeline_id'];
            $recruitment_pipeline = $_POST['recruitment_pipeline'];
            $description = $_POST['description'];

            $check_recruitment_pipeline_exist = $api->check_recruitment_pipeline_exist($recruitment_pipeline_id);

            if($check_recruitment_pipeline_exist > 0){
                $update_recruitment_pipeline = $api->update_recruitment_pipeline($recruitment_pipeline_id, $recruitment_pipeline, $description, $username);

                if($update_recruitment_pipeline){
                    echo 'Updated';
                }
                else{
                    echo $update_recruitment_pipeline;
                }
            }
            else{
                $insert_recruitment_pipeline = $api->insert_recruitment_pipeline($recruitment_pipeline, $description, $username);

                if($insert_recruitment_pipeline){
                    echo 'Inserted';
                }
                else{
                    echo $insert_recruitment_pipeline;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit recruitment pipeline stage
    else if($transaction == 'submit recruitment pipeline stage'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['recruitment_pipeline_stage_id']) && isset($_POST['recruitment_pipeline_id']) && !empty($_POST['recruitment_pipeline_id']) && isset($_POST['recruitment_pipeline_stage']) && !empty($_POST['recruitment_pipeline_stage']) && isset($_POST['description']) && !empty($_POST['description'])){
            $username = $_POST['username'];
            $recruitment_pipeline_stage_id = $_POST['recruitment_pipeline_stage_id'];
            $recruitment_pipeline_id = $_POST['recruitment_pipeline_id'];
            $recruitment_pipeline_stage = $_POST['recruitment_pipeline_stage'];
            $description = $_POST['description'];

            $check_recruitment_pipeline_stage_exist = $api->check_recruitment_pipeline_stage_exist($recruitment_pipeline_stage_id);

            if($check_recruitment_pipeline_stage_exist > 0){
                $update_recruitment_pipeline_stage = $api->update_recruitment_pipeline_stage($recruitment_pipeline_stage_id, $recruitment_pipeline_stage, $description, $username);

                if($update_recruitment_pipeline_stage){
                    echo 'Updated';
                }
                else{
                    echo $update_recruitment_pipeline_stage;
                }
            }
            else{
                $insert_recruitment_pipeline_stage = $api->insert_recruitment_pipeline_stage($recruitment_pipeline_id, $recruitment_pipeline_stage, $description, $username);

                if($insert_recruitment_pipeline_stage){
                    echo 'Inserted';
                }
                else{
                    echo $insert_recruitment_pipeline_stage;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit recruitment scorecard
    else if($transaction == 'submit recruitment scorecard'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['recruitment_scorecard_id']) && isset($_POST['recruitment_scorecard']) && !empty($_POST['recruitment_scorecard']) && isset($_POST['description']) && !empty($_POST['description'])){
            $username = $_POST['username'];
            $recruitment_scorecard_id = $_POST['recruitment_scorecard_id'];
            $recruitment_scorecard = $_POST['recruitment_scorecard'];
            $description = $_POST['description'];

            $check_recruitment_scorecard_exist = $api->check_recruitment_scorecard_exist($recruitment_scorecard_id);

            if($check_recruitment_scorecard_exist > 0){
                $update_recruitment_scorecard = $api->update_recruitment_scorecard($recruitment_scorecard_id, $recruitment_scorecard, $description, $username);

                if($update_recruitment_scorecard){
                    echo 'Updated';
                }
                else{
                    echo $update_recruitment_scorecard;
                }
            }
            else{
                $insert_recruitment_scorecard = $api->insert_recruitment_scorecard($recruitment_scorecard, $description, $username);

                if($insert_recruitment_scorecard){
                    echo 'Inserted';
                }
                else{
                    echo $insert_recruitment_scorecard;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit recruitment scorecard section
    else if($transaction == 'submit recruitment scorecard section'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['recruitment_scorecard_section_id']) && isset($_POST['recruitment_scorecard_id']) && !empty($_POST['recruitment_scorecard_id']) && isset($_POST['recruitment_scorecard_section']) && !empty($_POST['recruitment_scorecard_section']) && isset($_POST['description']) && !empty($_POST['description'])){
            $username = $_POST['username'];
            $recruitment_scorecard_section_id = $_POST['recruitment_scorecard_section_id'];
            $recruitment_scorecard_id = $_POST['recruitment_scorecard_id'];
            $recruitment_scorecard_section = $_POST['recruitment_scorecard_section'];
            $description = $_POST['description'];

            $check_recruitment_scorecard_section_exist = $api->check_recruitment_scorecard_section_exist($recruitment_scorecard_section_id);

            if($check_recruitment_scorecard_section_exist > 0){
                $update_recruitment_scorecard_section = $api->update_recruitment_scorecard_section($recruitment_scorecard_section_id, $recruitment_scorecard_section, $description, $username);

                if($update_recruitment_scorecard_section){
                    echo 'Updated';
                }
                else{
                    echo $update_recruitment_scorecard_section;
                }
            }
            else{
                $insert_recruitment_scorecard_section = $api->insert_recruitment_scorecard_section($recruitment_scorecard_id, $recruitment_scorecard_section, $description, $username);

                if($insert_recruitment_scorecard_section){
                    echo 'Inserted';
                }
                else{
                    echo $insert_recruitment_scorecard_section;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit recruitment scorecard section option
    else if($transaction == 'submit recruitment scorecard section option'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['recruitment_scorecard_section_option_id']) && isset($_POST['recruitment_scorecard_section_id']) && !empty($_POST['recruitment_scorecard_section_id']) && isset($_POST['recruitment_scorecard_section_option']) && !empty($_POST['recruitment_scorecard_section_option'])){
            $username = $_POST['username'];
            $recruitment_scorecard_section_option_id = $_POST['recruitment_scorecard_section_option_id'];
            $recruitment_scorecard_section_id = $_POST['recruitment_scorecard_section_id'];
            $recruitment_scorecard_section_option = $_POST['recruitment_scorecard_section_option'];

            $recruitment_scorecard_section_details = $api->get_recruitment_scorecard_section_details($recruitment_scorecard_section_id);
            $recruitment_scorecard_id = $recruitment_scorecard_section_details[0]['RECRUITMENT_SCORECARD_ID'];
             
            $check_recruitment_scorecard_section_option_exist = $api->check_recruitment_scorecard_section_option_exist($recruitment_scorecard_section_option_id);

            if($check_recruitment_scorecard_section_option_exist > 0){
                $update_recruitment_scorecard_section_option = $api->update_recruitment_scorecard_section_option($recruitment_scorecard_section_option_id, $recruitment_scorecard_section_option, $username);

                if($update_recruitment_scorecard_section_option){
                    echo 'Updated';
                }
                else{
                    echo $update_recruitment_scorecard_section_option;
                }
            }
            else{
                $insert_recruitment_scorecard_section_option = $api->insert_recruitment_scorecard_section_option($recruitment_scorecard_section_id, $recruitment_scorecard_id, $recruitment_scorecard_section_option, $username);

                if($insert_recruitment_scorecard_section_option){
                    echo 'Inserted';
                }
                else{
                    echo $insert_recruitment_scorecard_section_option;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit job
    else if($transaction == 'submit job'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['job_id']) && isset($_POST['job_title']) && !empty($_POST['job_title']) && isset($_POST['salary_amount']) && isset($_POST['job_category']) && !empty($_POST['job_category']) && isset($_POST['job_type']) && !empty($_POST['job_type']) && isset($_POST['recruitment_pipeline']) && !empty($_POST['recruitment_pipeline']) && isset($_POST['recruitment_scorecard']) && !empty($_POST['recruitment_scorecard']) && isset($_POST['team_member']) && !empty($_POST['team_member']) && isset($_POST['branch_id']) && !empty($_POST['branch_id']) && isset($_POST['description']) && !empty($_POST['description'])){
            $username = $_POST['username'];
            $job_id = $_POST['job_id'];
            $job_title = $_POST['job_title'];
            $salary_amount = $_POST['salary_amount'];
            $job_category = $_POST['job_category'];
            $job_type = $_POST['job_type'];
            $recruitment_pipeline = $_POST['recruitment_pipeline'];
            $recruitment_scorecard = $_POST['recruitment_scorecard'];
            $team_members = explode(',', $_POST['team_member']);
            $branch_ids = explode(',', $_POST['branch_id']);
            $description = $_POST['description'];

            $check_job_exist = $api->check_job_exist($job_id);

            if($check_job_exist > 0){
                $update_job = $api->update_job($job_id, $job_title, $job_category, $job_type, $recruitment_pipeline, $recruitment_scorecard, $salary_amount, $description, $username);

                if($update_job){
                    $delete_all_job_team_member = $api->delete_all_job_team_member($job_id, $username);

                    if($delete_all_job_team_member){
                        foreach($team_members as $team_member){
                            $insert_job_team_member = $api->insert_job_team_member($job_id, $team_member, $username);

                            if(!$insert_job_team_member){
                                $error = $insert_job_team_member;
                            }
                        }
                    }
                    else{
                        $error = $delete_all_job_team_member;
                    }

                    $delete_all_job_branch = $api->delete_all_job_branch($job_id, $username);

                    if($delete_all_job_branch){
                        foreach($branch_ids as $branch_id){
                            $insert_job_branch = $api->insert_job_branch($job_id, $branch_id, $username);

                            if(!$insert_job_branch){
                                $error = $insert_job_branch;
                            }
                        }
                    }
                    else{
                        $error = $delete_all_job_branch;
                    }

                    if(empty($error)){
                        echo 'Updated';
                    }
                    else{
                        echo $error;
                    }
                }
                else{
                    echo $update_job;
                }
            }
            else{
                $insert_job = $api->insert_job($job_title, $job_category, $job_type, $recruitment_pipeline, $recruitment_scorecard, $salary_amount, $description, $team_members, $branch_ids, $username);

                if($insert_job){
                    echo 'Inserted';
                }
                else{
                    echo $insert_job;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Submit job applicant
    else if($transaction == 'submit job applicant'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['applicant_id']) && isset($_POST['first_name']) && !empty($_POST['first_name']) && isset($_POST['middle_name']) && isset($_POST['last_name']) && !empty($_POST['last_name']) && isset($_POST['suffix']) && isset($_POST['application_date']) && !empty($_POST['application_date']) && isset($_POST['birthday']) && !empty($_POST['birthday']) && isset($_POST['gender']) && !empty($_POST['gender']) && isset($_POST['email']) && isset($_POST['phone']) && !empty($_POST['phone']) && isset($_POST['telephone'])){
            $file_type = '';
            $username = $_POST['username'];
            $applicant_id = $_POST['applicant_id'];
            $first_name = $_POST['first_name'];
            $middle_name = $_POST['middle_name'];
            $last_name = $_POST['last_name'];
            $suffix = $_POST['suffix'];
            $file_as = $api->get_file_as_format($first_name, $middle_name, $last_name, $suffix);
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $telephone = $_POST['telephone'];
            $application_date = $api->check_date('empty', $_POST['application_date'], '', 'Y-m-d', '', '', '');
            $birthday = $api->check_date('empty', $_POST['birthday'], '', 'Y-m-d', '', '', '');

            $applicant_resume_name = $_FILES['applicant_resume']['name'];
            $applicant_resume_size = $_FILES['applicant_resume']['size'];
            $applicant_resume_error = $_FILES['applicant_resume']['error'];
            $applicant_resume_tmp_name = $_FILES['applicant_resume']['tmp_name'];
            $applicant_resume_ext = explode('.', $applicant_resume_name);
            $applicant_resume_actual_ext = strtolower(end($applicant_resume_ext));

            $upload_setting_details = $api->get_upload_setting_details(21);
            $upload_file_type_details = $api->get_upload_file_type_details(21);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            $check_job_applicant_exist = $api->check_job_applicant_exist($applicant_id);
 
            if($check_job_applicant_exist > 0){
                if(!empty($applicant_resume_tmp_name)){
                    if(in_array($applicant_resume_actual_ext, $allowed_ext)){
                        if(!$applicant_resume_error){
                            if($applicant_resume_size < $file_max_size){
                                $update_job_applicant_resume = $api->update_job_applicant_resume($applicant_resume_tmp_name, $applicant_resume_actual_ext, $applicant_id, $username);
        
                                if($update_job_applicant_resume){
                                    $update_job_applicant = $api->update_job_applicant($applicant_id, $file_as, $first_name, $middle_name, $last_name, $suffix, $birthday, $application_date, $email, $gender, $phone, $telephone, $username);

                                    if($update_job_applicant){
                                        echo 'Updated';
                                    }
                                    else{
                                        echo $update_job_applicant;
                                    }
                                }
                                else{
                                    echo $update_job_applicant_resume;
                                }
                            }
                            else{
                                echo 'File Size';
                            }
                        }
                        else{
                            echo 'There was an error uploading the file.';
                        }
                    }
                    else{
                        echo 'File Type';
                    }
                }
                else{
                    $update_job_applicant = $api->update_job_applicant($applicant_id, $file_as, $first_name, $middle_name, $last_name, $suffix, $birthday, $application_date, $email, $gender, $phone, $telephone, $username);

                    if($update_job_applicant){
                        echo 'Updated';
                    }
                    else{
                        echo $update_job_applicant;
                    }
                }
            }
            else{
                if(in_array($applicant_resume_actual_ext, $allowed_ext)){
                    if(!$applicant_resume_error){
                        if($applicant_resume_size < $file_max_size){
                            $insert_job_applicant = $api->insert_job_applicant($applicant_resume_tmp_name, $applicant_resume_actual_ext, $file_as, $first_name, $middle_name, $last_name, $suffix, $birthday, $application_date, $email, $gender, $phone, $telephone, $system_date, $current_time, $username);

                            if($insert_job_applicant){
                                echo 'Inserted';
                            }
                            else{
                                echo $insert_job_applicant;
                            }
                        }
                        else{
                            echo 'File Size';
                        }
                    }
                    else{
                        echo 'There was an error uploading the file.';
                    }
                }
                else{
                    echo 'File Type';
                }
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Delete transactions
    # -------------------------------------------------------------

    # Delete system parameter
    else if($transaction == 'delete system parameter'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['parameter_id']) && !empty($_POST['parameter_id'])){
            $username = $_POST['username'];
            $parameter_id = $_POST['parameter_id'];

            $check_system_parameter_exist = $api->check_system_parameter_exist($parameter_id);

            if($check_system_parameter_exist > 0){
                $delete_system_parameter = $api->delete_system_parameter($parameter_id, $username);
                                    
                if($delete_system_parameter){
                    echo 'Deleted';
                }
                else{
                    echo $delete_system_parameter;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple system parameter
    else if($transaction == 'delete multiple system parameter'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['parameter_id'])){
            $username = $_POST['username'];
            $parameter_ids = $_POST['parameter_id'];

            foreach($parameter_ids as $parameter_id){
                $check_system_parameter_exist = $api->check_system_parameter_exist($parameter_id);

                if($check_system_parameter_exist > 0){
                    $delete_system_parameter = $api->delete_system_parameter($parameter_id, $username);
                                        
                    if(!$delete_system_parameter){
                        $error = $delete_system_parameter;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete policy
    else if($transaction == 'delete policy'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['policy_id']) && !empty($_POST['policy_id'])){
            $username = $_POST['username'];
            $policy_id = $_POST['policy_id'];

            $check_policy_exist = $api->check_policy_exist($policy_id);

            if($check_policy_exist > 0){
                $delete_all_permission = $api->delete_all_permission($policy_id, $username);
                                    
                if($delete_all_permission){
                    $delete_policy = $api->delete_policy($policy_id, $username);
                                    
                    if($delete_policy){
                        echo 'Deleted';
                    }
                    else{
                        echo $delete_policy;
                    }
                }
                else{
                    echo $delete_all_permission;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple policy
    else if($transaction == 'delete multiple policy'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['policy_id'])){
            $username = $_POST['username'];
            $policy_ids = $_POST['policy_id'];

            foreach($policy_ids as $policy_id){
                $check_policy_exist = $api->check_policy_exist($policy_id);

                if($check_policy_exist > 0){
                    $delete_policy = $api->delete_policy($policy_id, $username);
                                    
                    if($delete_policy){
                        $delete_all_permission = $api->delete_all_permission($policy_id, $username);
                                        
                        if(!$delete_all_permission){
                            $error = $delete_all_permission;
                        }
                    }
                    else{
                        $error = $delete_policy;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete permission
    else if($transaction == 'delete permission'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['permission_id']) && !empty($_POST['permission_id'])){
            $username = $_POST['username'];
            $permission_id = $_POST['permission_id'];

            $check_permission_exist = $api->check_permission_exist($permission_id);

            if($check_permission_exist > 0){
                $delete_permission = $api->delete_permission($permission_id, $username);
                                    
                if($delete_permission){
                    echo 'Deleted';
                }
                else{
                    echo $delete_permission;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple permission
    else if($transaction == 'delete multiple permission'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['permission_id'])){
            $username = $_POST['username'];
            $permission_ids = $_POST['permission_id'];

            foreach($permission_ids as $permission_id){
                $check_permission_exist = $api->check_permission_exist($permission_id);

                if($check_permission_exist > 0){
                    $delete_permission = $api->delete_permission($permission_id, $username);
                                        
                    if(!$delete_permission){
                        $error = $delete_permission;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete role
    else if($transaction == 'delete role'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['role_id']) && !empty($_POST['role_id'])){
            $username = $_POST['username'];
            $role_id = $_POST['role_id'];

            $check_role_exist = $api->check_role_exist($role_id);

            if($check_role_exist > 0){
                $delete_role = $api->delete_role($role_id, $username);
                                    
                if($delete_role){
                    $delete_permission_role = $api->delete_permission_role($role_id, $username);
                                    
                    if($delete_permission_role){
                        echo 'Deleted';
                    }
                    else{
                        echo $delete_permission_role;
                    }
                }
                else{
                    echo $delete_role;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple role
    else if($transaction == 'delete multiple role'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['role_id'])){
            $username = $_POST['username'];
            $role_ids = $_POST['role_id'];

            foreach($role_ids as $role_id){
                $check_role_exist = $api->check_role_exist($role_id);

                if($check_role_exist > 0){
                    $delete_role = $api->delete_role($role_id, $username);
                                    
                    if($delete_role){
                        $delete_permission_role = $api->delete_permission_role($role_id, $username);
                                        
                        if(!$delete_permission_role){
                            $error = $delete_permission_role;
                        }
                    }
                    else{
                        $error = $delete_role;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete system code
    else if($transaction == 'delete system code'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['system_type']) && !empty($_POST['system_type']) && isset($_POST['system_code']) && !empty($_POST['system_code'])){
            $username = $_POST['username'];
            $system_type = $_POST['system_type'];
            $system_code = $_POST['system_code'];

            $check_system_code_exist = $api->check_system_code_exist($system_type, $system_code);

            if($check_system_code_exist > 0){
                $delete_system_code = $api->delete_system_code($system_type, $system_code, $username);
                                    
                if($delete_system_code){
                    echo 'Deleted';
                }
                else{
                    echo $delete_system_code;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple system code
    else if($transaction == 'delete multiple system code'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['system_type']) && isset($_POST['system_code'])){
            $username = $_POST['username'];
            $system_type = $_POST['system_type'];
            $system_code = $_POST['system_code'];
            $system_type_length = count($system_type);

            for($i = 0; $i < $system_type_length; $i++){
                $check_system_code_exist = $api->check_system_code_exist($system_type[$i], $system_code[$i]);

                if($check_system_code_exist > 0){
                    $delete_system_code = $api->delete_system_code($system_type[$i], $system_code[$i], $username);
                                        
                    if(!$delete_system_code){
                        $error = $delete_system_code;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete notification type
    else if($transaction == 'delete notification type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['notification_id']) && !empty($_POST['notification_id'])){
            $username = $_POST['username'];
            $notification_id = $_POST['notification_id'];

            $check_notification_type_exist = $api->check_notification_type_exist($notification_id);

            if($check_notification_type_exist > 0){
                $delete_notification_type = $api->delete_notification_type($notification_id, $username);
                                    
                if($delete_notification_type){
                    $delete_notification_details = $api->delete_notification_details($notification_id, $username);
                                    
                    if($delete_notification_details){
                        $delete_notification_recipient = $api->delete_notification_recipient($notification_id, $username);
                                    
                        if($delete_notification_recipient){
                            echo 'Deleted';
                        }
                        else{
                            echo $delete_notification_recipient;
                        }
                    }
                    else{
                        echo $delete_notification_details;
                    }
                }
                else{
                    echo $delete_notification_type;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple notification type
    else if($transaction == 'delete multiple notification type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['notification_id'])){
            $username = $_POST['username'];
            $notification_ids = $_POST['notification_id'];

            foreach($notification_ids as $notification_id){
                $check_notification_type_exist = $api->check_notification_type_exist($notification_id);

                if($check_notification_type_exist > 0){
                    $delete_notification_type = $api->delete_notification_type($notification_id, $username);
                                    
                    if(!$delete_notification_type){
                        $error = $delete_policy;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete department
    else if($transaction == 'delete department'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['department_id']) && !empty($_POST['department_id'])){
            $username = $_POST['username'];
            $department_id = $_POST['department_id'];

            $check_department_exist = $api->check_department_exist($department_id);

            if($check_department_exist > 0){
                $delete_department = $api->delete_department($department_id, $username);
                                    
                if($delete_department){
                    echo 'Deleted';
                }
                else{
                    echo $delete_department;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple department
    else if($transaction == 'delete multiple department'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['department_id'])){
            $username = $_POST['username'];
            $department_ids = $_POST['department_id'];

            foreach($department_ids as $department_id){
                $check_department_exist = $api->check_department_exist($department_id);

                if($check_department_exist > 0){
                    $delete_department = $api->delete_department($department_id, $username);
                                    
                    if(!$delete_department){
                        $error = $delete_department;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete designation
    else if($transaction == 'delete designation'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['designation_id']) && !empty($_POST['designation_id'])){
            $username = $_POST['username'];
            $designation_id = $_POST['designation_id'];

            $check_designation_exist = $api->check_designation_exist($designation_id);

            if($check_designation_exist > 0){
                $delete_designation = $api->delete_designation($designation_id, $username);
                                    
                if($delete_designation){
                    echo 'Deleted';
                }
                else{
                    echo $delete_designation;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple designation
    else if($transaction == 'delete multiple designation'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['designation_id'])){
            $username = $_POST['username'];
            $designation_ids = $_POST['designation_id'];

            foreach($designation_ids as $designation_id){
                $check_designation_exist = $api->check_designation_exist($designation_id);

                if($check_designation_exist > 0){
                    $delete_designation = $api->delete_designation($designation_id, $username);
                                    
                    if(!$delete_designation){
                        $error = $delete_designation;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete branch
    else if($transaction == 'delete branch'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['branch_id']) && !empty($_POST['branch_id'])){
            $username = $_POST['username'];
            $branch_id = $_POST['branch_id'];

            $check_branch_exist = $api->check_branch_exist($branch_id);

            if($check_branch_exist > 0){
                $delete_branch = $api->delete_branch($branch_id, $username);
                                    
                if($delete_branch){
                    echo 'Deleted';
                }
                else{
                    echo $delete_branch;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple branch
    else if($transaction == 'delete multiple branch'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['branch_id'])){
            $username = $_POST['username'];
            $branch_ids = $_POST['branch_id'];

            foreach($branch_ids as $branch_id){
                $check_branch_exist = $api->check_branch_exist($branch_id);

                if($check_branch_exist > 0){
                    $delete_branch = $api->delete_branch($branch_id, $username);
                                    
                    if(!$delete_branch){
                        $error = $delete_branch;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete upload setting
    else if($transaction == 'delete upload setting'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['upload_setting_id']) && !empty($_POST['upload_setting_id'])){
            $username = $_POST['username'];
            $upload_setting_id = $_POST['upload_setting_id'];

            $check_upload_setting_exist = $api->check_upload_setting_exist($upload_setting_id);

            if($check_upload_setting_exist > 0){
                $delete_upload_setting = $api->delete_upload_setting($upload_setting_id, $username);
                                    
                if($delete_upload_setting){
                    $delete_all_upload_file_type = $api->delete_all_upload_file_type($upload_setting_id, $username);
                                    
                    if($delete_all_upload_file_type){
                        echo 'Deleted';
                    }
                    else{
                        echo $delete_all_upload_file_type;
                    }
                }
                else{
                    echo $delete_upload_setting;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple upload setting
    else if($transaction == 'delete multiple upload setting'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['upload_setting_id'])){
            $username = $_POST['username'];
            $upload_setting_ids = $_POST['upload_setting_id'];

            foreach($upload_setting_ids as $upload_setting_id){
                $check_upload_setting_exist = $api->check_upload_setting_exist($upload_setting_id);

                if($check_upload_setting_exist > 0){
                    $delete_upload_setting = $api->delete_upload_setting($upload_setting_id, $username);
                                    
                    if($delete_upload_setting){
                        $delete_all_upload_file_type = $api->delete_all_upload_file_type($upload_setting_id, $username);
                                    
                        if(!$delete_all_upload_file_type){
                            $error = $delete_all_upload_file_type;
                        }                       
                    }
                    else{
                        $error = $delete_upload_setting;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete employment status
    else if($transaction == 'delete employment status'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employment_status_id']) && !empty($_POST['employment_status_id'])){
            $username = $_POST['username'];
            $employment_status_id = $_POST['employment_status_id'];

            $check_employment_status_exist = $api->check_employment_status_exist($employment_status_id);

            if($check_employment_status_exist > 0){
                $delete_employment_status = $api->delete_employment_status($employment_status_id, $username);
                                    
                if($delete_employment_status){
                    echo 'Deleted';
                }
                else{
                    echo $delete_employment_status;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple employment status
    else if($transaction == 'delete multiple employment status'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employment_status_id'])){
            $username = $_POST['username'];
            $employment_status_ids = $_POST['employment_status_id'];

            foreach($employment_status_ids as $employment_status_id){
                $check_employment_status_exist = $api->check_employment_status_exist($employment_status_id);

                if($check_employment_status_exist > 0){
                    $delete_employment_status = $api->delete_employment_status($employment_status_id, $username);

                    if(!$delete_employment_status){
                        $error = $delete_employment_status;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete employee
    else if($transaction == 'delete employee'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employee_id']) && !empty($_POST['employee_id'])){
            $username = $_POST['username'];
            $employee_id = $_POST['employee_id'];

            $check_employee_exist = $api->check_employee_exist($employee_id);

            if($check_employee_exist > 0){
                $delete_employee = $api->delete_employee($employee_id, $username);
                                    
                if($delete_employee){
                    echo 'Deleted';
                }
                else{
                    echo $delete_employee;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple employee
    else if($transaction == 'delete multiple employee'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employee_id'])){
            $username = $_POST['username'];
            $employee_ids = $_POST['employee_id'];

            foreach($employee_ids as $employee_id){
                $check_employee_exist = $api->check_employee_exist($employee_id);

                if($check_employee_exist > 0){
                    $delete_employee = $api->delete_employee($employee_id, $username);
                                    
                    if(!$delete_employee){
                        $error = $delete_employee;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete emergency contact
    else if($transaction == 'delete emergency contact'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['contact_id']) && !empty($_POST['contact_id'])){
            $username = $_POST['username'];
            $contact_id = $_POST['contact_id'];

            $check_emergency_contact_exist = $api->check_emergency_contact_exist($contact_id);

            if($check_emergency_contact_exist > 0){
                $delete_emergency_contact = $api->delete_emergency_contact($contact_id, $username);
                                    
                if($delete_emergency_contact){
                    echo 'Deleted';
                }
                else{
                    echo $delete_emergency_contact;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete employee address
    else if($transaction == 'delete employee address'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['address_id']) && !empty($_POST['address_id'])){
            $username = $_POST['username'];
            $address_id = $_POST['address_id'];

            $check_employee_address_exist = $api->check_employee_address_exist($address_id);

            if($check_employee_address_exist > 0){
                $delete_employee_address = $api->delete_employee_address($address_id, $username);
                                    
                if($delete_employee_address){
                    echo 'Deleted';
                }
                else{
                    echo $delete_employee_address;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete employee social
    else if($transaction == 'delete employee social'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['social_id']) && !empty($_POST['social_id'])){
            $username = $_POST['username'];
            $social_id = $_POST['social_id'];

            $check_employee_social_exist = $api->check_employee_social_exist($social_id);

            if($check_employee_social_exist > 0){
                $delete_employee_social = $api->delete_employee_social($social_id, $username);
                                    
                if($delete_employee_social){
                    echo 'Deleted';
                }
                else{
                    echo $delete_employee_social;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete work shift
    else if($transaction == 'delete work shift'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['work_shift_id']) && !empty($_POST['work_shift_id'])){
            $username = $_POST['username'];
            $work_shift_id = $_POST['work_shift_id'];

            $check_work_shift_exist = $api->check_work_shift_exist($work_shift_id);

            if($check_work_shift_exist > 0){
                $delete_work_shift = $api->delete_work_shift($work_shift_id, $username);
                                    
                if($delete_work_shift){
                    $delete_work_shift_schedule = $api->delete_work_shift_schedule($work_shift_id, $username);
                                    
                    if($delete_work_shift_schedule){
                        $delete_employee_work_shift = $api->delete_employee_work_shift($work_shift_id, $username);
                                    
                        if($delete_employee_work_shift){
                            echo 'Deleted';
                        }
                        else{
                            echo $delete_employee_work_shift;
                        }
                    }
                    else{
                        echo $delete_work_shift_schedule;
                    }
                }
                else{
                    echo $delete_work_shift;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple work shift
    else if($transaction == 'delete multiple work shift'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['work_shift_id'])){
            $username = $_POST['username'];
            $work_shift_ids = $_POST['work_shift_id'];

            foreach($work_shift_ids as $work_shift_id){
                $check_work_shift_exist = $api->check_work_shift_exist($work_shift_id);

                if($check_work_shift_exist > 0){
                    $delete_work_shift = $api->delete_work_shift($work_shift_id, $username);
                                    
                    if($delete_work_shift){
                        $delete_work_shift_schedule = $api->delete_work_shift_schedule($work_shift_id, $username);
                                    
                        if($delete_work_shift_schedule){
                            $delete_employee_work_shift = $api->delete_employee_work_shift($work_shift_id, $username);
                                    
                            if(!$delete_employee_work_shift){
                                $error = $delete_employee_work_shift;
                            }
                        }
                        else{
                            $error = $delete_work_shift_schedule;
                        }
                    }
                    else{
                        $error = $delete_work_shift;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete employee attendance
    else if($transaction == 'delete employee attendance'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['attendance_id']) && !empty($_POST['attendance_id'])){
            $username = $_POST['username'];
            $attendance_id = $_POST['attendance_id'];

            $check_employee_attendance_exist = $api->check_employee_attendance_exist($attendance_id);

            if($check_employee_attendance_exist > 0){
                $delete_employee_attendance = $api->delete_employee_attendance($attendance_id, $username);
                                    
                if($delete_employee_attendance){
                    echo 'Deleted';
                }
                else{
                    echo $delete_employee_attendance;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete leave type
    else if($transaction == 'delete leave type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_type_id']) && !empty($_POST['leave_type_id'])){
            $username = $_POST['username'];
            $leave_type_id = $_POST['leave_type_id'];

            $check_leave_type_exist = $api->check_leave_type_exist($leave_type_id);

            if($check_leave_type_exist > 0){
                $delete_leave_type = $api->delete_leave_type($leave_type_id, $username);
                                    
                if($delete_leave_type){
                    echo 'Deleted';
                }
                else{
                    echo $delete_leave_type;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple leave type
    else if($transaction == 'delete multiple leave type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_type_id'])){
            $username = $_POST['username'];
            $leave_type_ids = $_POST['leave_type_id'];

            foreach($leave_type_ids as $leave_type_id){
                $check_leave_type_exist = $api->check_leave_type_exist($leave_type_id);

                if($check_leave_type_exist > 0){
                    $delete_leave_type = $api->delete_leave_type($leave_type_id, $username);
                                    
                    if($delete_leave_type){
                        $error = $delete_leave_type;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete leave entitlement or delete employee leave entitlement
    else if($transaction == 'delete leave entitlement' || $transaction == 'delete employee leave entitlement'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_entitlement_id']) && !empty($_POST['leave_entitlement_id'])){
            $username = $_POST['username'];
            $leave_entitlement_id = $_POST['leave_entitlement_id'];

            $check_leave_entitlement_exist = $api->check_leave_entitlement_exist($leave_entitlement_id);

            if($check_leave_entitlement_exist > 0){
                $delete_leave_entitlement = $api->delete_leave_entitlement($leave_entitlement_id, $username);
                                    
                if($delete_leave_entitlement){
                    echo 'Deleted';
                }
                else{
                    echo $delete_leave_entitlement;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple leave entitlement
    else if($transaction == 'delete multiple leave entitlement'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_entitlement_id'])){
            $username = $_POST['username'];
            $leave_entitlement_ids = $_POST['leave_entitlement_id'];

            foreach($leave_entitlement_ids as $leave_entitlement_id){
                $check_leave_entitlement_exist = $api->check_leave_entitlement_exist($leave_entitlement_id);

                if($check_leave_entitlement_exist > 0){
                    $delete_leave_entitlement = $api->delete_leave_entitlement($leave_entitlement_id, $username);
                                    
                    if(!$delete_leave_entitlement){
                        $error = $delete_leave_entitlement;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete leave
    else if($transaction == 'delete leave'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_id']) && !empty($_POST['leave_id'])){
            $username = $_POST['username'];
            $leave_id = $_POST['leave_id'];

            $leave_details = $api->get_leave_details($leave_id);
            $employee_id = $leave_details[0]['EMPLOYEE_ID'];
            $leave_type = $leave_details[0]['LEAVE_TYPE'];
            $leave_date = $leave_details[0]['LEAVE_DATE'];
            $start_time = $leave_details[0]['START_TIME'];
            $end_time = $leave_details[0]['END_TIME'];

            $leave_day = date('N', strtotime($leave_date));

            $work_shift_schedule = $api->get_work_shift_schedule($employee_id, $leave_date, $leave_day);
            $work_shift_time_in = $work_shift_schedule[0]['START_TIME'];
            $work_shift_time_out = $work_shift_schedule[0]['END_TIME'];

            $total_working_hours = round(abs(strtotime($work_shift_time_out) - strtotime($work_shift_time_in)) / 3600, 2);
            $total_leave_hours = round(abs(strtotime($end_time) - strtotime($start_time)) / 3600, 2);

            if($total_working_hours == $total_leave_hours){
                $total_hours =  - 1;
            }
            else{
                $total_hours =  - 1 * abs(($total_working_hours - $total_leave_hours) / $total_working_hours);
            }

            $check_leave_exist = $api->check_leave_exist($leave_id);

            if($check_leave_exist > 0){
                $delete_leave = $api->delete_leave($leave_id, $username);
                                    
                if($delete_leave){
                    $update_leave_entitlement_count = $api->update_leave_entitlement_count($employee_id, $leave_type, $leave_date, $total_hours, $username);

                    if($update_leave_entitlement_count){
                        echo 'Deleted';
                    }
                    else{
                        echo $update_leave_entitlement_count;
                    }
                }
                else{
                    echo $delete_leave;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple leave
    else if($transaction == 'delete multiple leave'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_id'])){
            $username = $_POST['username'];
            $leave_ids = $_POST['leave_id'];

            foreach($leave_ids as $leave_id){
                $leave_details = $api->get_leave_details($leave_id);
                $employee_id = $leave_details[0]['EMPLOYEE_ID'];
                $leave_type = $leave_details[0]['LEAVE_TYPE'];
                $leave_date = $leave_details[0]['LEAVE_DATE'];
                $start_time = $leave_details[0]['START_TIME'];
                $end_time = $leave_details[0]['END_TIME'];

                $leave_day = date('N', strtotime($leave_date));

                $work_shift_schedule = $api->get_work_shift_schedule($employee_id, $leave_date, $leave_day);
                $work_shift_time_in = $work_shift_schedule[0]['START_TIME'];
                $work_shift_time_out = $work_shift_schedule[0]['END_TIME'];

                $total_working_hours = round(abs(strtotime($work_shift_time_out) - strtotime($work_shift_time_in)) / 3600, 2);
                $total_leave_hours = round(abs(strtotime($end_time) - strtotime($start_time)) / 3600, 2);

                if($total_working_hours == $total_leave_hours){
                    $total_hours =  - 1;
                }
                else{
                    $total_hours =  - 1 * abs(($total_working_hours - $total_leave_hours) / $total_working_hours);
                }

                $check_leave_exist = $api->check_leave_exist($leave_id);

                if($check_leave_exist > 0){
                    $delete_leave = $api->delete_leave($leave_id, $username);
                                    
                    if($delete_leave){
                        $update_leave_entitlement_count = $api->update_leave_entitlement_count($employee_id, $leave_type, $leave_date, $total_hours, $username);

                        if(!$update_leave_entitlement_count){
                            $error = $update_leave_entitlement_count;
                        }
                    }
                    else{
                        $error = $delete_leave;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete employee file
    else if($transaction == 'delete employee file'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['file_id']) && !empty($_POST['file_id'])){
            $username = $_POST['username'];
            $file_id = $_POST['file_id'];

            $check_employee_file_exist = $api->check_employee_file_exist($file_id);

            if($check_employee_file_exist > 0){
                $delete_employee_file = $api->delete_employee_file($file_id, $username);
                                    
                if($delete_employee_file){
                    echo 'Deleted';
                }
                else{
                    echo $delete_employee_file;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple employee file
    else if($transaction == 'delete multiple employee file'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['file_id'])){
            $username = $_POST['username'];
            $file_ids = $_POST['file_id'];

            foreach($file_ids as $file_id){
                $check_employee_file_exist = $api->check_employee_file_exist($file_id);

                if($check_employee_file_exist > 0){
                    $delete_employee_file = $api->delete_employee_file($file_id, $username);
                                    
                    if(!$delete_employee_file){
                        $error = $delete_employee_file;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete holiday
    else if($transaction == 'delete holiday'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['holiday_id']) && !empty($_POST['holiday_id'])){
            $username = $_POST['username'];
            $holiday_id = $_POST['holiday_id'];

            $check_holiday_exist = $api->check_holiday_exist($holiday_id);

            if($check_holiday_exist > 0){
                $delete_holiday = $api->delete_holiday($holiday_id, $username);
                                    
                if($delete_holiday){
                    $delete_all_holiday_branch = $api->delete_all_holiday_branch($holiday_id);

                    if($delete_all_holiday_branch){
                        echo 'Deleted';
                    }
                    else{
                        echo $delete_all_holiday_branch;
                    }                    
                }
                else{
                    echo $delete_holiday;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple holiday
    else if($transaction == 'delete multiple holiday'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['holiday_id'])){
            $username = $_POST['username'];
            $holiday_ids = $_POST['holiday_id'];

            foreach($holiday_ids as $holiday_id){
                $check_holiday_exist = $api->check_holiday_exist($holiday_id);

                if($check_holiday_exist > 0){
                    $delete_holiday = $api->delete_holiday($holiday_id, $username);
                                    
                    if($delete_holiday){
                        $delete_all_holiday_branch = $api->delete_all_holiday_branch($holiday_id);

                        if(!$delete_all_holiday_branch){
                            $error = $delete_all_holiday_branch;
                        }
                    }
                    else{
                        $error = $delete_holiday;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete attendance creation
    else if($transaction == 'delete attendance creation'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id'])){
            $username = $_POST['username'];
            $request_id = $_POST['request_id'];

            $check_attendance_creation_exist = $api->check_attendance_creation_exist($request_id);

            if($check_attendance_creation_exist > 0){
                $delete_attendance_creation = $api->delete_attendance_creation($request_id, $username);
                                    
                if($delete_attendance_creation){
                    echo 'Deleted';
                }
                else{
                    echo $delete_attendance_creation;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple attendance creation
    else if($transaction == 'delete multiple attendance creation'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id'])){
            $username = $_POST['username'];
            $request_ids = $_POST['request_id'];

            foreach($request_ids as $request_id){
                $check_attendance_creation_exist = $api->check_attendance_creation_exist($request_id);

                if($check_attendance_creation_exist > 0){
                    $delete_attendance_creation = $api->delete_attendance_creation($request_id, $username);
                                    
                    if(!$delete_attendance_creation){
                        $error = $delete_attendance_creation;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete allowance type
    else if($transaction == 'delete allowance type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['allowance_type_id']) && !empty($_POST['allowance_type_id'])){
            $username = $_POST['username'];
            $allowance_type_id = $_POST['allowance_type_id'];

            $check_allowance_type_exist = $api->check_allowance_type_exist($allowance_type_id);

            if($check_allowance_type_exist > 0){
                $delete_allowance_type = $api->delete_allowance_type($allowance_type_id, $username);
                                    
                if($delete_allowance_type){
                    echo 'Deleted';
                }
                else{
                    echo $delete_allowance_type;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple allowance type
    else if($transaction == 'delete multiple allowance type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['allowance_type_id'])){
            $username = $_POST['username'];
            $allowance_type_ids = $_POST['allowance_type_id'];

            foreach($allowance_type_ids as $allowance_type_id){
                $check_allowance_type_exist = $api->check_allowance_type_exist($allowance_type_id);

                if($check_allowance_type_exist > 0){
                    $delete_allowance_type = $api->delete_allowance_type($allowance_type_id, $username);
                                    
                    if(!$delete_allowance_type){
                        $error = $delete_allowance_type;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete allowance
    else if($transaction == 'delete allowance'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['allowance_id']) && !empty($_POST['allowance_id'])){
            $username = $_POST['username'];
            $allowance_id = $_POST['allowance_id'];

            $check_allowance_exist = $api->check_allowance_exist($allowance_id);

            if($check_allowance_exist > 0){
                $delete_allowance = $api->delete_allowance($allowance_id, $username);
                                    
                if($delete_allowance){
                    echo 'Deleted';
                }
                else{
                    echo $delete_allowance;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple allowance
    else if($transaction == 'delete multiple allowance'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['allowance_id'])){
            $username = $_POST['username'];
            $allowance_ids = $_POST['allowance_id'];

            foreach($allowance_ids as $allowance_id){
                $check_allowance_exist = $api->check_allowance_exist($allowance_id);

                if($check_allowance_exist > 0){
                    $delete_allowance = $api->delete_allowance($allowance_id, $username);
                                    
                    if(!$delete_allowance){
                        $error = $delete_allowance;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete other income type
    else if($transaction == 'delete other income type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['other_income_type_id']) && !empty($_POST['other_income_type_id'])){
            $username = $_POST['username'];
            $other_income_type_id = $_POST['other_income_type_id'];

            $check_other_income_type_exist = $api->check_other_income_type_exist($other_income_type_id);

            if($check_other_income_type_exist > 0){
                $delete_other_income_type = $api->delete_other_income_type($other_income_type_id, $username);
                                    
                if($delete_other_income_type){
                    echo 'Deleted';
                }
                else{
                    echo $delete_other_income_type;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple other income type
    else if($transaction == 'delete multiple other income type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['other_income_type_id'])){
            $username = $_POST['username'];
            $other_income_type_ids = $_POST['other_income_type_id'];

            foreach($other_income_type_ids as $other_income_type_id){
                $check_other_income_type_exist = $api->check_other_income_type_exist($other_income_type_id);

                if($check_other_income_type_exist > 0){
                    $delete_other_income_type = $api->delete_other_income_type($other_income_type_id, $username);
                                    
                    if(!$delete_other_income_type){
                        $error = $delete_other_income_type;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete other income
    else if($transaction == 'delete other income'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['other_income_id']) && !empty($_POST['other_income_id'])){
            $username = $_POST['username'];
            $other_income_id = $_POST['other_income_id'];

            $check_other_income_exist = $api->check_other_income_exist($other_income_id);

            if($check_other_income_exist > 0){
                $delete_other_income = $api->delete_other_income($other_income_id, $username);
                                    
                if($delete_other_income){
                    echo 'Deleted';
                }
                else{
                    echo $delete_other_income;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple other income
    else if($transaction == 'delete multiple other income'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['other_income_id'])){
            $username = $_POST['username'];
            $other_income_ids = $_POST['other_income_id'];

            foreach($other_income_ids as $other_income_id){
                $check_other_income_exist = $api->check_other_income_exist($other_income_id);

                if($check_other_income_exist > 0){
                    $delete_other_income = $api->delete_other_income($other_income_id, $username);
                                    
                    if(!$delete_other_income){
                        $error = $delete_other_income;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete deduction type
    else if($transaction == 'delete deduction type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['deduction_type_id']) && !empty($_POST['deduction_type_id'])){
            $username = $_POST['username'];
            $deduction_type_id = $_POST['deduction_type_id'];

            $check_deduction_type_exist = $api->check_deduction_type_exist($deduction_type_id);

            if($check_department_exist > 0){
                $delete_deduction_type = $api->delete_deduction_type($deduction_type_id, $username);
                                    
                if($delete_deduction_type){
                    echo 'Deleted';
                }
                else{
                    echo $delete_deduction_type;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple deduction type
    else if($transaction == 'delete multiple deduction type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['deduction_type_id'])){
            $username = $_POST['username'];
            $deduction_type_ids = $_POST['deduction_type_id'];

            foreach($deduction_type_ids as $deduction_type_id){
                $check_deduction_type_exist = $api->check_deduction_type_exist($deduction_type_id);

                if($check_deduction_type_exist > 0){
                    $delete_deduction_type = $api->delete_deduction_type($deduction_type_id, $username);
                                    
                    if(!$delete_deduction_type){
                        $error = $delete_deduction_type;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------
    
    # Delete government contribution
    else if($transaction == 'delete government contribution'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['government_contribution_id']) && !empty($_POST['government_contribution_id'])){
            $username = $_POST['username'];
            $government_contribution_id = $_POST['government_contribution_id'];

            $check_government_contribution_exist = $api->check_government_contribution_exist($government_contribution_id);

            if($check_government_contribution_exist > 0){
                $delete_government_contribution = $api->delete_government_contribution($government_contribution_id, $username);
                                    
                if($delete_government_contribution){
                    $delete_all_contribution_bracket = $api->delete_all_contribution_bracket($government_contribution_id, $username);
                                    
                    if($delete_all_contribution_bracket){
                        echo 'Deleted';
                    }
                    else{
                        echo $delete_all_contribution_bracket;
                    }
                }
                else{
                    echo $delete_government_contribution;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple government contribution
    else if($transaction == 'delete multiple government contribution'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['government_contribution_id'])){
            $username = $_POST['username'];
            $government_contribution_ids = $_POST['government_contribution_id'];

            foreach($government_contribution_ids as $government_contribution_id){
                $check_government_contribution_exist = $api->check_government_contribution_exist($government_contribution_id);

                if($check_government_contribution_exist > 0){
                    $delete_government_contribution = $api->delete_government_contribution($government_contribution_id, $username);
                                    
                    if($delete_government_contribution){
                        
                        $delete_all_contribution_bracket = $api->delete_all_contribution_bracket($government_contribution_id, $username);
                                    
                        if(!$delete_all_contribution_bracket){
                            $error = $delete_all_contribution_bracket;
                        }
                    }
                    else{
                        $error = $delete_government_contribution;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete contribution bracket
    else if($transaction == 'delete contribution bracket'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['contribution_bracket_id']) && !empty($_POST['contribution_bracket_id'])){
            $username = $_POST['username'];
            $contribution_bracket_id = $_POST['contribution_bracket_id'];

            $check_contribution_bracket_exist = $api->check_contribution_bracket_exist($contribution_bracket_id);

            if($check_contribution_bracket_exist > 0){
                $delete_contribution_bracket = $api->delete_contribution_bracket($contribution_bracket_id, $username);
                                    
                if($delete_contribution_bracket){
                    echo 'Deleted';
                }
                else{
                    echo $delete_contribution_bracket;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple contribution bracket
    else if($transaction == 'delete multiple contribution bracket'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['contribution_bracket_id'])){
            $username = $_POST['username'];
            $contribution_bracket_ids = $_POST['contribution_bracket_id'];

            foreach($contribution_bracket_ids as $contribution_bracket_id){
                $check_contribution_bracket_exist = $api->check_contribution_bracket_exist($contribution_bracket_id);

                if($check_contribution_bracket_exist > 0){
                    $delete_contribution_bracket = $api->delete_contribution_bracket($contribution_bracket_id, $username);
                                    
                    if(!$delete_contribution_bracket){
                        $error = $delete_contribution_bracket;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete deduction
    else if($transaction == 'delete deduction'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['deduction_id']) && !empty($_POST['deduction_id'])){
            $username = $_POST['username'];
            $deduction_id = $_POST['deduction_id'];

            $check_deduction_exist = $api->check_deduction_exist($deduction_id);

            if($check_deduction_exist > 0){
                $delete_deduction = $api->delete_deduction($deduction_id, $username);
                                    
                if($delete_deduction){
                    echo 'Deleted';
                }
                else{
                    echo $delete_deduction;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple deduction
    else if($transaction == 'delete multiple deduction'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['deduction_id'])){
            $username = $_POST['username'];
            $deduction_ids = $_POST['deduction_id'];

            foreach($deduction_ids as $deduction_id){
                $check_deduction_exist = $api->check_deduction_exist($deduction_id);

                if($check_deduction_exist > 0){
                    $delete_deduction = $api->delete_deduction($deduction_id, $username);
                                    
                    if(!$delete_deduction){
                        $error = $delete_deduction;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------
    
    # Delete contribution deduction
    else if($transaction == 'delete contribution deduction'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['contribution_deduction_id']) && !empty($_POST['contribution_deduction_id'])){
            $username = $_POST['username'];
            $contribution_deduction_id = $_POST['contribution_deduction_id'];

            $check_contribution_deduction_exist = $api->check_contribution_deduction_exist($contribution_deduction_id);

            if($check_contribution_deduction_exist > 0){
                $delete_contribution_deduction_exist = $api->delete_contribution_deduction_exist($contribution_deduction_id, $username);
                                    
                if($delete_contribution_deduction_exist){
                    echo 'Deleted';
                }
                else{
                    echo $delete_contribution_deduction_exist;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple contribution deduction
    else if($transaction == 'delete multiple contribution deduction'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['contribution_deduction_id'])){
            $username = $_POST['username'];
            $contribution_deduction_ids = $_POST['contribution_deduction_id'];

            foreach($contribution_deduction_ids as $contribution_deduction_id){
                $check_contribution_deduction_exist = $api->check_contribution_deduction_exist($contribution_deduction_id);

                if($check_contribution_deduction_exist > 0){
                    $delete_contribution_deduction_exist = $api->delete_contribution_deduction_exist($contribution_deduction_id, $username);
                                    
                    if(!$delete_contribution_deduction_exist){
                        $error = $delete_contribution_deduction_exist;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete salary
    else if($transaction == 'delete salary'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['salary_id']) && !empty($_POST['salary_id'])){
            $username = $_POST['username'];
            $salary_id = $_POST['salary_id'];

            $check_salary_exist = $api->check_salary_exist($salary_id);

            if($check_salary_exist > 0){
                $delete_salary = $api->delete_salary($salary_id, $username);
                                    
                if($delete_salary){
                    echo 'Deleted';
                }
                else{
                    echo $delete_salary;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple salary
    else if($transaction == 'delete multiple salary'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['salary_id'])){
            $username = $_POST['username'];
            $salary_ids = $_POST['salary_id'];

            foreach($salary_ids as $salary_id){
                $check_salary_exist = $api->check_salary_exist($salary_id);

                if($check_salary_exist > 0){
                    $delete_salary = $api->delete_salary($salary_id, $username);
                                    
                    if(!$delete_salary){
                        $error = $delete_salary;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete payroll group
    else if($transaction == 'delete payroll group'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['payroll_group_id']) && !empty($_POST['payroll_group_id'])){
            $username = $_POST['username'];
            $payroll_group_id = $_POST['payroll_group_id'];

            $check_payroll_group_exist = $api->check_payroll_group_exist($payroll_group_id);

            if($check_payroll_group_exist > 0){
                $delete_payroll_group = $api->delete_payroll_group($payroll_group_id, $username);
                                    
                if($delete_payroll_group){
                    $delete_all_payroll_group_employee = $api->delete_all_payroll_group_employee($payroll_group_id, $username);
                                    
                    if($delete_all_payroll_group_employee){
                        echo 'Deleted';
                    }
                    else{
                        echo $delete_all_payroll_group_employee;
                    }
                }
                else{
                    echo $delete_payroll_group;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple payroll group
    else if($transaction == 'delete multiple payroll group'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['payroll_group_id'])){
            $username = $_POST['username'];
            $payroll_group_ids = $_POST['payroll_group_id'];

            foreach($payroll_group_ids as $payroll_group_id){
                $check_payroll_group_exist = $api->check_payroll_group_exist($payroll_group_id);

                if($check_payroll_group_exist > 0){
                    $delete_payroll_group = $api->delete_payroll_group($payroll_group_id, $username);
                                    
                    if($delete_payroll_group){
                        $delete_all_payroll_group_employee = $api->delete_all_payroll_group_employee($payroll_group_id, $username);
                                    
                        if(!$delete_all_payroll_group_employee){
                            $error = $delete_all_payroll_group_employee;
                        }                       
                    }
                    else{
                        $error = $delete_payroll_group;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete withholding tax
    else if($transaction == 'delete withholding tax'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['withholding_tax_id']) && !empty($_POST['withholding_tax_id'])){
            $username = $_POST['username'];
            $withholding_tax_id = $_POST['withholding_tax_id'];

            $check_withholding_tax_exist = $api->check_withholding_tax_exist($withholding_tax_id);

            if($check_withholding_tax_exist > 0){
                $delete_withholding_tax = $api->delete_withholding_tax($withholding_tax_id, $username);
                                    
                if($delete_withholding_tax){
                    echo 'Deleted';
                }
                else{
                    echo $delete_withholding_tax;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple withholding tax
    else if($transaction == 'delete multiple withholding tax'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['withholding_tax_id'])){
            $username = $_POST['username'];
            $withholding_tax_ids = $_POST['withholding_tax_id'];

            foreach($withholding_tax_ids as $withholding_tax_id){
                $check_withholding_tax_exist = $api->check_withholding_tax_exist($withholding_tax_id);

                if($check_withholding_tax_exist > 0){
                    $delete_withholding_tax = $api->delete_withholding_tax($withholding_tax_id, $username);
                                    
                    if(!$delete_withholding_tax){
                        $error = $delete_withholding_tax;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete pay run
    else if($transaction == 'delete pay run'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['pay_run_id']) && !empty($_POST['pay_run_id'])){
            $username = $_POST['username'];
            $pay_run_id = $_POST['pay_run_id'];

            $check_pay_run_exist = $api->check_pay_run_exist($pay_run_id);

            if($check_pay_run_exist > 0){
                $delete_pay_run_payslip = $api->delete_pay_run_payslip($pay_run_id, $username);

                if($delete_pay_run_payslip){
                    $delete_pay_run = $api->delete_pay_run($pay_run_id, $username);
                                    
                    if($delete_pay_run){
                        echo 'Deleted';
                    }
                    else{
                        echo $delete_pay_run;
                    }
                }
                else{
                    echo $delete_pay_run_payslip;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple pay run
    else if($transaction == 'delete multiple pay run'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['pay_run_id'])){
            $username = $_POST['username'];
            $pay_run_ids = $_POST['pay_run_id'];

            foreach($pay_run_ids as $pay_run_id){
                $check_pay_run_exist = $api->check_pay_run_exist($pay_run_id);

                if($check_pay_run_exist > 0){
                    $delete_pay_run_payslip = $api->delete_pay_run_payslip($pay_run_id, $username);

                    if($delete_pay_run_payslip){
                        $delete_pay_run = $api->delete_pay_run($pay_run_id, $username);
                                        
                        if(!$delete_pay_run){
                            $error = $delete_pay_run;
                        }
                    }
                    else{
                        $error = $delete_pay_run_payslip;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete payslip
    else if($transaction == 'delete payslip'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['payslip_id']) && !empty($_POST['payslip_id'])){
            $username = $_POST['username'];
            $payslip_id = $_POST['payslip_id'];

            $get_payslip_details = $api->get_payslip_details($payslip_id);
            $pay_run_id = $get_payslip_details[0]['PAY_RUN_ID'];
            $employee_id = $get_payslip_details[0]['EMPLOYEE_ID'];

            $check_payslip_exist = $api->check_payslip_exist($payslip_id);

            if($check_payslip_exist > 0){
                $update_allowance_reversal = $api->update_allowance_reversal($payslip_id, $username);
                                    
                if($update_allowance_reversal){
                    $update_deduction_reversal = $api->update_deduction_reversal($payslip_id, $username);
                                    
                    if($update_deduction_reversal){
                        $update_other_income_reversal = $api->update_other_income_reversal($payslip_id, $username);
                                    
                        if($update_other_income_reversal){
                            $update_contribution_deduction_reversal = $api->update_contribution_deduction_reversal($payslip_id, $username);
                                    
                            if($update_contribution_deduction_reversal){
                                $delete_pay_run_payee = $api->delete_pay_run_payee($pay_run_id, $employee_id, $username);
                                    
                                if($delete_pay_run_payee){
                                    $delete_payslip = $api->delete_payslip($payslip_id, $username);
                                    
                                    if($delete_payslip){
                                        echo 'Deleted';
                                    }
                                    else{
                                        echo $delete_payslip;
                                    }
                                }
                                else{
                                    echo $delete_pay_run_payee;
                                }
                            }
                            else{
                                echo $update_contribution_deduction_reversal;
                            }
                        }
                        else{
                            echo $update_other_income_reversal;
                        }
                    }
                    else{
                        echo $update_deduction_reversal;
                    }
                }
                else{
                    echo $update_allowance_reversal;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple payslip
    else if($transaction == 'delete multiple payslip'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['payslip_id'])){
            $username = $_POST['username'];
            $payslip_ids = $_POST['payslip_id'];

            foreach($payslip_ids as $payslip_id){
                $get_payslip_details = $api->get_payslip_details($payslip_id);
                $pay_run_id = $get_payslip_details[0]['PAY_RUN_ID'];
                $employee_id = $get_payslip_details[0]['EMPLOYEE_ID'];

                $check_payslip_exist = $api->check_payslip_exist($payslip_id);

                if($check_payslip_exist > 0){
                    $update_allowance_reversal = $api->update_allowance_reversal($payslip_id, $username);
                                    
                    if($update_allowance_reversal){
                        $update_deduction_reversal = $api->update_deduction_reversal($payslip_id, $username);
                                        
                        if($update_deduction_reversal){
                            $update_other_income_reversal = $api->update_other_income_reversal($payslip_id, $username);
                                        
                            if($update_other_income_reversal){
                                $update_contribution_deduction_reversal = $api->update_contribution_deduction_reversal($payslip_id, $username);
                                        
                                if($update_contribution_deduction_reversal){
                                    $delete_pay_run_payee = $api->delete_pay_run_payee($pay_run_id, $employee_id, $username);
                                    
                                    if($delete_pay_run_payee){
                                        $delete_payslip = $api->delete_payslip($payslip_id, $username);
                                        
                                        if(!$delete_payslip){
                                            $error = $delete_payslip;
                                        }
                                    }
                                    else{
                                        $error = $delete_pay_run_payee;
                                    }
                                }
                                else{
                                    $error = $update_contribution_deduction_reversal;
                                }
                            }
                            else{
                                $error = $update_other_income_reversal;
                            }
                        }
                        else{
                            $error = $update_deduction_reversal;
                        }
                    }
                    else{
                        $error = $update_allowance_reversal;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete job category
    else if($transaction == 'delete job category'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['job_category_id']) && !empty($_POST['job_category_id'])){
            $username = $_POST['username'];
            $job_category_id = $_POST['job_category_id'];

            $check_job_category_exist = $api->check_job_category_exist($job_category_id);

            if($check_job_category_exist > 0){
                $delete_job_category = $api->delete_job_category($job_category_id, $username);
                                    
                if($delete_job_category){
                    echo 'Deleted';
                }
                else{
                    echo $delete_job_category;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple job category
    else if($transaction == 'delete multiple job category'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['job_category_id'])){
            $username = $_POST['username'];
            $job_category_ids = $_POST['job_category_id'];

            foreach($job_category_ids as $job_category_id){
                $check_job_category_exist = $api->check_job_category_exist($job_category_id);

                if($check_job_category_exist > 0){
                    $delete_job_category = $api->delete_job_category($job_category_id, $username);
                                        
                    if(!$delete_job_category){
                        $error = $delete_job_category;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete job type
    else if($transaction == 'delete job type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['job_type_id']) && !empty($_POST['job_type_id'])){
            $username = $_POST['username'];
            $job_type_id = $_POST['job_type_id'];

            $check_job_type_exist = $api->check_job_type_exist($job_type_id);

            if($check_job_type_exist > 0){
                $delete_job_type = $api->delete_job_type($job_type_id, $username);
                                    
                if($delete_job_type){
                    echo 'Deleted';
                }
                else{
                    echo $delete_job_type;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple job type
    else if($transaction == 'delete multiple job type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['job_type_id'])){
            $username = $_POST['username'];
            $job_type_ids = $_POST['job_type_id'];

            foreach($job_type_ids as $job_type_id){
                $check_job_type_exist = $api->check_job_type_exist($job_type_id);

                if($check_job_type_exist > 0){
                    $delete_job_type = $api->delete_job_type($job_type_id, $username);
                                        
                    if(!$delete_job_type){
                        $error = $delete_job_type;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete recruitment pipeline
    else if($transaction == 'delete recruitment pipeline'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['recruitment_pipeline_id']) && !empty($_POST['recruitment_pipeline_id'])){
            $username = $_POST['username'];
            $recruitment_pipeline_id = $_POST['recruitment_pipeline_id'];

            $check_recruitment_pipeline_exist = $api->check_recruitment_pipeline_exist($recruitment_pipeline_id);

            if($check_recruitment_pipeline_exist > 0){
                $delete_recruitment_pipeline = $api->delete_recruitment_pipeline($recruitment_pipeline_id, $username);
                                    
                if($delete_recruitment_pipeline){
                    $delete_all_recruitment_pipeline_stage = $api->delete_all_recruitment_pipeline_stage($recruitment_pipeline_id, $username);
                                    
                    if($delete_all_recruitment_pipeline_stage){
                        echo 'Deleted';
                    }
                    else{
                        echo $delete_all_recruitment_pipeline_stage;
                    }
                }
                else{
                    echo $delete_recruitment_pipeline;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple recruitment pipeline
    else if($transaction == 'delete multiple recruitment pipeline'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['recruitment_pipeline_id'])){
            $username = $_POST['username'];
            $recruitment_pipeline_ids = $_POST['recruitment_pipeline_id'];

            foreach($recruitment_pipeline_ids as $recruitment_pipeline_id){
                $check_recruitment_pipeline_exist = $api->check_recruitment_pipeline_exist($recruitment_pipeline_id);

                if($check_recruitment_pipeline_exist > 0){
                    $delete_recruitment_pipeline = $api->delete_recruitment_pipeline($recruitment_pipeline_id, $username);
                                    
                    if($delete_recruitment_pipeline){
                        $delete_all_recruitment_pipeline_stage = $api->delete_all_recruitment_pipeline_stage($recruitment_pipeline_id, $username);
                                        
                        if(!$delete_all_recruitment_pipeline_stage){
                            $error = $delete_all_recruitment_pipeline_stage;
                        }
                    }
                    else{
                        $error = $delete_recruitment_pipeline;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete recruitment pipeline stage
    else if($transaction == 'delete recruitment pipeline stage'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['recruitment_pipeline_stage_id']) && !empty($_POST['recruitment_pipeline_stage_id'])){
            $username = $_POST['username'];
            $recruitment_pipeline_stage_id = $_POST['recruitment_pipeline_stage_id'];

            $recruitment_pipeline_stage_details = $api->get_recruitment_pipeline_stage_details($recruitment_pipeline_stage_id);
            $recruitment_pipeline_id = $recruitment_pipeline_stage_details[0]['RECRUITMENT_PIPELINE_ID'];
            $stage_order = $recruitment_pipeline_stage_details[0]['STAGE_ORDER'];

            $check_recruitment_pipeline_stage_exist = $api->check_recruitment_pipeline_stage_exist($recruitment_pipeline_stage_id);

            if($check_recruitment_pipeline_stage_exist > 0){
                $update_recruitment_pipeline_stage_subsquent_order = $api->update_recruitment_pipeline_stage_subsquent_order($recruitment_pipeline_id, $stage_order, $username);
                                    
                if($update_recruitment_pipeline_stage_subsquent_order){
                    $delete_recruitment_pipeline_stage = $api->delete_recruitment_pipeline_stage($recruitment_pipeline_stage_id, $username);
                                    
                    if($delete_recruitment_pipeline_stage){
                        echo 'Deleted';
                    }
                    else{
                        echo $delete_recruitment_pipeline_stage;
                    }
                }
                else{
                    echo $update_recruitment_pipeline_stage_subsquent_order;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple recruitment pipeline stage
    else if($transaction == 'delete multiple recruitment pipeline stage'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['recruitment_pipeline_stage_id'])){
            $username = $_POST['username'];
            $recruitment_pipeline_stage_ids = $_POST['recruitment_pipeline_stage_id'];

            foreach($recruitment_pipeline_stage_ids as $recruitment_pipeline_stage_id){
                $recruitment_pipeline_stage_details = $api->get_recruitment_pipeline_stage_details($recruitment_pipeline_stage_id);
                $recruitment_pipeline_id = $recruitment_pipeline_stage_details[0]['RECRUITMENT_PIPELINE_ID'];
                $stage_order = $recruitment_pipeline_stage_details[0]['STAGE_ORDER'];

                $check_recruitment_pipeline_stage_exist = $api->check_recruitment_pipeline_stage_exist($recruitment_pipeline_stage_id);

                if($check_recruitment_pipeline_stage_exist > 0){
                    $update_recruitment_pipeline_stage_subsquent_order = $api->update_recruitment_pipeline_stage_subsquent_order($recruitment_pipeline_id, $stage_order, $username);
                                    
                    if($update_recruitment_pipeline_stage_subsquent_order){
                        $delete_recruitment_pipeline_stage = $api->delete_recruitment_pipeline_stage($recruitment_pipeline_stage_id, $username);
                                        
                        if(!$delete_recruitment_pipeline_stage){
                            $error = $delete_recruitment_pipeline_stage;
                        }
                    }
                    else{
                        $error = $update_recruitment_pipeline_stage_subsquent_order;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete recruitment scorecard
    else if($transaction == 'delete recruitment scorecard'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['recruitment_scorecard_id']) && !empty($_POST['recruitment_scorecard_id'])){
            $username = $_POST['username'];
            $recruitment_scorecard_id = $_POST['recruitment_scorecard_id'];

            $check_recruitment_scorecard_exist = $api->check_recruitment_scorecard_exist($recruitment_scorecard_id);

            if($check_recruitment_scorecard_exist > 0){
                $delete_recruitment_scorecard = $api->delete_recruitment_scorecard($recruitment_scorecard_id, $username);
                                    
                if($delete_recruitment_scorecard){
                    $delete_all_recruitment_scorecard_section = $api->delete_all_recruitment_scorecard_section($recruitment_scorecard_id, $username);
                                    
                    if($delete_all_recruitment_scorecard_section){
                        $delete_all_recruitment_scorecard_section_option = $api->delete_all_recruitment_scorecard_section_option($recruitment_scorecard_id, null, $username);
                                    
                        if($delete_all_recruitment_scorecard_section_option){
                            echo 'Deleted';
                        }
                        else{
                            echo $delete_all_recruitment_scorecard_section_option;
                        }
                    }
                    else{
                        echo $delete_all_recruitment_scorecard_section;
                    }
                }
                else{
                    echo $delete_recruitment_scorecard;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple recruitment scorecard
    else if($transaction == 'delete multiple recruitment scorecard'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['recruitment_scorecard_id'])){
            $username = $_POST['username'];
            $recruitment_scorecard_ids = $_POST['recruitment_scorecard_id'];

            foreach($recruitment_scorecard_ids as $recruitment_scorecard_id){
                $check_recruitment_scorecard_exist = $api->check_recruitment_scorecard_exist($recruitment_scorecard_id);

                if($check_recruitment_scorecard_exist > 0){
                    $delete_recruitment_scorecard = $api->delete_recruitment_scorecard($recruitment_scorecard_id, $username);
                                    
                    if($delete_recruitment_scorecard){
                        $delete_all_recruitment_scorecard_section = $api->delete_all_recruitment_scorecard_section($recruitment_scorecard_id, $username);
                                    
                        if($delete_all_recruitment_scorecard_section){
                            $delete_all_recruitment_scorecard_section_option = $api->delete_all_recruitment_scorecard_section_option($recruitment_scorecard_id, null, $username);
                                        
                            if(!$delete_all_recruitment_scorecard_section_option){
                                $error = $delete_all_recruitment_scorecard_section_option;
                            }
                        }
                        else{
                            $error = $delete_all_recruitment_scorecard_section;
                        }
                    }
                    else{
                        $error = $delete_recruitment_scorecard;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete recruitment scorecard section
    else if($transaction == 'delete recruitment scorecard section'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['recruitment_scorecard_section_id']) && !empty($_POST['recruitment_scorecard_section_id'])){
            $username = $_POST['username'];
            $recruitment_scorecard_section_id = $_POST['recruitment_scorecard_section_id'];

            $check_recruitment_scorecard_section_exist = $api->check_recruitment_scorecard_section_exist($recruitment_scorecard_section_id);

            if($check_recruitment_scorecard_section_exist > 0){
                $delete_recruitment_scorecard_section = $api->delete_recruitment_scorecard_section($recruitment_scorecard_section_id, $username);
                                        
                if($delete_recruitment_scorecard_section){
                    $delete_all_recruitment_scorecard_section_option = $api->delete_all_recruitment_scorecard_section_option(null, $recruitment_scorecard_section_id, $username);
                                    
                    if($delete_all_recruitment_scorecard_section_option){
                        echo 'Deleted';
                    }
                    else{
                        echo $delete_all_recruitment_scorecard_section_option;
                    }
                }
                else{
                    echo $delete_recruitment_scorecard_section;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple recruitment scorecard section
    else if($transaction == 'delete multiple recruitment scorecard section'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['recruitment_scorecard_section_id'])){
            $username = $_POST['username'];
            $recruitment_scorecard_section_ids = $_POST['recruitment_scorecard_section_id'];

            foreach($recruitment_scorecard_section_ids as $recruitment_scorecard_section_id){
                $check_recruitment_scorecard_section_exist = $api->check_recruitment_scorecard_section_exist($recruitment_scorecard_section_id);

                if($check_recruitment_scorecard_section_exist > 0){
                    $delete_recruitment_scorecard_section = $api->delete_recruitment_scorecard_section($recruitment_scorecard_section_id, $username);
                                            
                    if($delete_recruitment_scorecard_section){
                        $delete_all_recruitment_scorecard_section_option = $api->delete_all_recruitment_scorecard_section_option(null, $recruitment_scorecard_section_id, $username);
                                        
                        if(!$delete_all_recruitment_scorecard_section_option){
                            $error = $delete_all_recruitment_scorecard_section_option;
                        }
                    }
                    else{
                        $error = $delete_recruitment_scorecard_section;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete recruitment scorecard section option
    else if($transaction == 'delete recruitment scorecard section option'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['recruitment_scorecard_section_option_id']) && !empty($_POST['recruitment_scorecard_section_option_id'])){
            $username = $_POST['username'];
            $recruitment_scorecard_section_option_id = $_POST['recruitment_scorecard_section_option_id'];

            $check_recruitment_scorecard_section_option_exist = $api->check_recruitment_scorecard_section_option_exist($recruitment_scorecard_section_option_id);

            if($check_recruitment_scorecard_section_option_exist > 0){
                $delete_recruitment_scorecard_section_option = $api->delete_recruitment_scorecard_section_option($recruitment_scorecard_section_option_id, $username);
                                        
                if($delete_recruitment_scorecard_section_option){
                    echo 'Deleted';
                }
                else{
                    echo $delete_recruitment_scorecard_section_option;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple recruitment scorecard section option
    else if($transaction == 'delete multiple recruitment scorecard section option'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['recruitment_scorecard_section_option_id'])){
            $username = $_POST['username'];
            $recruitment_scorecard_section_option_ids = $_POST['recruitment_scorecard_section_option_id'];

            foreach($recruitment_scorecard_section_option_ids as $recruitment_scorecard_section_option_id){
                $check_recruitment_scorecard_section_option_exist = $api->check_recruitment_scorecard_section_option_exist($recruitment_scorecard_section_option_id);

                if($check_recruitment_scorecard_section_option_exist > 0){
                    $delete_recruitment_scorecard_section_option = $api->delete_recruitment_scorecard_section_option($recruitment_scorecard_section_option_id, $username);
                                            
                    if(!$delete_recruitment_scorecard_section_option){
                        $error = $delete_recruitment_scorecard_section_option;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete job
    else if($transaction == 'delete job'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['job_id']) && !empty($_POST['job_id'])){
            $username = $_POST['username'];
            $job_id = $_POST['job_id'];

            $check_job_exist = $api->check_job_exist($job_id);

            if($check_job_exist > 0){
                $delete_job = $api->delete_job($job_id, $username);
                                    
                if($delete_job){
                    $delete_all_job_team_member = $api->delete_all_job_team_member($job_id, $username);

                    if($delete_all_job_team_member){
                        $delete_all_job_branch = $api->delete_all_job_branch($job_id, $username);

                        if($delete_all_job_branch){
                            echo 'Deleted';
                        }
                        else {
                            echo $delete_all_job_branch;
                        }
                    }
                    else {
                        echo $delete_all_job_team_member;
                    }
                }
                else{
                    echo $delete_job_type;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple job type
    else if($transaction == 'delete multiple job'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['job_id'])){
            $username = $_POST['username'];
            $job_ids = $_POST['job_id'];

            foreach($job_ids as $job_id){
                $check_job_exist = $api->check_job_exist($job_id);

                if($check_job_exist > 0){
                    $delete_job = $api->delete_job($job_id, $username);
                                        
                    if($delete_job){
                        $delete_all_job_team_member = $api->delete_all_job_team_member($job_id, $username);

                        if($delete_all_job_team_member){
                            $delete_all_job_branch = $api->delete_all_job_branch($job_id, $username);

                            if(!$delete_all_job_branch){
                                $error = $delete_all_job_branch;
                            }
                        }
                        else {
                            $error = $delete_all_job_team_member;
                        }
                    }
                    else{
                        $error = $delete_job_type;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Delete job applicant
    else if($transaction == 'delete job applicant'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['applicant_id']) && !empty($_POST['applicant_id'])){
            $username = $_POST['username'];
            $applicant_id = $_POST['applicant_id'];

            $check_job_applicant_exist = $api->check_job_applicant_exist($applicant_id);

            if($check_job_applicant_exist > 0){
                $delete_job_applicant = $api->delete_job_applicant($applicant_id, $username);
                                    
                if($delete_job_applicant){
                    echo 'Deleted';
                }
                else{
                    echo $delete_job_applicant;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Delete multiple job applicant
    else if($transaction == 'delete multiple job applicant'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['applicant_id'])){
            $username = $_POST['username'];
            $applicant_ids = $_POST['applicant_id'];

            foreach($applicant_ids as $applicant_id){
                $check_job_applicant_exist = $api->check_job_applicant_exist($applicant_id);

                if($check_job_applicant_exist > 0){
                    $delete_job_applicant = $api->delete_job_applicant($applicant_id, $username);
                                    
                    if(!$delete_job_applicant){
                        $error = $delete_job_applicant;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deleted';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Approve transactions
    # -------------------------------------------------------------

    # Approve leave
    else if($transaction == 'approve leave'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_id']) && !empty($_POST['leave_id']) && isset($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $leave_id = $_POST['leave_id'];
            $decision_remarks = $_POST['decision_remarks'];

            $check_leave_exist = $api->check_leave_exist($leave_id);

            if($check_leave_exist > 0){
                $leave_details = $api->get_leave_details($leave_id);
                $employee_id = $leave_details[0]['EMPLOYEE_ID'];
                $leave_date = $leave_details[0]['LEAVE_DATE'];
                $start_time = $leave_details[0]['START_TIME'];
                $end_time = $leave_details[0]['END_TIME'];

                $check_leave_overlap_start = $api->check_leave_overlap($leave_id, $employee_id, $leave_date, $start_time);
                $check_leave_overlap_end = $api->check_leave_overlap($leave_id, $employee_id, $leave_date, $end_time);

                if($check_leave_overlap_start == 0 && $check_leave_overlap_end == 0){
                    $update_leave_status = $api->update_leave_status($leave_id, 'APV', $decision_remarks, $username);
    
                    if($update_leave_status){
                        $from_details = $api->get_leave_details($leave_id);
                        $from_id = $from_details[0]['DECISION_BY'];
                        $from_details = $api->get_employee_details('', $from_id);
                        $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                        $notification_details = $api->get_notification_details(16);
                        $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                
                        $send_notification = $api->send_notification(16, $from_id, $employee_id, $notification_title, $notification_message, $username);

                        if($send_notification){
                            echo 'Approved';
                        }
                        else{
                            echo $send_notification;
                        }
                    }
                    else{
                        echo $update_leave_status;
                    }
                }
                else{
                    echo 'Overlap';
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Approve multiple leave
    else if($transaction == 'approve multiple leave'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_id']) && !empty($_POST['leave_id']) && isset($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $leave_ids = explode(',', $_POST['leave_id']);
            $decision_remarks = $_POST['decision_remarks'];
            $error_count = 0;
            $error = '';

            foreach($leave_ids as $leave_id){
                $check_leave_exist = $api->check_leave_exist($leave_id);

                if($check_leave_exist > 0){
                    $leave_details = $api->get_leave_details($leave_id);
                    $employee_id = $leave_details[0]['EMPLOYEE_ID'];
                    $leave_date = $leave_details[0]['LEAVE_DATE'];
                    $start_time = $leave_details[0]['START_TIME'];
                    $end_time = $leave_details[0]['END_TIME'];

                    $check_leave_overlap_start = $api->check_leave_overlap($leave_id, $employee_id, $leave_date, $start_time);
                    $check_leave_overlap_end = $api->check_leave_overlap($leave_id, $employee_id, $leave_date, $end_time);

                    if($check_leave_overlap_start == 0 && $check_leave_overlap_end == 0){
                        $update_leave_status = $api->update_leave_status($leave_id, 'APV', $decision_remarks, $username);
        
                        if($update_leave_status){
                            $from_details = $api->get_leave_details($leave_id);
                            $from_id = $from_details[0]['DECISION_BY'];
                            $from_details = $api->get_employee_details('', $from_id);
                            $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                            $notification_details = $api->get_notification_details(16);
                            $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                            $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                            $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                        
                            $send_notification = $api->send_notification(16, $from_id, $employee_id, $notification_title, $notification_message, $username);

                            if(!$send_notification){
                                $error_count = $error_count + 1;
                            }
                        }
                        else{
                            $error_count = $error_count + 1;
                        }
                    }
                    else{
                        $error_count = $error_count + 1;
                    }
                }
                else{
                    $error_count = $error_count + 1;
                }
            }

            if($error_count > 0){
                if($error_count){
                    $error = 'There was an error approving '. number_format($error_count) .' leave.<br/>';
                }
                else{
                    $error = 'There was an error approving '. number_format($error_count) .' leaves.<br/>';
                }
            }

            if(empty($error)){
                echo 'Approved';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Approve overlap leave
    else if($transaction == 'approve overlap leave'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_id']) && !empty($_POST['leave_id']) && isset($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $leave_id = $_POST['leave_id'];
            $decision_remarks = $_POST['decision_remarks'];

            $check_leave_exist = $api->check_leave_exist($leave_id);

            if($check_leave_exist > 0){
                $leave_details = $api->get_leave_details($leave_id);
                $employee_id = $leave_details[0]['EMPLOYEE_ID'];
                $leave_date = $leave_details[0]['LEAVE_DATE'];
                $start_time = $leave_details[0]['START_TIME'];
                $end_time = $leave_details[0]['END_TIME'];

                $update_leave_status = $api->update_leave_status($leave_id, 'APV', $decision_remarks, $username);
    
                if($update_leave_status){
                    $from_details = $api->get_leave_details($leave_id);
                    $from_id = $from_details[0]['DECISION_BY'];
                    $from_details = $api->get_employee_details('', $from_id);
                    $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                    $notification_details = $api->get_notification_details(16);
                    $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                    $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                    $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                
                    $send_notification = $api->send_notification(16, $from_id, $attendance_adjustment_employee_id, $notification_title, $notification_message, $username);

                    if($send_notification){
                        echo 'Approved';
                    }
                    else{
                        echo $send_notification;
                    }
                }
                else{
                    echo $update_leave_status;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Approve attendance creation
    else if($transaction == 'approve attendance creation'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id']) && isset($_POST['sanction']) && isset($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $request_id = $_POST['request_id'];
            $sanction = $_POST['sanction'];
            $decision_remarks = $_POST['decision_remarks'];

            $check_attendance_creation_exist = $api->check_attendance_creation_exist($request_id);

            if($check_attendance_creation_exist > 0){
                $attendance_creation_details = $api->get_attendance_creation_details($request_id);
                $attendance_creation_employee_id = $attendance_creation_details[0]['EMPLOYEE_ID'];
                $attendance_creation_time_in_date = $api->check_date('empty', $attendance_creation_details[0]['TIME_IN_DATE'], '', 'Y-m-d', '', '', '');
                $attendance_creation_time_in = $api->check_date('empty', $attendance_creation_details[0]['TIME_IN'], '', 'H:i:00', '', '', '');
                $attendance_creation_time_in_behavior = $api->get_time_in_behavior($attendance_creation_employee_id, $attendance_creation_time_in_date, $attendance_creation_time_in);
                $late = $api->get_attendance_late_total($attendance_creation_employee_id, $attendance_creation_time_in_date, $attendance_creation_time_in);

                $attendance_creation_time_out_date = $api->check_date('empty', $attendance_creation_details[0]['TIME_OUT_DATE'], '', 'Y-m-d', '', '', '');
                $attendance_creation_time_out = $api->check_date('empty', $attendance_creation_details[0]['TIME_OUT'], '', 'H:i:00', '', '', '');

                $check_attendance_validation = $api->check_attendance_validation($attendance_creation_time_in_date, $attendance_creation_time_in, $attendance_creation_time_out_date, $attendance_creation_time_out);

                if(empty($check_attendance_validation)){
                    if(!empty($attendance_creation_time_out_date) && !empty($attendance_creation_time_out)){
                        $early_leaving = $api->get_attendance_early_leaving_total($attendance_creation_employee_id, $attendance_creation_time_in_date, $attendance_creation_time_out);
                        $overtime = $api->get_attendance_overtime_total($attendance_creation_employee_id, $attendance_creation_time_in_date, $attendance_creation_time_out_date, $attendance_creation_time_out);
                        $total_hours_worked = $api->get_attendance_total_hours($attendance_creation_employee_id, $attendance_creation_time_in_date, $attendance_creation_time_in, $attendance_creation_time_out_date, $attendance_creation_time_out);
                        $attendance_creation_time_out_behavior = $api->get_time_out_behavior($attendance_creation_employee_id, $attendance_creation_time_in_date, $attendance_creation_time_out_date, $attendance_creation_time_out);
                    }
                    else{
                        $time_out_behavior = '';
                        $early_leaving = 0;
                        $overtime = 0;
                        $total_hours_worked = 0;
                    }

                    $attendance_setting_details = $api->get_attendance_setting_details(1);
                    $max_attendance = $attendance_setting_details[0]['MAX_ATTENDANCE'] ?? 1;
                    $get_clock_in_total = $api->get_clock_in_total($attendance_creation_employee_id, $attendance_creation_time_in_date);
    
                    if($get_clock_in_total < $max_attendance){
                        $insert_manual_employee_attendance = $api->insert_manual_employee_attendance($attendance_creation_employee_id, $attendance_creation_time_in_date, $attendance_creation_time_in, $attendance_creation_time_in_behavior, $attendance_creation_time_out_date, $attendance_creation_time_out, $attendance_creation_time_out_behavior, $late, $early_leaving, $overtime, $total_hours_worked, 'Created through attendance creation.', $username);

                        if($insert_manual_employee_attendance){
                            $update_attendance_creation_status = $api->update_attendance_creation_status($request_id, 'APV', $decision_remarks, $sanction, $username);
    
                            if($update_attendance_creation_status){
                                $from_details = $api->get_attendance_creation_details($request_id);
                                $from_id = $from_details[0]['DECISION_BY'];
                                $from_details = $api->get_employee_details('', $from_id);
                                $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                                $notification_details = $api->get_notification_details(13);
                                $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                                $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                                $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                            
                                $send_notification = $api->send_notification(13, $from_id, $attendance_creation_employee_id, $notification_title, $notification_message, $username);

                                if($send_notification){
                                    echo 'Approved';
                                }
                                else{
                                    echo $send_notification;
                                }
                            }
                            else{
                                echo $update_attendance_creation_status;
                            }
                        }
                        else{
                            echo $insert_manual_employee_attendance;
                        }
                    }
                    else{
                        echo 'Max Attendance';
                    }
                }
                else{
                    echo $check_attendance_validation;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Approve multiple attendance creation
    else if($transaction == 'approve multiple attendance creation'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id']) && isset($_POST['sanction']) && isset($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $request_ids = explode(',', $_POST['request_id']);
            $sanction = $_POST['sanction'];
            $decision_remarks = $_POST['decision_remarks'];
            $error_count = 0;
            $error = '';

            foreach($request_ids as $request_id){
                $check_attendance_creation_exist = $api->check_attendance_creation_exist($request_id);

                if($check_attendance_creation_exist > 0){
                    $attendance_creation_details = $api->get_attendance_creation_details($request_id);
                    $attendance_creation_employee_id = $attendance_creation_details[0]['EMPLOYEE_ID'];
                    $attendance_creation_time_in_date = $api->check_date('empty', $attendance_creation_details[0]['TIME_IN_DATE'], '', 'Y-m-d', '', '', '');
                    $attendance_creation_time_in = $api->check_date('empty', $attendance_creation_details[0]['TIME_IN'], '', 'H:i:00', '', '', '');
                    $attendance_creation_time_in_behavior = $api->get_time_in_behavior($attendance_creation_employee_id, $attendance_creation_time_in_date, $attendance_creation_time_in);
                    $late = $api->get_attendance_late_total($attendance_creation_employee_id, $attendance_creation_time_in_date, $attendance_creation_time_in);

                    $attendance_creation_time_out_date = $api->check_date('empty', $attendance_creation_details[0]['TIME_OUT_DATE'], '', 'Y-m-d', '', '', '');
                    $attendance_creation_time_out = $api->check_date('empty', $attendance_creation_details[0]['TIME_OUT'], '', 'H:i:00', '', '', '');

                    $check_attendance_validation = $api->check_attendance_validation($attendance_creation_time_in_date, $attendance_creation_time_in, $attendance_creation_time_out_date, $attendance_creation_time_out);

                    if(empty($check_attendance_validation)){
                        if(!empty($attendance_creation_time_out_date) && !empty($attendance_creation_time_out)){
                            $early_leaving = $api->get_attendance_early_leaving_total($attendance_creation_employee_id, $attendance_creation_time_in_date, $attendance_creation_time_out);
                            $overtime = $api->get_attendance_overtime_total($attendance_creation_employee_id, $attendance_creation_time_in_date, $attendance_creation_time_out_date, $attendance_creation_time_out);
                            $total_hours_worked = $api->get_attendance_total_hours($attendance_creation_employee_id, $attendance_creation_time_in_date, $attendance_creation_time_in, $attendance_creation_time_out_date, $attendance_creation_time_out);
                            $attendance_creation_time_out_behavior = $api->get_time_out_behavior($attendance_creation_employee_id, $attendance_creation_time_in_date, $attendance_creation_time_out_date, $attendance_creation_time_out);
                        }
                        else{
                            $time_out_behavior = '';
                            $early_leaving = 0;
                            $overtime = 0;
                            $total_hours_worked = 0;
                        }

                        $attendance_setting_details = $api->get_attendance_setting_details(1);
                        $max_attendance = $attendance_setting_details[0]['MAX_ATTENDANCE'] ?? 1;
                        $get_clock_in_total = $api->get_clock_in_total($attendance_creation_employee_id, $attendance_creation_time_in_date);
        
                        if($get_clock_in_total < $max_attendance){
                            $insert_manual_employee_attendance = $api->insert_manual_employee_attendance($attendance_creation_employee_id, $attendance_creation_time_in_date, $attendance_creation_time_in, $attendance_creation_time_in_behavior, $attendance_creation_time_out_date, $attendance_creation_time_out, $attendance_creation_time_out_behavior, $late, $early_leaving, $overtime, $total_hours_worked, 'Created through attendance creation.', $username);

                            if($insert_manual_employee_attendance){
                                $update_attendance_creation_status = $api->update_attendance_creation_status($request_id, 'APV', $decision_remarks, $sanction, $username);
        
                                if($update_attendance_creation_status){
                                    $from_details = $api->get_attendance_creation_details($request_id);
                                    $from_id = $from_details[0]['DECISION_BY'];
                                    $from_details = $api->get_employee_details('', $from_id);
                                    $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                                    $notification_details = $api->get_notification_details(13);
                                    $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                                    $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                                    $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                
                                    $send_notification = $api->send_notification(13, $from_id, $attendance_creation_employee_id, $notification_title, $notification_message, $username);

                                    if(!$send_notification){
                                        $error_count = $error_count + 1;
                                    }
                                }
                                else{
                                    $error_count = $error_count + 1;
                                }
                            }
                            else{
                                $error_count = $error_count + 1;
                            }
                        }
                        else{
                            $error_count = $error_count + 1;
                        }
                    }
                    else{
                        $error_count = $error_count + 1;
                    }
                }
                else{
                    $error_count = $error_count + 1;
                }
            }

            if($error_count > 0){
                if($error_count){
                    $error = 'There was an error approving '. number_format($error_count) .' attendance creation.<br/>';
                }
                else{
                    $error = 'There were errors in approving '. number_format($error_count) .' attendance creations.<br/>';
                }
            }

            if(empty($error)){
                echo 'Approved';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Approve attendance adjustment
    else if($transaction == 'approve attendance adjustment'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id']) && isset($_POST['sanction']) && isset($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $request_id = $_POST['request_id'];
            $sanction = $_POST['sanction'];
            $decision_remarks = $_POST['decision_remarks'];

            $check_attendance_adjustment_exist = $api->check_attendance_adjustment_exist($request_id);

            if($check_attendance_adjustment_exist > 0){
                $attendance_adjustment_details = $api->get_attendance_adjustment_details($request_id);
                $attendance_adjustment_employee_id = $attendance_adjustment_details[0]['EMPLOYEE_ID'];
                $attendance_adjustment_attendance_id = $attendance_adjustment_details[0]['ATTENDANCE_ID'];
                $attendance_adjustment_time_in_date = $api->check_date('empty', $attendance_adjustment_details[0]['TIME_IN_DATE_ADJUSTED'], '', 'Y-m-d', '', '', '');
                $attendance_adjustment_time_in = $api->check_date('empty', $attendance_adjustment_details[0]['TIME_IN_ADJUSTED'], '', 'H:i:00', '', '', '');
                $attendance_adjustment_time_out_date = $api->check_date('empty', $attendance_adjustment_details[0]['TIME_OUT_DATE_ADJUSTED'], '', 'Y-m-d', '', '', '');
                $attendance_adjustment_time_out = $api->check_date('empty', $attendance_adjustment_details[0]['TIME_OUT_ADJUSTED'], '', 'H:i:00', '', '', '');
                $time_in_behavior = $api->get_time_in_behavior($attendance_adjustment_employee_id, $attendance_adjustment_time_in_date, $attendance_adjustment_time_in);
                $late = $api->get_attendance_late_total($attendance_adjustment_employee_id, $attendance_adjustment_time_in_date, $attendance_adjustment_time_in);

                $check_attendance_validation = $api->check_attendance_validation($attendance_adjustment_time_in_date, $attendance_adjustment_time_in, $attendance_adjustment_time_out_date, $attendance_adjustment_time_out);

                if(empty($check_attendance_validation)){
                    if(!empty($attendance_adjustment_time_out_date) && !empty($attendance_adjustment_time_out)){
                        $early_leaving = $api->get_attendance_early_leaving_total($attendance_adjustment_employee_id, $attendance_adjustment_time_in_date, $attendance_adjustment_time_out);
                        $overtime = $api->get_attendance_overtime_total($attendance_adjustment_employee_id, $attendance_adjustment_time_in_date, $attendance_adjustment_time_out_date, $attendance_adjustment_time_out);
                        $total_hours_worked = $api->get_attendance_total_hours($attendance_adjustment_employee_id, $attendance_adjustment_time_in_date, $attendance_adjustment_time_in, $attendance_adjustment_time_out_date, $attendance_adjustment_time_out);
                        $time_out_behavior = $api->get_time_out_behavior($attendance_adjustment_employee_id, $attendance_adjustment_time_in_date, $attendance_adjustment_time_out_date, $attendance_adjustment_time_out);
                    }
                    else{
                        $time_out_behavior = '';
                        $early_leaving = 0;
                        $overtime = 0;
                        $total_hours_worked = 0;
                    }

                    $check_employee_attendance_exist = $api->check_employee_attendance_exist($attendance_adjustment_attendance_id);

                    if($check_employee_attendance_exist > 0){
                        $get_employee_attendance_details = $api->get_employee_attendance_details($attendance_adjustment_attendance_id);
                        $time_date_details = $get_employee_attendance_details[0]['TIME_IN_DATE'];

                        if(strtotime($time_date_details) != strtotime($attendance_adjustment_time_in_date)){
                            if($get_clock_in_total < $max_attendance){
                                $update_manual_employee_attendance = $api->update_manual_employee_attendance($attendance_adjustment_attendance_id, $attendance_adjustment_time_in_date, $attendance_adjustment_time_in, $time_in_behavior, $attendance_adjustment_time_out_date, $attendance_adjustment_time_out, $time_out_behavior, $late, $early_leaving, $overtime, $total_hours_worked, 'Adjusted using attendance adjustment.', $username);

                                if($update_manual_employee_attendance){
                                    $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'APV', $decision_remarks, $sanction, $username);
    
                                    if($update_attendance_adjustment_status){
                                        $from_details = $api->get_attendance_adjustment_details($request_id);
                                        $from_id = $from_details[0]['DECISION_BY'];
                                        $from_details = $api->get_employee_details('', $from_id);
                                        $from_file_as = $from_details[0]['FILE_AS'] ?? null;
    
                                        $notification_details = $api->get_notification_details(14);
                                        $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                                        $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                                        $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                    
                                        $send_notification = $api->send_notification(14, $from_id, $attendance_adjustment_employee_id, $notification_title, $notification_message, $username);
    
                                        if($send_notification){
                                            echo 'Approved';
                                        }
                                        else{
                                            echo $send_notification;
                                        }
                                    }
                                    else{
                                        echo $update_attendance_adjustment_status;
                                    }
                                }
                                else{
                                    echo $update_manual_employee_attendance;
                                }
                            }
                            else{
                                echo 'Max Attendance';
                            }
                        }
                        else{
                            $update_manual_employee_attendance = $api->update_manual_employee_attendance($attendance_adjustment_attendance_id, $attendance_adjustment_time_in_date, $attendance_adjustment_time_in, $time_in_behavior, $attendance_adjustment_time_out_date, $attendance_adjustment_time_out, $time_out_behavior, $late, $early_leaving, $overtime, $total_hours_worked, 'Adjusted using attendance adjustment.' , $username);

                            if($update_manual_employee_attendance){
                                $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'APV', $decision_remarks, $sanction, $username);
    
                                if($update_attendance_adjustment_status){
                                    $from_details = $api->get_attendance_adjustment_details($request_id);
                                    $from_id = $from_details[0]['DECISION_BY'];
                                    $from_details = $api->get_employee_details('', $from_id);
                                    $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                                    $notification_details = $api->get_notification_details(14);
                                    $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                                    $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                                    $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                
                                    $send_notification = $api->send_notification(14, $from_id, $attendance_adjustment_employee_id, $notification_title, $notification_message, $username);

                                    if($send_notification){
                                        echo 'Approved';
                                    }
                                    else{
                                        echo $send_notification;
                                    }
                                }
                                else{
                                    echo $update_attendance_adjustment_status;
                                }
                            }
                            else{
                                echo $update_manual_employee_attendance;
                            }
                        }
                    }
                    else{
                        echo 'Attendance Record Not Found';
                    }
                }
                else{
                    echo $check_attendance_validation;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Approve multiple attendance adjustment
    else if($transaction == 'approve multiple attendance adjustment'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id']) && isset($_POST['sanction']) && isset($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $request_ids = explode(',', $_POST['request_id']);
            $sanction = $_POST['sanction'];
            $decision_remarks = $_POST['decision_remarks'];
            $error_count = 0;
            $error = '';

            foreach($request_ids as $request_id){
                $check_attendance_adjustment_exist = $api->check_attendance_adjustment_exist($request_id);

                if($check_attendance_adjustment_exist > 0){
                    $attendance_adjustment_details = $api->get_attendance_adjustment_details($request_id);
                    $attendance_adjustment_employee_id = $attendance_adjustment_details[0]['EMPLOYEE_ID'];
                    $attendance_adjustment_attendance_id = $attendance_adjustment_details[0]['ATTENDANCE_ID'];
                    $attendance_adjustment_time_in_date = $api->check_date('empty', $attendance_adjustment_details[0]['TIME_IN_DATE_ADJUSTED'], '', 'Y-m-d', '', '', '');
                    $attendance_adjustment_time_in = $api->check_date('empty', $attendance_adjustment_details[0]['TIME_IN_ADJUSTED'], '', 'H:i:00', '', '', '');
                    $attendance_adjustment_time_out_date = $api->check_date('empty', $attendance_adjustment_details[0]['TIME_OUT_DATE_ADJUSTED'], '', 'Y-m-d', '', '', '');
                    $attendance_adjustment_time_out = $api->check_date('empty', $attendance_adjustment_details[0]['TIME_OUT_ADJUSTED'], '', 'H:i:00', '', '', '');
                    $time_in_behavior = $api->get_time_in_behavior($attendance_adjustment_employee_id, $attendance_adjustment_time_in_date, $attendance_adjustment_time_in);
                    $late = $api->get_attendance_late_total($attendance_adjustment_employee_id, $attendance_adjustment_time_in_date, $attendance_adjustment_time_in);
    
                    $check_attendance_validation = $api->check_attendance_validation($attendance_adjustment_time_in_date, $attendance_adjustment_time_in, $attendance_adjustment_time_out_date, $attendance_adjustment_time_out);
    
                    if(empty($check_attendance_validation)){
                        if(!empty($attendance_adjustment_time_out_date) && !empty($attendance_adjustment_time_out)){
                            $early_leaving = $api->get_attendance_early_leaving_total($attendance_adjustment_employee_id, $attendance_adjustment_time_in_date, $attendance_adjustment_time_out);
                            $overtime = $api->get_attendance_overtime_total($attendance_adjustment_employee_id, $attendance_adjustment_time_in_date, $attendance_adjustment_time_out_date, $attendance_adjustment_time_out);
                            $total_hours_worked = $api->get_attendance_total_hours($attendance_adjustment_employee_id, $attendance_adjustment_time_in_date, $attendance_adjustment_time_in, $attendance_adjustment_time_out_date, $attendance_adjustment_time_out);
                            $time_out_behavior = $api->get_time_out_behavior($attendance_adjustment_employee_id, $attendance_adjustment_time_in_date, $attendance_adjustment_time_out_date, $attendance_adjustment_time_out);
                        }
                        else{
                            $time_out_behavior = '';
                            $early_leaving = 0;
                            $overtime = 0;
                            $total_hours_worked = 0;
                        }
    
                        $check_employee_attendance_exist = $api->check_employee_attendance_exist($attendance_adjustment_attendance_id);
    
                        if($check_employee_attendance_exist > 0){
                            $get_employee_attendance_details = $api->get_employee_attendance_details($attendance_adjustment_attendance_id);
                            $time_date_details = $get_employee_attendance_details[0]['TIME_IN_DATE'];
    
                            if(strtotime($time_date_details) != strtotime($attendance_adjustment_time_in_date)){
                                if($get_clock_in_total < $max_attendance){
                                    $update_manual_employee_attendance = $api->update_manual_employee_attendance($attendance_adjustment_attendance_id, $attendance_adjustment_time_in_date, $attendance_adjustment_time_in, $time_in_behavior, $attendance_adjustment_time_out_date, $attendance_adjustment_time_out, $time_out_behavior, $late, $early_leaving, $overtime, $total_hours_worked, 'Adjusted using attendance adjustment.', $username);
    
                                    if($update_manual_employee_attendance){
                                        $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'APV', $decision_remarks, $sanction, $username);
        
                                        if($update_attendance_adjustment_status){
                                            $from_details = $api->get_attendance_adjustment_details($request_id);
                                            $from_id = $from_details[0]['DECISION_BY'];
                                            $from_details = $api->get_employee_details('', $from_id);
                                            $from_file_as = $from_details[0]['FILE_AS'] ?? null;
        
                                            $notification_details = $api->get_notification_details(14);
                                            $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                                            $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                                            $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                        
                                            $send_notification = $api->send_notification(14, $from_id, $attendance_adjustment_employee_id, $notification_title, $notification_message, $username);
        
                                            if(!$send_notification){
                                                $error_count = $error_count + 1;
                                            }
                                        }
                                        else{
                                            $error_count = $error_count + 1;
                                        }
                                    }
                                    else{
                                        $error_count = $error_count + 1;
                                    }
                                }
                                else{
                                    $error_count = $error_count + 1;
                                }
                            }
                            else{
                                $update_manual_employee_attendance = $api->update_manual_employee_attendance($attendance_adjustment_attendance_id, $attendance_adjustment_time_in_date, $attendance_adjustment_time_in, $time_in_behavior, $attendance_adjustment_time_out_date, $attendance_adjustment_time_out, $time_out_behavior, $late, $early_leaving, $overtime, $total_hours_worked, 'Adjusted using attendance adjustment.' , $username);
    
                                if($update_manual_employee_attendance){
                                    $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'APV', $decision_remarks, $sanction, $username);
        
                                    if($update_attendance_adjustment_status){
                                        $from_details = $api->get_attendance_adjustment_details($request_id);
                                        $from_id = $from_details[0]['DECISION_BY'];
                                        $from_details = $api->get_employee_details('', $from_id);
                                        $from_file_as = $from_details[0]['FILE_AS'] ?? null;
    
                                        $notification_details = $api->get_notification_details(14);
                                        $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                                        $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                                        $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                    
                                        $send_notification = $api->send_notification(14, $from_id, $attendance_adjustment_employee_id, $notification_title, $notification_message, $username);
    
                                        if(!$send_notification){
                                            $error_count = $error_count + 1;
                                        }
                                    }
                                    else{
                                        $error_count = $error_count + 1;
                                    }
                                }
                                else{
                                    $error_count = $error_count + 1;
                                }
                            }
                        }
                        else{
                            $error_count = $error_count + 1;
                        }
                    }
                    else{
                        $error_count = $error_count + 1;
                    }
                }
                else{
                    $error_count = $error_count + 1;
                }
            }

            if($error_count > 0){
                if($error_count){
                    $error = 'There was an error approving '. number_format($error_count) .' attendance adjustment.<br/>';
                }
                else{
                    $error = 'There were errors in approving '. number_format($error_count) .' attendance adjustments.<br/>';
                }
            }

            if(empty($error)){
                echo 'Approved';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Reject transactions
    # -------------------------------------------------------------

    # Reject leave
    else if($transaction == 'reject leave'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_id']) && !empty($_POST['leave_id']) && isset($_POST['decision_remarks']) && !empty($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $leave_id = $_POST['leave_id'];
            $decision_remarks = $_POST['decision_remarks'];

            $leave_details = $api->get_leave_details($leave_id);
            $employee_id = $leave_details[0]['EMPLOYEE_ID'];
            $leave_type = $leave_details[0]['LEAVE_TYPE'];
            $leave_date = $leave_details[0]['LEAVE_DATE'];
            $start_time = $leave_details[0]['START_TIME'];
            $end_time = $leave_details[0]['END_TIME'];

            $leave_day = date('N', strtotime($leave_date));

            $work_shift_schedule = $api->get_work_shift_schedule($employee_id, $leave_date, $leave_day);
            $work_shift_time_in = $work_shift_schedule[0]['START_TIME'];
            $work_shift_time_out = $work_shift_schedule[0]['END_TIME'];

            $total_working_hours = round(abs(strtotime($work_shift_time_out) - strtotime($work_shift_time_in)) / 3600, 2);
            $total_leave_hours = round(abs(strtotime($end_time) - strtotime($start_time)) / 3600, 2);

            if($total_working_hours == $total_leave_hours){
                $total_hours =  - 1;
            }
            else{
                $total_hours =  - 1 * abs(($total_working_hours - $total_leave_hours) / $total_working_hours);
            }

            $check_leave_exist = $api->check_leave_exist($leave_id);

            if($check_leave_exist > 0){
                $update_leave_status = $api->update_leave_status($leave_id, 'REJ', $decision_remarks, $username);
    
                if($update_leave_status){
                    $update_leave_entitlement_count = $api->update_leave_entitlement_count($employee_id, $leave_type, $leave_date, $total_hours, $username);

                    if($update_leave_entitlement_count){
                        $from_details = $api->get_leave_details($leave_id);
                        $from_id = $from_details[0]['DECISION_BY'];
                        $from_details = $api->get_employee_details('', $from_id);
                        $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                        $notification_details = $api->get_notification_details(17);
                        $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                
                        $send_notification = $api->send_notification(17, $from_id, $employee_id, $notification_title, $notification_message, $username);

                        if($send_notification){
                            echo 'Rejected';
                        }
                        else{
                            echo $send_notification;
                        }
                    }
                    else{
                        echo $update_leave_entitlement_count;
                    }
                }
                else{
                    echo $update_leave_status;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Reject multiple leave
    else if($transaction == 'reject multiple leave'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_id']) && !empty($_POST['leave_id']) && isset($_POST['decision_remarks']) && !empty($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $leave_ids = explode(',', $_POST['leave_id']);
            $decision_remarks = $_POST['decision_remarks'];
            $error_count = 0;
            $error = '';

            foreach($leave_ids as $leave_id){
                $leave_details = $api->get_leave_details($leave_id);
                $employee_id = $leave_details[0]['EMPLOYEE_ID'];
                $leave_type = $leave_details[0]['LEAVE_TYPE'];
                $leave_date = $leave_details[0]['LEAVE_DATE'];
                $start_time = $leave_details[0]['START_TIME'];
                $end_time = $leave_details[0]['END_TIME'];

                $leave_day = date('N', strtotime($leave_date));

                $work_shift_schedule = $api->get_work_shift_schedule($employee_id, $leave_date, $leave_day);
                $work_shift_time_in = $work_shift_schedule[0]['START_TIME'];
                $work_shift_time_out = $work_shift_schedule[0]['END_TIME'];

                $total_working_hours = round(abs(strtotime($work_shift_time_out) - strtotime($work_shift_time_in)) / 3600, 2);
                $total_leave_hours = round(abs(strtotime($end_time) - strtotime($start_time)) / 3600, 2);

                if($total_working_hours == $total_leave_hours){
                    $total_hours =  - 1;
                }
                else{
                    $total_hours =  - 1 * abs(($total_working_hours - $total_leave_hours) / $total_working_hours);
                }

                $check_leave_exist = $api->check_leave_exist($leave_id);

                if($check_leave_exist > 0){
                    $update_leave_status = $api->update_leave_status($leave_id, 'REJ', $decision_remarks, $username);
        
                    if($update_leave_status){
                        $update_leave_entitlement_count = $api->update_leave_entitlement_count($employee_id, $leave_type, $leave_date, $total_hours, $username);

                        if($update_leave_entitlement_count){
                            $from_details = $api->get_leave_details($leave_id);
                            $from_id = $from_details[0]['DECISION_BY'];
                            $from_details = $api->get_employee_details('', $from_id);
                            $from_file_as = $from_details[0]['FILE_AS'] ?? null;
    
                            $notification_details = $api->get_notification_details(17);
                            $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                            $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                            $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                    
                            $send_notification = $api->send_notification(17, $from_id, $employee_id, $notification_title, $notification_message, $username);
    
                            if(!$send_notification){
                                $error_count = $error_count + 1;
                            }
                        }
                        else{
                            $error_count = $error_count + 1;
                        }
                    }
                    else{
                        $error_count = $error_count + 1;
                    }
                }
                else{
                    $error_count = $error_count + 1;
                }
            }

            if($error_count > 0){
                if($error_count){
                    $error = 'There was an error rejecting '. number_format($error_count) .' leave.<br/>';
                }
                else{
                    $error = 'There was an error rejecting '. number_format($error_count) .' leaves.<br/>';
                }
            }

            if(empty($error)){
                echo 'Rejected';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Reject attendance creation
    else if($transaction == 'reject attendance creation'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id']) && isset($_POST['decision_remarks']) && !empty($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $request_id = $_POST['request_id'];
            $decision_remarks = $_POST['decision_remarks'];

            $check_attendance_creation_exist = $api->check_attendance_creation_exist($request_id);

            if($check_attendance_creation_exist > 0){
                $update_attendance_creation_status = $api->update_attendance_creation_status($request_id, 'REJ', $decision_remarks, null, $username);
    
                if($update_attendance_creation_status){
                    $from_details = $api->get_attendance_creation_details($request_id);
                    $from_id = $from_details[0]['DECISION_BY'];
                    $employee_id = $from_details[0]['EMPLOYEE_ID'];
                    $from_details = $api->get_employee_details('', $from_id);
                    $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                    $notification_details = $api->get_notification_details(11);
                    $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                    $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                    $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                
                    $send_notification = $api->send_notification(11, $from_id, $employee_id, $notification_title, $notification_message, $username);

                    if($send_notification){
                        echo 'Rejected';
                    }
                    else{
                        echo $send_notification;
                    }
                }
                else{
                    echo $update_attendance_creation_status;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Reject multiple attendance creation
    else if($transaction == 'reject multiple attendance creation'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id']) && isset($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $request_ids = explode(',', $_POST['request_id']);
            $decision_remarks = $_POST['decision_remarks'];
            $error_count = 0;
            $error = '';

            foreach($request_ids as $request_id){
                $check_attendance_creation_exist = $api->check_attendance_creation_exist($request_id);

                if($check_attendance_creation_exist > 0){
                    $update_attendance_creation_status = $api->update_attendance_creation_status($request_id, 'REJ', $decision_remarks, null, $username);
        
                    if($update_attendance_creation_status){
                        $from_details = $api->get_attendance_creation_details($request_id);
                        $from_id = $from_details[0]['DECISION_BY'];
                        $employee_id = $from_details[0]['EMPLOYEE_ID'];
                        $from_details = $api->get_employee_details('', $from_id);
                        $from_file_as = $from_details[0]['FILE_AS'] ?? null;
    
                        $notification_details = $api->get_notification_details(11);
                        $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                    
                        $send_notification = $api->send_notification(11, $from_id, $employee_id, $notification_title, $notification_message, $username);

                        if(!$send_notification){
                            $error_count = $error_count + 1;
                        }
                    }
                    else{
                        $error_count = $error_count + 1;
                    }
                }
                else{
                    $error_count = $error_count + 1;
                }
            }

            if($error_count > 0){
                if($error_count){
                    $error = 'There was an error rejecting '. number_format($error_count) .' attendance creation.<br/>';
                }
                else{
                    $error = 'There was an error rejecting '. number_format($error_count) .' attendance creation.<br/>';
                }
            }

            if(empty($error)){
                echo 'Rejected';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Reject attendance adjustment
    else if($transaction == 'reject attendance adjustment'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id']) && isset($_POST['decision_remarks']) && !empty($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $request_id = $_POST['request_id'];
            $decision_remarks = $_POST['decision_remarks'];

            $check_attendance_adjustment_exist = $api->check_attendance_adjustment_exist($request_id);

            if($check_attendance_adjustment_exist > 0){
                $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'REJ', $decision_remarks, null, $username);
    
                if($update_attendance_adjustment_status){
                    $from_details = $api->get_attendance_adjustment_details($request_id);
                    $from_id = $from_details[0]['DECISION_BY'];
                    $employee_id = $from_details[0]['EMPLOYEE_ID'];
                    $from_details = $api->get_employee_details('', $from_id);
                    $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                    $notification_details = $api->get_notification_details(12);
                    $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                    $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                    $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                
                    $send_notification = $api->send_notification(12, $from_id, $employee_id, $notification_title, $notification_message, $username);

                    if($send_notification){
                        echo 'Rejected';
                    }
                    else{
                        echo $send_notification;
                    }
                }
                else{
                    echo $update_attendance_adjustment_status;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Reject multiple attendance adjustment
    else if($transaction == 'reject multiple attendance adjustment'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id']) && isset($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $request_ids = explode(',', $_POST['request_id']);
            $decision_remarks = $_POST['decision_remarks'];
            $error_count = 0;
            $error = '';

            foreach($request_ids as $request_id){
                $check_attendance_adjustment_exist = $api->check_attendance_adjustment_exist($request_id);

                if($check_attendance_adjustment_exist > 0){
                    $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'REJ', $decision_remarks, null, $username);
        
                    if($update_attendance_adjustment_status){
                        $from_details = $api->get_attendance_adjustment_details($request_id);
                        $from_id = $from_details[0]['DECISION_BY'];
                        $employee_id = $from_details[0]['EMPLOYEE_ID'];
                        $from_details = $api->get_employee_details('', $from_id);
                        $from_file_as = $from_details[0]['FILE_AS'] ?? null;
    
                        $notification_details = $api->get_notification_details(12);
                        $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                    
                        $send_notification = $api->send_notification(12, $from_id, $employee_id, $notification_title, $notification_message, $username);

                        if(!$send_notification){
                            $error_count = $error_count + 1;
                        }
                    }
                    else{
                        $error_count = $error_count + 1;
                    }
                }
                else{
                    $error_count = $error_count + 1;
                }
            }

            if($error_count > 0){
                if($error_count){
                    $error = 'There was an error rejecting '. number_format($error_count) .' attendance adjustment.<br/>';
                }
                else{
                    $error = 'There was an error rejecting '. number_format($error_count) .' attendance adjustment.<br/>';
                }
            }

            if(empty($error)){
                echo 'Rejected';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Cancel transactions
    # -------------------------------------------------------------

    # Cancel leave
    else if($transaction == 'cancel leave'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_id']) && !empty($_POST['leave_id']) && isset($_POST['decision_remarks']) && !empty($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $leave_id = $_POST['leave_id'];
            $decision_remarks = $_POST['decision_remarks'];

            $leave_details = $api->get_leave_details($leave_id);
            $employee_id = $leave_details[0]['EMPLOYEE_ID'];
            $leave_type = $leave_details[0]['LEAVE_TYPE'];
            $leave_date = $leave_details[0]['LEAVE_DATE'];
            $start_time = $leave_details[0]['START_TIME'];
            $end_time = $leave_details[0]['END_TIME'];

            $leave_day = date('N', strtotime($leave_date));

            $work_shift_schedule = $api->get_work_shift_schedule($employee_id, $leave_date, $leave_day);
            $work_shift_time_in = $work_shift_schedule[0]['START_TIME'];
            $work_shift_time_out = $work_shift_schedule[0]['END_TIME'];

            $total_working_hours = round(abs(strtotime($work_shift_time_out) - strtotime($work_shift_time_in)) / 3600, 2);
            $total_leave_hours = round(abs(strtotime($end_time) - strtotime($start_time)) / 3600, 2);

            if($total_working_hours == $total_leave_hours){
                $total_hours =  - 1;
            }
            else{
                $total_hours =  - 1 * abs(($total_working_hours - $total_leave_hours) / $total_working_hours);
            }

            $check_leave_exist = $api->check_leave_exist($leave_id);

            if($check_leave_exist > 0){
                $update_leave_status = $api->update_leave_status($leave_id, 'CAN', $decision_remarks, $username);
    
                if($update_leave_status){
                    $update_leave_entitlement_count = $api->update_leave_entitlement_count($employee_id, $leave_type, $leave_date, $total_hours, $username);

                    if($update_leave_entitlement_count){
                        $from_details = $api->get_leave_details($leave_id);
                        $from_id = $from_details[0]['DECISION_BY'];
                        $from_details = $api->get_employee_details('', $from_id);
                        $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                        $notification_details = $api->get_notification_details(18);
                        $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                
                        $send_notification = $api->send_notification(18, $from_id, $employee_id, $notification_title, $notification_message, $username);

                        if($send_notification){
                            echo 'Cancelled';
                        }
                        else{
                            echo $send_notification;
                        }
                    }
                    else{
                        echo $update_leave_entitlement_count;
                    }
                }
                else{
                    echo $update_leave_status;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------
    
    # Cancel multiple leave
    else if($transaction == 'cancel multiple leave'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_id']) && !empty($_POST['leave_id']) && isset($_POST['decision_remarks']) && !empty($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $username = $_POST['username'];
            $leave_ids = explode(',', $_POST['leave_id']);
            $decision_remarks = $_POST['decision_remarks'];
            $error_count = 0;
            $error = '';

            foreach($leave_ids as $leave_id){
                $leave_details = $api->get_leave_details($leave_id);
                $employee_id = $leave_details[0]['EMPLOYEE_ID'];
                $leave_type = $leave_details[0]['LEAVE_TYPE'];
                $leave_date = $leave_details[0]['LEAVE_DATE'];
                $start_time = $leave_details[0]['START_TIME'];
                $end_time = $leave_details[0]['END_TIME'];

                $leave_day = date('N', strtotime($leave_date));

                $work_shift_schedule = $api->get_work_shift_schedule($employee_id, $leave_date, $leave_day);
                $work_shift_time_in = $work_shift_schedule[0]['START_TIME'];
                $work_shift_time_out = $work_shift_schedule[0]['END_TIME'];

                $total_working_hours = round(abs(strtotime($work_shift_time_out) - strtotime($work_shift_time_in)) / 3600, 2);
                $total_leave_hours = round(abs(strtotime($end_time) - strtotime($start_time)) / 3600, 2);

                if($total_working_hours == $total_leave_hours){
                    $total_hours =  - 1;
                }
                else{
                    $total_hours =  - 1 * abs(($total_working_hours - $total_leave_hours) / $total_working_hours);
                }

                $check_leave_exist = $api->check_leave_exist($leave_id);

                if($check_leave_exist > 0){
                    $update_leave_status = $api->update_leave_status($leave_id, 'CAN', $decision_remarks, $username);
        
                    if($update_leave_status){
                        $update_leave_entitlement_count = $api->update_leave_entitlement_count($employee_id, $leave_type, $leave_date, $total_hours, $username);

                        if($update_leave_entitlement_count){
                            $from_details = $api->get_leave_details($leave_id);
                            $from_id = $from_details[0]['DECISION_BY'];
                            $from_details = $api->get_employee_details('', $from_id);
                            $from_file_as = $from_details[0]['FILE_AS'] ?? null;
    
                            $notification_details = $api->get_notification_details(18);
                            $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                            $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                            $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                    
                            $send_notification = $api->send_notification(18, $from_id, $employee_id, $notification_title, $notification_message, $username);
    
                            if(!$send_notification){
                                $error_count = $error_count + 1;
                            }
                        }
                        else{
                            $error_count = $error_count + 1;
                        }
                    }
                    else{
                        $error_count = $error_count + 1;
                    }
                }
                else{
                    $error_count = $error_count + 1;
                }
            }

            if($error_count > 0){
                if($error_count){
                    $error = 'There was an error cancelling '. number_format($error_count) .' leave.<br/>';
                }
                else{
                    $error = 'There was an error cancelling '. number_format($error_count) .' leaves.<br/>';
                }
            }

            if(empty($error)){
                echo 'Cancelled';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Cancel attendance creation
    else if($transaction == 'cancel attendance creation'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id']) && isset($_POST['decision_remarks']) && !empty($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $request_id = $_POST['request_id'];
            $decision_remarks = $_POST['decision_remarks'];

            $check_attendance_creation_exist = $api->check_attendance_creation_exist($request_id);

            if($check_attendance_creation_exist > 0){
                $update_attendance_creation_status = $api->update_attendance_creation_status($request_id, 'CAN', $decision_remarks, null, $username);
    
                if($update_attendance_creation_status){
                    $from_details = $api->get_attendance_creation_details($request_id);
                    $from_id = $from_details[0]['DECISION_BY'];
                    $employee_id = $from_details[0]['EMPLOYEE_ID'];
                    $from_details = $api->get_employee_details('', $from_id);
                    $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                    $notification_details = $api->get_notification_details(7);
                    $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                    $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                    $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                
                    $send_notification = $api->send_notification(7, $from_id, $employee_id, $notification_title, $notification_message, $username);

                    if($send_notification){
                        echo 'Cancelled';
                    }
                    else{
                        echo $send_notification;
                    }
                }
                else{
                    echo $update_attendance_creation_status;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Cancel multiple attendance creation
    else if($transaction == 'cancel multiple attendance creation'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id']) && isset($_POST['decision_remarks']) && !empty($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $request_ids = explode(',', $_POST['request_id']);
            $decision_remarks = $_POST['decision_remarks'];
            $error_count = 0;
            $error = '';

            foreach($request_ids as $request_id){
                $check_attendance_creation_exist = $api->check_attendance_creation_exist($request_id);

                if($check_attendance_creation_exist > 0){
                    $update_attendance_creation_status = $api->update_attendance_creation_status($request_id, 'CAN', $decision_remarks, null, $username);
        
                    if($update_attendance_creation_status){
                        $from_details = $api->get_attendance_creation_details($request_id);
                        $from_id = $from_details[0]['DECISION_BY'];
                        $employee_id = $from_details[0]['EMPLOYEE_ID'];
                        $from_details = $api->get_employee_details('', $from_id);
                        $from_file_as = $from_details[0]['FILE_AS'] ?? null;
    
                        $notification_details = $api->get_notification_details(7);
                        $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                    
                        $send_notification = $api->send_notification(7, $from_id, $employee_id, $notification_title, $notification_message, $username);

                        if(!$send_notification){
                            $error_count = $error_count + 1;
                        }
                    }
                    else{
                        $error_count = $error_count + 1;
                    }
                }
                else{
                    $error_count = $error_count + 1;
                }
            }

            if($error_count > 0){
                if($error_count){
                    $error = 'There was an error cancelling '. number_format($error_count) .' attendance creation.<br/>';
                }
                else{
                    $error = 'There were errors in cancelling '. number_format($error_count) .' attendance creations.<br/>';
                }
            }

            if(empty($error)){
                echo 'Cancelled';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Cancel attendance adjustment
    else if($transaction == 'cancel attendance adjustment'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id']) && isset($_POST['decision_remarks']) && !empty($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $request_id = $_POST['request_id'];
            $decision_remarks = $_POST['decision_remarks'];

            $check_attendance_adjustment_exist = $api->check_attendance_adjustment_exist($request_id);

            if($check_attendance_adjustment_exist > 0){
                $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'CAN', $decision_remarks, null, $username);
    
                if($update_attendance_adjustment_status){
                    $from_details = $api->get_attendance_adjustment_details($request_id);
                    $from_id = $from_details[0]['DECISION_BY'];
                    $employee_id = $from_details[0]['EMPLOYEE_ID'];
                    $from_details = $api->get_employee_details('', $from_id);
                    $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                    $notification_details = $api->get_notification_details(8);
                    $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                    $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                    $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                
                    $send_notification = $api->send_notification(8, $from_id, $employee_id, $notification_title, $notification_message, $username);

                    if($send_notification){
                        echo 'Cancelled';
                    }
                    else{
                        echo $send_notification;
                    }
                }
                else{
                    echo $update_attendance_adjustment_status;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Cancel multiple attendance adjustment
    else if($transaction == 'cancel multiple attendance adjustment'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id']) && isset($_POST['decision_remarks']) && !empty($_POST['decision_remarks'])){
            $username = $_POST['username'];
            $request_ids = explode(',', $_POST['request_id']);
            $decision_remarks = $_POST['decision_remarks'];
            $error_count = 0;
            $error = '';

            foreach($request_ids as $request_id){
                $check_attendance_adjustment_exist = $api->check_attendance_adjustment_exist($request_id);

                if($check_attendance_adjustment_exist > 0){
                    $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'CAN', $decision_remarks, null, $username);
        
                    if($update_attendance_adjustment_status){
                        $from_details = $api->get_attendance_adjustment_details($request_id);
                        $from_id = $from_details[0]['DECISION_BY'];
                        $employee_id = $from_details[0]['EMPLOYEE_ID'];
                        $from_details = $api->get_employee_details('', $from_id);
                        $from_file_as = $from_details[0]['FILE_AS'] ?? null;
    
                        $notification_details = $api->get_notification_details(8);
                        $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                    
                        $send_notification = $api->send_notification(8, $from_id, $employee_id, $notification_title, $notification_message, $username);

                        if(!$send_notification){
                            $error_count = $error_count + 1;
                        }
                    }
                    else{
                        $error_count = $error_count + 1;
                    }
                }
                else{
                    $error_count = $error_count + 1;
                }
            }

            if($error_count > 0){
                if($error_count){
                    $error = 'There was an error cancelling '. number_format($error_count) .' attendance adjustment.<br/>';
                }
                else{
                    $error = 'There was an error cancelling '. number_format($error_count) .' attendance adjustment.<br/>';
                }
            }

            if(empty($error)){
                echo 'Cancelled';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Unlock transactions
    # -------------------------------------------------------------

    # Unlock user account
    else if($transaction == 'unlock user account'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['user_code']) && !empty($_POST['user_code'])){
            $username = $_POST['username'];
            $user_code = $_POST['user_code'];

            $check_user_account_exist = $api->check_user_account_exist($user_code);

            if($check_user_account_exist > 0){
                $update_user_account_lock_status = $api->update_user_account_lock_status($user_code, 'unlock', $system_date, $username);
    
                if($update_user_account_lock_status){
                    echo 'Unlocked';
                }
                else{
                    echo $update_user_account_lock_status;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Unlock multiple user account
    else if($transaction == 'unlock multiple user account'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['user_code'])){
            $username = $_POST['username'];
            $user_codes = $_POST['user_code'];

            foreach($user_codes as $user_code){
                $check_user_account_exist = $api->check_user_account_exist($user_code);

                if($check_user_account_exist > 0){
                    $update_user_account_lock_status = $api->update_user_account_lock_status($user_code, 'unlock', $system_date, $username);
                                    
                    if(!$update_user_account_lock_status){
                        $error = $update_user_account_lock_status;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Unlocked';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Unlock pay run
    else if($transaction == 'unlock pay run'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['pay_run_id']) && !empty($_POST['pay_run_id'])){
            $username = $_POST['username'];
            $pay_run_id = $_POST['pay_run_id'];

            $check_pay_run_exist = $api->check_pay_run_exist($pay_run_id);

            if($check_pay_run_exist > 0){
                $update_pay_run_status = $api->update_pay_run_status($pay_run_id, 'UNLOCK', $username);
    
                if($update_pay_run_status){
                    echo 'Unlocked';
                }
                else{
                    echo $update_pay_run_status;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Unlock multiple pay run
    else if($transaction == 'unlock multiple pay run'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['pay_run_id'])){
            $username = $_POST['username'];
            $pay_run_ids = $_POST['pay_run_id'];

            foreach($pay_run_ids as $pay_run_id){
                $check_pay_run_exist = $api->check_pay_run_exist($pay_run_id);

                if($check_pay_run_exist > 0){
                    $update_pay_run_status = $api->update_pay_run_status($pay_run_id, 'UNLOCK', $username);
                                    
                    if(!$update_pay_run_status){
                        $error = $update_pay_run_status;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Unlocked';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Lock transactions
    # -------------------------------------------------------------

    # Lock user account
    else if($transaction == 'lock user account'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['user_code']) && !empty($_POST['user_code'])){
            $username = $_POST['username'];
            $user_code = $_POST['user_code'];

            $check_user_account_exist = $api->check_user_account_exist($user_code);

            if($check_user_account_exist > 0){
                $update_user_account_lock_status = $api->update_user_account_lock_status($user_code, 'lock', $system_date, $username);
    
                if($update_user_account_lock_status){
                    echo 'Locked';
                }
                else{
                    echo $update_user_account_lock_status;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Lock multiple user account
    else if($transaction == 'lock multiple user account'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['user_code'])){
            $username = $_POST['username'];
            $user_codes = $_POST['user_code'];

            foreach($user_codes as $user_code){
                $check_user_account_exist = $api->check_user_account_exist($user_code);

                if($check_user_account_exist > 0){
                    $update_user_account_lock_status = $api->update_user_account_lock_status($user_code, 'lock', $system_date, $username);
                                    
                    if(!$update_user_account_lock_status){
                        $error = $update_user_account_lock_status;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Locked';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Lock pay run
    else if($transaction == 'lock pay run'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['pay_run_id']) && !empty($_POST['pay_run_id'])){
            $error = '';
            $username = $_POST['username'];
            $employee_details = $api->get_employee_details('', $username);
            $employee_id = $employee_details[0]['EMPLOYEE_ID'];
            $pay_run_id = $_POST['pay_run_id'];

            $pay_run_details = $api->get_pay_run_details($pay_run_id);
            $start_date = $api->check_date('empty', $pay_run_details[0]['START_DATE'], '', 'm/d/Y', '', '', '');
            $end_date = $api->check_date('empty', $pay_run_details[0]['END_DATE'], '', 'm/d/Y', '', '', '');

            $check_pay_run_exist = $api->check_pay_run_exist($pay_run_id);

            if($check_pay_run_exist > 0){
                $update_pay_run_status = $api->update_pay_run_status($pay_run_id, 'LOCK', $username);
    
                if($update_pay_run_status){
                    $pay_run_payee_details = $api->get_pay_run_payee_details($pay_run_id);

                    $sent_to_notification_details = $api->get_notification_details(19);
                    $sent_to_notification_title = $sent_to_notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                    $sent_to_notification_message = $sent_to_notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                    $sent_to_notification_message = str_replace('{coverage_date}', $start_date . ' - ' . $end_date, $sent_to_notification_message);

                    for($i = 0; $i < count($pay_run_payee_details); $i++) {
                        $recipient = $pay_run_payee_details[$i]['EMPLOYEE_ID'];
        
                        $send_notification = $api->send_notification(19, $employee_id, $recipient, $sent_to_notification_title, $sent_to_notification_message, $username);

                        if(!$send_notification){
                            $error = $send_notification;
                        }
                    }

                    if(empty($error)){
                        echo 'Locked';
                    }
                    else{
                        echo $error;
                    }
                }
                else{
                    echo $update_pay_run_status;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Lock multiple pay run
    else if($transaction == 'lock multiple pay run'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['pay_run_id'])){
            $username = $_POST['username'];
            $pay_run_ids = $_POST['pay_run_id'];

            foreach($pay_run_ids as $pay_run_id){
                $check_pay_run_exist = $api->check_pay_run_exist($pay_run_id);

                if($check_pay_run_exist > 0){
                    $update_pay_run_status = $api->update_pay_run_status($pay_run_id, 'LOCK', $username);
                                    
                    if(!$update_pay_run_status){
                        $error = $update_pay_run_status;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Locked';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Activate transactions
    # -------------------------------------------------------------

    # Activate user account
    else if($transaction == 'activate user account'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['user_code']) && !empty($_POST['user_code'])){
            $username = $_POST['username'];
            $user_code = $_POST['user_code'];

            $check_user_account_exist = $api->check_user_account_exist($user_code);

            if($check_user_account_exist > 0){
                $update_user_account_status = $api->update_user_account_status($user_code, 1, $username);
    
                if($update_user_account_status){
                    echo 'Activated';
                }
                else{
                    echo $update_user_account_status;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Activate multiple user account
    else if($transaction == 'activate multiple user account'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['user_code'])){
            $username = $_POST['username'];
            $user_codes = $_POST['user_code'];

            foreach($user_codes as $user_code){
                $check_user_account_exist = $api->check_user_account_exist($user_code);

                if($check_user_account_exist > 0){
                    $update_user_account_status = $api->update_user_account_status($user_code, 1, $username);
                                    
                    if(!$update_user_account_status){
                        $error = $update_user_account_status;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Activated';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Activate job
    else if($transaction == 'activate job'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['job_id']) && !empty($_POST['job_id'])){
            $username = $_POST['username'];
            $job_id = $_POST['job_id'];

            $check_job_exist = $api->check_job_exist($job_id);

            if($check_job_exist > 0){
                $update_job_status = $api->update_job_status($job_id, 'ACT', $username);
    
                if($update_job_status){
                    echo 'Activated';
                }
                else{
                    echo $update_job_status;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Activate multiple job
    else if($transaction == 'activate multiple job'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['job_id'])){
            $username = $_POST['username'];
            $job_ids = $_POST['job_id'];

            foreach($job_ids as $job_id){
                $check_job_exist = $api->check_job_exist($job_id);

                if($check_job_exist > 0){
                    $update_job_status = $api->update_job_status($job_id, 'ACT', $username);
        
                    if(!$update_job_status){
                        $error = $update_job_status;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Activated';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------
    
    # -------------------------------------------------------------
    #   Deactivate transactions
    # -------------------------------------------------------------

    # Deactivate user account
    else if($transaction == 'deactivate user account'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['user_code']) && !empty($_POST['user_code'])){
            $username = $_POST['username'];
            $user_code = $_POST['user_code'];

            $check_user_account_exist = $api->check_user_account_exist($user_code);

            if($check_user_account_exist > 0){
                $update_user_account_status = $api->update_user_account_status($user_code, 0, $username);
    
                if($update_user_account_status){
                    echo 'Deactivated';
                }
                else{
                    echo $update_user_account_status;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Deactivate multiple user account
    else if($transaction == 'deactivate multiple user account'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['user_code'])){
            $username = $_POST['username'];
            $user_codes = $_POST['user_code'];

            foreach($user_codes as $user_code){
                $check_user_account_exist = $api->check_user_account_exist($user_code);

                if($check_user_account_exist > 0){
                    $update_user_account_status = $api->update_user_account_status($user_code, 0, $username);
                                    
                    if(!$update_user_account_status){
                        $error = $update_user_account_status;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deactivated';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Deactivate job
    else if($transaction == 'deactivate job'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['job_id']) && !empty($_POST['job_id'])){
            $username = $_POST['username'];
            $job_id = $_POST['job_id'];

            $check_job_exist = $api->check_job_exist($job_id);

            if($check_job_exist > 0){
                $update_job_status = $api->update_job_status($job_id, 'INACT', $username);
    
                if($update_job_status){
                    echo 'Deactivated';
                }
                else{
                    echo $update_job_status;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Deactivate multiple job
    else if($transaction == 'deactivate multiple job'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['job_id'])){
            $username = $_POST['username'];
            $job_ids = $_POST['job_id'];

            foreach($job_ids as $job_id){
                $check_job_exist = $api->check_job_exist($job_id);

                if($check_job_exist > 0){
                    $update_job_status = $api->update_job_status($job_id, 'INACT', $username);
        
                    if(!$update_job_status){
                        $error = $update_job_status;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Deactivated';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   For recommendation transactions
    # -------------------------------------------------------------

    # For recommendation attendance creation
    else if($transaction == 'for recommendation attendance creation'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id'])){
            $username = $_POST['username'];
            $employee_details = $api->get_employee_details('', $username);
            $employee_id = $employee_details[0]['EMPLOYEE_ID'];
            $employee_file_as = $employee_details[0]['FILE_AS'];
            $request_id = $_POST['request_id'];

            $from_details = $api->get_employee_details('', $username);
            $from_id = $from_details[0]['EMPLOYEE_ID'] ?? null;
            $from_department = $from_details[0]['DEPARTMENT'] ?? null;
            $from_file_as = $from_details[0]['FILE_AS'] ?? null;

            $department_details = $api->get_department_details($from_department);
            $department_head = $department_details[0]['DEPARTMENT_HEAD'];

            $notification_details = $api->get_notification_details(3);
            $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
            $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
            $notification_message = str_replace('{name}', $from_file_as, $notification_message);

            $check_attendance_creation_exist = $api->check_attendance_creation_exist($request_id);

            if($check_attendance_creation_exist > 0){
                $attendance_setting_details = $api->get_attendance_setting_details(1);
                $attendance_creation_recommendation = $attendance_setting_details[0]['ATTENDANCE_CREATION_RECOMMENDATION'];
                $check_attendance_creation_recommendation_exception_exist = $api->check_attendance_creation_recommendation_exception_exist($employee_id);

                if($attendance_creation_recommendation == 0 || ($attendance_creation_recommendation && $check_attendance_creation_recommendation_exception_exist > 0)){
                    $update_attendance_creation_status = $api->update_attendance_creation_status($request_id, 'REC', null, null, $username);
    
                    if($update_attendance_creation_status){
                        $sent_to_notification_details = $api->get_notification_details(9);
                        $sent_to_notification_title = $sent_to_notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $sent_to_notification_message = $sent_to_notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $sent_to_notification_message = str_replace('{name}', $employee_file_as, $sent_to_notification_message);
    
                        $notification_recipient_details = $api->get_notification_recipient_details(9);
    
                        for($i = 0; $i < count($notification_recipient_details); $i++) {
                            $recipient = $notification_recipient_details[$i]['EMPLOYEE_ID'];
                
                            $send_notification = $api->send_notification(9, $employee_id, $recipient, $sent_to_notification_title, $sent_to_notification_message, $username);
    
                            if(!$send_notification){
                                $error = $send_notification;
                            }
                        }
                    }
                    else{
                        $error = $update_attendance_creation_status;
                    }

                    if(empty($error)){
                        echo 'Recommended';
                    }
                    else{
                        echo $error;
                    }
                }
                else{
                    $update_attendance_creation_status = $api->update_attendance_creation_status($request_id, 'FRREC', null, null, $username);
    
                    if($update_attendance_creation_status){
                        $send_notification = $api->send_notification(3, $from_id, $department_head, $notification_title, $notification_message, $username);
    
                        if($send_notification){
                            echo 'For Recommendation';
                        }
                        else{
                            echo $send_notification;
                        }
                    }
                    else{
                        echo $update_attendance_creation_status;
                    }
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # For recommendation multiple attendance creation
    else if($transaction == 'for recommendation multiple attendance creation'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id'])){
            $username = $_POST['username'];
            $employee_details = $api->get_employee_details('', $username);
            $employee_id = $employee_details[0]['EMPLOYEE_ID'];
            $employee_file_as = $employee_details[0]['FILE_AS'];
            $request_ids = $_POST['request_id'];

            $from_details = $api->get_employee_details('', $username);
            $from_id = $from_details[0]['EMPLOYEE_ID'] ?? null;
            $from_department = $from_details[0]['DEPARTMENT'] ?? null;
            $from_file_as = $from_details[0]['FILE_AS'] ?? null;

            $department_details = $api->get_department_details($from_department);
            $department_head = $department_details[0]['DEPARTMENT_HEAD'];

            $notification_details = $api->get_notification_details(3);
            $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
            $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
            $notification_message = str_replace('{name}', $from_file_as, $notification_message);

            foreach($request_ids as $request_id){
                $check_attendance_creation_exist = $api->check_attendance_creation_exist($request_id);

                if($check_attendance_creation_exist > 0){
                    $attendance_setting_details = $api->get_attendance_setting_details(1);
                    $attendance_creation_recommendation = $attendance_setting_details[0]['ATTENDANCE_CREATION_RECOMMENDATION'];
                    $check_attendance_creation_recommendation_exception_exist = $api->check_attendance_creation_recommendation_exception_exist($employee_id);

                    if($attendance_creation_recommendation == 0 || ($attendance_creation_recommendation && $check_attendance_creation_recommendation_exception_exist > 0)){
                        $update_attendance_creation_status = $api->update_attendance_creation_status($request_id, 'REC', null, null, $username);
        
                        if($update_attendance_creation_status){
                            $sent_to_notification_details = $api->get_notification_details(9);
                            $sent_to_notification_title = $sent_to_notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                            $sent_to_notification_message = $sent_to_notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                            $sent_to_notification_message = str_replace('{name}', $employee_file_as, $sent_to_notification_message);
        
                            $notification_recipient_details = $api->get_notification_recipient_details(9);
        
                            for($i = 0; $i < count($notification_recipient_details); $i++) {
                                $recipient = $notification_recipient_details[$i]['EMPLOYEE_ID'];
                    
                                $send_notification = $api->send_notification(9, $employee_id, $recipient, $sent_to_notification_title, $sent_to_notification_message, $username);
        
                                if(!$send_notification){
                                    $error = $send_notification;
                                }
                            }
                        }
                        else{
                            $error = $update_attendance_creation_status;
                        }
                    }
                    else{
                        $update_attendance_creation_status = $api->update_attendance_creation_status($request_id, 'FRREC', null, null, $username);
        
                        if($update_attendance_creation_status){
                            $send_notification = $api->send_notification(3, $from_id, $department_head, $notification_title, $notification_message, $username);
    
                            if(!$send_notification){
                                $error = $send_notification;
                            }
                        }
                        else{
                            $error = $update_attendance_creation_status;
                        }
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                if($attendance_creation_recommendation == 0 || ($attendance_creation_recommendation && $check_attendance_creation_recommendation_exception_exist > 0)){
                    echo 'Recommended';
                }
                else{
                    echo 'For Recommendation';
                }
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # For recommendation attendance adjustment
    else if($transaction == 'for recommendation attendance adjustment'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id'])){
            $username = $_POST['username'];
            $employee_details = $api->get_employee_details('', $username);
            $employee_id = $employee_details[0]['EMPLOYEE_ID'];
            $employee_file_as = $employee_details[0]['FILE_AS'];
            $request_id = $_POST['request_id'];

            $from_details = $api->get_employee_details('', $username);
            $from_id = $from_details[0]['EMPLOYEE_ID'] ?? null;
            $from_department = $from_details[0]['DEPARTMENT'] ?? null;
            $from_file_as = $from_details[0]['FILE_AS'] ?? null;

            $department_details = $api->get_department_details($from_department);
            $department_head = $department_details[0]['DEPARTMENT_HEAD'];

            $notification_details = $api->get_notification_details(4);
            $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
            $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
            $notification_message = str_replace('{name}', $from_file_as, $notification_message);

            $check_attendance_adjustment_exist = $api->check_attendance_adjustment_exist($request_id);

            if($check_attendance_adjustment_exist > 0){
                $attendance_setting_details = $api->get_attendance_setting_details(1);
                $attendance_adjustment_recommendation = $attendance_setting_details[0]['ATTENDANCE_ADJUSTMENT_RECOMMENDATION'];
                $check_attendance_creation_recommendation_exception_exist = $api->check_attendance_adjustment_recommendation_exception_exist($employee_id);

                if($attendance_adjustment_recommendation == 0 || ($attendance_adjustment_recommendation && $check_attendance_creation_recommendation_exception_exist > 0)){
                    $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'REC', null, null, $username);
    
                    if($update_attendance_adjustment_status){
                        $sent_to_notification_details = $api->get_notification_details(10);
                        $sent_to_notification_title = $sent_to_notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $sent_to_notification_message = $sent_to_notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $sent_to_notification_message = str_replace('{name}', $employee_file_as, $sent_to_notification_message);

                        $notification_recipient_details = $api->get_notification_recipient_details(10);

                        for($i = 0; $i < count($notification_recipient_details); $i++) {
                            $recipient = $notification_recipient_details[$i]['EMPLOYEE_ID'];
                
                            $send_notification = $api->send_notification(10, $employee_id, $recipient, $sent_to_notification_title, $sent_to_notification_message, $username);

                            if(!$send_notification){
                                $error = $send_notification;
                            }
                        }
                    }
                    else{
                        $error = $update_attendance_adjustment_status;
                    }

                    if(empty($error)){
                        echo 'Recommended';
                    }
                    else{
                        echo $error;
                    }
                }
                else{
                    $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'FRREC', null, null, $username);
    
                    if($update_attendance_adjustment_status){
                        $send_notification = $api->send_notification(4, $from_id, $department_head, $notification_title, $notification_message, $username);
    
                        if($send_notification){
                            echo 'For Recommendation';
                        }
                        else{
                            echo $send_notification;
                        }
                    }
                    else{
                        echo $update_attendance_adjustment_status;
                    }
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # For recommendation multiple attendance adjustment
    else if($transaction == 'for recommendation multiple attendance adjustment'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id'])){
            $username = $_POST['username'];
            $employee_details = $api->get_employee_details('', $username);
            $employee_id = $employee_details[0]['EMPLOYEE_ID'];
            $employee_file_as = $employee_details[0]['FILE_AS'];
            $request_ids = $_POST['request_id'];

            $from_details = $api->get_employee_details('', $username);
            $from_id = $from_details[0]['EMPLOYEE_ID'] ?? null;
            $from_department = $from_details[0]['DEPARTMENT'] ?? null;
            $from_file_as = $from_details[0]['FILE_AS'] ?? null;

            $department_details = $api->get_department_details($from_department);
            $department_head = $department_details[0]['DEPARTMENT_HEAD'];

            $notification_details = $api->get_notification_details(4);
            $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
            $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
            $notification_message = str_replace('{name}', $from_file_as, $notification_message);

            foreach($request_ids as $request_id){
                $check_attendance_adjustment_exist = $api->check_attendance_adjustment_exist($request_id);

                if($check_attendance_adjustment_exist > 0){
                    $attendance_setting_details = $api->get_attendance_setting_details(1);
                    $attendance_adjustment_recommendation = $attendance_setting_details[0]['ATTENDANCE_ADJUSTMENT_RECOMMENDATION'];
                    $check_attendance_creation_recommendation_exception_exist = $api->check_attendance_adjustment_recommendation_exception_exist($employee_id);

                    if($attendance_adjustment_recommendation == 0 || ($attendance_adjustment_recommendation && $check_attendance_creation_recommendation_exception_exist > 0)){
                        $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'FRREC', null, null, $username);
            
                        if($update_attendance_adjustment_status){
                            $sent_to_notification_details = $api->get_notification_details(10);
                            $sent_to_notification_title = $sent_to_notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                            $sent_to_notification_message = $sent_to_notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                            $sent_to_notification_message = str_replace('{name}', $employee_file_as, $sent_to_notification_message);
        
                            $notification_recipient_details = $api->get_notification_recipient_details(10);
        
                            for($i = 0; $i < count($notification_recipient_details); $i++) {
                                $recipient = $notification_recipient_details[$i]['EMPLOYEE_ID'];
                    
                                $send_notification = $api->send_notification(10, $employee_id, $recipient, $sent_to_notification_title, $sent_to_notification_message, $username);
        
                                if(!$send_notification){
                                    $error = $send_notification;
                                }
                            }
                        }
                        else{
                            $error = $update_attendance_adjustment_status;
                        }
                    }
                    else{
                        $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'FRREC', null, null, $username);
            
                        if($update_attendance_adjustment_status){
                            $send_notification = $api->send_notification(4, $from_id, $department_head, $notification_title, $notification_message, $username);

                            if(!$send_notification){
                                $error = $send_notification;
                            }
                        }
                        else{
                            $error = $update_attendance_adjustment_status;
                        }   
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                if($attendance_adjustment_recommendation == 0 || ($attendance_adjustment_recommendation && $check_attendance_creation_recommendation_exception_exist > 0)){
                    echo 'Recommended';
                }
                else{
                    echo 'For Recommendation';
                }
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Recommend transactions
    # -------------------------------------------------------------

    # Recommend attendance creation
    else if($transaction == 'recommend attendance creation'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id'])){
            $username = $_POST['username'];
            $request_id = $_POST['request_id'];
            $error = '';

            $check_attendance_creation_exist = $api->check_attendance_creation_exist($request_id);

            if($check_attendance_creation_exist > 0){
                $update_attendance_creation_status = $api->update_attendance_creation_status($request_id, 'REC', null, null, $username);
    
                if($update_attendance_creation_status){
                    $from_details = $api->get_attendance_creation_details($request_id);
                    $from_id = $from_details[0]['RECOMMENDED_BY'];
                    $employee_id = $from_details[0]['EMPLOYEE_ID'];
                    $employee_details = $api->get_employee_details($employee_id, '');
                    $employee_file_as = $employee_details[0]['FILE_AS'] ?? null;
                    $from_details = $api->get_employee_details('', $from_id);
                    $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                    $notification_details = $api->get_notification_details(5);
                    $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                    $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                    $notification_message = str_replace('{name}', $from_file_as, $notification_message);

                    $send_notification = $api->send_notification(5, $from_id, $employee_id, $notification_title, $notification_message, $username);

                    if($send_notification){
                        $sent_to_notification_details = $api->get_notification_details(9);
                        $sent_to_notification_title = $sent_to_notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $sent_to_notification_message = $sent_to_notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $sent_to_notification_message = str_replace('{name}', $employee_file_as, $sent_to_notification_message);

                        $notification_recipient_details = $api->get_notification_recipient_details(9);

                        for($i = 0; $i < count($notification_recipient_details); $i++) {
                            $recipient = $notification_recipient_details[$i]['EMPLOYEE_ID'];
                
                            $send_notification = $api->send_notification(9, $employee_id, $recipient, $sent_to_notification_title, $sent_to_notification_message, $username);

                            if(!$send_notification){
                                $error = $send_notification;
                            }
                        }
                    }
                    else{
                        $error = $send_notification;
                    }
                }
                else{
                    $error = $update_attendance_creation_status;
                }
            }
            else{
                $error = 'Not Found';
            }

            if(empty($error)){
                echo 'Recommended';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Recommend multiple attendance creation
    else if($transaction == 'recommend multiple attendance creation'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id'])){
            $username = $_POST['username'];
            $request_ids = $_POST['request_id'];
            $error = '';

            foreach($request_ids as $request_id){
                $check_attendance_creation_exist = $api->check_attendance_creation_exist($request_id);

                if($check_attendance_creation_exist > 0){
                    $update_attendance_creation_status = $api->update_attendance_creation_status($request_id, 'REC', null, null, $username);
        
                    if($update_attendance_creation_status){
                        $from_details = $api->get_attendance_creation_details($request_id);
                        $from_id = $from_details[0]['RECOMMENDED_BY'];
                        $employee_id = $from_details[0]['EMPLOYEE_ID'];
                        $employee_details = $api->get_employee_details($employee_id, '');
                        $employee_file_as = $employee_details[0]['FILE_AS'] ?? null;
                        $from_details = $api->get_employee_details('', $from_id);
                        $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                        $notification_details = $api->get_notification_details(5);
                        $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $notification_message = str_replace('{name}', $from_file_as, $notification_message);

                        $send_notification = $api->send_notification(5, $from_id, $employee_id, $notification_title, $notification_message, $username);

                        if($send_notification){
                            $sent_to_notification_details = $api->get_notification_details(9);
                            $sent_to_notification_title = $sent_to_notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                            $sent_to_notification_message = $sent_to_notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                            $sent_to_notification_message = str_replace('{name}', $employee_file_as, $notification_message);
    
                            $notification_recipient_details = $api->get_notification_recipient_details(9);
    
                            for($i = 0; $i < count($notification_recipient_details); $i++) {
                                $recipient = $notification_recipient_details[$i]['EMPLOYEE_ID'];
                    
                                $send_notification = $api->send_notification(9, $employee_id, $recipient, $sent_to_notification_title, $sent_to_notification_message, $username);
    
                                if(!$send_notification){
                                    $error = $send_notification;
                                }
                            }
                        }
                        else{
                            $error = $send_notification;
                        }
                    }
                    else{
                        $error = $update_attendance_creation_status;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Recommended';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Recommend attendance adjustment
    else if($transaction == 'recommend attendance adjustment'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id'])){
            $username = $_POST['username'];
            $request_id = $_POST['request_id'];
            $error = '';

            $check_attendance_adjustment_exist = $api->check_attendance_adjustment_exist($request_id);

            if($check_attendance_adjustment_exist > 0){
                $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'REC', null, null, $username);
    
                if($update_attendance_adjustment_status){
                    $from_details = $api->get_attendance_adjustment_details($request_id);
                    $from_id = $from_details[0]['RECOMMENDED_BY'];
                    $employee_id = $from_details[0]['EMPLOYEE_ID'];
                    $employee_details = $api->get_employee_details($employee_id, '');
                    $employee_file_as = $employee_details[0]['FILE_AS'] ?? null;
                    $from_details = $api->get_employee_details('', $from_id);
                    $from_file_as = $from_details[0]['FILE_AS'] ?? null;
        
                    $notification_details = $api->get_notification_details(6);
                    $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                    $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                    $notification_message = str_replace('{name}', $from_file_as, $notification_message);

                    $send_notification = $api->send_notification(6, $from_id, $employee_id, $notification_title, $notification_message, $username);

                    if($send_notification){
                        $sent_to_notification_details = $api->get_notification_details(10);
                        $sent_to_notification_title = $sent_to_notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $sent_to_notification_message = $sent_to_notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $sent_to_notification_message = str_replace('{name}', $employee_file_as, $notification_message);

                        $notification_recipient_details = $api->get_notification_recipient_details(10);

                        for($i = 0; $i < count($notification_recipient_details); $i++) {
                            $recipient = $notification_recipient_details[$i]['EMPLOYEE_ID'];
                
                            $send_notification = $api->send_notification(10, $employee_id, $recipient, $sent_to_notification_title, $sent_to_notification_message, $username);

                            if(!$send_notification){
                                $error = $send_notification;
                            }
                        }
                    }
                    else{
                        $error = $send_notification;
                    }
                }
                else{
                    $error = $update_attendance_adjustment_status;
                }
            }
            else{
                $error = 'Not Found';
            }

            if(empty($error)){
                echo 'Recommended';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Recommend multiple attendance adjustment
    else if($transaction == 'recommend multiple attendance adjustment'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['request_id']) && !empty($_POST['request_id'])){
            $username = $_POST['username'];
            $request_ids = $_POST['request_id'];

            foreach($request_ids as $request_id){
                $check_attendance_adjustment_exist = $api->check_attendance_adjustment_exist($request_id);

                if($check_attendance_adjustment_exist > 0){
                    $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'REC', null, null, $username);
        
                    if($update_attendance_adjustment_status){
                        $from_details = $api->get_attendance_adjustment_details($request_id);
                        $from_id = $from_details[0]['RECOMMENDED_BY'];
                        $employee_id = $from_details[0]['EMPLOYEE_ID'];
                        $employee_details = $api->get_employee_details($employee_id, '');
                        $employee_file_as = $employee_details[0]['FILE_AS'] ?? null;
                        $from_details = $api->get_employee_details('', $from_id);
                        $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                        $notification_details = $api->get_notification_details(6);
                        $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                        
                        $send_notification = $api->send_notification(6, $from_id, $employee_id, $notification_title, $notification_message, $username);

                        if($send_notification){
                            $sent_to_notification_details = $api->get_notification_details(10);
                            $sent_to_notification_title = $sent_to_notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                            $sent_to_notification_message = $sent_to_notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                            $sent_to_notification_message = str_replace('{name}', $employee_file_as, $notification_message);

                            $notification_recipient_details = $api->get_notification_recipient_details(10);

                            for($i = 0; $i < count($notification_recipient_details); $i++) {
                                $recipient = $notification_recipient_details[$i]['EMPLOYEE_ID'];
                    
                                $send_notification = $api->send_notification(10, $employee_id, $recipient, $sent_to_notification_title, $sent_to_notification_message, $username);

                                if(!$send_notification){
                                    $error = $send_notification;
                                }
                            }
                        }
                        else{
                            $error = $send_notification;
                        }
                    }
                    else{
                        $error = $update_attendance_adjustment_status;
                    }
                }
                else{
                    $error = 'Not Found';
                }
            }

            if(empty($error)){
                echo 'Recommended';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Print transactions
    # -------------------------------------------------------------

    # Print multiple payslip
    else if($transaction == 'print multiple payslip'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['payslip_id']) && !empty($_POST['payslip_id'])){
            $username = $_POST['username'];
            $payslip_ids = implode(',', $_POST['payslip_id']);;
            $payslip_encrypted = $api->encrypt_data($payslip_ids);
            
            echo 'payslip-multiple-print.php?id=' . $payslip_encrypted;
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Notification transactions
    # -------------------------------------------------------------

    # Partial notification status
    else if($transaction == 'partial notification status'){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            $username = $_POST['username'];
            $employee_details = $api->get_employee_details('', $username);
            $employee_id = $employee_details[0]['EMPLOYEE_ID'];
           
            $update_notification_status = $api->update_notification_status($employee_id, '', 2);

            if($update_notification_status){
                echo 'Updated';
            }
            else{
                echo $update_notification_status;
            }
        }
    }
    # -------------------------------------------------------------

    # Read notification status
    else if($transaction == 'read notification status'){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            $username = $_POST['username'];
            $notification_id = $_POST['notification_id'];
            $employee_details = $api->get_employee_details('', $username);
            $employee_id = $employee_details[0]['EMPLOYEE_ID'];
           
            $update_notification_status = $api->update_notification_status($employee_id, $notification_id, 1);

            if($update_notification_status){
                echo 'Updated';
            }
            else{
                echo $update_notification_status;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Send transactions
    # -------------------------------------------------------------

    # Send test email
    else if($transaction == 'send test email'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['email']) && !empty($_POST['email'])){
            $username = $_POST['username'];
            $email = $_POST['email'];

            $send_email_notification = $api->send_email_notification('test email', $email, 'Test Email', 'This is a test email.', '', 0, '');

            if($send_email_notification){
                echo 'Sent';
            }
            else{
                echo $send_email_notification;
            }
        }
    }
    # -------------------------------------------------------------

    # Send payslip
    else if($transaction == 'send payslip'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['payslip_id']) && !empty($_POST['payslip_id'])){
            $username = $_POST['username'];
            $payslip_id = $_POST['payslip_id'];

            $payslip_details = $api->get_payslip_details($payslip_id);
            $pay_run_id = $payslip_details[0]['PAY_RUN_ID'];
            $employee_id = $payslip_details[0]['EMPLOYEE_ID'];

            # Company details
            $company_setting_details = $api->get_company_setting_details(1);
            $company_name = $company_setting_details[0]['COMPANY_NAME'];
            $company_address = $company_setting_details[0]['ADDRESS'];
            $company_province_id = $company_setting_details[0]['PROVINCE_ID'];
            $company_city_id = $company_setting_details[0]['CITY_ID'];

            # Company province details
            $company_province_details = $api->get_province_details($company_province_id);
            $company_province = $company_province_details[0]['PROVINCE'];

            # Company city details
            $city_details = $api->get_city_details($company_city_id, $company_province_id);
            $company_city = $city_details[0]['CITY'];

            # Employee details
            $employee_details = $api->get_employee_details($employee_id, '');
            $file_as = $employee_details[0]['FILE_AS'];
            $email = $employee_details[0]['EMAIL'];
            $designation = $employee_details[0]['DESIGNATION'];
            $department = $employee_details[0]['DEPARTMENT'];
            $validate_email = $api->validate_email($email);

            # Designation details
            $designation_details = $api->get_designation_details($designation);
            $designation_name = $designation_details[0]['DESIGNATION'];
            $system_date = date('Y-m-d');

            # Department details
            $department_details = $api->get_department_details($department);
            $department_name = $department_details[0]['DEPARTMENT'];

            # Payrun details
            $pay_run_details = $api->get_pay_run_details($pay_run_id);
            $coverage_start_date = $api->check_date('empty', $pay_run_details[0]['START_DATE'], '', 'F d, Y', '', '', '');
            $coverage_end_date = $api->check_date('empty', $pay_run_details[0]['END_DATE'], '', 'F d, Y', '', '', '');

            $payslip_employee_details = '<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top"><b>'. $file_as .'</b>
                                                <br style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin-top: 0;" />'. $designation_name .'
                                                <br style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin-top: 0;" />'. $department_name .'
                                                <br style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin-top: 0;" />Employee ID: '. $employee_id .'
                                            </td>';

            $pay_run_details = '<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0; text-align: right;" valign="top"><b>Coverage Date:</b>
                                                    <br style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin-top: 0;" />'. $coverage_start_date .' - '. $coverage_end_date .'
                                                    <br/>
                                                </td>';

            $payslip_earnings_table = $api->generate_email_payslip_earnings_table($payslip_id, $employee_id);
            $payslip_deduction_table = $api->generate_email_payslip_deduction_table($payslip_id, $employee_id);

            $message = file_get_contents('email_template/basic-payslip.html');
            $message = str_replace('@company_name', $company_name, $message);
            $message = str_replace('@company_address', $company_address . ', ' . $company_city . ', ' . $company_province, $message);
            $message = str_replace('@generated_date', date('F d, Y'), $message);
            $message = str_replace('@employee_details', $payslip_employee_details, $message);
            $message = str_replace('@pay_run_details', $pay_run_details, $message);
            $message = str_replace('@earnings_table', $payslip_earnings_table, $message);
            $message = str_replace('@deduction_table', $payslip_deduction_table, $message);

            if(empty($email) || !$validate_email){
                if(empty($email)){
                    echo 'Email';
                }
                else{
                    echo 'Invalid Email';
                }
            }
            else{
                $check_payslip_exist = $api->check_payslip_exist($payslip_id);

                if($check_payslip_exist > 0){
                    $send_email_notification = $api->send_email_notification('send payslip', $email, $file_as . ' Payslip ('.  $coverage_start_date . ' - ' . $coverage_end_date .') ', $message, '', true, '');

                    if($send_email_notification){
                        echo 'Sent';
                    }
                    else{
                        echo $send_email_notification;
                    }
                }
                else{
                    echo 'Not Found';
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Send multiple payslip
    else if($transaction == 'send multiple payslip'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['payslip_id']) && !empty($_POST['payslip_id'])){
            $error = '';
            $username = $_POST['username'];
            $payslip_ids = $_POST['payslip_id'];

            foreach($payslip_ids as $payslip_id){
                $payslip_details = $api->get_payslip_details($payslip_id);
                $pay_run_id = $payslip_details[0]['PAY_RUN_ID'];
                $employee_id = $payslip_details[0]['EMPLOYEE_ID'];
    
                # Company details
                $company_setting_details = $api->get_company_setting_details(1);
                $company_name = $company_setting_details[0]['COMPANY_NAME'];
                $company_address = $company_setting_details[0]['ADDRESS'];
                $company_province_id = $company_setting_details[0]['PROVINCE_ID'];
                $company_city_id = $company_setting_details[0]['CITY_ID'];
    
                # Company province details
                $company_province_details = $api->get_province_details($company_province_id);
                $company_province = $company_province_details[0]['PROVINCE'];
    
                # Company city details
                $city_details = $api->get_city_details($company_city_id, $company_province_id);
                $company_city = $city_details[0]['CITY'];
    
                # Employee details
                $employee_details = $api->get_employee_details($employee_id, '');
                $file_as = $employee_details[0]['FILE_AS'];
                $email = $employee_details[0]['EMAIL'];
                $designation = $employee_details[0]['DESIGNATION'];
                $department = $employee_details[0]['DEPARTMENT'];
                $validate_email = $api->validate_email($email);
    
                # Designation details
                $designation_details = $api->get_designation_details($designation);
                $designation_name = $designation_details[0]['DESIGNATION'];
                $system_date = date('Y-m-d');
    
                # Department details
                $department_details = $api->get_department_details($department);
                $department_name = $department_details[0]['DEPARTMENT'];
    
                # Payrun details
                $pay_run_details = $api->get_pay_run_details($pay_run_id);
                $coverage_start_date = $api->check_date('empty', $pay_run_details[0]['START_DATE'], '', 'F d, Y', '', '', '');
                $coverage_end_date = $api->check_date('empty', $pay_run_details[0]['END_DATE'], '', 'F d, Y', '', '', '');
    
                $payslip_employee_details = '<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top"><b>'. $file_as .'</b>
                                                    <br style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin-top: 0;" />'. $designation_name .'
                                                    <br style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin-top: 0;" />'. $department_name .'
                                                    <br style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin-top: 0;" />Employee ID: '. $employee_id .'
                                                </td>';
    
                $pay_run_details = '<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0; text-align: right;" valign="top"><b>Coverage Date:</b>
                                                        <br style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin-top: 0;" />'. $coverage_start_date .' - '. $coverage_end_date .'
                                                        <br/>
                                                    </td>';
    
                $payslip_earnings_table = $api->generate_email_payslip_earnings_table($payslip_id, $employee_id);
                $payslip_deduction_table = $api->generate_email_payslip_deduction_table($payslip_id, $employee_id);
    
                $message = file_get_contents('email_template/basic-payslip.html');
                $message = str_replace('@company_name', $company_name, $message);
                $message = str_replace('@company_address', $company_address . ', ' . $company_city . ', ' . $company_province, $message);
                $message = str_replace('@generated_date', date('F d, Y'), $message);
                $message = str_replace('@employee_details', $payslip_employee_details, $message);
                $message = str_replace('@pay_run_details', $pay_run_details, $message);
                $message = str_replace('@earnings_table', $payslip_earnings_table, $message);
                $message = str_replace('@deduction_table', $payslip_deduction_table, $message);
    
                if(!empty($email) && $validate_email){
                    $check_payslip_exist = $api->check_payslip_exist($payslip_id);
    
                    if($check_payslip_exist > 0){
                        $send_email_notification = $api->send_email_notification('send payslip', $email, $file_as . ' Payslip ('.  $coverage_start_date . ' - ' . $coverage_end_date .') ', $message, '', true, '');
    
                        if(!$send_email_notification){
                            $error = $send_email_notification;
                        }
                    }
                    else{
                        $error = 'Not Found';
                    }
                }
            }

            if(empty($error)){
                echo 'Sent';
            }
            else{
                echo $error;
            }
        }
    }
    # -------------------------------------------------------------

    # Send pay run payslip
    else if($transaction == 'send pay run payslip'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['pay_run_id']) && !empty($_POST['pay_run_id']) && isset($_POST['employee_id']) && !empty($_POST['employee_id'])){
            if ($api->databaseConnection()) {
                $error = '';
                $username = $_POST['username'];
                $pay_run_id = $_POST['pay_run_id'];
                $payees = explode(',', $_POST['payee']);
    
                foreach($payees as $employee_id){
                    $sql = $api->db_connection->prepare('SELECT PAYSLIP_ID FROM tblpayslip WHERE EMPLOYEE_ID = :employee_id AND PAY_RUN_ID = :pay_run_id');
                    $sql->bindValue(':employee_id', $employee_id);
                    $sql->bindValue(':pay_run_id', $pay_run_id);
                    
                    if($sql->execute()){
                        while($row = $sql->fetch()){
                            $payslip_id = $row['PAYSLIP_ID'];
        
                            $payslip_details = $api->get_payslip_details($payslip_id);
                            $pay_run_id = $payslip_details[0]['PAY_RUN_ID'];
        
                            # Company details
                            $company_setting_details = $api->get_company_setting_details(1);
                            $company_name = $company_setting_details[0]['COMPANY_NAME'];
                            $company_address = $company_setting_details[0]['ADDRESS'];
                            $company_province_id = $company_setting_details[0]['PROVINCE_ID'];
                            $company_city_id = $company_setting_details[0]['CITY_ID'];
        
                            # Company province details
                            $company_province_details = $api->get_province_details($company_province_id);
                            $company_province = $company_province_details[0]['PROVINCE'];
        
                            # Company city details
                            $city_details = $api->get_city_details($company_city_id, $company_province_id);
                            $company_city = $city_details[0]['CITY'];
        
                            # Employee details
                            $employee_details = $api->get_employee_details($employee_id, '');
                            $file_as = $employee_details[0]['FILE_AS'];
                            $email = $employee_details[0]['EMAIL'];
                            $designation = $employee_details[0]['DESIGNATION'];
                            $department = $employee_details[0]['DEPARTMENT'];
                            $validate_email = $api->validate_email($email);
        
                            # Designation details
                            $designation_details = $api->get_designation_details($designation);
                            $designation_name = $designation_details[0]['DESIGNATION'];
                            $system_date = date('Y-m-d');
        
                            # Department details
                            $department_details = $api->get_department_details($department);
                            $department_name = $department_details[0]['DEPARTMENT'];
        
                            # Payrun details
                            $pay_run_details = $api->get_pay_run_details($pay_run_id);
                            $coverage_start_date = $api->check_date('empty', $pay_run_details[0]['START_DATE'], '', 'F d, Y', '', '', '');
                            $coverage_end_date = $api->check_date('empty', $pay_run_details[0]['END_DATE'], '', 'F d, Y', '', '', '');
        
                            $payslip_employee_details = '<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top"><b>'. $file_as .'</b>
                                                                <br style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin-top: 0;" />'. $designation_name .'
                                                                <br style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin-top: 0;" />'. $department_name .'
                                                                <br style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin-top: 0;" />Employee ID: '. $employee_id .'
                                                            </td>';
        
                            $pay_run_details = '<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0; text-align: right;" valign="top"><b>Coverage Date:</b>
                                                                    <br style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin-top: 0;" />'. $coverage_start_date .' - '. $coverage_end_date .'
                                                                    <br/>
                                                                </td>';
        
                            $payslip_earnings_table = $api->generate_email_payslip_earnings_table($payslip_id, $employee_id);
                            $payslip_deduction_table = $api->generate_email_payslip_deduction_table($payslip_id, $employee_id);
        
                            $message = file_get_contents('email_template/basic-payslip.html');
                            $message = str_replace('@company_name', $company_name, $message);
                            $message = str_replace('@company_address', $company_address . ', ' . $company_city . ', ' . $company_province, $message);
                            $message = str_replace('@generated_date', date('F d, Y'), $message);
                            $message = str_replace('@employee_details', $payslip_employee_details, $message);
                            $message = str_replace('@pay_run_details', $pay_run_details, $message);
                            $message = str_replace('@earnings_table', $payslip_earnings_table, $message);
                            $message = str_replace('@deduction_table', $payslip_deduction_table, $message);
        
                            if(empty($email) || !$validate_email){
                                if(empty($email)){
                                    $error = 'Email';
                                }
                                else{
                                    $error = 'Invalid Email';
                                }
                            }
                            else{
                                $check_payslip_exist = $api->check_payslip_exist($payslip_id);
        
                                if($check_payslip_exist > 0){
                                    $send_email_notification = $api->send_email_notification('send payslip', $email, $file_as . ' Payslip ('.  $coverage_start_date . ' - ' . $coverage_end_date .') ', $message, '', true, '');
        
                                    if(!$send_email_notification){
                                        $error = $send_email_notification;
                                    }
                                }
                                else{
                                    $error = 'Not Found';
                                }
                            }                    
                        }
                    }
                    else{
                        $error = $sql->errorInfo()[2];
                    }   
                }
    
                if(empty($error)){
                    echo 'Sent';
                }
                else{
                    echo $error;
                }
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Order transactions
    # -------------------------------------------------------------

    # Order up recruitment pipeline stage
    else if($transaction == 'order up recruitment pipeline stage'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['recruitment_pipeline_stage_id']) && !empty($_POST['recruitment_pipeline_stage_id']) && isset($_POST['stage_order']) && !empty($_POST['stage_order'])){
            $username = $_POST['username'];
            $recruitment_pipeline_stage_id = $_POST['recruitment_pipeline_stage_id'];
            $stage_order = $_POST['stage_order'];

            $recruitment_pipeline_stage_details = $api->get_recruitment_pipeline_stage_details($recruitment_pipeline_stage_id);
            $recruitment_pipeline_id = $recruitment_pipeline_stage_details[0]['RECRUITMENT_PIPELINE_ID'];

            $check_recruitment_pipeline_stage_exist = $api->check_recruitment_pipeline_stage_exist($recruitment_pipeline_stage_id);

            if($check_recruitment_pipeline_stage_exist > 0){
                $subsquent_recruitment_pipeline_stage_id = $api->get_recruitment_pipeline_stage_id_from_stage_order($recruitment_pipeline_id, ($stage_order - 1));

                $update_recruitment_pipeline_stage_order = $api->update_recruitment_pipeline_stage_order($subsquent_recruitment_pipeline_stage_id, $stage_order, $username);
    
                if($update_recruitment_pipeline_stage_order){
                    $update_recruitment_pipeline_stage_order = $api->update_recruitment_pipeline_stage_order($recruitment_pipeline_stage_id, ($stage_order - 1), $username);
    
                    if($update_recruitment_pipeline_stage_order){
                        echo 'Order Up';
                    }
                    else{
                        echo $update_recruitment_pipeline_stage_order;
                    }
                }
                else{
                    echo $update_recruitment_pipeline_stage_order;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # Order down recruitment pipeline stage
    else if($transaction == 'order down recruitment pipeline stage'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['recruitment_pipeline_stage_id']) && !empty($_POST['recruitment_pipeline_stage_id']) && isset($_POST['stage_order']) && !empty($_POST['stage_order'])){
            $username = $_POST['username'];
            $recruitment_pipeline_stage_id = $_POST['recruitment_pipeline_stage_id'];
            $stage_order = $_POST['stage_order'];

            $recruitment_pipeline_stage_details = $api->get_recruitment_pipeline_stage_details($recruitment_pipeline_stage_id);
            $recruitment_pipeline_id = $recruitment_pipeline_stage_details[0]['RECRUITMENT_PIPELINE_ID'];

            $check_recruitment_pipeline_stage_exist = $api->check_recruitment_pipeline_stage_exist($recruitment_pipeline_stage_id);

            if($check_recruitment_pipeline_stage_exist > 0){
                $subsquent_recruitment_pipeline_stage_id = $api->get_recruitment_pipeline_stage_id_from_stage_order($recruitment_pipeline_id, ($stage_order + 1));

                $update_recruitment_pipeline_stage_order = $api->update_recruitment_pipeline_stage_order($subsquent_recruitment_pipeline_stage_id, $stage_order, $username);
    
                if($update_recruitment_pipeline_stage_order){
                    $update_recruitment_pipeline_stage_order = $api->update_recruitment_pipeline_stage_order($recruitment_pipeline_stage_id, ($stage_order + 1), $username);
    
                    if($update_recruitment_pipeline_stage_order){
                        echo 'Order Down';
                    }
                    else{
                        echo $update_recruitment_pipeline_stage_order;
                    }
                }
                else{
                    echo $update_recruitment_pipeline_stage_order;
                }
            }
            else{
                echo 'Not Found';
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Get details transactions
    # -------------------------------------------------------------

    # System parameter details
    else if($transaction == 'system parameter details'){
        if(isset($_POST['parameter_id']) && !empty($_POST['parameter_id'])){
            $parameter_id = $_POST['parameter_id'];
            $system_parameter_details = $api->get_system_parameter_details($parameter_id);

            $response[] = array(
                'PARAMETER_DESC' => $system_parameter_details[0]['PARAMETER_DESC'],
                'PARAMETER_EXTENSION' => $system_parameter_details[0]['PARAMETER_EXTENSION'],
                'PARAMETER_NUMBER' => $system_parameter_details[0]['PARAMETER_NUMBER']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Policy details
    else if($transaction == 'policy details'){
        if(isset($_POST['policy_id']) && !empty($_POST['policy_id'])){
            $policy_id = $_POST['policy_id'];
            $policy_details = $api->get_policy_details($policy_id);

            $response[] = array(
                'POLICY' => $policy_details[0]['POLICY'],
                'DESCRIPTION' => $policy_details[0]['DESCRIPTION']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Permission details
    else if($transaction == 'permission details'){
        if(isset($_POST['permission_id']) && !empty($_POST['permission_id'])){
            $permission_id = $_POST['permission_id'];
            $permission_details = $api->get_permission_details($permission_id);

            $response[] = array(
                'PERMISSION' => $permission_details[0]['PERMISSION']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Role details
    else if($transaction == 'role details'){
        if(isset($_POST['role_id']) && !empty($_POST['role_id'])){
            $role_id = $_POST['role_id'];
            $role_details = $api->get_role_details($role_id);

            $response[] = array(
                'ROLE' => $role_details[0]['ROLE'],
                'DESCRIPTION' => $role_details[0]['DESCRIPTION']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Role permission details
    else if($transaction == 'role permission details'){
        if(isset($_POST['role_id']) && !empty($_POST['role_id'])){
            $response = array();

            $role_id = $_POST['role_id'];
            $role_permission_details = $api->get_role_permission_details($role_id);

            for($i = 0; $i < count($role_permission_details); $i++) {
                array_push($response, $role_permission_details[$i]['PERMISSION_ID']);
            }

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # System code details
    else if($transaction == 'system code details'){
        if(isset($_POST['system_type']) && !empty($_POST['system_type']) && isset($_POST['system_code']) && !empty($_POST['system_code'])){
            $response = array();

            $system_type = $_POST['system_type'];
            $system_code = $_POST['system_code'];

            $system_code_details = $api->get_system_code_details($system_type, $system_code);

            $response[] = array(
                'DESCRIPTION' => $system_code_details[0]['DESCRIPTION']     
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # User interface settings details
    else if($transaction == 'user interface settings details'){
        $user_interface_details = $api->get_user_interface_settings_details(1);

        $response[] = array(
            'LOGIN_BG' => $api->check_image($user_interface_details[0]['LOGIN_BG'] ?? null, 'login bg'),
            'LOGO_LIGHT' => $api->check_image($user_interface_details[0]['LOGO_LIGHT'] ?? null, 'logo light'),
            'LOGO_DARK' => $api->check_image($user_interface_details[0]['LOGO_DARK'] ?? null, 'logo dark'),
            'LOGO_ICON_LIGHT' => $api->check_image($user_interface_details[0]['LOGO_ICON_LIGHT'] ?? null, 'logo icon light'),
            'LOGO_ICON_DARK' => $api->check_image($user_interface_details[0]['LOGO_ICON_DARK'] ?? null, 'logo icon dark'),
            'FAVICON' => $api->check_image($user_interface_details[0]['FAVICON'] ?? null, 'favicon')
        );

        echo json_encode($response);
    }
    # -------------------------------------------------------------

    # Email configuration details
    else if($transaction == 'email configuration details'){
        $email_configuration_details = $api->get_email_configuration_details(1);

        $response[] = array(
            'MAIL_HOST' => $email_configuration_details[0]['MAIL_HOST'],
            'PORT' => $email_configuration_details[0]['PORT'],
            'SMTP_AUTH' => $email_configuration_details[0]['SMTP_AUTH'],
            'SMTP_AUTO_TLS' => $email_configuration_details[0]['SMTP_AUTO_TLS'],
            'USERNAME' => $email_configuration_details[0]['USERNAME'],
            'MAIL_ENCRYPTION' => $email_configuration_details[0]['MAIL_ENCRYPTION'],
            'MAIL_FROM_NAME' => $email_configuration_details[0]['MAIL_FROM_NAME'],
            'MAIL_FROM_EMAIL' => $email_configuration_details[0]['MAIL_FROM_EMAIL']
        );

        echo json_encode($response);
    }
    # -------------------------------------------------------------

    # Notification type details
    else if($transaction == 'notification type details'){
        if(isset($_POST['notification_id']) && !empty($_POST['notification_id'])){
            $notification_id = $_POST['notification_id'];
            $notification_type_details = $api->get_notification_type_details($notification_id);

            $response[] = array(
                'NOTIFICATION' => $notification_type_details[0]['NOTIFICATION'],
                'DESCRIPTION' => $notification_type_details[0]['DESCRIPTION']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Notification details
    else if($transaction == 'notification details'){
        if(isset($_POST['notification_id']) && !empty($_POST['notification_id'])){
            $notification_id = $_POST['notification_id'];
            $notification_details = $api->get_notification_details($notification_id);
            $recipient = '';

            $notification_recipient_details = $api->get_notification_recipient_details($notification_id);

            for($i = 0; $i < count($notification_recipient_details); $i++) {
                $recipient .= $notification_recipient_details[$i]['EMPLOYEE_ID'];
    
                if($i != (count($notification_recipient_details) - 1)){
                    $recipient .= ',';
                }
            }

            $response[] = array(
                'NOTIFICATION_TITLE' => $notification_details[0]['NOTIFICATION_TITLE'],
                'NOTIFICATION_MESSAGE' => $notification_details[0]['NOTIFICATION_MESSAGE'],
                'SYSTEM_LINK' => $notification_details[0]['SYSTEM_LINK'],
                'WEB_LINK' => $notification_details[0]['WEB_LINK'],
                'RECIPIENT' => $recipient
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Application notification details
    else if($transaction == 'application notification details'){
        $response = array();
        $application_notification_details = $api->get_application_notification_details();

        for($i = 0; $i < count($application_notification_details); $i++) {
            $notification = $application_notification_details[$i]['NOTIFICATION_ID'] . '-' . $application_notification_details[$i]['NOTIFICATION'];
            array_push($response, $notification);
        }

        echo json_encode($response);
    }
    # -------------------------------------------------------------

    # Company setting details
    else if($transaction == 'company setting details'){
        $company_setting_details = $api->get_company_setting_details(1);

        $response[] = array(
            'COMPANY_NAME' => $company_setting_details[0]['COMPANY_NAME'],
            'EMAIL' => $company_setting_details[0]['EMAIL'],
            'TELEPHONE' => $company_setting_details[0]['TELEPHONE'],
            'PHONE' => $company_setting_details[0]['PHONE'],
            'WEBSITE' => $company_setting_details[0]['WEBSITE'],
            'ADDRESS' => $company_setting_details[0]['ADDRESS'],
            'PROVINCE_ID' => $company_setting_details[0]['PROVINCE_ID'],
            'CITY_ID' => $company_setting_details[0]['CITY_ID'],
            'COMPANY_LOGO' => $api->check_image($company_setting_details[0]['COMPANY_LOGO'] ?? null, 'company logo')
        );

        echo json_encode($response);
    }
    # -------------------------------------------------------------

    # Department details
    else if($transaction == 'department details'){
        if(isset($_POST['department_id']) && !empty($_POST['department_id'])){
            $department_id = $_POST['department_id'];
            $department_details = $api->get_department_details($department_id);

            $response[] = array(
                'DEPARTMENT' => $department_details[0]['DEPARTMENT'],
                'DESCRIPTION' => $department_details[0]['DESCRIPTION'],
                'DEPARTMENT_HEAD' => $department_details[0]['DEPARTMENT_HEAD'],
                'PARENT_DEPARTMENT' => $department_details[0]['PARENT_DEPARTMENT']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Designation details
    else if($transaction == 'designation details'){
        if(isset($_POST['designation_id']) && !empty($_POST['designation_id'])){
            $designation_id = $_POST['designation_id'];
            $designation_details = $api->get_designation_details($designation_id);

            $response[] = array(
                'DESIGNATION' => $designation_details[0]['DESIGNATION'],
                'DESCRIPTION' => $designation_details[0]['DESCRIPTION']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Branch details
    else if($transaction == 'branch details'){
        if(isset($_POST['branch_id']) && !empty($_POST['branch_id'])){
            $branch_id = $_POST['branch_id'];
            $branch_details = $api->get_branch_details($branch_id);

            $response[] = array(
                'BRANCH' => $branch_details[0]['BRANCH'],
                'EMAIL' => $branch_details[0]['EMAIL'],
                'PHONE' => $branch_details[0]['PHONE'],
                'TELEPHONE' => $branch_details[0]['TELEPHONE'],
                'ADDRESS' => $branch_details[0]['ADDRESS']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Upload setting details
    else if($transaction == 'upload setting details'){
        if(isset($_POST['upload_setting_id']) && !empty($_POST['upload_setting_id'])){
            $file_type = '';
            $upload_setting_id = $_POST['upload_setting_id'];
            $upload_setting_details = $api->get_upload_setting_details($upload_setting_id);
            $upload_file_type_details = $api->get_upload_file_type_details($upload_setting_id);

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details[$i]['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $response[] = array(
                'UPLOAD_SETTING' => $upload_setting_details[0]['UPLOAD_SETTING'],
                'DESCRIPTION' => $upload_setting_details[0]['DESCRIPTION'],
                'MAX_FILE_SIZE' => $upload_setting_details[0]['MAX_FILE_SIZE'],
                'FILE_TYPE' => $file_type
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------
    
    # Employment status details
    else if($transaction == 'employment status details'){
        if(isset($_POST['employment_status_id']) && !empty($_POST['employment_status_id'])){
            $employment_status_id = $_POST['employment_status_id'];
            $employment_status_details = $api->get_employment_status_details($employment_status_id);

            $response[] = array(
                'EMPLOYMENT_STATUS' => $employment_status_details[0]['EMPLOYMENT_STATUS'],
                'COLOR_VALUE' => $employment_status_details[0]['COLOR_VALUE'],
                'DESCRIPTION' => $employment_status_details[0]['DESCRIPTION']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Employee details
    else if($transaction == 'employee details'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id'])){
            $employee_id = $_POST['employee_id'];
            $employee_details = $api->get_employee_details($employee_id, '');

            $response[] = array(
                'ID_NUMBER' => $employee_details[0]['ID_NUMBER'],
                'JOIN_DATE' => $api->check_date('empty', $employee_details[0]['JOIN_DATE'], '', 'n/d/Y', '', '', ''),
                'PERMANENCY_DATE' => $api->check_date('empty', $employee_details[0]['PERMANENCY_DATE'], '', 'n/d/Y', '', '', ''),
                'EXIT_DATE' => $api->check_date('empty', $employee_details[0]['EXIT_DATE'], '', 'n/d/Y', '', '', ''),
                'EXIT_REASON' => $employee_details[0]['EXIT_REASON'],
                'FIRST_NAME' => $employee_details[0]['FIRST_NAME'],
                'MIDDLE_NAME' => $employee_details[0]['MIDDLE_NAME'],
                'LAST_NAME' => $employee_details[0]['LAST_NAME'],
                'SUFFIX' => $employee_details[0]['SUFFIX'],
                'BIRTHDAY' => $api->check_date('empty', $employee_details[0]['BIRTHDAY'], '', 'n/d/Y', '', '', ''),
                'EMAIL' => $employee_details[0]['EMAIL'],
                'PHONE' => $employee_details[0]['PHONE'],
                'TELEPHONE' => $employee_details[0]['TELEPHONE'],
                'EMPLOYMENT_STATUS' => $employee_details[0]['EMPLOYMENT_STATUS'],
                'DEPARTMENT' => $employee_details[0]['DEPARTMENT'],
                'DESIGNATION' => $employee_details[0]['DESIGNATION'],
                'BRANCH' => $employee_details[0]['BRANCH'],
                'GENDER' => $employee_details[0]['GENDER']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Emergency contact details
    else if($transaction == 'emergency contact details'){
        if(isset($_POST['contact_id']) && !empty($_POST['contact_id'])){
            $contact_id = $_POST['contact_id'];

            $emergency_contact_details = $api->get_emergency_contact_details($contact_id);

            $response[] = array(
                'NAME' => $emergency_contact_details[0]['NAME'],
                'RELATIONSHIP' => $emergency_contact_details[0]['RELATIONSHIP'],
                'EMAIL' => $emergency_contact_details[0]['EMAIL'],
                'PHONE' => $emergency_contact_details[0]['PHONE'],
                'TELEPHONE' => $emergency_contact_details[0]['TELEPHONE'],
                'ADDRESS' => $emergency_contact_details[0]['ADDRESS'],
                'CITY' => $emergency_contact_details[0]['CITY'],
                'PROVINCE' => $emergency_contact_details[0]['PROVINCE']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Employee address details
    else if($transaction == 'employee address details'){
        if(isset($_POST['address_id']) && !empty($_POST['address_id'])){
            $address_id = $_POST['address_id'];

            $employee_address_details = $api->get_employee_address_details($address_id);

            $response[] = array(
                'ADDRESS_TYPE' => $employee_address_details[0]['ADDRESS_TYPE'],
                'ADDRESS' => $employee_address_details[0]['ADDRESS'],
                'CITY' => $employee_address_details[0]['CITY'],
                'PROVINCE' => $employee_address_details[0]['PROVINCE']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Employee social details
    else if($transaction == 'employee social details'){
        if(isset($_POST['social_id']) && !empty($_POST['social_id'])){
            $social_id = $_POST['social_id'];

            $employee_social_details = $api->get_employee_social_details($social_id);

            $response[] = array(
                'SOCIAL_TYPE' => $employee_social_details[0]['SOCIAL_TYPE'],
                'LINK' => $employee_social_details[0]['LINK']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Work shift details
    else if($transaction == 'work shift details'){
        if(isset($_POST['work_shift_id']) && !empty($_POST['work_shift_id'])){
            $work_shift_id = $_POST['work_shift_id'];
            $work_shift_details = $api->get_work_shift_details($work_shift_id);

            $response[] = array(
                'WORK_SHIFT' => $work_shift_details[0]['WORK_SHIFT'],
                'WORK_SHIFT_TYPE' => $work_shift_details[0]['WORK_SHIFT_TYPE'],
                'DESCRIPTION' => $work_shift_details[0]['DESCRIPTION']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Work shift summary details
    else if($transaction == 'work shift summary details'){
        if(isset($_POST['work_shift_id']) && !empty($_POST['work_shift_id'])){
            $employee = '';
            $work_shift_id = $_POST['work_shift_id'];
            $work_shift_details = $api->get_work_shift_details($work_shift_id);
            $work_shift_schedule_details = $api->get_work_shift_schedule_details($work_shift_id);
            $work_shift_assignment_details = $api->get_work_shift_assignment_details($work_shift_id);

            $work_shift_type = $work_shift_details[0]['WORK_SHIFT_TYPE'];
            $work_shift_type_name = $api->get_system_code_details('WORKSHIFT', $work_shift_type)[0]['DESCRIPTION'] ?? null;

            $monday = 'Start Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['MONDAY_START_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $monday .= 'End Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['MONDAY_END_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $monday .= 'Lunch Start Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['MONDAY_LUNCH_START_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $monday .= 'Lunch End Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['MONDAY_LUNCH_END_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $monday .= 'Half Day Mark: ' . $api->check_date('summary', $work_shift_schedule_details[0]['MONDAY_HALF_DAY_MARK'] ?? null, '', 'h:i a', '', '', '') . '<br/>';

            $tuesday = 'Start Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['TUESDAY_START_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $tuesday .= 'End Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['TUESDAY_END_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $tuesday .= 'Lunch Start Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['TUESDAY_LUNCH_START_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $tuesday .= 'Lunch End Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['TUESDAY_LUNCH_END_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $tuesday .= 'Half Day Mark: ' . $api->check_date('summary', $work_shift_schedule_details[0]['TUESDAY_HALF_DAY_MARK'] ?? null, '', 'h:i a', '', '', '') . '<br/>';

            $wednesday = 'Start Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['WEDNESDAY_START_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $wednesday .= 'End Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['WEDNESDAY_END_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $wednesday .= 'Lunch Start Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['WEDNESDAY_LUNCH_START_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $wednesday .= 'Lunch End Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['WEDNESDAY_LUNCH_END_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $wednesday .= 'Half Day Mark: ' . $api->check_date('summary', $work_shift_schedule_details[0]['WEDNESDAY_HALF_DAY_MARK'] ?? null, '', 'h:i a', '', '', '') . '<br/>';

            $thursday = 'Start Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['THURSDAY_START_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $thursday .= 'End Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['THURSDAY_END_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $thursday .= 'Lunch Start Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['THURSDAY_LUNCH_START_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $thursday .= 'Lunch End Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['THURSDAY_LUNCH_END_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $thursday .= 'Half Day Mark: ' . $api->check_date('summary', $work_shift_schedule_details[0]['THURSDAY_HALF_DAY_MARK'] ?? null, '', 'h:i a', '', '', '') . '<br/>';

            $friday = 'Start Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['FRIDAY_START_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $friday .= 'End Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['FRIDAY_END_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $friday .= 'Lunch Start Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['FRIDAY_LUNCH_START_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $friday .= 'Lunch End Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['FRIDAY_LUNCH_END_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $friday .= 'Half Day Mark: ' . $api->check_date('summary', $work_shift_schedule_details[0]['FRIDAY_HALF_DAY_MARK'] ?? null, '', 'h:i a', '', '', '') . '<br/>';

            $saturday = 'Start Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['SATURDAY_START_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $saturday .= 'End Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['SATURDAY_END_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $saturday .= 'Lunch Start Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['SATURDAY_LUNCH_START_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $saturday .= 'Lunch End Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['SATURDAY_LUNCH_END_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $saturday .= 'Half Day Mark: ' . $api->check_date('summary', $work_shift_schedule_details[0]['SATURDAY_HALF_DAY_MARK'] ?? null, '', 'h:i a', '', '', '') . '<br/>';

            $sunday = 'Start Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['SUNDAY_START_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $sunday .= 'End Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['SUNDAY_END_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $sunday .= 'Lunch Start Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['SUNDAY_LUNCH_START_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $sunday .= 'Lunch End Time: ' . $api->check_date('summary', $work_shift_schedule_details[0]['SUNDAY_LUNCH_END_TIME'] ?? null, '', 'h:i a', '', '', '') . '<br/>';
            $sunday .= 'Half Day Mark: ' . $api->check_date('summary', $work_shift_schedule_details[0]['SUNDAY_HALF_DAY_MARK'] ?? null, '', 'h:i a', '', '', '') . '<br/>';

            for($i = 0; $i < count($work_shift_assignment_details); $i++) {
                $employee_id = $work_shift_assignment_details[$i]['EMPLOYEE_ID'];
                $employee_details = $api->get_employee_details($employee_id, '');
                $file_as = $employee_details[0]['FILE_AS'];

                if($i != (count($work_shift_assignment_details) - 1)){
                    $employee .= $file_as . '<br/>';
                }
                else{
                    $employee .= $file_as;
                }
            }

            $response[] = array(
                'WORK_SHIFT' => $work_shift_details[0]['WORK_SHIFT'],
                'WORK_SHIFT_TYPE' => $work_shift_type_name,
                'DESCRIPTION' => $work_shift_details[0]['DESCRIPTION'],
                'START_DATE' => $api->check_date('summary', $work_shift_schedule_details[0]['START_DATE'] ?? null, '', 'F d, Y', '', '', ''),
                'END_DATE' => $api->check_date('summary', $work_shift_schedule_details[0]['END_DATE'] ?? null, '', 'F d, Y', '', '', ''),
                'MONDAY' => $monday,
                'TUESDAY' => $tuesday,
                'WEDNESDAY' => $wednesday,
                'THURSDAY' => $thursday,
                'FRIDAY' => $friday,
                'SATURDAY' => $saturday,
                'SUNDAY' => $sunday,
                'EMPLOYEE' => $employee
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Work shift schedule details
    else if($transaction == 'work shift schedule details'){
        if(isset($_POST['work_shift_id']) && !empty($_POST['work_shift_id'])){
            $work_shift_id = $_POST['work_shift_id'];
            $work_shift_schedule_details = $api->get_work_shift_schedule_details($work_shift_id);

            $response[] = array(
                'START_DATE' => $api->check_date('empty', $work_shift_schedule_details[0]['START_DATE'] ?? null, '', 'n/d/Y', '', '', ''),
                'END_DATE' => $api->check_date('empty', $work_shift_schedule_details[0]['END_DATE'] ?? null, '', 'n/d/Y', '', '', ''),
                'MONDAY_START_TIME' => $work_shift_schedule_details[0]['MONDAY_START_TIME'] ?? null,
                'MONDAY_END_TIME' => $work_shift_schedule_details[0]['MONDAY_END_TIME'] ?? null,
                'MONDAY_LUNCH_START_TIME' => $work_shift_schedule_details[0]['MONDAY_LUNCH_START_TIME'] ?? null,
                'MONDAY_LUNCH_END_TIME' => $work_shift_schedule_details[0]['MONDAY_LUNCH_END_TIME'] ?? null,
                'MONDAY_HALF_DAY_MARK' => $work_shift_schedule_details[0]['MONDAY_HALF_DAY_MARK'] ?? null,
                'TUESDAY_START_TIME' => $work_shift_schedule_details[0]['TUESDAY_START_TIME'] ?? null,
                'TUESDAY_END_TIME' => $work_shift_schedule_details[0]['TUESDAY_END_TIME'] ?? null,
                'TUESDAY_LUNCH_START_TIME' => $work_shift_schedule_details[0]['TUESDAY_LUNCH_START_TIME'] ?? null,
                'TUESDAY_LUNCH_END_TIME' => $work_shift_schedule_details[0]['TUESDAY_LUNCH_END_TIME'] ?? null,
                'TUESDAY_HALF_DAY_MARK' => $work_shift_schedule_details[0]['TUESDAY_HALF_DAY_MARK'] ?? null,
                'WEDNESDAY_START_TIME' => $work_shift_schedule_details[0]['WEDNESDAY_START_TIME'] ?? null,
                'WEDNESDAY_END_TIME' => $work_shift_schedule_details[0]['WEDNESDAY_END_TIME'] ?? null,
                'WEDNESDAY_LUNCH_START_TIME' => $work_shift_schedule_details[0]['WEDNESDAY_LUNCH_START_TIME'] ?? null,
                'WEDNESDAY_LUNCH_END_TIME' => $work_shift_schedule_details[0]['WEDNESDAY_LUNCH_END_TIME'] ?? null,
                'WEDNESDAY_HALF_DAY_MARK' => $work_shift_schedule_details[0]['WEDNESDAY_HALF_DAY_MARK'] ?? null,
                'THURSDAY_START_TIME' => $work_shift_schedule_details[0]['THURSDAY_START_TIME'] ?? null,
                'THURSDAY_END_TIME' => $work_shift_schedule_details[0]['THURSDAY_END_TIME'] ?? null,
                'THURSDAY_LUNCH_START_TIME' => $work_shift_schedule_details[0]['THURSDAY_LUNCH_START_TIME'] ?? null,
                'THURSDAY_LUNCH_END_TIME' => $work_shift_schedule_details[0]['THURSDAY_LUNCH_END_TIME'] ?? null,
                'THURSDAY_HALF_DAY_MARK' => $work_shift_schedule_details[0]['THURSDAY_HALF_DAY_MARK'] ?? null,
                'FRIDAY_START_TIME' => $work_shift_schedule_details[0]['FRIDAY_START_TIME'] ?? null,
                'FRIDAY_END_TIME' => $work_shift_schedule_details[0]['FRIDAY_END_TIME'] ?? null,
                'FRIDAY_LUNCH_START_TIME' => $work_shift_schedule_details[0]['FRIDAY_LUNCH_START_TIME'] ?? null,
                'FRIDAY_LUNCH_END_TIME' => $work_shift_schedule_details[0]['FRIDAY_LUNCH_END_TIME'] ?? null,
                'FRIDAY_HALF_DAY_MARK' => $work_shift_schedule_details[0]['FRIDAY_HALF_DAY_MARK'] ?? null,
                'SATURDAY_START_TIME' => $work_shift_schedule_details[0]['SATURDAY_START_TIME'] ?? null,
                'SATURDAY_END_TIME' => $work_shift_schedule_details[0]['SATURDAY_END_TIME'] ?? null,
                'SATURDAY_LUNCH_START_TIME' => $work_shift_schedule_details[0]['SATURDAY_LUNCH_START_TIME'] ?? null,
                'SATURDAY_LUNCH_END_TIME' => $work_shift_schedule_details[0]['SATURDAY_LUNCH_END_TIME'] ?? null,
                'SATURDAY_HALF_DAY_MARK' => $work_shift_schedule_details[0]['SATURDAY_HALF_DAY_MARK'] ?? null,
                'SUNDAY_START_TIME' => $work_shift_schedule_details[0]['SUNDAY_START_TIME'] ?? null,
                'SUNDAY_END_TIME' => $work_shift_schedule_details[0]['SUNDAY_END_TIME'] ?? null,
                'SUNDAY_LUNCH_START_TIME' => $work_shift_schedule_details[0]['SUNDAY_LUNCH_START_TIME'] ?? null,
                'SUNDAY_LUNCH_END_TIME' => $work_shift_schedule_details[0]['SUNDAY_LUNCH_END_TIME'] ?? null,
                'SUNDAY_HALF_DAY_MARK' => $work_shift_schedule_details[0]['SUNDAY_HALF_DAY_MARK'] ?? null
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Work shift assignment details
    else if($transaction == 'work shift assignment details'){
        if(isset($_POST['work_shift_id']) && !empty($_POST['work_shift_id'])){
            $employee = '';
            $work_shift_id = $_POST['work_shift_id'];
            $work_shift_assignment_details = $api->get_work_shift_assignment_details($work_shift_id);

            for($i = 0; $i < count($work_shift_assignment_details); $i++) {
                $employee .= $work_shift_assignment_details[$i]['EMPLOYEE_ID'];

                if($i != (count($work_shift_assignment_details) - 1)){
                    $employee .= ',';
                }
            }

            $response[] = array(
                'EMPLOYEE_ID' => $employee
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Employee attendance details
    else if($transaction == 'employee attendance details'){
        if(isset($_POST['attendance_id']) && !empty($_POST['attendance_id'])){
            $attendance_id = $_POST['attendance_id'];

            $get_employee_attendance_details = $api->get_employee_attendance_details($attendance_id);

            $response[] = array(
                'TIME_IN_DATE' => $api->check_date('empty', $get_employee_attendance_details[0]['TIME_IN_DATE'], '', 'n/d/Y', '', '', ''),
                'TIME_IN' => $get_employee_attendance_details[0]['TIME_IN'],
                'TIME_OUT_DATE' => $api->check_date('empty', $get_employee_attendance_details[0]['TIME_OUT_DATE'], '', 'n/d/Y', '', '', ''),
                'TIME_OUT' => $get_employee_attendance_details[0]['TIME_OUT'],
                'REMARKS' => $get_employee_attendance_details[0]['REMARKS']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Leave type details
    else if($transaction == 'leave type details'){
        if(isset($_POST['leave_type_id']) && !empty($_POST['leave_type_id'])){
            $leave_type_id = $_POST['leave_type_id'];
            $leave_type_details = $api->get_leave_type_details($leave_type_id);

            $response[] = array(
                'LEAVE_NAME' => $leave_type_details[0]['LEAVE_NAME'],
                'DESCRIPTION' => $leave_type_details[0]['DESCRIPTION'],
                'NO_LEAVES' => $leave_type_details[0]['NO_LEAVES'],
                'PAID_STATUS' => $leave_type_details[0]['PAID_STATUS']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Leave entitlement details
    else if($transaction == 'leave entitlement details'){
        if(isset($_POST['leave_entitlement_id']) && !empty($_POST['leave_entitlement_id'])){
            $leave_entitlement_id = $_POST['leave_entitlement_id'];
            $get_leave_entitlement_details = $api->get_leave_entitlement_details($leave_entitlement_id);

            $response[] = array(
                'EMPLOYEE_ID' => $get_leave_entitlement_details[0]['EMPLOYEE_ID'],
                'LEAVE_TYPE' => $get_leave_entitlement_details[0]['LEAVE_TYPE'],
                'NO_LEAVES' => $get_leave_entitlement_details[0]['NO_LEAVES'],
                'START_DATE' => $api->check_date('empty', $get_leave_entitlement_details[0]['START_DATE'] ?? null, '', 'n/d/Y', '', '', ''),
                'END_DATE' => $api->check_date('empty', $get_leave_entitlement_details[0]['END_DATE'] ?? null, '', 'n/d/Y', '', '', '')
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Leave details
    else if($transaction == 'leave details'){
        if(isset($_POST['leave_id']) && !empty($_POST['leave_id'])){
            $system_date = date('Y-m-d');
            $leave_id = $_POST['leave_id'];
            $leave_details = $api->get_leave_details($leave_id);
            $employee_id = $leave_details[0]['EMPLOYEE_ID'];
            $decision_by = $leave_details[0]['DECISION_BY'];
            $leave_type = $leave_details[0]['LEAVE_TYPE'];
            $leave_status = $leave_details[0]['LEAVE_STATUS'];
            $leave_reason = $leave_details[0]['LEAVE_REASON'];
            $decision_remarks = $leave_details[0]['DECISION_REMARKS'];
            $leave_date = $api->check_date('empty', $leave_details[0]['LEAVE_DATE'] ?? null, '', 'F d, Y', '', '', '');
            $decision_date = $api->check_date('empty', $leave_details[0]['DECISION_DATE'] ?? null, '', 'F d, Y', '', '', '');
            $start_time = $api->check_date('empty', $leave_details[0]['START_TIME'] ?? null, '', 'h:i a', '', '', '');
            $end_time = $api->check_date('empty', $leave_details[0]['END_TIME'] ?? null, '', 'h:i a', '', '', '');
            $decision_time = $api->check_date('empty', $leave_details[0]['DECISION_TIME'] ?? null, '', 'h:i a', '', '', '');

            $employee_details = $api->get_employee_details($employee_id, '');
            $employee_file_as = $employee_details[0]['FILE_AS'];

            if(!empty($decision_by)){
                $decision_by_details = $api->get_employee_details('', $decision_by);
                $decision_by_file_as = $decision_by_details[0]['FILE_AS'] ?? $decision_by;
            }
            else{
                $decision_by_file_as = '';
            }

            $leave_type_details = $api->get_leave_type_details($leave_type);
            $leave_name = $leave_type_details[0]['LEAVE_NAME'];

            $leave_status_name = $api->get_leave_status($leave_status, $system_date, $leave_date)[0]['STATUS'];

            $response[] = array(
                'EMPLOYEE' => $employee_file_as,
                'LEAVE_TYPE' => $leave_name,
                'LEAVE_DATE' => $leave_date,
                'LEAVE_TIME' => $start_time . ' - ' . $end_time,
                'LEAVE_REASON' => $leave_reason,
                'LEAVE_STATUS' => $leave_status_name,
                'DECISION_BY' => $decision_by_file_as,
                'DECISION_REMARKS' => $decision_remarks,
                'DECISION_DATE' => $decision_date,
                'DECISION_TIME' => $decision_time,
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Employee file details
    else if($transaction == 'employee file details'){
        if(isset($_POST['file_id']) && !empty($_POST['file_id'])){
            $file_id = $_POST['file_id'];
            $get_employee_file_details = $api->get_employee_file_details($file_id);

            $response[] = array(
                'EMPLOYEE_ID' => $get_employee_file_details[0]['EMPLOYEE_ID'],
                'FILE_NAME' => $get_employee_file_details[0]['FILE_NAME'],
                'FILE_CATEGORY' => $get_employee_file_details[0]['FILE_CATEGORY'],
                'REMARKS' => $get_employee_file_details[0]['REMARKS'],
                'FILE_DATE' => $api->check_date('empty', $get_employee_file_details[0]['FILE_DATE'], '', 'n/d/Y', '', '', '')
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Employee file details
    else if($transaction == 'employee file summary details'){
        if(isset($_POST['file_id']) && !empty($_POST['file_id'])){
            $file_id = $_POST['file_id'];
            $get_employee_file_details = $api->get_employee_file_details($file_id);

            $employee_id = $get_employee_file_details[0]['EMPLOYEE_ID'];
            $file_name = $get_employee_file_details[0]['FILE_NAME'];
            $file_category = $get_employee_file_details[0]['FILE_CATEGORY'];
            $file_date = $api->check_date('empty', $get_employee_file_details[0]['FILE_DATE'], '', 'F d, Y', '', '', '');
            $upload_date = $api->check_date('empty', $get_employee_file_details[0]['UPLOAD_DATE'], '', 'F d, Y', '', '', '');
            $upload_time = $api->check_date('empty', $get_employee_file_details[0]['UPLOAD_TIME'], '', 'h:i:s a', '', '', '');
            $file_path = '<a href="'. $get_employee_file_details[0]['FILE_PATH'] .'" target="_blank">View File</a>';
            $upload_by = $get_employee_file_details[0]['UPLOAD_BY'];

            $employee_details = $api->get_employee_details($employee_id, '');
            $employee_file_as = $employee_details[0]['FILE_AS'];

            $upload_by_details = $api->get_employee_details('', $upload_by);
            $upload_by_name = $upload_by_details[0]['FILE_AS'] ?? $upload_by;

            $system_code_details = $api->get_system_code_details('FILECATEGORY', $file_category);
            $file_category_name = $system_code_details[0]['DESCRIPTION'];

            $response[] = array(
                'EMPLOYEE_ID' => $employee_file_as,
                'FILE_NAME' => $file_name,
                'FILE_CATEGORY' => $file_category_name,
                'FILE_PATH' => $file_path,
                'FILE_DATE' => $file_date,
                'UPLOAD_DATE' => $upload_date ?? '--',
                'UPLOAD_TIME' => $upload_time ?? '--',
                'UPLOAD_BY' => $upload_by_name,
                'REMARKS' => $get_employee_file_details[0]['REMARKS'],
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # User account details
    else if($transaction == 'user account details'){
        if(isset($_POST['user_code']) && !empty($_POST['user_code'])){
            $roles = '';
            $user_code = $_POST['user_code'];
            $role_user_details = $api->get_role_user_details('', $user_code);

            for($i = 0; $i < count($role_user_details); $i++) {
                $roles .= $role_user_details[$i]['ROLE_ID'];

                if($i != (count($role_user_details) - 1)){
                    $roles .= ',';
                }
            }

            $response[] = array(
                'ROLES' => $roles
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # View user account details
    else if($transaction == 'view user account details'){
        if(isset($_POST['user_code']) && !empty($_POST['user_code'])){
            $roles = '';
            $user_code = $_POST['user_code'];
            
            $user_account_details = $api->get_user_account_details($user_code);
            $role_user_details = $api->get_role_user_details('', $user_code);

            for($i = 0; $i < count($role_user_details); $i++) {
                $role_id = $role_user_details[$i]['ROLE_ID'];
                $role_details = $api->get_role_details($role_id);
                $roles .= $role_details[0]['ROLE'];

                if($i != (count($role_user_details) - 1)){
                    $roles .= ', ';
                }
            }

            $employee_details = $api->get_employee_details('', $user_code);
            $employee_file_as = $employee_details[0]['FILE_AS'] ?? $user_code;

            $account_status = $api->get_user_account_status($user_account_details[0]['ACTIVE'])[0]['STATUS'];

            $response[] = array(
                'FILE_AS' => $employee_file_as,
                'ACTIVE' => $account_status,
                'PASSWORD_EXPIRY_DATE' => $api->check_date('empty', $user_account_details[0]['PASSWORD_EXPIRY_DATE'], '', 'F d, Y', '', '', ''),
                'FAILED_LOGIN' => $user_account_details[0]['FAILED_LOGIN'],
                'LAST_FAILED_LOGIN' => $api->check_date('empty', $user_account_details[0]['LAST_FAILED_LOGIN'], '', 'F d, Y', '', '', ''),
                'ROLES' => $roles
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Holiday details
    else if($transaction == 'holiday details'){
        if(isset($_POST['holiday_id']) && !empty($_POST['holiday_id'])){
            $branch = '';
            $holiday_id = $_POST['holiday_id'];
            $holiday_details = $api->get_holiday_details($holiday_id);
            $holiday_branch_details = $api->get_holiday_branch_details($holiday_id);

            for($i = 0; $i < count($holiday_branch_details); $i++) {
                $branch .= $holiday_branch_details[$i]['BRANCH_ID'];

                if($i != (count($holiday_branch_details) - 1)){
                    $branch .= ',';
                }
            }

            $response[] = array(
                'HOLIDAY' => $holiday_details[0]['HOLIDAY'],
                'HOLIDAY_DATE' => $api->check_date('empty', $holiday_details[0]['HOLIDAY_DATE'], '', 'n/d/Y', '', '', ''),
                'HOLIDAY_TYPE' => $holiday_details[0]['HOLIDAY_TYPE'],
                'BRANCH' => $branch
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Attendance setting details
    else if($transaction == 'attendance setting details'){
        $creation = '';
        $adjustment = '';
        $attendance_setting_details = $api->get_attendance_setting_details(1);
        $attendance_creation_exception_details = $api->get_attendance_creation_exception_details();
        $attendance_adjustment_exception_details = $api->get_attendance_adjustment_exception_details();

        for($i = 0; $i < count($attendance_creation_exception_details); $i++) {
            $creation .= $attendance_creation_exception_details[$i]['EMPLOYEE_ID'];

            if($i != (count($attendance_creation_exception_details) - 1)){
                $creation .= ',';
            }
        }

        for($i = 0; $i < count($attendance_adjustment_exception_details); $i++) {
            $adjustment .= $attendance_adjustment_exception_details[$i]['EMPLOYEE_ID'];

            if($i != (count($attendance_adjustment_exception_details) - 1)){
                $adjustment .= ',';
            }
        }

        $response[] = array(
            'MAX_ATTENDANCE' => $attendance_setting_details[0]['MAX_ATTENDANCE'] ?? 1,
            'TIME_OUT_ALLOWANCE' => $attendance_setting_details[0]['TIME_OUT_ALLOWANCE'] ?? 1,
            'LATE_ALLOWANCE' => $attendance_setting_details[0]['LATE_ALLOWANCE'] ?? 1,
            'LATE_POLICY' => $attendance_setting_details[0]['LATE_POLICY'] ?? 0,
            'EARLY_LEAVING_POLICY' => $attendance_setting_details[0]['EARLY_LEAVING_POLICY'] ?? 0,
            'OVERTIME_POLICY' => $attendance_setting_details[0]['OVERTIME_POLICY'] ?? 0,
            'ATTENDANCE_CREATION_RECOMMENDATION' => $attendance_setting_details[0]['ATTENDANCE_CREATION_RECOMMENDATION'] ?? 0,
            'ATTENDANCE_ADJUSTMENT_RECOMMENDATION' => $attendance_setting_details[0]['ATTENDANCE_ADJUSTMENT_RECOMMENDATION'] ?? 0,
            'CREATION' => $creation,
            'ADJUSTMENT' => $adjustment
        );

        echo json_encode($response);
    }
    # -------------------------------------------------------------

    # Record attendance details
    else if($transaction == 'record attendance details'){
        if(isset($_POST['attendance_id']) && !empty($_POST['attendance_id'])){
            $attendance_id = $_POST['attendance_id'];

            $employee_attendance_details = $api->get_employee_attendance_details($attendance_id);

            $response[] = array(
                'TIME_IN_DATE' => $api->check_date('empty', $employee_attendance_details[0]['TIME_IN_DATE'], '', 'F d, Y', '', '', '') . ' ' . $api->check_date('empty', $employee_attendance_details[0]['TIME_IN'], '', 'h:i a', '', '', '')
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Employee attendance summary details
    else if($transaction == 'employee attendance summary details'){
        if(isset($_POST['attendance_id']) && !empty($_POST['attendance_id'])){
            $attendance_id = $_POST['attendance_id'];

            $employee_attendance_details = $api->get_employee_attendance_details($attendance_id);
            $employee_id = $employee_attendance_details[0]['EMPLOYEE_ID'];

            $time_in_date = $api->check_date('empty', $employee_attendance_details[0]['TIME_IN_DATE'] ?? null, '', 'F d, Y', '', '', '');
            $time_in = $api->check_date('empty', $employee_attendance_details[0]['TIME_IN'] ?? null, '', 'h:i a', '', '', '');
            $time_in_location = $employee_attendance_details[0]['TIME_IN_LOCATION'] ?? null;
            $time_in_ip_address = $employee_attendance_details[0]['TIME_IN_IP_ADDRESS'] ?? null;
            $time_in_by = $employee_attendance_details[0]['TIME_IN_BY'] ?? null;
            $time_in_note = $employee_attendance_details[0]['TIME_IN_NOTE'] ?? '--';
            $time_in_behavior = $api->get_time_in_behavior_status($employee_attendance_details[0]['TIME_IN_BEHAVIOR'])[0]['BADGE'];

            $time_out_date = $api->check_date('empty', $employee_attendance_details[0]['TIME_OUT_DATE'] ?? null, '', 'F d, Y', '', '', '');
            $time_out = $api->check_date('empty', $employee_attendance_details[0]['TIME_OUT'] ?? null, '', 'h:i a', '', '', '');
            $time_out_location = $employee_attendance_details[0]['TIME_OUT_LOCATION'] ?? null;
            $time_out_ip_address = $employee_attendance_details[0]['TIME_OUT_IP_ADDRESS'] ?? null;
            $time_out_by = $employee_attendance_details[0]['TIME_OUT_BY'] ?? null;
            $time_out_note = $employee_attendance_details[0]['TIME_OUT_NOTE'] ?? '--';
            $time_out_behavior = $api->get_time_out_behavior_status($employee_attendance_details[0]['TIME_OUT_BEHAVIOR'])[0]['BADGE'];

            if(!empty($time_in_location)){
                $in_location = '<a href="https://maps.google.com/?q=' . $time_out_location . '" target="_blank">View Location</a>';
            }
            else{
                $in_location = 'No location available';
            }

            if(!empty($time_out_location)){
                $out_location = '<a href="https://maps.google.com/?q=' . $time_out_location . '" target="_blank">View Location</a>';
            }
            else{
                $out_location = 'No location available';
            }

            $employee_details = $api->get_employee_details($employee_id, '');
            $employee_file_as = $employee_details[0]['FILE_AS'];

            $time_in_by_details = $api->get_employee_details($time_in_by, '');
            $time_in_by_file_as = $time_in_by_details[0]['FILE_AS'] ?? '--';

            $time_out_by_details = $api->get_employee_details($time_out_by, '');
            $time_out_by_file_as = $time_out_by_details[0]['FILE_AS'] ?? '--';

            $response[] = array(
                'EMPLOYEE_ID' => $employee_file_as,
                'TIME_IN_DATE' => $time_in_date,
                'TIME_IN' => $time_in,
                'TIME_IN_LOCATION' => $in_location,
                'TIME_IN_IP_ADDRESS' => $time_in_ip_address ?? '--',
                'TIME_IN_BY' => $time_in_by_file_as,
                'TIME_IN_BEHAVIOR' => $time_in_behavior,
                'TIME_IN_NOTE' => $time_in_note,
                'TIME_OUT_DATE' => $time_out_date ?? '--',
                'TIME_OUT' => $time_out ?? '--',
                'TIME_OUT_LOCATION' => $out_location ?? '--',
                'TIME_OUT_IP_ADDRESS' => $time_out_ip_address ?? '--',
                'TIME_OUT_BY' => $time_out_by_file_as,
                'TIME_OUT_BEHAVIOR' => $time_out_behavior ?? '--',
                'TIME_OUT_NOTE' => $time_out_note,
                'LATE' => number_format($employee_attendance_details[0]['LATE'] ?? '0.00'),
                'EARLY_LEAVING' => number_format($employee_attendance_details[0]['EARLY_LEAVING'] ?? '0.00'),
                'OVERTIME' => number_format($employee_attendance_details[0]['OVERTIME'] ?? '0.00'),
                'TOTAL_WORKING_HOURS' => number_format($employee_attendance_details[0]['TOTAL_WORKING_HOURS'] ?? '0.00', 2),
                'REMARKS' => $employee_attendance_details[0]['REMARKS'] ?? '--',
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Attendance record details
    else if($transaction == 'attendance record details'){
        if(isset($_POST['attendance_id']) && !empty($_POST['attendance_id'])){
            $attendance_id = $_POST['attendance_id'];

            $employee_attendance_details = $api->get_employee_attendance_details($attendance_id);

            $response[] = array(
                'EMPLOYEE_ID' => $employee_attendance_details[0]['EMPLOYEE_ID'],
                'TIME_IN_DATE' => $api->check_date('empty', $employee_attendance_details[0]['TIME_IN_DATE'], '', 'n/d/Y', '', '', ''),
                'TIME_IN' => $employee_attendance_details[0]['TIME_IN'],
                'TIME_OUT_DATE' => $api->check_date('empty', $employee_attendance_details[0]['TIME_OUT_DATE'], '', 'n/d/Y', '', '', ''),
                'TIME_OUT' => $employee_attendance_details[0]['TIME_OUT'],
                'REMARKS' => $employee_attendance_details[0]['REMARKS']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Attendance creation details
    else if($transaction == 'attendance creation details'){
        if(isset($_POST['request_id']) && !empty($_POST['request_id'])){
            $request_id = $_POST['request_id'];

            $attendance_creation_details = $api->get_attendance_creation_details($request_id);

            $response[] = array(
                'TIME_IN_DATE' => $api->check_date('empty', $attendance_creation_details[0]['TIME_IN_DATE'], '', 'n/d/Y', '', '', ''),
                'TIME_IN' => $attendance_creation_details[0]['TIME_IN'],
                'TIME_OUT_DATE' => $api->check_date('empty', $attendance_creation_details[0]['TIME_OUT_DATE'], '', 'n/d/Y', '', '', ''),
                'TIME_OUT' => $attendance_creation_details[0]['TIME_OUT'],
                'REASON' => $attendance_creation_details[0]['REASON']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Attendance creation summary details
    else if($transaction == 'attendance creation summary details'){
        if(isset($_POST['request_id']) && !empty($_POST['request_id'])){
            $request_id = $_POST['request_id'];
            $attendance_creation_details = $api->get_attendance_creation_details($request_id);
            $employee_id = $attendance_creation_details[0]['EMPLOYEE_ID'] ?? null;
            $decision_by = $attendance_creation_details[0]['DECISION_BY'] ?? null;
            $recommended_by = $attendance_creation_details[0]['RECOMMENDED_BY'] ?? null;
            $decision_remarks = $attendance_creation_details[0]['DECISION_REMARKS'] ?? '--';

            $time_in_date = $api->check_date('empty', $attendance_creation_details[0]['TIME_IN_DATE'] ?? null, '', 'F d, Y', '', '', '');
            $time_in = $api->check_date('empty', $attendance_creation_details[0]['TIME_IN'] ?? null, '', 'h:i a', '', '', '');

            $time_out_date = $api->check_date('empty', $attendance_creation_details[0]['TIME_OUT_DATE'] ?? null, '', 'F d, Y', '', '', '');
            $time_out = $api->check_date('empty', $attendance_creation_details[0]['TIME_OUT'] ?? null, '', 'h:i a', '', '', '');

            $request_date = $api->check_date('empty', $attendance_creation_details[0]['REQUEST_DATE'] ?? null, '', 'F d, Y', '', '', '');
            $request_time = $api->check_date('empty', $attendance_creation_details[0]['REQUEST_TIME'] ?? null, '', 'h:i a', '', '', '');

            $for_recommendation_date = $api->check_date('empty', $attendance_creation_details[0]['FOR_RECOMMENDATION_DATE'] ?? null, '', 'F d, Y', '', '', '');
            $for_recommendation_time = $api->check_date('empty', $attendance_creation_details[0]['FOR_RECOMMENDATION_TIME'] ?? null, '', 'h:i a', '', '', '');

            $recommendation_date = $api->check_date('empty', $attendance_creation_details[0]['RECOMMENDATION_DATE'] ?? null, '', 'F d, Y', '', '', '');
            $recommendation_time = $api->check_date('empty', $attendance_creation_details[0]['RECOMMENDATION_TIME'] ?? null, '', 'h:i a', '', '', '');

            $decision_date = $api->check_date('empty', $attendance_creation_details[0]['DECISION_DATE'] ?? null, '', 'F d, Y', '', '', '');
            $decision_time = $api->check_date('empty', $attendance_creation_details[0]['DECISION_TIME'] ?? null, '', 'h:i a', '', '', '');
            
            $attachment = '<a href="'. $attendance_creation_details[0]['FILE_PATH'] . '" target="_blank">View Attachment</a>';
            $status = $api->get_attendance_creation_status($attendance_creation_details[0]['STATUS'])[0]['BADGE'];
            $reason = $attendance_creation_details[0]['REASON'];

            $sanction = $api->get_attendance_creation_sanction_status($attendance_adjustment_details[0]['SANCTION'])[0]['BADGE'];

            $employee_details = $api->get_employee_details($employee_id, '');
            $employee_file_as = $employee_details[0]['FILE_AS'] ?? '--';

            $decision_by_details = $api->get_employee_details('', $decision_by);
            $decision_by_file_as = $decision_by_details[0]['FILE_AS'] ?? '--';

            $recommended_by_details = $api->get_employee_details('', $recommended_by);
            $recommended_by_file_as = $recommended_by_details[0]['FILE_AS'] ?? '--';

            $response[] = array(
                'EMPLOYEE_ID' => $employee_file_as,
                'TIME_IN_DATE' => $time_in_date ?? '--',
                'TIME_IN' => $time_in ?? '--',
                'TIME_OUT_DATE' => $time_out_date ?? '--',
                'TIME_OUT' => $time_out ?? '--',
                'ATTACHMENT' => $attachment,
                'STATUS' => $status,
                'REASON' => $reason,
                'SANCTION' => $sanction,
                'REQUEST_DATE' => $request_date ?? '--',
                'REQUEST_TIME' => $request_time ?? '--',
                'FOR_RECOMMENDATION_DATE' => $for_recommendation_date ?? '--',
                'FOR_RECOMMENDATION_TIME' => $for_recommendation_time ?? '--',
                'RECOMMENDATION_DATE' => $recommendation_date ?? '--',
                'RECOMMENDATION_TIME' => $recommendation_time ?? '--',
                'RECOMMENDATION_BY' => $recommended_by_file_as,
                'DECISION_DATE' => $decision_date ?? '--',
                'DECISION_TIME' => $decision_time ?? '--',
                'DECISION_REMARKS' => $decision_remarks,
                'DECISION_BY' => $decision_by_file_as,
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Attendance adjustment details
    else if($transaction == 'attendance adjustment details'){
        if(isset($_POST['request_id']) && !empty($_POST['request_id'])){
            $request_id = $_POST['request_id'];
            $attendance_adjustment_details = $api->get_attendance_adjustment_details($request_id);
            
            $response[] = array(
                'TIME_IN_DATE_ADJUSTED' => $api->check_date('empty', $attendance_adjustment_details[0]['TIME_IN_DATE_ADJUSTED'], '', 'n/d/Y', '', '', ''),
                'TIME_IN_ADJUSTED' => $attendance_adjustment_details[0]['TIME_IN_ADJUSTED'],
                'TIME_OUT_DATE_ADJUSTED' => $api->check_date('empty', $attendance_adjustment_details[0]['TIME_OUT_DATE_ADJUSTED'], '', 'n/d/Y', '', '', ''),
                'TIME_OUT_ADJUSTED' => $attendance_adjustment_details[0]['TIME_OUT_ADJUSTED'],
                'REASON' => $attendance_adjustment_details[0]['REASON']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Attendance adjustment summary details
    else if($transaction == 'attendance adjustment summary details'){
        if(isset($_POST['request_id']) && !empty($_POST['request_id'])){
            $request_id = $_POST['request_id'];
            $attendance_adjustment_details = $api->get_attendance_adjustment_details($request_id);
            $employee_id = $attendance_adjustment_details[0]['EMPLOYEE_ID'] ?? null;
            $decision_by = $attendance_adjustment_details[0]['DECISION_BY'] ?? null;
            $recommended_by = $attendance_adjustment_details[0]['RECOMMENDED_BY'] ?? null;
            $decision_remarks = $attendance_adjustment_details[0]['DECISION_REMARKS'] ?? '--';

            $time_in_date = $api->check_date('empty', $attendance_adjustment_details[0]['TIME_IN_DATE'] ?? null, '', 'F d, Y', '', '', '');
            $time_in = $api->check_date('empty', $attendance_adjustment_details[0]['TIME_IN'] ?? null, '', 'h:i a', '', '', '');

            $time_in_date_adjustment = $api->check_date('empty', $attendance_adjustment_details[0]['TIME_IN_DATE_ADJUSTED'] ?? null, '', 'F d, Y', '', '', '');
            $time_in_adjustment = $api->check_date('empty', $attendance_adjustment_details[0]['TIME_IN_ADJUSTED'] ?? null, '', 'h:i a', '', '', '');

            $time_out_date = $api->check_date('empty', $attendance_adjustment_details[0]['TIME_OUT_DATE'] ?? null, '', 'F d, Y', '', '', '');
            $time_out = $api->check_date('empty', $attendance_adjustment_details[0]['TIME_OUT'] ?? null, '', 'h:i a', '', '', '');

            $time_out_date_adjustment = $api->check_date('empty', $attendance_adjustment_details[0]['TIME_OUT_DATE_ADJUSTED'] ?? null, '', 'F d, Y', '', '', '');
            $time_out_adjustment = $api->check_date('empty', $attendance_adjustment_details[0]['TIME_OUT_ADJUSTED'] ?? null, '', 'h:i a', '', '', '');

            $request_date = $api->check_date('empty', $attendance_adjustment_details[0]['REQUEST_DATE'] ?? null, '', 'F d, Y', '', '', '');
            $request_time = $api->check_date('empty', $attendance_adjustment_details[0]['REQUEST_TIME'] ?? null, '', 'h:i a', '', '', '');

            $for_recommendation_date = $api->check_date('empty', $attendance_adjustment_details[0]['FOR_RECOMMENDATION_DATE'] ?? null, '', 'F d, Y', '', '', '');
            $for_recommendation_time = $api->check_date('empty', $attendance_adjustment_details[0]['FOR_RECOMMENDATION_TIME'] ?? null, '', 'h:i a', '', '', '');

            $recommendation_date = $api->check_date('empty', $attendance_adjustment_details[0]['RECOMMENDATION_DATE'] ?? null, '', 'F d, Y', '', '', '');
            $recommendation_time = $api->check_date('empty', $attendance_adjustment_details[0]['RECOMMENDATION_TIME'] ?? null, '', 'h:i a', '', '', '');

            $decision_date = $api->check_date('empty', $attendance_adjustment_details[0]['DECISION_DATE'] ?? null, '', 'F d, Y', '', '', '');
            $decision_time = $api->check_date('empty', $attendance_adjustment_details[0]['DECISION_TIME'] ?? null, '', 'h:i a', '', '', '');
            
            $attachment = '<a href="'. $attendance_adjustment_details[0]['FILE_PATH'] . '" target="_blank">View Attachment</a>';
            $status = $api->get_attendance_adjustment_status($attendance_adjustment_details[0]['STATUS'])[0]['BADGE'];
            $reason = $attendance_adjustment_details[0]['REASON'];

            $employee_details = $api->get_employee_details($employee_id, '');
            $employee_file_as = $employee_details[0]['FILE_AS'] ?? '--';

            $decision_by_details = $api->get_employee_details('', $decision_by);
            $decision_by_file_as = $decision_by_details[0]['FILE_AS'] ?? '--';

            $recommended_by_details = $api->get_employee_details('', $recommended_by);
            $recommended_by_file_as = $recommended_by_details[0]['FILE_AS'] ?? '--';

            $sanction = $api->get_attendance_adjustment_sanction_status($attendance_adjustment_details[0]['SANCTION'])[0]['BADGE'];

            $response[] = array(
                'EMPLOYEE_ID' => $employee_file_as,
                'TIME_IN_DATE' => $time_in_date ?? '--',
                'TIME_IN' => $time_in ?? '--',
                'TIME_IN_DATE_ADJUSTMENT' => $time_in_date_adjustment ?? '--',
                'TIME_IN_ADJUSTMENT' => $time_in_adjustment ?? '--',
                'TIME_OUT_DATE' => $time_out_date ?? '--',
                'TIME_OUT' => $time_out ?? '--',
                'TIME_OUT_DATE_ADJUSTMENT' => $time_out_date_adjustment ?? '--',
                'TIME_OUT_ADJUSTMENT' => $time_out_adjustment ?? '--',
                'ATTACHMENT' => $attachment,
                'STATUS' => $status,
                'REASON' => $reason,
                'SANCTION' => $sanction,
                'REQUEST_DATE' => $request_date ?? '--',
                'REQUEST_TIME' => $request_time ?? '--',
                'FOR_RECOMMENDATION_DATE' => $for_recommendation_date ?? '--',
                'FOR_RECOMMENDATION_TIME' => $for_recommendation_time ?? '--',
                'RECOMMENDATION_DATE' => $recommendation_date ?? '--',
                'RECOMMENDATION_TIME' => $recommendation_time ?? '--',
                'RECOMMENDATION_BY' => $recommended_by_file_as,
                'DECISION_DATE' => $decision_date ?? '--',
                'DECISION_TIME' => $decision_time ?? '--',
                'DECISION_REMARKS' => $decision_remarks,
                'DECISION_BY' => $decision_by_file_as,
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Allowance type details
    else if($transaction == 'allowance type details'){
        if(isset($_POST['allowance_type_id']) && !empty($_POST['allowance_type_id'])){
            $allowance_type_id = $_POST['allowance_type_id'];
            $allowance_type_details = $api->get_allowance_type_details($allowance_type_id);

            $response[] = array(
                'ALLOWANCE_TYPE' => $allowance_type_details[0]['ALLOWANCE_TYPE'],
                'TAXABLE' => $allowance_type_details[0]['TAXABLE'],
                'DESCRIPTION' => $allowance_type_details[0]['DESCRIPTION']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Allowance details
    else if($transaction == 'allowance details'){
        if(isset($_POST['allowance_id']) && !empty($_POST['allowance_id'])){
            $allowance_id = $_POST['allowance_id'];
            $allowance_details = $api->get_allowance_details($allowance_id);

            $response[] = array(
                'EMPLOYEE_ID' => $allowance_details[0]['EMPLOYEE_ID'],
                'ALLOWANCE_TYPE' => $allowance_details[0]['ALLOWANCE_TYPE'],
                'PAYROLL_DATE' => $api->check_date('empty', $allowance_details[0]['PAYROLL_DATE'], '', 'n/d/Y', '', '', ''),
                'AMOUNT' => $allowance_details[0]['AMOUNT']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Allowance summary details
    else if($transaction == 'allowance summary details'){
        if(isset($_POST['allowance_id']) && !empty($_POST['allowance_id'])){
            $allowance_id = $_POST['allowance_id'];
            $allowance_details = $api->get_allowance_details($allowance_id);
            $employee_id = $allowance_details[0]['EMPLOYEE_ID'];
            $allowance_type = $allowance_details[0]['ALLOWANCE_TYPE'];
            $payroll_id = $allowance_details[0]['PAYROLL_ID'];
            $payroll_date = $api->check_date('empty', $allowance_details[0]['PAYROLL_DATE'], '', 'F d, Y', '', '', '');
            $amount = $allowance_details[0]['AMOUNT'];
            $allowance_type_details = $api->get_allowance_type_details($allowance_type);
            $allowance_type_name = $allowance_type_details[0]['ALLOWANCE_TYPE'];
            $payslip_id_encrypted = $api->encrypt_data($payroll_id);

            $employee_details = $api->get_employee_details($employee_id, '');
            $employee_file_as = $employee_details[0]['FILE_AS'] ?? '--';

            if(!empty($payroll_id)){
                $payroll = '<a href="payslip-print.php?id='. $payslip_id_encrypted .'" target="_blank">View Payroll</a>';
            }
            else{
                $payroll = '--';
            }

            $response[] = array(
                'EMPLOYEE_ID' => $employee_file_as,
                'ALLOWANCE_TYPE' => $allowance_type_name,
                'PAYROLL' => $payroll,
                'PAYROLL_DATE' => $payroll_date,
                'AMOUNT' => number_format($amount, 2)
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Other income type details
    else if($transaction == 'other income type details'){
        if(isset($_POST['other_income_type_id']) && !empty($_POST['other_income_type_id'])){
            $other_income_type_id = $_POST['other_income_type_id'];
            $other_income_type_details = $api->get_other_income_type_details($other_income_type_id);

            $response[] = array(
                'OTHER_INCOME_TYPE' => $other_income_type_details[0]['OTHER_INCOME_TYPE'],
                'TAXABLE' => $other_income_type_details[0]['TAXABLE'],
                'DESCRIPTION' => $other_income_type_details[0]['DESCRIPTION']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Other income details
    else if($transaction == 'other income details'){
        if(isset($_POST['other_income_id']) && !empty($_POST['other_income_id'])){
            $other_income_id = $_POST['other_income_id'];
            $other_income_details = $api->get_other_income_details($other_income_id);

            $response[] = array(
                'EMPLOYEE_ID' => $other_income_details[0]['EMPLOYEE_ID'],
                'OTHER_INCOME_TYPE' => $other_income_details[0]['OTHER_INCOME_TYPE'],
                'PAYROLL_DATE' => $api->check_date('empty', $other_income_details[0]['PAYROLL_DATE'], '', 'n/d/Y', '', '', ''),
                'AMOUNT' => $other_income_details[0]['AMOUNT']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Other income summary details
    else if($transaction == 'other income summary details'){
        if(isset($_POST['other_income_id']) && !empty($_POST['other_income_id'])){
            $other_income_id = $_POST['other_income_id'];
            $other_income_details = $api->get_other_income_details($other_income_id);
            $employee_id = $other_income_details[0]['EMPLOYEE_ID'];
            $other_income_type = $other_income_details[0]['OTHER_INCOME_TYPE'];
            $payroll_id = $other_income_details[0]['PAYROLL_ID'];
            $payroll_date = $api->check_date('empty', $other_income_details[0]['PAYROLL_DATE'], '', 'F d, Y', '', '', '');
            $amount = $other_income_details[0]['AMOUNT'];
            $other_income_type_details = $api->get_other_income_type_details($other_income_type);
            $other_income_type_name = $other_income_type_details[0]['OTHER_INCOME_TYPE'];
            $payslip_id_encrypted = $api->encrypt_data($payroll_id);

            $employee_details = $api->get_employee_details($employee_id, '');
            $employee_file_as = $employee_details[0]['FILE_AS'] ?? '--';

            if(!empty($payroll_id)){
                $payroll = '<a href="payslip-print.php?id='. $payslip_id_encrypted .'" target="_blank">View Payroll</a>';
            }
            else{
                $payroll = '--';
            }

            $response[] = array(
                'EMPLOYEE_ID' => $employee_file_as,
                'OTHER_INCOME_TYPE' => $other_income_type_name,
                'PAYROLL' => $payroll,
                'PAYROLL_DATE' => $payroll_date,
                'AMOUNT' => number_format($amount, 2)
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Deduction type details
    else if($transaction == 'deduction type details'){
        if(isset($_POST['deduction_type_id']) && !empty($_POST['deduction_type_id'])){
            $deduction_type_id = $_POST['deduction_type_id'];
            $deduction_type_details = $api->get_deduction_type_details($deduction_type_id);

            $response[] = array(
                'DEDUCTION_TYPE' => $deduction_type_details[0]['DEDUCTION_TYPE'],
                'DESCRIPTION' => $deduction_type_details[0]['DESCRIPTION']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Government contribution details
    else if($transaction == 'government contribution details'){
        if(isset($_POST['government_contribution_id']) && !empty($_POST['government_contribution_id'])){
            $government_contribution_id = $_POST['government_contribution_id'];
            $government_contribution_details = $api->get_government_contribution_details($government_contribution_id);

            $response[] = array(
                'GOVERNMENT_CONTRIBUTION' => $government_contribution_details[0]['GOVERNMENT_CONTRIBUTION'],
                'DESCRIPTION' => $government_contribution_details[0]['DESCRIPTION']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Contribution bracket details
    else if($transaction == 'contribution bracket details'){
        if(isset($_POST['contribution_bracket_id']) && !empty($_POST['contribution_bracket_id'])){
            $contribution_bracket_id = $_POST['contribution_bracket_id'];
            $contribution_bracket_details = $api->get_contribution_bracket_details($contribution_bracket_id);

            $response[] = array(
                'START_RANGE' => $contribution_bracket_details[0]['START_RANGE'],
                'END_RANGE' => $contribution_bracket_details[0]['END_RANGE'],
                'DEDUCTION_AMOUNT' => $contribution_bracket_details[0]['DEDUCTION_AMOUNT']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Deduction details
    else if($transaction == 'deduction details'){
        if(isset($_POST['deduction_id']) && !empty($_POST['deduction_id'])){
            $deduction_id = $_POST['deduction_id'];
            $deduction_details = $api->get_deduction_details($deduction_id);

            $response[] = array(
                'EMPLOYEE_ID' => $deduction_details[0]['EMPLOYEE_ID'],
                'DEDUCTION_TYPE' => $deduction_details[0]['DEDUCTION_TYPE'],
                'PAYROLL_DATE' => $api->check_date('empty', $deduction_details[0]['PAYROLL_DATE'], '', 'n/d/Y', '', '', ''),
                'AMOUNT' => $deduction_details[0]['AMOUNT']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Deduction summary details
    else if($transaction == 'deduction summary details'){
        if(isset($_POST['deduction_id']) && !empty($_POST['deduction_id'])){
            $deduction_id = $_POST['deduction_id'];
            $deduction_details = $api->get_deduction_details($deduction_id);
            $employee_id = $deduction_details[0]['EMPLOYEE_ID'];
            $deduction_type = $deduction_details[0]['DEDUCTION_TYPE'];
            $payroll_id = $deduction_details[0]['PAYROLL_ID'];
            $payroll_date = $api->check_date('empty', $deduction_details[0]['PAYROLL_DATE'], '', 'F d, Y', '', '', '');
            $amount = $deduction_details[0]['AMOUNT'];
            $deduction_type_details = $api->get_deduction_type_details($deduction_type);
            $deduction_type_name = $deduction_type_details[0]['DEDUCTION_TYPE'];
            $payslip_id_encrypted = $api->encrypt_data($payroll_id);

            $employee_details = $api->get_employee_details($employee_id, '');
            $employee_file_as = $employee_details[0]['FILE_AS'] ?? '--';

            if(!empty($payroll_id)){
                $payroll = '<a href="payslip-print.php?id='. $payslip_id_encrypted .'" target="_blank">View Payroll</a>';
            }
            else{
                $payroll = '--';
            }

            $response[] = array(
                'EMPLOYEE_ID' => $employee_file_as,
                'DEDUCTION_TYPE' => $deduction_type_name,
                'PAYROLL' => $payroll,
                'PAYROLL_DATE' => $payroll_date,
                'AMOUNT' => number_format($amount, 2)
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Contribution deduction details
    else if($transaction == 'contribution deduction details'){
        if(isset($_POST['contribution_deduction_id']) && !empty($_POST['contribution_deduction_id'])){
            $contribution_deduction_id = $_POST['contribution_deduction_id'];
            $contribution_deduction_details = $api->get_contribution_deduction_details($contribution_deduction_id);

            $response[] = array(
                'EMPLOYEE_ID' => $contribution_deduction_details[0]['EMPLOYEE_ID'],
                'GOVERNMENT_CONTRIBUTION_TYPE' => $contribution_deduction_details[0]['GOVERNMENT_CONTRIBUTION_TYPE'],
                'PAYROLL_DATE' => $api->check_date('empty', $contribution_deduction_details[0]['PAYROLL_DATE'], '', 'n/d/Y', '', '', '')
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Contribution deduction summary details
    else if($transaction == 'contribution deduction summary details'){
        if(isset($_POST['contribution_deduction_id']) && !empty($_POST['contribution_deduction_id'])){
            $contribution_deduction_id = $_POST['contribution_deduction_id'];
            $contribution_deduction_details = $api->get_contribution_deduction_details($contribution_deduction_id);
            $employee_id = $contribution_deduction_details[0]['EMPLOYEE_ID'];
            $government_contribution_type = $contribution_deduction_details[0]['GOVERNMENT_CONTRIBUTION_TYPE'];
            $payroll_id = $contribution_deduction_details[0]['PAYROLL_ID'];
            $payroll_date = $api->check_date('empty', $contribution_deduction_details[0]['PAYROLL_DATE'], '', 'F d, Y', '', '', '');
            $government_contribution_type_details = $api->get_government_contribution_details($government_contribution_type);
            $government_contribution_type_name = $government_contribution_type_details[0]['GOVERNMENT_CONTRIBUTION'];
            $payslip_id_encrypted = $api->encrypt_data($payroll_id);

            $employee_details = $api->get_employee_details($employee_id, '');
            $employee_file_as = $employee_details[0]['FILE_AS'] ?? '--';

            if(!empty($payroll_id)){
                $payroll = '<a href="payslip-print.php?id='. $payslip_id_encrypted .'" target="_blank">View Payroll</a>';
            }
            else{
                $payroll = '--';
            }

            $response[] = array(
                'EMPLOYEE_ID' => $employee_file_as,
                'GOVERNMENT_CONTRIBUTION_TYPE' => $government_contribution_type_name,
                'PAYROLL' => $payroll,
                'PAYROLL_DATE' => $payroll_date
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Salary details
    else if($transaction == 'salary details'){
        if(isset($_POST['salary_id']) && !empty($_POST['salary_id'])){
            $salary_id = $_POST['salary_id'];
            $salary_details = $api->get_salary_details($salary_id);

            $response[] = array(
                'EMPLOYEE_ID' => $salary_details[0]['EMPLOYEE_ID'],
                'SALARY_AMOUNT' => $salary_details[0]['SALARY_AMOUNT'],
                'SALARY_FREQUENCY' => $salary_details[0]['SALARY_FREQUENCY'],
                'HOURS_PER_WEEK' => $salary_details[0]['HOURS_PER_WEEK'],
                'HOURS_PER_DAY' => $salary_details[0]['HOURS_PER_DAY'],
                'MINUTE_RATE' => $salary_details[0]['MINUTE_RATE'],
                'HOURLY_RATE' => $salary_details[0]['HOURLY_RATE'],
                'DAILY_RATE' => $salary_details[0]['DAILY_RATE'],
                'WEEKLY_RATE' => $salary_details[0]['WEEKLY_RATE'],
                'BI_WEEKLY_RATE' => $salary_details[0]['BI_WEEKLY_RATE'],
                'MONTHLY_RATE' => $salary_details[0]['MONTHLY_RATE'],
                'EFFECTIVITY_DATE' => $api->check_date('empty', $salary_details[0]['EFFECTIVITY_DATE'], '', 'n/d/Y', '', '', ''),
                'REMARKS' => $salary_details[0]['REMARKS']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Salary details
    else if($transaction == 'salary summary details'){
        if(isset($_POST['salary_id']) && !empty($_POST['salary_id'])){
            $salary_id = $_POST['salary_id'];
            $salary_details = $api->get_salary_details($salary_id);
            $employee_id = $salary_details[0]['EMPLOYEE_ID'];

            $employee_details = $api->get_employee_details($employee_id, '');
            $employee_file_as = $employee_details[0]['FILE_AS'] ?? '--';

            $response[] = array(
                'EMPLOYEE_ID' => $employee_file_as,
                'SALARY_AMOUNT' => number_format($salary_details[0]['SALARY_AMOUNT'], 2),
                'SALARY_FREQUENCY' => $api->get_system_code_details('SALARYFREQUENCY', $salary_details[0]['SALARY_FREQUENCY'])[0]['DESCRIPTION'],
                'HOURS_PER_WEEK' => number_format($salary_details[0]['HOURS_PER_WEEK']),
                'HOURS_PER_DAY' => number_format($salary_details[0]['HOURS_PER_DAY']),
                'MINUTE_RATE' => number_format($salary_details[0]['MINUTE_RATE'], 2),
                'HOURLY_RATE' => number_format($salary_details[0]['HOURLY_RATE'], 2),
                'DAILY_RATE' => number_format($salary_details[0]['DAILY_RATE'], 2),
                'WEEKLY_RATE' => number_format($salary_details[0]['WEEKLY_RATE'], 2),
                'BI_WEEKLY_RATE' => number_format($salary_details[0]['BI_WEEKLY_RATE'], 2),
                'MONTHLY_RATE' => number_format($salary_details[0]['MONTHLY_RATE'], 2),
                'EFFECTIVITY_DATE' => $api->check_date('empty', $salary_details[0]['EFFECTIVITY_DATE'], '', 'F d, Y', '', '', ''),
                'REMARKS' => $salary_details[0]['REMARKS']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Payroll setting details
    else if($transaction == 'payroll setting details'){
        $payroll_setting_details = $api->get_payroll_setting_details(1);
       
        $response[] = array(
            'LATE_DEDUCTION_RATE' => $payroll_setting_details[0]['LATE_DEDUCTION_RATE'] ?? 0,
            'EARLY_LEAVING_DEDUCTION_RATE' => $payroll_setting_details[0]['EARLY_LEAVING_DEDUCTION_RATE'] ?? 0,
            'OVERTIME_RATE' => $payroll_setting_details[0]['OVERTIME_RATE'] ?? 125,
            'NIGHT_DIFFERENTIAL_RATE' => $payroll_setting_details[0]['NIGHT_DIFFERENTIAL_RATE'] ?? 0
        );

        echo json_encode($response);
    }
    # -------------------------------------------------------------

    # Payroll group details
    else if($transaction == 'payroll group details'){
        if(isset($_POST['payroll_group_id']) && !empty($_POST['payroll_group_id'])){
            $employee_id = '';
            $payroll_group_id = $_POST['payroll_group_id'];
            $payroll_group_details = $api->get_payroll_group_details($payroll_group_id);
            $payroll_group_employee_details = $api->get_payroll_group_employee_details($payroll_group_id);

            for($i = 0; $i < count($payroll_group_employee_details); $i++) {
                $employee_id .= $payroll_group_employee_details[$i]['EMPLOYEE_ID'];

                if($i != (count($payroll_group_employee_details) - 1)){
                    $employee_id .= ',';
                }
            }

            $response[] = array(
                'PAYROLL_GROUP' => $payroll_group_details[0]['PAYROLL_GROUP'],
                'DESCRIPTION' => $payroll_group_details[0]['DESCRIPTION'],
                'EMPLOYEE_ID' => $employee_id
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Payroll group summary details
    else if($transaction == 'payroll group summary details'){
        if(isset($_POST['payroll_group_id']) && !empty($_POST['payroll_group_id'])){
            $employee = '';
            $payroll_group_id = $_POST['payroll_group_id'];
            $payroll_group_details = $api->get_payroll_group_details($payroll_group_id);
            $payroll_group_employee_details = $api->get_payroll_group_employee_details($payroll_group_id);

            for($i = 0; $i < count($payroll_group_employee_details); $i++) {
                $employee_id = $payroll_group_employee_details[$i]['EMPLOYEE_ID'];

                $employee_details = $api->get_employee_details($employee_id, '');
                $employee .= $employee_details[0]['FILE_AS'] ?? '--';

                if($i != (count($payroll_group_employee_details) - 1)){
                    $employee .= '<br/>';
                }
            }

            $response[] = array(
                'PAYROLL_GROUP' => $payroll_group_details[0]['PAYROLL_GROUP'],
                'DESCRIPTION' => $payroll_group_details[0]['DESCRIPTION'],
                'EMPLOYEE' => $employee
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Pay run summary details
    else if($transaction == 'pay run summary details'){
        if(isset($_POST['pay_run_id']) && !empty($_POST['pay_run_id'])){
            $payee = '';
            $pay_run_id = $_POST['pay_run_id'];
            $pay_run_details = $api->get_pay_run_details($pay_run_id);
            $pay_run_payee_details = $api->get_pay_run_payee_details($pay_run_id);

            for($i = 0; $i < count($pay_run_payee_details); $i++) {
                $employee_id = $pay_run_payee_details[$i]['EMPLOYEE_ID'];

                $employee_details = $api->get_employee_details($employee_id, '');
                $payee .= $employee_details[0]['FILE_AS'] ?? '--';

                if($i != (count($pay_run_payee_details) - 1)){
                    $payee .= '<br/>';
                }
            }

            $generated_by_details = $api->get_employee_details('', $pay_run_details[0]['GENERATED_BY']);
            $generated_by = $generated_by_details[0]['FILE_AS'] ?? '--';

            $pay_run_status = $api->get_pay_run_status($pay_run_details[0]['STATUS'])[0]['BADGE'];
            $consider_overtime_status = $api->get_consider_overtime_status($pay_run_details[0]['CONSIDER_OVERTIME'])[0]['BADGE'];
            $consider_withholding_tax_status = $api->get_consider_withholding_tax_status($pay_run_details[0]['CONSIDER_WITHHOLDING_TAX'])[0]['BADGE'];
            $consider_holiday_pay_status = $api->get_consider_holiday_pay_status($pay_run_details[0]['CONSIDER_HOLIDAY_PAY'])[0]['BADGE'];
            $consider_night_differential_status = $api->get_consider_night_differential_status($pay_run_details[0]['CONSIDER_NIGHT_DIFFERENTIAL'])[0]['BADGE'];

            $response[] = array(
                'START_DATE' => $api->check_date('empty', $pay_run_details[0]['START_DATE'], '', 'F d, Y', '', '', ''),
                'END_DATE' => $api->check_date('empty', $pay_run_details[0]['END_DATE'], '', 'F d, Y', '', '', ''),
                'GENERATION_DATE' => $api->check_date('empty', $pay_run_details[0]['GENERATION_DATE'], '', 'F d, Y', '', '', ''),
                'GENERATION_TIME' => $api->check_date('empty', $pay_run_details[0]['GENERATION_TIME'], '', 'h:i:s a', '', '', ''),
                'PAYSLIP_NOTE' => $pay_run_details[0]['PAYSLIP_NOTE'],
                'GENERATED_BY' => $generated_by,
                'STATUS' => $pay_run_status,
                'CONSIDER_OVERTIME' => $consider_overtime_status,
                'CONSIDER_WITHHOLDING_TAX' => $consider_withholding_tax_status,
                'CONSIDER_HOLIDAY_PAY' => $consider_holiday_pay_status,
                'CONSIDER_NIGHT_DIFFERENTIAL' => $consider_night_differential_status,
                'PAYEE' => $payee
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Withholding tax details
    else if($transaction == 'withholding tax details'){
        if(isset($_POST['withholding_tax_id']) && !empty($_POST['withholding_tax_id'])){
            $withholding_tax_id = $_POST['withholding_tax_id'];
            $withholding_tax_details = $api->get_withholding_tax_details($withholding_tax_id);

            $response[] = array(
                'SALARY_FREQUENCY' => $withholding_tax_details[0]['SALARY_FREQUENCY'],
                'START_RANGE' => $withholding_tax_details[0]['START_RANGE'],
                'END_RANGE' => $withholding_tax_details[0]['END_RANGE'],
                'FIX_COMPENSATION_LEVEL' => $withholding_tax_details[0]['FIX_COMPENSATION_LEVEL'],
                'BASE_TAX' => $withholding_tax_details[0]['BASE_TAX'],
                'PERCENT_OVER' => $withholding_tax_details[0]['PERCENT_OVER']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Payslip summary details
    else if($transaction == 'payslip summary details'){
        if(isset($_POST['payslip_id']) && !empty($_POST['payslip_id'])){
            $payslip_id = $_POST['payslip_id'];
            $payslip_details = $api->get_payslip_details($payslip_id);
            $pay_run_id = $payslip_details[0]['PAY_RUN_ID'];
            $employee_id = $payslip_details[0]['EMPLOYEE_ID'];

            # Company details
            $company_setting_details = $api->get_company_setting_details(1);
            $company_name = $company_setting_details[0]['COMPANY_NAME'];
            $company_address = $company_setting_details[0]['ADDRESS'];
            $company_province_id = $company_setting_details[0]['PROVINCE_ID'];
            $company_city_id = $company_setting_details[0]['CITY_ID'];
            $company_logo = $api->check_image($company_setting_details[0]['COMPANY_LOGO'] ?? null, 'company logo');

            # Company province details
            $company_province_details = $api->get_province_details($company_province_id);
            $company_province = $company_province_details[0]['PROVINCE'];

            # Company city details
            $city_details = $api->get_city_details($company_city_id, $company_province_id);
            $company_city = $city_details[0]['CITY'];

            # Employee details
            $employee_details = $api->get_employee_details($employee_id, '');
            $file_as = $employee_details[0]['FILE_AS'];
            $designation = $employee_details[0]['DESIGNATION'];
            $department = $employee_details[0]['DEPARTMENT'];

            # Designation details
            $designation_details = $api->get_designation_details($designation);
            $designation_name = $designation_details[0]['DESIGNATION'];
            $system_date = date('Y-m-d');

            # Department details
            $department_details = $api->get_department_details($department);
            $department_name = $department_details[0]['DEPARTMENT'];

            # Payrun details
            $pay_run_details = $api->get_pay_run_details($pay_run_id);
            $coverage_start_date = $api->check_date('empty', $pay_run_details[0]['START_DATE'], '', 'F d, Y', '', '', '');
            $coverage_end_date = $api->check_date('empty', $pay_run_details[0]['END_DATE'], '', 'F d, Y', '', '', '');

            $payslip_logo = ' <img src="'. $company_logo .'" alt="company logo" style="max-height: 50px"/>';
            $generated_date = ' <strong>Generated Date:</strong><br>'. date('F d, Y');
            $payslip_pay_run_details = ' <strong>Coverage Date:</strong><br>' . $coverage_start_date . ' - ' . $coverage_end_date;

            $payslip_employee_details = ' <strong>'. $file_as .'</strong><br>
                                            '. $designation_name .'<br>
                                            '. $department_name .'<br>
                                            Employee ID: ' . $employee_id;

            $payslip_company_details = ' <strong>'. $company_name .'</strong><br>
                                            ' . $company_address . ', ' . $company_city . ', ' . $company_province;

            $payslip_earnings_table = $api->generate_payslip_earnings_table($payslip_id, $employee_id);
            $payslip_deduction_table = $api->generate_payslip_deduction_table($payslip_id, $employee_id);

            $response[] = array(
                'EMPLOYEE_DETAILS' => $payslip_employee_details,
                'COMPANY_DETAILS' => $payslip_company_details,
                'GENERATED_DATE' => $generated_date,
                'PAYRUN_DETAILS' => $payslip_pay_run_details,
                'EARNINGS_TABLE' => $payslip_earnings_table,
                'DEDUCTIONS_TABLE' => $payslip_deduction_table,
                'COMPANY_LOGO' => $payslip_logo,
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Job category details
    else if($transaction == 'job category details'){
        if(isset($_POST['job_category_id']) && !empty($_POST['job_category_id'])){
            $job_category_id = $_POST['job_category_id'];
            $job_category_details = $api->get_job_category_details($job_category_id);

            $response[] = array(
                'JOB_CATEGORY' => $job_category_details[0]['JOB_CATEGORY'],
                'DESCRIPTION' => $job_category_details[0]['DESCRIPTION']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Job type details
    else if($transaction == 'job type details'){
        if(isset($_POST['job_type_id']) && !empty($_POST['job_type_id'])){
            $job_type_id = $_POST['job_type_id'];
            $job_type_details = $api->get_job_type_details($job_type_id);

            $response[] = array(
                'JOB_TYPE' => $job_type_details[0]['JOB_TYPE'],
                'DESCRIPTION' => $job_type_details[0]['DESCRIPTION']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Recruitment pipeline details
    else if($transaction == 'recruitment pipeline details'){
        if(isset($_POST['recruitment_pipeline_id']) && !empty($_POST['recruitment_pipeline_id'])){
            $recruitment_pipeline_id = $_POST['recruitment_pipeline_id'];
            $recruitment_pipeline_details = $api->get_recruitment_pipeline_details($recruitment_pipeline_id);

            $response[] = array(
                'RECRUITMENT_PIPELINE' => $recruitment_pipeline_details[0]['RECRUITMENT_PIPELINE'],
                'DESCRIPTION' => $recruitment_pipeline_details[0]['DESCRIPTION']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Recruitment pipeline stage details
    else if($transaction == 'recruitment pipeline stage details'){
        if(isset($_POST['recruitment_pipeline_stage_id']) && !empty($_POST['recruitment_pipeline_stage_id'])){
            $recruitment_pipeline_stage_id = $_POST['recruitment_pipeline_stage_id'];
            $recruitment_pipeline_stage_details = $api->get_recruitment_pipeline_stage_details($recruitment_pipeline_stage_id);

            $response[] = array(
                'RECRUITMENT_PIPELINE_STAGE' => $recruitment_pipeline_stage_details[0]['RECRUITMENT_PIPELINE_STAGE'],
                'DESCRIPTION' => $recruitment_pipeline_stage_details[0]['DESCRIPTION']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Recruitment scorecard details
    else if($transaction == 'recruitment scorecard details'){
        if(isset($_POST['recruitment_scorecard_id']) && !empty($_POST['recruitment_scorecard_id'])){
            $recruitment_scorecard_id = $_POST['recruitment_scorecard_id'];
            $recruitment_scorecard_details = $api->get_recruitment_scorecard_details($recruitment_scorecard_id);

            $response[] = array(
                'RECRUITMENT_SCORECARD' => $recruitment_scorecard_details[0]['RECRUITMENT_SCORECARD'],
                'DESCRIPTION' => $recruitment_scorecard_details[0]['DESCRIPTION']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Recruitment scorecard section details
    else if($transaction == 'recruitment scorecard section details'){
        if(isset($_POST['recruitment_scorecard_section_id']) && !empty($_POST['recruitment_scorecard_section_id'])){
            $recruitment_scorecard_section_id = $_POST['recruitment_scorecard_section_id'];
            $recruitment_scorecard_section_details = $api->get_recruitment_scorecard_section_details($recruitment_scorecard_section_id);

            $response[] = array(
                'RECRUITMENT_SCORECARD_SECTION' => $recruitment_scorecard_section_details[0]['RECRUITMENT_SCORECARD_SECTION'],
                'DESCRIPTION' => $recruitment_scorecard_section_details[0]['DESCRIPTION']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Recruitment scorecard section option details
    else if($transaction == 'recruitment scorecard section option details'){
        if(isset($_POST['recruitment_scorecard_section_option_id']) && !empty($_POST['recruitment_scorecard_section_option_id'])){
            $recruitment_scorecard_section_option_id = $_POST['recruitment_scorecard_section_option_id'];
            $recruitment_scorecard_section_option_details = $api->get_recruitment_scorecard_section_option_details($recruitment_scorecard_section_option_id);

            $response[] = array(
                'RECRUITMENT_SCORECARD_SECTION_OPTION' => $recruitment_scorecard_section_option_details[0]['RECRUITMENT_SCORECARD_SECTION_OPTION']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Job details
    else if($transaction == 'job details'){
        if(isset($_POST['job_id']) && !empty($_POST['job_id'])){
            $job_id = $_POST['job_id'];
            $job_details = $api->get_job_details($job_id);
            $team_member = '';
            $branch = '';

            $job_team_member_details = $api->get_job_team_member_details($job_id);
            $job_branch_details = $api->get_job_branch_details($job_id);

            for($i = 0; $i < count($job_team_member_details); $i++) {
                $team_member .= $job_team_member_details[$i]['EMPLOYEE_ID'] ?? null;

                if($i != (count($job_team_member_details) - 1)){
                    $team_member .= ',';
                }
            }

            for($i = 0; $i < count($job_branch_details); $i++) {
                $branch .= $job_branch_details[$i]['BRANCH_ID'] ?? null;

                if($i != (count($job_branch_details) - 1)){
                    $branch .= ',';
                }
            }

            $response[] = array(
                'JOB_TITLE' => $job_details[0]['JOB_TITLE'],
                'JOB_CATEGORY' => $job_details[0]['JOB_CATEGORY'],
                'JOB_TYPE' => $job_details[0]['JOB_TYPE'],
                'PIPELINE' => $job_details[0]['PIPELINE'],
                'SCORECARD' => $job_details[0]['SCORECARD'],
                'SALARY' => $job_details[0]['SALARY'],
                'DESCRIPTION' => $job_details[0]['DESCRIPTION'],
                'TEAM_MEMBER' => $team_member,
                'BRANCH' => $branch
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Job summary details
    else if($transaction == 'job summary details'){
        if(isset($_POST['job_id']) && !empty($_POST['job_id'])){
            $job_id = $_POST['job_id'];
            $job_details = $api->get_job_details($job_id);
            $team_member = '';
            $branch = '';
            $job_category = $job_details[0]['JOB_CATEGORY'];
            $job_type = $job_details[0]['JOB_TYPE'];
            $pipeline = $job_details[0]['PIPELINE'];
            $scorecard = $job_details[0]['SCORECARD'];

            $job_category_details = $api->get_job_category_details($job_category);
            $job_category_name = $job_category_details[0]['JOB_CATEGORY'];

            $job_type_details = $api->get_job_type_details($job_type);
            $job_type_name = $job_type_details[0]['JOB_TYPE'];

            $recruitment_pipeline_details = $api->get_recruitment_pipeline_details($pipeline);
            $pipeline_name = $recruitment_pipeline_details[0]['RECRUITMENT_PIPELINE'];

            $recruitment_scorecard_details = $api->get_recruitment_scorecard_details($scorecard);
            $scorecard_name = $recruitment_scorecard_details[0]['RECRUITMENT_SCORECARD'];

            $job_team_member_details = $api->get_job_team_member_details($job_id);
            $job_branch_details = $api->get_job_branch_details($job_id);

            $created_by_details = $api->get_employee_details('', $job_details[0]['CREATED_BY']);
            $created_by = $created_by_details[0]['FILE_AS'] ?? $job_details[0]['CREATED_BY'];

            for($i = 0; $i < count($job_team_member_details); $i++) {
                $team_member_details = $api->get_employee_details($job_team_member_details[$i]['EMPLOYEE_ID'], '');
                $team_member .= $team_member_details[0]['FILE_AS'] ?? null;

                if($i != (count($job_team_member_details) - 1)){
                    $team_member .= '<br/>';
                }
            }

            for($i = 0; $i < count($job_branch_details); $i++) {
                $branch_details = $api->get_branch_details($job_branch_details[$i]['BRANCH_ID']);
                $branch = $branch_details[0]['BRANCH'];

                if($i != (count($job_branch_details) - 1)){
                    $branch .= '<br/>';
                }
            }

            $response[] = array(
                'JOB_TITLE' => $job_details[0]['JOB_TITLE'],
                'JOB_CATEGORY' => $job_category_name,
                'JOB_TYPE' => $job_type_name,
                'PIPELINE' => $pipeline_name,
                'SCORECARD' => $scorecard_name,
                'SALARY' => number_format($job_details[0]['SALARY'], 2),
                'STATUS' => $api->get_job_status($job_details[0]['STATUS'])[0]['BADGE'],
                'DESCRIPTION' => $job_details[0]['DESCRIPTION'],
                'CREATED_DATE' => $api->check_date('empty', $job_details[0]['CREATED_DATE'], '', 'F d, Y', '', '', ''),
                'CREATED_TIME' => $api->check_date('empty', $job_details[0]['CREATED_TIME'], '', 'h:i:s a', '', '', ''),
                'CREATED_BY' => $created_by,
                'TEAM_MEMBER' => $team_member,
                'BRANCH' => $branch
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # Job applicant details
    else if($transaction == 'job applicant details'){
        if(isset($_POST['applicant_id']) && !empty($_POST['applicant_id'])){
            $applicant_id = $_POST['applicant_id'];
            $job_applicant_details = $api->get_job_applicant_details($applicant_id);
          
            $response[] = array(
                'FIRST_NAME' => $job_applicant_details[0]['FIRST_NAME'],
                'MIDDLE_NAME' => $job_applicant_details[0]['MIDDLE_NAME'],
                'LAST_NAME' => $job_applicant_details[0]['LAST_NAME'],
                'APPLICATION_DATE' => $job_applicant_details[0]['APPLICATION_DATE'],
                'BIRTHDAY' => $job_applicant_details[0]['BIRTHDAY'],
                'EMAIL' => $job_applicant_details[0]['EMAIL'],
                'PHONE' => $job_applicant_details[0]['PHONE'],
                'TELEPHONE' => $job_applicant_details[0]['TELEPHONE'],
                'SUFFIX' => $job_applicant_details[0]['SUFFIX'],
                'APPLIED_FOR' => $job_applicant_details[0]['APPLIED_FOR'],
                'GENDER' => $job_applicant_details[0]['GENDER']
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

}

?>