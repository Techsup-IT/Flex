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
    } else {

        //$working_details = $db->run("SELECT * from `shift_check` where `company_id` ='". $_SESSION['company_id']."' AND `current_dt` BETWEEN '" . $start_date . "' AND  '" . $end_date . "'")->fetchAll();
    }
} elseif (isset($_REQUEST['today']) && $_REQUEST['today'] != "none") {
    $start_date = date('Y-m-d');
    $end_date = date('Y-m-d');
    //$working_details = $db->run("SELECT * from `shift_check` where `company_id` ='". $_SESSION['company_id']."' AND `current_dt`= '" .$start_date."' ")->fetchAll();

} elseif (isset($_REQUEST['seven_day']) && $_REQUEST['seven_day'] != "none") {
    $end_date = date('Y-m-d', strtotime("-1 days"));
    $start_date = strtotime($end_date . " -6 days");
    $start_date = date('Y-m-d', $start_date);
    //$working_details = $db->run("SELECT * from `shift_check` where `company_id` ='". $_SESSION['company_id']."' AND `current_dt` BETWEEN '" . $start_date . "' AND  '" . $end_date . "'")->fetchAll();

} elseif (isset($_REQUEST['thirty_day']) && $_REQUEST['thirty_day'] != "none") {
    $end_date = date('Y-m-d', strtotime("-1 days"));
    $start_date = strtotime($end_date . " -30 days");
    $start_date = date('Y-m-d', $start_date);
    //$working_details = $db->run("SELECT * from `shift_check` where `company_id` ='". $_SESSION['company_id']."' AND `current_dt` BETWEEN '" . $start_date . "' AND  '" . $end_date . "'")->fetchAll();
} elseif (isset($_REQUEST['sixty_day']) && $_REQUEST['sixty_day'] != "none") {
    $end_date = date('Y-m-d', strtotime("-1 days"));
    $start_date = strtotime($end_date . " -60 days");
    $start_date = date('Y-m-d', $start_date);
    //$working_details = $db->run("SELECT * from `shift_check` where `company_id` ='". $_SESSION['company_id']."' AND `current_dt` BETWEEN '" . $start_date . "' AND  '" . $end_date . "'")->fetchAll();
} else {
    //$working_details = $db->get_all('shift_check',array('company_id'=>$_SESSION['company_id']));
    $end_date = date('Y-m-d');
    $start_date = date('Y-m-d', strtotime("-1 months"));
    //$working_details = $db->run("SELECT * from `shift_check` where `company_id` ='". $_SESSION['company_id']."' AND `current_dt` BETWEEN '" . $start_date . "' AND  '" . $end_date . "'")->fetchAll();
}

if (isset($_POST['approve_time_submit'])) {
    $id = $_POST['edit_entry_id'];
    $total_working_time = strtotime($_POST['total_working_time']);
    $approved_time = strtotime($_POST['approved_time']) - strtotime('00:00:00');
    $data = array(
        'approved_time' => $approved_time,
        'manual_edit' => 1,
    );
    $where = array('id' => $id);

    if ($id > 0) {
        $update_data = $db->update('shift_check', $data, $where);
        if ($update_data) {
            $display_msg = '<div class="alert alert-success">
                              <i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["update_success"] . '
                            </div>';
        } else {
            $display_msg = '<div class="alert alert-danger">
                              <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["error_occured"] . '
                            </div>';
        }
    } else {
        $display_msg = '<div class="alert alert-danger">
                            <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["error_occured"] . '
                        </div>';
    }
}

if ($_SESSION['department'] == 2 || $_SESSION['department'] == 3) {
    // $report_details = $db->run("SELECT e.employee_id, e.emp_name, p.project_name, t.task_name, SUM(sc.check_out_time) as working_hours, ecm.hourly_rate FROM `shift_check` sc left join `employee` e on e.employee_id = sc.employee_id left join projects p on p.project_id= sc.project_id left join to_do_list t on t.task_id = sc.task_id LEFT JOIN employee_company_map ecm on ecm.employee_id = sc.employee_id WHERE sc.company_id = '" . $_SESSION['company_id'] . "' and sc.employee_id = '" . $_SESSION['employee_id'] . "' and sc.current_dt BETWEEN '" . $start_date . "' AND '" . $end_date . "' GROUP by sc.employee_id,sc.project_id,sc.task_id ORDER BY e.`emp_name` ASC ")->fetchAll();
    $report_details = $db->run("SELECT e.employee_id, e.emp_name, p.project_name, t.task_name, SUM(sc.check_out_time) as working_hours, SUM(sc.approved_time) as approved_time, ecm.hourly_rate FROM `shift_check` sc left join `employee` e on e.employee_id = sc.employee_id left join projects p on p.project_id= sc.project_id left join to_do_list t on t.task_id = sc.task_id LEFT JOIN employee_company_map ecm on ecm.employee_id = sc.employee_id WHERE sc.company_id = '" . $_SESSION['company_id'] . "' and sc.employee_id = '" . $_SESSION['employee_id'] . "' and sc.current_dt BETWEEN '" . $start_date . "' AND '" . $end_date . "'  ORDER BY e.`emp_name` ASC ")->fetchAll();
} else {
    // $report_details = $db->run("SELECT e.employee_id, e.emp_name, p.project_name, t.task_name, SUM(sc.check_out_time) as working_hours FROM `shift_check` sc left join `employee` e on e.employee_id = sc.employee_id left join projects p on p.project_id= sc.project_id left join to_do_list t on t.task_id = sc.task_id WHERE sc.company_id = '" . $_SESSION['company_id'] . "' and sc.current_dt BETWEEN '" . $start_date . "' AND '" . $end_date . "' and (e.`department` = 2 OR e.`department` = 3) GROUP by sc.employee_id,sc.project_id,sc.task_id ORDER BY e.`emp_name` ASC ")->fetchAll();
    $report_details = $db->run("SELECT sc.id, sc.current_dt, sc.check_in, sc.check_out, sc.approved_time, e.employee_id, e.emp_name, p.project_name, t.task_name, sc.check_out_time as working_hours FROM `shift_check` sc left join `employee` e on e.employee_id = sc.employee_id left join projects p on p.project_id= sc.project_id left join to_do_list t on t.task_id = sc.task_id WHERE sc.company_id = '" . $_SESSION['company_id'] . "' and sc.current_dt BETWEEN '" . $start_date . "' AND '" . $end_date . "' and (e.`department` = 2 OR e.`department` = 3)  ORDER BY e.`emp_name` ASC ")->fetchAll();
}

// $report_details = $db->run("SELECT e.emp_name, p.project_name, t.task_name, SUM(sc.check_out_time) as working_hours FROM `shift_check` sc left join `employee` e on e.employee_id = sc.employee_id left join projects p on p.project_id= sc.project_id left join to_do_list t on t.task_id = sc.task_id WHERE sc.company_id = '". $_SESSION['company_id']."' and sc.current_dt BETWEEN '".$start_date."' AND '".$end_date."' GROUP by sc.employee_id,sc.project_id,sc.task_id ORDER BY e.`emp_name` ASC ")->fetchAll();
//echo "<pre>"; print_r($report_details); exit();

if (SITE_DATE_FORMAT == 1) {
    $date_format = "DD-MM-YYYY";
} elseif (SITE_DATE_FORMAT == 2) {
    $date_format = "MM-DD-YYYY";
} elseif (SITE_DATE_FORMAT == 3) {
    $date_format = "Day-Month-Year";
}
