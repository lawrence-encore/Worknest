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

            if($form_type == 'change password form' || $form_type == 'change profile password form'){
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
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" name="email" class="form-control form-maxlength" maxlength="100" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Mobile Number <span class="required">*</span></label>
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
                                        </tr>
                                        <tr>
                                            <th scope="row">Tuesday</th>
                                            <td><input type="time" id="tuesday_start_time" name="tuesday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="tuesday_end_time" name="tuesday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="tuesday_lunch_start_time" name="tuesday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="tuesday_lunch_end_time" name="tuesday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="tuesday_half_day_mark" name="tuesday_half_day_mark" class="form-control" autocomplete="off"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Wednesday</th>
                                            <td><input type="time" id="wednesday_start_time" name="wednesday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="wednesday_end_time" name="wednesday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="wednesday_lunch_start_time" name="wednesday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="wednesday_lunch_end_time" name="wednesday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="wednesday_half_day_mark" name="wednesday_half_day_mark" class="form-control" autocomplete="off"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Thursday</th>
                                            <td><input type="time" id="thursday_start_time" name="thursday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="thursday_end_time" name="thursday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="thursday_lunch_start_time" name="thursday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="thursday_lunch_end_time" name="thursday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="thursday_half_day_mark" name="thursday_half_day_mark" class="form-control" autocomplete="off"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Friday</th>
                                            <td><input type="time" id="friday_start_time" name="friday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="friday_end_time" name="friday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="friday_lunch_start_time" name="friday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="friday_lunch_end_time" name="friday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="friday_half_day_mark" name="friday_half_day_mark" class="form-control" autocomplete="off"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Saturday</th>
                                            <td><input type="time" id="saturday_start_time" name="saturday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="saturday_end_time" name="saturday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="saturday_lunch_start_time" name="saturday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="saturday_lunch_end_time" name="saturday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="saturday_half_day_mark" name="saturday_half_day_mark" class="form-control" autocomplete="off"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Sunday</th>
                                            <td><input type="time" id="sunday_start_time" name="sunday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="sunday_end_time" name="sunday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="sunday_lunch_start_time" name="sunday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="sunday_lunch_end_time" name="sunday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="sunday_half_day_mark" name="sunday_half_day_mark" class="form-control" autocomplete="off"></td>
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
                                        </tr>
                                        <tr>
                                            <th scope="row">Tuesday</th>
                                            <td><input type="time" id="tuesday_start_time" name="tuesday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="tuesday_end_time" name="tuesday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="tuesday_lunch_start_time" name="tuesday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="tuesday_lunch_end_time" name="tuesday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="tuesday_half_day_mark" name="tuesday_half_day_mark" class="form-control" autocomplete="off"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Wednesday</th>
                                            <td><input type="time" id="wednesday_start_time" name="wednesday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="wednesday_end_time" name="wednesday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="wednesday_lunch_start_time" name="wednesday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="wednesday_lunch_end_time" name="wednesday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="wednesday_half_day_mark" name="wednesday_half_day_mark" class="form-control" autocomplete="off"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Thursday</th>
                                            <td><input type="time" id="thursday_start_time" name="thursday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="thursday_end_time" name="thursday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="thursday_lunch_start_time" name="thursday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="thursday_lunch_end_time" name="thursday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="thursday_half_day_mark" name="thursday_half_day_mark" class="form-control" autocomplete="off"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Friday</th>
                                            <td><input type="time" id="friday_start_time" name="friday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="friday_end_time" name="friday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="friday_lunch_start_time" name="friday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="friday_lunch_end_time" name="friday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="friday_half_day_mark" name="friday_half_day_mark" class="form-control" autocomplete="off"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Saturday</th>
                                            <td><input type="time" id="saturday_start_time" name="saturday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="saturday_end_time" name="saturday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="saturday_lunch_start_time" name="saturday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="saturday_lunch_end_time" name="saturday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="saturday_half_day_mark" name="saturday_half_day_mark" class="form-control" autocomplete="off"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Sunday</th>
                                            <td><input type="time" id="sunday_start_time" name="sunday_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="sunday_end_time" name="sunday_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="sunday_lunch_start_time" name="sunday_lunch_start_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="sunday_lunch_end_time" name="sunday_lunch_end_time" class="form-control" autocomplete="off"></td>
                                            <td><input type="time" id="sunday_half_day_mark" name="sunday_half_day_mark" class="form-control" autocomplete="off"></td>
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
                                    <select class="form-control form-select2" multiple="multiple" id="employee" name="employee">';
                                    $form .= $api->generate_active_employee_options();
                                    $form .='</select>
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
                                        <select class="form-control form-select2" multiple="multiple" id="employee" name="employee">';
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
                                            <option value="PEN">Pending</option>
                                            <option value="APV">Approved</option>
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
            else if($form_type == 'approve leave form' || $form_type == 'reject leave form' || $form_type == 'cancel leave form' || $form_type == 'approve multiple leave form' || $form_type == 'reject multiple leave form' || $form_type == 'cancel multiple leave form' || $form_type == 'approve employee leave form' || $form_type == 'reject employee leave form' || $form_type == 'cancel employee leave form'){
                if($form_type == 'approve leave form' || $form_type == 'approve multiple leave form' || $form_type == 'approve employee leave form'){
                    $label = 'Approval Remarks';
                }
                else if($form_type == 'reject leave form' || $form_type == 'reject multiple leave form' || $form_type == 'reject employee leave form'){
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
            else if($form_type == 'employee leave management form'){
                $form .= '<div class="row">
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
                                        <label for="leave_duration" class="form-label">Duration <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="leave_duration" name="leave_duration">
                                        <option value="">--</option>'; 
                                        $form .= $api->generate_system_code_options('LEAVEDURATION');
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
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
                                        <select class="form-control form-select2" multiple="multiple" id="branch" name="branch">';
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
            else if($form_type == 'reject attendance creation form' || $form_type == 'cancel attendance creation form' || $form_type == 'reject multiple attendance creation form' || $form_type == 'cancel multiple attendance creation form' || $form_type == 'reject attendance adjustment form' || $form_type == 'cancel attendance adjustment form' || $form_type == 'reject multiple attendance adjustment form' || $form_type == 'cancel multiple attendance adjustment form'){
                if($form_type == 'reject attendance creation form' || $form_type == 'reject multiple attendance creation form' || $form_type == 'reject attendance adjustment form' || $form_type == 'reject multiple attendance adjustment form'){
                    $label = 'Rejection Remarks <span class="required">*</span>';
                }
                else{
                    $label = 'Cancellation Remarks <span class="required">*</span>';
                }

                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="decision_remarks" class="form-label">'. $label .'</label>
                                        <input type="hidden" id="request_id" name="request_id">
                                        <textarea class="form-control form-maxlength" id="decision_remarks" name="decision_remarks" maxlength="500" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'approve attendance creation form' || $form_type == 'approve multiple attendance creation form' || $form_type == 'approve attendance adjustment form'  || $form_type == 'approve multiple attendance adjustment form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="decision_remarks" class="form-label">Sanction <span class="required">*</span></label>
                                        <input type="hidden" id="request_id" name="request_id">
                                        <select class="form-control form-select2" id="sanction" name="sanction">
                                            <option value="">--</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="decision_remarks" class="form-label">Approval Remarks</label>
                                        <textarea class="form-control form-maxlength" id="decision_remarks" name="decision_remarks" maxlength="500" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'allowance type form'){
                $form .= '<div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="allowance_type" class="form-label">Allowance Type <span class="required">*</span></label>
                                        <input type="hidden" id="allowance_type_id" name="allowance_type_id">
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="allowance_type" name="allowance_type" maxlength="100">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="taxable" class="form-label">Tax Type <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="taxable" name="taxable">
                                            <option value="">--</option>
                                            <option value="TAX">Taxable</option>
                                            <option value="NTAX">Non-Taxable</option>
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
            else if($form_type == 'allowance form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Employee <span class="required">*</span></label>
                                        <select class="form-control form-select2" multiple="multiple" id="employee_id" name="employee_id">';
                                        $form .= $api->generate_employee_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="allowance_type" class="form-label">Allowance Type <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="allowance_type" name="allowance_type">
                                        <option value="">--</option>'; 
                                        $form .= $api->generate_allowance_type_options();
                                        $form .='</select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Amount <span class="required">*</span></label>
                                        <input id="amount" name="amount" class="form-control" type="number" min="0.01" value="0" step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="recurrence" class="form-label">Recurrence</label>
                                        <input id="recurrence" name="recurrence" class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="recurrence_pattern" class="form-label">Recurrence Pattern</label>
                                        <select class="form-control form-select2" id="recurrence_pattern" name="recurrence_pattern">
                                        <option value="">--</option>'; 
                                        $form .= $api->generate_system_code_options('RECURRENCEPATTERN');
                                        $form .='</select>
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
                                        <label class="form-label">End Date</label>
                                        <div class="input-group" id="end-date-container">
                                            <input type="text" class="form-control" id="end_date" name="end_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#end-date-container" data-provide="datepicker" data-date-autoclose="true" disabled>
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'allowance update form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Employee <span class="required">*</span></label>
                                        <input type="hidden" id="allowance_id" name="allowance_id">
                                        <select class="form-control form-select2" id="employee_id" name="employee_id" disabled>
                                        <option value="">--</option>';
                                        $form .= $api->generate_employee_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="allowance_type" class="form-label">Allowance Type <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="allowance_type" name="allowance_type" disabled>
                                        <option value="">--</option>';
                                        $form .= $api->generate_allowance_type_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Amount <span class="required">*</span></label>
                                        <input id="amount" name="amount" class="form-control" type="number" min="0.01" value="0" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Payroll Date <span class="required">*</span></label>
                                        <div class="input-group" id="payroll-date-container">
                                            <input type="text" class="form-control" id="payroll_date" name="payroll_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#payroll-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'deduction type form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="deduction_type" class="form-label">Deduction Type <span class="required">*</span></label>
                                        <input type="hidden" id="deduction_type_id" name="deduction_type_id">
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="deduction_type" name="deduction_type" maxlength="100">
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
            else if($form_type == 'government contribution form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="government_contribution" class="form-label">Government Contribution <span class="required">*</span></label>
                                        <input type="hidden" id="government_contribution_id" name="government_contribution_id">
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="government_contribution" name="government_contribution" maxlength="100">
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
            else if($form_type == 'contribution bracket form'){
                $form .= '<div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="start_range" class="form-label">Start Range <span class="required">*</span></label>
                                        <input type="hidden" id="contribution_bracket_id" name="contribution_bracket_id">
                                        <input type="hidden" id="government_contribution_id" name="government_contribution_id">
                                        <input id="start_range" name="start_range" class="form-control" type="number" min="1" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="end_range" class="form-label">End Range <span class="required">*</span></label>
                                        <input id="end_range" name="end_range" class="form-control" type="number" min="1" step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="deduction_amount" class="form-label">Deduction Amount <span class="required">*</span></label>
                                        <input id="deduction_amount" name="deduction_amount" class="form-control" type="number" min="1" step="0.01">
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'deduction form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Employee <span class="required">*</span></label>
                                        <select class="form-control form-select2" multiple="multiple" id="employee_id" name="employee_id">';
                                        $form .= $api->generate_employee_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="deduction_type" class="form-label">Deduction Type <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="deduction_type" name="deduction_type">
                                        <option value="">--</option>'; 
                                        $form .= $api->generate_deduction_type_options();
                                        $form .='</select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Amount <span class="required">*</span></label>
                                        <input id="amount" name="amount" class="form-control" type="number" min="0.01" value="0" step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="recurrence" class="form-label">Recurrence</label>
                                        <input id="recurrence" name="recurrence" class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="recurrence_pattern" class="form-label">Recurrence Pattern</label>
                                        <select class="form-control form-select2" id="recurrence_pattern" name="recurrence_pattern">
                                        <option value="">--</option>'; 
                                        $form .= $api->generate_system_code_options('RECURRENCEPATTERN');
                                        $form .='</select>
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
                                        <label class="form-label">End Date</label>
                                        <div class="input-group" id="end-date-container">
                                            <input type="text" class="form-control" id="end_date" name="end_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#end-date-container" data-provide="datepicker" data-date-autoclose="true" disabled>
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'deduction update form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Employee <span class="required">*</span></label>
                                        <input type="hidden" id="deduction_id" name="deduction_id">
                                        <select class="form-control form-select2" id="employee_id" name="employee_id" disabled>
                                        <option value="">--</option>';
                                        $form .= $api->generate_employee_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="deduction_type" class="form-label">Deduction Type <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="deduction_type" name="deduction_type" disabled>
                                        <option value="">--</option>';
                                        $form .= $api->generate_deduction_type_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Amount <span class="required">*</span></label>
                                        <input id="amount" name="amount" class="form-control" type="number" min="0.01" value="0" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Payroll Date <span class="required">*</span></label>
                                        <div class="input-group" id="payroll-date-container">
                                            <input type="text" class="form-control" id="payroll_date" name="payroll_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#payroll-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'contribution deduction form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Employee <span class="required">*</span></label>
                                        <select class="form-control form-select2" multiple="multiple" id="employee_id" name="employee_id">';
                                        $form .= $api->generate_employee_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="government_contribution" class="form-label">Government Contribution <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="government_contribution" name="government_contribution">
                                        <option value="">--</option>'; 
                                        $form .= $api->generate_contribution_deduction_type_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="recurrence" class="form-label">Recurrence</label>
                                        <input id="recurrence" name="recurrence" class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="recurrence_pattern" class="form-label">Recurrence Pattern</label>
                                        <select class="form-control form-select2" id="recurrence_pattern" name="recurrence_pattern">
                                        <option value="">--</option>'; 
                                        $form .= $api->generate_system_code_options('RECURRENCEPATTERN');
                                        $form .='</select>
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
                                        <label class="form-label">End Date</label>
                                        <div class="input-group" id="end-date-container">
                                            <input type="text" class="form-control" id="end_date" name="end_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#end-date-container" data-provide="datepicker" data-date-autoclose="true" disabled>
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'contribution deduction update form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Employee <span class="required">*</span></label>
                                        <input type="hidden" id="contribution_deduction_id" name="contribution_deduction_id">
                                        <select class="form-control form-select2" id="employee_id" name="employee_id" disabled>
                                        <option value="">--</option>';
                                        $form .= $api->generate_employee_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="government_contribution" class="form-label">Government Contribution <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="government_contribution" name="government_contribution" disabled>
                                        <option value="">--</option>'; 
                                        $form .= $api->generate_contribution_deduction_type_options();
                                        $form .='</select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Payroll Date <span class="required">*</span></label>
                                        <div class="input-group" id="payroll-date-container">
                                            <input type="text" class="form-control" id="payroll_date" name="payroll_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#payroll-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'import employee form' || $form_type == 'import attendance record form' || $form_type == 'import leave entitlement form' || $form_type == 'import leave form' || $form_type == 'import attendance adjustment form' || $form_type == 'import attendance creation form' || $form_type == 'import allowance form' || $form_type == 'import deduction form' || $form_type == 'import government contribution form' || $form_type == 'import contribution bracket form' || $form_type == 'import contribution deduction form' || $form_type == 'import withholding tax form' || $form_type == 'import other income form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="import_file" class="form-label">Import File <span class="required">*</span></label><br/>
                                    <input class="form-control" type="file" name="import_file" id="import_file">
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'backup database form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="file_name" class="form-label">File Name <span class="required">*</span></label>
                                        <input type="text" class="form-control" autocomplete="off" id="file_name" name="file_name">
                                    </div>
                                </div>';
            }
            else if($form_type == 'salary form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Employee <span class="required">*</span></label>
                                        <select class="form-control form-select2" multiple="multiple" id="employee_id" name="employee_id">';
                                        $form .= $api->generate_employee_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Effectivity Date <span class="required">*</span></label>
                                        <div class="input-group" id="effectivity-date-container">
                                            <input type="text" class="form-control" id="effectivity_date" name="effectivity_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#effectivity-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="salary_amount" class="form-label">Salary Amount <span class="required">*</span></label>
                                        <input id="salary_amount" name="salary_amount" class="form-control" type="number" min="0.01" value="0" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="salary_frequency" class="form-label">Salary Frequency <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="salary_frequency" name="salary_frequency">
                                        <option value="">--</option>'; 
                                        $form .= $api->generate_system_code_options('SALARYFREQUENCY');
                                        $form .='</select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="hours_per_week" class="form-label">Hours Per Week <span class="required">*</span></label>
                                        <input id="hours_per_week" name="hours_per_week" class="form-control" type="number" min="1">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="hours_per_day" class="form-label">Hours Per Day <span class="required">*</span></label>
                                        <input id="hours_per_day" name="hours_per_day" class="form-control" type="number" min="1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="minute_rate" class="form-label">Minute Rate</label>
                                        <input type="text" class="form-control" autocomplete="off" id="minute_rate" name="minute_rate" value="0.00" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="hourly_rate" class="form-label">Hourly Rate</label>
                                        <input type="text" class="form-control" autocomplete="off" id="hourly_rate" name="hourly_rate" value="0.00" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="daily_rate" class="form-label">Daily Rate</label>
                                        <input type="text" class="form-control" autocomplete="off" id="daily_rate" name="daily_rate" value="0.00" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="weekly_rate" class="form-label">Weekly Rate</label>
                                        <input type="text" class="form-control" autocomplete="off" id="weekly_rate" name="weekly_rate" value="0.00" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="bi_weekly_rate" class="form-label">Bi-Weekly Rate</label>
                                        <input type="text" class="form-control" autocomplete="off" id="bi_weekly_rate" name="bi_weekly_rate" value="0.00" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="monthly_rate" class="form-label">Monthly Rate</label>
                                        <input type="text" class="form-control" autocomplete="off" id="monthly_rate" name="monthly_rate" value="0.00" readonly>
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
            else if($form_type == 'salary update form'){
                $form .= '<div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Employee <span class="required">*</span></label>
                                    <input type="hidden" id="salary_id" name="salary_id">
                                    <select class="form-control form-select2" id="employee_id" name="employee_id" disabled>';
                                    $form .= $api->generate_employee_options();
                                    $form .='</select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Effectivity Date <span class="required">*</span></label>
                                    <div class="input-group" id="effectivity-date-container">
                                        <input type="text" class="form-control" id="effectivity_date" name="effectivity_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#effectivity-date-container" data-provide="datepicker" data-date-autoclose="true">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="salary_amount" class="form-label">Salary Amount <span class="required">*</span></label>
                                    <input id="salary_amount" name="salary_amount" class="form-control" type="number" min="0.01" value="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="salary_frequency" class="form-label">Salary Frequency <span class="required">*</span></label>
                                    <select class="form-control form-select2" id="salary_frequency" name="salary_frequency">
                                    <option value="">--</option>'; 
                                    $form .= $api->generate_system_code_options('SALARYFREQUENCY');
                                    $form .='</select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="hours_per_week" class="form-label">Hours Per Week <span class="required">*</span></label>
                                    <input id="hours_per_week" name="hours_per_week" class="form-control" type="number" min="1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="hours_per_day" class="form-label">Hours Per Day <span class="required">*</span></label>
                                    <input id="hours_per_day" name="hours_per_day" class="form-control" type="number" min="1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="minute_rate" class="form-label">Minute Rate</label>
                                    <input type="text" class="form-control" autocomplete="off" id="minute_rate" name="minute_rate" value="0.00" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="hourly_rate" class="form-label">Hourly Rate</label>
                                    <input type="text" class="form-control" autocomplete="off" id="hourly_rate" name="hourly_rate" value="0.00" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="daily_rate" class="form-label">Daily Rate</label>
                                    <input type="text" class="form-control" autocomplete="off" id="daily_rate" name="daily_rate" value="0.00" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="weekly_rate" class="form-label">Weekly Rate</label>
                                    <input type="text" class="form-control" autocomplete="off" id="weekly_rate" name="weekly_rate" value="0.00" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="bi_weekly_rate" class="form-label">Bi-Weekly Rate</label>
                                    <input type="text" class="form-control" autocomplete="off" id="bi_weekly_rate" name="bi_weekly_rate" value="0.00" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="monthly_rate" class="form-label">Monthly Rate</label>
                                    <input type="text" class="form-control" autocomplete="off" id="monthly_rate" name="monthly_rate" value="0.00" readonly>
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
            else if($form_type == 'payroll group form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="payroll_group" class="form-label">Payroll Group <span class="required">*</span></label>
                                        <input type="hidden" id="payroll_group_id" name="payroll_group_id">
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="payroll_group" name="payroll_group" maxlength="100">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Employee <span class="required">*</span></label>
                                        <select class="form-control form-select2" multiple="multiple" id="employee_id" name="employee_id">';
                                        $form .= $api->generate_employee_options();
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
            else if($form_type == 'pay run form'){
                $form .= '<div class="row">
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
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Consider Overtime? <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="consider_overtime" name="consider_overtime">
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Consider Withholding Tax? <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="consider_withholding_tax" name="consider_withholding_tax">
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Payroll Group</label>
                                        <select class="form-control form-select2" multiple="multiple" id="payroll_group_id" name="payroll_group_id">';
                                        $form .= $api->generate_payroll_group_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Employee</label>
                                        <select class="form-control form-select2" multiple="multiple" id="employee_id" name="employee_id">';
                                        $form .= $api->generate_employee_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="payslip_note" class="form-label">Payslip Note </label>
                                        <textarea class="form-control form-maxlength" id="payslip_note" name="payslip_note" maxlength="500" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'send payslip form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Payee <span class="required">*</span></label>
                                    <input type="hidden" id="pay_run_id" name="pay_run_id">
                                    <select class="form-control form-select2" multiple="multiple" id="payee" name="payee">
                                    </select>
                                </div>
                            </div>';
            }
            else if($form_type == 'withholding tax form'){
                $form .= '<div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="salary_frequency" class="form-label">Salary Frequency <span class="required">*</span></label>
                                        <input type="hidden" id="withholding_tax_id" name="withholding_tax_id">
                                        <select class="form-control form-select2" id="salary_frequency" name="salary_frequency">
                                        <option value="">--</option>'; 
                                        $form .= $api->generate_system_code_options('SALARYFREQUENCY');
                                        $form .='</select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="start_range" class="form-label">Start Range <span class="required">*</span></label>
                                        <input id="start_range" name="start_range" class="form-control" type="number" min="1" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="end_range" class="form-label">End Range <span class="required">*</span></label>
                                        <input id="end_range" name="end_range" class="form-control" type="number" min="1" step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="fix_compensation_level" class="form-label">Fix Compensation Level <span class="required">*</span></label>
                                        <input id="fix_compensation_level" name="fix_compensation_level" class="form-control" type="number" min="0" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="base_tax" class="form-label">Base Tax <span class="required">*</span></label>
                                        <input id="base_tax" name="base_tax" class="form-control" type="number" min="0" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="percent_over" class="form-label">% Over <span class="required">*</span></label>
                                        <input id="percent_over" name="percent_over" class="form-control" type="number" min="0" step="0.01">
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'other income type form'){
                $form .= '<div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="other_income_type" class="form-label">Other Income Type <span class="required">*</span></label>
                                        <input type="hidden" id="other_income_type_id" name="other_income_type_id">
                                        <input type="text" class="form-control form-maxlength" autocomplete="off" id="other_income_type" name="other_income_type" maxlength="100">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="taxable" class="form-label">Tax Type <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="taxable" name="taxable">
                                            <option value="">--</option>
                                            <option value="TAX">Taxable</option>
                                            <option value="NTAX">Non-Taxable</option>
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
            else if($form_type == 'other income form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Employee <span class="required">*</span></label>
                                        <select class="form-control form-select2" multiple="multiple" id="employee_id" name="employee_id">';
                                        $form .= $api->generate_employee_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="other_income_type" class="form-label">Other Income Type <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="other_income_type" name="other_income_type">
                                        <option value="">--</option>'; 
                                        $form .= $api->generate_other_income_type_options();
                                        $form .='</select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Amount <span class="required">*</span></label>
                                        <input id="amount" name="amount" class="form-control" type="number" min="0.01" value="0" step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="recurrence" class="form-label">Recurrence</label>
                                        <input id="recurrence" name="recurrence" class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="recurrence_pattern" class="form-label">Recurrence Pattern</label>
                                        <select class="form-control form-select2" id="recurrence_pattern" name="recurrence_pattern">
                                        <option value="">--</option>'; 
                                        $form .= $api->generate_system_code_options('RECURRENCEPATTERN');
                                        $form .='</select>
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
                                        <label class="form-label">End Date</label>
                                        <div class="input-group" id="end-date-container">
                                            <input type="text" class="form-control" id="end_date" name="end_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#end-date-container" data-provide="datepicker" data-date-autoclose="true" disabled>
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'other income update form'){
                $form .= '<div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Employee <span class="required">*</span></label>
                                        <input type="hidden" id="other_income_id" name="other_income_id">
                                        <select class="form-control form-select2" id="employee_id" name="employee_id" disabled>
                                        <option value="">--</option>';
                                        $form .= $api->generate_employee_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="other_income_type" class="form-label">Allowance Type <span class="required">*</span></label>
                                        <select class="form-control form-select2" id="other_income_type" name="other_income_type" disabled>
                                        <option value="">--</option>';
                                        $form .= $api->generate_other_income_type_options();
                                        $form .='</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Amount <span class="required">*</span></label>
                                        <input id="amount" name="amount" class="form-control" type="number" min="0.01" value="0" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Payroll Date <span class="required">*</span></label>
                                        <div class="input-group" id="payroll-date-container">
                                            <input type="text" class="form-control" id="payroll_date" name="payroll_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#payroll-date-container" data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
            else if($form_type == 'job category form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="job_category" class="form-label">Job Category <span class="required">*</span></label>
                                    <input type="hidden" id="job_category_id" name="job_category_id">
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="job_category" name="job_category" maxlength="100">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span class="required">*</span></label>
                                    <textarea class="form-control form-maxlength" id="description" name="description" maxlength="100" rows="5"></textarea>
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'job type form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="job_type" class="form-label">Job Type <span class="required">*</span></label>
                                    <input type="hidden" id="job_type_id" name="job_type_id">
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="job_type" name="job_type" maxlength="100">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span class="required">*</span></label>
                                    <textarea class="form-control form-maxlength" id="description" name="description" maxlength="100" rows="5"></textarea>
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'recruitment pipeline form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="recruitment_pipeline" class="form-label">Recruitment Pipeline <span class="required">*</span></label>
                                    <input type="hidden" id="recruitment_pipeline_id" name="recruitment_pipeline_id">
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="recruitment_pipeline" name="recruitment_pipeline" maxlength="100">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span class="required">*</span></label>
                                    <textarea class="form-control form-maxlength" id="description" name="description" maxlength="100" rows="5"></textarea>
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'recruitment pipeline stage form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="recruitment_pipeline_stage" class="form-label">Recruitment Pipeline Stage <span class="required">*</span></label>
                                    <input type="hidden" id="recruitment_pipeline_stage_id" name="recruitment_pipeline_stage_id">
                                    <input type="hidden" id="recruitment_pipeline_id" name="recruitment_pipeline_id">
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="recruitment_pipeline_stage" name="recruitment_pipeline_stage" maxlength="100">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span class="required">*</span></label>
                                    <textarea class="form-control form-maxlength" id="description" name="description" maxlength="100" rows="5"></textarea>
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'recruitment scorecard form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="recruitment_scorecard" class="form-label">Recruitment Scorecard <span class="required">*</span></label>
                                    <input type="hidden" id="recruitment_scorecard_id" name="recruitment_scorecard_id">
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="recruitment_scorecard" name="recruitment_scorecard" maxlength="100">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span class="required">*</span></label>
                                    <textarea class="form-control form-maxlength" id="description" name="description" maxlength="100" rows="5"></textarea>
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'recruitment scorecard section form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="recruitment_scorecard_section" class="form-label">Recruitment Scorecard Section <span class="required">*</span></label>
                                    <input type="hidden" id="recruitment_scorecard_section_id" name="recruitment_scorecard_section_id">
                                    <input type="hidden" id="recruitment_scorecard_id" name="recruitment_scorecard_id">
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="recruitment_scorecard_section" name="recruitment_scorecard_section" maxlength="100">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span class="required">*</span></label>
                                    <textarea class="form-control form-maxlength" id="description" name="description" maxlength="100" rows="5"></textarea>
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'recruitment scorecard section option form'){
                $form .= '<div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="recruitment_scorecard_section_option" class="form-label">Recruitment Scorecard Section Option <span class="required">*</span></label>
                                    <input type="hidden" id="recruitment_scorecard_section_option_id" name="recruitment_scorecard_section_option_id">
                                    <input type="hidden" id="recruitment_scorecard_section_id" name="recruitment_scorecard_section_id">
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="recruitment_scorecard_section_option" name="recruitment_scorecard_section_option" maxlength="100">
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'job form'){
                $form .= '<div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="job_title" class="form-label">Job Title <span class="required">*</span></label>
                                    <input type="hidden" id="job_id" name="job_id">
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="job_title" name="job_title" maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="salary_amount" class="form-label">Salary Amount</label>
                                    <input id="salary_amount" name="salary_amount" class="form-control" type="number" min="0" value="0" step="0.01">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Job Category <span class="required">*</span></label>
                                    <select class="form-control form-select2" id="job_category" name="job_category">
                                    <option value="">--</option>';
                                    $form .= $api->generate_job_category_options();
                                    $form .='</select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Job Type <span class="required">*</span></label>
                                    <select class="form-control form-select2" id="job_type" name="job_type">
                                    <option value="">--</option>';
                                    $form .= $api->generate_job_type_options();
                                    $form .='</select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Recruitment Pipeline <span class="required">*</span></label>
                                    <select class="form-control form-select2" id="recruitment_pipeline" name="recruitment_pipeline">
                                    <option value="">--</option>';
                                    $form .= $api->generate_recruitment_pipeline_options();
                                    $form .='</select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Recruitment Scorecard <span class="required">*</span></label>
                                    <select class="form-control form-select2" id="recruitment_scorecard" name="recruitment_scorecard">
                                    <option value="">--</option>';
                                    $form .= $api->generate_recruitment_scorecard_options();
                                    $form .='</select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Team Members <span class="required">*</span></label>
                                    <select class="form-control form-select2" multiple="multiple" id="team_member" name="team_member">';
                                    $form .= $api->generate_employee_options();
                                    $form .='</select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Branch <span class="required">*</span></label>
                                    <select class="form-control form-select2" multiple="multiple" id="branch_id" name="branch_id">';
                                    $form .= $api->generate_branch_options();
                                    $form .='</select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span class="required">*</span></label>
                                    <textarea class="form-control form-maxlength" id="description" name="description" maxlength="30000" rows="5"></textarea>
                                </div>
                            </div>
                        </div>';
            }
            else if($form_type == 'job applicant form'){
                $form .= '<div class="row mb-3">
                                <label for="first_name" class="col-sm-3 col-form-label">First Name <span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="hidden" id="applicant_id" name="applicant_id">
                                    <input type="hidden" id="update" value="0">
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="first_name" name="first_name" maxlength="100">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="middle_name" class="col-sm-3 col-form-label">Middle Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="middle_name" name="middle_name" maxlength="100">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="last_name" class="col-sm-3 col-form-label">Last Name <span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="last_name" name="last_name" maxlength="100">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="suffix" class="col-sm-3 col-form-label">Suffix</label>
                                <div class="col-sm-9">
                                    <select class="form-control form-select2" id="suffix" name="suffix">
                                    <option value="">--</option>';
                                    $form .= $api->generate_system_code_options('SUFFIX');
                                    $form .='</select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="application_date" class="col-sm-3 col-form-label">Application Date <span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <div class="input-group" id="application-date-container">
                                        <input type="text" class="form-control application-date-date-picker" id="application_date" name="application_date" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#application-date-container" data-provide="datepicker" data-date-autoclose="true" data-end-date="-18y">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>      
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="birthday" class="col-sm-3 col-form-label">Birthday <span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <div class="input-group" id="birthday-container">
                                        <input type="text" class="form-control birthday-date-picker" id="birthday" name="birthday" autocomplete="off" data-date-format="m/dd/yyyy" data-date-container="#birthday-container" data-provide="datepicker" data-date-autoclose="true" data-end-date="-18y">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="gender" class="col-sm-3 col-form-label">Gender <span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control form-select2" id="gender" name="gender">
                                    <option value="">--</option>';
                                    $form .= $api->generate_system_code_options('GENDER');
                                    $form .='</select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="applicant_resume" class="col-sm-3 col-form-label">Applicant Resume</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="file" name="applicant_resume" id="applicant_resume">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input id="email" name="email" class="form-control form-maxlength" maxlength="100" autocomplete="off">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="phone" class="col-sm-3 col-form-label">Mobile Number <span class="required">*</span></label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control form-maxlength" autocomplete="off" id="phone" name="phone" maxlength="30">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="telephone" class="col-sm-3 col-form-label">Telephone</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-maxlength" autocomplete="off" id="telephone" name="telephone" maxlength="30">
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
                $element = '<table id="transaction-log-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th class="all">Log Type</th>
                                        <th class="all">Log</th>
                                        <th class="all">Log Date</th>
                                        <th class="all">Log By</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                            </table>';
            }
            else if($element_type == 'work shift regular details'){
                $element = '<table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Work Shift :</th>
                                        <td id="work_shift"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Description :</th>
                                        <td id="description"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Work Shift Type :</th>
                                        <td id="work_shift_type"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Monday :</th>
                                        <td id="monday"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tuesday :</th>
                                        <td id="tuesday"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Wednesday :</th>
                                        <td id="wednesday"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Thursday :</th>
                                        <td id="thursday"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Friday :</th>
                                        <td id="friday"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Saturday :</th>
                                        <td id="saturday"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Sunday :</th>
                                        <td id="sunday"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Assigned To :</th>
                                        <td id="assigned_to"></td>
                                    </tr>
                                </tbody>
                            </table>';
            }
            else if($element_type == 'work shift scheduled details'){
                $element = '<table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Work Shift :</th>
                                        <td id="work_shift"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Description :</th>
                                        <td id="description"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Work Shift Type :</th>
                                        <td id="work_shift_type"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Start Date :</th>
                                        <td id="start_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">End Date :</th>
                                        <td id="end_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Monday :</th>
                                        <td id="monday"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tuesday :</th>
                                        <td id="tuesday"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Wednesday :</th>
                                        <td id="wednesday"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Thursday :</th>
                                        <td id="thursday"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Friday :</th>
                                        <td id="friday"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Saturday :</th>
                                        <td id="saturday"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Sunday :</th>
                                        <td id="sunday"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Assigned To :</th>
                                        <td id="assigned_to"></td>
                                    </tr>
                                </tbody>
                            </table>';
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
                                    <tr>
                                        <th scope="row">Decision By :</th>
                                        <td id="decision_by"></td>
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
            else if($element_type == 'attendance creation details'){
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
                                        <th scope="row">Time Out Date :</th>
                                        <td id="time_out_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time Out :</th>
                                        <td id="time_out"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Attachment :</th>
                                        <td id="attachment"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Status :</th>
                                        <td id="creation_status"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Sanction :</th>
                                        <td id="creation_sanction"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Reason :</th>
                                        <td id="reason"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Request Date :</th>
                                        <td id="request_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Request Time :</th>
                                        <td id="request_time"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">For Recommendation Date :</th>
                                        <td id="for_recommendation_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">For Recommendation Time :</th>
                                        <td id="for_recommendation_time"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Recommendation Date :</th>
                                        <td id="recommendation_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Recommendation Time :</th>
                                        <td id="recommendation_time"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Recommendation By :</th>
                                        <td id="recommendation_by"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Decision Date :</th>
                                        <td id="decision_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Decision Time :</th>
                                        <td id="decision_time"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Decision Remarks :</th>
                                        <td id="decision_remarks"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Decision By :</th>
                                        <td id="decision_by"></td>
                                    </tr>
                                </tbody>
                            </table>';
            }
            else if($element_type == 'attendance adjustment details'){
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
                                        <th scope="row">Time In Date Adjustment :</th>
                                        <td id="time_in_date_adjustment"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time In :</th>
                                        <td id="time_in"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time In Adjustment :</th>
                                        <td id="time_in_adjustment"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time Out Date :</th>
                                        <td id="time_out_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time Out Date Adjustment :</th>
                                        <td id="time_out_date_adjustment"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time Out :</th>
                                        <td id="time_out"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Time Out Adjustment :</th>
                                        <td id="time_out_adjustment"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Attachment :</th>
                                        <td id="attachment"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Status :</th>
                                        <td id="adjustment_status"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Sanction :</th>
                                        <td id="adjustment_sanction"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Reason :</th>
                                        <td id="reason"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Request Date :</th>
                                        <td id="request_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Request Time :</th>
                                        <td id="request_time"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">For Recommendation Date :</th>
                                        <td id="for_recommendation_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">For Recommendation Time :</th>
                                        <td id="for_recommendation_time"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Recommendation Date :</th>
                                        <td id="recommendation_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Recommendation Time :</th>
                                        <td id="recommendation_time"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Recommendation By :</th>
                                        <td id="recommendation_by"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Decision Date :</th>
                                        <td id="decision_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Decision Time :</th>
                                        <td id="decision_time"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Decision Remarks :</th>
                                        <td id="decision_remarks"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Decision By :</th>
                                        <td id="decision_by"></td>
                                    </tr>
                                </tbody>
                            </table>';
            }
            else if($element_type == 'allowance details'){
                $element = '<table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Employee :</th>
                                        <td id="employee"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Allowance Type :</th>
                                        <td id="allowance_type"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Payroll :</th>
                                        <td id="payroll"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Payroll Date :</th>
                                        <td id="payroll_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Amount :</th>
                                        <td id="amount"></td>
                                    </tr>
                                </tbody>
                            </table>';
            }
            else if($element_type == 'other income details'){
                $element = '<table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Employee :</th>
                                        <td id="employee"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Other Income Type :</th>
                                        <td id="other_income_type"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Payroll :</th>
                                        <td id="payroll"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Payroll Date :</th>
                                        <td id="payroll_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Amount :</th>
                                        <td id="amount"></td>
                                    </tr>
                                </tbody>
                            </table>';
            }
            else if($element_type == 'deduction details'){
                $element = '<table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Employee :</th>
                                        <td id="employee"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Deduction Type :</th>
                                        <td id="deduction_type"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Payroll :</th>
                                        <td id="payroll"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Payroll Date :</th>
                                        <td id="payroll_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Amount :</th>
                                        <td id="amount"></td>
                                    </tr>
                                </tbody>
                            </table>';
            }
            else if($element_type == 'contribution deduction details'){
                $element = '<table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Employee :</th>
                                        <td id="employee"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Government Contribution Type :</th>
                                        <td id="government_contribution_type"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Payroll :</th>
                                        <td id="payroll"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Payroll Date :</th>
                                        <td id="payroll_date"></td>
                                    </tr>
                                </tbody>
                            </table>';
            }
            else if($element_type == 'attendance summary details'){
                $element = '<div class="row">
                                <div class="col-md-3">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link mb-2 active" id="v-pills-attendance-record-tab" data-bs-toggle="pill" href="#v-pills-attendance-record" role="tab" aria-controls="v-pills-attendance-record" aria-selected="true">Attendance Record</a>
                                        <a class="nav-link mb-2" id="v-pills-attendance-adjustment-tab" data-bs-toggle="pill" href="#v-pills-attendance-adjustment" role="tab" aria-controls="v-pills-attendance-adjustment" aria-selected="false">Attendance Adjustment</a>
                                        <a class="nav-link mb-2" id="v-pills-attendance-creation-tab" data-bs-toggle="pill" href="#v-pills-attendance-creation" role="tab" aria-controls="v-pills-attendance-creation" aria-selected="false">Attendance Creation</a>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-attendance-record" role="tabpanel" aria-labelledby="v-pills-attendance-record-tab">
                                            <table id="employee-attendance-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th class="all">Time In</th>
                                                        <th class="all">Behavior</th>
                                                        <th class="all">Time Out</th>
                                                        <th class="all">Behavior</th>
                                                        <th class="all">Late</th>
                                                        <th class="all">Early Leave</th>
                                                        <th class="all">Overtime</th>
                                                        <th class="all">Total Hours</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-attendance-adjustment" role="tabpanel" aria-labelledby="v-pills-attendance-adjustment-tab">
                                            <table id="attendance-adjustment-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th class="all">Time In Date</th>
                                                        <th class="all">Time In</th>
                                                        <th class="all">Time Out Date</th>
                                                        <th class="all">Time Out</th>
                                                        <th class="all">Status</th>
                                                        <th class="all">Attachment</th>
                                                        <th class="all">Reason</th>
                                                        <th class="all">Request Date</th>
                                                        <th class="all">For Recommendation Date</th>
                                                        <th class="all">Recommendation Date</th>
                                                        <th class="all">Recommendation By</th>
                                                        <th class="all">Approval Date</th>
                                                        <th class="all">Approval By</th>
                                                        <th class="all">Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-attendance-creation" role="tabpanel" aria-labelledby="v-pills-attendance-creation-tab">
                                            <table id="attendance-creation-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th class="all">Time In</th>
                                                        <th class="all">Time Out</th>
                                                        <th class="all">Status</th>
                                                        <th class="all">Attachment</th>
                                                        <th class="all">Reason</th>
                                                        <th class="all">Request Date</th>
                                                        <th class="all">For Recommendation Date</th>
                                                        <th class="all">Recommendation Date</th>
                                                        <th class="all">Recommendation By</th>
                                                        <th class="all">Approval Date</th>
                                                        <th class="all">Approval By</th>
                                                        <th class="all">Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
            else if($element_type == 'salary details'){
                $element = '<table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Employee :</th>
                                        <td id="employee"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Salary Amount :</th>
                                        <td id="salary_amount"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Salary Frequency :</th>
                                        <td id="salary_frequency"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Hours Per Week :</th>
                                        <td id="hours_per_week"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Hours Per Day :</th>
                                        <td id="hours_per_day"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Minute Rate :</th>
                                        <td id="minute_rate"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Hourly Rate :</th>
                                        <td id="hourly_rate"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Daily Rate :</th>
                                        <td id="daily_rate"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Weekly Rate :</th>
                                        <td id="weekly_rate"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Bi-Weekly Rate :</th>
                                        <td id="bi_weekly_rate"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Monthly Rate :</th>
                                        <td id="monthly_rate"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Effectivity Date :</th>
                                        <td id="effectivity_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Remarks :</th>
                                        <td id="remarks"></td>
                                    </tr>
                                </tbody>
                            </table>';
            }
            else if($element_type == 'payroll group details'){
                $element = '<table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Payroll Group :</th>
                                        <td id="payroll_group"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Description :</th>
                                        <td id="description"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Employee :</th>
                                        <td id="employee"></td>
                                    </tr>
                                </tbody>
                            </table>';
            }
            else if($element_type == 'pay run details'){
                $element = '<table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Pay Run ID :</th>
                                        <td id="pay_run_id"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Start Date :</th>
                                        <td id="start_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">End Date :</th>
                                        <td id="end_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Consider Overtime :</th>
                                        <td id="consider_overtime"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Consider Withholding Tax :</th>
                                        <td id="consider_withholding_tax"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Status :</th>
                                        <td id="pay_run_status"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Payslip Note :</th>
                                        <td id="payslip_note"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Generated Date :</th>
                                        <td id="generated_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Generated Time :</th>
                                        <td id="generated_time"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Generated By :</th>
                                        <td id="generated_by"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Payees :</th>
                                        <td id="payees"></td>
                                    </tr>
                                </tbody>
                            </table>';
            }
            else if($element_type == 'payslip details'){
                $element = '<div class="row">
                                <div class="col-lg-12">
                                    <div class="invoice-title">
                                        <h4 class="float-end font-size-16" id="payslip_id"># 1</h4>
                                            <div class="mb-4" id="company_logo"></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <address id="company_details"></address>
                                            </div>
                                            <div class="col-sm-6 text-sm-end">
                                                <address class="mt-2 mt-sm-0" id="generated_date">
                                                    <strong>Shipped To:</strong><br>
                                                    Kenny Rigdon<br>
                                                    1234 Main<br>
                                                    Apt. 4B<br>
                                                    Springfield, ST 54321
                                                </address>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <address id="employee_details"></address>
                                            </div>
                                            <div class="col-sm-6 text-sm-end">
                                                <address class="mt-2 mt-sm-0" id="payrun_details">
                                                    <strong>Shipped To:</strong><br>
                                                    Kenny Rigdon<br>
                                                    1234 Main<br>
                                                    Apt. 4B<br>
                                                    Springfield, ST 54321
                                                </address>
                                            </div>
                                        </div>
                                        <div class="py-0 mt-0">
                                            <h3 class="font-size-15 fw-bold">Earnings</h3>
                                        </div>
                                        <div class="table-responsive" id="earnings_table">
                                            <table class="table table-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 70px;">No.</th>
                                                        <th>Item</th>
                                                        <th class="text-end">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>01</td>
                                                        <td>Skote - Admin Dashboard Template</td>
                                                        <td class="text-end">$499.00</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>02</td>
                                                        <td>Skote - Landing Template</td>
                                                        <td class="text-end">$399.00</td>
                                                    </tr>

                                                    <tr>
                                                        <td>03</td>
                                                        <td>Veltrix - Admin Dashboard Template</td>
                                                        <td class="text-end">$499.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="text-end">Sub Total</td>
                                                        <td class="text-end">$1397.00</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="py-0 mt-0">
                                            <h3 class="font-size-15 fw-bold">Deductions</h3>
                                        </div>
                                        <div class="table-responsive" id="deductions_table">
                                            <table class="table table-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 70px;">No.</th>
                                                        <th>Item</th>
                                                        <th class="text-end">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>01</td>
                                                        <td>Skote - Admin Dashboard Template</td>
                                                        <td class="text-end">$499.00</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>02</td>
                                                        <td>Skote - Landing Template</td>
                                                        <td class="text-end">$399.00</td>
                                                    </tr>

                                                    <tr>
                                                        <td>03</td>
                                                        <td>Veltrix - Admin Dashboard Template</td>
                                                        <td class="text-end">$499.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="text-end">Sub Total</td>
                                                        <td class="text-end">$1397.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="border-0 text-end">
                                                            <strong>Net Pay</strong></td>
                                                        <td class="border-0 text-end"><h4 class="m-0">$1410.00</h4></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
            else if($element_type == 'job details'){
                $element = '<table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Job Title :</th>
                                        <td id="job_title"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Job Category :</th>
                                        <td id="job_category"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Job Type :</th>
                                        <td id="job_type"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pipeline :</th>
                                        <td id="pipeline"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Scorecard :</th>
                                        <td id="scorecard"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Salary :</th>
                                        <td id="salary"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Status :</th>
                                        <td id="job_status"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Description :</th>
                                        <td id="description"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Branch :</th>
                                        <td id="branch"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Team Members :</th>
                                        <td id="team_member"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Created Date :</th>
                                        <td id="created_date"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Created Time :</th>
                                        <td id="created_time"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Created By :</th>
                                        <td id="created_by"></td>
                                    </tr>
                                </tbody>
                            </table>';
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
                    $department_head = $row['DEPARTMENT_HEAD'] ?? null;
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                    $parent_department_details = $api->get_department_details($row['PARENT_DEPARTMENT']);
                    $parent_department = $parent_department_details[0]['DEPARTMENT'] ?? null;

                    $department_head_details = $api->get_employee_details($department_head, '');
                    $department_head_file_as = $department_head_details[0]['FILE_AS'] ?? null;

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
                        'DEPARTMENT_HEAD' => $department_head_file_as,
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
                        $color_value = $employment_status_details[0]['COLOR_VALUE'] ?? null;
                        $employment_status_description = $employment_status_details[0]['EMPLOYMENT_STATUS'];
    
                        $department_details = $api->get_department_details($department);
                        $department_name = $department_details[0]['DEPARTMENT'] ?? null;
    
                        $designation_details = $api->get_designation_details($designation);
                        $designation_name = $designation_details[0]['DESIGNATION'] ?? null;
    
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

    # Profile emergency contact table
    else if($type == 'profile emergency contact table'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id'])){
            if ($api->databaseConnection()) {
                $employee_id = $_POST['employee_id'];
    
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
    
                        $response[] = array(
                            'NAME' => $name . '<p class="text-muted mb-0">'. $relationship .'</p>',
                            'PHONE' => $phone,
                            'EMAIL' => $email,
                            'TELEPHONE' => $telephone,
                            'ADDRESS' => $address . ', ' . $city_name . ', ' . $province_name
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

    # Profile address table
    else if($type == 'profile address table'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id'])){
            if ($api->databaseConnection()) {
                $employee_id = $_POST['employee_id'];
    
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
    
                        $response[] = array(
                            'ADDRESS_TYPE' => $address_type,
                            'ADDRESS' => $address . ', ' . $city_name . ', ' . $province_name,
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

    # Profile social table
    else if($type == 'profile social table'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id'])){
            if ($api->databaseConnection()) {
                $employee_id = $_POST['employee_id'];
    
                $sql = $api->db_connection->prepare('SELECT SOCIAL_ID, SOCIAL_TYPE, LINK, TRANSACTION_LOG_ID FROM tblemployeesocial WHERE EMPLOYEE_ID = :employee_id');
                $sql->bindValue(':employee_id', $employee_id);
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $social_id = $row['SOCIAL_ID'];
                        $social_type = $api->get_system_code_details('SOCIAL', $row['SOCIAL_TYPE'])[0]['DESCRIPTION'] ?? null;
                        $link = $row['LINK'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
    
                        $response[] = array(
                            'SOCIAL_TYPE' => $social_type,
                            'LINK' => '<a href="'. $link .'">Visit Link</a>'
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

                    $check_work_shift_schedule_exist = $api->check_work_shift_schedule_exist($work_shift_id);

                    if($check_work_shift_schedule_exist > 0){
                        if($assign_work_shift > 0){
                            $assign = '<button type="button" class="btn btn-success waves-effect waves-light assign-work-shift" data-work-shift-id="'. $work_shift_id .'" title="Assign Work Shift">
                                            <i class="bx bx-user-plus font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $assign = '';
                        }
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
                            <button type="button" class="btn btn-primary waves-effect waves-light view-work-shift" data-work-shift-id="'. $work_shift_id .'" data-work-shift-type="'. $work_shift_type .'" title="View Work Shift">
                                <i class="bx bx-show font-size-16 align-middle"></i>
                            </button>
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
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['filter_attendance_record_start_date']) && isset($_POST['filter_attendance_record_end_date']) && isset($_POST['filter_attendance_record_time_in_behavior']) && isset($_POST['filter_attendance_record_time_out_behavior'])){
            if ($api->databaseConnection()) {
                $employee_id = $_POST['employee_id'];

                $filter_attendance_record_time_in_behavior = $_POST['filter_attendance_record_time_in_behavior'];
                $filter_attendance_record_time_out_behavior = $_POST['filter_attendance_record_time_out_behavior'];

                $filter_attendance_record_start_date = $api->check_date('empty', $_POST['filter_attendance_record_start_date'], '', 'Y-m-d', '', '', '');
                $filter_attendance_record_end_date = $api->check_date('empty', $_POST['filter_attendance_record_end_date'], '', 'Y-m-d', '', '', '');

                # Get permission
                $update_employee_attendance = $api->check_role_permissions($username, 101);
                $delete_employee_attendance = $api->check_role_permissions($username, 102);
                $view_transaction_log = $api->check_role_permissions($username, 103);

                $query = 'SELECT ATTENDANCE_ID, TIME_IN_DATE, TIME_IN, TIME_IN_BEHAVIOR, TIME_OUT_DATE, TIME_OUT, TIME_OUT_BEHAVIOR, LATE, EARLY_LEAVING, OVERTIME, TOTAL_WORKING_HOURS, TRANSACTION_LOG_ID FROM tblattendancerecord WHERE EMPLOYEE_ID = :employee_id';
    
                if((!empty($filter_attendance_record_start_date) && !empty($filter_attendance_record_end_date)) || !empty($filter_attendance_record_time_in_behavior) || !empty($filter_attendance_record_time_out_behavior)){
                    $query .= ' AND ';

                    if(!empty($filter_attendance_record_start_date) && !empty($filter_attendance_record_end_date)){
                        $filter[] = 'TIME_IN_DATE BETWEEN :filter_attendance_record_start_date AND :filter_attendance_record_end_date';
                    }

                    if(!empty($filter_attendance_record_time_in_behavior)){
                        $filter[] = 'TIME_IN_BEHAVIOR = :filter_attendance_record_time_in_behavior';
                    }

                    if(!empty($filter_attendance_record_time_out_behavior)){
                        $filter[] = 'TIME_OUT_BEHAVIOR = :filter_attendance_record_time_out_behavior';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);
                
                if((!empty($filter_attendance_record_start_date) && !empty($filter_attendance_record_end_date)) || !empty($filter_attendance_record_time_in_behavior) || !empty($filter_attendance_record_time_out_behavior)){
                    if(!empty($filter_attendance_record_start_date) && !empty($filter_attendance_record_end_date)){
                        $sql->bindValue(':filter_attendance_record_start_date', $filter_attendance_record_start_date);
                        $sql->bindValue(':filter_attendance_record_end_date', $filter_attendance_record_end_date);
                    }

                    if(!empty($filter_attendance_record_time_in_behavior)){
                        $sql->bindValue(':filter_attendance_record_time_in_behavior', $filter_attendance_record_time_in_behavior);
                    }

                    if(!empty($filter_attendance_record_time_out_behavior)){
                        $sql->bindValue(':filter_attendance_record_time_out_behavior', $filter_attendance_record_time_out_behavior);
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

    # Profile attendance table
    else if($type == 'profile attendance table'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['filter_attendance_record_start_date']) && isset($_POST['filter_attendance_record_end_date']) && isset($_POST['filter_attendance_record_time_in_behavior']) && isset($_POST['filter_attendance_record_time_out_behavior'])){
            if ($api->databaseConnection()) {
                $employee_id = $_POST['employee_id'];

                $filter_attendance_record_time_in_behavior = $_POST['filter_attendance_record_time_in_behavior'];
                $filter_attendance_record_time_out_behavior = $_POST['filter_attendance_record_time_out_behavior'];

                $filter_attendance_record_start_date = $api->check_date('empty', $_POST['filter_attendance_record_start_date'], '', 'Y-m-d', '', '', '');
                $filter_attendance_record_end_date = $api->check_date('empty', $_POST['filter_attendance_record_end_date'], '', 'Y-m-d', '', '', '');

                $query = 'SELECT ATTENDANCE_ID, TIME_IN_DATE, TIME_IN, TIME_IN_BEHAVIOR, TIME_OUT_DATE, TIME_OUT, TIME_OUT_BEHAVIOR, LATE, EARLY_LEAVING, OVERTIME, TOTAL_WORKING_HOURS, TRANSACTION_LOG_ID FROM tblattendancerecord WHERE EMPLOYEE_ID = :employee_id';
    
                if((!empty($filter_attendance_record_start_date) && !empty($filter_attendance_record_end_date)) || !empty($filter_attendance_record_time_in_behavior) || !empty($filter_attendance_record_time_out_behavior)){
                    $query .= ' AND ';

                    if(!empty($filter_attendance_record_start_date) && !empty($filter_attendance_record_end_date)){
                        $filter[] = 'TIME_IN_DATE BETWEEN :filter_attendance_record_start_date AND :filter_attendance_record_end_date';
                    }

                    if(!empty($filter_attendance_record_time_in_behavior)){
                        $filter[] = 'TIME_IN_BEHAVIOR = :filter_attendance_record_time_in_behavior';
                    }

                    if(!empty($filter_attendance_record_time_out_behavior)){
                        $filter[] = 'TIME_OUT_BEHAVIOR = :filter_attendance_record_time_out_behavior';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);
                
                if((!empty($filter_attendance_record_start_date) && !empty($filter_attendance_record_end_date)) || !empty($filter_attendance_record_time_in_behavior) || !empty($filter_attendance_record_time_out_behavior)){
                    if(!empty($filter_attendance_record_start_date) && !empty($filter_attendance_record_end_date)){
                        $sql->bindValue(':filter_attendance_record_start_date', $filter_attendance_record_start_date);
                        $sql->bindValue(':filter_attendance_record_end_date', $filter_attendance_record_end_date);
                    }

                    if(!empty($filter_attendance_record_time_in_behavior)){
                        $sql->bindValue(':filter_attendance_record_time_in_behavior', $filter_attendance_record_time_in_behavior);
                    }

                    if(!empty($filter_attendance_record_time_out_behavior)){
                        $sql->bindValue(':filter_attendance_record_time_out_behavior', $filter_attendance_record_time_out_behavior);
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

    # Leave type table
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

    # Leave entitlement table
    else if($type == 'leave entitlement table'){
        if(isset($_POST['filter_branch']) && isset($_POST['filter_department']) && isset($_POST['filter_leave_type']) && isset($_POST['filter_start_date']) && isset($_POST['filter_end_date'])){
            if ($api->databaseConnection()) {
                # Get permission
                $update_leave_entitlement = $api->check_role_permissions($username, 111);
                $delete_leave_entitlement = $api->check_role_permissions($username, 112);
                $view_transaction_log = $api->check_role_permissions($username, 113);

                $filter_branch = $_POST['filter_branch'];
                $filter_department = $_POST['filter_department'];
                $filter_leave_type = $_POST['filter_leave_type'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');
    
                $query = 'SELECT LEAVE_ENTITLEMENT_ID, EMPLOYEE_ID, LEAVE_TYPE, NO_LEAVES, ACQUIRED_LEAVES, START_DATE, END_DATE, TRANSACTION_LOG_ID FROM tblleaveentitlement';

                if(!empty($filter_branch) || !empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_leave_type)){
                    $query .= ' WHERE ';

                    if(!empty($filter_branch)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE BRANCH = :filter_branch)';
                    }

                    if(!empty($filter_department)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = :filter_department)';
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $filter[] = 'START_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if(!empty($filter_leave_type)){
                        $filter[] = 'LEAVE_TYPE = :filter_leave_type';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);

                if(!empty($filter_branch) || !empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_leave_type)){
                    if(!empty($filter_branch)){
                        $sql->bindValue(':filter_branch', $filter_branch);
                    }

                    if(!empty($filter_department)){
                        $sql->bindValue(':filter_department', $filter_department);
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }

                    if(!empty($filter_leave_type)){
                        $sql->bindValue(':filter_leave_type', $filter_leave_type);
                    }
                }
    
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
    }
    # -------------------------------------------------------------

    # Employee leave entitlement table
    else if($type == 'employee leave entitlement table'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['filter_leave_entitlement_start_date']) && isset($_POST['filter_leave_entitlement_end_date']) && isset($_POST['filter_leave_entitlement_leave_type'])){
            if ($api->databaseConnection()) {
                $employee_id = $_POST['employee_id'];

                $filter_leave_entitlement_leave_type = $_POST['filter_leave_entitlement_leave_type'];

                $filter_leave_entitlement_start_date = $api->check_date('empty', $_POST['filter_leave_entitlement_start_date'], '', 'Y-m-d', '', '', '');
                $filter_leave_entitlement_end_date = $api->check_date('empty', $_POST['filter_leave_entitlement_end_date'], '', 'Y-m-d', '', '', '');

                # Get permission
                $update_leave_entitlement = $api->check_role_permissions($username, 111);
                $delete_leave_entitlement = $api->check_role_permissions($username, 112);
                $view_transaction_log = $api->check_role_permissions($username, 113);

                $query = 'SELECT LEAVE_ENTITLEMENT_ID, LEAVE_TYPE, NO_LEAVES, ACQUIRED_LEAVES, START_DATE, END_DATE, TRANSACTION_LOG_ID FROM tblleaveentitlement WHERE EMPLOYEE_ID = :employee_id';
    
                if((!empty($filter_leave_entitlement_start_date) && !empty($filter_leave_entitlement_end_date)) || !empty($filter_leave_entitlement_leave_type)){
                    $query .= ' AND ';

                    if(!empty($filter_leave_entitlement_start_date) && !empty($filter_leave_entitlement_end_date)){
                        $filter[] = 'START_DATE BETWEEN :filter_leave_entitlement_start_date AND :filter_leave_entitlement_end_date';
                    }

                    if(!empty($filter_leave_entitlement_leave_type)){
                        $filter[] = 'LEAVE_TYPE = :filter_leave_entitlement_leave_type';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);
                
                if((!empty($filter_leave_entitlement_start_date) && !empty($filter_leave_entitlement_end_date)) || !empty($filter_leave_entitlement_leave_type)){
                    if(!empty($filter_leave_entitlement_start_date) && !empty($filter_leave_entitlement_end_date)){
                        $sql->bindValue(':filter_leave_entitlement_start_date', $filter_leave_entitlement_start_date);
                        $sql->bindValue(':filter_leave_entitlement_end_date', $filter_leave_entitlement_end_date);
                    }

                    if(!empty($filter_leave_entitlement_leave_type)){
                        $sql->bindValue(':filter_leave_entitlement_leave_type', $filter_leave_entitlement_leave_type);
                    }
                }
    
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

    # Profile leave entitlement table
    else if($type == 'profile leave entitlement table'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['filter_leave_entitlement_start_date']) && isset($_POST['filter_leave_entitlement_end_date']) && isset($_POST['filter_leave_entitlement_leave_type'])){
            if ($api->databaseConnection()) {
                $employee_id = $_POST['employee_id'];

                $filter_leave_entitlement_leave_type = $_POST['filter_leave_entitlement_leave_type'];

                $filter_leave_entitlement_start_date = $api->check_date('empty', $_POST['filter_leave_entitlement_start_date'], '', 'Y-m-d', '', '', '');
                $filter_leave_entitlement_end_date = $api->check_date('empty', $_POST['filter_leave_entitlement_end_date'], '', 'Y-m-d', '', '', '');

                $query = 'SELECT LEAVE_ENTITLEMENT_ID, LEAVE_TYPE, NO_LEAVES, ACQUIRED_LEAVES, START_DATE, END_DATE, TRANSACTION_LOG_ID FROM tblleaveentitlement WHERE EMPLOYEE_ID = :employee_id';
    
                if((!empty($filter_leave_entitlement_start_date) && !empty($filter_leave_entitlement_end_date)) || !empty($filter_leave_entitlement_leave_type)){
                    $query .= ' AND ';

                    if(!empty($filter_leave_entitlement_start_date) && !empty($filter_leave_entitlement_end_date)){
                        $filter[] = 'START_DATE BETWEEN :filter_leave_entitlement_start_date AND :filter_leave_entitlement_end_date';
                    }

                    if(!empty($filter_leave_entitlement_leave_type)){
                        $filter[] = 'LEAVE_TYPE = :filter_leave_entitlement_leave_type';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);
                
                if((!empty($filter_leave_entitlement_start_date) && !empty($filter_leave_entitlement_end_date)) || !empty($filter_leave_entitlement_leave_type)){
                    if(!empty($filter_leave_entitlement_start_date) && !empty($filter_leave_entitlement_end_date)){
                        $sql->bindValue(':filter_leave_entitlement_start_date', $filter_leave_entitlement_start_date);
                        $sql->bindValue(':filter_leave_entitlement_end_date', $filter_leave_entitlement_end_date);
                    }

                    if(!empty($filter_leave_entitlement_leave_type)){
                        $sql->bindValue(':filter_leave_entitlement_leave_type', $filter_leave_entitlement_leave_type);
                    }
                }
    
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
    
                        $response[] = array(
                            'LEAVE_NAME' => $leave_name,
                            'COVERAGE' => $start_date . ' - ' . $end_date,
                            'ENTITLEMENT' => $leave_entitlement_status
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

    # Leave management table
    else if($type == 'leave management table'){
        if(isset($_POST['filter_leave_status']) && isset($_POST['filter_branch']) && isset($_POST['filter_department']) && isset($_POST['filter_leave_type']) && isset($_POST['filter_start_date']) && isset($_POST['filter_end_date'])){
            if ($api->databaseConnection()) {
                # Get permission
                $delete_leave = $api->check_role_permissions($username, 121);
                $approve_leave = $api->check_role_permissions($username, 122);
                $reject_leave = $api->check_role_permissions($username, 123);
                $cancel_leave = $api->check_role_permissions($username, 124);
                $view_transaction_log = $api->check_role_permissions($username, 125);
    
                $filter_leave_status = $_POST['filter_leave_status'];
                $filter_branch = $_POST['filter_branch'];
                $filter_department = $_POST['filter_department'];
                $filter_leave_type = $_POST['filter_leave_type'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');
    
                $query = 'SELECT LEAVE_ID, EMPLOYEE_ID, LEAVE_TYPE, LEAVE_DATE, START_TIME, END_TIME, LEAVE_STATUS, TRANSACTION_LOG_ID FROM tblleave WHERE ';
    
                if(!empty($filter_branch) || !empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_leave_status) || !empty($filter_leave_type)){
                    if(!empty($filter_branch)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE BRANCH = :filter_branch)';
                    }

                    if(!empty($filter_department)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = :filter_department)';
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $filter[] = 'LEAVE_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if(!empty($filter_leave_type)){
                        $filter[] = 'LEAVE_TYPE = :filter_leave_type';
                    }

                    if(!empty($filter_leave_status)){
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

                if(!empty($filter_branch) || !empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_leave_status) || !empty($filter_leave_type)){
                    if(!empty($filter_branch)){
                        $sql->bindValue(':filter_branch', $filter_branch);
                    }

                    if(!empty($filter_department)){
                        $sql->bindValue(':filter_department', $filter_department);
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }

                    if(!empty($filter_leave_status)){
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
    
                        if($delete_leave > 0 && $leave_status == 'PEN'){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-leave" data-leave-id="'. $leave_id .'" title="Delete Leave">
                                        <i class="bx bx-trash font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $delete = '';
                        }
    
                        if($approve_leave > 0 && $leave_status == 'PEN'){
                            $approve = '<button type="button" class="btn btn-success waves-effect waves-light approve-leave" data-leave-id="'. $leave_id .'" title="Approve Leave">
                                        <i class="bx bx-check font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $approve = '';
                        }
    
                        if($reject_leave > 0 && $leave_status == 'PEN'){
                            $reject = '<button type="button" class="btn btn-danger waves-effect waves-light reject-leave" data-leave-id="'. $leave_id .'" title="Reject Leave">
                                        <i class="bx bx-x font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $reject = '';
                        }
    
                        if($cancel_leave > 0 && ($leave_status == 'APVSYS' || $leave_status == 'PEN' || ($leave_status == 'APV' && strtotime($system_date) < strtotime($leave_date)))){
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

                        if($leave_status == 'PEN' || $leave_status == 'APVSYS' || ($leave_status == 'APV' && strtotime($system_date) < strtotime($leave_date))){
                            if($leave_status == 'PEN'){
                                $data_approve_reject = 1;
                            }
                            else{
                                $data_approve_reject = 0;
                            }

                            $data_cancel = 1;

                            $check_box = '<input class="form-check-input datatable-checkbox-children" type="checkbox" data-cancel="'. $data_cancel .'" data-approve="'. $data_approve_reject .'" data-reject="'. $data_approve_reject .'" data-leave-status="'. $leave_status .'" value="'. $leave_id .'">';
                        }
                        else{
                            $check_box = '';
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

    # Employee leave table
    else if($type == 'employee leave table'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['filter_employee_leave_start_date']) && isset($_POST['filter_employee_leave_end_date']) && isset($_POST['filter_employee_leave_type']) && isset($_POST['filter_employee_leave_status'])){
            if ($api->databaseConnection()) {
                $employee_id = $_POST['employee_id'];

                $filter_employee_leave_type = $_POST['filter_employee_leave_type'];
                $filter_employee_leave_status = $_POST['filter_employee_leave_status'];

                $filter_employee_leave_start_date = $api->check_date('empty', $_POST['filter_employee_leave_start_date'], '', 'Y-m-d', '', '', '');
                $filter_employee_leave_end_date = $api->check_date('empty', $_POST['filter_employee_leave_end_date'], '', 'Y-m-d', '', '', '');

                # Get permission
                $delete_leave = $api->check_role_permissions($username, 128);
                $approve_leave = $api->check_role_permissions($username, 129);
                $reject_leave = $api->check_role_permissions($username, 130);
                $cancel_leave = $api->check_role_permissions($username, 131);
                $view_transaction_log = $api->check_role_permissions($username, 132);

                $query = 'SELECT LEAVE_ID, LEAVE_TYPE, LEAVE_DATE, START_TIME, END_TIME, LEAVE_STATUS, TRANSACTION_LOG_ID FROM tblleave WHERE EMPLOYEE_ID = :employee_id';
    
                if((!empty($filter_employee_leave_start_date) && !empty($filter_employee_leave_end_date)) || !empty($filter_employee_leave_type) || !empty($filter_employee_leave_status)){
                    $query .= ' AND ';

                    if(!empty($filter_employee_leave_start_date) && !empty($filter_employee_leave_end_date)){
                        $filter[] = 'LEAVE_DATE BETWEEN :filter_employee_leave_start_date AND :filter_employee_leave_end_date';
                    }

                    if(!empty($filter_employee_leave_type)){
                        $filter[] = 'LEAVE_TYPE = :filter_employee_leave_type';
                    }

                    if(!empty($filter_employee_leave_status)){
                        $filter[] = 'LEAVE_STATUS = :filter_employee_leave_status';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);
                
                if((!empty($filter_employee_leave_start_date) && !empty($filter_employee_leave_end_date)) || !empty($filter_employee_leave_type) || !empty($filter_employee_leave_status)){
                    if(!empty($filter_employee_leave_start_date) && !empty($filter_employee_leave_end_date)){
                        $sql->bindValue(':filter_employee_leave_start_date', $filter_employee_leave_start_date);
                        $sql->bindValue(':filter_employee_leave_end_date', $filter_employee_leave_end_date);
                    }

                    if(!empty($filter_employee_leave_type)){
                        $sql->bindValue(':filter_employee_leave_type', $filter_employee_leave_type);
                    }

                    if(!empty($filter_employee_leave_status)){
                        $sql->bindValue(':filter_employee_leave_status', $filter_employee_leave_status);
                    }
                }
    
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
    
                        if($cancel_leave > 0 && ($leave_status == 'APVSYS' || $leave_status == 'PEN' || ($leave_status == 'APV' && strtotime($system_date) < strtotime($leave_date)))){
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

    # Profile leave table
    else if($type == 'profile leave table'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['filter_employee_leave_start_date']) && isset($_POST['filter_employee_leave_end_date']) && isset($_POST['filter_employee_leave_type']) && isset($_POST['filter_employee_leave_status'])){
            if ($api->databaseConnection()) {
                $employee_id = $_POST['employee_id'];

                $filter_employee_leave_type = $_POST['filter_employee_leave_type'];
                $filter_employee_leave_status = $_POST['filter_employee_leave_status'];

                $filter_employee_leave_start_date = $api->check_date('empty', $_POST['filter_employee_leave_start_date'], '', 'Y-m-d', '', '', '');
                $filter_employee_leave_end_date = $api->check_date('empty', $_POST['filter_employee_leave_end_date'], '', 'Y-m-d', '', '', '');

                $query = 'SELECT LEAVE_ID, LEAVE_TYPE, LEAVE_DATE, START_TIME, END_TIME, LEAVE_STATUS, TRANSACTION_LOG_ID FROM tblleave WHERE EMPLOYEE_ID = :employee_id';
    
                if((!empty($filter_employee_leave_start_date) && !empty($filter_employee_leave_end_date)) || !empty($filter_employee_leave_type) || !empty($filter_employee_leave_status)){
                    $query .= ' AND ';

                    if(!empty($filter_employee_leave_start_date) && !empty($filter_employee_leave_end_date)){
                        $filter[] = 'LEAVE_DATE BETWEEN :filter_employee_leave_start_date AND :filter_employee_leave_end_date';
                    }

                    if(!empty($filter_employee_leave_type)){
                        $filter[] = 'LEAVE_TYPE = :filter_employee_leave_type';
                    }

                    if(!empty($filter_employee_leave_status)){
                        $filter[] = 'LEAVE_STATUS = :filter_employee_leave_status';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);
                
                if((!empty($filter_employee_leave_start_date) && !empty($filter_employee_leave_end_date)) || !empty($filter_employee_leave_type) || !empty($filter_employee_leave_status)){
                    if(!empty($filter_employee_leave_start_date) && !empty($filter_employee_leave_end_date)){
                        $sql->bindValue(':filter_employee_leave_start_date', $filter_employee_leave_start_date);
                        $sql->bindValue(':filter_employee_leave_end_date', $filter_employee_leave_end_date);
                    }

                    if(!empty($filter_employee_leave_type)){
                        $sql->bindValue(':filter_employee_leave_type', $filter_employee_leave_type);
                    }

                    if(!empty($filter_employee_leave_status)){
                        $sql->bindValue(':filter_employee_leave_status', $filter_employee_leave_status);
                    }
                }
    
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
    
                        $response[] = array(
                            'LEAVE_NAME' => $leave_name,
                            'LEAVE_ENTITLMENT' => $leave_entitlement_status,
                            'LEAVE_DATE' => $leave_date . '<br/>' . $start_time . ' - ' . $end_time,
                            'LEAVE_STATUS' => $leave_status_name,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-leave" data-leave-id="'. $leave_id .'" title="View Leave">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
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
        if(isset($_POST['filter_branch']) && isset($_POST['filter_department']) && isset($_POST['filter_file_category']) && isset($_POST['filter_file_start_date']) && isset($_POST['filter_file_end_date']) && isset($_POST['filter_upload_start_date']) && isset($_POST['filter_upload_end_date'])){
            if ($api->databaseConnection()) {
                # Get permission
                $update_employee_file = $api->check_role_permissions($username, 135);
                $delete_employee_file = $api->check_role_permissions($username, 136);
                $view_transaction_log = $api->check_role_permissions($username, 137);

                $filter_branch = $_POST['filter_branch'];
                $filter_department = $_POST['filter_department'];
                $filter_file_category = $_POST['filter_file_category'];
                $filter_file_start_date = $api->check_date('empty', $_POST['filter_file_start_date'], '', 'Y-m-d', '', '', '');
                $filter_file_end_date = $api->check_date('empty', $_POST['filter_file_end_date'], '', 'Y-m-d', '', '', '');
                $filter_upload_start_date = $api->check_date('empty', $_POST['filter_upload_start_date'], '', 'Y-m-d', '', '', '');
                $filter_upload_end_date = $api->check_date('empty', $_POST['filter_upload_end_date'], '', 'Y-m-d', '', '', '');

                $query = 'SELECT FILE_ID, EMPLOYEE_ID, FILE_NAME, FILE_CATEGORY, REMARKS, FILE_DATE, FILE_PATH, TRANSACTION_LOG_ID FROM tblemployeefile WHERE ';
    
                if(!empty($filter_branch) || !empty($filter_department) || (!empty($filter_file_start_date) && !empty($filter_file_end_date)) || !empty($filter_upload_start_date) && !empty($filter_upload_end_date) || !empty($filter_file_category)){
                    if(!empty($filter_branch)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE BRANCH = :filter_branch)';
                    }

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
    
                if(!empty($filter)){
                    $query .= implode(' AND ', $filter);
                }
    
                $sql = $api->db_connection->prepare($query);

                if(!empty($filter_branch) || !empty($filter_department) || (!empty($filter_file_start_date) && !empty($filter_file_end_date)) || !empty($filter_upload_start_date) && !empty($filter_upload_end_date) || !empty($filter_file_category)){
                    if(!empty($filter_branch)){
                        $sql->bindValue(':filter_branch', $filter_branch);
                    }

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
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['filter_employee_file_start_date']) && isset($_POST['filter_employee_file_end_date']) && isset($_POST['filter_upload_employee_file_start_date']) && isset($_POST['filter_upload_employee_file_end_date']) && isset($_POST['filter_employee_file_category'])){
            if ($api->databaseConnection()) {
                $employee_id = $_POST['employee_id'];

                $filter_employee_file_category = $_POST['filter_employee_file_category'];

                $filter_employee_file_start_date = $api->check_date('empty', $_POST['filter_employee_file_start_date'], '', 'Y-m-d', '', '', '');
                $filter_employee_file_end_date = $api->check_date('empty', $_POST['filter_employee_file_end_date'], '', 'Y-m-d', '', '', '');
                $filter_upload_employee_file_start_date = $api->check_date('empty', $_POST['filter_upload_employee_file_start_date'], '', 'Y-m-d', '', '', '');
                $filter_upload_employee_file_end_date = $api->check_date('empty', $_POST['filter_upload_employee_file_end_date'], '', 'Y-m-d', '', '', '');

                # Get permission
                $update_employee_file = $api->check_role_permissions($username, 140);
                $delete_employee_file = $api->check_role_permissions($username, 141);
                $view_transaction_log = $api->check_role_permissions($username, 142);

                $query = 'SELECT FILE_ID, EMPLOYEE_ID, FILE_NAME, FILE_CATEGORY, REMARKS, FILE_DATE, FILE_PATH, TRANSACTION_LOG_ID FROM tblemployeefile WHERE EMPLOYEE_ID = :employee_id';
    
                if((!empty($filter_employee_file_start_date) && !empty($filter_employee_file_end_date)) || (!empty($filter_upload_employee_file_start_date) && !empty($filter_upload_employee_file_end_date)) || !empty($filter_employee_file_category)){
                    $query .= ' AND ';

                    if(!empty($filter_employee_file_start_date) && !empty($filter_employee_file_end_date)){
                        $filter[] = 'FILE_DATE BETWEEN :filter_employee_file_start_date AND :filter_employee_file_end_date';
                    }

                    if(!empty($filter_upload_employee_file_start_date) && !empty($filter_upload_employee_file_end_date)){
                        $filter[] = 'UPLOAD_DATE BETWEEN :filter_upload_employee_file_start_date AND :filter_upload_employee_file_end_date';
                    }

                    if(!empty($filter_employee_file_category)){
                        $filter[] = 'FILE_CATEGORY = :filter_employee_file_category';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);

                if((!empty($filter_employee_file_start_date) && !empty($filter_employee_file_end_date)) || (!empty($filter_upload_employee_file_start_date) && !empty($filter_upload_employee_file_end_date)) || !empty($filter_employee_file_category)){
                    if(!empty($filter_employee_file_start_date) && !empty($filter_employee_file_end_date)){
                        $sql->bindValue(':filter_employee_file_start_date', $filter_employee_file_start_date);
                        $sql->bindValue(':filter_employee_file_end_date', $filter_employee_file_end_date);
                    }

                    if(!empty($filter_upload_employee_file_start_date) && !empty($filter_upload_employee_file_end_date)){
                        $sql->bindValue(':filter_upload_employee_file_start_date', $filter_upload_employee_file_start_date);
                        $sql->bindValue(':filter_upload_employee_file_end_date', $filter_upload_employee_file_end_date);
                    }

                    if(!empty($filter_employee_file_category)){
                        $sql->bindValue(':filter_employee_file_category', $filter_employee_file_category);
                    }
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

    # Profile file table
    else if($type == 'profile file table'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['filter_employee_file_start_date']) && isset($_POST['filter_employee_file_end_date']) && isset($_POST['filter_upload_employee_file_start_date']) && isset($_POST['filter_upload_employee_file_end_date']) && isset($_POST['filter_employee_file_category'])){
            if ($api->databaseConnection()) {
                $employee_id = $_POST['employee_id'];

                $filter_employee_file_category = $_POST['filter_employee_file_category'];

                $filter_employee_file_start_date = $api->check_date('empty', $_POST['filter_employee_file_start_date'], '', 'Y-m-d', '', '', '');
                $filter_employee_file_end_date = $api->check_date('empty', $_POST['filter_employee_file_end_date'], '', 'Y-m-d', '', '', '');
                $filter_upload_employee_file_start_date = $api->check_date('empty', $_POST['filter_upload_employee_file_start_date'], '', 'Y-m-d', '', '', '');
                $filter_upload_employee_file_end_date = $api->check_date('empty', $_POST['filter_upload_employee_file_end_date'], '', 'Y-m-d', '', '', '');

                $query = 'SELECT FILE_ID, EMPLOYEE_ID, FILE_NAME, FILE_CATEGORY, REMARKS, FILE_DATE, FILE_PATH, TRANSACTION_LOG_ID FROM tblemployeefile WHERE EMPLOYEE_ID = :employee_id';
    
                if((!empty($filter_employee_file_start_date) && !empty($filter_employee_file_end_date)) || (!empty($filter_upload_employee_file_start_date) && !empty($filter_upload_employee_file_end_date)) || !empty($filter_employee_file_category)){
                    $query .= ' AND ';

                    if(!empty($filter_employee_file_start_date) && !empty($filter_employee_file_end_date)){
                        $filter[] = 'FILE_DATE BETWEEN :filter_employee_file_start_date AND :filter_employee_file_end_date';
                    }

                    if(!empty($filter_upload_employee_file_start_date) && !empty($filter_upload_employee_file_end_date)){
                        $filter[] = 'UPLOAD_DATE BETWEEN :filter_upload_employee_file_start_date AND :filter_upload_employee_file_end_date';
                    }

                    if(!empty($filter_employee_file_category)){
                        $filter[] = 'FILE_CATEGORY = :filter_employee_file_category';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);

                if((!empty($filter_employee_file_start_date) && !empty($filter_employee_file_end_date)) || (!empty($filter_upload_employee_file_start_date) && !empty($filter_upload_employee_file_end_date)) || !empty($filter_employee_file_category)){
                    if(!empty($filter_employee_file_start_date) && !empty($filter_employee_file_end_date)){
                        $sql->bindValue(':filter_employee_file_start_date', $filter_employee_file_start_date);
                        $sql->bindValue(':filter_employee_file_end_date', $filter_employee_file_end_date);
                    }

                    if(!empty($filter_upload_employee_file_start_date) && !empty($filter_upload_employee_file_end_date)){
                        $sql->bindValue(':filter_upload_employee_file_start_date', $filter_upload_employee_file_start_date);
                        $sql->bindValue(':filter_upload_employee_file_end_date', $filter_upload_employee_file_end_date);
                    }

                    if(!empty($filter_employee_file_category)){
                        $sql->bindValue(':filter_employee_file_category', $filter_employee_file_category);
                    }
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
    
                        $response[] = array(
                            'FILE_NAME' => '<a href="'. $file_path .'" target="_blank">' . $file_name . '</a>' . '<p class="text-muted mb-0">'. $remarks .'</p>',
                            'FILE_DATE' => $file_date,
                            'FILE_CATEGORY' => $file_category_name,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-employee-file" data-file-id="'. $file_id .'" title="View Employee File">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
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
    
                if(!empty($filter_department) || !empty($filter_branch) || (!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_time_in_behavior) || !empty($filter_time_out_behavior)){
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

                    if(!empty($filter_time_in_behavior)){
                        $filter[] = 'TIME_IN_BEHAVIOR = :filter_time_in_behavior';
                    }

                    if(!empty($filter_time_out_behavior)){
                        $filter[] = 'TIME_OUT_BEHAVIOR = :filter_time_out_behavior';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);
                
                if(!empty($filter_department) || !empty($filter_branch) || (!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_time_in_behavior) || !empty($filter_time_out_behavior)){
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

                    if(!empty($filter_time_in_behavior)){
                        $sql->bindValue(':filter_time_in_behavior', $filter_time_in_behavior);
                    }

                    if(!empty($filter_time_out_behavior)){
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
                $employee_id = $employee_details[0]['EMPLOYEE_ID'] ?? null;

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

    # Attendance creation table
    else if($type == 'attendance creation table'){
        if(isset($_POST['filter_start_date']) && isset($_POST['filter_end_date']) && isset($_POST['filter_attendance_creation_status']) && isset($_POST['filter_attendance_creation_sanction'])){
            if ($api->databaseConnection()) {
                $employee_details = $api->get_employee_details('', $username);
                $employee_id = $employee_details[0]['EMPLOYEE_ID'] ?? null;

                # Get permission
                $update_attendance_creation = $api->check_role_permissions($username, 177);
                $delete_attendance_creation = $api->check_role_permissions($username, 178);
                $tag_attendance_creation_for_recommendation = $api->check_role_permissions($username, 179);
                $cancel_attendance_creation = $api->check_role_permissions($username, 180);
                $view_transaction_log = $api->check_role_permissions($username, 181);

                $filter_attendance_creation_status = $_POST['filter_attendance_creation_status'];
                $filter_attendance_creation_sanction = $_POST['filter_attendance_creation_sanction'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');

                $query = 'SELECT REQUEST_ID, TIME_IN_DATE, TIME_IN, TIME_OUT_DATE, TIME_OUT, STATUS, SANCTION, REASON, FILE_PATH, TRANSACTION_LOG_ID FROM tblattendancecreation WHERE EMPLOYEE_ID = :employee_id AND ';
    
                if((!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_attendance_creation_status) || $filter_attendance_creation_sanction != ''){
                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $filter[] = 'REQUEST_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if(!empty($filter_attendance_creation_status)){
                        $filter[] = 'STATUS = :filter_attendance_creation_status';
                    }

                    if($filter_attendance_creation_sanction != ''){
                        $filter[] = 'SANCTION = :filter_attendance_creation_sanction';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);
                
                if((!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_attendance_creation_status) || $filter_attendance_creation_sanction != ''){
                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }

                    if(!empty($filter_attendance_creation_status)){
                        $sql->bindValue(':filter_attendance_creation_status', $filter_attendance_creation_status);
                    }

                    if($filter_attendance_creation_sanction != ''){
                        $sql->bindValue(':filter_attendance_creation_sanction', $filter_attendance_creation_sanction);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $request_id = $row['REQUEST_ID'];
                        $time_in_date = $api->check_date('empty', $row['TIME_IN_DATE'], '', 'm/d/Y', '', '', '');
                        $time_in = $api->check_date('empty', $row['TIME_IN'], '', 'h:i a', '', '', '');
                        $time_out_date = $api->check_date('empty', $row['TIME_OUT_DATE'], '', 'm/d/Y', '', '', '');
                        $time_out = $api->check_date('empty', $row['TIME_OUT'], '', 'h:i a', '', '', '');
                        $status = $row['STATUS'];
                        $status_description = $api->get_attendance_creation_status($status)[0]['BADGE'];
                        $reason = $row['REASON'];
                        $file_path = $row['FILE_PATH'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                        if($update_attendance_creation > 0 && $status == 'PEN'){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-attendance-creation" data-request-id="'. $request_id .'" title="Edit Attendance Creation">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }

                        if($cancel_attendance_creation > 0 && ($status == 'PEN' || $status == 'REC' || $status == 'FRREC')){
                            $cancel = '<button type="button" class="btn btn-warning waves-effect waves-light cancel-attendance-creation" data-request-id="'. $request_id .'" title="Cancel Attendance Creation">
                                        <i class="bx bx-calendar-x font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $cancel = '';
                        }

                        if($tag_attendance_creation_for_recommendation > 0 && $status == 'PEN'){
                            $for_recommendation = '<button type="button" class="btn btn-success waves-effect waves-light for-recommend-attendance-creation" data-request-id="'. $request_id .'" title="Tag Attendance Creation For Recommendation">
                                        <i class="bx bx-check font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $for_recommendation = '';
                        }

                        if($delete_attendance_creation > 0 && $status == 'PEN'){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-attendance-creation" data-request-id="'. $request_id .'" title="Delete Attendance Creation">
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

                        if($status == 'PEN' || $status == 'REC' || $status == 'FRREC'){
                            $data_cancel = 1;

                            if($status == 'PEN'){
                                $data_for_recommendation = 1;
                                $data_delete = 1;
                            }
                            else{
                                $data_for_recommendation = 0;
                                $data_delete = 0;
                            }

                            $check_box = '<input class="form-check-input datatable-checkbox-children" data-cancel="'. $data_cancel .'" data-delete="'. $data_delete .'" data-for-recommendation="'. $data_for_recommendation .'" type="checkbox" value="'. $request_id .'">';
                        }
                        else{
                            $check_box = '';
                        }

                        if($status == 'APV'){
                            $sanction = $api->get_attendance_creation_sanction_status($row['SANCTION'])[0]['BADGE'];
                        }
                        else{
                            $sanction = '';
                        }
    
                        $response[] = array(
                            'CHECK_BOX' => $check_box,
                            'TIME_IN' => $time_in_date . '<br/>' . $time_in,
                            'TIME_OUT' => $time_out_date . '<br/>' . $time_out,
                            'STATUS' => $status_description,
                            'SANCTION' => $sanction,
                            'ATTACHMENT' => '<a href="'. $file_path .'" target="_blank">Attachment</a>',
                            'REASON' => $reason,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-attendance-creation" data-request-id="'. $request_id .'" title="View Attendance Creation">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $update .'
                                '. $for_recommendation .'
                                '. $cancel .'
                                '. $delete .'
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

    # Attendance adjustment table
    else if($type == 'attendance adjustment table'){
        if(isset($_POST['filter_start_date']) && isset($_POST['filter_end_date']) && isset($_POST['filter_attendance_adjustment_status']) && isset($_POST['filter_attendance_adjustment_sanction'])){
            if ($api->databaseConnection()) {
                $employee_details = $api->get_employee_details('', $username);
                $employee_id = $employee_details[0]['EMPLOYEE_ID'] ?? null;

                # Get permission
                $update_attendance_adjustment = $api->check_role_permissions($username, 183);
                $delete_attendance_adjustment = $api->check_role_permissions($username, 184);
                $tag_attendance_adjustment_for_recommendation = $api->check_role_permissions($username, 185);
                $cancel_attendance_adjustment = $api->check_role_permissions($username, 186);
                $view_transaction_log = $api->check_role_permissions($username, 187);

                $filter_attendance_adjustment_status = $_POST['filter_attendance_adjustment_status'];
                $filter_attendance_adjustment_sanction = $_POST['filter_attendance_adjustment_sanction'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');

                $query = 'SELECT REQUEST_ID, TIME_IN_DATE, TIME_IN, TIME_IN_DATE_ADJUSTED, TIME_IN_ADJUSTED, TIME_OUT_DATE, TIME_OUT, TIME_OUT_DATE_ADJUSTED, TIME_OUT_ADJUSTED, STATUS, SANCTION, REASON, FILE_PATH, TRANSACTION_LOG_ID FROM tblattendanceadjustment WHERE EMPLOYEE_ID = :employee_id AND ';
    
                if((!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_attendance_adjustment_status) || $filter_attendance_adjustment_sanction != ''){
                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $filter[] = 'REQUEST_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if(!empty($filter_attendance_adjustment_status)){
                        $filter[] = 'STATUS = :filter_attendance_adjustment_status';
                    }

                    if($filter_attendance_adjustment_sanction != ''){
                        $filter[] = 'SANCTION = :filter_attendance_adjustment_sanction';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);
                
                if((!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_attendance_adjustment_status) || $filter_attendance_adjustment_sanction != ''){
                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }

                    if(!empty($filter_attendance_adjustment_status)){
                        $sql->bindValue(':filter_attendance_adjustment_status', $filter_attendance_adjustment_status);
                    }

                    if($filter_attendance_adjustment_sanction != ''){
                        $sql->bindValue(':filter_attendance_adjustment_sanction', $filter_attendance_adjustment_sanction);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $request_id = $row['REQUEST_ID'];
                        $time_in_date = $api->check_date('empty', $row['TIME_IN_DATE'] ?? null, '', 'm/d/Y', '', '', '');
                        $time_in = $api->check_date('empty', $row['TIME_IN'] ?? null, '', 'h:i a', '', '', '');
                        $time_in_date_adjusted = $api->check_date('empty', $row['TIME_IN_DATE_ADJUSTED'] ?? null, '', 'm/d/Y', '', '', '');
                        $time_in_adjusted = $api->check_date('empty', $row['TIME_IN_ADJUSTED'] ?? null, '', 'h:i a', '', '', '');
                        $time_out_date = $api->check_date('empty', $row['TIME_OUT_DATE'] ?? null, '', 'm/d/Y', '', '', '');
                        $time_out = $api->check_date('empty', $row['TIME_OUT'] ?? null, '', 'h:i a', '', '', '');
                        $time_out_date_adjusted = $api->check_date('empty', $row['TIME_OUT_DATE_ADJUSTED'] ?? null, '', 'm/d/Y', '', '', '');
                        $time_out_adjusted = $api->check_date('empty', $row['TIME_OUT_ADJUSTED'] ?? null, '', 'h:i a', '', '', '');
                        $status = $row['STATUS'];
                        $status_description = $api->get_attendance_adjustment_status($status)[0]['BADGE'];
                        $reason = $row['REASON'];
                        $file_path = $row['FILE_PATH'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                        if($update_attendance_adjustment > 0  && $status == 'PEN'){
                            if(!empty($time_out_date) && !empty($time_out)){
                                $update = '<button type="button" class="btn btn-info waves-effect waves-light update-attendance-adjustment-full" data-request-id="'. $request_id .'" title="Edit Attendance Adjustment">
                                    <i class="bx bx-pencil font-size-16 align-middle"></i>
                                </button>';
                            }
                            else{
                                $update = '<button type="button" class="btn btn-info waves-effect waves-light update-attendance-adjustment-partial" data-request-id="'. $request_id .'" title="Edit Attendance Adjustment">
                                    <i class="bx bx-pencil font-size-16 align-middle"></i>
                                </button>';
                            }
                        }
                        else{
                            $update = '';
                        }

                        if($cancel_attendance_adjustment > 0 && ($status == 'PEN' || $status == 'REC' || $status == 'FRREC')){
                            $cancel = '<button type="button" class="btn btn-warning waves-effect waves-light cancel-attendance-adjustment" data-request-id="'. $request_id .'" title="Cancel Attendance Adjustment">
                                        <i class="bx bx-calendar-x font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $cancel = '';
                        }

                        if($tag_attendance_adjustment_for_recommendation > 0 && $status == 'PEN'){
                            $for_recommendation = '<button type="button" class="btn btn-success waves-effect waves-light for-recommend-attendance-adjustment" data-request-id="'. $request_id .'" title="Tag Attendance Adjustment For Recommendation">
                                        <i class="bx bx-check font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $for_recommendation = '';
                        }

                        if($delete_attendance_adjustment > 0 && $status == 'PEN'){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-attendance-adjustment" data-request-id="'. $request_id .'" title="Delete Attendance Adjustment">
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

                        if($status == 'PEN' || $status == 'REC' || $status == 'FRREC'){
                            $data_cancel = 1;

                            if($status == 'PEN'){
                                $data_for_recommendation = 1;
                                $data_delete = 1;
                            }
                            else{
                                $data_for_recommendation = 0;
                                $data_delete = 0;
                            }

                            $check_box = '<input class="form-check-input datatable-checkbox-children" data-cancel="'. $data_cancel .'" data-delete="'. $data_delete .'" data-for-recommendation="'. $data_for_recommendation .'" type="checkbox" value="'. $request_id .'">';
                        }
                        else{
                            $check_box = '';
                        }

                        if($status == 'APV'){
                            $sanction = $api->get_attendance_adjustment_sanction_status($row['SANCTION'])[0]['BADGE'];
                        }
                        else{
                            $sanction = '';
                        }

                        if(strtotime($time_in_date) != strtotime($time_in_date_adjusted)){
                            $adjustment_time_in_date = $time_in_date . ' -> ' . $time_in_date_adjusted;
                        }
                        else{
                            $adjustment_time_in_date = $time_in_date;
                        }

                        if(strtotime($time_in) != strtotime($time_in_adjusted)){
                            $adjustment_time_in = $time_in . ' -> ' . $time_in_adjusted;
                        }
                        else{
                            $adjustment_time_in = $time_in_date;
                        }

                        if(strtotime($time_out_date) != strtotime($time_out_date_adjusted)){
                            $adjustment_time_out_date = $time_out_date . ' -> ' . $time_out_date_adjusted;
                        }
                        else{
                            $adjustment_time_out_date = $time_out_date;
                        }

                        if(strtotime($time_out) != strtotime($time_out_adjusted)){
                            $adjustment_time_out = $time_out . ' -> ' . $time_out_adjusted;
                        }
                        else{
                            $adjustment_time_out = $time_out_date;
                        }
    
                        $response[] = array(
                            'CHECK_BOX' => $check_box,
                            'TIME_IN_DATE' => $adjustment_time_in_date,
                            'TIME_IN' => $adjustment_time_in,
                            'TIME_OUT_DATE' => $adjustment_time_out_date,
                            'TIME_OUT' => $adjustment_time_out,
                            'STATUS' => $status_description,
                            'SANCTION' => $sanction,
                            'ATTACHMENT' => '<a href="'. $file_path .'" target="_blank">Attachment</a>',
                            'REASON' => $reason,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-attendance-adjustment" data-request-id="'. $request_id .'" title="View Attendance Adjustment">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $update .'
                                '. $for_recommendation .'
                                '. $cancel .'
                                '. $delete .'
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

    # Attendance creation recommendation table
    else if($type == 'attendance creation recommendation table'){
        if(isset($_POST['filter_start_date']) && isset($_POST['filter_end_date'])){
            if ($api->databaseConnection()) {
                $employee_details = $api->get_employee_details('', $username);
                $employee_id = $employee_details[0]['EMPLOYEE_ID'] ?? null; 

                # Get permission
                $recommend_attendance_creation = $api->check_role_permissions($username, 189);
                $reject_attendance_creation = $api->check_role_permissions($username, 190);
                $cancel_attendance_creation = $api->check_role_permissions($username, 191);
                $view_transaction_log = $api->check_role_permissions($username, 192);

                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');

                $query = 'SELECT REQUEST_ID, EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_OUT_DATE, TIME_OUT, STATUS, REASON, FILE_PATH, TRANSACTION_LOG_ID FROM tblattendancecreation WHERE EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT IN (SELECT DEPARTMENT_ID FROM tbldepartment WHERE DEPARTMENT_HEAD = :employee_id)) AND STATUS = :status ';
    
                if((!empty($filter_start_date) && !empty($filter_end_date))){
                    $query .= 'AND FOR_RECOMMENDATION_DATE BETWEEN :filter_start_date AND :filter_end_date';
                }

                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);
                $sql->bindValue(':status', 'FRREC');
                
                if((!empty($filter_start_date) && !empty($filter_end_date))){
                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $request_id = $row['REQUEST_ID'];
                        $employee_id = $row['EMPLOYEE_ID'];
                        $time_in_date = $api->check_date('empty', $row['TIME_IN_DATE'], '', 'm/d/Y', '', '', '');
                        $time_in = $api->check_date('empty', $row['TIME_IN'], '', 'h:i a', '', '', '');
                        $time_out_date = $api->check_date('empty', $row['TIME_OUT_DATE'], '', 'm/d/Y', '', '', '');
                        $time_out = $api->check_date('empty', $row['TIME_OUT'], '', 'h:i a', '', '', '');
                        $status = $row['STATUS'];
                        $status_description = $api->get_attendance_creation_status($status)[0]['BADGE'];
                        $reason = $row['REASON'];
                        $file_path = $row['FILE_PATH'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                        $employee_details = $api->get_employee_details($employee_id, '');
                        $employee_file_as = $employee_details[0]['FILE_AS'];

                        if($reject_attendance_creation > 0){
                            $reject = '<button type="button" class="btn btn-danger waves-effect waves-light reject-attendance-creation" data-request-id="'. $request_id .'" title="Reject Attendance Creation">
                                        <i class="bx bx-block font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $reject = '';
                        }

                        if($cancel_attendance_creation > 0){
                            $cancel = '<button type="button" class="btn btn-warning waves-effect waves-light cancel-attendance-creation" data-request-id="'. $request_id .'" title="Cancel Attendance Creation">
                                        <i class="bx bx-calendar-x font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $cancel = '';
                        }

                        if($recommend_attendance_creation > 0){
                            $recommend = '<button type="button" class="btn btn-success waves-effect waves-light recommend-attendance-creation" data-request-id="'. $request_id .'" title="Recommend Attendance Creation">
                                        <i class="bx bx-check font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $recommend = '';
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
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" data-cancel="1" data-recommend="1" data-reject="1" type="checkbox" value="'. $request_id .'">',
                            'EMPLOYEE_ID' => $employee_file_as,
                            'TIME_IN' => $time_in_date . '<br/>' . $time_in,
                            'TIME_OUT' => $time_out_date . '<br/>' . $time_out,
                            'STATUS' => $status_description,
                            'ATTACHMENT' => '<a href="'. $file_path .'" target="_blank">Attachment</a>',
                            'REASON' => $reason,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-attendance-creation" data-request-id="'. $request_id .'" title="View Attendance Creation">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $recommend .'
                                '. $reject .'
                                '. $cancel .'
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

    # Attendance adjustment recommendation table
    else if($type == 'attendance adjustment recommendation table'){
        if(isset($_POST['filter_start_date']) && isset($_POST['filter_end_date'])){
            if ($api->databaseConnection()) {
                $employee_details = $api->get_employee_details('', $username);
                $employee_id = $employee_details[0]['EMPLOYEE_ID'] ?? null;

                # Get permission
                $recommend_attendance_adjustment = $api->check_role_permissions($username, 194);
                $reject_attendance_adjustment = $api->check_role_permissions($username, 195);
                $cancel_attendance_adjustment = $api->check_role_permissions($username, 196);
                $view_transaction_log = $api->check_role_permissions($username, 197);

                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');

                $query = 'SELECT REQUEST_ID, EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_IN_DATE_ADJUSTED, TIME_IN_ADJUSTED, TIME_OUT_DATE, TIME_OUT, TIME_OUT_DATE_ADJUSTED, TIME_OUT_ADJUSTED, STATUS, REASON, FILE_PATH, TRANSACTION_LOG_ID FROM tblattendanceadjustment WHERE EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT IN (SELECT DEPARTMENT_ID FROM tbldepartment WHERE DEPARTMENT_HEAD = :employee_id)) AND STATUS = :status ';
    
                if((!empty($filter_start_date) && !empty($filter_end_date))){
                    $query .= 'AND FOR_RECOMMENDATION_DATE BETWEEN :filter_start_date AND :filter_end_date';
                }

                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);
                $sql->bindValue(':status', 'FRREC');
                
                if((!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_attendance_adjustment_status)){
                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $request_id = $row['REQUEST_ID'];
                        $employee_id = $row['EMPLOYEE_ID'];
                        $time_in_date = $api->check_date('empty', $row['TIME_IN_DATE'] ?? null, '', 'm/d/Y', '', '', '');
                        $time_in = $api->check_date('empty', $row['TIME_IN'] ?? null, '', 'h:i a', '', '', '');
                        $time_in_date_adjusted = $api->check_date('empty', $row['TIME_IN_DATE_ADJUSTED'] ?? null, '', 'm/d/Y', '', '', '');
                        $time_in_adjusted = $api->check_date('empty', $row['TIME_IN_ADJUSTED'] ?? null, '', 'h:i a', '', '', '');
                        $time_out_date = $api->check_date('empty', $row['TIME_OUT_DATE'] ?? null, '', 'm/d/Y', '', '', '');
                        $time_out = $api->check_date('empty', $row['TIME_OUT'] ?? null, '', 'h:i a', '', '', '');
                        $time_out_date_adjusted = $api->check_date('empty', $row['TIME_OUT_DATE_ADJUSTED'] ?? null, '', 'm/d/Y', '', '', '');
                        $time_out_adjusted = $api->check_date('empty', $row['TIME_OUT_ADJUSTED'] ?? null, '', 'h:i a', '', '', '');
                        $status = $row['STATUS'];
                        $status_description = $api->get_attendance_adjustment_status($status)[0]['BADGE'];
                        $reason = $row['REASON'];
                        $file_path = $row['FILE_PATH'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                        $employee_details = $api->get_employee_details($employee_id, '');
                        $employee_file_as = $employee_details[0]['FILE_AS'];

                        if($reject_attendance_adjustment > 0){
                            $reject = '<button type="button" class="btn btn-danger waves-effect waves-light reject-attendance-adjustment" data-request-id="'. $request_id .'" title="Reject Attendance Adjustment">
                                        <i class="bx bx-block font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $reject = '';
                        }

                        if($cancel_attendance_adjustment > 0){
                            $cancel = '<button type="button" class="btn btn-warning waves-effect waves-light cancel-attendance-adjustment" data-request-id="'. $request_id .'" title="Cancel Attendance Adjustment">
                                        <i class="bx bx-calendar-x font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $cancel = '';
                        }

                        if($recommend_attendance_adjustment > 0){
                            $recommend = '<button type="button" class="btn btn-success waves-effect waves-light recommend-attendance-adjustment" data-request-id="'. $request_id .'" title="Recommend Attendance Adjustment">
                                        <i class="bx bx-check font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $recommend = '';
                        }
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }

                        if(strtotime($time_in_date) != strtotime($time_in_date_adjusted)){
                            $adjustment_time_in_date = $time_in_date . ' -> ' . $time_in_date_adjusted;
                        }
                        else{
                            $adjustment_time_in_date = $time_in_date;
                        }

                        if(strtotime($time_in) != strtotime($time_in_adjusted)){
                            $adjustment_time_in = $time_in . ' -> ' . $time_in_adjusted;
                        }
                        else{
                            $adjustment_time_in = $time_in_date;
                        }

                        if(strtotime($time_out_date) != strtotime($time_out_date_adjusted)){
                            $adjustment_time_out_date = $time_out_date . ' -> ' . $time_out_date_adjusted;
                        }
                        else{
                            $adjustment_time_out_date = $time_out_date;
                        }

                        if(strtotime($time_out) != strtotime($time_out_adjusted)){
                            $adjustment_time_out = $time_out . ' -> ' . $time_out_adjusted;
                        }
                        else{
                            $adjustment_time_out = $time_out_date;
                        }
    
                        $response[] = array(
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" data-cancel="1" data-recommend="1" data-reject="1" type="checkbox" value="'. $request_id .'">',
                            'EMPLOYEE_ID' => $employee_file_as,
                            'TIME_IN_DATE' => $adjustment_time_in_date,
                            'TIME_IN' => $adjustment_time_in,
                            'TIME_OUT_DATE' => $adjustment_time_out_date,
                            'TIME_OUT' => $adjustment_time_out,
                            'STATUS' => $status_description,
                            'ATTACHMENT' => '<a href="'. $file_path .'" target="_blank">Attachment</a>',
                            'REASON' => $reason,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-attendance-adjustment" data-request-id="'. $request_id .'" title="View Attendance Adjustment">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $recommend .'
                                '. $reject .'
                                '. $cancel .'
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

    # Attendance creation approval table
    else if($type == 'attendance creation approval table'){
        if(isset($_POST['filter_start_date']) && isset($_POST['filter_end_date']) && isset($_POST['filter_branch']) && isset($_POST['filter_department'])){
            if ($api->databaseConnection()) {
                $employee_details = $api->get_employee_details('', $username);
                $employee_id = $employee_details[0]['EMPLOYEE_ID'] ?? null;

                # Get permission
                $approve_attendance_creation = $api->check_role_permissions($username, 199);
                $reject_attendance_creation = $api->check_role_permissions($username, 200);
                $cancel_attendance_creation = $api->check_role_permissions($username, 201);
                $view_transaction_log = $api->check_role_permissions($username, 202);

                $filter_branch = $_POST['filter_branch'];
                $filter_department = $_POST['filter_department'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');

                $query = 'SELECT REQUEST_ID, EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_OUT_DATE, TIME_OUT, STATUS, REASON, FILE_PATH, TRANSACTION_LOG_ID FROM tblattendancecreation WHERE STATUS = :status AND ';
    
                if((!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_branch) || !empty($filter_department)){
                    if(!empty($filter_branch)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE BRANCH = :filter_branch)';
                    }

                    if(!empty($filter_department)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = :filter_department)';
                    }

                    if((!empty($filter_start_date) && !empty($filter_end_date))){
                        $filter[] = 'RECOMMENDATION_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }

                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':status', 'REC');
                
                if((!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_branch) || !empty($filter_department)){
                    if(!empty($filter_branch)){
                        $sql->bindValue(':filter_branch', $filter_branch);
                    }

                    if(!empty($filter_department)){
                        $sql->bindValue(':filter_department', $filter_department);
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $request_id = $row['REQUEST_ID'];
                        $employee_id = $row['EMPLOYEE_ID'];
                        $time_in_date = $api->check_date('empty', $row['TIME_IN_DATE'], '', 'm/d/Y', '', '', '');
                        $time_in = $api->check_date('empty', $row['TIME_IN'], '', 'h:i a', '', '', '');
                        $time_out_date = $api->check_date('empty', $row['TIME_OUT_DATE'], '', 'm/d/Y', '', '', '');
                        $time_out = $api->check_date('empty', $row['TIME_OUT'], '', 'h:i a', '', '', '');
                        $status = $row['STATUS'];
                        $status_description = $api->get_attendance_creation_status($status)[0]['BADGE'];
                        $reason = $row['REASON'];
                        $file_path = $row['FILE_PATH'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                        $employee_details = $api->get_employee_details($employee_id, '');
                        $employee_file_as = $employee_details[0]['FILE_AS'];

                        if($reject_attendance_creation > 0){
                            $reject = '<button type="button" class="btn btn-danger waves-effect waves-light reject-attendance-creation" data-request-id="'. $request_id .'" title="Reject Attendance Creation">
                                        <i class="bx bx-block font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $reject = '';
                        }

                        if($cancel_attendance_creation > 0){
                            $cancel = '<button type="button" class="btn btn-warning waves-effect waves-light cancel-attendance-creation" data-request-id="'. $request_id .'" title="Cancel Attendance Creation">
                                        <i class="bx bx-calendar-x font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $cancel = '';
                        }

                        if($approve_attendance_creation > 0){
                            $approve = '<button type="button" class="btn btn-success waves-effect waves-light approve-attendance-creation" data-request-id="'. $request_id .'" title="Approve Attendance Creation">
                                        <i class="bx bx-check font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $approve = '';
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
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" data-cancel="1" data-approve="1" data-reject="1" type="checkbox" value="'. $request_id .'">',
                            'EMPLOYEE_ID' => $employee_file_as,
                            'TIME_IN' => $time_in_date . '<br/>' . $time_in,
                            'TIME_OUT' => $time_out_date . '<br/>' . $time_out,
                            'STATUS' => $status_description,
                            'ATTACHMENT' => '<a href="'. $file_path .'" target="_blank">Attachment</a>',
                            'REASON' => $reason,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-attendance-creation" data-request-id="'. $request_id .'" title="View Attendance Creation">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $approve .'
                                '. $reject .'
                                '. $cancel .'
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

    # Attendance adjustment approval table
    else if($type == 'attendance adjustment approval table'){
        if(isset($_POST['filter_start_date']) && isset($_POST['filter_end_date']) && isset($_POST['filter_branch']) && isset($_POST['filter_department'])){
            if ($api->databaseConnection()) {
                $employee_details = $api->get_employee_details('', $username);
                $employee_id = $employee_details[0]['EMPLOYEE_ID'] ?? null;

                # Get permission
                $approve_attendance_adjustment = $api->check_role_permissions($username, 204);
                $reject_attendance_adjustment = $api->check_role_permissions($username, 205);
                $cancel_attendance_adjustment = $api->check_role_permissions($username, 206);
                $view_transaction_log = $api->check_role_permissions($username, 207);

                $filter_branch = $_POST['filter_branch'];
                $filter_department = $_POST['filter_department'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');

                $query = 'SELECT REQUEST_ID, EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_IN_DATE_ADJUSTED, TIME_IN_ADJUSTED, TIME_OUT_DATE, TIME_OUT, TIME_OUT_DATE_ADJUSTED, TIME_OUT_ADJUSTED, STATUS, REASON, FILE_PATH, TRANSACTION_LOG_ID FROM tblattendanceadjustment WHERE STATUS = :status AND ';
    
                if((!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_branch) || !empty($filter_department)){
                    if(!empty($filter_branch)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE BRANCH = :filter_branch)';
                    }

                    if(!empty($filter_department)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = :filter_department)';
                    }

                    if((!empty($filter_start_date) && !empty($filter_end_date))){
                        $filter[] = 'RECOMMENDATION_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
                

                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':status', 'REC');
                
                if((!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_branch) || !empty($filter_department)){
                    if(!empty($filter_branch)){
                        $sql->bindValue(':filter_branch', $filter_branch);
                    }

                    if(!empty($filter_department)){
                        $sql->bindValue(':filter_department', $filter_department);
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $request_id = $row['REQUEST_ID'];
                        $employee_id = $row['EMPLOYEE_ID'];
                        $time_in_date = $api->check_date('empty', $row['TIME_IN_DATE'] ?? null, '', 'm/d/Y', '', '', '');
                        $time_in = $api->check_date('empty', $row['TIME_IN'] ?? null, '', 'h:i a', '', '', '');
                        $time_in_date_adjusted = $api->check_date('empty', $row['TIME_IN_DATE_ADJUSTED'] ?? null, '', 'm/d/Y', '', '', '');
                        $time_in_adjusted = $api->check_date('empty', $row['TIME_IN_ADJUSTED'] ?? null, '', 'h:i a', '', '', '');
                        $time_out_date = $api->check_date('empty', $row['TIME_OUT_DATE'] ?? null, '', 'm/d/Y', '', '', '');
                        $time_out = $api->check_date('empty', $row['TIME_OUT'] ?? null, '', 'h:i a', '', '', '');
                        $time_out_date_adjusted = $api->check_date('empty', $row['TIME_OUT_DATE_ADJUSTED'] ?? null, '', 'm/d/Y', '', '', '');
                        $time_out_adjusted = $api->check_date('empty', $row['TIME_OUT_ADJUSTED'] ?? null, '', 'h:i a', '', '', '');
                        $status = $row['STATUS'];
                        $status_description = $api->get_attendance_adjustment_status($status)[0]['BADGE'];
                        $reason = $row['REASON'];
                        $file_path = $row['FILE_PATH'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                        $employee_details = $api->get_employee_details($employee_id, '');
                        $employee_file_as = $employee_details[0]['FILE_AS'];

                        if($reject_attendance_adjustment > 0){
                            $reject = '<button type="button" class="btn btn-danger waves-effect waves-light reject-attendance-adjustment" data-request-id="'. $request_id .'" title="Reject Attendance Adjustment">
                                        <i class="bx bx-block font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $reject = '';
                        }

                        if($cancel_attendance_adjustment > 0){
                            $cancel = '<button type="button" class="btn btn-warning waves-effect waves-light cancel-attendance-adjustment" data-request-id="'. $request_id .'" title="Cancel Attendance Adjustment">
                                        <i class="bx bx-calendar-x font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $cancel = '';
                        }

                        if($approve_attendance_adjustment > 0){
                            $approve = '<button type="button" class="btn btn-success waves-effect waves-light approve-attendance-adjustment" data-request-id="'. $request_id .'" title="Approve Attendance Adjustment">
                                        <i class="bx bx-check font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $approve = '';
                        }
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }

                        if(strtotime($time_in_date) != strtotime($time_in_date_adjusted)){
                            $adjustment_time_in_date = $time_in_date . ' -> ' . $time_in_date_adjusted;
                        }
                        else{
                            $adjustment_time_in_date = $time_in_date;
                        }

                        if(strtotime($time_in) != strtotime($time_in_adjusted)){
                            $adjustment_time_in = $time_in . ' -> ' . $time_in_adjusted;
                        }
                        else{
                            $adjustment_time_in = $time_in_date;
                        }

                        if(strtotime($time_out_date) != strtotime($time_out_date_adjusted)){
                            $adjustment_time_out_date = $time_out_date . ' -> ' . $time_out_date_adjusted;
                        }
                        else{
                            $adjustment_time_out_date = $time_out_date;
                        }

                        if(strtotime($time_out) != strtotime($time_out_adjusted)){
                            $adjustment_time_out = $time_out . ' -> ' . $time_out_adjusted;
                        }
                        else{
                            $adjustment_time_out = $time_out_date;
                        }
    
                        $response[] = array(
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" data-cancel="1" data-approve="1" data-reject="1" type="checkbox" value="'. $request_id .'">',
                            'EMPLOYEE_ID' => $employee_file_as,
                            'TIME_IN_DATE' => $adjustment_time_in_date,
                            'TIME_IN' => $adjustment_time_in,
                            'TIME_OUT_DATE' => $adjustment_time_out_date,
                            'TIME_OUT' => $adjustment_time_out,
                            'STATUS' => $status_description,
                            'ATTACHMENT' => '<a href="'. $file_path .'" target="_blank">Attachment</a>',
                            'REASON' => $reason,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-attendance-adjustment" data-request-id="'. $request_id .'" title="View Attendance Adjustment">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $approve .'
                                '. $reject .'
                                '. $cancel .'
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

    # Employee leave management table
    else if($type == 'employee leave management table'){
        if(isset($_POST['filter_leave_status']) && isset($_POST['filter_leave_type']) && isset($_POST['filter_start_date']) && isset($_POST['filter_end_date'])){
            if ($api->databaseConnection()) {
                $employee_details = $api->get_employee_details('', $username);
                $employee_id = $employee_details[0]['EMPLOYEE_ID'] ?? null;

                # Get permission
                $delete_leave = $api->check_role_permissions($username, 211);
                $cancel_leave = $api->check_role_permissions($username, 212);
                $view_transaction_log = $api->check_role_permissions($username, 213);
    
                $filter_leave_status = $_POST['filter_leave_status'];
                $filter_leave_type = $_POST['filter_leave_type'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');
    
                $query = 'SELECT LEAVE_ID, LEAVE_TYPE, LEAVE_DATE, START_TIME, END_TIME, LEAVE_STATUS, TRANSACTION_LOG_ID FROM tblleave WHERE EMPLOYEE_ID = :employee_id';
    
                if((!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_leave_status) || !empty($filter_leave_type)){
                    $query .= ' AND ';

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $filter[] = 'LEAVE_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if(!empty($filter_leave_status)){
                        $filter[] = 'LEAVE_STATUS = :filter_leave_status';
                    }

                    if(!empty($filter_leave_type)){
                        $filter[] = 'LEAVE_TYPE = :filter_leave_type';
                    }
                }               
    
                if(!empty($filter)){
                    $query .= implode(' AND ', $filter);
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);

                if((!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_leave_status) || !empty($filter_leave_type)){
                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }

                    if(!empty($filter_leave_status)){
                        $sql->bindValue(':filter_leave_status', $filter_leave_status);
                    }

                    if(!empty($filter_leave_type)){
                        $sql->bindValue(':filter_leave_type', $filter_leave_type);
                    }
                }
    
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
    
                        if($delete_leave > 0 && $leave_status == 'PEN'){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-leave" data-leave-id="'. $leave_id .'" title="Delete Leave">
                                        <i class="bx bx-trash font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $delete = '';
                        }
    
                        if($cancel_leave > 0 && ($leave_status == 'APVSYS' || $leave_status == 'PEN' || ($leave_status == 'APV' && strtotime($system_date) < strtotime($leave_date)))){
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

                        if($leave_status == 'PEN' || $leave_status == 'APVSYS' || ($leave_status == 'APV' && strtotime($system_date) < strtotime($leave_date))){
                            $check_box = '<input class="form-check-input datatable-checkbox-children" type="checkbox" data-cancel="1" data-leave-status="'. $leave_status .'" value="'. $leave_id .'">';
                        }
                        else{
                            $check_box = '';
                        }
    
                        $response[] = array(
                            'CHECK_BOX' => $check_box,
                            'LEAVE_NAME' => $leave_name,
                            'LEAVE_ENTITLMENT' => $leave_entitlement_status,
                            'LEAVE_DATE' => $leave_date . '<br/>' . $start_time . ' - ' . $end_time,
                            'LEAVE_STATUS' => $leave_status_name,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-leave" data-leave-id="'. $leave_id .'" title="View Leave">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
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

    # Leave approval table
    else if($type == 'leave approval table'){
        if(isset($_POST['filter_leave_type']) && isset($_POST['filter_start_date']) && isset($_POST['filter_end_date'])){
            if ($api->databaseConnection()) {
                $employee_details = $api->get_employee_details('', $username);
                $employee_id = $employee_details[0]['EMPLOYEE_ID'] ?? null;

                # Get permission
                $approve_leave = $api->check_role_permissions($username, 214);
                $reject_leave = $api->check_role_permissions($username, 215);
                $cancel_leave = $api->check_role_permissions($username, 216);
                $view_transaction_log = $api->check_role_permissions($username, 217);
    
                $filter_leave_type = $_POST['filter_leave_type'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');
    
                $query = 'SELECT EMPLOYEE_ID, LEAVE_ID, LEAVE_TYPE, LEAVE_DATE, START_TIME, END_TIME, LEAVE_STATUS, TRANSACTION_LOG_ID FROM tblleave WHERE EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT IN (SELECT DEPARTMENT_ID FROM tbldepartment WHERE DEPARTMENT_HEAD = :employee_id)) AND LEAVE_STATUS = :leave_status';
    
                if((!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_leave_type)){
                    $query .= ' AND ';

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $filter[] = 'LEAVE_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if(!empty($filter_leave_type)){
                        $filter[] = 'LEAVE_TYPE = :filter_leave_type';
                    }
                }               
    
                if(!empty($filter)){
                    $query .= implode(' AND ', $filter);
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);
                $sql->bindValue(':leave_status', 'PEN');

                if((!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_leave_type)){
                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }

                    if(!empty($filter_leave_type)){
                        $sql->bindValue(':filter_leave_type', $filter_leave_type);
                    }
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

                        $employee_details = $api->get_employee_details($employee_id, '');
                        $employee_name = $employee_details[0]['FILE_AS'];
    
                        $employee_leave_entitlement_details = $api->get_employee_leave_entitlement_details($employee_id, $leave_type, $leave_date);
                        $no_leaves = $employee_leave_entitlement_details[0]['NO_LEAVES'];
                        $acquired_leaves = $employee_leave_entitlement_details[0]['ACQUIRED_LEAVES'];
    
                        $leave_entitlement_status = $api->get_leave_entitlement_status($no_leaves, $acquired_leaves)[0]['BADGE'];
    
                        $leave_type_details = $api->get_leave_type_details($leave_type);
                        $leave_name = $leave_type_details[0]['LEAVE_NAME'];

                        if($approve_leave > 0){
                            $approve = '<button type="button" class="btn btn-success waves-effect waves-light approve-leave" data-leave-id="'. $leave_id .'" title="Approve Leave">
                                        <i class="bx bx-check font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $approve = '';
                        }
    
                        if($reject_leave > 0){
                            $reject = '<button type="button" class="btn btn-danger waves-effect waves-light reject-leave" data-leave-id="'. $leave_id .'" title="Reject Leave">
                                        <i class="bx bx-x font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $reject = '';
                        }
    
                        if($cancel_leave > 0){
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
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" data-approve="1" data-reject="1" data-cancel="1" data-leave-status="'. $leave_status .'" value="'. $leave_id .'">',
                            'FILE_AS' => $employee_name,
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

    # Allowance type table
    else if($type == 'allowance type table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_allowance_type = $api->check_role_permissions($username, 220);
            $delete_allowance_type = $api->check_role_permissions($username, 221);
            $view_transaction_log = $api->check_role_permissions($username, 222);

            $sql = $api->db_connection->prepare('SELECT ALLOWANCE_TYPE_ID, DESCRIPTION, ALLOWANCE_TYPE, TAXABLE, TRANSACTION_LOG_ID FROM tblallowancetype ORDER BY ALLOWANCE_TYPE');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $allowance_type_id = $row['ALLOWANCE_TYPE_ID'];
                    $allowance_type = $row['ALLOWANCE_TYPE'];
                    $description = $row['DESCRIPTION'];
                    $taxable = $row['TAXABLE'];
                    $allowance_type_status_name = $api->get_allowance_type_status($taxable)[0]['BADGE'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                    if($update_allowance_type > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-allowance-type" data-allowance-type-id="'. $allowance_type_id .'" title="Edit Allowance Type">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_allowance_type > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-allowance-type" data-allowance-type-id="'. $allowance_type_id .'" title="Delete Allowance Type">
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
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $allowance_type_id .'">',
                        'ALLOWANCE_TYPE' => $allowance_type . '<p class="text-muted mb-0">'. $description .'</p>',
                        'TAXABLE' => $allowance_type_status_name,
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

    # Allowance table
    else if($type == 'allowance table'){ 
        if(isset($_POST['filter_branch']) && isset($_POST['filter_department']) && isset($_POST['filter_allowance_type']) && isset($_POST['filter_start_date']) && isset($_POST['filter_end_date'])){
            if ($api->databaseConnection()) {
                # Get permission
                $update_allowance = $api->check_role_permissions($username, 225);
                $delete_allowance = $api->check_role_permissions($username, 226);
                $view_transaction_log = $api->check_role_permissions($username, 227);
    
                $filter_branch = $_POST['filter_branch'];
                $filter_department = $_POST['filter_department'];
                $filter_allowance_type = $_POST['filter_allowance_type'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');
    
                $query = 'SELECT ALLOWANCE_ID, EMPLOYEE_ID, ALLOWANCE_TYPE, PAYROLL_ID, PAYROLL_DATE, AMOUNT, TRANSACTION_LOG_ID FROM tblallowance WHERE ';
    
                if(!empty($filter_branch)  || !empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_allowance_type)){
                    if(!empty($filter_branch)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE BRANCH = :filter_branch)';
                    }

                    if(!empty($filter_department)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = :filter_department)';
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $filter[] = 'PAYROLL_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if(!empty($filter_allowance_type)){
                        $filter[] = 'ALLOWANCE_TYPE = :filter_allowance_type';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);

                if(!empty($filter_branch)  || !empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_allowance_type)){
                    if(!empty($filter_branch)){
                        $sql->bindValue(':filter_branch', $filter_branch);
                    }

                    if(!empty($filter_department)){
                        $sql->bindValue(':filter_department', $filter_department);
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }

                    if(!empty($filter_allowance_type)){
                        $sql->bindValue(':filter_allowance_type', $filter_allowance_type);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $allowance_id = $row['ALLOWANCE_ID'];
                        $employee_id = $row['EMPLOYEE_ID'];
                        $allowance_type = $row['ALLOWANCE_TYPE'];
                        $payroll_id = $row['PAYROLL_ID'];
                        $amount = $row['AMOUNT'];
                        $payroll_date = $api->check_date('empty', $row['PAYROLL_DATE'], '', 'm/d/Y', '', '', '');
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                        $allowance_type_details = $api->get_allowance_type_details($allowance_type);
                        $allowance_type_name = $allowance_type_details[0]['ALLOWANCE_TYPE'];
    
                        $employee_details = $api->get_employee_details($employee_id, '');
                        $file_as = $employee_details[0]['FILE_AS'];
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }

                        if(empty($payroll_id)){
                            if($update_allowance > 0){
                                $update = '<button type="button" class="btn btn-info waves-effect waves-light update-allowance" data-allowance-id="'. $allowance_id .'" title="Edit Allowance">
                                                <i class="bx bx-pencil font-size-16 align-middle"></i>
                                            </button>';
                            }
                            else{
                                $update = '';
                            }
        
                            if($delete_allowance > 0){
                                $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-allowance" data-allowance-id="'. $allowance_id .'" title="Delete Allowance">
                                            <i class="bx bx-trash font-size-16 align-middle"></i>
                                        </button>';
                            }
                            else{
                                $delete = '';
                            }

                            $check_box = '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $allowance_id .'">';
                        }
                        else{
                            $update = '';
                            $delete = '';
                            $check_box = '';
                        }
    
                        $response[] = array(
                            'CHECK_BOX' => $check_box,
                            'FILE_AS' => $file_as,
                            'ALLOWANCE_TYPE' => $allowance_type_name,
                            'PAYROLL_DATE' => $payroll_date,
                            'AMOUNT' => number_format($amount, 2),
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-allowance" data-allowance-id="'. $allowance_id .'" title="View Allowance">
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

    # Deduction type table
    else if($type == 'deduction type table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_deduction_type = $api->check_role_permissions($username, 230);
            $delete_deduction_type = $api->check_role_permissions($username, 231);
            $view_transaction_log = $api->check_role_permissions($username, 232);

            $sql = $api->db_connection->prepare('SELECT DEDUCTION_TYPE_ID, DESCRIPTION, DEDUCTION_TYPE, TRANSACTION_LOG_ID FROM tbldeductiontype ORDER BY DEDUCTION_TYPE');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $deduction_type_id = $row['DEDUCTION_TYPE_ID'];
                    $deduction_type = $row['DEDUCTION_TYPE'];
                    $description = $row['DESCRIPTION'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                    if($update_deduction_type > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-deduction-type" data-deduction-type-id="'. $deduction_type_id .'" title="Edit Allowance Type">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_deduction_type > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-deduction-type" data-deduction-type-id="'. $deduction_type_id .'" title="Delete Allowance Type">
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
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $deduction_type_id .'">',
                        'DEDUCTION_TYPE' => $deduction_type . '<p class="text-muted mb-0">'. $description .'</p>',
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

    # Government contribution table
    else if($type == 'government contribution table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_government_contribution = $api->check_role_permissions($username, 235);
            $delete_government_contribution = $api->check_role_permissions($username, 236);
            $view_transaction_log = $api->check_role_permissions($username, 237);
            $view_contribution_bracket_page = $api->check_role_permissions($username, 238);

            $sql = $api->db_connection->prepare('SELECT GOVERNMENT_CONTRIBUTION_ID, DESCRIPTION, GOVERNMENT_CONTRIBUTION, TRANSACTION_LOG_ID FROM tblgovernmentcontribution ORDER BY GOVERNMENT_CONTRIBUTION');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $government_contribution_id = $row['GOVERNMENT_CONTRIBUTION_ID'];
                    $government_contribution = $row['GOVERNMENT_CONTRIBUTION'];
                    $description = $row['DESCRIPTION'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                    $government_contribution_id_encrypted = $api->encrypt_data($government_contribution_id);

                    if($update_government_contribution > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-government-contribution" data-government-contribution-id="'. $government_contribution_id .'" title="Edit Allowance Type">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($view_contribution_bracket_page > 0){
                        $view_page = '<a href="contribution-bracket.php?id='. $government_contribution_id_encrypted .'" class="btn btn-warning waves-effect waves-light" title="View Contribution Bracket">
                                            <i class="bx bx-spreadsheet font-size-16 align-middle"></i>
                                        </a>';
                    }
                    else{
                        $view_page = '';
                    }

                    if($delete_government_contribution > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-government-contribution" data-government-contribution-id="'. $government_contribution_id .'" title="Delete Allowance Type">
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
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $government_contribution_id .'">',
                        'GOVERNMENT_CONTRIBUTION' => $government_contribution . '<p class="text-muted mb-0">'. $description .'</p>',
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
    # -------------------------------------------------------------

    # Contribution bracket table
    else if($type == 'contribution bracket table'){
        if(isset($_POST['government_contribution_id']) && !empty($_POST['government_contribution_id'])){
            if ($api->databaseConnection()) {
                $government_contribution_id = $_POST['government_contribution_id'];

                # Get permission
                $update_contribution_bracket = $api->check_role_permissions($username, 8);
                $delete_contribution_bracket = $api->check_role_permissions($username, 10);
                $view_transaction_log = $api->check_role_permissions($username, 10);
    
                $sql = $api->db_connection->prepare('SELECT CONTRIBUTION_BRACKET_ID, START_RANGE, END_RANGE, DEDUCTION_AMOUNT, TRANSACTION_LOG_ID FROM tblcontributionbracket WHERE GOVERNMENT_CONTRIBUTION_ID = :government_contribution_id ORDER BY CONTRIBUTION_BRACKET_ID');
                $sql->bindValue(':government_contribution_id', $government_contribution_id);
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $contribution_bracket_id = $row['CONTRIBUTION_BRACKET_ID'];
                        $start_range = $row['START_RANGE'];
                        $end_range = $row['END_RANGE'];
                        $deduction_amount = $row['DEDUCTION_AMOUNT'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
    
                        if($update_contribution_bracket > 0){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-contribution-bracket" data-contribution-bracket-id="'. $contribution_bracket_id .'" title="Edit Contribution Bracket">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }
    
                        if($delete_contribution_bracket > 0){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-contribution-bracket" data-contribution-bracket-id="'. $contribution_bracket_id .'" title="Delete Contribution Bracket">
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
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $contribution_bracket_id .'">',
                            'BRACKET' => number_format($start_range, 2) . ' - ' . number_format($end_range, 2),
                            'DEDUCTION_AMOUNT' => number_format($deduction_amount, 2),
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

    # Deduction table
    else if($type == 'deduction table'){
        if(isset($_POST['filter_branch']) && isset($_POST['filter_department']) && isset($_POST['filter_deduction_type']) && isset($_POST['filter_start_date']) && isset($_POST['filter_end_date'])){
            if ($api->databaseConnection()) {
                # Get permission
                $update_deduction = $api->check_role_permissions($username, 245);
                $delete_deduction = $api->check_role_permissions($username, 246);
                $view_transaction_log = $api->check_role_permissions($username, 247);
    
                $filter_branch = $_POST['filter_branch'];
                $filter_department = $_POST['filter_department'];
                $filter_deduction_type = $_POST['filter_deduction_type'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');
    
                $query = 'SELECT DEDUCTION_ID, EMPLOYEE_ID, DEDUCTION_TYPE, PAYROLL_ID, PAYROLL_DATE, AMOUNT, TRANSACTION_LOG_ID FROM tbldeduction WHERE ';
    
                if(!empty($filter_branch)  || !empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_deduction_type)){
                    if(!empty($filter_branch)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE BRANCH = :filter_branch)';
                    }

                    if(!empty($filter_department)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = :filter_department)';
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $filter[] = 'PAYROLL_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if(!empty($filter_deduction_type)){
                        $filter[] = 'DEDUCTION_TYPE = :filter_deduction_type';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);

                if(!empty($filter_branch)  || !empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_deduction_type)){
                    if(!empty($filter_branch)){
                        $sql->bindValue(':filter_branch', $filter_branch);
                    }

                    if(!empty($filter_department)){
                        $sql->bindValue(':filter_department', $filter_department);
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }

                    if(!empty($filter_deduction_type)){
                        $sql->bindValue(':filter_deduction_type', $filter_deduction_type);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $deduction_id = $row['DEDUCTION_ID'];
                        $employee_id = $row['EMPLOYEE_ID'];
                        $deduction_type = $row['DEDUCTION_TYPE'];
                        $payroll_id = $row['PAYROLL_ID'];
                        $amount = $row['AMOUNT'];
                        $payroll_date = $api->check_date('empty', $row['PAYROLL_DATE'], '', 'm/d/Y', '', '', '');
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                        $deduction_type_details = $api->get_deduction_type_details($deduction_type);
                        $deduction_type_name = $deduction_type_details[0]['DEDUCTION_TYPE'];
    
                        $employee_details = $api->get_employee_details($employee_id, '');
                        $file_as = $employee_details[0]['FILE_AS'];
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }

                        if(empty($payroll_id)){
                            if($update_deduction > 0){
                                $update = '<button type="button" class="btn btn-info waves-effect waves-light update-deduction" data-deduction-id="'. $deduction_id .'" title="Edit Deduction">
                                                <i class="bx bx-pencil font-size-16 align-middle"></i>
                                            </button>';
                            }
                            else{
                                $update = '';
                            }
        
                            if($delete_deduction > 0){
                                $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-deduction" data-deduction-id="'. $deduction_id .'" title="Delete Deduction">
                                            <i class="bx bx-trash font-size-16 align-middle"></i>
                                        </button>';
                            }
                            else{
                                $delete = '';
                            }

                            $check_box = '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $deduction_id .'">';
                        }
                        else{
                            $update = '';
                            $delete = '';
                            $check_box = '';
                        }
    
                        $response[] = array(
                            'CHECK_BOX' => $check_box,
                            'FILE_AS' => $file_as,
                            'DEDUCTION_TYPE' => $deduction_type_name,
                            'PAYROLL_DATE' => $payroll_date,
                            'AMOUNT' => number_format($amount, 2),
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-deduction" data-deduction-id="'. $deduction_id .'" title="View Deduction">
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

    # Contribution deduction table
    else if($type == 'contribution deduction table'){
        if(isset($_POST['filter_branch']) && isset($_POST['filter_department']) && isset($_POST['filter_contribution_deduction_type']) && isset($_POST['filter_start_date']) && isset($_POST['filter_end_date'])){
            if ($api->databaseConnection()) {
                # Get permission
                $update_contribution_deduction = $api->check_role_permissions($username, 250);
                $delete_contribution_deduction = $api->check_role_permissions($username, 251);
                $view_transaction_log = $api->check_role_permissions($username, 252);
    
                $filter_branch = $_POST['filter_branch'];
                $filter_department = $_POST['filter_department'];
                $filter_contribution_deduction_type = $_POST['filter_contribution_deduction_type'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');
    
                $query = 'SELECT CONTRIBUTION_DEDUCTION_ID, EMPLOYEE_ID, GOVERNMENT_CONTRIBUTION_TYPE, PAYROLL_ID, PAYROLL_DATE, TRANSACTION_LOG_ID FROM tblcontributiondeduction WHERE ';
    
                if(!empty($filter_branch)  || !empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_contribution_deduction_type)){
                    if(!empty($filter_branch)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE BRANCH = :filter_branch)';
                    }

                    if(!empty($filter_department)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = :filter_department)';
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $filter[] = 'PAYROLL_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if(!empty($filter_contribution_deduction_type)){
                        $filter[] = 'GOVERNMENT_CONTRIBUTION_TYPE = :filter_contribution_deduction_type';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);

                if(!empty($filter_branch)  || !empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_contribution_deduction_type)){
                    if(!empty($filter_branch)){
                        $sql->bindValue(':filter_branch', $filter_branch);
                    }

                    if(!empty($filter_department)){
                        $sql->bindValue(':filter_department', $filter_department);
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }

                    if(!empty($filter_contribution_deduction_type)){
                        $sql->bindValue(':filter_contribution_deduction_type', $filter_contribution_deduction_type);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $contribution_deduction_id = $row['CONTRIBUTION_DEDUCTION_ID'];
                        $employee_id = $row['EMPLOYEE_ID'];
                        $government_contribution_type = $row['GOVERNMENT_CONTRIBUTION_TYPE'];
                        $payroll_id = $row['PAYROLL_ID'];
                        $payroll_date = $api->check_date('empty', $row['PAYROLL_DATE'], '', 'm/d/Y', '', '', '');
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                        $government_contribution_type_details = $api->get_government_contribution_details($government_contribution_type);
                        $government_contribution_type_name = $government_contribution_type_details[0]['GOVERNMENT_CONTRIBUTION'];
    
                        $employee_details = $api->get_employee_details($employee_id, '');
                        $file_as = $employee_details[0]['FILE_AS'];
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }

                        if(empty($payroll_id)){
                            if($update_contribution_deduction > 0){
                                $update = '<button type="button" class="btn btn-info waves-effect waves-light update-contribution-deduction" data-contribution-deduction-id="'. $contribution_deduction_id .'" title="Edit Contribution Deduction">
                                                <i class="bx bx-pencil font-size-16 align-middle"></i>
                                            </button>';
                            }
                            else{
                                $update = '';
                            }
        
                            if($delete_contribution_deduction > 0){
                                $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-contribution-deduction" data-contribution-deduction-id="'. $contribution_deduction_id .'" title="Delete Contribution Deduction">
                                            <i class="bx bx-trash font-size-16 align-middle"></i>
                                        </button>';
                            }
                            else{
                                $delete = '';
                            }

                            $check_box = '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $contribution_deduction_id .'">';
                        }
                        else{
                            $update = '';
                            $delete = '';
                            $check_box = '';
                        }
    
                        $response[] = array(
                            'CHECK_BOX' => $check_box,
                            'FILE_AS' => $file_as,
                            'GOVERNMENT_CONTRIBUTION_TYPE' => $government_contribution_type_name,
                            'PAYROLL_DATE' => $payroll_date,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-contribution-deduction" data-contribution-deduction-id="'. $contribution_deduction_id .'" title="View Contribution Deduction">
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

    # Transaction log table
    else if($type == 'transaction log table'){
        if(isset($_POST['transaction_log_id']) && !empty($_POST['transaction_log_id'])){
            if ($api->databaseConnection()) {
                $transaction_log_id = $_POST['transaction_log_id'];
    
                $sql = $api->db_connection->prepare('SELECT USERNAME, LOG_TYPE, LOG_DATE, LOG FROM tbltransactionlog WHERE TRANSACTION_LOG_ID = :transaction_log_id');
                $sql->bindValue(':transaction_log_id', $transaction_log_id);
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $username = $row['USERNAME'];
                        $log_type = $row['LOG_TYPE'];
                        $log = $row['LOG'];
                        $log_date = $api->check_date('empty', $row['LOG_DATE'], '', 'm/d/Y h:i:s a', '', '', '');
    
                        $log_by_details = $api->get_employee_details('', $username);
                        $log_by = $log_by_details[0]['FILE_AS'] ?? $username;
    
                        $response[] = array(
                            'LOG_TYPE' => $log_type,
                            'LOG' => $log,
                            'LOG_DATE' => $log_date,
                            'LOG_BY' => $log_by
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

    # Attendance summary table
    else if($type == 'attendance summary table'){
        if(isset($_POST['filter_start_date']) && isset($_POST['filter_end_date']) && isset($_POST['filter_branch']) && isset($_POST['filter_department'])){
            if ($api->databaseConnection()) {

                $filter_department = $_POST['filter_department'];
                $filter_branch = $_POST['filter_branch'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');

                $query = 'SELECT DISTINCT(EMPLOYEE_ID) AS EMPLOYEE_ID FROM tblattendancerecord';
    
                if(!empty($filter_department) || !empty($filter_branch) || (!empty($filter_start_date) && !empty($filter_end_date))){
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

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);
                
                if(!empty($filter_department) || !empty($filter_branch) || (!empty($filter_start_date) && !empty($filter_end_date))){
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
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $employee_id = $row['EMPLOYEE_ID'];

                        $get_working_days = $api->get_working_days($employee_id, $filter_start_date, $filter_end_date);
                        $get_days_worked = $api->get_days_worked($employee_id, $filter_start_date, $filter_end_date);
                        $get_employee_late_count = $api->get_attendance_time_in_count('LATE', $employee_id, $filter_start_date, $filter_end_date);
                        $get_employee_total_late = $api->get_employee_attendance_total('Late', $employee_id, $filter_start_date, $filter_end_date);
                        $get_employee_early_leaving_count = $api->get_attendance_time_out_count('EL', $employee_id, $filter_start_date, $filter_end_date);
                        $get_employee_total_early_leaving = $api->get_employee_attendance_total('Early Leaving', $employee_id, $filter_start_date, $filter_end_date);
                        $get_attendance_adjustment_count = $api->get_attendance_adjustment_count('APV', $employee_id, $filter_start_date, $filter_end_date);
                        $get_attendance_creation_count = $api->get_attendance_creation_count('APV', $employee_id, $filter_start_date, $filter_end_date);
                        $get_attendance_adjustments_sanction_count = $api->get_attendance_adjustments_sanction_count(1, $employee_id, $filter_start_date, $filter_end_date);
                        $get_attendance_creation_sanction_count = $api->get_attendance_creation_sanction_count(1, $employee_id, $filter_start_date, $filter_end_date);
                        $get_attendance_adjustments_unsanction_count = $api->get_attendance_adjustments_sanction_count(0, $employee_id, $filter_start_date, $filter_end_date);
                        $get_attendance_creation_unsanction_count = $api->get_attendance_creation_sanction_count(0, $employee_id, $filter_start_date, $filter_end_date);
                       
                        $employee_details = $api->get_employee_details($employee_id, '');
                        $file_as = $employee_details[0]['FILE_AS'];
    
                        $response[] = array(
                            'FILE_AS' => '<a href="javascript: void(0);" class="view-attendance-summary">'. $file_as . '</a>',
                            'WORKING_DAYS' => number_format($get_working_days),
                            'DAYS_WORKED' => number_format($get_days_worked),
                            'LATE_COUNT' => number_format($get_employee_late_count),
                            'TOTAL_LATE' => number_format($get_employee_total_late, 2),
                            'EARLY_LEAVING_COUNT' => number_format($get_employee_early_leaving_count),
                            'TOTAL_EARLY_LEAVING' => number_format($get_employee_total_early_leaving, 2),
                            'ATTENDANCE_ADJUSTMENT' => number_format($get_attendance_adjustment_count),
                            'ATTENDANCE_CREATION' => number_format($get_attendance_creation_count),
                            'SANCTIONED_ATTENDANCE_ADJUSTMENT' => number_format($get_attendance_adjustments_sanction_count),
                            'SANCTIONED_ATTENDANCE_CREATION' => number_format($get_attendance_creation_sanction_count),
                            'UNSANCTIONED_ATTENDANCE_ADJUSTMENT' => number_format($get_attendance_adjustments_unsanction_count),
                            'UNSANCTIONED_ATTENDANCE_CREATION' => number_format($get_attendance_creation_unsanction_count),
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-attendance-summary" data-employee-id="'. $employee_id .'" title="View Attendance Summary">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
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

    # Attendance record summary table
    else if($type == 'attendance record summary table'){
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id']) && isset($_POST['filter_start_date']) && isset($_POST['filter_end_date'])){
            if ($api->databaseConnection()) {

                $employee_id = $_POST['employee_id'];

                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');

                $query = 'SELECT ATTENDANCE_ID, TIME_IN_DATE, TIME_IN, TIME_IN_BEHAVIOR, TIME_OUT_DATE, TIME_OUT, TIME_OUT_BEHAVIOR, LATE, EARLY_LEAVING, OVERTIME, TOTAL_WORKING_HOURS, TRANSACTION_LOG_ID FROM tblattendancerecord WHERE EMPLOYEE_ID = :employee_id';
    
                if((!empty($filter_start_date) && !empty($filter_end_date))){
                    $query .= ' AND ';

                    $filter[] = 'TIME_IN_DATE BETWEEN :filter_start_date AND :filter_end_date';

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);
                
                if((!empty($filter_start_date) && !empty($filter_end_date))){
                    $sql->bindValue(':filter_start_date', $filter_start_date);
                    $sql->bindValue(':filter_end_date', $filter_end_date);
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
    
                        $response[] = array(
                            'TIME_IN' => $time_in_date . '<br/>' . $time_in,
                            'TIME_IN_BEHAVIOR' => $time_in_behavior,
                            'TIME_OUT' => $time_out_date . '<br/>' . $time_out,
                            'TIME_OUT_BEHAVIOR' => $time_out_behavior,
                            'LATE' => $late,
                            'EARLY_LEAVING' => $early_leaving,
                            'OVERTIME' => $overtime,
                            'TOTAL_WORKING_HOURS' => $total_working_hours
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

    # Attendance creation summary table
    else if($type == 'attendance creation summary table'){
        if(isset($_POST['filter_start_date']) && isset($_POST['filter_end_date']) && isset($_POST['employee_id'])){
            if ($api->databaseConnection()) {
                $employee_id = $_POST['employee_id'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');

                $query = 'SELECT REQUEST_ID, TIME_IN_DATE, TIME_IN, TIME_OUT_DATE, TIME_OUT, STATUS, REASON, FILE_PATH, REQUEST_DATE, REQUEST_TIME, FOR_RECOMMENDATION_DATE, FOR_RECOMMENDATION_TIME, RECOMMENDATION_DATE, RECOMMENDATION_TIME, RECOMMENDED_BY, DECISION_REMARKS, DECISION_DATE, DECISION_TIME, DECISION_BY, DECISION_REMARKS, TRANSACTION_LOG_ID FROM tblattendancecreation WHERE EMPLOYEE_ID = :employee_id AND STATUS = :status AND ';
    
                if((!empty($filter_start_date) && !empty($filter_end_date))){
                    $filter[] = 'REQUEST_DATE BETWEEN :filter_start_date AND :filter_end_date';

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);
                $sql->bindValue(':status', 'APV');
                
                if((!empty($filter_start_date) && !empty($filter_end_date))){
                    $sql->bindValue(':filter_start_date', $filter_start_date);
                    $sql->bindValue(':filter_end_date', $filter_end_date);
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $request_id = $row['REQUEST_ID'];
                        $time_in_date = $api->check_date('empty', $row['TIME_IN_DATE'], '', 'm/d/Y', '', '', '');
                        $time_in = $api->check_date('empty', $row['TIME_IN'], '', 'h:i a', '', '', '');
                        $time_out_date = $api->check_date('empty', $row['TIME_OUT_DATE'], '', 'm/d/Y', '', '', '');
                        $time_out = $api->check_date('empty', $row['TIME_OUT'], '', 'h:i a', '', '', '');
                        $status = $row['STATUS'];
                        $status_description = $api->get_attendance_creation_status($status)[0]['BADGE'];
                        $reason = $row['REASON'];
                        $file_path = $row['FILE_PATH'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                        $recommended_by = $row['RECOMMENDED_BY'];
                        $decision_by = $row['DECISION_BY'];
                        $decision_remarks = $row['DECISION_REMARKS'] ?? null;
                        $request_date = $api->check_date('empty', $row['REQUEST_DATE'] ?? null, '', 'm/d/Y', '', '', '');
                        $request_time = $api->check_date('empty', $row['REQUEST_TIME'] ?? null, '', 'h:i a', '', '', '');
                        $for_recommendation_date = $api->check_date('empty', $row['FOR_RECOMMENDATION_DATE'] ?? null, '', 'm/d/Y', '', '', '');
                        $for_recommendation_time = $api->check_date('empty', $row['FOR_RECOMMENDATION_TIME'] ?? null, '', 'h:i a', '', '', '');
                        $recommendation_date = $api->check_date('empty', $row['RECOMMENDATION_DATE'] ?? null, '', 'm/d/Y', '', '', '');
                        $recommendation_time = $api->check_date('empty', $row['RECOMMENDATION_TIME'] ?? null, '', 'h:i a', '', '', '');
                        $decision_date = $api->check_date('empty', $row['DECISION_DATE'] ?? null, '', 'm/d/Y', '', '', '');
                        $decision_time = $api->check_date('empty', $row['DECISION_TIME'] ?? null, '', 'h:i a', '', '', '');

                        $recommended_by_details = $api->get_employee_details('', $recommended_by);
                        $recommended_by_file_as = $recommended_by_details[0]['FILE_AS'] ?? null;

                        $decision_by_details = $api->get_employee_details('', $decision_by);
                        $decision_by_file_as = $decision_by_details[0]['FILE_AS'] ?? null;

                        $response[] = array(
                            'TIME_IN' => $time_in_date . '<br/>' . $time_in,
                            'TIME_OUT' => $time_out_date . '<br/>' . $time_out,
                            'STATUS' => $status_description,
                            'ATTACHMENT' => '<a href="'. $file_path .'" target="_blank">Attachment</a>',
                            'REASON' => $reason,
                            'REQUEST_DATE' => $request_date . '<br/>' . $request_time,
                            'FOR_RECOMMENDATION_DATE' => $for_recommendation_date . '<br/>' . $for_recommendation_time,
                            'RECOMMENDATION_DATE' => $recommendation_date . '<br/>' . $recommendation_time,
                            'RECOMMENDED_BY' => $recommended_by_file_as,
                            'APPROVAL_DATE' => $decision_date . '<br/>' . $decision_time,
                            'APPROVAL_BY' => $decision_by_file_as,
                            'REMARKS' => $decision_remarks,
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

    # Attendance adjustment summary table
    else if($type == 'attendance adjustment summary table'){
        if(isset($_POST['filter_start_date']) && isset($_POST['filter_end_date']) && isset($_POST['employee_id'])){
            if ($api->databaseConnection()) {
                $employee_id = $_POST['employee_id'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');

                $query = 'SELECT REQUEST_ID, TIME_IN_DATE, TIME_IN, TIME_IN_DATE_ADJUSTED, TIME_IN_ADJUSTED, TIME_OUT_DATE, TIME_OUT, TIME_OUT_DATE_ADJUSTED, TIME_OUT_ADJUSTED, STATUS, REASON, FILE_PATH, REQUEST_DATE, REQUEST_TIME, FOR_RECOMMENDATION_DATE, FOR_RECOMMENDATION_TIME, RECOMMENDATION_DATE, RECOMMENDATION_TIME, RECOMMENDED_BY, DECISION_REMARKS, DECISION_DATE, DECISION_TIME, DECISION_BY, DECISION_REMARKS, TRANSACTION_LOG_ID FROM tblattendanceadjustment WHERE EMPLOYEE_ID = :employee_id AND STATUS = :status AND ';
    
                if((!empty($filter_start_date) && !empty($filter_end_date))){
                    $filter[] = 'REQUEST_DATE BETWEEN :filter_start_date AND :filter_end_date';

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);
                $sql->bindValue(':status', 'APV');
                
                if((!empty($filter_start_date) && !empty($filter_end_date)) ){
                    $sql->bindValue(':filter_start_date', $filter_start_date);
                    $sql->bindValue(':filter_end_date', $filter_end_date);
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $request_id = $row['REQUEST_ID'];
                        $time_in_date = $api->check_date('empty', $row['TIME_IN_DATE'] ?? null, '', 'm/d/Y', '', '', '');
                        $time_in = $api->check_date('empty', $row['TIME_IN'] ?? null, '', 'h:i a', '', '', '');
                        $time_in_date_adjusted = $api->check_date('empty', $row['TIME_IN_DATE_ADJUSTED'] ?? null, '', 'm/d/Y', '', '', '');
                        $time_in_adjusted = $api->check_date('empty', $row['TIME_IN_ADJUSTED'] ?? null, '', 'h:i a', '', '', '');
                        $time_out_date = $api->check_date('empty', $row['TIME_OUT_DATE'] ?? null, '', 'm/d/Y', '', '', '');
                        $time_out = $api->check_date('empty', $row['TIME_OUT'] ?? null, '', 'h:i a', '', '', '');
                        $time_out_date_adjusted = $api->check_date('empty', $row['TIME_OUT_DATE_ADJUSTED'] ?? null, '', 'm/d/Y', '', '', '');
                        $time_out_adjusted = $api->check_date('empty', $row['TIME_OUT_ADJUSTED'] ?? null, '', 'h:i a', '', '', '');
                        $status = $row['STATUS'];
                        $status_description = $api->get_attendance_adjustment_status($status)[0]['BADGE'];
                        $reason = $row['REASON'];
                        $file_path = $row['FILE_PATH'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                        $recommended_by = $row['RECOMMENDED_BY'];
                        $decision_by = $row['DECISION_BY'];
                        $decision_remarks = $row['DECISION_REMARKS'] ?? null;
                        $request_date = $api->check_date('empty', $row['REQUEST_DATE'] ?? null, '', 'm/d/Y', '', '', '');
                        $request_time = $api->check_date('empty', $row['REQUEST_TIME'] ?? null, '', 'h:i a', '', '', '');
                        $for_recommendation_date = $api->check_date('empty', $row['FOR_RECOMMENDATION_DATE'] ?? null, '', 'm/d/Y', '', '', '');
                        $for_recommendation_time = $api->check_date('empty', $row['FOR_RECOMMENDATION_TIME'] ?? null, '', 'h:i a', '', '', '');
                        $recommendation_date = $api->check_date('empty', $row['RECOMMENDATION_DATE'] ?? null, '', 'm/d/Y', '', '', '');
                        $recommendation_time = $api->check_date('empty', $row['RECOMMENDATION_TIME'] ?? null, '', 'h:i a', '', '', '');
                        $decision_date = $api->check_date('empty', $row['DECISION_DATE'] ?? null, '', 'm/d/Y', '', '', '');
                        $decision_time = $api->check_date('empty', $row['DECISION_TIME'] ?? null, '', 'h:i a', '', '', '');

                        $recommended_by_details = $api->get_employee_details('', $recommended_by);
                        $recommended_by_file_as = $recommended_by_details[0]['FILE_AS'] ?? null;

                        $decision_by_details = $api->get_employee_details('', $decision_by);
                        $decision_by_file_as = $decision_by_details[0]['FILE_AS'] ?? null;

                        if(strtotime($time_in_date) != strtotime($time_in_date_adjusted)){
                            $adjustment_time_in_date = $time_in_date . ' -> ' . $time_in_date_adjusted;
                        }
                        else{
                            $adjustment_time_in_date = $time_in_date;
                        }

                        if(strtotime($time_in) != strtotime($time_in_adjusted)){
                            $adjustment_time_in = $time_in . ' -> ' . $time_in_adjusted;
                        }
                        else{
                            $adjustment_time_in = $time_in_date;
                        }

                        if(strtotime($time_out_date) != strtotime($time_out_date_adjusted)){
                            $adjustment_time_out_date = $time_out_date . ' -> ' . $time_out_date_adjusted;
                        }
                        else{
                            $adjustment_time_out_date = $time_out_date;
                        }

                        if(strtotime($time_out) != strtotime($time_out_adjusted)){
                            $adjustment_time_out = $time_out . ' -> ' . $time_out_adjusted;
                        }
                        else{
                            $adjustment_time_out = $time_out_date;
                        }

                        $response[] = array(
                            'TIME_IN_DATE' => $adjustment_time_in_date,
                            'TIME_IN' => $adjustment_time_in,
                            'TIME_OUT_DATE' => $adjustment_time_out_date,
                            'TIME_OUT' => $adjustment_time_out,
                            'STATUS' => $status_description,
                            'ATTACHMENT' => '<a href="'. $file_path .'" target="_blank">Attachment</a>',
                            'REASON' => $reason,
                            'REQUEST_DATE' => $request_date . '<br/>' . $request_time,
                            'FOR_RECOMMENDATION_DATE' => $for_recommendation_date . '<br/>' . $for_recommendation_time,
                            'RECOMMENDATION_DATE' => $recommendation_date . '<br/>' . $recommendation_time,
                            'RECOMMENDED_BY' => $recommended_by_file_as,
                            'APPROVAL_DATE' => $decision_date . '<br/>' . $decision_time,
                            'APPROVAL_BY' => $decision_by_file_as,
                            'REMARKS' => $decision_remarks,
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

    # Temporary employee table
    else if($type == 'temporary employee table'){
        if ($api->databaseConnection()) {
            $sql = $api->db_connection->prepare('SELECT EMPLOYEE_ID, ID_NUMBER, FILE_AS, FIRST_NAME, MIDDLE_NAME, LAST_NAME, SUFFIX, BIRTHDAY, EMPLOYMENT_STATUS, JOIN_DATE, EXIT_DATE, PERMANENCY_DATE, EXIT_REASON, EMAIL, PHONE, TELEPHONE, DEPARTMENT, DESIGNATION, BRANCH, GENDER FROM temp_employee');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $employee_id = $row['EMPLOYEE_ID'];
                    $id_number = $row['ID_NUMBER'];
                    $file_as = $row['FILE_AS'];
                    $first_name = $row['FIRST_NAME'];
                    $middle_name = $row['MIDDLE_NAME'];
                    $last_name = $row['LAST_NAME'];
                    $suffix = $row['SUFFIX'];
                    $employment_status = $row['EMPLOYMENT_STATUS'];
                    $exit_reason = $row['EXIT_REASON'];
                    $email = $row['EMAIL'];
                    $phone = $row['PHONE'];
                    $telephone = $row['TELEPHONE'];
                    $department = $row['DEPARTMENT'];
                    $designation = $row['DESIGNATION'];
                    $branch = $row['BRANCH'];
                    $gender = $row['GENDER'];
                    
                    $birthday = $api->check_date('empty', $row['BIRTHDAY'] ?? null, '', 'Y-m-d', '', '', '');
                    $join_date = $api->check_date('empty', $row['JOIN_DATE'] ?? null, '', 'Y-m-d', '', '', '');
                    $exit_date = $api->check_date('empty', $row['EXIT_DATE'] ?? null, '', 'Y-m-d', '', '', '');
                    $permanency_date = $api->check_date('empty', $row['PERMANENCY_DATE'] ?? null, '', 'Y-m-d', '', '', '');

                    $response[] = array(
                        'EMPLOYEE_ID' => $employee_id,
                        'ID_NUMBER' => $id_number,
                        'FILE_AS' => $file_as,
                        'FIRST_NAME' => $first_name,
                        'MIDDLE_NAME' => $middle_name,
                        'LAST_NAME' => $last_name,
                        'SUFFIX' => $suffix,
                        'BIRTHDAY' => $birthday,
                        'EMPLOYMENT_STATUS' => $employment_status,
                        'JOIN_DATE' => $join_date,
                        'EXIT_DATE' => $exit_date,
                        'PERMANENCY_DATE' => $permanency_date,
                        'EXIT_REASON' => $exit_reason,
                        'EMAIL' => $email,
                        'PHONE' => $phone,
                        'TELEPHONE' => $telephone,
                        'DEPARTMENT' => $department,
                        'DESIGNATION' => $designation,
                        'BRANCH' => $branch,
                        'GENDER' => $gender
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

    # Temporary attendance record table
    else if($type == 'temporary attendance record table'){
        if ($api->databaseConnection()) {
            $sql = $api->db_connection->prepare('SELECT ATTENDANCE_ID, EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_OUT_DATE, TIME_OUT FROM temp_attendance_record');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $attendance_id = $row['ATTENDANCE_ID'];
                    $employee_id = $row['EMPLOYEE_ID'];
                    
                    $time_in_date = $api->check_date('empty', $row['TIME_IN_DATE'] ?? null, '', 'Y-m-d', '', '', '');
                    $time_in = $api->check_date('empty', $row['TIME_IN'] ?? null, '', 'H:i:00', '', '', '');
                    $time_out_date = $api->check_date('empty', $row['TIME_OUT_DATE'] ?? null, '', 'Y-m-d', '', '', '');
                    $time_out = $api->check_date('empty', $row['TIME_OUT'] ?? null, '', 'H:i:00', '', '', '');

                    $response[] = array(
                        'ATTENDANCE_ID' => $attendance_id,
                        'EMPLOYEE_ID' => $employee_id,
                        'TIME_IN_DATE' => $time_in_date,
                        'TIME_IN' => $time_in,
                        'TIME_OUT_DATE' => $time_out_date,
                        'TIME_OUT' => $time_out
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

    # Temporary leave entitlement table
    else if($type == 'temporary leave entitlement table'){
        if ($api->databaseConnection()) {
            $sql = $api->db_connection->prepare('SELECT LEAVE_ENTITLEMENT_ID, EMPLOYEE_ID, LEAVE_TYPE, NO_LEAVES, START_DATE, END_DATE FROM temp_leave_entitlement');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $leave_entitlement_id = $row['LEAVE_ENTITLEMENT_ID'];
                    $employee_id = $row['EMPLOYEE_ID'];
                    $leave_type = $row['LEAVE_TYPE'];
                    $no_leaves = $row['NO_LEAVES'];
                    
                    $start_date = $api->check_date('empty', $row['START_DATE'] ?? null, '', 'Y-m-d', '', '', '');
                    $end_date = $api->check_date('empty', $row['END_DATE'] ?? null, '', 'Y-m-d', '', '', '');

                    $response[] = array(
                        'LEAVE_ENTITLEMENT_ID' => $leave_entitlement_id,
                        'EMPLOYEE_ID' => $employee_id,
                        'LEAVE_TYPE' => $leave_type,
                        'NO_LEAVES' => $no_leaves,
                        'START_DATE' => $start_date,
                        'END_DATE' => $end_date
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

    # Temporary leave table
    else if($type == 'temporary leave table'){
        if ($api->databaseConnection()) {
            $sql = $api->db_connection->prepare('SELECT EMPLOYEE_ID, LEAVE_TYPE, LEAVE_DATE, START_TIME, END_TIME, LEAVE_STATUS, LEAVE_REASON FROM temp_leave');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $employee_id = $row['EMPLOYEE_ID'];
                    $leave_type = $row['LEAVE_TYPE'];
                    $leave_status = $row['LEAVE_STATUS'];
                    $leave_reason = $row['LEAVE_REASON'];
                    
                    $leave_date = $api->check_date('empty', $row['LEAVE_DATE'] ?? null, '', 'Y-m-d', '', '', '');
                    $start_time = $api->check_date('empty', $row['START_TIME'] ?? null, '', 'H:i:00', '', '', '');
                    $end_time = $api->check_date('empty', $row['END_TIME'] ?? null, '', 'H:i:00', '', '', '');

                    $response[] = array(
                        'EMPLOYEE_ID' => $employee_id,
                        'LEAVE_TYPE' => $leave_type,
                        'LEAVE_DATE' => $leave_date,
                        'START_TIME' => $start_time,
                        'END_TIME' => $end_time,
                        'LEAVE_STATUS' => $leave_status,
                        'LEAVE_REASON' => $leave_reason
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

    # Temporary attendance adjustment table
    else if($type == 'temporary attendance adjustment table'){
        if ($api->databaseConnection()) {
            $sql = $api->db_connection->prepare('SELECT REQUEST_ID, EMPLOYEE_ID, ATTENDANCE_ID, TIME_IN_DATE_ADJUSTED, TIME_IN_ADJUSTED, TIME_OUT_DATE_ADJUSTED, TIME_OUT_ADJUSTED, STATUS, REASON, FILE_PATH, SANCTION, REQUEST_DATE, REQUEST_TIME, FOR_RECOMMENDATION_DATE, FOR_RECOMMENDATION_TIME, RECOMMENDATION_DATE, RECOMMENDATION_TIME, RECOMMENDED_BY, DECISION_REMARKS, DECISION_DATE, DECISION_TIME, DECISION_BY FROM temp_attendance_adjustment');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $request_id = $row['REQUEST_ID'];
                    $employee_id = $row['EMPLOYEE_ID'];
                    $attendance_id = $row['ATTENDANCE_ID'];
                    $status = $row['STATUS'];
                    $reason = $row['REASON'];
                    $file_path = $row['FILE_PATH'];
                    $sanction = $row['SANCTION'];
                    $recommended_by = $row['RECOMMENDED_BY'];
                    $decision_remarks = $row['DECISION_REMARKS'];
                    $decision_by = $row['DECISION_BY'];
                    
                    $time_in_date_adjusted = $api->check_date('empty', $row['TIME_IN_DATE_ADJUSTED'] ?? null, '', 'Y-m-d', '', '', '');
                    $time_in_adjusted = $api->check_date('empty', $row['TIME_IN_ADJUSTED'] ?? null, '', 'H:i:s', '', '', '');
                    $time_out_date_adjusted = $api->check_date('empty', $row['TIME_OUT_DATE_ADJUSTED'] ?? null, '', 'Y-m-d', '', '', '');
                    $time_out_adjusted = $api->check_date('empty', $row['TIME_OUT_ADJUSTED'] ?? null, '', 'H:i:s', '', '', '');
                    $request_date = $api->check_date('empty', $row['REQUEST_DATE'] ?? null, '', 'Y-m-d', '', '', '');
                    $request_time = $api->check_date('empty', $row['REQUEST_TIME'] ?? null, '', 'H:i:s', '', '', '');
                    $for_recommendation_date = $api->check_date('empty', $row['FOR_RECOMMENDATION_DATE'] ?? null, '', 'Y-m-d', '', '', '');
                    $for_recommendation_time = $api->check_date('empty', $row['FOR_RECOMMENDATION_TIME'] ?? null, '', 'H:i:s', '', '', '');
                    $recommendation_date = $api->check_date('empty', $row['RECOMMENDATION_DATE'] ?? null, '', 'Y-m-d', '', '', '');
                    $recommendation_time = $api->check_date('empty', $row['RECOMMENDATION_TIME'] ?? null, '', 'H:i:s', '', '', '');
                    $decision_date = $api->check_date('empty', $row['DECISION_DATE'] ?? null, '', 'Y-m-d', '', '', '');
                    $decision_time = $api->check_date('empty', $row['DECISION_TIME'] ?? null, '', 'H:i:s', '', '', '');

                    $response[] = array(
                        'REQUEST_ID' => $request_id,
                        'EMPLOYEE_ID' => $employee_id,
                        'ATTENDANCE_ID' => $attendance_id,
                        'TIME_IN_DATE_ADJUSTED' => $time_in_date_adjusted,
                        'TIME_IN_ADJUSTED' => $time_in_adjusted,
                        'TIME_OUT_DATE_ADJUSTED' => $time_out_date_adjusted,
                        'TIME_OUT_ADJUSTED' => $time_out_adjusted,
                        'STATUS' => $status,
                        'REASON' => $reason,
                        'FILE_PATH' => $file_path,
                        'SANCTION' => $sanction,
                        'REQUEST_DATE' => $request_date,
                        'REQUEST_TIME' => $request_time,
                        'FOR_RECOMMENDATION_DATE' => $for_recommendation_date,
                        'FOR_RECOMMENDATION_TIME' => $for_recommendation_time,
                        'RECOMMENDATION_DATE' => $recommendation_date,
                        'RECOMMENDATION_TIME' => $recommendation_time,
                        'RECOMMENDED_BY' => $recommended_by,
                        'DECISION_REMARKS' => $decision_remarks,
                        'DECISION_DATE' => $decision_date,
                        'DECISION_TIME' => $decision_time,
                        'DECISION_BY' => $decision_by
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

    # Temporary attendance creation table
    else if($type == 'temporary attendance creation table'){
        if ($api->databaseConnection()) {
            $sql = $api->db_connection->prepare('SELECT REQUEST_ID, EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_OUT_DATE, TIME_OUT, STATUS, REASON, FILE_PATH, SANCTION, REQUEST_DATE, REQUEST_TIME, FOR_RECOMMENDATION_DATE, FOR_RECOMMENDATION_TIME, RECOMMENDATION_DATE, RECOMMENDATION_TIME, RECOMMENDED_BY, DECISION_REMARKS, DECISION_DATE, DECISION_TIME, DECISION_BY FROM temp_attendance_creation');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $request_id = $row['REQUEST_ID'];
                    $employee_id = $row['EMPLOYEE_ID'];
                    $status = $row['STATUS'];
                    $reason = $row['REASON'];
                    $file_path = $row['FILE_PATH'];
                    $sanction = $row['SANCTION'];
                    $recommended_by = $row['RECOMMENDED_BY'];
                    $decision_remarks = $row['DECISION_REMARKS'];
                    $decision_by = $row['DECISION_BY'];
                    
                    $time_in_date = $api->check_date('empty', $row['TIME_IN_DATE'] ?? null, '', 'Y-m-d', '', '', '');
                    $time_in = $api->check_date('empty', $row['TIME_IN'] ?? null, '', 'H:i:s', '', '', '');
                    $time_out_date = $api->check_date('empty', $row['TIME_OUT_DATE'] ?? null, '', 'Y-m-d', '', '', '');
                    $time_out = $api->check_date('empty', $row['TIME_OUT'] ?? null, '', 'H:i:s', '', '', '');
                    $request_date = $api->check_date('empty', $row['REQUEST_DATE'] ?? null, '', 'Y-m-d', '', '', '');
                    $request_time = $api->check_date('empty', $row['REQUEST_TIME'] ?? null, '', 'H:i:s', '', '', '');
                    $for_recommendation_date = $api->check_date('empty', $row['FOR_RECOMMENDATION_DATE'] ?? null, '', 'Y-m-d', '', '', '');
                    $for_recommendation_time = $api->check_date('empty', $row['FOR_RECOMMENDATION_TIME'] ?? null, '', 'H:i:s', '', '', '');
                    $recommendation_date = $api->check_date('empty', $row['RECOMMENDATION_DATE'] ?? null, '', 'Y-m-d', '', '', '');
                    $recommendation_time = $api->check_date('empty', $row['RECOMMENDATION_TIME'] ?? null, '', 'H:i:s', '', '', '');
                    $decision_date = $api->check_date('empty', $row['DECISION_DATE'] ?? null, '', 'Y-m-d', '', '', '');
                    $decision_time = $api->check_date('empty', $row['DECISION_TIME'] ?? null, '', 'H:i:s', '', '', '');

                    $response[] = array(
                        'REQUEST_ID' => $request_id,
                        'EMPLOYEE_ID' => $employee_id,
                        'TIME_IN_DATE' => $time_in_date,
                        'TIME_IN' => $time_in,
                        'TIME_OUT_DATE' => $time_out_date,
                        'TIME_OUT' => $time_out,
                        'STATUS' => $status,
                        'REASON' => $reason,
                        'FILE_PATH' => $file_path,
                        'SANCTION' => $sanction,
                        'REQUEST_DATE' => $request_date,
                        'REQUEST_TIME' => $request_time,
                        'FOR_RECOMMENDATION_DATE' => $for_recommendation_date,
                        'FOR_RECOMMENDATION_TIME' => $for_recommendation_time,
                        'RECOMMENDATION_DATE' => $recommendation_date,
                        'RECOMMENDATION_TIME' => $recommendation_time,
                        'RECOMMENDED_BY' => $recommended_by,
                        'DECISION_REMARKS' => $decision_remarks,
                        'DECISION_DATE' => $decision_date,
                        'DECISION_TIME' => $decision_time,
                        'DECISION_BY' => $decision_by
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

    # Temporary allowance table
    else if($type == 'temporary allowance table'){
        if ($api->databaseConnection()) {
            $sql = $api->db_connection->prepare('SELECT ALLOWANCE_ID, EMPLOYEE_ID, ALLOWANCE_TYPE, PAYROLL_ID, PAYROLL_DATE, AMOUNT FROM temp_allowance');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $allowance_id = $row['ALLOWANCE_ID'];
                    $employee_id = $row['EMPLOYEE_ID'];
                    $allowance_type = $row['ALLOWANCE_TYPE'];
                    $payroll_id = $row['PAYROLL_ID'];
                    $amount = $row['AMOUNT'];
                    
                    $payroll_date = $api->check_date('empty', $row['PAYROLL_DATE'] ?? null, '', 'Y-m-d', '', '', '');

                    $response[] = array(
                        'ALLOWANCE_ID' => $allowance_id,
                        'EMPLOYEE_ID' => $employee_id,
                        'ALLOWANCE_TYPE' => $allowance_type,
                        'PAYROLL_ID' => $payroll_id,
                        'PAYROLL_DATE' => $payroll_date,
                        'AMOUNT' => $amount
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
    
    # Temporary other income table
    else if($type == 'temporary other income table'){
        if ($api->databaseConnection()) {
            $sql = $api->db_connection->prepare('SELECT OTHER_INCOME_ID, EMPLOYEE_ID, OTHER_INCOME_TYPE, PAYROLL_ID, PAYROLL_DATE, AMOUNT FROM temp_other_income');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $other_income_id = $row['OTHER_INCOME_ID'];
                    $employee_id = $row['EMPLOYEE_ID'];
                    $other_income_type = $row['OTHER_INCOME_TYPE'];
                    $payroll_id = $row['PAYROLL_ID'];
                    $amount = $row['AMOUNT'];
                    
                    $payroll_date = $api->check_date('empty', $row['PAYROLL_DATE'] ?? null, '', 'Y-m-d', '', '', '');

                    $response[] = array(
                        'OTHER_INCOME_ID' => $other_income_id,
                        'EMPLOYEE_ID' => $employee_id,
                        'OTHER_INCOME_TYPE' => $other_income_type,
                        'PAYROLL_ID' => $payroll_id,
                        'PAYROLL_DATE' => $payroll_date,
                        'AMOUNT' => $amount
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

    # Temporary deduction table
    else if($type == 'temporary deduction table'){
        if ($api->databaseConnection()) {
            $sql = $api->db_connection->prepare('SELECT DEDUCTION_ID, EMPLOYEE_ID, DEDUCTION_TYPE, PAYROLL_ID, PAYROLL_DATE, AMOUNT FROM temp_deduction');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $deduction_id = $row['DEDUCTION_ID'];
                    $employee_id = $row['EMPLOYEE_ID'];
                    $deduction_type = $row['DEDUCTION_TYPE'];
                    $payroll_id = $row['PAYROLL_ID'];
                    $amount = $row['AMOUNT'];
                    
                    $payroll_date = $api->check_date('empty', $row['PAYROLL_DATE'] ?? null, '', 'Y-m-d', '', '', '');

                    $response[] = array(
                        'DEDUCTION_ID' => $deduction_id,
                        'EMPLOYEE_ID' => $employee_id,
                        'DEDUCTION_TYPE' => $deduction_type,
                        'PAYROLL_ID' => $payroll_id,
                        'PAYROLL_DATE' => $payroll_date,
                        'AMOUNT' => $amount
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

    # Temporary government contribution table
    else if($type == 'temporary government contribution table'){
        if ($api->databaseConnection()) {
            $sql = $api->db_connection->prepare('SELECT GOVERNMENT_CONTRIBUTION_ID, GOVERNMENT_CONTRIBUTION, DESCRIPTION FROM temp_government_contribution');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $government_contribution_id = $row['GOVERNMENT_CONTRIBUTION_ID'];
                    $government_contribution = $row['GOVERNMENT_CONTRIBUTION'];
                    $description = $row['DESCRIPTION'];

                    $response[] = array(
                        'GOVERNMENT_CONTRIBUTION_ID' => $government_contribution_id,
                        'GOVERNMENT_CONTRIBUTION' => $government_contribution,
                        'DESCRIPTION' => $description
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

    # Temporary contribution bracket table
    else if($type == 'temporary contribution bracket table'){
        if ($api->databaseConnection()) {
            $sql = $api->db_connection->prepare('SELECT CONTRIBUTION_BRACKET_ID, GOVERNMENT_CONTRIBUTION_ID, START_RANGE, END_RANGE, DEDUCTION_AMOUNT FROM temp_contribution_bracket');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $contribution_bracket_id = $row['CONTRIBUTION_BRACKET_ID'];
                    $government_contribution_id = $row['GOVERNMENT_CONTRIBUTION_ID'];
                    $start_range = $row['START_RANGE'];
                    $end_range = $row['END_RANGE'];
                    $deduction_amount = $row['DEDUCTION_AMOUNT'];

                    $response[] = array(
                        'CONTRIBUTION_BRACKET_ID' => $contribution_bracket_id,
                        'GOVERNMENT_CONTRIBUTION_ID' => $government_contribution_id,
                        'START_RANGE' => $start_range,
                        'END_RANGE' => $end_range,
                        'DEDUCTION_AMOUNT' => $deduction_amount
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

    # Temporary contribution deduction table
    else if($type == 'temporary contribution deduction table'){
        if ($api->databaseConnection()) {
            $sql = $api->db_connection->prepare('SELECT CONTRIBUTION_DEDUCTION_ID, EMPLOYEE_ID, GOVERNMENT_CONTRIBUTION_TYPE, PAYROLL_ID, PAYROLL_DATE FROM temp_contribution_deduction');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $contribution_deduction_id = $row['CONTRIBUTION_DEDUCTION_ID'];
                    $employee_id = $row['EMPLOYEE_ID'];
                    $government_contribution_type = $row['GOVERNMENT_CONTRIBUTION_TYPE'];
                    $payroll_id = $row['PAYROLL_ID'];
                    
                    $payroll_date = $api->check_date('empty', $row['PAYROLL_DATE'] ?? null, '', 'Y-m-d', '', '', '');

                    $response[] = array(
                        'CONTRIBUTION_DEDUCTION_ID' => $contribution_deduction_id,
                        'EMPLOYEE_ID' => $employee_id,
                        'GOVERNMENT_CONTRIBUTION_TYPE' => $government_contribution_type,
                        'PAYROLL_ID' => $payroll_id,
                        'PAYROLL_DATE' => $payroll_date
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

    # Temporary withholding tax table
    else if($type == 'temporary withholding tax table'){
        if ($api->databaseConnection()) {
            $sql = $api->db_connection->prepare('SELECT WITHHOLDING_TAX_ID, SALARY_FREQUENCY, START_RANGE, END_RANGE, FIX_COMPENSATION_LEVEL, BASE_TAX, PERCENT_OVER FROM temp_withholding_tax');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $withholding_tax_id = $row['WITHHOLDING_TAX_ID'];
                    $salary_frequency = $row['SALARY_FREQUENCY'];
                    $start_range = $row['START_RANGE'];
                    $end_range = $row['END_RANGE'];
                    $fix_compensation_level = $row['FIX_COMPENSATION_LEVEL'];
                    $base_tax = $row['BASE_TAX'];
                    $percent_rate = $row['PERCENT_OVER'];

                    $response[] = array(
                        'WITHHOLDING_TAX_ID' => $withholding_tax_id,
                        'SALARY_FREQUENCY' => $salary_frequency,
                        'START_RANGE' => $start_range,
                        'END_RANGE' => $end_range,
                        'FIX_COMPENSATION_LEVEL' => $fix_compensation_level,
                        'BASE_TAX' => $fix_compensation_level,
                        'PERCENT_OVER' => $percent_rate
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

    # Notification table
    else if($type == 'notification table'){
        if(isset($_POST['filter_branch']) && isset($_POST['filter_department']) && isset($_POST['filter_start_date']) && isset($_POST['filter_end_date'])){
            if ($api->databaseConnection()) {
                $employee_details = $api->get_employee_details('', $username);
                $employee_id = $employee_details[0]['EMPLOYEE_ID'];
    
                $filter_branch = $_POST['filter_branch'];
                $filter_department = $_POST['filter_department'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');
    
                $query = 'SELECT NOTIFICATION_FROM, STATUS, NOTIFICATION_TITLE, NOTIFICATION, LINK, NOTIFICATION_DATE, NOTIFICATION_TIME FROM tblnotification WHERE NOTIFICATION_TO = :employee_id';
    
                if(!empty($filter_branch)  || !empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date))){
                    $query .= ' AND ';

                    if(!empty($filter_branch)){
                        $filter[] = 'NOTIFICATION_FROM IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE BRANCH = :filter_branch)';
                    }

                    if(!empty($filter_department)){
                        $filter[] = 'NOTIFICATION_FROM IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = :filter_department)';
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $filter[] = 'NOTIFICATION_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);

                if(!empty($filter_branch)  || !empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date))){
                    if(!empty($filter_branch)){
                        $sql->bindValue(':filter_branch', $filter_branch);
                    }

                    if(!empty($filter_department)){
                        $sql->bindValue(':filter_department', $filter_department);
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $notification_from = $row['NOTIFICATION_FROM'];
                        $status = $row['STATUS'];
                        $notification_title = $row['NOTIFICATION_TITLE'];
                        $notification = $row['NOTIFICATION'];
                        $link = $row['LINK'];
                        $notification_date = $api->check_date('empty', $row['NOTIFICATION_DATE'], '', 'm/d/Y', '', '', '');
                        $notification_time = $api->check_date('empty', $row['NOTIFICATION_TIME'], '', 'h:i:s a', '', '', '');
    
                        if(!empty($notification_from)){
                            $notification_from_details = $api->get_employee_details($notification_from, '');
                            $notification_from_file_as = $notification_from_details[0]['FILE_AS'] ?? $notification_from;   
                        }
                        else{
                            $notification_from_file_as = 'System';
                        }

                        if(!empty($link)){
                            $title = '<a href="'. $link .'" title="View Notification">
                                       '. $notification_title .'
                                    </a>';
                        }
                        else{
                            $title = $notification_title;
                        }
    
                        $response[] = array(
                            'NOTIFICATION_TITLE' => $title . '<p class="text-muted mb-0">'. $notification .'</p>',
                            'NOTIFICATION_FROM' => $notification_from_file_as,
                            'NOTIFICATION_DATE' => $notification_date . ' ' . $notification_time
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

    # Salary table
    else if($type == 'salary table'){
        if(isset($_POST['filter_branch']) && isset($_POST['filter_department']) && isset($_POST['filter_start_date']) && isset($_POST['filter_end_date'])){
            if ($api->databaseConnection()) {
                # Get permission
                $update_salary = $api->check_role_permissions($username, 286);
                $delete_salary = $api->check_role_permissions($username, 287);
                $view_transaction_log = $api->check_role_permissions($username, 288);
    
                $filter_branch = $_POST['filter_branch'];
                $filter_department = $_POST['filter_department'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');
    
                $query = 'SELECT SALARY_ID, EMPLOYEE_ID, SALARY_AMOUNT, SALARY_FREQUENCY, EFFECTIVITY_DATE, REMARKS, TRANSACTION_LOG_ID FROM tblsalary WHERE ';
    
                if(!empty($filter_branch)  || !empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date))){
                    if(!empty($filter_branch)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE BRANCH = :filter_branch)';
                    }

                    if(!empty($filter_department)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = :filter_department)';
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $filter[] = 'EFFECTIVITY_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);

                if(!empty($filter_branch)  || !empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date))){
                    if(!empty($filter_branch)){
                        $sql->bindValue(':filter_branch', $filter_branch);
                    }

                    if(!empty($filter_department)){
                        $sql->bindValue(':filter_department', $filter_department);
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $salary_id = $row['SALARY_ID'];
                        $employee_id = $row['EMPLOYEE_ID'];
                        $salary_amount = $row['SALARY_AMOUNT'];
                        $salary_frequency = $api->get_system_code_details('SALARYFREQUENCY', $row['SALARY_FREQUENCY'])[0]['DESCRIPTION'];
                        $remarks = $row['REMARKS'];
                        $effectivity_date = $api->check_date('empty', $row['EFFECTIVITY_DATE'], '', 'm/d/Y', '', '', '');
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
    
                        $employee_details = $api->get_employee_details($employee_id, '');
                        $file_as = $employee_details[0]['FILE_AS'];
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }

                        if($update_salary > 0){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-salary" data-salary-id="'. $salary_id .'" title="Edit Salary">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }
    
                        if($delete_salary > 0){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-salary" data-salary-id="'. $salary_id .'" title="Delete Salary">
                                        <i class="bx bx-trash font-size-16 align-middle"></i>
                                    </button>';
                        }
                        else{
                            $delete = '';
                        }
    
                        $response[] = array(
                            'CHECK_BOX' =>  '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $salary_id .'">',
                            'FILE_AS' => $file_as,
                            'SALARY_AMOUNT' => number_format($salary_amount, 2),
                            'SALARY_AMOUNT' => number_format($salary_amount, 2) . '<p class="text-muted mb-0">'. $salary_frequency .'</p>',
                            'EFFECTIVITY_DATE' => $effectivity_date,
                            'REMARKS' => $remarks,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-salary" data-salary-id="'. $salary_id .'" title="View Salary">
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

    # Payroll group table
    else if($type == 'payroll group table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_payroll_group = $api->check_role_permissions($username, 294);
            $delete_payroll_group = $api->check_role_permissions($username, 295);
            $view_transaction_log = $api->check_role_permissions($username, 296);

            $sql = $api->db_connection->prepare('SELECT PAYROLL_GROUP_ID, PAYROLL_GROUP, DESCRIPTION, TRANSACTION_LOG_ID FROM tblpayrollgroup ORDER BY PAYROLL_GROUP');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $payroll_group_id = $row['PAYROLL_GROUP_ID'];
                    $payroll_group = $row['PAYROLL_GROUP'];
                    $description = $row['DESCRIPTION'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                    if($update_payroll_group > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-payroll-group" data-payroll-group-id="'. $payroll_group_id .'" title="Edit Payroll Group">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_payroll_group > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-payroll-group" data-payroll-group-id="'. $payroll_group_id .'" title="Delete Payroll Group">
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
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $payroll_group_id .'">',
                        'PAYROLL_GROUP' => $payroll_group . '<p class="text-muted mb-0">'. $description .'</p>',
                        'ACTION' => '<div class="d-flex gap-2">
                            <button type="button" class="btn btn-primary waves-effect waves-light view-payroll-group" data-payroll-group-id="'. $payroll_group_id .'" title="View Payroll Group">
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

    # Pay run table
    else if($type == 'pay run table'){
        if(isset($_POST['filter_pay_run_status']) && isset($_POST['filter_pay_run_start_date']) && isset($_POST['filter_pay_run_end_date']) & isset($_POST['filter_generated_start_date']) && isset($_POST['filter_generated_end_date'])){
            if ($api->databaseConnection()) {
                # Get permission
                $delete_pay_run = $api->check_role_permissions($username, 299);
                $lock_pay_run = $api->check_role_permissions($username, 300);
                $unlock_pay_run = $api->check_role_permissions($username, 301);
                $send_payslip = $api->check_role_permissions($username, 302);
                $view_transaction_log = $api->check_role_permissions($username, 303);
                $payslip_page = $api->check_role_permissions($username, 304);
    
                $filter_pay_run_status = $_POST['filter_pay_run_status'];
                $filter_pay_run_start_date = $api->check_date('empty', $_POST['filter_pay_run_start_date'], '', 'Y-m-d', '', '', '');
                $filter_pay_run_end_date = $api->check_date('empty', $_POST['filter_pay_run_end_date'], '', 'Y-m-d', '', '', '');
                $filter_generated_start_date = $api->check_date('empty', $_POST['filter_generated_start_date'], '', 'Y-m-d', '', '', '');
                $filter_generated_end_date = $api->check_date('empty', $_POST['filter_generated_end_date'], '', 'Y-m-d', '', '', '');
    
                $query = 'SELECT PAY_RUN_ID, START_DATE, END_DATE, STATUS, GENERATION_DATE, GENERATION_TIME, TRANSACTION_LOG_ID FROM tblpayrun WHERE ';
    
                if(!empty($filter_pay_run_status) || (!empty($filter_pay_run_start_date) && !empty($filter_pay_run_end_date)) || (!empty($filter_generated_start_date) && !empty($filter_generated_end_date))){
                    if(!empty($filter_pay_run_status)){
                        $filter[] = 'STATUS = :filter_pay_run_status';
                    }

                    if(!empty($filter_pay_run_start_date) && !empty($filter_pay_run_end_date)){
                        $filter[] = 'START_DATE BETWEEN :filter_pay_run_start_date AND :filter_pay_run_end_date';
                    }

                    if(!empty($filter_generated_start_date) && !empty($filter_generated_end_date)){
                        $filter[] = 'GENERATION_DATE BETWEEN :filter_generated_start_date AND :filter_generated_end_date';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);

                if(!empty($filter_pay_run_status) || (!empty($filter_pay_run_start_date) && !empty($filter_pay_run_end_date)) || (!empty($filter_generated_start_date) && !empty($filter_generated_end_date))){
                    if(!empty($filter_pay_run_status)){
                        $sql->bindValue(':filter_pay_run_status', $filter_pay_run_status);
                    }

                    if(!empty($filter_pay_run_start_date) && !empty($filter_pay_run_end_date)){
                        $sql->bindValue(':filter_pay_run_start_date', $filter_pay_run_start_date);
                        $sql->bindValue(':filter_pay_run_end_date', $filter_pay_run_end_date);
                    }

                    if(!empty($filter_generated_start_date) && !empty($filter_generated_end_date)){
                        $sql->bindValue(':filter_generated_start_date', $filter_generated_start_date);
                        $sql->bindValue(':filter_generated_end_date', $filter_generated_end_date);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $pay_run_id = $row['PAY_RUN_ID'];
                        $status = $row['STATUS'];
                        $start_date = $api->check_date('empty', $row['START_DATE'], '', 'm/d/Y', '', '', '');
                        $end_date = $api->check_date('empty', $row['END_DATE'], '', 'm/d/Y', '', '', '');
                        $generation_date = $api->check_date('empty', $row['GENERATION_DATE'], '', 'm/d/Y', '', '', '');
                        $generation_time = $api->check_date('empty', $row['GENERATION_TIME'], '', 'h:i:s a', '', '', '');
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                        $pay_run_status = $api->get_pay_run_status($status)[0]['BADGE'];
                        $pay_run_id_encrypted = $api->encrypt_data($pay_run_id);

                        if($payslip_page > 0){
                            $payslip = '<a href="payslip.php?id='. $pay_run_id_encrypted .'" class="btn btn-warning waves-effect waves-light" title="View Payslip">
                                        <i class="bx bx-receipt font-size-16 align-middle"></i>
                                    </a>';
                        }
                        else{
                            $payslip = '';
                        }
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }

                        if($status == 'LOCK'){
                            if($unlock_pay_run > 0){
                                $lock_unlock = '<button class="btn btn-info waves-effect waves-light unlock-pay-run" title="Unlock Pay Run" data-pay-run-id="'. $pay_run_id .'">
                                <i class="bx bx-lock-open-alt font-size-16 align-middle"></i>
                                </button>';
                            }
                            else{
                                $lock_unlock = '';
                            }
    
                            $data_lock = '1';
                            $delete = '';

                            if($send_payslip > 0){
                                $send = '<button type="button" class="btn btn-success waves-effect waves-light send-payslip" data-pay-run-id="'. $pay_run_id .'" title="Send Payslip">
                                                <i class="bx bx-send font-size-16 align-middle"></i>
                                            </button>';
                            }
                            else{
                                $send = '';
                            }
                        }
                        else{
                            if($lock_pay_run > 0){
                                $lock_unlock = '<button class="btn btn-warning waves-effect waves-light lock-pay-run" title="Lock Pay Run" data-pay-run-id="'. $pay_run_id .'">
                                <i class="bx bx-lock-alt font-size-16 align-middle"></i>
                                </button>';
                            }
                            else{
                                $lock_unlock = '';
                            }

                            if($delete_pay_run > 0){
                                $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-pay-run" data-pay-run-id="'. $pay_run_id .'" title="Delete Salary">
                                            <i class="bx bx-trash font-size-16 align-middle"></i>
                                        </button>';
                            }
                            else{
                                $delete = '';
                            }
    
                            $data_lock = '0';
                            $send = '';
                        }

                        $response[] = array(
                            'CHECK_BOX' =>  '<input class="form-check-input datatable-checkbox-children" type="checkbox" data-lock="'. $data_lock .'" value="'. $pay_run_id .'">',
                            'PAY_RUN_ID' => $pay_run_id,
                            'COVERAGE_DATE' => $start_date . ' - ' . $end_date,
                            'GENERATION_DATE' => $generation_date . ' ' . $generation_time,
                            'STATUS' => $pay_run_status,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-pay-run" data-pay-run-id="'. $pay_run_id .'" title="View Pay Run">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $payslip .'
                                '. $send .'
                                '. $lock_unlock .'
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

    # Withholding tax table
    else if($type == 'withholding tax table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_contribution_bracket = $api->check_role_permissions($username, 311);
            $delete_contribution_bracket = $api->check_role_permissions($username, 312);
            $view_transaction_log = $api->check_role_permissions($username, 313);

            $sql = $api->db_connection->prepare('SELECT WITHHOLDING_TAX_ID, SALARY_FREQUENCY, START_RANGE, END_RANGE, FIX_COMPENSATION_LEVEL, BASE_TAX, PERCENT_OVER, TRANSACTION_LOG_ID FROM tblwithholdingtax');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $withholding_tax_id = $row['WITHHOLDING_TAX_ID'];
                    $salary_frequency = $api->get_system_code_details('SALARYFREQUENCY', $row['SALARY_FREQUENCY'])[0]['DESCRIPTION'];
                    $start_range = $row['START_RANGE'];
                    $end_range = $row['END_RANGE'];
                    $fix_compensation_level = $row['FIX_COMPENSATION_LEVEL'];
                    $base_tax = $row['BASE_TAX'];
                    $percent_rate = $row['PERCENT_OVER'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                    if($update_contribution_bracket > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-withholding-tax" data-withholding-tax-id="'. $withholding_tax_id .'" title="Edit Withholding Tax">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_contribution_bracket > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-withholding-tax" data-withholding-tax-id="'. $withholding_tax_id .'" title="Delete Withholding Tax">
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
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $withholding_tax_id .'">',
                        'SALARY_FREQUENCY' => $salary_frequency,
                        'COMPENSATION_RANGE' => number_format($start_range, 2) . ' - ' . number_format($end_range, 2),
                        'FIX_COMPENSATION_LEVEL' => number_format($fix_compensation_level, 2),
                        'BASE_TAX' => number_format($base_tax, 2),
                        'PERCENT_OVER' => number_format($percent_rate, 2),
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

    # Other income type table
    else if($type == 'other income type table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_other_income_type = $api->check_role_permissions($username, 318);
            $delete_other_income_type = $api->check_role_permissions($username, 319);
            $view_transaction_log = $api->check_role_permissions($username, 320);

            $sql = $api->db_connection->prepare('SELECT OTHER_INCOME_TYPE_ID, DESCRIPTION, OTHER_INCOME_TYPE, TAXABLE, TRANSACTION_LOG_ID FROM tblotherincometype ORDER BY OTHER_INCOME_TYPE');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $other_income_type_id = $row['OTHER_INCOME_TYPE_ID'];
                    $other_income_type = $row['OTHER_INCOME_TYPE'];
                    $description = $row['DESCRIPTION'];
                    $taxable = $row['TAXABLE'];
                    $other_income_type_status_name = $api->get_other_income_type_status($taxable)[0]['BADGE'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                    if($update_other_income_type > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-other-income-type" data-other-income-type-id="'. $other_income_type_id .'" title="Edit Other Income Type">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_other_income_type > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-other-income-type" data-other-income-type-id="'. $other_income_type_id .'" title="Delete Other Income Type">
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
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $other_income_type_id .'">',
                        'OTHER_INCOME_TYPE' => $other_income_type . '<p class="text-muted mb-0">'. $description .'</p>',
                        'TAXABLE' => $other_income_type_status_name,
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

    # Other income table
    else if($type == 'other income table'){
        if(isset($_POST['filter_branch']) && isset($_POST['filter_department']) && isset($_POST['filter_other_income_type']) && isset($_POST['filter_start_date']) && isset($_POST['filter_end_date'])){
            if ($api->databaseConnection()) {
                # Get permission
                $update_other_income = $api->check_role_permissions($username, 323);
                $delete_other_income = $api->check_role_permissions($username, 324);
                $view_transaction_log = $api->check_role_permissions($username, 325);
    
                $filter_branch = $_POST['filter_branch'];
                $filter_department = $_POST['filter_department'];
                $filter_other_income_type = $_POST['filter_other_income_type'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');
    
                $query = 'SELECT OTHER_INCOME_ID, EMPLOYEE_ID, OTHER_INCOME_TYPE, PAYROLL_ID, PAYROLL_DATE, AMOUNT, TRANSACTION_LOG_ID FROM tblotherincome WHERE ';
    
                if(!empty($filter_branch)  || !empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_other_income_type)){
                    if(!empty($filter_branch)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE BRANCH = :filter_branch)';
                    }

                    if(!empty($filter_department)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = :filter_department)';
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $filter[] = 'PAYROLL_DATE BETWEEN :filter_start_date AND :filter_end_date';
                    }

                    if(!empty($filter_other_income_type)){
                        $filter[] = 'OTHER_INCOME_TYPE = :filter_other_income_type';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);

                if(!empty($filter_branch)  || !empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date)) || !empty($filter_other_income_type)){
                    if(!empty($filter_branch)){
                        $sql->bindValue(':filter_branch', $filter_branch);
                    }

                    if(!empty($filter_department)){
                        $sql->bindValue(':filter_department', $filter_department);
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }

                    if(!empty($filter_other_income_type)){
                        $sql->bindValue(':filter_other_income_type', $filter_other_income_type);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $other_income_id = $row['OTHER_INCOME_ID'];
                        $employee_id = $row['EMPLOYEE_ID'];
                        $other_income_type = $row['OTHER_INCOME_TYPE'];
                        $payroll_id = $row['PAYROLL_ID'];
                        $amount = $row['AMOUNT'];
                        $payroll_date = $api->check_date('empty', $row['PAYROLL_DATE'], '', 'm/d/Y', '', '', '');
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                        $other_income_type_details = $api->get_other_income_type_details($other_income_type);
                        $other_income_type_name = $other_income_type_details[0]['OTHER_INCOME_TYPE'];
    
                        $employee_details = $api->get_employee_details($employee_id, '');
                        $file_as = $employee_details[0]['FILE_AS'];
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }

                        if(empty($payroll_id)){
                            if($update_other_income > 0){
                                $update = '<button type="button" class="btn btn-info waves-effect waves-light update-other-income" data-other-income-id="'. $other_income_id .'" title="Edit Other Income">
                                                <i class="bx bx-pencil font-size-16 align-middle"></i>
                                            </button>';
                            }
                            else{
                                $update = '';
                            }
        
                            if($delete_other_income > 0){
                                $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-other-income" data-other-income-id="'. $other_income_id .'" title="Delete Other Income">
                                            <i class="bx bx-trash font-size-16 align-middle"></i>
                                        </button>';
                            }
                            else{
                                $delete = '';
                            }

                            $check_box = '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $other_income_id .'">';
                        }
                        else{
                            $update = '';
                            $delete = '';
                            $check_box = '';
                        }
    
                        $response[] = array(
                            'CHECK_BOX' => $check_box,
                            'FILE_AS' => $file_as,
                            'OTHER_INCOME_TYPE' => $other_income_type_name,
                            'PAYROLL_DATE' => $payroll_date,
                            'AMOUNT' => number_format($amount, 2),
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-other-income" data-other-income-id="'. $other_income_id .'" title="View Other Income">
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

    # Payslip table
    else if($type == 'payslip table'){
        if(isset($_POST['pay_run_id']) && !empty($_POST['pay_run_id']) && isset($_POST['filter_branch']) && isset($_POST['filter_department'])){
            if ($api->databaseConnection()) {
                # Get permission
                $delete_payslip = $api->check_role_permissions($username, 305);
                $send_payslip = $api->check_role_permissions($username, 306);
                $print_payslip = $api->check_role_permissions($username, 307);
                $view_transaction_log = $api->check_role_permissions($username, 308);
    
                $pay_run_id = $_POST['pay_run_id'];
                $filter_branch = $_POST['filter_branch'];
                $filter_department = $_POST['filter_department'];

                # Pay run details
                $pay_run_details = $api->get_pay_run_details($pay_run_id);
                $start_date = $api->check_date('empty', $pay_run_details[0]['START_DATE'], '', 'm/d/Y', '', '', '');
                $end_date = $api->check_date('empty', $pay_run_details[0]['END_DATE'], '', 'm/d/Y', '', '', '');
                $pay_run_status = $pay_run_details[0]['STATUS'];
    
                $query = 'SELECT PAYSLIP_ID, EMPLOYEE_ID, GROSS_PAY, NET_PAY, TRANSACTION_LOG_ID FROM tblpayslip WHERE PAY_RUN_ID = :pay_run_id';
    
                if(!empty($filter_branch) || !empty($filter_department)){
                    $query .= ' AND ';

                    if(!empty($filter_branch)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE BRANCH = :filter_branch)';
                    }

                    if(!empty($filter_department)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = :filter_department)';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':pay_run_id', $pay_run_id);

                if(!empty($filter_branch) || !empty($filter_department)){
                    if(!empty($filter_branch)){
                        $sql->bindValue(':filter_branch', $filter_branch);
                    }

                    if(!empty($filter_department)){
                        $sql->bindValue(':filter_department', $filter_department);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $payslip_id = $row['PAYSLIP_ID'];
                        $employee_id = $row['EMPLOYEE_ID'];
                        $gross_pay = $row['GROSS_PAY'];
                        $net_pay = $row['NET_PAY'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                        $payslip_id_encrypted = $api->encrypt_data($payslip_id);

                        $employee_details = $api->get_employee_details($employee_id, '');
                        $file_as = $employee_details[0]['FILE_AS'];
                        $department = $employee_details[0]['DEPARTMENT'];
                        $email = $employee_details[0]['EMAIL'];
                        $validate_email = $api->validate_email($email);

                        $department_details = $api->get_department_details($department);
                        $department_name = $department_details[0]['DEPARTMENT'];
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }

                        if($pay_run_status == 'LOCK'){
                            if($send_payslip > 0 && (!empty($email) && $validate_email)){
                                $send = '<button type="button" class="btn btn-success waves-effect waves-light send-payslip" data-payslip-id="'. $payslip_id .'" title="Send Payslip">
                                            <i class="bx bx-send font-size-16 align-middle"></i>
                                        </button>';
                            }
                            else{
                                $send = '';
                            }

                            if($print_payslip > 0){
                                $print = '<a href="payslip-print.php?id='. $payslip_id_encrypted .'" class="btn btn-info waves-effect waves-light" target="_blank" title="Print Payslip">
                                                <i class="bx bx-printer font-size-16 align-middle"></i>
                                            </a>';
                            }
                            else{
                                $print = '';
                            }

                            $delete = '';
                        }
                        else{
                            if($delete_payslip > 0){
                                $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-payslip" data-payslip-id="'. $payslip_id .'" title="Delete Payslip">
                                            <i class="bx bx-trash font-size-16 align-middle"></i>
                                        </button>';
                            }
                            else{
                                $delete = '';
                            }

                            $send = '';
                            $print = '';
                        }
    
                        $response[] = array(
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" data-send="1" data-print="1" type="checkbox" value="'. $payslip_id .'">',
                            'FILE_AS' => $file_as . '<p class="text-muted mb-0">'. $department_name .'</p>',
                            'PAY_RUN' => $start_date . ' - ' . $end_date,
                            'GROSS_PAY' => number_format($gross_pay, 2),
                            'NET_PAY' => number_format($net_pay, 2),
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-payslip" data-payslip-id="'. $payslip_id .'" title="View Payslip">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $send .'
                                '. $print .'
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

    # Payroll summary table
    else if($type == 'payroll summary table'){
        if(isset($_POST['filter_start_date']) && isset($_POST['filter_end_date']) && isset($_POST['filter_branch']) && isset($_POST['filter_department'])){
            if ($api->databaseConnection()) {
                # Get permission
                $delete_payslip = $api->check_role_permissions($username, 305);
                $send_payslip = $api->check_role_permissions($username, 306);
                $print_payslip = $api->check_role_permissions($username, 307);
                $view_transaction_log = $api->check_role_permissions($username, 308);
    
                $filter_branch = $_POST['filter_branch'];
                $filter_department = $_POST['filter_department'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');
    
                $query = 'SELECT PAYSLIP_ID, PAY_RUN_ID, EMPLOYEE_ID, GROSS_PAY, NET_PAY, TRANSACTION_LOG_ID FROM tblpayslip';
    
                if(!empty($filter_branch) || !empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date))){
                    $query .= ' WHERE ';

                    if(!empty($filter_branch)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE BRANCH = :filter_branch)';
                    }

                    if(!empty($filter_department)){
                        $filter[] = 'EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = :filter_department)';
                    }

                    if((!empty($filter_start_date) && !empty($filter_end_date))){
                        $filter[] = 'PAY_RUN_ID IN (SELECT PAY_RUN_ID FROM tblpayrun WHERE START_DATE BETWEEN :filter_start_date AND :filter_start_date)';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);

                if(!empty($filter_branch) || !empty($filter_department) || (!empty($filter_start_date) && !empty($filter_end_date))){
                    if(!empty($filter_branch)){
                        $sql->bindValue(':filter_branch', $filter_branch);
                    }

                    if(!empty($filter_department)){
                        $sql->bindValue(':filter_department', $filter_department);
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $payslip_id = $row['PAYSLIP_ID'];
                        $pay_run_id = $row['PAY_RUN_ID'];
                        $employee_id = $row['EMPLOYEE_ID'];
                        $gross_pay = $row['GROSS_PAY'];
                        $net_pay = $row['NET_PAY'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                        $payslip_id_encrypted = $api->encrypt_data($payslip_id);

                        $pay_run_details = $api->get_pay_run_details($pay_run_id);
                        $start_date = $api->check_date('empty', $pay_run_details[0]['START_DATE'], '', 'm/d/Y', '', '', '');
                        $end_date = $api->check_date('empty', $pay_run_details[0]['END_DATE'], '', 'm/d/Y', '', '', '');
                        $pay_run_status = $pay_run_details[0]['STATUS'];

                        $employee_details = $api->get_employee_details($employee_id, '');
                        $file_as = $employee_details[0]['FILE_AS'];
                        $department = $employee_details[0]['DEPARTMENT'];
                        $email = $employee_details[0]['EMAIL'];
                        $validate_email = $api->validate_email($email);

                        $department_details = $api->get_department_details($department);
                        $department_name = $department_details[0]['DEPARTMENT'];
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }

                        if($pay_run_status == 'LOCK'){
                            if($send_payslip > 0 && (!empty($email) && $validate_email)){
                                $send = '<button type="button" class="btn btn-success waves-effect waves-light send-payslip" data-payslip-id="'. $payslip_id .'" title="Send Payslip">
                                            <i class="bx bx-send font-size-16 align-middle"></i>
                                        </button>';
                            }
                            else{
                                $send = '';
                            }

                            if($print_payslip > 0){
                                $print = '<a href="payslip-print.php?id='. $payslip_id_encrypted .'" class="btn btn-info waves-effect waves-light" target="_blank" title="Print Payslip">
                                                <i class="bx bx-printer font-size-16 align-middle"></i>
                                            </a>';
                            }
                            else{
                                $print = '';
                            }

                            $delete = '';
                        }
                        else{
                            if($delete_payslip > 0){
                                $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-payslip" data-payslip-id="'. $payslip_id .'" title="Delete Payslip">
                                            <i class="bx bx-trash font-size-16 align-middle"></i>
                                        </button>';
                            }
                            else{
                                $delete = '';
                            }

                            $send = '';
                            $print = '';
                        }
    
                        $response[] = array(
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" data-send="1" data-print="1" type="checkbox" value="'. $payslip_id .'">',
                            'FILE_AS' => $file_as . '<p class="text-muted mb-0">'. $department_name .'</p>',
                            'PAY_RUN' => $start_date . ' - ' . $end_date,
                            'GROSS_PAY' => number_format($gross_pay, 2),
                            'NET_PAY' => number_format($net_pay, 2),
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-payslip" data-payslip-id="'. $payslip_id .'" title="View Payslip">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $send .'
                                '. $print .'
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

    # Employee payroll summary
    else if($type == 'employee payroll summary table'){
        if(isset($_POST['employee_id']) && !empty(isset($_POST['employee_id'])) && isset($_POST['filter_employee_payroll_summary_start_date']) && isset($_POST['filter_employee_payroll_summary_end_date'])){
            if ($api->databaseConnection()) {
                # Get permission
                $delete_payslip = $api->check_role_permissions($username, 334);
                $send_payslip = $api->check_role_permissions($username, 335);
                $print_payslip = $api->check_role_permissions($username, 336);
                $view_transaction_log = $api->check_role_permissions($username, 337);
    
                $employee_id = $_POST['employee_id'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_employee_payroll_summary_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_employee_payroll_summary_end_date'], '', 'Y-m-d', '', '', '');

                $employee_details = $api->get_employee_details($employee_id, '');
                $email = $employee_details[0]['EMAIL'] ?? null;
                $validate_email = $api->validate_email($email);
    
                $query = 'SELECT PAYSLIP_ID, PAY_RUN_ID, GROSS_PAY, NET_PAY, TRANSACTION_LOG_ID FROM tblpayslip WHERE EMPLOYEE_ID = :employee_id AND PAY_RUN_ID IN (SELECT PAY_RUN_ID FROM tblpayrun WHERE STATUS = "LOCK")';
    
                if(!empty($filter_start_date) && !empty($filter_end_date)){
                    $query .= ' AND PAY_RUN_ID IN (SELECT PAY_RUN_ID FROM tblpayrun WHERE START_DATE BETWEEN :filter_start_date AND :filter_start_date)';
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);

                if(!empty($filter_start_date) && !empty($filter_end_date)){
                    $sql->bindValue(':filter_start_date', $filter_start_date);
                    $sql->bindValue(':filter_end_date', $filter_end_date);
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $payslip_id = $row['PAYSLIP_ID'];
                        $pay_run_id = $row['PAY_RUN_ID'];
                        $gross_pay = $row['GROSS_PAY'];
                        $net_pay = $row['NET_PAY'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                        $payslip_id_encrypted = $api->encrypt_data($payslip_id);

                        $pay_run_details = $api->get_pay_run_details($pay_run_id);
                        $start_date = $api->check_date('empty', $pay_run_details[0]['START_DATE'], '', 'm/d/Y', '', '', '');
                        $end_date = $api->check_date('empty', $pay_run_details[0]['END_DATE'], '', 'm/d/Y', '', '', '');
                        $pay_run_status = $pay_run_details[0]['STATUS'];
    
                        if($view_transaction_log > 0 && !empty($transaction_log_id)){
                            $transaction_log = '<button type="button" class="btn btn-dark waves-effect waves-light view-transaction-log" data-transaction-log-id="'. $transaction_log_id .'" title="View Transaction Log">
                                                    <i class="bx bx-detail font-size-16 align-middle"></i>
                                                </button>';
                        }
                        else{
                            $transaction_log = '';
                        }

                        if($pay_run_status == 'LOCK'){
                            if($send_payslip > 0 && (!empty($email) && $validate_email)){
                                $send = '<button type="button" class="btn btn-success waves-effect waves-light send-employee-payslip" data-payslip-id="'. $payslip_id .'" title="Send Payslip">
                                            <i class="bx bx-send font-size-16 align-middle"></i>
                                        </button>';
                            }
                            else{
                                $send = '';
                            }

                            if($print_payslip > 0){
                                $print = '<a href="payslip-print.php?id='. $payslip_id_encrypted .'" class="btn btn-info waves-effect waves-light" target="_blank" title="Print Payslip">
                                                <i class="bx bx-printer font-size-16 align-middle"></i>
                                            </a>';
                            }
                            else{
                                $print = '';
                            }

                            $delete = '';
                        }
                        else{
                            if($delete_payslip > 0){
                                $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-employee-payslip" data-payslip-id="'. $payslip_id .'" title="Delete Payslip">
                                            <i class="bx bx-trash font-size-16 align-middle"></i>
                                        </button>';
                            }
                            else{
                                $delete = '';
                            }

                            $send = '';
                            $print = '';
                        }
    
                        $response[] = array(
                            'PAY_RUN' => $start_date . ' - ' . $end_date,
                            'GROSS_PAY' => number_format($gross_pay, 2),
                            'NET_PAY' => number_format($net_pay, 2),
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-payslip" data-payslip-id="'. $payslip_id .'" title="View Payslip">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $send .'
                                '. $print .'
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

    # Profile payroll summary
    else if($type == 'profile payroll summary table'){
        if(isset($_POST['employee_id']) && !empty(isset($_POST['employee_id'])) && isset($_POST['filter_employee_payroll_summary_start_date']) && isset($_POST['filter_employee_payroll_summary_end_date'])){
            if ($api->databaseConnection()) {    
                $employee_id = $_POST['employee_id'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_employee_payroll_summary_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_employee_payroll_summary_end_date'], '', 'Y-m-d', '', '', '');

                $employee_details = $api->get_employee_details($employee_id, '');
                $email = $employee_details[0]['EMAIL'];
                $validate_email = $api->validate_email($email);
    
                $query = 'SELECT PAYSLIP_ID, PAY_RUN_ID, GROSS_PAY, NET_PAY, TRANSACTION_LOG_ID FROM tblpayslip WHERE EMPLOYEE_ID = :employee_id AND PAY_RUN_ID IN (SELECT PAY_RUN_ID FROM tblpayrun WHERE STATUS = "LOCK")';
    
                if(!empty($filter_start_date) && !empty($filter_end_date)){
                    $query .= ' AND PAY_RUN_ID IN (SELECT PAY_RUN_ID FROM tblpayrun WHERE START_DATE BETWEEN :filter_start_date AND :filter_start_date)';
                }
    
                $sql = $api->db_connection->prepare($query);
                $sql->bindValue(':employee_id', $employee_id);

                if(!empty($filter_start_date) && !empty($filter_end_date)){
                    $sql->bindValue(':filter_start_date', $filter_start_date);
                    $sql->bindValue(':filter_end_date', $filter_end_date);
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $payslip_id = $row['PAYSLIP_ID'];
                        $pay_run_id = $row['PAY_RUN_ID'];
                        $gross_pay = $row['GROSS_PAY'];
                        $net_pay = $row['NET_PAY'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                        $payslip_id_encrypted = $api->encrypt_data($payslip_id);

                        $pay_run_details = $api->get_pay_run_details($pay_run_id);
                        $start_date = $api->check_date('empty', $pay_run_details[0]['START_DATE'], '', 'm/d/Y', '', '', '');
                        $end_date = $api->check_date('empty', $pay_run_details[0]['END_DATE'], '', 'm/d/Y', '', '', '');
                        $pay_run_status = $pay_run_details[0]['STATUS'];
    
                        $response[] = array(
                            'PAY_RUN' => $start_date . ' - ' . $end_date,
                            'GROSS_PAY' => number_format($gross_pay, 2),
                            'NET_PAY' => number_format($net_pay, 2),
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-payslip" data-payslip-id="'. $payslip_id .'" title="View Payslip">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                <a href="payslip-print.php?id='. $payslip_id_encrypted .'" class="btn btn-info waves-effect waves-light" target="_blank" title="Print Payslip">
                                    <i class="bx bx-printer font-size-16 align-middle"></i>
                                </a>
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

    # Job category table
    else if($type == 'job category table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_job_category = $api->check_role_permissions($username, 342);
            $delete_job_category = $api->check_role_permissions($username, 343);
            $view_transaction_log = $api->check_role_permissions($username, 344);

            $sql = $api->db_connection->prepare('SELECT JOB_CATEGORY_ID, JOB_CATEGORY, DESCRIPTION, TRANSACTION_LOG_ID FROM tbljobcategory ORDER BY JOB_CATEGORY');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $job_category_id = $row['JOB_CATEGORY_ID'];
                    $job_category = $row['JOB_CATEGORY'];
                    $description = $row['DESCRIPTION'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                    if($update_job_category > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-job-category" data-job-category-id="'. $job_category_id .'" title="Edit Job Category">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_job_category > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-job-category" data-job-category-id="'. $job_category_id .'" title="Delete Job Category">
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
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $job_category_id .'">',
                        'JOB_CATEGORY' => $job_category . '<p class="text-muted mb-0">'. $description .'</p>',
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

    # Job type table
    else if($type == 'job type table'){
        if ($api->databaseConnection()) {
            # Get permission
            $update_job_type = $api->check_role_permissions($username, 347);
            $delete_job_type = $api->check_role_permissions($username, 348);
            $view_transaction_log = $api->check_role_permissions($username, 349);

            $sql = $api->db_connection->prepare('SELECT JOB_TYPE_ID, JOB_TYPE, DESCRIPTION, TRANSACTION_LOG_ID FROM tbljobtype ORDER BY JOB_TYPE');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $job_type_id = $row['JOB_TYPE_ID'];
                    $job_type = $row['JOB_TYPE'];
                    $description = $row['DESCRIPTION'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                    if($update_job_type > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-job-type" data-job-type-id="'. $job_type_id .'" title="Edit Job Type">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_job_type > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-job-type" data-job-type-id="'. $job_type_id .'" title="Delete Job Type">
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
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $job_type_id .'">',
                        'JOB_TYPE' => $job_type . '<p class="text-muted mb-0">'. $description .'</p>',
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

    # Recruitment pipeline table
    else if($type == 'recruitment pipeline table'){
        if ($api->databaseConnection()) {
            # Get permission
            $recruitment_pipeline_stage_page = $api->check_role_permissions($username, 355);
            $update_recruitment_pipeline = $api->check_role_permissions($username, 352);
            $delete_recruitment_pipeline = $api->check_role_permissions($username, 353);
            $view_transaction_log = $api->check_role_permissions($username, 354);

            $sql = $api->db_connection->prepare('SELECT RECRUITMENT_PIPELINE_ID, RECRUITMENT_PIPELINE, DESCRIPTION, TRANSACTION_LOG_ID FROM tblrecruitmentpipeline ORDER BY RECRUITMENT_PIPELINE');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $recruitment_pipeline_id = $row['RECRUITMENT_PIPELINE_ID'];
                    $recruitment_pipeline = $row['RECRUITMENT_PIPELINE'];
                    $description = $row['DESCRIPTION'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                    $recruitment_pipeline_id_encrypted = $api->encrypt_data($recruitment_pipeline_id);

                    if($recruitment_pipeline_stage_page > 0){
                        $pipeline_stage = '<a href="recruitment-pipeline-stage.php?id='. $recruitment_pipeline_id_encrypted .'" class="btn btn-success waves-effect waves-light" title="View Recruitment Pipeline Stage">
                                    <i class="bx bx-stats font-size-16 align-middle"></i>
                                </a>';
                    }
                    else{
                        $pipeline_stage = '';
                    }

                    if($update_recruitment_pipeline > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-recruitment-pipeline" data-recruitment-pipeline-id="'. $recruitment_pipeline_id .'" title="Edit Recruitment Pipeline">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_recruitment_pipeline > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-recruitment-pipeline" data-recruitment-pipeline-id="'. $recruitment_pipeline_id .'" title="Delete Recruitment Pipeline">
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
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $recruitment_pipeline_id .'">',
                        'RECRUITMENT_PIPELINE' => $recruitment_pipeline . '<p class="text-muted mb-0">'. $description .'</p>',
                        'ACTION' => '<div class="d-flex gap-2">
                            '. $update .'
                            '. $pipeline_stage .'
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

    # Recruitment pipeline stage table
    else if($type == 'recruitment pipeline stage table'){
        if(isset($_POST['recruitment_pipeline_id']) && !empty($_POST['recruitment_pipeline_id'])){
            if ($api->databaseConnection()) {
                # Get permission
                $update_recruitment_pipeline_stage = $api->check_role_permissions($username, 357);
                $delete_recruitment_pipeline_stage = $api->check_role_permissions($username, 358);
                $view_transaction_log = $api->check_role_permissions($username, 359);

                $recruitment_pipeline_id = $_POST['recruitment_pipeline_id'];
                $last_recruitment_pipeline_stage_order = $api->get_last_recruitment_pipeline_stage_order($recruitment_pipeline_id);
    
                $sql = $api->db_connection->prepare('SELECT RECRUITMENT_PIPELINE_STAGE_ID, RECRUITMENT_PIPELINE_STAGE, DESCRIPTION, STAGE_ORDER, TRANSACTION_LOG_ID FROM tblrecruitmentpipelinestage WHERE RECRUITMENT_PIPELINE_ID = :recruitment_pipeline_id ORDER BY STAGE_ORDER');
                $sql->bindValue(':recruitment_pipeline_id', $recruitment_pipeline_id);
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $recruitment_pipeline_stage_id = $row['RECRUITMENT_PIPELINE_STAGE_ID'];
                        $recruitment_pipeline_stage = $row['RECRUITMENT_PIPELINE_STAGE'];
                        $stage_order = $row['STAGE_ORDER'];
                        $description = $row['DESCRIPTION'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                        if($last_recruitment_pipeline_stage_order == 1){
                            $button_order = '';
                        }
                        else{
                            if($stage_order == 1){
                                $button_order = '<button type="button" class="btn btn-warning waves-effect waves-light recruitment-pipeline-stage-order-down" data-recruitment-pipeline-stage-id="'. $recruitment_pipeline_stage_id .'" data-stage-order="'. $stage_order .'" title="Recruitment Pipeline Order Down">
                                    <i class="bx bx-down-arrow-alt font-size-16 align-middle"></i>
                                </button>';
                            }
                            else if($stage_order == $last_recruitment_pipeline_stage_order){
                                $button_order = '<button type="button" class="btn btn-success waves-effect waves-light recruitment-pipeline-stage-order-up" data-recruitment-pipeline-stage-id="'. $recruitment_pipeline_stage_id .'" data-stage-order="'. $stage_order .'" title="Recruitment Pipeline Order Up">
                                    <i class="bx bx-up-arrow-alt font-size-16 align-middle"></i>
                                </button>';
                            }
                            else{
                                $button_order = '<button type="button" class="btn btn-success waves-effect waves-light recruitment-pipeline-stage-order-up" data-recruitment-pipeline-stage-id="'. $recruitment_pipeline_stage_id .'" data-stage-order="'. $stage_order .'" title="Recruitment Pipeline Order Up">
                                    <i class="bx bx-up-arrow-alt font-size-16 align-middle"></i>
                                </button>
                                <button type="button" class="btn btn-warning waves-effect waves-light recruitment-pipeline-stage-order-down" data-recruitment-pipeline-stage-id="'. $recruitment_pipeline_stage_id .'" data-stage-order="'. $stage_order .'" title="Recruitment Pipeline Order Down">
                                    <i class="bx bx-down-arrow-alt font-size-16 align-middle"></i>
                                </button>';
                            }
                        }
    
                        if($update_recruitment_pipeline_stage > 0){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-recruitment-pipeline-stage" data-recruitment-pipeline-stage-id="'. $recruitment_pipeline_stage_id .'" title="Edit Recruitment Pipeline">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }
    
                        if($delete_recruitment_pipeline_stage > 0){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-recruitment-pipeline-stage" data-recruitment-pipeline-stage-id="'. $recruitment_pipeline_stage_id .'" title="Delete Recruitment Pipeline">
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
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $recruitment_pipeline_stage_id .'">',
                            'STAGE_ORDER' => number_format($stage_order),
                            'RECRUITMENT_PIPELINE_STAGE' => $recruitment_pipeline_stage . '<p class="text-muted mb-0">'. $description .'</p>',
                            'ACTION' => '<div class="d-flex gap-2">
                                '. $update .'
                                '. $button_order .'
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

    # Recruitment scorecard table
    else if($type == 'recruitment scorecard table'){
        if ($api->databaseConnection()) {
            # Get permission
            $recruitment_scorecard_section_page = $api->check_role_permissions($username, 365);
            $update_recruitment_scorecard = $api->check_role_permissions($username, 362);
            $delete_recruitment_scorecard = $api->check_role_permissions($username, 363);
            $view_transaction_log = $api->check_role_permissions($username, 364);

            $sql = $api->db_connection->prepare('SELECT RECRUITMENT_SCORECARD_ID, RECRUITMENT_SCORECARD, DESCRIPTION, TRANSACTION_LOG_ID FROM tblrecruitmentscorecard ORDER BY RECRUITMENT_SCORECARD');

            if($sql->execute()){
                while($row = $sql->fetch()){
                    $recruitment_scorecard_id = $row['RECRUITMENT_SCORECARD_ID'];
                    $recruitment_scorecard = $row['RECRUITMENT_SCORECARD'];
                    $description = $row['DESCRIPTION'];
                    $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                    $recruitment_scorecard_id_encrypted = $api->encrypt_data($recruitment_scorecard_id);

                    if($recruitment_scorecard_section_page > 0){
                        $scorecard_section = '<a href="recruitment-scorecard-section.php?id='. $recruitment_scorecard_id_encrypted .'" class="btn btn-warning waves-effect waves-light" title="View Recruitment Scorecard Section">
                                    <i class="bx bx-columns font-size-16 align-middle"></i>
                                </a>';
                    }
                    else{
                        $scorecard_section = '';
                    }

                    if($update_recruitment_scorecard > 0){
                        $update = '<button type="button" class="btn btn-info waves-effect waves-light update-recruitment-scorecard" data-recruitment-scorecard-id="'. $recruitment_scorecard_id .'" title="Edit Recruitment Scorecard">
                                        <i class="bx bx-pencil font-size-16 align-middle"></i>
                                    </button>';
                    }
                    else{
                        $update = '';
                    }

                    if($delete_recruitment_scorecard > 0){
                        $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-recruitment-scorecard" data-recruitment-scorecard-id="'. $recruitment_scorecard_id .'" title="Delete Recruitment Scorecard">
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
                        'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $recruitment_scorecard_id .'">',
                        'RECRUITMENT_SCORECARD' => $recruitment_scorecard . '<p class="text-muted mb-0">'. $description .'</p>',
                        'ACTION' => '<div class="d-flex gap-2">
                            '. $update .'
                            '. $scorecard_section .'
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

    # Recruitment scorecard section table
    else if($type == 'recruitment scorecard section table'){
        if(isset($_POST['recruitment_scorecard_id']) && !empty($_POST['recruitment_scorecard_id'])){
            if ($api->databaseConnection()) {
                # Get permission
                $recruitment_scorecard_section_option_page = $api->check_role_permissions($username, 370);
                $update_recruitment_scorecard_section = $api->check_role_permissions($username, 367);
                $delete_recruitment_scorecard_section = $api->check_role_permissions($username, 368);
                $view_transaction_log = $api->check_role_permissions($username, 369);

                $recruitment_scorecard_id = $_POST['recruitment_scorecard_id'];
    
                $sql = $api->db_connection->prepare('SELECT RECRUITMENT_SCORECARD_SECTION_ID, RECRUITMENT_SCORECARD_SECTION, DESCRIPTION, TRANSACTION_LOG_ID FROM tblrecruitmentscorecardsection WHERE RECRUITMENT_SCORECARD_ID = :recruitment_scorecard_id ORDER BY RECRUITMENT_SCORECARD_SECTION');
                $sql->bindValue(':recruitment_scorecard_id', $recruitment_scorecard_id);
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $recruitment_scorecard_section_id = $row['RECRUITMENT_SCORECARD_SECTION_ID'];
                        $recruitment_scorecard_section = $row['RECRUITMENT_SCORECARD_SECTION'];
                        $description = $row['DESCRIPTION'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
                        $recruitment_scorecard_section_id_encrypted = $api->encrypt_data($recruitment_scorecard_section_id);

                        if($recruitment_scorecard_section_option_page > 0){
                            $scorecard_section_option = '<a href="recruitment-scorecard-section-option.php?id='. $recruitment_scorecard_section_id_encrypted .'" class="btn btn-success waves-effect waves-light" title="View Recruitment Scorecard Section Option">
                                        <i class="bx bx bx-list-ol font-size-16 align-middle"></i>
                                    </a>';
                        }
                        else{
                            $scorecard_section_option = '';
                        }
    
                        if($update_recruitment_scorecard_section > 0){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-recruitment-scorecard-section" data-recruitment-scorecard-section-id="'. $recruitment_scorecard_section_id .'" title="Edit Recruitment Scorecard Section">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }
    
                        if($delete_recruitment_scorecard_section > 0){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-recruitment-scorecard-section" data-recruitment-scorecard-section-id="'. $recruitment_scorecard_section_id .'" title="Delete Recruitment Scorecard Section">
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
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $recruitment_scorecard_section_id .'">',
                            'RECRUITMENT_SCORECARD_SECTION' => $recruitment_scorecard_section . '<p class="text-muted mb-0">'. $description .'</p>',
                            'ACTION' => '<div class="d-flex gap-2">
                                '. $update .'
                                '. $scorecard_section_option .'
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

    # Recruitment scorecard section table
    else if($type == 'recruitment scorecard section option table'){
        if(isset($_POST['recruitment_scorecard_section_id']) && !empty($_POST['recruitment_scorecard_section_id'])){
            if ($api->databaseConnection()) {
                # Get permission
                $update_recruitment_scorecard_section_option = $api->check_role_permissions($username, 372);
                $delete_recruitment_scorecard_section_option = $api->check_role_permissions($username, 373);
                $view_transaction_log = $api->check_role_permissions($username, 374);

                $recruitment_scorecard_section_id = $_POST['recruitment_scorecard_section_id'];
    
                $sql = $api->db_connection->prepare('SELECT RECRUITMENT_SCORECARD_SECTION_OPTION_ID, RECRUITMENT_SCORECARD_SECTION_OPTION, TRANSACTION_LOG_ID FROM tblrecruitmentscorecardsectionoption WHERE RECRUITMENT_SCORECARD_SECTION_ID = :recruitment_scorecard_section_id ORDER BY RECRUITMENT_SCORECARD_SECTION_OPTION');
                $sql->bindValue(':recruitment_scorecard_section_id', $recruitment_scorecard_section_id);
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $recruitment_scorecard_section_option_id = $row['RECRUITMENT_SCORECARD_SECTION_OPTION_ID'];
                        $recruitment_scorecard_section_option = $row['RECRUITMENT_SCORECARD_SECTION_OPTION'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];
    
                        if($update_recruitment_scorecard_section_option > 0){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-recruitment-scorecard-section-option" data-recruitment-scorecard-section-option-id="'. $recruitment_scorecard_section_option_id .'" title="Edit Recruitment Scorecard Section Optioin">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }
    
                        if($delete_recruitment_scorecard_section_option > 0){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-recruitment-scorecard-section-option" data-recruitment-scorecard-section-option-id="'. $recruitment_scorecard_section_option_id .'" title="Delete Recruitment Scorecard Section Optioin">
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
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $recruitment_scorecard_section_option_id .'">',
                            'RECRUITMENT_SCORECARD_SECTION_OPTION' => $recruitment_scorecard_section_option,
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

    # Job table
    else if($type == 'job table'){
        if(isset($_POST['filter_job_type']) && isset($_POST['filter_job_category']) && isset($_POST['filter_recruitment_pipeline']) && isset($_POST['filter_recruitment_scorecard']) && isset($_POST['filter_status']) && isset($_POST['filter_team_member'])){
            if ($api->databaseConnection()) {
                # Get permission
                $update_job = $api->check_role_permissions($username, 377);
                $delete_job = $api->check_role_permissions($username, 378);
                $activate_job = $api->check_role_permissions($username, 379);
                $deactivate_job = $api->check_role_permissions($username, 380);
                $view_transaction_log = $api->check_role_permissions($username, 381);

                $filter_branch = $_POST['filter_branch'];
                $filter_job_type = $_POST['filter_job_type'];
                $filter_job_category = $_POST['filter_job_category'];
                $filter_recruitment_pipeline = $_POST['filter_recruitment_pipeline'];
                $filter_recruitment_scorecard = $_POST['filter_recruitment_scorecard'];
                $filter_status = $_POST['filter_status'];
                $filter_team_member = $_POST['filter_team_member'];

                $query = 'SELECT JOB_ID, JOB_TITLE, JOB_CATEGORY, JOB_TYPE, STATUS, TRANSACTION_LOG_ID FROM tbljob';
    
                if(!empty($filter_branch) || !empty($filter_job_type) || !empty($filter_job_category) || !empty($filter_recruitment_pipeline) || !empty($filter_recruitment_scorecard) || !empty($filter_status) || !empty($filter_team_member)){
                    $query .= ' WHERE ';

                    if(!empty($filter_branch)){
                        $filter[] = 'JOB_ID IN (SELECT JOB_ID FROM tbljobbranch WHERE BRANCH_ID = :filter_branch)';
                    }

                    if(!empty($filter_team_member)){
                        $filter[] = 'JOB_ID IN (SELECT JOB_ID FROM tbljobteam WHERE EMPLOYEE_ID = :filter_team_member)';
                    }

                    if(!empty($filter_job_category)){
                        $filter[] = 'JOB_CATEGORY = :filter_job_category';
                    }

                    if(!empty($filter_job_type)){
                        $filter[] = 'JOB_TYPE = :filter_job_type';
                    }

                    if(!empty($filter_recruitment_pipeline)){
                        $filter[] = 'PIPELINE = :filter_recruitment_pipeline';
                    }

                    if(!empty($filter_recruitment_scorecard)){
                        $filter[] = 'SCORECARD = :filter_recruitment_scorecard';
                    }

                    if(!empty($filter_status)){
                        $filter[] = 'STATUS = :filter_status';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
    
                $sql = $api->db_connection->prepare($query);

                if(!empty($filter_branch) || !empty($filter_job_type) || !empty($filter_job_category) || !empty($filter_recruitment_pipeline) || !empty($filter_recruitment_scorecard) || !empty($filter_status) || !empty($filter_team_member)){
                    if(!empty($filter_branch)){
                        $sql->bindValue(':filter_branch', $filter_branch);
                    }

                    if(!empty($filter_team_member)){
                        $sql->bindValue(':filter_team_member', $filter_team_member);
                    }

                    if(!empty($filter_job_category)){
                        $sql->bindValue(':filter_job_category', $filter_job_category);
                    }

                    if(!empty($filter_job_type)){
                        $sql->bindValue(':filter_job_type', $filter_job_type);
                    }

                    if(!empty($filter_recruitment_pipeline)){
                        $sql->bindValue(':filter_recruitment_pipeline', $filter_recruitment_pipeline);
                    }

                    if(!empty($filter_recruitment_scorecard)){
                        $sql->bindValue(':filter_recruitment_scorecard', $filter_recruitment_scorecard);
                    }

                    if(!empty($filter_status)){
                        $sql->bindValue(':filter_status', $filter_status);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $job_id = $row['JOB_ID'];
                        $job_title = $row['JOB_TITLE'];
                        $job_category = $row['JOB_CATEGORY'];
                        $job_type = $row['JOB_TYPE'];
                        $status = $row['STATUS'];
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                        $status_name = $api->get_job_status($status)[0]['BADGE'];

                        $job_category_details = $api->get_job_category_details($job_category);
                        $job_category_name = $job_category_details[0]['JOB_CATEGORY'];

                        $job_type_details = $api->get_job_type_details($job_type);
                        $job_type_name = $job_type_details[0]['JOB_TYPE'];

                        if($status == 'ACT'){
                            if($deactivate_job > 0){
                                $active_inactive = '<button class="btn btn-danger waves-effect waves-light deactivate-job title="Deactivate Job" data-job-id="'. $job_id .'">
                                <i class="bx bx-x font-size-16 align-middle"></i>
                                </button>';
                            }
                            else{
                                $active_inactive = '';
                            }

                            $delete = '';
                            $update = '';
                            $data_active = '1';
                        }
                        else{
                            if($activate_job > 0){
                                $active_inactive = '<button class="btn btn-success waves-effect waves-light activate-job" title="Activate Job" data-job-id="'. $job_id .'">
                                <i class="bx bx-check font-size-16 align-middle"></i>
                                </button>';
                            }
                            else{
                                $active_inactive = '';
                            }

                            if($update_job > 0){
                                $update = '<button type="button" class="btn btn-info waves-effect waves-light update-job" data-job-id="'. $job_id .'" title="Edit Job">
                                                <i class="bx bx-pencil font-size-16 align-middle"></i>
                                            </button>';
                            }
                            else{
                                $update = '';
                            }
    
                            if($delete_job > 0){
                                $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-job" data-job-id="'. $job_id .'" title="Delete Job">
                                            <i class="bx bx-trash font-size-16 align-middle"></i>
                                        </button>';
                            }
                            else{
                                $delete = '';
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
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" data-active="'. $data_active .'" value="'. $job_id .'">',
                            'JOB_TITLE' => $job_title,
                            'JOB_CATEGORY' => $job_category_name,
                            'JOB_TYPE' => $job_type_name,
                            'STATUS' => $status_name,
                            'ACTION' => '<div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light view-job" data-job-id="'. $job_id .'" title="View Job">
                                    <i class="bx bx-show font-size-16 align-middle"></i>
                                </button>
                                '. $update .'
                                '. $active_inactive .'
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

    # Job applicant table
    else if($type == 'job applicant table'){
        if(isset($_POST['filter_branch']) && isset($_POST['filter_job']) && isset($_POST['filter_job_category']) && isset($_POST['filter_job_type']) && isset($_POST['filter_recruitment_stage']) && isset($_POST['filter_start_date']) && isset($_POST['filter_end_date'])){
            if($api->databaseConnection()) {
                # Get permission
                $update_job_applicant = $api->check_role_permissions($username, 384);
                $delete_job_applicant = $api->check_role_permissions($username, 385);
                $view_transaction_log = $api->check_role_permissions($username, 386);
                $view_applicant_details_page = $api->check_role_permissions($username, 75);

                $filter_branch = $_POST['filter_branch'];
                $filter_job = $_POST['filter_job'];
                $filter_job_category = $_POST['filter_job_category'];
                $filter_job_type = $_POST['filter_job_type'];
                $filter_recruitment_stage = $_POST['filter_recruitment_stage'];
                $filter_start_date = $api->check_date('empty', $_POST['filter_start_date'], '', 'Y-m-d', '', '', '');
                $filter_end_date = $api->check_date('empty', $_POST['filter_end_date'], '', 'Y-m-d', '', '', '');
    
                $query = 'SELECT APPLICANT_ID, FILE_AS, APPLICATION_DATE, APPLIED_FOR, RECRUITMENT_STAGE, TRANSACTION_LOG_ID FROM tblapplicant ';

                if(!empty($filter_branch) || !empty($filter_job) || !empty($filter_job_category) || !empty($filter_recruitment_stage) || !empty($filter_job_type) || (!empty($filter_start_date) && !empty($filter_end_date))){
                    $query .= ' WHERE ';

                    if(!empty($filter_branch)){
                        $filter[] = 'APPLIED_FOR IN (SELECT JOB_ID FROM tbljobbranch WHERE BRANCH_ID = :filter_branch)';
                    }

                    if(!empty($filter_job)){
                        $filter[] = 'APPLIED_FOR = :filter_job';
                    }

                    if(!empty($filter_recruitment_stage)){
                        $filter[] = 'RECRUITMENT_STAGE = :filter_recruitment_stage';
                    }

                    if(!empty($filter_job_category)){
                        $filter[] = 'APPLIED_FOR IN (SELECT JOB_ID FROM tbljob WHERE JOB_CATEGORY = :filter_job_category)';
                    }

                    if(!empty($filter_job_type)){
                        $filter[] = 'APPLIED_FOR IN (SELECT JOB_ID FROM tbljob WHERE JOB_TYPE = :filter_job_type)';
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $query .= ' APPLICATION_DATE BETWEEN :filter_start_date AND :filter_start_date';
                    }

                    if(!empty($filter)){
                        $query .= implode(' AND ', $filter);
                    }
                }
                
                $sql = $api->db_connection->prepare($query);

                if(!empty($filter_branch) || !empty($filter_job) || !empty($filter_job_category) || !empty($filter_recruitment_stage) || !empty($filter_job_type) || (!empty($filter_start_date) && !empty($filter_end_date))){
                    if(!empty($filter_branch)){
                        $sql->bindValue(':filter_branch', $filter_branch);
                    }

                    if(!empty($filter_job)){
                        $sql->bindValue(':filter_job', $filter_job);
                    }

                    if(!empty($filter_recruitment_stage)){
                        $sql->bindValue(':filter_recruitment_stage', $filter_recruitment_stage);
                    }

                    if(!empty($filter_job_category)){
                        $sql->bindValue(':filter_job_category', $filter_job_category);
                    }

                    if(!empty($filter_job_type)){
                        $sql->bindValue(':filter_job_type', $filter_job_type);
                    }

                    if(!empty($filter_start_date) && !empty($filter_end_date)){
                        $sql->bindValue(':filter_start_date', $filter_start_date);
                        $sql->bindValue(':filter_end_date', $filter_end_date);
                    }
                }
    
                if($sql->execute()){
                    while($row = $sql->fetch()){
                        $applicant_id = $row['APPLICANT_ID'];
                        $applicant_id_encrypted = $api->encrypt_data($applicant_id);
                        $file_as = $row['FILE_AS'];
                        $applied_for = $row['APPLIED_FOR'];
                        $recruitment_stage = $row['RECRUITMENT_STAGE'];

                        $application_date = $api->check_date('empty', $row['APPLICATION_DATE'], '', 'm/d/Y', '', '', '');
                        $transaction_log_id = $row['TRANSACTION_LOG_ID'];

                        $job_details = $api->get_job_details($applied_for);
                        $job_title = $job_details[0]['JOB_TITLE'] ?? null;

                        $recruitment_pipeline_stage_details = $api->get_recruitment_pipeline_stage_details($recruitment_stage);
                        $recruitment_stage_name = $recruitment_pipeline_stage_details[0]['RECRUITMENT_PIPELINE_STAGE'];
    
                        if($update_job_applicant > 0){
                            $update = '<button type="button" class="btn btn-info waves-effect waves-light update-job-applicant" data-applicant-id="'. $applicant_id .'" title="Edit Applicant">
                                            <i class="bx bx-pencil font-size-16 align-middle"></i>
                                        </button>';
                        }
                        else{
                            $update = '';
                        }
    
                        if($view_applicant_details_page > 0){
                            $view_page = '<a href="applicant-details.php?id='. $applicant_id_encrypted .'" class="btn btn-warning waves-effect waves-light" title="View Applicant Details">
                                                <i class="bx bx-user font-size-16 align-middle"></i>
                                            </a>';

                            $file_as = '<a href="applicant-details.php?id='. $applicant_id_encrypted .'" title="View Applicant Details">
                                                '. $file_as .'
                                            </a>';
                        }
                        else{
                            $view_page = '';
                        }
    
                        if($delete_job_applicant > 0){
                            $delete = '<button type="button" class="btn btn-danger waves-effect waves-light delete-job-applicant" data-applicant-id="'. $applicant_id .'" title="Delete Applicant">
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
                            'CHECK_BOX' => '<input class="form-check-input datatable-checkbox-children" type="checkbox" value="'. $applicant_id .'">',
                            'FILE_AS' => $file_as,
                            'JOB_TITLE' => $job_title,
                            'APPLICATION_DATE' => $application_date,
                            'RECRUITMENT_PIPELINE_STAGE' => $recruitment_stage_name,
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

    # Pay run payee options
    else if($type == 'pay run payee options'){
        if ($api->databaseConnection()) {
            if(isset($_POST['pay_run_id']) && !empty($_POST['pay_run_id'])){
                $pay_run_id = $_POST['pay_run_id'];

                $pay_run_payee_details = $api->get_pay_run_payee_details($pay_run_id);

                for($i = 0; $i < count($pay_run_payee_details); $i++) {
                    $employee_id = $pay_run_payee_details[$i]['EMPLOYEE_ID'];
                    $employee_details = $api->get_employee_details($employee_id, '');
                    $file_as = $employee_details[0]['FILE_AS'];

                    $response[] = array(
                        'EMPLOYEE_ID' => $employee_id,
                        'FILE_AS' => $file_as
                    );
                }

                echo json_encode($response);
            }
        }
    }
    # -------------------------------------------------------------
}

?>