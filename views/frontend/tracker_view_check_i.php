<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
if ($_REQUEST['token'] && $security->decrypt($_REQUEST['token'], key)) {

	$postdata = file_get_contents("php://input");
	header('Content-Type: application/json');
	$request = array();
	$postdata = json_encode($_REQUEST);
	$sessions = array();
	$request = json_decode($postdata, true);
	$start_date = $request['start_date'];

	$end_date = $request['end_date'];
	$employee_id = $request['employee_id'];
	$company_id = $request['company_id'];

	if ($start_date == '' || $end_date == '') {
		$sessions['status'] = "false";
		$sessions['msg'] = "Please Provide Start and End Date";
	} else if ($start_date > $end_date) {
		$sessions['status'] = "false";
		$sessions['msg'] = "Start date must be less then End date";
	} else {
		$sessions = $db->run("SELECT id,check_in,check_out,current_dt,check_out_time from `shift_check` where `employee_id`='" . $employee_id . "' AND `company_id`='" . $company_id . "' AND `current_dt` BETWEEN '" . $start_date . "' AND  '" . $end_date . "' ORDER BY id DESC")->fetchAll();
		if (is_array($sessions)) {
			foreach ($sessions as $key => $check_tm) {

				if ($check_tm['check_out'] == '') {

					$db->limit = 1;
					$working = '';

					if ($working == '') {
						$working = "-";
						$sessions[$key]['check_out_time'] = "-";
					} else {
						$sessions[$key]['check_out'] = $working;
						$sessions[$key]['check_out_time'] = $working - $sessions[$key]['check_in'];
						$sessions[$key]['check_out_time'] = (string)$sessions[$key]['check_out_time'];
					}
				}
			}
		} else {
			$sessions['status'] = "false";
			$sessions['msg'] = "";
		}
	}
	echo json_encode($sessions);
} else {
	$session->redirect('404', frontend);
}
