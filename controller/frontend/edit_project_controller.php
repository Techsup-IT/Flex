<?php
if (isset($_REQUEST['edit_project_id'])) {
    $current_id = $_REQUEST['edit_project_id'];
    $employee_array = array();
    $get_row_project = $db->get_row('projects', array('project_id' => $current_id));

    $get_row_project_assign = $db->get_all('project_assign', array('project_id' => $current_id));

    if (is_array($get_row_project_assign)) {
        foreach ($get_row_project_assign as $ei) {
            array_push($employee_array, $ei['employee_id']);
        }
    }
    //print_r($employee_array);

}

if (isset($_POST['submit_add_project'])) {
    //print_r($_POST);
    $project_title = $_POST['project_title'];
    $radio1 = $_POST['radio1'];
    if ($project_assign && $radio1 == "private") {
        $project_type = "private";
    } elseif ($radio1 == "private") {
        $project_type = "none";
    } else {
        $project_type = "public";
    }
    $employee_id_list = $_POST['employee_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $rating = $_POST['rating'];
    $company_id = $_SESSION['company_id'];
    $user_id = $_SESSION['employee_id'];
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $create_on = date('y-m-d h:i:s');
    if ($project_title == '') {
        $display_msg = '<div class="alert alert-danger">
                    		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_project_title"] . '
                    		</div>';
    } else {
        $update_projects = $db->update(
            'projects',
            array(
                'project_name' => $project_title, 'start_date' => $start_date, 'end_date' => $end_date, 'project_type' => $project_type, 'rating' => $rating
            ),
            array(
                'project_id' => $current_id
            )
        );
        //$db->debug();
        if (true) {
            if ($project_type != "public") {
                $remove_old = $db->delete('project_assign', array('project_id' => $current_id));
                foreach ($employee_id_list as $emp_id) {
                    $insert_projects_assign = $db->insert('project_assign', array(
                        'project_id' => $current_id, 'employee_id' => $emp_id, 'company_id' => $company_id, 'ip_address' => $ip_address, 'created_date' => $create_on
                    ));
                }
            } elseif ($project_type == "public") {
                $remove_old = $db->delete('project_assign', array('project_id' => $current_id));
                $all_employees = $db->run("Select employee_id from employee where company_id='" . $company_id . "' AND department!='1'")->fetchAll();
                if (is_array($all_employees)) {
                    foreach ($all_employees as $emp_id) {
                        $insert_projects_assign = $db->insert('project_assign', array(
                            'project_id' => $current_id, 'employee_id' => $emp_id['employee_id'], 'company_id' => $company_id, 'ip_address' => $ip_address, 'created_date' => $create_on
                        ));
                    }
                }
            }
        }
        $display_msg = '<div class="alert alert-success">
                            	 <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["update_success"] . '
                            	 </div>';
        echo "<script>
                 setTimeout(function(){
	    		  window.location = '" . $link->link("edit_project", frontend, '&edit_project_id=' . $current_id) . "'
	                },2000);</script>";
    }
}
