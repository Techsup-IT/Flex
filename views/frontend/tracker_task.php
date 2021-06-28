<?php
//{"task_name":"Null","company_id":"1","project_id":"9","employee_id":"2","task_id":"Null","operation":"tasklist"}
if($_REQUEST['token'] && $security->decrypt($_REQUEST['token'], key))
{
	$postdata=file_get_contents("php://input");
	header('Content-Type: application/json');

	$request=array();
	$sessions = array();
	$request = json_decode($postdata,true);
	//print_r($postdata);

	$operation=$request['operation'];
	$task_name = $request['task_name'];
	$project_name = $request['project_name'];
	$employee_id = $request['employee_id'];
	$task_id = $request['task_id'];
    $company_id = $request['company_id'];
	$create_date=date('Y/m/d');
	$ip_address=$_SERVER['REMOTE_ADDR'];
	$project_id = $request['project_id'];


    if($operation=='insert')
    {
        //{"task_name":"ERP Task 02","company_id":"1","employee_id":"3","projct_id":"23","project_name":"ERP - One","operation":"insert"}
        $insert=$db->insert('to_do_list',array('task_name'=>$task_name,'project_id'=>$project_id,'employee_id'=>$employee_id,'company_id'=>$company_id,'created_date'=>$create_date,'ip_address'=>$ip_address));
        //$db->debug();
        if($insert)
        {
        	$sessions['last_id'] = $db->lastInsertId();
        	$sessions['status'] = true;
        	echo json_encode($sessions);
        }

    }
    elseif($operation=='update')
    {
        $update = $db->update('to_do_list',array('task_name'=>$task_name,'project_id'=>$project_id),array('task_id'=>$task_id,'employee_id'=>$employee_id,'company_id'=>$company_id));
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
    	 //$view=$db->run("SELECT * from `to_do_list` where `employee_id`='".$employee_id."' AND `company_id`='".$company_id."' ORDER BY project_name DESC")->fetchAll();
    	 $view=$db->run("SELECT SUM(check_out_time), to_do_list. *, projects.project_name 
			FROM to_do_list
			LEFT JOIN shift_check ON to_do_list.task_id = shift_check.task_id
			JOIN project_assign ON project_assign.project_id = to_do_list.project_id
			JOIN projects ON projects.project_id = to_do_list.project_id
    	    where project_assign.`employee_id`='".$employee_id."' AND to_do_list.`company_id`='".$company_id."'
    	    GROUP BY to_do_list.task_id
			ORDER BY to_do_list.task_id DESC")->fetchAll();
        if($view)
        {
          echo json_encode($view);
        }
    }
    elseif($operation=='delete')
    {

    	$delete=$db->delete('to_do_list',array('task_id'=>$task_id,'employee_id'=>$employee_id,'company_id'=>$company_id));
    	if($delete)
    	{
    		$sessions['status'] = true;
    		echo json_encode($sessions);
    	}
    }
    
    elseif($operation=='tasklist')
    {
        $view=$db->run("SELECT to_do_list.*,projects.project_name from `to_do_list`
            LEFT JOIN project_assign ON project_assign.project_id = to_do_list.project_id
            JOIN projects ON projects.project_id = to_do_list.project_id 
            where project_assign.`project_id`='".$project_id."' AND project_assign.`employee_id`='".$employee_id."' AND project_assign.`company_id`='".$company_id."'
            ORDER BY task_id DESC")->fetchAll();
        if($view)
        {
        	echo json_encode($view);
        
        }
    }

}

else
{
	$session->redirect('404',frontend);
}


