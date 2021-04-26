<?php

$table = 'employee';
$primaryKey = 'employee_id';
$columns = array(
	array('db' => 'employee_id', 'dt' => 0),
	array('db' => 'emp_name', 'dt' => 1),
	array('db' => 'email', 'dt' => 2),
	array('db' => 'department', 'dt' => 3),
);

$sql_details = array(
	'user' => DB_USER,
	'pass' => DB_PASSWORD,
	'db'   => DB_NAME,
	'host' => DB_HOST
);

$user_companies = array($_SESSION['company_id']);
$companies = $db->run("SELECT emp.company_id, c.company_name FROM employee_company_map emp LEFT JOIN company c on c.id = emp.company_id WHERE employee_id  IN (SELECT e.employee_id FROM employee e LEFT JOIN employee_company_map m on m.employee_id = e.employee_id WHERE m.company_id = " . $_SESSION['company_id'] . " and e.department = 3)")->fetchAll();
if (!empty($companies)) {
	foreach ($companies as $c) {
		$user_companies[] = $c['company_id'];
	}
}

$where = array("(department = '2' AND company_id = '" . $_SESSION['company_id'] . "') OR (department = '3' AND company_id IN (" . implode(',', $user_companies) . "))");

$output_arr = SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $where);
// echo "<pre>"; print_r($output_arr['data']); exit();
foreach ($output_arr['data'] as $key => $value) {
	if (isset($value[3]) && $value[3] == 3) {
		$output_arr['data'][$key][count($output_arr['data'][$key]) - 1] = '<span class="label label-success">' . $lang['freelancer'] . '</span>';
	} else {
		$output_arr['data'][$key][count($output_arr['data'][$key]) - 1] = '';
	}
	$check_details = $db->get_count('shift_check', array('company_id' => $_SESSION['company_id'], 'employee_id' => $value[0]));
	$activity_details = 0;
	$clockin = $db->get_col('shift_check', array('employee_id' => $value[0]), 'check_in');
	if ($clockin['0'] == '') {
		$output_arr['data'][$key][count($output_arr['data'][$key])] = 'Not Clocked Yet';
	} else {
		$tm = date('Y-m-d H:i:s', max($clockin));
		$output_arr['data'][$key][count($output_arr['data'][$key])] = "Last Clock In " . $tm;
	}
	$activity_link = '#';
	$work_link = $link->link('working_hour', frontend, '&working_emp=' . $value[0]);
	$output_arr['data'][$key][count($output_arr['data'][$key])] = '<a href="' . $work_link . '" "><span class="label label-warning">' . $check_details . '</span></a>';
	// $edit_link = $link->link("edit_user", frontend, '&edit=' . $value[0]);
	if (isset($value[3]) && $value[3] == 3) {
		$edit_link = $link->link("edit_freelancer", frontend, '&edit=' . $value[0]);
	} else {
		$edit_link = $link->link("edit_user", frontend, '&edit=' . $value[0]);
	}
	$delete_link = $link->link("users", '', '&del_id=' . $value[0]);
	$activate = $db->get_col('employee', array('employee_id' => $value[0]), 'status');
	if (end($activate) == 1) {
		$activate_lable = $lang["activate"];
		$activate_link = $link->link("users", '', '&activate_id=' . $value[0]);
	} else {
		$activate_lable = $lang["deactivate"];
		$activate_link = $link->link("users", '', '&deactivate_id=' . $value[0]);
	}
	$output_arr['data'][$key][count($output_arr['data'][$key])] = '<a href="' . $edit_link . '" style="margin:0 10px;" "><span class="label label-success">' . $lang["update"] . '</span></a><a href="' . $delete_link . '" style="margin:0 10px;" "><span class="label label-danger">' . $lang["delete"] . '</span></a><a href="' . $activate_link . '" style="margin:0 10px;" "><span class="label label-warning">' . $activate_lable . '</span></a>';
	// echo "<pre>"; print_r($output_arr['data'][$key]); exit();
}
//echo "<pre>"; print_r($output_arr['data']); exit();
echo json_encode($output_arr);
exit();
