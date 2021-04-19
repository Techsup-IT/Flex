<?php
$company_id = $_SESSION['company_id'];
$employee_id = $_SESSION['employee_id'];

$previous_jobs = $db->run("
                    SELECT pa.employee_id, pa.project_id, p.project_name, p.rating, c.company_name, GROUP_CONCAT(DISTINCT t.task_name) as task_name, SUM(sc.check_out_time) as working_hours 
                    FROM project_assign pa 
                    LEFT JOIN projects p on pa.project_id = p.project_id 
                    LEFT JOIN company c ON pa.company_id = c.id 
                    LEFT JOIN to_do_list t on pa.project_id = t.project_id 
                    LEFT JOIN shift_check sc on (pa.project_id = sc.project_id AND pa.employee_id = sc.employee_id AND pa.company_id = sc.company_id AND t.task_id = sc.task_id) 
                    WHERE pa.employee_id = $employee_id AND pa.company_id = $company_id GROUP BY pa.project_id
                ")->fetchAll();

// $previous_jobs = array();
// if (count($previous_jobs_data) > 0) {
//     foreach ($previous_jobs_data as $proj) {
//         $previous_jobs[$proj['project_id']][] = $proj;
//     }
// }
// echo "<pre>"; print_r($previous_jobs); exit();
