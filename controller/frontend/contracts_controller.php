<?php

$company_id = $_SESSION['company_id'];
$employee_id = $_REQUEST['employee_id'];
if ($_SESSION['department'] == 3) {
    $employee_id == $_SESSION['employee_id'];
}
$allowed_types = [3, 4, 5];
if (!in_array($_SESSION['department'], $allowed_types) || $employee_id < 0 || $employee_id == '') {
    echo "<script>window.location = '" . SITE_URL . "'</script>";
}

$sql = "SELECT ecm.*, concat(e.emp_name, ' ', e.emp_surname) as employee_name, e.IdNumber, e.EstLaborOfficeId, e.EstSequenceNumber, e.employee_national_number, e.dob, e.city_id, c.company_name FROM employee_company_map ecm LEFT JOIN employee e on e.employee_id = ecm.employee_id LEFT JOIN company c on c.id = ecm.company_id WHERE ecm.employee_id = $employee_id and ecm.company_id = $company_id";
$contracts = $db->run($sql)->fetchAll();
// echo "<pre>"; print_r($contracts); exit();