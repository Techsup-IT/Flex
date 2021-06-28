<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
if ($_REQUEST['token'] && $security->decrypt($_REQUEST['token'], key)) {

	$postdata = file_get_contents("php://input");

	header('Content-Type: application/json');

	$request = array();
	$postdata = json_encode($_GET);
	$sessions = array();
	$request = json_decode($postdata, true);
	$id = $request['id'];
	$check_in = $request['check_in'];
	$check_out = $request['check_out'];
	$employee_id = $request['employee_id'];
	$last_id = $request['last_id'];
	$company_id = $request['company_id'];

	$company_details = $db->get_row('company', array('id' => $company_id));


	define(default_timezone, date_default_timezone_get());
	define(new_timezone, $company_details['timezone']);
	date_default_timezone_set(new_timezone);
	$current_time = time();

	$request['current_dt'] = date("Y-m-d", $check_in);

	$check_out_time = $request['check_out_time'];
	$request["create_date"] = date('Y/m/d');
	$request["ip_address"] = $_SERVER['REMOTE_ADDR'];


	if ($db->exists('company', array('id' => $company_id)))
		if ($db->exists('employee', array('employee_id' => $employee_id, 'company_id' => $company_id))) {

			if ($check_out == "") {
				if ($check_in >= ($current_time - (60 * 5)) && $check_in <= ($current_time + (60 * 5))) {
					unset($request['user']);
					unset($request['token']);
					$insert = $db->insert('shift_check', $request);
					$sessions['last_id'] = $db->lastInsertId();
				} else {
					$sessions['last_id'] = false;
					$sessions['status'] = false;
				}
			} elseif ($check_out != "") {
				if ($check_out >= ($current_time - (60 * 5)) && $check_out <= ($current_time + (60 * 5))) {
					$update = $db->update("shift_check", array('check_out_time' => $check_out_time, 'check_out' => $check_out), array('id' => $last_id));
				} else {
					$sessions['last_id'] = false;
					$sessions['status'] = false;
				}
			}
			if ($insert) {
				$sessions['status'] = true;
			}
		} else {
			$sessions['last_id'] = false;
			$sessions['status'] = false;
		}
	echo json_encode($sessions);
} else {
	$session->redirect('404', frontend);
}
