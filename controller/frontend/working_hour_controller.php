<?php



$working_emp = $_REQUEST['working_emp'];
$user_name = $db->get_var('employee', array('employee_id' => $working_emp), 'emp_name');



$db->order_by = "`id` DESC";

$working_details = $db->get_all('shift_check', array('company_id' => $_SESSION['company_id'], 'employee_id' => $working_emp));
$working_date_format = $working_details['current_dt'];

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

        $db->order_by = "`id` DESC";
        $working_details = $db->run("SELECT * from `shift_check` where `company_id` ='" . $_SESSION['company_id'] . "' AND `employee_id` ='" . $working_emp . "' AND `current_dt` BETWEEN '" . $start_date . "' AND  '" . $end_date . "'")->fetchAll();
    }
}



if (SITE_DATE_FORMAT == 1) {
    $date_format = "DD-MM-YYYY";
} elseif (SITE_DATE_FORMAT == 2) {
    $date_format = "MM-DD-YYYY";
} elseif (SITE_DATE_FORMAT == 3) {
    $date_format = "Day-Month-Year";
}
