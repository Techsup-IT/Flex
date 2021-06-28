<?php
if($_REQUEST['token'] && $security->decrypt($_REQUEST['token'], key))
{

	$postdata=file_get_contents("php://input");
	header('Content-Type: application/json');

	$request=array();
	$sessions = array();
	$request = json_decode($postdata,true);

	$operation=$request['operation'];
	$end_date = $request['end_date'];
	$project_name = $request['project_name'];

	/***************** by Rishabh ****************/
	$task_name = $request['task_name'];
	/****** End *******/
    $employee_id = $request['employee_id'];
	$project_id = $request['project_id'];
    $company_id = $request['company_id'];
    $create_date=date('Y/m/d');
    $ip_address=$_SERVER['REMOTE_ADDR'];


    if($operation=='insert')
    {
        $insert=$db->insert('projects',array('end_date'=>$end_date,'project_name'=>$project_name,'project_type'=>'private','employee_id'=>$employee_id,'company_id'=>$company_id,'created_date'=>$create_date,'ip_address'=>$ip_address));
	    if($insert)
	    {
	    	$sessions['last_id'] = $db->lastInsertId();

	    	$lst_id = $db->lastInsertId();
	    	/***************** by Rishabh ****************/
	    	if($task_name != '')
	    	  $insert=$db->insert('to_do_list',array('task_name'=>$task_name,'project_id'=>$lst_id,'employee_id'=>$employee_id,'company_id'=>$company_id,'created_date'=>$create_date,'ip_address'=>$ip_address));
	    	/****** End *******/
	    	$insert_user_project= $db->insert('project_assign', array('project_id'=>$sessions['last_id'], 'employee_id'=>$employee_id, 'company_id'=>$company_id,'created_date'=>$create_date,'ip_address'=>$ip_address));//*
	    	if($insert_user_project) {
		    	$sessions['status'] = true;
		    	echo json_encode($sessions);
	    	}
	    	else {
	    	    $sessions['status'] = false;
	    	    echo json_encode($sessions);
	    	}
	    }
    }
    elseif($operation=='update')
    {
        $update = $db->update('projects',array('end_date'=>$end_date,'project_name'=>$project_name),array('project_id'=>$project_id,'employee_id'=>$employee_id,'company_id'=>$company_id));
        if($update)
		    {
		    	$sessions['status'] = true;
		    	echo json_encode($sessions);
		    }
		else
		{
             $sessions['status'] = false;
             echo json_encode($sessions);
		}
    }
    elseif($operation=='view')
    {
	  $view = $db->run("SELECT SUM( check_out_time ) , projects.* 
			FROM projects
			LEFT JOIN shift_check ON projects.project_id = shift_check.project_id  
	        join project_assign ON projects.project_id=project_assign.project_id
	        where project_assign.`employee_id`='".$employee_id."' AND project_assign.`company_id`='".$company_id."'
			GROUP BY project_assign.project_id
			ORDER BY project_assign.project_id DESC")->fetchAll();
        	 //}
       if($view)
	   {
	      echo json_encode($view);

	   }
    }
    elseif($operation=='delete')
    {

    	$delete=$db->delete('project_assign',array('project_id'=>$project_id,'employee_id'=>$employee_id,'company_id'=>$company_id));
    	if($delete)
    	{
    	    $update=$db->update('projects',array('project_type'=>'private'),array('project_id'=>$project_id));
    		$sessions['status'] = true;
    		echo json_encode($sessions);
    	}
    }

}

else
{
	$session->redirect('404',frontend);
}