
<?php if (isset($_POST['submit_add_task'])) {
    //print_r($_POST);
    $task_title = $_POST['task_title'];
    $project_id = $_POST['proejct_id'];
    $company_id = $_SESSION['company_id'];
    $user_id = $_SESSION['employee_id'];
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $create_on = date('y-m-d h:i:s');
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    if ($task_title == '') {
        $display_msg = '<div class="alert alert-danger">
                    		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_task_title"] . '
                    		</div>';
    } elseif ($project_id == '') {
        $display_msg = '<div class="alert alert-danger">
                    		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["select_project"] . '
                    		</div>';
    } else {
        $insert_task = $db->insert('to_do_list', array(
            'project_id' => $project_id, 'task_name' => $task_title, 'start_date' => $start_date, 'end_date' => $end_date, 'company_id' => $company_id, 'employee_id' => $user_id, 'ip_address' => $ip_address, 'created_date' => $create_on
        ));
        //$db->debug();
        if ($insert_task) {
            $display_msg = '<div class="alert alert-success">
                            	 <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["add_success"] . '
                            	 </div>';
            echo "<script>
                    setTimeout(function(){
	    		        window.location = '" . $link->link("tasks", frontend) . "'
	                },2000);
                </script>";
        } else {
            $display_msg = '<div class="alert alert-danger">
                            	 <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["error_occured"] . '
                            	 </div>';
        }
    }
} ?>