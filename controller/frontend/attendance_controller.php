<?php

/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/

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

// $report_details = $db->run("SELECT employee.emp_name, shift_check.current_dt, MIN(shift_check.check_in) as check_in, MAX(shift_check.check_out) as check_out, SUM(shift_check.check_out_time) as working_hours from shift_check LEFT JOIN employee on employee.employee_id = shift_check.employee_id WHERE shift_check.company_id = '". $_SESSION['company_id']."' and shift_check.current_dt BETWEEN '".$start_date."' AND '".$end_date."' GROUP BY shift_check.employee_id, shift_check.current_dt ORDER BY employee.`emp_name` ASC, shift_check.`current_dt` DESC")->fetchAll();
if ($_SESSION['department'] == 2 || $_SESSION['department'] == 3) {
    $report_details = $db->run("SELECT employee.employee_id, concat(employee.emp_name, ' ',employee.emp_surname) as emp_name, shift_check.current_dt, MIN(shift_check.check_in) as check_in, MAX(shift_check.check_out) as check_out, SUM(shift_check.check_out_time) as working_hours, count(*) as checkin_count, manual_edit, cron_edit from shift_check LEFT JOIN employee on employee.employee_id = shift_check.employee_id WHERE shift_check.company_id = '" . $_SESSION['company_id'] . "' and shift_check.employee_id = '" . $_SESSION['employee_id'] . "' and shift_check.current_dt BETWEEN '" . $start_date . "' AND '" . $end_date . "' GROUP BY shift_check.employee_id, shift_check.current_dt ORDER BY employee.`emp_name` ASC, shift_check.`current_dt` DESC")->fetchAll();
} else {
    $report_details = $db->run("SELECT employee.employee_id, concat(employee.emp_name, ' ',employee.emp_surname) as emp_name, shift_check.current_dt, MIN(shift_check.check_in) as check_in, MAX(shift_check.check_out) as check_out, SUM(shift_check.check_out_time) as working_hours, count(*) as checkin_count, manual_edit, cron_edit from shift_check LEFT JOIN employee on employee.employee_id = shift_check.employee_id WHERE shift_check.company_id = '" . $_SESSION['company_id'] . "' and shift_check.current_dt BETWEEN '" . $start_date . "' AND '" . $end_date . "' and (employee.`department` = 2 OR employee.`department` = 3) GROUP BY shift_check.employee_id, shift_check.current_dt ORDER BY employee.`emp_name` ASC, shift_check.`current_dt` DESC")->fetchAll();
}
// $report_details = $db->run("SELECT employee.emp_name, shift_check.current_dt, MIN(shift_check.check_in) as check_in, MAX(shift_check.check_out) as check_out, SUM(shift_check.check_out_time) as working_hours, count(*) as checkin_count from shift_check LEFT JOIN employee on employee.employee_id = shift_check.employee_id WHERE shift_check.company_id = '". $_SESSION['company_id']."' and shift_check.current_dt BETWEEN '".$start_date."' AND '".$end_date."' GROUP BY shift_check.employee_id, shift_check.current_dt ORDER BY employee.`emp_name` ASC, shift_check.`current_dt` DESC")->fetchAll();
// echo "<pre>"; print_r($report_details);exit();

if (SITE_DATE_FORMAT == 1) {
    $date_format = "DD-MM-YYYY";
} elseif (SITE_DATE_FORMAT == 2) {
    $date_format = "MM-DD-YYYY";
} elseif (SITE_DATE_FORMAT == 3) {
    $date_format = "Day-Month-Year";
}
