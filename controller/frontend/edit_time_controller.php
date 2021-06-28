<?php

/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/

// echo "<pre>"; print_r($_POST); exit();
$db->order_by = "`id` DESC";

if (isset($_POST['show_data'])) {
    $start_date = $_POST['start_date'];
    $start_date = date('Y-m-d', strtotime($start_date));

    $end_date = $_POST['end_date'];
    $end_date = date('Y-m-d', strtotime($end_date));

    if ($start_date > $end_date) {
        $display_msg = '<div class="alert alert-danger">
        <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times</button>
            ' . $lang["start_date_must_less_then_end_date"] . '
        </div>';
    }
} elseif (isset($_REQUEST['today']) && $_REQUEST['today'] != "none") {
    $start_date = date('Y-m-d');
    $end_date = date('Y-m-d');
} elseif (isset($_REQUEST['seven_day']) && $_REQUEST['seven_day'] != "none") {
    $end_date = date('Y-m-d', strtotime("-1 days"));
    $start_date = strtotime($end_date . " -6 days");
    $start_date = date('Y-m-d', $start_date);
} elseif (isset($_REQUEST['thirty_day']) && $_REQUEST['thirty_day'] != "none") {
    $end_date = date('Y-m-d', strtotime("-1 days"));
    $start_date = strtotime($end_date . " -30 days");
    $start_date = date('Y-m-d', $start_date);
} elseif (isset($_REQUEST['sixty_day']) && $_REQUEST['sixty_day'] != "none") {
    $end_date = date('Y-m-d', strtotime("-1 days"));
    $start_date = strtotime($end_date . " -60 days");
    $start_date = date('Y-m-d', $start_date);
} else {
    $end_date = date('Y-m-d');
    $start_date = date('Y-m-d', strtotime("-1 months"));
}

// $sql = "SELECT employee_id, emp_name FROM `employee` WHERE company_id = " . $_SESSION['company_id'] . " and department = 2";

$user_companies = array($_SESSION['company_id']);
$companies = $db->run("SELECT emp.company_id, c.company_name FROM employee_company_map emp LEFT JOIN company c on c.id = emp.company_id WHERE employee_id  IN (SELECT e.employee_id FROM employee e LEFT JOIN employee_company_map m on m.employee_id = e.employee_id WHERE m.company_id = " . $_SESSION['company_id'] . " and e.department = 3)")->fetchAll();
if (!empty($companies)) {
    foreach ($companies as $c) {
        $user_companies[] = $c['company_id'];
    }
}
$sql = "SELECT employee_id, emp_name FROM `employee` WHERE (company_id = " . $_SESSION['company_id'] . " and department = 2) OR (department = '3' AND company_id IN (" . implode(',', $user_companies) . "))";
$emp_details = $db->run($sql)->fetchAll();

// $report_details = $db->run("SELECT shift_check.id, employee.emp_name, shift_check.current_dt, shift_check.check_in, shift_check.check_out, shift_check.check_out_time as working_hours, manual_edit, cron_edit from shift_check LEFT JOIN employee on employee.employee_id = shift_check.employee_id WHERE shift_check.company_id = '" . $_SESSION['company_id'] . "' and shift_check.current_dt BETWEEN '" . $start_date . "' AND '" . $end_date . "' and employee.`department` = 2  ORDER BY shift_check.`current_dt` DESC, employee.`emp_name` ASC")->fetchAll();
$report_details = $db->run("SELECT shift_check.id, employee.emp_name, shift_check.current_dt, shift_check.check_in, shift_check.check_out, shift_check.check_out_time as working_hours, manual_edit, cron_edit from shift_check LEFT JOIN employee on employee.employee_id = shift_check.employee_id WHERE shift_check.company_id = '" . $_SESSION['company_id'] . "' and shift_check.current_dt BETWEEN '" . $start_date . "' AND '" . $end_date . "' and (employee.`department` = 2 or employee.`department` = 3)  ORDER BY shift_check.`current_dt` DESC, employee.`emp_name` ASC")->fetchAll();
// echo "<pre>"; print_r($report_details); exit();

if (SITE_DATE_FORMAT == 1) {
    $date_format = "DD-MM-YYYY";
} elseif (SITE_DATE_FORMAT == 2) {
    $date_format = "MM-DD-YYYY";
} elseif (SITE_DATE_FORMAT == 3) {
    $date_format = "Day-Month-Year";
}
