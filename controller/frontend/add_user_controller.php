<?php
$employee_count = $db->get_count('employee', array('company_id' => CURRENT_LOGIN_COMPANY_ID, 'department' => 2));
if ($employee_count >= COMPANY_ALLOWED_EMPLOYEE) {
    $session->redirect('users&max_users=1', frontend);
}

$emplast_id = 0;

if (isset($_POST['submit_user'])) {
    //print_r($_POST);
    //exit;
    $emp_name = $_POST['emp_name'];
    $emp_surname = $_POST['emp_surname'];
    $address = $_POST['address'];
    $contact1 = $_POST['contact1'];
    $email = $_POST['email'];
    $hour = $_POST['hour'];
    $department = "2";
    $pass = $_POST['password'];

    // $screenshort = $_POST['screenshort'];
    //$screenshort_time = $_POST['screenshort_time'];
    // $logs = $_POST['logs'];
    //$logs_time = $_POST['logs_time'];
    //$project_and_task = $_POST['project_and_task'];


    // $salary_type = $_POST['salary_type'];
    // $salary = $_POST['salary'];

    $create_on = date('y-m-d h:i:s');
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $pro = $_FILES['img'];

    $handle = new uploader($_FILES['img']);
    $path = SERVER_ROOT . '/uploads/profile/';

    $IdNumber = $_POST['IdNumber'];
    $EstLaborOfficeId = $_POST['EstLaborOfficeId'];
    $EstSequenceNumber = $_POST['EstSequenceNumber'];
    $is_molTWC = $_POST['is_molTWC'];

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
    } elseif (($fv->emptyfields(array('IdNumber' => $IdNumber), NULL))) {
        $display_msg = '<div class="alert alert-danger">
        <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_IdNumber"] . '
        </div>';
    } elseif (($fv->emptyfields(array('EstLaborOfficeId' => $EstLaborOfficeId), NULL))) {
        $display_msg = '<div class="alert alert-danger">
        <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_EstLaborOfficIdb"] . '
        </div>';
    } elseif (($fv->emptyfields(array('EstSequenceNumber' => $EstSequenceNumber), NULL))) {
        $display_msg = '<div class="alert alert-danger">
        <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_EstSequenceNumber"] . '
        </div>';
    } elseif ($hour == '') {
        $display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["empty_working_hours"] . '
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
                        'hour' => $hour,
                        'contact1' => $contact1,
                        'company_id' => $_SESSION['company_id'],
                        'email' => $email,
                        'password' => $encrypt_password,
                        'create_date' => $create_on,
                        'ip_address' => $ip_address
                    ));
                    $emplast_id = $db->lastInsertId();
                    if ($insert) {

                        //send sms with username and password to new user
                        if ($contact1 != '' && file_exists(SERVER_ROOT . '/webservice/class_sms.php')) {
                            require SERVER_ROOT . '/webservice/class_sms.php';
                            $sms = new SMS();
                            $msg = 'Hello';
                            $msg .= '<br/>';
                            $msg .= '<b>url : <a href="https://techsupflex.com">https://techsupflex.com</a> </b> ';
                            $msg .= '<br/>';
                            $msg .= '<b>Username : </b> ' . $email;
                            $msg .= '<br/>';
                            $msg .= '<b>Password : </b> ' . $pass;
                            $data = array(
                                'mobile_number' => $contact1,
                                'text' => $msg
                            );
                            $sms->send_sms($data);
                        }
                        //end changes

                        $path_cmp = SERVER_ROOT . '/uploads/images/' . $_SESSION['company_id'] . '/';
                        $path1 = SERVER_ROOT . '/uploads/images/' . $_SESSION['company_id'] . '/' . $emplast_id . '/';

                        if (!is_dir($path_cmp)) {
                            mkdir($path_cmp);

                            if (!file_exists($path1)) {
                                mkdir($path1);
                            }
                        }
                        echo "<script>
                 setTimeout(function(){
	    		  window.location = '" . $link->link("users", frontend) . "'
	                },2000);</script>";
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
            'hour' => $hour,
            'address' => $address,
            'contact1' => $contact1,
            'company_id' => $_SESSION['company_id'],
            'email' => $email,
            'password' => $encrypt_password,
            'create_date' => $create_on,
            'ip_address' => $ip_address
        ));
        $emplast_id = $db->lastInsertId();
        if ($insert) {

            //send sms with username and password to new user
            if ($contact1 != '' && file_exists(SERVER_ROOT . '/webservice/class_sms.php')) {
                require SERVER_ROOT . '/webservice/class_sms.php';
                $sms = new SMS();
                $msg = 'Hello';
                $msg .= '<br/>';
                $msg .= '<b>url : <a href="https://techsupflex.com">https://techsupflex.com</a> </b> ';
                $msg .= '<br/>';
                $msg .= '<b>Username : </b> ' . $email;
                $msg .= '<br/>';
                $msg .= '<b>Password : </b> ' . $pass;
                $data = array(
                    'mobile_number' => $contact1,
                    'text' => $msg
                );
                $sms->send_sms($data);
            }
            //end changes

            //$db->debug();
            $path_cmp = SERVER_ROOT . '/uploads/images/' . $_SESSION['company_id'] . '/';
            $path1 = SERVER_ROOT . '/uploads/images/' . $_SESSION['company_id'] . '/' . $emplast_id . '/';

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
	    		  window.location = '" . $link->link("users", frontend) . "'
	                },2000);</script>";
        }
    }
}

