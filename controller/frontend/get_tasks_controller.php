<?php

$table = 'to_do_list LEFT JOIN projects ON to_do_list.project_id = projects.project_id LEFT JOIN employee ON to_do_list.employee_id = employee.employee_id';
$primaryKey = 'task_id';
$columns = array(
				array( 'db' => 'task_name', 'dt' => 0 ),
				array( 'db' => 'project_name', 'dt' => 1 ),
				array( 'db' => 'emp_name', 'dt' => 2 ),
				array( 'db' => 'task_id', 'dt' => 3 ),
);

$sql_details = array(
	'user' => DB_USER,
	'pass' => DB_PASSWORD,
	'db'   => DB_NAME,
	'host' => DB_HOST
);
$where = array("to_do_list.company_id = '".$_SESSION['company_id']."'");
$output_arr = SSP::custom_complex( $_GET, $sql_details, $table, $primaryKey, $columns, $where);
foreach ($output_arr['data'] as $key => $value) {
	$task_id = $value[3];
	$edit_link = $link->link("edit_task",frontend,'&edit_task_id='.$task_id);
	$delete_link = $link->link("tasks",frontend,'&del_task_id='.$task_id);
	$output_arr['data'][$key][count($output_arr['data'][$key]) - 1 ] = '';
	$output_arr['data'][$key][count($output_arr['data'][$key]) - 1 ] .= '<a style="margin:0 10px;" href="'.$edit_link.'" class="btn btn-success fa fa-edit"></a><a href="'.$delete_link.'" class="btn btn-danger fa fa-trash"></a>';
	//echo "<pre>"; print_r($output_arr['data'][$key]); exit();
}
//echo "<pre>"; print_r($output_arr['data']); exit();
echo json_encode($output_arr);
exit();