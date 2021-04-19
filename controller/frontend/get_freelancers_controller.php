<?php

$table = 'employee';
$primaryKey = 'employee_id';
$columns = array(
	array('db' => 'employee_id', 'dt' => 0),
	array('db' => 'emp_name', 'dt' => 1),
	array('db' => 'email', 'dt' => 2),
);

$sql_details = array(
	'user' => DB_USER,
	'pass' => DB_PASSWORD,
	'db'   => DB_NAME,
	'host' => DB_HOST
);

$where = array("department = '3'");
$output_arr = SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $where);
foreach ($output_arr['data'] as $key => $value) {
	$edit_link = $link->link("edit_freelancer", frontend, '&edit=' . $value[0]);
	$delete_link = $link->link("freelancers", '', '&del_id=' . $value[0]);
	$activate = $db->get_col('employee', array('employee_id' => $value[0]), 'status');
	if (end($activate) == 1) {
		$activate_lable = $lang["activate"];
		$activate_link = $link->link("freelancers", '', '&activate_id=' . $value[0]);
		$activate_style = '<a href="' . $activate_link . '" style="margin:0 10px;" "><span class="label label-warning" style="background-color:#203b47;border-color:#203b47;">' . $activate_lable . '</span></a>';
	} else {
		$activate_lable = $lang["deactivate"];
		$activate_link = $link->link("freelancers", '', '&deactivate_id=' . $value[0]);
		$activate_style = '<a href="' . $activate_link . '" style="margin:0 10px;" "><span class="label label-warning" style="background-color:#0a9bb9;border-color:#0a9bb9;">' . $activate_lable . '</span></a>';
	}
	$contract_link = $link->link("contracts", frontend, '&employee_id=' . $value[0]);
	$contract_btn = '<a href="' . $contract_link . '" style="margin:5px;" "><span class="label label-info">' . $lang["contracts"] . '</span></a>';
	$output_arr['data'][$key][count($output_arr['data'][$key])] = $contract_btn . '<a href="' . $edit_link . '" style="margin:0 10px;" "><span class="label label-success">'. $lang["update"] .'</span></a><a href="' . $delete_link . '" style="margin:0 10px;" "><span class="label label-danger">' . $lang["delete"] . '</span></a>' . $activate_style;
// 	<a href="' . $activate_link . '" style="margin:0 10px;" "><span class="label label-warning">' . $activate_lable . '</span></a>';

// btn btn-success fa fa-edit
	//echo "<pre>"; print_r($output_arr['data'][$key]); exit();
}
//echo "<pre>"; print_r($output_arr['data']); exit();
echo json_encode($output_arr);
exit();
