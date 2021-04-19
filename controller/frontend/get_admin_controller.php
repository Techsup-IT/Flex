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

// $where = array("department = '1' AND company_id = '".$_SESSION['company_id']."'");
// $user_companies = array();
$user_companies = array($_SESSION['company_id']);
$companies = $db->run("SELECT emp.company_id, c.company_name FROM employee_company_map emp LEFT JOIN company c on c.id = emp.company_id WHERE employee_id  IN (SELECT e.employee_id FROM employee e LEFT JOIN employee_company_map m on m.employee_id = e.employee_id WHERE m.company_id = " . $_SESSION['company_id'] . " and e.department = 1)")->fetchAll();
if (!empty($companies)) {
    foreach ($companies as $c) {
        $user_companies[] = $c['company_id'];
    }
}
$where = array("department = '1' AND company_id IN (" . implode(',', $user_companies) . ")");

$output_arr = SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $where);
foreach ($output_arr['data'] as $key => $value) {
    $edit_link = $link->link("edit_admin", frontend, '&edit=' . $value[0]);
    $delete_link = $link->link("admin", '', '&del_id=' . $value[0]);
    $activate = $db->get_col('employee', array('employee_id' => $value[0]), 'status');
    if (end($activate) == 1) {
        $activate_lable = $lang["activate"];
        $activate_link = $link->link("admin", '', '&activate_id=' . $value[0]);
        $activate_style = '<a href="' . $activate_link . '" style="margin:0 10px;" "><span class="label label-warning" style="background-color:#203b47;border-color:#203b47;">' . $activate_lable . '</span></a>';
    } else {
        $activate_lable = $lang["deactivate"];
        $activate_link = $link->link("admin", '', '&deactivate_id=' . $value[0]);
        $activate_style = '<a href="' . $activate_link . '" style="margin:0 10px;" "><span class="label label-warning" style="background-color:#0a9bb9;border-color:#0a9bb9;">' . $activate_lable . '</span></a>';
    }
    $output_arr['data'][$key][count($output_arr['data'][$key])] = '<a href="' . $edit_link . '" style="margin:0 10px;" "><span class="btn btn-success fa fa-edit">' . '</span></a><a href="' . $delete_link . '" style="margin:0 10px;" "><span class="btn btn-danger fa fa-trash">' . '</span></a>' . $activate_style;
    // <a href="' . $activate_link . '" style="margin:0 10px;" "><span class="label label-warning">' . $activate_lable . '</span></a>'
}
// echo "<pre>"; print_r($output_arr['data']); exit();
echo json_encode($output_arr);
exit();
