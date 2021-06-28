<?php
if($_REQUEST['token'] && $security->decrypt($_REQUEST['token'], key))
{

	$postdata=file_get_contents("php://input");
	header('Content-Type: application/json');

	$request=array();
	$sessions = array();
	$request = json_decode($postdata,true);

	$opertion=$request['operation'];
	$task_title = $request['task_title'];
	$project_title = $request['project_title'];
	$check_out_time =$request['check_out_time'];
	$employee_id = $request['employee_id'];
	$id = $request['id'];
    $company_id = $request['company_id'];
    $request["create_date"]=date('Y/m/d');
    $request["ip_address"]=$_SERVER['REMOTE_ADDR'];



    if($opertion=='insert')
    {
           $insert=$db->insert('project',$request);
    }
    elseif($opertion=='update')
    {
        $update = $db->update("project",array('task_title'=>$task_title,'project_title'=>$project_title,'check_out_time'=>$check_out_time),array('id'=>$id));
    }
    elseif($opertion=='delete')
    {
        $delete=$db->delete('project',array('id'=>$id));

    }


}