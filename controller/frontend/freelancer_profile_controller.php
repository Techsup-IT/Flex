<?php
$speciality_list = array();
if (file_exists(SERVER_ROOT . '/uploads/job_titles.json')) {
    $speciality_list = file_get_contents(SERVER_ROOT . '/uploads/job_titles.json');
}

$freelancer_data = $db->get_row('employee', array('employee_id' => $_SESSION['employee_id']));
if (isset($_REQUEST['tab'])) {
    $current_tab = $_REQUEST['tab'];
}

$specialities = json_decode($speciality_list, true);
if (isset($_POST['submit_profile'])) {
    $current_tab = $_POST['current_tab'];
    $firstname = $_POST['f_name'];
    $lastname = $_POST['l_name'];
    $contact1 = $_POST['contact1'];
    $address = $_POST['address'];
    $profilepic = $_FILES['profilepic'];

    $IdNumber = $_POST['IdNumber'];
    $EstLaborOfficeId = $_POST['EstLaborOfficeId'];
    $EstSequenceNumber = $_POST['EstSequenceNumber'];

    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $employee_national_number = $_POST['employee_national_number'];
    $city_id = $_POST['city_id'];

    $handle = new uploader($profilepic);
    $ext = $handle->file_src_name_ext;
    $path = SERVER_ROOT . '/uploads/profile/';

    if (($fv->emptyfields(array('emp_name' => $firstname), NULL))) {
        $display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_name"] . '
		</div>';
    } elseif (($fv->emptyfields(array('emp_surname' => $lastname), NULL))) {
        $display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_surname"] . '
		</div>';
    } elseif (($fv->emptyfields(array('IdNumber' => $IdNumber), NULL))) {
        $display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_IdNumber"] . '
		</div>';
    } elseif (($fv->emptyfields(array('EstLaborOfficeId' => $EstLaborOfficeId), NULL))) {
        $display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_EstLaborOfficId"] . '
		</div>';
    } elseif (($fv->emptyfields(array('EstSequenceNumber' => $EstSequenceNumber), NULL))) {
        $display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_EstSequenceNumber"] . '
		</div>';
    } elseif (($fv->emptyfields(array('dob' => $dob), NULL))) {
        $display_msg = '<div class="alert alert-danger">
                        <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["required_field_error"] . '
                        </div>';
    } elseif (($fv->emptyfields(array('city_id' => $city_id), NULL))) {
        $display_msg = '<div class="alert alert-danger">
                        <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["required_field_error"] . '
                        </div>';
    } elseif (($fv->emptyfields(array('employee_national_number' => $employee_national_number), NULL))) {
        $display_msg = '<div class="alert alert-danger">
                        <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["required_field_error"] . '
                        </div>';
    } elseif ($profilepic['name'] != '') {

        if (!is_dir($path)) {
            if (!file_exists($path)) {
                mkdir($path);
            }
        }

        if (file_exists(SERVER_ROOT . '/uploads/profile/' . $user_details['emp_photo_file']) && (($user_details['emp_photo_file']) != '')) {
            unlink(SERVER_ROOT . '/uploads/profile/' . $user_details['emp_photo_file']);
        }
        $newfilename = $handle->file_new_name_body = time();
        $ext = $handle->image_src_type;
        $filename = $newfilename . '.' . $ext;


        if ($handle->image_src_type == 'jpg' || $handle->image_src_type == 'jpeg' || $handle->image_src_type == 'png') {
            if ($handle->uploaded) {
                $handle->Process($path);
                if ($handle->processed) {
                    $update = $db->update('employee', array('emp_name' => $firstname, 'emp_surname' => $lastname, 'emp_photo_file' => $filename, 'contact1' => $contact1, 'address' => $address, 'dob' => $dob, 'city_id' => $city_id, 'employee_national_number' => $employee_national_number, 'IdNumber' => $IdNumber, 'EstLaborOfficeId' => $EstLaborOfficeId, 'EstSequenceNumber' => $EstSequenceNumber), array('employee_id' => $_SESSION['employee_id']));
                }
            }
        }
    } else {
        $update = $db->update('employee', array('emp_name' => $firstname, 'emp_surname' => $lastname, 'address' => $address, 'dob' => $dob, 'city_id' => $city_id, 'employee_national_number' => $employee_national_number, 'contact1' => $contact1, 'IdNumber' => $IdNumber, 'EstLaborOfficeId' => $EstLaborOfficeId, 'EstSequenceNumber' => $EstSequenceNumber), array('employee_id' => $_SESSION['employee_id']));
    }

    if ($update) {
        $display_msg = '<div class="alert alert-success">
		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times</button>' . $lang["update_success"] . '
		</div>';

        // echo "<script>
        //          setTimeout(function(){
        // 		  window.location = '" . $link->link("freelancer_profile", frontend) . "'
        //             },1000);</script>";
    }
} else if (isset($_POST['submit_cv'])) {
    $current_tab = $_POST['current_tab'];
    $major = $_POST['major'];
    $other_major = $_POST['other_major'];
    $skills = $_POST['skills'];
    $certificate = $_POST['certificate'];
    $work_exp_info = array();
    for ($i = 0; $i < count($_POST['job_title']); $i++) {
        $work_exp_info[] = array(
            'job_title' => $_POST['job_title'][$i],
            'years_of_exp' => $_POST['years_of_experience'][$i],
        );
    }
    if (($fv->emptyfields(array('major' => $major), NULL))) {
        $display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>Please enter all required details
		</div>';
    } else {
        $certificate_data = $_FILES['upload_cert'];
        $handle = new uploader($certificate_data);
        $path = SERVER_ROOT . '/uploads/certificates/';
        if ($certificate_data['name'] != '') {
            if (!is_dir($path)) {
                if (!file_exists($path)) {
                    mkdir($path);
                }
            }
            $newfilename = $handle->file_new_name_body = time();
            $ext = $handle->file_src_name_ext;
            $filename = $newfilename . '.' . $ext;
            if ($handle->file_src_name_ext == 'pdf') {
                if ($handle->uploaded) {
                    $handle->Process($path);
                    if ($handle->processed) {
                        if ($certificate != '' && file_exists(SERVER_ROOT . '/uploads/certificates/' . $certificate)) {
                            unlink(SERVER_ROOT . '/uploads/certificates/' . $certificate);
                        }
                        $certificate = $filename;
                    }
                }
            }
        }

        $update = $db->update('employee', array('major' => $major, 'other_major' => $other_major, 'skills' => $skills, 'certificate' => $certificate), array('employee_id' => $_SESSION['employee_id']));

        $del_work_exp = $db->delete('work_experience_info', array('employee_id' => $_SESSION['employee_id']));
        if (!empty($work_exp_info)) {
            foreach ($work_exp_info as $exp_info) {
                $insert_map = $db->insert('work_experience_info', array('employee_id' => $_SESSION['employee_id'], 'job_title' => $exp_info['job_title'], 'years_of_exp' => $exp_info['years_of_exp']));
            }
        }

        $display_msg = '<div class="alert alert-success">
		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times</button>' . $lang["update_success"] . '
		</div>';
    }
    // $update = $db->update('employee', array('major' => $major, 'other_major' => $other_major, 'skills' => $skills, 'work_experience_info' => $work_exp_info), array('employee_id' => $_SESSION['employee_id']));
    // if ($update) {

    //     $del_work_exp = $db->delete('work_experience_info', array('employee_id' => $_SESSION['employee_id']));
    //     if (!empty($work_exp_info)) {
    //         foreach ($work_exp_info as $exp_info) {
    //             $insert_map = $db->insert('work_experience_info', array('employee_id' => $_SESSION['employee_id'], 'job_title' => $exp_info['job_title'], 'years_of_exp' => $exp_info['years_of_exp']));
    //         }
    //     }

    //     $display_msg = '<div class="alert alert-success">
    // 	<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times</button>' . $lang["update_success"] . '
    // 	</div>';
    // }
} else if (isset($_POST['submit_contract_info'])) {
    $current_tab = $_POST['current_tab'];
    $contract_info = array();
    for ($i = 0; $i < count($_POST['speciality']); $i++) {
        $contract_info[] = array(
            'speciality' => $_POST['speciality'][$i],
            'hourly_rate' => $_POST['hourly_rate'][$i],
        );
    }

    $del_contract_info = $db->delete('contract_info', array('employee_id' => $_SESSION['employee_id']));
    if (!empty($contract_info)) {
        foreach ($contract_info as $contract_details) {
            $insert_map = $db->insert('contract_info', array('employee_id' => $_SESSION['employee_id'], 'speciality' => $contract_details['speciality'], 'hourly_rate' => $contract_details['hourly_rate']));
        }
    }

    $display_msg = '<div class="alert alert-success">
		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times</button>' . $lang["update_success"] . '
		</div>';
}

$freelancer_data = $db->get_row('employee', array('employee_id' => $_SESSION['employee_id']));
$freelancer_work_exp = $db->get('work_experience_info', array('employee_id' => $_SESSION['employee_id']));
$freelancer_contract_info = $db->get('contract_info', array('employee_id' => $_SESSION['employee_id']));
$user_details = $db->get_row('employee', array('employee_id' => $_SESSION['employee_id']));
// echo "<pre>"; print_r(); exit();