<?php

$company_id = $_SESSION['company_id'];
$employee_id = $_SESSION['employee_id'];

$speciality_list = array();
if (file_exists(SERVER_ROOT . '/uploads/job_titles.json')) {
    $speciality_list = file_get_contents(SERVER_ROOT . '/uploads/job_titles.json');
}
$specialitiesAll = json_decode($speciality_list, true);
$specialities = array_column($specialitiesAll, $_SESSION['site_lang'] . '_Title');
$specialities_map = array_combine(array_keys($specialitiesAll), $specialities);
// echo "<pre>";
// print_r(array_column($specialities, 'English_Title'));
// exit();

$is_search = false;
$extra_where = "";
if (isset($_POST['search_speciality']) && $_POST['search_speciality'] != '') {
    $speciality = 0;
    if ($job_id = array_search($_POST['search_speciality'], $specialities_map)) {
        $speciality = $job_id;
    }
    // foreach ($specialitiesAll as $job_id => $job_data) {
    //     if ($_POST['search_speciality'] == $job_data[$_SESSION['site_lang'] . '_Title']) {
    //         $speciality = $job_id;
    //         break;
    //     }
    // }
    $extra_where .= " AND c.speciality = " . $speciality . " ";
    $is_search = true;
}
if (isset($_POST['search_price']) && $_POST['search_price'] != '') {
    $extra_where .= " AND c.hourly_rate <= " . $_POST['search_price'] . " ";
}
if (isset($_POST['search_work_exp']) && $_POST['search_work_exp'] != '') {
    $extra_where .= " AND w.years_of_exp >= " . $_POST['search_work_exp'] . " ";
}

// echo $extra_where; exit();

$freelancers = $db->run("
                    SELECT e.employee_id, CONCAT(e.emp_name, ' ', e.emp_surname) as employee_name , e.skills, e.major, e.other_major, c.speciality, c.hourly_rate, GROUP_CONCAT(DISTINCT w.job_title) as job_title, GROUP_CONCAT(DISTINCT w.years_of_exp) as years_of_exp 
                    FROM employee e 
                    LEFT JOIN contract_info c on e.employee_id = c.employee_id 
                    LEFT JOIN work_experience_info w on e.employee_id = w.employee_id 
                    WHERE e.department = 3 
                    and c.speciality IS NOT null 
                    $extra_where 
                    GROUP BY e.employee_id, c.speciality
                ")->fetchAll();
                
// echo "<pre>"; print_r($freelancers); exit();
