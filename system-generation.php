<?php
require('./config/config.php');
require('./classes/api.php');

if(isset($_POST['type']) && !empty($_POST['type']) && isset($_POST['username']) && !empty($_POST['username'])){
    $api = new Api;
    $type = $_POST['type'];
    $username = $_POST['username'];
    $system_date = date('Y-m-d');
    $current_time = date('H:i:s');
    $response = array();

    # -------------------------------------------------------------
    #   Generate elements functions
    # -------------------------------------------------------------

    # System modal
    if($type == 'system modal'){
        if(isset($_POST['title']) && isset($_POST['size']) && isset($_POST['scrollable']) && isset($_POST['submit_button']) && isset($_POST['form_id'])){
            $title = $_POST['title'];
            $size = $api->check_modal_size($_POST['size']);
            $scrollable = $api->check_modal_scrollable($_POST['scrollable']);
            $form_id = $_POST['form_id'];
            $submit_button = $_POST['submit_button'];

            if($submit_button == 1){
                $button = '<button type="submit" class="btn btn-primary" id="submit-form" form="'. $form_id .'">Submit</button>';
            }
            else{
                $button = '';
            }

            $modal = '<div class="modal fade" id="System-Modal" role="dialog" aria-labelledby="modal-'. $form_id .'" aria-hidden="true">
                            <div class="modal-dialog '. $scrollable .' '. $size .'">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-'. $form_id .'">'. $title .'</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" id="modal-body"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        '. $button .'
                                    </div>
                                </div>
                            </div>
                        </div>';

            $response[] = array(
                'MODAL' => $modal
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------
    
    # System form
    else if($type == 'system form'){
        if(isset($_POST['form_type']) && isset($_POST['form_id'])){
            $form_type = $_POST['form_type'];
            $form_id = $_POST['form_id'];

            $form = '<form class="cmxform" id="'. $form_id .'" method="post" action="#">';

            if($form_type == 'change password form'){
                $form .= '<div class="mb-3">
                                <label class="form-label" for="change_username">Password <span class="required">*</span></label>
                                <input type="hidden" id="change_username" name="change_username" value="'. $username .'">
                                <div class="input-group auth-pass-inputgroup">
                                    <input type="password" id="change_password" name="change_password" class="form-control" aria-label="Password" aria-describedby="password-addon">
                                    <button class="btn btn-light" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                </div>
                            </div>';
            }
            else if($form_type == 'policy form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="policy" class="form-label">Policy <span class="required">*</span></label>
                                    <input type="hidden" id="policy_id" name="policy_id">
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="policy" name="policy" maxlength="100">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span class="required">*</span></label>
                                    <textarea class="form-control form-maxlength" id="description" name="description" maxlength="200" rows="5"></textarea>
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'permission form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="permission" class="form-label">Permission <span class="required">*</span></label>
                                    <input type="hidden" id="permission_id" name="permission_id">
                                    <input type="hidden" id="policy_id" name="policy_id">
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="permission" name="permission" maxlength="100">
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'role form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role <span class="required">*</span></label>
                                        <input type="hidden" id="role_id" name="role_id">
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="role" name="role" maxlength="100">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description <span class="required">*</span></label>
                                        <textarea class="form-control form-maxlength" id="description" name="description" maxlength="200" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'system code form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">System Type <span class="required">*</span></label>
                                    <select class="form-control form-select2" id="system_type" name="system_type">
                                    <option value="">--</option>';
                                    $form .= $api->generate_system_code_options('SYSTYPE');
                                    $form .='</select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="system_code" class="form-label">System Code <span class="required">*</span></label>
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="system_code" name="system_code" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="system_description" class="form-label">System Description <span class="required">*</span></label>
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="system_description" name="system_description" maxlength="100">
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'permission role form'){
                $form .= '<div class="row">
                                '. $api->generate_permission_check_box() .'
                            </div>';
            }
            else if($form_type == 'system parameter form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="parameter" class="form-label">Parameter <span class="required">*</span></label>
                                    <input type="hidden" id="parameter_id" name="parameter_id">
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="parameter" name="parameter" maxlength="100">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="extension" class="form-label">Extension</label>
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="extension" name="extension" maxlength="10">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="parameter_number" class="form-label">Number</label>
                                    <input id="parameter_number" name="parameter_number" class="form-control" type="number" min="0">
                                </div>
                            </div>
                        </div>';
                
            }
            else if($form_type == 'permission role form'){
                $form .= '<div class="row">
                                '. $api->generate_permission_check_box() .'
                            </div>';
            }
            else if($form_type == 'notification type form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="notification" class="form-label">Notification <span class="required">*</span></label>
                                    <input type="hidden" id="notification_id" name="notification_id">
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="notification" name="notification" maxlength="100">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span class="required">*</span></label>
                                    <textarea class="form-control form-maxlength" id="description" name="description" maxlength="200" rows="5"></textarea>
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'department form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="department" class="form-label">Department <span class="required">*</span></label>
                                        <input type="hidden" id="department_id" name="department_id">
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="department" name="department" maxlength="200">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="department_head" class="form-label">Department Head</label>
                                        <select class="form-control form-select2" id="department_head" name="department_head">
                                            <option value="">--</option>';
                                        $form .= $api->generate_active_employee_options();
                                        $form .='</select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="parent_department" class="form-label">Parent Department</label>
                                        <select class="form-control form-select2" id="parent_department" name="parent_department">
                                            <option value="">--</option>';
                                        $form .= $api->generate_department_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description <span class="required">*</span></label>
                                        <textarea class="form-control form-maxlength" id="description" name="description" maxlength="200" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'designation form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="designation" class="form-label">Designation <span class="required">*</span></label>
                                        <input type="hidden" id="designation_id" name="designation_id">
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="designation" name="designation" maxlength="200">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="job_description" class="form-label">Job Description</label><br/>
                                        <input class="form-control" type="file" name="job_description" id="job_description">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description <span class="required">*</span></label>
                                        <textarea class="form-control form-maxlength" id="description" name="description" maxlength="200" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'branch form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="branch" class="form-label">Branch <span class="required">*</span></label>
                                        <input type="hidden" id="branch_id" name="branch_id">
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="branch" name="branch" maxlength="100">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" name="email" class="form-control form-maxlength" maxlength="50" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="phone" name="phone" maxlength="30">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="telephone" class="form-label">Telephone</label>
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="telephone" name="telephone" maxlength="30">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address <span class="required">*</span></label>
                                        <textarea class="form-control form-maxlength" id="address" name="address" maxlength="500" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'upload setting form'){
                $form .= '<div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="upload_setting" class="form-label">Upload Setting <span class="required">*</span></label>
                                        <input type="hidden" id="upload_setting_id" name="upload_setting_id">
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="upload_setting" name="upload_setting" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input type="hidden" id="settingid" name="settingid">
                                        <label for="max_file_size" class="form-label">Max File Size (Megabytes) <span class="required">*</span></label>
                                        <input id="max_file_size" name="max_file_size" class="form-control" type="number" min="0">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="file_type" class="form-label">Allowed File Type <span class="required">*</span></label>
                                        <select class="form-control form-select2" multiple="multiple" id="file_type" name="file_type">
                                            '. $api->generate_system_code_options('FILETYPE') .'
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description <span class="required">*</span></label>
                                        <textarea class="form-control form-maxlength" id="description" name="description" maxlength="200" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'employment status form'){
                $form .= '<div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="employment_status" class="form-label">Employment Status <span class="required">*</span></label>
                                        <input type="hidden" id="employment_status_id" name="employment_status_id">
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="employment_status" name="employment_status" maxlength="100">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Color Value <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="color_value" name="color_value">
                                        <option value="">--</option>';
                                        $form .= $api->generate_system_code_options('COLORVALUE');
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description <span class="required">*</span></label>
                                        <textarea class="form-control form-maxlength" id="description" name="description" maxlength="200" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'employee form'){
                $form .= '<div class="row">
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <input type="hidden" id="employee_id" name="employee_id">
                                        <label for="id_number" class="form-label">ID Number <span class="required">*</span></label>
                                        <input type="text" class="form-control maxlength" autocomplete="off" id="id_number" name="id_number" maxlength="100">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name <span class="required">*</span></label>
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="first_name" name="first_name" maxlength="100">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="middle_name" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="middle_name" name="middle_name" maxlength="100">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name <span class="required">*</span></label>
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="last_name" name="last_name" maxlength="100">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="mb-3">
                                        <label class="form-label">Suffix</label>
                                        <select class="form-control form-select2" id="suffix" name="suffix">
                                        <option value="">--</option>';
                                        $form .= $api->generate_system_code_options('SUFFIX');
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Department <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="department" name="department">
                                        <option value="">--</option>';
                                        $form .= $api->generate_department_options();
                                        $form .='</select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Designation <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="designation" name="designation">
                                        <option value="">--</option>';
                                        $form .= $api->generate_designation_options();
                                        $form .='</select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Branch <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="branch" name="branch">
                                        <option value="">--</option>';
                                        $form .= $api->generate_branch_options();
                                        $form .='</select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Employment Status <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="employment_status" name="employment_status">
                                            <option value="">--</option>';
                                            $form .= $api->generate_employment_status_options();
                                            $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Joining Date <span class="required">*</span></label>
                                        <div class="input-group" id="join-date-container">
                                            <input type="text" class="form-control" id="joining_date" name="joining_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#join-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Permanency Date</label>
                                        <div class="input-group" id="permanency-date-container">
                                            <input type="text" class="form-control" id="permanency_date" name="permanency_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#permanency-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Exit Date</label>
                                        <div class="input-group" id="exit-date-container">
                                            <input type="text" class="form-control" id="exit_date" name="exit_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#exit-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="exit_reason" class="form-label">Exit Reason</label>
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="exit_reason" name="exit_reason" maxlength="500">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Birthday <span class="required">*</span></label>
                                        <div class="input-group" id="birthday-container">
                                            <input type="text" class="form-control birthday-date-picker" id="birthday" name="birthday" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#birthday-container" data-provide="datepicker" data-date-autoclose="true" data-end-date="-18y">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Gender <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="gender" name="gender">
                                        <option value="">--</option>';
                                        $form .= $api->generate_system_code_options('GENDER');
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="required">*</span></label>
                                        <input id="email" name="email" class="form-control form-maxlength" maxlength="100" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Mobile Number</label>
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="phone" name="phone" maxlength="30">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="telephone" class="form-label">Telephone</label>
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="telephone" name="telephone" maxlength="30">
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'emergency contact form'){
                $form .= '<div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="hidden" id="contact_id" name="contact_id">
                                    <input type="hidden" id="employee_id" name="employee_id">
                                    <label for="contact_name" class="form-label">Name <span class="required">*</span></label>
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="contact_name" name="contact_name" maxlength="300">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Relationship <span class="required">*</span></label>
                                    <select class="form-control form-select2" id="relationship" name="relationship">
                                    <option value="">--</option>';
                                    $form .= $api->generate_system_code_options('RELATIONSHIP');
                                    $form .='</select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address <span class="required">*</span></label>
                                    <textarea class="form-control form-maxlength" id="address" name="address" maxlength="200" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Province <span class="required">*</span></label>
                                    <select class="form-control form-select2" id="province" name="province">
                                    <option value="">--</option>';
                                    $form .= $api->generate_province_options();
                                    $form .='</select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">City <span class="required">*</span></label>
                                    <select class="form-control form-select2" id="city" name="city" disabled>
                                        <option value="">--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Mobile Number <span class="required">*</span></label>
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="phone" name="phone" maxlength="30">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" name="email" class="form-control form-maxlength" maxlength="100" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="telephone" class="form-label">Telephone</label>
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="telephone" name="telephone" maxlength="30">
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'employee address form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="hidden" id="address_id" name="address_id">
                                    <input type="hidden" id="employee_id" name="employee_id">
                                    <label class="form-label">Address Type <span class="required">*</span></label>
                                    <select class="form-control form-select2" id="address_type" name="address_type">
                                    <option value="">--</option>';
                                    $form .= $api->generate_system_code_options('ADDRESSTYPE');
                                    $form .='</select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address <span class="required">*</span></label>
                                    <textarea class="form-control form-maxlength" id="address" name="address" maxlength="200" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Province <span class="required">*</span></label>
                                    <select class="form-control form-select2" id="province" name="province">
                                    <option value="">--</option>';
                                    $form .= $api->generate_province_options();
                                    $form .='</select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">City <span class="required">*</span></label>
                                    <select class="form-control form-select2" id="city" name="city" disabled>
                                        <option value="">--</option>
                                    </select>
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'employee social form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="hidden" id="social_id" name="social_id">
                                    <input type="hidden" id="employee_id" name="employee_id">
                                    <label class="form-label">Social <span class="required">*</span></label>
                                    <select class="form-control form-select2" id="social_type" name="social_type">
                                    <option value="">--</option>';
                                    $form .= $api->generate_system_code_options('SOCIAL');
                                    $form .='</select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="link" class="form-label">Link <span class="required">*</span></label>
                                    <input type="url" class="form-control form-maxlength" autocomplete="off" id="link" name="link" maxlength="300">
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'work shift form'){
                $form .= '<div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="hidden" id="work_shift_id" name="work_shift_id">
                                    <label for="work_shift" class="form-label">Work Shift <span class="required">*</span></label>
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="work_shift" name="work_shift" maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Work Shift Type <span class="required">*</span></label>
                                    <select class="form-control form-select2" id="work_shift_type" name="work_shift_type">
                                    <option value="">--</option>';
                                    $form .= $api->generate_system_code_options('WORKSHIFT');
                                    $form .='</select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span class="required">*</span></label>
                                    <textarea class="form-control form-maxlength" id="description" name="description" maxlength="200" rows="5"></textarea>
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'regular work shift schedule form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <input type="hidden" id="work_shift_id" name="work_shift_id">
                                <table class="table table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th>Weekday</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Lunch Start Time</th>
                                            <th>Lunch End Time</th>
                                            <th>Half Day Mark</th>
                                            <th>Late Mark (Minutes)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Monday</th>
                                            <td><input type="time" id="monday_start_time" name="monday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="monday_end_time" name="monday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="monday_lunch_start_time" name="monday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="monday_lunch_end_time" name="monday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="monday_half_day_mark" name="monday_half_day_mark" class="form-control" autocomplete="off"></td>
                                            <td><input id="monday_late_mark" name="monday_late_mark" class="form-control" type="number" min="0"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tuesday</th>
                                            <td><input type="time" id="tuesday_start_time" name="tuesday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="tuesday_end_time" name="tuesday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="tuesday_lunch_start_time" name="tuesday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="tuesday_lunch_end_time" name="tuesday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="tuesday_half_day_mark" name="tuesday_half_day_mark" class="form-control" autocomplete="off"></td>
                                            <td><input id="tuesday_late_mark" name="tuesday_late_mark" class="form-control" type="number" min="0"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Wednesday</th>
                                            <td><input type="time" id="wednesday_start_time" name="wednesday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="wednesday_end_time" name="wednesday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="wednesday_lunch_start_time" name="wednesday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="wednesday_lunch_end_time" name="wednesday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="wednesday_half_day_mark" name="wednesday_half_day_mark" class="form-control" autocomplete="off"></td>
                                            <td><input id="wednesday_late_mark" name="wednesday_late_mark" class="form-control" type="number" min="0"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Thursday</th>
                                            <td><input type="time" id="thursday_start_time" name="thursday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="thursday_end_time" name="thursday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="thursday_lunch_start_time" name="thursday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="thursday_lunch_end_time" name="thursday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="thursday_half_day_mark" name="thursday_half_day_mark" class="form-control" autocomplete="off"></td>
                                            <td><input id="thursday_late_mark" name="thursday_late_mark" class="form-control" type="number" min="0"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Friday</th>
                                            <td><input type="time" id="friday_start_time" name="friday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="friday_end_time" name="friday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="friday_lunch_start_time" name="friday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="friday_lunch_end_time" name="friday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="friday_half_day_mark" name="friday_half_day_mark" class="form-control" autocomplete="off"></td>
                                            <td><input id="friday_late_mark" name="friday_late_mark" class="form-control" type="number" min="0"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Saturday</th>
                                            <td><input type="time" id="saturday_start_time" name="saturday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="saturday_end_time" name="saturday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="saturday_lunch_start_time" name="saturday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="saturday_lunch_end_time" name="saturday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="saturday_half_day_mark" name="saturday_half_day_mark" class="form-control" autocomplete="off"></td>
                                            <td><input id="saturday_late_mark" name="saturday_late_mark" class="form-control" type="number" min="0"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Sunday</th>
                                            <td><input type="time" id="sunday_start_time" name="sunday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="sunday_end_time" name="sunday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="sunday_lunch_start_time" name="sunday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="sunday_lunch_end_time" name="sunday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="sunday_half_day_mark" name="sunday_half_day_mark" class="form-control" autocomplete="off"></td>
                                            <td><input id="sunday_late_mark" name="sunday_late_mark" class="form-control" type="number" min="0"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>';
            }
            else if($form_type == 'scheduled work shift schedule form'){
                $form .= '<div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date <span class="required">*</span></label>
                                    <div class="input-group" id="start-date-container">
                                        <input type="hidden" id="work_shift_id" name="work_shift_id">
                                        <input type="text" class="form-control" id="start_date" name="start_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#start-date-container" data-provide="datepicker" data-date-autoclose="true" value="'. date('m/01/Y') .'">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Date <span class="required">*</span></label>
                                    <div class="input-group" id="end-date-container">
                                        <input type="text" class="form-control" id="end_date" name="end_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#end-date-container" data-provide="datepicker" data-date-autoclose="true" value="'. date('m/t/Y') .'">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th>Weekday</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Lunch Start Time</th>
                                            <th>Lunch End Time</th>
                                            <th>Half Day Mark</th>
                                            <th>Late Mark (Minutes)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Monday</th>
                                            <td><input type="time" id="monday_start_time" name="monday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="monday_end_time" name="monday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="monday_lunch_start_time" name="monday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="monday_lunch_end_time" name="monday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="monday_half_day_mark" name="monday_half_day_mark" class="form-control" autocomplete="off"></td>
                                            <td><input id="monday_late_mark" name="monday_late_mark" class="form-control" type="number" min="0"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tuesday</th>
                                            <td><input type="time" id="tuesday_start_time" name="tuesday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="tuesday_end_time" name="tuesday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="tuesday_lunch_start_time" name="tuesday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="tuesday_lunch_end_time" name="tuesday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="tuesday_half_day_mark" name="tuesday_half_day_mark" class="form-control" autocomplete="off"></td>
                                            <td><input id="tuesday_late_mark" name="tuesday_late_mark" class="form-control" type="number" min="0"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Wednesday</th>
                                            <td><input type="time" id="wednesday_start_time" name="wednesday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="wednesday_end_time" name="wednesday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="wednesday_lunch_start_time" name="wednesday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="wednesday_lunch_end_time" name="wednesday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="wednesday_half_day_mark" name="wednesday_half_day_mark" class="form-control" autocomplete="off"></td>
                                            <td><input id="wednesday_late_mark" name="wednesday_late_mark" class="form-control" type="number" min="0"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Thursday</th>
                                            <td><input type="time" id="thursday_start_time" name="thursday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="thursday_end_time" name="thursday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="thursday_lunch_start_time" name="thursday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="thursday_lunch_end_time" name="thursday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="thursday_half_day_mark" name="thursday_half_day_mark" class="form-control" autocomplete="off"></td>
                                            <td><input id="thursday_late_mark" name="thursday_late_mark" class="form-control" type="number" min="0"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Friday</th>
                                            <td><input type="time" id="friday_start_time" name="friday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="friday_end_time" name="friday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="friday_lunch_start_time" name="friday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="friday_lunch_end_time" name="friday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="friday_half_day_mark" name="friday_half_day_mark" class="form-control" autocomplete="off"></td>
                                            <td><input id="friday_late_mark" name="friday_late_mark" class="form-control" type="number" min="0"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Saturday</th>
                                            <td><input type="time" id="saturday_start_time" name="saturday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="saturday_end_time" name="saturday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="saturday_lunch_start_time" name="saturday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="saturday_lunch_end_time" name="saturday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="saturday_half_day_mark" name="saturday_half_day_mark" class="form-control" autocomplete="off"></td>
                                            <td><input id="saturday_late_mark" name="saturday_late_mark" class="form-control" type="number" min="0"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Sunday</th>
                                            <td><input type="time" id="sunday_start_time" name="sunday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="sunday_end_time" name="sunday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="sunday_lunch_start_time" name="sunday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="sunday_lunch_end_time" name="sunday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="sunday_half_day_mark" name="sunday_half_day_mark" class="form-control" autocomplete="off"></td>
                                            <td><input id="sunday_late_mark" name="sunday_late_mark" class="form-control" type="number" min="0"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>';
            }
            else if($form_type == 'assign work shift form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Employee <span class="required">*</span></label>
                                    <input type="hidden" id="work_shift_id" name="work_shift_id">
                                    <select class="form-control form-select2" multiple="multiple" id="employee" name="employee"></select>
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'employee attendance form'){
                $form .= '<div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time In Date <span class="required">*</span></label>
                                    <div class="input-group" id="time-in-date-container">
                                        <input type="hidden" id="attendance_id" name="attendance_id">
                                        <input type="hidden" id="employee_id" name="employee_id">
                                        <input type="text" class="form-control" id="time_in_date" name="time_in_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#time-in-date-container" data-provide="datepicker" data-date-autoclose="true">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time In <span class="required">*</span></label>
                                    <input type="time" id="time_in" name="time_in" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time Out Date</label>
                                    <div class="input-group" id="time-out-date-container">
                                        <input type="text" class="form-control" id="time_out_date" name="time_out_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#time-out-date-container" data-provide="datepicker" data-date-autoclose="true">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time Out</label>
                                    <input type="time" id="time_out" name="time_out" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="remarks" class="form-label">Remarks</label>
                                    <textarea class="form-control form-maxlength" id="remarks" name="remarks" maxlength="500" rows="5"></textarea>
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'leave type form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="leave_name" class="form-label">Leave <span class="required">*</span></label>
                                        <input type="hidden" id="leave_type_id" name="leave_type_id">
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="leave_name" name="leave_name" maxlength="100">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="no_leaves" class="form-label">Default Value</label>
                                        <input id="no_leaves" name="no_leaves" class="form-control" type="number" min="0" value="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="paid_status" class="form-label">Paid Status <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="paid_status" name="paid_status">
                                            <option value="">--</option>';
                                        $form .= $api->generate_system_code_options('PAIDSTATUS');
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description <span class="required">*</span></label>
                                        <textarea class="form-control form-maxlength" id="description" name="description" maxlength="200" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'leave entitlement form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Employee <span class="required">*</span></label>
                                        <select class="form-control form-select2" multiple="multiple" id="employee" name="employee">
                                            <option value="">--</option>';
                                        $form .= $api->generate_active_employee_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="leave_type" class="form-label">Leave Type <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="leave_type" name="leave_type">
                                            <option value="">--</option>';
                                        $form .= $api->generate_leave_type_options();
                                        $form .='</select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="no_leaves" class="form-label">Entitlement <span class="required">*</span></label>
                                        <input id="no_leaves" name="no_leaves" class="form-control" type="number" min="1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Start Date <span class="required">*</span></label>
                                        <div class="input-group" id="start-date-container">
                                            <input type="text" class="form-control" id="start_date" name="start_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#start-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">End Date <span class="required">*</span></label>
                                        <div class="input-group" id="end-date-container">
                                            <input type="text" class="form-control" id="end_date" name="end_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#end-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'update leave entitlement form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Employee <span class="required">*</span></label>
                                        <input type="hidden" id="leave_entitlement_id" name="leave_entitlement_id">
                                        <select class="form-control form-select2" id="employee_id" name="employee_id" disabled>
                                            <option value="">--</option>';
                                        $form .= $api->generate_active_employee_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="leave_type" class="form-label">Leave Type <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="leave_type" name="leave_type" disabled>
                                            <option value="">--</option>';
                                        $form .= $api->generate_leave_type_options();
                                        $form .='</select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="no_leaves" class="form-label">Entitlement <span class="required">*</span></label>
                                        <input id="no_leaves" name="no_leaves" class="form-control" type="number" min="1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Start Date <span class="required">*</span></label>
                                        <div class="input-group" id="start-date-container">
                                            <input type="text" class="form-control" id="start_date" name="start_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#start-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">End Date <span class="required">*</span></label>
                                        <div class="input-group" id="end-date-container">
                                            <input type="text" class="form-control" id="end_date" name="end_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#end-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'employee leave entitlement form'){
                $form .= '<div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="leave_type" class="form-label">Leave Type <span class="required">*</span></label>
                                        <input type="hidden" id="leave_entitlement_id" name="leave_entitlement_id">
                                        <input type="hidden" id="employee_id" name="employee_id">
                                        <select class="form-control form-select2" id="leave_type" name="leave_type">
                                            <option value="">--</option>';
                                        $form .= $api->generate_leave_type_options();
                                        $form .='</select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="no_leaves" class="form-label">Entitlement <span class="required">*</span></label>
                                        <input id="no_leaves" name="no_leaves" class="form-control" type="number" min="1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Start Date <span class="required">*</span></label>
                                        <div class="input-group" id="start-date-container">
                                            <input type="text" class="form-control" id="start_date" name="start_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#start-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">End Date <span class="required">*</span></label>
                                        <div class="input-group" id="end-date-container">
                                            <input type="text" class="form-control" id="end_date" name="end_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#end-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'leave form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Employee <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="employee_id" name="employee_id">
                                            <option value="">--</option>';
                                        $form .= $api->generate_active_employee_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="leave_type" class="form-label">Leave Type <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="leave_type" name="leave_type">
                                        <option value="">--</option>'; 
                                        $form .= $api->generate_leave_type_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="leave_status" class="form-label">Status <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="leave_status" name="leave_status">
                                            <option value="">--</option>
                                            <option value="2">Pending</option>
                                            <option value="1">Approved</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="leave_duration" class="form-label">Duration <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="leave_duration" name="leave_duration">
                                        <option value="">--</option>'; 
                                        $form .= $api->generate_system_code_options('LEAVEDURATION');
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="leave-date-container"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="reason" class="form-label">Reason <span class="required">*</span></label>
                                        <textarea class="form-control form-maxlength" id="reason" name="reason" maxlength="500" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'approve leave form' || $form_type == 'reject leave form' || $form_type == 'cancel leave form' || $form_type == 'approve employee leave form' || $form_type == 'reject employee leave form' || $form_type == 'cancel employee leave form'){
                if($form_type == 'approve leave form' || $form_type == 'approve employee leave form'){
                    $label = 'Approval Remarks';
                }
                else if($form_type == 'reject leave form' || $form_type == 'reject employee leave form'){
                    $label = 'Rejection Remarks <span class="required">*</span>';
                }
                else{
                    $label = 'Cancellation Remarks <span class="required">*</span>';
                }

                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="decision_remarks" class="form-label">'. $label .'</label>
                                        <input type="hidden" id="leave_id" name="leave_id">
                                        <textarea class="form-control form-maxlength" id="decision_remarks" name="decision_remarks" maxlength="500" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'employee leave form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="leave_type" class="form-label">Leave Type <span class="required">*</span></label>
                                        <input type="hidden" id="employee_id" name="employee_id">
                                        <select class="form-control form-select2" id="leave_type" name="leave_type">
                                        <option value="">--</option>'; 
                                        $form .= $api->generate_leave_type_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="leave_status" class="form-label">Status <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="leave_status" name="leave_status">
                                            <option value="">--</option>
                                            <option value="2">Pending</option>
                                            <option value="1">Approved</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="leave_duration" class="form-label">Duration <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="leave_duration" name="leave_duration">
                                        <option value="">--</option>'; 
                                        $form .= $api->generate_system_code_options('LEAVEDURATION');
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="leave-date-container"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="reason" class="form-label">Reason <span class="required">*</span></label>
                                        <textarea class="form-control form-maxlength" id="reason" name="reason" maxlength="500" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'employee file management form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Employee <span class="required">*</span></label>
                                        <input type="hidden" id="file_id" name="file_id">
                                        <input type="hidden" id="update" value="0">
                                        <select class="form-control form-select2" id="employee_id" name="employee_id">
                                            <option value="">--</option>';
                                        $form .= $api->generate_active_employee_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="file_name" class="form-label">File Name <span class="required">*</span></label>
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="file_name" name="file_name" maxlength="100">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="file_category" class="form-label">File Category <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="file_category" name="file_category">
                                            <option value="">--</option>
                                            '. $api->generate_system_code_options('FILECATEGORY') .'
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">File Date <span class="required">*</span></label>
                                        <div class="input-group" id="file-date-container">
                                            <input type="text" class="form-control" id="file_date" name="file_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#file-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="file" class="form-label">File</label><br/>
                                        <input class="form-control" type="file" name="file" id="file">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="remarks" class="form-label">Remarks <span class="required">*</span></label>
                                        <textarea class="form-control form-maxlength" id="remarks" name="remarks" maxlength="100" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'employee file form'){
                $form .= '<div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="file_name" class="form-label">File Name <span class="required">*</span></label>
                                        <input type="hidden" id="file_id" name="file_id">
                                        <input type="hidden" id="employee_id" name="employee_id">
                                        <input type="hidden" id="update" value="0">
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="file_name" name="file_name" maxlength="100">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="file_category" class="form-label">File Category <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="file_category" name="file_category">
                                            <option value="">--</option>
                                            '. $api->generate_system_code_options('FILECATEGORY') .'
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">File Date <span class="required">*</span></label>
                                        <div class="input-group" id="file-date-container">
                                            <input type="text" class="form-control" id="file_date" name="file_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#file-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="file" class="form-label">File</label><br/>
                                        <input class="form-control" type="file" name="file" id="file">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="remarks" class="form-label">Remarks <span class="required">*</span></label>
                                        <textarea class="form-control form-maxlength" id="remarks" name="remarks" maxlength="100" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'user account form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="employee_id" class="form-label">Employee</label>
                                    <input type="hidden" id="update" value="0">
                                    <select class="form-control form-select2" id="employee_id" name="employee_id">
                                    <option value="">--</option>'; 
                                    $form .= $api->generate_employee_without_user_account_options();
                                    $form .='</select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="user_code" class="form-label">Username <span class="required">*</span></label>
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="user_code" name="user_code" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password <span class="required">*</span></label>
                                    <div class="input-group auth-pass-inputgroup">
                                        <input type="password" id="password" name="password" class="form-control" aria-label="Password" aria-describedby="password-addon">
                                        <button class="btn btn-light" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role <span class="required">*</span></label>
                                        <select class="form-control form-select2" multiple="multiple" id="role" name="role">
                                            '. $api->generate_role_options() .'
                                        </select>
                                    </div>
                                </div>
                        </div>';
            }
            else if($form_type == 'user account update form'){
                $form .= '<div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="user_code" class="form-label">Username <span class="required">*</span></label>
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="user_code" name="user_code" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group auth-pass-inputgroup">
                                        <input type="password" id="password" name="password" class="form-control" aria-label="Password" aria-describedby="password-addon">
                                        <button class="btn btn-light" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role <span class="required">*</span></label>
                                        <select class="form-control form-select2" multiple="multiple" id="role" name="role">
                                            '. $api->generate_role_options() .'
                                        </select>
                                    </div>
                                </div>
                        </div>';
            }
            else if($form_type == 'holiday form'){
                $form .= '<div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="holiday" class="form-label">Holiday <span class="required">*</span></label>
                                        <input type="hidden" id="holiday_id" name="holiday_id">
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="holiday" name="holiday" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="holiday_type" class="form-label">Holiday Type <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="holiday_type" name="holiday_type">
                                        <option value="">--</option>'; 
                                        $form .= $api->generate_system_code_options('HOLIDAYTYPE');
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Holiday Date <span class="required">*</span></label>
                                        <div class="input-group" id="holiday-date-container">
                                            <input type="text" class="form-control" id="holiday_date" name="holiday_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#holiday-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Branch <span class="required">*</span></label>
                                        <select class="form-control form-select2" multiple="multiple" id="branch" name="branch">
                                        <option value="">--</option>';
                                        $form .= $api->generate_branch_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'time in form'){
                $form .= '<div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap mb-3">
                                        <div class="me-3">
                                            <p class="text-muted mb-2">Time In Date & Time</p>
                                            <h5 class="mb-2">'. date('F d, Y') .' '. date('h:i a') .'</h5>
                                        </div>

                                        <div class="avatar-sm ms-auto">
                                            <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                                <i class="bx bx-log-in"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="time_in_note" class="form-label">Time In Note</label>
                                        <input type="hidden" id="attendance_position" name="attendance_position">
                                        <textarea class="form-control form-maxlength" id="time_in_note" name="time_in_note" maxlength="200" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'time out form'){
                $form .= '<div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap mb-3">
                                        <div class="me-3">
                                            <p class="text-muted mb-2">Time In Date & Time</p>
                                            <h5 class="mb-2" id="time-in-record">--</h5>
                                        </div>

                                        <div class="avatar-sm ms-auto">
                                            <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                                <i class="bx bx-log-in"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap mb-3">
                                        <div class="me-3">
                                            <p class="text-muted mb-2">Time Out Date & Time</p>
                                            <h5 class="mb-2">'. date('F d, Y') .' '. date('h:i a') .'</h5>
                                        </div>

                                        <div class="avatar-sm ms-auto">
                                            <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                                <i class="bx bx-log-out"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="time_out_note" class="form-label">Time Out Note</label>
                                        <input type="hidden" id="attendance_id" name="attendance_id">
                                        <input type="hidden" id="attendance_position" name="attendance_position">
                                        <textarea class="form-control form-maxlength" id="time_out_note" name="time_out_note" maxlength="200" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'attendance record form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Employee <span class="required">*</span></label>
                                        <input type="hidden" id="attendance_id" name="attendance_id">
                                        <select class="form-control form-select2" id="employee_id" name="employee_id">
                                            <option value="">--</option>';
                                        $form .= $api->generate_active_employee_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Time In Date <span class="required">*</span></label>
                                        <div class="input-group" id="time-in-date-container">
                                            <input type="text" class="form-control" id="time_in_date" name="time_in_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#time-in-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Time In <span class="required">*</span></label>
                                        <input type="time" id="time_in" name="time_in" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Time Out Date</label>
                                        <div class="input-group" id="time-out-date-container">
                                            <input type="text" class="form-control" id="time_out_date" name="time_out_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#time-out-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Time Out</label>
                                        <input type="time" id="time_out" name="time_out" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="remarks" class="form-label">Remarks</label>
                                        <textarea class="form-control form-maxlength" id="remarks" name="remarks" maxlength="500" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'health declaration form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="temperature" class="form-label">Temperature <span class="required">*</span></label>
                                        <input id="temperature" name="temperature" class="form-control" type="number" min="0" step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-1">
                                        <label class="form-label">1. Are you experiencing:  <span class="required">*</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-9">
                                    <label for="sore_throat" class="col-form-label">Sore throat (Pananakit ng lalamunan/ masakit lumunok)</label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control form-select2" id="sore_throat" name="sore_throat">
                                        <option value="1">Yes</option>
                                        <option value="0" selected>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-9">
                                    <label for="body_pain" class="col-form-label">Body pains (Pananakit ng katawan)</label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control form-select2" id="body_pain" name="body_pain">
                                        <option value="2">Yes</option>
                                        <option value="0" selected>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-9">
                                    <label for="headache" class="col-form-label">Headache (Pananakit ng ulo)</label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control form-select2" id="headache" name="headache">
                                        <option value="4">Yes</option>
                                        <option value="0" selected>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-9">
                                    <label for="fever" class="col-form-label">Fever for the past few days (Lagnat sa nakalipas na mga araw)</label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control form-select2" id="fever" name="fever">
                                        <option value="8">Yes</option>
                                        <option value="0" selected>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="temperature" class="form-label">2. Have you worked together or stayed in the same close environment ofa confirmed COVID-19 case? (May nakasama ka ba o nakatrabahong tao na kumpirmadong may COVID-19 / may impeksyon ng coronavirus?) <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="question_2" name="question_2">
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="temperature" class="form-label">3. Have you had any contact with anyone with fever, cough, colds, and sore throat in the past 2 weeks? (Mayroon ka bang nakasama na may lagnat, ubo, sipon o sakit ng lalamunan sa nakalipas ng dalawang (2) lingo?) <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="question_3" name="question_3">
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="temperature" class="form-label">4. Have you travelled outside of the Philippines in the last 14 days? (Ikaw ba ay nagbyahe sa labas ng Pilipinas sa nakalipas na 14 na araw?) <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="question_4" name="question_4">
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="temperature" class="form-label">5. Have you travelled to any area in NCR aside from your home? (Ikaw ba ay nagpunta sa iba pang parte ng NCR o Metro Manila bukod sa iyong bahay?) <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="question_5" name="question_5">
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="temperature" class="form-label">If yes, specify which city/municipality you went to (Sabihin kung saan)</label>
                                        <input type="text" class="form-control maxlength" autocomplete="off" id="specific" name="specific" maxlength="100" disabled>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'get location form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="remarks" class="form-label">Remarks</label>
                                        <input type="hidden" id="position" name="position">
                                        <textarea class="form-control form-maxlength" id="remarks" name="remarks" maxlength="500" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'send test email form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="required">*</span></label>
                                        <input id="email" name="email" class="form-control form-maxlength" maxlength="200" autocomplete="off">
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'attendance creation form'){
                $form .= '<div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time In Date <span class="required">*</span></label>
                                    <div class="input-group" id="time-in-date-container">
                                        <input type="hidden" id="request_id" name="request_id">
                                        <input type="hidden" id="update" value="0">
                                        <input type="text" class="form-control" id="time_in_date" name="time_in_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#time-in-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-end-date="0d">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time In <span class="required">*</span></label>
                                    <input type="time" id="time_in" name="time_in" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time Out Date</label>
                                    <div class="input-group" id="time-out-date-container">
                                        <input type="text" class="form-control" id="time_out_date" name="time_out_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#time-out-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-end-date="0d">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time Out</label>
                                    <input type="time" id="time_out" name="time_out" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="file" class="form-label">Attachment <span class="required">*</span></label><br/>
                                        <input class="form-control" type="file" name="file" id="file">
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="reason" class="form-label">Reason <span class="required">*</span></label>
                                    <textarea class="form-control form-maxlength" id="reason" name="reason" maxlength="500" rows="5"></textarea>
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'attendance adjustment full form'){
                $form .= '<div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time In Date <span class="required">*</span></label>
                                    <div class="input-group" id="time-in-date-container">
                                        <input type="hidden" id="attendance_id" name="attendance_id">
                                        <input type="text" class="form-control" id="time_in_date" name="time_in_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#time-in-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-end-date="0d">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time In <span class="required">*</span></label>
                                    <input type="time" id="time_in" name="time_in" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time Out Date <span class="required">*</span></label>
                                    <div class="input-group" id="time-out-date-container">
                                        <input type="text" class="form-control" id="time_out_date" name="time_out_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#time-out-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-end-date="0d">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time Out <span class="required">*</span></label>
                                    <input type="time" id="time_out" name="time_out" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="file" class="form-label">Attachment <span class="required">*</span></label><br/>
                                    <input class="form-control" type="file" name="file" id="file">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="reason" class="form-label">Reason <span class="required">*</span></label>
                                    <textarea class="form-control form-maxlength" id="reason" name="reason" maxlength="500" rows="5"></textarea>
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'attendance adjustment partial form'){
                $form .= '<div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time In Date <span class="required">*</span></label>
                                    <div class="input-group" id="time-in-date-container">
                                        <input type="hidden" id="attendance_id" name="attendance_id">
                                        <input type="text" class="form-control" id="time_in_date" name="time_in_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#time-in-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-end-date="0d">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time In <span class="required">*</span></label>
                                    <input type="time" id="time_in" name="time_in" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="file" class="form-label">Attachment <span class="required">*</span></label><br/>
                                    <input class="form-control" type="file" name="file" id="file">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="reason" class="form-label">Reason <span class="required">*</span></label>
                                    <textarea class="form-control form-maxlength" id="reason" name="reason" maxlength="500" rows="5"></textarea>
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'attendance adjustment full update form'){
                $form .= '<div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time In Date <span class="required">*</span></label>
                                    <div class="input-group" id="time-in-date-container">
                                        <input type="hidden" id="request_id" name="request_id">
                                        <input type="text" class="form-control" id="time_in_date" name="time_in_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#time-in-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-end-date="0d">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time In <span class="required">*</span></label>
                                    <input type="time" id="time_in" name="time_in" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time Out Date <span class="required">*</span></label>
                                    <div class="input-group" id="time-out-date-container">
                                        <input type="text" class="form-control" id="time_out_date" name="time_out_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#time-out-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-end-date="0d">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time Out <span class="required">*</span></label>
                                    <input type="time" id="time_out" name="time_out" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="file" class="form-label">Attachment</label><br/>
                                    <input class="form-control" type="file" name="file" id="file">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="reason" class="form-label">Reason <span class="required">*</span></label>
                                    <textarea class="form-control form-maxlength" id="reason" name="reason" maxlength="500" rows="5"></textarea>
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'attendance adjustment partial update form'){
                $form .= '<div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time In Date <span class="required">*</span></label>
                                    <div class="input-group" id="time-in-date-container">
                                        <input type="hidden" id="request_id" name="request_id">
                                        <input type="text" class="form-control" id="time_in_date" name="time_in_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#time-in-date-container" data-provide="datepicker" data-date-autoclose="true" data-date-end-date="0d">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Time In <span class="required">*</span></label>
                                    <input type="time" id="time_in" name="time_in" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="file" class="form-label">Attachment</label><br/>
                                    <input class="form-control" type="file" name="file" id="file">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="reason" class="form-label">Reason <span class="required">*</span></label>
                                    <textarea class="form-control form-maxlength" id="reason" name="reason" maxlength="500" rows="5"></textarea>
                                </div>
                            </div>
                        </div>';
            }

            $form .= '</form>';

            $response[] = array(
                'FORM' => $form
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------
    
    # System element
    else if($type == 'system element'){
        if(isset($_POST['element_type']) && !empty($_POST['element_type']) && isset($_POST['value'])){
            $element_type = $_POST['element_type'];
            $value = $_POST['value'];
            $element = '';

            if($element_type == 'system parameter details'){
                $element = '<table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Parameter :</th>
                                        <td id="parameter"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Extension :</th>
                                        <td id="extension"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Number :</th>
                                        <td id="parameter_number"></td>
                                    </tr>
                                </tbody>
                            </table>';
            }
            else if($element_type == 'branch details'){
                $element = '<table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Branch :</th>
                                        <td id="branch"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email :</th>
                                        <td id="email"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Phone :</th>
                                        <td id="phone"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Telephone :</th>
                                        <td id="telephone"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address :</th>
                                        <td id="address"></td>
                                    </tr>
                                </tbody>
                            </table>';
            }
            else if($element_type == 'transaction log'){
                $element = '<ul class="verti-timeline list-unstyled" id="transaction-log-timeline"></ul>';
            }
            else if($element_type == 'leave duration'){
                $element .= '<label class="form-label">Leave Date <span class="required">*</span></label>';

                if($value == 'SINGLE' || $value == 'HLFDAYMOR' || $value == 'HLFDAYAFT'){
                    $element .= '<div class="col-md-12">
                        <div class="mb-3">
                            <div class="input-group" id="date-leave-container">
                                <input type="text" class="form-control" id="leave_date" name="leave_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#date-leave-container" data-provide="datepicker" data-date-autoclose="true">
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                    </div>';
                }
                else if($value == 'CUSTOM'){
                    $element .= '<div class="col-md-12">
                        <div class="mb-3">
                            <div class="input-group" id="date-leave-container">
                                <input type="text" class="form-control" id="leave_date" name="leave_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#date-leave-container" data-provide="datepicker" data-date-autoclose="false" data-date-multidate="true">
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="start_time" class="form-label">Start Time <span class="required">*</span></label>
                            <input type="time" id="start_time" name="start_time" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="end_time" class="form-label">End Time <span class="required">*</span></label>
                            <input type="time" id="end_time" name="end_time" class="form-control" autocomplete="off">
                        </div>
                    </div>';
                }
                else {
                    $element .= '<div class="col-md-12">
                        <div class="mb-3">
                            <div class="input-group" id="date-leave-container">
                                <input type="text" class="form-control" id="leave_date" name="leave_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#date-leave-container" data-provide="datepicker" data-date-autoclose="false" data-date-multidate="true">
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                    </div>';
                }
            }
            else if($element_type == 'leave details'){
                $element = '<table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Employee :</th>
                                        <td id="employee"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Leave Type :</th>
                                        <td id="leave_type"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Leave Date :</th>
                                        <td id="leave_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Leave Time :</th>
                                        <td id="leave_time"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Leave Reason :</th>
                                        <td id="leave_reason"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Leave Status :</th>
                                        <td id="leave_status"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Decision By :</th>
                                        <td id="decision_by"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Decision Remarks :</th>
                                        <td id="decision_remarks"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Decision Date :</th>
                                        <td id="decision_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Decision Time :</th>
                                        <td id="decision_time"></td>
                                    </tr>
                                </tbody>
                            </table>';
            }
            else if($element_type == 'employee attendance details'){
                $element = '<table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Employee :</th>
                                        <td id="employee"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time In Date :</th>
                                        <td id="time_in_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time In :</th>
                                        <td id="time_in"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time In Location :</th>
                                        <td id="time_in_location"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time In IP Address :</th>
                                        <td id="time_in_ip_address"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time In By :</th>
                                        <td id="time_in_by"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time In Behavior :</th>
                                        <td id="time_in_behavior"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time In Note :</th>
                                        <td id="time_in_note"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time Out Date :</th>
                                        <td id="time_out_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time Out :</th>
                                        <td id="time_out"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time Out Location :</th>
                                        <td id="time_out_location"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time Out IP Address :</th>
                                        <td id="time_out_ip_address"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time Out By :</th>
                                        <td id="time_out_by"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time Out Behavior :</th>
                                        <td id="time_out_behavior"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time Out Note :</th>
                                        <td id="time_out_note"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Late :</th>
                                        <td id="late"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Early Leaving :</th>
                                        <td id="early_leaving"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Overtime :</th>
                                        <td id="overtime"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total Working Hours :</th>
                                        <td id="total_working_hours"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Remarks :</th>
                                        <td id="remarks"></td>
                                    </tr>
                                </tbody>
                            </table>';
            }
            else if($element_type == 'employee file details'){
                $element = '<table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Employee :</th>
                                        <td id="employee"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">File Name :</th>
                                        <td id="file_name"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">File Category :</th>
                                        <td id="file_category"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">File :</th>
                                        <td id="file"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">File Date :</th>
                                        <td id="file_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Upload Date :</th>
                                        <td id="upload_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Upload Time :</th>
                                        <td id="upload_time"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Upload By :</th>
                                        <td id="upload_by"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Remarks :</th>
                                        <td id="remarks"></td>
                                    </tr>
                                </tbody>
                            </table>';
            }
            else if($element_type == 'employee qr code'){
                $element = '<div class="row">
                                <div class="col-md-12">
                                    <div id="qr-code">
                                        <img class="img-fluid" alt="employee qr code" src="./assets/images/default/default-qr.jpg" id="qr-code" data-holder-rendered="true">
                                    </div>
                                </div>
                            </div>';
            }
            else if($element_type == 'user account details'){
                $element = '<table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Employee :</th>
                                        <td id="employee"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Username :</th>
                                        <td id="user_code"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">User Acount Status :</th>
                                        <td id="active"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Password Expiry Date :</th>
                                        <td id="password_expiry_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Failed Login :</th>
                                        <td id="failed_login"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Last Failed Login :</th>
                                        <td id="last_failed_login"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Roles :</th>
                                        <td id="roles"></td>
                                    </tr>
                                </tbody>
                            </table>';
            }
            else if($element_type == 'scan qr code form'){
                $element = '<div class="row">
                                <div class="col-md-12">
                                    <div id="qr-code-reader"></div>
                                </div>
                            </div>';
            }

            $response[] = array(
                'ELEMENT' => $element
            );

            echo json_encode($response);
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Generate table functions
    # -------------------------------------------------------------
    
    # System parameter table
    else if($type == 'system parameter table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_system_parameter = $api->check_role_permissions($username, 21);
            $delete_system_parameter = $api->check_role_permissions($username, 22);
            $view_transaction_log = $api->check_role_permissions($username, 23);

            $sql = $api->db_connection->prepare('SELECT PARAMETER_ID, PARAMETER_DESC, TRANSACTION_LOG_ID FROM tblsystemparameters ORDER BY PARAMETER_ID');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $parameter_id = $row['PARAMETER_ID'];
                    $parameter_desc = $row['PARAMETER_DESC'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                    if($update_system_parameter > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-system-parameter" data-parameter-id="'. $parameter_id .'" title="Edit System Parameter">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_system_parameter > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-system-parameter" data-parameter-id="'. $parameter_id .'" title="Delete System Parameter">
                        <i class="bx bx-trash font-size-16 align-middle"></i>
                        </button>';
                    }
                    else{
                        $delete = '';
                    }

                    if($view_transaction_log > 0 && !empty($transaction_log_id)){
                        $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                <i class="bx bx-detail font-size-16 align-middle"></i>
                                            </button>';
                    }
                    else{
                        $transaction_log = '';
                    }

                    $response[] = array(
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $parameter_id .'">',
                        'PARAMETER_ID' => $parameter_id,
                        'PARAMETER_DESC' => $parameter_desc,
                        'ACTION' => '<div class="d-flex gap-2">
                            <button type="button" class="btn btn-primary waves-effect waves-light view-system-parameter" data-parameter-id="'. $parameter_id .'" title="View System Parameter">
                                <i class="bx bx-show font-size-16 align-middle"></i>
                            </button>
                            '. $update .'
                            '. $transaction_log .'
                            '. $delete .'
                        </div>'
                    );
                }

                echo json_encode($response);
            }
            else{
                echo $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # Policy table
    else if($type == 'policy table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_policy = $api->check_role_permissions($username, 4);
            $delete_policy = $api->check_role_permissions($username, 5);
            $view_transaction_log = $api->check_role_permissions($username, 6);
            $permission_page = $api->check_role_permissions($username, 7);

            $sql = $api->db_connection->prepare('SELECT POLICY_ID, POLICY, DESCRIPTION, TRANSACTION_LOG_ID FROM tblpolicy ORDER BY POLICY');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $policy_id = $row['POLICY_ID'];
                    $policy = $row['POLICY'];
                    $description = $row['DESCRIPTION'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                    $policy_id_encrypted = $api->encrypt_data($policy_id);

                    if($permission_page > 0){
                        $permission = '<a href="permission.php?id='. $policy_id_encrypted .'" class="btn btn-warning waves-effect waves-light" title="View Permission">
                                    <i class="bx bx-list-check font-size-16 align-middle"></i>
                                </a>';
                    }
                    else{
                        $permission = '';
                    }

                    if($update_policy > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-policy" data-policy-id="'. $policy_id .'" title="Edit Policy">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_policy > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-policy" data-policy-id="'. $policy_id .'" title="Delete Policy">
                            <i class="bx bx-trash font-size-16 align-middle"></i>
                        </button>';
                    }
                    else{
                        $delete = '';
                    }

                    if($view_transaction_log > 0 && !empty($transaction_log_id)){
                        $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                <i class="bx bx-detail font-size-16 align-middle"></i>
                                            </button>';
                    }
                    else{
                        $transaction_log = '';
                    }

                    $response[] = array(
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $policy_id .'">',
                        'POLICY' => $policy . '<p class="text-muted mb-0">'. $description .'</p>',
                        'ACTION' => '<div class="d-flex gap-2">
                                            '. $update .'
                                            '. $permission .'
                                            '. $transaction_log .'
                                            '. $delete .'
                                        </div>'
                    );
                }

                echo json_encode($response);
            }
            else{
                echo $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # Permission table
    else if($type == 'permission table'){
        if(isset($_POST['policy_id']) && !empty($_POST['policy_id'])){
            if ($api->databaseConnection()) {
                $policy_id = $_POST['policy_id'];
                $policy_details = $api->get_policy_details($policy_id);
                $policy = $policy_details[0]['POLICY'];

                # Get permission
                $update_permission = $api->check_role_permissions($username, 8);
                $delete_permission = $api->check_role_permissions($username, 10);
                $view_transaction_log = $api->check_role_permissions($username, 10);
    
                $sql = $api->db_connection->prepare('SELECT PERMISSION_ID, PERMISSION, TRANSACTION_LOG_ID FROM tblpermission WHERE POLICY = :policy_id ORDER BY PERMISSION_ID');
                $sql->bindValue(':policy_id', $policy_id);
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $permission_id = $row['PERMISSION_ID'];
                        $permission = $row['PERMISSION'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
    
                        if($update_permission > 0){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-permission" data-permission-id="'. $permission_id .'" title="Edit Permission">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }
    
                        if($delete_permission > 0){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-permission" data-permission-id="'. $permission_id .'" title="Delete Permission">
                                            <i class="bx bx-trash font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $delete = '';
                        }

                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }
    
                        $response[] = array(
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $permission_id .'">',
                            'PERMISSION_ID' => $permission_id,
                            'PERMISSION' => $permission . '<p class="text-muted mb-0">'. $policy .'</p>',
                            'ACTION' => '<div class="d-flex gap-2">
                                '. $update .'
                                '. $transaction_log .'
                                '. $delete .'
                            </div>'
                        );
                    }
    
                    echo json_encode($response);
                }
                else{
                    echo $sql->errorInfo()[2];
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Role table
    else if($type == 'role table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_role = $api->check_role_permissions($username, 14);
            $delete_role = $api->check_role_permissions($username, 15);
            $view_transaction_log = $api->check_role_permissions($username, 16);
            $role_permission_page = $api->check_role_permissions($username, 17);

            $sql = $api->db_connection->prepare('SELECT ROLE_ID, ROLE, DESCRIPTION, TRANSACTION_LOG_ID FROM tblrole ORDER BY ROLE');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $role_id = $row['ROLE_ID'];
                    $role = $row['ROLE'];
                    $description = $row['DESCRIPTION'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                    $role_id_encrypted = $api->encrypt_data($role_id);

                    if($update_role > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-role" data-role-id="'. $role_id .'" title="Edit Role">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_role > 0 && $role_id != 'RL-1'){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-role" data-role-id="'. $role_id .'" title="Delete Role">
                                    <i class="bx bx-trash font-size-16 align-middle"></i>
                                </button>';
                    }
                    else{
                        $delete = '';
                    }

                    if($role_permission_page > 0){
                        $permission = '<a href="role-permission.php?id='. $role_id_encrypted .'" class="btn btn-warning waves-effect waves-light" title="View Permission">
                                    <i class="bx bx-list-check font-size-16 align-middle"></i>
                                </a>';
                    }
                    else{
                        $permission = '';
                    }

                    if($role_id != 'RL-1'){
                        $check_box = '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $role_id .'">';
                    }
                    else{
                        $check_box = '';
                    }

                    if($view_transaction_log > 0 && !empty($transaction_log_id)){
                        $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                <i class="bx bx-detail font-size-16 align-middle"></i>
                                            </button>';
                    }
                    else{
                        $transaction_log = '';
                    }

                    $response[] = array(
                        'CHECK_BOX' => $check_box,
                        'ROLE' => $role . '<p class="text-muted mb-0">'. $description .'</p>',
                        'ACTION' => '<div class="d-flex gap-2">
                            '. $update .'
                            '. $permission .'
                            '. $transaction_log .'
                            '. $delete .'
                        </div>'
                    );
                }

                echo json_encode($response);
            }
            else{
                echo $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # System code table
    else if($type == 'system code table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_system_code = $api->check_role_permissions($username, 26);
            $delete_system_code = $api->check_role_permissions($username, 27);
            $view_transaction_log = $api->check_role_permissions($username, 28);

            $sql = $api->db_connection->prepare('SELECT SYSTEM_TYPE, SYSTEM_CODE, DESCRIPTION, TRANSACTION_LOG_ID FROM tblsystemcode ORDER BY SYSTEM_TYPE');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $system_type = $row['SYSTEM_TYPE'];
                    $system_code = $row['SYSTEM_CODE'];
                    $description = $row['DESCRIPTION'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                    if($update_system_code > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-system-code" data-system-type="'. $system_type .'" data-system-code="'. $system_code .'" title="Edit System Code">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_system_code > 0 && ($system_type != 'SYSTYPE' || $system_code != 'SYSTYPE')){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-system-code" data-system-type="'. $system_type .'" data-system-code="'. $system_code .'" title="Delete System Code">
                        <i class="bx bx-trash font-size-16 align-middle"></i>
                        </button>';
                    }
                    else{
                        $delete = '';
                    }

                    if($system_type != 'SYSTYPE' || $system_code != 'SYSTYPE'){
                        $check_box = '<input class="form-check-input datatable-checkbox-children" type="checkbox" data-system-type="'. $system_type .'" data-system-code="'. $system_code .'">';
                    }
                    else{
                        $check_box = '';
                    }

                    if($view_transaction_log > 0 && !empty($transaction_log_id)){
                        $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                <i class="bx bx-detail font-size-16 align-middle"></i>
                                            </button>';
                    }
                    else{
                        $transaction_log = '';
                    }

                    $response[] = array(
                        'CHECK_BOX' => $check_box,
                        'SYSTEM_TYPE' => $system_type,
                        'SYSTEM_CODE' => $system_code . '<p class="text-muted mb-0">'. $description .'</p>',
                        'ACTION' => '<div class="d-flex gap-2">
                            '. $update .'
                            '. $transaction_log .'
                            '. $delete .'
                        </div>'
                    );
                }

                echo json_encode($response);
            }
            else{
                echo $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # Notification type table
    else if($type == 'notification type table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_notification_type = $api->check_role_permissions($username, 31);
            $delete_notification_type = $api->check_role_permissions($username, 32);
            $view_transaction_log = $api->check_role_permissions($username, 33);
            $notification_details_page = $api->check_role_permissions($username, 168);

            $sql = $api->db_connection->prepare('SELECT NOTIFICATION_ID, NOTIFICATION, DESCRIPTION, TRANSACTION_LOG_ID FROM tblnotificationtype ORDER BY NOTIFICATION');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $notification_id = $row['NOTIFICATION_ID'];
                    $notification = $row['NOTIFICATION'];
                    $description = $row['DESCRIPTION'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                    $notification_id_encrypted = $api->encrypt_data($notification_id);

                    if($notification_details_page > 0){
                        $notification_details = '<a href="notification-details.php?id='. $notification_id_encrypted .'" class="btn btn-warning waves-effect waves-light" title="View Notification Details">
                                    <i class="bx bx-list-check font-size-16 align-middle"></i>
                                </a>';
                    }
                    else{
                        $notification_details = '';
                    }

                    if($update_notification_type > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-notification-type" data-notification-id="'. $notification_id .'" title="Edit Notification Type">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_notification_type > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-notification-type" data-notification-id="'. $notification_id .'" title="Delete Notification Type">
                                    <i class="bx bx-trash font-size-16 align-middle"></i>
                                </button>';
                    }
                    else{
                        $delete = '';
                    }

                    if($view_transaction_log > 0 && !empty($transaction_log_id)){
                        $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                <i class="bx bx-detail font-size-16 align-middle"></i>
                                            </button>';
                    }
                    else{
                        $transaction_log = '';
                    }
                   
                    $response[] = array(
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $notification_id .'">',
                        'NOTIFICATION' => $notification . '<p class="text-muted mb-0">'. $description .'</p>',
                        'ACTION' => '<div class="d-flex gap-2">
                            '. $update .'
                            '. $notification_details .'
                            '. $transaction_log .'
                            '. $delete .'
                        </div>'
                    );
                }

                echo json_encode($response);
            }
            else{
                echo $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # Department table
    else if($type == 'department table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_department = $api->check_role_permissions($username, 47);
            $delete_department = $api->check_role_permissions($username, 48);
            $view_transaction_log = $api->check_role_permissions($username, 49);

            $sql = $api->db_connection->prepare('SELECT DEPARTMENT_ID, DEPARTMENT, DESCRIPTION, DEPARTMENT_HEAD, PARENT_DEPARTMENT, TRANSACTION_LOG_ID FROM tbldepartment ORDER BY DEPARTMENT');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $department_id = $row['DEPARTMENT_ID'];
                    $department = $row['DEPARTMENT'];
                    $description = $row['DESCRIPTION'];
                    $department_head = $row['DEPARTMENT_HEAD'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                    $parent_department_details = $api->get_department_details($row['PARENT_DEPARTMENT']);
                    $parent_department = $parent_department_details[0]['DEPARTMENT'] ?? null;

                    if($update_department > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-department" data-department-id="'. $department_id .'" title="Edit Department">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_department > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-department" data-department-id="'. $department_id .'" title="Delete Department">
                                    <i class="bx bx-trash font-size-16 align-middle"></i>
                                </button>';
                    }
                    else{
                        $delete = '';
                    }

                    if($view_transaction_log > 0 && !empty($transaction_log_id)){
                        $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                <i class="bx bx-detail font-size-16 align-middle"></i>
                                            </button>';
                    }
                    else{
                        $transaction_log = '';
                    }

                    $response[] = array(
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $department_id .'">',
                        'DEPARTMENT' => $department . '<p class="text-muted mb-0">'. $description .'</p>',
                        'DEPARTMENT_HEAD' => $department_head,
                        'PARENT_DEPARTMENT' => $parent_department,
                        'ACTION' => '<div class="d-flex gap-2">
                            '. $update .'
                            '. $transaction_log .'
                            '. $delete .'
                        </div>'
                    );
                }

                echo json_encode($response);
            }
            else{
                echo $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # Designation table
    else if($type == 'designation table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_designation = $api->check_role_permissions($username, 52);
            $delete_designation = $api->check_role_permissions($username, 53);
            $view_transaction_log = $api->check_role_permissions($username, 54);

            $sql = $api->db_connection->prepare('SELECT DESIGNATION_ID, DESIGNATION, DESCRIPTION, JOB_DESCRIPTION, TRANSACTION_LOG_ID FROM tbldesignation ORDER BY DESIGNATION');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $designation_id = $row['DESIGNATION_ID'];
                    $designation = $row['DESIGNATION'];
                    $description = $row['DESCRIPTION'];
                    $job_description = $row['JOB_DESCRIPTION'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                    if($update_designation > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-designation" data-designation-id="'. $designation_id .'" title="Edit Designation">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_designation > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-designation" data-designation-id="'. $designation_id .'" title="Delete Designation">
                                    <i class="bx bx-trash font-size-16 align-middle"></i>
                                </button>';
                    }
                    else{
                        $delete = '';
                    }

                    if($view_transaction_log > 0 && !empty($transaction_log_id)){
                        $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                <i class="bx bx-detail font-size-16 align-middle"></i>
                                            </button>';
                    }
                    else{
                        $transaction_log = '';
                    }

                    $response[] = array(
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $designation_id .'">',
                        'DESIGNATION' => $designation . '<p class="text-muted mb-0">'. $description .'</p>',
                        'ACTION' => '<div class="d-flex gap-2">
                            '. $update .'
                            '. $transaction_log .'
                            '. $delete .'
                        </div>'
                    );
                }

                echo json_encode($response);
            }
            else{
                echo $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # Branch table
    else if($type == 'branch table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_branch = $api->check_role_permissions($username, 57);
            $delete_branch = $api->check_role_permissions($username, 58);
            $view_transaction_log = $api->check_role_permissions($username, 59);

            $sql = $api->db_connection->prepare('SELECT BRANCH_ID, BRANCH, TRANSACTION_LOG_ID FROM tblbranch ORDER BY BRANCH');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $branch_id = $row['BRANCH_ID'];
                    $branch = $row['BRANCH'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                    if($update_branch > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-branch" data-branch-id="'. $branch_id .'" title="Edit Branch">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_branch > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-branch" data-branch-id="'. $branch_id .'" title="Delete Branch">
                                    <i class="bx bx-trash font-size-16 align-middle"></i>
                                </button>';
                    }
                    else{
                        $delete = '';
                    }

                    if($view_transaction_log > 0 && !empty($transaction_log_id)){
                        $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                <i class="bx bx-detail font-size-16 align-middle"></i>
                                            </button>';
                    }
                    else{
                        $transaction_log = '';
                    }

                    $response[] = array(
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $branch_id .'">',
                        'BRANCH' => $branch,
                        'ACTION' => '<div class="d-flex gap-2">
                            <button type="button" class="btn btn-primary waves-effect waves-light view-branch" data-branch-id="'. $branch_id .'" title="View Branch">
                                <i class="bx bx-show font-size-16 align-middle"></i>
                            </button>
                            '. $update .'
                            '. $transaction_log .'
                            '. $delete .'
                        </div>'
                    );
                }

                echo json_encode($response);
            }
            else{
                echo $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # Upload setting table
    else if($type == 'upload setting table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_upload_setting = $api->check_role_permissions($username, 62);
            $delete_upload_setting = $api->check_role_permissions($username, 63);
            $view_transaction_log = $api->check_role_permissions($username, 64);

            $sql = $api->db_connection->prepare('SELECT UPLOAD_SETTING_ID, UPLOAD_SETTING, DESCRIPTION, MAX_FILE_SIZE, TRANSACTION_LOG_ID FROM tbluploadsetting ORDER BY UPLOAD_SETTING');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $file_type = '';
                    $upload_setting_id = $row['UPLOAD_SETTING_ID'];
                    $upload_setting = $row['UPLOAD_SETTING'];
                    $description = $row['DESCRIPTION'];
                    $max_file_size = $row['MAX_FILE_SIZE'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                    $upload_file_type_details = $api->get_upload_file_type_details($upload_setting_id);

                    for($i = 0; $i < count($upload_file_type_details); $i++) {
                        $system_code_details = $api->get_system_code_details('FILETYPE', $upload_file_type_details[$i]['FILE_TYPE']);
                        $file_type .= '<span class="badge bg-info font-size-11">'. $system_code_details[0]['DESCRIPTION'] .'</span> ';

                        if(($i + 1) % 3 == 0){
                            $file_type .= '<br/>';
                        }
                    }

                    if($delete_upload_setting > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-upload-setting" data-upload-setting-id="'. $upload_setting_id .'" title="Edit Upload Setting">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_upload_setting > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-upload-setting" data-upload-setting-id="'. $upload_setting_id .'" title="Delete Upload Setting">
                                    <i class="bx bx-trash font-size-16 align-middle"></i>
                                </button>';
                    }
                    else{
                        $delete = '';
                    }

                    if($view_transaction_log > 0 && !empty($transaction_log_id)){
                        $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                <i class="bx bx-detail font-size-16 align-middle"></i>
                                            </button>';
                    }
                    else{
                        $transaction_log = '';
                    }

                    $response[] = array(
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $upload_setting_id .'">',
                        'UPLOAD_SETTING_ID' => $upload_setting_id,
                        'UPLOAD_SETTING' => $upload_setting . '<p class="text-muted mb-0">'. $description .'</p>',
                        'MAX_FILE_SIZE' => $max_file_size . ' Mb',
                        'FILE_TYPE' => $file_type,
                        'ACTION' => '<div class="d-flex gap-2">
                            '. $update .'
                            '. $transaction_log .'
                            '. $delete .'
                        </div>'
                    );
                }

                echo json_encode($response);
            }
            else{
                echo $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # Employment status table
    else if($type == 'employment status table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_employment_status = $api->check_role_permissions($username, 67);
            $delete_employment_status = $api->check_role_permissions($username, 68);
            $view_transaction_log = $api->check_role_permissions($username, 69);

            $sql = $api->db_connection->prepare('SELECT EMPLOYMENT_STATUS_ID, EMPLOYMENT_STATUS, DESCRIPTION, COLOR_VALUE, TRANSACTION_LOG_ID FROM tblemploymentstatus ORDER BY EMPLOYMENT_STATUS');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $employment_status_id = $row['EMPLOYMENT_STATUS_ID'];
                    $employment_status = $row['EMPLOYMENT_STATUS'];
                    $description = $row['DESCRIPTION'];
                    $color_value = $row['COLOR_VALUE'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                    if($update_employment_status > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-employment-status" data-employment-status-id="'. $employment_status_id .'" title="Edit Employment Status">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_employment_status > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-employment-status" data-employment-status-id="'. $employment_status_id .'" title="Delete Employment Status">
                                    <i class="bx bx-trash font-size-16 align-middle"></i>
                                </button>';
                    }
                    else{
                        $delete = '';
                    }

                    if($view_transaction_log > 0 && !empty($transaction_log_id)){
                        $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                <i class="bx bx-detail font-size-16 align-middle"></i>
                                            </button>';
                    }
                    else{
                        $transaction_log = '';
                    }

                    $response[] = array(
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $employment_status_id .'">',
                        'EMPLOYMENT_STATUS' => $employment_status . '<p class="text-muted mb-0">'. $description .'</p>',
                        'PREVIEW' => '<span class="badge bg-'. $color_value .'">'. $employment_status .'</span>',
                        'ACTION' => '<div class="d-flex gap-2">
                            '. $update .'
                            '. $transaction_log .'
                            '. $delete .'
                        </div>'
                    );
                }

                echo json_encode($response);
            }
            else{
                echo $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # Employee table
    else if($type == 'employee table'){
        if(isset($_POST['filter_branch']) && isset($_POST['filter_department']) && isset($_POST['filter_designation']) && isset($_POST['filter_employment_status'])){
            if($api->databaseConnection()) {
                # Get permission
                $update_employee = $api->check_role_permissions($username, 72);
                $delete_employee = $api->check_role_permissions($username, 73);
                $view_transaction_log = $api->check_role_permissions($username, 74);
                $view_employee_details_page = $api->check_role_permissions($username, 75);

                $filter_branch = $_POST['filter_branch'];
                $filter_department = $_POST['filter_department'];
                $filter_designation = $_POST['filter_designation'];
                $filter_employment_status = $_POST['filter_employment_status'];
    
                $query = 'SELECT EMPLOYEE_ID, FILE_AS, EMPLOYMENT_STATUS, DEPARTMENT, DESIGNATION, TRANSACTION_LOG_ID FROM tblemployee WHERE ';

                if(!empty($filter_branch) || !empty($filter_department) || !empty($filter_designation) || !empty($filter_employment_status)){
                    if(!empty($filter_branch)){
                        $filter[] = 'BRANCH = :filter_branch';
                    }

                    if(!empty($filter_department)){
                        $filter[] = 'DEPARTMENT = :filter_department';
                    }

                    if(!empty($filter_designation)){
                        $filter[] = 'DESIGNATION = :filter_designation';
                    }

                    if(!empty($filter_employment_status)){
                        $filter[] = 'EMPLOYMENT_STATUS = :filter_employment_status';
                    }
                    else{
                        $filter[] = 'EMPLOYMENT_STATUS IN ("1", "2")';
                    }
                }
                else{
                    $filter[] = 'EMPLOYMENT_STATUS IN ("1", "2")';
                }

                if(!empty($filter)){
                    $query .= implode(' AND ', $filter);
                }
                
                $sql = $api->db_connection->prepare($query);

                if(!empty($filter_branch) || !empty($filter_department) || !empty($filter_designation) || !empty($filter_employment_status)){
                    if(!empty($filter_branch)){
                        $sql->bindValue(':filter_branch', $filter_branch);
                    }

                    if(!empty($filter_department)){
                        $sql->bindValue(':filter_department', $filter_department);
                    }

                    if(!empty($filter_designation)){
                        $sql->bindValue(':filter_designation', $filter_designation);
                    }

                    if(!empty($filter_employment_status)){
                        $sql->bindValue(':filter_employment_status', $filter_employment_status);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $employee_id = $row['EMPLOYEE_ID'];
                        $employee_id_encrypted = $api->encrypt_data($employee_id);
                        $file_as = $row['FILE_AS'];
                        $employment_status = $row['EMPLOYMENT_STATUS'];
                        $department = $row['DEPARTMENT'];
                        $designation = $row['DESIGNATION'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
    
                        $employment_status_details = $api->get_employment_status_details($employment_status);
                        $color_value = $employment_status_details[0]['COLOR_VALUE'];
                        $employment_status_description = $employment_status_details[0]['EMPLOYMENT_STATUS'];
    
                        $department_details = $api->get_department_details($department);
                        $department_name = $department_details[0]['DEPARTMENT'];
    
                        $designation_details = $api->get_designation_details($designation);
                        $designation_name = $designation_details[0]['DESIGNATION'];
    
                        if($update_employee > 0){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-employee" data-employee-id="'. $employee_id .'" title="Edit Employee">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }
    
                        if($view_employee_details_page > 0){
                            $view_page = '<a href="employee-details.php?id='. $employee_id_encrypted .'" class="btn btn-warning waves-effect waves-light" title="View Employee Details">
                                                <i class="bx bx-user font-size-16 align-middle"></i>
                                            </a>';

                            $file_as = '<a href="employee-details.php?id='. $employee_id_encrypted .'" title="View Employee Details">
                                                '. $file_as .'
                                            </a>';
                        }
                        else{
                            $view_page = '';
                        }
    
                        if($delete_employee > 0){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-employee" data-employee-id="'. $employee_id .'" title="Delete Employee">
                                        <i class="bx bx-trash font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $delete = '';
                        }
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }
    
                        $response[] = array(
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $employee_id .'">',
                            'FILE_AS' => $file_as . '<p class="text-muted mb-0">'. $designation_name .'</p>',
                            'EMPLOYEE_ID' => $employee_id,
                            'EMPLOYMENT_STATUS' => '<span class="badge bg-'. $color_value .'">'. $employment_status_description .'</span>',
                            'DEPARTMENT' => $department_name,
                            'ACTION' => '<div class="d-flex gap-2">
                                '. $update .'
                                '. $view_page .'
                                '. $transaction_log .'
                                '. $delete .'
                            </div>'
                        );
                    }
    
                    echo json_encode($response);
                }
                else{
                    echo $sql->errorInfo()[2];
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Emergency contact table
    else if($type == 'emergency contact table'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id'])){
            if ($api->databaseConnection()) {
                $employee_id = $_POST['employee_id'];

                # Get permission
                $update_emergency_contact = $api->check_role_permissions($username, 79);
                $delete_emergency_contact = $api->check_role_permissions($username, 80);
                $view_transaction_log = $api->check_role_permissions($username, 81);
    
                $sql = $api->db_connection->prepare('SELECT CONTACT_ID, NAME, RELATIONSHIP, EMAIL, PHONE, TELEPHONE, ADDRESS, CITY, PROVINCE, TRANSACTION_LOG_ID FROM tblemergencycontact WHERE EMPLOYEE_ID = :employee_id');
                $sql->bindValue(':employee_id', $employee_id);
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $contact_id = $row['CONTACT_ID'];
                        $name = $row['NAME'];
                        $relationship = $api->get_system_code_details('RELATIONSHIP', $row['RELATIONSHIP'])[0]['DESCRIPTION'];
                        $email = $row['EMAIL'];
                        $phone = $row['PHONE'];
                        $telephone = $row['TELEPHONE'];
                        $address = $row['ADDRESS'];
                        $city = $row['CITY'];
                        $province = $row['PROVINCE'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                        $province_details = $api->get_province_details($province);
                        $city_details = $api->get_city_details($city, $province);

                        $province_name = $province_details[0]['PROVINCE'];
                        $city_name = $city_details[0]['CITY'];
    
                        if($update_emergency_contact > 0){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-emergency-contact" data-contact-id="'. $contact_id .'" title="Edit Emergency Contact">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }
    
                        if($delete_emergency_contact > 0){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-emergency-contact" data-contact-id="'. $contact_id .'" title="Delete Emergency Contact">
                                        <i class="bx bx-trash font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $delete = '';
                        }
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }
    
                        $response[] = array(
                            'NAME' => $name . '<p class="text-muted mb-0">'. $relationship .'</p>',
                            'PHONE' => $phone,
                            'EMAIL' => $email,
                            'TELEPHONE' => $telephone,
                            'ADDRESS' => $address . ', ' . $city_name . ', ' . $province_name,
                            'ACTION' => '<div class="d-flex gap-2">
                                '. $update .'
                                '. $transaction_log .'
                                '. $delete .'
                            </div>'
                        );
                    }
    
                    echo json_encode($response);
                }
                else{
                    echo $sql->errorInfo()[2];
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Employee address table
    else if($type == 'employee address table'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id'])){
            if ($api->databaseConnection()) {
                $employee_id = $_POST['employee_id'];

                # Get permission
                $update_employee_address = $api->check_role_permissions($username, 79);
                $delete_employee_address = $api->check_role_permissions($username, 80);
                $view_transaction_log = $api->check_role_permissions($username, 81);
    
                $sql = $api->db_connection->prepare('SELECT ADDRESS_ID, ADDRESS_TYPE, ADDRESS, CITY, PROVINCE, TRANSACTION_LOG_ID FROM tblemployeeaddress WHERE EMPLOYEE_ID = :employee_id');
                $sql->bindValue(':employee_id', $employee_id);
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $address_id = $row['ADDRESS_ID'];
                        $address_type = $api->get_system_code_details('ADDRESSTYPE', $row['ADDRESS_TYPE'])[0]['DESCRIPTION'] ?? null;
                        $address = $row['ADDRESS'];
                        $city = $row['CITY'];
                        $province = $row['PROVINCE'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                        $province_details = $api->get_province_details($province);
                        $city_details = $api->get_city_details($city, $province);

                        $province_name = $province_details[0]['PROVINCE'];
                        $city_name = $city_details[0]['CITY'];
    
                        if($update_employee_address > 0){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-employee-address" data-address-id="'. $address_id .'" title="Edit Employee Address">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }
    
                        if($delete_employee_address > 0){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-employee-address" data-address-id="'. $address_id .'" title="Delete Employee Address">
                                        <i class="bx bx-trash font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $delete = '';
                        }
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }
    
                        $response[] = array(
                            'ADDRESS_TYPE' => $address_type,
                            'ADDRESS' => $address . ', ' . $city_name . ', ' . $province_name,
                            'ACTION' => '<div class="d-flex gap-2">
                                '. $update .'
                                '. $transaction_log .'
                                '. $delete .'
                            </div>'
                        );
                    }
    
                    echo json_encode($response);
                }
                else{
                    echo $sql->errorInfo()[2];
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Employee social table
    else if($type == 'employee social table'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id'])){
            if ($api->databaseConnection()) {
                $employee_id = $_POST['employee_id'];

                # Get permission
                $update_employee_social = $api->check_role_permissions($username, 89);
                $delete_employee_social = $api->check_role_permissions($username, 90);
                $view_transaction_log = $api->check_role_permissions($username, 91);
    
                $sql = $api->db_connection->prepare('SELECT SOCIAL_ID, SOCIAL_TYPE, LINK, TRANSACTION_LOG_ID FROM tblemployeesocial WHERE EMPLOYEE_ID = :employee_id');
                $sql->bindValue(':employee_id', $employee_id);
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $social_id = $row['SOCIAL_ID'];
                        $social_type = $api->get_system_code_details('SOCIAL', $row['SOCIAL_TYPE'])[0]['DESCRIPTION'] ?? null;
                        $link = $row['LINK'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
    
                        if($update_employee_social > 0){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-employee-social" data-social-id="'. $social_id .'" title="Edit Employee Social">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }
    
                        if($delete_employee_social > 0){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-employee-social" data-social-id="'. $social_id .'" title="Delete Employee Social">
                                        <i class="bx bx-trash font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $delete = '';
                        }
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }
    
                        $response[] = array(
                            'SOCIAL_TYPE' => $social_type,
                            'LINK' => '<a href="'. $link .'">Visit Link</a>',
                            'ACTION' => '<div class="d-flex gap-2">
                                '. $update .'
                                '. $transaction_log .'
                                '. $delete .'
                            </div>'
                        );
                    }
    
                    echo json_encode($response);
                }
                else{
                    echo $sql->errorInfo()[2];
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Work shift table
    else if($type == 'work shift table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_work_shift = $api->check_role_permissions($username, 94);
            $update_work_shift_schedule = $api->check_role_permissions($username, 95);
            $assign_work_shift = $api->check_role_permissions($username, 96);
            $delete_work_shift = $api->check_role_permissions($username, 97);
            $view_transaction_log = $api->check_role_permissions($username, 98);

            $sql = $api->db_connection->prepare('SELECT WORK_SHIFT_ID, WORK_SHIFT, WORK_SHIFT_TYPE, DESCRIPTION, TRANSACTION_LOG_ID FROM tblworkshift ORDER BY WORK_SHIFT');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $schedule = '';
                    $work_shift_id = $row['WORK_SHIFT_ID'];
                    $work_shift = $row['WORK_SHIFT'];
                    $work_shift_type = $row['WORK_SHIFT_TYPE'];
                    $work_shift_type_name = $api->get_system_code_details('WORKSHIFT', $work_shift_type)[0]['DESCRIPTION'] ?? null;
                    $description = $row['DESCRIPTION'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                    if($update_work_shift > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-work-shift" data-work-shift-id="'. $work_shift_id .'" title="Edit Work Shift">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($assign_work_shift > 0){
                        $assign = '<button type="button" class="btn btn-success waves-effect waves-light assign-work-shift" data-work-shift-id="'. $work_shift_id .'" title="Assign Work Shift">
                                        <i class="bx bx-calendar-plus font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $assign = '';
                    }

                    if($update_work_shift_schedule > 0){
                        $work_schedule = '<button type="button" class="btn btn-warning waves-effect waves-light update-work-shift-schedule" data-work-shift-id="'. $work_shift_id .'" data-work-shift-type="'. $work_shift_type .'" title="Edit Work Shift Schedule">
                                        <i class="bx bx-calendar font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $work_schedule = '';
                    }

                    if($delete_work_shift > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-work-shift" data-work-shift-id="'. $work_shift_id .'" title="Delete Work Shift">
                                    <i class="bx bx-trash font-size-16 align-middle"></i>
                                </button>';
                    }
                    else{
                        $delete = '';
                    }

                    if($view_transaction_log > 0 && !empty($transaction_log_id)){
                        $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                <i class="bx bx-detail font-size-16 align-middle"></i>
                                            </button>';
                    }
                    else{
                        $transaction_log = '';
                    }

                    $response[] = array(
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $work_shift_id .'">',
                        'WORK_SHIFT' => $work_shift . '<p class="text-muted mb-0">'. $description .'</p>',
                        'WORK_SHIFT_TYPE' => $work_shift_type_name,
                        'ACTION' => '<div class="d-flex gap-2">
                            '. $update .'
                            '. $work_schedule .'
                            '. $assign .'
                            '. $transaction_log .'
                            '. $delete .'
                        </div>'
                    );
                }

                echo json_encode($response);
            }
            else{
                echo $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # Employee attendance table
    else if($type == 'employee attendance table'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id'])){
            if ($api->databaseConnection()) {
                $employee_id = $_POST['employee_id'];

                # Get permission
                $update_employee_attendance = $api->check_role_permissions($username, 101);
                $delete_employee_attendance = $api->check_role_permissions($username, 102);
                $view_transaction_log = $api->check_role_permissions($username, 103);
    
                $sql = $api->db_connection->prepare('SELECT ATTENDANCE_ID, TIME_IN_DATE, TIME_IN, TIME_IN_BEHAVIOR, TIME_OUT_DATE, TIME_OUT, TIME_OUT_BEHAVIOR, LATE, EARLY_LEAVING, OVERTIME, TOTAL_WORKING_HOURS, TRANSACTION_LOG_ID FROM tblattendancerecord WHERE EMPLOYEE_ID = :employee_id');
                $sql->bindValue(':employee_id', $employee_id);
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $attendance_id = $row['ATTENDANCE_ID'];
                        $time_in_date = $api->check_date('empty', $row['TIME_IN_DATE'], '', 'm/d/Y', '', '', '');
                        $time_in = $api->check_date('empty', $row['TIME_IN'], '', 'h:i a', '', '', '');
                        $time_in_behavior = $api->get_time_in_behavior_status($row['TIME_IN_BEHAVIOR'])[0]['BADGE'];
                        $time_out_date = $api->check_date('empty', $row['TIME_OUT_DATE'], '', 'm/d/Y', '', '', '');
                        $time_out = $api->check_date('empty', $row['TIME_OUT'], '', 'h:i a', '', '', '');
                        $time_out_behavior = $api->get_time_out_behavior_status($row['TIME_OUT_BEHAVIOR'])[0]['BADGE'];
                        $late = number_format($row['LATE']);
                        $early_leaving = number_format($row['EARLY_LEAVING']);
                        $overtime = number_format($row['OVERTIME']);
                        $total_working_hours = number_format($row['TOTAL_WORKING_HOURS'], 2);
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
    
                        if($update_employee_attendance > 0){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-employee-attendance" data-attendance-id="'. $attendance_id .'" title="Edit Employee Attendance">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }
    
                        if($delete_employee_attendance > 0){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-employee-attendance" data-attendance-id="'. $attendance_id .'" title="Delete Employee Attendance">
                                        <i class="bx bx-trash font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $delete = '';
                        }
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }
    
                        $response[] = array(
                            'TIME_IN' => $time_in_date . '<br/>' . $time_in,
                            'TIME_IN_BEHAVIOR' => $time_in_behavior,
                            'TIME_OUT' => $time_out_date . '<br/>' . $time_out,
                            'TIME_OUT_BEHAVIOR' => $time_out_behavior,
                            'LATE' => $late,
                            'EARLY_LEAVING' => $early_leaving,
                            'OVERTIME' => $overtime,
                            'TOTAL_WORKING_HOURS' => $total_working_hours,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-employee-attendance" data-attendance-id="'. $attendance_id .'" title="View Employee Attendance">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $update .'
                                '. $transaction_log .'
                                '. $delete .'
                            </div>'
                        );
                    }
    
                    echo json_encode($response);
                }
                else{
                    echo $sql->errorInfo()[2];
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Leave Type table
    else if($type == 'leave type table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_leave_type = $api->check_role_permissions($username, 106);
            $delete_leave_type = $api->check_role_permissions($username, 107);
            $view_transaction_log = $api->check_role_permissions($username, 108);

            $sql = $api->db_connection->prepare('SELECT LEAVE_TYPE_ID, LEAVE_NAME, DESCRIPTION, NO_LEAVES, PAID_STATUS, TRANSACTION_LOG_ID FROM tblleavetype ORDER BY LEAVE_NAME');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $leave_type_id = $row['LEAVE_TYPE_ID'];
                    $leave_name = $row['LEAVE_NAME'];
                    $description = $row['DESCRIPTION'];
                    $no_leaves = $row['NO_LEAVES'];
                    $paid_status = $api->get_system_code_details('PAIDSTATUS', $row['PAID_STATUS'])[0]['DESCRIPTION'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                    if($update_leave_type > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-leave-type" data-leave-type-id="'. $leave_type_id .'" title="Edit Leave Type">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_leave_type > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-leave-type" data-leave-type-id="'. $leave_type_id .'" title="Delete Leave Type">
                                    <i class="bx bx-trash font-size-16 align-middle"></i>
                                </button>';
                    }
                    else{
                        $delete = '';
                    }

                    if($view_transaction_log > 0 && !empty($transaction_log_id)){
                        $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                <i class="bx bx-detail font-size-16 align-middle"></i>
                                            </button>';
                    }
                    else{
                        $transaction_log = '';
                    }

                    $response[] = array(
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $leave_type_id .'">',
                        'LEAVE_NAME' => $leave_name . '<p class="text-muted mb-0">'. $description .'</p>',
                        'NO_LEAVES' => number_format($no_leaves),
                        'PAID_STATUS' => $paid_status,
                        'ACTION' => '<div class="d-flex gap-2">
                            '. $update .'
                            '. $transaction_log .'
                            '. $delete .'
                        </div>'
                    );
                }

                echo json_encode($response);
            }
            else{
                echo $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # Leave Entitlement table
    else if($type == 'leave entitlement table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_leave_entitlement = $api->check_role_permissions($username, 111);
            $delete_leave_entitlement = $api->check_role_permissions($username, 112);
            $view_transaction_log = $api->check_role_permissions($username, 113);

            $sql = $api->db_connection->prepare('SELECT LEAVE_ENTITLEMENT_ID, EMPLOYEE_ID, LEAVE_TYPE, NO_LEAVES, ACQUIRED_LEAVES, START_DATE, END_DATE, TRANSACTION_LOG_ID FROM tblleaveentitlement');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $leave_entitlement_id = $row['LEAVE_ENTITLEMENT_ID'];
                    $employee_id = $row['EMPLOYEE_ID'];
                    $leave_type = $row['LEAVE_TYPE'];
                    $no_leaves = $row['NO_LEAVES'];
                    $acquired_leaves = $row['ACQUIRED_LEAVES'];
                    $leave_entitlement_status = $api->get_leave_entitlement_status($no_leaves, $acquired_leaves)[0]['BADGE'];
                    $start_date = $api->check_date('empty', $row['START_DATE'], '', 'm/d/Y', '', '', '');
                    $end_date = $api->check_date('empty', $row['END_DATE'], '', 'm/d/Y', '', '', '');
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                    $leave_type_details = $api->get_leave_type_details($leave_type);
                    $leave_name = $leave_type_details[0]['LEAVE_NAME'];

                    $employee_details = $api->get_employee_details($employee_id, '');
                    $file_as = $employee_details[0]['FILE_AS'];

                    if($update_leave_entitlement > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-leave-entitlement" data-leave-entitlement-id="'. $leave_entitlement_id .'" title="Edit Leave Entitlement">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_leave_entitlement > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-leave-entitlement" data-leave-entitlement-id="'. $leave_entitlement_id .'" title="Delete Leave Entitlement">
                                    <i class="bx bx-trash font-size-16 align-middle"></i>
                                </button>';
                    }
                    else{
                        $delete = '';
                    }

                    if($view_transaction_log > 0 && !empty($transaction_log_id)){
                        $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                <i class="bx bx-detail font-size-16 align-middle"></i>
                                            </button>';
                    }
                    else{
                        $transaction_log = '';
                    }

                    $response[] = array(
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $leave_entitlement_id .'">',
                        'FILE_AS' => $file_as,
                        'LEAVE_NAME' => $leave_name,
                        'COVERAGE' => $start_date . ' - ' . $end_date,
                        'ENTITLEMENT' => $leave_entitlement_status,
                        'ACTION' => '<div class="d-flex gap-2">
                            '. $update .'
                            '. $transaction_log .'
                            '. $delete .'
                        </div>'
                    );
                }

                echo json_encode($response);
            }
            else{
                echo $sql->errorInfo()[2];
            }
        }
    }
    # -------------------------------------------------------------

    # Employee leave entitlement table
    else if($type == 'employee leave entitlement table'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id'])){
            if ($api->databaseConnection()) {
                $employee_id = $_POST['employee_id'];

                # Get permission
                $update_leave_entitlement = $api->check_role_permissions($username, 111);
                $delete_leave_entitlement = $api->check_role_permissions($username, 112);
                $view_transaction_log = $api->check_role_permissions($username, 113);
    
                $sql = $api->db_connection->prepare('SELECT LEAVE_ENTITLEMENT_ID, LEAVE_TYPE, NO_LEAVES, ACQUIRED_LEAVES, START_DATE, END_DATE, TRANSACTION_LOG_ID FROM tblleaveentitlement WHERE EMPLOYEE_ID = :employee_id');
                $sql->bindValue(':employee_id', $employee_id);
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $leave_entitlement_id = $row['LEAVE_ENTITLEMENT_ID'];
                        $leave_type = $row['LEAVE_TYPE'];
                        $no_leaves = $row['NO_LEAVES'];
                        $acquired_leaves = $row['ACQUIRED_LEAVES'];
                        $leave_entitlement_status = $api->get_leave_entitlement_status($no_leaves, $acquired_leaves)[0]['BADGE'];
                        $start_date = $api->check_date('empty', $row['START_DATE'], '', 'm/d/Y', '', '', '');
                        $end_date = $api->check_date('empty', $row['END_DATE'], '', 'm/d/Y', '', '', '');
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
    
                        $leave_type_details = $api->get_leave_type_details($leave_type);
                        $leave_name = $leave_type_details[0]['LEAVE_NAME'];
    
                        if($update_leave_entitlement > 0){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-employee-leave-entitlement" data-leave-entitlement-id="'. $leave_entitlement_id .'" title="Edit Leave Entitlement">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }
    
                        if($delete_leave_entitlement > 0){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-employee-leave-entitlement" data-leave-entitlement-id="'. $leave_entitlement_id .'" title="Delete Leave Entitlement">
                                        <i class="bx bx-trash font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $delete = '';
                        }
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }
    
                        $response[] = array(
                            'LEAVE_NAME' => $leave_name,
                            'COVERAGE' => $start_date . ' - ' . $end_date,
                            'ENTITLEMENT' => $leave_entitlement_status,
                            'ACTION' => '<div class="d-flex gap-2">
                                '. $update .'
                                '. $transaction_log .'
                                '. $delete .'
                            </div>'
                        );
                    }
    
                    echo json_encode($response);
                }
                else{
                    echo $sql->errorInfo()[2];
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Leave Management table
    else if($type == 'leave management table'){
        if(isset($_POST['filter_leave_status']) && isset($_POST['filter_department']) && isset($_POST['filter_leave_type']) && isset($_POST['filter_start_date']) && isset($_POST['filter_end_date'])){
            if ($api->databaseConnection()) {
                # Get permission
                $delete_leave = $api->check_role_permissions($username, 121);
                $approve_leave = $api->check_role_permissions($username, 122);
                $reject_leave = $api->check_role_permissions($username, 123);
                $cancel_leave = $api->check_role_permissions($username, 124);
                $view_transaction_log = $api->check_role_permissions($username, 125);
    
                $filter_leave_status = $_POST['filter_leave_status'];
                $filter_department = $_POST['filter_department'];
                $filter_leave_type = $_POST['filter_leave_type'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');
    
                $query = 'SELECT LEAVE_ID, EMPLOYEE_ID, LEAVE_TYPE, LEAVE_DATE, START_TIME, END_TIME, LEAVE_STATUS, TRANSACTION_LOG_ID FROM tblleave WHERE ';
    
                if(!empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date)) || $filter_leave_status != '' || !empty($filter_leave_type)){
                    if(!empty($filter_department)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = :filter_department)';
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $filter[] = 'LEAVE_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if(!empty($filter_leave_type)){
                        $filter[] = 'LEAVE_TYPE = :filter_leave_type';
                    }

                    if($filter_leave_status != ''){
                        $filter[] = 'LEAVE_STATUS = :filter_leave_status';
                    }
                }
                else{
                    $filter[] = 'LEAVE_STATUS = :filter_leave_status';
                }                
    
                if(!empty($filter)){
                    $query .= implode(' AND ', $filter);
                }
    
                $sql = $api->db_connection->prepare($query);

                if(!empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date)) ||  $filter_leave_status != '' || !empty($filter_leave_type)){
                    if(!empty($filter_department)){
                        $sql->bindValue(':filter_department', $filter_department);
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }

                    if($filter_leave_status != ''){
                        $sql->bindValue(':filter_leave_status', $filter_leave_status);
                    }

                    if(!empty($filter_leave_type)){
                        $sql->bindValue(':filter_leave_type', $filter_leave_type);
                    }
                }
                else{
                    $filter[] = 'LEAVE_STATUS = :filter_leave_status';
                } 
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $leave_id = $row['LEAVE_ID'];
                        $employee_id = $row['EMPLOYEE_ID'];
                        $leave_type = $row['LEAVE_TYPE'];
                        $leave_date = $api->check_date('empty', $row['LEAVE_DATE'], '', 'm/d/Y', '', '', '');
                        $start_time = $api->check_date('empty', $row['START_TIME'], '', 'h:i a', '', '', '');
                        $end_time = $api->check_date('empty', $row['END_TIME'], '', 'h:i a', '', '', '');
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                        $leave_status = $row['LEAVE_STATUS'];
                        $leave_status_name = $api->get_leave_status($leave_status, $system_date, $leave_date)[0]['BADGE'];
    
                        $employee_leave_entitlement_details = $api->get_employee_leave_entitlement_details($employee_id, $leave_type, $leave_date);
                        $no_leaves = $employee_leave_entitlement_details[0]['NO_LEAVES'];
                        $acquired_leaves = $employee_leave_entitlement_details[0]['ACQUIRED_LEAVES'];
    
                        $leave_entitlement_status = $api->get_leave_entitlement_status($no_leaves, $acquired_leaves)[0]['BADGE'];
    
                        $leave_type_details = $api->get_leave_type_details($leave_type);
                        $leave_name = $leave_type_details[0]['LEAVE_NAME'];
    
                        $employee_details = $api->get_employee_details($employee_id, '');
                        $file_as = $employee_details[0]['FILE_AS'];
    
                        if($delete_leave > 0 && $leave_status == 2){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-leave" data-leave-id="'. $leave_id .'" title="Delete Leave">
                                        <i class="bx bx-trash font-size-16 align-middle"></i>
                                    </button>';
                            $check_box = '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $leave_id .'">';
                        }
                        else{
                            $delete = '';
                            $check_box = '';
                        }
    
                        if($approve_leave > 0 && $leave_status == 2){
                            $approve = '<button type="button" class="btn btn-success waves-effect waves-light approve-leave" data-leave-id="'. $leave_id .'" title="Approve Leave">
                                        <i class="bx bx-check font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $approve = '';
                        }
    
                        if($reject_leave > 0 && $leave_status == 2){
                            $reject = '<button type="button" class="btn btn-danger waves-effect waves-light reject-leave" data-leave-id="'. $leave_id .'" title="Reject Leave">
                                        <i class="bx bx-x font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $reject = '';
                        }
    
                        if($cancel_leave > 0 && ($leave_status == 2 || ($leave_status == 1 && strtotime($system_date) < strtotime($leave_date)))){
                            $cancel = '<button type="button" class="btn btn-warning waves-effect waves-light cancel-leave" data-leave-id="'. $leave_id .'" title="Cancel Leave">
                                        <i class="bx bx-calendar-x font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $cancel = '';
                        }
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }
    
                        $response[] = array(
                            'CHECK_BOX' => $check_box,
                            'FILE_AS' => $file_as,
                            'LEAVE_NAME' => $leave_name,
                            'LEAVE_ENTITLMENT' => $leave_entitlement_status,
                            'LEAVE_DATE' => $leave_date . '<br/>' . $start_time . ' - ' . $end_time,
                            'LEAVE_STATUS' => $leave_status_name,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-leave" data-leave-id="'. $leave_id .'" title="View Leave">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $approve .'
                                '. $reject .'
                                '. $cancel .'
                                '. $transaction_log .'
                                '. $delete .'
                            </div>'
                        );
                    }
    
                    echo json_encode($response);
                }
                else{
                    echo $sql->errorInfo()[2];
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Leave Management table
    else if($type == 'employee leave table'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id'])){
            if ($api->databaseConnection()) {
                # Get permission
                $delete_leave = $api->check_role_permissions($username, 128);
                $approve_leave = $api->check_role_permissions($username, 129);
                $reject_leave = $api->check_role_permissions($username, 130);
                $cancel_leave = $api->check_role_permissions($username, 131);
                $view_transaction_log = $api->check_role_permissions($username, 132);
    
                $employee_id = $_POST['employee_id'];
    
                $sql = $api->db_connection->prepare('SELECT LEAVE_ID, LEAVE_TYPE, LEAVE_DATE, START_TIME, END_TIME, LEAVE_STATUS, TRANSACTION_LOG_ID FROM tblleave WHERE EMPLOYEE_ID = :employee_id');
                $sql->bindValue(':employee_id', $employee_id);
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $leave_id = $row['LEAVE_ID'];
                        $leave_type = $row['LEAVE_TYPE'];
                        $leave_date = $api->check_date('empty', $row['LEAVE_DATE'], '', 'm/d/Y', '', '', '');
                        $start_time = $api->check_date('empty', $row['START_TIME'], '', 'h:i a', '', '', '');
                        $end_time = $api->check_date('empty', $row['END_TIME'], '', 'h:i a', '', '', '');
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                        $leave_status = $row['LEAVE_STATUS'];
                        $leave_status_name = $api->get_leave_status($leave_status, $system_date, $leave_date)[0]['BADGE'];
    
                        $employee_leave_entitlement_details = $api->get_employee_leave_entitlement_details($employee_id, $leave_type, $leave_date);
                        $no_leaves = $employee_leave_entitlement_details[0]['NO_LEAVES'];
                        $acquired_leaves = $employee_leave_entitlement_details[0]['ACQUIRED_LEAVES'];
    
                        $leave_entitlement_status = $api->get_leave_entitlement_status($no_leaves, $acquired_leaves)[0]['BADGE'];
    
                        $leave_type_details = $api->get_leave_type_details($leave_type);
                        $leave_name = $leave_type_details[0]['LEAVE_NAME'];
    
                        if($delete_leave > 0 && $leave_status == 2){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-employee-leave" data-leave-id="'. $leave_id .'" title="Delete Leave">
                                        <i class="bx bx-trash font-size-16 align-middle"></i>
                                    </button>';
                            $check_box = '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $leave_id .'">';
                        }
                        else{
                            $delete = '';
                            $check_box = '';
                        }
    
                        if($approve_leave > 0 && $leave_status == 2){
                            $approve = '<button type="button" class="btn btn-success waves-effect waves-light approve-employee-leave" data-leave-id="'. $leave_id .'" title="Approve Leave">
                                        <i class="bx bx-check font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $approve = '';
                        }
    
                        if($reject_leave > 0 && $leave_status == 2){
                            $reject = '<button type="button" class="btn btn-danger waves-effect waves-light reject-employee-leave" data-leave-id="'. $leave_id .'" title="Reject Leave">
                                        <i class="bx bx-x font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $reject = '';
                        }
    
                        if($cancel_leave > 0 && ($leave_status == 2 || ($leave_status == 1 && strtotime($system_date) < strtotime($leave_date)))){
                            $cancel = '<button type="button" class="btn btn-warning waves-effect waves-light cancel-employee-leave" data-leave-id="'. $leave_id .'" title="Cancel Leave">
                                        <i class="bx bx-calendar-x font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $cancel = '';
                        }
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }
    
                        $response[] = array(
                            'LEAVE_NAME' => $leave_name,
                            'LEAVE_ENTITLMENT' => $leave_entitlement_status,
                            'LEAVE_DATE' => $leave_date . '<br/>' . $start_time . ' - ' . $end_time,
                            'LEAVE_STATUS' => $leave_status_name,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-leave" data-leave-id="'. $leave_id .'" title="View Leave">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $approve .'
                                '. $reject .'
                                '. $cancel .'
                                '. $transaction_log .'
                                '. $delete .'
                            </div>'
                        );
                    }
    
                    echo json_encode($response);
                }
                else{
                    echo $sql->errorInfo()[2];
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Employee file management table
    else if($type == 'employee file management table'){
        if(isset($_POST['filter_department']) && isset($_POST['filter_file_category']) && isset($_POST['filter_file_start_date']) && isset($_POST['filter_file_end_date']) && isset($_POST['filter_upload_start_date']) && isset($_POST['filter_upload_end_date'])){
            if ($api->databaseConnection()) {
                # Get permission
                $update_employee_file = $api->check_role_permissions($username, 135);
                $delete_employee_file = $api->check_role_permissions($username, 136);
                $view_transaction_log = $api->check_role_permissions($username, 137);

                $filter_department = $_POST['filter_department'];
                $filter_file_category = $_POST['filter_file_category'];
                $filter_file_start_date = $api->check_date('empty', $_POST['filter_file_start_date'], '', 'Y-m-d', '', '', '');
                $filter_file_end_date = $api->check_date('empty', $_POST['filter_file_end_date'], '', 'Y-m-d', '', '', '');
                $filter_upload_start_date = $api->check_date('empty', $_POST['filter_upload_start_date'], '', 'Y-m-d', '', '', '');
                $filter_upload_end_date = $api->check_date('empty', $_POST['filter_upload_end_date'], '', 'Y-m-d', '', '', '');
                $filter_date_range = date('Y-m-d', strtotime($system_date. ' - 1 month'));

                $query = 'SELECT FILE_ID, EMPLOYEE_ID, FILE_NAME, FILE_CATEGORY, REMARKS, FILE_DATE, FILE_PATH, TRANSACTION_LOG_ID FROM tblemployeefile WHERE ';
    
                if(!empty($filter_department) || (!empty($filter_file_start_date) && !empty($filter_file_end_date)) || !empty($filter_upload_start_date) && !empty($filter_upload_end_date) || !empty($filter_file_category)){
                    if(!empty($filter_department)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = :filter_department)';
                    }

                    if(!empty($filter_file_start_date) && !empty($filter_file_end_date)){
                        $filter[] = 'FILE_DATE BETWEEN :filter_file_start_date AND :filter_file_end_date';
                    }

                    if(!empty($filter_upload_start_date) && !empty($filter_upload_end_date)){
                        $filter[] = 'UPLOAD_DATE BETWEEN :filter_upload_start_date AND :filter_upload_end_date';
                    }

                    if(!empty($filter_file_category)){
                        $filter[] = 'FILE_CATEGORY = :filter_file_category';
                    }
                }
                else{
                    $filter[] = 'FILE_DATE BETWEEN :filter_date_range AND :system_date';
                }                
    
                if(!empty($filter)){
                    $query .= implode(' AND ', $filter);
                }
    
                $sql = $api->db_connection->prepare($query);

                if(!empty($filter_department) || (!empty($filter_file_start_date) && !empty($filter_file_end_date)) || !empty($filter_upload_start_date) && !empty($filter_upload_end_date) || !empty($filter_file_category)){
                    if(!empty($filter_department)){
                        $sql->bindValue(':filter_department', $filter_department);
                    }

                    if(!empty($filter_file_start_date) && !empty($filter_file_end_date)){
                        $sql->bindValue(':filter_file_start_date', $filter_file_start_date);
                        $sql->bindValue(':filter_file_end_date', $filter_file_end_date);
                    }

                    if(!empty($filter_upload_start_date) && !empty($filter_upload_end_date)){
                        $sql->bindValue(':filter_upload_start_date', $filter_upload_start_date);
                        $sql->bindValue(':filter_upload_end_date', $filter_upload_end_date);
                    }

                    if(!empty($filter_file_category)){
                        $sql->bindValue(':filter_file_category', $filter_file_category);
                    }
                }
                else{
                    $sql->bindValue(':filter_date_range', $filter_date_range);
                    $sql->bindValue(':system_date', $system_date);
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $file_id = $row['FILE_ID'];
                        $employee_id = $row['EMPLOYEE_ID'];
                        $file_name = $row['FILE_NAME'];
                        $file_category = $row['FILE_CATEGORY'];
                        $remarks = $row['REMARKS'];
                        $file_date = $api->check_date('empty', $row['FILE_DATE'], '', 'm/d/Y', '', '', '');
                        $file_path = $row['FILE_PATH'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
    
                        $employee_details = $api->get_employee_details($employee_id, '');
                        $file_as = $employee_details[0]['FILE_AS'];
    
                        $system_code_details = $api->get_system_code_details('FILECATEGORY', $file_category);
                        $file_category_name = $system_code_details[0]['DESCRIPTION'];
    
                        if($update_employee_file > 0){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-employee-file-management" data-file-id="'. $file_id .'" title="Edit Employee File">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }
    
                        if($delete_employee_file > 0){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-employee-file-management" data-file-id="'. $file_id .'" title="Delete Employee File">
                                        <i class="bx bx-trash font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $delete = '';
                        }
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }
    
                        $response[] = array(
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $file_id .'">',
                            'FILE_AS' => $file_as,
                            'FILE_NAME' => '<a href="'. $file_path .'" target="_blank">' . $file_name . '</a>' . '<p class="text-muted mb-0">'. $remarks .'</p>',
                            'FILE_DATE' => $file_date,
                            'FILE_CATEGORY' => $file_category_name,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-employee-file" data-file-id="'. $file_id .'" title="View Employee File">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $update .'
                                '. $transaction_log .'
                                '. $delete .'
                            </div>'
                        );
                    }
    
                    echo json_encode($response);
                }
                else{
                    echo $sql->errorInfo()[2];
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Employee file table
    else if($type == 'employee file table'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id'])){
            if ($api->databaseConnection()) {
                # Get permission
                $update_employee_file = $api->check_role_permissions($username, 140);
                $delete_employee_file = $api->check_role_permissions($username, 141);
                $view_transaction_log = $api->check_role_permissions($username, 142);

                $employee_id = $_POST['employee_id'];
    
                $sql = $api->db_connection->prepare('SELECT FILE_ID, EMPLOYEE_ID, FILE_NAME, FILE_CATEGORY, REMARKS, FILE_DATE, FILE_PATH, TRANSACTION_LOG_ID FROM tblemployeefile WHERE EMPLOYEE_ID = :employee_id');
                $sql->bindValue(':employee_id', $employee_id);
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $file_id = $row['FILE_ID'];
                        $employee_id = $row['EMPLOYEE_ID'];
                        $file_name = $row['FILE_NAME'];
                        $file_category = $row['FILE_CATEGORY'];
                        $remarks = $row['REMARKS'];
                        $file_date = $api->check_date('empty', $row['FILE_DATE'], '', 'm/d/Y', '', '', '');
                        $file_path = $row['FILE_PATH'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
    
                        $employee_details = $api->get_employee_details($employee_id, '');
                        $file_as = $employee_details[0]['FILE_AS'];
    
                        $system_code_details = $api->get_system_code_details('FILECATEGORY', $file_category);
                        $file_category_name = $system_code_details[0]['DESCRIPTION'];
    
                        if($update_employee_file > 0){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-employee-file" data-file-id="'. $file_id .'" title="Edit Employee File">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }
    
                        if($delete_employee_file > 0){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-employee-file" data-file-id="'. $file_id .'" title="Delete Employee File">
                                        <i class="bx bx-trash font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $delete = '';
                        }
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }
    
                        $response[] = array(
                            'FILE_NAME' => '<a href="'. $file_path .'" target="_blank">' . $file_name . '</a>' . '<p class="text-muted mb-0">'. $remarks .'</p>',
                            'FILE_DATE' => $file_date,
                            'FILE_CATEGORY' => $file_category_name,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-employee-file" data-file-id="'. $file_id .'" title="View Employee File">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $update .'
                                '. $transaction_log .'
                                '. $delete .'
                            </div>'
                        );
                    }
    
                    echo json_encode($response);
                }
                else{
                    echo $sql->errorInfo()[2];
                }
            }
        }
    }
    # -------------------------------------------------------------

    # User account table
    else if($type == 'user account table'){
        if(isset($_POST['filter_user_account_lock_status']) && isset($_POST['filter_department']) && isset($_POST['filter_user_account_status']) && isset($_POST['filter_start_date']) && isset($_POST['filter_end_date'])){
            if ($api->databaseConnection()) {
                # Get permission
                $update_user_account = $api->check_role_permissions($username, 145);
                $lock_user_account = $api->check_role_permissions($username, 146);
                $unlock_user_account = $api->check_role_permissions($username, 147);
                $activate_user_account = $api->check_role_permissions($username, 148);
                $deactivate_user_account = $api->check_role_permissions($username, 149);
                $view_transaction_log = $api->check_role_permissions($username, 150);

                $filter_user_account_lock_status = $_POST['filter_user_account_lock_status'];
                $filter_department = $_POST['filter_department'];
                $filter_user_account_status = $_POST['filter_user_account_status'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');

                $query = 'SELECT USERNAME, ACTIVE, PASSWORD_EXPIRY_DATE, FAILED_LOGIN, TRANSACTION_LOG_ID FROM tbluseraccount';

                if(!empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date)) || $filter_user_account_status != '' || !empty($filter_user_account_lock_status)){
                    $query .= ' WHERE ';

                    if(!empty($filter_department)){
                        $filter[] = 'USERNAME IN (SELECT USERNAME FROM tblemployee WHERE DEPARTMENT = :filter_department)';
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $filter[] = 'PASSWORD_EXPIRY_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if($filter_user_account_lock_status == 'locked'){
                        $filter[] = 'FAILED_LOGIN >= 5';
                    }
                    else {
                        $filter[] = 'FAILED_LOGIN < 5';
                    }

                    if($filter_user_account_status != ''){
                        $filter[] = 'ACTIVE = :filter_user_account_status';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);

                if(!empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date)) || $filter_user_account_status != ''){
                    if(!empty($filter_department)){
                        $sql->bindValue(':filter_department', $filter_department);
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }

                    if($filter_user_account_status != ''){
                        $sql->bindValue(':filter_user_account_status', $filter_user_account_status);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $username = $row['USERNAME'];
                        $active = $row['ACTIVE'];
                        $password_expiry_date = $api->check_date('empty', $row['PASSWORD_EXPIRY_DATE'], '', 'm/d/Y', '', '', '');
                        $failed_login = $row['FAILED_LOGIN'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                        $lock_status = $api->get_user_account_lock_status($failed_login)[0]['BADGE'];
                        $account_status = $api->get_user_account_status($active)[0]['BADGE'];
                        $password_expiry_date_difference = $api->get_date_difference($system_date, $password_expiry_date);
                        $expiry_difference = 'Expiring in ' . $password_expiry_date_difference[0]['MONTHS'] . ' ' . $password_expiry_date_difference[0]['DAYS'];
    
                        $employee_details = $api->get_employee_details('', $username);
                        $file_as = $employee_details[0]['FILE_AS'] ?? $username;
    
                        if($update_user_account > 0){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-user-account" data-user-code="'. $username .'" title="Edit User Account">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }
    
                        if($failed_login >= 5){
                            if($unlock_user_account > 0){
                                $lock_unlock = '<button class="btn btn-info waves-effect waves-light unlock-user-account" title="Unlock User Account" data-user-code="'. $username .'">
                                <i class="bx bx-lock-open-alt font-size-16 align-middle"></i>
                                </button>';
                            }
                            else{
                                $lock_unlock = '';
                            }
    
                            $data_lock = '1';
                        }
                        else{
                            if($lock_user_account > 0){
                                $lock_unlock = '<button class="btn btn-warning waves-effect waves-light lock-user-account" title="Lock User Account" data-user-code="'. $username .'">
                                <i class="bx bx-lock-alt font-size-16 align-middle"></i>
                                </button>';
                            }
                            else{
                                $lock_unlock = '';
                            }
    
                            $data_lock = '0';
                        }
    
                        if($active == 1){
                            if($deactivate_user_account > 0){
                                $active_inactive = '<button class="btn btn-danger waves-effect waves-light deactivate-user-account" title="Deactivate User Account" data-user-code="'. $username .'">
                                <i class="bx bx-x font-size-16 align-middle"></i>
                                </button>';
                            }
                            else{
                                $active_inactive = '';
                            }
    
                            $data_active = '1';
                        }
                        else{
                            if($activate_user_account > 0){
                                $active_inactive = '<button class="btn btn-success waves-effect waves-light activate-user-account" title="Activate User Account" data-user-code="'. $username .'">
                                <i class="bx bx-user-check font-size-16 align-middle"></i>
                                </button>';
                            }
                            else{
                                $active_inactive = '';
                            }
    
                            $data_active = '0';
                        }
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }
    
                        $response[] = array(
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" data-lock="'. $data_lock .'" data-active="'. $data_active .'" value="'. $username .'">',
                            'FILE_AS' => $file_as . '<p class="text-muted mb-0">'. $username .'</p>',
                            'ACCOUNT_STATUS' => $account_status,
                            'LOCK_STATUS' => $lock_status,
                            'PASSWORD_EXPIRY_DATE' => $password_expiry_date . '<p class="text-muted mb-0">'. $expiry_difference .'</p>',
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-user-account" data-user-code="'. $username .'" title="View User Account">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $update .'
                                '. $active_inactive .'
                                '. $lock_unlock .'
                                '. $transaction_log .'
                            </div>'
                        );
                    }
    
                    echo json_encode($response);
                }
                else{
                    echo $sql->errorInfo()[2];
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Holiday table
    else if($type == 'holiday table'){
        if(isset($_POST['filter_start_date']) && isset($_POST['filter_end_date']) && isset($_POST['filter_holiday_type']) && isset($_POST['filter_branch'])){
            if ($api->databaseConnection()) {
                # Get permission
                $update_holiday = $api->check_role_permissions($username, 153);
                $delete_holiday = $api->check_role_permissions($username, 154);
                $view_transaction_log = $api->check_role_permissions($username, 155);

                $filter_holiday_type = $_POST['filter_holiday_type'];
                $filter_branch = $_POST['filter_branch'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');
                
                $query = 'SELECT HOLIDAY_ID, HOLIDAY, HOLIDAY_DATE, HOLIDAY_TYPE, TRANSACTION_LOG_ID FROM tblholiday';

                if(!empty($filter_holiday_type) || (!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_branch)){
                    $query .= ' WHERE ';

                    if(!empty($filter_holiday_type)){
                        $filter[] = 'HOLIDAY_TYPE = :filter_holiday_type';
                    }

                    if(!empty($filter_branch)){
                        $filter[] = 'HOLIDAY_ID IN (SELECT HOLIDAY_ID FROM tblholidaybranch WHERE BRANCH_ID = :filter_branch)';
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $filter[] = 'HOLIDAY_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);

                if(!empty($filter_holiday_type) || (!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_branch)){
                    if(!empty($filter_holiday_type)){
                        $sql->bindValue(':filter_holiday_type', $filter_holiday_type);
                    }

                    if(!empty($filter_branch)){
                        $sql->bindValue(':filter_branch', $filter_branch);
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $branch = '';
                        $holiday_id = $row['HOLIDAY_ID'];
                        $holiday = $row['HOLIDAY'];
                        $holiday_date = $api->check_date('empty', $row['HOLIDAY_DATE'], '', 'm/d/Y', '', '', '');
                        $holiday_type = $row['HOLIDAY_TYPE'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
    
                        $system_code_details = $api->get_system_code_details('HOLIDAYTYPE', $holiday_type);
                        $holiday_type_name = $system_code_details[0]['DESCRIPTION'];
    
                        $holiday_branch_details = $api->get_holiday_branch_details($holiday_id);
    
                        for($i = 0; $i < count($holiday_branch_details); $i++) {
                            $branch_id = $holiday_branch_details[$i]['BRANCH_ID'];
                            $branch_details = $api->get_branch_details($branch_id);
                            $branch .= $branch_details[0]['BRANCH'];
            
                            if($i != (count($holiday_branch_details)-1)){
                                $branch .= ', ';
                            }
                        }
    
                        if($update_holiday > 0){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-holiday" data-holiday-id="'. $holiday_id .'" title="Edit Holiday">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }
    
                        if($delete_holiday > 0){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-holiday" data-holiday-id="'. $holiday_id .'" title="Delete Holiday">
                                        <i class="bx bx-trash font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $delete = '';
                        }
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }
    
                        $response[] = array(
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $holiday_id .'">',
                            'HOLIDAY' => $holiday . '<p class="text-muted mb-0">'. $holiday_type_name .'</p>',
                            'HOLIDAY_DATE' => $holiday_date,
                            'BRANCH' => $branch,
                            'ACTION' => '<div class="d-flex gap-2">
                                '. $update .'
                                '. $transaction_log .'
                                '. $delete .'
                            </div>'
                        );
                    }
    
                    echo json_encode($response);
                }
                else{
                    echo $sql->errorInfo()[2];
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Attendance record table
    else if($type == 'attendance record table'){
        if(isset($_POST['filter_start_date']) && isset($_POST['filter_end_date']) && isset($_POST['filter_branch']) && isset($_POST['filter_department']) && isset($_POST['filter_time_in_behavior']) && isset($_POST['filter_time_out_behavior'])){
            if ($api->databaseConnection()) {

                # Get permission
                $update_attendance_record = $api->check_role_permissions($username, 162);
                $delete_attendance_record = $api->check_role_permissions($username, 163);
                $view_transaction_log = $api->check_role_permissions($username, 164);

                $filter_department = $_POST['filter_department'];
                $filter_branch = $_POST['filter_branch'];
                $filter_time_in_behavior = $_POST['filter_time_in_behavior'];
                $filter_time_out_behavior = $_POST['filter_time_out_behavior'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');

                $query = 'SELECT ATTENDANCE_ID, EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_IN_BEHAVIOR, TIME_OUT_DATE, TIME_OUT, TIME_OUT_BEHAVIOR, LATE, EARLY_LEAVING, OVERTIME, TOTAL_WORKING_HOURS, TRANSACTION_LOG_ID FROM tblattendancerecord';
    
                if(!empty($filter_department) || !empty($filter_branch) || (!empty($filter_start_date) && !empty($filter_end_date)) || $filter_time_in_behavior != '' || $filter_time_out_behavior != ''){
                    $query .= ' WHERE ';

                    if(!empty($filter_department)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = :filter_department)';
                    }

                    if(!empty($filter_branch)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE BRANCH = :filter_branch)';
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $filter[] = 'TIME_IN_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if($filter_time_in_behavior != ''){
                        $filter[] = 'TIME_IN_BEHAVIOR = :filter_time_in_behavior';
                    }

                    if($filter_time_out_behavior != ''){
                        $filter[] = 'TIME_OUT_BEHAVIOR = :filter_time_out_behavior';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);
                
                if(!empty($filter_department) || !empty($filter_branch) || (!empty($filter_start_date) && !empty($filter_end_date)) || $filter_time_in_behavior != '' || $filter_time_out_behavior != ''){
                    if(!empty($filter_department)){
                        $sql->bindValue(':filter_department', $filter_department);
                    }

                    if(!empty($filter_branch)){
                        $sql->bindValue(':filter_branch', $filter_branch);
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }

                    if($filter_time_in_behavior != ''){
                        $sql->bindValue(':filter_time_in_behavior', $filter_time_in_behavior);
                    }

                    if($filter_time_out_behavior != ''){
                        $sql->bindValue(':filter_time_out_behavior', $filter_time_out_behavior);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $attendance_id = $row['ATTENDANCE_ID'];
                        $employee_id = $row['EMPLOYEE_ID'];
                        $time_in_date = $api->check_date('empty', $row['TIME_IN_DATE'], '', 'm/d/Y', '', '', '');
                        $time_in = $api->check_date('empty', $row['TIME_IN'], '', 'h:i a', '', '', '');
                        $time_in_behavior = $api->get_time_in_behavior_status($row['TIME_IN_BEHAVIOR'])[0]['BADGE'];
                        $time_out_date = $api->check_date('empty', $row['TIME_OUT_DATE'], '', 'm/d/Y', '', '', '');
                        $time_out = $api->check_date('empty', $row['TIME_OUT'], '', 'h:i a', '', '', '');
                        $time_out_behavior = $api->get_time_out_behavior_status($row['TIME_OUT_BEHAVIOR'])[0]['BADGE'];
                        $late = number_format($row['LATE']);
                        $early_leaving = number_format($row['EARLY_LEAVING']);
                        $overtime = number_format($row['OVERTIME']);
                        $total_working_hours = number_format($row['TOTAL_WORKING_HOURS'], 2);
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                        $employee_details = $api->get_employee_details($employee_id, '');
                        $file_as = $employee_details[0]['FILE_AS'];
    
                        if($update_attendance_record > 0){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-attendance-record" data-attendance-id="'. $attendance_id .'" title="Edit Employee Attendance">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }
    
                        if($delete_attendance_record > 0){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-attendance-record" data-attendance-id="'. $attendance_id .'" title="Delete Employee Attendance">
                                        <i class="bx bx-trash font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $delete = '';
                        }
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }
    
                        $response[] = array(
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $attendance_id .'">',
                            'FILE_AS' => $file_as,
                            'TIME_IN' => $time_in_date . '<br/>' . $time_in,
                            'TIME_IN_BEHAVIOR' => $time_in_behavior,
                            'TIME_OUT' => $time_out_date . '<br/>' . $time_out,
                            'TIME_OUT_BEHAVIOR' => $time_out_behavior,
                            'LATE' => $late,
                            'EARLY_LEAVING' => $early_leaving,
                            'OVERTIME' => $overtime,
                            'TOTAL_WORKING_HOURS' => $total_working_hours,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-employee-attendance" data-attendance-id="'. $attendance_id .'" title="View Employee Attendance">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $update .'
                                '. $transaction_log .'
                                '. $delete .'
                            </div>'
                        );
                    }
    
                    echo json_encode($response);
                }
                else{
                    echo $sql->errorInfo()[2];
                }
            }
        }
    }
    # -------------------------------------------------------------

    # Employee attendance record table
    else if($type == 'employee attendance record table'){
        if(isset($_POST['filter_start_date']) && isset($_POST['filter_end_date']) && isset($_POST['filter_time_in_behavior']) && isset($_POST['filter_time_out_behavior'])){
            if ($api->databaseConnection()) {
                $employee_details = $api->get_employee_details('', $username);
                $employee_id = $employee_details[0]['EMPLOYEE_ID'];

                # Get permission
                $add_attendance_adjustment = $api->check_role_permissions($username, 173);
                $view_transaction_log = $api->check_role_permissions($username, 174);

                $filter_time_in_behavior = $_POST['filter_time_in_behavior'];
                $filter_time_out_behavior = $_POST['filter_time_out_behavior'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');

                $query = 'SELECT ATTENDANCE_ID, TIME_IN_DATE, TIME_IN, TIME_IN_BEHAVIOR, TIME_OUT_DATE, TIME_OUT, TIME_OUT_BEHAVIOR, LATE, EARLY_LEAVING, OVERTIME, TOTAL_WORKING_HOURS, TRANSACTION_LOG_ID FROM tblattendancerecord WHERE EMPLOYEE_ID = :employee_id AND ';
    
                if((!empty($filter_start_date) && !empty($filter_end_date)) || $filter_time_in_behavior != '' || $filter_time_out_behavior != ''){
                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $filter[] = 'TIME_IN_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if($filter_time_in_behavior != ''){
                        $filter[] = 'TIME_IN_BEHAVIOR = :filter_time_in_behavior';
                    }

                    if($filter_time_out_behavior != ''){
                        $filter[] = 'TIME_OUT_BEHAVIOR = :filter_time_out_behavior';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);

                $sql->bindValue(':employee_id', $employee_id);
                
                if((!empty($filter_start_date) && !empty($filter_end_date)) || $filter_time_in_behavior != '' || $filter_time_out_behavior != ''){
                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }

                    if($filter_time_in_behavior != ''){
                        $sql->bindValue(':filter_time_in_behavior', $filter_time_in_behavior);
                    }

                    if($filter_time_out_behavior != ''){
                        $sql->bindValue(':filter_time_out_behavior', $filter_time_out_behavior);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $attendance_id = $row['ATTENDANCE_ID'];
                        $time_in_date = $api->check_date('empty', $row['TIME_IN_DATE'], '', 'm/d/Y', '', '', '');
                        $time_in = $api->check_date('empty', $row['TIME_IN'], '', 'h:i a', '', '', '');
                        $time_in_behavior = $api->get_time_in_behavior_status($row['TIME_IN_BEHAVIOR'])[0]['BADGE'];
                        $time_out_date = $api->check_date('empty', $row['TIME_OUT_DATE'], '', 'm/d/Y', '', '', '');
                        $time_out = $api->check_date('empty', $row['TIME_OUT'], '', 'h:i a', '', '', '');
                        $time_out_behavior = $api->get_time_out_behavior_status($row['TIME_OUT_BEHAVIOR'])[0]['BADGE'];
                        $late = number_format($row['LATE']);
                        $early_leaving = number_format($row['EARLY_LEAVING']);
                        $overtime = number_format($row['OVERTIME']);
                        $total_working_hours = number_format($row['TOTAL_WORKING_HOURS'], 2);
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                        if($add_attendance_adjustment > 0){
                            if(!empty($time_out_date) && !empty($time_out)){
                                $attendance_adjustment = '<button type="button" class="btn btn-success waves-effect waves-light add-attendance-adjustment-full" data-attendance-id="'. $attendance_id .'" title="Add Attendance Adjustment">
                                    <i class="bx bx-time-five font-size-16 align-middle"></i>
                                </button>';
                            }
                            else{
                                $attendance_adjustment = '<button type="button" class="btn btn-success waves-effect waves-light add-attendance-adjustment-partial" data-attendance-id="'. $attendance_id .'" title="Add Attendance Adjustment">
                                    <i class="bx bx-time-five font-size-16 align-middle"></i>
                                </button>';
                            }
                        }
                        else{
                            $attendance_adjustment = '';
                        }
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }
    
                        $response[] = array(
                            'TIME_IN' => $time_in_date . '<br/>' . $time_in,
                            'TIME_IN_BEHAVIOR' => $time_in_behavior,
                            'TIME_OUT' => $time_out_date . '<br/>' . $time_out,
                            'TIME_OUT_BEHAVIOR' => $time_out_behavior,
                            'LATE' => $late,
                            'EARLY_LEAVING' => $early_leaving,
                            'OVERTIME' => $overtime,
                            'TOTAL_WORKING_HOURS' => $total_working_hours,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-employee-attendance" data-attendance-id="'. $attendance_id .'" title="View Employee Attendance">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $attendance_adjustment .'
                                '. $transaction_log .'
                            </div>'
                        );
                    }
    
                    echo json_encode($response);
                }
                else{
                    echo $sql->errorInfo()[2];
                }
            }
        }
    }
    # -------------------------------------------------------------

    # -------------------------------------------------------------
    #   Generate option functions
    # -------------------------------------------------------------

    # City options
    else if($type == 'city options'){
        if ($api->databaseConnection()) {
            if(isset($_POST['province']) && !empty($_POST['province'])){
                $province = $_POST['province'];
                
                $sql = $api->db_connection->prepare('CALL generate_city(:province)');
                $sql->bindParam(':province', $province);

                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $response[] = array(
                            'CITY_ID' => $row['CITY_ID'],
                            'CITY' => $row['CITY']
                        );
                    }

                    echo json_encode($response);
                }
                else{
                    echo $sql->errorInfo();
                }
            }
        }
    }
    # -------------------------------------------------------------
    
    # Employee work shift options
    else if($type == 'employee work shift options'){
        if ($api->databaseConnection()) {
            if(isset($_POST['work_shift_id']) && !empty($_POST['work_shift_id'])){
                $work_shift_id = $_POST['work_shift_id'];
                
                $sql = $api->db_connection->prepare('CALL generate_employee_work_shift(:work_shift_id)');
                $sql->bindParam(':work_shift_id', $work_shift_id);

                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $response[] = array(
                            'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                            'FILE_AS' => $row['FILE_AS']
                        );
                    }

                    echo json_encode($response);
                }
                else{
                    echo $sql->errorInfo();
                }
            }
        }
    }
    # -------------------------------------------------------------
}
?>