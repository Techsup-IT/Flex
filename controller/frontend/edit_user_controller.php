<?php
$load = $_REQUEST['edit'];
if (isset($_REQUEST['edit'])) {
	$get_row = $db->get_row('employee', array('employee_id' => $load));
}
if (isset($_REQUEST['tab'])) {
	$current_tab = $_REQUEST['tab'];
}
if (isset($_POST['submit_user'])) {
	$current_tab = $_POST['current_tab'];
	$emp_name = $_POST['emp_name'];
	$emp_surname = $_POST['emp_surname'];
	$address = $_POST['address'];
	$hour = $_POST['hour'];
	$contact1 = $_POST['contact1'];

	$create_on = date('y-m-d h:i:s');
	$ip_address = $_SERVER['REMOTE_ADDR'];

	$IdNumber = $_POST['IdNumber'];
	$EstLaborOfficeId = $_POST['EstLaborOfficeId'];
	$EstSequenceNumber = $_POST['EstSequenceNumber'];
	$is_molTWC = $_POST['is_molTWC'];

	$department = $_POST['department'];

	if (($fv->emptyfields(array('emp_name' => $emp_name), NULL))) {
		$display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_employee_name"] . '
		</div>';
	}

	if (($fv->emptyfields(array('IdNumber' => $IdNumber), NULL))) {
		$display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_IdNumber"] . '
		</div>';
	}
	if (($fv->emptyfields(array('EstLaborOfficeId' => $EstLaborOfficeId), NULL))) {
		$display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_EstLaborOfficId"] . '
		</div>';
	}
	if (($fv->emptyfields(array('EstSequenceNumber' => $EstSequenceNumber), NULL))) {
		$display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_EstSequenceNumber"] . '
		</div>';
	} elseif ($hour == '') {
		$display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["empty_working_hours"] . '
		</div>';
	} else {
		$update = $db->update('employee', array('IdNumber' => $IdNumber, 'EstLaborOfficeId' => $EstLaborOfficeId, 'EstSequenceNumber' => $EstSequenceNumber, 'is_molTWC' => $is_molTWC, 'emp_name' => $emp_name, 'emp_surname' => $emp_surname, 'address' => $address, 'hour' => $hour, 'contact1' => $contact1, 'create_date' => $create_on, 'ip_address' => $ip_address, 'department' => $department), array('employee_id' => $load, 'company_id' => $_SESSION['company_id']));
		if ($update) {
			$get_row = $db->get_row('employee', array('employee_id' => $load));

			$display_msg = '<div class="alert alert-success">
		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["update_success"] . '
		</div>';
		}
	}
} elseif (isset($_POST['submit_login'])) {

	$current_tab = $_POST['current_tab'];
	$pass = $_POST['password'];

	if ($pass != '') {
		$encrypt_password = $password->hashBcrypt($pass, '10', PASSWORD_DEFAULT);
		$update = $db->update('employee', array('password' => $encrypt_password), array('employee_id' => $load));
		if ($update) {
			$get_row = $db->get_row('employee', array('employee_id' => $load));
			$display_msg = '<div class="alert alert-success">
				  <i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["update_success"] . '
				  </div>';
		}
	} else {
		$get_row = $db->get_row('employee', array('employee_id' => $load));
		$display_msg = '<div class="alert alert-danger">
				  <i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["empty_password"] . '
				  </div>';
	}
} elseif (isset($_POST['submit_image'])) {

	$current_tab = $_POST['current_tab'];
	$profilepic = $_FILES['profilepic'];
	$handle = new uploader($profilepic);
	$ext = $handle->file_src_name_ext;
	$path = SERVER_ROOT . '/uploads/profile/';


	if ($profilepic['name'] != '') {

		if (!is_dir($path)) {
			if (!file_exists($path)) {
				mkdir($path);
			}
		}

		if (file_exists(SERVER_ROOT . '/uploads/profile/' . $get_row['emp_photo_file']) && (($get_row['emp_photo_file']) != '')) {
			unlink(SERVER_ROOT . '/uploads/profile/' . $get_row['emp_photo_file']);
		}
		$newfilename = $handle->file_new_name_body = time();
		$ext = $handle->image_src_type;
		$filename = $newfilename . '.' . $ext;


		if ($handle->image_src_type == 'jpg' || $handle->image_src_type == 'jpeg' || $handle->image_src_type == 'png') {
			if ($handle->uploaded) {
				$handle->Process($path);
				if ($handle->processed) {
					$update = $db->update('employee', array('emp_photo_file' => $filename), array('employee_id' => $load));
					if ($update) {
						$get_row = $db->get_row('employee', array('employee_id' => $load));

						$display_msg = '<div class="alert alert-success">
				  <i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["update_success"] . '
				  </div>';
					}
				}
			}
		}
	}
}

if (isset($_POST) && !empty($_POST)) {
	if (file_exists(SERVER_ROOT . '/protected/views/frontend/templates/teleworker_update.php')) {
		$templates = file_get_contents(SERVER_ROOT . '/protected/views/frontend/templates/teleworker_update.php');
		$emp_details = $db->get_row('employee', array('employee_id' => $load));
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
		$mail->Subject = '[TechsupTrack] ' . $lang['teleworker_update_emails_subject'];
		$mail->msgHTML($message_data);
		foreach ($email_list as $email) {
			$mail->clearAllRecipients();
			$mail->addAddress($email['email']);
			$mail_status = $mail->send();
		}
		// $mail_status = $mail->send();

	}
}
