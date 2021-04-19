<?php

$table = '`employee` as e LEFT JOIN `company` as c on c.id = e.company_id';
$primaryKey = 'e`.`employee_id';
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

$emp_shift_details = array();
$active_employees = array(0);

$yesterday=date('Y-m-d',strtotime("-1 days"));
$last_7date = strtotime( $yesterday . " -6 days" );
$last_7date=date('Y-m-d',$last_7date);
$active_employees_seven_day = array(0);

$last_30date = strtotime( $yesterday . " -30 days" );
$last_30date=date('Y-m-d',$last_30date);
$active_employees_thirty_day = array(0);

$last_60date = strtotime( $yesterday . " -60 days" );
$last_60date=date('Y-m-d',$last_60date);
$active_employees_sixty_day = array(0);

if(isset($_REQUEST['type']) && $_REQUEST['type'] != ''){
    $sql = "SELECT employee_id, current_dt, check_out FROM shift_check WHERE id IN ( SELECT MAX(id) FROM shift_check GROUP BY employee_id)";
    $shift_details = $db->run($sql)->fetchAll();
    foreach ($shift_details as $shift) {
        $emp_shift_details[$shift['employee_id']] = $shift;
        if($shift['current_dt'] == date('Y-m-d') && ($shift['check_out'] == '' || is_null($shift['check_out']))){
            $active_employees[] = $shift['employee_id'];
        }

        if($shift['current_dt'] >= $last_7date && $shift['current_dt'] <= $yesterday){
            $active_employees_seven_day[] = $shift['employee_id'];
        }

        if($shift['current_dt'] >= $last_30date && $shift['current_dt'] <= $yesterday){
            $active_employees_thirty_day[] = $shift['employee_id'];
        }

        if($shift['current_dt'] >= $last_60date && $shift['current_dt'] <= $yesterday){
            $active_employees_sixty_day[] = $shift['employee_id'];
        }
    }
    // echo "<pre>"; print_r($active_employees_sixty_day); exit();

    $where[] = "department = 2";
    if($_REQUEST['type'] == 'inactive'){
        $where[] = "e.employee_id NOT IN (".implode(',', array_keys($emp_shift_details)).")";
    }

    else if($_REQUEST['type'] == 'active'){
        $where[] = "e.employee_id IN (".implode(',', $active_employees).")";
    }

    else if($_REQUEST['type'] == 'seven_day'){
        $where[] = "e.employee_id IN (".implode(',', $active_employees_seven_day).")";
    }

    else if($_REQUEST['type'] == 'thirty_day'){
        $where[] = "e.employee_id IN (".implode(',', $active_employees_thirty_day).")";
    }

    else if($_REQUEST['type'] == 'sixty_day'){
        $where[] = "e.employee_id IN (".implode(',', $active_employees_sixty_day).")";
    }
}

$output_arr = SSP::custom_complex( $_GET, $sql_details, $table, $primaryKey, $columns, $where,'', $group_by, $c_columns);
// echo "<pre>"; print_r($output_arr); exit();

foreach ($output_arr['data'] as $key => $value) {
    $role = '';
    if($value[4] == 1){$role = $lang["admin"];}
    else if($value[4] == 3){$role = $lang["freelancer"];}
    else if($value[4] == 4){$role = $lang["manager"];}
    else if($value[4] == 5){$role = $lang["admin"];}
    else if($value[4] == 6){$role = $lang["supervisor"];}
    else{$role = $lang["employee"];}
	$output_arr['data'][$key][count($output_arr['data'][$key])-1] = $role;
}
// echo "<pre>"; print_r($output_arr); exit();
echo json_encode($output_arr);
exit();
