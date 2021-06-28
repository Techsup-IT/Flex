<?php
$msg = 0;

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

$company_ID = $_SESSION['company_id'];
$company_details = $db->get_row('company', array('id' => $company_ID));
date_default_timezone_set($company_details['timezone']);

if (isset($_POST['edit_type'])) {
	if ($_POST['edit_type'] == 'shift_data') {
		$id = $_POST['entry_id'];
		$checkin = strtotime($_POST['edit_date'] . ' ' . $_POST['edit_checkin']);
		$checkout = strtotime($_POST['edit_date'] . ' ' . $_POST['edit_checkout']);
		$data = array(
			'current_dt' => $_POST['edit_date'],
			'check_in' => $checkin,
			'check_out' => $checkout,
			'check_out_time' => ($checkout - $checkin),
			'manual_edit' => 1,
		);
		$where = array('id' => $id);

		if ($id > 0) {
			$update_data = $db->update('shift_check', $data, $where);
			if ($update_data) {
				$msg = 1;
			}
		}
	}

	if ($_POST['edit_type'] == 'shift_data_delete') {
		$id = $_POST['entry_id'];
		$where = array('id' => $id);
		if ($id > 0) {
			$delete_data = $db->delete("shift_check", $where);
			if ($delete_data) {
				$msg = 1;
			}
		}
	}

	if ($_POST['edit_type'] == 'shift_data_add') {
		$company_id = $_POST['company_id'];
		$employee_id = $_POST['employee_id'];
		if ($company_id > 0 && $employee_id > 0) {
			$checkin = strtotime($_POST['add_date'] . ' ' . $_POST['add_checkin']);
			$checkout = strtotime($_POST['add_date'] . ' ' . $_POST['add_checkout']);
			$check_out_time = $checkout - $checkin;
			if ($checkout < $checkin) {
				$checkout = '';
				$check_out_time = '';
			}
			$data = array(
				'company_id' => $company_id,
				'employee_id' => $employee_id,
				'current_dt' => $_POST['add_date'],
				'check_in' => $checkin,
				'check_out' => $checkout,
				'check_out_time' => $check_out_time,
				'manual_edit' => 1,
				'create_date' => date('Y/m/d'),
				'ip_address' => $_SERVER['REMOTE_ADDR'],
			);
			$insert_data = $db->insert('shift_check', $data);
			if ($insert_data) {
				$msg = 1;
			}
		}
	}
}
echo json_encode($msg);
die();
