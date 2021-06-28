<?php

if (isset($_SESSION['department'])) {
    if (isset($_SESSION['department']) && ($_SESSION['department'] == 2 || $_SESSION['department'] == 3)) {
        $session->redirect('profile', frontend);
    } else {
        $session->redirect('home', frontend);
    }
}


if (isset($_POST['submit_freelancer'])) {

    $IdNumber = $_POST['IdNumber'];
    $EstLaborOfficeId = $_POST['EstLaborOfficeId'];
    $EstSequenceNumber = $_POST['EstSequenceNumber'];
    $emp_name = $_POST['emp_name'];
    $emp_surname = $_POST['emp_surname'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $address = $_POST['address'];
    $is_molTWC = $_POST['is_molTWC'];
    $contact1 = $_POST['contact1'];
    $freelancer_type = 1;
    $freelancer_company = 1;
    $dob = $_POST['dob'];
    $employee_national_number = $_POST['employee_national_number'];
    $city_id = $_POST['city_id'];

    $department = "3";
    $create_on = date('y-m-d h:i:s');
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $pro = $_FILES['img'];

    $handle = new uploader($_FILES['img']);
    $path = SERVER_ROOT . '/uploads/profile/';

    if (!is_dir($path)) {
        if (!file_exists($path)) {
            mkdir($path);
        }
    }

    if (($fv->emptyfields(array('emp_name' => $emp_name), NULL))) {
        $display_msg = '<div class="alert alert-danger">
                        <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_employee_name"] . '
                        </div>';
    } elseif (($fv->emptyfields(array('email' => $email), NULL))) {
        $display_msg = '<div class="alert alert-danger">
                        <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_email_address"] . '
                        </div>';
    } elseif (!$fv->check_email($email)) {
        $display_msg = '<div class="alert alert-danger">
                        <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_valid_email"] . '
                        </div>';
    } elseif ($db->exists('employee', array('email' => $email))) {
        $display_msg = '<div class="alert alert-danger">
                        <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["email_exists"] . '
                        </div>';
    } elseif ($fv->emptyfields(array('password' => $pass), NULL)) {
        $display_msg = '<div class="alert alert-danger">
                        <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["empty_password"] . '
                        </div>';
    }
    // elseif (($fv->emptyfields(array('IdNumber' => $IdNumber), NULL))) {
    //     $display_msg = '<div class="alert alert-danger">
    //                     <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_IdNumber"] . '
    //                     </div>';
    // } 
    elseif (($fv->emptyfields(array('EstLaborOfficeId' => $EstLaborOfficeId), NULL))) {
        $display_msg = '<div class="alert alert-danger">
                        <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_EstLaborOfficIdb"] . '
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
    } elseif (($pro['name']) != '') {
        $newfilename = $handle->file_new_name_body = preg_replace('/\s+/', '', time());
        $ext = $handle->image_src_type;
        $filename = $newfilename . '.' . $ext;

        if ($handle->image_src_type == 'jpg' || $handle->image_src_type == 'jpeg' || $handle->image_src_type == 'JPEG' || $handle->image_src_type == 'png' || $handle->image_src_type == 'JPG') {

            if ($handle->uploaded) {

                $handle->Process($path);
                if ($handle->processed) {

                    $encrypt_password = $password->hashBcrypt($pass, '10', PASSWORD_DEFAULT);
                    $insert = $db->insert('employee', array(
                        'emp_name' => $emp_name,
                        'emp_surname' => $emp_surname,
                        'IdNumber' => $IdNumber,
                        'EstLaborOfficeId' => $EstLaborOfficeId,
                        'EstSequenceNumber' => $EstSequenceNumber,
                        'is_molTWC' => $is_molTWC,
                        'emp_photo_file' => $filename,
                        'department' => $department,
                        'address' => $address,
                        'contact1' => $contact1,
                        'company_id' => $freelancer_company,
                        'is_company' => $freelancer_type,
                        'email' => $email,
                        'password' => $encrypt_password,
                        'create_date' => $create_on,
                        'ip_address' => $ip_address,
                        'dob' => $dob,
                        'city_id' => $city_id,
                        'employee_national_number' => $employee_national_number,
                        'privacy_check' => 1
                    ));
                    $emplast_id = $db->lastInsertId();
                    if ($insert) {
                        $path_cmp = SERVER_ROOT . '/uploads/images/' . $freelancer_company . '/';
                        $path1 = SERVER_ROOT . '/uploads/images/' . $freelancer_company . '/' . $emplast_id . '/';

                        if (!is_dir($path_cmp)) {
                            mkdir($path_cmp);

                            if (!file_exists($path1)) {
                                mkdir($path1);
                            }
                        }
                        $display_msg = '<div class="alert alert-success">
                            <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["add_success"] . '
                        </div>';
                        echo "<script>
                        setTimeout(function(){
                            window.location = '" . $link->link("login", frontend) . "'
                        },2000);</script>";
                    } else {
                        $display_msg = '<div class="alert alert-danger">
                                    <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>Something went wrong. Please try agian later.
                                    </div>';
                        // echo $db->debug(); exit();
                    }
                }
            }
        }
    } else {

        $encrypt_password = $password->hashBcrypt($pass, '10', PASSWORD_DEFAULT);
        $insert = $db->insert('employee', array(
            'emp_name' => $emp_name,
            'emp_surname' => $emp_surname,
            'IdNumber' => $IdNumber,
            'EstLaborOfficeId' => $EstLaborOfficeId,
            'EstSequenceNumber' => $EstSequenceNumber,
            'is_molTWC' => $is_molTWC,
            'department' => $department,
            'address' => $address,
            'contact1' => $contact1,
            'company_id' => $freelancer_company,
            'is_company' => $freelancer_type,
            'email' => $email,
            'password' => $encrypt_password,
            'create_date' => $create_on,
            'ip_address' => $ip_address,
            'dob' => $dob,
            'city_id' => $city_id,
            'employee_national_number' => $employee_national_number,
            'privacy_check' => 1
        ));
        $emplast_id = $db->lastInsertId();
        if ($insert) {
            $path_cmp = SERVER_ROOT . '/uploads/images/' . $freelancer_company . '/';
            $path1 = SERVER_ROOT . '/uploads/images/' . $freelancer_company . '/' . $emplast_id . '/';

            if (!is_dir($path_cmp)) {
                mkdir($path_cmp);

                if (!file_exists($path1)) {
                    mkdir($path1);
                }
            }
            $display_msg = '<div class="alert alert-success">
                            <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["add_success"] . '
                        </div>';
            echo "<script>
                setTimeout(function(){
                    window.location = '" . $link->link("login", frontend) . "'
                },2000);</script>";
        } else {
            $display_msg = '<div class="alert alert-danger">
                        <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>Something went wrong. Please try agian later.
                        </div>';
        }
    }
}
