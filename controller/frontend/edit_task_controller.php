<?php
if (isset($_REQUEST['edit_task_id'])) {
    $current_id = $_REQUEST['edit_task_id'];
    $employee_array = array();
    //$get_row_project=$db->get_row('to_do_list',array('task_id'=>$current_id));
    $task_details = $db->run("select to_do_list.*, projects.project_name from to_do_list
    LEFT JOIN projects ON to_do_list.project_id = projects.project_id where to_do_list.task_id='" . $current_id . "'
    order by to_do_list.task_id DESC")->fetch();
}

if (isset($_POST['submit_add_task'])) {
    $task_title = $_POST['task_title'];
    $project_id = $_POST['proejct_id'];
    $company_id = $_SESSION['company_id'];
    $user_id = $_SESSION['employee_id'];
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $create_on = date('y-m-d h:i:s');
    if ($task_title == '') {
        $display_msg = '<div class="alert alert-danger">
                        		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_task_title"] . '
                        		</div>';
    } elseif ($project_id == '') {
        $display_msg = '<div class="alert alert-danger">
                        		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["select_project"] . '
                        		</div>';
    } else {
        $update_task = $db->update('to_do_list', array(
            'project_id' => $project_id, 'task_name' => $task_title, 'start_date' => $start_date, 'end_date' => $end_date
        ), array('task_id' => $current_id));
        if ($update_task) {
            $display_msg = '<div class="alert alert-success">
                                	 <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["update_success"] . '
                                	 </div>';
        } else {
            $display_msg = '<div class="alert alert-danger">
                                	 <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["error_occured"] . '
                                	 </div>';
        }
        /*
            $task_details=$db->run("select to_do_list.*, projects.project_name from to_do_list
    LEFT JOIN projects ON to_do_list.project_id = projects.project_id where to_do_list.task_id='".$current_id."'
    order by to_do_list.task_id DESC")->fetch(); */
        echo "<script>
                 setTimeout(function(){
	    		  window.location = '" . $link->link("edit_task", frontend, '&edit_task_id=' . $current_id) . "'
	                },2000);</script>";
    }
}
