<?php

/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/

$db->order_by = "`id` DESC";
$r_t = '';
$is_rt = '';

if (isset($_REQUEST['daily']) && $_REQUEST['daily'] != "none") {
    $start_date = date('Y-m-d');
    $end_date = date('Y-m-d');
    $r_t = 'daily';
    $is_rt = 'daily';
} elseif (isset($_REQUEST['weekly']) && $_REQUEST['weekly'] != "none") {
    $end_date = date('Y-m-d');
    $start_date = date('Y-m-d', strtotime("-6 days"));
    $r_t = 'weekly';
    $is_rt = 'weekly';
} elseif (isset($_REQUEST['monthly']) && $_REQUEST['monthly'] != "none") {
    $end_date = date('Y-m-d');
    $start_date = date('Y-m-d', strtotime("-1 months"));
    $r_t = 'monthly';
    $is_rt = 'monthly';
} else {
    $start_date = date('Y-m-d');
    $end_date = date('Y-m-d');
    $r_t = 'daily';
    $is_rt = 'daily';
}

if (isset($_POST['show_data'])) {
    $r_t = $_POST['r_t'];
    $start_date = $_POST['start_date'];
    $start_date = date('Y-m-d', strtotime($start_date));

    $end_date = $_POST['end_date'];
    $end_date = date('Y-m-d', strtotime($end_date));
}

if ($_SESSION['department'] == 2 || $_SESSION['department'] == 3) {
    $report_details = $db->run("SELECT e.employee_id, e.emp_name,  
        SUM(case
            when sc.manual_edit = 1
            then sc.check_out_time else 0
            end)
        as ewh,
        SUM(sc.check_out_time) as working_hours  
        FROM `shift_check` sc left join `employee` e on e.employee_id = sc.employee_id  
        WHERE sc.company_id = '" . $_SESSION['company_id'] . "' and sc.employee_id = '" . $_SESSION['employee_id'] . "' and sc.current_dt BETWEEN '" . $start_date . "' AND '" . $end_date . "' 
        GROUP by sc.employee_id 
        ORDER BY e.`emp_name` ASC")->fetchAll();
} else {

    $user_companies = array($_SESSION['company_id']);
    $companies = $db->run("SELECT emp.company_id, c.company_name FROM employee_company_map emp LEFT JOIN company c on c.id = emp.company_id WHERE employee_id  IN (SELECT e.employee_id FROM employee e LEFT JOIN employee_company_map m on m.employee_id = e.employee_id WHERE m.company_id = " . $_SESSION['company_id'] . " and e.department = 3)")->fetchAll();
    if (!empty($companies)) {
        foreach ($companies as $c) {
            $user_companies[] = $c['company_id'];
        }
    }

    $report_details = $db->run("SELECT e.employee_id, e.emp_name,
        SUM(case
            when sc.manual_edit = 1
            then sc.check_out_time else 0
            end)
        as ewh,
        SUM(sc.check_out_time) as working_hours  
        from `employee` e left join `shift_check` sc on sc.employee_id = e.employee_id and sc.current_dt BETWEEN '" . $start_date . "' AND '" . $end_date . "' 
        where (e.company_id = '" . $_SESSION['company_id'] . "' and e.department = 2) 
        or (e.company_id in (" . implode(',', $user_companies) . ") and e.department = 3) 
        GROUP by e.employee_id
        ORDER BY e.`emp_name` ASC")->fetchAll();
}

$iasql = "SELECT e.employee_id FROM `employee` e LEFT JOIN shift_check sc on sc.employee_id = e.employee_id WHERE e.company_id = " . $_SESSION['company_id'] . " and e.department = 2 and sc.employee_id is null group by e.employee_id";
$inactive_employees = $db->run($iasql)->fetchAll();
$inactive_emp = array();
if (count($inactive_employees) > 0) {
    foreach ($inactive_employees as $inactive_employee) {
        $inactive_emp[] = $inactive_employee['employee_id'];
    }
}
// echo "<pre>"; print_r($inactive_emp); exit();

if (SITE_DATE_FORMAT == 1) {
    $date_format = "DD-MM-YYYY";
} elseif (SITE_DATE_FORMAT == 2) {
    $date_format = "MM-DD-YYYY";
} elseif (SITE_DATE_FORMAT == 3) {
    $date_format = "Day-Month-Year";
}
