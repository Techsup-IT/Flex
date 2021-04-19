<?php

if (isset($_GET['markUnread']) && $_GET['markUnread'] == 1) {
	if (isset($_GET['email_id']) && isset($_GET['msg_check']) && $_GET['email_id'] != '' && $_GET['msg_check'] != '') {
		$update = $db->update('emails', array($_GET['msg_check'] => 1), array('message_id' => $_GET['email_id']));
	}
	die();
}

if (isset($_POST['sendMail']) && $_POST['sendMail'] == 1) {
	$email_from = $_POST['email_from'];
	$email_to = $_POST['email_to'];
	$email_sub = $_POST['email_sub'];
	$parent_id = $_POST['parent_id'];
	$reply_id = $_POST['reply_id'];
	$message_data = $_POST['message_data'];
	$company_id = $_SESSION['company_id'];
	$manager_id = 0;
	$emp_status = 0;
	$admin_status = 0;
	$employee_id = 0;
	if ($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 6) {
		$manager_id = $_SESSION['employee_id'];
		$employee_id = $_POST['receiver_id'];
		$admin_status = 1;
	} else {
		$manager_id = $_POST['receiver_id'];
		$employee_id = $_SESSION['employee_id'];
		$emp_status = 1;
	}

	$ip_address = $_SERVER['REMOTE_ADDR'];
	$create_on = date('Y-m-d h:i:s');

	// $email_to = 'hiren.macwan@confidosoft.com';
	if ($email_to != '' && $email_sub != '' && $message_data != '') {
		// require '../../library/PHPMailer_class.php';
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
		$mail->addAddress($email_to);
		$mail->Subject = '[Techsup Email] ' . $email_sub;
		$mail->msgHTML($message_data);

		$email_files = array();
		if (isset($_FILES['email_attachments']) && !empty($_FILES['email_attachments']) && count($_FILES["email_attachments"]['name']) > 0) {
			// if(!empty(array_filter($_FILES['email_attachments']['name']))){
			foreach ($_FILES['email_attachments']['tmp_name'] as $key => $value) {
				if ($_FILES['email_attachments']['error'][$key] === UPLOAD_ERR_OK) {
					$mail->AddAttachment($_FILES['email_attachments']['tmp_name'][$key], $_FILES['email_attachments']['name'][$key]);
					$email_files[] = $_FILES['email_attachments']['name'][$key];
				}
			}
			// }

		}
		$mail_status = $mail->send();
		// $mail_status = mail($email_to, $email_sub, $message_data);
		if ($mail_status) {
			$insert = $db->insert('emails', array(
				'company_id' => $company_id,
				'manager_id' => $manager_id,
				'employee_id' => $employee_id,
				'email_from' => $email_from,
				'email_to' => $email_to,
				'reply_id' => $reply_id,
				'parent_id' => $parent_id,
				'email_sub' => htmlentities($email_sub),
				'message_data' => htmlentities($message_data),
				'attachments' => json_encode($email_files),
				'admin_status' => $admin_status,
				'emp_status' => $emp_status,
				'ip_address' => $ip_address,
				'created_date' => $create_on
			));
			if ($insert) {
				if (isset($_FILES['email_attachments']) && !empty($_FILES['email_attachments']) && count($_FILES["email_attachments"]['name']) > 0) {
					// if(!empty(array_filter($_FILES['email_attachments']['name']))){
					$path = SERVER_ROOT . '/uploads/emails/files/' . $db->lastInsertId();
					if (!is_dir($path)) {
						if (!file_exists($path)) {
							mkdir($path, 0777, true);
						}
					}
					foreach ($_FILES['email_attachments']['tmp_name'] as $key => $value) {
						if (in_array($_FILES['email_attachments']['name'][$key], $email_files)) {
							$file_tmpname = $_FILES['email_attachments']['tmp_name'][$key];
							$file_name = $_FILES['email_attachments']['name'][$key];
							$file_size = $_FILES['email_attachments']['size'][$key];
							$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
							move_uploaded_file($file_tmpname, $path . DIRECTORY_SEPARATOR . $file_name);
						}
					}
					// }

				}
			}
		}
	}
}

$emails = array();
$email_list = array();
if ($_SESSION['department'] == 5 || $_SESSION['department'] == 6 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4) {
	$emails = $db->run("SELECT * from `emails` where `company_id` = '" . $_SESSION['company_id'] . "' ORDER BY `emails`.`message_id` DESC ")->fetchAll();
	// $email_list = $db->run("SELECT * from `employee` where `department` = 2 AND `company_id` = '" . $_SESSION['company_id'] . "' ")->fetchAll();
	$user_companies = array($_SESSION['company_id']);
	$companies = $db->run("SELECT emp.company_id, c.company_name FROM employee_company_map emp LEFT JOIN company c on c.id = emp.company_id WHERE employee_id  IN (SELECT e.employee_id FROM employee e LEFT JOIN employee_company_map m on m.employee_id = e.employee_id WHERE m.company_id = " . $_SESSION['company_id'] . " and e.department = 3)")->fetchAll();
	if (!empty($companies)) {
		foreach ($companies as $c) {
			$user_companies[] = $c['company_id'];
		}
	}
	$email_list = $db->run("SELECT * from `employee` where (`department` = 2 AND `company_id` = '" . $_SESSION['company_id'] . "') or (`department` = 3 AND `company_id` in (" . implode(',', $user_companies) . ")) ")->fetchAll();
} else {
	$emails = $db->run("SELECT * from `emails` where `employee_id`= '" . $_SESSION['employee_id'] . "' AND `company_id` = '" . $_SESSION['company_id'] . "' ORDER BY `emails`.`message_id` DESC ")->fetchAll();
	$email_list = $db->run("SELECT * from `employee` where `department` = 4 AND `company_id` = '" . $_SESSION['company_id'] . "' ")->fetchAll();
}

// echo "<pre>"; print_r($emails); exit();

$conversations = array();
if (!empty($emails)) {
	foreach ($emails as $e_data) {
		$p_id = ($e_data['parent_id'] != 0) ? $e_data['parent_id'] : $e_data['message_id'];
		$e_data['created_date'] = date("D, j M Y, h:i:s A", strtotime($e_data['created_date']));
		$conversations[$p_id][] = $e_data;
	}
}
// echo "<pre>"; print_r($conversations); exit();