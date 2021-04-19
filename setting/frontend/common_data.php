<?php
if (!$session->Check()) {

    $session->redirect('login', frontend);
}

$user_companies = array();

if ($_SESSION['department'] == 5) {
    $company = $db->run("SELECT * from `company`")->fetchAll();
    if (($_SESSION['company_id'] == '' || $_SESSION['company_id'] == 0) && !empty($company)) {
        $_SESSION['company_id'] = 1;
    }

    $companies = $db->run("SELECT id as company_id, company_name FROM company")->fetchAll();
    if (!empty($companies)) {
        foreach ($companies as $c) {
            // $user_companies[$c['company_id']] = $c['company_name'];
            $user_companies[] = $c['company_id'];
        }
    }
    // echo "<pre>"; print_r($user_companies); exit();
} else if ($_SESSION['department'] == 1  || $_SESSION['department'] == 4 || $_SESSION['department'] == 3) {
    $user_companies = $_SESSION['user_companies'];
} else {
    $user_companies[] = $_SESSION['company_id'];
}

if ($_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 3) {
    $company = $db->run("SELECT * from `company` where id in (" . implode(',', $_SESSION['user_companies']) . ") ")->fetchAll();
}

// $employees = $db->get_all('employee', array('company_id' => $_SESSION['company_id']));
$employees = $db->run("SELECT * from `employee` where (`department`='2' AND `company_id` ='" . $_SESSION['company_id'] . "') or (`department`='3' and `company_id` in (" . implode(',', $user_companies) . ") ) ")->fetchAll();

$user_id = $_SESSION['employee_id'];
$user_details = array();
$users_name = array();

if ($_SESSION['department'] != 2) {
    $user_details = $db->get_all('employee', array('employee_id' => $user_id))[0];
}

foreach ($employees as $val) {
    if ($val['department'] == 2 || $val['department'] == 3) {
        $users_name[] = $val;
        if ($val['employee_id'] == $user_id) {
            $user_details = $val;
        }
    } else {
        if ($val['department'] == 1  && $val['employee_id'] == $user_id) {
            $user_details = $val;
        } elseif ($_SESSION['department'] == 5 || $_SESSION['department'] == 4 || $_SESSION['department'] == 6) {
            if ($val['employee_id'] == $user_id) {
                $user_details = $val;
            }
        }
    }
}

$user_count = count($users_name);
$company_details = $db->get_row('company', array('id' => $_SESSION['company_id']));


define('SITE_DATE_FORMAT', $company_details['date_format']);
define('SITE_NAME', $company_details['name']);
define('default_timezone', date_default_timezone_get());
define('new_timezone', $company_details['timezone']);

define('CURRENT_LOGIN_ID', $_SESSION['employee_id']);
define('CURRENT_LOGIN_COMPANY_ID', $_SESSION['company_id']);
define('COMPANY_ALLOWED_EMPLOYEE', $company_details['currently_allowed_employee']);
