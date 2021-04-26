<?php

if (isset($_POST) && isset($_POST['selected_company_id']) && $_POST['selected_company_id'] != '') {
    $_SESSION['company_id'] = $_POST['selected_company_id'];
}

// $url = $_SESSION['company_id'] . '___' . str_replace('_', '', SITE_URL) . '/';
$url = $_SESSION['company_id'] . '___' . SITE_URL . '/';
$url_encrpt = $security->encrypt($url, key);
$token =  json_encode($url_encrpt);

$employee_id = $_SESSION['employee_id'];
$company_id = $_SESSION['company_id'];

$current_check = array();
$is_checked_in = 0;
$last_check = $db->run("SELECT id,check_in,check_out,current_dt,check_out_time,project_id,task_id from `shift_check` where `employee_id`='" . $employee_id . "' AND `company_id`='" . $company_id . "'  ORDER BY id DESC LIMIT 1")->fetchAll();
// echo "<pre>";print_r($last_check);exit();
if (!empty($last_check)) {
    $last_check_time = $last_check[0]['check_in'];
    $current_time = time();
    if ($last_check[0]['check_out'] == '' && ($current_time - $last_check_time) < 8 * 3600) {
        $current_check = $last_check[0];
        $is_checked_in = 1;
    }
}

$end_date = date('Y-m-d');
$start_date = date('Y-m-d', strtotime("-1 months"));
// $report_details = $db->run("SELECT shift_check.id, employee.emp_name, shift_check.current_dt, shift_check.check_in, shift_check.check_out, shift_check.check_out_time as working_hours, manual_edit, cron_edit from shift_check LEFT JOIN employee on employee.employee_id = shift_check.employee_id WHERE shift_check.company_id = '" . $company_id . "' and employee.employee_id = '" . $employee_id . "' and shift_check.current_dt BETWEEN '" . $start_date . "' AND '" . $end_date . "' and (employee.`department` = 2 or employee.`department` = 3)  ORDER BY shift_check.`id` DESC, employee.`emp_name` ASC")->fetchAll();
$report_details = $db->run("SELECT employee.employee_id, concat(employee.emp_name, ' ',employee.emp_surname) as emp_name, shift_check.current_dt, MIN(shift_check.check_in) as check_in, MAX(shift_check.check_out) as check_out, SUM(shift_check.check_out_time) as working_hours, count(*) as checkin_count, manual_edit, cron_edit from shift_check LEFT JOIN employee on employee.employee_id = shift_check.employee_id WHERE shift_check.company_id = '" . $_SESSION['company_id'] . "' and shift_check.employee_id = '" . $_SESSION['employee_id'] . "' and shift_check.current_dt BETWEEN '" . $start_date . "' AND '" . $end_date . "' GROUP BY shift_check.employee_id, shift_check.current_dt ORDER BY employee.`emp_name` ASC, shift_check.`current_dt` DESC")->fetchAll();
// echo "<pre>";print_r($report_details);exit();

$month_start_date = date('Y-m-01');
$month_end_date = date('Y-m-t');
$current_month_working_details = $db->run("SELECT employee.employee_id, employee.emp_name, SUM(shift_check.check_out_time) as total_duration from shift_check LEFT JOIN employee on employee.employee_id = shift_check.employee_id WHERE shift_check.company_id = '" . $company_id . "' and employee.employee_id = '" . $employee_id . "' and shift_check.current_dt BETWEEN '" . $month_start_date . "' AND '" . $month_end_date . "' and (employee.`department` = 2 or employee.`department` = 3) GROUP BY employee.employee_id  ORDER BY shift_check.`id` DESC, employee.`emp_name` ASC")->fetchAll();
$current_month_working_duration = isset($current_month_working_details[0]) ? (int)$current_month_working_details[0]['total_duration'] : 0;

if ($_SESSION['department'] == 3) {
    $fc_max_working_hour = $db->run("SELECT working_hours from employee_company_map where employee_id = $employee_id and company_id = $company_id")->fetchAll();
    $fc_monthly_max_working_duration = isset($fc_max_working_hour[0]) ? ($fc_max_working_hour[0]['working_hours'] * 3600) : 0;
    // echo "<pre>"; print_r($fc_max_working_hour); echo $fc_monthly_max_working_duration; exit;
}

if ($_SESSION['department'] == 2) {
    $fc_max_working_hour = $db->run("SELECT hour from employee where employee_id = $employee_id and company_id = $company_id")->fetchAll();
    $fc_monthly_max_working_duration = isset($fc_max_working_hour[0]) ? ($fc_max_working_hour[0]['hour'] * 3600) : 0;
    // echo "<pre>"; print_r($fc_max_working_hour); echo $fc_monthly_max_working_duration; exit;
}

$user_projects = $db->run("SELECT pa.project_id, p.project_name FROM project_assign pa LEFT JOIN projects p on p.project_id = pa.project_id WHERE pa.employee_id = $employee_id and pa.company_id = $company_id and p.end_date >= '" . date('Y-m-d') . "' ")->fetchAll();
$user_tasks = $db->run("SELECT t.task_id, t.task_name, t.project_id FROM to_do_list t WHERE t.project_id in ( SELECT pa.project_id FROM project_assign pa LEFT JOIN projects p on p.project_id = pa.project_id WHERE pa.employee_id = $employee_id and pa.company_id = $company_id and p.end_date >= '" . date('Y-m-d') . "'  )")->fetchAll();
