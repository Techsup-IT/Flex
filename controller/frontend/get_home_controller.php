<?php

$table = '`shift_check` as s LEFT JOIN `employee` as e on s.employee_id=e.employee_id';
$primaryKey = 'id';
$columns = array(
				array( 'db' => 'e`.`employee_id', 'dt' => 0 ),
				array( 'db' => 'emp_name', 'dt' => 1 ),
				array( 'db' => 's`.`ip_address', 'dt' => 2 ),
				array( 'db' => 'id', 'dt' => 3 ),
);

$c_columns = array(
				array( 'db' => 'employee_id', 'dt' => 0 ),
				array( 'db' => 'emp_name', 'dt' => 1 ),
				array( 'db' => 'ip_address', 'dt' => 2 ),
				array( 'db' => 'id', 'dt' => 3 ),
);

$sql_details = array(
	'user' => DB_USER,
	'pass' => DB_PASSWORD,
	'db'   => DB_NAME,
	'host' => DB_HOST
);

$where = array("s.company_id = '".$_SESSION['company_id']."'","department = 2");
$group_by = "GROUP by s.employee_id";
$output_arr = SSP::custom_complex( $_GET, $sql_details, $table, $primaryKey, $columns, $where,'', $group_by, $c_columns);
foreach ($output_arr['data'] as $key => $value) {
	$employee_id = $value[0];
	$activitylink = $link->link('activity_list',frontend,'&today'.'&emp='.$employee_id);
	$work_link = $link->link('working_hour',frontend,'&working_emp='.$employee_id);
	$delete_link = $link->link("tasks",frontend,'&del_task_id='.$task_id);
	// $output_arr['data'][$key][count($output_arr['data'][$key]) - 3 ] = '<a href="'.$activitylink.'">'.$value[1].'</a>';
	$output_arr['data'][$key][count($output_arr['data'][$key]) - 3 ] = $value[1];
	//$time=$db->get_row('shift_check',array('employee_id'=>$employee_id),'check_in');
	$db->order_by = "id";
	$time=$db->get_col('shift_check',array('employee_id'=>$employee_id),'check_in');
	if(isset($time) && !empty($time) && $time != ''){
		$time['check_in'] = end($time);
	}
	else{
		$time=$db->get_row('shift_check',array('employee_id'=>$employee_id),'check_in');
	}
	$output_arr['data'][$key][count($output_arr['data'][$key]) - 1 ] = $feature->time_elapsed_string(date("Y-m-d H:i:s",$time['check_in']));
	$output_arr['data'][$key][count($output_arr['data'][$key])] = date("Y-m-d H:i:s",$time['check_in']);
}
//echo "<pre>"; print_r($output_arr['data']); exit();
echo json_encode($output_arr);
exit();
?>