if ($emplast_id > 0) {
    if (file_exists(SERVER_ROOT . '/protected/views/frontend/templates/teleworker_update.php')) {
        $templates = file_get_contents(SERVER_ROOT . '/protected/views/frontend/templates/teleworker_update.php');
        $emp_details = $db->get_row('employee', array('employee_id' => $emplast_id));
        $site_settings = $db->get_row('settings');
        $site_logo = $site_settings['logo'];

        $replacements = array(
            '{SITE_LOGO_SRC}' => SITE_URL . '/uploads/logo/' . $site_logo,
            '{DATE}' => date("F j, Y h:i:s"),
            '{PANEL_HEAD}' => $lang['telework_email_head'],
            '{PANEL_BODY_TEXT}' => $lang['telework_email_body_text'],
            '{MAX_TW_COUNT_LABEL}' => $lang['max_telework_count_label'],
            '{MAX_TW_COUNT}' => COMPANY_ALLOWED_EMPLOYEE,
            '{CURRENT_TW_COUNT_LABEL}' => $lang['current_telework_count_label'],
            '{CURRENT_TW_COUNT}' => $db->get_count('employee', array('company_id' => CURRENT_LOGIN_COMPANY_ID, 'department' => 2)),
            '{CMP_NAME_LABEL}' => $lang['company_name'],
            '{CMP_NAME}' => $company_details['company_name'],
            '{EMP_NAME_LABEL}' => $lang['employee_name'],
            '{EMP_NAME}' => $emp_details['emp_name'] . ' ' . $emp_details['emp_surname'],
            '{EMP_EMAIL_LABEL}' => $lang['email_address'],
            '{EMP_EMAIL}' => $emp_details['email'],
        );

        $message_data = str_replace(array_keys($replacements), array_values($replacements), $templates);
        $email_list = $db->run("SELECT email from `employee` where (company_id = " . $_SESSION['company_id'] . " and department = 1 ) || (department in (5,6) ) and status = 0 ")->fetchAll();

        $mail = new PHPMailer;
        $mail->SMTPDebug = 2;
        $mail->CharSet = 'UTF-8';
        $mail->Debugoutput = 'html';
        $mail->Host = 'mail.techsupflex.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "support@techsupflex.com";
        $mail->Password = "YW?G*@L*vmNS";
        $mail->setFrom('support@techsupflex.com', 'Techsup');
        $mail->addReplyTo('support@techsupflex.com', 'Techsup');
        $mail->clearAllRecipients();

        // $email_to = 'hiren.macwan@confidosoft.com';
        // $mail->addAddress($email_to);
        $mail->Subject = '[TechsupTrack] ' . $lang['teleworker_add_emails_subject'];
        $mail->msgHTML($message_data);
        foreach ($email_list as $email) {
            $mail->clearAllRecipients();
            $mail->addAddress($email['email']);
            $mail_status = $mail->send();
        }
        // $mail_status = $mail->send();

    }
}
