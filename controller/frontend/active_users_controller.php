<?php

$asql = "SELECT e.employee_id, sc.ip_address, e.emp_name, e.emp_surname, e.email, c.company_name FROM `shift_check` sc left join employee e on sc.employee_id = e.employee_id left join company c on c.id = e.company_id WHERE sc.current_dt = '".date('Y-m-d')."' and ( sc.check_out = '' or sc.check_out IS NULL ) group by sc.employee_id";
$users = $db->run($asql)->fetchAll();