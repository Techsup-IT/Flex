
<?php if (isset($_POST['submit_add_project'])) {
    //print_r($_POST);
    $project_title = $_POST['project_title'];
    $radio1 = $_POST['radio1'];
    $employee_id_list = $_POST['employee_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $company_id = $_SESSION['company_id'];
    $user_id = $_SESSION['employee_id'];
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $create_on = date('y-m-d h:i:s');
    $project_assign = is_array($employee_id_list);
    if ($project_assign && $radio1 == "private") {
        $project_type = "private";
    } elseif ($radio1 == "private") {
        $project_type = "none";
    } else {
        $project_type = "public";
    }
    if ($project_title == '') {
        $display_msg = '<div class="alert alert-danger">
                    		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_project_title"] . '
                    		</div>';
    } else {
        $insert_projects = $db->insert('projects', array(
            'project_name' => $project_title, 'project_type' => $project_type, 'start_date' => $start_date, 'end_date' => $end_date, 'company_id' => $company_id, 'employee_id' => $user_id, 'share_project_to' => '0', 'ip_address' => $ip_address, 'created_date' => $create_on
        ));
        if ($insert_projects) {
            $last_id = $db->lastInsertId();
            if ($project_assign) {
                foreach ($employee_id_list as $emp_id) {
                    $insert_projects_assign = $db->insert('project_assign', array(
                        'project_id' => $last_id, 'employee_id' => $emp_id, 'company_id' => $company_id, 'ip_address' => $ip_address, 'created_date' => $create_on
                    ));
                }
            } elseif ($project_type == "public") {
                $all_employees = $db->run("Select employee_id from employee where company_id='" . $company_id . "' AND department!='1'")->fetchAll();
                if (is_array($all_employees)) {
                    foreach ($all_employees as $emp_id) {
                        $insert_projects_assign = $db->insert('project_assign', array(
                            'project_id' => $last_id, 'employee_id' => $emp_id['employee_id'], 'company_id' => $company_id, 'ip_address' => $ip_address, 'created_date' => $create_on
                        ));
                    }
                }
            }
            $display_msg = '<div class="alert alert-success">
                            	 <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["add_success"] . '
                            	 </div>';
            echo "<script>
                    setTimeout(function(){
	    		        window.location = '" . $link->link("projects", frontend) . "'
	                },2000);
                </script>";
        }
    }
} ?>