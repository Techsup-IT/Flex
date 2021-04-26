<?php

if ($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 6) {
	// $users = $db->run("SELECT employee_id, emp_name, emp_surname, email from `employee` where `department`='2' AND `company_id` ='". $_SESSION['company_id']."' AND `status` = 0 ")->fetchAll();
	$user_companies = array($_SESSION['company_id']);
	$companies = $db->run("SELECT emp.company_id, c.company_name FROM employee_company_map emp LEFT JOIN company c on c.id = emp.company_id WHERE employee_id  IN (SELECT e.employee_id FROM employee e LEFT JOIN employee_company_map m on m.employee_id = e.employee_id WHERE m.company_id = " . $_SESSION['company_id'] . " and e.department = 3)")->fetchAll();
	if (!empty($companies)) {
		foreach ($companies as $c) {
			$user_companies[] = $c['company_id'];
		}
	}
	$users = $db->run("SELECT employee_id, emp_name, emp_surname, email from `employee` where ((`department`='2' AND `company_id` ='" . $_SESSION['company_id'] . "') OR (`department`='3' AND `company_id` in (" . implode(',', $user_companies) . ")) ) AND `status` = 0 ")->fetchAll();
	$user_count = count($users);
}

if (isset($_REQUEST['employee_id']) && $_REQUEST['employee_id'] != '') {
	$messages = $db->run("SELECT * from `messages` where `employee_id`= '" . $_REQUEST['employee_id'] . "' AND `company_id` = '" . $_SESSION['company_id'] . "' ")->fetchAll();
	// echo "<pre>"; print_r($messages); exit();
}
