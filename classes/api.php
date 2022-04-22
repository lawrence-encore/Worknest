<?php
require('assets/libs/PHPMailer/src/Exception.php');
require('assets/libs/PHPMailer/src/PHPMailer.php');
require('assets/libs/PHPMailer/src/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Api{
    # @var object $db_connection The database connection
    public $db_connection = null;

    public $response = array();

    # -------------------------------------------------------------
    #   Custom methods
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : databaseConnection
    # Purpose    : Checks if database connection is opened.
    #              If not, then this method tries to open it.
    #              @return bool Success status of the
    #              database connecting process
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function databaseConnection(){
        // if connection already exists
        if ($this->db_connection != null) {
            return 1;
        } 
        else {
            try {
                $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';character_set=utf8', DB_USER, DB_PASS);
                return 1;
            } 
            catch (PDOException $e) {
                $this->errors[] = $e->getMessage();
            }
        }
        // default return
        return false;
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : backup_database
    # Purpose    : Backs-up the database.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function backup_database($file_name, $username){
        if ($this->databaseConnection()) {
            $backup_file = 'backup/' . $file_name . '_' . time() . '.sql';
            
            exec('C:\xampp\mysql\bin\mysqldump.exe --routines -u '. DB_USER .' -p'. DB_PASS .' '. DB_NAME .' -r "'. $backup_file .'"  2>&1', $output, $return);

            if(!$return) {
                return 1;
            }
            else {
                return $return;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : format_date
    # Purpose    : Returns date with a custom formatting
    #              Avoids error when date is greater 
    #              than the year 2038 or less than 
    #              January 01, 1970.
    #
    # Returns    : Date
    #
    # -------------------------------------------------------------
    public function format_date($format, $date, $modify){
        if(!empty($modify)){
            $datestring = (new DateTime($date))->modify($modify)->format($format);
        }
        else{
            $datestring = (new DateTime($date))->format($format);
        }

        return $datestring;
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : CryptRC4
    # Purpose    : Returns the encrypted password using RC4-40.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function CryptRC4($text) {
        return openssl_encrypt($text, 'RC4-40', ENCRYPTION_KEY, 1 | 2);
    }
    # -------------------------------------------------------------
    
    # -------------------------------------------------------------
    #
    # Name       : ToHexDump
    # Purpose    : Encrypt the text or password to binary hex.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function ToHexDump($text) {
        return bin2hex($text);
    }
    # -------------------------------------------------------------
    
    # -------------------------------------------------------------
    #
    # Name       : FromHexDump
    # Purpose    : Decrypt the text or password to binary hex.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function FromHexDump($text) {
        return hex2bin($text);
    }
    # -------------------------------------------------------------
    
    # -------------------------------------------------------------
    #
    # Name       : encrypt_data
    # Purpose    : Encrypt the text.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function encrypt_data($text) {
        return $this->ToHexDump($this->CryptRC4($text));
    }
    # -------------------------------------------------------------
    
    # -------------------------------------------------------------
    #
    # Name       : decrypt_data
    # Purpose    : Decrypt the text.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function decrypt_data($text) {
        return $this->CryptRC4($this->FromHexDump($text));
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : remove_comma
    # Purpose    : Removes comma from number.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function remove_comma($number){
        return str_replace(',', '', $number);
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : add_months
    # Purpose    : Add months to calculated date.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function add_months($months, DateTime $dateObject){
        # Format date to Y-m-d
        # Get the last day of the given month
        $next = new DateTime($dateObject->format('Y-m-d'));
        $next->modify('last day of +'.$months.' month');
    
        # If $dateObject day is greater than the day of $next
        # Return the difference
        # Else create a new interval
        if($dateObject->format('d') > $next->format('d')) {
            return $dateObject->diff($next);
        } else {
            return new DateInterval('P'.$months.'M');
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : validate_email
    # Purpose    : Validate if email is valid.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function validate_email($email){
        $regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";

        if (preg_match($regex, $email)) {
            return 1;
        }
        else{
            return 'The email is not valid';
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : authenticate
    # Purpose    : Authenticates the user.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function authenticate($username, $password){
        if ($this->databaseConnection()) {
            $system_date = date('Y-m-d');

            $check_user_account_exist = $this->check_user_account_exist($username);
           
            if($check_user_account_exist == 1){
                $user_account_details = $this->get_user_account_details($username);
                $active = $user_account_details[0]['ACTIVE'];
                $login_attemp = $user_account_details[0]['FAILED_LOGIN'];
                $password_expiry_date = $user_account_details[0]['PASSWORD_EXPIRY_DATE'];

                if($active == 1){
                    if($login_attemp >= 5){
                        return 'Locked';
                    }
                    else{
                        if($user_account_details[0]['PASSWORD'] == $password){
                            if(strtotime($system_date) > strtotime($password_expiry_date)){
                                return 'Password Expired';
                            }
                            else{
                                if($login_attemp > 0){
                                    $update_login_attempt = $this->update_login_attempt($username, '', 0, NULL);

                                    if($update_login_attempt == 1){
                                        return 1;
                                    }
                                    else{
                                        return $update_login_attempt;
                                    }
                                }
                                else{
                                    return 1;
                                }
                            }
                        }
                        else{
                            $update_login_attempt = $this->update_login_attempt($username, ($login_attemp + 1), date('Y-m-d'));

                            if($update_login_attempt == 1){
                                return 'Incorrect';
                            }
                            else{
                                return $update_login_attempt;
                            }
                        }   
                    }
                }
                else{
                    return 'Inactive';
                }
            }
            else{
                return 'Incorrect';
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : send_email_notification
    # Purpose    : Sends notification email.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function send_email_notification($notification_type, $email, $subject, $body, $link, $is_html, $character_set){
        $email_configuration_details = $this->get_email_configuration_details(1);
        $mail_host = $email_configuration_details[0]['MAIL_HOST'];
        $port = $email_configuration_details[0]['PORT'];
        $smtp_auth = $email_configuration_details[0]['SMTP_AUTH'];
        $smtp_auto_tls = $email_configuration_details[0]['SMTP_AUTO_TLS'];
        $mail_username = $email_configuration_details[0]['USERNAME'];
        $mail_password = $this->decrypt_data($email_configuration_details[0]['PASSWORD']);
        $mail_encryption = $email_configuration_details[0]['MAIL_ENCRYPTION'];
        $mail_from_name = $email_configuration_details[0]['MAIL_FROM_NAME'];
        $mail_from_email = $email_configuration_details[0]['MAIL_FROM_EMAIL'];

        $company_setting_details = $this->get_company_setting_details(1);
        $company_name = $company_setting_details[0]['COMPANY_NAME'];

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;

        $mail->Host = $mail_host;
        $mail->Port = $port;
        $mail->SMTPSecure = $mail_encryption;
        $mail->SMTPAuth = $smtp_auth;
        $mail->SMTPAutoTLS = $smtp_auto_tls;
        $mail->Username = $mail_username;
        $mail->Password = $mail_password;
        $mail->setFrom($mail_from_email, $mail_from_name);
        $mail->addAddress($email, $email);
        $mail->Subject = $subject;

        if($notification_type == 1 || $notification_type == 2 || $notification_type == 3 || $notification_type == 4 || $notification_type == 5 || $notification_type == 6 || $notification_type == 7 || $notification_type == 8 || $notification_type == 9 || $notification_type == 10 || $notification_type == 11 || $notification_type == 12 || $notification_type == 13 || $notification_type == 14 || $notification_type == 15 || $notification_type == 15 || $notification_type == 16 || $notification_type == 17 || $notification_type == 18){
            if(!empty($link)){
                $message = file_get_contents('email_template/basic-notification-with-button.html');

                if($notification_type == 1 || $notification_type == 2){
                    $message = str_replace('@link', $link, $message);
                    $message = str_replace('@button_title', 'View Attendance Record', $message);
                }
                else if($notification_type == 3 || $notification_type == 5 || $notification_type == 7 || $notification_type == 9 || $notification_type == 11 || $notification_type == 13){
                    $message = str_replace('@button_title', 'View Attendance Creation', $message);
                }
                else if($notification_type == 4 || $notification_type == 6 || $notification_type == 8 || $notification_type == 10 || $notification_type == 12 || $notification_type == 14){
                    $message = str_replace('@button_title', 'View Attendance Adjustment', $message);
                }
                else if($notification_type == 15 || $notification_type == 16 || $notification_type == 17 || $notification_type == 18){
                    $message = str_replace('@button_title', 'View Leave Application', $message);
                }
            }
            else{
                $message = file_get_contents('email_template/basic-notification.html'); 
            }
            
            $message = str_replace('@company_name', $company_name, $message);
            $message = str_replace('@year', date('Y'), $message);
            $message = str_replace('@title', $subject, $message);
            $message = str_replace('@body', $body, $message);
        }

        if($is_html == 1){
            $mail->isHTML(true);
            $mail->MsgHTML($message);
            $mail->CharSet = $character_set;
        }
        else{
            $mail->Body = $body;
        }

        if ($mail->send()) {
            return 1;
        } 
        else {
            return 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : send_notification
    # Purpose    : Sends notification.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function send_notification($notification_id, $from, $sent_to, $title, $message, $username){
        $system_notification = $this->check_system_notification_exist($notification_id, 'S');
        $email_notification = $this->check_system_notification_exist($notification_id, 'E');

        if($system_notification > 0 || $email_notification > 0){
            $error = '';
            $employee_details = $this->get_employee_details($sent_to, $sent_to);
            $email = $employee_details[0]['EMAIL'] ?? null;
            $validate_email = $this->validate_email($email);

            $notification_details = $this->get_notification_details($notification_id);
            $system_link = $notification_details[0]['SYSTEM_LINK'] ?? null;
            $web_link = $notification_details[0]['WEB_LINK'] ?? null;

            if($system_notification > 0){
                $insert_system_notification = $this->insert_system_notification($notification_id, $from, $sent_to, $title, $message, $system_link, $username);

                if($insert_system_notification != 1){
                    $error = $insert_system_notification;
                }
            }

            if($email_notification > 0){
                if(!empty($email) && $validate_email == 1){
                    $send_email_notification = $this->send_email_notification($notification_id, $email, $title, $message, $web_link, 1, 'utf-8');
    
                    if($send_email_notification != 1){
                        $error = $send_email_notification;
                    }
                }
            }

            if(empty($error)){
                return 1;
            }
            else{
                return $error;
            }
        }
        else{
            return 1;
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Truncate methods
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : truncate_temporary_employee_table
    # Purpose    : Truncates the temporary table for employee.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function truncate_temporary_employee_table(){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('TRUNCATE TABLE temp_employee');

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : truncate_temporary_attendance_record_table
    # Purpose    : Truncates the temporary table for attendance record.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function truncate_temporary_attendance_record_table(){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('TRUNCATE TABLE temp_attendance_record');

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : truncate_temporary_leave_entitlement_table
    # Purpose    : Truncates the temporary table for leave entitlement.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function truncate_temporary_leave_entitlement_table(){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('TRUNCATE TABLE temp_leave_entitlement');

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : truncate_temporary_leave_table
    # Purpose    : Truncates the temporary table for leave.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function truncate_temporary_leave_table(){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('TRUNCATE TABLE temp_leave');

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : truncate_temporary_attendance_adjustment_table
    # Purpose    : Truncates the temporary table for attendance adjustment.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function truncate_temporary_attendance_adjustment_table(){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('TRUNCATE TABLE temp_attendance_adjustment');

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : truncate_temporary_attendance_creation_table
    # Purpose    : Truncates the temporary table for attendance creation.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function truncate_temporary_attendance_creation_table(){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('TRUNCATE TABLE temp_attendance_creation');

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : truncate_temporary_allowance_table
    # Purpose    : Truncates the temporary table for allowance.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function truncate_temporary_allowance_table(){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('TRUNCATE TABLE temp_allowance');

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : truncate_temporary_deduction_table
    # Purpose    : Truncates the temporary table for deduction.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function truncate_temporary_deduction_table(){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('TRUNCATE TABLE temp_deduction');

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : truncate_temporary_government_contribution_table
    # Purpose    : Truncates the temporary table for government contribution.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function truncate_temporary_government_contribution_table(){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('TRUNCATE TABLE temp_government_contribution');

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : truncate_temporary_contribution_bracket_table
    # Purpose    : Truncates the temporary table for contribution bracket.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function truncate_temporary_contribution_bracket_table(){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('TRUNCATE TABLE temp_contribution_bracket');

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : truncate_temporary_contribution_deduction_table
    # Purpose    : Truncates the temporary table for contribution deduction.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function truncate_temporary_contribution_deduction_table(){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('TRUNCATE TABLE temp_contribution_deduction');

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Check data exist methods
    # -------------------------------------------------------------
    
    # -------------------------------------------------------------
    #
    # Name       : check_user_account_exist
    # Purpose    : Checks if the user exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_user_account_exist($username){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_user_account_exist(:username)');
            $sql->bindValue(':username', $username);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_system_parameter_exist
    # Purpose    : Checks if the system parameter exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_system_parameter_exist($parameter_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_system_parameter_exist(:parameter_id)');
            $sql->bindValue(':parameter_id', $parameter_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_policy_exist
    # Purpose    : Checks if the policy exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_policy_exist($policy_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_policy_exist(:policy_id)');
            $sql->bindValue(':policy_id', $policy_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_permission_exist
    # Purpose    : Checks if the permission exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_permission_exist($permission_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_permission_exist(:permission_id)');
            $sql->bindValue(':permission_id', $permission_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_role_exist
    # Purpose    : Checks if the role exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_role_exist($role_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_role_exist(:role_id)');
            $sql->bindValue(':role_id', $role_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_system_code_exist
    # Purpose    : Checks if the system code exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_system_code_exist($system_type, $system_code){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_system_code_exist(:system_type, :system_code)');
            $sql->bindValue(':system_type', $system_type);
            $sql->bindValue(':system_code', $system_code);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_user_interface_settings_exist
    # Purpose    : Checks if the application setting exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_user_interface_settings_exist($setting_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_user_interface_settings_exist(:setting_id)');
            $sql->bindValue(':setting_id', $setting_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_mail_configuration_exist
    # Purpose    : Checks if the email configuration exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_mail_configuration_exist($mail_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_mail_configuration_exist(:mail_id)');
            $sql->bindValue(':mail_id', $mail_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_notification_type_exist
    # Purpose    : Checks if the notification type exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_notification_type_exist($notification_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_notification_type_exist(:notification_id)');
            $sql->bindValue(':notification_id', $notification_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_notification_details_exist
    # Purpose    : Checks if the notification details exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_notification_details_exist($notification_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_notification_details_exist(:notification_id)');
            $sql->bindValue(':notification_id', $notification_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_company_setting_exist
    # Purpose    : Checks if the company setting exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_company_setting_exist($company_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_company_setting_exist(:company_id)');
            $sql->bindValue(':company_id', $company_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_department_exist
    # Purpose    : Checks if the department exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_department_exist($department_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_department_exist(:department_id)');
            $sql->bindValue(':department_id', $department_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_designation_exist
    # Purpose    : Checks if the designation exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_designation_exist($designation_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_designation_exist(:designation_id)');
            $sql->bindValue(':designation_id', $designation_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_branch_exist
    # Purpose    : Checks if the branch exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_branch_exist($branch_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_branch_exist(:branch_id)');
            $sql->bindValue(':branch_id', $branch_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_upload_setting_exist
    # Purpose    : Checks if the upload setting exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_upload_setting_exist($upload_setting_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_upload_setting_exist(:upload_setting_id)');
            $sql->bindValue(':upload_setting_id', $upload_setting_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_employment_status_exist
    # Purpose    : Checks if the employment status exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_employment_status_exist($employment_status_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_employment_status_exist(:employment_status_id)');
            $sql->bindValue(':employment_status_id', $employment_status_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_employee_exist
    # Purpose    : Checks if the employee exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_employee_exist($employee_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_employee_exist(:employee_id)');
            $sql->bindValue(':employee_id', $employee_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_employee_id_number_exist
    # Purpose    : Checks if the employee id number exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_employee_id_number_exist($employee_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_employee_id_number_exist(:employee_id)');
            $sql->bindValue(':employee_id', $employee_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_emergency_contact_exist
    # Purpose    : Checks if the emergency contact exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_emergency_contact_exist($contact_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_emergency_contact_exist(:contact_id)');
            $sql->bindValue(':contact_id', $contact_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_employee_address_exist
    # Purpose    : Checks if the employee address exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_employee_address_exist($address_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_employee_address_exist(:address_id)');
            $sql->bindValue(':address_id', $address_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_employee_social_exist
    # Purpose    : Checks if the employee social exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_employee_social_exist($social_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_employee_social_exist(:social_id)');
            $sql->bindValue(':social_id', $social_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_work_shift_exist
    # Purpose    : Checks if the work shift exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_work_shift_exist($work_shift_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_work_shift_exist(:work_shift_id)');
            $sql->bindValue(':work_shift_id', $work_shift_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_work_shift_schedule_exist
    # Purpose    : Checks if the work shift schedule exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_work_shift_schedule_exist($work_shift_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_work_shift_schedule_exist(:work_shift_id)');
            $sql->bindValue(':work_shift_id', $work_shift_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_employee_attendance_exist
    # Purpose    : Checks if the employee attendance exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_employee_attendance_exist($attendance_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_employee_attendance_exist(:attendance_id)');
            $sql->bindValue(':attendance_id', $attendance_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_leave_type_exist
    # Purpose    : Checks if the leave type exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_leave_type_exist($leave_type_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_leave_type_exist(:leave_type_id)');
            $sql->bindValue(':leave_type_id', $leave_type_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_leave_entitlement_exist
    # Purpose    : Checks if the leave entitlement exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_leave_entitlement_exist($leave_entitlement_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_leave_entitlement_exist(:leave_entitlement_id)');
            $sql->bindValue(':leave_entitlement_id', $leave_entitlement_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_leave_exist
    # Purpose    : Checks if the leave exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_leave_exist($leave_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_leave_exist(:leave_id)');
            $sql->bindValue(':leave_id', $leave_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_employee_file_exist
    # Purpose    : Checks if the employee file exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_employee_file_exist($file_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_employee_file_exist(:file_id)');
            $sql->bindValue(':file_id', $file_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_holiday_exist
    # Purpose    : Checks if the holiday exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_holiday_exist($holiday_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_holiday_exist(:holiday_id)');
            $sql->bindValue(':holiday_id', $holiday_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_attendance_setting_exist
    # Purpose    : Checks if the attendance setting exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_attendance_setting_exist($setting_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_attendance_setting_exist(:setting_id)');
            $sql->bindValue(':setting_id', $setting_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_system_notification_exist
    # Purpose    : Checks if the system notification exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_system_notification_exist($notification_id, $notification_type){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_system_notification_exist(:notification_id, :notification_type)');
            $sql->bindValue(':notification_id', $notification_id);
            $sql->bindValue(':notification_type', $notification_type);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_attendance_creation_exist
    # Purpose    : Checks if the attendance creation exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_attendance_creation_exist($request_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_attendance_creation_exist(:request_id)');
            $sql->bindValue(':request_id', $request_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_attendance_adjustment_exist
    # Purpose    : Checks if the attendance adjustment exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_attendance_adjustment_exist($request_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_attendance_adjustment_exist(:request_id)');
            $sql->bindValue(':request_id', $request_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_attendance_creation_recommendation_exception_exist
    # Purpose    : Checks if the attendance creation recommendation exception exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_attendance_creation_recommendation_exception_exist($employee_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_attendance_creation_recommendation_exception_exist(:employee_id)');
            $sql->bindValue(':employee_id', $employee_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_attendance_adjustment_recommendation_exception_exist
    # Purpose    : Checks if the attendance adjustment recommendation exception exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_attendance_adjustment_recommendation_exception_exist($employee_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_attendance_adjustment_recommendation_exception_exist(:employee_id)');
            $sql->bindValue(':employee_id', $employee_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_allowance_type_exist
    # Purpose    : Checks if the allowance type exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_allowance_type_exist($allowance_type_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_allowance_type_exist(:allowance_type_id)');
            $sql->bindValue(':allowance_type_id', $allowance_type_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_allowance_exist
    # Purpose    : Checks if the allowance exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_allowance_exist($allowance_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_allowance_exist(:allowance_id)');
            $sql->bindValue(':allowance_id', $allowance_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_deduction_type_exist
    # Purpose    : Checks if the deduction type exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_deduction_type_exist($deduction_type_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_deduction_type_exist(:deduction_type_id)');
            $sql->bindValue(':deduction_type_id', $deduction_type_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_government_contribution_exist
    # Purpose    : Checks if the government contribution exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_government_contribution_exist($government_contribution_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_government_contribution_exist(:government_contribution_id)');
            $sql->bindValue(':government_contribution_id', $government_contribution_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_contribution_bracket_exist
    # Purpose    : Checks if the contribution bracket exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_contribution_bracket_exist($contribution_bracket_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_contribution_bracket_exist(:contribution_bracket_id)');
            $sql->bindValue(':contribution_bracket_id', $contribution_bracket_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_deduction_exist
    # Purpose    : Checks if the deduction exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_deduction_exist($deduction_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_deduction_exist(:deduction_id)');
            $sql->bindValue(':deduction_id', $deduction_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_contribution_deduction_exist
    # Purpose    : Checks if the contribution deduction exists.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_contribution_deduction_exist($contribution_deduction_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL check_contribution_deduction_exist(:contribution_deduction_id)');
            $sql->bindValue(':contribution_deduction_id', $contribution_deduction_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Update methods
    # -------------------------------------------------------------
    
    # -------------------------------------------------------------
    #
    # Name       : update_login_attempt
    # Purpose    : Updates the login attempt of the user.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_login_attempt($username, $login_attemp, $last_failed_attempt_date){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL update_login_attempt(:username, :login_attemp, :last_failed_attempt_date)');
            $sql->bindValue(':username', $username);
            $sql->bindValue(':login_attemp', $login_attemp);
            $sql->bindValue(':last_failed_attempt_date', $last_failed_attempt_date);

            if($sql->execute()){
               return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_user_password
    # Purpose    : Updates the user account password.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_user_password($username, $password, $password_expiry_date){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL update_user_password(:username, :password, :password_expiry_date)');
            $sql->bindValue(':password', $password);
            $sql->bindValue(':password_expiry_date', $password_expiry_date);
            $sql->bindValue(':username', $username);

            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($username, 'Update Password', '');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_system_parameter
    # Purpose    : Updates system parameter.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_system_parameter($parameter_id, $parameter, $extension, $parameter_number, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $system_parameter_details = $this->get_system_parameter_details($parameter_id);
            
            if(!empty($system_parameter_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $system_parameter_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_system_parameter(:parameter_id, :parameter, :extension, :parameter_number, :transaction_log_id, :record_log)');
            $sql->bindValue(':parameter_id', $parameter_id);
            $sql->bindValue(':parameter', $parameter);
            $sql->bindValue(':extension', $extension);
            $sql->bindValue(':parameter_number', $parameter_number);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($system_parameter_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated system parameter (' . $parameter_id . ').');
                                        
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated system parameter (' . $parameter_id . ').');
                                        
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_system_parameter_value
    # Purpose    : Updates system parameter value.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_system_parameter_value($parameter_number, $parameter_id, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');

            $sql = $this->db_connection->prepare('CALL update_system_parameter_value(:parameter_id, :parameter_number, :record_log)');
            $sql->bindValue(':parameter_id', $parameter_id);
            $sql->bindValue(':parameter_number', $parameter_number);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_policy
    # Purpose    : Updates policy.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_policy($policy, $policy_id, $description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $policy_details = $this->get_policy_details($policy_id);
            
            if(!empty($policy_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $policy_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_policy(:policy_id, :policy, :description, :transaction_log_id, :record_log)');
            $sql->bindValue(':policy_id', $policy_id);
            $sql->bindValue(':policy', $policy);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($policy_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated policy (' . $policy_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated policy (' . $policy_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_permission
    # Purpose    : Updates permission.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_permission($permission_id, $policy_id, $permission, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $permission_details = $this->get_permission_details($permission_id);
            
            if(!empty($permission_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $permission_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_permission(:permission_id, :policy_id, :permission, :transaction_log_id, :record_log)');
            $sql->bindValue(':permission_id', $permission_id);
            $sql->bindValue(':policy_id', $policy_id);
            $sql->bindValue(':permission', $permission);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($permission_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated permission (' . $permission_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated permission (' . $permission_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_role
    # Purpose    : Updates role.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_role($role_id, $role, $description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $role_details = $this->get_role_details($role_id);

            if(!empty($role_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $role_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_role(:role_id, :role, :description, :transaction_log_id, :record_log)');
            $sql->bindValue(':role_id', $role_id);
            $sql->bindValue(':role', $role);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($role_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated role (' . $role_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated role (' . $role_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_system_code
    # Purpose    : Updates system code.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_system_code($system_type, $system_code, $system_description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $system_code_details = $this->get_system_code_details($system_type, $system_code);

            if(!empty($system_code_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $system_code_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_system_code(:system_type, :system_code, :system_description, :transaction_log_id, :record_log)');
            $sql->bindValue(':system_type', $system_type);
            $sql->bindValue(':system_code', $system_code);
            $sql->bindValue(':system_description', $system_description);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($system_code_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated system code (' . $system_code . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated system code (' . $system_code . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_user_interface_settings_images
    # Purpose    : Updates application settings images
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function update_user_interface_settings_images($file_tmp_name, $file_actual_ext, $request_type, $setting_id, $username){
        if ($this->databaseConnection()) {
            if(!empty($file_tmp_name)){
                $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
                $user_interface_settings_details = $this->get_user_interface_settings_details($setting_id);

                if(!empty($user_interface_settings_details[0]['TRANSACTION_LOG_ID'])){
                    $transaction_log_id = $user_interface_settings_details[0]['TRANSACTION_LOG_ID'];
                }
                else{
                    # Get transaction log id
                    $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                    $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                    $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
                }

                switch ($request_type) {
                    case 'login background':
                        $file_new = 'login-bg.' . $file_actual_ext;
                        $image = $user_interface_settings_details[0]['LOGIN_BG'] ?? null;
                        $log = 'User ' . $username . ' updated login background.';
                        break;
                    case 'logo light':
                        $file_new = 'logo-light.' . $file_actual_ext;
                        $image = $user_interface_settings_details[0]['LOGO_LIGHT'] ?? null;
                        $log = 'User ' . $username . ' updated logo light.';
                        break;
                    case 'logo dark':
                        $file_new = 'logo-dark.' . $file_actual_ext;
                        $image = $user_interface_settings_details[0]['LOGO_DARK'] ?? null;
                        $log = 'User ' . $username . ' updated logo dark.';
                        break;
                    case 'logo icon light':
                        $file_new = 'logo-icon-light.' . $file_actual_ext;
                        $image = $user_interface_settings_details[0]['LOGO_ICON_LIGHT'] ?? null;
                        $log = 'User ' . $username . ' updated logo icon light.';
                        break;
                    case 'logo icon dark':
                        $file_new = 'logo-icon-dark.' . $file_actual_ext;
                        $image = $user_interface_settings_details[0]['LOGO_ICON_DARK'] ?? null;
                        $log = 'User ' . $username . ' updated logo icon dark.';
                        break;
                    default:
                        $file_new = 'favicon.' . $file_actual_ext;
                        $image = $user_interface_settings_details[0]['FAVICON'] ?? null;
                        $log = 'User ' . $username . ' updated favicon image.';
                }

                $file_destination = $_SERVER['DOCUMENT_ROOT'] . '/worknest/assets/images/application-settings/' . $file_new;
                $file_path = './assets/images/application-settings/' . $file_new;
                
                if(file_exists($image)){
                    if (unlink($image)) {
                        if(move_uploaded_file($file_tmp_name, $file_destination)){
                            $sql = $this->db_connection->prepare('CALL update_user_interface_settings_images(:setting_id, :file_path, :transaction_log_id, :record_log, :request_type)');
                            $sql->bindValue(':setting_id', $setting_id);
                            $sql->bindValue(':file_path', $file_path);
                            $sql->bindValue(':transaction_log_id', $transaction_log_id);
                            $sql->bindValue(':record_log', $record_log);
                            $sql->bindValue(':request_type', $request_type);
                        
                            if($sql->execute()){
                                if(!empty($user_interface_settings_details[0]['TRANSACTION_LOG_ID'])){
                                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', $log);
                                
                                    if($insert_transaction_log == 1){
                                        return 1;
                                    }
                                    else{
                                        return $insert_transaction_log;
                                    }
                                }
                                else{
                                    # Update transaction log value
                                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);
                
                                    if($update_system_parameter_value == 1){
                                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', $log);
                                
                                        if($insert_transaction_log == 1){
                                            return 1;
                                        }
                                        else{
                                            return $insert_transaction_log;
                                        }
                                    }
                                    else{
                                        return $update_system_parameter_value;
                                    }
                                }
                            }
                            else{
                                return $sql->errorInfo()[2];
                            }
                        }
                        else{
                            return 'There was an error uploading your image.';
                        }
                    }
                    else {
                        return $profile_image . ' cannot be deleted due to an error.';
                    }
                }
                else{
                    if(move_uploaded_file($file_tmp_name, $file_destination)){
                        $sql = $this->db_connection->prepare('CALL update_user_interface_settings_images(:setting_id, :file_path, :transaction_log_id, :record_log, :request_type)');
                        $sql->bindValue(':setting_id', $setting_id);
                        $sql->bindValue(':file_path', $file_path);
                        $sql->bindValue(':transaction_log_id', $transaction_log_id);
                        $sql->bindValue(':record_log', $record_log);
                        $sql->bindValue(':request_type', $request_type);
                        
                        if($sql->execute()){
                            if(!empty($user_interface_settings_details[0]['TRANSACTION_LOG_ID'])){
                                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', $log);
                            
                                if($insert_transaction_log == 1){
                                    return 1;
                                }
                                else{
                                    return $insert_transaction_log;
                                }
                            }
                            else{
                                # Update transaction log value
                                $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);
            
                                if($update_system_parameter_value == 1){
                                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', $log);
                            
                                    if($insert_transaction_log == 1){
                                        return 1;
                                    }
                                    else{
                                        return $insert_transaction_log;
                                    }
                                }
                                else{
                                    return $update_system_parameter_value;
                                }
                            }
                        }
                        else{
                            return $sql->errorInfo()[2];
                        }
                    }
                    else{
                        return 'There was an error uploading your image.';
                    }
                }
            }
            else{
                return 1;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_email_configuration
    # Purpose    : Updates email configuration.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_email_configuration($mail_id, $mail_host, $port, $smtp_auth, $smtp_auto_tls, $mail_user, $mail_password, $mail_encryption, $mail_from_name, $mail_from_email, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');

            $email_configuration_details = $this->get_email_configuration_details($mail_id);

            if(!empty($email_configuration_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $email_configuration_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_email_configuration(:mail_id, :mail_host, :port, :smtp_auth, :smtp_auto_tls, :mail_user, :mail_password, :mail_encryption, :mail_from_name, :mail_from_email, :transaction_log_id, :record_log)');
            $sql->bindValue(':mail_id', $mail_id);
            $sql->bindValue(':mail_host', $mail_host);
            $sql->bindValue(':port', $port);
            $sql->bindValue(':smtp_auth', $smtp_auth);
            $sql->bindValue(':smtp_auto_tls', $smtp_auto_tls);
            $sql->bindValue(':mail_user', $mail_user);
            $sql->bindValue(':mail_password', $mail_password);
            $sql->bindValue(':mail_encryption', $mail_encryption);
            $sql->bindValue(':mail_from_name', $mail_from_name);
            $sql->bindValue(':mail_from_email', $mail_from_email);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($email_configuration_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated email configuration (' . $mail_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated email configuration (' . $mail_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_notification_type
    # Purpose    : Updates notification type.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_notification_type($notification_id, $notification, $description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $notification_type_details = $this->get_notification_type_details($notification_id);

            if(!empty($notification_type_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $notification_type_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_notification_type(:notification_id, :notification, :description, :transaction_log_id, :record_log)');
            $sql->bindValue(':notification_id', $notification_id);
            $sql->bindValue(':notification', $notification);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($notification_type_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated notification type (' . $notification_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated notification type (' . $notification_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_notification_details
    # Purpose    : Updates notification details.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_notification_details($notification_id, $notification_title, $notification_message, $system_link, $web_link, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $notification_type_details = $this->get_notification_type_details($notification_id);

            if(!empty($notification_type_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $notification_type_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_notification_details(:notification_id, :notification_title, :notification_message, :system_link, :web_link, :transaction_log_id, :record_log)');
            $sql->bindValue(':notification_id', $notification_id);
            $sql->bindValue(':notification_title', $notification_title);
            $sql->bindValue(':notification_message', $notification_message);
            $sql->bindValue(':system_link', $system_link);
            $sql->bindValue(':web_link', $web_link);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($notification_type_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated notification details (' . $notification_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated notification details (' . $notification_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_company_setting
    # Purpose    : Updates company setting.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_company_setting($company_id, $company_name, $email, $telephone, $phone, $website, $address, $province, $city, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');

            $company_setting_details = $this->get_company_setting_details($company_id);

            if(!empty($company_setting_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $company_setting_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_company_setting(:company_id, :company_name, :email, :telephone, :phone, :website, :address, :province, :city, :transaction_log_id, :record_log)');
            $sql->bindValue(':company_id', $company_id);
            $sql->bindValue(':company_name', $company_name);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':telephone', $telephone);
            $sql->bindValue(':phone', $phone);
            $sql->bindValue(':website', $website);
            $sql->bindValue(':address', $address);
            $sql->bindValue(':province', $province);
            $sql->bindValue(':city', $city);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($company_setting_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated company setting (' . $company_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated company setting (' . $company_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_department
    # Purpose    : Updates department.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_department($department_id, $department, $description, $department_head, $parent_department, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $department_details = $this->get_department_details($department_id);

            if(!empty($department_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $department_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_department(:department_id, :department, :description, :department_head, :parent_department, :transaction_log_id, :record_log)');
            $sql->bindValue(':department_id', $department_id);
            $sql->bindValue(':department', $department);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':department_head', $department_head);
            $sql->bindValue(':parent_department', $parent_department);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($department_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated department (' . $department_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated department (' . $department_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_designation
    # Purpose    : Updates designation.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_designation($designation_id, $designation, $description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $designation_details = $this->get_designation_details($designation_id);

            if(!empty($designation_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $designation_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_designation(:designation_id, :designation, :description, :transaction_log_id, :record_log)');
            $sql->bindValue(':designation_id', $designation_id);
            $sql->bindValue(':designation', $designation);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($designation_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated designation (' . $designation_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated designation (' . $designation_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_designation_file
    # Purpose    : Updates designation file
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function update_designation_file($job_description_tmp_name, $job_description_actual_ext, $designation_id, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');

            if(!empty($job_description_tmp_name)){ 
                $file_name = $this->generate_file_name(10);
                $file_new = $file_name . '.' . $job_description_actual_ext;
                $file_destination = $_SERVER['DOCUMENT_ROOT'] . '/worknest/job_description/' . $file_new;
                $file_path = './job_description/' . $file_new;
                
                $designation_details = $this->get_designation_details($designation_id);
                $job_description_path = $designation_details[0]['JOB_DESCRIPTION'];
                $transaction_log_id = $designation_details[0]['TRANSACTION_LOG_ID'];

                if(file_exists($job_description_path)){
                    if (unlink($job_description_path)) {
                        if(move_uploaded_file($job_description_tmp_name, $file_destination)){
                            $sql = $this->db_connection->prepare('CALL update_designation_file(:designation_id, :file_path, :transaction_log_id, :record_log)');
                            $sql->bindValue(':designation_id', $designation_id);
                            $sql->bindValue(':file_path', $file_path);
                            $sql->bindValue(':transaction_log_id', $transaction_log_id);
                            $sql->bindValue(':record_log', $record_log);
                        
                            if($sql->execute()){
                                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated designation job description (' . $designation_id . ').');
                                    
                                if($insert_transaction_log == 1){
                                    return 1;
                                }
                                else{
                                    return $insert_transaction_log;
                                }
                            }
                            else{
                                return $sql->errorInfo()[2];
                            }
                        }
                        else{
                            return 'There was an error uploading your file.';
                        }
                    }
                    else {
                        return $job_description_path . ' cannot be deleted due to an error.';
                    }
                }
                else{
                    if(move_uploaded_file($job_description_tmp_name, $file_destination)){
                        $sql = $this->db_connection->prepare('CALL update_designation_file(:designation_id, :file_path, :transaction_log_id, :record_log)');
                        $sql->bindValue(':designation_id', $designation_id);
                        $sql->bindValue(':file_path', $file_path);
                        $sql->bindValue(':transaction_log_id', $transaction_log_id);
                        $sql->bindValue(':record_log', $record_log);
                        
                        if($sql->execute()){
                            $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated designation job description (' . $designation_id . ').');
                                    
                            if($insert_transaction_log == 1){
                                return 1;
                            }
                            else{
                                return $insert_transaction_log;
                            }
                        }
                        else{
                            return $sql->errorInfo()[2];
                        }
                    }
                    else{
                        return 'There was an error uploading your file.';
                    }
                }
            }
            else{
                return 1;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_branch
    # Purpose    : Updates branch.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_branch($branch_id, $branch, $email, $phone, $telephone, $address, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $branch_details = $this->get_branch_details($branch_id);

            if(!empty($branch_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $branch_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_branch(:branch_id, :branch, :email, :phone, :telephone, :address, :transaction_log_id, :record_log)');
            $sql->bindValue(':branch_id', $branch_id);
            $sql->bindValue(':branch', $branch);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':phone', $phone);
            $sql->bindValue(':telephone', $telephone);
            $sql->bindValue(':address', $address);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($branch_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated branch (' . $branch_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated branch (' . $branch_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_upload_setting
    # Purpose    : Updates upload setting.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_upload_setting($setting_id, $upload_setting, $description, $max_file_size, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $upload_setting_details = $this->get_upload_setting_details($setting_id);

            if(!empty($upload_setting_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $upload_setting_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_upload_setting(:setting_id, :upload_setting, :description, :max_file_size, :transaction_log_id, :record_log)');
            $sql->bindValue(':setting_id', $setting_id);
            $sql->bindValue(':upload_setting', $upload_setting);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':max_file_size', $max_file_size);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($upload_setting_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated upload setting (' . $setting_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated upload setting (' . $setting_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_employment_status
    # Purpose    : Updates employment status.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_employment_status($employment_status_id, $employment_status, $color_value, $description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $employment_status_details = $this->get_employment_status_details($employment_status_id);

            if(!empty($employment_status_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $employment_status_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_employment_status(:employment_status_id, :employment_status, :description, :color_value, :transaction_log_id, :record_log)');
            $sql->bindValue(':employment_status_id', $employment_status_id);
            $sql->bindValue(':employment_status', $employment_status);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':color_value', $color_value);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($employment_status_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated employment status (' . $employment_status_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated employment status (' . $employment_status_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_employee
    # Purpose    : Updates employee.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_employee($employee_id, $file_as, $first_name, $middle_name, $last_name, $suffix, $birthday, $employment_status, $joining_date, $permanency_date, $exit_date, $exit_reason, $email, $phone, $telephone, $department, $designation, $branch, $gender, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $employee_details = $this->get_employee_details($employee_id, '');

            if(!empty($employee_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $employee_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_employee(:employee_id, :file_as, :first_name, :middle_name, :last_name, :suffix, :birthday, :employment_status, :joining_date, :permanency_date, :exit_date, :exit_reason, :email, :phone, :telephone, :department, :designation, :branch, :gender, :transaction_log_id, :record_log)');
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':file_as', $file_as);
            $sql->bindValue(':first_name', $first_name);
            $sql->bindValue(':middle_name', $middle_name);
            $sql->bindValue(':last_name', $last_name);
            $sql->bindValue(':suffix', $suffix);
            $sql->bindValue(':birthday', $birthday);
            $sql->bindValue(':employment_status', $employment_status);
            $sql->bindValue(':joining_date', $joining_date);
            $sql->bindValue(':permanency_date', $permanency_date);
            $sql->bindValue(':exit_date', $exit_date);
            $sql->bindValue(':exit_reason', $exit_reason);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':phone', $phone);
            $sql->bindValue(':telephone', $telephone);
            $sql->bindValue(':department', $department);
            $sql->bindValue(':designation', $designation);
            $sql->bindValue(':branch', $branch);
            $sql->bindValue(':gender', $gender);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($employee_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated employee (' . $employee_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated employee (' . $employee_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_emergency_contact
    # Purpose    : Updates emergency contact.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_emergency_contact($contact_id, $contact_name, $relationship, $email, $phone, $telephone, $address, $city, $province, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $emergency_contact_details = $this->get_emergency_contact_details($contact_id);

            if(!empty($emergency_contact_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $emergency_contact_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_emergency_contact(:contact_id, :contact_name, :relationship, :email, :phone, :telephone, :address, :city, :province, :transaction_log_id, :record_log)');
            $sql->bindValue(':contact_id', $contact_id);
            $sql->bindValue(':contact_name', $contact_name);
            $sql->bindValue(':relationship', $relationship);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':phone', $phone);
            $sql->bindValue(':telephone', $telephone);
            $sql->bindValue(':address', $address);
            $sql->bindValue(':city', $city);
            $sql->bindValue(':province', $province);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($emergency_contact_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated emergency contact (' . $contact_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated emergency contact (' . $contact_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_employee_address
    # Purpose    : Updates employee address.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_employee_address($address_id, $address_type, $address, $city, $province, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $employee_address_details = $this->get_employee_address_details($address_id);

            if(!empty($employee_address_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $employee_address_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_employee_address(:address_id, :address_type, :address, :city, :province, :transaction_log_id, :record_log)');
            $sql->bindValue(':address_id', $address_id);
            $sql->bindValue(':address_type', $address_type);
            $sql->bindValue(':address', $address);
            $sql->bindValue(':city', $city);
            $sql->bindValue(':province', $province);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($employee_address_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated employee address (' . $address_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated employee address (' . $address_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_employee_social
    # Purpose    : Updates employee social.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_employee_social($social_id, $social_type, $link, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $employee_social_details = $this->get_employee_social_details($social_id);

            if(!empty($employee_social_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $employee_social_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_employee_social(:social_id, :social_type, :link, :transaction_log_id, :record_log)');
            $sql->bindValue(':social_id', $social_id);
            $sql->bindValue(':social_type', $social_type);
            $sql->bindValue(':link', $link);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($employee_social_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated employee social (' . $social_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated employee social (' . $social_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_work_shift
    # Purpose    : Updates work shift.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_work_shift($work_shift_id, $work_shift, $work_shift_type, $description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $work_shift_details = $this->get_work_shift_details($work_shift_id);

            if(!empty($work_shift_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $work_shift_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_work_shift(:work_shift_id, :work_shift, :work_shift_type, :description, :transaction_log_id, :record_log)');
            $sql->bindValue(':work_shift_id', $work_shift_id);
            $sql->bindValue(':work_shift', $work_shift);
            $sql->bindValue(':work_shift_type', $work_shift_type);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($work_shift_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated work shift (' . $work_shift_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated work shift (' . $work_shift_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_work_shift_schedule
    # Purpose    : Updates work shift schedule.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_work_shift_schedule($work_shift_id, $start_date, $end_date, $monday_start_time, $monday_end_time, $monday_lunch_start_time, $monday_lunch_end_time, $monday_half_day_mark, $tuesday_start_time, $tuesday_end_time, $tuesday_lunch_start_time, $tuesday_lunch_end_time, $tuesday_half_day_mark, $wednesday_start_time, $wednesday_end_time, $wednesday_lunch_start_time, $wednesday_lunch_end_time, $wednesday_half_day_mark, $thursday_start_time, $thursday_end_time, $thursday_lunch_start_time, $thursday_lunch_end_time, $thursday_half_day_mark, $friday_start_time, $friday_end_time, $friday_lunch_start_time, $friday_lunch_end_time, $friday_half_day_mark, $saturday_start_time, $saturday_end_time, $saturday_lunch_start_time, $saturday_lunch_end_time, $saturday_half_day_mark, $sunday_start_time, $sunday_end_time, $sunday_lunch_start_time, $sunday_lunch_end_time, $sunday_half_day_mark, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');

            $work_shift_details = $this->get_work_shift_details($work_shift_id);
            $transaction_log_id = $work_shift_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL update_work_shift_schedule(:work_shift_id, :start_date, :end_date, :monday_start_time, :monday_end_time, :monday_lunch_start_time, :monday_lunch_end_time, :monday_half_day_mark, :tuesday_start_time, :tuesday_end_time, :tuesday_lunch_start_time, :tuesday_lunch_end_time, :tuesday_half_day_mark, :wednesday_start_time, :wednesday_end_time, :wednesday_lunch_start_time, :wednesday_lunch_end_time, :wednesday_half_day_mark, :thursday_start_time, :thursday_end_time, :thursday_lunch_start_time, :thursday_lunch_end_time, :thursday_half_day_mark, :friday_start_time, :friday_end_time, :friday_lunch_start_time, :friday_lunch_end_time, :friday_half_day_mark, :saturday_start_time, :saturday_end_time, :saturday_lunch_start_time, :saturday_lunch_end_time, :saturday_half_day_mark, :sunday_start_time, :sunday_end_time, :sunday_lunch_start_time, :sunday_lunch_end_time, :sunday_half_day_mark, :record_log)');
            $sql->bindValue(':work_shift_id', $work_shift_id);
            $sql->bindValue(':start_date', $start_date);
            $sql->bindValue(':end_date', $end_date);
            $sql->bindValue(':monday_start_time', $monday_start_time);
            $sql->bindValue(':monday_end_time', $monday_end_time);
            $sql->bindValue(':monday_lunch_start_time', $monday_lunch_start_time);
            $sql->bindValue(':monday_lunch_end_time', $monday_lunch_end_time);
            $sql->bindValue(':monday_half_day_mark', $monday_half_day_mark);
            $sql->bindValue(':tuesday_start_time', $tuesday_start_time);
            $sql->bindValue(':tuesday_end_time', $tuesday_end_time);
            $sql->bindValue(':tuesday_lunch_start_time', $tuesday_lunch_start_time);
            $sql->bindValue(':tuesday_lunch_end_time', $tuesday_lunch_end_time);
            $sql->bindValue(':tuesday_half_day_mark', $tuesday_half_day_mark);
            $sql->bindValue(':wednesday_start_time', $wednesday_start_time);
            $sql->bindValue(':wednesday_end_time', $wednesday_end_time);
            $sql->bindValue(':wednesday_lunch_start_time', $wednesday_lunch_start_time);
            $sql->bindValue(':wednesday_lunch_end_time', $wednesday_lunch_end_time);
            $sql->bindValue(':wednesday_half_day_mark', $wednesday_half_day_mark);
            $sql->bindValue(':thursday_start_time', $thursday_start_time);
            $sql->bindValue(':thursday_end_time', $thursday_end_time);
            $sql->bindValue(':thursday_lunch_start_time', $thursday_lunch_start_time);
            $sql->bindValue(':thursday_lunch_end_time', $thursday_lunch_end_time);
            $sql->bindValue(':thursday_half_day_mark', $thursday_half_day_mark);
            $sql->bindValue(':friday_start_time', $friday_start_time);
            $sql->bindValue(':friday_end_time', $friday_end_time);
            $sql->bindValue(':friday_lunch_start_time', $friday_lunch_start_time);
            $sql->bindValue(':friday_lunch_end_time', $friday_lunch_end_time);
            $sql->bindValue(':friday_half_day_mark', $friday_half_day_mark);
            $sql->bindValue(':saturday_start_time', $saturday_start_time);
            $sql->bindValue(':saturday_end_time', $saturday_end_time);
            $sql->bindValue(':saturday_lunch_start_time', $saturday_lunch_start_time);
            $sql->bindValue(':saturday_lunch_end_time', $saturday_lunch_end_time);
            $sql->bindValue(':saturday_half_day_mark', $saturday_half_day_mark);
            $sql->bindValue(':sunday_start_time', $sunday_start_time);
            $sql->bindValue(':sunday_end_time', $sunday_end_time);
            $sql->bindValue(':sunday_lunch_start_time', $sunday_lunch_start_time);
            $sql->bindValue(':sunday_lunch_end_time', $sunday_lunch_end_time);
            $sql->bindValue(':sunday_half_day_mark', $sunday_half_day_mark);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated work shift schedule (' . $work_shift_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_manual_employee_attendance
    # Purpose    : Updates employee attendance.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_manual_employee_attendance($attendance_id, $time_in_date, $time_in, $time_in_behavior, $time_out_date, $time_out, $time_out_behavior, $late, $early_leaving, $overtime, $total_hours_worked, $remarks, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $employee_attendance_details = $this->get_employee_attendance_details($attendance_id);

            if(!empty($employee_attendance_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $employee_attendance_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_manual_employee_attendance(:attendance_id, :time_in_date, :time_in, :time_in_behavior, :time_out_date, :time_out, :time_out_behavior, :late, :early_leaving, :overtime, :total_hours_worked, :remarks, :transaction_log_id, :record_log)');
            $sql->bindValue(':attendance_id', $attendance_id);
            $sql->bindValue(':time_in_date', $time_in_date);
            $sql->bindValue(':time_in', $time_in);
            $sql->bindValue(':time_in_behavior', $time_in_behavior);
            $sql->bindValue(':time_out_date', $time_out_date);
            $sql->bindValue(':time_out', $time_out);
            $sql->bindValue(':time_out_behavior', $time_out_behavior);
            $sql->bindValue(':late', $late);
            $sql->bindValue(':early_leaving', $early_leaving);
            $sql->bindValue(':overtime', $overtime);
            $sql->bindValue(':total_hours_worked', $total_hours_worked);
            $sql->bindValue(':remarks', $remarks);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($employee_attendance_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated employee attendance (' . $attendance_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated employee attendance (' . $attendance_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_leave_type
    # Purpose    : Updates leave type.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_leave_type($leave_type_id, $leave_name, $description, $no_leaves, $paid_status, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $leave_type_details = $this->get_leave_type_details($leave_type_id);

            if(!empty($leave_type_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $leave_type_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_leave_type(:leave_type_id, :leave_name, :description, :no_leaves, :paid_status, :transaction_log_id, :record_log)');
            $sql->bindValue(':leave_type_id', $leave_type_id);
            $sql->bindValue(':leave_name', $leave_name);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':no_leaves', $no_leaves);
            $sql->bindValue(':paid_status', $paid_status);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($leave_type_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated leave type (' . $leave_type_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated leave type (' . $leave_type_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_leave_entitlement
    # Purpose    : Updates leave entitlement.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_leave_entitlement($leave_entitlement_id, $no_leaves, $start_date, $end_date, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $leave_entitlement_details = $this->get_leave_entitlement_details($leave_entitlement_id);

            if(!empty($leave_entitlement_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $leave_entitlement_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_leave_entitlement(:leave_entitlement_id, :no_leaves, :start_date, :end_date, :transaction_log_id, :record_log)');
            $sql->bindValue(':leave_entitlement_id', $leave_entitlement_id);
            $sql->bindValue(':no_leaves', $no_leaves);
            $sql->bindValue(':start_date', $start_date);
            $sql->bindValue(':end_date', $end_date);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($leave_entitlement_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated leave entitlement (' . $leave_entitlement_id . ').');

                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated leave entitlement (' . $leave_entitlement_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_leave_entitlement_count
    # Purpose    : Update leave entitlement count
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_leave_entitlement_count($employee_id, $leave_type, $leave_date, $total_hours, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');

            $employee_leave_entitlement_details = $this->get_employee_leave_entitlement_details($employee_id, $leave_type, $leave_date);
            $leave_entitlement_id = $employee_leave_entitlement_details[0]['LEAVE_ENTITLEMENT_ID'];
            $transaction_log_id = $employee_leave_entitlement_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL update_leave_entitlement_count(:leave_entitlement_id, :total_hours, :record_log)');
            $sql->bindValue(':total_hours', $total_hours);
            $sql->bindValue(':record_log', $record_log);
            $sql->bindValue(':leave_entitlement_id', $leave_entitlement_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated leave entitlement count (' . $leave_entitlement_id . ').');

                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_leave_file
    # Purpose    : Updates designation file
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function update_leave_file($attachment_file_tmp_name, $attachment_file_actual_ext, $leave_id, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');

            if(!empty($attachment_file_tmp_name)){ 
                $file_name = $this->generate_file_name(10);
                $file_new = $file_name . '.' . $attachment_file_actual_ext;
                $file_destination = $_SERVER['DOCUMENT_ROOT'] . '/worknest/leave_attachment/' . $file_new;
                $file_path = './leave_attachment/' . $file_new;
                
                $leave_details = $this->get_leave_details($leave_id);
                $leave_attachment_path = $leave_details[0]['FILE_PATH'];
                $transaction_log_id = $leave_details[0]['TRANSACTION_LOG_ID'];

                if(file_exists($leave_attachment_path)){
                    if (unlink($leave_attachment_path)) {
                        if(move_uploaded_file($attachment_file_tmp_name, $file_destination)){
                            $sql = $this->db_connection->prepare('CALL update_leave_file(:leave_id, :file_path, :transaction_log_id, :record_log)');
                            $sql->bindValue(':leave_id', $leave_id);
                            $sql->bindValue(':file_path', $file_path);
                            $sql->bindValue(':transaction_log_id', $transaction_log_id);
                            $sql->bindValue(':record_log', $record_log);
                        
                            if($sql->execute()){
                                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated leave attachment (' . $leave_id . ').');
                                    
                                if($insert_transaction_log == 1){
                                    return 1;
                                }
                                else{
                                    return $insert_transaction_log;
                                }
                            }
                            else{
                                return $sql->errorInfo()[2];
                            }
                        }
                        else{
                            return 'There was an error uploading your file.';
                        }
                    }
                    else {
                        return $leave_attachment_path . ' cannot be deleted due to an error.';
                    }
                }
                else{
                    if(move_uploaded_file($attachment_file_tmp_name, $file_destination)){
                        $sql = $this->db_connection->prepare('CALL update_leave_file(:leave_id, :file_path, :transaction_log_id, :record_log)');
                        $sql->bindValue(':leave_id', $leave_id);
                        $sql->bindValue(':file_path', $file_path);
                        $sql->bindValue(':transaction_log_id', $transaction_log_id);
                        $sql->bindValue(':record_log', $record_log);
                        
                        if($sql->execute()){
                            $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated leave attachment (' . $leave_id . ').');
                                    
                            if($insert_transaction_log == 1){
                                return 1;
                            }
                            else{
                                return $insert_transaction_log;
                            }
                        }
                        else{
                            return $sql->errorInfo()[2];
                        }
                    }
                    else{
                        return 'There was an error uploading your file.';
                    }
                }
            }
            else{
                return 1;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_leave_status
    # Purpose    : Update leave status
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_leave_status($leave_id, $status, $decision_remarks, $username){
        if ($this->databaseConnection()) {
            
            $system_date = date('Y-m-d');
            $system_time = date('H:i:s');

            if($status == 'REJ'){
                $record_log = 'REJ->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'Reject';
                $log = 'User ' . $username . ' rejected leave (' . $leave_id . ').';
            }
            else if($status == 'APV'){
                $record_log = 'APV->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'Approve';
                $log = 'User ' . $username . ' approved leave (' . $leave_id . ').';
            }
            else if($status == 'CAN'){
                $record_log = 'CAN->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'Cancel';
                $log = 'User ' . $username . ' approved leave (' . $leave_id . ').';
            }
            else{
                $record_log = 'APVSYS->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'Approved';
                $log = 'User ' . $username . ' approved system generated leave (' . $leave_id . ').';
            }

            $leave_details = $this->get_leave_details($leave_id);
            $transaction_log_id = $leave_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare("CALL update_leave_status(:leave_id, :leave_status, :decision_remarks, :system_date, :system_time, :username, :transaction_log_id, :record_log)");
            $sql->bindValue(':leave_id', $leave_id);
            $sql->bindValue(':leave_status', $status);
            $sql->bindValue(':decision_remarks', $decision_remarks);
            $sql->bindValue(':system_date', $system_date);
            $sql->bindValue(':system_time', $system_time);
            $sql->bindValue(':username', $username);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, $log_type, $log);

                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_employee_file_details
    # Purpose    : Updates employee file.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_employee_file_details($file_id, $file_name, $file_category, $remarks, $file_date, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $employee_file_details = $this->get_employee_file_details($file_id);

            if(!empty($employee_file_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $employee_file_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_employee_file_details(:file_id, :file_name, :file_category, :remarks, :file_date, :transaction_log_id, :record_log)');
            $sql->bindValue(':file_id', $file_id);
            $sql->bindValue(':file_name', $file_name);
            $sql->bindValue(':file_category', $file_category);
            $sql->bindValue(':remarks', $remarks);
            $sql->bindValue(':file_date', $file_date);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($employee_file_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated employee file (' . $file_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated employee file (' . $file_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_employee_file
    # Purpose    : Updates employee file.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_employee_file($file_tmp_name, $file_actual_ext, $file_id, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');

            if(!empty($file_tmp_name)){ 
                $file_name = $this->generate_file_name(10);
                $file_new = $file_name . '.' . $file_actual_ext;
                $file_destination = $_SERVER['DOCUMENT_ROOT'] . '/worknest/employee_file/' . $file_new;
                $file_path = './employee_file/' . $file_new;
                
                $employee_file_details = $this->get_employee_file_details($file_id);
                $employee_file_path = $employee_file_details[0]['FILE_PATH'];
                $transaction_log_id = $employee_file_details[0]['TRANSACTION_LOG_ID'];

                if(file_exists($employee_file_path)){
                    if (unlink($employee_file_path)) {
                        if(move_uploaded_file($file_tmp_name, $file_destination)){
                            $sql = $this->db_connection->prepare('CALL update_employee_file(:file_id, :file_path, :transaction_log_id, :record_log)');
                            $sql->bindValue(':file_id', $file_id);
                            $sql->bindValue(':file_path', $file_path);
                            $sql->bindValue(':transaction_log_id', $transaction_log_id);
                            $sql->bindValue(':record_log', $record_log);
                        
                            if($sql->execute()){
                                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated employee file (' . $file_id . ').');
                                    
                                if($insert_transaction_log == 1){
                                    return 1;
                                }
                                else{
                                    return $insert_transaction_log;
                                }
                            }
                            else{
                                return $sql->errorInfo()[2];
                            }
                        }
                        else{
                            return 'There was an error uploading your file.';
                        }
                    }
                    else {
                        return $employee_file_path . ' cannot be deleted due to an error.';
                    }
                }
                else{
                    if(move_uploaded_file($file_tmp_name, $file_destination)){
                        $sql = $this->db_connection->prepare('CALL update_employee_file(:file_id, :file_path, :transaction_log_id, :record_log)');
                        $sql->bindValue(':file_id', $file_id);
                        $sql->bindValue(':file_path', $file_path);
                        $sql->bindValue(':transaction_log_id', $transaction_log_id);
                        $sql->bindValue(':record_log', $record_log);
                        
                        if($sql->execute()){
                            $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated employee file (' . $file_id . ').');
                                    
                            if($insert_transaction_log == 1){
                                return 1;
                            }
                            else{
                                return $insert_transaction_log;
                            }
                        }
                        else{
                            return $sql->errorInfo()[2];
                        }
                    }
                    else{
                        return 'There was an error uploading your file.';
                    }
                }
            }
            else{
                return 1;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_user_account
    # Purpose    : Updates user account.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_user_account($user_code, $password, $password_expiry_date, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $user_account_details = $this->get_user_account_details($user_code);

            if(!empty($user_account_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $user_account_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_user_account(:user_code, :password, :password_expiry_date, :transaction_log_id, :record_log)');
            $sql->bindValue(':user_code', $user_code);
            $sql->bindValue(':password', $password);
            $sql->bindValue(':password_expiry_date', $password_expiry_date);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($user_account_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated user account (' . $user_code . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated user account (' . $user_code . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_employee_user_account
    # Purpose    : Updates employee user account.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_employee_user_account($employee_id, $user_code, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $employee_details = $this->get_employee_details($employee_id, '');

            if(!empty($employee_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $employee_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_employee_user_account(:employee_id, :user_code, :transaction_log_id, :record_log)');
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':user_code', $user_code);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($employee_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated employee user account (' . $employee_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated employee user account (' . $employee_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_user_account_lock_status
    # Purpose    : Updates user account lock status.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_user_account_lock_status($user_code, $transaction_type, $system_date, $username){
        if ($this->databaseConnection()) {
            $user_account_details = $this->get_user_account_details($user_code);
            $transaction_log_id = $user_account_details[0]['TRANSACTION_LOG_ID'];

            if($transaction_type == 'unlock'){
                $record_log = 'ULCK->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'Unlock';
                $log = 'User ' . $username . ' unlocked user account (' . $user_code . ').';
            }
            else{
                $record_log = 'LCK->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'Lock';
                $log = 'User ' . $username . ' locked user account (' . $user_code . ').';
            }

            $sql = $this->db_connection->prepare('CALL update_user_account_lock_status(:user_code, :transaction_type, :system_date, :record_log)');
            $sql->bindValue(':user_code', $user_code);
            $sql->bindValue(':transaction_type', $transaction_type);
            $sql->bindValue(':system_date', $system_date);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, $log_type, $log);
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_user_account_status
    # Purpose    : Updates user account status.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_user_account_status($user_code, $active, $username){
        if ($this->databaseConnection()) {
            $user_account_details = $this->get_user_account_details($user_code);
            $transaction_log_id = $user_account_details[0]['TRANSACTION_LOG_ID'];

            if($active == 1){
                $record_log = 'ACT->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'Activate';
                $log = 'User ' . $username . ' activated user account (' . $user_code . ').';
            }
            else{
                $record_log = 'DACT->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'Deactivated';
                $log = 'User ' . $username . ' deactivated user account (' . $user_code . ').';
            }

            $sql = $this->db_connection->prepare('CALL update_user_account_status(:user_code, :active, :record_log)');
            $sql->bindValue(':user_code', $user_code);
            $sql->bindValue(':active', $active);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, $log_type, $log);
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_holiday
    # Purpose    : Updates holiday.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_holiday($holiday_id, $holiday, $holiday_date, $holiday_type, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $holiday_details = $this->get_holiday_details($holiday_id);

            if(!empty($holiday_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $holiday_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_holiday(:holiday_id, :holiday, :holiday_date, :holiday_type, :transaction_log_id, :record_log)');
            $sql->bindValue(':holiday_id', $holiday_id);
            $sql->bindValue(':holiday', $holiday);
            $sql->bindValue(':holiday_date', $holiday_date);
            $sql->bindValue(':holiday_type', $holiday_type);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($holiday_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated holiday (' . $holiday_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated holiday (' . $holiday_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_attendance_setting
    # Purpose    : Updates attendance setting.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_attendance_setting($setting_id, $maximum_attendance, $time_out_allowance, $late_allowance, $late_policy, $early_leaving_policy, $attendance_creation_recommendation, $attendance_adjustment_recommendation, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $attendance_setting_details = $this->get_attendance_setting_details($setting_id);

            if(!empty($attendance_setting_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $attendance_setting_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_attendance_setting(:setting_id, :maximum_attendance, :time_out_allowance, :late_allowance, :late_policy, :early_leaving_policy, :attendance_creation_recommendation, :attendance_adjustment_recommendation, :transaction_log_id, :record_log)');
            $sql->bindValue(':setting_id', $setting_id);
            $sql->bindValue(':maximum_attendance', $maximum_attendance);
            $sql->bindValue(':time_out_allowance', $time_out_allowance);
            $sql->bindValue(':late_allowance', $late_allowance);
            $sql->bindValue(':late_policy', $late_policy);
            $sql->bindValue(':early_leaving_policy', $early_leaving_policy);
            $sql->bindValue(':attendance_creation_recommendation', $attendance_creation_recommendation);
            $sql->bindValue(':attendance_adjustment_recommendation', $attendance_adjustment_recommendation);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($attendance_setting_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated attendance setting (' . $setting_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated attendance setting (' . $setting_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_time_out
    # Purpose    : Updates attendance time out.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_time_out($attendance_id, $time_out_date, $time_out, $attendance_position, $ip_address, $time_out_behavior, $time_out_note, $early_leaving, $overtime, $total_hours_worked, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $employee_attendance_details = $this->get_employee_attendance_details($attendance_id);

            $employee_details = $this->get_employee_details('', $username);
            $scanned_employee_id = $employee_details[0]['EMPLOYEE_ID'];

            if(!empty($employee_attendance_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $employee_attendance_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_time_out(:attendance_id, :time_out_date, :time_out, :attendance_position, :ip_address, :scanned_employee_id, :time_out_behavior, :time_out_note, :early_leaving, :overtime, :total_hours_worked, :transaction_log_id, :record_log)');
            $sql->bindValue(':attendance_id', $attendance_id);
            $sql->bindValue(':time_out_date', $time_out_date);
            $sql->bindValue(':time_out', $time_out);
            $sql->bindValue(':attendance_position', $attendance_position);
            $sql->bindValue(':ip_address', $ip_address);
            $sql->bindValue(':scanned_employee_id', $scanned_employee_id);
            $sql->bindValue(':time_out_behavior', $time_out_behavior);
            $sql->bindValue(':time_out_note', $time_out_note);
            $sql->bindValue(':early_leaving', $early_leaving);
            $sql->bindValue(':overtime', $overtime);
            $sql->bindValue(':total_hours_worked', $total_hours_worked);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($employee_attendance_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated attendance time out (' . $attendance_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated attendance time out (' . $attendance_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_attendance_creation
    # Purpose    : Updates attendance creation.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_attendance_creation($request_id, $time_in_date, $time_in, $time_out_date, $time_out, $reason, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $attendance_creation_details = $this->get_attendance_creation_details($request_id);

            if(!empty($attendance_creation_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $attendance_creation_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_attendance_creation(:request_id, :time_in_date, :time_in, :time_out_date, :time_out, :reason, :transaction_log_id, :record_log)');
            $sql->bindValue(':request_id', $request_id);
            $sql->bindValue(':time_in_date', $time_in_date);
            $sql->bindValue(':time_in', $time_in);
            $sql->bindValue(':time_out_date', $time_out_date);
            $sql->bindValue(':time_out', $time_out);
            $sql->bindValue(':reason', $reason);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($attendance_creation_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated attendance creation (' . $request_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated attendance creation (' . $file_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_attendance_creation_file
    # Purpose    : Updates attendance creation file.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_attendance_creation_file($attendance_creation_file_tmp_name, $attendance_creation_file_actual_ext, $request_id, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');

            if(!empty($attendance_creation_file_tmp_name)){ 
                $file_name = $this->generate_file_name(10);
                $file_new = $file_name . '.' . $attendance_creation_file_actual_ext;
                $file_destination = $_SERVER['DOCUMENT_ROOT'] . '/worknest/attendance_creation/' . $file_new;
                $file_path = './attendance_creation/' . $file_new;
                
                $attendance_creation_details = $this->get_attendance_creation_details($request_id);
                $attendance_creation_file_path = $attendance_creation_details[0]['FILE_PATH'];
                $transaction_log_id = $attendance_creation_details[0]['TRANSACTION_LOG_ID'];

                if(file_exists($attendance_creation_file_path)){
                    if (unlink($attendance_creation_file_path)) {
                        if(move_uploaded_file($attendance_creation_file_tmp_name, $file_destination)){
                            $sql = $this->db_connection->prepare('CALL update_attendance_creation_file(:request_id, :file_path, :transaction_log_id, :record_log)');
                            $sql->bindValue(':request_id', $request_id);
                            $sql->bindValue(':file_path', $file_path);
                            $sql->bindValue(':transaction_log_id', $transaction_log_id);
                            $sql->bindValue(':record_log', $record_log);
                        
                            if($sql->execute()){
                                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated attendance creation file (' . $request_id . ').');
                                    
                                if($insert_transaction_log == 1){
                                    return 1;
                                }
                                else{
                                    return $insert_transaction_log;
                                }
                            }
                            else{
                                return $sql->errorInfo()[2];
                            }
                        }
                        else{
                            return 'There was an error uploading your file.';
                        }
                    }
                    else {
                        return $attendance_creation_file_path . ' cannot be deleted due to an error.';
                    }
                }
                else{
                    if(move_uploaded_file($attendance_creation_file_tmp_name, $file_destination)){
                        $sql = $this->db_connection->prepare('CALL update_attendance_creation_file(:request_id, :file_path, :transaction_log_id, :record_log)');
                        $sql->bindValue(':request_id', $request_id);
                        $sql->bindValue(':file_path', $file_path);
                        $sql->bindValue(':transaction_log_id', $transaction_log_id);
                        $sql->bindValue(':record_log', $record_log);
                        
                        if($sql->execute()){
                            $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated attendance creation file (' . $request_id . ').');
                                    
                            if($insert_transaction_log == 1){
                                return 1;
                            }
                            else{
                                return $insert_transaction_log;
                            }
                        }
                        else{
                            return $sql->errorInfo()[2];
                        }
                    }
                    else{
                        return 'There was an error uploading your file.';
                    }
                }
            }
            else{
                return 1;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_attendance_adjustment
    # Purpose    : Updates attendance adjustment.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_attendance_adjustment($request_id, $time_in_date, $time_in, $time_out_date, $time_out, $reason, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $attendance_adjustment_details = $this->get_attendance_adjustment_details($request_id);

            if(!empty($attendance_adjustment_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $attendance_adjustment_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_attendance_adjustment(:request_id, :time_in_date, :time_in, :time_out_date, :time_out, :reason, :transaction_log_id, :record_log)');
            $sql->bindValue(':request_id', $request_id);
            $sql->bindValue(':time_in_date', $time_in_date);
            $sql->bindValue(':time_in', $time_in);
            $sql->bindValue(':time_out_date', $time_out_date);
            $sql->bindValue(':time_out', $time_out);
            $sql->bindValue(':reason', $reason);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($attendance_adjustment_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated attendance adjustment (' . $request_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated attendance adjustment (' . $file_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_attendance_adjustment_file
    # Purpose    : Updates attendance adjustment file.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_attendance_adjustment_file($attendance_adjustment_file_tmp_name, $attendance_adjustment_file_actual_ext, $request_id, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');

            if(!empty($attendance_adjustment_file_tmp_name)){ 
                $file_name = $this->generate_file_name(10);
                $file_new = $file_name . '.' . $attendance_adjustment_file_actual_ext;
                $file_destination = $_SERVER['DOCUMENT_ROOT'] . '/worknest/attendance_adjustment/' . $file_new;
                $file_path = './attendance_adjustment/' . $file_new;
                
                $attendance_adjustment_details = $this->get_attendance_adjustment_details($request_id);
                $attendance_adjustment_file_path = $attendance_adjustment_details[0]['FILE_PATH'];
                $transaction_log_id = $attendance_adjustment_details[0]['TRANSACTION_LOG_ID'];

                if(file_exists($attendance_adjustment_file_path)){
                    if (unlink($attendance_adjustment_file_path)) {
                        if(move_uploaded_file($attendance_adjustment_file_tmp_name, $file_destination)){
                            $sql = $this->db_connection->prepare('CALL update_attendance_adjustment_file(:request_id, :file_path, :transaction_log_id, :record_log)');
                            $sql->bindValue(':request_id', $request_id);
                            $sql->bindValue(':file_path', $file_path);
                            $sql->bindValue(':transaction_log_id', $transaction_log_id);
                            $sql->bindValue(':record_log', $record_log);
                        
                            if($sql->execute()){
                                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated attendance adjustment file (' . $request_id . ').');
                                    
                                if($insert_transaction_log == 1){
                                    return 1;
                                }
                                else{
                                    return $insert_transaction_log;
                                }
                            }
                            else{
                                return $sql->errorInfo()[2];
                            }
                        }
                        else{
                            return 'There was an error uploading your file.';
                        }
                    }
                    else {
                        return $attendance_creation_file_path . ' cannot be deleted due to an error.';
                    }
                }
                else{
                    if(move_uploaded_file($attendance_adjustment_file_tmp_name, $file_destination)){
                        $sql = $this->db_connection->prepare('CALL update_attendance_adjustment_file(:request_id, :file_path, :transaction_log_id, :record_log)');
                        $sql->bindValue(':request_id', $request_id);
                        $sql->bindValue(':file_path', $file_path);
                        $sql->bindValue(':transaction_log_id', $transaction_log_id);
                        $sql->bindValue(':record_log', $record_log);
                    
                        if($sql->execute()){
                            $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated attendance adjustment file (' . $request_id . ').');
                                
                            if($insert_transaction_log == 1){
                                return 1;
                            }
                            else{
                                return $insert_transaction_log;
                            }
                        }
                        else{
                            return $sql->errorInfo()[2];
                        }
                    }
                    else{
                        return 'There was an error uploading your file.';
                    }
                }
            }
            else{
                return 1;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_attendance_creation_status
    # Purpose    : Update attendance creation status.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_attendance_creation_status($request_id, $status, $decision_remarks, $sanction, $username){
        if ($this->databaseConnection()) {
            
            $system_date = date('Y-m-d');
            $system_time = date('H:i:s');

            if($status == 'APV'){
                $record_log = 'APV->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'Approve';
                $log = 'User ' . $username . ' approved attendance creation (' . $request_id . ').';
            }
            else if($status == 'CAN'){
                $record_log = 'CAN->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'Cancel';
                $log = 'User ' . $username . ' cancelled attendance creation (' . $request_id . ').';
            }
            else if($status == 'FRREC'){
                $record_log = 'FRREC->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'For Recommendation';
                $log = 'User ' . $username . ' tagged the attendance creation for recommendation (' . $request_id . ').';
            }
            else if($status == 'REC'){
                $record_log = 'REC->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'Recommend';
                $log = 'User ' . $username . ' recommended attendance creation (' . $request_id . ').';
            }
            else if($status == 'PEN'){
                $record_log = 'PEN->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'Pending';
                $log = 'User ' . $username . ' tagged the attendance creation as pending (' . $request_id . ').';
            }
            else{
                $record_log = 'REJ->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'Reject';
                $log = 'User ' . $username . ' rejected attendance creation (' . $request_id . ').';
            }

            $attendance_creation_details = $this->get_attendance_creation_details($request_id);
            $transaction_log_id = $attendance_creation_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare("CALL update_attendance_creation_status(:request_id, :status, :decision_remarks, :sanction, :system_date, :system_time, :username, :transaction_log_id, :record_log)");
            $sql->bindValue(':request_id', $request_id);
            $sql->bindValue(':status', $status);
            $sql->bindValue(':decision_remarks', $decision_remarks);
            $sql->bindValue(':sanction', $sanction);
            $sql->bindValue(':system_date', $system_date);
            $sql->bindValue(':system_time', $system_time);
            $sql->bindValue(':username', $username);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, $log_type, $log);

                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_attendance_adjustment_status
    # Purpose    : Update attendance adjustment status.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_attendance_adjustment_status($request_id, $status, $decision_remarks, $sanction, $username){
        if ($this->databaseConnection()) {
            
            $system_date = date('Y-m-d');
            $system_time = date('H:i:s');

            if($status == 'APV'){
                $record_log = 'APV->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'Approve';
                $log = 'User ' . $username . ' approved attendance adjustment (' . $request_id . ').';
            }
            else if($status == 'CAN'){
                $record_log = 'CAN->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'Cancel';
                $log = 'User ' . $username . ' cancelled attendance adjustment (' . $request_id . ').';
            }
            else if($status == 'FRREC'){
                $record_log = 'FRREC->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'For Recommendation';
                $log = 'User ' . $username . ' tagged the attendance adjustment for recommendation (' . $request_id . ').';
            }
            else if($status == 'REC'){
                $record_log = 'REC->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'Recommend';
                $log = 'User ' . $username . ' recommended attendance adjustment (' . $request_id . ').';
            }
            else if($status == 'PEN'){
                $record_log = 'PEN->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'Pending';
                $log = 'User ' . $username . ' tagged the attendance adjustment as pending (' . $request_id . ').';
            }
            else{
                $record_log = 'REJ->' . $username . '->' . date('Y-m-d h:i:s');
                $log_type = 'Reject';
                $log = 'User ' . $username . ' rejected attendance adjustment (' . $request_id . ').';
            }

            $attendance_adjustment_details = $this->get_attendance_adjustment_details($request_id);
            $transaction_log_id = $attendance_adjustment_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare("CALL update_attendance_adjustment_status(:request_id, :status, :decision_remarks, :sanction, :system_date, :system_time, :username, :transaction_log_id, :record_log)");
            $sql->bindValue(':request_id', $request_id);
            $sql->bindValue(':status', $status);
            $sql->bindValue(':decision_remarks', $decision_remarks);
            $sql->bindValue(':sanction', $sanction);
            $sql->bindValue(':system_date', $system_date);
            $sql->bindValue(':system_time', $system_time);
            $sql->bindValue(':username', $username);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, $log_type, $log);

                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_allowance_type
    # Purpose    : Updates allowance type.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_allowance_type($allowance_type_id, $allowance_type, $taxable, $description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $allowance_type_details = $this->get_allowance_type_details($allowance_type_id);

            if(!empty($allowance_type_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $allowance_type_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_allowance_type(:allowance_type_id, :allowance_type, :taxable, :description, :transaction_log_id, :record_log)');
            $sql->bindValue(':allowance_type_id', $allowance_type_id);
            $sql->bindValue(':allowance_type', $allowance_type);
            $sql->bindValue(':taxable', $taxable);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($allowance_type_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated allowance type (' . $allowance_type_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated allowance type (' . $allowance_type_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_allowance
    # Purpose    : Updates allowance.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_allowance($allowance_id, $payroll_date, $amount, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $allowance_details = $this->get_allowance_details($allowance_id);

            if(!empty($allowance_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $allowance_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_allowance(:allowance_id, :payroll_date, :amount, :transaction_log_id, :record_log)');
            $sql->bindValue(':allowance_id', $allowance_id);
            $sql->bindValue(':payroll_date', $payroll_date);
            $sql->bindValue(':amount', $amount);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($allowance_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated allowance (' . $allowance_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated allowance (' . $allowance_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_deduction_type
    # Purpose    : Updates deduction type.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_deduction_type($deduction_type_id, $deduction_type, $description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $deduction_type_details = $this->get_deduction_type_details($deduction_type_id);

            if(!empty($deduction_type_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $deduction_type_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_deduction_type(:deduction_type_id, :deduction_type, :description, :transaction_log_id, :record_log)');
            $sql->bindValue(':deduction_type_id', $deduction_type_id);
            $sql->bindValue(':deduction_type', $deduction_type);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($deduction_type_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated deduction type (' . $deduction_type_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated deduction type (' . $deduction_type_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_government_contribution
    # Purpose    : Updates government contribution.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_government_contribution($government_contribution_id, $government_contribution, $description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $government_contribution_details = $this->get_government_contribution_details($government_contribution_id);

            if(!empty($government_contribution_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $government_contribution_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_government_contribution(:government_contribution_id, :government_contribution, :description, :transaction_log_id, :record_log)');
            $sql->bindValue(':government_contribution_id', $government_contribution_id);
            $sql->bindValue(':government_contribution', $government_contribution);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($government_contribution_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated government contribution (' . $government_contribution_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated government contribution (' . $government_contribution_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_contribution_bracket
    # Purpose    : Updates contribution bracket.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_contribution_bracket($contribution_bracket_id, $start_range, $end_range, $deduction_amount, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $contribution_bracket_details = $this->get_contribution_bracket_details($contribution_bracket_id);

            if(!empty($contribution_bracket_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $contribution_bracket_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_contribution_bracket(:contribution_bracket_id, :start_range, :end_range, :deduction_amount, :transaction_log_id, :record_log)');
            $sql->bindValue(':contribution_bracket_id', $contribution_bracket_id);
            $sql->bindValue(':start_range', $start_range);
            $sql->bindValue(':end_range', $end_range);
            $sql->bindValue(':deduction_amount', $deduction_amount);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($contribution_bracket_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated contribution bracket (' . $contribution_bracket_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated contribution bracket (' . $contribution_bracket_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_deduction
    # Purpose    : Updates deduction.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_deduction($deduction_id, $payroll_date, $amount, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $deduction_details = $this->get_deduction_details($deduction_id);

            if(!empty($deduction_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $deduction_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_deduction(:deduction_id, :payroll_date, :amount, :transaction_log_id, :record_log)');
            $sql->bindValue(':deduction_id', $deduction_id);
            $sql->bindValue(':payroll_date', $payroll_date);
            $sql->bindValue(':amount', $amount);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($deduction_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated deduction (' . $deduction_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated deduction (' . $deduction_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : update_contribution_deduction
    # Purpose    : Updates contribution deduction.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function update_contribution_deduction($contribution_deduction_id, $payroll_date, $username){
        if ($this->databaseConnection()) {
            $record_log = 'UPD->' . $username . '->' . date('Y-m-d h:i:s');
            $contribution_deduction_details = $this->get_contribution_deduction_details($contribution_deduction_id);

            if(!empty($contribution_deduction_details[0]['TRANSACTION_LOG_ID'])){
                $transaction_log_id = $contribution_deduction_details[0]['TRANSACTION_LOG_ID'];
            }
            else{
                # Get transaction log id
                $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
                $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
                $transaction_log_id = $transaction_log_system_parameter[0]['ID'];
            }

            $sql = $this->db_connection->prepare('CALL update_contribution_deduction(:contribution_deduction_id, :payroll_date, :transaction_log_id, :record_log)');
            $sql->bindValue(':contribution_deduction_id', $contribution_deduction_id);
            $sql->bindValue(':payroll_date', $payroll_date);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                if(!empty($contribution_deduction_details[0]['TRANSACTION_LOG_ID'])){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated contribution deduction (' . $contribution_deduction_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Update', 'User ' . $username . ' updated contribution deduction (' . $contribution_deduction_id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Insert methods
    # -------------------------------------------------------------
    
    # -------------------------------------------------------------
    #
    # Name       : insert_transaction_log
    # Purpose    : Inserts user log activities.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_transaction_log($transaction_log_id, $username, $log_type, $log){
        if ($this->databaseConnection()) {
            $log_date = date('Y-m-d H:i:s');

            $sql = $this->db_connection->prepare('CALL insert_transaction_log(:transaction_log_id, :username, :log_type, :log_date, :log)');
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':username', $username);
            $sql->bindValue(':log_type', $log_type);
            $sql->bindValue(':log_date', $log_date);
            $sql->bindValue(':log', $log);

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_system_parameter
    # Purpose    : Insert system parameter.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_system_parameter($parameter, $extension, $number, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(1, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_system_parameter(:id, :parameter, :extension, :number, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':parameter', $parameter);
            $sql->bindValue(':extension', $extension);
            $sql->bindValue(':number', $number);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 1, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted system parameter (' . $id . ').');
                                        
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_policy
    # Purpose    : Insert policy.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_policy($policy, $description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(3, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_policy(:id, :policy, :description, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':policy', $policy);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 3, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted policy (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_permission
    # Purpose    : Insert permission.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_permission($policy_id, $permission, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(4, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_permission(:id, :policy_id, :permission, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':policy_id', $policy_id);
            $sql->bindValue(':permission', $permission);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 4, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted permission (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_role
    # Purpose    : Insert role.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_role($role, $description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(5, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_role(:id, :role, :description, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':role', $role);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 5, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted role (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_permission_role
    # Purpose    : Insert role permission.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_permission_role($role_id, $permission_id, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            $sql = $this->db_connection->prepare('CALL insert_permission_role(:role_id, :permission_id, :record_log)');
            $sql->bindValue(':role_id', $role_id);
            $sql->bindValue(':permission_id', $permission_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_system_code
    # Purpose    : Insert system code.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_system_code($system_type, $system_code, $system_description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_system_code(:system_type, :system_code, :system_description, :transaction_log_id, :record_log)');
            $sql->bindValue(':system_type', $system_type);
            $sql->bindValue(':system_code', $system_code);
            $sql->bindValue(':system_description', $system_description);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                # Update transaction log value
                $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                if($update_system_parameter_value == 1){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted system code (' . $system_code . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_user_interface_settings
    # Purpose    : Insert application setting.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_user_interface_settings($setting_id, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_user_interface_settings(:setting_id, :transaction_log_id, :record_log)');
            $sql->bindValue(':setting_id', $setting_id);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update transaction log value
                $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                if($update_system_parameter_value == 1){
                    $insert_transaction_log = $this->insert_transaction_log($username, 'Insert', 'User ' . $username . ' inserted application setting (' . $setting_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_email_configuration
    # Purpose    : Insert email configuration.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_email_configuration($mail_id, $mail_host, $port, $smtp_auth, $smtp_auto_tls, $mail_user, $mail_password, $mail_encryption, $mail_from_name, $mail_from_email, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_email_configuration(:mail_id, :mail_host, :port, :smtp_auth, :smtp_auto_tls, :mail_user, :mail_password, :mail_encryption, :mail_from_name, :mail_from_email, :transaction_log_id, :record_log)');
            $sql->bindValue(':mail_id', $mail_id);
            $sql->bindValue(':mail_host', $mail_host);
            $sql->bindValue(':port', $port);
            $sql->bindValue(':smtp_auth', $smtp_auth);
            $sql->bindValue(':smtp_auto_tls', $smtp_auto_tls);
            $sql->bindValue(':mail_user', $mail_user);
            $sql->bindValue(':mail_password', $mail_password);
            $sql->bindValue(':mail_encryption', $mail_encryption);
            $sql->bindValue(':mail_from_name', $mail_from_name);
            $sql->bindValue(':mail_from_email', $mail_from_email);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update transaction log value
                $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                if($update_system_parameter_value == 1){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted email configuration (' . $mail_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_notification_type
    # Purpose    : Insert notification type.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_notification_type($notification, $description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(6, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_notification_type(:id, :notification, :description, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':notification', $notification);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 6, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted notification type (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_notification_details
    # Purpose    : Insert notification details.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_notification_details($notification_id, $notification_title, $notification_message, $system_link, $web_link, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_notification_details(:notification_id, :notification_title, :notification_message, :system_link, :web_link, :transaction_log_id, :record_log)');
            $sql->bindValue(':notification_id', $notification_id);
            $sql->bindValue(':notification_title', $notification_title);
            $sql->bindValue(':notification_message', $notification_message);
            $sql->bindValue(':system_link', $system_link);
            $sql->bindValue(':web_link', $web_link);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update transaction log value
                $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                if($update_system_parameter_value == 1){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted notification details (' . $notification_id . ').');
                                
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_notification_recipient
    # Purpose    : Insert notification recipient details.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_notification_recipient($notification_id, $notification_recipient, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            $sql = $this->db_connection->prepare('CALL insert_notification_recipient(:notification_id, :notification_recipient, :record_log)');
            $sql->bindValue(':notification_id', $notification_id);
            $sql->bindValue(':notification_recipient', $notification_recipient);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_application_notification
    # Purpose    : Insert application notification.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_application_notification($notification_id, $notification_type, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            $sql = $this->db_connection->prepare('CALL insert_application_notification(:notification_id, :notification_type, :record_log)');
            $sql->bindValue(':notification_id', $notification_id);
            $sql->bindValue(':notification_type', $notification_type);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_company_setting
    # Purpose    : Insert company setting.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_company_setting($company_id, $company_name, $email, $telephone, $phone, $website, $address, $province, $city, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_company_setting(:company_id, :company_name, :email, :telephone, :phone, :website, :address, :province, :city, :transaction_log_id, :record_log)');
            $sql->bindValue(':company_id', $company_id);
            $sql->bindValue(':company_name', $company_name);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':telephone', $telephone);
            $sql->bindValue(':phone', $phone);
            $sql->bindValue(':website', $website);
            $sql->bindValue(':address', $address);
            $sql->bindValue(':province', $province);
            $sql->bindValue(':city', $city);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                # Update transaction log value
                $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                if($update_system_parameter_value == 1){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted company setting (' . $company_id . ').');
                                    
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_department
    # Purpose    : Insert department.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_department($department, $description, $department_head, $parent_department, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(7, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_department(:id, :department, :description, :department_head, :parent_department, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':department', $department);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':department_head', $department_head);
            $sql->bindValue(':parent_department', $parent_department);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 7, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted department (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_designation
    # Purpose    : Insert designation.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_designation($job_description_tmp_name, $job_description_actual_ext, $designation, $description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(8, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_designation(:id, :designation, :description, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':designation', $designation);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 8, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted designation (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            if(!empty($job_description_tmp_name)){
                                $update_designation_file = $this->update_designation_file($job_description_tmp_name, $job_description_actual_ext, $id, $username);
        
                                if($update_designation_file == '1'){
                                    return 1;
                                }
                                else{
                                    return $update_designation_file;
                                }
                            }
                            else{
                                return 1;
                            }
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_branch
    # Purpose    : Insert branch.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_branch($branch, $email, $phone, $telephone, $address, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(9, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_branch(:id, :branch, :email, :phone, :telephone, :address, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':branch', $branch);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':phone', $phone);
            $sql->bindValue(':telephone', $telephone);
            $sql->bindValue(':address', $address);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 9, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted branch (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_upload_setting
    # Purpose    : Insert upload setting.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_upload_setting($upload_setting, $description, $max_file_size, $file_types, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');
            $error = '';

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(10, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_upload_setting(:id, :upload_setting, :description, :max_file_size, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':upload_setting', $upload_setting);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':max_file_size', $max_file_size);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                foreach($file_types as $file_type){
                    $insert_upload_file_type = $this->insert_upload_file_type($id, $file_type, $username);

                    if($insert_upload_file_type != '1'){
                        $error = $insert_upload_file_type;
                    }
                }

                if(empty($error)){
                    # Update system parameter value
                    $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 10, $username);

                    if($update_system_parameter_value == 1){
                        # Update transaction log value
                        $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                        if($update_system_parameter_value == 1){
                            $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted upload setting (' . $id . ').');
                                        
                            if($insert_transaction_log == 1){
                                return 1;
                            }
                            else{
                                return $insert_transaction_log;
                            }
                        }
                        else{
                            return $update_system_parameter_value;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $error;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_upload_file_type
    # Purpose    : Insert upload file type.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_upload_file_type($setting_id, $file_type, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            $sql = $this->db_connection->prepare('CALL insert_upload_file_type(:setting_id, :file_type, :record_log)');
            $sql->bindValue(':setting_id', $setting_id);
            $sql->bindValue(':file_type', $file_type);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_employment_status
    # Purpose    : Insert employment status.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_employment_status($employment_status, $color_value, $description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(11, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_employment_status(:id, :employment_status, :description, :color_value, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':employment_status', $employment_status);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':color_value', $color_value);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 11, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted employment status (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_employee
    # Purpose    : Insert employee.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_employee($id_number, $file_as, $first_name, $middle_name, $last_name, $suffix, $birthday, $employment_status, $joining_date, $permanency_date, $exit_date, $exit_reason, $email, $phone, $telephone, $department, $designation, $branch, $gender, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(12, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_employee(:id, :id_number, :file_as, :first_name, :middle_name, :last_name, :suffix, :birthday, :employment_status, :joining_date, :permanency_date, :exit_date, :exit_reason, :email, :phone, :telephone, :department, :designation, :branch, :gender, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':id_number', $id_number);
            $sql->bindValue(':file_as', $file_as);
            $sql->bindValue(':first_name', $first_name);
            $sql->bindValue(':middle_name', $middle_name);
            $sql->bindValue(':last_name', $last_name);
            $sql->bindValue(':suffix', $suffix);
            $sql->bindValue(':birthday', $birthday);
            $sql->bindValue(':employment_status', $employment_status);
            $sql->bindValue(':joining_date', $joining_date);
            $sql->bindValue(':permanency_date', $permanency_date);
            $sql->bindValue(':exit_date', $exit_date);
            $sql->bindValue(':exit_reason', $exit_reason);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':phone', $phone);
            $sql->bindValue(':telephone', $telephone);
            $sql->bindValue(':department', $department);
            $sql->bindValue(':designation', $designation);
            $sql->bindValue(':branch', $branch);
            $sql->bindValue(':gender', $gender);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 12, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted employee (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_emergency_contact
    # Purpose    : Insert emergency contact.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_emergency_contact($employee_id, $contact_name, $relationship, $email, $phone, $telephone, $address, $city, $province, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(13, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_emergency_contact(:id, :employee_id, :contact_name, :relationship, :email, :phone, :telephone, :address, :city, :province, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':contact_name', $contact_name);
            $sql->bindValue(':relationship', $relationship);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':phone', $phone);
            $sql->bindValue(':telephone', $telephone);
            $sql->bindValue(':address', $address);
            $sql->bindValue(':city', $city);
            $sql->bindValue(':province', $province);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 13, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted emergency contact (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_employee_address
    # Purpose    : Insert employee address.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_employee_address($employee_id, $address_type, $address, $city, $province, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(14, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_employee_address(:id, :employee_id, :address_type, :address, :city, :province, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':address_type', $address_type);
            $sql->bindValue(':address', $address);
            $sql->bindValue(':city', $city);
            $sql->bindValue(':province', $province);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 14, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted employee address (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_employee_social
    # Purpose    : Insert employee social.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_employee_social($employee_id, $social_type, $link, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(15, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_employee_social(:id, :employee_id, :social_type, :link, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':social_type', $social_type);
            $sql->bindValue(':link', $link);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 15, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted employee social (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_work_shift
    # Purpose    : Insert work shift.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_work_shift($work_shift, $work_shift_type, $description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(16, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_work_shift(:id, :work_shift, :work_shift_type, :description, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':work_shift', $work_shift);
            $sql->bindValue(':work_shift_type', $work_shift_type);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 16, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted work shift (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_work_shift_schedule
    # Purpose    : Insert work shift schedule.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_work_shift_schedule($work_shift_id, $start_date, $end_date, $monday_start_time, $monday_end_time, $monday_lunch_start_time, $monday_lunch_end_time, $monday_half_day_mark, $tuesday_start_time, $tuesday_end_time, $tuesday_lunch_start_time, $tuesday_lunch_end_time, $tuesday_half_day_mark, $wednesday_start_time, $wednesday_end_time, $wednesday_lunch_start_time, $wednesday_lunch_end_time, $wednesday_half_day_mark, $thursday_start_time, $thursday_end_time, $thursday_lunch_start_time, $thursday_lunch_end_time, $thursday_half_day_mark, $friday_start_time, $friday_end_time, $friday_lunch_start_time, $friday_lunch_end_time, $friday_half_day_mark, $saturday_start_time, $saturday_end_time, $saturday_lunch_start_time, $saturday_lunch_end_time, $saturday_half_day_mark, $sunday_start_time, $sunday_end_time, $sunday_lunch_start_time, $sunday_lunch_end_time, $sunday_half_day_mark, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            $work_shift_details = $this->get_work_shift_details($work_shift_id);
            $transaction_log_id = $work_shift_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL insert_work_shift_schedule(:work_shift_id, :start_date, :end_date, :monday_start_time, :monday_end_time, :monday_lunch_start_time, :monday_lunch_end_time, :monday_half_day_mark, :tuesday_start_time, :tuesday_end_time, :tuesday_lunch_start_time, :tuesday_lunch_end_time, :tuesday_half_day_mark, :wednesday_start_time, :wednesday_end_time, :wednesday_lunch_start_time, :wednesday_lunch_end_time, :wednesday_half_day_mark, :thursday_start_time, :thursday_end_time, :thursday_lunch_start_time, :thursday_lunch_end_time, :thursday_half_day_mark, :friday_start_time, :friday_end_time, :friday_lunch_start_time, :friday_lunch_end_time, :friday_half_day_mark, :saturday_start_time, :saturday_end_time, :saturday_lunch_start_time, :saturday_lunch_end_time, :saturday_half_day_mark, :sunday_start_time, :sunday_end_time, :sunday_lunch_start_time, :sunday_lunch_end_time, :sunday_half_day_mark, :record_log)');
            $sql->bindValue(':work_shift_id', $work_shift_id);
            $sql->bindValue(':start_date', $start_date);
            $sql->bindValue(':end_date', $end_date);
            $sql->bindValue(':monday_start_time', $monday_start_time);
            $sql->bindValue(':monday_end_time', $monday_end_time);
            $sql->bindValue(':monday_lunch_start_time', $monday_lunch_start_time);
            $sql->bindValue(':monday_lunch_end_time', $monday_lunch_end_time);
            $sql->bindValue(':monday_half_day_mark', $monday_half_day_mark);
            $sql->bindValue(':tuesday_start_time', $tuesday_start_time);
            $sql->bindValue(':tuesday_end_time', $tuesday_end_time);
            $sql->bindValue(':tuesday_lunch_start_time', $tuesday_lunch_start_time);
            $sql->bindValue(':tuesday_lunch_end_time', $tuesday_lunch_end_time);
            $sql->bindValue(':tuesday_half_day_mark', $tuesday_half_day_mark);
            $sql->bindValue(':wednesday_start_time', $wednesday_start_time);
            $sql->bindValue(':wednesday_end_time', $wednesday_end_time);
            $sql->bindValue(':wednesday_lunch_start_time', $wednesday_lunch_start_time);
            $sql->bindValue(':wednesday_lunch_end_time', $wednesday_lunch_end_time);
            $sql->bindValue(':wednesday_half_day_mark', $wednesday_half_day_mark);
            $sql->bindValue(':thursday_start_time', $thursday_start_time);
            $sql->bindValue(':thursday_end_time', $thursday_end_time);
            $sql->bindValue(':thursday_lunch_start_time', $thursday_lunch_start_time);
            $sql->bindValue(':thursday_lunch_end_time', $thursday_lunch_end_time);
            $sql->bindValue(':thursday_half_day_mark', $thursday_half_day_mark);
            $sql->bindValue(':friday_start_time', $friday_start_time);
            $sql->bindValue(':friday_end_time', $friday_end_time);
            $sql->bindValue(':friday_lunch_start_time', $friday_lunch_start_time);
            $sql->bindValue(':friday_lunch_end_time', $friday_lunch_end_time);
            $sql->bindValue(':friday_half_day_mark', $friday_half_day_mark);
            $sql->bindValue(':saturday_start_time', $saturday_start_time);
            $sql->bindValue(':saturday_end_time', $saturday_end_time);
            $sql->bindValue(':saturday_lunch_start_time', $saturday_lunch_start_time);
            $sql->bindValue(':saturday_lunch_end_time', $saturday_lunch_end_time);
            $sql->bindValue(':saturday_half_day_mark', $saturday_half_day_mark);
            $sql->bindValue(':sunday_start_time', $sunday_start_time);
            $sql->bindValue(':sunday_end_time', $sunday_end_time);
            $sql->bindValue(':sunday_lunch_start_time', $sunday_lunch_start_time);
            $sql->bindValue(':sunday_lunch_end_time', $sunday_lunch_end_time);
            $sql->bindValue(':sunday_half_day_mark', $sunday_half_day_mark);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted work shift schedule (' . $work_shift_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_employee_work_shift
    # Purpose    : Insert employee work shift.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_employee_work_shift($work_shift_id, $employee, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            $sql = $this->db_connection->prepare('CALL insert_employee_work_shift(:work_shift_id, :employee, :record_log)');
            $sql->bindValue(':work_shift_id', $work_shift_id);
            $sql->bindValue(':employee', $employee);
            $sql->bindValue(':record_log', $record_log);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_manual_employee_attendance
    # Purpose    : Insert employee attendance.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_manual_employee_attendance($employee_id, $time_in_date, $time_in, $time_in_behavior, $time_out_date, $time_out, $time_out_behavior, $late, $early_leaving, $overtime, $total_hours_worked, $remarks, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(17, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_manual_employee_attendance(:id, :employee_id, :time_in_date, :time_in, :time_in_behavior, :time_out_date, :time_out, :time_out_behavior, :late, :early_leaving, :overtime, :total_hours_worked, :remarks, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':time_in_date', $time_in_date);
            $sql->bindValue(':time_in', $time_in);
            $sql->bindValue(':time_in_behavior', $time_in_behavior);
            $sql->bindValue(':time_out_date', $time_out_date);
            $sql->bindValue(':time_out', $time_out);
            $sql->bindValue(':time_out_behavior', $time_out_behavior);
            $sql->bindValue(':late', $late);
            $sql->bindValue(':early_leaving', $early_leaving);
            $sql->bindValue(':overtime', $overtime);
            $sql->bindValue(':total_hours_worked', $total_hours_worked);
            $sql->bindValue(':remarks', $remarks);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 17, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted employee attendance (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_leave_type
    # Purpose    : Insert leave type.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_leave_type($leave_name, $description, $no_leaves, $paid_status, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(18, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_leave_type(:id, :leave_name, :description, :no_leaves, :paid_status, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':leave_name', $leave_name);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':no_leaves', $no_leaves);
            $sql->bindValue(':paid_status', $paid_status);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 18, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted leave type (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_leave_entitlement
    # Purpose    : Insert leave entitlement.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_leave_entitlement($employee, $leave_type, $no_leaves, $start_date, $end_date, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(19, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_leave_entitlement(:id, :employee, :leave_type, :no_leaves, :start_date, :end_date, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':employee', $employee);
            $sql->bindValue(':leave_type', $leave_type);
            $sql->bindValue(':no_leaves', $no_leaves);
            $sql->bindValue(':start_date', $start_date);
            $sql->bindValue(':end_date', $end_date);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 19, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted leave entitlement (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_leave
    # Purpose    : Insert leave.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_leave($employee_id, $leave_type, $leave_date, $start_time, $end_time, $leave_status, $reason, $decision_date, $decision_time, $decision_by, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(20, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_leave(:id, :employee_id, :leave_type, :leave_date, :start_time, :end_time, :leave_status, :reason, :decision_date, :decision_time, :decision_by, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':leave_type', $leave_type);
            $sql->bindValue(':leave_date', $leave_date);
            $sql->bindValue(':start_time', $start_time);
            $sql->bindValue(':end_time', $end_time);
            $sql->bindValue(':leave_status', $leave_status);
            $sql->bindValue(':reason', $reason);
            $sql->bindValue(':decision_date', $decision_date);
            $sql->bindValue(':decision_time', $decision_time);
            $sql->bindValue(':decision_by', $decision_by);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 20, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted leave (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_employee_file
    # Purpose    : Insert employee file.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_employee_file($file_tmp_name, $file_actual_ext, $employee_id, $file_name, $file_category, $remarks, $file_date, $system_date, $current_time, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(21, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_employee_file(:id, :employee_id, :file_name, :file_category, :remarks, :file_date, :system_date, :current_time, :username, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':file_name', $file_name);
            $sql->bindValue(':file_category', $file_category);
            $sql->bindValue(':remarks', $remarks);
            $sql->bindValue(':file_date', $file_date);
            $sql->bindValue(':system_date', $system_date);
            $sql->bindValue(':current_time', $current_time);
            $sql->bindValue(':username', $username);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 21, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted employee file (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            $update_employee_file = $this->update_employee_file($file_tmp_name, $file_actual_ext, $id, $username);
        
                            if($update_employee_file == '1'){
                                return 1;
                            }
                            else{
                                return $update_employee_file;
                            }
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_user_account
    # Purpose    : Insert user account.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_user_account($user_code, $password, $password_expiry_date, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_user_account(:user_code, :password, :password_expiry_date, :transaction_log_id, :record_log)');
            $sql->bindValue(':user_code', $user_code);
            $sql->bindValue(':password', $password);
            $sql->bindValue(':password_expiry_date', $password_expiry_date);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update transaction log value
                $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                if($update_system_parameter_value == 1){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted user account (' . $user_code . ').');
                                 
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------
     
    # -------------------------------------------------------------
    #
    # Name       : insert_user_role
    # Purpose    : Insert user account role.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_user_role($user_code, $role, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            $sql = $this->db_connection->prepare('CALL insert_user_role(:user_code, :role, :record_log)');
            $sql->bindValue(':user_code', $user_code);
            $sql->bindValue(':role', $role);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_holiday
    # Purpose    : Insert holiday.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_holiday($holiday, $holiday_date, $holiday_type, $branches, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');
            $error = '';

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(22, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_holiday(:id, :holiday, :holiday_date, :holiday_type, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':holiday', $holiday);
            $sql->bindValue(':holiday_date', $holiday_date);
            $sql->bindValue(':holiday_type', $holiday_type);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 22, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted holiday (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            foreach($branches as $branch){
                                $insert_holiday_branch = $this->insert_holiday_branch($id, $branch, $username);
    
                                if($insert_holiday_branch != 1){
                                    $error = $insert_holiday_branch;
                                }
                            }

                            if(empty($error)){
                                return 1;
                            }
                            else{
                                return $error;
                            }
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_holiday_branch
    # Purpose    : Insert holiday branch.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_holiday_branch($holiday_id, $branch, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            $sql = $this->db_connection->prepare('CALL insert_holiday_branch(:holiday_id, :branch, :record_log)');
            $sql->bindValue(':holiday_id', $holiday_id);
            $sql->bindValue(':branch', $branch);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_attendance_setting
    # Purpose    : Insert attendance setting.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_attendance_setting($setting_id, $maximum_attendance, $time_out_allowance, $late_allowance, $late_policy, $early_leaving_policy, $attendance_creation_recommendation, $attendance_adjustment_recommendation, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_attendance_setting(:setting_id, :maximum_attendance, :time_out_allowance, :late_allowance, :late_policy, :early_leaving_policy, :transaction_log_id, :record_log)');
            $sql->bindValue(':setting_id', $setting_id);
            $sql->bindValue(':maximum_attendance', $maximum_attendance);
            $sql->bindValue(':time_out_allowance', $time_out_allowance);
            $sql->bindValue(':late_allowance', $late_allowance);
            $sql->bindValue(':late_policy', $late_policy);
            $sql->bindValue(':early_leaving_policy', $early_leaving_policy);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
               # Update transaction log value
               $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

               if($update_system_parameter_value == 1){
                    $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted attendance setting (' . $setting_id . ').');
                                
                    if($insert_transaction_log == 1){
                        return 1;
                    }
                    else{
                        return $insert_transaction_log;
                    }
               }
               else{
                   return $update_system_parameter_value;
               }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_attendance_creation_approval
    # Purpose    : Insert attendance creation approval.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_attendance_creation_approval($employee_id, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            $sql = $this->db_connection->prepare('CALL insert_attendance_creation_approval(:employee_id, :record_log)');
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_attendance_adjustment_approval
    # Purpose    : Insert attendance adjustment approval.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_attendance_adjustment_approval($employee_id, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            $sql = $this->db_connection->prepare('CALL insert_attendance_adjustment_approval(:employee_id, :record_log)');
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_time_in
    # Purpose    : Insert attendance time in.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_time_in($employee_id, $time_in_date, $time_in, $attendance_position, $ip_address, $time_in_behavior, $time_in_note, $late, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');
            
            $employee_details = $this->get_employee_details('', $username);
            $scanned_employee_id = $employee_details[0]['EMPLOYEE_ID'];

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(17, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_time_in(:id, :employee_id, :time_in_date, :time_in, :attendance_position, :ip_address, :scanned_employee_id, :time_in_behavior, :time_in_note, :late, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':time_in_date', $time_in_date);
            $sql->bindValue(':time_in', $time_in);
            $sql->bindValue(':attendance_position', $attendance_position);
            $sql->bindValue(':ip_address', $ip_address);
            $sql->bindValue(':scanned_employee_id', $scanned_employee_id);
            $sql->bindValue(':time_in_behavior', $time_in_behavior);
            $sql->bindValue(':time_in_note', $time_in_note);
            $sql->bindValue(':late', $late);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 17, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted attendance time in (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_health_declaration
    # Purpose    : Insert health declaration.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_health_declaration($employee_id, $temperature, $question_1, $question_2, $question_3, $question_4, $question_5, $specific, $system_date, $current_time, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(23, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_health_declaration(:id, :employee_id, :temperature, :question_1, :question_2, :question_3, :question_4, :question_5, :specific, :system_date, :current_time, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':temperature', $temperature);
            $sql->bindValue(':question_1', $question_1);
            $sql->bindValue(':question_2', $question_2);
            $sql->bindValue(':question_3', $question_3);
            $sql->bindValue(':question_4', $question_4);
            $sql->bindValue(':question_5', $question_5);
            $sql->bindValue(':specific', $specific);
            $sql->bindValue(':system_date', $system_date);
            $sql->bindValue(':current_time', $current_time);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 23, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted health declaration (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_location
    # Purpose    : Insert location.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_location($employee_id, $position, $system_date, $current_time, $remarks, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(24, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_location(:id, :employee_id, :position, :system_date, :current_time, :remarks, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':position', $position);
            $sql->bindValue(':system_date', $system_date);
            $sql->bindValue(':current_time', $current_time);
            $sql->bindValue(':remarks', $remarks);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 24, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted location (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_system_notification
    # Purpose    : Insert system notification.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_system_notification($notification_id, $notification_from, $notification_to, $title, $message, $link, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');
            $system_date = date('Y-m-d');
            $current_time = date('H:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(25, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_system_notification(:id, :notification_from, :notification_to, :title, :message, :link, :system_date, :current_time, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':notification_from', $notification_from);
            $sql->bindValue(':notification_to', $notification_to);
            $sql->bindValue(':title', $title);
            $sql->bindValue(':message', $message);
            $sql->bindValue(':link', $link);
            $sql->bindValue(':system_date', $system_date);
            $sql->bindValue(':current_time', $current_time);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 25, $username);

                if($update_system_parameter_value == 1){
                    return 1;
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_attendance_creation
    # Purpose    : Insert attendance creation.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_attendance_creation($attendance_creation_file_tmp_name, $attendance_creation_file_actual_ext, $employee_id, $time_in_date, $time_in, $time_out_date, $time_out, $reason, $system_date, $current_time, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(26, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_attendance_creation(:id, :employee_id, :time_in_date, :time_in, :time_out_date, :time_out, :reason, :system_date, :current_time, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':time_in_date', $time_in_date);
            $sql->bindValue(':time_in', $time_in);
            $sql->bindValue(':time_out_date', $time_out_date);
            $sql->bindValue(':time_out', $time_out);
            $sql->bindValue(':reason', $reason);
            $sql->bindValue(':system_date', $system_date);
            $sql->bindValue(':current_time', $current_time);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 26, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted attendance creation (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            $update_attendance_creation_file = $this->update_attendance_creation_file($attendance_creation_file_tmp_name, $attendance_creation_file_actual_ext, $id, $username);
        
                            if($update_attendance_creation_file == 1){
                                return 1;
                            }
                            else{
                                return $update_attendance_creation_file;
                            }
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_attendance_adjustment
    # Purpose    : Insert attendance adjustment.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_attendance_adjustment($attendance_adjustment_file_tmp_name, $attendance_adjustment_file_actual_ext, $employee_id, $attendance_id, $time_in_date_default, $time_in_default, $time_in_date, $time_in, $time_out_date_default, $time_out_default, $time_out_date, $time_out, $reason, $system_date, $current_time, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(27, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_attendance_adjustment(:id, :employee_id, :attendance_id, :time_in_date_default, :time_in_default, :time_in_date, :time_in, :time_out_date_default, :time_out_default, :time_out_date, :time_out, :reason, :system_date, :current_time, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':attendance_id', $attendance_id);
            $sql->bindValue(':time_in_date_default', $time_in_date_default);
            $sql->bindValue(':time_in_default', $time_in_default);
            $sql->bindValue(':time_in_date', $time_in_date);
            $sql->bindValue(':time_in', $time_in);
            $sql->bindValue(':time_out_date_default', $time_out_date_default);
            $sql->bindValue(':time_out_default', $time_out_default);
            $sql->bindValue(':time_out_date', $time_out_date);
            $sql->bindValue(':time_out', $time_out);
            $sql->bindValue(':reason', $reason);
            $sql->bindValue(':system_date', $system_date);
            $sql->bindValue(':current_time', $current_time);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 27, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted attendance adjustment (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            $update_attendance_adjustment_file = $this->update_attendance_adjustment_file($attendance_adjustment_file_tmp_name, $attendance_adjustment_file_actual_ext, $id, $username);
        
                            if($update_attendance_adjustment_file == 1){
                                return 1;
                            }
                            else{
                                return $update_attendance_adjustment_file;
                            }
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_allowance_type
    # Purpose    : Insert allowance type.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_allowance_type($allowance_type, $taxable, $description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(28, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_allowance_type(:id, :allowance_type, :taxable, :description, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':allowance_type', $allowance_type);
            $sql->bindValue(':taxable', $taxable);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 28, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted allowance type (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_allowance
    # Purpose    : Insert allowance.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_allowance($employee_id, $allowance_type, $payroll_date, $amount, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(29, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_allowance(:id, :employee_id, :allowance_type, :payroll_date, :amount, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':allowance_type', $allowance_type);
            $sql->bindValue(':payroll_date', $payroll_date);
            $sql->bindValue(':amount', $amount);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 29, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted allowance (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_deduction_type
    # Purpose    : Insert deduction type.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_deduction_type($deduction_type, $description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(30, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_deduction_type(:id, :deduction_type, :description, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':deduction_type', $deduction_type);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 30, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted deduction type (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # ------------------------------------------------------------
    #
    # Name       : insert_government_contribution
    # Purpose    : Insert government contribution.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_government_contribution($government_contribution, $description, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(31, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_government_contribution(:id, :government_contribution, :description, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':government_contribution', $government_contribution);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 31, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted government contribution (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # ------------------------------------------------------------
    #
    # Name       : insert_contribution_bracket
    # Purpose    : Insert contribution bracket.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_contribution_bracket($government_contribution_id, $start_range, $end_range, $deduction_amount, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(32, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_contribution_bracket(:id, :government_contribution_id, :start_range, :end_range, :deduction_amount, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':government_contribution_id', $government_contribution_id);
            $sql->bindValue(':start_range', $start_range);
            $sql->bindValue(':end_range', $end_range);
            $sql->bindValue(':end_range', $end_range);
            $sql->bindValue(':deduction_amount', $deduction_amount);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 32, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted contribution bracket (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_deduction
    # Purpose    : Insert deduction.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_deduction($employee_id, $deduction_type, $payroll_date, $amount, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(33, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_deduction(:id, :employee_id, :deduction_type, :payroll_date, :amount, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':deduction_type', $deduction_type);
            $sql->bindValue(':payroll_date', $payroll_date);
            $sql->bindValue(':amount', $amount);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 33, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted deduction (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_contribution_deduction
    # Purpose    : Insert contribution deduction.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_contribution_deduction($employee_id, $government_contribution, $payroll_date, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(34, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_contribution_deduction(:id, :employee_id, :government_contribution, :payroll_date, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':government_contribution', $government_contribution);
            $sql->bindValue(':payroll_date', $payroll_date);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 34, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted contribution deduction (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_temporary_employee
    # Purpose    : Inserts temporary employee for importing.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_temporary_employee($employee_id, $id_number, $file_as, $first_name, $middle_name, $last_name, $suffix, $birthday, $employment_status, $join_date, $exit_date, $permanency_date, $exit_reason, $email, $phone, $telephone, $department, $designation, $branch, $gender){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL insert_temporary_employee(:employee_id, :id_number, :file_as, :first_name, :middle_name, :last_name, :suffix, :birthday, :employment_status, :join_date, :exit_date, :permanency_date, :exit_reason, :email, :phone, :telephone, :department, :designation, :branch, :gender)');
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':id_number', $id_number);
            $sql->bindValue(':file_as', $file_as);
            $sql->bindValue(':first_name', $first_name);
            $sql->bindValue(':middle_name', $middle_name);
            $sql->bindValue(':last_name', $last_name);
            $sql->bindValue(':suffix', $suffix);
            $sql->bindValue(':birthday', $birthday);
            $sql->bindValue(':employment_status', $employment_status);
            $sql->bindValue(':join_date', $join_date);
            $sql->bindValue(':exit_date', $exit_date);
            $sql->bindValue(':permanency_date', $permanency_date);
            $sql->bindValue(':exit_reason', $exit_reason);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':phone', $phone);
            $sql->bindValue(':telephone', $telephone);
            $sql->bindValue(':department', $department);
            $sql->bindValue(':designation', $designation);
            $sql->bindValue(':branch', $branch);
            $sql->bindValue(':gender', $gender);

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_temporary_attendance_record
    # Purpose    : Inserts temporary attendance record for importing.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_temporary_attendance_record($attendance_id, $employee_id, $time_in_date, $time_in, $time_out_date, $time_out){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL insert_temporary_attendance_record(:attendance_id, :employee_id, :time_in_date, :time_in, :time_out_date, :time_out)');
            $sql->bindValue(':attendance_id', $attendance_id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':time_in_date', $time_in_date);
            $sql->bindValue(':time_in', $time_in);
            $sql->bindValue(':time_out_date', $time_out_date);
            $sql->bindValue(':time_out', $time_out);

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_temporary_leave_entitlement
    # Purpose    : Inserts temporary leave entitlement for importing.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_temporary_leave_entitlement($leave_entitlement_id, $employee_id, $leave_type, $no_leaves, $start_date, $end_date){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL insert_temporary_leave_entitlement(:leave_entitlement_id, :employee_id, :leave_type, :no_leaves, :start_date, :end_date)');
            $sql->bindValue(':leave_entitlement_id', $leave_entitlement_id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':leave_type', $leave_type);
            $sql->bindValue(':no_leaves', $no_leaves);
            $sql->bindValue(':start_date', $start_date);
            $sql->bindValue(':end_date', $end_date);

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_temporary_leave
    # Purpose    : Inserts temporary leave for importing.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_temporary_leave($employee_id, $leave_type, $leave_date, $start_time, $end_time, $leave_status, $leave_reason){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL insert_temporary_leave(:employee_id, :leave_type, :leave_date, :start_time, :end_time, :leave_status, :leave_reason)');
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':leave_type', $leave_type);
            $sql->bindValue(':leave_date', $leave_date);
            $sql->bindValue(':start_time', $start_time);
            $sql->bindValue(':end_time', $end_time);
            $sql->bindValue(':leave_status', $leave_status);
            $sql->bindValue(':leave_reason', $leave_reason);

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_temporary_attendance_adjustment
    # Purpose    : Inserts temporary attendance adjustment for importing.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_temporary_attendance_adjustment($request_id, $employee_id, $attendance_id, $time_in_date_adjusted, $time_in_adjusted, $time_out_date_adjusted, $time_out_adjusted, $status, $reason, $file_path, $sanction, $request_date, $request_time, $for_recommendation_date, $for_recommendation_time, $recommendation_date, $recommendation_time, $recommended_by, $decision_remarks, $decision_date, $decision_time, $decision_by){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL insert_temporary_attendance_adjustment(:request_id, :employee_id, :attendance_id, :time_in_date_adjusted, :time_in_adjusted, :time_out_date_adjusted, :time_out_adjusted, :status, :reason, :file_path, :sanction, :request_date, :request_time, :for_recommendation_date, :for_recommendation_time, :recommendation_date, :recommendation_time, :recommended_by, :decision_remarks, :decision_date, :decision_time, :decision_by)');
            $sql->bindValue(':request_id', $request_id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':attendance_id', $attendance_id);
            $sql->bindValue(':time_in_date_adjusted', $time_in_date_adjusted);
            $sql->bindValue(':time_in_adjusted', $time_in_adjusted);
            $sql->bindValue(':time_out_date_adjusted', $time_out_date_adjusted);
            $sql->bindValue(':time_out_adjusted', $time_out_adjusted);
            $sql->bindValue(':status', $status);
            $sql->bindValue(':reason', $reason);
            $sql->bindValue(':file_path', $file_path);
            $sql->bindValue(':sanction', $sanction);
            $sql->bindValue(':request_date', $request_date);
            $sql->bindValue(':request_time', $request_time);
            $sql->bindValue(':for_recommendation_date', $for_recommendation_date);
            $sql->bindValue(':for_recommendation_time', $for_recommendation_time);
            $sql->bindValue(':recommendation_date', $recommendation_date);
            $sql->bindValue(':recommendation_time', $recommendation_time);
            $sql->bindValue(':recommended_by', $recommended_by);
            $sql->bindValue(':decision_remarks', $decision_remarks);
            $sql->bindValue(':decision_date', $decision_date);
            $sql->bindValue(':decision_time', $decision_time);
            $sql->bindValue(':decision_by', $decision_by);

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_imported_attendance_adjustment
    # Purpose    : Insert imported attendance adjustment.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_imported_attendance_adjustment($employee_id, $attendance_id, $time_in_date_default, $time_in_default, $time_in_date_adjustment, $time_in_adjustment, $time_out_date_default, $time_out_default, $time_out_date_adjustment, $time_out_adjustment, $status, $reason, $file_path, $sanction, $request_date, $request_time, $for_recommendation_date, $for_recommendation_time, $recommendation_date, $recommendation_time, $recommended_by, $decision_remarks, $decision_date, $decision_time, $decision_by, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(27, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_imported_attendance_adjustment(:id, :employee_id, :attendance_id, :time_in_date_default, :time_in_default, :time_in_date_adjustment, :time_in_adjustment, :time_out_date_default, :time_out_default, :time_out_date_adjustment, :time_out_adjustment, :status, :reason, :file_path, :sanction, :request_date, :request_time, :for_recommendation_date, :for_recommendation_time, :recommendation_date, :recommendation_time, :recommended_by, :decision_remarks, :decision_date, :decision_time, :decision_by, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':attendance_id', $attendance_id);
            $sql->bindValue(':time_in_date_default', $time_in_date_default);
            $sql->bindValue(':time_in_default', $time_in_default);
            $sql->bindValue(':time_in_date_adjustment', $time_in_date_adjustment);
            $sql->bindValue(':time_in_adjustment', $time_in_adjustment);
            $sql->bindValue(':time_out_date_default', $time_out_date_default);
            $sql->bindValue(':time_out_default', $time_out_default);
            $sql->bindValue(':time_out_date_adjustment', $time_out_date_adjustment);
            $sql->bindValue(':time_out_adjustment', $time_out_adjustment);
            $sql->bindValue(':status', $status);
            $sql->bindValue(':reason', $reason);
            $sql->bindValue(':file_path', $file_path);
            $sql->bindValue(':sanction', $sanction);
            $sql->bindValue(':request_date', $request_date);
            $sql->bindValue(':request_time', $request_time);
            $sql->bindValue(':for_recommendation_date', $for_recommendation_date);
            $sql->bindValue(':for_recommendation_time', $for_recommendation_time);
            $sql->bindValue(':recommendation_date', $recommendation_date);
            $sql->bindValue(':recommendation_time', $recommendation_time);
            $sql->bindValue(':recommended_by', $recommended_by);
            $sql->bindValue(':decision_remarks', $decision_remarks);
            $sql->bindValue(':decision_date', $decision_date);
            $sql->bindValue(':decision_time', $decision_time);
            $sql->bindValue(':decision_by', $decision_by);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 27, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted attendance adjustment (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_temporary_attendance_creation
    # Purpose    : Inserts temporary attendance creation for importing.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_temporary_attendance_creation($request_id, $employee_id, $time_in_date, $time_in, $time_out_date, $time_out, $status, $reason, $file_path, $sanction, $request_date, $request_time, $for_recommendation_date, $for_recommendation_time, $recommendation_date, $recommendation_time, $recommended_by, $decision_remarks, $decision_date, $decision_time, $decision_by){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL insert_temporary_attendance_creation(:request_id, :employee_id, :time_in_date, :time_in, :time_out_date, :time_out, :status, :reason, :file_path, :sanction, :request_date, :request_time, :for_recommendation_date, :for_recommendation_time, :recommendation_date, :recommendation_time, :recommended_by, :decision_remarks, :decision_date, :decision_time, :decision_by)');
            $sql->bindValue(':request_id', $request_id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':time_in_date', $time_in_date);
            $sql->bindValue(':time_in', $time_in);
            $sql->bindValue(':time_out_date', $time_out_date);
            $sql->bindValue(':time_out', $time_out);
            $sql->bindValue(':status', $status);
            $sql->bindValue(':reason', $reason);
            $sql->bindValue(':file_path', $file_path);
            $sql->bindValue(':sanction', $sanction);
            $sql->bindValue(':request_date', $request_date);
            $sql->bindValue(':request_time', $request_time);
            $sql->bindValue(':for_recommendation_date', $for_recommendation_date);
            $sql->bindValue(':for_recommendation_time', $for_recommendation_time);
            $sql->bindValue(':recommendation_date', $recommendation_date);
            $sql->bindValue(':recommendation_time', $recommendation_time);
            $sql->bindValue(':recommended_by', $recommended_by);
            $sql->bindValue(':decision_remarks', $decision_remarks);
            $sql->bindValue(':decision_date', $decision_date);
            $sql->bindValue(':decision_time', $decision_time);
            $sql->bindValue(':decision_by', $decision_by);

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_imported_attendance_creation
    # Purpose    : Insert imported attendance creation.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_imported_attendance_creation($employee_id, $time_in_date, $time_in, $time_out_date, $time_out, $status, $reason, $file_path, $sanction, $request_date, $request_time, $for_recommendation_date, $for_recommendation_time, $recommendation_date, $recommendation_time, $recommended_by, $decision_remarks, $decision_date, $decision_time, $decision_by, $username){
        if ($this->databaseConnection()) {
            $record_log = 'INS->' . $username . '->' . date('Y-m-d h:i:s');

            # Get system parameter id
            $system_parameter = $this->get_system_parameter(26, 1);
            $parameter_number = $system_parameter[0]['PARAMETER_NUMBER'];
            $id = $system_parameter[0]['ID'];

            # Get transaction log id
            $transaction_log_system_parameter = $this->get_system_parameter(2, 1);
            $transaction_log_parameter_number = $transaction_log_system_parameter[0]['PARAMETER_NUMBER'];
            $transaction_log_id = $transaction_log_system_parameter[0]['ID'];

            $sql = $this->db_connection->prepare('CALL insert_imported_attendance_creation(:id, :employee_id, :time_in_date, :time_in, :time_out_date, :time_out, :status, :reason, :file_path, :sanction, :request_date, :request_time, :for_recommendation_date, :for_recommendation_time, :recommendation_date, :recommendation_time, :recommended_by, :decision_remarks, :decision_date, :decision_time, :decision_by, :transaction_log_id, :record_log)');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':time_in_date', $time_in_date);
            $sql->bindValue(':time_in', $time_in);
            $sql->bindValue(':time_out_date', $time_out_date);
            $sql->bindValue(':time_out', $time_out);
            $sql->bindValue(':status', $status);
            $sql->bindValue(':reason', $reason);
            $sql->bindValue(':file_path', $file_path);
            $sql->bindValue(':sanction', $sanction);
            $sql->bindValue(':request_date', $request_date);
            $sql->bindValue(':request_time', $request_time);
            $sql->bindValue(':for_recommendation_date', $for_recommendation_date);
            $sql->bindValue(':for_recommendation_time', $for_recommendation_time);
            $sql->bindValue(':recommendation_date', $recommendation_date);
            $sql->bindValue(':recommendation_time', $recommendation_time);
            $sql->bindValue(':recommended_by', $recommended_by);
            $sql->bindValue(':decision_remarks', $decision_remarks);
            $sql->bindValue(':decision_date', $decision_date);
            $sql->bindValue(':decision_time', $decision_time);
            $sql->bindValue(':decision_by', $decision_by);
            $sql->bindValue(':transaction_log_id', $transaction_log_id);
            $sql->bindValue(':record_log', $record_log); 
        
            if($sql->execute()){
                # Update system parameter value
                $update_system_parameter_value = $this->update_system_parameter_value($parameter_number, 26, $username);

                if($update_system_parameter_value == 1){
                    # Update transaction log value
                    $update_system_parameter_value = $this->update_system_parameter_value($transaction_log_parameter_number, 2, $username);

                    if($update_system_parameter_value == 1){
                        $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Insert', 'User ' . $username . ' inserted attendance creation (' . $id . ').');
                                    
                        if($insert_transaction_log == 1){
                            return 1;
                        }
                        else{
                            return $insert_transaction_log;
                        }
                    }
                    else{
                        return $update_system_parameter_value;
                    }
                }
                else{
                    return $update_system_parameter_value;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_temporary_allowance
    # Purpose    : Inserts temporary allowance for importing.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_temporary_allowance($allowance_id, $employee_id, $allowance_type, $payroll_id, $payroll_date, $amount){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL insert_temporary_allowance(:allowance_id, :employee_id, :allowance_type, :payroll_id, :payroll_date, :amount)');
            $sql->bindValue(':allowance_id', $allowance_id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':allowance_type', $allowance_type);
            $sql->bindValue(':payroll_id', $payroll_id);
            $sql->bindValue(':payroll_date', $payroll_date);
            $sql->bindValue(':amount', $amount);

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_temporary_deduction
    # Purpose    : Inserts temporary deduction for importing.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_temporary_deduction($deduction_id, $employee_id, $deduction_type, $payroll_id, $payroll_date, $amount){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL insert_temporary_deduction(:deduction_id, :employee_id, :deduction_type, :payroll_id, :payroll_date, :amount)');
            $sql->bindValue(':deduction_id', $deduction_id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':deduction_type', $deduction_type);
            $sql->bindValue(':payroll_id', $payroll_id);
            $sql->bindValue(':payroll_date', $payroll_date);
            $sql->bindValue(':amount', $amount);

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_temporary_government_contribution
    # Purpose    : Inserts temporary government contribution for importing.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_temporary_government_contribution($government_contribution_id, $government_contribution, $description){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL insert_temporary_government_contribution(:government_contribution_id, :government_contribution, :description)');
            $sql->bindValue(':government_contribution_id', $government_contribution_id);
            $sql->bindValue(':government_contribution', $government_contribution);
            $sql->bindValue(':description', $description);

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_temporary_contribution_bracket
    # Purpose    : Inserts temporary contribution bracket for importing.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_temporary_contribution_bracket($contribution_bracket_id, $government_contribution_id, $start_range, $end_range, $deduction_amount){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL insert_temporary_contribution_bracket(:contribution_bracket_id, :government_contribution_id, :start_range, :end_range, :deduction_amount)');
            $sql->bindValue(':contribution_bracket_id', $contribution_bracket_id);
            $sql->bindValue(':government_contribution_id', $government_contribution_id);
            $sql->bindValue(':start_range', $start_range);
            $sql->bindValue(':end_range', $end_range);
            $sql->bindValue(':deduction_amount', $deduction_amount);

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : insert_temporary_contribution_deduction
    # Purpose    : Inserts temporary contribution deduction for importing.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function insert_temporary_contribution_deduction($contribution_deduction_id, $employee_id, $government_contribution_type, $payroll_id, $payroll_date){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL insert_temporary_contribution_deduction(:contribution_deduction_id, :employee_id, :government_contribution_type, :payroll_id, :payroll_date)');
            $sql->bindValue(':contribution_deduction_id', $contribution_deduction_id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':government_contribution_type', $government_contribution_type);
            $sql->bindValue(':payroll_id', $payroll_id);
            $sql->bindValue(':payroll_date', $payroll_date);

            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Delete methods
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_system_parameter
    # Purpose    : Delete system parameter.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_system_parameter($parameter_id, $username){
        if ($this->databaseConnection()) {
            $system_parameter_details = $this->get_system_parameter_details($parameter_id);
            $transaction_log_id = $system_parameter_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_system_parameter(:parameter_id)');
            $sql->bindValue(':parameter_id', $parameter_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted system parameter (' . $parameter_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_policy
    # Purpose    : Delete policy.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_policy($policy_id, $username){
        if ($this->databaseConnection()) {
            $policy_details = $this->get_policy_details($policy_id);
            $transaction_log_id = $policy_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_policy(:policy_id)');
            $sql->bindValue(':policy_id', $policy_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted policy (' . $policy_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_all_permission
    # Purpose    : Delete all permission linked to policy.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_all_permission($policy_id, $username){
        if ($this->databaseConnection()) {
            $policy_details = $this->get_policy_details($policy_id);

            $sql = $this->db_connection->prepare('CALL delete_all_permission(:policy_id)');
            $sql->bindValue(':policy_id', $policy_id);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_permission
    # Purpose    : Delete permission.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_permission($permission_id, $username){
        if ($this->databaseConnection()) {
            $permission_details = $this->get_permission_details($permission_id);
            $transaction_log_id = $permission_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_permission(:permission_id)');
            $sql->bindValue(':permission_id', $permission_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted permission (' . $permission_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_role
    # Purpose    : Delete role.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_role($role_id, $username){
        if ($this->databaseConnection()) {
            $role_details = $this->get_role_details($role_id);
            $transaction_log_id = $role_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_role(:role_id)');
            $sql->bindValue(':role_id', $role_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted role (' . $role_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_permission_role
    # Purpose    : Delete assigned permissions to role.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_permission_role($role_id, $username){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_permission_role(:role_id)');
            $sql->bindValue(':role_id', $role_id);
        
            if($sql->execute()){
               return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_system_code
    # Purpose    : Delete system code.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_system_code($system_type, $system_code, $username){
        if ($this->databaseConnection()) {
            $system_code_details = $this->get_system_code_details($system_type, $system_code);
            $transaction_log_id = $system_code_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_system_code(:system_type, :system_code)');
            $sql->bindValue(':system_type', $system_type);
            $sql->bindValue(':system_code', $system_code);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted system code (' . $system_code . ').');
                                     
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_notification_type
    # Purpose    : Delete notification type.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_notification_type($notification_id, $username){
        if ($this->databaseConnection()) {
            $notification_type_details = $this->get_notification_type_details($notification_id);
            $transaction_log_id = $notification_type_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_notification_type(:notification_id)');
            $sql->bindValue(':notification_id', $notification_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted notification type (' . $notification_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_notification_details
    # Purpose    : Delete notification details.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_notification_details($notification_id, $username){
        if ($this->databaseConnection()) {
            $notification_details = $this->get_notification_details($notification_id);
            $transaction_log_id = $notification_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_notification_details(:notification_id)');
            $sql->bindValue(':notification_id', $notification_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted notification details (' . $notification_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_notification_recipient
    # Purpose    : Delete notification recipient details.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_notification_recipient($notification_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_notification_recipient(:notification_id)');
            $sql->bindValue(':notification_id', $notification_id);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_all_application_notification
    # Purpose    : Delete all application notification.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_all_application_notification($username){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_all_application_notification()');
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_department
    # Purpose    : Delete department.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_department($department_id, $username){
        if ($this->databaseConnection()) {
            $department_details = $this->get_department_details($department_id);
            $transaction_log_id = $department_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_department(:department_id)');
            $sql->bindValue(':department_id', $department_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted department (' . $department_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_designation
    # Purpose    : Delete designation.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_designation($designation_id, $username){
        if ($this->databaseConnection()) {
            $designation_details = $this->get_designation_details($designation_id);
            $job_description = $designation_details[0]['JOB_DESCRIPTION'];
            $transaction_log_id = $designation_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_designation(:designation_id)');
            $sql->bindValue(':designation_id', $designation_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted designation (' . $designation_id . ').');
                                    
                if($insert_transaction_log == 1){
                    if(!empty($job_description)){
                        if (unlink($job_description)) {
                            return 1;
                        }
                        else {
                            return $job_description . ' cannot be deleted due to an error.';
                        }
                    }
                    else{
                        return 1;
                    }
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_branch
    # Purpose    : Delete branch.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_branch($branch_id, $username){
        if ($this->databaseConnection()) {
            $branch_details = $this->get_branch_details($role_id);
            $transaction_log_id = $branch_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_branch(:branch_id)');
            $sql->bindValue(':branch_id', $branch_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted branch (' . $branch_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_upload_setting
    # Purpose    : Delete upload setitng.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_upload_setting($upload_setting_id, $username){
        if ($this->databaseConnection()) {
            $upload_setting_details = $this->get_upload_setting_details($upload_setting_id);
            $transaction_log_id = $upload_setting_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_upload_setting(:upload_setting_id)');
            $sql->bindValue(':upload_setting_id', $upload_setting_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted upload setting (' . $upload_setting_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_all_upload_file_type
    # Purpose    : Delete upload file type.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_all_upload_file_type($upload_setting_id, $username){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_all_upload_file_type(:upload_setting_id)');
            $sql->bindValue(':upload_setting_id', $upload_setting_id);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_employment_status
    # Purpose    : Delete employment status.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_employment_status($employment_status_id, $username){
        if ($this->databaseConnection()) {
            $employment_status_details = $this->get_employment_status_details($employment_status_id);
            $transaction_log_id = $employment_status_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_employment_status(:employment_status_id)');
            $sql->bindValue(':employment_status_id', $employment_status_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted employment status (' . $employment_status_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_employee
    # Purpose    : Delete employee.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_employee($employee_id, $username){
        if ($this->databaseConnection()) {
            $employee_details = $this->get_employee_details($employee_id, '');
            $transaction_log_id = $employee_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_employee(:employee_id)');
            $sql->bindValue(':employee_id', $employee_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted employee (' . $employee_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_emergency_contact
    # Purpose    : Delete emergency contact.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_emergency_contact($contact_id, $username){
        if ($this->databaseConnection()) {
            $emergency_contact_details = $this->get_emergency_contact_details($contact_id);
            $transaction_log_id = $emergency_contact_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_emergency_contact(:contact_id)');
            $sql->bindValue(':contact_id', $contact_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted emergency contact (' . $contact_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_employee_address
    # Purpose    : Delete employee address.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_employee_address($address_id, $username){
        if ($this->databaseConnection()) {
            $employee_address_details = $this->get_employee_address_details($address_id);
            $transaction_log_id = $employee_address_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_employee_address(:address_id)');
            $sql->bindValue(':address_id', $address_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted employee address (' . $address_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_employee_social
    # Purpose    : Delete employee social.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_employee_social($social_id, $username){
        if ($this->databaseConnection()) {
            $employee_social_details = $this->get_employee_social_details($social_id);
            $transaction_log_id = $employee_social_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_employee_social(:social_id)');
            $sql->bindValue(':social_id', $social_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted employee social (' . $social_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_work_shift
    # Purpose    : Delete work shift.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_work_shift($work_shift_id, $username){
        if ($this->databaseConnection()) {
            $work_shift_details = $this->get_work_shift_details($work_shift_id);
            $transaction_log_id = $work_shift_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_work_shift(:work_shift_id)');
            $sql->bindValue(':work_shift_id', $work_shift_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted work shift (' . $work_shift_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_work_shift_schedule
    # Purpose    : Delete work shift schedule.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_work_shift_schedule($work_shift_id, $username){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_work_shift_schedule(:work_shift_id)');
            $sql->bindValue(':work_shift_id', $work_shift_id);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_employee_work_shift
    # Purpose    : Delete employee work shift.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_employee_work_shift($work_shift_id, $username){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_employee_work_shift(:work_shift_id)');
            $sql->bindValue(':work_shift_id', $work_shift_id);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_employee_work_shift_assignment
    # Purpose    : Delete employee work shift assignment.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_employee_work_shift_assignment($employee_id, $username){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_employee_work_shift_assignment(:employee_id)');
            $sql->bindValue(':employee_id', $employee_id);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_employee_attendance
    # Purpose    : Delete employee attendance.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_employee_attendance($attendance_id, $username){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_employee_attendance(:attendance_id)');
            $sql->bindValue(':attendance_id', $attendance_id);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_leave_type
    # Purpose    : Delete leave type.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_leave_type($leave_type_id, $username){
        if ($this->databaseConnection()) {
            $leave_type_details = $this->get_leave_type_details($leave_type_id);
            $transaction_log_id = $leave_type_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_leave_type(:leave_type_id)');
            $sql->bindValue(':leave_type_id', $leave_type_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted leave type (' . $leave_type_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_leave_entitlement
    # Purpose    : Delete leave entitlement.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_leave_entitlement($leave_entitlement_id, $username){
        if ($this->databaseConnection()) {
            $leave_entitlement_details = $this->get_leave_entitlement_details($leave_entitlement_id);
            $transaction_log_id = $leave_entitlement_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_leave_entitlement(:leave_entitlement_id)');
            $sql->bindValue(':leave_entitlement_id', $leave_entitlement_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted leave entitlement (' . $leave_entitlement_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_leave
    # Purpose    : Delete leave.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_leave($leave_id, $username){
        if ($this->databaseConnection()) {
            $leave_details = $this->get_leave_details($leave_id);
            $transaction_log_id = $leave_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_leave(:leave_id)');
            $sql->bindValue(':leave_id', $leave_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted leave (' . $leave_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_employee_file
    # Purpose    : Delete employee file.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_employee_file($file_id, $username){
        if ($this->databaseConnection()) {
            $employee_file_details = $this->get_employee_file_details($file_id);
            $file_path = $employee_file_details[0]['FILE_PATH'];
            $transaction_log_id = $employee_file_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_employee_file(:file_id)');
            $sql->bindValue(':file_id', $file_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted employee file (' . $file_id . ').');
                                    
                if($insert_transaction_log == 1){
                    if(!empty($file_path)){
                        if (unlink($file_path)) {
                            return 1;
                        }
                        else {
                            return $file_path . ' cannot be deleted due to an error.';
                        }
                    }
                    else{
                        return 1;
                    }
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_all_user_role
    # Purpose    : Delete all user role.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_all_user_role($user_code){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_all_user_role(:user_code)');
            $sql->bindValue(':user_code', $user_code);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_holiday
    # Purpose    : Delete holiday.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_holiday($holiday_id, $username){
        if ($this->databaseConnection()) {
            $holiday_details = $this->get_holiday_details($holiday_id);
            $transaction_log_id = $holiday_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_holiday(:holiday_id)');
            $sql->bindValue(':holiday_id', $holiday_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted holiday (' . $holiday_id . ').');
                                    
                if($insert_transaction_log == 1){
                    return 1;
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_all_holiday_branch
    # Purpose    : Delete all holiday branch.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_all_holiday_branch($holiday_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_all_holiday_branch(:holiday_id)');
            $sql->bindValue(':holiday_id', $holiday_id);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_attendance_creation_approval
    # Purpose    : Delete all creation approval.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_attendance_creation_approval(){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_attendance_creation_approval()');
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_attendance_adjustment_approval
    # Purpose    : Delete all adjustment approval.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_attendance_adjustment_approval(){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_attendance_adjustment_approval()');
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_attendance_creation
    # Purpose    : Delete attendance creation.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_attendance_creation($request_id, $username){
        if ($this->databaseConnection()) {
            $attendance_creation_details = $this->get_attendance_creation_details($request_id);
            $file_path = $attendance_creation_details[0]['FILE_PATH'];
            $transaction_log_id = $attendance_creation_details[0]['TRANSACTION_LOG_ID'];

            $sql = $this->db_connection->prepare('CALL delete_attendance_creation(:request_id)');
            $sql->bindValue(':request_id', $request_id);
        
            if($sql->execute()){
                $insert_transaction_log = $this->insert_transaction_log($transaction_log_id, $username, 'Delete', 'User ' . $username . ' deleted attendance creation (' . $request_id . ').');
                                    
                if($insert_transaction_log == 1){
                    if(!empty($file_path)){
                        if (unlink($file_path)) {
                            return 1;
                        }
                        else {
                            return $file_path . ' cannot be deleted due to an error.';
                        }
                    }
                    else{
                        return 1;
                    }
                }
                else{
                    return $insert_transaction_log;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_allowance_type
    # Purpose    : Delete allowance type.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_allowance_type($allowance_type_id, $username){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_allowance_type(:allowance_type_id)');
            $sql->bindValue(':allowance_type_id', $allowance_type_id);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_allowance
    # Purpose    : Delete allowance type.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_allowance($allowance_id, $username){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_allowance(:allowance_id)');
            $sql->bindValue(':allowance_id', $allowance_id);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_deduction_type
    # Purpose    : Delete deduction type.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_deduction_type($deduction_type_id, $username){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_deduction_type(:deduction_type_id)');
            $sql->bindValue(':deduction_type_id', $deduction_type_id);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_government_contribution
    # Purpose    : Delete government contribution.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_government_contribution($government_contribution_id, $username){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_government_contribution(:government_contribution_id)');
            $sql->bindValue(':government_contribution_id', $government_contribution_id);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_all_contribution_bracket
    # Purpose    : Delete all contribution bracket.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_all_contribution_bracket($government_contribution_id, $username){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_all_contribution_bracket(:government_contribution_id)');
            $sql->bindValue(':government_contribution_id', $government_contribution_id);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_contribution_bracket
    # Purpose    : Delete contribution bracket.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_contribution_bracket($contribution_bracket_id, $username){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_contribution_bracket(:contribution_bracket_id)');
            $sql->bindValue(':contribution_bracket_id', $contribution_bracket_id);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_deduction
    # Purpose    : Delete deduction.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_deduction($deduction_id, $username){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_deduction(:deduction_id)');
            $sql->bindValue(':deduction_id', $deduction_id);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : delete_contribution_deduction
    # Purpose    : Delete contribution deduction.
    #
    # Returns    : Number/String
    #
    # -------------------------------------------------------------
    public function delete_contribution_deduction($contribution_deduction_id, $username){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL delete_contribution_deduction(:contribution_deduction_id)');
            $sql->bindValue(':contribution_deduction_id', $contribution_deduction_id);
        
            if($sql->execute()){
                return 1;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Get details methods
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_user_account_details
    # Purpose    : Gets the user account details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_user_account_details($username){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_user_account_details(:username)');
            $sql->bindValue(':username', $username);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'PASSWORD' => $row['PASSWORD'],
                        'ACTIVE' => $row['ACTIVE'],
                        'PASSWORD_EXPIRY_DATE' => $row['PASSWORD_EXPIRY_DATE'],
                        'FAILED_LOGIN' => $row['FAILED_LOGIN'],
                        'LAST_FAILED_LOGIN' => $row['LAST_FAILED_LOGIN'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_system_parameter_details
    # Purpose    : Gets the system parameter details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_system_parameter_details($parameter_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_system_parameter_details(:parameter_id)');
            $sql->bindValue(':parameter_id', $parameter_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'PARAMETER_DESC' => $row['PARAMETER_DESC'],
                        'PARAMETER_EXTENSION' => $row['PARAMETER_EXTENSION'],
                        'PARAMETER_NUMBER' => $row['PARAMETER_NUMBER'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_transaction_log_details
    # Purpose    : Gets the transaction log details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_transaction_log_details($transaction_log_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_transaction_log_details(:transaction_log_id)');
            $sql->bindValue(':transaction_log_id', $transaction_log_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'USERNAME' => $row['USERNAME'],
                        'LOG_TYPE' => $row['LOG_TYPE'],
                        'LOG_DATE' => $row['LOG_DATE'],
                        'LOG' => $row['LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_policy_details
    # Purpose    : Gets the policy details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_policy_details($policy_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_policy_details(:policy_id)');
            $sql->bindValue(':policy_id', $policy_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'POLICY' => $row['POLICY'],
                        'DESCRIPTION' => $row['DESCRIPTION'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_permission_details
    # Purpose    : Gets the permission details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_permission_details($permission_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_permission_details(:permission_id)');
            $sql->bindValue(':permission_id', $permission_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'POLICY' => $row['POLICY'],
                        'PERMISSION' => $row['PERMISSION'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_role_details
    # Purpose    : Gets the role details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_role_details($role_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_role_details(:role_id)');
            $sql->bindValue(':role_id', $role_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'ROLE' => $row['ROLE'],
                        'DESCRIPTION' => $row['DESCRIPTION'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_role_permission_details
    # Purpose    : Gets the role permission details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_role_permission_details($role_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_role_permission_details(:role_id)');
            $sql->bindValue(':role_id', $role_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'PERMISSION_ID' => $row['PERMISSION_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_system_code_details
    # Purpose    : Gets the system code details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_system_code_details($system_type, $system_code){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_system_code_details(:system_type, :system_code)');
            $sql->bindValue(':system_type', $system_type);
            $sql->bindValue(':system_code', $system_code);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'DESCRIPTION' => $row['DESCRIPTION'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_user_interface_settings_details
    # Purpose    : Gets the application settings details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_user_interface_settings_details($setting_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_user_interface_settings_details(:setting_id)');
            $sql->bindValue(':setting_id', $setting_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'LOGIN_BG' => $row['LOGIN_BG'],
                        'LOGO_LIGHT' => $row['LOGO_LIGHT'],
                        'LOGO_DARK' => $row['LOGO_DARK'],
                        'LOGO_ICON_LIGHT' => $row['LOGO_ICON_LIGHT'],
                        'LOGO_ICON_DARK' => $row['LOGO_ICON_DARK'],
                        'FAVICON' => $row['FAVICON'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_email_configuration_details
    # Purpose    : Gets the email cofiguration details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_email_configuration_details($mail_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_email_configuration_details(:mail_id)');
            $sql->bindValue(':mail_id', $mail_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'MAIL_HOST' => $row['MAIL_HOST'],
                        'PORT' => $row['PORT'],
                        'SMTP_AUTH' => $row['SMTP_AUTH'],
                        'SMTP_AUTO_TLS' => $row['SMTP_AUTO_TLS'],
                        'USERNAME' => $row['USERNAME'],
                        'PASSWORD' => $row['PASSWORD'],
                        'MAIL_ENCRYPTION' => $row['MAIL_ENCRYPTION'],
                        'MAIL_FROM_NAME' => $row['MAIL_FROM_NAME'],
                        'MAIL_FROM_EMAIL' => $row['MAIL_FROM_EMAIL'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_notification_type_details
    # Purpose    : Gets the notification type details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_notification_type_details($notification_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_notification_type_details(:notification_id)');
            $sql->bindValue(':notification_id', $notification_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'NOTIFICATION' => $row['NOTIFICATION'],
                        'DESCRIPTION' => $row['DESCRIPTION'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_notification_details
    # Purpose    : Gets the notification details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_notification_details($notification_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_notification_details(:notification_id)');
            $sql->bindValue(':notification_id', $notification_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'NOTIFICATION_TITLE' => $row['NOTIFICATION_TITLE'],
                        'NOTIFICATION_MESSAGE' => $row['NOTIFICATION_MESSAGE'],
                        'SYSTEM_LINK' => $row['SYSTEM_LINK'],
                        'WEB_LINK' => $row['WEB_LINK'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_notification_recipient_details
    # Purpose    : Gets the notification recipient details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_notification_recipient_details($notification_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_notification_recipient_details(:notification_id)');
            $sql->bindValue(':notification_id', $notification_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_application_notification_details
    # Purpose    : Gets the application notification details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_application_notification_details(){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_application_notification_details()');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'NOTIFICATION_ID' => $row['NOTIFICATION_ID'],
                        'NOTIFICATION' => $row['NOTIFICATION'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_company_setting_details
    # Purpose    : Gets the company setting details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_company_setting_details($company_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_company_setting_details(:company_id)');
            $sql->bindValue(':company_id', $company_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'COMPANY_NAME' => $row['COMPANY_NAME'],
                        'EMAIL' => $row['EMAIL'],
                        'TELEPHONE' => $row['TELEPHONE'],
                        'PHONE' => $row['PHONE'],
                        'WEBSITE' => $row['WEBSITE'],
                        'ADDRESS' => $row['ADDRESS'],
                        'PROVINCE_ID' => $row['PROVINCE_ID'],
                        'CITY_ID' => $row['CITY_ID'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_department_details
    # Purpose    : Gets the department details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_department_details($department_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_department_details(:department_id)');
            $sql->bindValue(':department_id', $department_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'DEPARTMENT' => $row['DEPARTMENT'],
                        'DESCRIPTION' => $row['DESCRIPTION'],
                        'DEPARTMENT_HEAD' => $row['DEPARTMENT_HEAD'],
                        'PARENT_DEPARTMENT' => $row['PARENT_DEPARTMENT'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_designation_details
    # Purpose    : Gets the designation details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_designation_details($designation_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_designation_details(:designation_id)');
            $sql->bindValue(':designation_id', $designation_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'DESIGNATION' => $row['DESIGNATION'],
                        'DESCRIPTION' => $row['DESCRIPTION'],
                        'JOB_DESCRIPTION' => $row['JOB_DESCRIPTION'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_branch_details
    # Purpose    : Gets the branch details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_branch_details($branch_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_branch_details(:branch_id)');
            $sql->bindValue(':branch_id', $branch_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'BRANCH' => $row['BRANCH'],
                        'EMAIL' => $row['EMAIL'],
                        'PHONE' => $row['PHONE'],
                        'TELEPHONE' => $row['TELEPHONE'],
                        'ADDRESS' => $row['ADDRESS'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_upload_setting_details
    # Purpose    : Gets the upload setting details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_upload_setting_details($upload_setting_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_upload_setting_details(:upload_setting_id)');
            $sql->bindValue(':upload_setting_id', $upload_setting_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'UPLOAD_SETTING' => $row['UPLOAD_SETTING'],
                        'DESCRIPTION' => $row['DESCRIPTION'],
                        'MAX_FILE_SIZE' => $row['MAX_FILE_SIZE'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_upload_file_type_details
    # Purpose    : Gets the upload file type details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_upload_file_type_details($upload_setting_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_upload_file_type_details(:upload_setting_id)');
            $sql->bindValue(':upload_setting_id', $upload_setting_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'FILE_TYPE' => $row['FILE_TYPE'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_employment_status_details
    # Purpose    : Gets the employment status details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_employment_status_details($employment_status_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_employment_status_details(:employment_status_id)');
            $sql->bindValue(':employment_status_id', $employment_status_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'EMPLOYMENT_STATUS' => $row['EMPLOYMENT_STATUS'],
                        'DESCRIPTION' => $row['DESCRIPTION'],
                        'COLOR_VALUE' => $row['COLOR_VALUE'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_employee_details
    # Purpose    : Gets the employee details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_employee_details($employee_id, $username){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_employee_details(:employee_id, :username)');
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':username', $username);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                        'ID_NUMBER' => $row['ID_NUMBER'],
                        'USERNAME' => $row['USERNAME'],
                        'FILE_AS' => $row['FILE_AS'],
                        'FIRST_NAME' => $row['FIRST_NAME'],
                        'MIDDLE_NAME' => $row['MIDDLE_NAME'],
                        'LAST_NAME' => $row['LAST_NAME'],
                        'SUFFIX' => $row['SUFFIX'],
                        'BIRTHDAY' => $row['BIRTHDAY'],
                        'EMPLOYMENT_STATUS' => $row['EMPLOYMENT_STATUS'],
                        'JOIN_DATE' => $row['JOIN_DATE'],
                        'EXIT_DATE' => $row['EXIT_DATE'],
                        'PERMANENCY_DATE' => $row['PERMANENCY_DATE'],
                        'EXIT_REASON' => $row['EXIT_REASON'],
                        'EMAIL' => $row['EMAIL'],
                        'PHONE' => $row['PHONE'],
                        'TELEPHONE' => $row['TELEPHONE'],
                        'DEPARTMENT' => $row['DEPARTMENT'],
                        'DESIGNATION' => $row['DESIGNATION'],
                        'BRANCH' => $row['BRANCH'],
                        'GENDER' => $row['GENDER'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_province_details
    # Purpose    : Gets the province details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_province_details($province_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_province_details(:province_id)');
            $sql->bindValue(':province_id', $province_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'PROVINCE' => $row['PROVINCE'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_city_details
    # Purpose    : Gets the city details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_city_details($city_id, $province_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_city_details(:city_id, :province_id)');
            $sql->bindValue(':city_id', $city_id);
            $sql->bindValue(':province_id', $province_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'CITY' => $row['CITY'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_emergency_contact_details
    # Purpose    : Gets the emergency contact details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_emergency_contact_details($contact_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_emergency_contact_details(:contact_id)');
            $sql->bindValue(':contact_id', $contact_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                        'NAME' => $row['NAME'],
                        'RELATIONSHIP' => $row['RELATIONSHIP'],
                        'EMAIL' => $row['EMAIL'],
                        'PHONE' => $row['PHONE'],
                        'TELEPHONE' => $row['TELEPHONE'],
                        'ADDRESS' => $row['ADDRESS'],
                        'CITY' => $row['CITY'],
                        'PROVINCE' => $row['PROVINCE'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_employee_address_details
    # Purpose    : Gets the employee address details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_employee_address_details($address_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_employee_address_details(:address_id)');
            $sql->bindValue(':address_id', $address_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                        'ADDRESS_TYPE' => $row['ADDRESS_TYPE'],
                        'ADDRESS' => $row['ADDRESS'],
                        'CITY' => $row['CITY'],
                        'PROVINCE' => $row['PROVINCE'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_employee_social_details
    # Purpose    : Gets the employee social details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_employee_social_details($social_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_employee_social_details(:social_id)');
            $sql->bindValue(':social_id', $social_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                        'SOCIAL_TYPE' => $row['SOCIAL_TYPE'],
                        'LINK' => $row['LINK'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_work_shift_details
    # Purpose    : Gets the work shift details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_work_shift_details($work_shift_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_work_shift_details(:work_shift_id)');
            $sql->bindValue(':work_shift_id', $work_shift_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'WORK_SHIFT' => $row['WORK_SHIFT'],
                        'WORK_SHIFT_TYPE' => $row['WORK_SHIFT_TYPE'],
                        'DESCRIPTION' => $row['DESCRIPTION'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_work_shift_schedule_details
    # Purpose    : Gets the work shift details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_work_shift_schedule_details($work_shift_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_work_shift_schedule_details(:work_shift_id)');
            $sql->bindValue(':work_shift_id', $work_shift_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'START_DATE' => $row['START_DATE'],
                        'END_DATE' => $row['END_DATE'],
                        'MONDAY_START_TIME' => $row['MONDAY_START_TIME'],
                        'MONDAY_END_TIME' => $row['MONDAY_END_TIME'],
                        'MONDAY_LUNCH_START_TIME' => $row['MONDAY_LUNCH_START_TIME'],
                        'MONDAY_LUNCH_END_TIME' => $row['MONDAY_LUNCH_END_TIME'],
                        'MONDAY_HALF_DAY_MARK' => $row['MONDAY_HALF_DAY_MARK'],
                        'TUESDAY_START_TIME' => $row['TUESDAY_START_TIME'],
                        'TUESDAY_END_TIME' => $row['TUESDAY_END_TIME'],
                        'TUESDAY_LUNCH_START_TIME' => $row['TUESDAY_LUNCH_START_TIME'],
                        'TUESDAY_LUNCH_END_TIME' => $row['TUESDAY_LUNCH_END_TIME'],
                        'TUESDAY_HALF_DAY_MARK' => $row['TUESDAY_HALF_DAY_MARK'],
                        'WEDNESDAY_START_TIME' => $row['WEDNESDAY_START_TIME'],
                        'WEDNESDAY_END_TIME' => $row['WEDNESDAY_END_TIME'],
                        'WEDNESDAY_LUNCH_START_TIME' => $row['WEDNESDAY_LUNCH_START_TIME'],
                        'WEDNESDAY_LUNCH_END_TIME' => $row['WEDNESDAY_LUNCH_END_TIME'],
                        'WEDNESDAY_HALF_DAY_MARK' => $row['WEDNESDAY_HALF_DAY_MARK'],
                        'THURSDAY_START_TIME' => $row['THURSDAY_START_TIME'],
                        'THURSDAY_END_TIME' => $row['THURSDAY_END_TIME'],
                        'THURSDAY_LUNCH_START_TIME' => $row['THURSDAY_LUNCH_START_TIME'],
                        'THURSDAY_LUNCH_END_TIME' => $row['THURSDAY_LUNCH_END_TIME'],
                        'THURSDAY_HALF_DAY_MARK' => $row['THURSDAY_HALF_DAY_MARK'],
                        'FRIDAY_START_TIME' => $row['FRIDAY_START_TIME'],
                        'FRIDAY_END_TIME' => $row['FRIDAY_END_TIME'],
                        'FRIDAY_LUNCH_START_TIME' => $row['FRIDAY_LUNCH_START_TIME'],
                        'FRIDAY_LUNCH_END_TIME' => $row['FRIDAY_LUNCH_END_TIME'],
                        'FRIDAY_HALF_DAY_MARK' => $row['FRIDAY_HALF_DAY_MARK'],
                        'SATURDAY_START_TIME' => $row['SATURDAY_START_TIME'],
                        'SATURDAY_END_TIME' => $row['SATURDAY_END_TIME'],
                        'SATURDAY_LUNCH_START_TIME' => $row['SATURDAY_LUNCH_START_TIME'],
                        'SATURDAY_LUNCH_END_TIME' => $row['SATURDAY_LUNCH_END_TIME'],
                        'SATURDAY_HALF_DAY_MARK' => $row['SATURDAY_HALF_DAY_MARK'],
                        'SUNDAY_START_TIME' => $row['SUNDAY_START_TIME'],
                        'SUNDAY_END_TIME' => $row['SUNDAY_END_TIME'],
                        'SUNDAY_LUNCH_START_TIME' => $row['SUNDAY_LUNCH_START_TIME'],
                        'SUNDAY_LUNCH_END_TIME' => $row['SUNDAY_LUNCH_END_TIME'],
                        'SUNDAY_HALF_DAY_MARK' => $row['SUNDAY_HALF_DAY_MARK'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_work_shift_assignment_details
    # Purpose    : Gets the work shift details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_work_shift_assignment_details($work_shift_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_work_shift_assignment_details(:work_shift_id)');
            $sql->bindValue(':work_shift_id', $work_shift_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_employee_work_shift_schedule_details
    # Purpose    : Gets the employee's work shift schedule details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_employee_work_shift_schedule_details($employee_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_employee_work_shift_schedule_details(:employee_id)');
            $sql->bindValue(':employee_id', $employee_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'WORK_SHIFT_ID' => $row['WORK_SHIFT_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_employee_attendance_details
    # Purpose    : Gets the employee attendance details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_employee_attendance_details($attendance_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_employee_attendance_details(:attendance_id)');
            $sql->bindValue(':attendance_id', $attendance_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                        'TIME_IN_DATE' => $row['TIME_IN_DATE'],
                        'TIME_IN' => $row['TIME_IN'],
                        'TIME_IN_LOCATION' => $row['TIME_IN_LOCATION'],
                        'TIME_IN_IP_ADDRESS' => $row['TIME_IN_IP_ADDRESS'],
                        'TIME_IN_BY' => $row['TIME_IN_BY'],
                        'TIME_IN_BEHAVIOR' => $row['TIME_IN_BEHAVIOR'],
                        'TIME_IN_NOTE' => $row['TIME_IN_NOTE'],
                        'TIME_OUT_DATE' => $row['TIME_OUT_DATE'],
                        'TIME_OUT' => $row['TIME_OUT'],
                        'TIME_OUT_LOCATION' => $row['TIME_OUT_LOCATION'],
                        'TIME_OUT_IP_ADDRESS' => $row['TIME_OUT_IP_ADDRESS'],
                        'TIME_OUT_BY' => $row['TIME_OUT_BY'],
                        'TIME_OUT_BEHAVIOR' => $row['TIME_OUT_BEHAVIOR'],
                        'TIME_OUT_NOTE' => $row['TIME_OUT_NOTE'],
                        'LATE' => $row['LATE'],
                        'EARLY_LEAVING' => $row['EARLY_LEAVING'],
                        'OVERTIME' => $row['OVERTIME'],
                        'TOTAL_WORKING_HOURS' => $row['TOTAL_WORKING_HOURS'],
                        'REMARKS' => $row['REMARKS'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_leave_type_details
    # Purpose    : Gets the leave type details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_leave_type_details($leave_type_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_leave_type_details(:leave_type_id)');
            $sql->bindValue(':leave_type_id', $leave_type_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'LEAVE_NAME' => $row['LEAVE_NAME'],
                        'DESCRIPTION' => $row['DESCRIPTION'],
                        'NO_LEAVES' => $row['NO_LEAVES'],
                        'PAID_STATUS' => $row['PAID_STATUS'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_leave_entitlement_details
    # Purpose    : Gets the leave entitlement details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_leave_entitlement_details($leave_entitlement_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_leave_entitlement_details(:leave_entitlement_id)');
            $sql->bindValue(':leave_entitlement_id', $leave_entitlement_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                        'LEAVE_TYPE' => $row['LEAVE_TYPE'],
                        'NO_LEAVES' => $row['NO_LEAVES'],
                        'ACQUIRED_LEAVES' => $row['ACQUIRED_LEAVES'],
                        'START_DATE' => $row['START_DATE'],
                        'END_DATE' => $row['END_DATE'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_employee_leave_entitlement_details
    # Purpose    : Gets the leave entitlement details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_employee_leave_entitlement_details($employee_id, $leave_type, $leave_date){
        if ($this->databaseConnection()) {
            $response = array();
            $leave_date = $this->check_date('empty', $leave_date, '', 'Y-m-d', '', '', '');
            
            $sql = $this->db_connection->prepare('CALL get_employee_leave_entitlement_details(:employee_id, :leave_type, :leave_date)');
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':leave_type', $leave_type);
            $sql->bindValue(':leave_date', $leave_date);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'LEAVE_ENTITLEMENT_ID' => $row['LEAVE_ENTITLEMENT_ID'],
                        'NO_LEAVES' => $row['NO_LEAVES'],
                        'ACQUIRED_LEAVES' => $row['ACQUIRED_LEAVES'],
                        'START_DATE' => $row['START_DATE'],
                        'END_DATE' => $row['END_DATE'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_leave_details
    # Purpose    : Gets the leave details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_leave_details($leave_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_leave_details(:leave_id)');
            $sql->bindValue(':leave_id', $leave_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                        'LEAVE_TYPE' => $row['LEAVE_TYPE'],
                        'LEAVE_DATE' => $row['LEAVE_DATE'],
                        'START_TIME' => $row['START_TIME'],
                        'END_TIME' => $row['END_TIME'],
                        'LEAVE_STATUS' => $row['LEAVE_STATUS'],
                        'LEAVE_REASON' => $row['LEAVE_REASON'],
                        'FILE_PATH' => $row['FILE_PATH'],
                        'DECISION_REMARKS' => $row['DECISION_REMARKS'],
                        'DECISION_DATE' => $row['DECISION_DATE'],
                        'DECISION_TIME' => $row['DECISION_TIME'],
                        'DECISION_BY' => $row['DECISION_BY'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_employee_file_details
    # Purpose    : Gets the employee file details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_employee_file_details($file_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_employee_file_details(:file_id)');
            $sql->bindValue(':file_id', $file_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                        'FILE_NAME' => $row['FILE_NAME'],
                        'FILE_CATEGORY' => $row['FILE_CATEGORY'],
                        'REMARKS' => $row['REMARKS'],
                        'FILE_DATE' => $row['FILE_DATE'],
                        'UPLOAD_DATE' => $row['UPLOAD_DATE'],
                        'UPLOAD_TIME' => $row['UPLOAD_TIME'],
                        'UPLOAD_BY' => $row['UPLOAD_BY'],
                        'FILE_PATH' => $row['FILE_PATH'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_role_user_details
    # Purpose    : Gets the role user details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_role_user_details($role_id, $user_code){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_role_user_details(:role_id, :user_code)');
            $sql->bindValue(':role_id', $role_id);
            $sql->bindValue(':user_code', $user_code);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'ROLE_ID' => $row['ROLE_ID'],
                        'USERNAME' => $row['USERNAME'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_holiday_details
    # Purpose    : Gets the holiday details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_holiday_details($holiday_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_holiday_details(:holiday_id)');
            $sql->bindValue(':holiday_id', $holiday_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'HOLIDAY' => $row['HOLIDAY'],
                        'HOLIDAY_DATE' => $row['HOLIDAY_DATE'],
                        'HOLIDAY_TYPE' => $row['HOLIDAY_TYPE'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_holiday_branch_details
    # Purpose    : Gets the holiday branch details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_holiday_branch_details($holiday_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_holiday_branch_details(:holiday_id)');
            $sql->bindValue(':holiday_id', $holiday_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'BRANCH_ID' => $row['BRANCH_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_setting_details
    # Purpose    : Gets the attendance setting details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_attendance_setting_details($setting_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_attendance_setting_details(:setting_id)');
            $sql->bindValue(':setting_id', $setting_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'MAX_ATTENDANCE' => $row['MAX_ATTENDANCE'],
                        'TIME_OUT_ALLOWANCE' => $row['TIME_OUT_ALLOWANCE'],
                        'LATE_ALLOWANCE' => $row['LATE_ALLOWANCE'],
                        'LATE_POLICY' => $row['LATE_POLICY'],
                        'EARLY_LEAVING_POLICY' => $row['EARLY_LEAVING_POLICY'],
                        'ATTENDANCE_CREATION_RECOMMENDATION' => $row['ATTENDANCE_CREATION_RECOMMENDATION'],
                        'ATTENDANCE_ADJUSTMENT_RECOMMENDATION' => $row['ATTENDANCE_ADJUSTMENT_RECOMMENDATION'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_creation_exception_details
    # Purpose    : Gets the attendance creation exception details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_attendance_creation_exception_details(){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_attendance_creation_exception_details()');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_adjustment_exception_details
    # Purpose    : Gets the attendance adjustment exception details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_attendance_adjustment_exception_details(){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_attendance_adjustment_exception_details()');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_creation_details
    # Purpose    : Gets the attendance creation details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_attendance_creation_details($request_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_attendance_creation_details(:request_id)');
            $sql->bindValue(':request_id', $request_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                        'TIME_IN_DATE' => $row['TIME_IN_DATE'],
                        'TIME_IN' => $row['TIME_IN'],
                        'TIME_OUT_DATE' => $row['TIME_OUT_DATE'],
                        'TIME_OUT' => $row['TIME_OUT'],
                        'STATUS' => $row['STATUS'],
                        'REASON' => $row['REASON'],
                        'FILE_PATH' => $row['FILE_PATH'],
                        'SANCTION' => $row['SANCTION'],
                        'REQUEST_DATE' => $row['REQUEST_DATE'],
                        'REQUEST_TIME' => $row['REQUEST_TIME'],
                        'FOR_RECOMMENDATION_DATE' => $row['FOR_RECOMMENDATION_DATE'],
                        'FOR_RECOMMENDATION_TIME' => $row['FOR_RECOMMENDATION_TIME'],
                        'RECOMMENDATION_DATE' => $row['RECOMMENDATION_DATE'],
                        'RECOMMENDATION_TIME' => $row['RECOMMENDATION_TIME'],
                        'RECOMMENDED_BY' => $row['RECOMMENDED_BY'],
                        'DECISION_REMARKS' => $row['DECISION_REMARKS'],
                        'DECISION_DATE' => $row['DECISION_DATE'],
                        'DECISION_TIME' => $row['DECISION_TIME'],
                        'DECISION_BY' => $row['DECISION_BY'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_adjustment_details
    # Purpose    : Gets the attendance creation details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_attendance_adjustment_details($request_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_attendance_adjustment_details(:request_id)');
            $sql->bindValue(':request_id', $request_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                        'ATTENDANCE_ID' => $row['ATTENDANCE_ID'],
                        'TIME_IN_DATE' => $row['TIME_IN_DATE'],
                        'TIME_IN' => $row['TIME_IN'],
                        'TIME_IN_DATE_ADJUSTED' => $row['TIME_IN_DATE_ADJUSTED'],
                        'TIME_IN_ADJUSTED' => $row['TIME_IN_ADJUSTED'],
                        'TIME_OUT_DATE' => $row['TIME_OUT_DATE'],
                        'TIME_OUT' => $row['TIME_OUT'],
                        'TIME_OUT_DATE_ADJUSTED' => $row['TIME_OUT_DATE_ADJUSTED'],
                        'TIME_OUT_ADJUSTED' => $row['TIME_OUT_ADJUSTED'],
                        'STATUS' => $row['STATUS'],
                        'REASON' => $row['REASON'],
                        'FILE_PATH' => $row['FILE_PATH'],
                        'SANCTION' => $row['SANCTION'],
                        'REQUEST_DATE' => $row['REQUEST_DATE'],
                        'REQUEST_TIME' => $row['REQUEST_TIME'],
                        'FOR_RECOMMENDATION_DATE' => $row['FOR_RECOMMENDATION_DATE'],
                        'FOR_RECOMMENDATION_TIME' => $row['FOR_RECOMMENDATION_TIME'],
                        'RECOMMENDATION_DATE' => $row['RECOMMENDATION_DATE'],
                        'RECOMMENDATION_TIME' => $row['RECOMMENDATION_TIME'],
                        'RECOMMENDED_BY' => $row['RECOMMENDED_BY'],
                        'DECISION_REMARKS' => $row['DECISION_REMARKS'],
                        'DECISION_DATE' => $row['DECISION_DATE'],
                        'DECISION_TIME' => $row['DECISION_TIME'],
                        'DECISION_BY' => $row['DECISION_BY'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_allowance_type_details
    # Purpose    : Gets the allowance type details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_allowance_type_details($allowance_type_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_allowance_type_details(:allowance_type_id)');
            $sql->bindValue(':allowance_type_id', $allowance_type_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'ALLOWANCE_TYPE' => $row['ALLOWANCE_TYPE'],
                        'TAXABLE' => $row['TAXABLE'],
                        'DESCRIPTION' => $row['DESCRIPTION'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_allowance_details
    # Purpose    : Gets the allowance details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_allowance_details($allowance_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_allowance_details(:allowance_id)');
            $sql->bindValue(':allowance_id', $allowance_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                        'ALLOWANCE_TYPE' => $row['ALLOWANCE_TYPE'],
                        'PAYROLL_ID' => $row['PAYROLL_ID'],
                        'PAYROLL_DATE' => $row['PAYROLL_DATE'],
                        'AMOUNT' => $row['AMOUNT'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_deduction_type_details
    # Purpose    : Gets the deduction type details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_deduction_type_details($deduction_type_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_deduction_type_details(:deduction_type_id)');
            $sql->bindValue(':deduction_type_id', $deduction_type_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'DEDUCTION_TYPE' => $row['DEDUCTION_TYPE'],
                        'DESCRIPTION' => $row['DESCRIPTION'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_government_contribution_details
    # Purpose    : Gets the government contribution details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_government_contribution_details($government_contribution_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_government_contribution_details(:government_contribution_id)');
            $sql->bindValue(':government_contribution_id', $government_contribution_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'GOVERNMENT_CONTRIBUTION' => $row['GOVERNMENT_CONTRIBUTION'],
                        'DESCRIPTION' => $row['DESCRIPTION'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_contribution_bracket_details
    # Purpose    : Gets the contribution bracket details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_contribution_bracket_details($contribution_bracket_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_contribution_bracket_details(:contribution_bracket_id)');
            $sql->bindValue(':contribution_bracket_id', $contribution_bracket_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'GOVERNMENT_CONTRIBUTION_ID' => $row['GOVERNMENT_CONTRIBUTION_ID'],
                        'START_RANGE' => $row['START_RANGE'],
                        'END_RANGE' => $row['END_RANGE'],
                        'DEDUCTION_AMOUNT' => $row['DEDUCTION_AMOUNT'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_deduction_details
    # Purpose    : Gets the deduction details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_deduction_details($deduction_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_deduction_details(:deduction_id)');
            $sql->bindValue(':deduction_id', $deduction_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                        'DEDUCTION_TYPE' => $row['DEDUCTION_TYPE'],
                        'PAYROLL_ID' => $row['PAYROLL_ID'],
                        'PAYROLL_DATE' => $row['PAYROLL_DATE'],
                        'AMOUNT' => $row['AMOUNT'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_contribution_deduction_details
    # Purpose    : Gets the contribution deduction details.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_contribution_deduction_details($contribution_deduction_id){
        if ($this->databaseConnection()) {
            $response = array();

            $sql = $this->db_connection->prepare('CALL get_contribution_deduction_details(:contribution_deduction_id)');
            $sql->bindValue(':contribution_deduction_id', $contribution_deduction_id);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $response[] = array(
                        'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                        'GOVERNMENT_CONTRIBUTION_TYPE' => $row['GOVERNMENT_CONTRIBUTION_TYPE'],
                        'PAYROLL_ID' => $row['PAYROLL_ID'],
                        'PAYROLL_DATE' => $row['PAYROLL_DATE'],
                        'TRANSACTION_LOG_ID' => $row['TRANSACTION_LOG_ID'],
                        'RECORD_LOG' => $row['RECORD_LOG']
                    );
                }

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Get methods
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_next_date
    # Purpose    : Returns the calculated date 
    #              based on the frequency
    #
    # Returns    : Date
    #
    # -------------------------------------------------------------
    public function get_next_date($previous_date, $frequency){   
        if($frequency == 'MONTHLY'){
            $date = $this->check_date('empty', $previous_date, '', 'Y-m-d', '+1 month', '', '');
        }
        else if($frequency == 'DAILY'){
            $date = $this->check_date('empty', $previous_date, '', 'Y-m-d', '+1 day', '', '');
        }
        else if($frequency == 'WEEKLY'){
            $date = $this->check_date('empty', $previous_date, '', 'Y-m-d', '+1 week', '', '');
        }
        else if($frequency == 'BIWEEKLY'){
            $date = $this->check_date('empty', $previous_date, '', 'Y-m-d', '+2 weeks', '', '');
        }
        else if($frequency == 'QUARTERLY'){
            $date = $this->check_date('empty', $previous_date, '', 'Y-m-d', '+3 months', '', '');
        }
        else{
            $date = $this->check_date('empty', $previous_date, '', 'Y-m-d', '+1 year', '', '');
        }
    
        return $date;
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_system_parameter
    # Purpose    : Gets the system parameter.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_system_parameter($parameter_id, $add){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL get_system_parameter(:parameter_id)');
            $sql->bindValue(':parameter_id', $parameter_id);

            if($sql->execute()){
                $row = $sql->fetch();

                $parameter_number = $row['PARAMETER_NUMBER'] + $add; # Add value to system number
                $parameter_extension = $row['PARAMETER_EXTENSION'];

                $response[] = array(
                    'PARAMETER_NUMBER' => $parameter_number,
                    'ID' => $parameter_extension . $parameter_number
                );

                return $response;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_permission_count
    # Purpose    : Gets the roles' sub permission count.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function get_permission_count($role_id, $permission_id){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL get_permission_count(:role_id, :permission_id)');
            $sql->bindValue(':role_id', $role_id);
            $sql->bindValue(':permission_id', $permission_id);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_file_as_format
    # Purpose    : Returns the file as name format
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function get_file_as_format($first_name, $middle_name, $last_name, $suffix){
        $suffix = $this->get_system_code_details('SUFFIX', $suffix)[0]['DESCRIPTION'] ?? null;

        if(!empty($middle_name) && !empty($suffix)){
            return $last_name . ', ' . $first_name . ' ' . $middle_name . ', ' . $suffix;
        }
        else if(!empty($middle_name) && empty($suffix)){
            return $last_name . ', ' . $first_name . ' ' . $middle_name;
        }
        else if(empty($middle_name) && !empty($suffix)){
            return $last_name . ', ' . $first_name . ', ' . $suffix;
        }
        else{
            return $last_name . ', ' . $first_name;
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_time_in_behavior_status
    # Purpose    : Returns the status, badge
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_time_in_behavior_status($stat){
        $response = array();

        switch ($stat) {
            case 'REG':
                $status = 'Regular';
                $button_class = 'bg-success';
                break;
            case 'EARLY':
                $status = 'Early';
                $button_class = 'bg-info';
                break;
            case 'LATE':
                $status = 'Late';
                $button_class = 'bg-danger';
                break;
            default:
                $status = '--';
                $button_class = 'bg-info';
        }

        $response[] = array(
            'STATUS' => $status,
            'BADGE' => '<span class="badge '. $button_class .'">'. $status .'</span>'
        );

        return $response;
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_time_out_behavior_status
    # Purpose    : Returns the status, badge
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_time_out_behavior_status($stat){
        $response = array();

        switch ($stat) {
            case 'REG':
                $status = 'Regular';
                $button_class = 'bg-success';
                break;
            case 'OT':
                $status = 'Overtime';
                $button_class = 'bg-info';
                break;
            case 'EL':
                $status = 'Early Leaving';
                $button_class = 'bg-danger';
                break;
            default:
                $status = '--';
                $button_class = 'bg-info';
        }

        $response[] = array(
            'STATUS' => $status,
            'BADGE' => '<span class="badge '. $button_class .'">'. $status .'</span>'
        );

        return $response;
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_leave_status
    # Purpose    : Returns the status, badge
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_leave_status($stat, $system_date, $leave_date){
        $response = array();

        if($stat == 'REJ'){
            $status = 'Rejected';
            $button_class = 'bg-danger';
        }
        else if($stat == 'APV'){
            if(strtotime($system_date) >= strtotime($leave_date)){
                $status = 'Taken';
                $button_class = 'bg-primary';
            }
            else{
                $status = 'Approved';
                $button_class = 'bg-success';
            }
        }
        else if($stat == 'PEN'){
            $status = 'Pending';
            $button_class = 'bg-info';
        }
        else if($stat == 'CAN'){
            $status = 'Cancelled';
            $button_class = 'bg-warning';
        }
        else{
            $status = 'Approved (System Generated)';
            $button_class = 'bg-danger';
        }

        $response[] = array(
            'STATUS' => $status,
            'BADGE' => '<span class="badge '. $button_class .'">'. $status .'</span>'
        );

        return $response;
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_ip_address
    # Purpose    : Returns the ip address of the client
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function get_ip_address() {
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
        else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        }  
        else{  
            $ip = $_SERVER['REMOTE_ADDR'];  
        }  
        
        return $ip;  
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_late_total
    # Purpose    : Returns the total late minutes
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_attendance_late_total($employee_id, $time_in_date, $time_in){
        if ($this->databaseConnection()) {
            $time_in_day = date('N', strtotime($time_in_date));
            $time_in = $this->check_date('empty', $time_in, '', 'H:i:00', '', '', '');

            $attendance_setting_details = $this->get_attendance_setting_details(1);
            $late_allowance = $attendance_setting_details[0]['LATE_ALLOWANCE'] ?? 1;
            $late_policy = $attendance_setting_details[0]['LATE_POLICY'] ?? 0;

            $work_shift_schedule = $this->get_work_shift_schedule($employee_id, $time_in_date, $time_in_day);
            $work_shift_id = $work_shift_schedule[0]['WORK_SHIFT_ID'];
            $work_shift_time_in = $work_shift_schedule[0]['START_TIME'];
            $start_lunch_break = $work_shift_schedule[0]['LUNCH_START_TIME'];
            $end_lunch_break = $work_shift_schedule[0]['LUNCH_END_TIME'];

            $work_shift_late_allowance = $this->check_date('empty', $work_shift_time_in, '', 'H:i:00', '+'. $late_allowance .' minutes', '', '');

            if(strtotime($time_in) >= strtotime($work_shift_late_allowance)){
                if($time_in >= $end_lunch_break){
                    $late = floor(((strtotime($time_in) - strtotime($end_lunch_break)) / 3600) * 60);
                }
                else{
                    $late = floor(((strtotime($time_in) - strtotime($work_shift_time_in)) / 3600) * 60);
                }
    
                if($late_policy > 0){
                    if($late > $late_policy){
                        $late = floor(((strtotime($start_lunch_break) - strtotime($work_shift_time_in)) / 3600) * 60);
                    }
                }
            }
            else{
                $late = 0;
            }

            if($late <= 0){
                $late = 0;
            }

            return $late;
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_early_leaving_total
    # Purpose    : Returns the total early leaving minutes
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_attendance_early_leaving_total($employee_id, $time_in_date, $time_out){
        if ($this->databaseConnection()) {
            $time_in_day = date('N', strtotime($time_in_date));
            $time_out = $time_out;

            $attendance_setting_details = $this->get_attendance_setting_details(1);
            $early_leaving_policy = $attendance_setting_details[0]['EARLY_LEAVING_POLICY'];

            $work_shift_schedule = $this->get_work_shift_schedule($employee_id, $time_in_date, $time_in_day);
            $end_lunch_break = $work_shift_schedule[0]['LUNCH_END_TIME'];
            $work_shift_time_out = $work_shift_schedule[0]['END_TIME'];

            $early_leaving = floor(((strtotime($work_shift_time_out) - strtotime($time_out)) / 3600) * 60);

            if($early_leaving_policy > 0){
                if($early_leaving > $early_leaving_policy){
                    $early_leaving = floor(((strtotime($work_shift_time_out) - strtotime($end_lunch_break)) / 3600) * 60);
                }
            }

            if($early_leaving <= 0){
                $early_leaving = 0;
            }

            return $early_leaving;
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_overtime_total
    # Purpose    : Returns the total overtime minutes
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_attendance_overtime_total($employee_id, $time_in_date, $time_out_date, $time_out){
        if ($this->databaseConnection()) {
            $time_in_day = date('N', strtotime($time_in_date));
            $time_out = strtotime($time_out_date . ' ' . $time_out);

            $work_shift_schedule = $this->get_work_shift_schedule($employee_id, $time_in_date, $time_in_day);
            $work_shift_time_out = strtotime($time_in_date . ' ' . $work_shift_schedule[0]['END_TIME']);

           $over_time = floor((($time_out - $work_shift_time_out) / 3600));

            if($over_time <= 0){
                $over_time = 0;
            }

            return floor($over_time);
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_total_hours
    # Purpose    : Returns the total hours worked
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_attendance_total_hours($employee_id, $time_in_date, $time_in, $time_out_date, $time_out){
        if ($this->databaseConnection()) {
            $total_hours = 0;
            $time_in_day = date('N', strtotime($time_in_date));

            $late = $this->get_attendance_late_total($employee_id, $time_in_date, $time_in);
            $early_leaving = $this->get_attendance_early_leaving_total($employee_id, $time_in_date, $time_out);

            $work_shift_schedule = $this->get_work_shift_schedule($employee_id, $time_in_date, $time_in_day);
            $work_shift_time_in = strtotime($time_in_date . ' ' . $work_shift_schedule[0]['START_TIME']);
            $work_shift_time_out = strtotime($time_out_date . ' ' . $work_shift_schedule[0]['END_TIME']);
            $work_shift_start_lunch_break = strtotime($time_in_date . ' ' . $work_shift_schedule[0]['LUNCH_START_TIME']);
            $work_shift_end_lunch_break = strtotime($time_in_date . ' ' . $work_shift_schedule[0]['LUNCH_END_TIME']);

            $time_in = abs($work_shift_time_in - $work_shift_start_lunch_break);
            $time_out = abs($work_shift_time_out - $work_shift_end_lunch_break);

            $total_hours = (((abs($time_in + $time_out) / 3600) * 60) - ($late + $early_leaving)) / 60;

            if($total_hours <= 0){
                $total_hours = 0;
            }

            return $total_hours;
           
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_work_shift_schedule
    # Purpose    : Gets the roles' sub permission count.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function get_work_shift_schedule($employee_id, $date, $day){
        if ($this->databaseConnection()) {
            $response = array();

            $employee_work_shift_schedule_details = $this->get_employee_work_shift_schedule_details($employee_id);
            $work_shift_id = $employee_work_shift_schedule_details[0]['WORK_SHIFT_ID'];

            $work_shift_details = $this->get_work_shift_details($work_shift_id);
            $work_shift_type = $work_shift_details[0]['WORK_SHIFT_TYPE'];

            $work_shift_schedule_details = $this->get_work_shift_schedule_details($work_shift_id);
            $start_date = $work_shift_schedule_details[0]['START_DATE'];
            $end_date = $work_shift_schedule_details[0]['END_DATE'];

            if($work_shift_type == 'REGULAR' || ($work_shift_type == 'SCHEDULED' && (strtotime($date) >= strtotime($start_date) && strtotime($date) <= strtotime($end_date)))){
                switch ($day) {
                    case 1:
                        $start_time = $work_shift_schedule_details[0]['MONDAY_START_TIME'];
                        $end_time = $work_shift_schedule_details[0]['MONDAY_END_TIME'];
                        $lunch_start_time = $work_shift_schedule_details[0]['MONDAY_LUNCH_START_TIME'];
                        $lunch_end_time = $work_shift_schedule_details[0]['MONDAY_LUNCH_END_TIME'];
                        $half_day_mark = $work_shift_schedule_details[0]['MONDAY_HALF_DAY_MARK'];
                    case 2:
                        $start_time = $work_shift_schedule_details[0]['TUESDAY_START_TIME'];
                        $end_time = $work_shift_schedule_details[0]['TUESDAY_END_TIME'];
                        $lunch_start_time = $work_shift_schedule_details[0]['TUESDAY_LUNCH_START_TIME'];
                        $lunch_end_time = $work_shift_schedule_details[0]['TUESDAY_LUNCH_END_TIME'];
                        $half_day_mark = $work_shift_schedule_details[0]['TUESDAY_HALF_DAY_MARK'];
                        break;
                    case 3:
                        $start_time = $work_shift_schedule_details[0]['WEDNESDAY_START_TIME'];
                        $end_time = $work_shift_schedule_details[0]['WEDNESDAY_END_TIME'];
                        $lunch_start_time = $work_shift_schedule_details[0]['WEDNESDAY_LUNCH_START_TIME'];
                        $lunch_end_time = $work_shift_schedule_details[0]['WEDNESDAY_LUNCH_END_TIME'];
                        $half_day_mark = $work_shift_schedule_details[0]['WEDNESDAY_HALF_DAY_MARK'];
                    case 4:
                        $start_time = $work_shift_schedule_details[0]['THURSDAY_START_TIME'];
                        $end_time = $work_shift_schedule_details[0]['THURSDAY_END_TIME'];
                        $lunch_start_time = $work_shift_schedule_details[0]['THURSDAY_LUNCH_START_TIME'];
                        $lunch_end_time = $work_shift_schedule_details[0]['THURSDAY_LUNCH_END_TIME'];
                        $half_day_mark = $work_shift_schedule_details[0]['THURSDAY_HALF_DAY_MARK'];
                        break;
                    case 5:
                        $start_time = $work_shift_schedule_details[0]['FRIDAY_START_TIME'];
                        $end_time = $work_shift_schedule_details[0]['FRIDAY_END_TIME'];
                        $lunch_start_time = $work_shift_schedule_details[0]['FRIDAY_LUNCH_START_TIME'];
                        $lunch_end_time = $work_shift_schedule_details[0]['FRIDAY_LUNCH_END_TIME'];
                        $half_day_mark = $work_shift_schedule_details[0]['FRIDAY_HALF_DAY_MARK'];
                        break;
                    case 6:
                        $start_time = $work_shift_schedule_details[0]['SATURDAY_START_TIME'];
                        $end_time = $work_shift_schedule_details[0]['SATURDAY_END_TIME'];
                        $lunch_start_time = $work_shift_schedule_details[0]['SATURDAY_LUNCH_START_TIME'];
                        $lunch_end_time = $work_shift_schedule_details[0]['SATURDAY_LUNCH_END_TIME'];
                        $half_day_mark = $work_shift_schedule_details[0]['SATURDAY_HALF_DAY_MARK'];
                        break;
                    default:
                        $start_time = $work_shift_schedule_details[0]['SUNDAY_START_TIME'];
                        $end_time = $work_shift_schedule_details[0]['SUNDAY_END_TIME'];
                        $lunch_start_time = $work_shift_schedule_details[0]['SUNDAY_LUNCH_START_TIME'];
                        $lunch_end_time = $work_shift_schedule_details[0]['SUNDAY_LUNCH_END_TIME'];
                        $half_day_mark = $work_shift_schedule_details[0]['SUNDAY_HALF_DAY_MARK'];
                }

                $response[] = array(
                    'WORK_SHIFT_ID' => $work_shift_id,
                    'START_TIME' => $start_time,
                    'END_TIME' => $end_time,
                    'LUNCH_START_TIME' => $lunch_start_time,
                    'LUNCH_END_TIME' => $lunch_end_time,
                    'HALF_DAY_MARK' => $half_day_mark
                );
            }

            return $response;
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_time_in_behavior
    # Purpose    : Returns the time in behavior.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_time_in_behavior($employee_id, $time_in_date, $time_in){
        $time_in_day = date('N', strtotime($time_in_date));
        $time_in = $time_in;

        $attendance_setting_details = $this->get_attendance_setting_details(1);
        $late_allowance = $attendance_setting_details[0]['LATE_ALLOWANCE'] ?? 1;

        $work_shift_schedule = $this->get_work_shift_schedule($employee_id, $time_in_date, $time_in_day);
        $work_shift_id = $work_shift_schedule[0]['WORK_SHIFT_ID'];
        $work_shift_time_in = $work_shift_schedule[0]['START_TIME'];
        $work_shift_late_allowance = $this->check_date('empty', $work_shift_time_in, '', 'H:i:00', '+'. $late_allowance .' minutes', '', '');

        if(strtotime($time_in) < strtotime($work_shift_time_in)){
            return 'EARLY';
        }
        else if(strtotime($time_in) >= strtotime($work_shift_late_allowance)){
            return 'LATE';
        }
        else{
            return 'REG';
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_time_out_behavior
    # Purpose    : Returns the time out behavior.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_time_out_behavior($employee_id, $time_in_date, $time_out_date, $time_out){
        $time_in_day = date('N', strtotime($time_in_date));
        $time_out = strtotime($time_out);

        $work_shift_schedule = $this->get_work_shift_schedule($employee_id, $time_in_date, $time_in_day);
        $work_shift_id = strtotime($work_shift_schedule[0]['WORK_SHIFT_ID']);
        $work_shift_time_out = strtotime($work_shift_schedule[0]['END_TIME']);

        if($time_out == $work_shift_time_out){
            return 'REG';
        }
        else if($time_out > $work_shift_time_out){
            return 'OT';
        }
        else{
            return 'EL';
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_leave_entitlement_status
    # Purpose    : Returns the status, badge.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_leave_entitlement_status($no_leaves, $acquired_leaves){
        $response = array();

        if($acquired_leaves > 0){
            $percent = ($acquired_leaves / $no_leaves) * 100;

            if($percent < 50){
                $button_class = 'bg-success';
            }
            else if ($percent == 50){
                $button_class = 'bg-warning';
            }
            else{
                $button_class = 'bg-danger';
            }   
        }
        else{
            $button_class = 'bg-success';
        }

        $response[] = array(
            'STATUS' => $acquired_leaves . ' / ' . $no_leaves,
            'BADGE' => '<span class="badge '. $button_class .'">'. number_format($this->check_number($acquired_leaves), 1) . ' / ' . number_format($this->check_number($no_leaves), 1) .'</span>'
        );

        return $response;
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_available_leave_entitlement
    # Purpose    : Returns the available leave entitlement count.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_available_leave_entitlement($employee_id, $leave_type, $leave_date){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL get_available_leave_entitlement(:employee_id, :leave_type, :leave_date)');
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':leave_type', $leave_type);
            $sql->bindValue(':leave_date', $leave_date);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'] ?? 0;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_leave_statistics
    # Purpose    : Returns the leave statistics.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_leave_statistics($employee_id, $leave_type, $system_date){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL get_leave_statistics(:employee_id, :leave_type, :system_date)');
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':leave_type', $leave_type);
            $sql->bindValue(':system_date', $system_date);

            if($sql->execute()){
                $row = $sql->fetch();

                return number_format($row['ACQUIRED_LEAVES'] ?? 0, 2) . ' / ' . number_format($row['NO_LEAVES'] ?? 0, 2);
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_user_account_lock_status
    # Purpose    : Returns the status, badge.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_user_account_lock_status($failed_login){
        $response = array();

        if ($failed_login >= 5) {
            $status = 'Locked';
            $button_class = 'bg-danger';
        }
        else{
            $status = 'Unlocked';
            $button_class = 'bg-success';
        }

        $response[] = array(
            'STATUS' => $status,
            'BADGE' => '<span class="badge '. $button_class .'">'. $status .'</span>'
        );

        return $response;
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_user_account_status
    # Purpose    : Returns the status, badge.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_user_account_status($stat){
        $response = array();

        switch ($stat) {
            case 1:
                $status = 'Active';
                $button_class = 'bg-success';
                break;
            default:
                $status = 'Inactive';
                $button_class = 'bg-danger';
        }

        $response[] = array(
            'STATUS' => $status,
            'BADGE' => '<span class="badge '. $button_class .'">'. $status .'</span>'
        );

        return $response;
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_date_difference
    # Purpose    : Returns the year, month and days difference.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_date_difference($date_1, $date_2){
        $response = array();

        $diff = abs(strtotime($date_2) - strtotime($date_1));

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24)/ (60 * 60 * 24));

        if($years == 1){
            $years = $years . ' Year';
        }
        else{
            $years = $years . ' Years';
        }

        if($months == 1){
            $months = $months . ' Month';
        }
        else{
            $months = $months . ' Months';
        }

        if($days == 1){
            $days = $days . ' Day';
        }
        else{
            $days = $days . ' Days';
        }

        $response[] = array(
            'YEARS' => $years,
            'MONTHS' => $months,
            'DAYS' => $days
        );

        return $response;
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_clock_in_total
    # Purpose    : Gets the total clock-in by date.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_clock_in_total($employee_id, $system_date){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('SELECT COUNT(ATTENDANCE_ID) AS TOTAL FROM tblattendancerecord WHERE EMPLOYEE_ID = :employee_id AND TIME_IN_DATE = :system_date AND (TIME_OUT_DATE IS NOT NULL AND TIME_OUT IS NOT NULL)');
            $sql->bindParam(':employee_id', $employee_id);
            $sql->bindParam(':system_date', $system_date);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_by_date
    # Purpose    : Gets the attendance id based on date.
    #
    # Returns    : Date
    #
    # -------------------------------------------------------------
    public function get_attendance_by_date($attendance_date){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('SELECT ATTENDANCE_ID FROM tblattendancerecord WHERE TIME_IN_DATE = :attendance_date ORDER BY TIME_IN_DATE DESC, TIME_IN DESC LIMIT 1');
            $sql->bindParam(':attendance_date', $attendance_date);
                                                        
            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    $row = $sql->fetch();

                    return $row['ATTENDANCE_ID'];
                }
                else{
                    return '';
                }               
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_health_declaration_count
    # Purpose    : Gets the total health declaration by date.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_health_declaration_count($employee_id, $system_date){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('SELECT COUNT(DECLARATION_ID) AS TOTAL FROM tblhealthdeclaration WHERE EMPLOYEE_ID = :employee_id AND SUBMIT_DATE = :system_date');
            $sql->bindParam(':employee_id', $employee_id);
            $sql->bindParam(':system_date', $system_date);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_creation_status
    # Purpose    : Returns the status, badge.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_attendance_creation_status($stat){
        $response = array();

        if($stat == 'PEN'){
            $status = 'Pending';
            $button_class = 'bg-info';
        }
        else if($stat == 'APV'){
            $status = 'Approved';
            $button_class = 'bg-success';
        }
        else if($stat == 'REJ'){
            $status = 'Rejected';
            $button_class = 'bg-danger';
        }
        else if($stat == 'CAN'){
            $status = 'Cancelled';
            $button_class = 'bg-warning';
        }
        else if($stat == 'FRREC'){
            $status = 'For Recommendation';
            $button_class = 'bg-success';
        }
        else{
            $status = 'Recommended';
            $button_class = 'bg-info';
        }

        $response[] = array(
            'STATUS' => $status,
            'BADGE' => '<span class="badge '. $button_class .'">'. $status .'</span>'
        );

        return $response;
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_adjustment_status
    # Purpose    : Returns the status, badge.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_attendance_adjustment_status($stat){
        $response = array();

        if($stat == 'PEN'){
            $status = 'Pending';
            $button_class = 'bg-info';
        }
        else if($stat == 'APV'){
            $status = 'Approved';
            $button_class = 'bg-success';
        }
        else if($stat == 'REJ'){
            $status = 'Rejected';
            $button_class = 'bg-danger';
        }
        else if($stat == 'CAN'){
            $status = 'Cancelled';
            $button_class = 'bg-warning';
        }
        else if($stat == 'FRREC'){
            $status = 'For Recommendation';
            $button_class = 'bg-success';
        }
        else{
            $status = 'Recommended';
            $button_class = 'bg-info';
        }

        $response[] = array(
            'STATUS' => $status,
            'BADGE' => '<span class="badge '. $button_class .'">'. $status .'</span>'
        );

        return $response;
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_creation_sanction_status
    # Purpose    : Returns the status, badge.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_attendance_creation_sanction_status($stat){
        $response = array();

        if($stat == '1'){
            $status = 'Yes';
            $button_class = 'bg-danger';
        }
        else{
            $status = 'No';
            $button_class = 'bg-success';
        }

        $response[] = array(
            'STATUS' => $status,
            'BADGE' => '<span class="badge '. $button_class .'">'. $status .'</span>'
        );

        return $response;
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_adjustment_sanction_status
    # Purpose    : Returns the status, badge.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_attendance_adjustment_sanction_status($stat){
        $response = array();

        if($stat == '1'){
            $status = 'Yes';
            $button_class = 'bg-danger';
        }
        else{
            $status = 'No';
            $button_class = 'bg-success';
        }

        $response[] = array(
            'STATUS' => $status,
            'BADGE' => '<span class="badge '. $button_class .'">'. $status .'</span>'
        );

        return $response;
    }
    # -------------------------------------------------------------
    
    # -------------------------------------------------------------
    #
    # Name       : get_allowance_type_status
    # Purpose    : Returns the status, badge.
    #
    # Returns    : Array
    #
    # -------------------------------------------------------------
    public function get_allowance_type_status($stat){
        $response = array();

        switch ($stat) {
            case 'TAX':
                $status = 'Taxable';
                $button_class = 'bg-info';
                break;
            default:
                $status = 'Non-Taxable';
                $button_class = 'bg-success';
        }

        $response[] = array(
            'STATUS' => $status,
            'BADGE' => '<span class="badge '. $button_class .'">'. $status .'</span>'
        );

        return $response;
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_time_in_count
    # Purpose    : Gets the attendance record in based on behavior.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_attendance_time_in_count($time_in_behavior, $employee_id, $start_date, $end_date){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL get_attendance_time_in_count(:time_in_behavior, :employee_id, :start_date, :end_date)');
            $sql->bindParam(':time_in_behavior', $time_in_behavior);
            $sql->bindParam(':employee_id', $employee_id);
            $sql->bindParam(':start_date', $start_date);
            $sql->bindParam(':end_date', $end_date);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_time_out_count
    # Purpose    : Gets the total attendance record based on behavior.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_attendance_time_out_count($time_out_behavior, $employee_id, $start_date, $end_date){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL get_attendance_time_out_count(:time_out_behavior, :employee_id, :start_date, :end_date)');
            $sql->bindParam(':time_out_behavior', $time_out_behavior);
            $sql->bindParam(':employee_id', $employee_id);
            $sql->bindParam(':start_date', $start_date);
            $sql->bindParam(':end_date', $end_date);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_employee_attendance_total
    # Purpose    : Gets the total attendance record based on request type.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_employee_attendance_total($request_type, $employee_id, $start_date, $end_date){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL get_employee_attendance_total(:request_type, :employee_id, :start_date, :end_date)');
            $sql->bindParam(':request_type', $request_type);
            $sql->bindParam(':employee_id', $employee_id);
            $sql->bindParam(':start_date', $start_date);
            $sql->bindParam(':end_date', $end_date);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------
    
    # -------------------------------------------------------------
    #
    # Name       : get_attendance_adjustment_count
    # Purpose    : Gets the total attendance adjustment based on request type.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_attendance_adjustment_count($request_type, $employee_id, $start_date, $end_date){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL get_attendance_adjustment_count(:request_type, :employee_id, :start_date, :end_date)');
            $sql->bindParam(':request_type', $request_type);
            $sql->bindParam(':employee_id', $employee_id);
            $sql->bindParam(':start_date', $start_date);
            $sql->bindParam(':end_date', $end_date);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------
    
    # -------------------------------------------------------------
    #
    # Name       : get_attendance_creation_count
    # Purpose    : Gets the total attendance creation based on request type.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_attendance_creation_count($request_type, $employee_id, $start_date, $end_date){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL get_attendance_creation_count(:request_type, :employee_id, :start_date, :end_date)');
            $sql->bindParam(':request_type', $request_type);
            $sql->bindParam(':employee_id', $employee_id);
            $sql->bindParam(':start_date', $start_date);
            $sql->bindParam(':end_date', $end_date);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_adjustments_sanction_count
    # Purpose    : Gets the total attendance adjustment based on sanction.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_attendance_adjustments_sanction_count($sanction, $employee_id, $start_date, $end_date){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL get_attendance_adjustments_sanction_count(:sanction, :employee_id, :start_date, :end_date)');
            $sql->bindParam(':sanction', $sanction);
            $sql->bindParam(':employee_id', $employee_id);
            $sql->bindParam(':start_date', $start_date);
            $sql->bindParam(':end_date', $end_date);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_creation_sanction_count
    # Purpose    : Gets the total attendance creation based on sanction.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_attendance_creation_sanction_count($sanction, $employee_id, $start_date, $end_date){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL get_attendance_creation_sanction_count(:sanction, :employee_id, :start_date, :end_date)');
            $sql->bindParam(':sanction', $sanction);
            $sql->bindParam(':employee_id', $employee_id);
            $sql->bindParam(':start_date', $start_date);
            $sql->bindParam(':end_date', $end_date);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------
    
    # -------------------------------------------------------------
    #
    # Name       : get_days_worked
    # Purpose    : Gets the total days worked.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_days_worked($employee_id, $start_date, $end_date){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL get_days_worked(:employee_id, :start_date, :end_date)');
            $sql->bindParam(':employee_id', $employee_id);
            $sql->bindParam(':start_date', $start_date);
            $sql->bindParam(':end_date', $end_date);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_working_days
    # Purpose    : Returns working days
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_working_days($employee_id, $start_date, $end_date){
        if ($this->databaseConnection()) {
            $working_days = 0;
            $start_date_converted = strtotime($start_date);
            $end_date_converted = strtotime($end_date);
                
            for ($i = $start_date_converted; $i <= $end_date_converted; $i = $i + (60 * 60 * 24)) {
                $day = date('N', $i);

                $work_shift_schedule = $this->get_work_shift_schedule($employee_id, date('Y-m-d', $i), $day);
                $work_shift_id = $work_shift_schedule[0]['WORK_SHIFT_ID'] ?? null;

                if(!empty($work_shift_id)){
                    $working_days = $working_days + 1;
                }
            }
            
            return $working_days;
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_summary_time_in_count
    # Purpose    : Gets the attendance record in based on behavior.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_attendance_summary_time_in_count($time_in_behavior, $start_date, $end_date, $branch, $department){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL get_attendance_summary_time_in_count(:time_in_behavior, :start_date, :end_date, :branch, :department)');
            $sql->bindParam(':time_in_behavior', $time_in_behavior);
            $sql->bindParam(':start_date', $start_date);
            $sql->bindParam(':end_date', $end_date);
            $sql->bindParam(':branch', $branch);
            $sql->bindParam(':department', $department);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_summary_time_out_count
    # Purpose    : Gets the total attendance record based on behavior.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_attendance_summary_time_out_count($time_out_behavior, $start_date, $end_date, $branch, $department){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL get_attendance_summary_time_out_count(:time_out_behavior, :start_date, :end_date, :branch, :department)');
            $sql->bindParam(':time_out_behavior', $time_out_behavior);
            $sql->bindParam(':start_date', $start_date);
            $sql->bindParam(':end_date', $end_date);
            $sql->bindParam(':branch', $branch);
            $sql->bindParam(':department', $department);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_summary_attendance_adjustments_sanction_count
    # Purpose    : Gets the total attendance record based on behavior.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_attendance_summary_attendance_adjustments_sanction_count($sanction, $start_date, $end_date, $branch, $department){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL get_attendance_summary_attendance_adjustments_sanction_count(:sanction, :start_date, :end_date, :branch, :department)');
            $sql->bindParam(':sanction', $sanction);
            $sql->bindParam(':start_date', $start_date);
            $sql->bindParam(':end_date', $end_date);
            $sql->bindParam(':branch', $branch);
            $sql->bindParam(':department', $department);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : get_attendance_summary_attendance_creation_sanction_count
    # Purpose    : Gets the total attendance record based on behavior.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function get_attendance_summary_attendance_creation_sanction_count($sanction, $start_date, $end_date, $branch, $department){
        if ($this->databaseConnection()) {
            $sql = $this->db_connection->prepare('CALL get_attendance_summary_attendance_creation_sanction_count(:sanction, :start_date, :end_date, :branch, :department)');
            $sql->bindParam(':sanction', $sanction);
            $sql->bindParam(':start_date', $start_date);
            $sql->bindParam(':end_date', $end_date);
            $sql->bindParam(':branch', $branch);
            $sql->bindParam(':department', $department);

            if($sql->execute()){
                $row = $sql->fetch();

                return $row['TOTAL'];
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Check methods
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_role_permissions
    # Purpose    : Checks the permissions of the role.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_role_permissions($username, $permission_id){
        if ($this->databaseConnection()) {
            $response = array();
            $total = 0;

            $sql = $this->db_connection->prepare('SELECT ROLE_ID FROM tblroleuser WHERE USERNAME = :username');
            $sql->bindValue(':username', $username);

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $role_id = $row['ROLE_ID'];

                    $total += $this->get_permission_count($role_id, $permission_id);
                }
                
                return $total;
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_modal_scrollable
    # Purpose    : Check if the modal to be generated
    #              is scrollable or not.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function check_modal_scrollable($scrollable){
        if($scrollable == 1){
            return 'modal-dialog-scrollable';
        }
        else{
            return '';
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_modal_size
    # Purpose    : Check the size of the modal.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function check_modal_size($size){
        if($size == 'SM'){
            return 'modal-sm';
        }
        else if($size == 'LG'){
            return 'modal-lg';
        }
        else if($size == 'XL'){
            return 'modal-xl';
        }
        else {
            return '';
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_number
    # Purpose    : Checks the number if empty or 0 
    #              return 0 or return number given.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_number($number){
        if(is_numeric($number) && (!empty($number) || $number > 0) && !empty($number)){
            return $number;
        }
        else{
            return '0';
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_date
    # Purpose    : Checks the date with different format
    #
    # Returns    : Date
    #
    # -------------------------------------------------------------
    public function check_date($type, $date, $time, $format, $modify, $system_date, $current_time){
        if($type == 'default'){
            if(!empty($date)){
                return $this->format_date($format, $date, $modify);
            }
            else{
                return $system_date;
            }
        }
        else if($type == 'empty'){
            if(!empty($date)){
                return $this->format_date($format, $date, $modify);
            }
            else{
                return null;
            }
        }
        else if($type == 'summary'){
            if(!empty($date)){
                return $this->format_date($format, $date, $modify);
            }
            else{
                return '--';
            }
        }
        else if($type == 'na'){
            if(!empty($date)){
                return $this->format_date($format, $date, $modify);
            }
            else{
                return 'N/A';
            }
        }
        else if($type == 'complete'){
            if(!empty($date)){
                return $this->format_date($format, $date, $modify) . ' ' . $time;
            }
            else{
                return 'N/A';
            }
        }
        else if($type == 'encoded'){
            if(!empty($date)){
                return $this->format_date($format, $date, $modify) . ' ' . $time;
            }
            else{
                return 'N/A';
            }
        }
        else if($type == 'date time'){
            if(!empty($date)){
                return $this->format_date($format, $date, $modify) . ' ' . $time;
            }
            else{
                return 'N/A';
            }
        }
        else if($type == 'default time'){
            if(!empty($date)){
                return $time;
            }
            else{
                return $current_time;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_image
    # Purpose    : Checks the image.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function check_image($image, $type){
        if(empty($image) || !file_exists($image)){
            switch ($type) {
                case 'profile':
                    return './assets/images/default/default-avatar.png';
                break;
                default:
                    return './assets/images/default/default-image-placeholder.png';
            }
        }
        else{
            return $image;
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_user_interface_upload
    # Purpose    : Checks the user interface upload.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_user_interface_upload($file, $request, $setting_id, $username){
        $file_type = '';
        $file_name = $file['name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        $file_tmp_name = $file['tmp_name'];
        $file_ext = explode('.', $file_name);
        $file_actual_ext = strtolower(end($file_ext));

        if(!empty($file_name)){
            switch ($request) {
                case 'login background':
                    $file_size_error = 'The file uploaded for login background exceeds the maximum file size.';
                    $file_type_error = 'The file uploaded for login background is not supported.';
                    $upload_setting_id = 1;
                    break;
                case 'logo light':
                    $file_size_error = 'The file uploaded for logo light exceeds the maximum file size.';
                    $file_type_error = 'The file uploaded for logo light is not supported.';
                    $upload_setting_id = 2;
                    break;
                case 'logo dark':
                    $file_size_error = 'The file uploaded for logo dark exceeds the maximum file size.';
                    $file_type_error = 'The file uploaded for logo dark is not supported.';
                    $upload_setting_id = 3;
                    break;
                case 'logo icon light':
                    $file_size_error = 'The file uploaded for logo icon light exceeds the maximum file size.';
                    $file_type_error = 'The file uploaded for logo icon light is not supported.';
                    $upload_setting_id = 4;
                    break;
                case 'logo icon dark':
                    $file_size_error = 'The file uploaded for logo icon dark exceeds the maximum file size.';
                    $file_type_error = 'The file uploaded for logo icon dark is not supported.';
                    $upload_setting_id = 5;
                    break;
                default:
                    $file_size_error = 'The file uploaded for favicon exceeds the maximum file size.';
                    $file_type_error = 'The file uploaded for favicon is not supported.';
                    $upload_setting_id = 6;
            }

            $upload_setting_details = $this->get_upload_setting_details($upload_setting_id);
            $upload_file_type_details = $this->get_upload_file_type_details($upload_setting_id);
            $file_max_size = $upload_setting_details[0]['MAX_FILE_SIZE'] * 1048576;

            for($i = 0; $i < count($upload_file_type_details); $i++) {
                $file_type .= $upload_file_type_details['FILE_TYPE'];

                if($i != (count($upload_file_type_details) - 1)){
                    $file_type .= ',';
                }
            }

            $allowed_ext = explode(',', $file_type);

            if(in_array($file_actual_ext, $allowed_ext)){
                if(!$file_error){
                    if($file_size < $file_max_size){
                        $update_user_interface_settings_images = $this->update_user_interface_settings_images($file_tmp_name, $file_actual_ext, $request, $setting_id, $username);

                        if($update_user_interface_settings_images == 1){
                            return 1;
                        }
                        else{
                            return $update_user_interface_settings_images;
                        }
                    }
                    else{
                        return $file_size_error;
                    }
                }
                else{
                    return 'There was an error uploading the file.';
                }
            }
            else {
                return $file_type_error;
            }
        }
        else{
            return 1;
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_attendance_validation
    # Purpose    : Checks attendance validation.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function check_attendance_validation($time_in_date, $time_in, $time_out_date, $time_out){
        if(!empty($time_in_date) && !empty($time_in) && !empty($time_out_date) && !empty($time_out)){
            if(strtotime($time_in_date . ' ' . $time_in) > strtotime($time_out_date . ' ' . $time_out)){
                return 'Time In';
            }
            else if(strtotime($time_out_date . ' ' . $time_out) < strtotime($time_in_date . ' ' . $time_in)){
                return 'Time Out';
            }
            else{
                return null;
            }
        }
        else{
            return null;
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_leave_entitlement_overlap
    # Purpose    : Checks the leave entitlement overlap.
    #
    # Returns    : Date
    #
    # -------------------------------------------------------------
    public function check_leave_entitlement_overlap($leave_entitlement_id, $leave_entitlement_start_date, $leave_entitlement_end_date, $employee_id, $leave_type){
        if ($this->databaseConnection()) {
            $overlap_count = 0;

            $sql = $this->db_connection->prepare('CALL check_leave_entitlement_overlap(:leave_entitlement_id, :employee_id, :leave_type)');
            $sql->bindValue(':leave_entitlement_id', $leave_entitlement_id);
            $sql->bindValue(':employee_id', $employee_id);
            $sql->bindValue(':leave_type', $leave_type);
                                                        
            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    while($row = $sql->fetch()){
                        $start_date = $row['START_DATE'];
                        $end_date = $row['END_DATE'];

                        if((strtotime($leave_entitlement_start_date) >= strtotime($start_date) && strtotime($leave_entitlement_start_date) <= strtotime($end_date)) || (strtotime($leave_entitlement_end_date) >= strtotime($start_date) && strtotime($leave_entitlement_end_date) <= strtotime($end_date)) || (strtotime($leave_entitlement_start_date) <= strtotime($start_date) && strtotime($leave_entitlement_end_date) >= strtotime($end_date))){
                            $overlap_count++;
                        }                        
                    }
    
                    return $overlap_count;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_week_day
    # Purpose    : Checks the week day.
    #
    # Returns    : Number
    #
    # -------------------------------------------------------------
    public function check_week_day($day){
        if($day == 0) {
            return 7;
        }
        else{
            return $day;
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_leave_overlap
    # Purpose    : Checks the leave application overlap .
    #
    # Returns    : Date
    #
    # -------------------------------------------------------------
    public function check_leave_overlap($leave_id, $employee_id, $date, $time){
        if ($this->databaseConnection()) {
            $overlap_count = 0;

            $sql = $this->db_connection->prepare("CALL check_leave_overlap(:leave_id, :employee_id)");
            $sql->bindValue(':leave_id', $leave_id);
            $sql->bindValue(':employee_id', $employee_id);
                                                        
            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    while($row = $sql->fetch()){
                        $start_date = $this->check_date('empty', $row['LEAVE_DATE'], '', 'Y-m-d', '', '', '') . ' ' . $row['START_TIME'];
                        $end_date = $this->check_date('empty', $row['LEAVE_DATE'], '', 'Y-m-d', '', '', '') . ' ' . $row['END_TIME'];

                        if (strtotime($date . ' ' . $time) >= strtotime($start_date) && strtotime($date . ' ' . $time) <= strtotime($end_date)){
                            $overlap_count++;
                        }
                    }
    
                    return $overlap_count;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_user_account_status
    # Purpose    : Checks the user account status. 
    #
    # Returns    : Date
    #
    # -------------------------------------------------------------
    public function check_user_account_status($username){
        if ($this->databaseConnection()) {
            $user_account_details = $this->get_user_account_details($username);
            $active = $user_account_details[0]['ACTIVE'];
            $failed_login = $user_account_details[0]['FAILED_LOGIN'];

            if($active == 0 || $failed_login >= 5){
                return 1;
            }
            else{
                return 0;
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_attendance_clock_out
    # Purpose    : Checks the attendance clock out
    #
    # Returns    : Date
    #
    # -------------------------------------------------------------
    public function check_attendance_clock_out($employee_id){
        if ($this->databaseConnection()) {
            $overlap_count = 0;

            $sql = $this->db_connection->prepare('SELECT ATTENDANCE_ID FROM tblattendancerecord WHERE EMPLOYEE_ID = :employee_id AND (TIME_IN_DATE IS NOT NULL AND TIME_IN IS NOT NULL AND TIME_OUT_DATE IS NULL) ORDER BY TIME_IN_DATE DESC LIMIT 1');
            $sql->bindParam(':employee_id', $employee_id);
                                                        
            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    $row = $sql->fetch();

                    return $row['ATTENDANCE_ID'];
                }
                else{
                    return '';
                }               
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : check_contribution_bracket_overlap
    # Purpose    : Checks the contribution bracket overlap.
    #
    # Returns    : Date
    #
    # -------------------------------------------------------------
    public function check_contribution_bracket_overlap($contribution_bracket_id, $government_contribution_id, $range){
        if ($this->databaseConnection()) {
            $overlap_count = 0;

            $sql = $this->db_connection->prepare('CALL check_contribution_bracket_overlap(:contribution_bracket_id, :government_contribution_id)');
            $sql->bindValue(':contribution_bracket_id', $contribution_bracket_id);
            $sql->bindValue(':government_contribution_id', $government_contribution_id);
                                                        
            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    while($row = $sql->fetch()){
                        $start_range = $row['START_RANGE'];
                        $end_range = $row['END_RANGE'];

                        if(($range >= $start_range && $range <= $end_range)){
                            $overlap_count++;
                        }                        
                    }
    
                    return $overlap_count;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Generate methods
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_file_name
    # Purpose    : generates random file name.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_file_name($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));
    
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
    
        return $key;
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_role_permission_form
    # Purpose    : Generates permission check box.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_role_permission_form($disabled = null){
        if ($this->databaseConnection()) {
            $counter = 0;
            $column = '';
        
            $sql = $this->db_connection->prepare('SELECT POLICY_ID, POLICY, DESCRIPTION FROM tblpolicy ORDER BY POLICY');
        
            if($sql->execute()){
                while($row = $sql->fetch()){
                    $policy_id = $row['POLICY_ID'];
                    $policy = $row['POLICY'];
                    $description = $row['DESCRIPTION'];

                    $column .= '<div class="col-lg-3 mb-2">
                                    <div class="form-group">
                                        <label class="mb-0"><b>'. $policy .'</b></label>
                                        <p class="text-muted mb-3">'. $description .'</p>';

                    $sql2 = $this->db_connection->prepare('SELECT PERMISSION_ID, PERMISSION FROM tblpermission WHERE POLICY = :policy_id ORDER BY PERMISSION_ID');
                    $sql2->bindValue(':policy_id', $policy_id);

                    if($sql2->execute()){
                        while($res = $sql2->fetch()){
                            $permission_id = $res['PERMISSION_ID'];
                            $permission = $res['PERMISSION'];

                            $column .= '<div class="form-check form-switch mb-3">
                                            <input class="form-check-input role-permissions" type="checkbox" id="'. $permission_id .'" value="'. $permission_id .'" '. $disabled .'>
                                            <label class="form-check-label" for="'. $permission_id .'">'. $permission .'</label>
                                        </div>';
                        }
                    }

                    $column .= '</div>
                        </div>';
                }

                return $column;
            }
            else{
                return $sql->errorInfo();
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_system_code_options
    # Purpose    : Generates system code options of dropdown.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_system_code_options($system_type){
        if ($this->databaseConnection()) {
            $option = '';
            
            $sql = $this->db_connection->prepare('CALL generate_system_code_options(:system_type)');
            $sql->bindValue(':system_type', $system_type);

            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    while($row = $sql->fetch()){
                        $system_code = $row['SYSTEM_CODE'];
                        $description = $row['DESCRIPTION'];
    
                        $option .= "<option value='". $system_code ."'>". $description ."</option>";
                    }
    
                    return $option;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_application_notification_table
    # Purpose    : Generates application notification table.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_application_notification_table($disabled = null){
        if ($this->databaseConnection()) {
            $counter = 0;
            $column = '';
            $status = '1';
        
            $sql = $this->db_connection->prepare('SELECT NOTIFICATION_ID, NOTIFICATION, DESCRIPTION FROM tblnotificationtype ORDER BY DESCRIPTION');
        
            if($sql->execute()){
                $column .= '<div class="table-responsive">
                                    <table class="table table-bordered mb-0">

                                        <thead>
                                            <tr>
                                                <th style="width:70%">Notification</th>
                                                <th style="width:15%">System Notification</th>
                                                <th style="width:15%">Email Notification</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                while($row = $sql->fetch()){
                    $notification_id = $row['NOTIFICATION_ID'];
                    $notification = $row['NOTIFICATION'];
                    $description = $row['DESCRIPTION'];

                    $column .= '<tr>
                            <td scope="row">'. $notification . '<p class="text-muted mb-0">'. $description .'</p></td>
                            <td>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input application-notification" type="checkbox" value="'. $notification_id .'-S" '. $disabled .'>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input application-notification" type="checkbox" value="'. $notification_id .'-E" '. $disabled .'>
                                </div>
                            </td>
                        </tr>';
                }

                $column .= '</tbody>
                        </table>
                    </div>';

                return $column;
            }
            else{
                return $sql->errorInfo();
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_department_options
    # Purpose    : Generates department options of dropdown.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_department_options(){
        if ($this->databaseConnection()) {
            $option = '';
            
            $sql = $this->db_connection->prepare('CALL generate_department_options()');

            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    while($row = $sql->fetch()){
                        $department_id = $row['DEPARTMENT_ID'];
                        $department = $row['DEPARTMENT'];
    
                        $option .= "<option value='". $department_id ."'>". $department ."</option>";
                    }
    
                    return $option;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_designation_options
    # Purpose    : Generates designation options of dropdown.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_designation_options(){
        if ($this->databaseConnection()) {
            $option = '';
            
            $sql = $this->db_connection->prepare('CALL generate_designation_options()');

            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    while($row = $sql->fetch()){
                        $designation_id = $row['DESIGNATION_ID'];
                        $designation = $row['DESIGNATION'];
    
                        $option .= "<option value='". $designation_id ."'>". $designation ."</option>";
                    }
    
                    return $option;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_branch_options
    # Purpose    : Generates branch options of dropdown.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_branch_options(){
        if ($this->databaseConnection()) {
            $option = '';
            
            $sql = $this->db_connection->prepare('CALL generate_branch_options()');

            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    while($row = $sql->fetch()){
                        $branch_id = $row['BRANCH_ID'];
                        $branch = $row['BRANCH'];
    
                        $option .= "<option value='". $branch_id ."'>". $branch ."</option>";
                    }
    
                    return $option;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_employment_status_options
    # Purpose    : Generates employment status options of dropdown.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_employment_status_options(){
        if ($this->databaseConnection()) {
            $option = '';
            
            $sql = $this->db_connection->prepare('CALL generate_employment_status_options()');

            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    while($row = $sql->fetch()){
                        $employment_status_id = $row['EMPLOYMENT_STATUS_ID'];
                        $employment_status = $row['EMPLOYMENT_STATUS'];
    
                        $option .= "<option value='". $employment_status_id ."'>". $employment_status ."</option>";
                    }
    
                    return $option;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_province_options
    # Purpose    : Generates province options of dropdown.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_province_options(){
        if ($this->databaseConnection()) {
            $option = '';
            
            $sql = $this->db_connection->prepare('CALL generate_province_options()');

            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    while($row = $sql->fetch()){
                        $province_id = $row['PROVINCE_ID'];
                        $province = $row['PROVINCE'];
    
                        $option .= "<option value='". $province_id ."'>". $province ."</option>";
                    }
    
                    return $option;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_active_employee_options
    # Purpose    : Generates active employee options of dropdown.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_active_employee_options(){
        if ($this->databaseConnection()) {
            $option = '';
            
            $sql = $this->db_connection->prepare('CALL generate_active_employee_options()');

            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    while($row = $sql->fetch()){
                        $employee_id = $row['EMPLOYEE_ID'];
                        $file_as = $row['FILE_AS'];
    
                        $option .= "<option value='". $employee_id ."'>". $file_as ."</option>";
                    }
    
                    return $option;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_employee_options
    # Purpose    : Generates employee options of dropdown.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_employee_options(){
        if ($this->databaseConnection()) {
            $option = '';
            
            $sql = $this->db_connection->prepare('CALL generate_employee_options()');

            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    while($row = $sql->fetch()){
                        $employee_id = $row['EMPLOYEE_ID'];
                        $file_as = $row['FILE_AS'];
    
                        $option .= "<option value='". $employee_id ."'>". $file_as ."</option>";
                    }
    
                    return $option;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_leave_type_options
    # Purpose    : Generates active employee options of dropdown.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_leave_type_options(){
        if ($this->databaseConnection()) {
            $option = '';
            
            $sql = $this->db_connection->prepare('CALL generate_leave_type_options()');

            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    while($row = $sql->fetch()){
                        $leave_type_id = $row['LEAVE_TYPE_ID'];
                        $leave_name = $row['LEAVE_NAME'];
    
                        $option .= "<option value='". $leave_type_id ."'>". $leave_name ."</option>";
                    }
    
                    return $option;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_employee_work_shift_schedule_table
    # Purpose    : Generates employee work shift schedule table.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_employee_work_shift_schedule_table($employee_id){
        if ($this->databaseConnection()) {
            $counter = 0;
            $column = '';
            $status = '1';
        
            $sql = $this->db_connection->prepare('SELECT WORK_SHIFT_ID, MONDAY_START_TIME, MONDAY_END_TIME, MONDAY_LUNCH_START_TIME, MONDAY_LUNCH_END_TIME, MONDAY_HALF_DAY_MARK, TUESDAY_START_TIME, TUESDAY_END_TIME, TUESDAY_LUNCH_START_TIME, TUESDAY_LUNCH_END_TIME, TUESDAY_HALF_DAY_MARK, WEDNESDAY_START_TIME, WEDNESDAY_END_TIME, WEDNESDAY_LUNCH_START_TIME, WEDNESDAY_LUNCH_END_TIME, WEDNESDAY_HALF_DAY_MARK, THURSDAY_START_TIME, THURSDAY_END_TIME, THURSDAY_LUNCH_START_TIME, THURSDAY_LUNCH_END_TIME, THURSDAY_HALF_DAY_MARK, FRIDAY_START_TIME, FRIDAY_END_TIME, FRIDAY_LUNCH_START_TIME, FRIDAY_LUNCH_END_TIME, FRIDAY_HALF_DAY_MARK, SATURDAY_START_TIME, SATURDAY_END_TIME, SATURDAY_LUNCH_START_TIME, SATURDAY_LUNCH_END_TIME, SATURDAY_HALF_DAY_MARK, SUNDAY_START_TIME, SUNDAY_END_TIME, SUNDAY_LUNCH_START_TIME, SUNDAY_LUNCH_END_TIME, SUNDAY_HALF_DAY_MARK FROM tblworkshiftschedule WHERE WORK_SHIFT_ID IN (SELECT WORK_SHIFT_ID FROM tblemployeeworkshift WHERE EMPLOYEE_ID = :employee_id)');
            $sql->bindValue(':employee_id', $employee_id);
        
            if($sql->execute()){
                $column .= '<div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Weekday</th>
                                                <th>Time</th>
                                                <th>Lunch</th>
                                                <th>Half Day Mark</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                while($row = $sql->fetch()){
                    $monday_start_time = $this->check_date('empty', $row['MONDAY_START_TIME'], '', 'h:i a', '', '', '');
                    $monday_end_time = $this->check_date('empty', $row['MONDAY_END_TIME'], '', 'h:i a', '', '', '');
                    $monday_lunch_start_time = $this->check_date('empty', $row['MONDAY_LUNCH_START_TIME'], '', 'h:i a', '', '', '');
                    $monday_lunch_end_time = $this->check_date('empty', $row['MONDAY_LUNCH_END_TIME'], '', 'h:i a', '', '', '');
                    $monday_half_day_mark = $this->check_date('summary', $row['MONDAY_HALF_DAY_MARK'], '', 'h:i a', '', '', '');

                    $tuesday_start_time = $this->check_date('empty', $row['TUESDAY_START_TIME'], '', 'h:i a', '', '', '');
                    $tuesday_end_time = $this->check_date('empty', $row['TUESDAY_END_TIME'], '', 'h:i a', '', '', '');
                    $tuesday_lunch_start_time = $this->check_date('empty', $row['TUESDAY_LUNCH_START_TIME'], '', 'h:i a', '', '', '');
                    $tuesday_lunch_end_time = $this->check_date('empty', $row['TUESDAY_LUNCH_END_TIME'], '', 'h:i a', '', '', '');
                    $tuesday_half_day_mark = $this->check_date('summary', $row['TUESDAY_HALF_DAY_MARK'], '', 'h:i a', '', '', '');

                    $wednesday_start_time = $this->check_date('empty', $row['WEDNESDAY_START_TIME'], '', 'h:i a', '', '', '');
                    $wednesday_end_time = $this->check_date('empty', $row['WEDNESDAY_END_TIME'], '', 'h:i a', '', '', '');
                    $wednesday_lunch_start_time = $this->check_date('empty', $row['WEDNESDAY_LUNCH_START_TIME'], '', 'h:i a', '', '', '');
                    $wednesday_lunch_end_time = $this->check_date('empty', $row['WEDNESDAY_LUNCH_END_TIME'], '', 'h:i a', '', '', '');
                    $wednesday_half_day_mark = $this->check_date('summary', $row['WEDNESDAY_HALF_DAY_MARK'], '', 'h:i a', '', '', '');

                    $thursday_start_time = $this->check_date('empty', $row['THURSDAY_START_TIME'], '', 'h:i a', '', '', '');
                    $thursday_end_time = $this->check_date('empty', $row['THURSDAY_END_TIME'], '', 'h:i a', '', '', '');
                    $thursday_lunch_start_time = $this->check_date('empty', $row['THURSDAY_LUNCH_START_TIME'], '', 'h:i a', '', '', '');
                    $thursday_lunch_end_time = $this->check_date('empty', $row['THURSDAY_LUNCH_END_TIME'], '', 'h:i a', '', '', '');
                    $thursday_half_day_mark = $this->check_date('summary', $row['THURSDAY_HALF_DAY_MARK'], '', 'h:i a', '', '', '');

                    $friday_start_time = $this->check_date('empty', $row['FRIDAY_START_TIME'], '', 'h:i a', '', '', '');
                    $friday_end_time = $this->check_date('empty', $row['FRIDAY_END_TIME'], '', 'h:i a', '', '', '');
                    $friday_lunch_start_time = $this->check_date('empty', $row['FRIDAY_LUNCH_START_TIME'], '', 'h:i a', '', '', '');
                    $friday_lunch_end_time = $this->check_date('empty', $row['FRIDAY_LUNCH_END_TIME'], '', 'h:i a', '', '', '');
                    $friday_half_day_mark = $this->check_date('summary', $row['FRIDAY_HALF_DAY_MARK'], '', 'h:i a', '', '', '');

                    $saturday_start_time = $this->check_date('empty', $row['SATURDAY_START_TIME'], '', 'h:i a', '', '', '');
                    $saturday_end_time = $this->check_date('empty', $row['SATURDAY_END_TIME'], '', 'h:i a', '', '', '');
                    $saturday_lunch_start_time = $this->check_date('empty', $row['SATURDAY_LUNCH_START_TIME'], '', 'h:i a', '', '', '');
                    $saturday_lunch_end_time = $this->check_date('empty', $row['SATURDAY_LUNCH_END_TIME'], '', 'h:i a', '', '', '');
                    $saturday_half_day_mark = $this->check_date('summary', $row['SATURDAY_HALF_DAY_MARK'], '', 'h:i a', '', '', '');

                    $sunday_start_time = $this->check_date('empty', $row['SUNDAY_START_TIME'], '', 'h:i a', '', '', '');
                    $sunday_end_time = $this->check_date('empty', $row['SUNDAY_END_TIME'], '', 'h:i a', '', '', '');
                    $sunday_lunch_start_time = $this->check_date('empty', $row['SUNDAY_LUNCH_START_TIME'], '', 'h:i a', '', '', '');
                    $sunday_lunch_end_time = $this->check_date('empty', $row['SUNDAY_LUNCH_END_TIME'], '', 'h:i a', '', '', '');
                    $sunday_half_day_mark = $this->check_date('summary', $row['SUNDAY_HALF_DAY_MARK'], '', 'h:i a', '', '', '');

                    $column .= '<tr>
                                    <td>Monday</td>
                                    <td>'. $monday_start_time .' - '. $monday_end_time .'</td>
                                    <td>'. $monday_lunch_start_time .' - '. $monday_lunch_end_time .'</td>
                                    <td>'. $monday_half_day_mark .'</td>
                                </tr>
                                <tr>
                                    <td>Tuesday</td>
                                    <td>'. $tuesday_start_time .' - '. $tuesday_end_time .'</td>
                                    <td>'. $tuesday_lunch_start_time .' - '. $tuesday_lunch_end_time .'</td>
                                    <td>'. $tuesday_half_day_mark .'</td>
                                </tr>
                                <tr>
                                    <td>Wednesday</td>
                                    <td>'. $wednesday_start_time .' - '. $wednesday_end_time .'</td>
                                    <td>'. $wednesday_lunch_start_time .' - '. $wednesday_lunch_end_time .'</td>
                                    <td>'. $wednesday_half_day_mark .'</td>
                                </tr>
                                <tr>
                                    <td>Thursday</td>
                                    <td>'. $thursday_start_time .' - '. $thursday_end_time .'</td>
                                    <td>'. $thursday_lunch_start_time .' - '. $thursday_lunch_end_time .'</td>
                                    <td>'. $thursday_half_day_mark .'</td>
                                </tr>
                                <tr>
                                    <td>Friday</td>
                                    <td>'. $friday_start_time .' - '. $friday_end_time .'</td>
                                    <td>'. $friday_lunch_start_time .' - '. $friday_lunch_end_time .'</td>
                                    <td>'. $friday_half_day_mark .'</td>
                                </tr>
                                <tr>
                                    <td>Saturday</td>
                                    <td>'. $saturday_start_time .' - '. $saturday_end_time .'</td>
                                    <td>'. $saturday_lunch_start_time .' - '. $saturday_lunch_end_time .'</td>
                                    <td>'. $saturday_half_day_mark .'</td>
                                </tr>
                                <tr>
                                    <td>Sunday</td>
                                    <td>'. $sunday_start_time .' - '. $sunday_end_time .'</td>
                                    <td>'. $sunday_lunch_start_time .' - '. $sunday_lunch_end_time .'</td>
                                    <td>'. $sunday_half_day_mark .'</td>
                                </tr>';
                }

                $column .= '</tbody>
                        </table>
                    </div>';

                return $column;
            }
            else{
                return $sql->errorInfo();
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_employee_without_user_account_options
    # Purpose    : Generates employee without user account options of dropdown.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_employee_without_user_account_options(){
        if ($this->databaseConnection()) {
            $option = '';
            
            $sql = $this->db_connection->prepare('CALL generate_employee_without_user_account_options()');

            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    while($row = $sql->fetch()){
                        $employee_id = trim($row['EMPLOYEE_ID']);
                        $file_as = trim($row['FILE_AS']);
    
                        $option .= "<option value='". $employee_id ."'>". $file_as ."</option>";
                    }
    
                    return $option;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_role_options
    # Purpose    : Generates role options of dropdown.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_role_options(){
        if ($this->databaseConnection()) {
            $option = '';
            
            $sql = $this->db_connection->prepare('CALL generate_role_options()');

            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    while($row = $sql->fetch()){
                        $role_id = $row['ROLE_ID'];
                        $role = $row['ROLE'];
    
                        $option .= "<option value='". $role_id ."'>". $role ."</option>";
                    }
    
                    return $option;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_allowance_type_options
    # Purpose    : Generates allowance type options of dropdown.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_allowance_type_options(){
        if ($this->databaseConnection()) {
            $option = '';
            
            $sql = $this->db_connection->prepare('CALL generate_allowance_type_options()');

            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    while($row = $sql->fetch()){
                        $allowance_type_id = $row['ALLOWANCE_TYPE_ID'];
                        $allowance_type = $row['ALLOWANCE_TYPE'];
    
                        $option .= "<option value='". $allowance_type_id ."'>". $allowance_type ."</option>";
                    }
    
                    return $option;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_deduction_type_options
    # Purpose    : Generates deduction type options of dropdown.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_deduction_type_options(){
        if ($this->databaseConnection()) {
            $option = '';
            
            $sql = $this->db_connection->prepare('CALL generate_deduction_type_options()');

            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    while($row = $sql->fetch()){
                        $deduction_type_id = $row['DEDUCTION_TYPE_ID'];
                        $deduction_type = $row['DEDUCTION_TYPE'];
    
                        $option .= "<option value='". $deduction_type_id ."'>". $deduction_type ."</option>";
                    }
    
                    return $option;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_contribution_deduction_type_options
    # Purpose    : Generates contribution deduction type options of dropdown.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_contribution_deduction_type_options(){
        if ($this->databaseConnection()) {
            $option = '';
            
            $sql = $this->db_connection->prepare('CALL generate_contribution_deduction_type_options()');

            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    while($row = $sql->fetch()){
                        $government_contribution_id = $row['GOVERNMENT_CONTRIBUTION_ID'];
                        $government_contribution = $row['GOVERNMENT_CONTRIBUTION'];
    
                        $option .= "<option value='". $government_contribution_id ."'>". $government_contribution ."</option>";
                    }
    
                    return $option;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #
    # Name       : generate_employee_without_workshift_options
    # Purpose    : Generates employee without workshift options of dropdown.
    #
    # Returns    : String
    #
    # -------------------------------------------------------------
    public function generate_employee_without_workshift_options(){
        if ($this->databaseConnection()) {
            $option = '';
            
            $sql = $this->db_connection->prepare('CALL generate_employee_without_workshift_options()');

            if($sql->execute()){
                $count = $sql->rowCount();
        
                if($count > 0){
                    while($row = $sql->fetch()){
                        $employee_id = $row['EMPLOYEE_ID'];
                        $file_as = $row['FILE_AS'];
    
                        $option .= "<option value='". $employee_id ."'>". $file_as ."</option>";
                    }
    
                    return $option;
                }
            }
            else{
                return $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------
}

?>