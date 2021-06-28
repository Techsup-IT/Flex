<?php

if (isset($_GET['markUnread']) && $_GET['markUnread'] == 1) {
	if (isset($_GET['file_id']) && isset($_GET['msg_check']) && $_GET['file_id'] != '' && $_GET['msg_check'] != '') {
		$update = $db->update('files', array($_GET['msg_check'] => 1), array('message_id' => $_GET['file_id']));
	}
	die();
}

if (isset($_POST['sendFile']) && $_POST['sendFile'] == 1) {
	if (isset($_FILES['file']) && !empty($_FILES['file'])) {
		$path = SERVER_ROOT . '/uploads/files/';
		if (!is_dir($path)) {
			if (!file_exists($path)) {
				mkdir($path);
			}
		}
		$allowed_file_type = array("png", "jpg", "jpeg", "pdf", "doc", "docx", "xlsx", "xls");
		// Get image file extension
		$file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		// Validate file input to check if is not empty
		if (!file_exists($_FILES["file"]["tmp_name"])) {
			$display_msg = '<div class="alert alert-danger">
				<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["select_file"] . '
				</div>';
		}
		// Validate file input to check if is with valid extension
		else if (!in_array(strtolower($file_extension), $allowed_file_type)) {
			$display_msg = '<div class="alert alert-danger">
				<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["invalid_file"] . '
				</div>';
		}
		// Validate image file size
		else if (($_FILES["file-input"]["size"] > 2000000)) {
			$display_msg = '<div class="alert alert-danger">
				<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["file_size_exceeded"] . '
				</div>';
		} else {
			$file_data = pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME) . '_' . time() . '.' . $file_extension;
			$target = $path . pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME) . '_' . time() . '.' . $file_extension;
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target)) {
				$display_msg = '<div class="alert alert-success">
					<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["success"] . '
					</div>';

				$file_from = $_POST['file_from'];
				$file_to = $_POST['file_to'];
				$parent_id = $_POST['parent_id'];
				$reply_id = $_POST['reply_id'];
				$file_desc = $_POST['file_desc'];
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
				if ($file_to != '' && $file_desc != '' && $file_data != '') {
					$insert = $db->insert('files', array(
						'company_id' => $company_id,
						'manager_id' => $manager_id,
						'employee_id' => $employee_id,
						'file_from' => $file_from,
						'file_to' => $file_to,
						'reply_id' => $reply_id,
						'parent_id' => $parent_id,
						'file_desc' => htmlentities($file_desc),
						'file_name' => $file_data,
						'admin_status' => $admin_status,
						'emp_status' => $emp_status,
						'ip_address' => $ip_address,
						'created_date' => $create_on
					));
				}
			} else {
				$display_msg = '<div class="alert alert-danger">
					<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["file_upload_error"] . '
					</div>';
			}
		}
	}
}

$files = array();
$file_list = array();
if ($_SESSION['department'] == 5 || $_SESSION['department'] == 6 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4) {
	$files = $db->run("SELECT * from `files` where `company_id` = '" . $_SESSION['company_id'] . "' ORDER BY `files`.`message_id` DESC ")->fetchAll();
	// $file_list = $db->run("SELECT * from `employee` where `department` = 2 AND `company_id` = '". $_SESSION['company_id']."' ")->fetchAll();
	$user_companies = array($_SESSION['company_id']);
	$companies = $db->run("SELECT emp.company_id, c.company_name FROM employee_company_map emp LEFT JOIN company c on c.id = emp.company_id WHERE employee_id  IN (SELECT e.employee_id FROM employee e LEFT JOIN employee_company_map m on m.employee_id = e.employee_id WHERE m.company_id = " . $_SESSION['company_id'] . " and e.department = 3)")->fetchAll();
	if (!empty($companies)) {
		foreach ($companies as $c) {
			$user_companies[] = $c['company_id'];
		}
	}
	$file_list = $db->run("SELECT * from `employee` where (`department` = 2 AND `company_id` = '" . $_SESSION['company_id'] . "') or (`department` = 3 AND `company_id` in (" . implode(',', $user_companies) . ")) ")->fetchAll();
} else {
	$files = $db->run("SELECT * from `files` where `employee_id`= '" . $_SESSION['employee_id'] . "' AND `company_id` = '" . $_SESSION['company_id'] . "' ORDER BY `files`.`message_id` DESC ")->fetchAll();
	$file_list = $db->run("SELECT * from `employee` where `department` = 4 AND `company_id` = '" . $_SESSION['company_id'] . "' ")->fetchAll();
}

// echo "<pre>"; print_r($emails); exit();