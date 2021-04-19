<?php

$table = '`employee` as e LEFT JOIN `company` as c on c.id = e.company_id';
$primaryKey = 'employee_id';
$columns = array(
                array( 'db' => 'e`.`employee_id', 'dt' => 0 ),
                array( 'db' => 'emp_name', 'dt' => 1 ),
                array( 'db' => 'e`.`email', 'dt' => 2 ),
                array( 'db' => 'c`.`company_name', 'dt' => 3 ),
                array( 'db' => 'department', 'dt' => 4 ),
);

$c_columns = array(
                array( 'db' => 'employee_id', 'dt' => 0 ),
                array( 'db' => 'emp_name', 'dt' => 1 ),
                array( 'db' => 'email', 'dt' => 2 ),
                array( 'db' => 'company_name', 'dt' => 3 ),
                array( 'db' => 'department', 'dt' => 4 ),
);

$sql_details = array(
    'user' => DB_USER,
    'pass' => DB_PASSWORD,
    'db'   => DB_NAME,
    'host' => DB_HOST
);

$where = array("department != 5");
$output_arr = SSP::custom_complex( $_GET, $sql_details, $table, $primaryKey, $columns, $where,'', $group_by, $c_columns);

foreach ($output_arr['data'] as $key => $value) {
    $role = '';
    if($value[4] == 1){$role = $lang["admin"];}
    else if($value[4] == 4){$role = $lang["manager"];}
    else{$role = $lang["employee"];}
	$output_arr['data'][$key][count($output_arr['data'][$key])-1] = $role;
}
// echo "<pre>"; print_r($output_arr['data']); exit();
echo json_encode($output_arr);
exit();
?>