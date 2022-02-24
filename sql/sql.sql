/* Create Table */

CREATE TABLE tbluseraccount(
	USERNAME VARCHAR(50) PRIMARY KEY,
	PASSWORD VARCHAR(200) NOT NULL,
	USER_ROLE VARCHAR(50) NOT NULL,
	ACTIVE INT(1),
	PASSWORD_EXPIRY_DATE DATE NOT NULL,
	FAILED_LOGIN INT(1),
	LAST_FAILED_LOGIN DATE,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblsystemcode(
	SYSTEM_TYPE VARCHAR(20) NOT NULL,
	SYSTEM_CODE VARCHAR(20) NOT NULL,
	DESCRIPTION VARCHAR(100) NOT NULL,
	TRANSACTION_LOG_ID VARCHAR(500)
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblsystemparameters(
	PARAMETER_ID INT PRIMARY KEY,
	PARAMETER_DESC VARCHAR(100) NOT NULL,
	PARAMETER_EXTENSION VARCHAR(10),
	PARAMETER_NUMBER INT,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tbltransactionlog( 
	TRANSACTION_LOG_ID VARCHAR(500) NOT NULL,
	USERNAME VARCHAR(50) NOT NULL,
	LOG_TYPE VARCHAR(100) NOT NULL,
	LOG_DATE DATETIME NOT NULL,
	LOG VARCHAR(4000)
);

CREATE TABLE tblpolicy(
	POLICY_ID INT(50) PRIMARY KEY,
	POLICY VARCHAR(100) NOT NULL,
	DESCRIPTION VARCHAR(200) NOT NULL,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblpermission(
	PERMISSION_ID INT(50) PRIMARY KEY,
	POLICY_ID INT(50) NOT NULL,
	PERMISSION VARCHAR(100) NOT NULL,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblrole(
	ROLE_ID VARCHAR(50) PRIMARY KEY,
	DESCRIPTION VARCHAR(100) NOT NULL,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblroleuser(
	ROLE_ID VARCHAR(50) NOT NULL,
	USERNAME VARCHAR(50) NOT NULL,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblrolepermission(
	ROLE_ID VARCHAR(50) NOT NULL,
	PERMISSION_ID INT(20) NOT NULL,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblcontacts(
	USERNAME VARCHAR(50) PRIMARY KEY,
	FIRST_NAME VARCHAR(100) NOT NULL,
	MIDDLE_NAME VARCHAR(100),
	LAST_NAME VARCHAR(100) NOT NULL,
	EMAIL VARCHAR(100) NOT NULL,
	PERMANENT_ADDRESS VARCHAR(500) NOT NULL,
	PRESENT_ADDRESS VARCHAR(500) NOT NULL,
	EMAIL VARCHAR(30) NOT NULL,
	PHONE VARCHAR(30),
	TELEPHONE VARCHAR(30),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tbluserinterfacesettings(
	SETTINGS_ID INT PRIMARY KEY,
	LOGIN_BG VARCHAR(500),
	LOGO_LIGHT VARCHAR(500),
	LOGO_DARK VARCHAR(500),
	LOGO_ICON_LIGHT VARCHAR(500),
	LOGO_ICON_DARK VARCHAR(500),
	FAVICON VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblmailconfig(
	MAIL_ID INT PRIMARY KEY,
	MAIL_HOST VARCHAR(100) NOT NULL,
	PORT INT NOT NULL,
	SMTP_AUTH INT(1) NOT NULL,
	SMTP_AUTO_TLS INT(1) NOT NULL,
	USERNAME VARCHAR(200) NOT NULL,
	PASSWORD VARCHAR(200) NOT NULL,
	MAIL_ENCRYPTION VARCHAR(20),
	MAIL_FROM_NAME VARCHAR(200),
	MAIL_FROM_EMAIL VARCHAR(200),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblnotificationtype(
	NOTIFICATION_ID INT(50) PRIMARY KEY,
	NOTIFICATION VARCHAR(100) NOT NULL,
	DESCRIPTION VARCHAR(200) NOT NULL,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblnotificationdetails(
	NOTIFICATION_ID INT(50) PRIMARY KEY,
	NOTIFICATION_TITLE VARCHAR(500),
	NOTIFICATION_MESSAGE VARCHAR(500),
	SYSTEM_LINK VARCHAR(200),
	WEB_LINK VARCHAR(200),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblsystemnotification(
	NOTIFICATION_ID INT(50),
	NOTIFICATION VARCHAR(5) NOT NULL,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblcompany(
	COMPANY_ID VARCHAR(50) PRIMARY KEY,
	COMPANY_NAME VARCHAR(100) NOT NULL,
	EMAIL VARCHAR(50),
	TELEPHONE VARCHAR(20),
	PHONE VARCHAR(20),
	WEBSITE VARCHAR(100),
	ADDRESS VARCHAR(200),
	PROVINCE_ID INT,
	CITY_ID INT,
	BARANGAY_ID INT,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblprovince(
	PROVINCE_ID INT PRIMARY KEY,
	PROVINCE VARCHAR(300) NOT NULL,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblcity(
	CITY_ID INT PRIMARY KEY,
	PROVINCE_ID INT NOT NULL,
	CITY VARCHAR(300) NOT NULL,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblbarangay(
	BARANGAY_ID INT PRIMARY KEY,
	CITY_ID INT,
	BARANGAY VARCHAR(300) NOT NULL,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tbldepartment(
	DEPARTMENT_ID VARCHAR(50) PRIMARY KEY,
	DEPARTMENT VARCHAR(200) NOT NULL,
	DESCRIPTION VARCHAR(200) NOT NULL,
	DEPARTMENT_HEAD VARCHAR(100),
	PARENT_DEPARTMENT VARCHAR(50),
	TRANSACTION_LOG_ID VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tbldesignation(
	DESIGNATION_ID VARCHAR(50) PRIMARY KEY,
	DESIGNATION VARCHAR(200) NOT NULL,
	DESCRIPTION VARCHAR(200) NOT NULL,
	JOB_DESCRIPTION VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblbranch(
	BRANCH_ID VARCHAR(50) PRIMARY KEY,
	BRANCH VARCHAR(200) NOT NULL,
	EMAIL VARCHAR(30) NOT NULL,
	PHONE VARCHAR(30),
	TELEPHONE VARCHAR(30),
    ADDRESS VARCHAR(500) NOT NULL,
    TRANSACTION_LOG_ID VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tbluploadsetting(
	UPLOAD_SETTING_ID INT(50) PRIMARY KEY,
	UPLOAD_SETTING VARCHAR(200) NOT NULL,
	DESCRIPTION VARCHAR(200) NOT NULL,
	MAX_FILE_SIZE DOUBLE,
    TRANSACTION_LOG_ID VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tbluploadfiletype(
	UPLOAD_SETTING_ID INT(50),
	FILE_TYPE VARCHAR(50) NOT NULL,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblemploymentstatus(
	EMPLOYMENT_STATUS_ID VARCHAR(50),
	EMPLOYMENT_STATUS VARCHAR(100) NOT NULL,
	DESCRIPTION VARCHAR(200) NOT NULL,
	COLOR_VALUE VARCHAR(20) NOT NULL,
	TRANSACTION_LOG_ID VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblemployee(
	EMPLOYEE_ID VARCHAR(100) PRIMARY KEY,
	ID_NUMBER VARCHAR(100) NOT NULL,
	USERNAME VARCHAR(50),
	FILE_AS VARCHAR(500) NOT NULL,
	FIRST_NAME VARCHAR(100) NOT NULL,
	MIDDLE_NAME VARCHAR(100),
	LAST_NAME VARCHAR(100) NOT NULL,
	SUFFIX VARCHAR(20),
	BIRTHDAY DATE NOT NULL,
	EMPLOYMENT_STATUS VARCHAR(50) NOT NULL,
	JOIN_DATE DATE NOT NULL,
	EXIT_DATE DATE,
	EXIT_REASON VARCHAR(500),
	EMAIL VARCHAR(100) NOT NULL,
	PHONE VARCHAR(30),
	TELEPHONE VARCHAR(30),
	DEPARTMENT VARCHAR(50) NOT NULL,
	DESIGNATION VARCHAR(50) NOT NULL,
	BRANCH VARCHAR(50) NOT NULL,
	GENDER VARCHAR(20) NOT NULL,
	TRANSACTION_LOG_ID VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblemergencycontact(
	CONTACT_ID VARCHAR(100) PRIMARY KEY,
	EMPLOYEE_ID VARCHAR(100) NOT NULL,
	NAME VARCHAR(300) NOT NULL,
	RELATIONSHIP VARCHAR(20) NOT NULL,
	EMAIL VARCHAR(100),
	PHONE VARCHAR(30) NOT NULL,
	TELEPHONE VARCHAR(30),
	ADDRESS VARCHAR(200),
	CITY INT,
	PROVINCE INT,
	TRANSACTION_LOG_ID VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblemployeeaddress(
	ADDRESS_ID VARCHAR(100) PRIMARY KEY,
	EMPLOYEE_ID VARCHAR(100) NOT NULL,
	ADDRESS_TYPE VARCHAR(20) NOT NULL,
	ADDRESS VARCHAR(200),
	CITY INT,
	PROVINCE INT,
	TRANSACTION_LOG_ID VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblemployeesocial(
	SOCIAL_ID VARCHAR(100) PRIMARY KEY,
	EMPLOYEE_ID VARCHAR(100) NOT NULL,
	SOCIAL_TYPE VARCHAR(20) NOT NULL,
	LINK VARCHAR(300),
	TRANSACTION_LOG_ID VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblworkshift(
	WORK_SHIFT_ID VARCHAR(100) PRIMARY KEY,
	WORK_SHIFT VARCHAR(100) NOT NULL,
	WORK_SHIFT_TYPE VARCHAR(20) NOT NULL,
	DESCRIPTION VARCHAR(200) NOT NULL,
	TRANSACTION_LOG_ID VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblworkshiftschedule(
	WORK_SHIFT_ID VARCHAR(100) PRIMARY KEY,
	START_DATE DATE,
	END_DATE DATE,
	MONDAY_START_TIME TIME,
	MONDAY_END_TIME TIME,
	MONDAY_LUNCH_START_TIME TIME,
	MONDAY_LUNCH_END_TIME TIME,
	MONDAY_LATE_MARK INT,
	MONDAY_HALF_DAY_MARK TIME,
	TUESDAY_START_TIME TIME,
	TUESDAY_END_TIME TIME,
	TUESDAY_LUNCH_START_TIME TIME,
	TUESDAY_LUNCH_END_TIME TIME,
	TUESDAY_LATE_MARK INT,
	TUESDAY_HALF_DAY_MARK TIME,
	WEDNESDAY_START_TIME TIME,
	WEDNESDAY_END_TIME TIME,
	WEDNESDAY_LUNCH_START_TIME TIME,
	WEDNESDAY_LUNCH_END_TIME TIME,
	WEDNESDAY_LATE_MARK INT,
	WEDNESDAY_HALF_DAY_MARK TIME,
	THURSDAY_START_TIME TIME,
	THURSDAY_END_TIME TIME,
	THURSDAY_LUNCH_START_TIME TIME,
	THURSDAY_LUNCH_END_TIME TIME,
	THURSDAY_LATE_MARK INT,
	THURSDAY_HALF_DAY_MARK TIME,
	FRIDAY_START_TIME TIME,
	FRIDAY_END_TIME TIME,
	FRIDAY_LUNCH_START_TIME TIME,
	FRIDAY_LUNCH_END_TIME TIME,
	FRIDAY_LATE_MARK INT,
	FRIDAY_HALF_DAY_MARK TIME,
	SATURDAY_START_TIME TIME,
	SATURDAY_END_TIME TIME,
	SATURDAY_LUNCH_START_TIME TIME,
	SATURDAY_LUNCH_END_TIME TIME,
	SATURDAY_LATE_MARK INT,
	SATURDAY_HALF_DAY_MARK TIME,
	SUNDAY_START_TIME TIME,
	SUNDAY_END_TIME TIME,
	SUNDAY_LUNCH_START_TIME TIME,
	SUNDAY_LUNCH_END_TIME TIME,
	SUNDAY_LATE_MARK INT,
	SUNDAY_HALF_DAY_MARK TIME,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblemployeeworkshift(
	WORK_SHIFT_ID VARCHAR(100) NOT NULL,
	EMPLOYEE_ID VARCHAR(100) NOT NULL,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblattendancerecord(
	ATTENDANCE_ID VARCHAR(100) PRIMARY KEY,
	EMPLOYEE_ID VARCHAR(100) NOT NULL,
	TIME_IN_DATE DATE,
	TIME_IN TIME,
	TIME_IN_LOCATION VARCHAR(100),
	TIME_IN_IP_ADDRESS VARCHAR(20),
	TIME_IN_BY VARCHAR(100),
	TIME_IN_BEHAVIOR VARCHAR(20),
	TIME_IN_NOTE VARCHAR(200),
	TIME_OUT_DATE DATE,
	TIME_OUT TIME,
	TIME_OUT_LOCATION VARCHAR(100),
	TIME_OUT_IP_ADDRESS VARCHAR(20),
	TIME_OUT_BY VARCHAR(100),
	TIME_OUT_BEHAVIOR VARCHAR(100),
	TIME_OUT_NOTE VARCHAR(200),
	LATE DOUBLE,
	EARLY_LEAVING DOUBLE,
	OVERTIME DOUBLE,
	TOTAL_WORKING_HOURS DOUBLE,
	REMARKS VARCHAR(500),
	TRANSACTION_LOG_ID VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblleavetype(
	LEAVE_TYPE_ID VARCHAR(50) PRIMARY KEY,
	LEAVE_NAME VARCHAR(100) NOT NULL,
	DESCRIPTION VARCHAR(200) NOT NULL,
	NO_LEAVES  DOUBLE,
	PAID_STATUS VARCHAR(20) NOT NULL,
	TRANSACTION_LOG_ID VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblleaveentitlement(
	LEAVE_ENTITLEMENT_ID VARCHAR(50) PRIMARY KEY,
	EMPLOYEE_ID VARCHAR(100) NOT NULL,
	LEAVE_TYPE VARCHAR(50) NOT NULL,
	NO_LEAVES  DOUBLE,
	ACQUIRED_LEAVES  DOUBLE,
	START_DATE DATE NOT NULL,
	END_DATE DATE NOT NULL,
	TRANSACTION_LOG_ID VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblleave(
	LEAVE_ID VARCHAR(50) PRIMARY KEY,
	EMPLOYEE_ID VARCHAR(100) NOT NULL,
	LEAVE_TYPE VARCHAR(50) NOT NULL,
	LEAVE_DATE DATE NOT NULL,
	START_TIME TIME,
	END_TIME TIME,
	LEAVE_STATUS INT(1),
	LEAVE_REASON VARCHAR(500),
	DECISION_REMARKS VARCHAR(500),
	DECISION_DATE DATE,
	DECISION_TIME TIME,
	DECISION_BY VARCHAR(50),
	TRANSACTION_LOG_ID VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblemployeefile(
	FILE_ID VARCHAR(50) PRIMARY KEY,
	EMPLOYEE_ID VARCHAR(100) NOT NULL,
	FILE_NAME VARCHAR(100) NOT NULL,
	FILE_CATEGORY VARCHAR(50) NOT NULL,
	REMARKS VARCHAR(100) NOT NULL,
	FILE_DATE DATE NOT NULL,
	UPLOAD_DATE DATE NOT NULL,
	UPLOAD_TIME TIME NOT NULL,
	UPLOAD_BY VARCHAR(50) NOT NULL,
	FILE_PATH VARCHAR(500) NOT NULL,
	TRANSACTION_LOG_ID VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblholiday(
	HOLIDAY_ID VARCHAR(50) PRIMARY KEY,
	HOLIDAY VARCHAR(200) NOT NULL,
	HOLIDAY_DATE DATE NOT NULL,
	HOLIDAY_TYPE VARCHAR(20),
	TRANSACTION_LOG_ID VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblholidaybranch(
	HOLIDAY_ID VARCHAR(50) NOT NULL,
	BRANCH_ID VARCHAR(200) NOT NULL,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblattendancesetting(
	SETTING_ID INT PRIMARY KEY,
	MAX_ATTENDANCE INT NOT NULL,
	TRANSACTION_LOG_ID VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblattendanceadjustmentexception(
	EMPLOYEE_ID VARCHAR(100) NOT NULL,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblattendancecreationexception(
	EMPLOYEE_ID VARCHAR(100) NOT NULL,
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblhealthdeclaration(
	DECLARATION_ID VARCHAR(50) PRIMARY KEY,
	EMPLOYEE_ID VARCHAR(100) NOT NULL,
	TEMPERATURE DOUBLE NOT NULL,
	QUESTION_1 INT,
	QUESTION_2 INT,
	QUESTION_3 INT,
	QUESTION_4 INT,
	QUESTION_5 INT,
	QUESTION_5_SPECIFIC VARCHAR(100),
	SUBMIT_DATE DATE NOT NULL,
	SUBMIT_TIME TIME NOT NULL,
	TRANSACTION_LOG_ID VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tbllocation(
	LOCATION_ID VARCHAR(50) PRIMARY KEY,
	EMPLOYEE_ID VARCHAR(100) NOT NULL,
	POSITION VARCHAR(100),
	LOG_DATE DATE NOT NULL,
	LOG_TIME TIME NOT NULL,
	REMARKS VARCHAR(500),
	TRANSACTION_LOG_ID VARCHAR(500),
	RECORD_LOG VARCHAR(100)
);

CREATE TABLE tblnotification(
	NOTIFICATION_ID INT PRIMARY KEY,
	NOTIFICATION_FROM VARCHAR(100) NOT NULL,
	NOTIFICATION_TO VARCHAR(100),
	STATUS INT(1),
	NOTIFICATION_TITLE VARCHAR(200),
	NOTIFICATION VARCHAR(1000),
	LINK VARCHAR(500),
	NOTIFICATION_DATE DATE,
	NOTIFICATION_TIME TIME,
	RECORD_LOG VARCHAR(100)
);

/* Index */

CREATE INDEX user_account_index ON tbluseraccount(USERNAME);
CREATE INDEX system_code_index ON tblsystemcode(SYSTEM_TYPE, SYSTEM_CODE);
CREATE INDEX system_parameters_index ON tblsystemparameters(PARAMETER_ID);
CREATE INDEX policy_index ON tblpolicy(POLICY_ID);
CREATE INDEX permission_index ON tblpermission(PERMISSION_ID);
CREATE INDEX role_index ON tblrole(ROLE_ID);
CREATE INDEX role_user_index ON tblroleuser(ROLE_ID, USERNAME);
CREATE INDEX role_permission_index ON tblrolepermission(ROLE_ID, PERMISSION_ID);
CREATE INDEX user_interface_setting_index ON tbluserinterfacesettings(SETTINGS_ID);
CREATE INDEX mail_config_index ON tblmailconfig(MAIL_ID);
CREATE INDEX notification_type_index ON tblnotificationtype(NOTIFICATION_ID);
CREATE INDEX system_notification_index ON tblsystemnotification(NOTIFICATION_ID, NOTIFICATION);
CREATE INDEX company_index ON tblcompany(COMPANY_ID);
CREATE INDEX province_index ON tblprovince(PROVINCE_ID);
CREATE INDEX city_index ON tblcity(CITY_ID, PROVINCE_ID);
CREATE INDEX barangay_index ON tblbarangay(BARANGAY_ID, CITY_ID);
CREATE INDEX designation_index ON tbldesignation(DESIGNATION_ID);
CREATE INDEX department_index ON tbldepartment(DEPARTMENT_ID);
CREATE INDEX transaction_log_index ON tbltransactionlog(TRANSACTION_LOG_ID);
CREATE INDEX employment_status_index ON tblemploymentstatus(EMPLOYMENT_STATUS_ID);
CREATE INDEX employee_index ON tblemployee(EMPLOYEE_ID);
CREATE INDEX emergency_contact_index ON tblemergencycontact(CONTACT_ID);
CREATE INDEX employee_address_index ON tblemployeeaddress(ADDRESS_ID);
CREATE INDEX employee_social_index ON tblemployeesocial(SOCIAL_ID);
CREATE INDEX work_shift_index ON tblworkshift(WORK_SHIFT_ID);
CREATE INDEX work_shift_schedule_index ON tblworkshiftschedule(WORK_SHIFT_ID);
CREATE INDEX attendance_record_index ON tblattendancerecord(ATTENDANCE_ID);
CREATE INDEX leave_type_index ON tblleavetype(LEAVE_TYPE_ID);
CREATE INDEX leave_entitlement_index ON tblleaveentitlement(LEAVE_ENTITLEMENT_ID);
CREATE INDEX leave_index ON tblleave(LEAVE_ID);
CREATE INDEX employee_file_index ON tblemployeefile(FILE_ID);
CREATE INDEX attendance_setting_index ON tblattendancesetting(SETTING_ID);
CREATE INDEX health_declaration_index ON tblhealthdeclaration(DECLARATION_ID);
CREATE INDEX location_index ON tbllocation(LOCATION_ID);
CREATE INDEX notification_index ON tblnotification(NOTIFICATION_ID);

/* Stored Procedure */

DELIMITER //

CREATE PROCEDURE check_user_exist(IN username VARCHAR(50))
BEGIN
	SET @username = username;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tbluseraccount WHERE BINARY USERNAME = @username';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_user_account_details(IN username VARCHAR(50))
BEGIN
	SET @username = username;

	SET @query = 'SELECT PASSWORD, ACTIVE, PASSWORD_EXPIRY_DATE, FAILED_LOGIN, LAST_FAILED_LOGIN, TRANSACTION_LOG_ID, RECORD_LOG FROM tbluseraccount WHERE USERNAME = @username';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_login_attempt(IN username VARCHAR(50), login_attemp INT(1), last_failed_attempt_date DATE)
BEGIN
	SET @username = username;
	SET @login_attemp = login_attemp;
	SET @last_failed_attempt_date = last_failed_attempt_date;

	SET @query = 'UPDATE tbluseraccount SET FAILED_LOGIN = @login_attemp, LAST_FAILED_LOGIN = @last_failed_attempt_date WHERE USERNAME = @username';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_transaction_log(IN transaction_log_id VARCHAR(500), IN username VARCHAR(50), log_type VARCHAR(100), log_date DATETIME, log VARCHAR(4000))
BEGIN
	SET @transaction_log_id = transaction_log_id;
	SET @username = username;
	SET @log_type = log_type;
	SET @log_date = log_date;
	SET @log = log;

	SET @query = 'INSERT INTO tbltransactionlog (TRANSACTION_LOG_ID, USERNAME, LOG_TYPE, LOG_DATE, LOG) VALUES(@transaction_log_id, @username, @log_type, @log_date, @log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_transaction_log_details(IN transaction_log_id VARCHAR(500))
BEGIN
	SET @transaction_log_id = transaction_log_id;

	SET @query = 'SELECT USERNAME, LOG_TYPE, LOG_DATE, LOG, RECORD_LOG FROM tbltransactionlog WHERE TRANSACTION_LOG_ID = @transaction_log_id ORDER BY LOG_DATE DESC';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_user_password(IN username VARCHAR(50), password VARCHAR(200), password_expiry_date DATE)
BEGIN
	SET @username = username;
	SET @password = password;
	SET @password_expiry_date = password_expiry_date;

	SET @query = 'UPDATE tbluseraccount SET PASSWORD = @password, PASSWORD_EXPIRY_DATE = @password_expiry_date WHERE USERNAME = @username';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_system_parameter_exist(IN parameter_id INT)
BEGIN
	SET @parameter_id = parameter_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblsystemparameters WHERE PARAMETER_ID = @parameter_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_system_parameter(IN parameter_id INT, IN parameter VARCHAR(100), IN extension VARCHAR(10), IN parameter_number INT, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @parameter_id = parameter_id;
	SET @parameter = parameter;
	SET @extension = extension;
	SET @parameter_number = parameter_number;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblsystemparameters SET PARAMETER_DESC = @parameter, PARAMETER_EXTENSION = @extension, PARAMETER_NUMBER = @parameter_number, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE PARAMETER_ID = @parameter_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_system_parameter(IN parameter_id INT, IN parameter VARCHAR(100), IN extension VARCHAR(10), IN parameter_number INT, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @parameter_id = parameter_id;
	SET @parameter = parameter;
	SET @extension = extension;
	SET @parameter_number = parameter_number;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblsystemparameters (PARAMETER_ID, PARAMETER_DESC, PARAMETER_EXTENSION, PARAMETER_NUMBER, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@parameter_id, @parameter, @extension, @parameter_number, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_system_parameter_value(IN parameter_id INT, IN parameter_number INT, IN record_log VARCHAR(100))
BEGIN
	SET @parameter_id = parameter_id;
	SET @parameter_number = parameter_number;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblsystemparameters SET PARAMETER_NUMBER = @parameter_number, RECORD_LOG = @record_log WHERE PARAMETER_ID = @parameter_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_system_parameter(IN parameter_id INT)
BEGIN
	SET @parameter_id = parameter_id;

	SET @query = 'SELECT PARAMETER_EXTENSION, PARAMETER_NUMBER FROM tblsystemparameters WHERE PARAMETER_ID = @parameter_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_system_parameter_details(IN parameter_id INT)
BEGIN
	SET @parameter_id = parameter_id;

	SET @query = 'SELECT PARAMETER_DESC, PARAMETER_EXTENSION, PARAMETER_NUMBER, TRANSACTION_LOG_ID, RECORD_LOG FROM tblsystemparameters WHERE PARAMETER_ID = @parameter_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_system_parameter(IN parameter_id INT)
BEGIN
	SET @parameter_id = parameter_id;

	SET @query = 'DELETE FROM tblsystemparameters WHERE PARAMETER_ID = @parameter_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_policy_exist(IN policy_id INT)
BEGIN
	SET @policy_id = policy_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblpolicy WHERE POLICY_ID = @policy_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_policy(IN policy_id INT, IN policy VARCHAR(100), IN description VARCHAR(200), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @policy_id = policy_id;
	SET @policy = policy;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblpolicy SET POLICY = @policy, DESCRIPTION = @description, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE POLICY_ID = @policy_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_policy(IN policy_id INT, IN policy VARCHAR(100), IN description VARCHAR(200), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @policy_id = policy_id;
	SET @policy = policy;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblpolicy (POLICY_ID, POLICY, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@policy_id, @policy, @description, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_policy_details(IN policy_id INT)
BEGIN
	SET @policy_id = policy_id;

	SET @query = 'SELECT POLICY, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG FROM tblpolicy WHERE POLICY_ID = @policy_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_policy(IN policy_id INT)
BEGIN
	SET @policy_id = policy_id;

	SET @query = 'DELETE FROM tblpolicy WHERE POLICY_ID = @policy_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_all_permission(IN policy INT)
BEGIN
	SET @policy = policy;

	SET @query = 'DELETE FROM tblpermission WHERE POLICY = @policy';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_permission_exist(IN permission_id INT)
BEGIN
	SET @permission_id = permission_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblpermission WHERE PERMISSION_ID = @permission_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_permission(IN permission_id INT, IN policy INT, IN permission VARCHAR(100), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @permission_id = permission_id;
	SET @permission = permission;
	SET @policy = policy;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblpermission SET POLICY = @policy, PERMISSION = @permission, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE PERMISSION_ID = @permission_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_permission(IN permission_id INT, IN policy INT, IN permission VARCHAR(100), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @permission_id = permission_id;
	SET @policy = policy;
	SET @permission = permission;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblpermission (PERMISSION_ID, POLICY, PERMISSION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@permission_id, @policy, @permission, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_permission_details(IN permission_id INT)
BEGIN
	SET @permission_id = permission_id;

	SET @query = 'SELECT POLICY, PERMISSION, TRANSACTION_LOG_ID, RECORD_LOG FROM tblpermission WHERE PERMISSION_ID = @permission_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_permission(IN permission_id INT)
BEGIN
	SET @permission_id = permission_id;

	SET @query = 'DELETE FROM tblpermission WHERE PERMISSION_ID = @permission_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_role_permissions(IN username VARCHAR(50))
BEGIN
	SET @username = username;

	SET @query = 'SELECT USER_ROLE FROM tbluseraccount WHERE USERNAME = @username';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_permission_count(IN role_id VARCHAR(50), IN permission_id INT)
BEGIN
	SET @role_id = role_id;
	SET @permission_id = permission_id;

	SET @query = 'SELECT COUNT(PERMISSION_ID) AS TOTAL FROM tblrolepermission WHERE ROLE_ID = @role_id AND PERMISSION_ID = @permission_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_role_exist(IN role_id VARCHAR(50))
BEGIN
	SET @role_id = role_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblrole WHERE ROLE_ID = @role_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_role(IN role_id VARCHAR(100), IN role VARCHAR(100), IN description VARCHAR(100), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @role_id = role_id;
	SET @role = role;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblrole SET ROLE = @role, DESCRIPTION = @description, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE ROLE_ID = @role_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_role(IN role_id VARCHAR(100), IN role VARCHAR(100), IN description VARCHAR(100), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @role_id = role_id;
	SET @role = role;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblrole (ROLE_ID, ROLE, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@role_id, @role, @description, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_role_details(IN role_id VARCHAR(100))
BEGIN
	SET @role_id = role_id;

	SET @query = 'SELECT ROLE, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG FROM tblrole WHERE ROLE_ID = @role_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_role(IN role_id VARCHAR(100))
BEGIN
	SET @role_id = role_id;

	SET @query = 'DELETE FROM tblrole WHERE ROLE_ID = @role_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_permission_role(IN role_id VARCHAR(100))
BEGIN
	SET @role_id = role_id;

	SET @query = 'DELETE FROM tblrolepermission WHERE ROLE_ID = @role_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_permission_role(IN role_id VARCHAR(100), IN permission_id INT, IN record_log VARCHAR(100))
BEGIN
	SET @role_id = role_id;
	SET @permission_id = permission_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblrolepermission (ROLE_ID, PERMISSION_ID, RECORD_LOG) VALUES (@role_id, @permission_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_role_permission_details(IN role_id VARCHAR(100))
BEGIN
	SET @role_id = role_id;

	SET @query = 'SELECT PERMISSION_ID, RECORD_LOG FROM tblrolepermission WHERE ROLE_ID = @role_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_system_code_exist(IN system_type VARCHAR(20), IN system_code VARCHAR(20))
BEGIN
	SET @system_type = system_type;
	SET @system_code = system_code;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblsystemcode WHERE SYSTEM_TYPE = @system_type AND SYSTEM_CODE = @system_code';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_system_code(IN system_type VARCHAR(100), IN system_code VARCHAR(100), IN description VARCHAR(100), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @system_type = system_type;
	SET @system_code = system_code;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblsystemcode SET DESCRIPTION = @description, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SYSTEM_TYPE = @system_type AND SYSTEM_CODE = @system_code';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_system_code(IN system_type VARCHAR(100), IN system_code VARCHAR(100), IN description VARCHAR(100), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @system_type = system_type;
	SET @system_code = system_code;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblsystemcode (SYSTEM_TYPE, SYSTEM_CODE, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@system_type, @system_code, @description, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_system_code_details(IN system_type VARCHAR(100), IN system_code VARCHAR(100))
BEGIN
	SET @system_type = system_type;
	SET @system_code = system_code;

	SET @query = 'SELECT DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG FROM tblsystemcode WHERE SYSTEM_TYPE = @system_type AND SYSTEM_CODE = @system_code';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE generate_system_code_options(IN system_type VARCHAR(100))
BEGIN
	SET @system_type = system_type;

	SET @query = 'SELECT SYSTEM_CODE, DESCRIPTION FROM tblsystemcode WHERE SYSTEM_TYPE = @system_type ORDER BY DESCRIPTION';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_system_code(IN system_type VARCHAR(100), IN system_code VARCHAR(100))
BEGIN
	SET @system_type = system_type;
	SET @system_code = system_code;

	SET @query = 'DELETE FROM tblsystemcode WHERE SYSTEM_TYPE = @system_type AND SYSTEM_CODE = @system_code';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_user_interface_settings_exist(IN setting_id INT)
BEGIN
	SET @setting_id = setting_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tbluserinterfacesettings WHERE SETTINGS_ID = @setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_user_interface_settings(IN setting_id INT, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @setting_id = setting_id;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tbluserinterfacesettings (SETTINGS_ID, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@setting_id, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_user_interface_settings_images(IN setting_id INT, IN file_path VARCHAR(500), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100), IN request_type VARCHAR(20))
BEGIN
	SET @setting_id = setting_id;
	SET @file_path = file_path;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;
	SET @request_type = request_type;

	IF @request_type = 'login background' THEN
		SET @query = 'UPDATE tbluserinterfacesettings SET LOGIN_BG = @file_path, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SETTINGS_ID = @setting_id';
	ELSEIF @request_type = 'logo light' THEN
		SET @query = 'UPDATE tbluserinterfacesettings SET LOGO_LIGHT = @file_path, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SETTINGS_ID = @setting_id';
	ELSEIF @request_type = 'logo dark' THEN
		SET @query = 'UPDATE tbluserinterfacesettings SET LOGO_DARK = @file_path, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SETTINGS_ID = @setting_id';
	ELSEIF @request_type = 'logo icon light' THEN
		SET @query = 'UPDATE tbluserinterfacesettings SET LOGO_ICON_LIGHT = @file_path, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SETTINGS_ID = @setting_id';
	ELSEIF @request_type = 'logo icon dark' THEN
		SET @query = 'UPDATE tbluserinterfacesettings SET LOGO_ICON_DARK = @file_path, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SETTINGS_ID = @setting_id';
	ELSE
		SET @query = 'UPDATE tbluserinterfacesettings SET FAVICON = @file_path, TRANSACTION_LOG_ID = @transaction_log_id RECORD_LOG = @record_log WHERE SETTINGS_ID = @setting_id';
    END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_user_interface_settings_details(IN setting_id INT)
BEGIN
	SET @setting_id = setting_id;

	SET @query = 'SELECT LOGIN_BG, LOGO_LIGHT, LOGO_DARK, LOGO_ICON_LIGHT, LOGO_ICON_DARK, FAVICON, TRANSACTION_LOG_ID, RECORD_LOG FROM tbluserinterfacesettings WHERE SETTINGS_ID = @setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_mail_configuration_exist(IN mail_id INT)
BEGIN
	SET @mail_id = mail_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblmailconfig WHERE MAIL_ID = @mail_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_email_configuration(IN mail_id INT, IN mail_host VARCHAR(100), IN port INT, IN smtp_auth INT(1), IN smtp_auto_tls INT(1), IN username VARCHAR(200), IN password VARCHAR(200), IN mail_encryption VARCHAR(20), IN mail_from_name VARCHAR(200), IN mail_from_email VARCHAR(200), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @mail_id = mail_id;
	SET @mail_host = mail_host;
	SET @port = port;
	SET @smtp_auth = smtp_auth;
	SET @smtp_auto_tls = smtp_auto_tls;
	SET @username = username;
	SET @password = password;
	SET @mail_encryption = mail_encryption;
	SET @mail_from_name = mail_from_name;
	SET @mail_from_email = mail_from_email;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;


	SET @query = 'INSERT INTO tblmailconfig (MAIL_ID, MAIL_HOST, PORT, SMTP_AUTH, SMTP_AUTO_TLS, USERNAME, PASSWORD, MAIL_ENCRYPTION, MAIL_FROM_NAME, MAIL_FROM_EMAIL, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@mail_id, @mail_host, @port, @smtp_auth, @smtp_auto_tls, @username, @password, @mail_encryption, @mail_from_name, @mail_from_email, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_email_configuration(IN mail_id INT, IN mail_host VARCHAR(100), IN port INT, IN smtp_auth INT(1), IN smtp_auto_tls INT(1), IN username VARCHAR(200), IN password VARCHAR(200), IN mail_encryption VARCHAR(20), IN mail_from_name VARCHAR(200), IN mail_from_email VARCHAR(200), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @mail_id = mail_id;
	SET @mail_host = mail_host;
	SET @port = port;
	SET @smtp_auth = smtp_auth;
	SET @smtp_auto_tls = smtp_auto_tls;
	SET @username = username;
	SET @password = password;
	SET @mail_encryption = mail_encryption;
	SET @mail_from_name = mail_from_name;
	SET @mail_from_email = mail_from_email;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	IF @password IS NULL OR @password = '' THEN
		SET @query = 'UPDATE tblmailconfig SET MAIL_HOST = @mail_host, PORT = @port, SMTP_AUTH = @smtp_auth, SMTP_AUTO_TLS = @smtp_auto_tls, USERNAME = @username, MAIL_ENCRYPTION = @mail_encryption, MAIL_FROM_NAME = @mail_from_name, MAIL_FROM_EMAIL = @mail_from_email, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE MAIL_ID = @mail_id';
	ELSE
		SET @query = 'UPDATE tblmailconfig SET MAIL_HOST = @mail_host, PORT = @port, SMTP_AUTH = @smtp_auth, SMTP_AUTO_TLS = @smtp_auto_tls, USERNAME = @username, PASSWORD = @password, MAIL_ENCRYPTION = @mail_encryption, MAIL_FROM_NAME = @mail_from_name, MAIL_FROM_EMAIL = @mail_from_email, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE MAIL_ID = @mail_id';
    END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_email_configuration_details(IN mail_id INT)
BEGIN
	SET @mail_id = mail_id;

	SET @query = 'SELECT MAIL_HOST, PORT, SMTP_AUTH, SMTP_AUTO_TLS, USERNAME, PASSWORD, MAIL_ENCRYPTION, MAIL_FROM_NAME, MAIL_FROM_EMAIL, TRANSACTION_LOG_ID, RECORD_LOG FROM tblmailconfig WHERE MAIL_ID = @mail_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_notification_type_exist(IN notification_id INT)
BEGIN
	SET @notification_id = notification_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblnotificationtype WHERE NOTIFICATION_ID = @notification_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_notification_type(IN notification_id INT, IN notification VARCHAR(100), IN description VARCHAR(200), IN system_link VARCHAR(500), IN web_link VARCHAR(500), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @notification_id = notification_id;
	SET @notification = notification;
	SET @description = description;
	SET @system_link = system_link;
	SET @web_link = web_link;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblnotificationtype SET NOTIFICATION = @notification, DESCRIPTION = @description, SYSTEM_LINK = @system_link, WEB_LINK = @web_link, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE NOTIFICATION_ID = @notification_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_notification_type(IN notification_id INT, IN notification VARCHAR(100), IN description VARCHAR(200), IN system_link VARCHAR(500), IN web_link VARCHAR(500), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @notification_id = notification_id;
	SET @notification = notification;
	SET @description = description;
	SET @system_link = system_link;
	SET @web_link = web_link;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblnotificationtype (NOTIFICATION_ID, NOTIFICATION, DESCRIPTION, SYSTEM_LINK, WEB_LINK, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@notification_id, @notification, @description, @system_link, @web_link, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_notification_type_details(IN notification_id INT)
BEGIN
	SET @notification_id = notification_id;

	SET @query = 'SELECT NOTIFICATION, DESCRIPTION, SYSTEM_LINK, WEB_LINK, TRANSACTION_LOG_ID, RECORD_LOG FROM tblnotificationtype WHERE NOTIFICATION_ID = @notification_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_notification_type(IN notification_id INT)
BEGIN
	SET @notification_id = notification_id;

	SET @query = 'DELETE FROM tblnotificationtype WHERE NOTIFICATION_ID = @notification_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_application_notification_details()
BEGIN

	SET @query = 'SELECT NOTIFICATION_ID, NOTIFICATION, RECORD_LOG FROM tblsystemnotification';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_all_application_notification()
BEGIN

	SET @query = 'DELETE FROM tblsystemnotification';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_application_notification(IN notification_id INT, IN notification VARCHAR(5), IN record_log VARCHAR(100))
BEGIN
	SET @notification_id = notification_id;
	SET @notification = notification;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblsystemnotification (NOTIFICATION_ID, NOTIFICATION, RECORD_LOG) VALUES(@notification_id, @notification, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE generate_province()
BEGIN
	SET @query = 'SELECT PROVINCE_ID, PROVINCE FROM tblprovince ORDER BY PROVINCE';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE generate_city(IN province_id INT)
BEGIN
	SET @province_id = province_id;

	SET @query = 'SELECT CITY_ID, CITY FROM tblcity WHERE PROVINCE_ID = @province_id ORDER BY CITY';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE generate_barangay(IN city_id INT)
BEGIN
	SET @city_id = city_id;

	SET @query = 'SELECT BARANGAY_ID, BARANGAY FROM tblbarangay WHERE CITY_ID = @city_id ORDER BY BARANGAY';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_company_setting_exist(IN company_id VARCHAR(50))
BEGIN
	SET @company_id = company_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblcompany WHERE COMPANY_ID = @company_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_company_setting_details(IN company_id VARCHAR(50))
BEGIN
	SET @company_id = company_id;

	SET @query = 'SELECT COMPANY_NAME, EMAIL, TELEPHONE, PHONE, WEBSITE, ADDRESS, PROVINCE_ID, CITY_ID, TRANSACTION_LOG_ID, RECORD_LOG FROM tblcompany WHERE COMPANY_ID = @company_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_company_setting(IN company_id VARCHAR(50), IN company_name VARCHAR(100), IN email VARCHAR(50), IN telephone VARCHAR(20), IN phone VARCHAR(20), IN website VARCHAR(100), IN address VARCHAR(200), IN province_id INT, IN city_id INT, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @company_id = company_id;
	SET @company_name = company_name;
	SET @email = email;
	SET @telephone = telephone;
	SET @phone = phone;
	SET @website = website;
	SET @address = address;
	SET @province_id = province_id;
	SET @city_id = city_id;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblcompany SET COMPANY_NAME = @company_name, EMAIL = @email, TELEPHONE = @telephone, PHONE = @phone, WEBSITE = @website, ADDRESS = @address, PROVINCE_ID = @province_id, CITY_ID = @city_id, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE COMPANY_ID = @company_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_company_setting(IN company_id VARCHAR(50), IN company_name VARCHAR(100), IN email VARCHAR(50), IN telephone VARCHAR(20), IN phone VARCHAR(20), IN website VARCHAR(100), IN address VARCHAR(200), IN province_id INT, IN city_id INT, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @company_id = company_id;
	SET @company_name = company_name;
	SET @email = email;
	SET @telephone = telephone;
	SET @phone = phone;
	SET @website = website;
	SET @address = address;
	SET @province_id = province_id;
	SET @city_id = city_id;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblcompany (COMPANY_ID, COMPANY_NAME, EMAIL, TELEPHONE, PHONE, WEBSITE, ADDRESS, PROVINCE_ID, CITY_ID, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@company_id, @company_name, @email, @telephone, @phone, @website, @address, @province_id, @city_id, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_department_exist(IN department_id VARCHAR(50))
BEGIN
	SET @department_id = department_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tbldepartment WHERE DEPARTMENT_ID = @department_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_department(IN department_id VARCHAR(50), IN department VARCHAR(100), IN description VARCHAR(100), IN department_head VARCHAR(100), IN parent_department VARCHAR(50), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @department_id = department_id;
	SET @department = department;
	SET @description = description;
	SET @department_head = department_head;
	SET @parent_department = parent_department;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tbldepartment SET DEPARTMENT = @department, DESCRIPTION = @description, DEPARTMENT_HEAD = @department_head, PARENT_DEPARTMENT = @parent_department, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE DEPARTMENT_ID = @department_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_department(IN department_id VARCHAR(50), IN department VARCHAR(100), IN description VARCHAR(100), IN department_head VARCHAR(100), IN parent_department VARCHAR(50), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @department_id = department_id;
	SET @department = department;
	SET @description = description;
	SET @department_head = department_head;
	SET @parent_department = parent_department;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tbldepartment (DEPARTMENT_ID, DEPARTMENT, DESCRIPTION, DEPARTMENT_HEAD, PARENT_DEPARTMENT, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@department_id, @department, @description, @department_head, @parent_department, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_department_details(IN department_id VARCHAR(50))
BEGIN
	SET @department_id = department_id;

	SET @query = 'SELECT DEPARTMENT, DESCRIPTION, DEPARTMENT_HEAD, PARENT_DEPARTMENT, TRANSACTION_LOG_ID, RECORD_LOG FROM tbldepartment WHERE DEPARTMENT_ID = @department_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_department(IN department_id VARCHAR(50))
BEGIN
	SET @department_id = department_id;

	SET @query = 'DELETE FROM tbldepartment WHERE DEPARTMENT_ID = @department_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_designation_exist(IN designation_id VARCHAR(50))
BEGIN
	SET @designation_id = designation_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tbldesignation WHERE DESIGNATION_ID = @designation_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_designation(IN designation_id VARCHAR(100), IN designation VARCHAR(100), IN description VARCHAR(100), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @designation_id = designation_id;
	SET @designation = designation;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tbldesignation SET DESIGNATION = @designation, DESCRIPTION = @description, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE DESIGNATION_ID = @designation_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_designation(IN designation_id VARCHAR(100), IN designation VARCHAR(100), IN description VARCHAR(100), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @designation_id = designation_id;
	SET @designation = designation;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tbldesignation (DESIGNATION_ID, DESIGNATION, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@designation_id, @designation, @description, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_designation_details(IN designation_id VARCHAR(100))
BEGIN
	SET @designation_id = designation_id;

	SET @query = 'SELECT DESIGNATION, DESCRIPTION, JOB_DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG FROM tbldesignation WHERE DESIGNATION_ID = @designation_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_designation(IN designation_id VARCHAR(100))
BEGIN
	SET @designation_id = designation_id;

	SET @query = 'DELETE FROM tbldesignation WHERE DESIGNATION_ID = @designation_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_designation_file(IN designation_id VARCHAR(100), IN file_path VARCHAR(500), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @designation_id = designation_id;
	SET @file_path = file_path;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tbldesignation SET JOB_DESCRIPTION = @file_path, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE DESIGNATION_ID = @designation_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_branch_exist(IN branch_id VARCHAR(50))
BEGIN
	SET @branch_id = branch_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblbranch WHERE BRANCH_ID = @branch_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_branch(IN branch_id VARCHAR(50), IN branch VARCHAR(100), IN email VARCHAR(50), IN phone VARCHAR(30), IN telephone VARCHAR(30), IN address VARCHAR(500), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @branch_id = branch_id;
	SET @branch = branch;
	SET @email = email;
	SET @phone = phone;
	SET @telephone = telephone;
	SET @address = address;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblbranch SET BRANCH = @branch, EMAIL = @email, PHONE = @phone, TELEPHONE = @telephone, ADDRESS = @address, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE BRANCH_ID = @branch_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_branch(IN branch_id VARCHAR(50), IN branch VARCHAR(100), IN email VARCHAR(50), IN phone VARCHAR(30), IN telephone VARCHAR(30), IN address VARCHAR(500), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @branch_id = branch_id;
	SET @branch = branch;
	SET @email = email;
	SET @phone = phone;
	SET @telephone = telephone;
	SET @address = address;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblbranch (BRANCH_ID, BRANCH, EMAIL, PHONE, TELEPHONE, ADDRESS, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@branch_id, @branch, @email, @phone, @telephone, @address, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_branch_details(IN branch_id VARCHAR(50))
BEGIN
	SET @branch_id = branch_id;

	SET @query = 'SELECT BRANCH, EMAIL, PHONE, TELEPHONE, ADDRESS, TRANSACTION_LOG_ID, RECORD_LOG FROM tblbranch WHERE BRANCH_ID = @branch_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_branch(IN branch_id VARCHAR(50))
BEGIN
	SET @branch_id = branch_id;

	SET @query = 'DELETE FROM tblbranch WHERE BRANCH_ID = @branch_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_upload_setting_exist(IN upload_setting_id INT(50))
BEGIN
	SET @upload_setting_id = upload_setting_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tbluploadsetting WHERE UPLOAD_SETTING_ID = @upload_setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_upload_setting(IN upload_setting_id INT(50), IN upload_setting VARCHAR(200), IN description VARCHAR(200), IN max_file_size DOUBLE, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @upload_setting_id = upload_setting_id;
	SET @upload_setting = upload_setting;
	SET @description = description;
	SET @max_file_size = max_file_size;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tbluploadsetting SET UPLOAD_SETTING = @upload_setting, DESCRIPTION = @description, MAX_FILE_SIZE = @max_file_size, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE UPLOAD_SETTING_ID = @upload_setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_upload_setting(IN upload_setting_id INT(50), IN upload_setting VARCHAR(200), IN description VARCHAR(200), IN max_file_size DOUBLE, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @upload_setting_id = upload_setting_id;
	SET @upload_setting = upload_setting;
	SET @description = description;
	SET @max_file_size = max_file_size;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tbluploadsetting (UPLOAD_SETTING_ID, UPLOAD_SETTING, DESCRIPTION, MAX_FILE_SIZE, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@upload_setting_id, @upload_setting, @description, @max_file_size, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_upload_file_type(IN upload_setting_id INT(50), IN file_type VARCHAR(50), IN record_log VARCHAR(100))
BEGIN
	SET @upload_setting_id = upload_setting_id;
	SET @file_type = file_type;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tbluploadfiletype (UPLOAD_SETTING_ID, FILE_TYPE, RECORD_LOG) VALUES(@upload_setting_id, @file_type, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_upload_setting_details(IN upload_setting_id INT(50))
BEGIN
	SET @upload_setting_id = upload_setting_id;

	SET @query = 'SELECT UPLOAD_SETTING, DESCRIPTION, MAX_FILE_SIZE, TRANSACTION_LOG_ID, RECORD_LOG FROM tbluploadsetting WHERE UPLOAD_SETTING_ID = @upload_setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_upload_file_type_details(IN upload_setting_id INT(50))
BEGIN
	SET @upload_setting_id = upload_setting_id;

	SET @query = 'SELECT FILE_TYPE, RECORD_LOG FROM tbluploadfiletype WHERE UPLOAD_SETTING_ID = @upload_setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_upload_setting(IN upload_setting_id INT(50))
BEGIN
	SET @upload_setting_id = upload_setting_id;

	SET @query = 'DELETE FROM tbluploadsetting WHERE UPLOAD_SETTING_ID = @upload_setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_all_upload_file_type(IN upload_setting_id INT(50))
BEGIN
	SET @upload_setting_id = upload_setting_id;

	SET @query = 'DELETE FROM tbluploadfiletype WHERE UPLOAD_SETTING_ID = @upload_setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_employment_status_exist(IN employment_status_id VARCHAR(50))
BEGIN
	SET @employment_status_id = employment_status_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblemploymentstatus WHERE EMPLOYMENT_STATUS_ID = @employment_status_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_employment_status(IN employment_status_id VARCHAR(50), IN employment_status VARCHAR(100), IN description VARCHAR(100), IN color_value VARCHAR(20), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @employment_status_id = employment_status_id;
	SET @employment_status = employment_status;
	SET @description = description;
	SET @color_value = color_value;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblemploymentstatus SET EMPLOYMENT_STATUS = @employment_status, DESCRIPTION = @description, COLOR_VALUE = @color_value, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE EMPLOYMENT_STATUS_ID = @employment_status_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_employment_status(IN employment_status_id VARCHAR(50), IN employment_status VARCHAR(100), IN description VARCHAR(100), IN color_value VARCHAR(20), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @employment_status_id = employment_status_id;
	SET @employment_status = employment_status;
	SET @description = description;
	SET @color_value = color_value;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblemploymentstatus (EMPLOYMENT_STATUS_ID, EMPLOYMENT_STATUS, DESCRIPTION, COLOR_VALUE, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@employment_status_id, @employment_status, @description, @color_value, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_employment_status_details(IN employment_status_id VARCHAR(50))
BEGIN
	SET @employment_status_id = employment_status_id;

	SET @query = 'SELECT EMPLOYMENT_STATUS, DESCRIPTION, COLOR_VALUE, TRANSACTION_LOG_ID, RECORD_LOG FROM tblemploymentstatus WHERE EMPLOYMENT_STATUS_ID = @employment_status_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_employment_status(IN employment_status_id VARCHAR(50))
BEGIN
	SET @employment_status_id = employment_status_id;

	SET @query = 'DELETE FROM tblemploymentstatus WHERE EMPLOYMENT_STATUS_ID = @employment_status_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE generate_department_options()
BEGIN
	SET @query = 'SELECT DEPARTMENT_ID, DEPARTMENT FROM tbldepartment ORDER BY DEPARTMENT';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE generate_designation_options()
BEGIN
	SET @query = 'SELECT DESIGNATION_ID, DESIGNATION FROM tbldesignation ORDER BY DESIGNATION';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE generate_branch_options()
BEGIN
	SET @query = 'SELECT BRANCH_ID, BRANCH FROM tblbranch ORDER BY BRANCH';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE generate_employment_status_options()
BEGIN
	SET @query = 'SELECT EMPLOYMENT_STATUS_ID, EMPLOYMENT_STATUS FROM tblemploymentstatus ORDER BY EMPLOYMENT_STATUS';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_employee_exist(IN employee_id VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblemployee WHERE EMPLOYEE_ID = @employee_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_employee_id_number_exist(IN id_number VARCHAR(100))
BEGIN
	SET @id_number = id_number;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblemployee WHERE ID_NUMBER = @id_number';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_employee(IN employee_id VARCHAR(100), IN file_as VARCHAR(500), IN first_name VARCHAR(100), IN middle_name VARCHAR(100), IN last_name VARCHAR(100), IN suffix VARCHAR(20), IN birthday DATE, IN employment_status VARCHAR(50), IN joining_date DATE, IN permanency_date DATE, IN exit_date DATE, IN exit_reason VARCHAR(500), IN email VARCHAR(100), IN phone VARCHAR(30), IN telephone VARCHAR(30), IN department VARCHAR(50), IN designation VARCHAR(50), IN branch VARCHAR(50), IN gender VARCHAR(20), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;
	SET @file_as = file_as;
	SET @first_name = first_name;
	SET @middle_name = middle_name;
	SET @last_name = last_name;
	SET @suffix = suffix;
	SET @birthday = birthday;
	SET @employment_status = employment_status;
	SET @joining_date = joining_date;
	SET @permanency_date = permanency_date;
	SET @exit_date = exit_date;
	SET @exit_reason = exit_reason;
	SET @email = email;
	SET @phone = phone;
	SET @telephone = telephone;
	SET @department = department;
	SET @designation = designation;
	SET @branch = branch;
	SET @gender = gender;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblemployee SET FILE_AS = @file_as, FIRST_NAME = @first_name, MIDDLE_NAME = @middle_name, LAST_NAME = @last_name, SUFFIX = @suffix, BIRTHDAY = @birthday, EMPLOYMENT_STATUS = @employment_status, JOIN_DATE = @joining_date, PERMANENCY_DATE = @permanency_date, EXIT_DATE = @exit_date, EXIT_REASON = @exit_reason, EMAIL = @email, PHONE = @phone, TELEPHONE = @telephone, DEPARTMENT = @department, DESIGNATION = @designation, BRANCH = @branch, GENDER = @gender, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE EMPLOYEE_ID = @employee_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_employee(IN employee_id VARCHAR(100), IN id_number VARCHAR(100), IN file_as VARCHAR(500), IN first_name VARCHAR(100), IN middle_name VARCHAR(100), IN last_name VARCHAR(100), IN suffix VARCHAR(20), IN birthday DATE, IN employment_status VARCHAR(50), IN joining_date DATE, IN permanency_date DATE, IN exit_date DATE, IN exit_reason VARCHAR(500), IN email VARCHAR(100), IN phone VARCHAR(30), IN telephone VARCHAR(30), IN department VARCHAR(50), IN designation VARCHAR(50), IN branch VARCHAR(50), IN gender VARCHAR(20), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;
	SET @file_as = file_as;
	SET @first_name = first_name;
	SET @middle_name = middle_name;
	SET @last_name = last_name;
	SET @suffix = suffix;
	SET @birthday = birthday;
	SET @employment_status = employment_status;
	SET @joining_date = joining_date;
	SET @permanency_date = permanency_date;
	SET @exit_date = exit_date;
	SET @exit_reason = exit_reason;
	SET @email = email;
	SET @phone = phone;
	SET @telephone = telephone;
	SET @department = department;
	SET @designation = designation;
	SET @branch = branch;
	SET @gender = gender;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblemployee (EMPLOYEE_ID, ID_NUMBER, FILE_AS, FIRST_NAME, MIDDLE_NAME, LAST_NAME, SUFFIX, BIRTHDAY, EMPLOYMENT_STATUS, JOIN_DATE, PERMANENCY_DATE, EXIT_DATE, EXIT_REASON, EMAIL, PHONE, TELEPHONE, DEPARTMENT, DESIGNATION, BRANCH, GENDER, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@employee_id, @id_number, @file_as, @first_name, @middle_name, @last_name, @suffix, @birthday, @employment_status, @joining_date, @permanency_date, @exit_date, @exit_reason, @email, @phone, @telephone, @department, @designation, @branch, @gender, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_employee_details(IN employee_id VARCHAR(100), IN username VARCHAR(50))
BEGIN
	SET @employee_id = employee_id;
	SET @username = username;

	SET @query = 'SELECT EMPLOYEE_ID, ID_NUMBER, USERNAME, FILE_AS, FIRST_NAME, MIDDLE_NAME, LAST_NAME, SUFFIX, BIRTHDAY, EMPLOYMENT_STATUS, JOIN_DATE, EXIT_DATE, PERMANENCY_DATE, EXIT_REASON, EMAIL, PHONE, TELEPHONE, DEPARTMENT, DESIGNATION, BRANCH, GENDER, TRANSACTION_LOG_ID, RECORD_LOG FROM tblemployee WHERE EMPLOYEE_ID = @employee_id OR USERNAME = @username';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_employee(IN employee_id VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;

	SET @query = 'DELETE FROM tblemployee WHERE EMPLOYEE_ID = @employee_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_province_details(IN province_id INT)
BEGIN
	SET @province_id = province_id;

	SET @query = 'SELECT PROVINCE, RECORD_LOG FROM tblprovince WHERE PROVINCE_ID  = @province_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_city_details(IN city_id INT, IN province_id INT)
BEGIN
	SET @city_id = city_id;
	SET @province_id = province_id;

	SET @query = 'SELECT CITY, RECORD_LOG FROM tblcity WHERE CITY_ID = @city_id AND PROVINCE_ID  = @province_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE generate_province_options()
BEGIN
	SET @query = 'SELECT PROVINCE_ID, PROVINCE FROM tblprovince ORDER BY PROVINCE';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_emergency_contact_exist(IN contact_id VARCHAR(100))
BEGIN
	SET @contact_id = contact_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblemergencycontact WHERE CONTACT_ID = @contact_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_emergency_contact(IN contact_id VARCHAR(100), IN contact_name VARCHAR(300), IN relationship VARCHAR(20), IN email VARCHAR(100), IN phone VARCHAR(30), IN telephone VARCHAR(30), IN address VARCHAR(200), IN city INT, IN province INT, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @contact_id = contact_id;
	SET @contact_name = contact_name;
	SET @relationship = relationship;
	SET @email = email;
	SET @phone = phone;
	SET @telephone = telephone;
	SET @address = address;
	SET @city = city;
	SET @province = province;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblemergencycontact SET NAME = @contact_name, RELATIONSHIP = @relationship, EMAIL = @email, PHONE = @phone, TELEPHONE = @telephone, ADDRESS = @address, CITY = @city, PROVINCE = @province, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE CONTACT_ID = @contact_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_emergency_contact(IN contact_id VARCHAR(100), IN employee_id VARCHAR(100), IN contact_name VARCHAR(300), IN relationship VARCHAR(20), IN email VARCHAR(100), IN phone VARCHAR(30), IN telephone VARCHAR(30), IN address VARCHAR(200), IN city INT, IN province INT, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @contact_id = contact_id;
	SET @employee_id = employee_id;
	SET @contact_name = contact_name;
	SET @relationship = relationship;
	SET @email = email;
	SET @phone = phone;
	SET @telephone = telephone;
	SET @address = address;
	SET @city = city;
	SET @province = province;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblemergencycontact (CONTACT_ID, EMPLOYEE_ID, NAME, RELATIONSHIP, EMAIL, PHONE, TELEPHONE, ADDRESS, CITY, PROVINCE, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@contact_id, @employee_id, @contact_name, @relationship, @email, @phone, @telephone, @address, @city, @province, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_emergency_contact_details(IN contact_id VARCHAR(100))
BEGIN
	SET @contact_id = contact_id;

	SET @query = 'SELECT EMPLOYEE_ID, NAME, RELATIONSHIP, EMAIL, PHONE, TELEPHONE, ADDRESS, CITY, PROVINCE, TRANSACTION_LOG_ID, RECORD_LOG FROM tblemergencycontact WHERE CONTACT_ID = @contact_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_emergency_contact(IN contact_id VARCHAR(100))
BEGIN
	SET @contact_id = contact_id;

	SET @query = 'DELETE FROM tblemergencycontact WHERE CONTACT_ID = @contact_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_employee_address_exist(IN address_id VARCHAR(100))
BEGIN
	SET @address_id = address_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblemployeeaddress WHERE ADDRESS_ID = @address_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_employee_address(IN address_id VARCHAR(100), IN address_type VARCHAR(20), IN address VARCHAR(200), IN city INT, IN province INT, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @address_id = address_id;
	SET @address_type = address_type;
	SET @address = address;
	SET @city = city;
	SET @province = province;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblemployeeaddress SET ADDRESS_TYPE = @address_type, ADDRESS = @address, CITY = @city, PROVINCE = @province, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE ADDRESS_ID = @address_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_employee_address(IN address_id VARCHAR(100), IN employee_id VARCHAR(100), IN address_type VARCHAR(20), IN address VARCHAR(200), IN city INT, IN province INT, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @address_id = address_id;
	SET @employee_id = employee_id;
	SET @address_type = address_type;
	SET @address = address;
	SET @city = city;
	SET @province = province;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblemployeeaddress (ADDRESS_ID, EMPLOYEE_ID, ADDRESS_TYPE, ADDRESS, CITY, PROVINCE, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@address_id, @employee_id, @address_type, @address, @city, @province, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_employee_address_details(IN address_id VARCHAR(100))
BEGIN
	SET @address_id = address_id;

	SET @query = 'SELECT EMPLOYEE_ID, ADDRESS_TYPE, ADDRESS, CITY, PROVINCE, TRANSACTION_LOG_ID, RECORD_LOG FROM tblemployeeaddress WHERE ADDRESS_ID = @address_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_employee_address(IN address_id VARCHAR(100))
BEGIN
	SET @address_id = address_id;

	SET @query = 'DELETE FROM tblemployeeaddress WHERE ADDRESS_ID = @address_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_employee_social_exist(IN social_id VARCHAR(100))
BEGIN
	SET @social_id = social_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblemployeesocial WHERE SOCIAL_ID = @social_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_employee_social(IN social_id VARCHAR(100), IN social_type VARCHAR(20), IN link VARCHAR(300), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @social_id = social_id;
	SET @social_type = social_type;
	SET @link = link;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblemployeesocial SET SOCIAL_TYPE = @social_type, LINK = @link, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SOCIAL_ID = @social_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_employee_social(IN social_id VARCHAR(100), IN employee_id VARCHAR(100), IN social_type VARCHAR(20), IN link VARCHAR(300), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @social_id = social_id;
	SET @employee_id = employee_id;
	SET @social_type = social_type;
	SET @link = link;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblemployeesocial (SOCIAL_ID, EMPLOYEE_ID, SOCIAL_TYPE, LINK, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@social_id, @employee_id, @social_type, @link, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_employee_social_details(IN social_id VARCHAR(100))
BEGIN
	SET @social_id = social_id;

	SET @query = 'SELECT EMPLOYEE_ID, SOCIAL_TYPE, LINK, TRANSACTION_LOG_ID, RECORD_LOG FROM tblemployeesocial WHERE SOCIAL_ID = @social_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_employee_social(IN social_id VARCHAR(100))
BEGIN
	SET @social_id = social_id;

	SET @query = 'DELETE FROM tblemployeesocial WHERE SOCIAL_ID = @social_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_work_shift_exist(IN work_shift_id VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblworkshift WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_work_shift(IN work_shift_id VARCHAR(100), IN work_shift VARCHAR(100), IN work_shift_type VARCHAR(20), IN description VARCHAR(200), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;
	SET @work_shift = work_shift;
	SET @work_shift_type = work_shift_type;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblworkshift SET WORK_SHIFT = @work_shift, WORK_SHIFT_TYPE = @work_shift_type, DESCRIPTION = @description, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_work_shift(IN work_shift_id VARCHAR(100), IN work_shift VARCHAR(100), IN work_shift_type VARCHAR(20), IN description VARCHAR(200), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;
	SET @work_shift = work_shift;
	SET @work_shift_type = work_shift_type;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblworkshift (WORK_SHIFT_ID, WORK_SHIFT, WORK_SHIFT_TYPE, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@work_shift_id, @work_shift, @work_shift_type, @description, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_work_shift_details(IN work_shift_id VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;

	SET @query = 'SELECT WORK_SHIFT, WORK_SHIFT_TYPE, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG FROM tblworkshift WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_work_shift(IN work_shift_id VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;

	SET @query = 'DELETE FROM tblworkshift WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_work_shift_schedule_exist(IN work_shift_id VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblworkshiftschedule WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_work_shift_schedule(IN work_shift_id VARCHAR(100), IN start_date DATE, IN end_date DATE, IN monday_start_time TIME, IN monday_end_time TIME, IN monday_lunch_start_time TIME, IN monday_lunch_end_time TIME, IN monday_late_mark INT, IN monday_half_day_mark TIME, IN tuesday_start_time TIME, IN tuesday_end_time TIME, IN tuesday_lunch_start_time TIME, IN tuesday_lunch_end_time TIME, IN tuesday_late_mark INT, IN tuesday_half_day_mark TIME, IN wednesday_start_time TIME, IN wednesday_end_time TIME, IN wednesday_lunch_start_time TIME, IN wednesday_lunch_end_time TIME, IN wednesday_late_mark INT, IN wednesday_half_day_mark TIME, 
IN thursday_start_time TIME, IN thursday_end_time TIME, IN thursday_lunch_start_time TIME, IN thursday_lunch_end_time TIME, IN thursday_late_mark INT, IN thursday_half_day_mark TIME, IN friday_start_time TIME, IN friday_end_time TIME, IN friday_lunch_start_time TIME, IN friday_lunch_end_time TIME, IN friday_late_mark INT, IN friday_half_day_mark TIME, IN saturday_start_time TIME, IN saturday_end_time TIME, IN saturday_lunch_start_time TIME, IN saturday_lunch_end_time TIME, IN saturday_late_mark INT, IN saturday_half_day_mark TIME, IN sunday_start_time TIME, IN sunday_end_time TIME, IN sunday_lunch_start_time TIME, IN sunday_lunch_end_time TIME, IN sunday_late_mark INT, IN sunday_half_day_mark TIME, IN record_log VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;
	SET @start_date = start_date;
	SET @end_date = end_date;
	SET @monday_start_time = monday_start_time;
	SET @monday_end_time = monday_end_time;
	SET @monday_lunch_start_time = monday_lunch_start_time;
	SET @monday_lunch_end_time = monday_lunch_end_time;
	SET @monday_late_mark = monday_late_mark;
	SET @monday_half_day_mark = monday_half_day_mark;
	SET @tuesday_start_time = tuesday_start_time;
	SET @tuesday_end_time = tuesday_end_time;
	SET @tuesday_lunch_start_time = tuesday_lunch_start_time;
	SET @tuesday_lunch_end_time = tuesday_lunch_end_time;
	SET @tuesday_late_mark = tuesday_late_mark;
	SET @tuesday_half_day_mark = tuesday_half_day_mark;
	SET @wednesday_start_time = wednesday_start_time;
	SET @wednesday_end_time = wednesday_end_time;
	SET @wednesday_lunch_start_time = wednesday_lunch_start_time;
	SET @wednesday_lunch_end_time = wednesday_lunch_end_time;
	SET @wednesday_late_mark = wednesday_late_mark;
	SET @wednesday_half_day_mark = wednesday_half_day_mark;
	SET @thursday_start_time = wednesday_start_time;
	SET @thursday_end_time = thursday_end_time;
	SET @thursday_lunch_start_time = thursday_lunch_start_time;
	SET @thursday_lunch_end_time = thursday_lunch_end_time;
	SET @thursday_late_mark = thursday_late_mark;
	SET @thursday_half_day_mark = thursday_half_day_mark;
	SET @friday_start_time = wednesday_start_time;
	SET @friday_end_time = friday_end_time;
	SET @friday_lunch_start_time = friday_lunch_start_time;
	SET @friday_lunch_end_time = friday_lunch_end_time;
	SET @friday_late_mark = friday_late_mark;
	SET @friday_half_day_mark = friday_half_day_mark;
	SET @saturday_start_time = wednesday_start_time;
	SET @saturday_end_time = saturday_end_time;
	SET @saturday_lunch_start_time = saturday_lunch_start_time;
	SET @saturday_lunch_end_time = saturday_lunch_end_time;
	SET @saturday_late_mark = saturday_late_mark;
	SET @saturday_half_day_mark = saturday_half_day_mark;
	SET @sunday_start_time = wednesday_start_time;
	SET @sunday_end_time = sunday_end_time;
	SET @sunday_lunch_start_time = sunday_lunch_start_time;
	SET @sunday_lunch_end_time = sunday_lunch_end_time;
	SET @sunday_late_mark = sunday_late_mark;
	SET @sunday_half_day_mark = sunday_half_day_mark;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblworkshiftschedule SET START_DATE = @work_shift, END_DATE = @work_shift_type, MONDAY_START_TIME = @monday_start_time, MONDAY_END_TIME = @monday_end_time, MONDAY_LUNCH_START_TIME = @monday_lunch_start_time, MONDAY_LUNCH_END_TIME = @monday_lunch_end_time, MONDAY_LATE_MARK = @monday_late_mark, MONDAY_HALF_DAY_MARK = @monday_half_day_mark, TUESDAY_START_TIME = @tuesday_start_time, TUESDAY_END_TIME = @tuesday_end_time, TUESDAY_LUNCH_START_TIME = @tuesday_lunch_start_time, TUESDAY_LUNCH_END_TIME = @tuesday_lunch_end_time, TUESDAY_LATE_MARK = @tuesday_late_mark, TUESDAY_HALF_DAY_MARK = @tuesday_half_day_mark,
	WEDNESDAY_START_TIME = @wednesday_start_time, WEDNESDAY_END_TIME = @wednesday_end_time, WEDNESDAY_LUNCH_START_TIME = @wednesday_lunch_start_time, WEDNESDAY_LUNCH_END_TIME = @wednesday_lunch_end_time, WEDNESDAY_LATE_MARK = @wednesday_late_mark, WEDNESDAY_HALF_DAY_MARK = @wednesday_half_day_mark, THURSDAY_START_TIME = @thursday_start_time, THURSDAY_END_TIME = @thursday_end_time, THURSDAY_LUNCH_START_TIME = @thursday_lunch_start_time, THURSDAY_LUNCH_END_TIME = @thursday_lunch_end_time, THURSDAY_LATE_MARK = @thursday_late_mark, THURSDAY_HALF_DAY_MARK = @thursday_half_day_mark,	FRIDAY_START_TIME = @friday_start_time, FRIDAY_END_TIME = @friday_end_time, FRIDAY_LUNCH_START_TIME = @friday_lunch_start_time, FRIDAY_LUNCH_END_TIME = @friday_lunch_end_time, FRIDAY_LATE_MARK = @friday_late_mark, FRIDAY_HALF_DAY_MARK = @friday_half_day_mark,	SATURDAY_START_TIME = @saturday_start_time, SATURDAY_END_TIME = @saturday_end_time, SATURDAY_LUNCH_START_TIME = @saturday_lunch_start_time, SATURDAY_LUNCH_END_TIME = @saturday_lunch_end_time, SATURDAY_LATE_MARK = @saturday_late_mark, SATURDAY_HALF_DAY_MARK = @saturday_half_day_mark,	SUNDAY_START_TIME = @sunday_start_time, SUNDAY_END_TIME = @sunday_end_time, SUNDAY_LUNCH_START_TIME = @sunday_lunch_start_time, SUNDAY_LUNCH_END_TIME = @sunday_lunch_end_time, SUNDAY_LATE_MARK = @sunday_late_mark, SUNDAY_HALF_DAY_MARK = @sunday_half_day_mark,	RECORD_LOG = @record_log WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_work_shift_schedule(IN work_shift_id VARCHAR(100), IN start_date DATE, IN end_date DATE, IN monday_start_time TIME, IN monday_end_time TIME, IN monday_lunch_start_time TIME, IN monday_lunch_end_time TIME, IN monday_late_mark INT, IN monday_half_day_mark TIME, IN tuesday_start_time TIME, IN tuesday_end_time TIME, IN tuesday_lunch_start_time TIME, IN tuesday_lunch_end_time TIME, IN tuesday_late_mark INT, IN tuesday_half_day_mark TIME, IN wednesday_start_time TIME, IN wednesday_end_time TIME, IN wednesday_lunch_start_time TIME, IN wednesday_lunch_end_time TIME, IN wednesday_late_mark INT, IN wednesday_half_day_mark TIME, 
IN thursday_start_time TIME, IN thursday_end_time TIME, IN thursday_lunch_start_time TIME, IN thursday_lunch_end_time TIME, IN thursday_late_mark INT, IN thursday_half_day_mark TIME, IN friday_start_time TIME, IN friday_end_time TIME, IN friday_lunch_start_time TIME, IN friday_lunch_end_time TIME, IN friday_late_mark INT, IN friday_half_day_mark TIME, IN saturday_start_time TIME, IN saturday_end_time TIME, IN saturday_lunch_start_time TIME, IN saturday_lunch_end_time TIME, IN saturday_late_mark INT, IN saturday_half_day_mark TIME, IN sunday_start_time TIME, IN sunday_end_time TIME, IN sunday_lunch_start_time TIME, IN sunday_lunch_end_time TIME, IN sunday_late_mark INT, IN sunday_half_day_mark TIME, IN record_log VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;
	SET @start_date = start_date;
	SET @end_date = end_date;
	SET @monday_start_time = monday_start_time;
	SET @monday_end_time = monday_end_time;
	SET @monday_lunch_start_time = monday_lunch_start_time;
	SET @monday_lunch_end_time = monday_lunch_end_time;
	SET @monday_late_mark = monday_late_mark;
	SET @monday_half_day_mark = monday_half_day_mark;
	SET @tuesday_start_time = tuesday_start_time;
	SET @tuesday_end_time = tuesday_end_time;
	SET @tuesday_lunch_start_time = tuesday_lunch_start_time;
	SET @tuesday_lunch_end_time = tuesday_lunch_end_time;
	SET @tuesday_late_mark = tuesday_late_mark;
	SET @tuesday_half_day_mark = tuesday_half_day_mark;
	SET @wednesday_start_time = wednesday_start_time;
	SET @wednesday_end_time = wednesday_end_time;
	SET @wednesday_lunch_start_time = wednesday_lunch_start_time;
	SET @wednesday_lunch_end_time = wednesday_lunch_end_time;
	SET @wednesday_late_mark = wednesday_late_mark;
	SET @wednesday_half_day_mark = wednesday_half_day_mark;
	SET @thursday_start_time = wednesday_start_time;
	SET @thursday_end_time = thursday_end_time;
	SET @thursday_lunch_start_time = thursday_lunch_start_time;
	SET @thursday_lunch_end_time = thursday_lunch_end_time;
	SET @thursday_late_mark = thursday_late_mark;
	SET @thursday_half_day_mark = thursday_half_day_mark;
	SET @friday_start_time = wednesday_start_time;
	SET @friday_end_time = friday_end_time;
	SET @friday_lunch_start_time = friday_lunch_start_time;
	SET @friday_lunch_end_time = friday_lunch_end_time;
	SET @friday_late_mark = friday_late_mark;
	SET @friday_half_day_mark = friday_half_day_mark;
	SET @saturday_start_time = wednesday_start_time;
	SET @saturday_end_time = saturday_end_time;
	SET @saturday_lunch_start_time = saturday_lunch_start_time;
	SET @saturday_lunch_end_time = saturday_lunch_end_time;
	SET @saturday_late_mark = saturday_late_mark;
	SET @saturday_half_day_mark = saturday_half_day_mark;
	SET @sunday_start_time = wednesday_start_time;
	SET @sunday_end_time = sunday_end_time;
	SET @sunday_lunch_start_time = sunday_lunch_start_time;
	SET @sunday_lunch_end_time = sunday_lunch_end_time;
	SET @sunday_late_mark = sunday_late_mark;
	SET @sunday_half_day_mark = sunday_half_day_mark;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblworkshiftschedule (WORK_SHIFT_ID, START_DATE, END_DATE, MONDAY_START_TIME,	MONDAY_END_TIME, MONDAY_LUNCH_START_TIME, MONDAY_LUNCH_END_TIME, MONDAY_LATE_MARK, MONDAY_HALF_DAY_MARK,	TUESDAY_START_TIME,	TUESDAY_END_TIME, TUESDAY_LUNCH_START_TIME, TUESDAY_LUNCH_END_TIME, TUESDAY_LATE_MARK, TUESDAY_HALF_DAY_MARK, WEDNESDAY_START_TIME, WEDNESDAY_END_TIME, WEDNESDAY_LUNCH_START_TIME, WEDNESDAY_LUNCH_END_TIME, WEDNESDAY_LATE_MARK, WEDNESDAY_HALF_DAY_MARK,	THURSDAY_START_TIME, THURSDAY_END_TIME, THURSDAY_LUNCH_START_TIME, THURSDAY_LUNCH_END_TIME, THURSDAY_LATE_MARK, THURSDAY_HALF_DAY_MARK,
	FRIDAY_START_TIME,	FRIDAY_END_TIME, FRIDAY_LUNCH_START_TIME, FRIDAY_LUNCH_END_TIME, FRIDAY_LATE_MARK, FRIDAY_HALF_DAY_MARK, SATURDAY_START_TIME, SATURDAY_END_TIME, SATURDAY_LUNCH_START_TIME, SATURDAY_LUNCH_END_TIME, SATURDAY_LATE_MARK, SATURDAY_HALF_DAY_MARK, SUNDAY_START_TIME,	SUNDAY_END_TIME, SUNDAY_LUNCH_START_TIME, SUNDAY_LUNCH_END_TIME, SUNDAY_LATE_MARK, SUNDAY_HALF_DAY_MARK, RECORD_LOG) VALUES(@work_shift_id, @start_date, @end_date, @monday_start_time, @monday_end_time, @monday_lunch_start_time, @monday_lunch_end_time, @monday_late_mark, @monday_half_day_mark, @tuesday_start_time, @tuesday_end_time, @tuesday_lunch_start_time, @tuesday_lunch_end_time, @tuesday_late_mark, @tuesday_half_day_mark, @wednesday_start_time, @wednesday_end_time, @wednesday_lunch_start_time, @wednesday_lunch_end_time, @wednesday_late_mark, @wednesday_half_day_mark, @thursday_start_time, @thursday_end_time, @thursday_lunch_start_time, @thursday_lunch_end_time, @thursday_late_mark, @thursday_half_day_mark, @friday_start_time, @friday_end_time, @friday_lunch_start_time, @friday_lunch_end_time, @friday_late_mark, @friday_half_day_mark, @saturday_start_time, @saturday_end_time, @saturday_lunch_start_time, @saturday_lunch_end_time, @saturday_late_mark, @saturday_half_day_mark, @sunday_start_time, @sunday_end_time, @sunday_lunch_start_time, @sunday_lunch_end_time, @sunday_late_mark, @sunday_half_day_mark, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_work_shift_schedule_details(IN work_shift_id VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;

	SET @query = 'SELECT WORK_SHIFT_ID, START_DATE, END_DATE, MONDAY_START_TIME, MONDAY_END_TIME, MONDAY_LUNCH_START_TIME, MONDAY_LUNCH_END_TIME, MONDAY_LATE_MARK, MONDAY_HALF_DAY_MARK, TUESDAY_START_TIME,	TUESDAY_END_TIME, TUESDAY_LUNCH_START_TIME, TUESDAY_LUNCH_END_TIME, TUESDAY_LATE_MARK, TUESDAY_HALF_DAY_MARK, WEDNESDAY_START_TIME, WEDNESDAY_END_TIME, WEDNESDAY_LUNCH_START_TIME, WEDNESDAY_LUNCH_END_TIME, WEDNESDAY_LATE_MARK, WEDNESDAY_HALF_DAY_MARK,	THURSDAY_START_TIME, THURSDAY_END_TIME, THURSDAY_LUNCH_START_TIME, THURSDAY_LUNCH_END_TIME, THURSDAY_LATE_MARK, THURSDAY_HALF_DAY_MARK,	FRIDAY_START_TIME,	FRIDAY_END_TIME, FRIDAY_LUNCH_START_TIME, FRIDAY_LUNCH_END_TIME, FRIDAY_LATE_MARK, FRIDAY_HALF_DAY_MARK, SATURDAY_START_TIME, SATURDAY_END_TIME, SATURDAY_LUNCH_START_TIME, SATURDAY_LUNCH_END_TIME, SATURDAY_LATE_MARK, SATURDAY_HALF_DAY_MARK, SUNDAY_START_TIME,	SUNDAY_END_TIME, SUNDAY_LUNCH_START_TIME, SUNDAY_LUNCH_END_TIME, SUNDAY_LATE_MARK, SUNDAY_HALF_DAY_MARK, RECORD_LOG FROM tblworkshiftschedule WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_work_shift_schedule(IN work_shift_id VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;

	SET @query = 'DELETE FROM tblworkshiftschedule WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE generate_employee_work_shift(IN work_shift_id VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;

	SET @query = 'SELECT EMPLOYEE_ID, FILE_AS FROM tblemployee WHERE EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployeeworkshift WHERE WORK_SHIFT_ID = @work_shift_id) AND EMPLOYEE_ID NOT IN (SELECT EMPLOYEE_ID FROM tblemployeeworkshift WHERE WORK_SHIFT_ID != @work_shift_id) AND EMPLOYMENT_STATUS IN ("1", "2", "5")';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_work_shift_assignment_details(IN work_shift_id VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;

	SET @query = 'SELECT EMPLOYEE_ID, RECORD_LOG FROM tblemployeeworkshift WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_employee_work_shift(IN work_shift_id VARCHAR(100), IN employee_id VARCHAR(100), IN record_log VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;
	SET @employee_id = employee_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblemployeeworkshift (WORK_SHIFT_ID, EMPLOYEE_ID, RECORD_LOG) VALUES(@work_shift_id, @employee_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_employee_work_shift(IN work_shift_id VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;

	SET @query = 'DELETE FROM tblemployeeworkshift WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_employee_attendance_exist(IN attendance_id VARCHAR(100))
BEGIN
	SET @attendance_id = attendance_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblattendancerecord WHERE ATTENDANCE_ID = @attendance_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_manual_employee_attendance(IN attendance_id VARCHAR(100), IN time_in_date DATE, IN time_in TIME, IN time_in_behavior VARCHAR(20), IN time_out_date DATE, IN time_out TIME, IN time_out_behavior VARCHAR(20), IN late DOUBLE, IN early_leaving DOUBLE, IN overtime DOUBLE, IN total_hours_worked DOUBLE, IN remarks VARCHAR(500), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @attendance_id = attendance_id;
	SET @time_in_date = time_in_date;
	SET @time_in = time_in;
	SET @time_in_behavior = time_in_behavior;
	SET @time_out_date = time_out_date;
	SET @time_out = time_out;
	SET @time_out_behavior = time_out_behavior;
	SET @late = late;
	SET @early_leaving = early_leaving;
	SET @overtime = overtime;
	SET @total_hours_worked = total_hours_worked;
	SET @remarks = remarks;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblattendancerecord SET TIME_IN_DATE = @time_in_date, TIME_IN = @time_in, TIME_IN_BEHAVIOR = @time_in_behavior, TIME_OUT_DATE = @time_out_date, TIME_OUT = @time_out, TIME_OUT_BEHAVIOR = @time_out_behavior, LATE = @late, EARLY_LEAVING = @early_leaving, OVERTIME = @overtime, TOTAL_WORKING_HOURS = @total_hours_worked, REMARKS = @remarks, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE ATTENDANCE_ID = @attendance_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_manual_employee_attendance(IN attendance_id VARCHAR(100), IN employee_id VARCHAR(100), IN time_in_date DATE, IN time_in TIME, IN time_in_behavior VARCHAR(20), IN time_out_date DATE, IN time_out TIME, IN time_out_behavior VARCHAR(20), IN late DOUBLE, IN early_leaving DOUBLE, IN overtime DOUBLE, IN total_hours_worked DOUBLE, IN remarks VARCHAR(500), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @attendance_id = attendance_id;
	SET @employee_id = employee_id;
	SET @time_in_date = time_in_date;
	SET @time_in = time_in;
	SET @time_in_behavior = time_in_behavior;
	SET @time_out_date = time_out_date;
	SET @time_out = time_out;
	SET @time_out_behavior = time_out_behavior;
	SET @late = late;
	SET @early_leaving = early_leaving;
	SET @overtime = overtime;
	SET @total_hours_worked = total_hours_worked;
	SET @remarks = remarks;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblattendancerecord (ATTENDANCE_ID, EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_IN_BEHAVIOR, TIME_OUT_DATE, TIME_OUT, TIME_OUT_BEHAVIOR, LATE, EARLY_LEAVING, OVERTIME, TOTAL_WORKING_HOURS, REMARKS, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@attendance_id, @employee_id, @time_in_date, @time_in, @time_in_behavior, @time_out_date, @time_out, @time_out_behavior, @late, @early_leaving, @overtime, @total_hours_worked, @remarks, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_employee_attendance_details(IN attendance_id VARCHAR(100))
BEGIN
	SET @attendance_id = attendance_id;

	SET @query = 'SELECT EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_IN_LOCATION, TIME_IN_IP_ADDRESS, TIME_IN_BY, TIME_IN_BEHAVIOR, TIME_OUT_DATE, TIME_OUT, TIME_OUT_LOCATION, TIME_OUT_IP_ADDRESS, TIME_OUT_BY, TIME_OUT_BEHAVIOR, LATE, EARLY_LEAVING, OVERTIME, TOTAL_WORKING_HOURS, REMARKS, TRANSACTION_LOG_ID, RECORD_LOG FROM tblattendancerecord WHERE ATTENDANCE_ID = @attendance_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_employee_attendance(IN attendance_id VARCHAR(100))
BEGIN
	SET @attendance_id = attendance_id;

	SET @query = 'DELETE FROM tblattendancerecord WHERE ATTENDANCE_ID = @attendance_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_employee_work_shift_schedule_details(IN employee_id VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;

	SET @query = 'SELECT WORK_SHIFT_ID, RECORD_LOG FROM tblemployeeworkshift WHERE EMPLOYEE_ID = @employee_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE generate_active_employee_options()
BEGIN
	SET @query = 'SELECT EMPLOYEE_ID, FILE_AS FROM tblemployee WHERE EMPLOYMENT_STATUS IN ("1", "2", "5") ORDER BY FILE_AS';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_leave_type_exist(IN leave_type_id VARCHAR(50))
BEGIN
	SET @leave_type_id = leave_type_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblleavetype WHERE LEAVE_TYPE_ID = @leave_type_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_leave_type(IN leave_type_id VARCHAR(50), IN leave_name VARCHAR(100), IN description VARCHAR(200), IN no_leaves DOUBLE, IN paid_status VARCHAR(20), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @leave_type_id = leave_type_id;
	SET @leave_name = leave_name;
	SET @description = description;
	SET @no_leaves = no_leaves;
	SET @paid_status = paid_status;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblleavetype SET LEAVE_NAME = @leave_name, DESCRIPTION = @description, NO_LEAVES = @no_leaves, PAID_STATUS = @paid_status, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE LEAVE_TYPE_ID = @leave_type_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_leave_type(IN leave_type_id VARCHAR(50), IN leave_name VARCHAR(100), IN description VARCHAR(200), IN no_leaves DOUBLE, IN paid_status VARCHAR(20), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @leave_type_id = leave_type_id;
	SET @leave_name = leave_name;
	SET @description = description;
	SET @no_leaves = no_leaves;
	SET @paid_status = paid_status;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblleavetype (LEAVE_TYPE_ID, LEAVE_NAME, DESCRIPTION, NO_LEAVES, PAID_STATUS, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@leave_type_id, @leave_name, @description, @no_leaves, @paid_status, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_leave_type_details(IN leave_type_id VARCHAR(50))
BEGIN
	SET @leave_type_id = leave_type_id;

	SET @query = 'SELECT LEAVE_NAME, DESCRIPTION, NO_LEAVES, PAID_STATUS, TRANSACTION_LOG_ID, RECORD_LOG FROM tblleavetype WHERE LEAVE_TYPE_ID = @leave_type_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_leave_type(IN leave_type_id VARCHAR(50))
BEGIN
	SET @leave_type_id = leave_type_id;

	SET @query = 'DELETE FROM tblleavetype WHERE LEAVE_TYPE_ID = @leave_type_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE generate_leave_type_options()
BEGIN
	SET @query = 'SELECT LEAVE_TYPE_ID, LEAVE_NAME FROM tblleavetype ORDER BY LEAVE_NAME';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_leave_entitlement_exist(IN leave_entitlement_id VARCHAR(50))
BEGIN
	SET @leave_entitlement_id = leave_entitlement_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblleaveentitlement WHERE LEAVE_ENTITLEMENT_ID = @leave_entitlement_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_leave_entitlement(IN leave_entitlement_id VARCHAR(50), IN no_leaves DOUBLE, IN start_date DATE, IN end_date DATE, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @leave_entitlement_id = leave_entitlement_id;
	SET @no_leaves = no_leaves;
	SET @start_date = start_date;
	SET @end_date = end_date;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblleaveentitlement SET NO_LEAVES = @no_leaves, START_DATE = @start_date, END_DATE = @end_date, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE LEAVE_ENTITLEMENT_ID = @leave_entitlement_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_leave_entitlement(IN leave_entitlement_id VARCHAR(50), IN employee_id VARCHAR(100), IN leave_type VARCHAR(50), IN no_leaves DOUBLE, IN start_date DATE, IN end_date DATE, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @leave_entitlement_id = leave_entitlement_id;
	SET @employee_id = employee_id;
	SET @leave_type = leave_type;
	SET @no_leaves = no_leaves;
	SET @start_date = start_date;
	SET @end_date = end_date;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblleaveentitlement (LEAVE_ENTITLEMENT_ID, EMPLOYEE_ID, LEAVE_TYPE, NO_LEAVES, ACQUIRED_LEAVES, START_DATE, END_DATE, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@leave_entitlement_id, @employee_id, @leave_type, @no_leaves, 0, @start_date, @end_date, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_leave_entitlement_details(IN leave_entitlement_id VARCHAR(50))
BEGIN
	SET @leave_entitlement_id = leave_entitlement_id;

	SET @query = 'SELECT EMPLOYEE_ID, LEAVE_TYPE, NO_LEAVES, ACQUIRED_LEAVES, START_DATE, END_DATE, TRANSACTION_LOG_ID, RECORD_LOG FROM tblleaveentitlement WHERE LEAVE_ENTITLEMENT_ID = @leave_entitlement_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_leave_entitlement(IN leave_entitlement_id VARCHAR(50))
BEGIN
	SET @leave_entitlement_id = leave_entitlement_id;

	SET @query = 'DELETE FROM tblleaveentitlement WHERE LEAVE_ENTITLEMENT_ID = @leave_entitlement_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_leave_entitlement_overlap(IN leave_entitlement_id VARCHAR(50), IN employee_id VARCHAR(100), IN leave_type VARCHAR(50))
BEGIN
	SET @leave_entitlement_id = leave_entitlement_id;
	SET @employee_id = employee_id;
	SET @leave_type = leave_type;

	SET @query = 'SELECT START_DATE, END_DATE FROM tblleaveentitlement WHERE LEAVE_ENTITLEMENT_ID != @leave_entitlement_id AND EMPLOYEE_ID = @employee_id AND LEAVE_TYPE = @leave_type';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_available_leave_entitlement(IN employee_id VARCHAR(100), IN leave_type VARCHAR(50), IN leave_date DATE)
BEGIN
	SET @employee_id = employee_id;
	SET @leave_type = leave_type;
	SET @leave_date = leave_date;

	SET @query = 'SELECT (NO_LEAVES - ACQUIRED_LEAVES) AS TOTAL FROM tblleaveentitlement WHERE EMPLOYEE_ID = @employee_id AND LEAVE_TYPE = @leave_type AND (START_DATE <= @leave_date AND END_DATE >= @leave_date)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_employee_leave_entitlement_details(IN employee_id VARCHAR(100), IN leave_type VARCHAR(50), IN leave_date DATE)
BEGIN
	SET @employee_id = employee_id;
	SET @leave_type = leave_type;
	SET @leave_date = leave_date;

	SET @query = 'SELECT LEAVE_ENTITLEMENT_ID, NO_LEAVES, ACQUIRED_LEAVES, START_DATE, END_DATE, TRANSACTION_LOG_ID, RECORD_LOG FROM tblleaveentitlement WHERE EMPLOYEE_ID = @employee_id AND LEAVE_TYPE = @leave_type AND (START_DATE <= @leave_date AND END_DATE >= @leave_date)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_leave_entitlement_count(IN leave_entitlement_id VARCHAR(50), IN total_hours DOUBLE, IN record_log VARCHAR(100))
BEGIN
	SET @leave_entitlement_id = leave_entitlement_id;
	SET @total_hours = total_hours;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblleaveentitlement SET ACQUIRED_LEAVES = (ACQUIRED_LEAVES + @total_hours), RECORD_LOG = @record_log WHERE LEAVE_ENTITLEMENT_ID = @leave_entitlement_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_leave(IN leave_id VARCHAR(50), IN employee_id VARCHAR(100), IN leave_type VARCHAR(50), IN leave_date DATE, IN start_time TIME, IN end_time TIME, IN leave_status INT(1), IN reason VARCHAR(500), IN decision_date DATE, IN decision_time TIME, IN decision_by VARCHAR(50), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @leave_id = leave_id;
	SET @employee_id = employee_id;
	SET @leave_type = leave_type;
	SET @leave_date = leave_date;
	SET @start_time = start_time;
	SET @end_time = end_time;
	SET @leave_status = leave_status;
	SET @reason = reason;
	SET @decision_date = decision_date;
	SET @decision_time = decision_time;
	SET @decision_by = decision_by;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblleave (LEAVE_ID, EMPLOYEE_ID, LEAVE_TYPE, LEAVE_DATE, START_TIME, END_TIME, LEAVE_STATUS, LEAVE_REASON, DECISION_DATE, DECISION_TIME, DECISION_BY, TRANSACTION_LOG_ID, RECORD_LOG) VALUES (@leave_id, @employee_id, @leave_type, @leave_date, @start_time, @end_time, @leave_status, @reason, @decision_date, @decision_time, @decision_by, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_leave_exist(IN leave_id VARCHAR(50))
BEGIN
	SET @leave_id = leave_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblleave WHERE LEAVE_ID = @leave_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_leave_status(IN leave_id VARCHAR(50), IN leave_status INT(1), IN decision_remarks VARCHAR(500), IN decision_date DATE, IN decision_time TIME, IN decision_by VARCHAR(50), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @leave_id = leave_id;
	SET @leave_status = leave_status;
	SET @decision_remarks = decision_remarks;
	SET @decision_date = decision_date;
	SET @decision_time = decision_time;
	SET @decision_by = decision_by;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblleave SET LEAVE_STATUS = @leave_status, DECISION_REMARKS = @decision_remarks, DECISION_DATE = @decision_date, DECISION_TIME = @decision_time, DECISION_BY = @decision_by, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE LEAVE_ID = @leave_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_leave_details(IN leave_id VARCHAR(50))
BEGIN
	SET @leave_id = leave_id;

	SET @query = 'SELECT EMPLOYEE_ID, LEAVE_TYPE, LEAVE_DATE, START_TIME, END_TIME, LEAVE_STATUS, LEAVE_REASON, DECISION_REMARKS, DECISION_DATE, DECISION_TIME, DECISION_BY, TRANSACTION_LOG_ID, RECORD_LOG FROM tblleave WHERE LEAVE_ID = @leave_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_leave_overlap(IN leave_id VARCHAR(50), IN employee_id VARCHAR(100))
BEGIN
	SET @leave_id = leave_id;
	SET @employee_id = employee_id;

	SET @query = 'SELECT LEAVE_DATE, START_TIME, END_TIME FROM tblleave WHERE LEAVE_STATUS IN ("1", "4") AND EMPLOYEE_ID = @employee_id AND LEAVE_TYPE NOT IN ("LEAVETP-8", "LEAVETP-9") AND LEAVE_ID != @leave_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_leave(IN leave_id VARCHAR(50))
BEGIN
	SET @leave_id = leave_id;

	SET @query = 'DELETE FROM tblleave WHERE LEAVE_ID = @leave_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_employee_file_exist(IN file_id VARCHAR(50))
BEGIN
	SET @file_id = file_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblemployeefile WHERE FILE_ID = @file_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_employee_file_details(IN file_id VARCHAR(50), IN file_name VARCHAR(100), IN file_category VARCHAR(50), IN remarks VARCHAR(100), IN file_date DATE, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @file_id = file_id;
	SET @file_name = file_name;
	SET @file_category = file_category;
	SET @remarks = remarks;
	SET @file_date = file_date;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblemployeefile SET FILE_NAME = @file_name, FILE_CATEGORY = @file_category, REMARKS = @remarks, FILE_DATE = @file_date, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE FILE_ID = @file_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_employee_file(IN file_id VARCHAR(50), IN employee_id VARCHAR(100), IN file_name VARCHAR(100), IN file_category VARCHAR(50), IN remarks VARCHAR(100), IN file_date DATE, IN upload_date DATE, IN upload_time TIME, IN upload_by VARCHAR(50), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @file_id = file_id;
	SET @employee_id = employee_id;
	SET @file_name = file_name;
	SET @file_category = file_category;
	SET @remarks = remarks;
	SET @file_date = file_date;
	SET @upload_date = upload_date;
	SET @upload_time = upload_time;
	SET @upload_by = upload_by;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblemployeefile (FILE_ID, EMPLOYEE_ID, FILE_NAME, FILE_CATEGORY, REMARKS, FILE_DATE, UPLOAD_DATE, UPLOAD_TIME, UPLOAD_BY, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@file_id, @employee_id, @file_name, @file_category, @remarks, @file_date, @upload_date, @upload_time, @upload_by, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_employee_file_details(IN file_id VARCHAR(50))
BEGIN
	SET @file_id = file_id;

	SET @query = 'SELECT EMPLOYEE_ID, FILE_NAME, FILE_CATEGORY, REMARKS, FILE_DATE, UPLOAD_DATE, UPLOAD_TIME, UPLOAD_BY, FILE_PATH, TRANSACTION_LOG_ID, RECORD_LOG FROM tblemployeefile WHERE FILE_ID = @file_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_employee_file(IN file_id VARCHAR(50))
BEGIN
	SET @file_id = file_id;

	SET @query = 'DELETE FROM tblemployeefile WHERE FILE_ID = @file_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_employee_file(IN file_id VARCHAR(50), IN file_path VARCHAR(500), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @file_id = file_id;
	SET @file_path = file_path;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblemployeefile SET FILE_PATH = @file_path, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE FILE_ID = @file_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_leave_statistics(IN employee_id VARCHAR(100), IN leave_type VARCHAR(50), IN leave_date DATE)
BEGIN
	SET @employee_id = employee_id;
	SET @leave_type = leave_type;
	SET @leave_date = leave_date;

	SET @query = 'SELECT NO_LEAVES, ACQUIRED_LEAVES FROM tblleaveentitlement WHERE EMPLOYEE_ID = @employee_id AND LEAVE_TYPE = @leave_type AND (START_DATE <= @leave_date AND END_DATE >= @leave_date)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE generate_employee_without_user_account_options()
BEGIN
	SET @query = 'SELECT EMPLOYEE_ID, FILE_AS FROM tblemployee WHERE EMPLOYMENT_STATUS IN ("1", "2", "5") AND USERNAME IS NULL ORDER BY FILE_AS';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE generate_role_options()
BEGIN
	SET @query = 'SELECT ROLE_ID, ROLE FROM tblrole ORDER BY ROLE';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_role_user_details(IN role_id VARCHAR(50), IN username VARCHAR(50))
BEGIN
	SET @role_id = role_id;
	SET @username = username;

	SET @query = 'SELECT ROLE_ID, USERNAME, RECORD_LOG FROM tblroleuser WHERE ROLE_ID = @role_id OR USERNAME = @username';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_user_account_exist(IN username VARCHAR(50))
BEGIN
	SET @username = username;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tbluseraccount WHERE USERNAME = @username';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_user_account(IN username VARCHAR(50), IN password VARCHAR(200), IN password_expiry_date DATE, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @username = username;
	SET @password = password;
	SET @password_expiry_date = password_expiry_date;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	IF @password IS NULL OR @password = '' THEN
		SET @query = 'UPDATE tbluseraccount SET TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE USERNAME = @username';
	ELSE
		SET @query = 'UPDATE tbluseraccount SET PASSWORD = @password, PASSWORD_EXPIRY_DATE = @password_expiry_date, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE USERNAME = @username';
    END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_user_account(IN username VARCHAR(50), IN password VARCHAR(200), IN password_expiry_date DATE, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @username = username;
	SET @password = password;
	SET @password_expiry_date = password_expiry_date;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tbluseraccount (USERNAME, PASSWORD, ACTIVE, PASSWORD_EXPIRY_DATE, FAILED_LOGIN, LAST_FAILED_LOGIN, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@username, @password, 0, @password_expiry_date, 0, null, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_user_role(IN username VARCHAR(50), IN role_id VARCHAR(50), IN record_log VARCHAR(100))
BEGIN
	SET @username = username;
	SET @role_id = role_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblroleuser (ROLE_ID, USERNAME, RECORD_LOG) VALUES(@role_id, @username, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_employee_user_account(IN employee_id VARCHAR(100), IN username VARCHAR(50), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;
	SET @username = username;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblemployee SET USERNAME = @username, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE EMPLOYEE_ID = @employee_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_all_user_role(IN user_code VARCHAR(50))
BEGIN
	SET @user_code = user_code;

	SET @query = 'DELETE FROM tblroleuser WHERE USERNAME = @user_code';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_user_account_lock_status(IN username VARCHAR(50), IN transaction_type VARCHAR(10), IN last_failed_login DATE, IN record_log VARCHAR(100))
BEGIN
	SET @username = username;
	SET @transaction_type = transaction_type;
	SET @last_failed_login = last_failed_login;
	SET @record_log = record_log;

	IF @transaction_type = 'unlock' THEN
		SET @query = 'UPDATE tbluseraccount SET FAILED_LOGIN = 0, LAST_FAILED_LOGIN = null, RECORD_LOG = @record_log WHERE USERNAME = @username';
	ELSE
		SET @query = 'UPDATE tbluseraccount SET FAILED_LOGIN = 5, LAST_FAILED_LOGIN = @last_failed_login, RECORD_LOG = @record_log WHERE USERNAME = @username';
    END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_user_account_status(IN username VARCHAR(50), IN active INT(1), IN record_log VARCHAR(100))
BEGIN
	SET @username = username;
	SET @active = active;
	SET @record_log = record_log;

	SET @query = 'UPDATE tbluseraccount SET ACTIVE = @active, RECORD_LOG = @record_log WHERE USERNAME = @username';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_holiday_exist(IN holiday_id VARCHAR(50))
BEGIN
	SET @holiday_id = holiday_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblholiday WHERE HOLIDAY_ID = @holiday_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_holiday(IN holiday_id VARCHAR(50), IN holiday VARCHAR(200), IN holiday_date DATE, IN holiday_type VARCHAR(20), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @holiday_id = holiday_id;
	SET @holiday = holiday;
	SET @holiday_date = holiday_date;
	SET @holiday_type = holiday_type;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblholiday SET HOLIDAY = @holiday, HOLIDAY_DATE = @holiday_date, HOLIDAY_TYPE = @holiday_type, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE HOLIDAY_ID = @holiday_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_holiday(IN holiday_id VARCHAR(50), IN holiday VARCHAR(200), IN holiday_date DATE, IN holiday_type VARCHAR(20), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @holiday_id = holiday_id;
	SET @holiday = holiday;
	SET @holiday_date = holiday_date;
	SET @holiday_type = holiday_type;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblholiday (HOLIDAY_ID, HOLIDAY, HOLIDAY_DATE, HOLIDAY_TYPE, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@holiday_id, @holiday, @holiday_date, @holiday_type, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_holiday_details(IN holiday_id VARCHAR(50))
BEGIN
	SET @holiday_id = holiday_id;

	SET @query = 'SELECT HOLIDAY, HOLIDAY_DATE, HOLIDAY_TYPE, TRANSACTION_LOG_ID, RECORD_LOG FROM tblholiday WHERE HOLIDAY_ID = @holiday_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_holiday(IN holiday_id VARCHAR(50))
BEGIN
	SET @holiday_id = holiday_id;

	SET @query = 'DELETE FROM tblholiday WHERE HOLIDAY_ID = @holiday_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_all_holiday_branch(IN holiday_id VARCHAR(50))
BEGIN
	SET @holiday_id = holiday_id;

	SET @query = 'DELETE FROM tblholidaybranch WHERE HOLIDAY_ID = @holiday_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_holiday_branch(IN holiday_id VARCHAR(50), IN branch_id VARCHAR(50), IN record_log VARCHAR(100))
BEGIN
	SET @holiday_id = holiday_id;
	SET @branch_id = branch_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblholidaybranch (HOLIDAY_ID, BRANCH_ID, RECORD_LOG) VALUES(@holiday_id, @branch_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_holiday_branch_details(IN holiday_id VARCHAR(50))
BEGIN
	SET @holiday_id = holiday_id;

	SET @query = 'SELECT BRANCH_ID, RECORD_LOG FROM tblholidaybranch WHERE HOLIDAY_ID = @holiday_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_attendance_setting_details(IN setting_id INT)
BEGIN
	SET @setting_id = setting_id;

	SET @query = 'SELECT MAX_ATTENDANCE, TRANSACTION_LOG_ID, RECORD_LOG FROM tblattendancesetting WHERE SETTING_ID = @setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_attendance_creation_exception_details()
BEGIN
	SET @query = 'SELECT EMPLOYEE_ID, RECORD_LOG FROM tblattendancecreationexception';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE get_attendance_adjustment_exception_details()
BEGIN
	SET @query = 'SELECT EMPLOYEE_ID, RECORD_LOG FROM tblattendanceadjustmentexception';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_attendance_setting_exist(IN setting_id INT)
BEGIN
	SET @setting_id = setting_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblattendancesetting WHERE SETTING_ID = @setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_attendance_setting(IN setting_id INT, IN maximum_attendance INT, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @setting_id = setting_id;
	SET @maximum_attendance = maximum_attendance;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblattendancesetting SET MAX_ATTENDANCE = @maximum_attendance, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SETTING_ID = @setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_attendance_setting(IN setting_id INT, IN maximum_attendance INT, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @setting_id = setting_id;
	SET @maximum_attendance = maximum_attendance;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblattendancesetting (SETTING_ID, MAX_ATTENDANCE, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@setting_id, @maximum_attendance, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_attendance_creation_approval()
BEGIN
	SET @query = 'DELETE FROM tblattendancecreationexception';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE delete_attendance_adjustment_approval()
BEGIN
	SET @query = 'DELETE FROM tblattendanceadjustmentexception';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_attendance_creation_approval(IN employee_id VARCHAR(100), IN record_log VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblattendancecreationexception (EMPLOYEE_ID, RECORD_LOG) VALUES(@employee_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_attendance_adjustment_approval(IN employee_id VARCHAR(100), IN record_log VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblattendanceadjustmentexception (EMPLOYEE_ID, RECORD_LOG) VALUES(@employee_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_time_in(IN attendance_id VARCHAR(100), IN employee_id VARCHAR(100), IN time_in_date DATE, IN time_in TIME, IN time_in_locaton VARCHAR(100), IN time_in_ip_address VARCHAR(20), IN time_in_by VARCHAR(100), IN time_in_behavior VARCHAR(20), IN time_in_note VARCHAR(200), IN late DOUBLE, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @attendance_id = attendance_id;
	SET @employee_id = employee_id;
	SET @time_in_date = time_in_date;
	SET @time_in = time_in;
	SET @time_in_locaton = time_in_locaton;
	SET @time_in_ip_address = time_in_ip_address;
	SET @time_in_by = time_in_by;
	SET @time_in_behavior = time_in_behavior;
	SET @time_in_note = time_in_note;
	SET @late = late;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblattendancerecord (ATTENDANCE_ID, EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_IN_LOCATION, TIME_IN_IP_ADDRESS, TIME_IN_BY, TIME_IN_BEHAVIOR, TIME_IN_NOTE, LATE, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@attendance_id, @employee_id, @time_in_date, @time_in, @time_in_locaton, @time_in_ip_address, @time_in_by, @time_in_behavior, @time_in_note, @late, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE update_time_out(IN attendance_id VARCHAR(100), IN time_out_date DATE, IN time_out TIME, IN time_out_locaton VARCHAR(100), IN time_out_ip_address VARCHAR(20), IN time_out_by VARCHAR(100), IN time_out_behavior VARCHAR(20), IN time_out_note VARCHAR(200), IN early_leaving DOUBLE, IN overtime DOUBLE, IN total_working_hours DOUBLE, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @attendance_id = attendance_id;
	SET @time_out_date = time_out_date;
	SET @time_out = time_out;
	SET @time_out_locaton = time_out_locaton;
	SET @time_out_ip_address = time_out_ip_address;
	SET @time_out_by = time_out_by;
	SET @time_out_behavior = time_out_behavior;
	SET @time_out_note = time_out_note;
	SET @early_leaving = early_leaving;
	SET @overtime = overtime;
	SET @total_working_hours = total_working_hours;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblattendancerecord SET TIME_OUT_DATE = @time_out_date, TIME_OUT = @time_out, TIME_OUT_LOCATION = @time_out_locaton, TIME_OUT_IP_ADDRESS = @time_out_ip_address, TIME_OUT_BY = @time_out_by, TIME_OUT_BEHAVIOR = @time_out_behavior, TIME_OUT_NOTE = @time_out_note, EARLY_LEAVING = @early_leaving, OVERTIME = @overtime, TOTAL_WORKING_HOURS = @total_working_hours, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE ATTENDANCE_ID = @attendance_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_health_declaration(IN declaration_id VARCHAR(50), IN employee_id VARCHAR(100), IN temperature DOUBLE, IN question_1 INT, IN question_2 INT, IN question_3 INT, IN question_4 INT, IN question_5 INT, IN question_5_specific INT, IN submit_date DATE, IN submit_time TIME, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @declaration_id = declaration_id;
	SET @employee_id = employee_id;
	SET @temperature = temperature;
	SET @question_1 = question_1;
	SET @question_2 = question_2;
	SET @question_3 = question_3;
	SET @question_4 = question_4;
	SET @question_5 = question_5;
	SET @question_5_specific = question_5_specific;
	SET @submit_date = submit_date;
	SET @submit_time = submit_time;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblhealthdeclaration (DECLARATION_ID, EMPLOYEE_ID, TEMPERATURE, QUESTION_1, QUESTION_2, QUESTION_3, QUESTION_4, QUESTION_5, QUESTION_5_SPECIFIC, SUBMIT_DATE, SUBMIT_TIME, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@declaration_id, @employee_id, @temperature, @question_1, @question_2, @question_3, @question_4, @question_5, @question_5_specific, @submit_date, @submit_time, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_location(IN location_id VARCHAR(50), IN employee_id VARCHAR(100), IN position VARCHAR(100), IN log_date DATE, IN log_time TIME, IN remarks VARCHAR(500), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @location_id = location_id;
	SET @employee_id = employee_id;
	SET @position = position;
	SET @log_date = log_date;
	SET @log_time = log_time;
	SET @remarks = remarks;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tbllocation (LOCATION_ID, EMPLOYEE_ID, POSITION, LOG_DATE, LOG_TIME, REMARKS, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@location_id, @employee_id, @position, @log_date, @log_time, @remarks, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE check_system_notification_exist(IN notification_id INT, IN notification_type VARCHAR(5))
BEGIN
	SET @notification_id = notification_id;
	SET @notification_type = notification_type;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblsystemnotification WHERE NOTIFICATION_ID = @notification_id AND NOTIFICATION = @notification_type';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

CREATE PROCEDURE insert_system_notification(IN notification_id INT, IN notification_from VARCHAR(100), IN notification_to VARCHAR(100), IN notification_title VARCHAR(200), IN notification VARCHAR(1000), IN link VARCHAR(500), IN notification_date DATE, IN notification_time TIME, IN record_log VARCHAR(100))
BEGIN
	SET @notification_id = notification_id;
	SET @notification_from = notification_from;
	SET @notification_to = notification_to;
	SET @notification_title = notification_title;
	SET @notification = notification;
	SET @link = link;
	SET @notification_date = notification_date;
	SET @notification_time = notification_time;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblnotification (NOTIFICATION_ID, NOTIFICATION_FROM, NOTIFICATION_TO, STATUS, NOTIFICATION_TITLE, NOTIFICATION, LINK, NOTIFICATION_DATE, NOTIFICATION_TIME, RECORD_LOG) VALUES(@notification_id, @notification_from, @notification_to, "0", @notification_title, @notification, @link, @notification_date, @notification_time, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END //

/* Insert */

INSERT INTO tbluseraccount (USERNAME, PASSWORD, USER_ROLE, ACTIVE, PASSWORD_EXPIRY_DATE, FAILED_LOGIN, TRANSACTION_LOG_ID) VALUES ('ADMIN', '68aff5412f35ed76', 'RL-1', 1, '2021-12-30', 0);
INSERT INTO tblsystemcode (SYSTEM_TYPE, SYSTEM_CODE, SYSTEM_DESC, TRANSACTION_LOG_ID) VALUES ('SYSTYPE', 'SYSTYPE', 'SYSTEM CODE', 'TL-3');
INSERT INTO tblsystemparameters (PARAMETER_ID, PARAMETER_DESC, PARAMETER_EXTENSION, PARAMETER_NUMBER, TRANSACTION_LOG_ID) VALUES ('1', 'System Parameter', '', '2','TL-1');
INSERT INTO tblsystemparameters (PARAMETER_ID, PARAMETER_DESC, PARAMETER_EXTENSION, PARAMETER_NUMBER, TRANSACTION_LOG_ID) VALUES ('2', 'Transaction Log', 'TL-', '3', 'TL-2');
INSERT INTO tbltransactionlog (TRANSACTION_LOG_ID, USERNAME, LOG_TYPE, LOG_DATE, LOG) VALUES('TL-1', 'ADMIN', 'Insert', '2022-01-03 08:30:00', 'User ADMIN inserted system parameter (1).');
INSERT INTO tbltransactionlog (TRANSACTION_LOG_ID, USERNAME, LOG_TYPE, LOG_DATE, LOG) VALUES('TL-2', 'ADMIN', 'Insert', '2022-01-03 08:30:00', 'User ADMIN inserted system parameter (1).');
INSERT INTO tbltransactionlog (TRANSACTION_LOG_ID, USERNAME, LOG_TYPE, LOG_DATE, LOG) VALUES('TL-3', 'ADMIN', 'Insert', '2022-01-03 08:30:00', 'User ADMIN inserted system code(SYSTYPE).');