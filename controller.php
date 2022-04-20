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

            if($check_user_account_exist == 1){
                $update_user_password = $api->update_user_password($username, $password, $password_expiry_date);

                if($update_user_password == 1){
                    $update_login_attempt = $api->update_login_attempt($username, '', 0, NULL);

                    if($update_login_attempt == 1){
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

                        if($truncate_temporary_employee_table == 1){
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

                        if($truncate_temporary_attendance_record_table == 1){
                            $file = fopen($import_file_tmp_name, 'r');
                            fgetcsv($file);
    
                            while (($column = fgetcsv($file, 0, ',')) !== FALSE) { 
                                $employee_id = $column[0];
                                $time_in_date = $api->check_date('empty', $column[1], '', 'Y-m-d', '', '', '');
                                $time_in = $api->check_date('empty', $column[2], '', 'H:i:00', '', '', '');
                                $time_out_date = $api->check_date('empty', $column[3], '', 'Y-m-d', '', '', '');
                                $time_out = $api->check_date('empty', $column[4], '', 'H:i:00', '', '', '');

                                if(!empty($employee_id) && !empty($time_in_date) && !empty($time_in)){
                                    $insert_temporary_attendance_record = $api->insert_temporary_attendance_record($employee_id, $time_in_date, $time_in, $time_out_date, $time_out);
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
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employee_id']) && isset($_POST['time_in_date']) && isset($_POST['time_in']) && isset($_POST['time_out_date']) && isset($_POST['time_out'])){
            $username = $_POST['username'];
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

                    if($get_clock_in_total < $max_attendance){
                        $insert_manual_employee_attendance = $api->insert_manual_employee_attendance($employee_id[$i], $time_in_date[$i], $time_in[$i], $time_in_behavior, $time_out_date[$i], $time_out[$i], $time_out_behavior, $late, $early_leaving, $overtime, $total_hours_worked, 'Imported', $username);
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

                        if($truncate_temporary_leave_table == 1){
                            $file = fopen($import_file_tmp_name, 'r');
                            fgetcsv($file);
    
                            while (($column = fgetcsv($file, 0, ',')) !== FALSE) { 
                                $employee_id = $column[0];
                                $leave_type = $column[1];
                                $no_leaves = $column[2];
                                $start_date = $api->check_date('empty', $column[3], '', 'Y-m-d', '', '', '');
                                $end_date = $api->check_date('empty', $column[4], '', 'Y-m-d', '', '', '');

                                if(!empty($employee_id) && !empty($leave_type) && !empty($no_leaves) && !empty($start_date) && !empty($end_date)){
                                    $insert_temporary_leave = $api->insert_temporary_leave($employee_id, $leave_type, $no_leaves, $start_date, $end_date);
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
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employee_id']) && isset($_POST['leave_type']) && isset($_POST['no_leaves']) && isset($_POST['start_date']) && isset($_POST['end_date'])){
            $username = $_POST['username'];
            $employee_id = $_POST['employee_id'];
            $leave_type = $_POST['leave_type'];
            $no_leaves = $_POST['no_leaves'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            for($i = 0; $i < count($employee_id); $i++){
                $leave_overlap = $api->check_leave_overlap('', $start_date[$i], $end_date[$i], $employee_id[$i], $leave_type[$i]);

                if($leave_overlap == 0){
                    $insert_leave = $api->insert_leave($employee_id[$i], $leave_type[$i], $no_leaves[$i], $start_date[$i], $end_date[$i], $username);

                    if($insert_leave != 1){
                        $error = $insert_leave;
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

                        if($truncate_temporary_leave_table == 1){
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
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employee_id']) && isset($_POST['leave_type']) && isset($_POST['leave_date']) && isset($_POST['leave_status']) && isset($_POST['leave_reason'])){
            $username = $_POST['username'];
            $employee_id = $_POST['employee_id'];
            $leave_type = $_POST['leave_type'];
            $leave_date = $_POST['leave_date'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $leave_status = $_POST['leave_status'];
            $leave_reason = $_POST['leave_reason'];

            for($i = 0; $i < count($employee_id); $i++){
                if($leave_status[$i] == 'APV'){
                    $decision_date = date('Y-m-d');
                    $decision_time = date('H:i:s');
                    $decision_by = $username;
                }
                else{
                    $decision_date = null;
                    $decision_time = null;
                    $decision_by = null;
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
            else{
                $truncate_table = 1;
            }

            if($truncate_table == 1){
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
                                        
                if($update_system_parameter == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_system_parameter;
                }
            }
            else{
                $insert_system_parameter = $api->insert_system_parameter($parameter, $extension, $parameter_number, $username);
                        
                if($insert_system_parameter == 1){
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

                if($update_policy == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_policy;
                }
            }
            else{
                $insert_policy = $api->insert_policy($policy, $description, $username);

                if($insert_policy == 1){
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

                if($update_permission == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_permission;
                }
            }
            else{
                $insert_permission = $api->insert_permission($policy_id, $permission, $username);

                if($insert_permission == 1){
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

                if($update_role == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_role;
                }
            }
            else{
                $insert_role = $api->insert_role($role, $description, $username);

                if($insert_role == 1){
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

            if($check_role_exist == 1){
                $delete_permission_role = $api->delete_permission_role($role_id, $username);

                if($delete_permission_role == 1){
                    foreach($permissions as $permission){
                        $insert_permission_role = $api->insert_permission_role($role_id, $permission, $username);

                        if($insert_permission_role != 1){
                            $error = $insert_permission_role;
                        }
                    }

                    if(empty($error)){
                        $insert_transaction_log = $api->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated role permission (' . $role_id . ').');
                                    
                        if($insert_transaction_log == 1){
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
                                    
                if($update_system_code == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_system_code;
                }
            }
            else{
                $insert_system_code = $api->insert_system_code($system_type, $system_code, $system_description, $username);
                        
                if($insert_system_code == 1){
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

                if($login_bg_upload == 1){
                    $logo_light_upload = $api->check_user_interface_upload($_FILES['logo_light'], 'logo light', $setting_id, $username);

                    if($logo_light_upload == 1){
                        $logo_dark_upload = $api->check_user_interface_upload($_FILES['logo_dark'], 'logo dark', $setting_id, $username);

                        if($logo_dark_upload == 1){
                            $logo_icon_light_upload = $api->check_user_interface_upload($_FILES['login_icon_light'], 'logo icon light', $setting_id, $username);

                            if($logo_icon_light_upload == 1){
                                $logo_icon_dark_upload = $api->check_user_interface_upload($_FILES['login_icon_dark'], 'logo icon dark', $setting_id, $username);

                                if($logo_icon_dark_upload == 1){
                                    $favicon_upload = $api->check_user_interface_upload($_FILES['favicon_image'], 'favicon image', $setting_id, $username);

                                    if($favicon_upload == 1){
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

                if($insert_user_interface_settings == 1){
                    $login_bg_upload = $api->check_user_interface_upload($_FILES['login_bg'], 'login background', $setting_id, $username);

                    if($login_bg_upload == 1){
                        $logo_light_upload = $api->check_user_interface_upload($_FILES['logo_light'], 'logo light', $setting_id, $username);
    
                        if($logo_light_upload == 1){
                            $logo_dark_upload = $api->check_user_interface_upload($_FILES['logo_dark'], 'logo dark', $setting_id, $username);
    
                            if($logo_dark_upload == 1){
                                $logo_icon_light_upload = $api->check_user_interface_upload($_FILES['login_icon_light'], 'logo icon light', $setting_id, $username);
    
                                if($logo_icon_light_upload == 1){
                                    $logo_icon_dark_upload = $api->check_user_interface_upload($_FILES['login_icon_dark'], 'logo icon dark', $setting_id, $username);
    
                                    if($logo_icon_dark_upload == 1){
                                        $favicon_upload = $api->check_user_interface_upload($_FILES['favicon_image'], 'favicon image', $setting_id, $username);
    
                                        if($favicon_upload == 1){
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

                if($update_email_configuration == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_email_configuration;
                }
            }
            else{
                $insert_email_configuration = $api->insert_email_configuration($mail_id, $mail_host, $port, $smtp_auth, $smtp_auto_tls, $mail_user, $mail_password, $mail_encryption, $mail_from_name, $mail_from_email, $username);

                if($insert_email_configuration == 1){
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

                if($update_notification_type == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_notification_type;
                }
            }
            else{
                $insert_notification_type = $api->insert_notification_type($notification, $description, $username);

                if($insert_notification_type == 1){
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

                if($update_notification_details == 1){
                    $delete_notification_recipient = $api->delete_notification_recipient($notification_id);

                    if($delete_notification_recipient == 1){
                        foreach($notification_recipients as $notification_recipient){
                            $insert_notification_recipient = $api->insert_notification_recipient($notification_id, $notification_recipient, $username);
    
                            if($insert_notification_recipient != 1){
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

                if($insert_notification_details == 1){
                    foreach($notification_recipients as $notification_recipient){
                        $insert_notification_recipient = $api->insert_notification_recipient($notification_id, $notification_recipient, $username);

                        if($insert_notification_recipient != 1){
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

            if($delete_all_application_notification == 1){
                foreach($notifications as $notification){            
                    $notification_string = explode('-', $notification);
                    $notification_id = $notification_string[0];
                    $notification_type = $notification_string[1];

                    $insert_application_notification = $api->insert_application_notification($notification_id, $notification_type, $username);

                    if($insert_application_notification != 1){
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

            $check_company_setting_exist = $api->check_company_setting_exist($company_id);

            if($check_company_setting_exist > 0){
                $update_company_setting = $api->update_company_setting($company_id, $company_name, $email, $telephone, $phone, $website, $address, $province, $city, $username);

                if($update_company_setting == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_company_setting;
                }
            }
            else{
                $insert_company_setting = $api->insert_company_setting($company_id, $company_name, $email, $telephone, $phone, $website, $address, $province, $city, $username);

                if($insert_company_setting == 1){
                    echo 'Updated';
                }
                else{
                    echo $insert_company_setting;
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

                if($update_department == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_department;
                }
            }
            else{
                $insert_department = $api->insert_department($department, $description, $department_head, $parent_department, $username);

                if($insert_department == 1){
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
        
                                if($update_designation_file == 1){
                                    $update_designation = $api->update_designation($designation_id, $designation, $description, $username);

                                    if($update_designation == 1){
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

                    if($update_designation == 1){
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

                                if($insert_designation == 1){
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

                    if($insert_designation == 1){
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

                if($update_branch == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_branch;
                }
            }
            else{
                $insert_branch = $api->insert_branch($branch, $email, $phone, $telephone, $address, $username);

                if($insert_branch == 1){
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

                if($update_upload_setting == 1){
                    $delete_all_upload_file_type = $api->delete_all_upload_file_type($upload_setting_id, $username);

                    if($delete_all_upload_file_type == 1){
                        foreach($file_types as $file_type){
                            $insert_upload_file_type = $api->insert_upload_file_type($upload_setting_id, $file_type, $username);

                            if($insert_upload_file_type != 1){
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

                if($insert_upload_setting == 1){
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

                if($update_employment_status == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_employment_status;
                }
            }
            else{
                $insert_employment_status = $api->insert_employment_status($employment_status, $color_value, $description, $username);

                if($insert_employment_status == 1){
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
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['employee_id']) && isset($_POST['id_number']) && !empty($_POST['id_number']) && isset($_POST['joining_date']) && !empty($_POST['joining_date']) && isset($_POST['permanency_date']) && isset($_POST['exit_date']) && isset($_POST['first_name']) && !empty($_POST['first_name']) && isset($_POST['middle_name']) && isset($_POST['last_name']) && !empty($_POST['last_name']) && isset($_POST['department']) && !empty($_POST['department']) && isset($_POST['designation']) && !empty($_POST['designation']) && isset($_POST['branch']) && !empty($_POST['branch']) && isset($_POST['employment_status']) && !empty($_POST['employment_status']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['phone']) && isset($_POST['telephone']) && isset($_POST['gender']) && !empty($_POST['gender']) && isset($_POST['birthday']) && !empty($_POST['birthday'])){
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

                if($update_employee == 1){
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

                    if($insert_employee == 1){
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

                if($update_emergency_contact == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_emergency_contact;
                }
            }
            else{
                $insert_emergency_contact = $api->insert_emergency_contact($employee_id, $contact_name, $relationship, $email, $phone, $telephone, $address, $city, $province, $username);

                if($insert_emergency_contact == 1){
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

                if($update_employee_address == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_employee_address;
                }
            }
            else{
                $insert_employee_address = $api->insert_employee_address($employee_id, $address_type, $address, $city, $province, $username);

                if($insert_employee_address == 1){
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

                if($update_employee_social == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_employee_social;
                }
            }
            else{
                $insert_employee_social = $api->insert_employee_social($employee_id, $social_type, $link, $username);

                if($insert_employee_social == 1){
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

                if($update_work_shift == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_work_shift;
                }
            }
            else{
                $insert_work_shift = $api->insert_work_shift($work_shift, $work_shift_type, $description, $username);

                if($insert_work_shift == 1){
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

                if($update_work_shift_schedule == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_work_shift_schedule;
                }
            }
            else{
                $insert_work_shift_schedule = $api->insert_work_shift_schedule($work_shift_id, null, null, $monday_start_time, $monday_end_time, $monday_lunch_start_time, $monday_lunch_end_time, $monday_half_day_mark, $tuesday_start_time, $tuesday_end_time, $tuesday_lunch_start_time, $tuesday_lunch_end_time, $tuesday_half_day_mark, $wednesday_start_time, $wednesday_end_time, $wednesday_lunch_start_time, $wednesday_lunch_end_time, $wednesday_half_day_mark, $thursday_start_time, $thursday_end_time, $thursday_lunch_start_time, $thursday_lunch_end_time, $thursday_half_day_mark, $friday_start_time, $friday_end_time, $friday_lunch_start_time, $friday_lunch_end_time, $friday_half_day_mark, $saturday_start_time, $saturday_end_time, $saturday_lunch_start_time, $saturday_lunch_end_time, $saturday_half_day_mark, $sunday_start_time, $sunday_end_time, $sunday_lunch_start_time, $sunday_lunch_end_time, $sunday_half_day_mark, $username);

                if($insert_work_shift_schedule == 1){
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

                if($update_work_shift_schedule == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_work_shift_schedule;
                }
            }
            else{
                $insert_work_shift_schedule = $api->insert_work_shift_schedule($work_shift_id, $start_date, $end_date, $monday_start_time, $monday_end_time, $monday_lunch_start_time, $monday_lunch_end_time, $monday_half_day_mark, $tuesday_start_time, $tuesday_end_time, $tuesday_lunch_start_time, $tuesday_lunch_end_time, $tuesday_half_day_mark, $wednesday_start_time, $wednesday_end_time, $wednesday_lunch_start_time, $wednesday_lunch_end_time, $wednesday_half_day_mark, $thursday_start_time, $thursday_end_time, $thursday_lunch_start_time, $thursday_lunch_end_time, $thursday_half_day_mark, $friday_start_time, $friday_end_time, $friday_lunch_start_time, $friday_lunch_end_time, $friday_half_day_mark, $saturday_start_time, $saturday_end_time, $saturday_lunch_start_time, $saturday_lunch_end_time, $saturday_half_day_mark, $sunday_start_time, $sunday_end_time, $sunday_lunch_start_time, $sunday_lunch_end_time, $sunday_half_day_mark, $username);

                if($insert_work_shift_schedule == 1){
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

                if($delete_employee_work_shift == 1){
                    foreach($employees as $employee){
                        $delete_employee_work_shift_assignment = $api->delete_employee_work_shift_assignment($employee, $username);

                        if($delete_employee_work_shift_assignment == 1){
                            $insert_employee_work_shift = $api->insert_employee_work_shift($work_shift_id, $employee, $username);

                            if($insert_employee_work_shift != 1){
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

                            if($update_manual_employee_attendance == 1){
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

                        if($update_manual_employee_attendance == 1){
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

                        if($insert_manual_employee_attendance == 1){
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

                if($update_leave_type == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_leave_type;
                }
            }
            else{
                $insert_leave_type = $api->insert_leave_type($leave_name, $description, $no_leaves, $paid_status, $username);

                if($insert_leave_type == 1){
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
                $leave_overlap = $api->check_leave_overlap('', $start_date, $end_date, $employee, $leave_type);

                if($leave_overlap == 0){
                    $insert_leave = $api->insert_leave($employee, $leave_type, $no_leaves, $start_date, $end_date, $username);

                    if($insert_leave != 1){
                        $error = $insert_leave;
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
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_id']) && isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['leave_type']) && !empty($_POST['leave_type']) && isset($_POST['no_leaves']) && !empty($_POST['no_leaves']) && isset($_POST['start_date']) && !empty($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['end_date'])){
            $error = '';
            $username = $_POST['username'];
            $leave_id = $_POST['leave_id'];
            $employee_id = $_POST['employee_id'];
            $leave_type = $_POST['leave_type'];
            $no_leaves = $_POST['no_leaves'];
            $start_date = $api->check_date('empty', $_POST['start_date'], '', 'Y-m-d', '', '', '');
            $end_date = $api->check_date('empty', $_POST['end_date'], '', 'Y-m-d', '', '', '');

            $check_leave_exist = $api->check_leave_exist($leave_id);

            if($check_leave_exist > 0){
                $leave_details = $api->get_leave_details($leave_id);
                $leave_start_date = $leave_details[0]['START_DATE'];
                $leave_end_date = $leave_details[0]['END_DATE'];

                if(strtotime($leave_start_date) != strtotime($start_date) || strtotime($leave_end_date) != strtotime($end_date)){
                    if(strtotime($leave_start_date) != strtotime($start_date)){
                        $start_date_overlap = $api->check_leave_overlap($leave_id, $start_date, $employee_id, $leave_type);
                    }
                    else{
                        $start_date_overlap = 0;
                    }

                    if(strtotime($leave_end_date) != strtotime($end_date)){
                        $end_date_overlap = $api->check_leave_overlap($leave_id, $end_date, $employee_id, $leave_type);
                    }
                    else{
                        $start_date_overlap = 0;
                    }

                    if($start_date_overlap == 0 && $end_date_overlap == 0){
                        $update_leave = $api->update_leave($leave_id, $no_leaves, $start_date, $end_date, $username);

                        if($update_leave == 1){
                            echo 'Updated';
                        }
                        else{
                            echo $update_leave;
                        }
                    }
                    else{
                        echo 'Overlap';
                    }
                }
                else{
                    $update_leave = $api->update_leave($leave_id, $no_leaves, $start_date, $end_date, $username);

                    if($update_leave == 1){
                        echo 'Updated';
                    }
                    else{
                        echo $update_leave;
                    }
                }
            }
            else{
                $start_date_overlap = $api->check_leave_overlap('', $start_date, $employee_id, $leave_type);
                $end_date_overlap = $api->check_leave_overlap('', $end_date, $employee_id, $leave_type);

                if($start_date_overlap == 0 && $end_date_overlap == 0){
                    $insert_leave = $api->insert_leave($employee_id, $leave_type, $no_leaves, $start_date, $end_date, $username);

                    if($insert_leave == 1){
                        echo 'Updated';
                    }
                    else{
                        echo $insert_leave;
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
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_id']) && isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['leave_type']) && !empty($_POST['leave_type']) && isset($_POST['no_leaves']) && !empty($_POST['no_leaves']) && isset($_POST['start_date']) && !empty($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['end_date'])){
            $error = '';
            $username = $_POST['username'];
            $leave_id = $_POST['leave_id'];
            $employee_id = $_POST['employee_id'];
            $leave_type = $_POST['leave_type'];
            $no_leaves = $_POST['no_leaves'];
            $start_date = $api->check_date('empty', $_POST['start_date'], '', 'Y-m-d', '', '', '');
            $end_date = $api->check_date('empty', $_POST['end_date'], '', 'Y-m-d', '', '', '');

            $check_leave_exist = $api->check_leave_exist($leave_id);

            if($check_leave_exist > 0){
                $leave_details = $api->get_leave_details($leave_id);
                $leave_start_date = $leave_details[0]['START_DATE'];
                $leave_end_date = $leave_details[0]['END_DATE'];

                if(strtotime($leave_start_date) != strtotime($start_date) || strtotime($leave_end_date) != strtotime($end_date)){
                    $leave_overlap = $api->check_leave_overlap($leave_id, $start_date, $end_date, $employee_id, $leave_type);

                    if($leave_overlap == 0){
                        $update_leave = $api->update_leave($leave_id, $no_leaves, $start_date, $end_date, $username);

                        if($update_leave == 1){
                            echo 'Updated';
                        }
                        else{
                            echo $update_leave;
                        }
                    }
                    else{
                        echo 'Overlap';
                    }
                }
                else{
                    $update_leave = $api->update_leave($leave_id, $no_leaves, $start_date, $end_date, $username);

                    if($update_leave == 1){
                        echo 'Updated';
                    }
                    else{
                        echo $update_leave;
                    }
                }
            }
            else{
                $leave_overlap = $api->check_leave_overlap('', $start_date, $end_date, $employee_id, $leave_type);

                if($leave_overlap == 0){
                    $insert_leave = $api->insert_leave($employee_id, $leave_type, $no_leaves, $start_date, $end_date, $username);

                    if($insert_leave == 1){
                        echo 'Inserted';
                    }
                    else{
                        echo $insert_leave;
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
                
                $get_available_leave = $api->get_available_leave($employee_id, $leave_type, $leave_date);

                if($get_available_leave > 0){
                    $insert_leave = $api->insert_leave($employee_id, $leave_type, $leave_date, $start_time, $end_time, $leave_status, $reason, $decision_date, $decision_time, $decision_by, $username);

                    if($insert_leave == 1){
                        $update_leave_count = $api->update_leave_count($employee_id, $leave_type, $leave_date, $total_hours, $username);

                        if($update_leave_count != 1){
                            $error = $update_leave_count;
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
        
                                if($update_employee_file == 1){
                                    $update_employee_file_details = $api->update_employee_file_details($file_id, $file_name, $file_category, $remarks, $file_date, $username);

                                    if($update_employee_file_details == 1){
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

                    if($update_employee_file_details == 1){
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

                            if($insert_employee_file == 1){
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

                if($update_user_account == 1){
                    $delete_all_role_users = $api->delete_all_user_role($user_code);

                    if($delete_all_role_users == 1){
                        foreach($roles as $role){
                            $insert_user_role = $api->insert_user_role($user_code, $role, $username);

                            if($insert_user_role != 1){
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

                if($insert_user_account == 1){
                    foreach($roles as $role){
                        $insert_user_role = $api->insert_user_role($user_code, $role, $username);

                        if($insert_user_role != 1){
                            $error = $insert_user_role;
                        }
                    }

                    if(empty($error)){
                        if(!empty($employee_id)){
                            $update_employee_user_account = $api->update_employee_user_account($employee_id, $user_code, $username);

                            if($update_employee_user_account == 1){
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

                if($update_user_account == 1){
                    $delete_all_role_users = $api->delete_all_user_role($user_code);

                    if($delete_all_role_users == 1){
                        foreach($roles as $role){
                            $insert_user_role = $api->insert_user_role($user_code, $role, $username);

                            if($insert_user_role != 1){
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

                if($update_holiday == 1){
                    $delete_all_holiday_branch = $api->delete_all_holiday_branch($holiday_id);

                    if($delete_all_holiday_branch == 1){
                        foreach($branches as $branch){
                            $insert_holiday_branch = $api->insert_holiday_branch($holiday_id, $branch, $username);

                            if($insert_holiday_branch != 1){
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

                if($insert_holiday == 1){
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
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['maximum_attendance']) && !empty($_POST['maximum_attendance']) && isset($_POST['time_out_allowance']) && !empty($_POST['time_out_allowance'])  && isset($_POST['late_allowance']) && isset($_POST['late_policy']) && isset($_POST['early_leaving_policy']) && isset($_POST['attendance_creation_approval']) && isset($_POST['attendance_adjustment_approval'])){
            $error = '';
            $username = $_POST['username'];
            $setting_id = 1;
            $maximum_attendance = $_POST['maximum_attendance'];
            $time_out_allowance = $_POST['time_out_allowance'];
            $late_allowance = $_POST['late_allowance'];
            $late_policy = $_POST['late_policy'];
            $early_leaving_policy = $_POST['early_leaving_policy'];
            $attendance_creation_recommendation = $_POST['attendance_creation_recommendation'] ?? 0;
            $attendance_adjustment_recommendation = $_POST['attendance_adjustment_recommendation'] ?? 0;
            $attendance_creation_approvals = explode(',', $_POST['attendance_creation_approval']);
            $attendance_adjustment_approvals = explode(',', $_POST['attendance_adjustment_approval']);

            $check_attendance_setting_exist = $api->check_attendance_setting_exist($setting_id);

            if($check_attendance_setting_exist > 0){
                $update_attendance_setting = $api->update_attendance_setting($setting_id, $maximum_attendance, $time_out_allowance, $late_allowance, $late_policy, $early_leaving_policy, $attendance_creation_recommendation, $attendance_adjustment_recommendation, $username);

                if($update_attendance_setting == 1){
                    $delete_attendance_creation_approval = $api->delete_attendance_creation_approval();

                    if($delete_attendance_creation_approval == 1){
                        foreach($attendance_creation_approvals as $attendance_creation_approval){
                            $insert_attendance_creation_approval = $api->insert_attendance_creation_approval($attendance_creation_approval, $username);

                            if($insert_attendance_creation_approval != 1){
                                $error = $insert_attendance_creation_approval;
                            }
                        }
                    }
                    else{
                        $error = $delete_attendance_creation_approval;
                    }

                    $delete_attendance_adjustment_approval = $api->delete_attendance_adjustment_approval();

                    if($delete_attendance_adjustment_approval == 1){
                        foreach($attendance_adjustment_approvals as $attendance_adjustment_approval){
                            $insert_attendance_adjustment_approval = $api->insert_attendance_adjustment_approval($attendance_adjustment_approval, $username);

                            if($insert_attendance_adjustment_approval != 1){
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
                $insert_attendance_setting = $api->insert_attendance_setting($setting_id, $maximum_attendance, $time_out_allowance, $late_allowance, $late_policy, $early_leaving_policy, $attendance_creation_recommendation, $attendance_adjustment_recommendation, $username);

                if($insert_attendance_setting == 1){
                    foreach($attendance_adjustment_approvals as $attendance_adjustment_approval){
                        $insert_attendance_creation_approval = $api->insert_attendance_creation_approval($attendance_adjustment_approval, $username);

                        if($insert_attendance_creation_approval != 1){
                            $error = $insert_attendance_creation_approval;
                        }
                    }

                    foreach($attendance_adjustment_approvals as $attendance_adjustment_approval){
                        $insert_attendance_adjustment_approval = $api->insert_attendance_adjustment_approval($attendance_adjustment_approval, $username);

                        if($insert_attendance_adjustment_approval != 1){
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

                        if($send_notification == 1){
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

                        if($send_notification == 1){
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

                        if($send_notification == 1){
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

                        if($send_notification == 1){
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

                if($insert_health_declaration == 1){
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

                                if($send_notification == 1){
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

                                if($send_notification == 1){
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

                            if($send_notification == 1){
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

                            if($send_notification == 1){
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

                if($insert_location == 1){
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
            
                                    if($update_attendance_creation_file == 1){
                                        $update_attendance_creation = $api->update_attendance_creation($request_id, $time_in_date, $time_in, $time_out_date, $time_out, $reason, $username);

                                        if($update_attendance_creation == 1){
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

                        if($update_attendance_creation == 1){
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

                                if($insert_attendance_creation == 1){
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
            $time_in_default = $api->check_date('empty', $get_employee_attendance_details[0]['TIME_IN'], '', 'H:i:s', '', '', '');
            $time_out_date_default = $api->check_date('empty', $get_employee_attendance_details[0]['TIME_OUT_DATE'], '', 'Y-m-d', '', '', '');
            $time_out_default = $api->check_date('empty', $get_employee_attendance_details[0]['TIME_OUT'], '', 'H:i:s', '', '', '');

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

                            if($insert_attendance_adjustment == 1){
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
        
                                    if($update_attendance_adjustment == 1){
                                        $update_attendance_adjustment_file = $api->update_attendance_adjustment_file($attendance_adjustment_file_tmp_name, $attendance_adjustment_file_actual_ext, $request_id, $username);
                
                                        if($update_attendance_adjustment_file == 1){
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
        
                        if($update_attendance_adjustment == 1){
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
                
                $get_available_leave = $api->get_available_leave($employee_id, $leave_type, $leave_date);

                if($get_available_leave > 0){
                    $insert_leave = $api->insert_leave($employee_id, $leave_type, $leave_date, $start_time, $end_time, 'PEN', $reason, null, null, null, $username);

                    if($insert_leave == 1){
                        $update_leave_count = $api->update_leave_count($employee_id, $leave_type, $leave_date, $total_hours, $username);

                        if($update_leave_count != 1){
                            $error = $update_leave_count;
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
    
                if($send_notification == 1){
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

                if($update_allowance_type == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_allowance_type;
                }
            }
            else{
                $insert_allowance_type = $api->insert_allowance_type($allowance_type, $taxable, $description, $username);

                if($insert_allowance_type == 1){
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
    
                        if($insert_allowance != 1){
                            $error = $insert_allowance;
                        }
                    }
                }
                else{
                    $insert_allowance = $api->insert_allowance($employee_id, $allowance_type, $start_date, $amount, $username);

                    if($insert_allowance != '1'){
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

                if($update_allowance == 1){
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

                if($update_deduction_type == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_deduction_type;
                }
            }
            else{
                $insert_deduction_type = $api->insert_deduction_type($deduction_type, $description, $username);

                if($insert_deduction_type == 1){
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

                if($update_government_contribution == 1){
                    echo 'Updated';
                }
                else{
                    echo $update_government_contribution;
                }
            }
            else{
                $insert_government_contribution = $api->insert_government_contribution($government_contribution, $description, $username);

                if($insert_government_contribution == 1){
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

                    if($update_contribution_bracket == 1){
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

                    if($insert_contribution_bracket == 1){
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
    
                        if($insert_deduction != 1){
                            $error = $insert_deduction;
                        }
                    }
                }
                else{
                    $insert_deduction = $api->insert_deduction($employee_id, $deduction_type, $start_date, $amount, $username);

                    if($insert_deduction != '1'){
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

                if($update_deduction == 1){
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
    
                        if($insert_contribution_deduction != 1){
                            $error = $insert_contribution_deduction;
                        }
                    }
                }
                else{
                    $insert_contribution_deduction = $api->insert_contribution_deduction($employee_id, $government_contribution, $start_date, $username);

                    if($insert_contribution_deduction != '1'){
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

                if($update_contribution_deduction == 1){
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
                                    
                if($delete_system_parameter == 1){
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
                                        
                    if($delete_system_parameter != 1){
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
                                    
                if($delete_all_permission == 1){
                    $delete_policy = $api->delete_policy($policy_id, $username);
                                    
                    if($delete_policy == 1){
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
                                    
                    if($delete_policy == 1){
                        $delete_all_permission = $api->delete_all_permission($policy_id, $username);
                                        
                        if($delete_all_permission != 1){
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
                                    
                if($delete_permission == 1){
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
                                        
                    if($delete_permission != 1){
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
                                    
                if($delete_role == 1){
                    $delete_permission_role = $api->delete_permission_role($role_id, $username);
                                    
                    if($delete_permission_role == 1){
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
                                    
                    if($delete_role == 1){
                        $delete_permission_role = $api->delete_permission_role($role_id, $username);
                                        
                        if($delete_permission_role != 1){
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
                                    
                if($delete_system_code == 1){
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
                                        
                    if($delete_system_code != 1){
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
                                    
                if($delete_notification_type == 1){
                    $delete_notification_details = $api->delete_notification_details($notification_id, $username);
                                    
                    if($delete_notification_details == 1){
                        $delete_notification_recipient = $api->delete_notification_recipient($notification_id, $username);
                                    
                        if($delete_notification_recipient == 1){
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
                                    
                    if($delete_notification_type != 1){
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
                                    
                if($delete_department == 1){
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
                                    
                    if($delete_department != 1){
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
                                    
                if($delete_designation == 1){
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
                                    
                    if($delete_designation != 1){
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
                                    
                if($delete_branch == 1){
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
                                    
                    if($delete_branch != 1){
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
                                    
                if($delete_upload_setting == 1){
                    $delete_all_upload_file_type = $api->delete_all_upload_file_type($upload_setting_id, $username);
                                    
                    if($delete_all_upload_file_type == 1){
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
                                    
                    if($delete_upload_setting == 1){
                        $delete_all_upload_file_type = $api->delete_all_upload_file_type($upload_setting_id, $username);
                                    
                        if($delete_all_upload_file_type != 1){
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
                                    
                if($delete_employment_status == 1){
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

                    if($delete_employment_status != 1){
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
                                    
                if($delete_employee == 1){
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
                                    
                    if($delete_employee != 1){
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
                                    
                if($delete_emergency_contact == 1){
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
                                    
                if($delete_employee_address == 1){
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
                                    
                if($delete_employee_social == 1){
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
                                    
                if($delete_work_shift == 1){
                    $delete_work_shift_schedule = $api->delete_work_shift_schedule($work_shift_id, $username);
                                    
                    if($delete_work_shift_schedule == 1){
                        $delete_employee_work_shift = $api->delete_employee_work_shift($work_shift_id, $username);
                                    
                        if($delete_employee_work_shift == 1){
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
                                    
                    if($delete_work_shift == 1){
                        $delete_work_shift_schedule = $api->delete_work_shift_schedule($work_shift_id, $username);
                                    
                        if($delete_work_shift_schedule == 1){
                            $delete_employee_work_shift = $api->delete_employee_work_shift($work_shift_id, $username);
                                    
                            if($delete_employee_work_shift != 1){
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
                                    
                if($delete_employee_attendance == 1){
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
                                    
                if($delete_leave_type == 1){
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
                                    
                    if($delete_leave_type != 1){
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
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_id']) && !empty($_POST['leave_id'])){
            $username = $_POST['username'];
            $leave_id = $_POST['leave_id'];

            $check_leave_exist = $api->check_leave_exist($leave_id);

            if($check_leave_exist > 0){
                $delete_leave = $api->delete_leave($leave_id, $username);
                                    
                if($delete_leave == 1){
                    echo 'Deleted';
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

    # Delete multiple leave entitlement
    else if($transaction == 'delete multiple leave entitlement'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['leave_id'])){
            $username = $_POST['username'];
            $leave_ids = $_POST['leave_id'];

            foreach($leave_ids as $leave_id){
                $check_leave_exist = $api->check_leave_exist($leave_id);

                if($check_leave_exist > 0){
                    $delete_leave = $api->delete_leave($leave_id, $username);
                                    
                    if($delete_leave != 1){
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
                                    
                if($delete_leave == 1){
                    $update_leave_count = $api->update_leave_count($employee_id, $leave_type, $leave_date, $total_hours, $username);

                    if($update_leave_count == 1){
                        echo 'Deleted';
                    }
                    else{
                        echo $update_leave_count;
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
                                    
                    if($delete_leave == 1){
                        $update_leave_count = $api->update_leave_count($employee_id, $leave_type, $leave_date, $total_hours, $username);

                        if($update_leave_count != 1){
                            $error = $update_leave_count;
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
                                    
                if($delete_employee_file == 1){
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
                                    
                    if($delete_employee_file != 1){
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
                                    
                if($delete_holiday == 1){
                    $delete_all_holiday_branch = $api->delete_all_holiday_branch($holiday_id);

                    if($delete_all_holiday_branch == 1){
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
                                    
                    if($delete_holiday == 1){
                        $delete_all_holiday_branch = $api->delete_all_holiday_branch($holiday_id);

                        if($delete_all_holiday_branch != 1){
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
                                    
                if($delete_attendance_creation == 1){
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
                                    
                    if($delete_attendance_creation != 1){
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

            if($check_department_exist > 0){
                $delete_allowance_type = $api->delete_allowance_type($allowance_type_id, $username);
                                    
                if($delete_allowance_type == 1){
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
                                    
                    if($delete_allowance_type != 1){
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
                                    
                if($delete_allowance == 1){
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
                                    
                    if($delete_allowance != 1){
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

    # Delete deduction type
    else if($transaction == 'delete deduction type'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['deduction_type_id']) && !empty($_POST['deduction_type_id'])){
            $username = $_POST['username'];
            $deduction_type_id = $_POST['deduction_type_id'];

            $check_deduction_type_exist = $api->check_deduction_type_exist($deduction_type_id);

            if($check_department_exist > 0){
                $delete_deduction_type = $api->delete_deduction_type($deduction_type_id, $username);
                                    
                if($delete_deduction_type == 1){
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
                                    
                    if($delete_deduction_type != 1){
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
                                    
                if($delete_government_contribution == 1){
                    $delete_all_contribution_bracket = $api->delete_all_contribution_bracket($government_contribution_id, $username);
                                    
                    if($delete_all_contribution_bracket == 1){
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
                                    
                    if($delete_government_contribution == 1){
                        
                        $delete_all_contribution_bracket = $api->delete_all_contribution_bracket($government_contribution_id, $username);
                                    
                        if($delete_all_contribution_bracket != 1){
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
                                    
                if($delete_contribution_bracket == 1){
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
                                    
                    if($delete_contribution_bracket != 1){
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
                                    
                if($delete_deduction == 1){
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
                                    
                    if($delete_deduction != 1){
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
                                    
                if($delete_contribution_deduction_exist == 1){
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
                                    
                    if($delete_contribution_deduction_exist != 1){
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
    
                    if($update_leave_status == 1){
                        $from_details = $api->get_leave_details($leave_id);
                        $from_id = $from_details[0]['DECISION_BY'];
                        $from_details = $api->get_employee_details('', $from_id);
                        $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                        $notification_details = $api->get_notification_details(16);
                        $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                
                        $send_notification = $api->send_notification(16, $from_id, $employee_id, $notification_title, $notification_message, $username);

                        if($send_notification == 1){
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
        
                        if($update_leave_status == 1){
                            $from_details = $api->get_leave_details($leave_id);
                            $from_id = $from_details[0]['DECISION_BY'];
                            $from_details = $api->get_employee_details('', $from_id);
                            $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                            $notification_details = $api->get_notification_details(16);
                            $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                            $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                            $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                        
                            $send_notification = $api->send_notification(16, $from_id, $employee_id, $notification_title, $notification_message, $username);

                            if($send_notification != 1){
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
                if($error_count == 1){
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
    
                if($update_leave_status == 1){
                    $from_details = $api->get_leave_details($leave_id);
                    $from_id = $from_details[0]['DECISION_BY'];
                    $from_details = $api->get_employee_details('', $from_id);
                    $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                    $notification_details = $api->get_notification_details(16);
                    $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                    $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                    $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                
                    $send_notification = $api->send_notification(16, $from_id, $attendance_adjustment_employee_id, $notification_title, $notification_message, $username);

                    if($send_notification == 1){
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

                        if($insert_manual_employee_attendance == 1){
                            $update_attendance_creation_status = $api->update_attendance_creation_status($request_id, 'APV', $decision_remarks, $sanction, $username);
    
                            if($update_attendance_creation_status == 1){
                                $from_details = $api->get_attendance_creation_details($request_id);
                                $from_id = $from_details[0]['DECISION_BY'];
                                $from_details = $api->get_employee_details('', $from_id);
                                $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                                $notification_details = $api->get_notification_details(13);
                                $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                                $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                                $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                            
                                $send_notification = $api->send_notification(13, $from_id, $attendance_creation_employee_id, $notification_title, $notification_message, $username);

                                if($send_notification == 1){
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

                            if($insert_manual_employee_attendance == 1){
                                $update_attendance_creation_status = $api->update_attendance_creation_status($request_id, 'APV', $decision_remarks, $sanction, $username);
        
                                if($update_attendance_creation_status == 1){
                                    $from_details = $api->get_attendance_creation_details($request_id);
                                    $from_id = $from_details[0]['DECISION_BY'];
                                    $from_details = $api->get_employee_details('', $from_id);
                                    $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                                    $notification_details = $api->get_notification_details(13);
                                    $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                                    $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                                    $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                
                                    $send_notification = $api->send_notification(13, $from_id, $attendance_creation_employee_id, $notification_title, $notification_message, $username);

                                    if($send_notification != 1){
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
                if($error_count == 1){
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

                                if($update_manual_employee_attendance == 1){
                                    $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'APV', $decision_remarks, $sanction, $username);
    
                                    if($update_attendance_adjustment_status == 1){
                                        $from_details = $api->get_attendance_adjustment_details($request_id);
                                        $from_id = $from_details[0]['DECISION_BY'];
                                        $from_details = $api->get_employee_details('', $from_id);
                                        $from_file_as = $from_details[0]['FILE_AS'] ?? null;
    
                                        $notification_details = $api->get_notification_details(14);
                                        $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                                        $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                                        $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                    
                                        $send_notification = $api->send_notification(14, $from_id, $attendance_adjustment_employee_id, $notification_title, $notification_message, $username);
    
                                        if($send_notification == 1){
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

                            if($update_manual_employee_attendance == 1){
                                $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'APV', $decision_remarks, $sanction, $username);
    
                                if($update_attendance_adjustment_status == 1){
                                    $from_details = $api->get_attendance_adjustment_details($request_id);
                                    $from_id = $from_details[0]['DECISION_BY'];
                                    $from_details = $api->get_employee_details('', $from_id);
                                    $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                                    $notification_details = $api->get_notification_details(14);
                                    $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                                    $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                                    $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                
                                    $send_notification = $api->send_notification(14, $from_id, $attendance_adjustment_employee_id, $notification_title, $notification_message, $username);

                                    if($send_notification == 1){
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
    
                                    if($update_manual_employee_attendance == 1){
                                        $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'APV', $decision_remarks, $sanction, $username);
        
                                        if($update_attendance_adjustment_status == 1){
                                            $from_details = $api->get_attendance_adjustment_details($request_id);
                                            $from_id = $from_details[0]['DECISION_BY'];
                                            $from_details = $api->get_employee_details('', $from_id);
                                            $from_file_as = $from_details[0]['FILE_AS'] ?? null;
        
                                            $notification_details = $api->get_notification_details(14);
                                            $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                                            $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                                            $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                        
                                            $send_notification = $api->send_notification(14, $from_id, $attendance_adjustment_employee_id, $notification_title, $notification_message, $username);
        
                                            if($send_notification != 1){
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
    
                                if($update_manual_employee_attendance == 1){
                                    $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'APV', $decision_remarks, $sanction, $username);
        
                                    if($update_attendance_adjustment_status == 1){
                                        $from_details = $api->get_attendance_adjustment_details($request_id);
                                        $from_id = $from_details[0]['DECISION_BY'];
                                        $from_details = $api->get_employee_details('', $from_id);
                                        $from_file_as = $from_details[0]['FILE_AS'] ?? null;
    
                                        $notification_details = $api->get_notification_details(14);
                                        $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                                        $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                                        $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                    
                                        $send_notification = $api->send_notification(14, $from_id, $attendance_adjustment_employee_id, $notification_title, $notification_message, $username);
    
                                        if($send_notification != 1){
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
                if($error_count == 1){
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
    
                if($update_leave_status == 1){
                    $update_leave_count = $api->update_leave_count($employee_id, $leave_type, $leave_date, $total_hours, $username);

                    if($update_leave_count == 1){
                        $from_details = $api->get_leave_details($leave_id);
                        $from_id = $from_details[0]['DECISION_BY'];
                        $from_details = $api->get_employee_details('', $from_id);
                        $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                        $notification_details = $api->get_notification_details(17);
                        $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                
                        $send_notification = $api->send_notification(17, $from_id, $employee_id, $notification_title, $notification_message, $username);

                        if($send_notification == 1){
                            echo 'Rejected';
                        }
                        else{
                            echo $send_notification;
                        }
                    }
                    else{
                        echo $update_leave_count;
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
        
                    if($update_leave_status == 1){
                        $update_leave_count = $api->update_leave_count($employee_id, $leave_type, $leave_date, $total_hours, $username);

                        if($update_leave_count == 1){
                            $from_details = $api->get_leave_details($leave_id);
                            $from_id = $from_details[0]['DECISION_BY'];
                            $from_details = $api->get_employee_details('', $from_id);
                            $from_file_as = $from_details[0]['FILE_AS'] ?? null;
    
                            $notification_details = $api->get_notification_details(17);
                            $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                            $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                            $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                    
                            $send_notification = $api->send_notification(17, $from_id, $employee_id, $notification_title, $notification_message, $username);
    
                            if($send_notification != 1){
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
                if($error_count == 1){
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
    
                if($update_attendance_creation_status == 1){
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

                    if($send_notification == 1){
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
        
                    if($update_attendance_creation_status == 1){
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

                        if($send_notification != 1){
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
                if($error_count == 1){
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
    
                if($update_attendance_adjustment_status == 1){
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

                    if($send_notification == 1){
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
        
                    if($update_attendance_adjustment_status == 1){
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

                        if($send_notification != 1){
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
                if($error_count == 1){
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
    
                if($update_leave_status == 1){
                    $update_leave_count = $api->update_leave_count($employee_id, $leave_type, $leave_date, $total_hours, $username);

                    if($update_leave_count == 1){
                        $from_details = $api->get_leave_details($leave_id);
                        $from_id = $from_details[0]['DECISION_BY'];
                        $from_details = $api->get_employee_details('', $from_id);
                        $from_file_as = $from_details[0]['FILE_AS'] ?? null;

                        $notification_details = $api->get_notification_details(18);
                        $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                
                        $send_notification = $api->send_notification(18, $from_id, $employee_id, $notification_title, $notification_message, $username);

                        if($send_notification == 1){
                            echo 'Cancelled';
                        }
                        else{
                            echo $send_notification;
                        }
                    }
                    else{
                        echo $update_leave_count;
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
        
                    if($update_leave_status == 1){
                        $update_leave_count = $api->update_leave_count($employee_id, $leave_type, $leave_date, $total_hours, $username);

                        if($update_leave_count == 1){
                            $from_details = $api->get_leave_details($leave_id);
                            $from_id = $from_details[0]['DECISION_BY'];
                            $from_details = $api->get_employee_details('', $from_id);
                            $from_file_as = $from_details[0]['FILE_AS'] ?? null;
    
                            $notification_details = $api->get_notification_details(18);
                            $notification_title = $notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                            $notification_message = $notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                            $notification_message = str_replace('{name}', $from_file_as, $notification_message);
                                    
                            $send_notification = $api->send_notification(18, $from_id, $employee_id, $notification_title, $notification_message, $username);
    
                            if($send_notification != 1){
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
                if($error_count == 1){
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
    
                if($update_attendance_creation_status == 1){
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

                    if($send_notification == 1){
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
        
                    if($update_attendance_creation_status == 1){
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

                        if($send_notification != 1){
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
                if($error_count == 1){
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
    
                if($update_attendance_adjustment_status == 1){
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

                    if($send_notification == 1){
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
        
                    if($update_attendance_adjustment_status == 1){
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

                        if($send_notification != 1){
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
                if($error_count == 1){
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
    
                if($update_user_account_lock_status == 1){
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
                                    
                    if($update_user_account_lock_status != 1){
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
    
                if($update_user_account_lock_status == 1){
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
                                    
                    if($update_user_account_lock_status != 1){
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
    
                if($update_user_account_status == 1){
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
                                    
                    if($update_user_account_status != 1){
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
    
                if($update_user_account_status == 1){
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
                                    
                    if($update_user_account_status != 1){
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

                if($attendance_creation_recommendation == 0 || ($attendance_creation_recommendation == 1 && $check_attendance_creation_recommendation_exception_exist > 0)){
                    $update_attendance_creation_status = $api->update_attendance_creation_status($request_id, 'REC', null, null, $username);
    
                    if($update_attendance_creation_status == 1){
                        $sent_to_notification_details = $api->get_notification_details(9);
                        $sent_to_notification_title = $sent_to_notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $sent_to_notification_message = $sent_to_notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $sent_to_notification_message = str_replace('{name}', $employee_file_as, $sent_to_notification_message);
    
                        $notification_recipient_details = $api->get_notification_recipient_details(9);
    
                        for($i = 0; $i < count($notification_recipient_details); $i++) {
                            $recipient = $notification_recipient_details[$i]['EMPLOYEE_ID'];
                
                            $send_notification = $api->send_notification(9, $employee_id, $recipient, $sent_to_notification_title, $sent_to_notification_message, $username);
    
                            if($send_notification != 1){
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
    
                    if($update_attendance_creation_status == 1){
                        $send_notification = $api->send_notification(3, $from_id, $department_head, $notification_title, $notification_message, $username);
    
                        if($send_notification == 1){
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

                    if($attendance_creation_recommendation == 0 || ($attendance_creation_recommendation == 1 && $check_attendance_creation_recommendation_exception_exist > 0)){
                        $update_attendance_creation_status = $api->update_attendance_creation_status($request_id, 'REC', null, null, $username);
        
                        if($update_attendance_creation_status == 1){
                            $sent_to_notification_details = $api->get_notification_details(9);
                            $sent_to_notification_title = $sent_to_notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                            $sent_to_notification_message = $sent_to_notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                            $sent_to_notification_message = str_replace('{name}', $employee_file_as, $sent_to_notification_message);
        
                            $notification_recipient_details = $api->get_notification_recipient_details(9);
        
                            for($i = 0; $i < count($notification_recipient_details); $i++) {
                                $recipient = $notification_recipient_details[$i]['EMPLOYEE_ID'];
                    
                                $send_notification = $api->send_notification(9, $employee_id, $recipient, $sent_to_notification_title, $sent_to_notification_message, $username);
        
                                if($send_notification != 1){
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
        
                        if($update_attendance_creation_status == 1){
                            $send_notification = $api->send_notification(3, $from_id, $department_head, $notification_title, $notification_message, $username);
    
                            if($send_notification != 1){
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
                if($attendance_creation_recommendation == 0 || ($attendance_creation_recommendation == 1 && $check_attendance_creation_recommendation_exception_exist > 0)){
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

                if($attendance_adjustment_recommendation == 0 || ($attendance_adjustment_recommendation == 1 && $check_attendance_creation_recommendation_exception_exist > 0)){
                    $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'REC', null, null, $username);
    
                    if($update_attendance_adjustment_status == 1){
                        $sent_to_notification_details = $api->get_notification_details(10);
                        $sent_to_notification_title = $sent_to_notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $sent_to_notification_message = $sent_to_notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $sent_to_notification_message = str_replace('{name}', $employee_file_as, $sent_to_notification_message);

                        $notification_recipient_details = $api->get_notification_recipient_details(10);

                        for($i = 0; $i < count($notification_recipient_details); $i++) {
                            $recipient = $notification_recipient_details[$i]['EMPLOYEE_ID'];
                
                            $send_notification = $api->send_notification(10, $employee_id, $recipient, $sent_to_notification_title, $sent_to_notification_message, $username);

                            if($send_notification != 1){
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
    
                    if($update_attendance_adjustment_status == 1){
                        $send_notification = $api->send_notification(4, $from_id, $department_head, $notification_title, $notification_message, $username);
    
                        if($send_notification == 1){
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

                    if($attendance_adjustment_recommendation == 0 || ($attendance_adjustment_recommendation == 1 && $check_attendance_creation_recommendation_exception_exist > 0)){
                        $update_attendance_adjustment_status = $api->update_attendance_adjustment_status($request_id, 'FRREC', null, null, $username);
            
                        if($update_attendance_adjustment_status == 1){
                            $sent_to_notification_details = $api->get_notification_details(10);
                            $sent_to_notification_title = $sent_to_notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                            $sent_to_notification_message = $sent_to_notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                            $sent_to_notification_message = str_replace('{name}', $employee_file_as, $sent_to_notification_message);
        
                            $notification_recipient_details = $api->get_notification_recipient_details(10);
        
                            for($i = 0; $i < count($notification_recipient_details); $i++) {
                                $recipient = $notification_recipient_details[$i]['EMPLOYEE_ID'];
                    
                                $send_notification = $api->send_notification(10, $employee_id, $recipient, $sent_to_notification_title, $sent_to_notification_message, $username);
        
                                if($send_notification != 1){
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
            
                        if($update_attendance_adjustment_status == 1){
                            $send_notification = $api->send_notification(4, $from_id, $department_head, $notification_title, $notification_message, $username);

                            if($send_notification != 1){
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
                if($attendance_adjustment_recommendation == 0 || ($attendance_adjustment_recommendation == 1 && $check_attendance_creation_recommendation_exception_exist > 0)){
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
    
                if($update_attendance_creation_status == 1){
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

                    if($send_notification == 1){
                        $sent_to_notification_details = $api->get_notification_details(9);
                        $sent_to_notification_title = $sent_to_notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $sent_to_notification_message = $sent_to_notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $sent_to_notification_message = str_replace('{name}', $employee_file_as, $sent_to_notification_message);

                        $notification_recipient_details = $api->get_notification_recipient_details(9);

                        for($i = 0; $i < count($notification_recipient_details); $i++) {
                            $recipient = $notification_recipient_details[$i]['EMPLOYEE_ID'];
                
                            $send_notification = $api->send_notification(9, $employee_id, $recipient, $sent_to_notification_title, $sent_to_notification_message, $username);

                            if($send_notification != 1){
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
        
                    if($update_attendance_creation_status == 1){
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

                        if($send_notification == 1){
                            $sent_to_notification_details = $api->get_notification_details(9);
                            $sent_to_notification_title = $sent_to_notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                            $sent_to_notification_message = $sent_to_notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                            $sent_to_notification_message = str_replace('{name}', $employee_file_as, $notification_message);
    
                            $notification_recipient_details = $api->get_notification_recipient_details(9);
    
                            for($i = 0; $i < count($notification_recipient_details); $i++) {
                                $recipient = $notification_recipient_details[$i]['EMPLOYEE_ID'];
                    
                                $send_notification = $api->send_notification(9, $employee_id, $recipient, $sent_to_notification_title, $sent_to_notification_message, $username);
    
                                if($send_notification != 1){
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
    
                if($update_attendance_adjustment_status == 1){
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

                    if($send_notification == 1){
                        $sent_to_notification_details = $api->get_notification_details(10);
                        $sent_to_notification_title = $sent_to_notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                        $sent_to_notification_message = $sent_to_notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                        $sent_to_notification_message = str_replace('{name}', $employee_file_as, $notification_message);

                        $notification_recipient_details = $api->get_notification_recipient_details(10);

                        for($i = 0; $i < count($notification_recipient_details); $i++) {
                            $recipient = $notification_recipient_details[$i]['EMPLOYEE_ID'];
                
                            $send_notification = $api->send_notification(10, $employee_id, $recipient, $sent_to_notification_title, $sent_to_notification_message, $username);

                            if($send_notification != 1){
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
        
                    if($update_attendance_adjustment_status == 1){
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

                        if($send_notification == 1){
                            $sent_to_notification_details = $api->get_notification_details(10);
                            $sent_to_notification_title = $sent_to_notification_details[0]['NOTIFICATION_TITLE'] ?? null;
                            $sent_to_notification_message = $sent_to_notification_details[0]['NOTIFICATION_MESSAGE'] ?? null;
                            $sent_to_notification_message = str_replace('{name}', $employee_file_as, $notification_message);

                            $notification_recipient_details = $api->get_notification_recipient_details(10);

                            for($i = 0; $i < count($notification_recipient_details); $i++) {
                                $recipient = $notification_recipient_details[$i]['EMPLOYEE_ID'];
                    
                                $send_notification = $api->send_notification(10, $employee_id, $recipient, $sent_to_notification_title, $sent_to_notification_message, $username);

                                if($send_notification != 1){
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
    #   Send transactions
    # -------------------------------------------------------------

    # Send test email
    else if($transaction == 'send test email'){
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['email']) && !empty($_POST['email'])){
            $username = $_POST['username'];
            $email = $_POST['email'];

            $send_email_notification = $api->send_email_notification('test email', $email, 'Test Email', 'This is a test email.', '', 0, '');

            if($send_email_notification == 1){
                echo 'Sent';
            }
            else{
                echo $send_email_notification;
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
            'LOGIN_BG' => $api->check_image($user_interface_details[0]['LOGIN_BG'] ?? null, 'placeholder'),
            'LOGO_LIGHT' => $api->check_image($user_interface_details[0]['LOGO_LIGHT'] ?? null, 'placeholder'),
            'LOGO_DARK' => $api->check_image($user_interface_details[0]['LOGO_DARK'] ?? null, 'placeholder'),
            'LOGO_ICON_LIGHT' => $api->check_image($user_interface_details[0]['LOGO_ICON_LIGHT'] ?? null, 'placeholder'),
            'LOGO_ICON_DARK' => $api->check_image($user_interface_details[0]['LOGO_ICON_DARK'] ?? null, 'placeholder'),
            'FAVICON' => $api->check_image($user_interface_details[0]['FAVICON'] ?? null, 'placeholder')
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
            'CITY_ID' => $company_setting_details[0]['CITY_ID']
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
        if(isset($_POST['leave_id']) && !empty($_POST['leave_id'])){
            $leave_id = $_POST['leave_id'];
            $leave_details = $api->get_leave_details($leave_id);

            $response[] = array(
                'EMPLOYEE_ID' => $leave_details[0]['EMPLOYEE_ID'],
                'LEAVE_TYPE' => $leave_details[0]['LEAVE_TYPE'],
                'NO_LEAVES' => $leave_details[0]['NO_LEAVES'],
                'START_DATE' => $api->check_date('empty', $leave_details[0]['START_DATE'] ?? null, '', 'n/d/Y', '', '', ''),
                'END_DATE' => $api->check_date('empty', $leave_details[0]['END_DATE'] ?? null, '', 'n/d/Y', '', '', '')
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

            $employee_details = $api->get_employee_details($employee_id, '');
            $employee_file_as = $employee_details[0]['FILE_AS'] ?? '--';

            if(!empty($payroll_id)){
                $payroll = '<a href="#">View Payroll</a>';
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

            $employee_details = $api->get_employee_details($employee_id, '');
            $employee_file_as = $employee_details[0]['FILE_AS'] ?? '--';

            if(!empty($payroll_id)){
                $payroll = '<a href="#">View Payroll</a>';
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

            $employee_details = $api->get_employee_details($employee_id, '');
            $employee_file_as = $employee_details[0]['FILE_AS'] ?? '--';

            if(!empty($payroll_id)){
                $payroll = '<a href="#">View Payroll</a>';
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

}
?>