<?php

/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/

$db->order_by = "`id` ASC";
$r_t = '';
$is_rt = '';

// $emp_data = 'e.employee_id, e.company_id, e.IdNumber, e.EstLaborOfficeId, e.EstSequenceNumber, e.is_molTWC, e.emp_name, e.emp_surname, e.email, e.contact1, e.address';
$emp_data = 'e.employee_id, e.company_id, e.IdNumber, e.EstLaborOfficeId, e.EstSequenceNumber, e.is_molTWC, e.emp_name, e.emp_surname, e.email, e.contact1, e.address, c.company_name';

$all_companies_users = 0;

$user_companies = array($_SESSION['company_id']);
$companies = $db->run("SELECT emp.company_id, c.company_name FROM employee_company_map emp LEFT JOIN company c on c.id = emp.company_id WHERE employee_id  IN (SELECT e.employee_id FROM employee e LEFT JOIN employee_company_map m on m.employee_id = e.employee_id WHERE m.company_id = " . $_SESSION['company_id'] . " and e.department = 3)")->fetchAll();
if (!empty($companies)) {
    foreach ($companies as $c) {
        $user_companies[] = $c['company_id'];
    }
}

if (($_SESSION['department'] == 5) && isset($_REQUEST['all_companies_user'])) {
    $all_companies_users = 1;
}

$sql = "SELECT " . $emp_data . " FROM `employee` e left join `company` c on c.id = e.company_id WHERE e.company_id = " . $_SESSION['company_id'] . " AND e.department = 2 AND e.is_molTWC = 1";
if ($all_companies_users == 1) {
    // $sql = "SELECT " . $emp_data . " FROM `employee` e left join `company` c on c.id = e.company_id WHERE e.department = 2 AND e.is_molTWC = 1";
    $sql = "SELECT " . $emp_data . " FROM `employee` e left join `company` c on c.id = e.company_id WHERE (e.department = 2 or e.department = 3) AND e.is_molTWC = 1";
}

if (isset($_REQUEST['twc'])) {
    $r_t = 'twc';
    $is_rt = 'twc';
} elseif (isset($_REQUEST['active'])) {
    $r_t = 'active';
    $is_rt = 'active';
    // $sql = "SELECT ".$emp_data.", sc.ip_address FROM `shift_check` sc left join employee e on sc.employee_id = e.employee_id WHERE sc.company_id = ".$_SESSION['company_id']." and sc.current_dt = '".date('Y-m-d')."' and ( sc.check_out = '' or sc.check_out IS NULL ) group by sc.employee_id";
    // $sql = "SELECT " . $emp_data . " , count(sc.employee_id) as check_count FROM `employee` e left join `company` c on c.id = e.company_id LEFT JOIN shift_check sc on sc.employee_id = e.employee_id WHERE e.company_id = " . $_SESSION['company_id'] . " and e.department = 2 and sc.employee_id is not null group by e.employee_id";
    $sql = "SELECT " . $emp_data . " , count(sc.employee_id) as check_count FROM `employee` e left join `company` c on c.id = e.company_id LEFT JOIN shift_check sc on sc.employee_id = e.employee_id WHERE ((e.company_id = " . $_SESSION['company_id'] . " and e.department = 2) or (e.company_id in (" . implode(',', $user_companies) . ") and e.department = 3) ) and sc.employee_id is not null group by e.employee_id";
    if ($all_companies_users == 1) {
        // $sql = "SELECT " . $emp_data . " , count(sc.employee_id) as check_count FROM `employee` e left join `company` c on c.id = e.company_id LEFT JOIN shift_check sc on sc.employee_id = e.employee_id WHERE e.department = 2 and sc.employee_id is not null group by e.employee_id";
        $sql = "SELECT " . $emp_data . " , count(sc.employee_id) as check_count FROM `employee` e left join `company` c on c.id = e.company_id LEFT JOIN shift_check sc on sc.employee_id = e.employee_id WHERE (e.department = 2 or e.department = 3) and sc.employee_id is not null group by e.employee_id";
    }
} elseif (isset($_REQUEST['inactive'])) {
    $r_t = 'inactive';
    $is_rt = 'inactive';
    // $sql = "SELECT " . $emp_data . " , count(sc.employee_id) as check_count FROM `employee` e left join `company` c on c.id = e.company_id LEFT JOIN shift_check sc on sc.employee_id = e.employee_id WHERE e.company_id = " . $_SESSION['company_id'] . " and e.department = 2 and sc.employee_id is null group by e.employee_id";
    $sql = "SELECT " . $emp_data . " , count(sc.employee_id) as check_count FROM `employee` e left join `company` c on c.id = e.company_id LEFT JOIN shift_check sc on sc.employee_id = e.employee_id WHERE ((e.company_id = " . $_SESSION['company_id'] . " and e.department = 2) or (e.company_id in (" . implode(',', $user_companies) . ") and e.department = 3) ) and sc.employee_id is null group by e.employee_id";
    if ($all_companies_users == 1) {
        // $sql = "SELECT " . $emp_data . " , count(sc.employee_id) as check_count FROM `employee` e left join `company` c on c.id = e.company_id LEFT JOIN shift_check sc on sc.employee_id = e.employee_id WHERE e.department = 2 and sc.employee_id is null group by e.employee_id";
        $sql = "SELECT " . $emp_data . " , count(sc.employee_id) as check_count FROM `employee` e left join `company` c on c.id = e.company_id LEFT JOIN shift_check sc on sc.employee_id = e.employee_id WHERE (e.department = 2 or e.department = 3) and sc.employee_id is null group by e.employee_id";
    }
} else {
    $r_t = 'twc';
    $is_rt = 'twc';
}

if ($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 6) {
    $employees = $db->run($sql)->fetchAll();
    // echo "<pre>"; print_r($employees); exit();
}


if (SITE_DATE_FORMAT == 1) {
    $date_format = "DD-MM-YYYY";
} elseif (SITE_DATE_FORMAT == 2) {
    $date_format = "MM-DD-YYYY";
} elseif (SITE_DATE_FORMAT == 3) {
    $date_format = "Day-Month-Year";
}
